<?php
/**
 * Top Row Header Options
 *
 * @package Gravisain\Customizer\Options\Header
 */

namespace Gravisain\Customizer\Options\Header;

use Gravisain\Customizer\Controls\SectionTabsControl;
use Gravisain\Customizer\Controls\SliderControl;
use Gravisain\Customizer\Controls\VisibilityControl;
use Gravisain\Customizer\Controls\NoticeControl;
use Gravisain\Customizer\Controls\ButtonGroupControl;

class TopRowOptions {
	public function register( $wp_customize ): void {
		$wp_customize->add_section( 'gravisain_header_top_row', [
			'title'    => __( 'Top Row', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 21,
		] );

		// 1. Section Tabs (Layout vs Style)
		$wp_customize->add_setting( 'gravisain_header_top_tabs', [
			'default'           => 'layout',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SectionTabsControl( $wp_customize, 'gravisain_header_top_tabs', [
			'section'  => 'gravisain_header_top_row',
			'priority' => 1,
		] ) );

		// --- LAYOUT TAB CONTROLS ---

		// Row Layout (Dropdown)
		$wp_customize->add_setting( 'gravisain_header_top_layout', [
			'default'           => 'full-contained',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( 'gravisain_header_top_layout', [
			'type'          => 'select',
			'label'         => __( 'Row Layout', 'gravisain' ),
			'section'       => 'gravisain_header_top_row',
			'priority'      => 5,
			'choices'       => [
				'full-contained' => __( 'Full Width - Contained', 'gravisain' ),
				'full-width'     => __( 'Full Width', 'gravisain' ),
				'contained'      => __( 'Contained', 'gravisain' ),
			],
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] );

		// Top Row Height (Responsive)
		$wp_customize->add_setting( 'gravisain_header_top_height', [
			'default'           => '{"desktop":"40","tablet":"40","mobile":"35"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_header_top_height', [
			'label'         => __( 'Row Height (px)', 'gravisain' ),
			'section'       => 'gravisain_header_top_row',
			'priority'      => 10,
			'default'       => 40,
			'choices'       => [ 'min' => 20, 'max' => 120, 'step' => 1 ],
			'responsive'    => true,
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		// Bottom Border Width
		$wp_customize->add_setting( 'gravisain_header_top_border_width', [
			'default'           => 1,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_header_top_border_width', [
			'label'         => __( 'Bottom Border Width (px)', 'gravisain' ),
			'section'       => 'gravisain_header_top_row',
			'priority'      => 20,
			'default'       => 1,
			'choices'       => [ 'min' => 0, 'max' => 10, 'step' => 1 ],
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		// Device Visibility
		$wp_customize->add_setting( 'gravisain_header_top_visibility', [
			'default'           => 'desktop,tablet,mobile',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new VisibilityControl( $wp_customize, 'gravisain_header_top_visibility', [
			'label'         => __( 'Device Visibility', 'gravisain' ),
			'section'       => 'gravisain_header_top_row',
			'priority'      => 30,
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		// --- STYLE TAB CONTROLS ---

		// Transparent Header Notice
		$wp_customize->add_setting( 'gravisain_header_top_transparent_notice', [
			'sanitize_callback' => 'sanitize_text_field',
		] );

		$wp_customize->add_control( new NoticeControl( $wp_customize, 'gravisain_header_top_transparent_notice', [
			'label'       => __( 'Transparent Header Active', 'gravisain' ),
			'description' => __( 'The Transparent Header is currently active. Background and text color settings here will be overridden on pages where the Transparent Header appears.', 'gravisain' ),
			'section'     => 'gravisain_header_top_row',
			'notice_type' => 'warning',
			'priority'    => 35,
			'tab'         => 'style',
		] ) );

		// Background Type
		$wp_customize->add_setting( 'gravisain_header_top_bg_type', [
			'default'           => 'solid',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ButtonGroupControl( $wp_customize, 'gravisain_header_top_bg_type', [
			'label'         => __( 'Background Type', 'gravisain' ),
			'section'       => 'gravisain_header_top_row',
			'priority'      => 39,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'choices'       => [
				'solid'    => __( 'Solid', 'gravisain' ),
				'gradient' => __( 'Gradient', 'gravisain' ),
			],
		] ) );

		$top_solid_cb = function() {
			return get_theme_mod( 'gravisain_header_top_bg_type', 'solid' ) === 'solid';
		};

		$top_grad_cb = function() {
			return get_theme_mod( 'gravisain_header_top_bg_type', 'solid' ) === 'gradient';
		};

		// Background Color (Solid)
		$wp_customize->add_setting( 'gravisain_header_top_bg_color', [
			'default'           => '#f8f9fa',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_top_bg_color', [
			'label'           => __( 'Background Color', 'gravisain' ),
			'section'         => 'gravisain_header_top_row',
			'priority'        => 40,
			'wrapper_attrs'   => [ 'data-tab' => 'style' ],
			'active_callback' => $top_solid_cb,
		] ) );

		// Gradient Color 1
		$wp_customize->add_setting( 'gravisain_header_top_bg_gradient_1', [
			'default'           => '#064e3b',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_top_bg_gradient_1', [
			'label'           => __( 'Gradient Color 1', 'gravisain' ),
			'section'         => 'gravisain_header_top_row',
			'priority'        => 41,
			'wrapper_attrs'   => [ 'data-tab' => 'style' ],
			'active_callback' => $top_grad_cb,
		] ) );

		// Gradient Color 2
		$wp_customize->add_setting( 'gravisain_header_top_bg_gradient_2', [
			'default'           => '#0f392b',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_top_bg_gradient_2', [
			'label'           => __( 'Gradient Color 2', 'gravisain' ),
			'section'         => 'gravisain_header_top_row',
			'priority'        => 42,
			'wrapper_attrs'   => [ 'data-tab' => 'style' ],
			'active_callback' => $top_grad_cb,
		] ) );

		// Gradient Angle
		$wp_customize->add_setting( 'gravisain_header_top_bg_gradient_angle', [
			'default'           => '135deg',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_header_top_bg_gradient_angle', [
			'label'           => __( 'Gradient Angle', 'gravisain' ),
			'section'         => 'gravisain_header_top_row',
			'priority'        => 43,
			'default'         => '135deg',
			'units'           => [ 'deg' ],
			'input_attrs'     => [
				'deg' => [ 'min' => 0, 'max' => 360, 'step' => 1 ],
			],
			'wrapper_attrs'   => [ 'data-tab' => 'style' ],
			'active_callback' => $top_grad_cb,
		] ) );

		// Text Color
		$wp_customize->add_setting( 'gravisain_header_top_text_color', [
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_top_text_color', [
			'label'         => __( 'Text Color', 'gravisain' ),
			'section'       => 'gravisain_header_top_row',
			'priority'      => 50,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Link Color
		$wp_customize->add_setting( 'gravisain_header_top_link_color', [
			'default'           => '#0073aa',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_top_link_color', [
			'label'         => __( 'Link Color', 'gravisain' ),
			'section'       => 'gravisain_header_top_row',
			'priority'      => 60,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Link Hover Color
		$wp_customize->add_setting( 'gravisain_header_top_link_hover_color', [
			'default'           => '#005177',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_top_link_hover_color', [
			'label'         => __( 'Link Hover Color', 'gravisain' ),
			'section'       => 'gravisain_header_top_row',
			'priority'      => 70,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Border Bottom Color
		$wp_customize->add_setting( 'gravisain_header_top_border_color', [
			'default'           => '#e2e8f0',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_top_border_color', [
			'label'         => __( 'Border Bottom Color', 'gravisain' ),
			'section'       => 'gravisain_header_top_row',
			'priority'      => 80,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Setup Selective Refresh for Top Row
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'gravisain_header_top_row', [
				'selector'            => '.site-header-top-row',
				'settings'            => [
					'gravisain_header_top_visibility',
				],
				'render_callback'     => function() {
					get_template_part( 'template-parts/header/top-row' );
				},
				'container_inclusive' => false,
				'fallback_refresh'    => false,
			] );
		}
	}
}
