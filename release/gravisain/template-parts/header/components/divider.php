<?php
/**
 * Divider / Vertical Line Component
 *
 * @package Gravisain\Components
 */

$visibility = get_theme_mod( 'gravisain_header_divider_visibility', 'desktop,tablet' );
$classes    = [ 'ghb-component', 'ghb-divider' ];

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
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" aria-hidden="true">
	<span class="ghb-divider-line"></span>
</div>
