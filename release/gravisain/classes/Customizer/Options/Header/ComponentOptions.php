<?php
/**
 * Header Components Options Orchestrator
 *
 * @package Gravisain\Customizer\Options\Header
 */

declare(strict_types=1);

namespace Gravisain\Customizer\Options\Header;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use WP_Customize_Manager;
use Gravisain\Customizer\Options\Header\Components\PrimaryNavOptions;
use Gravisain\Customizer\Options\Header\Components\SecondaryNavOptions;
use Gravisain\Customizer\Options\Header\Components\ActionButtonOptions;
use Gravisain\Customizer\Options\Header\Components\SocialOptions;
use Gravisain\Customizer\Options\Header\Components\HtmlOptions;
use Gravisain\Customizer\Options\Header\Components\SearchOptions;
use Gravisain\Customizer\Options\Header\Components\MenuTriggerOptions;
use Gravisain\Customizer\Options\Header\Components\OffCanvasOptions;
use Gravisain\Customizer\Options\Header\Components\AccountOptions;
use Gravisain\Customizer\Options\Header\Components\DividerOptions;
use Gravisain\Customizer\Options\Header\Components\ContactOptions;
use Gravisain\Customizer\Options\Header\Components\CartOptions;

/**
 * ComponentOptions Class
 *
 * Orchestrates all 12 header builder component options in the Customizer.
 */
class ComponentOptions {

	/**
	 * Register component options in Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager object.
	 * @return void
	 */
	public function register( $wp_customize ): void {
		$components = [
			new PrimaryNavOptions(),
			new SecondaryNavOptions(),
			new ActionButtonOptions(),
			new SocialOptions(),
			new HtmlOptions(),
			new SearchOptions(),
			new MenuTriggerOptions(),
			new OffCanvasOptions(),
			new AccountOptions(),
			new DividerOptions(),
			new ContactOptions(),
			new CartOptions(),
		];

		foreach ( $components as $component ) {
			$component->register( $wp_customize );
		}
	}
}
