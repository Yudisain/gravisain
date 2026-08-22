<?php
/**
 * Template part for displaying Related Posts on single articles.
 *
 * @package Gravisain
 */

use Gravisain\Components\RelatedPosts;

if ( ! RelatedPosts::should_render() ) {
	return;
}

$limit = (int) get_theme_mod( 'gravisain_single_post_related_count', 3 );
$query = RelatedPosts::get_related_posts( get_the_ID(), $limit );

if ( ! $query->have_posts() ) {
	return;
}
?>
<section class="gravisain-related-posts" aria-labelledby="related-posts-heading">
	<div class="related-posts-header">
		<h3 id="related-posts-heading" class="related-posts-title">
			<?php esc_html_e( 'Related Articles', 'gravisain' ); ?>
		</h3>
	</div>

	<div class="related-posts-grid columns-<?php echo esc_attr( (string) min( $limit, 3 ) ); ?>">
		<?php
		while ( $query->have_posts() ) :
			$query->the_post();
			?>
			<article id="related-post-<?php the_ID(); ?>" <?php post_class( 'related-post-card' ); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>" class="related-post-thumb-link" aria-label="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail( 'medium', [ 'class' => 'related-post-img', 'loading' => 'lazy' ] ); ?>
					</a>
				<?php endif; ?>

				<div class="related-post-body">
					<?php
					$categories = get_the_category();
					if ( ! empty( $categories ) ) :
						?>
						<span class="related-post-category"><?php echo esc_html( $categories[0]->name ); ?></span>
					<?php endif; ?>

					<h4 class="related-post-item-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h4>

					<div class="related-post-meta">
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					</div>
				</div>
			</article>
			<?php
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</section>
