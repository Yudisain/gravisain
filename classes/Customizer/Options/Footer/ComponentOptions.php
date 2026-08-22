<?php
/**
 * Footer Component Options
 *
 * @package Gravisain\Customizer\Options\Footer
 */

namespace Gravisain\Customizer\Options\Footer;

use Gravisain\Customizer\Controls\SectionTabsControl;
use Gravisain\Customizer\Controls\SocialIconsControl;
use Gravisain\Customizer\Controls\SliderControl;
use Gravisain\Customizer\Controls\ColorGroupControl;
use Gravisain\Customizer\Controls\TypographyControl;

class ComponentOptions {
	public function register( $wp_customize ): void {
		// 1. Copyright Section
		$wp_customize->add_section( 'gravisain_footer_copyright_section', [
			'title'    => __( 'Copyright Text', 'gravisain' ),
			'panel'    => 'gravisain_footer_panel',
			'priority' => 40,
		] );

		$wp_customize->add_setting( 'gravisain_footer_copyright_text', [
			'default'           => __( 'Copyright &copy; [year] [site_title]. All rights reserved.', 'gravisain' ),
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_footer_copyright_text', [
			'label'       => __( 'Copyright HTML Text', 'gravisain' ),
			'description' => __( 'Supported tags: [year], [site_title], [theme_author].', 'gravisain' ),
			'section'     => 'gravisain_footer_copyright_section',
			'type'        => 'textarea',
		] );

		// 2. Footer Navigation Section
		$wp_customize->add_section( 'gravisain_footer_navigation', [
			'title'    => __( 'Footer Navigation', 'gravisain' ),
			'panel'    => 'gravisain_footer_panel',
			'priority' => 45,
		] );

		// Section Tabs (Layout vs Style)
		$wp_customize->add_setting( 'gravisain_footer_nav_tabs', [
			'default'           => 'layout',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SectionTabsControl( $wp_customize, 'gravisain_footer_nav_tabs', [
			'section'  => 'gravisain_footer_navigation',
			'priority' => 1,
			'tabs'     => [
				'layout' => __( 'LAYOUT', 'gravisain' ),
				'style'  => __( 'STYLE', 'gravisain' ),
			],
		] ) );

		// Select Menu Control (Layout Tab)
		$wp_customize->add_setting( 'gravisain_footer_nav_menu', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$menus = wp_get_nav_menus();
		$menu_choices = [ '' => __( 'Select Menu (Default Location)', 'gravisain' ) ];
		foreach ( $menus as $menu ) {
			$menu_choices[ $menu->term_id ] = $menu->name;
		}

		$wp_customize->add_control( 'gravisain_footer_nav_menu', [
			'label'         => __( 'Select Menu', 'gravisain' ),
			'section'       => 'gravisain_footer_navigation',
			'priority'      => 10,
			'type'          => 'select',
			'choices'       => $menu_choices,
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] );

		// Item Spacing Control (Layout Tab)
		$wp_customize->add_setting( 'gravisain_footer_nav_spacing', [
			'default'           => '{"desktop":"20","tablet":"16","mobile":"12"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_footer_nav_spacing', [
			'label'         => __( 'Item Spacing / Gap (px)', 'gravisain' ),
			'section'       => 'gravisain_footer_navigation',
			'priority'      => 20,
			'default'       => 20,
			'choices'       => [ 'min' => 0, 'max' => 60, 'step' => 1 ],
			'responsive'    => true,
			'wrapper_attrs' => [ 'data-tab' => 'layout' ],
		] ) );

		// Navigation Colors (Style Tab)
		$wp_customize->add_setting( 'gravisain_footer_nav_colors', [
			'default'           => '{"initial":"","hover":""}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new ColorGroupControl( $wp_customize, 'gravisain_footer_nav_colors', [
			'label'         => __( 'Navigation Link Colors', 'gravisain' ),
			'section'       => 'gravisain_footer_navigation',
			'priority'      => 30,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
			'fields'        => [
				'initial' => __( 'Normal Color', 'gravisain' ),
				'hover'   => __( 'Hover Color', 'gravisain' ),
			],
		] ) );

		// Navigation Font (Style Tab)
		$wp_customize->add_setting( 'gravisain_footer_nav_font', [
			'default'           => '{"family":"inherit","style":"normal","size":"14"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new TypographyControl( $wp_customize, 'gravisain_footer_nav_font', [
			'label'         => __( 'Navigation Typography', 'gravisain' ),
			'section'       => 'gravisain_footer_navigation',
			'priority'      => 40,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// 3. Footer Social Icons Section
		$wp_customize->add_section( 'gravisain_footer_social', [
			'title'    => __( 'Social Icons', 'gravisain' ),
			'panel'    => 'gravisain_footer_panel',
			'priority' => 50,
		] );

		// Section Tabs (Design vs Style)
		$wp_customize->add_setting( 'gravisain_footer_social_tabs', [
			'default'           => 'design',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SectionTabsControl( $wp_customize, 'gravisain_footer_social_tabs', [
			'section'  => 'gravisain_footer_social',
			'priority' => 1,
			'tabs'     => [
				'design' => __( 'Design', 'gravisain' ),
				'style'  => __( 'Style', 'gravisain' ),
			],
		] ) );

		// Repeater Control for Footer Social Items (Design Tab)
		$wp_customize->add_setting( 'gravisain_footer_social_items', [
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post_deep',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new SocialIconsControl( $wp_customize, 'gravisain_footer_social_items', [
			'label'         => __( 'Social Networks', 'gravisain' ),
			'section'       => 'gravisain_footer_social',
			'priority'      => 10,
			'wrapper_attrs' => [
				'data-tab' => 'design',
			],
		] ) );

		// Item Spacing Control (Style Tab)
		$wp_customize->add_setting( 'gravisain_footer_social_spacing', [
			'default'           => '{"desktop":"14","tablet":"12","mobile":"10"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_footer_social_spacing', [
			'label'         => __( 'Item Spacing / Gap (px)', 'gravisain' ),
			'section'       => 'gravisain_footer_social',
			'priority'      => 20,
			'default'       => 14,
			'choices'       => [ 'min' => 0, 'max' => 50, 'step' => 1 ],
			'responsive'    => true,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Icon Size Control (Style Tab)
		$wp_customize->add_setting( 'gravisain_footer_social_icon_size', [
			'default'           => '{"desktop":"18","tablet":"16","mobile":"16"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_footer_social_icon_size', [
			'label'         => __( 'Icon Size (px)', 'gravisain' ),
			'section'       => 'gravisain_footer_social',
			'priority'      => 25,
			'default'       => 18,
			'choices'       => [ 'min' => 10, 'max' => 60, 'step' => 1 ],
			'responsive'    => true,
			'wrapper_attrs' => [ 'data-tab' => 'style' ],
		] ) );

		// Brand Colors Control (Style Tab)
		$wp_customize->add_setting( 'gravisain_footer_social_brand_colors', [
			'default'           => 'no',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_footer_social_brand_colors', [
			'label'         => __( 'Brand Colors', 'gravisain' ),
			'section'       => 'gravisain_footer_social',
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

		// 4. Custom HTML Section
		$wp_customize->add_section( 'gravisain_footer_html', [
			'title'    => __( 'Custom HTML / Shortcode', 'gravisain' ),
			'panel'    => 'gravisain_footer_panel',
			'priority' => 60,
		] );

		$wp_customize->add_setting( 'gravisain_footer_html_content', [
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_footer_html_content', [
			'label'       => __( 'Custom HTML / Shortcode Content', 'gravisain' ),
			'description' => __( 'Add any custom HTML tags, shortcodes, or badge links.', 'gravisain' ),
			'section'     => 'gravisain_footer_html',
			'type'        => 'textarea',
		] );
	}
}
