<?php
/**
 * Action Button Component Options
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
use Gravisain\Customizer\Controls\SectionTabsControl;
use Gravisain\Customizer\Controls\VisibilityControl;
use Gravisain\Customizer\Controls\ButtonGroupControl;
use Gravisain\Customizer\Controls\SpacingControl;
use Gravisain\Customizer\Controls\TypographyControl;
use Gravisain\Customizer\Controls\ColorGroupControl;
use Gravisain\Customizer\Controls\SliderControl;

/**
 * ActionButtonOptions Class
 */
class ActionButtonOptions implements ComponentOptionInterface {

	/**
	 * Register component options in Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( WP_Customize_Manager $wp_customize ): void {

		$wp_customize->add_section( 'gravisain_header_action_button', [
			'title'    => __( 'Action Button', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 41,
		] );

		// Section Tabs (Layout vs Style).
		$wp_customize->add_setting( 'gravisain_header_action_button_tabs', [
			'default'           => 'layout',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SectionTabsControl( $wp_customize, 'gravisain_header_action_button_tabs', [
			'section'  => 'gravisain_header_action_button',
			'priority' => 1,
			'tabs'     => [
				'layout' => __( 'LAYOUT', 'gravisain' ),
				'style'  => __( 'STYLE', 'gravisain' ),
			],
		] ) );

		$wp_customize->add_setting( 'gravisain_header_button_text', [
			'default'           => __( 'Get Started', 'gravisain' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_button_text', [
			'label'         => __( 'Button Text', 'gravisain' ),
			'section'       => 'gravisain_header_action_button',
			'type'          => 'text',
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] );

		$wp_customize->add_setting( 'gravisain_header_button_url', [
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_button_url', [
			'label'         => __( 'Button URL', 'gravisain' ),
			'section'       => 'gravisain_header_action_button',
			'type'          => 'url',
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] );

		$wp_customize->add_setting( 'gravisain_header_button_target', [
			'default'           => false,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_button_target', [
			'label'         => __( 'Open in new tab', 'gravisain' ),
			'section'       => 'gravisain_header_action_button',
			'type'          => 'checkbox',
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] );

		// Device Visibility.
		$wp_customize->add_setting( 'gravisain_header_button_visibility', [
			'default'           => 'desktop,tablet,mobile',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new VisibilityControl( $wp_customize, 'gravisain_header_button_visibility', [
			'label'         => __( 'Device Visibility', 'gravisain' ),
			'section'       => 'gravisain_header_action_button',
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		$wp_customize->add_setting( 'gravisain_header_button_style', [
			'default'           => 'fill',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_button_style', [
			'label'         => __( 'Button Style', 'gravisain' ),
			'section'       => 'gravisain_header_action_button',
			'type'          => 'select',
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'choices'       => [
				'fill'    => __( 'Filled', 'gravisain' ),
				'outline' => __( 'Outline', 'gravisain' ),
			],
		] );

		$wp_customize->add_setting( 'gravisain_header_button_size', [
			'default'           => 'md',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ButtonGroupControl( $wp_customize, 'gravisain_header_button_size', [
			'label'         => __( 'Button Size', 'gravisain' ),
			'section'       => 'gravisain_header_action_button',
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'choices'       => [
				'sm'     => __( 'SM', 'gravisain' ),
				'md'     => __( 'MD', 'gravisain' ),
				'lg'     => __( 'LG', 'gravisain' ),
				'custom' => __( 'Custom', 'gravisain' ),
			],
		] ) );

		$wp_customize->add_setting( 'gravisain_header_button_custom_padding', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SpacingControl( $wp_customize, 'gravisain_header_button_custom_padding', [
			'label'         => __( 'Padding', 'gravisain' ),
			'section'       => 'gravisain_header_action_button',
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Action Button Typography.
		$wp_customize->add_setting( 'gravisain_header_button_font', [
			'default'           => '{"family":"inherit","style":"600","size":""}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new TypographyControl( $wp_customize, 'gravisain_header_button_font', [
			'label'         => __( 'Button Typography', 'gravisain' ),
			'section'       => 'gravisain_header_action_button',
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'preview_text'  => __( 'Get Started', 'gravisain' ),
		] ) );

		// Button Colors.
		$wp_customize->add_setting( 'gravisain_header_button_font_colors', [
			'default'           => '{"initial":"","hover":""}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ColorGroupControl( $wp_customize, 'gravisain_header_button_font_colors', [
			'label'         => __( 'Font Color', 'gravisain' ),
			'section'       => 'gravisain_header_action_button',
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'fields'        => [
				'initial' => __( 'Initial', 'gravisain' ),
				'hover'   => __( 'Hover', 'gravisain' ),
			],
		] ) );

		$wp_customize->add_setting( 'gravisain_header_button_bg_colors', [
			'default'           => '{"initial":"","hover":""}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ColorGroupControl( $wp_customize, 'gravisain_header_button_bg_colors', [
			'label'         => __( 'Background Color', 'gravisain' ),
			'section'       => 'gravisain_header_action_button',
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'fields'        => [
				'initial' => __( 'Initial', 'gravisain' ),
				'hover'   => __( 'Hover', 'gravisain' ),
			],
		] ) );

		$wp_customize->add_setting( 'gravisain_header_button_border_colors', [
			'default'           => '{"initial":"","hover":""}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ColorGroupControl( $wp_customize, 'gravisain_header_button_border_colors', [
			'label'         => __( 'Border Color', 'gravisain' ),
			'section'       => 'gravisain_header_action_button',
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'fields'        => [
				'initial' => __( 'Initial', 'gravisain' ),
				'hover'   => __( 'Hover', 'gravisain' ),
			],
		] ) );

		$wp_customize->add_setting( 'gravisain_header_button_border_style', [
			'default'           => 'none',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ButtonGroupControl( $wp_customize, 'gravisain_header_button_border_style', [
			'label'         => __( 'Border Style', 'gravisain' ),
			'section'       => 'gravisain_header_action_button',
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'choices'       => [
				'none'   => 'X',
				'solid'  => '-',
				'dashed' => '---',
				'dotted' => '...',
				'double' => '=',
			],
		] ) );

		$wp_customize->add_setting( 'gravisain_header_button_border_width', [
			'default'           => '2px', // The SliderControl returns value+unit.
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_header_button_border_width', [
			'label'         => __( 'Border Width', 'gravisain' ),
			'section'       => 'gravisain_header_action_button',
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'units'         => [ 'px', 'em', 'rem' ],
			'input_attrs'   => [
				'px'  => [ 'min' => 0, 'max' => 20, 'step' => 1 ],
				'em'  => [ 'min' => 0, 'max' => 5, 'step' => 0.1 ],
				'rem' => [ 'min' => 0, 'max' => 5, 'step' => 0.1 ],
			],
			'default'       => '2px',
		] ) );
	}
}
