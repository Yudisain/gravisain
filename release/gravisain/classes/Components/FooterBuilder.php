<?php
/**
 * Footer Builder Logic
 *
 * @package Gravisain\Components
 */

namespace Gravisain\Components;

/**
 * FooterBuilder Class
 * 
 * Manages layout grid computation and rendering for modular footer builder.
 */
class FooterBuilder {

	/**
	 * Get the full layout state as an array.
	 *
	 * @return array
	 */
	public static function get_layout(): array {
		$default = [
			'top'    => [ 'col-1' => [], 'col-2' => [], 'col-3' => [], 'col-4' => [] ],
			'main'   => [ 'col-1' => ['widget-1'], 'col-2' => ['widget-2'], 'col-3' => ['widget-3'], 'col-4' => ['widget-4'] ],
			'bottom' => [ 'col-1' => ['copyright'], 'col-2' => ['footer-navigation'], 'col-3' => [], 'col-4' => [] ],
		];

		$layout_json = get_theme_mod( 'gravisain_footer_builder_layout', '' );
		if ( empty( $layout_json ) ) {
			return $default;
		}

		$layout = json_decode( $layout_json, true );
		if ( ! is_array( $layout ) ) {
			return $default;
		}

		// Ensure structure exists
		foreach ( ['top', 'main', 'bottom'] as $row ) {
			if ( ! isset( $layout[ $row ] ) ) {
				$layout[ $row ] = $default[ $row ];
			} else {
				foreach ( ['col-1', 'col-2', 'col-3', 'col-4'] as $col ) {
					if ( ! isset( $layout[ $row ][ $col ] ) ) {
						$layout[ $row ][ $col ] = [];
					}
				}
			}
		}

		return $layout;
	}

	/**
	 * Check if a specific row is completely empty.
	 *
	 * @param string $row top|main|bottom
	 * @return bool
	 */
	public static function is_row_empty( string $row ): bool {
		if ( is_customize_preview() ) {
			return false;
		}

		$layout = self::get_layout();
		
		if ( empty( $layout[ $row ] ) ) {
			return true;
		}

		foreach ( ['col-1', 'col-2', 'col-3', 'col-4'] as $col ) {
			if ( ! empty( $layout[ $row ][ $col ] ) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Render a specific column in a row.
	 *
	 * @param string $row top|main|bottom
	 * @param string $col col-1|col-2|col-3|col-4
	 */
	public static function render_column( string $row, string $col ): void {
		$layout = self::get_layout();
		
		if ( empty( $layout[ $row ][ $col ] ) ) {
			return;
		}

		foreach ( $layout[ $row ][ $col ] as $component ) {
			$component = sanitize_key( $component );
			$template  = locate_template( "template-parts/footer/components/{$component}.php" );
			
			if ( $template ) {
				load_template( $template, false );
			} else {
				// Fallback generic render for undefined components
				echo '<div class="gfb-dummy-component">' . esc_html( $component ) . '</div>';
			}
		}
	}
}
