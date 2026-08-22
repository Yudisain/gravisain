<?php
/**
 * Header CSS Generator
 *
 * Handles Logo Width, Header Rows, Navigation, Action Button, Transparent, and Sticky Header CSS.
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
use Gravisain\Helpers\HeaderHelper;
use Gravisain\Components\HeaderBuilder;
use Gravisain\Helpers\SocialNetworksHelper;

/**
 * HeaderCSS Class
 */
class HeaderCSS extends AbstractGenerator {

	/**
	 * Generate header CSS rules.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	public function generate( Builder $builder ): void {
		$this->generate_logo_width( $builder );
		$this->generate_header_rows( $builder );
		$this->generate_transparent_header( $builder );
		$this->generate_sticky_header( $builder );
		$this->generate_site_identity( $builder );
		$this->generate_primary_navigation( $builder );
		$this->generate_secondary_navigation( $builder );
		$this->generate_offcanvas_navigation( $builder );
		$this->generate_header_social_icons( $builder );
		$this->generate_action_button( $builder );
	}

	/**
	 * Generate logo width responsive CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_logo_width( Builder $builder ): void {
		$logo_width = get_theme_mod( 'gravisain_logo_width', '{"desktop":"110px","tablet":"90px","mobile":"70px"}' );
		if ( ! empty( $logo_width ) ) {
			$obj = $this->decode_json_val( $logo_width );
			if ( is_array( $obj ) ) {
				if ( ! empty( $obj['desktop'] ) ) {
					$builder->add( '.site-branding img.custom-logo', 'max-width', $obj['desktop'] );
					$builder->add( '.site-branding img.custom-logo', 'width', '100%' );
					$builder->add( '.site-branding img.custom-logo', 'height', 'auto' );
				}
				if ( ! empty( $obj['tablet'] ) ) {
					$builder->add( '.site-branding img.custom-logo', 'max-width', $obj['tablet'], 'max-width: 1024px' );
				}
				if ( ! empty( $obj['mobile'] ) ) {
					$builder->add( '.site-branding img.custom-logo', 'max-width', $obj['mobile'], 'max-width: 719px' );
				}
			} else {
				// Fallback for simple string.
				$builder->add( '.site-branding img.custom-logo', 'max-width', $logo_width );
				$builder->add( '.site-branding img.custom-logo', 'width', '100%' );
				$builder->add( '.site-branding img.custom-logo', 'height', 'auto' );
			}
		}
	}

	/**
	 * Generate site identity (title font, colors, margin, padding) CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_site_identity( Builder $builder ): void {
		$title_sel = '.site-header .site-header-row .site-branding .site-title, .site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn), .has-transparent-header .site-header .site-title a:not(.gravisain-btn), .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-title a:not(.gravisain-btn), #masthead .site-title, #masthead .site-title a';
		$title_box_sel = '.site-header .site-header-row .site-branding .site-title, .has-transparent-header .site-header .site-header-row .site-branding .site-title, .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-title, #masthead .site-title';

		// Typography.
		$this->build_typography_css( $builder, 'gravisain_site_title_typography', $title_sel, '{"family":"inherit","style":"700","size":"24","line_height":"1.3","spacing":"0"}', true, 'site-title' );

		// Colors (Initial, Hover, Active).
		$colors_json = get_theme_mod( 'gravisain_site_title_colors', '{"initial":"","hover":"","active":""}' );
		if ( ! empty( $colors_json ) ) {
			$colors = $this->decode_json_val( $colors_json );
			if ( is_array( $colors ) ) {
				if ( ! empty( $colors['initial'] ) ) {
					$builder->add( $title_sel, 'color', $colors['initial'] . ' !important' );
				}
				if ( ! empty( $colors['hover'] ) ) {
					$builder->add( '.site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn):hover, .site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn):focus, .has-transparent-header .site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn):hover, .has-transparent-header .site-header .site-title a:not(.gravisain-btn):hover, .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-title a:not(.gravisain-btn):hover, #masthead .site-title a:hover, #masthead .site-title a:focus', 'color', $colors['hover'] . ' !important' );
				}
				if ( ! empty( $colors['active'] ) ) {
					$builder->add( '.site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn):active, .has-transparent-header .site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn):active, .has-transparent-header .site-header .site-title a:not(.gravisain-btn):active, .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-title a:not(.gravisain-btn):active, #masthead .site-title a:active', 'color', $colors['active'] . ' !important' );
				}
			}
		}

		// Margin.
		$margin_json = get_theme_mod( 'gravisain_site_title_margin', '' );
		if ( ! empty( $margin_json ) ) {
			$margin = $this->decode_json_val( $margin_json );
			if ( is_array( $margin ) ) {
				$unit = ! empty( $margin['unit'] ) ? $margin['unit'] : 'px';
				if ( isset( $margin['top'] ) && '' !== $margin['top'] ) {
					$builder->add( $title_box_sel, 'margin-top', $margin['top'] . $unit . ' !important' );
				}
				if ( isset( $margin['right'] ) && '' !== $margin['right'] ) {
					$builder->add( $title_box_sel, 'margin-right', $margin['right'] . $unit . ' !important' );
				}
				if ( isset( $margin['bottom'] ) && '' !== $margin['bottom'] ) {
					$builder->add( $title_box_sel, 'margin-bottom', $margin['bottom'] . $unit . ' !important' );
				}
				if ( isset( $margin['left'] ) && '' !== $margin['left'] ) {
					$builder->add( $title_box_sel, 'margin-left', $margin['left'] . $unit . ' !important' );
				}
			}
		}

		// Padding.
		$padding_json = get_theme_mod( 'gravisain_site_title_padding', '' );
		if ( ! empty( $padding_json ) ) {
			$padding = $this->decode_json_val( $padding_json );
			if ( is_array( $padding ) ) {
				$unit = ! empty( $padding['unit'] ) ? $padding['unit'] : 'px';
				if ( isset( $padding['top'] ) && '' !== $padding['top'] ) {
					$builder->add( $title_box_sel, 'padding-top', $padding['top'] . $unit . ' !important' );
				}
				if ( isset( $padding['right'] ) && '' !== $padding['right'] ) {
					$builder->add( $title_box_sel, 'padding-right', $padding['right'] . $unit . ' !important' );
				}
				if ( isset( $padding['bottom'] ) && '' !== $padding['bottom'] ) {
					$builder->add( $title_box_sel, 'padding-bottom', $padding['bottom'] . $unit . ' !important' );
				}
				if ( isset( $padding['left'] ) && '' !== $padding['left'] ) {
					$builder->add( $title_box_sel, 'padding-left', $padding['left'] . $unit . ' !important' );
				}
			}
		}

		$tagline_sel = '.site-header .site-header-row .site-branding .site-description, .has-transparent-header .site-header .site-header-row .site-branding .site-description, .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-description, .site-description';

		// Tagline Typography.
		$this->build_typography_css( $builder, 'gravisain_site_tagline_typography', $tagline_sel, '{"family":"inherit","style":"400","size":"14","line_height":"1.5","spacing":"0"}', true, 'site-tagline' );

		// Tagline Colors (Initial).
		$tagline_colors_json = get_theme_mod( 'gravisain_site_tagline_colors', '{"initial":""}' );
		if ( ! empty( $tagline_colors_json ) ) {
			$tagline_colors = $this->decode_json_val( $tagline_colors_json );
			if ( is_array( $tagline_colors ) && ! empty( $tagline_colors['initial'] ) ) {
				$builder->add( $tagline_sel, 'color', $tagline_colors['initial'] . ' !important' );
			}
		}

		// Tagline Margin.
		$tagline_margin_json = get_theme_mod( 'gravisain_site_tagline_margin', '' );
		if ( ! empty( $tagline_margin_json ) ) {
			$tagline_margin = $this->decode_json_val( $tagline_margin_json );
			if ( is_array( $tagline_margin ) ) {
				$unit = ! empty( $tagline_margin['unit'] ) ? $tagline_margin['unit'] : 'px';
				if ( isset( $tagline_margin['top'] ) && '' !== $tagline_margin['top'] ) {
					$builder->add( $tagline_sel, 'margin-top', $tagline_margin['top'] . $unit . ' !important' );
				}
				if ( isset( $tagline_margin['right'] ) && '' !== $tagline_margin['right'] ) {
					$builder->add( $tagline_sel, 'margin-right', $tagline_margin['right'] . $unit . ' !important' );
				}
				if ( isset( $tagline_margin['bottom'] ) && '' !== $tagline_margin['bottom'] ) {
					$builder->add( $tagline_sel, 'margin-bottom', $tagline_margin['bottom'] . $unit . ' !important' );
				}
				if ( isset( $tagline_margin['left'] ) && '' !== $tagline_margin['left'] ) {
					$builder->add( $tagline_sel, 'margin-left', $tagline_margin['left'] . $unit . ' !important' );
				}
			}
		}

		// Tagline Padding.
		$tagline_padding_json = get_theme_mod( 'gravisain_site_tagline_padding', '' );
		if ( ! empty( $tagline_padding_json ) ) {
			$tagline_padding = $this->decode_json_val( $tagline_padding_json );
			if ( is_array( $tagline_padding ) ) {
				$unit = ! empty( $tagline_padding['unit'] ) ? $tagline_padding['unit'] : 'px';
				if ( isset( $tagline_padding['top'] ) && '' !== $tagline_padding['top'] ) {
					$builder->add( $tagline_sel, 'padding-top', $tagline_padding['top'] . $unit . ' !important' );
				}
				if ( isset( $tagline_padding['right'] ) && '' !== $tagline_padding['right'] ) {
					$builder->add( $tagline_sel, 'padding-right', $tagline_padding['right'] . $unit . ' !important' );
				}
				if ( isset( $tagline_padding['bottom'] ) && '' !== $tagline_padding['bottom'] ) {
					$builder->add( $tagline_sel, 'padding-bottom', $tagline_padding['bottom'] . $unit . ' !important' );
				}
				if ( isset( $tagline_padding['left'] ) && '' !== $tagline_padding['left'] ) {
					$builder->add( $tagline_sel, 'padding-left', $tagline_padding['left'] . $unit . ' !important' );
				}
			}
		}
	}

	/**
	 * Generate header rows (Top, Main, Bottom) CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_header_rows( Builder $builder ): void {
		// Top Row.
		if ( ! HeaderBuilder::is_row_empty( 'top' ) ) {
			$top_bg          = get_theme_mod( 'gravisain_header_top_bg_color', '#f8f9fa' );
			$top_color       = get_theme_mod( 'gravisain_header_top_text_color', '#333333' );
			$top_link        = get_theme_mod( 'gravisain_header_top_link_color', '#0073aa' );
			$top_link_hover  = get_theme_mod( 'gravisain_header_top_link_hover_color', '#005177' );
			$top_border_w    = intval( get_theme_mod( 'gravisain_header_top_border_width', 1 ) );
			$top_border_c    = get_theme_mod( 'gravisain_header_top_border_color', '#e2e8f0' );
			$top_height_json = get_theme_mod( 'gravisain_header_top_height', '{"desktop":"40","tablet":"40","mobile":"35"}' );

			if ( ! empty( $top_bg ) ) {
				$builder->add( '.site-header-top-row, .site-header-top', 'background-color', $top_bg );
			}
			if ( ! empty( $top_color ) ) {
				$builder->add( '.site-header-top-row, .site-header-top', 'color', $top_color );
			}
			if ( ! empty( $top_link ) ) {
				$builder->add( '.site-header-top-row a', 'color', $top_link );
			}
			if ( ! empty( $top_link_hover ) ) {
				$builder->add( '.site-header-top-row a:hover', 'color', $top_link_hover );
			}
			if ( $top_border_w > 0 ) {
				$builder->add( '.site-header-top-row', 'border-bottom', $top_border_w . 'px solid ' . $top_border_c );
			} else {
				$builder->add( '.site-header-top-row', 'border-bottom', 'none' );
			}

			// Height (Responsive).
			if ( ! empty( $top_height_json ) ) {
				$obj = $this->decode_json_val( $top_height_json );
				if ( is_array( $obj ) ) {
					if ( ! empty( $obj['desktop'] ) ) {
						$builder->add( '.site-header-top-row', 'min-height', intval( $obj['desktop'] ) . 'px' );
					}
					if ( ! empty( $obj['tablet'] ) ) {
						$builder->add( '.site-header-top-row', 'min-height', intval( $obj['tablet'] ) . 'px', 'max-width: 1024px' );
					}
					if ( ! empty( $obj['mobile'] ) ) {
						$builder->add( '.site-header-top-row', 'min-height', intval( $obj['mobile'] ) . 'px', 'max-width: 719px' );
					}
				} else {
					$builder->add( '.site-header-top-row', 'min-height', intval( $top_height_json ) . 'px' );
				}
			}
		}

		// Main Row.
		if ( ! HeaderBuilder::is_row_empty( 'main' ) ) {
			$main_bg          = get_theme_mod( 'gravisain_header_main_bg_color', '#ffffff' );
			$main_color       = get_theme_mod( 'gravisain_header_main_text_color', '#333333' );
			$main_link        = get_theme_mod( 'gravisain_header_main_link_color', '#0073aa' );
			$main_link_hover  = get_theme_mod( 'gravisain_header_main_link_hover_color', '#005177' );
			$main_border_w    = intval( get_theme_mod( 'gravisain_header_main_border_width', 0 ) );
			$main_border_c    = get_theme_mod( 'gravisain_header_main_border_color', '#e2e8f0' );
			$main_height_json = get_theme_mod( 'gravisain_header_main_height', '{"desktop":"80","tablet":"70","mobile":"60"}' );

			if ( ! empty( $main_bg ) ) {
				$builder->add( '.site-header-main', 'background-color', $main_bg );
			}
			if ( ! empty( $main_color ) ) {
				$builder->add( '.site-header-main', 'color', $main_color );
			}
			if ( ! empty( $main_link ) ) {
				$builder->add( '.site-header-main a', 'color', $main_link );
			}
			if ( ! empty( $main_link_hover ) ) {
				$builder->add( '.site-header-main a:hover', 'color', $main_link_hover );
			}
			if ( $main_border_w > 0 ) {
				$builder->add( '.site-header-main', 'border-bottom', $main_border_w . 'px solid ' . $main_border_c );
			} else {
				$builder->add( '.site-header-main', 'border-bottom', 'none' );
			}

			// Height (Responsive).
			if ( ! empty( $main_height_json ) ) {
				$obj = $this->decode_json_val( $main_height_json );
				if ( is_array( $obj ) ) {
					if ( ! empty( $obj['desktop'] ) ) {
						$builder->add( '.site-header-main', 'min-height', intval( $obj['desktop'] ) . 'px' );
					}
					if ( ! empty( $obj['tablet'] ) ) {
						$builder->add( '.site-header-main', 'min-height', intval( $obj['tablet'] ) . 'px', 'max-width: 1024px' );
					}
					if ( ! empty( $obj['mobile'] ) ) {
						$builder->add( '.site-header-main', 'min-height', intval( $obj['mobile'] ) . 'px', 'max-width: 719px' );
					}
				} else {
					$builder->add( '.site-header-main', 'min-height', intval( $main_height_json ) . 'px' );
				}
			}
		}

		// Bottom Row.
		if ( ! HeaderBuilder::is_row_empty( 'bottom' ) ) {
			$bottom_bg          = get_theme_mod( 'gravisain_header_bottom_bg_color', '#f8f9fa' );
			$bottom_color       = get_theme_mod( 'gravisain_header_bottom_text_color', '#333333' );
			$bottom_link        = get_theme_mod( 'gravisain_header_bottom_link_color', '#0073aa' );
			$bottom_link_hover  = get_theme_mod( 'gravisain_header_bottom_link_hover_color', '#005177' );
			$bottom_border_w    = intval( get_theme_mod( 'gravisain_header_bottom_border_width', 1 ) );
			$bottom_border_c    = get_theme_mod( 'gravisain_header_bottom_border_color', '#e2e8f0' );
			$bottom_height_json = get_theme_mod( 'gravisain_header_bottom_height', '{"desktop":"40","tablet":"40","mobile":"35"}' );

			if ( ! empty( $bottom_bg ) ) {
				$builder->add( '.site-header-bottom-row, .site-header-bottom', 'background-color', $bottom_bg );
			}
			if ( ! empty( $bottom_color ) ) {
				$builder->add( '.site-header-bottom-row, .site-header-bottom', 'color', $bottom_color );
			}
			if ( ! empty( $bottom_link ) ) {
				$builder->add( '.site-header-bottom-row a', 'color', $bottom_link );
			}
			if ( ! empty( $bottom_link_hover ) ) {
				$builder->add( '.site-header-bottom-row a:hover', 'color', $bottom_link_hover );
			}
			if ( $bottom_border_w > 0 ) {
				$builder->add( '.site-header-bottom-row', 'border-bottom', $bottom_border_w . 'px solid ' . $bottom_border_c );
			} else {
				$builder->add( '.site-header-bottom-row', 'border-bottom', 'none' );
			}

			// Height (Responsive).
			if ( ! empty( $bottom_height_json ) ) {
				$obj = $this->decode_json_val( $bottom_height_json );
				if ( is_array( $obj ) ) {
					if ( ! empty( $obj['desktop'] ) ) {
						$builder->add( '.site-header-bottom-row', 'min-height', intval( $obj['desktop'] ) . 'px' );
					}
					if ( ! empty( $obj['tablet'] ) ) {
						$builder->add( '.site-header-bottom-row', 'min-height', intval( $obj['tablet'] ) . 'px', 'max-width: 1024px' );
					}
					if ( ! empty( $obj['mobile'] ) ) {
						$builder->add( '.site-header-bottom-row', 'min-height', intval( $obj['mobile'] ) . 'px', 'max-width: 719px' );
					}
				} else {
					$builder->add( '.site-header-bottom-row', 'min-height', intval( $bottom_height_json ) . 'px' );
				}
			}
		}
	}

	/**
	 * Generate primary navigation CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_primary_navigation( Builder $builder ): void {
		// Primary Navigation Spacing.
		$primary_nav_spacing_json = get_theme_mod( 'gravisain_header_primary_nav_spacing', '{"desktop":"20","tablet":"15","mobile":"10"}' );
		if ( ! empty( $primary_nav_spacing_json ) ) {
			$obj = $this->decode_json_val( $primary_nav_spacing_json );
			if ( is_array( $obj ) ) {
				if ( isset( $obj['desktop'] ) && '' !== $obj['desktop'] ) {
					$builder->add( '.main-navigation ul', 'gap', intval( $obj['desktop'] ) . 'px' );
				}
				if ( isset( $obj['tablet'] ) && '' !== $obj['tablet'] ) {
					$builder->add( '.main-navigation ul', 'gap', intval( $obj['tablet'] ) . 'px', 'max-width: 1024px' );
				}
				if ( isset( $obj['mobile'] ) && '' !== $obj['mobile'] ) {
					$builder->add( '.main-navigation ul', 'gap', intval( $obj['mobile'] ) . 'px', 'max-width: 719px' );
				}
			} elseif ( is_numeric( $primary_nav_spacing_json ) ) {
				$builder->add( '.main-navigation ul', 'gap', intval( $primary_nav_spacing_json ) . 'px' );
			}
		}

		// Primary Navigation Stretch & Fill Center.
		$is_nav_stretch     = get_theme_mod( 'gravisain_header_primary_nav_stretch', false );
		$is_nav_fill_center = get_theme_mod( 'gravisain_header_primary_nav_fill_center', false );

		if ( $is_nav_stretch ) {
			$builder->add( '.col-left:has(.main-navigation), .col-center:has(.main-navigation), .col-right:has(.main-navigation)', 'flex', '1 1 0% !important' );
			$builder->add( '.ghb-component.main-navigation', 'flex', '1 1 0% !important' );
			$builder->add( '.ghb-component.main-navigation', 'width', '100% !important' );
			$builder->add( '.ghb-component.main-navigation', 'min-width', '0 !important' );
			$builder->add( '.ghb-component.main-navigation', 'max-width', '100% !important' );
			$builder->add( '.ghb-component.main-navigation', 'display', 'flex !important' );
			$builder->add( '.main-navigation div', 'width', '100% !important' );
			$builder->add( '.main-navigation div', 'min-width', '0 !important' );
			$builder->add( '.main-navigation div', 'max-width', '100% !important' );
			$builder->add( '.main-navigation div', 'display', 'flex !important' );
			$builder->add( '.main-navigation ul', 'width', '100% !important' );
			$builder->add( '.main-navigation ul', 'min-width', '0 !important' );
			$builder->add( '.main-navigation ul', 'max-width', '100% !important' );

			if ( $is_nav_fill_center ) {
				$builder->add( '.main-navigation ul', 'justify-content', 'center !important' );
				$builder->add( '.main-navigation ul', 'flex-wrap', 'wrap !important' );
				$builder->add( '.main-navigation ul > li', 'flex', '1 1 auto !important' );
				$builder->add( '.main-navigation ul > li', 'text-align', 'center !important' );
				$builder->add( '.main-navigation ul > li > a', 'justify-content', 'center !important' );
				$builder->add( '.main-navigation ul > li > a', 'text-align', 'center !important' );
			} else {
				$builder->add( '.main-navigation ul', 'justify-content', 'space-between !important' );
				$builder->add( '.main-navigation ul', 'flex-wrap', 'wrap !important' );
				$builder->add( '.main-navigation ul > li', 'flex', '0 1 auto !important' );
				$builder->add( '.main-navigation ul > li', 'text-align', 'left !important' );
				$builder->add( '.main-navigation ul > li > a', 'justify-content', 'flex-start !important' );
				$builder->add( '.main-navigation ul > li > a', 'text-align', 'left !important' );
			}
		}

		// Primary Navigation Colors.
		$nav_colors = $this->decode_json_val( get_theme_mod( 'gravisain_header_primary_nav_colors', '{"initial":"","hover":"","active":""}' ) );
		if ( is_array( $nav_colors ) ) {
			if ( ! empty( $nav_colors['initial'] ) ) {
				$builder->add( '.site-header .site-header-row .main-navigation a:not(.gravisain-btn), .site-header .site-header-row .main-navigation ul li a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .main-navigation a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .main-navigation ul li a:not(.gravisain-btn), .has-sticky-header .site-header.is-sticky .site-header-row .main-navigation a:not(.gravisain-btn), .main-navigation a, .main-navigation ul li a', 'color', $nav_colors['initial'] . ' !important' );
			}
			if ( ! empty( $nav_colors['hover'] ) ) {
				$builder->add( '.site-header .site-header-row .main-navigation a:not(.gravisain-btn):hover, .site-header .site-header-row .main-navigation ul li a:not(.gravisain-btn):hover, .site-header .site-header-row .main-navigation li:hover > a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .main-navigation a:not(.gravisain-btn):hover, .has-transparent-header .site-header .site-header-row .main-navigation ul li a:not(.gravisain-btn):hover, .has-transparent-header .site-header .site-header-row .main-navigation li:hover > a:not(.gravisain-btn), .main-navigation a:hover, .main-navigation ul li a:hover, .main-navigation li:hover > a', 'color', $nav_colors['hover'] . ' !important' );
			}
			if ( ! empty( $nav_colors['active'] ) ) {
				$builder->add( '.site-header .site-header-row .main-navigation li.current-menu-item > a:not(.gravisain-btn), .site-header .site-header-row .main-navigation li.current-menu-ancestor > a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .main-navigation li.current-menu-item > a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .main-navigation li.current-menu-ancestor > a:not(.gravisain-btn), .main-navigation li.current-menu-item > a, .main-navigation li.current-menu-ancestor > a', 'color', $nav_colors['active'] . ' !important' );
			}
		}

		// Primary Navigation Background.
		$nav_bg = $this->decode_json_val( get_theme_mod( 'gravisain_header_primary_nav_background', '{"initial":"","hover":"","active":""}' ) );
		if ( is_array( $nav_bg ) ) {
			if ( ! empty( $nav_bg['initial'] ) ) {
				$builder->add( '.main-navigation a, .main-navigation ul li a', 'background-color', $nav_bg['initial'] . ' !important' );
				$builder->add( '.main-navigation a, .main-navigation ul li a', 'padding', '8px 14px !important' );
				$builder->add( '.main-navigation a, .main-navigation ul li a', 'border-radius', '4px !important' );
			}
			if ( ! empty( $nav_bg['hover'] ) ) {
				$builder->add( '.main-navigation a:hover, .main-navigation ul li a:hover, .main-navigation li:hover > a', 'background-color', $nav_bg['hover'] . ' !important' );
				$builder->add( '.main-navigation a:hover, .main-navigation ul li a:hover, .main-navigation li:hover > a', 'padding', '8px 14px !important' );
				$builder->add( '.main-navigation a:hover, .main-navigation ul li a:hover, .main-navigation li:hover > a', 'border-radius', '4px !important' );
			}
			if ( ! empty( $nav_bg['active'] ) ) {
				$builder->add( '.main-navigation li.current-menu-item > a, .main-navigation li.current-menu-ancestor > a', 'background-color', $nav_bg['active'] . ' !important' );
				$builder->add( '.main-navigation li.current-menu-item > a, .main-navigation li.current-menu-ancestor > a', 'padding', '8px 14px !important' );
				$builder->add( '.main-navigation li.current-menu-item > a, .main-navigation li.current-menu-ancestor > a', 'border-radius', '4px !important' );
			}
		}

		// Primary Navigation Font.
		$nav_font = $this->decode_json_val( get_theme_mod( 'gravisain_header_primary_nav_font', '{"family":"inherit","style":"normal","size":"16"}' ) );
		if ( is_array( $nav_font ) ) {
			if ( ! empty( $nav_font['family'] ) && 'inherit' !== $nav_font['family'] ) {
				$font_fam = $nav_font['family'];
				if ( 'system-stack' === $font_fam ) {
					$font_fam = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif';
				} elseif ( GoogleFontsHelper::is_google_font( $font_fam ) ) {
					$nav_style  = isset( $nav_font['style'] ) ? (string) $nav_font['style'] : 'normal';
					$nav_weight = $this->resolve_font_weight( $nav_style );
					GoogleFonts::get_instance()->queue_font( $font_fam, $nav_weight );
				}
				$builder->add( '.main-navigation a, .main-navigation ul li a', 'font-family', $font_fam . ' !important' );
			}
			if ( ! empty( $nav_font['style'] ) ) {
				$st = $nav_font['style'];
				if ( false !== strpos( $st, 'italic' ) ) {
					$builder->add( '.main-navigation a, .main-navigation ul li a', 'font-style', 'italic !important' );
				} else {
					$builder->add( '.main-navigation a, .main-navigation ul li a', 'font-style', 'normal !important' );
				}
				preg_match( '/\d+/', $st, $matches );
				if ( ! empty( $matches[0] ) ) {
					$builder->add( '.main-navigation a, .main-navigation ul li a', 'font-weight', $matches[0] . ' !important' );
				} elseif ( 'bold' === $st || 'bold italic' === $st ) {
					$builder->add( '.main-navigation a, .main-navigation ul li a', 'font-weight', '700 !important' );
				} else {
					$builder->add( '.main-navigation a, .main-navigation ul li a', 'font-weight', '500 !important' );
				}
			}
			if ( ! empty( $nav_font['size'] ) && is_numeric( $nav_font['size'] ) ) {
				$builder->add( '.main-navigation a, .main-navigation ul li a', 'font-size', intval( $nav_font['size'] ) . 'px !important' );
			}
			if ( isset( $nav_font['spacing'] ) && '' !== $nav_font['spacing'] ) {
				$builder->add( '.main-navigation a, .main-navigation ul li a', 'letter-spacing', floatval( $nav_font['spacing'] ) . 'px !important' );
			}
		}
	}

	/**
	 * Generate secondary navigation CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_secondary_navigation( Builder $builder ): void {
		// Secondary Navigation Spacing.
		$secondary_nav_spacing_json = get_theme_mod( 'gravisain_header_secondary_nav_spacing', '{"desktop":"20","tablet":"15","mobile":"10"}' );
		if ( ! empty( $secondary_nav_spacing_json ) ) {
			$obj = $this->decode_json_val( $secondary_nav_spacing_json );
			if ( is_array( $obj ) ) {
				if ( isset( $obj['desktop'] ) && '' !== $obj['desktop'] ) {
					$builder->add( '.secondary-navigation ul', 'gap', intval( $obj['desktop'] ) . 'px' );
				}
				if ( isset( $obj['tablet'] ) && '' !== $obj['tablet'] ) {
					$builder->add( '.secondary-navigation ul', 'gap', intval( $obj['tablet'] ) . 'px', 'max-width: 1024px' );
				}
				if ( isset( $obj['mobile'] ) && '' !== $obj['mobile'] ) {
					$builder->add( '.secondary-navigation ul', 'gap', intval( $obj['mobile'] ) . 'px', 'max-width: 719px' );
				}
			} elseif ( is_numeric( $secondary_nav_spacing_json ) ) {
				$builder->add( '.secondary-navigation ul', 'gap', intval( $secondary_nav_spacing_json ) . 'px' );
			}
		}

		// Secondary Navigation Stretch & Fill Center.
		$is_sec_nav_stretch     = get_theme_mod( 'gravisain_header_secondary_nav_stretch', false );
		$is_sec_nav_fill_center = get_theme_mod( 'gravisain_header_secondary_nav_fill_center', false );

		if ( $is_sec_nav_stretch ) {
			$builder->add( '.col-left:has(.secondary-navigation), .col-center:has(.secondary-navigation), .col-right:has(.secondary-navigation)', 'flex', '1 1 0% !important' );
			$builder->add( '.ghb-component.secondary-navigation', 'flex', '1 1 0% !important' );
			$builder->add( '.ghb-component.secondary-navigation', 'width', '100% !important' );
			$builder->add( '.ghb-component.secondary-navigation', 'min-width', '0 !important' );
			$builder->add( '.ghb-component.secondary-navigation', 'max-width', '100% !important' );
			$builder->add( '.ghb-component.secondary-navigation', 'display', 'flex !important' );
			$builder->add( '.secondary-navigation div', 'width', '100% !important' );
			$builder->add( '.secondary-navigation div', 'min-width', '0 !important' );
			$builder->add( '.secondary-navigation div', 'max-width', '100% !important' );
			$builder->add( '.secondary-navigation div', 'display', 'flex !important' );
			$builder->add( '.secondary-navigation ul', 'width', '100% !important' );
			$builder->add( '.secondary-navigation ul', 'min-width', '0 !important' );
			$builder->add( '.secondary-navigation ul', 'max-width', '100% !important' );

			if ( $is_sec_nav_fill_center ) {
				$builder->add( '.secondary-navigation ul', 'justify-content', 'center !important' );
				$builder->add( '.secondary-navigation ul', 'flex-wrap', 'wrap !important' );
				$builder->add( '.secondary-navigation ul > li', 'flex', '1 1 auto !important' );
				$builder->add( '.secondary-navigation ul > li', 'text-align', 'center !important' );
				$builder->add( '.secondary-navigation ul > li > a', 'justify-content', 'center !important' );
				$builder->add( '.secondary-navigation ul > li > a', 'text-align', 'center !important' );
			} else {
				$builder->add( '.secondary-navigation ul', 'justify-content', 'space-between !important' );
				$builder->add( '.secondary-navigation ul', 'flex-wrap', 'wrap !important' );
				$builder->add( '.secondary-navigation ul > li', 'flex', '0 1 auto !important' );
				$builder->add( '.secondary-navigation ul > li', 'text-align', 'left !important' );
				$builder->add( '.secondary-navigation ul > li > a', 'justify-content', 'flex-start !important' );
				$builder->add( '.secondary-navigation ul > li > a', 'text-align', 'left !important' );
			}
		}

		// Secondary Navigation Colors.
		$sec_nav_colors = $this->decode_json_val( get_theme_mod( 'gravisain_header_secondary_nav_colors', '{"initial":"","hover":"","active":""}' ) );
		if ( is_array( $sec_nav_colors ) ) {
			if ( ! empty( $sec_nav_colors['initial'] ) ) {
				$builder->add( '.site-header .site-header-row .secondary-navigation a:not(.gravisain-btn), .site-header .site-header-row .secondary-navigation ul li a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .secondary-navigation a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .secondary-navigation ul li a:not(.gravisain-btn), .secondary-navigation a, .secondary-navigation ul li a', 'color', $sec_nav_colors['initial'] . ' !important' );
			}
			if ( ! empty( $sec_nav_colors['hover'] ) ) {
				$builder->add( '.site-header .site-header-row .secondary-navigation a:not(.gravisain-btn):hover, .site-header .site-header-row .secondary-navigation ul li a:not(.gravisain-btn):hover, .site-header .site-header-row .secondary-navigation li:hover > a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .secondary-navigation a:not(.gravisain-btn):hover, .has-transparent-header .site-header .site-header-row .secondary-navigation ul li a:not(.gravisain-btn):hover, .has-transparent-header .site-header .site-header-row .secondary-navigation li:hover > a:not(.gravisain-btn), .secondary-navigation a:hover, .secondary-navigation ul li a:hover, .secondary-navigation li:hover > a', 'color', $sec_nav_colors['hover'] . ' !important' );
			}
			if ( ! empty( $sec_nav_colors['active'] ) ) {
				$builder->add( '.site-header .site-header-row .secondary-navigation li.current-menu-item > a:not(.gravisain-btn), .site-header .site-header-row .secondary-navigation li.current-menu-ancestor > a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .secondary-navigation li.current-menu-item > a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .secondary-navigation li.current-menu-ancestor > a:not(.gravisain-btn), .secondary-navigation li.current-menu-item > a, .secondary-navigation li.current-menu-ancestor > a', 'color', $sec_nav_colors['active'] . ' !important' );
			}
		}

		// Secondary Navigation Background.
		$sec_nav_bg = $this->decode_json_val( get_theme_mod( 'gravisain_header_secondary_nav_background', '{"initial":"","hover":"","active":""}' ) );
		if ( is_array( $sec_nav_bg ) ) {
			if ( ! empty( $sec_nav_bg['initial'] ) ) {
				$builder->add( '.secondary-navigation a, .secondary-navigation ul li a', 'background-color', $sec_nav_bg['initial'] . ' !important' );
				$builder->add( '.secondary-navigation a, .secondary-navigation ul li a', 'padding', '8px 14px !important' );
				$builder->add( '.secondary-navigation a, .secondary-navigation ul li a', 'border-radius', '4px !important' );
			}
			if ( ! empty( $sec_nav_bg['hover'] ) ) {
				$builder->add( '.secondary-navigation a:hover, .secondary-navigation ul li a:hover, .secondary-navigation li:hover > a', 'background-color', $sec_nav_bg['hover'] . ' !important' );
				$builder->add( '.secondary-navigation a:hover, .secondary-navigation ul li a:hover, .secondary-navigation li:hover > a', 'padding', '8px 14px !important' );
				$builder->add( '.secondary-navigation a:hover, .secondary-navigation ul li a:hover, .secondary-navigation li:hover > a', 'border-radius', '4px !important' );
			}
			if ( ! empty( $sec_nav_bg['active'] ) ) {
				$builder->add( '.secondary-navigation li.current-menu-item > a, .secondary-navigation li.current-menu-ancestor > a', 'background-color', $sec_nav_bg['active'] . ' !important' );
				$builder->add( '.secondary-navigation li.current-menu-item > a, .secondary-navigation li.current-menu-ancestor > a', 'padding', '8px 14px !important' );
				$builder->add( '.secondary-navigation li.current-menu-item > a, .secondary-navigation li.current-menu-ancestor > a', 'border-radius', '4px !important' );
			}
		}

		// Secondary Navigation Font.
		$sec_nav_font = $this->decode_json_val( get_theme_mod( 'gravisain_header_secondary_nav_font', '{"family":"inherit","style":"normal","size":"16"}' ) );
		if ( is_array( $sec_nav_font ) ) {
			if ( ! empty( $sec_nav_font['family'] ) && 'inherit' !== $sec_nav_font['family'] ) {
				$font_fam = $sec_nav_font['family'];
				if ( 'system-stack' === $font_fam ) {
					$font_fam = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif';
				} elseif ( GoogleFontsHelper::is_google_font( $font_fam ) ) {
					$sec_style  = isset( $sec_nav_font['style'] ) ? (string) $sec_nav_font['style'] : 'normal';
					$sec_weight = $this->resolve_font_weight( $sec_style );
					GoogleFonts::get_instance()->queue_font( $font_fam, $sec_weight );
				}
				$builder->add( '.secondary-navigation a, .secondary-navigation ul li a', 'font-family', $font_fam . ' !important' );
			}
			if ( ! empty( $sec_nav_font['style'] ) ) {
				$st = $sec_nav_font['style'];
				if ( false !== strpos( $st, 'italic' ) ) {
					$builder->add( '.secondary-navigation a, .secondary-navigation ul li a', 'font-style', 'italic !important' );
				} else {
					$builder->add( '.secondary-navigation a, .secondary-navigation ul li a', 'font-style', 'normal !important' );
				}
				preg_match( '/\d+/', $st, $matches );
				if ( ! empty( $matches[0] ) ) {
					$builder->add( '.secondary-navigation a, .secondary-navigation ul li a', 'font-weight', $matches[0] . ' !important' );
				} elseif ( 'bold' === $st || 'bold italic' === $st ) {
					$builder->add( '.secondary-navigation a, .secondary-navigation ul li a', 'font-weight', '700 !important' );
				} else {
					$builder->add( '.secondary-navigation a, .secondary-navigation ul li a', 'font-weight', '500 !important' );
				}
			}
			if ( ! empty( $sec_nav_font['size'] ) && is_numeric( $sec_nav_font['size'] ) ) {
				$builder->add( '.secondary-navigation a, .secondary-navigation ul li a', 'font-size', intval( $sec_nav_font['size'] ) . 'px !important' );
			}
			if ( isset( $sec_nav_font['spacing'] ) && '' !== $sec_nav_font['spacing'] ) {
				$builder->add( '.secondary-navigation a, .secondary-navigation ul li a', 'letter-spacing', floatval( $sec_nav_font['spacing'] ) . 'px !important' );
			}
		}
	}

	/**
	 * Generate off-canvas navigation CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_offcanvas_navigation( Builder $builder ): void {
		// Off-Canvas Navigation Colors.
		$off_colors = $this->decode_json_val( get_theme_mod( 'gravisain_header_offcanvas_colors', '{"initial":"","hover":"","active":""}' ) );
		if ( is_array( $off_colors ) ) {
			if ( ! empty( $off_colors['initial'] ) ) {
				$builder->add( '.off-canvas-menu-list li a', 'color', $off_colors['initial'] . ' !important' );
			}
			if ( ! empty( $off_colors['hover'] ) ) {
				$builder->add( '.off-canvas-menu-list li a:hover', 'color', $off_colors['hover'] . ' !important' );
			}
			if ( ! empty( $off_colors['active'] ) ) {
				$builder->add( '.off-canvas-menu-list li.current-menu-item > a, .off-canvas-menu-list li.current-menu-ancestor > a', 'color', $off_colors['active'] . ' !important' );
			}
		}

		// Off-Canvas Navigation Background.
		$off_bg = $this->decode_json_val( get_theme_mod( 'gravisain_header_offcanvas_background', '{"initial":"","hover":"","active":""}' ) );
		if ( is_array( $off_bg ) && ! empty( $off_bg['initial'] ) ) {
			$builder->add( '.gravisain-off-canvas .off-canvas-container', 'background-color', $off_bg['initial'] . ' !important' );
		}

		// Off-Canvas Navigation Font.
		$off_nav_font = $this->decode_json_val( get_theme_mod( 'gravisain_header_offcanvas_font', '{"family":"inherit","style":"normal","size":"16"}' ) );
		if ( is_array( $off_nav_font ) ) {
			if ( ! empty( $off_nav_font['family'] ) && 'inherit' !== $off_nav_font['family'] ) {
				$font_fam = $off_nav_font['family'];
				if ( 'system-stack' === $font_fam ) {
					$font_fam = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif';
				} elseif ( GoogleFontsHelper::is_google_font( $font_fam ) ) {
					$off_style  = isset( $off_nav_font['style'] ) ? (string) $off_nav_font['style'] : 'normal';
					$off_weight = $this->resolve_font_weight( $off_style );
					GoogleFonts::get_instance()->queue_font( $font_fam, $off_weight );
				}
				$builder->add( '.off-canvas-menu-list li a', 'font-family', $font_fam . ' !important' );
			}
			if ( ! empty( $off_nav_font['style'] ) ) {
				$st = $off_nav_font['style'];
				if ( false !== strpos( $st, 'italic' ) ) {
					$builder->add( '.off-canvas-menu-list li a', 'font-style', 'italic !important' );
				} else {
					$builder->add( '.off-canvas-menu-list li a', 'font-style', 'normal !important' );
				}
				preg_match( '/\d+/', $st, $matches );
				if ( ! empty( $matches[0] ) ) {
					$builder->add( '.off-canvas-menu-list li a', 'font-weight', $matches[0] . ' !important' );
				} elseif ( 'bold' === $st || 'bold italic' === $st ) {
					$builder->add( '.off-canvas-menu-list li a', 'font-weight', '700 !important' );
				} else {
					$builder->add( '.off-canvas-menu-list li a', 'font-weight', '500 !important' );
				}
			}
			if ( ! empty( $off_nav_font['size'] ) && is_numeric( $off_nav_font['size'] ) ) {
				$builder->add( '.off-canvas-menu-list li a', 'font-size', intval( $off_nav_font['size'] ) . 'px !important' );
			}
			if ( isset( $off_nav_font['spacing'] ) && '' !== $off_nav_font['spacing'] ) {
				$builder->add( '.off-canvas-menu-list li a', 'letter-spacing', floatval( $off_nav_font['spacing'] ) . 'px !important' );
			}
		}
	}

	/**
	 * Generate header social icons CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_header_social_icons( Builder $builder ): void {
		// Header Social Icons Spacing.
		$social_spacing_json = get_theme_mod( 'gravisain_header_social_spacing', '{"desktop":"12","tablet":"10","mobile":"8"}' );
		if ( ! empty( $social_spacing_json ) ) {
			$obj = $this->decode_json_val( $social_spacing_json );
			if ( is_array( $obj ) ) {
				if ( isset( $obj['desktop'] ) && '' !== $obj['desktop'] ) {
					$builder->add( '.site-header .social-icons-list', 'gap', intval( $obj['desktop'] ) . 'px' );
				}
				if ( isset( $obj['tablet'] ) && '' !== $obj['tablet'] ) {
					$builder->add( '.site-header .social-icons-list', 'gap', intval( $obj['tablet'] ) . 'px', 'max-width: 1024px' );
				}
				if ( isset( $obj['mobile'] ) && '' !== $obj['mobile'] ) {
					$builder->add( '.site-header .social-icons-list', 'gap', intval( $obj['mobile'] ) . 'px', 'max-width: 719px' );
				}
			} elseif ( is_numeric( $social_spacing_json ) ) {
				$builder->add( '.site-header .social-icons-list', 'gap', intval( $social_spacing_json ) . 'px' );
			}
		}

		// Header Social Icons Size.
		$social_size_json = get_theme_mod( 'gravisain_header_social_icon_size', '{"desktop":"18","tablet":"16","mobile":"16"}' );
		if ( ! empty( $social_size_json ) ) {
			$obj = $this->decode_json_val( $social_size_json );
			if ( is_array( $obj ) ) {
				if ( isset( $obj['desktop'] ) && '' !== $obj['desktop'] ) {
					$builder->add( '.site-header .social-icon-item a:not(.has-label), .site-header .social-icon-icon, .site-header .social-icon-icon svg, .site-header .social-icon-icon img', 'width', intval( $obj['desktop'] ) . 'px !important' );
					$builder->add( '.site-header .social-icon-item a:not(.has-label), .site-header .social-icon-icon, .site-header .social-icon-icon svg, .site-header .social-icon-icon img', 'height', intval( $obj['desktop'] ) . 'px !important' );
				}
				if ( isset( $obj['tablet'] ) && '' !== $obj['tablet'] ) {
					$builder->add( '.site-header .social-icon-item a:not(.has-label), .site-header .social-icon-icon, .site-header .social-icon-icon svg, .site-header .social-icon-icon img', 'width', intval( $obj['tablet'] ) . 'px !important', 'max-width: 1024px' );
					$builder->add( '.site-header .social-icon-item a:not(.has-label), .site-header .social-icon-icon, .site-header .social-icon-icon svg, .site-header .social-icon-icon img', 'height', intval( $obj['tablet'] ) . 'px !important', 'max-width: 1024px' );
				}
				if ( isset( $obj['mobile'] ) && '' !== $obj['mobile'] ) {
					$builder->add( '.site-header .social-icon-item a:not(.has-label), .site-header .social-icon-icon, .site-header .social-icon-icon svg, .site-header .social-icon-icon img', 'width', intval( $obj['mobile'] ) . 'px !important', 'max-width: 719px' );
					$builder->add( '.site-header .social-icon-item a:not(.has-label), .site-header .social-icon-icon, .site-header .social-icon-icon svg, .site-header .social-icon-icon img', 'height', intval( $obj['mobile'] ) . 'px !important', 'max-width: 719px' );
				}
			} elseif ( is_numeric( $social_size_json ) ) {
				$builder->add( '.site-header .social-icon-item a:not(.has-label), .site-header .social-icon-icon, .site-header .social-icon-icon svg, .site-header .social-icon-icon img', 'width', intval( $social_size_json ) . 'px !important' );
				$builder->add( '.site-header .social-icon-item a:not(.has-label), .site-header .social-icon-icon, .site-header .social-icon-icon svg, .site-header .social-icon-icon img', 'height', intval( $social_size_json ) . 'px !important' );
			}
		}

		// Social Icons Brand Colors.
		$brand_mode = get_theme_mod( 'gravisain_header_social_brand_colors', 'no' );
		if ( 'no' !== $brand_mode && class_exists( '\Gravisain\Helpers\SocialNetworksHelper' ) ) {
			$brand_colors = SocialNetworksHelper::get_brand_colors();

			foreach ( $brand_colors as $network_id => $hex ) {
				$selector = '.ghb-social-icons .social-' . esc_attr( (string) $network_id ) . ' a';

				switch ( $brand_mode ) {
					case 'yes':
						$builder->add( $selector, 'color', $hex );
						$builder->add( $selector, 'background-color', $hex . '1a' ); // 10% opacity tint.
						break;

					case 'default-hover':
						$builder->add( $selector . ':hover', 'color', $hex );
						$builder->add( $selector . ':hover', 'background-color', $hex . '1a' );
						break;

					case 'hover-default':
						$builder->add( $selector, 'color', $hex );
						$builder->add( $selector, 'background-color', $hex . '1a' );
						$builder->add( $selector . ':hover', 'color', 'inherit' );
						$builder->add( $selector . ':hover', 'background-color', 'rgba(0,0,0,0.1)' );
						break;
				}
			}
		}
	}

	/**
	 * Generate action button CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_action_button( Builder $builder ): void {
		// Action Button Custom Padding.
		$btn_size = get_theme_mod( 'gravisain_header_button_size', 'md' );
		if ( 'custom' === $btn_size ) {
			$btn_padding_json = get_theme_mod( 'gravisain_header_button_custom_padding', '' );
			if ( ! empty( $btn_padding_json ) ) {
				$pad_obj = $this->decode_json_val( $btn_padding_json );
				if ( is_array( $pad_obj ) ) {
					$top    = isset( $pad_obj['top'] ) ? $pad_obj['top'] : '';
					$right  = isset( $pad_obj['right'] ) ? $pad_obj['right'] : '';
					$bottom = isset( $pad_obj['bottom'] ) ? $pad_obj['bottom'] : '';
					$left   = isset( $pad_obj['left'] ) ? $pad_obj['left'] : '';
					$unit   = isset( $pad_obj['unit'] ) ? $pad_obj['unit'] : 'px';

					if ( '' !== $top && '' !== $right && '' !== $bottom && '' !== $left ) {
						$padding_val = "{$top}{$unit} {$right}{$unit} {$bottom}{$unit} {$left}{$unit} !important";
						$builder->add( '.ghb-action-button-wrapper .gravisain-btn-custom', 'padding', $padding_val );
					}
				}
			}
		}

		// Action Button Typography.
		$this->build_typography_css( $builder, 'gravisain_header_button_font', '.ghb-action-button-wrapper .gravisain-btn', '{"family":"inherit","style":"600","size":""}' );

		// Action Button Colors.
		$btn_font_json   = get_theme_mod( 'gravisain_header_button_font_colors', '{"initial":"","hover":""}' );
		$btn_bg_json     = get_theme_mod( 'gravisain_header_button_bg_colors', '{"initial":"","hover":""}' );
		$btn_border_json = get_theme_mod( 'gravisain_header_button_border_colors', '{"initial":"","hover":""}' );

		$btn_font   = $this->decode_json_val( $btn_font_json );
		$btn_bg     = $this->decode_json_val( $btn_bg_json );
		$btn_border = $this->decode_json_val( $btn_border_json );

		if ( is_array( $btn_font ) ) {
			if ( ! empty( $btn_font['initial'] ) ) {
				$builder->add( '.ghb-action-button-wrapper .gravisain-btn', 'color', $btn_font['initial'] . ' !important' );
			}
			if ( ! empty( $btn_font['hover'] ) ) {
				$builder->add( '.ghb-action-button-wrapper .gravisain-btn:hover', 'color', $btn_font['hover'] . ' !important' );
			}
		}

		if ( is_array( $btn_bg ) ) {
			if ( ! empty( $btn_bg['initial'] ) ) {
				$builder->add( '.ghb-action-button-wrapper .gravisain-btn', 'background-color', $btn_bg['initial'] . ' !important' );
			}
			if ( ! empty( $btn_bg['hover'] ) ) {
				$builder->add( '.ghb-action-button-wrapper .gravisain-btn:hover', 'background-color', $btn_bg['hover'] . ' !important' );
			}
		}

		if ( is_array( $btn_border ) ) {
			if ( ! empty( $btn_border['initial'] ) ) {
				$builder->add( '.ghb-action-button-wrapper .gravisain-btn', 'border-color', $btn_border['initial'] . ' !important' );
			}
			if ( ! empty( $btn_border['hover'] ) ) {
				$builder->add( '.ghb-action-button-wrapper .gravisain-btn:hover', 'border-color', $btn_border['hover'] . ' !important' );
			}
		}

		$btn_border_style = get_theme_mod( 'gravisain_header_button_border_style', 'none' );
		$btn_border_width = get_theme_mod( 'gravisain_header_button_border_width', '2px' );
		if ( 'none' !== $btn_border_style && '' !== $btn_border_style ) {
			$builder->add( '.ghb-action-button-wrapper .gravisain-btn', 'border-style', $btn_border_style . ' !important' );
			$builder->add( '.ghb-action-button-wrapper .gravisain-btn', 'border-width', $btn_border_width . ' !important' );
		} else {
			$builder->add( '.ghb-action-button-wrapper .gravisain-btn', 'border-style', 'none !important' );
		}
	}

	/**
	 * Generate transparent header CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_transparent_header( Builder $builder ): void {
		if ( class_exists( '\Gravisain\Helpers\HeaderHelper' ) && HeaderHelper::is_transparent_header() ) {
			$trans_bg     = get_theme_mod( 'gravisain_transparent_header_bg_color', '' );
			$border_width = get_theme_mod( 'gravisain_transparent_header_border_width', '0' );
			$border_color = get_theme_mod( 'gravisain_transparent_header_border_color', '#ffffff' );
			$trans_text   = get_theme_mod( 'gravisain_transparent_header_text_color', '#ffffff' );
			$trans_hover  = get_theme_mod( 'gravisain_transparent_header_text_hover_color', '#cccccc' );

			$builder->add( '.has-transparent-header .site-header', 'position', 'absolute' );
			$builder->add( '.has-transparent-header .site-header', 'width', '100% !important' );
			$builder->add( '.has-transparent-header .site-header', 'top', '0px' );
			$builder->add( '.has-transparent-header .site-header', 'left', '0px' );
			$builder->add( '.has-transparent-header .site-header', 'right', '0px' );
			$builder->add( '.has-transparent-header .site-header', 'z-index', '999' );

			if ( ! empty( $trans_bg ) ) {
				$builder->add( '.has-transparent-header .site-header', 'background-color', $trans_bg . ' !important' );
			}

			// Compensate site-content top padding when transparent header is active so content does not collide with header.
			$builder->add( '.has-transparent-header .site-content', 'padding-top', 'calc(var(--gravisain-header-offset, 120px) + var(--gravisain-content-padding-top, 56px)) !important' );

			// Force inner rows to be transparent.
			$builder->add( '.has-transparent-header .site-header-top-row, .has-transparent-header .site-header-top', 'background-color', 'transparent !important' );
			$builder->add( '.has-transparent-header .site-header-main', 'background-color', 'transparent !important' );
			$builder->add( '.has-transparent-header .site-header-bottom-row, .has-transparent-header .site-header-bottom', 'background-color', 'transparent !important' );

			if ( ! empty( $border_width ) && '0' !== $border_width ) {
				$builder->add( '.has-transparent-header .site-header', 'border-bottom', $border_width . ' solid ' . $border_color );
			}

			// Text color for navigation links and site title.
			if ( ! empty( $trans_text ) ) {
				$builder->add( '.has-transparent-header .site-header .site-header-row', 'color', $trans_text . ' !important' );
				$builder->add( '.has-transparent-header .site-header .site-header-row a:not(.gravisain-btn)', 'color', $trans_text . ' !important' );
				$builder->add( '.has-transparent-header .site-header .main-navigation a, .has-transparent-header .site-header .main-navigation ul li a', 'color', $trans_text . ' !important' );
				$builder->add( '.has-transparent-header .site-header .secondary-navigation a, .has-transparent-header .site-header .secondary-navigation ul li a', 'color', $trans_text . ' !important' );
				$builder->add( '.has-transparent-header .site-header .site-title a', 'color', $trans_text . ' !important' );
				$builder->add( '.has-transparent-header .site-header .site-description', 'color', $trans_text . ' !important' );
				$builder->add( '.has-transparent-header .site-header', 'color', $trans_text . ' !important' );
			}
			if ( ! empty( $trans_hover ) ) {
				$builder->add( '.has-transparent-header .site-header .site-header-row a:not(.gravisain-btn):hover', 'color', $trans_hover . ' !important' );
				$builder->add( '.has-transparent-header .site-header .main-navigation a:hover, .has-transparent-header .site-header .main-navigation ul li a:hover, .has-transparent-header .site-header .main-navigation li:hover > a', 'color', $trans_hover . ' !important' );
				$builder->add( '.has-transparent-header .site-header .secondary-navigation a:hover, .has-transparent-header .site-header .secondary-navigation ul li a:hover, .has-transparent-header .site-header .secondary-navigation li:hover > a', 'color', $trans_hover . ' !important' );
				$builder->add( '.has-transparent-header .site-header .site-title a:hover', 'color', $trans_hover . ' !important' );
			}

			// Logo switching.
			$builder->add( '.has-transparent-header .site-branding.has-transparent-logo .custom-logo-link', 'display', 'none !important' );
			$builder->add( '.has-transparent-header .site-branding.has-transparent-logo .transparent-custom-logo-link', 'display', 'inline-block !important' );
		}
	}

	/**
	 * Generate sticky header CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_sticky_header( Builder $builder ): void {
		if ( class_exists( '\Gravisain\Helpers\HeaderHelper' ) ) {
			$sticky_mode = HeaderHelper::get_sticky_header_mode();
			if ( 'none' !== $sticky_mode ) {
				$sticky_bg     = get_theme_mod( 'gravisain_sticky_header_bg_color', '#ffffff' );
				$sticky_text   = get_theme_mod( 'gravisain_sticky_header_text_color', '' );
				$sticky_shadow = get_theme_mod( 'gravisain_sticky_header_shadow', true );

				if ( ! empty( $sticky_bg ) ) {
					$builder->add( '.has-sticky-header .site-header.is-sticky', 'background-color', $sticky_bg . ' !important' );
					$builder->add( '.has-sticky-header .site-header.is-sticky .site-header-row', 'background-color', 'transparent !important' );
				}

				if ( $sticky_shadow ) {
					$builder->add( '.has-sticky-header .site-header.is-sticky', 'box-shadow', '0 4px 20px rgba(0, 0, 0, 0.08) !important' );
				}

				if ( ! empty( $sticky_text ) ) {
					$builder->add( '.has-sticky-header .site-header.is-sticky .main-navigation a, .has-sticky-header .site-header.is-sticky .site-title a', 'color', $sticky_text . ' !important' );
				}

				if ( get_theme_mod( 'gravisain_sticky_header_shrink', true ) ) {
					$shrink_height      = get_theme_mod( 'gravisain_sticky_header_shrink_height', '54px' );
					$shrink_logo_height = get_theme_mod( 'gravisain_sticky_header_shrink_logo_height', '40px' );
					if ( ! empty( $shrink_height ) ) {
						$builder->add( 'body.sticky-shrink .site-header.is-sticky .site-header-row', 'min-height', $shrink_height . ' !important' );
					}
					if ( ! empty( $shrink_logo_height ) ) {
						$builder->add( 'body.sticky-shrink .site-header.is-sticky .custom-logo, body.sticky-shrink .site-header.is-sticky .transparent-logo', 'max-height', $shrink_logo_height . ' !important' );
					}
				}
			}
		}
	}
}
