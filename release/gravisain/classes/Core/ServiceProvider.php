<?php
/**
 * Service Provider
 *
 * @package Gravisain\Core
 */

namespace Gravisain\Core;

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
		\Gravisain\License\LicenseManager::class,
		\Gravisain\License\ThemeUpdater::class,
		Assets::class,
		Sidebars::class,
		\Gravisain\Core\ElementsEngine::class,
		\Gravisain\Meta\ElementMetaBox::class,
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
		\Gravisain\Dashboard\ImportExport::class,
		\Gravisain\Customizer\Customizer::class,
		\Gravisain\Customizer\StarterContent::class,
		\Gravisain\Rest\DemoDataEndpoint::class,
		\Gravisain\Integrations\WooCommerce::class,
		\Gravisain\Integrations\CompanionNotice::class,
	];

	/**
	 * Register and boot all services.
	 *
	 * @return void
	 */
	public function register(): void {
		foreach ( $this->services as $service_class ) {
			try {
				if ( class_exists( $service_class ) && method_exists( $service_class, 'init' ) ) {
					call_user_func( [ $service_class, 'init' ] );
				}
			} catch ( \Throwable $e ) {
				if ( is_admin() ) {
					add_action( 'admin_notices', function () use ( $service_class, $e ) {
						printf(
							'<div class="notice notice-warning is-dismissible"><p><strong>Gravisain Module (%1$s):</strong> %2$s in <code>%3$s:%4$d</code></p></div>',
							esc_html( $service_class ),
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
