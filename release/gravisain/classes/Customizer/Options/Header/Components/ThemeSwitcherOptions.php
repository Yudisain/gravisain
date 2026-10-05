<?php
/**
 * Theme Switcher Component Options
 *
 * @package Gravisain\Customizer\Options\Header\Components
 */

declare(strict_types=1);

namespace Gravisain\Customizer\Options\Header\Components;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use WP_Customize_Manager;
use Gravisain\Customizer\Options\ComponentOptionInterface;
use Gravisain\Customizer\Controls\VisibilityControl;

/**
 * ThemeSwitcherOptions Class
 */
class ThemeSwitcherOptions implements ComponentOptionInterface {

	/**
	 * Register component options in Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( WP_Customize_Manager $wp_customize ): void {

		// Section: Theme Switcher
		$wp_customize->add_section( 'gravisain_header_theme_switcher', [
			'title'    => __( 'Theme Switcher', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 47,
		] );

		// Switcher Style: Dropdown (Light/Dark/System) vs Simple Toggle (Light/Dark)
		$wp_customize->add_setting( 'gravisain_header_theme_switcher_style', [
			'default'           => 'dropdown',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_theme_switcher_style', [
			'label'       => __( 'Switcher Type', 'gravisain' ),
			'description' => __( 'Choose between Dropdown menu, Direct icon toggle, or Sliding switch (pill/iOS style).', 'gravisain' ),
			'section'     => 'gravisain_header_theme_switcher',
			'type'        => 'select',
			'choices'     => [
				'dropdown' => __( 'Dropdown Menu (Light / Dark / System)', 'gravisain' ),
				'toggle'   => __( 'Direct Icon Toggle (Light / Dark)', 'gravisain' ),
				'switch'   => __( 'Sliding Switch (Pill / iOS Style)', 'gravisain' ),
			],
		] );

		// Default Theme Mode
		$wp_customize->add_setting( 'gravisain_header_theme_switcher_default', [
			'default'           => 'system',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_theme_switcher_default', [
			'label'       => __( 'Default Preference', 'gravisain' ),
			'description' => __( 'Default mode applied for first-time visitors before they make a selection.', 'gravisain' ),
			'section'     => 'gravisain_header_theme_switcher',
			'type'        => 'select',
			'choices'     => [
				'system' => __( 'System (Follow User Device)', 'gravisain' ),
				'light'  => __( 'Light Mode', 'gravisain' ),
				'dark'   => __( 'Dark Mode', 'gravisain' ),
			],
		] );

		// Show Label
		$wp_customize->add_setting( 'gravisain_header_theme_switcher_show_label', [
			'default'           => false,
			'sanitize_callback' => 'wp_validate_boolean',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_theme_switcher_show_label', [
			'label'       => __( 'Display Text Label', 'gravisain' ),
			'description' => __( 'Show "Theme" or active mode label next to the button icon.', 'gravisain' ),
			'section'     => 'gravisain_header_theme_switcher',
			'type'        => 'checkbox',
		] );

		// --- Color Customization Controls ---

		// Background / Track Color
		$wp_customize->add_setting( 'gravisain_header_theme_switcher_bg_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_theme_switcher_bg_color', [
			'label'       => __( 'Background / Track Color', 'gravisain' ),
			'description' => __( 'Custom background color for toggle button or slider track.', 'gravisain' ),
			'section'     => 'gravisain_header_theme_switcher',
		] ) );

		// Background Hover Color
		$wp_customize->add_setting( 'gravisain_header_theme_switcher_bg_color_hover', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_theme_switcher_bg_color_hover', [
			'label'   => __( 'Background Hover Color', 'gravisain' ),
			'section' => 'gravisain_header_theme_switcher',
		] ) );

		// Icon / Text Color
		$wp_customize->add_setting( 'gravisain_header_theme_switcher_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_theme_switcher_color', [
			'label'       => __( 'Icon & Label Color', 'gravisain' ),
			'description' => __( 'Custom text and icon color for theme switcher.', 'gravisain' ),
			'section'     => 'gravisain_header_theme_switcher',
		] ) );

		// Icon / Text Hover Color
		$wp_customize->add_setting( 'gravisain_header_theme_switcher_color_hover', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_theme_switcher_color_hover', [
			'label'   => __( 'Icon & Label Hover Color', 'gravisain' ),
			'section' => 'gravisain_header_theme_switcher',
		] ) );

		// Border Color
		$wp_customize->add_setting( 'gravisain_header_theme_switcher_border_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_theme_switcher_border_color', [
			'label'       => __( 'Border Color', 'gravisain' ),
			'description' => __( 'Custom border color for button or switch track.', 'gravisain' ),
			'section'     => 'gravisain_header_theme_switcher',
		] ) );

		// Sliding Switch Knob / Thumb Color
		$wp_customize->add_setting( 'gravisain_header_theme_switcher_thumb_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_theme_switcher_thumb_color', [
			'label'       => __( 'Sliding Switch Thumb Color', 'gravisain' ),
			'description' => __( 'Applies to the circular knob when using the Sliding Switch style.', 'gravisain' ),
			'section'     => 'gravisain_header_theme_switcher',
		] ) );

		// Visibility Control
		$wp_customize->add_setting( 'gravisain_header_theme_switcher_visibility', [
			'default'           => 'desktop,tablet,mobile',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new VisibilityControl( $wp_customize, 'gravisain_header_theme_switcher_visibility', [
			'label'   => __( 'Visibility', 'gravisain' ),
			'section' => 'gravisain_header_theme_switcher',
		] ) );
	}
}
