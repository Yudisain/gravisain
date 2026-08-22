<?php
/**
 * Account Component Options
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
 * AccountOptions Class
 */
class AccountOptions implements ComponentOptionInterface {

	/**
	 * Register component options in Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( WP_Customize_Manager $wp_customize ): void {

		$wp_customize->add_section( 'gravisain_header_account', [
			'title'    => __( 'Account Icon', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 46,
		] );

		$wp_customize->add_setting( 'gravisain_header_account_style', [
			'default'           => 'icon_label',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_account_style', [
			'label'   => __( 'Display Style', 'gravisain' ),
			'section' => 'gravisain_header_account',
			'type'    => 'select',
			'choices' => [
				'icon'       => __( 'Icon Only', 'gravisain' ),
				'icon_label' => __( 'Icon + Label', 'gravisain' ),
				'avatar'     => __( 'User Avatar / Icon', 'gravisain' ),
			],
		] );

		$wp_customize->add_setting( 'gravisain_header_account_url', [
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_account_url', [
			'label'       => __( 'Custom Login / Account URL', 'gravisain' ),
			'description' => __( 'Leave empty to auto-detect login / WooCommerce My Account page.', 'gravisain' ),
			'section'     => 'gravisain_header_account',
			'type'        => 'text',
		] );

		$wp_customize->add_setting( 'gravisain_header_account_visibility', [
			'default'           => 'desktop,tablet,mobile',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new VisibilityControl( $wp_customize, 'gravisain_header_account_visibility', [
			'label'   => __( 'Visibility', 'gravisain' ),
			'section' => 'gravisain_header_account',
		] ) );
	}
}
