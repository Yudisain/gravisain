<?php
/**
 * Customizer Sanitization Methods
 *
 * Comprehensive enterprise-grade sanitization callbacks for WordPress Customizer settings.
 *
 * @package Gravisain\Customizer
 */

namespace Gravisain\Customizer;

class Sanitize {
	/**
	 * Sanitize Checkbox input.
	 *
	 * @param mixed $checked Whether the checkbox is checked.
	 * @return bool
	 */
	public static function checkbox( $checked ): bool {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}

	/**
	 * Sanitize Color input (Hex, RGB, RGBA, HSLA).
	 *
	 * @param string $color Raw color value.
	 * @return string Sanitized color string or empty string if invalid.
	 */
	public static function color( string $color ): string {
		$color = trim( $color );

		// Empty value
		if ( empty( $color ) ) {
			return '';
		}

		// Hex Color (#RGB or #RRGGBB or #RRGGBBAA)
		if ( preg_match( '/^#([A-Fa-f0-9]{3}){1,2}([A-Fa-f0-9]{2})?$/', $color ) ) {
			return $color;
		}

		// RGBA / RGB format: rgba(255, 255, 255, 0.5) or rgb(255, 255, 255)
		if ( preg_match( '/^rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*([0-9.]+)\s*)?\)$/', $color, $matches ) ) {
			return $color;
		}

		// HSLA / HSL format
		if ( preg_match( '/^hsla?\(\s*(\d{1,3})\s*,\s*(\d{1,3})%\s*,\s*(\d{1,3})%\s*(?:,\s*([0-9.]+)\s*)?\)$/', $color ) ) {
			return $color;
		}

		// Fallback to WordPress standard hex sanitizer
		$sanitized_hex = sanitize_hex_color( $color );
		return $sanitized_hex ? $sanitized_hex : '';
	}

	/**
	 * Sanitize Select / Radio choice input against registered choices.
	 *
	 * @param string               $input Selected value.
	 * @param \WP_Customize_Setting $setting Setting instance.
	 * @return string Sanitized choice value or default value if invalid.
	 */
	public static function select( $input, $setting ): string {
		$input   = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices ?? [];

		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	/**
	 * Sanitize Number within a specified range.
	 *
	 * @param mixed                $number Input number.
	 * @param \WP_Customize_Setting $setting Setting instance.
	 * @return float|int
	 */
	public static function number_range( $number, $setting ) {
		$number = is_float( $number ) ? floatval( $number ) : intval( $number );
		$atts   = $setting->manager->get_control( $setting->id )->input_attrs ?? [];

		$min = isset( $atts['min'] ) ? ( is_float( $atts['min'] ) ? floatval( $atts['min'] ) : intval( $atts['min'] ) ) : $number;
		$max = isset( $atts['max'] ) ? ( is_float( $atts['max'] ) ? floatval( $atts['max'] ) : intval( $atts['max'] ) ) : $number;

		return ( $number >= $min && $number <= $max ) ? $number : $setting->default;
	}

	/**
	 * Sanitize CSS unit value (px, rem, em, %, vh, vw, ch, auto, 0).
	 *
	 * @param string $value CSS value to sanitize.
	 * @return string Sanitized CSS unit string.
	 */
	public static function css_unit( string $value ): string {
		$value = trim( $value );

		if ( 'auto' === $value || '0' === $value || '' === $value ) {
			return $value;
		}

		if ( preg_match( '/^-?\d+(?:\.\d+)?(?:px|rem|em|%|vh|vw|ch)$/', $value ) ) {
			return $value;
		}

		return sanitize_text_field( $value );
	}

	/**
	 * Sanitize JSON string (for layout grids or JSON settings).
	 *
	 * @param string $json Raw JSON string.
	 * @return string Sanitized JSON string or empty string if invalid structure.
	 */
	public static function layout_json( string $json ): string {
		if ( empty( $json ) ) {
			return '';
		}

		$decoded = json_decode( $json, true );
		if ( json_last_error() !== JSON_ERROR_NONE || ! is_array( $decoded ) ) {
			return '';
		}

		$sanitized = self::sanitize_array_recursive( $decoded );
		return wp_json_encode( $sanitized );
	}

	/**
	 * Recursively sanitize an array for JSON storage.
	 *
	 * @param array $array Input array.
	 * @return array Sanitized array.
	 */
	private static function sanitize_array_recursive( array $array ): array {
		$sanitized = [];
		foreach ( $array as $key => $val ) {
			$clean_key = sanitize_key( $key );
			if ( is_array( $val ) ) {
				$sanitized[ $clean_key ] = self::sanitize_array_recursive( $val );
			} elseif ( is_bool( $val ) ) {
				$sanitized[ $clean_key ] = $val;
			} elseif ( is_numeric( $val ) ) {
				$sanitized[ $clean_key ] = is_float( $val ) ? floatval( $val ) : intval( $val );
			} else {
				$sanitized[ $clean_key ] = sanitize_text_field( strval( $val ) );
			}
		}
		return $sanitized;
	}
}

