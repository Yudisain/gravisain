<?php
/**
 * Footer CSS Generator
 *
 * Handles Footer Navigation, Footer Social Icons, and Footer Rows (Top, Main, Bottom) CSS.
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
 * FooterCSS Class
 */
class FooterCSS extends AbstractGenerator {

	/**
	 * Generate footer CSS rules.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	public function generate( Builder $builder ): void {
		$this->generate_footer_navigation( $builder );
		$this->generate_footer_social_icons( $builder );
		$this->generate_footer_rows( $builder );
	}

	/**
	 * Generate footer navigation CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_footer_navigation( Builder $builder ): void {
		// Footer Navigation Colors.
		$f_nav_colors = $this->decode_json_val( get_theme_mod( 'gravisain_footer_nav_colors', '{"initial":"","hover":""}' ) );
		if ( ! empty( $f_nav_colors ) && is_array( $f_nav_colors ) ) {
			if ( ! empty( $f_nav_colors['initial'] ) ) {
				$builder->add( '.gfb-footer-navigation a, .gfb-footer-navigation ul li a', 'color', $f_nav_colors['initial'] . ' !important' );
			}
			if ( ! empty( $f_nav_colors['hover'] ) ) {
				$builder->add( '.gfb-footer-navigation a:hover, .gfb-footer-navigation ul li a:hover', 'color', $f_nav_colors['hover'] . ' !important' );
			}
		}

		// Footer Navigation Spacing.
		$f_nav_spacing = get_theme_mod( 'gravisain_footer_nav_spacing', '{"desktop":"20","tablet":"16","mobile":"12"}' );
		if ( ! empty( $f_nav_spacing ) ) {
			$obj = $this->decode_json_val( $f_nav_spacing );
			if ( ! empty( $obj ) && is_array( $obj ) ) {
				if ( isset( $obj['desktop'] ) && '' !== $obj['desktop'] ) {
					$builder->add( '.gfb-footer-navigation ul', 'gap', intval( $obj['desktop'] ) . 'px' );
					$builder->add( '.gfb-footer-navigation ul', 'display', 'flex' );
					$builder->add( '.gfb-footer-navigation ul', 'flex-wrap', 'wrap' );
				}
				if ( isset( $obj['tablet'] ) && '' !== $obj['tablet'] ) {
					$builder->add( '.gfb-footer-navigation ul', 'gap', intval( $obj['tablet'] ) . 'px', 'max-width: 1024px' );
				}
				if ( isset( $obj['mobile'] ) && '' !== $obj['mobile'] ) {
					$builder->add( '.gfb-footer-navigation ul', 'gap', intval( $obj['mobile'] ) . 'px', 'max-width: 719px' );
				}
			} elseif ( is_numeric( $f_nav_spacing ) ) {
				$builder->add( '.gfb-footer-navigation ul', 'gap', intval( $f_nav_spacing ) . 'px' );
				$builder->add( '.gfb-footer-navigation ul', 'display', 'flex' );
				$builder->add( '.gfb-footer-navigation ul', 'flex-wrap', 'wrap' );
			}
		}

		// Footer Navigation Font.
		$f_nav_font = $this->decode_json_val( get_theme_mod( 'gravisain_footer_nav_font', '{"family":"inherit","style":"normal","size":"14"}' ) );
		if ( ! empty( $f_nav_font ) && is_array( $f_nav_font ) && ! empty( $f_nav_font['size'] ) && is_numeric( $f_nav_font['size'] ) ) {
			$builder->add( '.gfb-footer-navigation a, .gfb-footer-navigation ul li a', 'font-size', intval( $f_nav_font['size'] ) . 'px !important' );
		}
	}

	/**
	 * Generate footer social icons CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_footer_social_icons( Builder $builder ): void {
		// Footer Social Icons Spacing.
		$f_social_spacing_json = get_theme_mod( 'gravisain_footer_social_spacing', '{"desktop":"14","tablet":"12","mobile":"10"}' );
		if ( ! empty( $f_social_spacing_json ) ) {
			$obj = $this->decode_json_val( $f_social_spacing_json );
			if ( ! empty( $obj ) && is_array( $obj ) ) {
				if ( isset( $obj['desktop'] ) && '' !== $obj['desktop'] ) {
					$builder->add( '.gfb-social .social-icons-list', 'gap', intval( $obj['desktop'] ) . 'px' );
				}
				if ( isset( $obj['tablet'] ) && '' !== $obj['tablet'] ) {
					$builder->add( '.gfb-social .social-icons-list', 'gap', intval( $obj['tablet'] ) . 'px', 'max-width: 1024px' );
				}
				if ( isset( $obj['mobile'] ) && '' !== $obj['mobile'] ) {
					$builder->add( '.gfb-social .social-icons-list', 'gap', intval( $obj['mobile'] ) . 'px', 'max-width: 719px' );
				}
			} elseif ( is_numeric( $f_social_spacing_json ) ) {
				$builder->add( '.gfb-social .social-icons-list', 'gap', intval( $f_social_spacing_json ) . 'px' );
			}
		}

		// Footer Social Icons Size.
		$f_social_size_json = get_theme_mod( 'gravisain_footer_social_icon_size', '{"desktop":"18","tablet":"16","mobile":"16"}' );
		if ( ! empty( $f_social_size_json ) ) {
			$obj = $this->decode_json_val( $f_social_size_json );
			if ( is_array( $obj ) ) {
				if ( isset( $obj['desktop'] ) && '' !== $obj['desktop'] ) {
					$builder->add( '.gfb-social .social-icon-item a:not(.has-label), .gfb-social .social-icon-icon, .gfb-social .social-icon-icon svg, .gfb-social .social-icon-icon img', 'width', intval( $obj['desktop'] ) . 'px !important' );
					$builder->add( '.gfb-social .social-icon-item a:not(.has-label), .gfb-social .social-icon-icon, .gfb-social .social-icon-icon svg, .gfb-social .social-icon-icon img', 'height', intval( $obj['desktop'] ) . 'px !important' );
				}
				if ( isset( $obj['tablet'] ) && '' !== $obj['tablet'] ) {
					$builder->add( '.gfb-social .social-icon-item a:not(.has-label), .gfb-social .social-icon-icon, .gfb-social .social-icon-icon svg, .gfb-social .social-icon-icon img', 'width', intval( $obj['tablet'] ) . 'px !important', 'max-width: 1024px' );
					$builder->add( '.gfb-social .social-icon-item a:not(.has-label), .gfb-social .social-icon-icon, .gfb-social .social-icon-icon svg, .gfb-social .social-icon-icon img', 'height', intval( $obj['tablet'] ) . 'px !important', 'max-width: 1024px' );
				}
				if ( isset( $obj['mobile'] ) && '' !== $obj['mobile'] ) {
					$builder->add( '.gfb-social .social-icon-item a:not(.has-label), .gfb-social .social-icon-icon, .gfb-social .social-icon-icon svg, .gfb-social .social-icon-icon img', 'width', intval( $obj['mobile'] ) . 'px !important', 'max-width: 719px' );
					$builder->add( '.gfb-social .social-icon-item a:not(.has-label), .gfb-social .social-icon-icon, .gfb-social .social-icon-icon svg, .gfb-social .social-icon-icon img', 'height', intval( $obj['mobile'] ) . 'px !important', 'max-width: 719px' );
				}
			} elseif ( is_numeric( $f_social_size_json ) ) {
				$builder->add( '.gfb-social .social-icon-item a:not(.has-label), .gfb-social .social-icon-icon, .gfb-social .social-icon-icon svg, .gfb-social .social-icon-icon img', 'width', intval( $f_social_size_json ) . 'px !important' );
				$builder->add( '.gfb-social .social-icon-item a:not(.has-label), .gfb-social .social-icon-icon, .gfb-social .social-icon-icon svg, .gfb-social .social-icon-icon img', 'height', intval( $f_social_size_json ) . 'px !important' );
			}
		}
	}

	/**
	 * Generate footer rows (Top, Main, Bottom) CSS.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	private function generate_footer_rows( Builder $builder ): void {
		// Top Row.
		$footer_top_bg   = get_theme_mod( 'gravisain_footer_top_bg_color', '' );
		$footer_top_text = get_theme_mod( 'gravisain_footer_top_text_color', '' );
		if ( ! empty( $footer_top_bg ) ) {
			$builder->add( '.site-footer-top', 'background-color', $footer_top_bg . ' !important' );
		}
		if ( ! empty( $footer_top_text ) ) {
			$builder->add( '.site-footer-top, .site-footer-top a, .site-footer-top .footer-widget-title', 'color', $footer_top_text . ' !important' );
		}

		// Main Row.
		$footer_main_bg   = get_theme_mod( 'gravisain_footer_main_bg_color', '' );
		$footer_main_text = get_theme_mod( 'gravisain_footer_main_text_color', '' );
		if ( ! empty( $footer_main_bg ) ) {
			$builder->add( '.site-footer-main', 'background-color', $footer_main_bg . ' !important' );
		}
		if ( ! empty( $footer_main_text ) ) {
			$builder->add( '.site-footer-main, .site-footer-main a, .site-footer-main .footer-widget-title', 'color', $footer_main_text . ' !important' );
		}

		// Bottom Row.
		$footer_bottom_bg   = get_theme_mod( 'gravisain_footer_bottom_bg_color', '' );
		$footer_bottom_text = get_theme_mod( 'gravisain_footer_bottom_text_color', '' );
		if ( ! empty( $footer_bottom_bg ) ) {
			$builder->add( '.site-footer-bottom', 'background-color', $footer_bottom_bg . ' !important' );
		}
		if ( ! empty( $footer_bottom_text ) ) {
			$builder->add( '.site-footer-bottom, .site-footer-bottom a, .site-footer-bottom .gfb-copyright', 'color', $footer_bottom_text . ' !important' );
		}
	}
}
