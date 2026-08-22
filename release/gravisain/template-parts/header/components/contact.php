<?php
/**
 * Contact Info Component
 *
 * @package Gravisain\Components
 */

$phone      = get_theme_mod( 'gravisain_header_contact_phone', '' );
$email      = get_theme_mod( 'gravisain_header_contact_email', '' );
$hours      = get_theme_mod( 'gravisain_header_contact_hours', '' );
$visibility = get_theme_mod( 'gravisain_header_contact_visibility', 'desktop,tablet' );

if ( empty( $phone ) && empty( $email ) && empty( $hours ) && ! is_customize_preview() ) {
	return;
}

$classes = [ 'ghb-component', 'ghb-contact-info' ];

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
	<ul class="ghb-contact-list">
		<?php if ( ! empty( $phone ) || is_customize_preview() ) : ?>
			<li class="ghb-contact-item ghb-contact-phone <?php echo empty( $phone ) ? 'is-empty-preview' : ''; ?>">
				<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9\+\-\.]/', '', $phone ) ); ?>">
					<span class="ghb-contact-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
						</svg>
					</span>
					<span class="ghb-contact-text"><?php echo esc_html( $phone ); ?></span>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( ! empty( $email ) || is_customize_preview() ) : ?>
			<li class="ghb-contact-item ghb-contact-email <?php echo empty( $email ) ? 'is-empty-preview' : ''; ?>">
				<a href="<?php echo esc_url( 'mailto:' . $email ); ?>">
					<span class="ghb-contact-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
							<polyline points="22,6 12,13 2,6"></polyline>
						</svg>
					</span>
					<span class="ghb-contact-text"><?php echo esc_html( $email ); ?></span>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( ! empty( $hours ) || is_customize_preview() ) : ?>
			<li class="ghb-contact-item ghb-contact-hours <?php echo empty( $hours ) ? 'is-empty-preview' : ''; ?>">
				<span class="ghb-contact-icon" aria-hidden="true">
					<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<circle cx="12" cy="12" r="10"></circle>
						<polyline points="12 6 12 12 16 14"></polyline>
					</svg>
				</span>
				<span class="ghb-contact-text"><?php echo esc_html( $hours ); ?></span>
			</li>
		<?php endif; ?>
	</ul>
</div>
