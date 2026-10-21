<?php
/**
 * Header Builder Logic
 *
 * @package Gravisain\Components
 */

namespace Gravisain\Components;

class HeaderBuilder {

	/**
	 * Get the full layout state as an array.
	 *
	 * @return array
	 */
	public static function get_layout(): array {
		$default = [
			'top'    => [ 'left' => [], 'center' => [], 'right' => [] ],
			'main'   => [ 'left' => ['logo'], 'center' => ['primary-navigation'], 'right' => ['menu-trigger'] ],
			'bottom' => [ 'left' => [], 'center' => [], 'right' => [] ],
		];

		$layout_json = get_theme_mod( 'gravisain_header_builder_layout', '' );
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
				foreach ( ['left', 'center', 'right'] as $col ) {
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
		$layout = self::get_layout();
		
		if ( empty( $layout[ $row ] ) ) {
			return true;
		}

		foreach ( ['left', 'center', 'right'] as $col ) {
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
	 * @param string $col left|center|right
	 */
	public static function render_column( string $row, string $col ): void {
		$layout = self::get_layout();
		
		if ( empty( $layout[ $row ][ $col ] ) ) {
			return;
		}

		foreach ( $layout[ $row ][ $col ] as $component ) {
			$component = sanitize_key( $component );
			$template  = locate_template( "template-parts/header/components/{$component}.php" );
			
			if ( $template ) {
				load_template( $template, false );
			} else {
				// Fallback generic render for undefined components
				echo '<div class="ghb-dummy-component">' . esc_html( $component ) . '</div>';
			}
		}
	}
}
