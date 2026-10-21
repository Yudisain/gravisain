<?php
/**
 * General & UX Options for Customizer
 *
 * @package Gravisain\Customizer\Options
 */

declare(strict_types=1);

namespace Gravisain\Customizer\Options;

use Gravisain\Customizer\Controls\ButtonGroupControl;
use Gravisain\Customizer\Controls\SliderControl;
use Gravisain\Customizer\Sections\HeadingSection;
use Gravisain\Customizer\Sanitize;

class GeneralOptions {

	/**
	 * Register General & UX Panel and Sub-Sections.
	 *
	 * @param \WP_Customize_Manager $wp_customize Customizer manager.
	 * @return void
	 */
	public function register( $wp_customize ): void {
		// 1. Register Dedicated General Panel
		$wp_customize->add_panel( 'gravisain_general_panel', [
			'title'       => __( 'General Settings & UX', 'gravisain' ),
			'description' => __( 'Configure universal interactive UX components and reading enhancements across your site.', 'gravisain' ),
			'priority'    => 45,
		] );

		// 2. Group Heading: Interactive UX & Scroll
		$wp_customize->add_section( new HeadingSection( $wp_customize, 'gravisain_general_heading_interactive', [
			'title'    => __( 'Interactive UX & Scroll', 'gravisain' ),
			'panel'    => 'gravisain_general_panel',
			'priority' => 5,
		] ) );

		// 2.5 Sub-Section: Smooth Scroll
		$wp_customize->add_section( 'gravisain_smooth_scroll_section', [
			'title'       => __( 'Smooth Scroll', 'gravisain' ),
			'description' => __( 'Configure smooth scrolling animations and header clearance for in-page anchor links (e.g., #blocks).', 'gravisain' ),
			'panel'       => 'gravisain_general_panel',
			'priority'    => 8,
		] );

		// 3. Sub-Section: Scroll to Top
		$wp_customize->add_section( 'gravisain_scroll_top_section', [
			'title'       => __( 'Scroll to Top', 'gravisain' ),
			'description' => __( 'Configure the floating back-to-top button with circular scroll progress ring.', 'gravisain' ),
			'panel'       => 'gravisain_general_panel',
			'priority'    => 10,
		] );

		// 4. Group Heading: Media & Content
		$wp_customize->add_section( new HeadingSection( $wp_customize, 'gravisain_general_heading_media', [
			'title'    => __( 'Media & Content', 'gravisain' ),
			'panel'    => 'gravisain_general_panel',
			'priority' => 30,
		] ) );

		// 5. Sub-Section: Reading Progress Bar
		$wp_customize->add_section( 'gravisain_reading_progress_section', [
			'title'       => __( 'Reading Progress Bar', 'gravisain' ),
			'description' => __( 'Configure reading progress indicator on single post articles.', 'gravisain' ),
			'panel'       => 'gravisain_general_panel',
			'priority'    => 40,
		] );

		/* -------------------------------------------------------------------------
		 * SECTION 0: SMOOTH SCROLL CONTROLS
		 * ------------------------------------------------------------------------- */

		// 0.1 Enable Smooth Scroll
		$wp_customize->add_setting( 'gravisain_enable_smooth_scroll', [
			'default'           => true,
			'sanitize_callback' => [ Sanitize::class, 'checkbox' ],
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( 'gravisain_enable_smooth_scroll', [
			'label'       => __( 'Enable Smooth Scroll', 'gravisain' ),
			'description' => __( 'Smoothly animates scrolling when clicking in-page anchor links like #blocks or header menu anchors.', 'gravisain' ),
			'section'     => 'gravisain_smooth_scroll_section',
			'settings'    => 'gravisain_enable_smooth_scroll',
			'type'        => 'checkbox',
		] );

		// 0.2 Smooth Scroll Offset (Header Clearance)
		$wp_customize->add_setting( 'gravisain_smooth_scroll_offset', [
			'default'           => 80,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( 'gravisain_smooth_scroll_offset', [
			'label'           => __( 'Scroll Offset / Header Clearance (px)', 'gravisain' ),
			'description'     => __( 'Top offset spacing in pixels so sticky headers do not cover your anchor content.', 'gravisain' ),
			'section'         => 'gravisain_smooth_scroll_section',
			'settings'        => 'gravisain_smooth_scroll_offset',
			'type'            => 'number',
			'input_attrs'     => [
				'min'  => 0,
				'max'  => 300,
				'step' => 5,
			],
			'active_callback' => function() {
				return get_theme_mod( 'gravisain_enable_smooth_scroll', true );
			},
		] );

		/* -------------------------------------------------------------------------
		 * SECTION 1: SCROLL TO TOP CONTROLS
		 * ------------------------------------------------------------------------- */

		// 1.1 Enable Scroll to Top Button
		$wp_customize->add_setting( 'gravisain_enable_scroll_top', [
			'default'           => true,
			'sanitize_callback' => [ Sanitize::class, 'checkbox' ],
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_enable_scroll_top', [
			'label'       => __( 'Enable Scroll to Top Button', 'gravisain' ),
			'description' => __( 'Displays a floating back-to-top button with a scroll progress ring when scrolling down.', 'gravisain' ),
			'section'     => 'gravisain_scroll_top_section',
			'settings'    => 'gravisain_enable_scroll_top',
			'type'        => 'checkbox',
		] );

		$scroll_top_active_callback = function() {
			return get_theme_mod( 'gravisain_enable_scroll_top', true );
		};

		// 1.2 Position
		$wp_customize->add_setting( 'gravisain_scroll_top_position', [
			'default'           => 'right',
			'sanitize_callback' => [ Sanitize::class, 'select' ],
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ButtonGroupControl( $wp_customize, 'gravisain_scroll_top_position', [
			'label'           => __( 'Scroll to Top Position', 'gravisain' ),
			'description'     => __( 'Choose whether the button appears on the left or right side of the screen.', 'gravisain' ),
			'section'         => 'gravisain_scroll_top_section',
			'settings'        => 'gravisain_scroll_top_position',
			'active_callback' => $scroll_top_active_callback,
			'choices'         => [
				'left'  => __( 'Left', 'gravisain' ),
				'right' => __( 'Right', 'gravisain' ),
			],
		] ) );

		// 1.3 Icon Size
		$wp_customize->add_setting( 'gravisain_scroll_top_icon_size', [
			'default'           => '{"desktop":"18px","tablet":"16px","mobile":"16px"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_scroll_top_icon_size', [
			'label'           => __( 'Scroll to Top Icon Size', 'gravisain' ),
			'description'     => __( 'Adjust the size of the floating back-to-top button container and icon proportionally across devices.', 'gravisain' ),
			'section'         => 'gravisain_scroll_top_section',
			'settings'        => 'gravisain_scroll_top_icon_size',
			'active_callback' => $scroll_top_active_callback,
			'responsive'      => true,
			'units'           => [ 'px', 'em', 'rem' ],
			'input_attrs'     => [
				'px'  => [ 'min' => 10, 'max' => 50, 'step' => 1 ],
				'em'  => [ 'min' => 0.8, 'max' => 3.5, 'step' => 0.1 ],
				'rem' => [ 'min' => 0.8, 'max' => 3.5, 'step' => 0.1 ],
			],
		] ) );

		// 1.4 Side Offset
		$wp_customize->add_setting( 'gravisain_scroll_top_side_offset', [
			'default'           => '{"desktop":"2rem","tablet":"1.5rem","mobile":"1rem"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_scroll_top_side_offset', [
			'label'           => __( 'Scroll to Top Side Offset', 'gravisain' ),
			'description'     => __( 'Adjust distance from the left or right edge of the screen.', 'gravisain' ),
			'section'         => 'gravisain_scroll_top_section',
			'settings'        => 'gravisain_scroll_top_side_offset',
			'active_callback' => $scroll_top_active_callback,
			'responsive'      => true,
			'units'           => [ 'rem', 'px', '%' ],
			'input_attrs'     => [
				'rem' => [ 'min' => 0, 'max' => 10, 'step' => 0.1 ],
				'px'  => [ 'min' => 0, 'max' => 150, 'step' => 1 ],
				'%'   => [ 'min' => 0, 'max' => 50, 'step' => 1 ],
			],
		] ) );

		// 1.5 Bottom Offset
		$wp_customize->add_setting( 'gravisain_scroll_top_bottom_offset', [
			'default'           => '{"desktop":"2rem","tablet":"1.5rem","mobile":"1rem"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_scroll_top_bottom_offset', [
			'label'           => __( 'Scroll to Top Bottom Offset', 'gravisain' ),
			'description'     => __( 'Adjust distance from the bottom edge of the screen.', 'gravisain' ),
			'section'         => 'gravisain_scroll_top_section',
			'settings'        => 'gravisain_scroll_top_bottom_offset',
			'active_callback' => $scroll_top_active_callback,
			'responsive'      => true,
			'units'           => [ 'rem', 'px', '%' ],
			'input_attrs'     => [
				'rem' => [ 'min' => 0, 'max' => 10, 'step' => 0.1 ],
				'px'  => [ 'min' => 0, 'max' => 150, 'step' => 1 ],
				'%'   => [ 'min' => 0, 'max' => 50, 'step' => 1 ],
			],
		] ) );

		/* -------------------------------------------------------------------------
		 * SECTION 2: READING PROGRESS BAR CONTROLS
		 * ------------------------------------------------------------------------- */

		// 2.1 Reading Progress Bar
		$wp_customize->add_setting( 'gravisain_enable_reading_progress', [
			'default'           => true,
			'sanitize_callback' => [ Sanitize::class, 'checkbox' ],
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_enable_reading_progress', [
			'label'       => __( 'Enable Reading Progress Bar on Single Posts', 'gravisain' ),
			'description' => __( 'Displays a gradient horizontal reading progress bar fixed at the top of single post articles.', 'gravisain' ),
			'section'     => 'gravisain_reading_progress_section',
			'settings'    => 'gravisain_enable_reading_progress',
			'type'        => 'checkbox',
		] );
	}
}
