<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Gravisain
 */

get_header();
?>

<div class="site-content" style="padding: 5rem 0;">
	<div class="container" style="max-width: 700px; margin: 0 auto; text-align: center;">
		<main id="primary" class="site-main" tabindex="-1">
			<section class="error-404 not-found post-card" style="padding: 4rem 2rem;">
				<header class="page-header" style="margin-bottom: 2rem;">
					<h1 class="page-title" style="font-size: 5rem; font-weight: 900; color: var(--wp--preset--color--primary, #4f46e5); line-height: 1; margin-bottom: 1rem;">
						<?php esc_html_e( '404', 'gravisain' ); ?>
					</h1>
					<h2 style="font-size: 1.75rem; font-weight: 700; color: #0f172a; margin-bottom: 1rem;">
						<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'gravisain' ); ?>
					</h2>
					<p style="color: #64748b; font-size: 1.1rem; max-width: 500px; margin: 0 auto;">
						<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try running a search below to find what you were looking for?', 'gravisain' ); ?>
					</p>
				</header><!-- .page-header -->

				<div class="page-content" style="max-width: 450px; margin: 2rem auto 0;">
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #primary -->
	</div><!-- .container -->
</div><!-- .site-content -->

<?php
get_footer();
