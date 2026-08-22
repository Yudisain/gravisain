<?php
/**
 * Breadcrumbs & SEO Schema Options Panel for Customizer
 *
 * @package Gravisain\Customizer\Options
 */

namespace Gravisain\Customizer\Options;

class BreadcrumbOptions {

	/**
	 * Register Breadcrumbs & SEO Schema Customizer options.
	 *
	 * @param \WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( $wp_customize ): void {
		$wp_customize->add_section( 'gravisain_breadcrumbs_section', [
			'title'       => __( 'Breadcrumbs & SEO Schema', 'gravisain' ),
			'description' => __( 'Configure rich navigation breadcrumbs and Schema.org JSON-LD structured data output.', 'gravisain' ),
			'priority'    => 56,
		] );

		// 1. Enable / Disable Breadcrumbs Globally
		$wp_customize->add_setting( 'gravisain_breadcrumb_enable', [
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control(
			new \Gravisain\Customizer\Controls\VisibilityControl(
				$wp_customize,
				'gravisain_breadcrumb_enable',
				[
					'label'       => __( 'Enable Breadcrumbs Navigation', 'gravisain' ),
					'description' => __( 'Toggle breadcrumb trail display across the theme.', 'gravisain' ),
					'section'     => 'gravisain_breadcrumbs_section',
				]
			)
		);

		// 2. Breadcrumb Display Position
		$wp_customize->add_setting( 'gravisain_breadcrumb_position', [
			'default'           => 'in_page_header',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_breadcrumb_position', [
			'label'       => __( 'Display Position', 'gravisain' ),
			'description' => __( 'Choose where the breadcrumb navigation trail appears on single posts, pages, and archives.', 'gravisain' ),
			'section'     => 'gravisain_breadcrumbs_section',
			'type'        => 'select',
			'choices'     => [
				'in_page_header' => __( 'Inside Page Header Hero Area', 'gravisain' ),
				'above_content'  => __( 'Above Main Content Container', 'gravisain' ),
				'none'           => __( 'Hidden (Visual Only Hidden, Schema Still Active)', 'gravisain' ),
			],
		] );

		// 3. Separator Style
		$wp_customize->add_setting( 'gravisain_breadcrumb_separator', [
			'default'           => 'chevron',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_breadcrumb_separator', [
			'label'   => __( 'Separator Icon', 'gravisain' ),
			'section' => 'gravisain_breadcrumbs_section',
			'type'    => 'select',
			'choices' => [
				'chevron' => __( 'Chevron ( › )', 'gravisain' ),
				'slash'   => __( 'Slash ( / )', 'gravisain' ),
				'arrow'   => __( 'Arrow ( → )', 'gravisain' ),
				'dot'     => __( 'Dot ( • )', 'gravisain' ),
			],
		] );

		// 4. Show Home Item Toggle
		$wp_customize->add_setting( 'gravisain_breadcrumb_show_home', [
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control(
			new \Gravisain\Customizer\Controls\VisibilityControl(
				$wp_customize,
				'gravisain_breadcrumb_show_home',
				[
					'label'   => __( 'Show Home Link in Breadcrumbs', 'gravisain' ),
					'section' => 'gravisain_breadcrumbs_section',
				]
			)
		);

		// 5. Custom Home Label
		$wp_customize->add_setting( 'gravisain_breadcrumb_home_label', [
			'default'           => __( 'Home', 'gravisain' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_breadcrumb_home_label', [
			'label'       => __( 'Home Item Text', 'gravisain' ),
			'section'     => 'gravisain_breadcrumbs_section',
			'type'        => 'text',
		] );

		// 6. Schema.org JSON-LD Output
		$wp_customize->add_setting( 'gravisain_breadcrumb_schema_jsonld', [
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control(
			new \Gravisain\Customizer\Controls\VisibilityControl(
				$wp_customize,
				'gravisain_breadcrumb_schema_jsonld',
				[
					'label'       => __( 'Output Schema.org JSON-LD (<head>)', 'gravisain' ),
					'description' => __( 'Generates structured BreadcrumbList JSON-LD for Google SEO Rich Snippets. Automatically disables if Yoast SEO or Rank Math handles breadcrumbs.', 'gravisain' ),
					'section'     => 'gravisain_breadcrumbs_section',
				]
			)
		);
	}
}
