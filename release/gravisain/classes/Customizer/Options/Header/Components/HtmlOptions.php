<?php
/**
 * Custom HTML Component Options
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

/**
 * HtmlOptions Class
 */
class HtmlOptions implements ComponentOptionInterface {

	/**
	 * Register component options in Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( WP_Customize_Manager $wp_customize ): void {

		$wp_customize->add_section( 'gravisain_header_html', [
			'title'    => __( 'HTML / Shortcode', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 44,
		] );

		$wp_customize->add_setting( 'gravisain_header_html_content', [
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( 'gravisain_header_html_content', [
			'label'       => __( 'Custom HTML / Shortcode', 'gravisain' ),
			'description' => __( 'Enter custom text, phone numbers, or shortcodes.', 'gravisain' ),
			'section'     => 'gravisain_header_html',
			'type'        => 'textarea',
		] );
	}
}
