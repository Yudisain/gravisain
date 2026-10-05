<?php
/**
 * WooCommerce Deep Integration Class
 *
 * @package Gravisain\Integrations
 */

namespace Gravisain\Integrations;

/**
 * WooCommerce Class
 *
 * Manages WooCommerce theme support, layout columns, card styling,
 * AJAX cart fragment updates, and distraction-free checkout mode.
 */
class WooCommerce {

	/**
	 * Initialize WooCommerce integration.
	 *
	 * @return void
	 */
	public static function init(): void {
		$instance = new self();
		add_action( 'after_setup_theme', [ $instance, 'setup' ] );
		add_action( 'init', [ $instance, 'init_hooks' ] );
	}

	/**
	 * Setup theme support for WooCommerce and galleries.
	 *
	 * @return void
	 */
	public function setup(): void {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	/**
	 * Initialize WordPress & WooCommerce hooks conditionally.
	 *
	 * @return void
	 */
	public function init_hooks(): void {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		add_filter( 'gravisain_element_display_rules', [ $this, 'add_element_display_rules' ] );
		add_filter( 'gravisain_element_should_display', [ $this, 'evaluate_element_display_rule' ], 10, 3 );

		// 1. Catalog Grid Columns
		add_filter( 'loop_shop_columns', [ $this, 'get_shop_columns' ], 20 );

		// 2. Products Per Page
		add_filter( 'loop_shop_per_page', [ $this, 'get_products_per_page' ], 20 );

		// 3. Body Classes for Product Card Styles & Distraction-Free Mode
		add_filter( 'body_class', [ $this, 'add_body_classes' ] );

		// 4. AJAX Cart Fragment Refresh for Header Cart Component
		add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'cart_fragments' ] );

		// 5. Distraction-Free Checkout Header/Footer Hiding
		add_action( 'wp', [ $this, 'apply_distraction_free_checkout' ] );

		// 6. Sticky Add to Cart Bar on Single Product Page
		add_action( 'wp_footer', [ $this, 'render_sticky_add_to_cart' ], 30 );
	}

	/**
	 * Filter WooCommerce catalog columns based on Customizer setting.
	 *
	 * @param int $columns Default columns count.
	 * @return int
	 */
	public function get_shop_columns( $columns ): int {
		return (int) get_theme_mod( 'gravisain_woo_catalog_columns', 3 );
	}

	/**
	 * Filter WooCommerce catalog products per page based on Customizer setting.
	 *
	 * @param int $per_page Default products per page.
	 * @return int
	 */
	public function get_products_per_page( $per_page ): int {
		return (int) get_theme_mod( 'gravisain_woo_catalog_per_page', 12 );
	}

	/**
	 * Add body classes for WooCommerce layout options.
	 *
	 * @param array $classes Existing body classes.
	 * @return array
	 */
	public function add_body_classes( array $classes ): array {
		$card_align = get_theme_mod( 'gravisain_woo_card_align', 'left' );
		$badge_style = get_theme_mod( 'gravisain_woo_sale_badge_style', 'rounded' );

		$classes[] = 'gravisain-woo-align-' . sanitize_html_class( $card_align );
		$classes[] = 'gravisain-woo-badge-' . sanitize_html_class( $badge_style );

		if ( function_exists( 'is_checkout' ) && is_checkout() && get_theme_mod( 'gravisain_woo_distraction_free', false ) ) {
			$classes[] = 'gravisain-distraction-free-checkout';
		}

		return $classes;
	}

	/**
	 * Update Header Builder Mini Cart Badge and Total via WooCommerce AJAX.
	 *
	 * @param array $fragments Existing fragments array.
	 * @return array
	 */
	public function cart_fragments( array $fragments ): array {
		if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
			return $fragments;
		}

		$count = WC()->cart->get_cart_contents_count();
		$total = WC()->cart->get_cart_subtotal();

		// Badge fragment
		$empty_cls = ( 0 === $count ) ? 'is-empty' : '';
		$fragments['span.ghb-cart-badge'] = '<span class="ghb-cart-badge ' . esc_attr( $empty_cls ) . '">' . esc_html( $count ) . '</span>';

		// Total price fragment
		$fragments['span.ghb-cart-total'] = '<span class="ghb-cart-total">' . wp_kses_post( $total ) . '</span>';

		return $fragments;
	}

	/**
	 * Apply Distraction-Free Checkout by hiding header and footer.
	 *
	 * @return void
	 */
	public function apply_distraction_free_checkout(): void {
		if ( ! function_exists( 'is_checkout' ) || ! is_checkout() ) {
			return;
		}

		if ( function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url( 'order-received' ) ) {
			return;
		}

		if ( get_theme_mod( 'gravisain_woo_distraction_free', false ) ) {
			add_filter( 'gravisain_show_header', '__return_false' );
			add_filter( 'gravisain_show_footer', '__return_false' );
		}
	}

	/**
	 * Render Sticky Add to Cart Bar on Single Product Pages.
	 *
	 * @return void
	 */
	public function render_sticky_add_to_cart(): void {
		if ( ! function_exists( 'is_product' ) || ! is_product() ) {
			return;
		}

		if ( ! get_theme_mod( 'gravisain_woo_single_sticky_cart', true ) ) {
			return;
		}

		global $product;
		if ( ! is_a( $product, 'WC_Product' ) ) {
			return;
		}
		?>
		<div class="gravisain-sticky-add-to-cart">
			<div class="gravisain-sticky-cart-container">
				<div class="gravisain-sticky-cart-product-info">
					<?php echo $product->get_image( [ 48, 48 ] ); ?>
					<div class="gravisain-sticky-cart-title-price">
						<span class="gravisain-sticky-cart-title"><?php echo esc_html( $product->get_name() ); ?></span>
						<span class="gravisain-sticky-cart-price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
					</div>
				</div>
				<div class="gravisain-sticky-cart-action">
					<?php if ( $product->is_in_stock() ) : ?>
						<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="button alt gravisain-sticky-add-btn">
							<?php echo esc_html( $product->add_to_cart_text() ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Add WooCommerce display rules for Theme Builder Elements.
	 *
	 * @param array $rules Existing display rules.
	 * @return array
	 */
	public function add_element_display_rules( array $rules ): array {
		$rules['woo_shop']    = __( 'WooCommerce Shop / Catalog', 'gravisain' );
		$rules['woo_product'] = __( 'WooCommerce Single Product', 'gravisain' );
		$rules['woo_cart']    = __( 'WooCommerce Cart', 'gravisain' );
		$rules['woo_checkout']= __( 'WooCommerce Checkout', 'gravisain' );
		return $rules;
	}

	/**
	 * Evaluate WooCommerce display rules.
	 *
	 * @param bool   $should_display Current evaluation status.
	 * @param string $display_rule   The display rule for the element.
	 * @param int    $post_id        The element post ID.
	 * @return bool
	 */
	public function evaluate_element_display_rule( bool $should_display, string $display_rule, int $post_id ): bool {
		if ( $should_display ) {
			return true; // Already matched by another rule.
		}

		if ( 'woo_shop' === $display_rule && ( is_shop() || is_product_category() || is_product_tag() ) ) {
			return true;
		}

		if ( 'woo_product' === $display_rule && is_product() ) {
			return true;
		}

		if ( 'woo_cart' === $display_rule && is_cart() ) {
			return true;
		}

		if ( 'woo_checkout' === $display_rule && is_checkout() ) {
			return true;
		}

		return false;
	}
}
