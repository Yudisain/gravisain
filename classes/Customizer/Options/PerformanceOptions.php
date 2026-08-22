<?php
/**
 * Performance & Compliance Options for Customizer
 *
 * @package Gravisain\Customizer\Options
 */

namespace Gravisain\Customizer\Options;

class PerformanceOptions {

	/**
	 * Register Customizer settings and controls for Performance & Compliance.
	 *
	 * @param \WP_Customize_Manager $wp_customize Customizer instance.
	 * @return void
	 */
	public function register( $wp_customize ): void {
		$wp_customize->add_section( 'gravisain_performance', [
			'title'       => __( 'Performance & Compliance', 'gravisain' ),
			'description' => __( 'Manage asset optimization, GDPR font compliance, and file caching.', 'gravisain' ),
			'panel'       => 'gravisain_options',
			'priority'    => 15,
		] );

		// 1. Local Google Fonts (GDPR)
		$wp_customize->add_setting( 'gravisain_local_google_fonts', [
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( 'gravisain_local_google_fonts', [
			'label'       => __( 'Load Google Fonts Locally (GDPR Compliant)', 'gravisain' ),
			'description' => __( 'Automatically download Google Fonts to local server to eliminate third-party requests and comply with GDPR.', 'gravisain' ),
			'section'     => 'gravisain_performance',
			'type'        => 'checkbox',
		] );

		// 2. Dynamic CSS File Cache
		$wp_customize->add_setting( 'gravisain_dynamic_css_file_cache', [
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( 'gravisain_dynamic_css_file_cache', [
			'label'       => __( 'Enable Dynamic CSS File Caching', 'gravisain' ),
			'description' => __( 'Save generated dynamic CSS to a static stylesheet file (`wp-content/uploads/gravisain/gravisain-dynamic.css`) for browser caching.', 'gravisain' ),
			'section'     => 'gravisain_performance',
			'type'        => 'checkbox',
		] );
	}
}
