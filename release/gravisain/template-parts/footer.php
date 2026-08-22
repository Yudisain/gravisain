<?php
/**
 * Template part for displaying the footer markup
 *
 * @package Gravisain
 */

if ( ! apply_filters( 'gravisain_show_footer', true ) || \Gravisain\Meta\PageSettings::is_footer_hidden() ) {
	return;
}
?>
<?php do_action( 'gravisain_before_footer' ); ?>
<footer id="colophon" class="site-footer">
	<?php
	// 1. Top Row
	get_template_part( 'template-parts/footer/top-row' );

	// 2. Main Row
	get_template_part( 'template-parts/footer/main-row' );

	// 3. Bottom Row
	get_template_part( 'template-parts/footer/bottom-row' );

	if ( is_customize_preview() ) {
		// Ensure WordPress Customizer always registers all 4 footer sidebars as rendered on the page
		for ( $i = 1; $i <= 4; $i++ ) {
			ob_start();
			dynamic_sidebar( 'footer-widget-' . $i );
			ob_end_clean();
		}
	}
	?>
</footer><!-- #colophon -->
<?php do_action( 'gravisain_after_footer' ); ?>
