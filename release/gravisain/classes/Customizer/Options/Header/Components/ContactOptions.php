<?php
/**
 * Contact Info Component Options
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
 * ContactOptions Class
 */
class ContactOptions implements ComponentOptionInterface {

	/**
	 * Register component options in Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( WP_Customize_Manager $wp_customize ): void {

		$wp_customize->add_section( 'gravisain_header_contact', [
			'title'    => __( 'Contact Info', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 45,
		] );

		$wp_customize->add_setting( 'gravisain_header_contact_phone', [
			'default'           => '+1 (800) 123-4567',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_contact_phone', [
			'label'   => __( 'Phone Number', 'gravisain' ),
			'section' => 'gravisain_header_contact',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'gravisain_header_contact_email', [
			'default'           => 'info@example.com',
			'sanitize_callback' => 'sanitize_email',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_contact_email', [
			'label'   => __( 'Email Address', 'gravisain' ),
			'section' => 'gravisain_header_contact',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'gravisain_header_contact_hours', [
			'default'           => 'Mon - Fri: 8am - 5pm',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_contact_hours', [
			'label'   => __( 'Operating Hours / Location', 'gravisain' ),
			'section' => 'gravisain_header_contact',
			'type'    => 'text',
		] );

		$wp_customize->add_setting( 'gravisain_header_contact_visibility', [
			'default'           => 'desktop,tablet',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new VisibilityControl( $wp_customize, 'gravisain_header_contact_visibility', [
			'label'   => __( 'Visibility', 'gravisain' ),
			'section' => 'gravisain_header_contact',
		] ) );
	}
}
