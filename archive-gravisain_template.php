<?php
/**
 * The template for displaying Gravisain Template Archives
 *
 * @package Gravisain
 */

get_header(); ?>

<div class="site-content" style="background-color: var(--gravisain-global-color-6, #f8fafc); padding: 60px 0;">
	<div class="<?php echo esc_attr( \Gravisain\Helpers\LayoutHelper::get_container_class( 'archive' ) ); ?>">
		
		<header class="archive-header" style="text-align: center; margin-bottom: 40px;">
			<h1 style="font-size: 2.5rem; font-weight: 800; color: #0f172a; margin-bottom: 15px;"><?php esc_html_e( 'Gravisain Templates', 'gravisain' ); ?></h1>
			<p style="font-size: 1.15rem; color: #475569; max-width: 600px; margin: 0 auto;"><?php esc_html_e( 'Choose from our collection of premium, blazing-fast templates to kickstart your next project.', 'gravisain' ); ?></p>
		</header>

		<?php
		$terms = get_terms( [
			'taxonomy'   => 'template_category',
			'hide_empty' => true,
		] );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
		?>
		<div class="template-filters" style="display: flex; justify-content: center; gap: 10px; margin-bottom: 40px; flex-wrap: wrap;">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'gravisain_template' ) ); ?>" class="button <?php echo ! is_tax( 'template_category' ) ? 'active' : ''; ?>" style="border-radius: 99px; padding: 8px 20px; font-weight: 600; text-decoration: none; background: <?php echo ! is_tax( 'template_category' ) ? '#4f46e5' : '#fff'; ?>; color: <?php echo ! is_tax( 'template_category' ) ? '#fff' : '#475569'; ?>; border: 1px solid #cbd5e1; transition: all 0.2s;"><?php esc_html_e( 'All Templates', 'gravisain' ); ?></a>
			<?php foreach ( $terms as $term ) : ?>
				<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="button <?php echo is_tax( 'template_category', $term->term_id ) ? 'active' : ''; ?>" style="border-radius: 99px; padding: 8px 20px; font-weight: 600; text-decoration: none; background: <?php echo is_tax( 'template_category', $term->term_id ) ? '#4f46e5' : '#fff'; ?>; color: <?php echo is_tax( 'template_category', $term->term_id ) ? '#fff' : '#475569'; ?>; border: 1px solid #cbd5e1; transition: all 0.2s;"><?php echo esc_html( $term->name ); ?></a>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<div class="templates-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					$demo_url = get_post_meta( get_the_ID(), '_gravisain_demo_url', true );
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'template-card' ); ?> style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; transition: transform 0.3s ease, box-shadow 0.3s ease;">
						
						<a href="<?php the_permalink(); ?>" style="display: block; position: relative; padding-top: 66.66%; overflow: hidden; background: #f1f5f9;">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'large', [ 'style' => 'position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;' ] ); ?>
							<?php else: ?>
								<div style="position: absolute; top:0; left:0; width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:#94a3b8;">
									<svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
								</div>
							<?php endif; ?>
						</a>

						<div class="template-content" style="padding: 24px;">
							<?php
							$terms = get_the_terms( get_the_ID(), 'template_category' );
							if ( $terms && ! is_wp_error( $terms ) ) {
								$term = array_shift( $terms );
								echo '<span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; color: #4f46e5; margin-bottom: 8px; display: block;">' . esc_html( $term->name ) . '</span>';
							}
							?>
							<?php the_title( '<h2 class="template-title" style="font-size: 1.25rem; font-weight: 700; margin: 0 0 12px 0; line-height: 1.4;"><a href="' . esc_url( get_permalink() ) . '" style="color: #0f172a; text-decoration: none;">', '</a></h2>' ); ?>
							
							<div class="template-actions" style="display: flex; gap: 10px; margin-top: 20px;">
								<a href="<?php the_permalink(); ?>" style="flex: 1; text-align: center; padding: 10px; background: #f8fafc; color: #334155; border: 1px solid #cbd5e1; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: background 0.2s;"><?php esc_html_e( 'Details', 'gravisain' ); ?></a>
								<?php if ( $demo_url ) : ?>
									<a href="<?php echo esc_url( $demo_url ); ?>" target="_blank" rel="noopener noreferrer" style="flex: 1; text-align: center; padding: 10px; background: #4f46e5; color: #fff; border: 1px solid #4f46e5; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: background 0.2s;"><?php esc_html_e( 'Live Demo', 'gravisain' ); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</article>
					<?php
				endwhile;
			else :
				echo '<div class="no-templates" style="grid-column: 1 / -1; text-align: center; padding: 40px; background: #fff; border-radius: 12px; border: 1px dashed #cbd5e1;"><p style="font-size: 1.1rem; color: #64748b;">' . esc_html__( 'No templates found.', 'gravisain' ) . '</p></div>';
			endif;
			?>
		</div><!-- .templates-grid -->

		<div class="archive-pagination" style="margin-top: 40px; text-align: center;">
			<?php
			the_posts_pagination( [
				'mid_size'  => 2,
				'prev_text' => __( '&laquo; Prev', 'gravisain' ),
				'next_text' => __( 'Next &raquo;', 'gravisain' ),
			] );
			?>
		</div>

	</div><!-- .container -->
</div><!-- .site-content -->

<style>
	.template-card:hover {
		transform: translateY(-4px);
		box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05) !important;
	}
	.template-card:hover a img {
		transform: scale(1.03);
	}
	.template-filters a.button:hover {
		background: #f1f5f9 !important;
		border-color: #cbd5e1 !important;
	}
	.template-filters a.button.active:hover {
		background: #4338ca !important;
		border-color: #4338ca !important;
	}
	.template-actions a:hover {
		filter: brightness(0.95);
	}
	@media (max-width: 640px) {
		.templates-grid {
			grid-template-columns: 1fr !important;
			gap: 20px !important;
		}
		.template-card {
			width: 100% !important;
			box-sizing: border-box !important;
		}
		.template-filters {
			flex-wrap: nowrap !important;
			overflow-x: auto !important;
			justify-content: flex-start !important;
			gap: 8px !important;
			padding: 4px 4px 14px !important;
			margin-bottom: 24px !important;
			-webkit-overflow-scrolling: touch;
			scrollbar-width: none;
		}
		.template-filters::-webkit-scrollbar {
			display: none;
		}
		.template-filters a.button {
			flex-shrink: 0 !important;
			white-space: nowrap !important;
			padding: 7px 16px !important;
			font-size: 0.85rem !important;
		}
	}
</style>

<?php get_footer();
