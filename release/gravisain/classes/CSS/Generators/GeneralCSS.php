<?php
/**
 * General CSS Generator
 *
 * Handles Global Colors, Background Colors, Global Typography, and Layout Settings.
 *
 * @package Gravisain\CSS\Generators
 */

declare(strict_types=1);

namespace Gravisain\CSS\Generators;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Gravisain\CSS\Builder;

/**
 * GeneralCSS Class
 */
class GeneralCSS extends AbstractGenerator {

	/**
	 * Generate general CSS rules.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	public function generate( Builder $builder ): void {
		$this->generate_global_colors( $builder );
		$this->generate_global_typography( $builder );
		$this->generate_layout_and_spacing( $builder );
		$this->generate_ux_components( $builder );
	}

	/**
	 * Generate global colors CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_global_colors( Builder $builder ): void {
		$global_palette = $this->decode_json_val( get_theme_mod( 'gravisain_global_palette', '["#4f46e5","#0ea5e9","#0f172a","#475569","#ffffff","#f8fafc","#e2e8f0","#f43f5e"]' ) );

		if ( is_array( $global_palette ) && ! empty( $global_palette ) ) {
			// Define Gravisain Global Colors.
			foreach ( $global_palette as $index => $color ) {
				$color_num = $index + 1;
				$builder->add( ':root', "--gravisain-global-color-{$color_num}", $color );
			}

			// Map to WordPress Block Editor Presets.
			if ( isset( $global_palette[0] ) ) {
				$builder->add( ':root', '--wp--preset--color--primary', 'var(--gravisain-global-color-1) !important' );
			}
			if ( isset( $global_palette[1] ) ) {
				$builder->add( ':root', '--wp--preset--color--secondary', 'var(--gravisain-global-color-2) !important' );
			}
			if ( isset( $global_palette[2] ) ) {
				$builder->add( ':root', '--wp--preset--color--contrast', 'var(--gravisain-global-color-3) !important' );
			}
			if ( isset( $global_palette[3] ) ) {
				$builder->add( ':root', '--wp--preset--color--contrast-alt', 'var(--gravisain-global-color-4) !important' );
			}
			if ( isset( $global_palette[4] ) ) {
				$builder->add( ':root', '--wp--preset--color--base', 'var(--gravisain-global-color-5) !important' );
			}
			if ( isset( $global_palette[5] ) ) {
				$builder->add( ':root', '--wp--preset--color--base-alt', 'var(--gravisain-global-color-6) !important' );
			}
			if ( isset( $global_palette[7] ) ) {
				$builder->add( ':root', '--wp--preset--color--accent', 'var(--gravisain-global-color-8) !important' );
			}
		}

		// Dark Mode Palette
		$dark_palette = $this->decode_json_val( get_theme_mod( 'gravisain_dark_palette', '["#818cf8","#38bdf8","#f8fafc","#cbd5e1","#0f172a","#1e293b","#334155","#fb7185"]' ) );
		if ( is_array( $dark_palette ) && ! empty( $dark_palette ) ) {
			$builder->add( 'html.dark', 'color-scheme', 'dark' );
			foreach ( $dark_palette as $index => $color ) {
				$color_num = $index + 1;
				$builder->add( 'html.dark', "--gravisain-global-color-{$color_num}", $color );
			}
			$builder->add( 'html.dark', '--gravisain-content-bg', 'var(--gravisain-global-color-6)' );
			$builder->add( 'html.dark body', 'background-color', 'var(--gravisain-global-color-5) !important' );
			$builder->add( 'html.dark body', 'color', 'var(--gravisain-global-color-3) !important' );
		}

		// Site Background Color.
		$site_bg = get_theme_mod( 'gravisain_site_background', '' );
		if ( ! empty( $site_bg ) && is_string( $site_bg ) ) {
			$builder->add( 'body', 'background-color', $site_bg . ' !important' );
		}

		// Content Background Color.
		$content_bg = get_theme_mod( 'gravisain_content_background', '' );
		if ( ! empty( $content_bg ) && is_string( $content_bg ) ) {
			$builder->add( ':root', '--gravisain-content-bg', $content_bg );
		}
	}

	/**
	 * Generate global typography CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_global_typography( Builder $builder ): void {
		$this->build_typography_css( $builder, 'gravisain_typography_base', 'body', '{"family":"Inter","style":"400","size":"16","spacing":"0"}', true, 'base' );
		$this->build_typography_css( $builder, 'gravisain_typography_h1', 'h1, .h1', '{"family":"Inter","style":"700","size":"40","spacing":"-1"}', true, 'h1' );
		$this->build_typography_css( $builder, 'gravisain_typography_h2', 'h2, .h2', '{"family":"Inter","style":"700","size":"32","spacing":"-0.5"}', true, 'h2' );
		$this->build_typography_css( $builder, 'gravisain_typography_h3', 'h3, .h3', '{"family":"Inter","style":"700","size":"28","spacing":"0"}', true, 'h3' );
		$this->build_typography_css( $builder, 'gravisain_typography_h4', 'h4, .h4', '{"family":"Inter","style":"600","size":"24","spacing":"0"}', true, 'h4' );
		$this->build_typography_css( $builder, 'gravisain_typography_h5', 'h5, .h5', '{"family":"Inter","style":"600","size":"20","spacing":"0"}', true, 'h5' );
		$this->build_typography_css( $builder, 'gravisain_typography_h6', 'h6, .h6', '{"family":"Inter","style":"600","size":"16","spacing":"0"}', true, 'h6' );
	}

	/**
	 * Generate layout and spacing rules.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_layout_and_spacing( Builder $builder ): void {
		$content_width = get_theme_mod( 'gravisain_content_width', '1200' );
		if ( is_numeric( $content_width ) ) {
			$content_width .= 'px';
		}
		$builder->add( ':root', '--wp--custom--layout--content-size', $content_width . ' !important' );
		$builder->add( ':root', '--gravisain-container-width', $content_width . ' !important' );

		// Content Top and Bottom Spacing (Responsive).
		$spacing_y = get_theme_mod( 'gravisain_content_spacing_y', '{"desktop":"56","tablet":"40","mobile":"32"}' );
		if ( ! empty( $spacing_y ) ) {
			$obj = $this->decode_json_val( $spacing_y );
			if ( ! empty( $obj ) && is_array( $obj ) ) {
				if ( isset( $obj['desktop'] ) && '' !== $obj['desktop'] ) {
					$val = is_numeric( $obj['desktop'] ) ? $obj['desktop'] . 'px' : $obj['desktop'];
					$builder->add( '.site-content', '--gravisain-content-padding-top', $val );
					$builder->add( '.site-content', '--gravisain-content-padding-bottom', $val );
				}
				if ( isset( $obj['tablet'] ) && '' !== $obj['tablet'] ) {
					$val = is_numeric( $obj['tablet'] ) ? $obj['tablet'] . 'px' : $obj['tablet'];
					$builder->add( '.site-content', '--gravisain-content-padding-top', $val, 'max-width: 1024px' );
					$builder->add( '.site-content', '--gravisain-content-padding-bottom', $val, 'max-width: 1024px' );
				}
				if ( isset( $obj['mobile'] ) && '' !== $obj['mobile'] ) {
					$val = is_numeric( $obj['mobile'] ) ? $obj['mobile'] . 'px' : $obj['mobile'];
					$builder->add( '.site-content', '--gravisain-content-padding-top', $val, 'max-width: 719px' );
					$builder->add( '.site-content', '--gravisain-content-padding-bottom', $val, 'max-width: 719px' );
				}
			}
		}

		// Content Left/Right Edge Spacing (Responsive).
		$spacing_x = get_theme_mod( 'gravisain_content_spacing_x', '{"desktop":"24","tablet":"20","mobile":"16"}' );
		if ( ! empty( $spacing_x ) ) {
			$obj = $this->decode_json_val( $spacing_x );
			if ( is_array( $obj ) ) {
				if ( isset( $obj['desktop'] ) && '' !== $obj['desktop'] ) {
					$val = is_numeric( $obj['desktop'] ) ? $obj['desktop'] . 'px' : $obj['desktop'];
					$builder->add( '.site-content .container', '--gravisain-container-padding-x', $val );
				}
				if ( isset( $obj['tablet'] ) && '' !== $obj['tablet'] ) {
					$val = is_numeric( $obj['tablet'] ) ? $obj['tablet'] . 'px' : $obj['tablet'];
					$builder->add( '.site-content .container', '--gravisain-container-padding-x', $val, 'max-width: 1024px' );
				}
				if ( isset( $obj['mobile'] ) && '' !== $obj['mobile'] ) {
					$val = is_numeric( $obj['mobile'] ) ? $obj['mobile'] . 'px' : $obj['mobile'];
					$builder->add( '.site-content .container', '--gravisain-container-padding-x', $val, 'max-width: 719px' );
				}
			} elseif ( is_scalar( $spacing_x ) ) {
				$val = is_numeric( $spacing_x ) ? $spacing_x . 'px' : $spacing_x;
				$builder->add( '.site-content .container', '--gravisain-container-padding-x', $val );
			}
		}
	}

	/**
	 * Generate UX components (Scroll to Top, Reading Progress) rules.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_ux_components( Builder $builder ): void {
		// Scroll to Top Position & Side Offset (Responsive).
		$scroll_top_position    = get_theme_mod( 'gravisain_scroll_top_position', 'right' );
		$side_prop              = ( 'left' === $scroll_top_position ) ? 'left' : 'right';
		$opposite_prop          = ( 'left' === $scroll_top_position ) ? 'right' : 'left';
		$scroll_top_side_offset = get_theme_mod( 'gravisain_scroll_top_side_offset', '{"desktop":"2rem","tablet":"1.5rem","mobile":"1rem"}' );

		if ( ! empty( $scroll_top_side_offset ) ) {
			$side_obj = $this->decode_json_val( $scroll_top_side_offset );
			if ( is_array( $side_obj ) ) {
				if ( isset( $side_obj['desktop'] ) && '' !== $side_obj['desktop'] ) {
					$val = is_numeric( $side_obj['desktop'] ) ? $side_obj['desktop'] . 'px' : $side_obj['desktop'];
					$builder->add( '.gravisain-scroll-top', $side_prop, $val . ' !important' );
					$builder->add( '.gravisain-scroll-top', $opposite_prop, 'auto !important' );
				} else {
					$builder->add( '.gravisain-scroll-top', $side_prop, '2rem !important' );
					$builder->add( '.gravisain-scroll-top', $opposite_prop, 'auto !important' );
				}
				if ( isset( $side_obj['tablet'] ) && '' !== $side_obj['tablet'] ) {
					$val = is_numeric( $side_obj['tablet'] ) ? $side_obj['tablet'] . 'px' : $side_obj['tablet'];
					$builder->add( '.gravisain-scroll-top', $side_prop, $val . ' !important', 'max-width: 1024px' );
					$builder->add( '.gravisain-scroll-top', $opposite_prop, 'auto !important', 'max-width: 1024px' );
				}
				if ( isset( $side_obj['mobile'] ) && '' !== $side_obj['mobile'] ) {
					$val = is_numeric( $side_obj['mobile'] ) ? $side_obj['mobile'] . 'px' : $side_obj['mobile'];
					$builder->add( '.gravisain-scroll-top', $side_prop, $val . ' !important', 'max-width: 719px' );
					$builder->add( '.gravisain-scroll-top', $opposite_prop, 'auto !important', 'max-width: 719px' );
				}
			} elseif ( is_scalar( $scroll_top_side_offset ) && '' !== $scroll_top_side_offset ) {
				$val = is_numeric( $scroll_top_side_offset ) ? $scroll_top_side_offset . 'px' : $scroll_top_side_offset;
				$builder->add( '.gravisain-scroll-top', $side_prop, $val . ' !important' );
				$builder->add( '.gravisain-scroll-top', $opposite_prop, 'auto !important' );
			}
		} else {
			$builder->add( '.gravisain-scroll-top', $side_prop, '2rem !important' );
			$builder->add( '.gravisain-scroll-top', $opposite_prop, 'auto !important' );
		}

		// Scroll to Top Bottom Offset (Responsive).
		$scroll_top_bottom_offset = get_theme_mod( 'gravisain_scroll_top_bottom_offset', '{"desktop":"2rem","tablet":"1.5rem","mobile":"1rem"}' );
		if ( ! empty( $scroll_top_bottom_offset ) ) {
			$bottom_obj = $this->decode_json_val( $scroll_top_bottom_offset );
			if ( is_array( $bottom_obj ) ) {
				if ( isset( $bottom_obj['desktop'] ) && '' !== $bottom_obj['desktop'] ) {
					$val = is_numeric( $bottom_obj['desktop'] ) ? $bottom_obj['desktop'] . 'px' : $bottom_obj['desktop'];
					$builder->add( '.gravisain-scroll-top', 'bottom', $val . ' !important' );
				}
				if ( isset( $bottom_obj['tablet'] ) && '' !== $bottom_obj['tablet'] ) {
					$val = is_numeric( $bottom_obj['tablet'] ) ? $bottom_obj['tablet'] . 'px' : $bottom_obj['tablet'];
					$builder->add( '.gravisain-scroll-top', 'bottom', $val . ' !important', 'max-width: 1024px' );
				}
				if ( isset( $bottom_obj['mobile'] ) && '' !== $bottom_obj['mobile'] ) {
					$val = is_numeric( $bottom_obj['mobile'] ) ? $bottom_obj['mobile'] . 'px' : $bottom_obj['mobile'];
					$builder->add( '.gravisain-scroll-top', 'bottom', $val . ' !important', 'max-width: 719px' );
				}
			} elseif ( is_scalar( $scroll_top_bottom_offset ) && '' !== $scroll_top_bottom_offset ) {
				$val = is_numeric( $scroll_top_bottom_offset ) ? $scroll_top_bottom_offset . 'px' : $scroll_top_bottom_offset;
				$builder->add( '.gravisain-scroll-top', 'bottom', $val . ' !important' );
			}
		}

		// Scroll to Top Icon & Button Size (Responsive).
		$scroll_top_icon_size = get_theme_mod( 'gravisain_scroll_top_icon_size', '{"desktop":"18px","tablet":"16px","mobile":"16px"}' );
		if ( ! empty( $scroll_top_icon_size ) ) {
			$obj = $this->decode_json_val( $scroll_top_icon_size );
			if ( is_array( $obj ) ) {
				if ( isset( $obj['desktop'] ) && '' !== $obj['desktop'] ) {
					$val = is_numeric( $obj['desktop'] ) ? $obj['desktop'] . 'px' : $obj['desktop'];
					$builder->add( '.gravisain-scroll-top', 'width', 'calc(' . $val . ' * 2.444) !important' );
					$builder->add( '.gravisain-scroll-top', 'height', 'calc(' . $val . ' * 2.444) !important' );
					$builder->add( '.gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon', 'width', $val . ' !important' );
					$builder->add( '.gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon', 'height', $val . ' !important' );
					$builder->add( '.gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon', 'font-size', $val . ' !important' );
				}
				if ( isset( $obj['tablet'] ) && '' !== $obj['tablet'] ) {
					$val = is_numeric( $obj['tablet'] ) ? $obj['tablet'] . 'px' : $obj['tablet'];
					$builder->add( '.gravisain-scroll-top', 'width', 'calc(' . $val . ' * 2.444) !important', 'max-width: 1024px' );
					$builder->add( '.gravisain-scroll-top', 'height', 'calc(' . $val . ' * 2.444) !important', 'max-width: 1024px' );
					$builder->add( '.gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon', 'width', $val . ' !important', 'max-width: 1024px' );
					$builder->add( '.gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon', 'height', $val . ' !important', 'max-width: 1024px' );
					$builder->add( '.gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon', 'font-size', $val . ' !important', 'max-width: 1024px' );
				}
				if ( isset( $obj['mobile'] ) && '' !== $obj['mobile'] ) {
					$val = is_numeric( $obj['mobile'] ) ? $obj['mobile'] . 'px' : $obj['mobile'];
					$builder->add( '.gravisain-scroll-top', 'width', 'calc(' . $val . ' * 2.444) !important', 'max-width: 719px' );
					$builder->add( '.gravisain-scroll-top', 'height', 'calc(' . $val . ' * 2.444) !important', 'max-width: 719px' );
					$builder->add( '.gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon', 'width', $val . ' !important', 'max-width: 719px' );
					$builder->add( '.gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon', 'height', $val . ' !important', 'max-width: 719px' );
					$builder->add( '.gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon', 'font-size', $val . ' !important', 'max-width: 719px' );
				}
			} elseif ( is_scalar( $scroll_top_icon_size ) ) {
				$val = is_numeric( $scroll_top_icon_size ) ? $scroll_top_icon_size . 'px' : $scroll_top_icon_size;
				$builder->add( '.gravisain-scroll-top', 'width', 'calc(' . $val . ' * 2.444) !important' );
				$builder->add( '.gravisain-scroll-top', 'height', 'calc(' . $val . ' * 2.444) !important' );
				$builder->add( '.gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon', 'width', $val . ' !important' );
				$builder->add( '.gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon', 'height', $val . ' !important' );
				$builder->add( '.gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon', 'font-size', $val . ' !important' );
			}
		}
	}
}
