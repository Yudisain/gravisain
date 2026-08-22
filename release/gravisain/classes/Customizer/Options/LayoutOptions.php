<?php
/**
 * Layout & Container Options for Customizer
 *
 * @package Gravisain\Customizer\Options
 */

namespace Gravisain\Customizer\Options;

use Gravisain\Customizer\Controls\SliderControl;

class LayoutOptions {
	/**
	 * Register Container & Layout options.
	 *
	 * @param \WP_Customize_Manager $wp_customize Instance of WP_Customize_Manager.
	 * @return void
	 */
	public function register( $wp_customize ): void {
		// Register Section
		$wp_customize->add_section( 'gravisain_layout', [
			'title'       => __( 'Container & Layouts', 'gravisain' ),
			'description' => __( 'Configure global container width, responsive spacing, and box styles.', 'gravisain' ),
			'panel'       => 'gravisain_options',
			'priority'    => 30,
		] );

		// 1. Container Max Width
		$wp_customize->add_setting( 'gravisain_content_width', [
			'default'           => 1200,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_content_width', [
			'label'       => __( 'Container Max Width', 'gravisain' ),
			'description' => __( 'Set the maximum width for the global site container.', 'gravisain' ),
			'section'     => 'gravisain_layout',
			'priority'    => 10,
			'responsive'  => false,
			'units'       => [ 'px', 'rem', '%' ],
			'input_attrs' => [
				'px'  => [ 'min' => 800, 'max' => 2000, 'step' => 10 ],
				'rem' => [ 'min' => 50, 'max' => 130, 'step' => 1 ],
				'%'   => [ 'min' => 50, 'max' => 100, 'step' => 1 ],
			],
		] ) );

		// 2. Content Top and Bottom Spacing
		$wp_customize->add_setting( 'gravisain_content_spacing_y', [
			'default'           => '{"desktop":"56","tablet":"40","mobile":"32"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_content_spacing_y', [
			'label'       => __( 'Content Top & Bottom Spacing', 'gravisain' ),
			'description' => __( 'Set vertical padding (top and bottom) for the main content area.', 'gravisain' ),
			'section'     => 'gravisain_layout',
			'priority'    => 20,
			'responsive'  => true,
			'units'       => [ 'px', 'rem', 'em' ],
			'input_attrs' => [
				'px'  => [ 'min' => 0, 'max' => 200, 'step' => 2 ],
				'rem' => [ 'min' => 0, 'max' => 15, 'step' => 0.25 ],
				'em'  => [ 'min' => 0, 'max' => 15, 'step' => 0.25 ],
			],
		] ) );

		// 3. Content Left/Right Edge Spacing
		$wp_customize->add_setting( 'gravisain_content_spacing_x', [
			'default'           => '{"desktop":"24","tablet":"20","mobile":"16"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_content_spacing_x', [
			'label'       => __( 'Content Left/Right Edge Spacing', 'gravisain' ),
			'description' => __( 'Set horizontal padding on the left and right edges of the container.', 'gravisain' ),
			'section'     => 'gravisain_layout',
			'priority'    => 30,
			'responsive'  => true,
			'units'       => [ 'px', 'rem', '%' ],
			'input_attrs' => [
				'px'  => [ 'min' => 0, 'max' => 100, 'step' => 2 ],
				'rem' => [ 'min' => 0, 'max' => 6, 'step' => 0.25 ],
				'%'   => [ 'min' => 0, 'max' => 15, 'step' => 1 ],
			],
		] ) );

		// 4. Default Container Style
		$wp_customize->add_setting( 'gravisain_default_container_style', [
			'default'           => 'full-width',
			'sanitize_callback' => [ __CLASS__, 'sanitize_container_style' ],
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_default_container_style', [
			'label'       => __( 'Default Container Style', 'gravisain' ),
			'description' => __( 'Select the default box style for content across the website.', 'gravisain' ),
			'section'     => 'gravisain_layout',
			'priority'    => 40,
			'type'        => 'select',
			'choices'     => [
				'full-width'           => __( 'Full Width / Unboxed (Flat)', 'gravisain' ),
				'full-width-stretched' => __( 'Full Width / Stretched (100% Screen Width)', 'gravisain' ),
				'contained'            => __( 'Contained / Boxed (Single Box)', 'gravisain' ),
				'separated'            => __( 'Contained Separated (Separate Cards)', 'gravisain' ),
			],
		] );

		// Page Sidebar Position (Default for Pages)
		$wp_customize->add_setting( 'gravisain_page_sidebar', [
			'default'           => 'none',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_page_sidebar', [
			'label'       => __( 'Default Page Sidebar Position', 'gravisain' ),
			'description' => __( 'Select the default sidebar layout for standard static pages.', 'gravisain' ),
			'section'     => 'gravisain_layout',
			'priority'    => 45,
			'type'        => 'select',
			'choices'     => [
				'none'  => __( 'No Sidebar (Full / Normal Width)', 'gravisain' ),
				'right' => __( 'Right Sidebar', 'gravisain' ),
				'left'  => __( 'Left Sidebar', 'gravisain' ),
			],
		] );

		// 5. Blog / Archive Container Style
		$wp_customize->add_setting( 'gravisain_archive_container_style', [
			'default'           => 'inherit',
			'sanitize_callback' => [ __CLASS__, 'sanitize_container_style' ],
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_archive_container_style', [
			'label'       => __( 'Blog / Archive Container Style', 'gravisain' ),
			'description' => __( 'Override container style specifically for blog indices and archives.', 'gravisain' ),
			'section'     => 'gravisain_layout',
			'priority'    => 50,
			'type'        => 'select',
			'choices'     => [
				'inherit'              => __( 'Inherit Default Style', 'gravisain' ),
				'full-width'           => __( 'Full Width / Unboxed', 'gravisain' ),
				'full-width-stretched' => __( 'Full Width / Stretched (100% Screen Width)', 'gravisain' ),
				'contained'            => __( 'Contained / Boxed', 'gravisain' ),
				'separated'            => __( 'Contained Separated', 'gravisain' ),
			],
		] );

		// 6. Single Post Container Style
		$wp_customize->add_setting( 'gravisain_single_container_style', [
			'default'           => 'inherit',
			'sanitize_callback' => [ __CLASS__, 'sanitize_container_style' ],
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_single_container_style', [
			'label'       => __( 'Single Post Container Style', 'gravisain' ),
			'description' => __( 'Override container style specifically for single posts and static pages.', 'gravisain' ),
			'section'     => 'gravisain_layout',
			'priority'    => 60,
			'type'        => 'select',
			'choices'     => [
				'inherit'              => __( 'Inherit Default Style', 'gravisain' ),
				'full-width'           => __( 'Full Width / Unboxed', 'gravisain' ),
				'full-width-stretched' => __( 'Full Width / Stretched (100% Screen Width)', 'gravisain' ),
				'contained'            => __( 'Contained / Boxed', 'gravisain' ),
				'separated'            => __( 'Contained Separated', 'gravisain' ),
			],
		] );
	}

	/**
	 * Sanitize container style selection.
	 *
	 * @param string $input Selected style.
	 * @return string
	 */
	public static function sanitize_container_style( $input ): string {
		$valid = [ 'inherit', 'full-width', 'full-width-stretched', 'contained', 'separated' ];
		return in_array( $input, $valid, true ) ? $input : 'inherit';
	}
}
