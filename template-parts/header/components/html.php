<?php
/**
 * Custom HTML Component
 *
 * @package Gravisain\Components
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$content = get_theme_mod( 'gravisain_header_html_content', '' );

if ( empty( $content ) && is_customize_preview() ) {
	$content = '<span class="ghb-placeholder-text">' . __( 'Custom HTML Component (Edit in Customizer)', 'gravisain' ) . '</span>';
}

if ( empty( $content ) ) {
	return;
}
?>
<div class="ghb-component ghb-custom-html">
	<?php echo wp_kses_post( $content ); ?>
</div>
