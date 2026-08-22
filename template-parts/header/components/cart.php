<?php
/**
 * WooCommerce Mini Cart Component
 *
 * @package Gravisain\Components
 */

$style      = get_theme_mod( 'gravisain_header_cart_style', 'icon_badge' );
$visibility = get_theme_mod( 'gravisain_header_cart_visibility', 'desktop,tablet,mobile' );

$classes = [ 'ghb-component', 'ghb-cart', 'ghb-cart-' . esc_attr( $style ) ];

if ( ! empty( $visibility ) ) {
	if ( false === strpos( $visibility, 'desktop' ) ) {
		$classes[] = 'gravisain-hide-desktop';
	}
	if ( false === strpos( $visibility, 'tablet' ) ) {
		$classes[] = 'gravisain-hide-tablet';
	}
	if ( false === strpos( $visibility, 'mobile' ) ) {
		$classes[] = 'gravisain-hide-mobile';
	}
}

$cart_count = 0;
$cart_total = '';
$cart_url   = '#';

if ( class_exists( 'WooCommerce' ) && function_exists( 'WC' ) && WC()->cart ) {
	$cart_count = WC()->cart->get_cart_contents_count();
	$cart_total = WC()->cart->get_cart_subtotal();
	$cart_url   = wc_get_cart_url();
}
?>
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<a href="<?php echo esc_url( $cart_url ); ?>" class="ghb-cart-trigger" aria-label="<?php esc_attr_e( 'View Shopping Cart', 'gravisain' ); ?>">
		<span class="ghb-cart-icon-wrapper">
			<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
				<line x1="3" y1="6" x2="21" y2="6"></line>
				<path d="M16 10a4 4 0 0 1-8 0"></path>
			</svg>
			<?php if ( 'icon_badge' === $style || 'icon_price' === $style ) : ?>
				<span class="ghb-cart-badge <?php echo $cart_count === 0 ? 'is-empty' : ''; ?>">
					<?php echo esc_html( $cart_count ); ?>
				</span>
			<?php endif; ?>
		</span>

		<?php if ( 'icon_price' === $style && ! empty( $cart_total ) ) : ?>
			<span class="ghb-cart-total"><?php echo wp_kses_post( $cart_total ); ?></span>
		<?php endif; ?>
	</a>
</div>
