<?php
/**
 * Title: Hero Banner with Image
 * Slug: gravisain/core-hero-banner
 * Categories: gravisain, featured, banner
 * Description: A responsive two-column hero section built entirely with core WordPress blocks.
 * Keywords: hero, banner, intro, call to action
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$gravisain_hero_image = get_template_directory_uri() . '/assets/images/starter-content/resize.webp';
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem","left":"1.5rem","right":"1.5rem"}},"color":{"background":"#0f172a","text":"#f8fafc"}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group alignfull has-text-color has-background" style="background-color:#0f172a;color:#f8fafc;padding-top:5rem;padding-right:1.5rem;padding-bottom:5rem;padding-left:1.5rem">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"2.5rem","left":"3.5rem"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">
			<!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.12em","fontWeight":"700","fontSize":"0.8rem"},"color":{"text":"#818cf8"}}} -->
			<p class="has-text-color" style="color:#818cf8;font-size:0.8rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase"><?php esc_html_e( 'Modern Hybrid WordPress Theme', 'gravisain' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"2.85rem","lineHeight":"1.15","fontWeight":"800"},"color":{"text":"#ffffff"}}} -->
			<h1 class="wp-block-heading has-text-color" style="color:#ffffff;font-size:2.85rem;font-weight:800;line-height:1.15"><?php esc_html_e( 'Build Fast, Accessible Websites with Confidence', 'gravisain' ); ?></h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.7"},"color":{"text":"#cbd5e1"}}} -->
			<p class="has-text-color" style="color:#cbd5e1;font-size:1.1rem;line-height:1.7"><?php esc_html_e( 'Combine flexible Header & Footer Builders, global design tokens, and native Gutenberg blocks for clean, lightning-fast publishing.', 'gravisain' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"2rem"}}}} -->
			<div class="wp-block-buttons" style="margin-top:2rem">
				<!-- wp:button {"style":{"color":{"background":"#4f46e5","text":"#ffffff"},"border":{"radius":"999px"},"spacing":{"padding":{"top":"0.85rem","bottom":"0.85rem","left":"1.75rem","right":"1.75rem"}}}} -->
				<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="#services" style="border-radius:999px;background-color:#4f46e5;color:#ffffff;padding-top:0.85rem;padding-right:1.75rem;padding-bottom:0.85rem;padding-left:1.75rem"><?php esc_html_e( 'Explore Features', 'gravisain' ); ?></a></div>
				<!-- /wp:button -->

				<!-- wp:button {"className":"is-style-outline","style":{"color":{"text":"#f8fafc"},"border":{"radius":"999px","width":"1px","color":"#475569"},"spacing":{"padding":{"top":"0.85rem","bottom":"0.85rem","left":"1.75rem","right":"1.75rem"}}}} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color has-border-color wp-element-button" href="#contact" style="border-color:#475569;border-width:1px;border-radius:999px;color:#f8fafc;padding-top:0.85rem;padding-right:1.75rem;padding-bottom:0.85rem;padding-left:1.75rem"><?php esc_html_e( 'Get Started', 'gravisain' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
			<!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"16px"}}} -->
			<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( $gravisain_hero_image ); ?>" alt="<?php esc_attr_e( 'Creative workspace preview', 'gravisain' ); ?>" style="border-radius:16px"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
