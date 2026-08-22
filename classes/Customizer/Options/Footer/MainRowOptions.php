<?php
/**
 * Main Row Footer Options
 *
 * @package Gravisain\Customizer\Options\Footer
 */

namespace Gravisain\Customizer\Options\Footer;

use Gravisain\Customizer\Controls\SectionTabsControl;
use Gravisain\Customizer\Controls\VisibilityControl;

class MainRowOptions {
	public function register( $wp_customize ): void {
		$wp_customize->add_section( 'gravisain_footer_main_row', [
			'title'    => __( 'Main Footer Row (Widgets)', 'gravisain' ),
			'panel'    => 'gravisain_footer_panel',
			'priority' => 20,
		] );

		// 1. Section Tabs (Layout vs Style)
		$wp_customize->add_setting( 'gravisain_footer_main_tabs', [
			'default'           => 'layout',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SectionTabsControl( $wp_customize, 'gravisain_footer_main_tabs', [
			'section'  => 'gravisain_footer_main_row',
			'priority' => 1,
		] ) );

		// --- LAYOUT TAB CONTROLS ---

		// Columns Count (Dropdown)
		$wp_customize->add_setting( 'gravisain_footer_main_columns', [
			'default'           => 4,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_footer_main_columns', [
			'type'          => 'select',
			'label'         => __( 'Number of Columns', 'gravisain' ),
			'section'       => 'gravisain_footer_main_row',
			'priority'      => 5,
			'choices'       => [
				1 => __( '1 Column', 'gravisain' ),
				2 => __( '2 Columns', 'gravisain' ),
				3 => __( '3 Columns', 'gravisain' ),
				4 => __( '4 Columns', 'gravisain' ),
			],
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] );

		// Row Layout (Dropdown)
		$wp_customize->add_setting( 'gravisain_footer_main_layout', [
			'default'           => 'full-contained',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( 'gravisain_footer_main_layout', [
			'type'          => 'select',
			'label'         => __( 'Row Layout', 'gravisain' ),
			'section'       => 'gravisain_footer_main_row',
			'priority'      => 10,
			'choices'       => [
				'full-contained' => __( 'Full Width - Contained', 'gravisain' ),
				'full-width'     => __( 'Full Width', 'gravisain' ),
				'contained'      => __( 'Contained', 'gravisain' ),
			],
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] );

		// Device Visibility
		$wp_customize->add_setting( 'gravisain_footer_main_visibility', [
			'default'           => 'desktop,tablet,mobile',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new VisibilityControl( $wp_customize, 'gravisain_footer_main_visibility', [
			'label'         => __( 'Device Visibility', 'gravisain' ),
			'section'       => 'gravisain_footer_main_row',
			'priority'      => 30,
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		// --- STYLE TAB CONTROLS ---

		// Background Color
		$wp_customize->add_setting( 'gravisain_footer_main_bg_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_footer_main_bg_color', [
			'label'         => __( 'Background Color', 'gravisain' ),
			'section'       => 'gravisain_footer_main_row',
			'priority'      => 40,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Text Color
		$wp_customize->add_setting( 'gravisain_footer_main_text_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_footer_main_text_color', [
			'label'         => __( 'Text Color', 'gravisain' ),
			'section'       => 'gravisain_footer_main_row',
			'priority'      => 50,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );
	}
}
