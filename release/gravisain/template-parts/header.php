<?php
/**
 * Template part for displaying the header markup
 *
 * @package Gravisain
 */

if ( ! apply_filters( 'gravisain_show_header', true ) || \Gravisain\Meta\PageSettings::is_header_hidden() ) {
	return;
}
?>
<?php do_action( 'gravisain_before_header' ); ?>
<header id="masthead" class="site-header">
	<?php
	// 1. Top Row
	get_template_part( 'template-parts/header/top-row' );

	// 2. Main Row
	get_template_part( 'template-parts/header/main-row' );

	// 3. Bottom Row
	get_template_part( 'template-parts/header/bottom-row' );

	// 4. Off-Canvas Drawer Panel
	get_template_part( 'template-parts/header/off-canvas' );
	?>
</header><!-- #masthead -->
<?php do_action( 'gravisain_after_header' ); ?>
