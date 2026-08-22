<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gravisain
 */

get_header();

$layout      = get_theme_mod( 'gravisain_blog_archive_layout', 'grid' );
$cols        = absint( get_theme_mod( 'gravisain_blog_archive_grid_columns', 3 ) );
$sidebar_pos = get_theme_mod( 'gravisain_blog_archive_sidebar', 'right' );

$wrapper_class = 'posts-grid-wrapper layout-' . esc_attr( $layout );
if ( 'grid' === $layout ) {
	$wrapper_class .= ' cols-' . esc_attr( $cols );
}

$content_class = 'content-area-wrapper sidebar-' . esc_attr( $sidebar_pos ) . ' ' . \Gravisain\Helpers\LayoutHelper::get_container_style_class( 'archive' );
?>

<div class="site-content">
	<div class="<?php echo esc_attr( \Gravisain\Helpers\LayoutHelper::get_container_class( 'archive' ) ); ?>">
		<div class="<?php echo esc_attr( $content_class ); ?>">
			<main id="primary" class="site-main primary-content-area" tabindex="-1">
				<?php if ( have_posts() ) : ?>
					<?php if ( \Gravisain\Components\PageHeader::should_render_in_content_title() ) : ?>
						<header class="archive-header" style="margin-bottom: 2.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0;">
							<?php
							the_archive_title( '<h1 class="archive-title" style="font-size: 2rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem;">', '</h1>' );
							the_archive_description( '<div class="archive-description" style="color: #475569; font-size: 1.05rem;">', '</div>' );
							?>
						</header><!-- .archive-header -->
					<?php endif; ?>

					<div class="<?php echo esc_attr( $wrapper_class ); ?>">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content/content', get_post_type() );
						endwhile;
						?>
					</div><!-- .posts-grid-wrapper -->

					<div class="archive-pagination">
						<?php
						the_posts_pagination( [
							'mid_size'  => 2,
							'prev_text' => \Gravisain\Helpers\SVG::icon( 'arrow-left' ) . ' <span class="screen-reader-text">' . __( 'Previous page', 'gravisain' ) . '</span>',
							'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'gravisain' ) . '</span> ' . \Gravisain\Helpers\SVG::icon( 'arrow-right' ),
						] );
						?>
					</div>
				<?php else : ?>
					<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
				<?php endif; ?>
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
