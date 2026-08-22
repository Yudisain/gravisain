<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gravisain
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-page-article' ); ?>>
	<?php if ( \Gravisain\Components\PageHeader::should_render_in_content_title() ) : ?>
		<header class="entry-header" style="margin-bottom: 2rem;">
			<?php the_title( '<h1 class="entry-title" style="font-size: 2.5rem; font-weight: 800; color: #0f172a; margin-bottom: 1rem;">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="page-thumbnail" style="margin-bottom: 2.5rem; border-radius: 12px; overflow: hidden; max-height: 450px;">
			<?php the_post_thumbnail( 'full', [ 'style' => 'width: 100%; height: 100%; object-fit: cover;' ] ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content" style="font-size: 1.125rem; line-height: 1.8; color: #334155;">
		<?php
		the_content();

		wp_link_pages( [
			'before' => '<div class="page-links" style="margin-top: 2rem; font-weight: 600;">' . esc_html__( 'Pages:', 'gravisain' ),
			'after'  => '</div>',
		] );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
