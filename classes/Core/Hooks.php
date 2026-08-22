<?php
/**
 * Global Hooks Management
 *
 * @package Gravisain\Core
 */

namespace Gravisain\Core;

use Gravisain\Helpers\HeaderHelper;

/**
 * Hooks Class
 * 
 * Centralized place for registering global theme actions and filters
 * that do not belong to a specific component.
 */
class Hooks {

	/**
	 * Initialize the Hooks service.
	 *
	 * @return void
	 */
	public static function init(): void {
		$instance = new self();
		$instance->setup_hooks();
	}

	/**
	 * Setup global hooks.
	 *
	 * @return void
	 */
	private function setup_hooks(): void {
		add_action( 'init', [ $this, 'register_pattern_categories' ] );
		add_filter( 'body_class', [ $this, 'add_body_classes' ] );
		add_filter( 'script_loader_tag', [ $this, 'add_module_type_to_vite_scripts' ], 10, 3 );

		// Support PHP template hierarchy in templates/ folder
		$hierarchy_types = [
			'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy',
			'date', 'home', 'frontpage', 'page', 'paged', 'search', 'single',
			'singular', 'attachment',
		];
		foreach ( $hierarchy_types as $type ) {
			add_filter( "{$type}_template_hierarchy", [ $this, 'add_templates_dir_to_hierarchy' ] );
		}
	}

	/**
	 * Add type="module" to Vite generated scripts.
	 *
	 * @param string $tag    The `<script>` tag for the enqueued script.
	 * @param string $handle The script's registered handle.
	 * @param string $src    The script's source URL.
	 * @return string
	 */
	public function add_module_type_to_vite_scripts( string $tag, string $handle, string $src ): string {
		$vite_handles = [
			'gravisain-vite-js',
			'gravisain-customizer-js',
			'gravisain-customizer-react-js',
			'gravisain-customize-preview-js',
		];

		if ( in_array( $handle, $vite_handles, true ) ) {
			if ( strpos( $tag, 'type="module"' ) === false ) {
				$tag = str_replace( '<script ', '<script type="module" ', $tag );
			}
		}

		return $tag;
	}

	/**
	 * Prepend templates/ directory to template hierarchy search paths.
	 *
	 * @param array $templates Current template filenames.
	 * @return array
	 */
	public function add_templates_dir_to_hierarchy( array $templates ): array {
		$new_templates = [];
		foreach ( $templates as $template ) {
			$new_templates[] = 'templates/' . $template;
			$new_templates[] = $template;
		}
		return array_unique( $new_templates );
	}

	/**
	 * Register block pattern categories.
	 *
	 * @return void
	 */
	public function register_pattern_categories(): void {
		register_block_pattern_category(
			'gravisain',
			[ 'label' => __( 'Gravisain', 'gravisain' ) ]
		);
	}

	/**
	 * Add custom body classes.
	 *
	 * @param array $classes Current body classes.
	 * @return array
	 */
	public function add_body_classes( array $classes ): array {
		if ( HeaderHelper::is_transparent_header() ) {
			$classes[] = 'has-transparent-header';
		}

		$sticky_mode = HeaderHelper::get_sticky_header_mode();
		if ( 'none' !== $sticky_mode ) {
			$classes[] = 'has-sticky-header';
			$classes[] = 'sticky-behavior-' . get_theme_mod( 'gravisain_sticky_header_behavior', 'always' );

			if ( get_theme_mod( 'gravisain_sticky_header_shrink', true ) ) {
				$classes[] = 'sticky-shrink';
			}

			if ( 'entire_header' !== $sticky_mode ) {
				$selected = array_map( 'trim', explode( ',', $sticky_mode ) );
				if ( ! in_array( 'top_row', $selected, true ) ) {
					$classes[] = 'sticky-hide-top';
				}
				if ( ! in_array( 'main_row', $selected, true ) ) {
					$classes[] = 'sticky-hide-main';
				}
				if ( ! in_array( 'bottom_row', $selected, true ) ) {
					$classes[] = 'sticky-hide-bottom';
				}
			}
		}

		if ( is_customize_preview() ) {
			$classes[] = 'is-customize-preview';
		}

		// Inject layout classes
		$context = 'default';
		if ( is_singular() ) {
			$context = is_page() ? 'page' : 'single';
		} elseif ( is_archive() || is_home() || is_search() ) {
			$context = 'archive';
		}
		
		$styles = \Gravisain\Helpers\LayoutHelper::get_container_style_class( $context );
		if ( ! empty( $styles ) ) {
			foreach ( explode( ' ', $styles ) as $style_part ) {
				$part_clean = trim( $style_part );
				if ( ! empty( $part_clean ) ) {
					$classes[] = 'gravisain-' . $part_clean;
				}
			}
		}

		return $classes;
	}
}
