<?php
/**
 * Service Provider
 *
 * @package Gravisain\Core
 */

namespace Gravisain\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Service Provider Class
 * 
 * Registers and initializes all core theme services.
 */
class ServiceProvider {

	/**
	 * List of service classes to initialize.
	 *
	 * @var array<class-string>
	 */
	private array $services = [
		Hooks::class,
		Assets::class,
		Sidebars::class,
		'Gravisain\\Core\\ElementsEngine',
		'Gravisain\\Meta\\ElementMetaBox',
		\Gravisain\CSS\GoogleFonts::class,
		\Gravisain\CSS\LocalFontDownloader::class,
		\Gravisain\CSS\CSSFileCache::class,
		\Gravisain\CSS\DynamicCSS::class,
		\Gravisain\Meta\PageSettings::class,
		\Gravisain\Components\PageHeader::class,
		\Gravisain\Components\Breadcrumbs::class,
		\Gravisain\Components\RelatedPosts::class,
		\Gravisain\Components\MenuEnhancements::class,
		\Gravisain\Dashboard\Welcome::class,
		'Gravisain\\Dashboard\\ImportExport',
		\Gravisain\Customizer\Customizer::class,
		\Gravisain\Customizer\StarterContent::class,
		'Gravisain\\Rest\\DemoDataEndpoint',
		\Gravisain\Integrations\WooCommerce::class,
		'Gravisain\\Integrations\\CompanionNotice',
	];

	/**
	 * Register and boot all services.
	 *
	 * @return void
	 */
	public function register(): void {
		$services = $this->services;

		if ( defined( 'GRAVISAIN_ENABLE_THEME_LICENSE' ) && GRAVISAIN_ENABLE_THEME_LICENSE ) {
			$services[] = 'Gravisain\\License\\LicenseManager';
			$services[] = 'Gravisain\\License\\ThemeUpdater';
		}

		foreach ( $services as $service_class ) {
			try {
				if ( class_exists( $service_class ) && method_exists( $service_class, 'init' ) ) {
					call_user_func( [ $service_class, 'init' ] );
				}
			} catch ( \Throwable $e ) {
				if ( is_admin() ) {
					add_action( 'admin_notices', function () use ( $service_class, $e ) {
						printf(
							'<div class="notice notice-warning is-dismissible"><p><strong>%1$s:</strong> %2$s in <code>%3$s:%4$d</code></p></div>',
							sprintf(
								/* translators: %s: Module class name */
								esc_html__( 'Gravisain Module (%s)', 'gravisain' ),
								esc_html( $service_class )
							),
							esc_html( $e->getMessage() ),
							esc_html( $e->getFile() ),
							(int) $e->getLine()
						);
					} );
				}
			}
		}
	}
}
