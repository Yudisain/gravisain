<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gravisain
 */

?>

<section class="no-results not-found post-card" style="padding: 3rem; text-align: center;">
	<header class="page-header" style="margin-bottom: 1.5rem;">
		<h1 class="page-title" style="font-size: 1.75rem; font-weight: 700; color: #0f172a;">
			<?php esc_html_e( 'Nothing Found', 'gravisain' ); ?>
		</h1>
	</header><!-- .page-header -->

	<div class="page-content" style="color: #475569; line-height: 1.7; max-width: 600px; margin: 0 auto;">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'gravisain' ),
					[
						'a' => [
							'href' => [],
						],
					]
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);
		elseif ( is_search() ) :
			?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'gravisain' ); ?></p>
			<div style="margin-top: 2rem;">
				<?php get_search_form(); ?>
			</div>
			<?php
		else :
			?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'gravisain' ); ?></p>
			<div style="margin-top: 2rem;">
				<?php get_search_form(); ?>
			</div>
			<?php
		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
