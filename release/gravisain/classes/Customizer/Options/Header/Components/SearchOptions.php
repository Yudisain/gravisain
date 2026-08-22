<?php
/**
 * Search Component Options
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
 * SearchOptions Class
 */
class SearchOptions implements ComponentOptionInterface {

	/**
	 * Register component options in Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( WP_Customize_Manager $wp_customize ): void {

		$wp_customize->add_section( 'gravisain_header_search', [
			'title'    => __( 'Search', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 43,
		] );

		$wp_customize->add_setting( 'gravisain_header_search_style', [
			'default'           => 'icon',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_header_search_style', [
			'label'   => __( 'Search Display Style', 'gravisain' ),
			'section' => 'gravisain_header_search',
			'type'    => 'select',
			'choices' => [
				'icon'   => __( 'Modal Icon Toggle', 'gravisain' ),
				'inline' => __( 'Inline Search Form', 'gravisain' ),
			],
		] );
	}
}
