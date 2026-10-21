<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gravisain
 */

$show_author_box = get_theme_mod( 'gravisain_single_post_author_box', true );
$show_post_nav   = get_theme_mod( 'gravisain_single_post_navigation', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-article' ); ?>>
	<?php if ( \Gravisain\Components\PageHeader::should_render_in_content_title() ) : ?>
		<header class="single-post-header">
			<?php the_title( '<h1 class="single-post-title">', '</h1>' ); ?>

			<div class="single-post-meta">
				<span class="meta-author">
					<?php echo \Gravisain\Helpers\SVG::icon( 'user' ); ?>
					<?php
					echo '<span class="byline-prefix">' . esc_html__( 'By', 'gravisain' ) . ' </span>';
					echo '<a href="' . esc_url( get_author_posts_url( (int) get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>';
					?>
				</span>

				<span class="meta-date">
					<?php echo \Gravisain\Helpers\SVG::icon( 'calendar' ); ?>
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
				</span>

				<?php if ( has_category() ) : ?>
					<span class="meta-category">
						<?php echo \Gravisain\Helpers\SVG::icon( 'tag' ); ?>
						<?php the_category( ', ' ); ?>
					</span>
				<?php endif; ?>

				<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
					<span class="meta-comments">
						<?php echo \Gravisain\Helpers\SVG::icon( 'comments' ); ?>
						<?php comments_popup_link( esc_html__( '0 Comments', 'gravisain' ), esc_html__( '1 Comment', 'gravisain' ), esc_html__( '% Comments', 'gravisain' ) ); ?>
					</span>
				<?php endif; ?>
			</div><!-- .single-post-meta -->
		</header><!-- .single-post-header -->
	<?php endif; ?>

	<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="single-post-thumbnail">
			<?php the_post_thumbnail( 'full' ); ?>
		</div>
	<?php endif; ?>

	<div class="single-post-content">
		<?php
		the_content();

		wp_link_pages( [
			'before' => '<div class="page-links" style="margin-top: 2rem; font-weight: 600;">' . esc_html__( 'Pages:', 'gravisain' ),
			'after'  => '</div>',
		] );
		?>
	</div><!-- .single-post-content -->

	<footer class="single-post-footer" style="margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px solid #f1f5f9;">
		<?php if ( has_tag() ) : ?>
			<div class="post-tags" style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: center; margin-bottom: 1.5rem;">
				<?php echo \Gravisain\Helpers\SVG::icon( 'tag', [ 'style' => 'color: #64748b;' ] ); ?>
				<span style="font-weight: 600; color: #334155; margin-right: 0.5rem;"><?php esc_html_e( 'Tags:', 'gravisain' ); ?></span>
				<?php the_tags( '<span class="tag-link" style="background: #f1f5f9; color: #475569; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; text-decoration: none;">', '</span><span class="tag-link" style="background: #f1f5f9; color: #475569; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; text-decoration: none;">', '</span>' ); ?>
			</div>
		<?php endif; ?>

		<?php \Gravisain\Components\SocialShare::render(); ?>
	</footer><!-- .single-post-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php if ( $show_author_box && get_the_author_meta( 'description' ) ) : ?>
	<div class="author-bio-box">
		<div class="author-bio-avatar">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
		</div>
		<div class="author-bio-content">
			<h3 class="author-bio-name">
				<?php
				printf(
					/* translators: %s: Author name */
					esc_html__( 'About %s', 'gravisain' ),
					esc_html( get_the_author() )
				);
				?>
			</h3>
			<p class="author-bio-desc">
				<?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?>
			</p>
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" style="color: var(--wp--preset--color--primary, #4f46e5); font-weight: 600; font-size: 0.9rem; text-decoration: none; display: inline-block; margin-top: 0.5rem;">
				<?php esc_html_e( 'View all posts &rarr;', 'gravisain' ); ?>
			</a>
		</div>
	</div><!-- .author-bio-box -->
<?php endif; ?>

<?php if ( $show_post_nav ) : ?>
	<nav class="post-navigation" aria-label="<?php esc_attr_e( 'Posts', 'gravisain' ); ?>">
		<div class="nav-links">
			<div class="nav-previous">
				<?php
				previous_post_link(
					'<span class="nav-subtitle" style="display: block; font-size: 0.8rem; color: #64748b; text-transform: uppercase; margin-bottom: 0.25rem;">' . esc_html__( '&larr; Previous Post', 'gravisain' ) . '</span>%link',
					'%title'
				);
				?>
			</div>
			<div class="nav-next" style="text-align: right; margin-left: auto;">
				<?php
				next_post_link(
					'<span class="nav-subtitle" style="display: block; font-size: 0.8rem; color: #64748b; text-transform: uppercase; margin-bottom: 0.25rem;">' . esc_html__( 'Next Post &rarr;', 'gravisain' ) . '</span>%link',
					'%title'
				);
				?>
			</div>
		</div>
	</nav><!-- .post-navigation -->
<?php endif; ?>

<?php \Gravisain\Components\RelatedPosts::render(); ?>
