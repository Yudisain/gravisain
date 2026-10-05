<?php
/**
 * Site Identity Options
 *
 * @package Gravisain\Customizer\Options
 */

namespace Gravisain\Customizer\Options;

use Gravisain\Customizer\Controls\ColorGroupControl;
use Gravisain\Customizer\Controls\HeadingControl;
use Gravisain\Customizer\Controls\SectionTabsControl;
use Gravisain\Customizer\Controls\SliderControl;
use Gravisain\Customizer\Controls\SpacingControl;
use Gravisain\Customizer\Controls\TypographyControl;
use Gravisain\Customizer\Controls\VisibilityControl;
use Gravisain\Customizer\Sanitize;

class SiteIdentityOptions {
	public function register( $wp_customize ): void {
		
		// Remove core's combined display_header_text control so we can use our granular controls
		$wp_customize->remove_control( 'display_header_text' );

		// Move core section into Header Panel and set priority
		$section = $wp_customize->get_section( 'title_tagline' );
		if ( $section ) {
			$section->panel    = 'gravisain_header_panel';
			$section->priority = 11;
		}

		// Section Tabs (Layout vs Style)
		$wp_customize->add_setting( 'gravisain_site_identity_tabs', [
			'default'           => 'layout',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SectionTabsControl( $wp_customize, 'gravisain_site_identity_tabs', [
			'section'  => 'title_tagline',
			'priority' => 1,
			'tabs'     => [
				'layout' => __( 'LAYOUT', 'gravisain' ),
				'style'  => __( 'STYLE', 'gravisain' ),
			],
		] ) );

		// Assign existing core controls and set priorities right inside Layout tab
		$core_controls = [
			'custom_logo'     => 5,
			'blogname'        => 11,
			'blogdescription' => 21,
			'site_icon'       => 31,
		];
		foreach ( $core_controls as $control_id => $priority ) {
			$control = $wp_customize->get_control( $control_id );
			if ( $control ) {
				$control->tab      = 'layout';
				$control->priority = $priority;
				if ( ! isset( $control->wrapper_attrs ) || ! is_array( $control->wrapper_attrs ) ) {
					$control->wrapper_attrs = [];
				}
				$control->wrapper_attrs['data-tab'] = 'layout';
			}
		}

		// --- LOGO WIDTH (Moved to Priority 6, directly under custom_logo) ---
		$wp_customize->add_setting( 'gravisain_logo_width', [
			'default'           => '{"desktop":"220px","tablet":"180px","mobile":"140px"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_logo_width', [
			'label'         => __( 'Logo Width', 'gravisain' ),
			'description'   => __( 'Set the maximum width for the logo.', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 6,
			'responsive'    => true,
			'units'         => [ 'px', 'em', 'rem', 'vw', '%' ],
			'input_attrs'   => [
				'px'  => [ 'min' => 20, 'max' => 600, 'step' => 1 ],
				'em'  => [ 'min' => 2, 'max' => 40, 'step' => 0.1 ],
				'rem' => [ 'min' => 2, 'max' => 40, 'step' => 0.1 ],
				'vw'  => [ 'min' => 2, 'max' => 50, 'step' => 1 ],
				'%'   => [ 'min' => 10, 'max' => 100, 'step' => 1 ],
			],
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		// --- LOGO MARGIN (Priority 42, Style Tab) ---
		$wp_customize->add_setting( 'gravisain_logo_margin', [
			'default'           => '{"top":"","right":"","bottom":"","left":"","unit":"px","linked":true}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new SpacingControl( $wp_customize, 'gravisain_logo_margin', [
			'label'         => __( 'Logo Margin', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 42,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// --- GROUP 1: SITE TITLE (LAYOUT TAB) ---
		$wp_customize->add_setting( 'gravisain_site_title_layout_heading', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		] );

		$wp_customize->add_control( new HeadingControl( $wp_customize, 'gravisain_site_title_layout_heading', [
			'label'         => __( 'Site Title', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 10,
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		$wp_customize->add_setting( 'gravisain_show_site_title', [
			'default'           => true,
			'sanitize_callback' => [ '\Gravisain\Customizer\Sanitize', 'checkbox' ],
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( 'gravisain_show_site_title', [
			'type'          => 'checkbox',
			'label'         => __( 'Show Site Title', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 12,
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] );

		$wp_customize->add_setting( 'gravisain_site_title_visibility', [
			'default'           => 'desktop,tablet,mobile',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new VisibilityControl( $wp_customize, 'gravisain_site_title_visibility', [
			'label'         => __( 'Site Title Visibility', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 13,
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		// --- GROUP 2: SITE TAGLINE (LAYOUT TAB) ---
		$wp_customize->add_setting( 'gravisain_site_tagline_layout_heading', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		] );

		$wp_customize->add_control( new HeadingControl( $wp_customize, 'gravisain_site_tagline_layout_heading', [
			'label'         => __( 'Site Tagline', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 20,
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		$wp_customize->add_setting( 'gravisain_show_site_tagline', [
			'default'           => true,
			'sanitize_callback' => [ '\Gravisain\Customizer\Sanitize', 'checkbox' ],
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( 'gravisain_show_site_tagline', [
			'type'          => 'checkbox',
			'label'         => __( 'Show Site Tagline', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 22,
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] );

		$wp_customize->add_setting( 'gravisain_site_tagline_visibility', [
			'default'           => 'desktop,tablet,mobile',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new VisibilityControl( $wp_customize, 'gravisain_site_tagline_visibility', [
			'label'         => __( 'Site Tagline Visibility', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 23,
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		// --- GROUP 3: SITE ICON (LAYOUT TAB) ---
		$wp_customize->add_setting( 'gravisain_site_icon_heading', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		] );

		$wp_customize->add_control( new HeadingControl( $wp_customize, 'gravisain_site_icon_heading', [
			'label'         => __( 'Site Icon', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 30,
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		// --- STYLE TAB CONTROLS ---

		// --- GROUP 4: SITE TITLE STYLING (STYLE TAB) ---
		$wp_customize->add_setting( 'gravisain_site_title_style_heading', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		] );

		$wp_customize->add_control( new HeadingControl( $wp_customize, 'gravisain_site_title_style_heading', [
			'label'         => __( 'Site Title Styling', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 40,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		$wp_customize->add_setting( 'gravisain_site_title_typography', [
			'default'           => '{"family":"inherit","style":"700","size":"24","line_height":"1.3","spacing":"0"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new TypographyControl( $wp_customize, 'gravisain_site_title_typography', [
			'label'         => __( 'Site Title Font', 'gravisain' ),
			'description'   => __( 'Customize the typography for the site title.', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 41,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'preview_text'  => get_bloginfo( 'name' ) ?: __( 'Gravisain Theme', 'gravisain' ),
		] ) );

		$wp_customize->add_setting( 'gravisain_site_title_colors', [
			'default'           => '{"initial":"","hover":"","active":""}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ColorGroupControl( $wp_customize, 'gravisain_site_title_colors', [
			'label'         => __( 'Site Title Colors', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 42,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'fields'        => [
				'initial' => __( 'Initial Color', 'gravisain' ),
				'hover'   => __( 'Hover Color', 'gravisain' ),
				'active'  => __( 'Active Color', 'gravisain' ),
			],
		] ) );

		$wp_customize->add_setting( 'gravisain_site_title_margin', [
			'default'           => '{"top":"","right":"","bottom":"","left":"","unit":"px","linked":true}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SpacingControl( $wp_customize, 'gravisain_site_title_margin', [
			'label'         => __( 'Site Title Margin', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 43,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		$wp_customize->add_setting( 'gravisain_site_title_padding', [
			'default'           => '{"top":"","right":"","bottom":"","left":"","unit":"px","linked":true}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SpacingControl( $wp_customize, 'gravisain_site_title_padding', [
			'label'         => __( 'Site Title Padding', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 44,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// --- GROUP 5: SITE TAGLINE STYLING (STYLE TAB) ---
		$wp_customize->add_setting( 'gravisain_site_tagline_style_heading', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		] );

		$wp_customize->add_control( new HeadingControl( $wp_customize, 'gravisain_site_tagline_style_heading', [
			'label'         => __( 'Site Tagline Styling', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 50,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		$wp_customize->add_setting( 'gravisain_site_tagline_typography', [
			'default'           => '{"family":"inherit","style":"400","size":"14","line_height":"1.5","spacing":"0"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new TypographyControl( $wp_customize, 'gravisain_site_tagline_typography', [
			'label'         => __( 'Site Tagline Font', 'gravisain' ),
			'description'   => __( 'Customize the typography for the site tagline.', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 51,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'preview_text'  => get_bloginfo( 'description' ) ?: __( 'Just another WordPress site', 'gravisain' ),
		] ) );

		$wp_customize->add_setting( 'gravisain_site_tagline_colors', [
			'default'           => '{"initial":""}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ColorGroupControl( $wp_customize, 'gravisain_site_tagline_colors', [
			'label'         => __( 'Site Tagline Colors', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 52,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'fields'        => [
				'initial' => __( 'Initial Color', 'gravisain' ),
			],
		] ) );

		$wp_customize->add_setting( 'gravisain_site_tagline_margin', [
			'default'           => '{"top":"","right":"","bottom":"","left":"","unit":"px","linked":true}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SpacingControl( $wp_customize, 'gravisain_site_tagline_margin', [
			'label'         => __( 'Site Tagline Margin', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 53,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		$wp_customize->add_setting( 'gravisain_site_tagline_padding', [
			'default'           => '{"top":"","right":"","bottom":"","left":"","unit":"px","linked":true}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SpacingControl( $wp_customize, 'gravisain_site_tagline_padding', [
			'label'         => __( 'Site Tagline Padding', 'gravisain' ),
			'section'       => 'title_tagline',
			'priority'      => 54,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// 10. Ensure Core Settings use postMessage transport so Customizer Selective Refresh renders edit shortcuts
		if ( $wp_customize->get_setting( 'custom_logo' ) ) {
			$wp_customize->get_setting( 'custom_logo' )->transport = 'postMessage';
		}
		if ( $wp_customize->get_setting( 'blogname' ) ) {
			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		}
		if ( $wp_customize->get_setting( 'blogdescription' ) ) {
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		}

		// 11. Setup Selective Refresh for Site Branding / Logo
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'gravisain_site_branding', [
				'selector'            => '.site-branding',
				'settings'            => [
					'blogname',
					'blogdescription',
					'custom_logo',
					'gravisain_show_site_title',
					'gravisain_show_site_tagline',
				],
				'render_callback'     => function() {
					get_template_part( 'template-parts/header/components/logo' );
				},
				'container_inclusive' => false,
				'fallback_refresh'    => false,
			] );
		}
	}
}

