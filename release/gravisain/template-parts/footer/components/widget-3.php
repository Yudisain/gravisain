<?php
/**
 * Widget Area 3 Footer Component
 *
 * @package Gravisain\Components
 */
?>
<div class="gfb-component gfb-widget-area gfb-widget-3">
	<?php
	if ( is_active_sidebar( 'footer-widget-3' ) ) {
		dynamic_sidebar( 'footer-widget-3' );
	} elseif ( is_customize_preview() ) {
		// Call dynamic_sidebar to let WordPress know the sidebar is rendered
		ob_start();
		dynamic_sidebar( 'footer-widget-3' );
		ob_end_clean();

		echo '<div class="gfb-widget-placeholder">' . esc_html__( 'Footer Widget Area 3 - Add Widgets here', 'gravisain' ) . '</div>';
	}
	?>
</div>
