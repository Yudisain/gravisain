<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gravisain
 */

get_header();

$sidebar_pos   = get_theme_mod( 'gravisain_page_sidebar', 'none' );
$meta_sidebar  = \Gravisain\Meta\PageSettings::get_sidebar_layout();
if ( 'default' !== $meta_sidebar ) {
	if ( in_array( $meta_sidebar, [ 'no-sidebar', 'normal', 'narrow', 'fullwidth' ], true ) ) {
		$sidebar_pos = 'none';
	} elseif ( 'left-sidebar' === $meta_sidebar ) {
		$sidebar_pos = 'left';
	} elseif ( 'right-sidebar' === $meta_sidebar ) {
		$sidebar_pos = 'right';
	}
}
$style_class   = \Gravisain\Helpers\LayoutHelper::get_container_style_class( 'page' );
$content_class = 'content-area-wrapper sidebar-' . esc_attr( $sidebar_pos ) . ' ' . $style_class;
if ( in_array( $meta_sidebar, [ 'normal', 'narrow', 'no-sidebar' ], true ) && strpos( $content_class, 'layout-' . $meta_sidebar ) === false ) {
	$content_class .= ' layout-' . esc_attr( $meta_sidebar );
}
?>

<div class="site-content">
	<div class="<?php echo esc_attr( \Gravisain\Helpers\LayoutHelper::get_container_class( 'page' ) ); ?>">
		<div class="<?php echo esc_attr( $content_class ); ?>">
			<main id="primary" class="site-main primary-content-area" tabindex="-1">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</main><!-- #primary -->

			<?php
			if ( 'none' !== $sidebar_pos ) {
				get_sidebar();
			}
			?>
		</div><!-- .content-area-wrapper -->
	</div><!-- .container -->
</div><!-- .site-content -->

<?php
get_footer();
