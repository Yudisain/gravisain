<?php
/**
 * Layout Helper Class
 *
 * @package Gravisain\Helpers
 */

namespace Gravisain\Helpers;

/**
 * LayoutHelper Class
 * 
 * Provides utility methods for resolving layout and container style modifiers.
 */
class LayoutHelper {

	/**
	 * Get the container style class based on current page context and customizer settings.
	 *
	 * @param string $context Context ('archive', 'single', 'page', 'default').
	 * @return string
	 */
	public static function get_container_style_class( string $context = 'default' ): string {
		$classes = [];
		if ( 'single' === $context || 'page' === $context || is_singular() ) {
			$post_id = get_the_ID();
			if ( $post_id ) {
				$meta_style = \Gravisain\Meta\PageSettings::get_meta_value( $post_id, '_gravisain_content_style', 'default' );
				if ( 'boxed' === $meta_style ) {
					$classes[] = 'layout-boxed';
					$classes[] = 'layout-contained';
				} elseif ( 'unboxed' === $meta_style ) {
					$classes[] = 'layout-unboxed';
					$classes[] = 'layout-full-width';
				} elseif ( ! empty( $meta_style ) && 'default' !== $meta_style ) {
					$classes[] = 'layout-' . esc_attr( $meta_style );
				}
				$meta_layout = \Gravisain\Meta\PageSettings::get_meta_value( $post_id, '_gravisain_sidebar_layout', 'default' );
				if ( 'narrow' === $meta_layout || 'normal' === $meta_layout || 'no-sidebar' === $meta_layout ) {
					$classes[] = 'layout-' . esc_attr( $meta_layout );
				}
			}
		}

		$default_style = get_theme_mod( 'gravisain_default_container_style', 'full-width' );

		if ( 'archive' === $context || is_archive() || is_home() || is_search() ) {
			$style = get_theme_mod( 'gravisain_archive_container_style', 'inherit' );
		} elseif ( 'single' === $context || 'page' === $context || is_singular() ) {
			$style = get_theme_mod( 'gravisain_single_container_style', 'inherit' );
		} else {
			$style = 'inherit';
		}

		if ( 'inherit' === $style || empty( $style ) ) {
			$style = $default_style;
		}

		$has_box_style = false;
		foreach ( $classes as $c ) {
			if ( in_array( $c, [ 'layout-boxed', 'layout-unboxed', 'layout-contained', 'layout-full-width', 'layout-separated' ], true ) ) {
				$has_box_style = true;
				break;
			}
		}

		if ( ! $has_box_style ) {
			$classes[] = 'layout-' . esc_attr( $style );
		}

		return implode( ' ', array_unique( $classes ) );
	}

	/**
	 * Get the container element class based on current page context and customizer settings.
	 *
	 * @param string $context Context ('archive', 'single', 'page', 'default').
	 * @return string
	 */
	public static function get_container_class( string $context = 'default' ): string {
		$default_style = get_theme_mod( 'gravisain_default_container_style', 'full-width' );

		if ( 'archive' === $context || is_archive() || is_home() || is_search() ) {
			$style = get_theme_mod( 'gravisain_archive_container_style', 'inherit' );
		} elseif ( 'single' === $context || 'page' === $context || is_singular() ) {
			$style = get_theme_mod( 'gravisain_single_container_style', 'inherit' );
		} else {
			$style = 'inherit';
		}

		if ( 'inherit' === $style || empty( $style ) ) {
			$style = $default_style;
		}

		$class = 'container';
		if ( 'full-width-stretched' === $style ) {
			$class .= ' container-stretched';
		} elseif ( 'single' === $context || 'page' === $context || is_singular() ) {
			$post_id = get_the_ID();
			if ( $post_id ) {
				$meta_layout = \Gravisain\Meta\PageSettings::get_meta_value( $post_id, '_gravisain_sidebar_layout', 'default' );
				if ( 'no-sidebar' === $meta_layout || 'fullwidth' === $meta_layout ) {
					$class .= ' container-stretched';
				}
			}
		}

		return $class;
	}
}
