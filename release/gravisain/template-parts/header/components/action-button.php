<?php
/**
 * Action Button Component
 *
 * @package Gravisain\Components
 */

$text   = get_theme_mod( 'gravisain_header_button_text', __( 'Get Started', 'gravisain' ) );
$url    = get_theme_mod( 'gravisain_header_button_url', '#' );
$target = get_theme_mod( 'gravisain_header_button_target', false ) ? '_blank' : '_self';
$style = get_theme_mod( 'gravisain_header_button_style', 'fill' );
$size  = get_theme_mod( 'gravisain_header_button_size', 'md' );

$visibility = get_theme_mod( 'gravisain_header_button_visibility', 'desktop,tablet,mobile' );

if ( empty( $text ) && ! is_customize_preview() ) {
	return;
}

$classes = [ 'ghb-component', 'ghb-action-button-wrapper' ];

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

$btn_classes = [ 'gravisain-btn', 'gravisain-btn-' . esc_attr( $style ) ];
if ( 'custom' !== $size ) {
	$btn_classes[] = 'gravisain-btn-' . esc_attr( $size );
} else {
	$btn_classes[] = 'gravisain-btn-custom';
}
?>
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php echo esc_attr( implode( ' ', $btn_classes ) ); ?>" <?php echo '_blank' === $target ? 'rel="noopener noreferrer"' : ''; ?>>
		<?php echo esc_html( ! empty( $text ) ? $text : __( 'Get Started', 'gravisain' ) ); ?>
	</a>
</div>
