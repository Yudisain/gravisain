<?php
/**
 * Dynamic CSS Physical File Cache
 *
 * @package Gravisain\CSS
 */

namespace Gravisain\CSS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CSSFileCache Class
 *
 * Saves generated dynamic CSS string to a physical static stylesheet
 * (`wp-content/uploads/gravisain/gravisain-dynamic.css`) so browsers can cache it
 * across page requests, reducing PHP server CPU processing.
 */
class CSSFileCache {

	/**
	 * Initialize the CSS file cache service.
	 *
	 * @return void
	 */
	public static function init(): void {
		add_action( 'customize_save_after', [ self::class, 'clear_cache' ] );
	}

	/**
	 * Enqueue cached physical stylesheet or fallback to inline `<style>` tag.
	 *
	 * @param string $css_content The compiled dynamic CSS rules.
	 * @return void
	 */
	public static function enqueue_or_inject( string $css_content ): void {
		if ( empty( $css_content ) ) {
			return;
		}

		// Use inline style during Customizer live preview or if file cache is disabled.
		if ( is_customize_preview() || ! get_theme_mod( 'gravisain_dynamic_css_file_cache', true ) ) {
			self::inject_inline( $css_content );
			return;
		}

		$upload_dir = wp_upload_dir();
		if ( ! empty( $upload_dir['error'] ) ) {
			self::inject_inline( $css_content );
			return;
		}

		$cache_dir = trailingslashit( $upload_dir['basedir'] ) . 'gravisain';
		$cache_url = trailingslashit( $upload_dir['baseurl'] ) . 'gravisain';
		$file_path = $cache_dir . '/gravisain-dynamic.css';

		$scheme = ( is_ssl() || ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === $_SERVER['HTTP_X_FORWARDED_PROTO'] ) || ( isset( $_SERVER['HTTPS'] ) && 'off' !== $_SERVER['HTTPS'] ) ) ? 'https' : null;
		$file_url  = set_url_scheme( $cache_url . '/gravisain-dynamic.css', $scheme );

		// Ensure directory exists.
		if ( ! file_exists( $cache_dir ) ) {
			wp_mkdir_p( $cache_dir );
		}

		$current_hash = md5( $css_content );
		$cached_hash  = get_option( 'gravisain_dynamic_css_hash', '' );

		// Write or overwrite cache file if missing, empty, or content changed.
		if ( ! file_exists( $file_path ) || filesize( $file_path ) === 0 || $cached_hash !== $current_hash ) {
			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once ABSPATH . 'wp-admin/includes/file.php';
				WP_Filesystem();
			}

			$written = false;
			if ( $wp_filesystem ) {
				$written = $wp_filesystem->put_contents( $file_path, $css_content, FS_CHMOD_FILE );
			}

			if ( ! $written ) {
				self::inject_inline( $css_content );
				return;
			}

			update_option( 'gravisain_dynamic_css_hash', $current_hash, false );
		}

		// Ensure dynamic CSS loads AFTER main Vite styles so overrides win.
		$deps = [ 'gravisain-style' ];
		if ( wp_style_is( 'gravisain-vite-css', 'registered' ) || wp_style_is( 'gravisain-vite-css', 'enqueued' ) ) {
			$deps[] = 'gravisain-vite-css';
		}

		// Enqueue cached physical file with content hash version for instant cache invalidation.
		$version = @filemtime( $file_path ) ? @filemtime( $file_path ) . '-' . substr( $current_hash, 0, 8 ) : substr( $current_hash, 0, 8 );
		wp_enqueue_style(
			'gravisain-dynamic-css',
			$file_url,
			$deps,
			$version
		);
	}

	/**
	 * Print inline style tag inside <head>.
	 *
	 * @param string $css_content The CSS content to echo.
	 * @return void
	 */
	private static function inject_inline( string $css_content ): void {
		add_action( 'wp_head', function () use ( $css_content ): void {
			echo "<!-- Gravisain Dynamic CSS -->\n";
			echo "<style id='gravisain-dynamic-css'>\n" . $css_content . "\n</style>\n";
		}, 100 );
	}

	/**
	 * Delete cached physical CSS file and hash option so it regenerates cleanly.
	 *
	 * @return void
	 */
	public static function clear_cache(): void {
		delete_option( 'gravisain_dynamic_css_hash' );

		$upload_dir = wp_upload_dir();
		if ( ! empty( $upload_dir['error'] ) ) {
			return;
		}

		$file_path = trailingslashit( $upload_dir['basedir'] ) . 'gravisain/gravisain-dynamic.css';
		if ( file_exists( $file_path ) ) {
			@unlink( $file_path );
		}
	}
}
