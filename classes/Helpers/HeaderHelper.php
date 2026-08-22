<?php
/**
 * Header Helper Functions
 *
 * @package Gravisain\Helpers
 */

namespace Gravisain\Helpers;

class HeaderHelper {

	/**
	 * Check if transparent header should be active on the current page.
	 *
	 * @return bool
	 */
	public static function is_transparent_header(): bool {
		if ( is_singular() ) {
			$post_id = get_the_ID();
			if ( $post_id && class_exists( '\\Gravisain\\Meta\\PageSettings' ) ) {
				$meta_trans = \Gravisain\Meta\PageSettings::get_meta_value( $post_id, '_gravisain_transparent_header', '' );
				if ( 'enable' === $meta_trans ) {
					return true;
				}
				if ( 'disable' === $meta_trans ) {
					return false;
				}
			}
		}

		$is_enabled = get_theme_mod( 'gravisain_transparent_header_enable', false );

		if ( ! $is_enabled ) {
			return false;
		}

		// Disable on Archives
		if ( is_archive() || is_home() ) {
			$disable_archive = get_theme_mod( 'gravisain_transparent_header_disable_archive', true );
			if ( $disable_archive ) {
				return false;
			}
		}

		// Disable on 404 & Search
		if ( is_404() || is_search() ) {
			$disable_404 = get_theme_mod( 'gravisain_transparent_header_disable_404', true );
			if ( $disable_404 ) {
				return false;
			}
		}

		/**
		 * Filter the transparent header status.
		 * Allows meta boxes or plugins to override this setting per-page.
		 *
		 * @param bool $is_transparent
		 */
		return (bool) apply_filters( 'gravisain_is_transparent_header', true );
	}

	/**
	 * Get the sticky header mode setting.
	 *
	 * @return string 'none', 'main_row', or 'entire_header'
	 */
	public static function get_sticky_header_mode(): string {
		$mode = get_theme_mod( 'gravisain_sticky_header_enable', 'none' );
		if ( empty( $mode ) || 'none' === $mode ) {
			return 'none';
		}
		return $mode;
	}
}
