<?php
/**
 * Copyright Footer Component
 *
 * @package Gravisain\Components
 */

$default_text = __( 'Copyright &copy; [year] [site_title]. <a href="https://undagital.com" target="_blank" rel="noopener noreferrer">Gravisain Studio</a>', 'gravisain' );
$copyright    = get_theme_mod( 'gravisain_footer_copyright_text', $default_text );

// Parse shorttags
$replacements = [
	'[year]'         => date_i18n( 'Y' ),
	'[site_title]'   => get_bloginfo( 'name' ),
	'[theme_author]' => '<a href="https://gravisain.com" target="_blank" rel="noopener noreferrer">Gravisain</a>',
];

$copyright_parsed = str_replace( array_keys( $replacements ), array_values( $replacements ), $copyright );
?>
<div class="gfb-component gfb-copyright">
	<div class="copyright-text">
		<?php echo wp_kses_post( $copyright_parsed ); ?>
	</div>
</div>
