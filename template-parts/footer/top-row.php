<?php
/**
 * Template part for displaying the Top Row Footer
 *
 * @package Gravisain
 */

if ( \Gravisain\Components\FooterBuilder::is_row_empty( 'top' ) ) {
	return;
}

$columns    = absint( get_theme_mod( 'gravisain_footer_top_columns', 1 ) );
$visibility = get_theme_mod( 'gravisain_footer_top_visibility', 'desktop,tablet,mobile' );
$layout     = get_theme_mod( 'gravisain_footer_top_layout', 'full-contained' );
$classes    = [ 'site-footer-row', 'site-footer-top', 'cols-' . $columns, 'layout-' . sanitize_html_class( $layout ) ];

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
		<div class="footer-row-grid grid-cols-<?php echo esc_attr( $columns ); ?>">
			<?php for ( $i = 1; $i <= $columns; $i++ ) : ?>
				<div class="footer-col col-<?php echo esc_attr( $i ); ?>">
					<?php \Gravisain\Components\FooterBuilder::render_column( 'top', 'col-' . $i ); ?>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</div>
