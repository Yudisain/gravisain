<?php
/**
 * Off-Canvas Drawer Component Options
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
use Gravisain\Customizer\Controls\ColorGroupControl;
use Gravisain\Customizer\Controls\TypographyControl;
use Gravisain\Customizer\Controls\SliderControl;

/**
 * OffCanvasOptions Class
 */
class OffCanvasOptions implements ComponentOptionInterface {

	/**
	 * Register component options in Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( WP_Customize_Manager $wp_customize ): void {

		$wp_customize->add_section( 'gravisain_header_offcanvas', [
			'title'    => __( 'Off-Canvas Drawer', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 33,
		] );

		$wp_customize->add_setting( 'gravisain_offcanvas_direction', [
			'default'           => 'right',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_offcanvas_direction', [
			'label'   => __( 'Slide Direction', 'gravisain' ),
			'section' => 'gravisain_header_offcanvas',
			'type'    => 'select',
			'choices' => [
				'right'      => __( 'Slide from Right', 'gravisain' ),
				'left'       => __( 'Slide from Left', 'gravisain' ),
				'push-left'  => __( 'Push Body From Left', 'gravisain' ),
				'push-right' => __( 'Push Body From Right', 'gravisain' ),
				'top'        => __( 'Slide from Top', 'gravisain' ),
				'push-top'   => __( 'Push Body From Top', 'gravisain' ),
			],
		] );

		// Off-Canvas Width (Responsive Slider: %, px, vw).
		$wp_customize->add_setting( 'gravisain_offcanvas_width', [
			'default'           => '{"desktop":"380px","tablet":"380px","mobile":"100%"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_offcanvas_width', [
			'label'         => __( 'Drawer Width', 'gravisain' ),
			'description'   => __( 'Set side drawer width (e.g. 50% for half, 33% for third, 25% for quarter, or in px). Works for slide and push body.', 'gravisain' ),
			'section'       => 'gravisain_header_offcanvas',
			'priority'      => 14,
			'responsive'    => true,
			'units'         => [ '%', 'px', 'vw' ],
			'input_attrs'   => [
				'%'   => [ 'min' => 15, 'max' => 100, 'step' => 1 ],
				'px'  => [ 'min' => 150, 'max' => 1200, 'step' => 10 ],
				'vw'  => [ 'min' => 15, 'max' => 100, 'step' => 1 ],
			],
		] ) );

		// 1. Off-Canvas Colors.
		$wp_customize->add_setting( 'gravisain_header_offcanvas_colors', [
			'default'           => '{"initial":"","hover":"","active":""}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ColorGroupControl( $wp_customize, 'gravisain_header_offcanvas_colors', [
			'label'         => __( 'Menu Colors', 'gravisain' ),
			'section'       => 'gravisain_header_offcanvas',
			'priority'      => 15,
			'fields'        => [
				'initial' => __( 'Initial Color', 'gravisain' ),
				'hover'   => __( 'Hover Color', 'gravisain' ),
				'active'  => __( 'Active Color', 'gravisain' ),
			],
		] ) );

		// 2. Off-Canvas Background.
		$wp_customize->add_setting( 'gravisain_header_offcanvas_background', [
			'default'           => '{"initial":"","hover":"","active":""}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ColorGroupControl( $wp_customize, 'gravisain_header_offcanvas_background', [
			'label'         => __( 'Drawer Background', 'gravisain' ),
			'section'       => 'gravisain_header_offcanvas',
			'priority'      => 18,
			'fields'        => [
				'initial' => __( 'Background Color', 'gravisain' ),
			],
		] ) );

		// 3. Off-Canvas Navigation Font.
		$wp_customize->add_setting( 'gravisain_header_offcanvas_font', [
			'default'           => '{"family":"inherit","style":"normal","size":"16"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new TypographyControl( $wp_customize, 'gravisain_header_offcanvas_font', [
			'label'         => __( 'Off-Canvas Menu Font', 'gravisain' ),
			'section'       => 'gravisain_header_offcanvas',
			'priority'      => 20,
			'preview_text'  => __( 'Everything based on your mindset', 'gravisain' ),
		] ) );
	}
}
