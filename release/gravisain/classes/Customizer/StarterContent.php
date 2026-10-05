<?php
/**
 * Theme Starter Content
 *
 * @package Gravisain\Customizer
 */

namespace Gravisain\Customizer;

/**
 * StarterContent Class
 *
 * Manages the default starter content for fresh WordPress installations.
 * Mimics Astra's single-page anchor link approach for a cleaner database.
 */
class StarterContent {

	public const HOME_SLUG     = 'home';
	public const ABOUT_SLUG    = '#about';
	public const SERVICES_SLUG = '#services';
	public const CONTACT_SLUG  = '#contact';

	/**
	 * Initialize the Starter Content module.
	 *
	 * @return void
	 */
	public static function init(): void {
		add_action( 'after_setup_theme', [ self::class, 'setup_starter_content' ], 20 );
	}

	/**
	 * Configure and add theme support for starter content.
	 *
	 * @return void
	 */
	public static function setup_starter_content(): void {
		if ( ! get_option( 'fresh_site' ) ) {
			return;
		}

		$starter_content = self::get_content();
		add_theme_support( 'starter-content', $starter_content );
	}

	/**
	 * Get the starter content configuration array.
	 *
	 * @return array<string, mixed>
	 */
	private static function get_content(): array {
		$home_content = self::get_home_content();

		$nav_items = [
			'home'     => [
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::HOME_SLUG . '}}',
			],
			'about'    => [
				'title' => __( 'About', 'gravisain' ),
				'type'  => 'custom',
				'url'   => '{{' . self::ABOUT_SLUG . '}}',
			],
			'services' => [
				'title' => __( 'Services', 'gravisain' ),
				'type'  => 'custom',
				'url'   => '{{' . self::SERVICES_SLUG . '}}',
			],
			'contact'  => [
				'title' => __( 'Contact', 'gravisain' ),
				'type'  => 'custom',
				'url'   => '{{' . self::CONTACT_SLUG . '}}',
			],
		];

		return [
			'widgets' => [
				'sidebar-1' => [
					'search',
					'recent-posts',
					'recent-comments',
				],
			],
			'options' => [
				'show_on_front' => 'page',
				'page_on_front' => '{{' . self::HOME_SLUG . '}}',
			],
			'theme_mods' => [
				'custom_logo'                         => '{{image-logo}}',
				'gravisain_show_site_title'           => false,
				'gravisain_show_site_tagline'         => false,
				'gravisain_transparent_header_enable' => true,
				'gravisain_header_bottom_visibility'  => '',
			],
			'attachments' => [
				'image-logo' => [
					'post_title' => _x( 'Logo', 'Theme starter content', 'gravisain' ),
					'file'       => 'assets/images/starter-content/logo-landscape2.png',
				],
			],
			'posts' => [
				self::HOME_SLUG => [
					'post_type'    => 'page',
					'post_title'   => __( 'Home', 'gravisain' ),
					'post_content' => $home_content,
					'meta_input'   => [
						'_gravisain_vertical_spacing' => 'disable',
					],
				],
			],
			'nav_menus' => [
				'primary' => [
					'name'  => __( 'Primary Menu', 'gravisain' ),
					'items' => $nav_items,
				],
				'footer' => [
					'name'  => __( 'Footer Menu', 'gravisain' ),
					'items' => $nav_items,
				],
			],
		];
	}

	/**
	 * Generate the HTML content for the starter home page.
	 * 
	 * Contains sections with appropriate IDs for anchor links.
	 *
	 * @return string
	 */
	private static function get_home_content(): string {
		ob_start();
		?>
<!-- wp:group {"align":"full","className":"gravisain-hero","style":{"spacing":{"padding":{"top":"160px","bottom":"120px","left":"24px","right":"24px"},"margin":{"top":"calc(-1 * (var(--gravisain-header-offset, 120px) + var(--gravisain-content-padding-top, 56px)))"}}},"color":{"background":"#0B0B0C"},"layout":{"type":"constrained","contentSize":"1160px"}} -->
<div class="wp-block-group alignfull gravisain-hero has-background" style="background-color:#0B0B0C;margin-top:calc(-1 * (var(--gravisain-header-offset, 120px) + var(--gravisain-content-padding-top, 56px)));padding-top:160px;padding-right:24px;padding-bottom:120px;padding-left:24px"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"56px","top":"40px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"52%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:52%"><!-- wp:paragraph {"style":{"typography":{"fontSize":"13px","fontWeight":"700","letterSpacing":"1px","textTransform":"uppercase"},"color":{"text":"#EA4317"},"spacing":{"margin":{"bottom":"16px"}}}} -->
<p class="has-text-color" style="color:#EA4317;margin-bottom:16px;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase">Performance-First WordPress Theme</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"textColor":"white","style":{"typography":{"fontSize":"56px","lineHeight":"1.1","fontWeight":"600","letterSpacing":"-1px"}}} -->
<h1 class="wp-block-heading has-white-color has-text-color" style="font-size:56px;font-weight:600;letter-spacing:-1px;line-height:1.1">Create without limits.<br>Perform without compromise.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","lineHeight":"1.6"},"color":{"text":"#9CA3AF"},"spacing":{"margin":{"top":"24px","bottom":"40px"}}}} -->
<p class="has-text-color" style="color:#9CA3AF;margin-top:24px;margin-bottom:40px;font-size:18px;line-height:1.6">A flexible hybrid WordPress theme for fast, expressive and modern websites.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"style":{"border":{"radius":"4px"},"spacing":{"padding":{"top":"14px","right":"32px","bottom":"14px","left":"32px"}},"color":{"background":"#EA4317","text":"#FFFFFF"},"typography":{"fontSize":"15px","fontWeight":"700","textTransform":"uppercase"}}} -->
<div class="wp-block-button has-custom-font-size" style="font-size:15px;font-weight:700;text-transform:uppercase"><a class="wp-block-button__link has-text-color has-background" href="<?php echo esc_url( home_url( '/' ) ); ?>work/" style="border-radius:4px;background-color:#EA4317;color:#FFFFFF;padding-top:14px;padding-right:32px;padding-bottom:14px;padding-left:32px">Explore Gravisain →</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"48%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:48%"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/starter-content/resize.webp' ) ); ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","backgroundColor":"gravisain-site-bg","style":{"spacing":{"margin":{"top":"0px"},"padding":{"top":"96px","bottom":"96px","left":"24px","right":"24px"}}},"layout":{"type":"constrained","contentSize":"1160px"}} -->
<div class="wp-block-group alignfull has-gravisain-site-bg-background-color has-background" style="margin-top:0px;padding-top:96px;padding-right:24px;padding-bottom:96px;padding-left:24px"><!-- wp:heading {"textAlign":"center","textColor":"gravisain-text-color","style":{"typography":{"fontSize":"44px","fontWeight":"800","letterSpacing":"-0.5px"}}} -->
<h2 class="wp-block-heading has-text-align-center has-gravisain-text-color-color has-text-color" style="font-size:44px;font-weight:800;letter-spacing:-0.5px">Build Beyond Ordinary</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"gravisain-secondary","style":{"typography":{"fontSize":"17px"},"spacing":{"margin":{"top":"12px","bottom":"48px"}}}} -->
<p class="has-text-align-center has-gravisain-secondary-color has-text-color" style="margin-top:12px;margin-bottom:48px;font-size:17px">Build expressive, high-performance websites with a flexible design.</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"24px","top":"24px"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"gravisain-card gravisain-card-center","style":{"border":{"color":"#E5E7EB","width":"1px","radius":"14px"},"spacing":{"padding":{"top":"32px","right":"28px","bottom":"32px","left":"28px"},"blockGap":"14px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group gravisain-card gravisain-card-center has-border-color" style="border-color:#E5E7EB;border-width:1px;border-radius:14px;padding-top:32px;padding-right:28px;padding-bottom:32px;padding-left:28px"><!-- wp:html -->
<span class="gravisain-icon" style="color:#EA4317"><svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18z"/><path d="M12 3v2"/><path d="M5.6 5.6l1.4 1.4"/><path d="M3 12h2"/><path d="M18.4 5.6l-1.4 1.4"/><path d="M13 8l-4 5h3l-1 4 4-5h-3z"/></svg></span>
<!-- /wp:html -->

<!-- wp:heading {"level":3,"textColor":"gravisain-text-color","style":{"typography":{"fontSize":"20px","fontWeight":"700"}}} -->
<h3 class="wp-block-heading has-gravisain-text-color-color has-text-color" style="font-size:20px;font-weight:700">Performance First</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"gravisain-secondary","style":{"typography":{"fontSize":"15px","lineHeight":"1.65"}}} -->
<p class="has-gravisain-secondary-color has-text-color" style="font-size:15px;line-height:1.65">Modern architecture engineered for exceptional frontend performance. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px","fontWeight":"600"}}} -->
<p class="has-link-color" style="font-size:14px;font-weight:600"><a href="<?php echo esc_url( home_url( '/' ) ); ?>services/" style="color:#2563EB">Learn more →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"gravisain-card gravisain-card-center","style":{"border":{"color":"#E5E7EB","width":"1px","radius":"14px"},"spacing":{"padding":{"top":"32px","right":"28px","bottom":"32px","left":"28px"},"blockGap":"14px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group gravisain-card gravisain-card-center has-border-color" style="border-color:#E5E7EB;border-width:1px;border-radius:14px;padding-top:32px;padding-right:28px;padding-bottom:32px;padding-left:28px"><!-- wp:html -->
<span class="gravisain-icon" style="color:#EA4317"><svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="6" height="6" rx="1"/><rect x="14" y="4" width="6" height="6" rx="1"/><rect x="4" y="14" width="6" height="6" rx="1"/><rect x="14" y="14" width="6" height="6" rx="1" stroke-dasharray="2 2"/></svg></span>
<!-- /wp:html -->

<!-- wp:heading {"level":3,"textColor":"gravisain-text-color","style":{"typography":{"fontSize":"20px","fontWeight":"700"}}} -->
<h3 class="wp-block-heading has-gravisain-text-color-color has-text-color" style="font-size:20px;font-weight:700">Modular Builders</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"gravisain-secondary","style":{"typography":{"fontSize":"15px","lineHeight":"1.65"}}} -->
<p class="has-gravisain-secondary-color has-text-color" style="font-size:15px;line-height:1.65">Create flexible headers and footers with visual modular controls.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px","fontWeight":"600"}}} -->
<p class="has-link-color" style="font-size:14px;font-weight:600"><a href="<?php echo esc_url( home_url( '/' ) ); ?>services/" style="color:#2563EB">Learn more →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"gravisain-card gravisain-card-center","style":{"border":{"color":"#E5E7EB","width":"1px","radius":"14px"},"spacing":{"padding":{"top":"32px","right":"28px","bottom":"32px","left":"28px"},"blockGap":"14px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group gravisain-card gravisain-card-center has-border-color" style="border-color:#E5E7EB;border-width:1px;border-radius:14px;padding-top:32px;padding-right:28px;padding-bottom:32px;padding-left:28px"><!-- wp:html -->
<span class="gravisain-icon" style="color:#EA4317"><svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/><path d="M14.5 12.5l3 3-4 4H11v-2.5l4-4z"/><path d="M16 11l1.5-1.5a1 1 0 0 1 1.4 1.4L17.4 12.4"/></svg></span>
<!-- /wp:html -->

<!-- wp:heading {"level":3,"textColor":"gravisain-text-color","style":{"typography":{"fontSize":"20px","fontWeight":"700"}}} -->
<h3 class="wp-block-heading has-gravisain-text-color-color has-text-color" style="font-size:20px;font-weight:700">Native Guttenberg</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"gravisain-secondary","style":{"typography":{"fontSize":"15px","lineHeight":"1.65"}}} -->
<p class="has-gravisain-secondary-color has-text-color" style="font-size:15px;line-height:1.65">Design naturally with WordPress blocks, patterns, and global styles.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px","fontWeight":"600"}}} -->
<p class="has-link-color" style="font-size:14px;font-weight:600"><a href="<?php echo esc_url( home_url( '/' ) ); ?>services/" style="color:#2563EB">Learn more →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"gravisain-card gravisain-card-center","style":{"border":{"color":"#E5E7EB","width":"1px","radius":"14px"},"spacing":{"padding":{"top":"32px","right":"28px","bottom":"32px","left":"28px"},"blockGap":"14px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group gravisain-card gravisain-card-center has-border-color" style="border-color:#E5E7EB;border-width:1px;border-radius:14px;padding-top:32px;padding-right:28px;padding-bottom:32px;padding-left:28px"><!-- wp:html -->
<span class="gravisain-icon" style="color:#EA4317"><svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8h12l1 12H5L6 8z"/><path d="M8 8V6a4 4 0 0 1 8 0v2"/></svg></span>
<!-- /wp:html -->

<!-- wp:heading {"level":3,"textColor":"gravisain-text-color","style":{"typography":{"fontSize":"20px","fontWeight":"700"}}} -->
<h3 class="wp-block-heading has-gravisain-text-color-color has-text-color" style="font-size:20px;font-weight:700">Deep Commerce</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"gravisain-secondary","style":{"typography":{"fontSize":"15px","lineHeight":"1.65"}}} -->
<p class="has-gravisain-secondary-color has-text-color" style="font-size:15px;line-height:1.65">Advanced WooCommerce integration built for modern online stores.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px","fontWeight":"600"}}} -->
<p class="has-link-color" style="font-size:14px;font-weight:600"><a href="<?php echo esc_url( home_url( '/' ) ); ?>services/" style="color:#2563EB">Learn more →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","backgroundColor":"gravisain-link-color","style":{"spacing":{"padding":{"top":"96px","bottom":"96px","left":"24px","right":"24px"}}},"layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group alignfull has-gravisain-link-color-background-color has-background" style="padding-top:96px;padding-right:24px;padding-bottom:96px;padding-left:24px"><!-- wp:heading {"textAlign":"center","textColor":"gravisain-text-dark-bg","style":{"typography":{"fontSize":"40px","fontWeight":"800","letterSpacing":"-0.5px"}}} -->
<h2 class="wp-block-heading has-text-align-center has-gravisain-text-dark-bg-color has-text-color" style="font-size:40px;font-weight:800;letter-spacing:-0.5px">Let’s Build Something Great</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"gravisain-text-dark-bg","style":{"typography":{"fontSize":"18px","lineHeight":"1.7"},"spacing":{"margin":{"top":"16px","bottom":"32px"}},"color":{}}} -->
<p class="has-text-align-center has-gravisain-text-dark-bg-color has-text-color" style="margin-top:16px;margin-bottom:32px;font-size:18px;line-height:1.7">Have an idea in mind? Let’s turn it into a website designed to stand out.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"14px"}}} -->
<div class="wp-block-buttons"><!-- wp:button {"style":{"border":{"radius":"4px"},"spacing":{"padding":{"top":"14px","right":"32px","bottom":"14px","left":"32px"}},"color":{"background":"#EA4317","text":"#FFFFFF"},"typography":{"fontSize":"15px","fontWeight":"700","textTransform":"uppercase"}}} -->
<div class="wp-block-button has-custom-font-size" style="font-size:15px;font-weight:700;text-transform:uppercase"><a class="wp-block-button__link has-text-color has-background" href="<?php echo esc_url( home_url( '/' ) ); ?>contact/" style="border-radius:4px;background-color:#EA4317;color:#FFFFFF;padding-top:14px;padding-right:32px;padding-bottom:14px;padding-left:32px">Start a Project</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline gravisain-btn-outline","style":{"border":{"radius":"4px","color":"#EA4317","width":"1px"},"spacing":{"padding":{"top":"14px","right":"32px","bottom":"14px","left":"32px"}},"color":{"text":"#EA4317"},"typography":{"fontSize":"15px","fontWeight":"700","textTransform":"uppercase"}}} -->
<div class="wp-block-button has-custom-font-size is-style-outline gravisain-btn-outline" style="font-size:15px;font-weight:700;text-transform:uppercase"><a class="wp-block-button__link has-text-color has-border-color" href="<?php echo esc_url( home_url( '/' ) ); ?>work/" style="border-color:#EA4317;border-width:1px;border-radius:4px;color:#EA4317;padding-top:14px;padding-right:32px;padding-bottom:14px;padding-left:32px">View Our Work</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
		<?php
		return ob_get_clean() ?: '';
	}
}
