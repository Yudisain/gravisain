<?php
/**
 * Main Row Header Options
 *
 * @package Gravisain\Customizer\Options\Header
 */

namespace Gravisain\Customizer\Options\Header;

use Gravisain\Customizer\Controls\SectionTabsControl;
use Gravisain\Customizer\Controls\SliderControl;
use Gravisain\Customizer\Controls\VisibilityControl;
use Gravisain\Customizer\Controls\NoticeControl;

class MainRowOptions {
	public function register( $wp_customize ): void {
		$wp_customize->add_section( 'gravisain_header_main_row', [
			'title'    => __( 'Main Row', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 22,
		] );

		// 1. Section Tabs (Layout vs Style)
		$wp_customize->add_setting( 'gravisain_header_main_tabs', [
			'default'           => 'layout',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SectionTabsControl( $wp_customize, 'gravisain_header_main_tabs', [
			'section'  => 'gravisain_header_main_row',
			'priority' => 1,
		] ) );

		// --- LAYOUT TAB CONTROLS ---

		// Row Layout (Dropdown)
		$wp_customize->add_setting( 'gravisain_header_main_layout', [
			'default'           => 'full-contained',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( 'gravisain_header_main_layout', [
			'type'          => 'select',
			'label'         => __( 'Row Layout', 'gravisain' ),
			'section'       => 'gravisain_header_main_row',
			'priority'      => 5,
			'choices'       => [
				'full-contained' => __( 'Full Width - Contained', 'gravisain' ),
				'full-width'     => __( 'Full Width', 'gravisain' ),
				'contained'      => __( 'Contained', 'gravisain' ),
			],
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] );

		// Main Row Height (Responsive)
		$wp_customize->add_setting( 'gravisain_header_main_height', [
			'default'           => '{"desktop":"80","tablet":"70","mobile":"60"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_header_main_height', [
			'label'         => __( 'Row Height (px)', 'gravisain' ),
			'section'       => 'gravisain_header_main_row',
			'priority'      => 10,
			'default'       => 80,
			'choices'       => [ 'min' => 20, 'max' => 150, 'step' => 1 ],
			'responsive'    => true,
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		// Bottom Border Width
		$wp_customize->add_setting( 'gravisain_header_main_border_width', [
			'default'           => 0,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_header_main_border_width', [
			'label'         => __( 'Bottom Border Width (px)', 'gravisain' ),
			'section'       => 'gravisain_header_main_row',
			'priority'      => 20,
			'default'       => 0,
			'choices'       => [ 'min' => 0, 'max' => 10, 'step' => 1 ],
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		// Device Visibility
		$wp_customize->add_setting( 'gravisain_header_main_visibility', [
			'default'           => 'desktop,tablet,mobile',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new VisibilityControl( $wp_customize, 'gravisain_header_main_visibility', [
			'label'         => __( 'Device Visibility', 'gravisain' ),
			'section'       => 'gravisain_header_main_row',
			'priority'      => 30,
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		// --- STYLE TAB CONTROLS ---

		// Transparent Header Notice
		$wp_customize->add_setting( 'gravisain_header_main_transparent_notice', [
			'sanitize_callback' => 'sanitize_text_field',
		] );

		$wp_customize->add_control( new NoticeControl( $wp_customize, 'gravisain_header_main_transparent_notice', [
			'label'       => __( 'Transparent Header Active', 'gravisain' ),
			'description' => __( 'The Transparent Header is currently active. Background and text color settings here will be overridden on pages where the Transparent Header appears.', 'gravisain' ),
			'section'     => 'gravisain_header_main_row',
			'notice_type' => 'warning',
			'priority'    => 35,
			'tab'         => 'style',
		] ) );

		// Background Color
		$wp_customize->add_setting( 'gravisain_header_main_bg_color', [
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_main_bg_color', [
			'label'         => __( 'Background Color', 'gravisain' ),
			'section'       => 'gravisain_header_main_row',
			'priority'      => 40,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Text Color
		$wp_customize->add_setting( 'gravisain_header_main_text_color', [
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_main_text_color', [
			'label'         => __( 'Text Color', 'gravisain' ),
			'section'       => 'gravisain_header_main_row',
			'priority'      => 50,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Link Color
		$wp_customize->add_setting( 'gravisain_header_main_link_color', [
			'default'           => '#0073aa',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_main_link_color', [
			'label'         => __( 'Link Color', 'gravisain' ),
			'section'       => 'gravisain_header_main_row',
			'priority'      => 60,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Link Hover Color
		$wp_customize->add_setting( 'gravisain_header_main_link_hover_color', [
			'default'           => '#005177',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_main_link_hover_color', [
			'label'         => __( 'Link Hover Color', 'gravisain' ),
			'section'       => 'gravisain_header_main_row',
			'priority'      => 70,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Border Bottom Color
		$wp_customize->add_setting( 'gravisain_header_main_border_color', [
			'default'           => '#e2e8f0',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_main_border_color', [
			'label'         => __( 'Border Bottom Color', 'gravisain' ),
			'section'       => 'gravisain_header_main_row',
			'priority'      => 80,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Setup Selective Refresh for Main Row
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'gravisain_header_main_row', [
				'selector'            => '.site-header-main',
				'settings'            => [
					'gravisain_header_main_visibility',
				],
				'render_callback'     => function() {
					get_template_part( 'template-parts/header/main-row' );
				},
				'container_inclusive' => false,
				'fallback_refresh'    => false,
			] );
		}
	}
}
