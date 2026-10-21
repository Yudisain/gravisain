<?php
/**
 * Template part for displaying the Main Row Header
 *
 * @package Gravisain
 */

if ( \Gravisain\Components\HeaderBuilder::is_row_empty( 'main' ) ) {
	return;
}

$visibility = get_theme_mod( 'gravisain_header_main_visibility', 'desktop,tablet,mobile' );
$layout     = get_theme_mod( 'gravisain_header_main_layout', 'full-contained' );
$classes    = [ 'site-header-row', 'site-header-main', 'layout-' . sanitize_html_class( $layout ) ];

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
		<div class="row">
			<div class="col-left">
				<?php \Gravisain\Components\HeaderBuilder::render_column( 'main', 'left' ); ?>
			</div>
			<div class="col-center">
				<?php \Gravisain\Components\HeaderBuilder::render_column( 'main', 'center' ); ?>
			</div>
			<div class="col-right">
				<?php \Gravisain\Components\HeaderBuilder::render_column( 'main', 'right' ); ?>
			</div>
		</div>
	</div>
</div>
