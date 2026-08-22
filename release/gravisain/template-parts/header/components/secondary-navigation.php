<?php
/**
 * Secondary Navigation Component
 *
 * @package Gravisain\Components
 */
?>
<nav id="secondary-navigation" class="secondary-navigation ghb-component" aria-label="<?php esc_attr_e( 'Secondary Navigation', 'gravisain' ); ?>">
	<?php
	wp_nav_menu( [
		'theme_location' => 'secondary',
		'menu_id'        => 'secondary-menu',
		'menu_class'     => 'secondary-menu-list',
		'fallback_cb'    => 'wp_page_menu',
		'depth'          => 2,
	] );
	?>
</nav>
