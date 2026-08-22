<?php
/**
 * Search Component
 *
 * @package Gravisain\Components
 */

$style = get_theme_mod( 'gravisain_header_search_style', 'icon' );
?>
<div class="ghb-component ghb-search ghb-search-<?php echo esc_attr( $style ); ?>">
	<?php if ( 'inline' === $style ) : ?>
		<?php get_search_form(); ?>
	<?php else : ?>
		<button type="button" class="search-toggle-btn" aria-label="<?php esc_attr_e( 'Open Search Modal', 'gravisain' ); ?>" aria-expanded="false" data-toggle="search-modal">
			<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<circle cx="11" cy="11" r="8"></circle>
				<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
			</svg>
		</button>
	<?php endif; ?>
</div>
