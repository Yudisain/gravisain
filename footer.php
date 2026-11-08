<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #page div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gravisain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
	<?php do_action( 'gravisain_after_content' ); ?>

	<?php get_template_part( 'template-parts/footer' ); ?>

</div><!-- #page -->

<?php if ( is_singular( 'post' ) && get_theme_mod( 'gravisain_enable_reading_progress', true ) ) : ?>
	<div id="gravisain-reading-progress" class="gravisain-reading-progress" aria-hidden="true"></div>
<?php endif; ?>

<?php if ( get_theme_mod( 'gravisain_enable_scroll_top', true ) ) : ?>
<button id="gravisain-scroll-top" class="gravisain-scroll-top" aria-label="<?php esc_attr_e( 'Scroll to top', 'gravisain' ); ?>" title="<?php esc_attr_e( 'Scroll to top', 'gravisain' ); ?>">
	<svg class="progress-ring" width="44" height="44" viewBox="0 0 44 44">
		<circle class="progress-ring-circle-bg" stroke="currentColor" stroke-width="3" fill="transparent" r="18" cx="22" cy="22"/>
		<circle class="progress-ring-circle" stroke="currentColor" stroke-width="3" fill="transparent" r="18" cx="22" cy="22"/>
	</svg>
	<span class="scroll-icon"><?php echo wp_kses( \Gravisain\Helpers\SVG::icon( 'arrow-up' ), \Gravisain\Helpers\SVG::allowed_svg_html() ); ?></span>
</button>
<?php endif; ?>

<div id="gravisain-search-modal" class="gravisain-search-modal" aria-hidden="true">
	<div class="search-modal-backdrop" data-close="search-modal" tabindex="-1"></div>
	<div class="search-modal-container" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Search', 'gravisain' ); ?>">
		<div class="search-modal-header">
			<span class="search-modal-title"><?php esc_html_e( 'Search', 'gravisain' ); ?></span>
			<button type="button" class="search-modal-close-btn" aria-label="<?php esc_attr_e( 'Close search modal', 'gravisain' ); ?>" data-close="search-modal">
				<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
			</button>
		</div>
		<div class="search-modal-body">
			<?php get_search_form(); ?>
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
