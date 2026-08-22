<?php
/**
 * Template part for displaying the Top Row Header
 *
 * @package Gravisain
 */

if ( \Gravisain\Components\HeaderBuilder::is_row_empty( 'top' ) ) {
	return;
}

$visibility = get_theme_mod( 'gravisain_header_top_visibility', 'desktop,tablet,mobile' );
$layout     = get_theme_mod( 'gravisain_header_top_layout', 'full-contained' );
$classes    = [ 'site-header-row', 'site-header-top-row', 'layout-' . sanitize_html_class( $layout ) ];

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
				<?php \Gravisain\Components\HeaderBuilder::render_column( 'top', 'left' ); ?>
			</div>
			<div class="col-center">
				<?php \Gravisain\Components\HeaderBuilder::render_column( 'top', 'center' ); ?>
			</div>
			<div class="col-right">
				<?php \Gravisain\Components\HeaderBuilder::render_column( 'top', 'right' ); ?>
			</div>
		</div>
	</div>
</div>
