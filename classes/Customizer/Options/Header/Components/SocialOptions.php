<?php
/**
 * Social Icons Component Options
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
use Gravisain\Customizer\Controls\SocialIconsControl;
use Gravisain\Customizer\Controls\SliderControl;

/**
 * SocialOptions Class
 */
class SocialOptions implements ComponentOptionInterface {

	/**
	 * Register component options in Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( WP_Customize_Manager $wp_customize ): void {

		$wp_customize->add_section( 'gravisain_header_social', [
			'title'    => __( 'Social Icons', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 42,
		] );

		// Section Tabs (Design vs Style).
		$wp_customize->add_setting( 'gravisain_header_social_tabs', [
			'default'           => 'design',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SectionTabsControl( $wp_customize, 'gravisain_header_social_tabs', [
			'section'  => 'gravisain_header_social',
			'priority' => 1,
			'tabs'     => [
				'design' => __( 'Design', 'gravisain' ),
				'style'  => __( 'Style', 'gravisain' ),
			],
		] ) );

		// Repeater Control for Social Items (Design Tab).
		$wp_customize->add_setting( 'gravisain_header_social_items', [
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post_deep',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new SocialIconsControl( $wp_customize, 'gravisain_header_social_items', [
			'label'         => __( 'Social Networks', 'gravisain' ),
			'section'       => 'gravisain_header_social',
			'priority'      => 10,
			'wrapper_attrs' => [
				'data-tab' => 'design',
			],
		] ) );

		// Item Spacing Control (Style Tab).
		$wp_customize->add_setting( 'gravisain_header_social_spacing', [
			'default'           => '{"desktop":"12","tablet":"10","mobile":"8"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_header_social_spacing', [
			'label'         => __( 'Item Spacing / Gap (px)', 'gravisain' ),
			'section'       => 'gravisain_header_social',
			'priority'      => 20,
			'default'       => 12,
			'choices'       => [ 'min' => 0, 'max' => 50, 'step' => 1 ],
			'responsive'    => true,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Icon Size Control (Style Tab).
		$wp_customize->add_setting( 'gravisain_header_social_icon_size', [
			'default'           => '{"desktop":"18","tablet":"16","mobile":"14"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_header_social_icon_size', [
			'label'         => __( 'Icon Size (px)', 'gravisain' ),
			'section'       => 'gravisain_header_social',
			'priority'      => 25,
			'default'       => 18,
			'choices'       => [ 'min' => 10, 'max' => 60, 'step' => 1 ],
			'responsive'    => true,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Brand Colors Control (Style Tab).
		$wp_customize->add_setting( 'gravisain_header_social_brand_colors', [
			'default'           => 'no',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_social_brand_colors', [
			'label'         => __( 'Brand Colors', 'gravisain' ),
			'section'       => 'gravisain_header_social',
			'priority'      => 30,
			'type'          => 'select',
			'choices'       => [
				'no'            => __( 'No (default)', 'gravisain' ),
				'yes'           => __( 'Yes (Follow Brand Icon Color)', 'gravisain' ),
				'default-hover' => __( 'Default-Hover (Default, Brand on hover)', 'gravisain' ),
				'hover-default' => __( 'Hover-Default (Brand, Default on hover)', 'gravisain' ),
			],
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] );

		// Keep legacy individual URLs for backward compatibility.
		$networks = [
			'facebook'  => __( 'Facebook URL', 'gravisain' ),
			'twitter'   => __( 'X (Twitter) URL', 'gravisain' ),
			'instagram' => __( 'Instagram URL', 'gravisain' ),
			'linkedin'  => __( 'LinkedIn URL', 'gravisain' ),
			'youtube'   => __( 'YouTube URL', 'gravisain' ),
		];

		foreach ( $networks as $key => $label ) {
			$setting_id = "gravisain_header_social_{$key}";
			$wp_customize->add_setting( $setting_id, [
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
				'transport'         => 'refresh',
			] );
		}
	}
}
