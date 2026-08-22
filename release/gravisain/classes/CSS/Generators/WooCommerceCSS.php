<?php
/**
 * WooCommerce CSS Generator
 *
 * Handles WooCommerce dynamic grid columns and distraction-free checkout CSS.
 *
 * @package Gravisain\CSS\Generators
 */

declare(strict_types=1);

namespace Gravisain\CSS\Generators;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Gravisain\CSS\Builder;

/**
 * WooCommerceCSS Class
 */
class WooCommerceCSS extends AbstractGenerator {

	/**
	 * Generate WooCommerce CSS rules.
	 *
	 * @param Builder $builder Dynamic CSS Builder instance.
	 * @return void
	 */
	public function generate( Builder $builder ): void {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		$cols = (int) get_theme_mod( 'gravisain_woo_catalog_columns', 3 );
		if ( $cols > 0 ) {
			$builder->add( '.woocommerce ul.products', 'display', 'grid' );
			$builder->add( '.woocommerce ul.products', 'grid-template-columns', "repeat({$cols}, minmax(0, 1fr))" );
			$builder->add( '.woocommerce ul.products', 'gap', '2rem' );
			$builder->add( '.woocommerce ul.products::before, .woocommerce ul.products::after', 'display', 'none' );
		}

		if ( get_theme_mod( 'gravisain_woo_distraction_free', false ) ) {
			$builder->add( 'body.gravisain-distraction-free-checkout .site-header, body.gravisain-distraction-free-checkout .site-footer', 'display', 'none !important' );
		}
	}
}
