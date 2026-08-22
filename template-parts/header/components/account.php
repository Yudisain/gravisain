<?php
/**
 * Account / User Profile Component
 *
 * @package Gravisain\Components
 */

$style      = get_theme_mod( 'gravisain_header_account_style', 'icon_label' );
$custom_url = get_theme_mod( 'gravisain_header_account_url', '' );
$visibility = get_theme_mod( 'gravisain_header_account_visibility', 'desktop,tablet,mobile' );

$classes = [ 'ghb-component', 'ghb-account', 'ghb-account-' . esc_attr( $style ) ];

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

$is_logged_in = is_user_logged_in();

if ( ! empty( $custom_url ) ) {
	$account_url = $custom_url;
} elseif ( function_exists( 'wc_get_page_permalink' ) && wc_get_page_permalink( 'myaccount' ) ) {
	$account_url = wc_get_page_permalink( 'myaccount' );
} else {
	$account_url = $is_logged_in ? admin_url( 'profile.php' ) : wp_login_url( get_permalink() );
}

$current_user = wp_get_current_user();
$label_text   = $is_logged_in ? $current_user->display_name : __( 'Sign In', 'gravisain' );
?>
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<a href="<?php echo esc_url( $account_url ); ?>" class="ghb-account-link" aria-label="<?php echo esc_attr( $label_text ); ?>">
		<?php if ( 'avatar' === $style && $is_logged_in ) : ?>
			<span class="ghb-account-avatar">
				<?php echo get_avatar( $current_user->ID, 26 ); ?>
			</span>
		<?php else : ?>
			<span class="ghb-account-icon" aria-hidden="true">
				<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
					<circle cx="12" cy="7" r="4"></circle>
				</svg>
			</span>
		<?php endif; ?>

		<?php if ( 'icon_label' === $style ) : ?>
			<span class="ghb-account-label"><?php echo esc_html( $label_text ); ?></span>
		<?php endif; ?>
	</a>
</div>
