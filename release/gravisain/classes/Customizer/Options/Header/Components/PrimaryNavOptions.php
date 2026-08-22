<?php
/**
 * Primary Navigation Component Options
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
use Gravisain\Customizer\Controls\SliderControl;
use Gravisain\Customizer\Controls\ToggleControl;
use Gravisain\Customizer\Controls\ColorGroupControl;
use Gravisain\Customizer\Controls\TypographyControl;
use Gravisain\Customizer\Controls\VisibilityControl;

/**
 * PrimaryNavOptions Class
 */
class PrimaryNavOptions implements ComponentOptionInterface {

	/**
	 * Register component options in Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( WP_Customize_Manager $wp_customize ): void {

		// Primary Navigation Section.
		$wp_customize->add_section( 'gravisain_header_primary_navigation', [
			'title'    => __( 'Primary Navigation', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 31,
		] );

		// Section Tabs (General vs Design).
		$wp_customize->add_setting( 'gravisain_header_primary_nav_tabs', [
			'default'           => 'layout',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SectionTabsControl( $wp_customize, 'gravisain_header_primary_nav_tabs', [
			'section'  => 'gravisain_header_primary_navigation',
			'priority' => 1,
			'tabs'     => [
				'layout' => __( 'LAYOUT', 'gravisain' ),
				'style'  => __( 'STYLE', 'gravisain' ),
			],
		] ) );

		// Select Menu Control (General Tab).
		$wp_customize->add_setting( 'gravisain_header_primary_nav_menu', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$menus = wp_get_nav_menus();
		$menu_choices = [ '' => __( 'Select Menu', 'gravisain' ) ];
		foreach ( $menus as $menu ) {
			$menu_choices[ $menu->term_id ] = $menu->name;
		}

		$wp_customize->add_control( 'gravisain_header_primary_nav_menu', [
			'label'         => __( 'Select Menu', 'gravisain' ),
			'section'       => 'gravisain_header_primary_navigation',
			'priority'      => 10,
			'type'          => 'select',
			'choices'       => $menu_choices,
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] );

		// Items Spacing Control (General Tab).
		$wp_customize->add_setting( 'gravisain_header_primary_nav_spacing', [
			'default'           => '{"desktop":"20","tablet":"15","mobile":"10"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_header_primary_nav_spacing', [
			'label'         => __( 'Item Spacing / Gap (px)', 'gravisain' ),
			'section'       => 'gravisain_header_primary_navigation',
			'priority'      => 20,
			'default'       => 20,
			'input_attrs'   => [ 'px' => [ 'min' => 0, 'max' => 100, 'step' => 1 ] ],
			'units'         => [ 'px' ],
			'responsive'    => true,
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		$wp_customize->add_setting( 'gravisain_header_primary_visibility', [
			'default'           => 'desktop,tablet,mobile',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new VisibilityControl( $wp_customize, 'gravisain_header_primary_visibility', [
			'label'         => __( 'Visibility (Device Display)', 'gravisain' ),
			'section'       => 'gravisain_header_primary_navigation',
			'priority'      => 22,
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		// Stretch Menu? (General Tab).
		$wp_customize->add_setting( 'gravisain_header_primary_nav_stretch', [
			'default'           => false,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ToggleControl( $wp_customize, 'gravisain_header_primary_nav_stretch', [
			'label'         => __( 'Stretch Menu?', 'gravisain' ),
			'section'       => 'gravisain_header_primary_navigation',
			'priority'      => 30,
			'tab'           => 'layout',
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		// Fill and Center Menu Items? (General Tab).
		$wp_customize->add_setting( 'gravisain_header_primary_nav_fill_center', [
			'default'           => false,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ToggleControl( $wp_customize, 'gravisain_header_primary_nav_fill_center', [
			'label'           => __( 'Fill and Center Menu Items?', 'gravisain' ),
			'section'         => 'gravisain_header_primary_navigation',
			'priority'        => 35,
			'tab'             => 'layout',
			'wrapper_attrs'   => [ 'data-tab' => 'layout' ],
			'active_callback' => function() {
				return get_theme_mod( 'gravisain_header_primary_nav_stretch', false );
			},
		] ) );

		// ----------------------------------------------------
		// Design Tab Options (Primary Navigation)
		// ----------------------------------------------------

		// 1. Navigation Colors.
		$wp_customize->add_setting( 'gravisain_header_primary_nav_colors', [
			'default'           => '{"initial":"","hover":"","active":""}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ColorGroupControl( $wp_customize, 'gravisain_header_primary_nav_colors', [
			'label'         => __( 'Navigation Colors', 'gravisain' ),
			'section'       => 'gravisain_header_primary_navigation',
			'priority'      => 40,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'fields'        => [
				'initial' => __( 'Initial Color', 'gravisain' ),
				'hover'   => __( 'Hover Color', 'gravisain' ),
				'active'  => __( 'Active Color', 'gravisain' ),
			],
		] ) );

		// 2. Navigation Background.
		$wp_customize->add_setting( 'gravisain_header_primary_nav_background', [
			'default'           => '{"initial":"","hover":"","active":""}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ColorGroupControl( $wp_customize, 'gravisain_header_primary_nav_background', [
			'label'         => __( 'Navigation Background', 'gravisain' ),
			'section'       => 'gravisain_header_primary_navigation',
			'priority'      => 50,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'fields'        => [
				'initial' => __( 'Initial Background', 'gravisain' ),
				'hover'   => __( 'Hover Background', 'gravisain' ),
				'active'  => __( 'Active Background', 'gravisain' ),
			],
		] ) );

		// 3. Navigation Font.
		$wp_customize->add_setting( 'gravisain_header_primary_nav_font', [
			'default'           => '{"family":"inherit","style":"normal","size":"16"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new TypographyControl( $wp_customize, 'gravisain_header_primary_nav_font', [
			'label'         => __( 'Navigation Font', 'gravisain' ),
			'section'       => 'gravisain_header_primary_navigation',
			'priority'      => 60,
			'tab'           => 'style',
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'preview_text'  => __( 'Everything based on your mindset', 'gravisain' ),
		] ) );
	}
}
