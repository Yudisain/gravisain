<?php
/**
 * Customizer Component Option Interface
 *
 * @package Gravisain\Customizer\Options
 */

declare(strict_types=1);

namespace Gravisain\Customizer\Options;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use WP_Customize_Manager;

/**
 * Interface ComponentOptionInterface
 */
interface ComponentOptionInterface {

	/**
	 * Register component settings and controls in the Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( WP_Customize_Manager $wp_customize ): void;
}
