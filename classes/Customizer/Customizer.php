<?php
/**
 * Customizer Configuration Manager
 *
 * @package Gravisain\Customizer
 */

namespace Gravisain\Customizer;

use Gravisain\Customizer\Options\GeneralOptions;
use Gravisain\Customizer\Options\LayoutOptions;
use Gravisain\Customizer\Options\HeaderOptions;
use Gravisain\Customizer\Options\FooterOptions;
use Gravisain\Customizer\Options\TransparentHeaderOptions;
use Gravisain\Customizer\Options\StickyHeaderOptions;
use Gravisain\Customizer\Options\BlogOptions;
use Gravisain\Customizer\Options\PageHeaderOptions;
use Gravisain\Customizer\Options\ColorOptions;
use Gravisain\Customizer\Options\TypographyOptions;
use Gravisain\Customizer\Options\PerformanceOptions;
use Gravisain\Customizer\Options\WooCommerceOptions;
use Gravisain\Customizer\Options\BreadcrumbOptions;
use Gravisain\Helpers\GoogleFontsHelper;

class Customizer {
	public static function init(): void {
		$instance = new self();
		add_action( 'customize_register', [ $instance, 'register' ], 99 );
		add_action( 'customize_controls_enqueue_scripts', [ $instance, 'enqueue_assets' ] );
		add_action( 'customize_preview_init', [ $instance, 'enqueue_preview_assets' ] );
	}

	public function register( $wp_customize ): void {
		// 0. Register Custom Control Types
		$wp_customize->register_control_type( 'Gravisain\Customizer\Controls\SliderControl' );
		$wp_customize->register_control_type( 'Gravisain\Customizer\Controls\VisibilityControl' );
		$wp_customize->register_control_type( 'Gravisain\Customizer\Controls\SectionTabsControl' );
		$wp_customize->register_control_type( 'Gravisain\Customizer\Controls\SocialIconsControl' );
		$wp_customize->register_control_type( 'Gravisain\Customizer\Controls\ColorGroupControl' );
		$wp_customize->register_control_type( 'Gravisain\Customizer\Controls\TypographyControl' );
		$wp_customize->register_control_type( 'Gravisain\Customizer\Controls\ButtonGroupControl' );
		$wp_customize->register_control_type( 'Gravisain\Customizer\Controls\SpacingControl' );
		$wp_customize->register_control_type( 'Gravisain\Customizer\Controls\PaletteControl' );
		$wp_customize->register_control_type( 'Gravisain\Customizer\Controls\HeadingControl' );

		// 0.1 Register Custom Section Types
		$wp_customize->register_section_type( 'Gravisain\Customizer\Sections\HeadingSection' );

		// 1. Add Main Panel
		$wp_customize->add_panel( 'gravisain_options', [
			'title'       => __( 'Gravisain Options', 'gravisain' ),
			'description' => __( 'Premium options for Gravisain theme.', 'gravisain' ),
			'priority'    => 10,
		] );

		// 2. Load Modular Options
		( new \Gravisain\Customizer\Options\SiteIdentityOptions() )->register( $wp_customize );
		( new ColorOptions() )->register( $wp_customize );
		( new TypographyOptions() )->register( $wp_customize );
		( new PerformanceOptions() )->register( $wp_customize );
		( new GeneralOptions() )->register( $wp_customize );
		( new LayoutOptions() )->register( $wp_customize );
		( new HeaderOptions() )->register( $wp_customize );
		( new FooterOptions() )->register( $wp_customize );
		( new TransparentHeaderOptions() )->register( $wp_customize );
		( new StickyHeaderOptions() )->register( $wp_customize );
		( new BlogOptions() )->register( $wp_customize );
		( new PageHeaderOptions() )->register( $wp_customize );
		( new BreadcrumbOptions() )->register( $wp_customize );
		( new WooCommerceOptions() )->register( $wp_customize );
	}

	public function enqueue_assets(): void {
		$theme_version = wp_get_theme()->get( 'Version' );
		$manifest_path = get_template_directory() . '/assets/.vite/manifest.json';
		
		if ( file_exists( $manifest_path ) ) {
			$manifest      = json_decode( file_get_contents( $manifest_path ), true );
			$asset_version = $theme_version . '.' . filemtime( $manifest_path );

			// Customizer UI CSS
			if ( isset( $manifest['src/css/customizer.css']['file'] ) ) {
				wp_enqueue_style(
					'gravisain-customizer-css',
					get_template_directory_uri() . '/assets/' . $manifest['src/css/customizer.css']['file'],
					[],
					$asset_version
				);
			}

			// Customizer Controls CSS
			if ( isset( $manifest['src/css/customizer-controls.css']['file'] ) ) {
				wp_enqueue_style(
					'gravisain-customizer-controls-css',
					get_template_directory_uri() . '/assets/' . $manifest['src/css/customizer-controls.css']['file'],
					[ 'wp-color-picker' ],
					$asset_version
				);
			}

			// Customizer UI JS
			if ( isset( $manifest['src/js/customizer.js']['file'] ) ) {
				wp_enqueue_script(
					'gravisain-customizer-js',
					get_template_directory_uri() . '/assets/' . $manifest['src/js/customizer.js']['file'],
					[ 'jquery', 'customize-controls', 'jquery-ui-sortable' ],
					$asset_version,
					true
				);
			}

		// Customizer Controls JS
			if ( isset( $manifest['src/js/customizer-react.jsx']['file'] ) ) {
				wp_enqueue_script(
					'gravisain-customizer-react-js',
					get_template_directory_uri() . '/assets/' . $manifest['src/js/customizer-react.jsx']['file'],
					[ 'wp-element' ],
					$asset_version,
					true
				);
			}

			if ( isset( $manifest['src/js/customizer-controls.js']['file'] ) ) {
				wp_enqueue_script(
					'gravisain-customizer-controls-js',
					get_template_directory_uri() . '/assets/' . $manifest['src/js/customizer-controls.js']['file'],
					[ 'jquery', 'customize-controls', 'wp-color-picker', 'gravisain-customizer-react-js' ],
					$asset_version,
					true
				);

				// Pass the full Google Fonts catalog to JS for the searchable font picker.
				// The catalog is a static JSON file loaded once and cached in PHP.
				wp_localize_script(
					'gravisain-customizer-controls-js',
					'GravisainFonts',
					[
						'catalog'      => GoogleFontsHelper::get_catalog_for_js(),
						'system_fonts' => GoogleFontsHelper::get_system_fonts(),
						'preview_url'  => 'https://fonts.googleapis.com/css2',
					]
				);
			}
		}
	}

	public function enqueue_preview_assets(): void {
		$theme_version = wp_get_theme()->get( 'Version' );
		$manifest_path = get_template_directory() . '/assets/.vite/manifest.json';
		
		if ( file_exists( $manifest_path ) ) {
			$manifest = json_decode( file_get_contents( $manifest_path ), true );

			// Customizer Preview JS
			if ( isset( $manifest['src/js/customize-preview.js']['file'] ) ) {
				wp_enqueue_script(
					'gravisain-customize-preview-js',
					get_template_directory_uri() . '/assets/' . $manifest['src/js/customize-preview.js']['file'],
					[ 'jquery', 'customize-preview', 'customize-selective-refresh' ],
					$theme_version,
					true
				);
			}
		}
	}
}
