<?php
/**
 * Title: Three-Column Features Grid
 * Slug: gravisain/core-features-grid
 * Categories: gravisain, featured, text
 * Description: A clean three-column services and highlights layout built with core WordPress blocks.
 * Keywords: services, features, columns, grid
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"4.5rem","bottom":"4.5rem","left":"1.5rem","right":"1.5rem"}},"color":{"background":"#f8fafc","text":"#0f172a"}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div id="services" class="wp-block-group alignfull has-text-color has-background" style="background-color:#f8fafc;color:#0f172a;padding-top:4.5rem;padding-right:1.5rem;padding-bottom:4.5rem;padding-left:1.5rem">
	<!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"2.2rem","fontWeight":"800"},"color":{"text":"#0f172a"}}} -->
	<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#0f172a;font-size:2.2rem;font-weight:800"><?php esc_html_e( 'Engineered for Speed & Flexibility', 'gravisain' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#475569"},"spacing":{"margin":{"bottom":"3rem"}}}} -->
	<p class="has-text-align-center has-text-color" style="color:#475569;margin-bottom:3rem"><?php esc_html_e( 'Everything you need to craft clean, accessible websites without unnecessary bloat.', 'gravisain' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"1.5rem","left":"1.5rem"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.75rem","right":"1.75rem"}},"border":{"radius":"14px","width":"1px","color":"#e2e8f0"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group has-border-color has-background" style="border-color:#e2e8f0;border-width:1px;border-radius:14px;background-color:#ffffff;padding-top:2rem;padding-right:1.75rem;padding-bottom:2rem;padding-left:1.75rem">
				<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.25rem","fontWeight":"700"},"color":{"text":"#0f172a"}}} -->
				<h3 class="wp-block-heading has-text-color" style="color:#0f172a;font-size:1.25rem;font-weight:700"><?php esc_html_e( 'Zero jQuery Frontend', 'gravisain' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"style":{"color":{"text":"#475569"},"typography":{"lineHeight":"1.65"}}} -->
				<p class="has-text-color" style="color:#475569;line-height:1.65"><?php esc_html_e( 'Pure modular Vanilla JavaScript keeps frontend pages ultra-lightweight and responsive on every device.', 'gravisain' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.75rem","right":"1.75rem"}},"border":{"radius":"14px","width":"1px","color":"#e2e8f0"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group has-border-color has-background" style="border-color:#e2e8f0;border-width:1px;border-radius:14px;background-color:#ffffff;padding-top:2rem;padding-right:1.75rem;padding-bottom:2rem;padding-left:1.75rem">
				<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.25rem","fontWeight":"700"},"color":{"text":"#0f172a"}}} -->
				<h3 class="wp-block-heading has-text-color" style="color:#0f172a;font-size:1.25rem;font-weight:700"><?php esc_html_e( 'Header & Footer Builder', 'gravisain' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"style":{"color":{"text":"#475569"},"typography":{"lineHeight":"1.65"}}} -->
				<p class="has-text-color" style="color:#475569;line-height:1.65"><?php esc_html_e( 'Arrange navigation, search modals, dark mode switchers, and widget rows visually in the Customizer.', 'gravisain' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.75rem","right":"1.75rem"}},"border":{"radius":"14px","width":"1px","color":"#e2e8f0"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group has-border-color has-background" style="border-color:#e2e8f0;border-width:1px;border-radius:14px;background-color:#ffffff;padding-top:2rem;padding-right:1.75rem;padding-bottom:2rem;padding-left:1.75rem">
				<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.25rem","fontWeight":"700"},"color":{"text":"#0f172a"}}} -->
				<h3 class="wp-block-heading has-text-color" style="color:#0f172a;font-size:1.25rem;font-weight:700"><?php esc_html_e( 'Privacy & Accessibility First', 'gravisain' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"style":{"color":{"text":"#475569"},"typography":{"lineHeight":"1.65"}}} -->
				<p class="has-text-color" style="color:#475569;line-height:1.65"><?php esc_html_e( 'Built with keyboard navigation, semantic landmarks, and local font hosting so visitor privacy stays protected.', 'gravisain' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
