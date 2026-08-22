<?php
/**
 * Menu Trigger (Hamburger Button) Component
 *
 * @package Gravisain\Components
 */

$style      = get_theme_mod( 'gravisain_header_trigger_style', '3-lines' );
$label      = get_theme_mod( 'gravisain_header_trigger_label', '' );
$visibility = get_theme_mod( 'gravisain_header_trigger_visibility', 'desktop,tablet,mobile' );

$classes = [ 'ghb-component', 'ghb-menu-trigger' ];
if ( ! empty( $visibility ) ) {
	if ( false === strpos( $visibility, 'desktop' ) ) {
		$classes[] = 'gravisain-hide-desktop';
	}
	if ( false === strpos( $visibility, 'tablet' ) ) {
		$classes[] = 'gravisain-hide-tablet';
	}
	if ( false === strpos( $visibility, 'mobile' ) ) {
		$classes[] = 'gravisain-hide-mobile';
	}
}
?>
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<button type="button" class="gravisain-menu-trigger style-<?php echo esc_attr( $style ); ?>" aria-label="<?php esc_attr_e( 'Open menu', 'gravisain' ); ?>" aria-expanded="false" aria-controls="gravisain-off-canvas" data-toggle="off-canvas">
		<span class="trigger-icon" aria-hidden="true">
			<?php if ( '2-lines' === $style ) : ?>
				<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="9" x2="20" y2="9"></line><line x1="4" y1="15" x2="20" y2="15"></line></svg>
			<?php elseif ( 'dots' === $style ) : ?>
				<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="5" cy="12" r="2"></circle><circle cx="12" cy="12" r="2"></circle><circle cx="19" cy="12" r="2"></circle></svg>
			<?php else : ?>
				<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
			<?php endif; ?>
		</span>
		<?php if ( ! empty( $label ) || is_customize_preview() ) : ?>
			<span class="trigger-label" <?php if ( empty( $label ) ) { echo 'style="display:none;"'; } ?>><?php echo esc_html( $label ); ?></span>
		<?php endif; ?>
	</button>
</div>
