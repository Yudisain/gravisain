<?php
/**
 * Menu Trigger (Hamburger) Component Options
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
use Gravisain\Customizer\Controls\ShortcutControl;

/**
 * MenuTriggerOptions Class
 */
class MenuTriggerOptions implements ComponentOptionInterface {

	/**
	 * Register component options in Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( WP_Customize_Manager $wp_customize ): void {

		$wp_customize->add_section( 'gravisain_header_menu_trigger', [
			'title'    => __( 'Menu Trigger (Hamburger)', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 34,
		] );

		$wp_customize->add_setting( 'gravisain_header_trigger_style', [
			'default'           => '3-lines',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_trigger_style', [
			'label'   => __( 'Icon Style', 'gravisain' ),
			'section' => 'gravisain_header_menu_trigger',
			'type'    => 'select',
			'choices' => [
				'3-lines' => __( '3 Lines (Standard)', 'gravisain' ),
				'2-lines' => __( '2 Lines (Modern)', 'gravisain' ),
				'dots'    => __( '3 Dots', 'gravisain' ),
			],
		] );

		$wp_customize->add_setting( 'gravisain_header_trigger_label', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_trigger_label', [
			'label'   => __( 'Trigger Label Text', 'gravisain' ),
			'section' => 'gravisain_header_menu_trigger',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'gravisain_header_trigger_target_menu', [
			'default'           => 'primary',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_trigger_target_menu', [
			'label'   => __( 'Menu to Display in Drawer', 'gravisain' ),
			'section' => 'gravisain_header_menu_trigger',
			'type'    => 'select',
			'choices' => [
				'primary'   => __( 'Primary Navigation', 'gravisain' ),
				'secondary' => __( 'Secondary Navigation', 'gravisain' ),
				'both'      => __( 'Both Primary & Secondary', 'gravisain' ),
			],
		] );

		// Shortcut to Off-Canvas Drawer Section.
		$wp_customize->add_setting( 'gravisain_header_trigger_offcanvas_shortcut', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		] );

		$wp_customize->add_control( new ShortcutControl( $wp_customize, 'gravisain_header_trigger_offcanvas_shortcut', [
			'label'          => __( 'Off-Canvas Drawer Settings', 'gravisain' ),
			'description'    => __( 'Configure slide direction, push body animation, responsive drawer width (50%, 33%, 25%, etc.), and drawer styling.', 'gravisain' ),
			'button_text'    => __( 'Configure Off-Canvas Drawer', 'gravisain' ),
			'target_section' => 'gravisain_header_offcanvas',
			'section'        => 'gravisain_header_menu_trigger',
		] ) );

		$wp_customize->add_setting( 'gravisain_header_trigger_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_trigger_color', [
			'label'   => __( 'Trigger Color', 'gravisain' ),
			'section' => 'gravisain_header_menu_trigger',
		] ) );

		$wp_customize->add_setting( 'gravisain_header_trigger_color_hover', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_trigger_color_hover', [
			'label'   => __( 'Trigger Hover Color', 'gravisain' ),
			'section' => 'gravisain_header_menu_trigger',
		] ) );

		$wp_customize->add_setting( 'gravisain_header_trigger_bg_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_trigger_bg_color', [
			'label'   => __( 'Trigger Background Color', 'gravisain' ),
			'section' => 'gravisain_header_menu_trigger',
		] ) );

		$wp_customize->add_setting( 'gravisain_header_trigger_bg_color_hover', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_header_trigger_bg_color_hover', [
			'label'   => __( 'Trigger Background Hover Color', 'gravisain' ),
			'section' => 'gravisain_header_menu_trigger',
		] ) );

		$wp_customize->add_setting( 'gravisain_header_trigger_visibility', [
			'default'           => 'desktop,tablet,mobile',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new VisibilityControl( $wp_customize, 'gravisain_header_trigger_visibility', [
			'label'   => __( 'Visibility (Device Display)', 'gravisain' ),
			'section' => 'gravisain_header_menu_trigger',
		] ) );
	}
}
