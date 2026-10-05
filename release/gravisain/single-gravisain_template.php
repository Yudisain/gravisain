<?php
/**
 * The template for displaying single Gravisain Templates
 *
 * @package Gravisain
 */

get_header(); ?>

<div class="site-content" style="background-color: var(--gravisain-global-color-6, #f8fafc); padding: 60px 0;">
	<div class="<?php echo esc_attr( \Gravisain\Helpers\LayoutHelper::get_container_class( 'single' ) ); ?>" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
		
		<?php
		while ( have_posts() ) :
			the_post();
			$demo_url = get_post_meta( get_the_ID(), '_gravisain_demo_url', true );
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<header class="template-header" style="text-align: center; margin-bottom: 50px;">
					<?php
					$terms = get_the_terms( get_the_ID(), 'template_category' );
					if ( $terms && ! is_wp_error( $terms ) ) {
						$term = array_shift( $terms );
						echo '<a href="' . esc_url( get_term_link( $term ) ) . '" style="display: inline-block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; color: #4f46e5; margin-bottom: 15px; text-decoration: none; padding: 6px 12px; background: #e0e7ff; border-radius: 99px;">' . esc_html( $term->name ) . '</a>';
					}
					?>
					<?php the_title( '<h1 style="font-size: 3rem; font-weight: 800; color: #0f172a; margin: 0 0 20px 0; line-height: 1.2;">', '</h1>' ); ?>
					
					<?php if ( has_excerpt() ) : ?>
						<div class="template-excerpt" style="font-size: 1.25rem; color: #475569; max-width: 700px; margin: 0 auto 30px auto; line-height: 1.7;">
							<?php the_excerpt(); ?>
						</div>
					<?php endif; ?>

					<div class="template-hero-actions" style="display: flex; justify-content: center; gap: 15px;">
						<?php if ( $demo_url ) : ?>
							<a href="<?php echo esc_url( $demo_url ); ?>" target="_blank" rel="noopener noreferrer" style="display: inline-block; padding: 14px 28px; background: #4f46e5; color: #fff; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 1.05rem; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3); transition: transform 0.2s, box-shadow 0.2s;">
								<span style="display: flex; align-items: center; gap: 8px;">
									<svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
									View Live Demo
								</span>
							</a>
						<?php endif; ?>
						<a href="#features" style="display: inline-block; padding: 14px 28px; background: #fff; color: #0f172a; border: 1px solid #cbd5e1; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 1.05rem; transition: background 0.2s;">Explore Features</a>
					</div>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="template-featured-image" style="margin-bottom: 60px; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); border: 1px solid #e2e8f0; background: #fff;">
						<?php the_post_thumbnail( 'full', [ 'style' => 'width: 100%; height: auto; display: block;' ] ); ?>
					</div>
				<?php endif; ?>

				<div id="features" class="template-content-wrapper" style="display: grid; grid-template-columns: 1fr; gap: 40px; max-width: 900px; margin: 0 auto;">
					
					<div class="template-main-content" style="background: #fff; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
						<h2 style="font-size: 1.75rem; font-weight: 700; margin-top: 0; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #e2e8f0;">Template Description</h2>
						<div class="entry-content" style="font-size: 1.1rem; line-height: 1.8; color: #334155;">
							<?php the_content(); ?>
						</div>
					</div>

				</div>

			</article>
			<?php
		endwhile;
		?>
	</div><!-- .container -->
</div><!-- .site-content -->

<style>
	.template-hero-actions a:hover {
		transform: translateY(-2px);
		box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);
	}
	.template-hero-actions a[href="#features"]:hover {
		background: #f1f5f9;
		box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
	}
</style>

<?php get_footer();
