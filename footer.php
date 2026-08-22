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
	<span class="scroll-icon"><?php echo \Gravisain\Helpers\SVG::icon( 'arrow-up' ); ?></span>
</button>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
