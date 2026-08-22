<?php
/**
 * Abstract CSS Generator
 *
 * @package Gravisain\CSS\Generators
 */

declare(strict_types=1);

namespace Gravisain\CSS\Generators;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Gravisain\CSS\Builder;
use Gravisain\CSS\GoogleFonts;
use Gravisain\Helpers\GoogleFontsHelper;

/**
 * AbstractGenerator Class
 *
 * Provides shared helper methods for font resolution and typography building.
 */
abstract class AbstractGenerator implements GeneratorInterface {

	/**
	 * Resolve a numeric font weight from a style string.
	 *
	 * @param string $style The style string (e.g., "normal", "700", "600 italic").
	 * @return int The resolved numeric font weight.
	 */
	protected function resolve_font_weight( string $style ): int {
		if ( empty( $style ) || 'normal' === $style || 'italic' === $style ) {
			return 400;
		}

		preg_match( '/\d+/', $style, $matches );

		if ( ! empty( $matches[0] ) ) {
			return max( 100, min( 900, (int) $matches[0] ) );
		}

		if ( 'bold' === $style || 'bold italic' === $style ) {
			return 700;
		}

		return 400;
	}

	/**
	 * Safely decode a setting value that might be a JSON string, an array, or empty.
	 *
	 * @param mixed $val     The setting value from get_theme_mod.
	 * @param array $default Default array to return if invalid or empty.
	 * @return array
	 */
	protected function decode_json_val( $val, array $default = [] ): array {
		if ( is_array( $val ) ) {
			return ! empty( $val ) ? $val : $default;
		}
		if ( is_string( $val ) && ! empty( $val ) ) {
			$decoded = json_decode( $val, true );
			if ( is_array( $decoded ) && ! empty( $decoded ) ) {
				return $decoded;
			}
		}
		return $default;
	}

	/**
	 * Build CSS rules for a typography setting.
	 *
	 * @param Builder $builder     The CSS builder instance.
	 * @param string  $mod_key     The theme_mod key (e.g. 'gravisain_typography_base').
	 * @param string  $selector    The CSS selector to apply rules to (e.g. 'body', 'h1').
	 * @param string  $default     The default JSON value.
	 * @param bool    $is_root_var Should we also generate CSS variables on :root?
	 * @param string  $var_prefix  The prefix for root variables (e.g. 'base', 'h1').
	 * @return void
	 */
	protected function build_typography_css( Builder $builder, string $mod_key, string $selector, string $default, bool $is_root_var = false, string $var_prefix = '' ): void {
		$val = $this->decode_json_val( get_theme_mod( $mod_key, $default ) );
		if ( empty( $val ) || ! is_array( $val ) ) {
			return;
		}

		if ( ! empty( $val['family'] ) && 'inherit' !== $val['family'] ) {
			$font_fam = $val['family'];
			if ( 'system-stack' === $font_fam ) {
				$font_fam = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif';
			} elseif ( GoogleFontsHelper::is_google_font( $font_fam ) ) {
				$nav_style  = isset( $val['style'] ) ? (string) $val['style'] : 'normal';
				$nav_weight = $this->resolve_font_weight( $nav_style );
				GoogleFonts::get_instance()->queue_font( $font_fam, $nav_weight );
			}

			// Map specific font combinations safely.
			$builder->add( $selector, 'font-family', ( strpos( $font_fam, ',' ) === false && strpos( $font_fam, '"' ) === false ) ? '"' . $font_fam . '", sans-serif' : $font_fam );

			if ( $is_root_var && ! empty( $var_prefix ) ) {
				$builder->add( ':root', '--gravisain-font-family-' . $var_prefix, ( strpos( $font_fam, ',' ) === false && strpos( $font_fam, '"' ) === false ) ? '"' . $font_fam . '", sans-serif' : $font_fam );
			}
		}

		if ( ! empty( $val['style'] ) ) {
			$st = $val['style'];
			if ( false !== strpos( $st, 'italic' ) ) {
				$builder->add( $selector, 'font-style', 'italic' );
			} else {
				$builder->add( $selector, 'font-style', 'normal' );
			}

			preg_match( '/\d+/', $st, $matches );
			if ( ! empty( $matches[0] ) ) {
				$builder->add( $selector, 'font-weight', $matches[0] );
			} elseif ( 'bold' === $st || 'bold italic' === $st ) {
				$builder->add( $selector, 'font-weight', '700' );
			} else {
				$builder->add( $selector, 'font-weight', '400' );
			}
		}

		if ( isset( $val['size'] ) && '' !== $val['size'] ) {
			$size = is_numeric( $val['size'] ) ? $val['size'] . 'px' : $val['size'];
			$builder->add( $selector, 'font-size', $size );
			if ( $is_root_var && ! empty( $var_prefix ) ) {
				$builder->add( ':root', '--gravisain-font-size-' . $var_prefix, $size );
			}
		}

		if ( isset( $val['line_height'] ) && '' !== $val['line_height'] ) {
			$lh = is_numeric( $val['line_height'] ) ? (string) $val['line_height'] : $val['line_height'];
			$builder->add( $selector, 'line-height', $lh );
			if ( $is_root_var && ! empty( $var_prefix ) ) {
				$builder->add( ':root', '--gravisain-line-height-' . $var_prefix, $lh );
			}
		}

		if ( isset( $val['spacing'] ) && '' !== $val['spacing'] ) {
			$spacing = is_numeric( $val['spacing'] ) ? $val['spacing'] . 'px' : $val['spacing'];
			$builder->add( $selector, 'letter-spacing', $spacing );
		}
	}
}
