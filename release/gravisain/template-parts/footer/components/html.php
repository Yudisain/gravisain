<?php
/**
 * Footer Custom HTML Component
 *
 * @package Gravisain\Components
 */

$html_content = get_theme_mod( 'gravisain_footer_html_content', '' );
$visibility   = get_theme_mod( 'gravisain_footer_html_visibility', 'desktop,tablet,mobile' );

if ( empty( trim( $html_content ) ) && ! is_customize_preview() ) {
	return;
}

$classes = [ 'gfb-component', 'gfb-custom-html' ];

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
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<?php
	if ( ! empty( $html_content ) ) {
		echo do_shortcode( $html_content );
	} elseif ( is_customize_preview() ) {
		echo '<span class="gfb-placeholder-text">' . esc_html__( 'Add Custom HTML / Shortcode here...', 'gravisain' ) . '</span>';
	}
	?>
</div>
