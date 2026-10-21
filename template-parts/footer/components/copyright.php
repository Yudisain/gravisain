<?php
/**
 * Copyright Footer Component
 *
 * @package Gravisain\Components
 */

$default_text = sprintf(
	/* translators: 1: Year placeholder, 2: Site title placeholder, 3: Author link */
	__( 'Copyright &copy; %1$s %2$s. %3$s', 'gravisain' ),
	'[year]',
	'[site_title]',
	'<a href="' . esc_url( 'https://undagital.com' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Gravisain Studio', 'gravisain' ) . '</a>'
);
$copyright    = get_theme_mod( 'gravisain_footer_copyright_text', $default_text );

// Parse shorttags
$replacements = [
	'[year]'         => date_i18n( 'Y' ),
	'[site_title]'   => get_bloginfo( 'name' ),
	'[theme_author]' => '<a href="' . esc_url( 'https://gravisain.com' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Gravisain', 'gravisain' ) . '</a>',
];

$copyright_parsed = str_replace( array_keys( $replacements ), array_values( $replacements ), $copyright );
?>
<div class="gfb-component gfb-copyright">
	<div class="copyright-text">
		<?php echo wp_kses_post( $copyright_parsed ); ?>
	</div>
</div>
