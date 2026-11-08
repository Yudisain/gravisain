<?php
/**
 * Customizer Sanitization Methods
 *
 * Comprehensive enterprise-grade sanitization callbacks for WordPress Customizer settings.
 *
 * @package Gravisain\Customizer
 */

namespace Gravisain\Customizer;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
	 * @param mixed $color Raw color value.
	 * @return string Sanitized color string or empty string if invalid.
	 */
	public static function color( $color ): string {
		$color = trim( (string) $color );

		// Empty value or transparent keyword
		if ( '' === $color ) {
			return '';
		}
		if ( 'transparent' === strtolower( $color ) || 'currentColor' === $color || 'inherit' === strtolower( $color ) ) {
			return $color;
		}

		// CSS custom property reference: var(--wp--preset--color--primary)
		if ( preg_match( '/^var\(\s*--[a-zA-Z0-9_-]+(?:\s*,\s*#[a-fA-F0-9]{3,8})?\s*\)$/', $color ) ) {
			return $color;
		}

		// Hex Color (#RGB or #RRGGBB or #RRGGBBAA)
		if ( preg_match( '/^#([A-Fa-f0-9]{3}){1,2}([A-Fa-f0-9]{2})?$/', $color ) ) {
			return $color;
		}

		// RGBA / RGB format: rgba(255, 255, 255, 0.5) or rgb(255, 255, 255)
		if ( preg_match( '/^rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*([0-9.]+)\s*)?\)$/', $color ) ) {
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
	 * Sanitize Select / Radio / ButtonGroup choice input against registered choices.
	 *
	 * @param mixed                 $input   Selected value.
	 * @param \WP_Customize_Setting $setting Setting instance.
	 * @return string Sanitized choice value or default value if invalid.
	 */
	public static function select( $input, $setting ): string {
		$input   = sanitize_text_field( (string) $input );
		$control = $setting->manager->get_control( $setting->id );
		$choices = ( $control && is_array( $control->choices ) ) ? $control->choices : [];

		if ( empty( $choices ) ) {
			return sanitize_key( $input );
		}

		return array_key_exists( $input, $choices ) ? $input : (string) $setting->default;
	}

	/**
	 * Sanitize Number within a specified range.
	 *
	 * @param mixed                 $number  Input number.
	 * @param \WP_Customize_Setting $setting Setting instance.
	 * @return float|int
	 */
	public static function number_range( $number, $setting ) {
		$number = is_numeric( $number ) && false !== strpos( (string) $number, '.' ) ? floatval( $number ) : intval( $number );
		$atts   = $setting->manager->get_control( $setting->id )->input_attrs ?? [];

		$min = isset( $atts['min'] ) ? ( is_float( $atts['min'] ) ? floatval( $atts['min'] ) : intval( $atts['min'] ) ) : $number;
		$max = isset( $atts['max'] ) ? ( is_float( $atts['max'] ) ? floatval( $atts['max'] ) : intval( $atts['max'] ) ) : $number;

		return ( $number >= $min && $number <= $max ) ? $number : $setting->default;
	}

	/**
	 * Sanitize CSS unit value (px, rem, em, %, vh, vw, ch, auto, 0, or plain number).
	 *
	 * @param mixed $value CSS value to sanitize.
	 * @return string Sanitized CSS unit string or empty string if invalid.
	 */
	public static function css_unit( $value ): string {
		$value = trim( (string) $value );

		if ( 'auto' === $value || '0' === $value || '' === $value ) {
			return $value;
		}

		if ( preg_match( '/^-?\d+(?:\.\d+)?(?:px|rem|em|%|vh|vw|ch)?$/', $value ) ) {
			return $value;
		}

		return '';
	}

	/**
	 * Sanitize Responsive Slider value (plain CSS unit/number or JSON device map).
	 *
	 * @param mixed $input Raw slider input.
	 * @return string Sanitized string or JSON string.
	 */
	public static function responsive_slider( $input ): string {
		if ( is_numeric( $input ) ) {
			return (string) $input;
		}

		$str = trim( (string) $input );
		if ( '' === $str ) {
			return '';
		}

		if ( '{' === $str[0] ) {
			$decoded = json_decode( $str, true );
			if ( JSON_ERROR_NONE !== json_last_error() || ! is_array( $decoded ) ) {
				return '';
			}
			$clean = [];
			foreach ( $decoded as $key => $val ) {
				$clean_key = sanitize_key( (string) $key );
				if ( is_array( $val ) ) {
					$sub = [];
					foreach ( $val as $sk => $sv ) {
						$skey = sanitize_key( (string) $sk );
						$sub[ $skey ] = ( 'unit' === $skey )
							? ( in_array( $sv, [ 'px', 'em', 'rem', '%', 'vh', 'vw', 'ch' ], true ) ? $sv : 'px' )
							: self::css_unit( $sv );
					}
					$clean[ $clean_key ] = $sub;
				} elseif ( 'unit' === $clean_key ) {
					$clean[ $clean_key ] = in_array( $val, [ 'px', 'em', 'rem', '%', 'vh', 'vw', 'ch' ], true ) ? $val : 'px';
				} else {
					$clean[ $clean_key ] = self::css_unit( $val );
				}
			}
			return (string) wp_json_encode( $clean );
		}

		return self::css_unit( $str );
	}

	/**
	 * Sanitize Color Group JSON (e.g., {"normal":"#fff","hover":"#000"}).
	 *
	 * @param mixed $input Raw JSON or array.
	 * @return string Sanitized JSON string.
	 */
	public static function color_group_json( $input ): string {
		if ( empty( $input ) ) {
			return '';
		}

		$decoded = is_array( $input ) ? $input : json_decode( (string) $input, true );
		if ( ! is_array( $decoded ) ) {
			return self::color( $input );
		}

		$clean = [];
		foreach ( $decoded as $key => $color ) {
			$clean[ sanitize_key( (string) $key ) ] = self::color( $color );
		}

		return (string) wp_json_encode( $clean );
	}

	/**
	 * Sanitize Spacing Control JSON.
	 *
	 * @param mixed $input Raw JSON string or array.
	 * @return string Sanitized JSON string.
	 */
	public static function spacing_json( $input ): string {
		if ( empty( $input ) ) {
			return '';
		}

		$decoded = is_array( $input ) ? $input : json_decode( (string) $input, true );
		if ( ! is_array( $decoded ) ) {
			return '';
		}

		$clean_box = static function ( array $box ): array {
			$out = [];
			foreach ( $box as $k => $v ) {
				$ck = sanitize_key( (string) $k );
				if ( 'locked' === $ck || 'isLinked' === $ck ) {
					$out[ $ck ] = (bool) $v;
				} elseif ( 'unit' === $ck ) {
					$out[ $ck ] = in_array( $v, [ 'px', 'em', 'rem', '%', 'vh', 'vw' ], true ) ? $v : 'px';
				} else {
					$out[ $ck ] = self::css_unit( $v );
				}
			}
			return $out;
		};

		$clean = [];
		foreach ( $decoded as $key => $val ) {
			$ck = sanitize_key( (string) $key );
			if ( is_array( $val ) ) {
				$clean[ $ck ] = $clean_box( $val );
			} else {
				$clean = $clean_box( $decoded );
				break;
			}
		}

		return (string) wp_json_encode( $clean );
	}

	/**
	 * Sanitize Typography Control JSON.
	 *
	 * @param mixed $input Raw JSON string or array.
	 * @return string Sanitized JSON string.
	 */
	public static function typography_json( $input ): string {
		if ( empty( $input ) ) {
			return '';
		}

		$decoded = is_array( $input ) ? $input : json_decode( (string) $input, true );
		if ( ! is_array( $decoded ) ) {
			return '';
		}

		$clean = [];
		if ( isset( $decoded['family'] ) ) {
			$fam = preg_replace( '/[{};<>]/', '', sanitize_text_field( (string) $decoded['family'] ) );
			$clean['family'] = $fam;
		}
		if ( isset( $decoded['style'] ) ) {
			$clean['style'] = preg_replace( '/[^a-zA-Z0-9\s-]/', '', (string) $decoded['style'] );
		}
		if ( isset( $decoded['size'] ) ) {
			$clean['size'] = self::css_unit( $decoded['size'] );
		}
		if ( isset( $decoded['line_height'] ) ) {
			$clean['line_height'] = self::css_unit( $decoded['line_height'] );
		}
		if ( isset( $decoded['spacing'] ) ) {
			$clean['spacing'] = self::css_unit( $decoded['spacing'] );
		}

		return (string) wp_json_encode( $clean );
	}

	/**
	 * Sanitize Social Icons Repeater JSON.
	 *
	 * @param mixed $input Raw JSON string or array.
	 * @return string Sanitized JSON string.
	 */
	public static function social_items_json( $input ): string {
		if ( empty( $input ) ) {
			return '';
		}

		$decoded = is_array( $input ) ? $input : json_decode( (string) $input, true );
		if ( ! is_array( $decoded ) ) {
			return '[]';
		}

		$clean = [];
		foreach ( $decoded as $item ) {
			if ( ! is_array( $item ) ) {
				continue;
			}
			$source = isset( $item['source_type'] ) && in_array( $item['source_type'], [ 'icon', 'svg', 'image' ], true )
				? $item['source_type']
				: 'icon';

			$entry = [
				'id'          => isset( $item['id'] ) ? sanitize_key( (string) $item['id'] ) : 'social',
				'label'       => isset( $item['label'] ) ? sanitize_text_field( (string) $item['label'] ) : '',
				'url'         => isset( $item['url'] ) && '#' !== trim( (string) $item['url'] ) ? esc_url_raw( (string) $item['url'] ) : ( isset( $item['url'] ) && '#' === trim( (string) $item['url'] ) ? '#' : '' ),
				'source_type' => $source,
				'icon_style'  => isset( $item['icon_style'] ) ? sanitize_key( (string) $item['icon_style'] ) : 'filled',
				'max_width'   => isset( $item['max_width'] ) ? (string) max( 10, min( 200, absint( $item['max_width'] ) ) ) : '24',
				'show_label'  => ! empty( $item['show_label'] ),
			];

			if ( ! empty( $item['custom_image'] ) ) {
				$entry['custom_image'] = esc_url_raw( (string) $item['custom_image'] );
			}
			if ( ! empty( $item['custom_svg'] ) ) {
				$entry['custom_svg'] = \Gravisain\Helpers\SVG::kses_svg( (string) $item['custom_svg'] );
			}

			$clean[] = $entry;
		}

		return (string) wp_json_encode( $clean );
	}

	/**
	 * Sanitize Visibility device list (e.g., "desktop,tablet,mobile" or "none").
	 *
	 * @param mixed $input Raw visibility input.
	 * @return string Sanitized comma-separated device list.
	 */
	public static function visibility( $input ): string {
		$allowed = [ 'desktop', 'tablet', 'mobile', 'none' ];
		$parts   = is_array( $input ) ? $input : explode( ',', (string) $input );
		$valid   = [];

		foreach ( $parts as $part ) {
			$p = sanitize_key( trim( (string) $part ) );
			if ( in_array( $p, $allowed, true ) ) {
				$valid[] = $p;
			}
		}

		if ( empty( $valid ) || in_array( 'none', $valid, true ) ) {
			return 'none';
		}

		return implode( ',', array_unique( $valid ) );
	}

	/**
	 * Sanitize Sticky Header rows checklist.
	 *
	 * @param mixed $input Raw sticky rows string.
	 * @return string Sanitized sticky rows string.
	 */
	public static function sticky_rows( $input ): string {
		$allowed = [ 'none', 'entire_header', 'top_row', 'main_row', 'bottom_row' ];
		$parts   = array_map( 'trim', explode( ',', (string) $input ) );
		$valid   = [];

		foreach ( $parts as $part ) {
			$p = sanitize_key( $part );
			if ( in_array( $p, $allowed, true ) ) {
				$valid[] = $p;
			}
		}

		if ( empty( $valid ) || in_array( 'none', $valid, true ) ) {
			return 'none';
		}
		if ( in_array( 'entire_header', $valid, true ) ) {
			return 'entire_header';
		}

		return implode( ',', array_unique( $valid ) );
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

	/**
	 * Sanitize JSON Color Palette string.
	 *
	 * @param mixed $input JSON string or array of color hex codes.
	 * @return string Sanitized JSON string.
	 */
	public static function color_palette( $input ): string {
		if ( empty( $input ) ) {
			return '[]';
		}

		$colors = is_array( $input ) ? $input : json_decode( (string) $input, true );

		if ( ! is_array( $colors ) ) {
			return '[]';
		}

		$sanitized = [];
		foreach ( $colors as $color ) {
			$sanitized[] = self::color( (string) $color );
		}

		return (string) wp_json_encode( $sanitized );
	}
}

