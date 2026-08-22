<?php
/**
 * Page Header & Breadcrumbs Options Panel for Customizer
 *
 * @package Gravisain\Customizer\Options
 */

namespace Gravisain\Customizer\Options;

class PageHeaderOptions {

	/**
	 * Register Page Header Customizer options.
	 *
	 * @param \WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( $wp_customize ): void {
		$wp_customize->add_section( 'gravisain_page_header_section', [
			'title'    => __( 'Page Header / Hero Area', 'gravisain' ),
			'priority' => 55,
		] );

		// Layout Setting
		$wp_customize->add_setting( 'gravisain_page_header_layout', [
			'default'           => 'above_content',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_page_header_layout', [
			'label'   => __( 'Page Title Layout', 'gravisain' ),
			'section' => 'gravisain_page_header_section',
			'type'    => 'select',
			'choices' => [
				'above_content' => __( 'Above Content (Hero Banner Area)', 'gravisain' ),
				'in_content'    => __( 'In Content (Standard Title)', 'gravisain' ),
				'disabled'      => __( 'Disabled / Hidden', 'gravisain' ),
			],
		] );

		// Text Alignment
		$wp_customize->add_setting( 'gravisain_page_header_alignment', [
			'default'           => 'center',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_page_header_alignment', [
			'label'   => __( 'Text Alignment', 'gravisain' ),
			'section' => 'gravisain_page_header_section',
			'type'    => 'select',
			'choices' => [
				'left'   => __( 'Left Align', 'gravisain' ),
				'center' => __( 'Center Align', 'gravisain' ),
				'right'  => __( 'Right Align', 'gravisain' ),
			],
		] );

		// Background Style
		$wp_customize->add_setting( 'gravisain_page_header_bg_type', [
			'default'           => 'gradient',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_page_header_bg_type', [
			'label'   => __( 'Hero Background Style', 'gravisain' ),
			'section' => 'gravisain_page_header_section',
			'type'    => 'select',
			'choices' => [
				'solid'    => __( 'Solid Brand Background', 'gravisain' ),
				'gradient' => __( 'Modern Vibrant Gradient', 'gravisain' ),
				'featured' => __( 'Featured Image (with dark overlay)', 'gravisain' ),
			],
		] );

		// Breadcrumbs Position
		$wp_customize->add_setting( 'gravisain_page_header_breadcrumbs', [
			'default'           => 'below_title',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_page_header_breadcrumbs', [
			'label'   => __( 'Breadcrumbs Position', 'gravisain' ),
			'section' => 'gravisain_page_header_section',
			'type'    => 'select',
			'choices' => [
				'above_title' => __( 'Above Page Title', 'gravisain' ),
				'below_title' => __( 'Below Page Title', 'gravisain' ),
				'none'        => __( 'Hide Breadcrumbs', 'gravisain' ),
			],
		] );
	}
}
