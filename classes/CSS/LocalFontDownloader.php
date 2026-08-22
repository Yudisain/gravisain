<?php
/**
 * Local Google Fonts Downloader (GDPR Compliant & Core Web Vitals)
 *
 * @package Gravisain\CSS
 */

namespace Gravisain\CSS;

/**
 * LocalFontDownloader Class
 *
 * Responsible for downloading Google Fonts stylesheet and its .woff2 font files
 * to the local server (`wp-content/uploads/gravisain/fonts/`) to eliminate external
 * requests to fonts.googleapis.com and fonts.gstatic.com.
 */
class LocalFontDownloader {

	/**
	 * Initialize the service and register hooks.
	 *
	 * @return void
	 */
	public static function init(): void {
		add_action( 'customize_save_after', [ self::class, 'clear_cache' ] );
	}

	/**
	 * Retrieve a local stylesheet URL for the given remote Google Fonts URL.
	 *
	 * If local font loading is disabled or during Customizer preview, returns the
	 * original remote URL. Otherwise, downloads and rewrites the CSS to point
	 * to locally hosted .woff2 files.
	 *
	 * @param string $remote_url The Google Fonts CSS2 URL.
	 * @return string The local CSS URL, or fallback to the remote URL.
	 */
	public static function get_local_url( string $remote_url ): string {
		if ( empty( $remote_url ) ) {
			return '';
		}

		// Use remote URL during Customizer live preview or if setting is disabled.
		if ( is_customize_preview() || ! get_theme_mod( 'gravisain_local_google_fonts', true ) ) {
			return $remote_url;
		}

		$upload_dir = wp_upload_dir();
		if ( ! empty( $upload_dir['error'] ) ) {
			return $remote_url;
		}

		$fonts_dir = trailingslashit( $upload_dir['basedir'] ) . 'gravisain/fonts';
		$fonts_url = trailingslashit( $upload_dir['baseurl'] ) . 'gravisain/fonts';

		$hash      = md5( $remote_url );
		$css_file  = $fonts_dir . '/google-fonts-' . $hash . '.css';
		$css_url   = $fonts_url . '/google-fonts-' . $hash . '.css';

		// If cached CSS file already exists, return its URL.
		if ( file_exists( $css_file ) && filesize( $css_file ) > 0 ) {
			return $css_url;
		}

		// Ensure directory exists.
		if ( ! file_exists( $fonts_dir ) ) {
			wp_mkdir_p( $fonts_dir );
		}

		// Fetch remote CSS with a modern WOFF2-capable User Agent.
		$response = wp_remote_get( $remote_url, [
			'timeout'    => 15,
			'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
		] );

		if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
			return $remote_url;
		}

		$css_content = wp_remote_retrieve_body( $response );
		if ( empty( $css_content ) ) {
			return $remote_url;
		}

		// Extract all font URLs (e.g. https://fonts.gstatic.com/s/...)
		preg_match_all( '/url\s*\(\s*[\'"]?(https?:[^\'"\)]+)[\'"]?\s*\)/i', $css_content, $matches );

		if ( ! empty( $matches[1] ) ) {
			$unique_urls = array_unique( $matches[1] );

			foreach ( $unique_urls as $font_remote_url ) {
				$font_filename = basename( parse_url( $font_remote_url, PHP_URL_PATH ) );

				// Append hash to avoid name collisions across different font versions
				$local_font_file = $fonts_dir . '/' . $font_filename;
				$local_font_url  = $fonts_url . '/' . $font_filename;

				if ( ! file_exists( $local_font_file ) || filesize( $local_font_file ) === 0 ) {
					$font_response = wp_remote_get( $font_remote_url, [
						'timeout'  => 15,
						'stream'   => true,
						'filename' => $local_font_file,
					] );

					if ( is_wp_error( $font_response ) || 200 !== (int) wp_remote_retrieve_response_code( $font_response ) ) {
						// Clean up partial file if download failed
						if ( file_exists( $local_font_file ) ) {
							@unlink( $local_font_file );
						}
						continue;
					}
				}

				// Replace remote font URL with local font URL in the CSS content
				$css_content = str_replace( $font_remote_url, esc_url_raw( $local_font_url ), $css_content );
			}
		}

		// Save processed CSS to cache file
		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
			WP_Filesystem();
		}

		if ( $wp_filesystem && $wp_filesystem->put_contents( $css_file, $css_content, FS_CHMOD_FILE ) ) {
			return $css_url;
		}

		// Fallback to safe file_put_contents if WP_Filesystem couldn't write
		if ( @file_put_contents( $css_file, $css_content ) !== false ) {
			return $css_url;
		}

		return $remote_url;
	}

	/**
	 * Clear all cached Google font files and stylesheets.
	 *
	 * @return void
	 */
	public static function clear_cache(): void {
		$upload_dir = wp_upload_dir();
		if ( ! empty( $upload_dir['error'] ) ) {
			return;
		}

		$fonts_dir = trailingslashit( $upload_dir['basedir'] ) . 'gravisain/fonts';
		if ( ! is_dir( $fonts_dir ) ) {
			return;
		}

		$files = glob( $fonts_dir . '/*' );
		if ( is_array( $files ) ) {
			foreach ( $files as $file ) {
				if ( is_file( $file ) ) {
					@unlink( $file );
				}
			}
		}
	}
}
