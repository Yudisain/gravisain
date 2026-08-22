<?php
/**
 * Off-Canvas Drawer Panel
 *
 * @package Gravisain\Components
 */

$direction = get_theme_mod( 'gravisain_offcanvas_direction', 'right' );
?>
<div id="gravisain-off-canvas" class="gravisain-off-canvas slide-from-<?php echo esc_attr( $direction ); ?>" aria-hidden="true">
	<div class="off-canvas-backdrop" data-close="off-canvas" tabindex="-1"></div>
	<div class="off-canvas-container" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Mobile Navigation Drawer', 'gravisain' ); ?>">
		<div class="off-canvas-header">
			<div class="off-canvas-title">
				<?php bloginfo( 'name' ); ?>
			</div>
			<button type="button" class="off-canvas-close-btn" aria-label="<?php esc_attr_e( 'Close menu', 'gravisain' ); ?>" data-close="off-canvas">
				<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
			</button>
		</div>

		<div class="off-canvas-body">
			<nav class="off-canvas-navigation" aria-label="<?php esc_attr_e( 'Off-Canvas Mobile Menu', 'gravisain' ); ?>">
				<?php
				$target = get_theme_mod( 'gravisain_header_trigger_target_menu', 'primary' );

				if ( 'off-canvas' === $target ) {
					if ( has_nav_menu( 'off-canvas' ) ) {
						wp_nav_menu( [
							'theme_location' => 'off-canvas',
							'menu_id'        => 'off-canvas-menu',
							'menu_class'     => 'off-canvas-menu-list',
							'fallback_cb'    => false,
						] );
					} else {
						echo '<p class="off-canvas-empty-notice">' . esc_html__( 'Please assign a menu to Off-Canvas Mobile Navigation location.', 'gravisain' ) . '</p>';
					}
				} elseif ( 'secondary' === $target ) {
					if ( has_nav_menu( 'secondary' ) ) {
						wp_nav_menu( [
							'theme_location' => 'secondary',
							'menu_id'        => 'off-canvas-secondary-menu',
							'menu_class'     => 'off-canvas-menu-list',
							'fallback_cb'    => false,
						] );
					} else {
						echo '<p class="off-canvas-empty-notice">' . esc_html__( 'Please assign a menu to Secondary Navigation location.', 'gravisain' ) . '</p>';
					}
				} elseif ( 'both' === $target ) {
					// Render Primary
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( [
							'theme_location' => 'primary',
							'menu_id'        => 'off-canvas-primary-menu',
							'menu_class'     => 'off-canvas-menu-list',
							'fallback_cb'    => false,
						] );
					}
					// Render Secondary
					if ( has_nav_menu( 'secondary' ) ) {
						wp_nav_menu( [
							'theme_location' => 'secondary',
							'menu_id'        => 'off-canvas-secondary-menu',
							'menu_class'     => 'off-canvas-menu-list off-canvas-secondary-menu-list',
							'fallback_cb'    => false,
						] );
					}
					if ( ! has_nav_menu( 'primary' ) && ! has_nav_menu( 'secondary' ) ) {
						echo '<p class="off-canvas-empty-notice">' . esc_html__( 'Please assign a menu to Primary or Secondary Navigation locations.', 'gravisain' ) . '</p>';
					}
				} else {
					// Default to Primary
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( [
							'theme_location' => 'primary',
							'menu_id'        => 'off-canvas-primary-menu',
							'menu_class'     => 'off-canvas-menu-list',
							'fallback_cb'    => false,
						] );
					} else {
						echo '<p class="off-canvas-empty-notice">' . esc_html__( 'Please assign a menu to Primary Navigation location.', 'gravisain' ) . '</p>';
					}
				}
				?>
			</nav>
		</div>

		<div class="off-canvas-footer">
			<?php
			// Render social icons in off-canvas footer if configured
			$template = locate_template( 'template-parts/header/components/social.php' );
			if ( $template ) {
				load_template( $template, false );
			}
			?>
		</div>
	</div>
</div>
