<?php
/**
 * Template part for displaying post archives and single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gravisain
 */

$meta_setting = get_theme_mod( 'gravisain_blog_archive_meta', 'author,date,category,comments' );
$meta_elements = is_string( $meta_setting ) ? array_map( 'trim', explode( ',', $meta_setting ) ) : (array) $meta_setting;
$read_more_text = get_theme_mod( 'gravisain_blog_archive_read_more', __( 'Read More &rarr;', 'gravisain' ) );
$excerpt_length = absint( get_theme_mod( 'gravisain_blog_archive_excerpt_length', 25 ) );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( is_singular() ? 'single-post-article' : 'post-card' ); ?>>
	<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="<?php echo is_singular() ? 'single-post-thumbnail' : 'post-card-thumbnail'; ?>">
			<?php if ( ! is_singular() ) : ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail( 'large' ); ?>
				</a>
			<?php else : ?>
				<?php the_post_thumbnail( 'full' ); ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="<?php echo is_singular() ? 'single-post-body' : 'post-card-content'; ?>">
		<header class="<?php echo is_singular() ? 'single-post-header' : 'post-card-header'; ?>">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="single-post-title">', '</h1>' );
			else :
				the_title( '<h2 class="post-card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			?>

			<div class="<?php echo is_singular() ? 'single-post-meta' : 'post-card-meta'; ?>">
				<?php if ( in_array( 'author', $meta_elements, true ) ) : ?>
					<span class="meta-author">
						<?php echo \Gravisain\Helpers\SVG::icon( 'user' ); ?>
						<?php
						printf(
							/* translators: %s: Author name */
							esc_html__( 'By %s', 'gravisain' ),
							'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
						);
						?>
					</span>
				<?php endif; ?>

				<?php if ( in_array( 'date', $meta_elements, true ) ) : ?>
					<span class="meta-date">
						<?php echo \Gravisain\Helpers\SVG::icon( 'calendar' ); ?>
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					</span>
				<?php endif; ?>

				<?php if ( in_array( 'category', $meta_elements, true ) && has_category() ) : ?>
					<span class="meta-category">
						<?php echo \Gravisain\Helpers\SVG::icon( 'tag' ); ?>
						<?php the_category( ', ' ); ?>
					</span>
				<?php endif; ?>

				<?php if ( in_array( 'comments', $meta_elements, true ) && ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
					<span class="meta-comments">
						<?php echo \Gravisain\Helpers\SVG::icon( 'comments' ); ?>
						<?php comments_popup_link( esc_html__( '0 Comments', 'gravisain' ), esc_html__( '1 Comment', 'gravisain' ), esc_html__( '% Comments', 'gravisain' ) ); ?>
					</span>
				<?php endif; ?>
			</div><!-- .post-meta -->
		</header>

		<div class="<?php echo is_singular() ? 'single-post-content' : 'post-card-excerpt'; ?>">
			<?php
			if ( is_singular() ) :
				the_content();

				wp_link_pages( [
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gravisain' ),
					'after'  => '</div>',
				] );
			else :
				if ( has_excerpt() ) :
					the_excerpt();
				else :
					echo wp_kses_post( wp_trim_words( get_the_content(), $excerpt_length, '&hellip;' ) );
				endif;
			endif;
			?>
		</div>

		<?php if ( ! is_singular() ) : ?>
			<footer class="post-card-footer">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more-link">
					<?php echo wp_kses_post( $read_more_text ); ?>
				</a>
			</footer>
		<?php endif; ?>
	</div><!-- .post-card-content / .single-post-body -->
</article><!-- #post-<?php the_ID(); ?> -->
