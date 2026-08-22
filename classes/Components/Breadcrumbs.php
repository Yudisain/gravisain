<?php
/**
 * Breadcrumbs Component
 *
 * Generates Schema.org compliant breadcrumb navigation, SVG separators,
 * and structured JSON-LD BreadcrumbList output for search engines.
 *
 * @package Gravisain\Components
 */

namespace Gravisain\Components;

class Breadcrumbs {

	/**
	 * Initialize Breadcrumbs component hooks.
	 *
	 * @return void
	 */
	public static function init(): void {
		add_action( 'wp_head', [ __CLASS__, 'render_json_ld' ], 20 );
		add_action( 'gravisain_before_content', [ __CLASS__, 'render_above_content' ], 20 );
	}

	/**
	 * Check if third-party SEO breadcrumbs are available and enabled.
	 *
	 * @return bool
	 */
	public static function render_seo_plugin_breadcrumbs(): bool {
		// Yoast SEO
		if ( function_exists( 'yoast_breadcrumb' ) && class_exists( 'WPSEO_Options' ) ) {
			if ( \WPSEO_Options::get( 'breadcrumbs-enable', false ) ) {
				yoast_breadcrumb( '<nav aria-label="' . esc_attr__( 'Breadcrumbs', 'gravisain' ) . '" class="gravisain-breadcrumbs yoast-breadcrumbs">', '</nav>' );
				return true;
			}
		}

		// Rank Math
		if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
			rank_math_the_breadcrumbs( [
				'wrap_before' => '<nav aria-label="' . esc_attr__( 'Breadcrumbs', 'gravisain' ) . '" class="gravisain-breadcrumbs rankmath-breadcrumbs">',
				'wrap_after'  => '</nav>',
			] );
			return true;
		}

		return false;
	}

	/**
	 * Check if a third-party SEO plugin is already handling breadcrumb Schema.
	 *
	 * @return bool
	 */
	public static function is_third_party_schema_active(): bool {
		if ( function_exists( 'yoast_breadcrumb' ) && class_exists( 'WPSEO_Options' ) ) {
			if ( \WPSEO_Options::get( 'breadcrumbs-enable', false ) ) {
				return true;
			}
		}
		if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Render breadcrumb trail above main content if configured in Customizer.
	 *
	 * @return void
	 */
	public static function render_above_content(): void {
		if ( is_front_page() || ! get_theme_mod( 'gravisain_breadcrumb_enable', true ) ) {
			return;
		}

		$position = get_theme_mod( 'gravisain_breadcrumb_position', 'in_page_header' );
		if ( 'above_content' !== $position ) {
			return;
		}

		echo '<div class="gravisain-breadcrumbs-above-content container">';
		self::render_trail();
		echo '</div>';
	}

	/**
	 * Render native Gravisain breadcrumbs (called inside Page Header or Above Content).
	 *
	 * @return void
	 */
	public static function render(): void {
		if ( is_front_page() || ! get_theme_mod( 'gravisain_breadcrumb_enable', true ) ) {
			return;
		}

		$position = get_theme_mod( 'gravisain_breadcrumb_position', 'in_page_header' );
		if ( 'none' === $position ) {
			return;
		}

		self::render_trail();
	}

	/**
	 * Render the visual breadcrumb trail HTML.
	 *
	 * @return void
	 */
	public static function render_trail(): void {
		if ( self::render_seo_plugin_breadcrumbs() ) {
			return;
		}

		$items = self::get_items();
		if ( empty( $items ) || count( $items ) < 2 ) {
			return;
		}

		$separator = self::get_separator_svg();
		?>
		<nav aria-label="<?php esc_attr_e( 'Breadcrumbs', 'gravisain' ); ?>" class="gravisain-breadcrumbs">
			<ol class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">
				<?php foreach ( $items as $index => $item ) : ?>
					<?php $pos = $index + 1; ?>
					<li class="breadcrumb-item <?php echo empty( $item['url'] ) ? 'is-current' : ''; ?>" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
						<?php if ( ! empty( $item['url'] ) ) : ?>
							<a itemprop="item" href="<?php echo esc_url( $item['url'] ); ?>">
								<span itemprop="name"><?php echo esc_html( $item['label'] ); ?></span>
							</a>
						<?php else : ?>
							<span itemprop="name" aria-current="page"><?php echo esc_html( $item['label'] ); ?></span>
						<?php endif; ?>
						<meta itemprop="position" content="<?php echo esc_attr( (string) $pos ); ?>" />
					</li>
					<?php if ( $pos < count( $items ) ) : ?>
						<li class="breadcrumb-sep-wrapper" aria-hidden="true"><?php echo $separator; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ol>
		</nav>
		<?php
	}

	/**
	 * Render structured JSON-LD BreadcrumbList Schema in <head>.
	 *
	 * @return void
	 */
	public static function render_json_ld(): void {
		if ( is_front_page() || is_404() ) {
			return;
		}

		if ( ! get_theme_mod( 'gravisain_breadcrumb_enable', true ) || ! get_theme_mod( 'gravisain_breadcrumb_schema_jsonld', true ) ) {
			return;
		}

		if ( self::is_third_party_schema_active() ) {
			return;
		}

		$items = self::get_items();
		if ( empty( $items ) || count( $items ) < 2 ) {
			return;
		}

		$schema_items = [];
		foreach ( $items as $index => $item ) {
			$schema_items[] = [
				'@type'    => 'ListItem',
				'position' => $index + 1,
				'name'     => $item['label'],
				'item'     => ! empty( $item['url'] ) ? esc_url_raw( $item['url'] ) : esc_url_raw( home_url( add_query_arg( [], $GLOBALS['wp']->request ?? '' ) ) ),
			];
		}

		$schema = [
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $schema_items,
		];

		echo "\n" . '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
	}

	/**
	 * Get separator SVG markup based on Customizer setting.
	 *
	 * @return string
	 */
	public static function get_separator_svg(): string {
		$type = get_theme_mod( 'gravisain_breadcrumb_separator', 'chevron' );

		switch ( $type ) {
			case 'slash':
				return '<svg class="breadcrumb-sep-svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line></svg>';
			case 'arrow':
				return '<svg class="breadcrumb-sep-svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>';
			case 'dot':
				return '<svg class="breadcrumb-sep-svg" width="6" height="6" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="3"></circle></svg>';
			case 'chevron':
			default:
				return '<svg class="breadcrumb-sep-svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
		}
	}

	/**
	 * Generate breadcrumb items array for the current page.
	 *
	 * @return array<int, array{label: string, url: string}>
	 */
	public static function get_items(): array {
		$items = [];

		// 1. Home Link
		if ( get_theme_mod( 'gravisain_breadcrumb_show_home', true ) ) {
			$home_label = get_theme_mod( 'gravisain_breadcrumb_home_label', __( 'Home', 'gravisain' ) );
			$items[]    = [
				'label' => ! empty( $home_label ) ? $home_label : __( 'Home', 'gravisain' ),
				'url'   => home_url( '/' ),
			];
		}

		// 2. WooCommerce Shop / Product Hierarchy
		if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
			$shop_page_id = wc_get_page_id( 'shop' );
			if ( $shop_page_id && $shop_page_id > 0 ) {
				$items[] = [
					'label' => get_the_title( $shop_page_id ),
					'url'   => is_shop() ? '' : get_permalink( $shop_page_id ),
				];
			}

			if ( is_product() ) {
				$terms = get_the_terms( get_the_ID(), 'product_cat' );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
					$cat     = current( $terms );
					$items[] = [
						'label' => $cat->name,
						'url'   => get_term_link( $cat ),
					];
				}
				$items[] = [
					'label' => get_the_title(),
					'url'   => '',
				];
			} elseif ( is_product_category() || is_product_tag() ) {
				$items[] = [
					'label' => single_term_title( '', false ),
					'url'   => '',
				];
			}
			return $items;
		}

		// 3. Blog Archive / Single Post / Page Hierarchy
		if ( is_home() ) {
			$blog_page_id = get_option( 'page_for_posts' );
			$label        = $blog_page_id ? get_the_title( $blog_page_id ) : __( 'Blog', 'gravisain' );
			$items[]      = [
				'label' => $label,
				'url'   => '',
			];
		} elseif ( is_single() ) {
			$post_type = get_post_type();
			if ( 'post' === $post_type ) {
				$categories = get_the_category();
				if ( ! empty( $categories ) ) {
					$cat     = $categories[0];
					$items[] = [
						'label' => $cat->name,
						'url'   => get_category_link( $cat->term_id ),
					];
				}
			} elseif ( 'post' !== $post_type ) {
				$post_type_obj = get_post_type_object( (string) $post_type );
				if ( $post_type_obj && $post_type_obj->has_archive ) {
					$items[] = [
						'label' => $post_type_obj->labels->name,
						'url'   => get_post_type_archive_link( (string) $post_type ),
					];
				}
			}
			$items[] = [
				'label' => get_the_title(),
				'url'   => '',
			];
		} elseif ( is_page() ) {
			global $post;
			if ( $post && $post->post_parent ) {
				$parent_id = $post->post_parent;
				$parents   = [];
				while ( $parent_id ) {
					$page      = get_post( $parent_id );
					if ( ! $page ) {
						break;
					}
					$parents[] = [
						'label' => get_the_title( $page->ID ),
						'url'   => get_permalink( $page->ID ),
					];
					$parent_id = $page->post_parent;
				}
				$items = array_merge( $items, array_reverse( $parents ) );
			}
			$items[] = [
				'label' => get_the_title(),
				'url'   => '',
			];
		} elseif ( is_category() || is_tag() || is_tax() ) {
			$items[] = [
				'label' => single_term_title( '', false ),
				'url'   => '',
			];
		} elseif ( is_post_type_archive() ) {
			$items[] = [
				'label' => post_type_archive_title( '', false ),
				'url'   => '',
			];
		} elseif ( is_archive() ) {
			$items[] = [
				'label' => get_the_archive_title(),
				'url'   => '',
			];
		} elseif ( is_search() ) {
			$items[] = [
				/* translators: %s: Search query. */
				'label' => sprintf( __( 'Search Results for "%s"', 'gravisain' ), get_search_query() ),
				'url'   => '',
			];
		} elseif ( is_404() ) {
			$items[] = [
				'label' => __( 'Page Not Found', 'gravisain' ),
				'url'   => '',
			];
		}

		return $items;
	}
}
