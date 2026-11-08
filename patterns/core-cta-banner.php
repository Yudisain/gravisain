<?php
/**
 * Title: Call to Action Banner
 * Slug: gravisain/core-cta-banner
 * Categories: gravisain, call-to-action
 * Description: A centered call-to-action banner built with core WordPress blocks.
 * Keywords: cta, call to action, banner
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem","left":"2rem","right":"2rem"},"margin":{"top":"3rem","bottom":"3rem"}},"border":{"radius":"20px"},"color":{"background":"#1e1b4b","text":"#ffffff"}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<div id="contact" class="wp-block-group alignwide has-text-color has-background" style="border-radius:20px;background-color:#1e1b4b;color:#ffffff;margin-top:3rem;margin-bottom:3rem;padding-top:4rem;padding-right:2rem;padding-bottom:4rem;padding-left:2rem">
	<!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"2.25rem","fontWeight":"800"},"color":{"text":"#ffffff"}}} -->
	<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;font-size:2.25rem;font-weight:800"><?php esc_html_e( 'Ready to Launch Your Next Website?', 'gravisain' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#e0e7ff"},"typography":{"fontSize":"1.05rem","lineHeight":"1.7"}}} -->
	<p class="has-text-align-center has-text-color" style="color:#e0e7ff;font-size:1.05rem;line-height:1.7"><?php esc_html_e( 'Customize colors, typography, and layouts effortlessly using native WordPress tools.', 'gravisain' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"1.75rem"}}}} -->
	<div class="wp-block-buttons" style="margin-top:1.75rem">
		<!-- wp:button {"style":{"color":{"background":"#ffffff","text":"#1e1b4b"},"border":{"radius":"999px"},"typography":{"fontWeight":"700"},"spacing":{"padding":{"top":"0.85rem","bottom":"0.85rem","left":"2rem","right":"2rem"}}}} -->
		<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="#page" style="border-radius:999px;background-color:#ffffff;color:#1e1b4b;font-weight:700;padding-top:0.85rem;padding-right:2rem;padding-bottom:0.85rem;padding-left:2rem"><?php esc_html_e( 'Start Customizing', 'gravisain' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
