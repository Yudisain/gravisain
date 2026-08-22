<?php
/**
 * Transparent Header Options for Customizer
 *
 * @package Gravisain\Customizer\Options
 */

namespace Gravisain\Customizer\Options;

class TransparentHeaderOptions {
	public function register( $wp_customize ): void {
		$wp_customize->add_section( 'gravisain_header_transparent', [
			'title'       => __( 'Transparent Header', 'gravisain' ),
			'panel'       => 'gravisain_header_panel',
			'priority'    => 12,
			'description' => __( 'Configure the transparent header settings. The transparent header will sit on top of your page content.', 'gravisain' ),
		] );

		// Enable Transparent Header Globally
		$wp_customize->add_setting( 'gravisain_transparent_header_enable', [
			'default'           => false,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_transparent_header_enable', [
			'label'   => __( 'Enable Transparent Header', 'gravisain' ),
			'section' => 'gravisain_header_transparent',
			'type'    => 'checkbox',
		] );

		// Disable on Archives
		$wp_customize->add_setting( 'gravisain_transparent_header_disable_archive', [
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_transparent_header_disable_archive', [
			'label'       => __( 'Disable on Archives', 'gravisain' ),
			'description' => __( 'Turn off transparent header on blog, category, and tag archives.', 'gravisain' ),
			'section'     => 'gravisain_header_transparent',
			'type'        => 'checkbox',
		] );

		// Disable on 404 & Search
		$wp_customize->add_setting( 'gravisain_transparent_header_disable_404', [
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_transparent_header_disable_404', [
			'label'       => __( 'Disable on 404 & Search', 'gravisain' ),
			'section'     => 'gravisain_header_transparent',
			'type'        => 'checkbox',
		] );

		// Transparent Logo
		$wp_customize->add_setting( 'gravisain_transparent_header_logo', [
			'default'           => '',
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Media_Control( $wp_customize, 'gravisain_transparent_header_logo', [
			'label'       => __( 'Transparent Logo', 'gravisain' ),
			'description' => __( 'Upload a specific logo to display when the transparent header is active (usually a light/white logo).', 'gravisain' ),
			'section'     => 'gravisain_header_transparent',
			'mime_type'   => 'image',
		] ) );

		// Background Overlay
		$wp_customize->add_setting( 'gravisain_transparent_header_bg_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_transparent_header_bg_color', [
			'label'       => __( 'Background Overlay Color', 'gravisain' ),
			'description' => __( 'Choose overlay color for transparent header.', 'gravisain' ),
			'section'     => 'gravisain_header_transparent',
		] ) );

		// Border Bottom Width
		$wp_customize->add_setting( 'gravisain_transparent_header_border_width', [
			'default'           => '0',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_transparent_header_border_width', [
			'label'       => __( 'Bottom Border Width', 'gravisain' ),
			'section'     => 'gravisain_header_transparent',
			'type'        => 'select',
			'choices'     => [
				'0'   => __( 'None (0px)', 'gravisain' ),
				'1px' => __( '1px', 'gravisain' ),
				'2px' => __( '2px', 'gravisain' ),
				'3px' => __( '3px', 'gravisain' ),
			],
		] );

		// Border Bottom Color
		$wp_customize->add_setting( 'gravisain_transparent_header_border_color', [
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_transparent_header_border_color', [
			'label'       => __( 'Bottom Border Color', 'gravisain' ),
			'section'     => 'gravisain_header_transparent',
		] ) );

		// Navigation Text Color
		$wp_customize->add_setting( 'gravisain_transparent_header_text_color', [
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_transparent_header_text_color', [
			'label'   => __( 'Navigation Text Color', 'gravisain' ),
			'section' => 'gravisain_header_transparent',
		] ) );

		// Navigation Hover Color
		$wp_customize->add_setting( 'gravisain_transparent_header_text_hover_color', [
			'default'           => '#cccccc',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_transparent_header_text_hover_color', [
			'label'   => __( 'Navigation Text Hover Color', 'gravisain' ),
			'section' => 'gravisain_header_transparent',
		] ) );
	}
}
