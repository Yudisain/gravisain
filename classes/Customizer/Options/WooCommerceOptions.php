<?php
/**
 * WooCommerce Customizer Options
 *
 * @package Gravisain\Customizer\Options
 */

namespace Gravisain\Customizer\Options;

use Gravisain\Customizer\Controls\SliderControl;

/**
 * WooCommerceOptions Class
 */
class WooCommerceOptions {

	/**
	 * Register WooCommerce options in WordPress Customizer.
	 *
	 * @param \WP_Customize_Manager $wp_customize Customizer manager instance.
	 * @return void
	 */
	public function register( $wp_customize ): void {
		// Only register if WooCommerce is active
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		// 1. Panel
		$wp_customize->add_panel( 'gravisain_woocommerce_panel', [
			'title'       => __( 'WooCommerce (Gravisain Pro)', 'gravisain' ),
			'description' => __( 'Configure shop catalog layout, single product features, and checkout experience.', 'gravisain' ),
			'priority'    => 55,
		] );

		// ==========================================
		// SECTION 1: PRODUCT CATALOG (ARCHIVE)
		// ==========================================
		$wp_customize->add_section( 'gravisain_woo_catalog_section', [
			'title'    => __( 'Product Catalog Grid', 'gravisain' ),
			'panel'    => 'gravisain_woocommerce_panel',
			'priority' => 10,
		] );

		// Desktop Columns
		$wp_customize->add_setting( 'gravisain_woo_catalog_columns', [
			'default'           => 3,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_woo_catalog_columns', [
			'type'     => 'select',
			'label'    => __( 'Catalog Columns (Desktop)', 'gravisain' ),
			'section'  => 'gravisain_woo_catalog_section',
			'priority' => 10,
			'choices'  => [
				2 => __( '2 Columns', 'gravisain' ),
				3 => __( '3 Columns', 'gravisain' ),
				4 => __( '4 Columns', 'gravisain' ),
			],
		] );

		// Products Per Page
		$wp_customize->add_setting( 'gravisain_woo_catalog_per_page', [
			'default'           => 12,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_woo_catalog_per_page', [
			'label'      => __( 'Products Per Page', 'gravisain' ),
			'section'    => 'gravisain_woo_catalog_section',
			'priority'   => 20,
			'default'    => 12,
			'choices'    => [ 'min' => 4, 'max' => 48, 'step' => 2 ],
			'responsive' => false,
		] ) );

		// Product Card Alignment
		$wp_customize->add_setting( 'gravisain_woo_card_align', [
			'default'           => 'left',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_woo_card_align', [
			'type'     => 'select',
			'label'    => __( 'Product Card Content Alignment', 'gravisain' ),
			'section'  => 'gravisain_woo_catalog_section',
			'priority' => 30,
			'choices'  => [
				'left'   => __( 'Left Aligned', 'gravisain' ),
				'center' => __( 'Center Aligned', 'gravisain' ),
			],
		] );

		// Sale Badge Style
		$wp_customize->add_setting( 'gravisain_woo_sale_badge_style', [
			'default'           => 'rounded',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_woo_sale_badge_style', [
			'type'     => 'select',
			'label'    => __( 'Sale Badge Style', 'gravisain' ),
			'section'  => 'gravisain_woo_catalog_section',
			'priority' => 40,
			'choices'  => [
				'rounded' => __( 'Rounded Pill', 'gravisain' ),
				'square'  => __( 'Square Box', 'gravisain' ),
				'minimal' => __( 'Minimal Text', 'gravisain' ),
			],
		] );

		// ==========================================
		// SECTION 2: SINGLE PRODUCT PAGE
		// ==========================================
		$wp_customize->add_section( 'gravisain_woo_single_section', [
			'title'    => __( 'Single Product Page', 'gravisain' ),
			'panel'    => 'gravisain_woocommerce_panel',
			'priority' => 20,
		] );

		// Sticky Add to Cart Bar
		$wp_customize->add_setting( 'gravisain_woo_single_sticky_cart', [
			'default'           => true,
			'sanitize_callback' => [ __CLASS__, 'sanitize_checkbox' ],
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_woo_single_sticky_cart', [
			'type'     => 'checkbox',
			'label'    => __( 'Enable Sticky Add to Cart Bar on Scroll', 'gravisain' ),
			'section'  => 'gravisain_woo_single_section',
			'priority' => 10,
		] );

		// ==========================================
		// SECTION 3: STORE CHECKOUT & CART
		// ==========================================
		$wp_customize->add_section( 'gravisain_woo_checkout_section', [
			'title'    => __( 'Store Checkout & Conversion', 'gravisain' ),
			'panel'    => 'gravisain_woocommerce_panel',
			'priority' => 30,
		] );

		// Distraction-Free Checkout
		$wp_customize->add_setting( 'gravisain_woo_distraction_free', [
			'default'           => false,
			'sanitize_callback' => [ __CLASS__, 'sanitize_checkbox' ],
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_woo_distraction_free', [
			'type'        => 'checkbox',
			'label'       => __( 'Enable Distraction-Free Checkout', 'gravisain' ),
			'description' => __( 'Hides standard header and footer navigation on the Checkout page to maximize conversion rates.', 'gravisain' ),
			'section'     => 'gravisain_woo_checkout_section',
			'priority'    => 10,
		] );
	}

	/**
	 * Sanitize boolean checkbox setting.
	 *
	 * @param mixed $checked Value to sanitize.
	 * @return bool
	 */
	public static function sanitize_checkbox( $checked ): bool {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}
}
