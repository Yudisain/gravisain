<?php
/**
 * Divider Component Options
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
use Gravisain\Customizer\Controls\VisibilityControl;

/**
 * DividerOptions Class
 */
class DividerOptions implements ComponentOptionInterface {

	/**
	 * Register component options in Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( WP_Customize_Manager $wp_customize ): void {

		$wp_customize->add_section( 'gravisain_header_divider', [
			'title'    => __( 'Divider', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 48,
		] );

		$wp_customize->add_setting( 'gravisain_header_divider_visibility', [
			'default'           => 'desktop,tablet',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new VisibilityControl( $wp_customize, 'gravisain_header_divider_visibility', [
			'label'   => __( 'Visibility', 'gravisain' ),
			'section' => 'gravisain_header_divider',
		] ) );
	}
}
