<?php
/**
 * Theme Switcher Component (Light / Dark / System)
 *
 * @package Gravisain\Components
 */

$style         = get_theme_mod( 'gravisain_header_theme_switcher_style', 'dropdown' );
$default_mode  = get_theme_mod( 'gravisain_header_theme_switcher_default', 'system' );
$show_label    = (bool) get_theme_mod( 'gravisain_header_theme_switcher_show_label', false );
$visibility    = get_theme_mod( 'gravisain_header_theme_switcher_visibility', 'desktop,tablet,mobile' );

$classes = [
	'ghb-component',
	'ghb-theme-switcher',
	'ghb-theme-switcher-' . esc_attr( $style ),
];

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
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-default-theme="<?php echo esc_attr( $default_mode ); ?>" data-switcher-style="<?php echo esc_attr( $style ); ?>">
	<div class="ghb-theme-wrapper">
		<?php if ( 'switch' === $style ) : ?>
			<!-- Sliding Switch Button (Pill / iOS Style) -->
			<button
				type="button"
				class="ghb-theme-switch-slider"
				role="switch"
				aria-checked="false"
				aria-label="<?php esc_attr_e( 'Toggle Color Theme', 'gravisain' ); ?>"
				title="<?php esc_attr_e( 'Toggle Light / Dark Mode', 'gravisain' ); ?>"
			>
				<span class="ghb-switch-track">
					<span class="ghb-switch-icon ghb-switch-sun" aria-hidden="true">
						<svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
						</svg>
					</span>
					<span class="ghb-switch-icon ghb-switch-moon" aria-hidden="true">
						<svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
						</svg>
					</span>
					<span class="ghb-switch-thumb">
						<span class="ghb-thumb-sun" aria-hidden="true">
							<svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
							</svg>
						</span>
						<span class="ghb-thumb-moon" aria-hidden="true">
							<svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
							</svg>
						</span>
					</span>
				</span>
				<?php if ( $show_label ) : ?>
					<span class="ghb-theme-btn-label"><?php esc_html_e( 'Theme', 'gravisain' ); ?></span>
				<?php endif; ?>
			</button>
		<?php else : ?>
			<!-- Standard Icon Button -->
			<button
				type="button"
				class="ghb-theme-btn"
				aria-label="<?php esc_attr_e( 'Toggle Color Theme', 'gravisain' ); ?>"
				aria-expanded="false"
				title="<?php esc_attr_e( 'Theme Switcher', 'gravisain' ); ?>"
			>
				<!-- Sun Icon for Light -->
				<span class="ghb-theme-icon ghb-icon-sun" aria-hidden="true">
					<svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
					</svg>
				</span>

				<!-- Moon Icon for Dark -->
				<span class="ghb-theme-icon ghb-icon-moon" aria-hidden="true">
					<svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
					</svg>
				</span>

				<!-- Laptop Icon for System -->
				<span class="ghb-theme-icon ghb-icon-system" aria-hidden="true">
					<svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
					</svg>
				</span>

				<?php if ( $show_label ) : ?>
					<span class="ghb-theme-btn-label"><?php esc_html_e( 'Theme', 'gravisain' ); ?></span>
				<?php endif; ?>
			</button>

			<?php if ( 'dropdown' === $style ) : ?>
				<!-- Dropdown Menu (Light / Dark / System) -->
				<div class="ghb-theme-dropdown" role="menu" aria-label="<?php esc_attr_e( 'Theme Selection', 'gravisain' ); ?>">
					<button type="button" class="ghb-theme-item" data-mode="light" role="menuitem">
						<span class="ghb-theme-item-left">
							<svg class="ghb-item-icon-sun" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
							</svg>
							<span><?php esc_html_e( 'Light', 'gravisain' ); ?></span>
						</span>
						<span class="ghb-theme-check" aria-hidden="true">✓</span>
					</button>

					<button type="button" class="ghb-theme-item" data-mode="dark" role="menuitem">
						<span class="ghb-theme-item-left">
							<svg class="ghb-item-icon-moon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
							</svg>
							<span><?php esc_html_e( 'Dark', 'gravisain' ); ?></span>
						</span>
						<span class="ghb-theme-check" aria-hidden="true">✓</span>
					</button>

					<button type="button" class="ghb-theme-item" data-mode="system" role="menuitem">
						<span class="ghb-theme-item-left">
							<svg class="ghb-item-icon-system" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
							</svg>
							<span><?php esc_html_e( 'System', 'gravisain' ); ?></span>
						</span>
						<span class="ghb-theme-check" aria-hidden="true">✓</span>
					</button>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>
