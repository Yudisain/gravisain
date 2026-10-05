<?php
/**
 * Footer Navigation Component
 *
 * @package Gravisain\Components
 */

$selected_menu = get_theme_mod( 'gravisain_footer_nav_menu', '' );
?>
<div class="gfb-component gfb-footer-navigation" aria-label="<?php esc_attr_e( 'Footer Navigation', 'gravisain' ); ?>">
	<?php
	if ( ! empty( $selected_menu ) ) {
		wp_nav_menu( array(
			'menu'            => $selected_menu,
			'theme_location'  => '',
			'menu_id'         => 'footer-menu',
			'menu_class'      => 'footer-menu-list',
			'container_class' => 'footer-menu-container',
			'depth'           => 1,
			'fallback_cb'     => false,
		) );
	} elseif ( has_nav_menu( 'footer' ) ) {
		wp_nav_menu( array(
			'theme_location'  => 'footer',
			'menu_id'         => 'footer-menu',
			'menu_class'      => 'footer-menu-list',
			'container_class' => 'footer-menu-container',
			'depth'           => 1,
			'fallback_cb'     => false,
		) );
	} elseif ( is_customize_preview() ) {
		echo '<p class="gfb-notice">' . esc_html__( 'Please select a menu in Footer Navigation settings or assign a menu to Footer location.', 'gravisain' ) . '</p>';
	}
	?>
</div>
