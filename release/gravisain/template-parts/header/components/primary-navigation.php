<?php
/**
 * Primary Navigation Component
 *
 * @package Gravisain\Components
 */

$visibility = get_theme_mod( 'gravisain_header_primary_visibility', 'desktop,tablet,mobile' );
$classes = [ 'main-navigation', 'ghb-component' ];
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
?>
<nav id="site-navigation" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<?php
	wp_nav_menu( [
		'theme_location' => 'primary',
		'menu_id'        => 'primary-menu',
		'menu_class'     => 'primary-menu-list',
		'container'      => false,
		'fallback_cb'    => 'wp_page_menu',
	] );
	?>
</nav>
