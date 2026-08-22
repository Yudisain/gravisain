<?php
/**
 * The sidebar containing the main widget area (templates folder fallback)
 *
 * @package Gravisain
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area sidebar-area" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'gravisain' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
