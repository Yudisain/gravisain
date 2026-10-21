<?php
/**
 * Template part for displaying the Main Row Footer
 *
 * @package Gravisain
 */

if ( \Gravisain\Components\FooterBuilder::is_row_empty( 'main' ) ) {
	return;
}

$columns    = absint( get_theme_mod( 'gravisain_footer_main_columns', 4 ) );
$visibility = get_theme_mod( 'gravisain_footer_main_visibility', 'desktop,tablet,mobile' );
$layout     = get_theme_mod( 'gravisain_footer_main_layout', 'full-contained' );
$classes    = [ 'site-footer-row', 'site-footer-main', 'cols-' . $columns, 'layout-' . sanitize_html_class( $layout ) ];

$active_devices = ( '' !== $visibility && 'none' !== $visibility && null !== $visibility && ! empty( $visibility ) )
	? array_filter( array_map( 'trim', explode( ',', (string) $visibility ) ) )
	: [];

if ( ! in_array( 'desktop', $active_devices, true ) ) {
	$classes[] = 'gravisain-hide-desktop';
}
if ( ! in_array( 'tablet', $active_devices, true ) ) {
	$classes[] = 'gravisain-hide-tablet';
}
if ( ! in_array( 'mobile', $active_devices, true ) ) {
	$classes[] = 'gravisain-hide-mobile';
}
?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="container">
		<div class="footer-row-grid grid-cols-<?php echo esc_attr( $columns ); ?>">
			<?php for ( $i = 1; $i <= $columns; $i++ ) : ?>
				<div class="footer-col col-<?php echo esc_attr( $i ); ?>">
					<?php \Gravisain\Components\FooterBuilder::render_column( 'main', 'col-' . $i ); ?>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</div>
