<?php
/**
 * Template part for displaying the Bottom Row Header
 *
 * @package Gravisain
 */

if ( \Gravisain\Components\HeaderBuilder::is_row_empty( 'bottom' ) ) {
	return;
}

$visibility = get_theme_mod( 'gravisain_header_bottom_visibility', 'desktop,tablet,mobile' );
$layout     = get_theme_mod( 'gravisain_header_bottom_layout', 'full-contained' );
$classes    = [ 'site-header-row', 'site-header-bottom-row', 'layout-' . sanitize_html_class( $layout ) ];

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
	<div class="container">
		<div class="row">
			<div class="col-left">
				<?php \Gravisain\Components\HeaderBuilder::render_column( 'bottom', 'left' ); ?>
			</div>
			<div class="col-center">
				<?php \Gravisain\Components\HeaderBuilder::render_column( 'bottom', 'center' ); ?>
			</div>
			<div class="col-right">
				<?php \Gravisain\Components\HeaderBuilder::render_column( 'bottom', 'right' ); ?>
			</div>
		</div>
	</div>
</div>
