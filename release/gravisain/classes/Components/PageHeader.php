<?php
/**
 * Page Header / Hero Area Component
 *
 * @package Gravisain\Components
 */

namespace Gravisain\Components;

class PageHeader {

	/**
	 * Initialize the Page Header component.
	 *
	 * @return void
	 */
	public static function init(): void {
		add_action( 'gravisain_before_content', [ __CLASS__, 'render' ], 15 );
	}

	/**
	 * Check if the Page Header Hero Banner should be displayed.
	 *
	 * @return bool
	 */
	public static function should_render_hero(): bool {
		if ( \Gravisain\Meta\PageSettings::is_title_hidden() ) {
			return false;
		}

		$layout = get_theme_mod( 'gravisain_page_header_layout', 'above_content' );

		if ( \Gravisain\Meta\PageSettings::is_title_forced_show() ) {
			return 'in_content' !== $layout;
		}

		if ( is_front_page() ) {
			return false;
		}

		return 'above_content' === $layout;
	}

	/**
	 * Check if the standard in-content title should be displayed.
	 *
	 * @return bool
	 */
	public static function should_render_in_content_title(): bool {
		if ( \Gravisain\Meta\PageSettings::is_title_hidden() ) {
			return false;
		}

		$layout = get_theme_mod( 'gravisain_page_header_layout', 'above_content' );

		if ( \Gravisain\Meta\PageSettings::is_title_forced_show() ) {
			return 'in_content' === $layout;
		}

		if ( is_front_page() ) {
			return false;
		}

		if ( 'disabled' === $layout ) {
			return false;
		}

		return 'in_content' === $layout;
	}

	/**
	 * Get the current page or archive title.
	 *
	 * @return string
	 */
	public static function get_title(): string {
		if ( is_home() ) {
			$blog_page_id = get_option( 'page_for_posts' );
			return $blog_page_id ? get_the_title( $blog_page_id ) : __( 'Latest Articles', 'gravisain' );
		}
		if ( is_archive() ) {
			return get_the_archive_title();
		}
		if ( is_search() ) {
			/* translators: %s: Search query term. */
			return sprintf( __( 'Search Results for: %s', 'gravisain' ), get_search_query() );
		}
		if ( is_404() ) {
			return __( 'Page Not Found', 'gravisain' );
		}
		return get_the_title();
	}

	/**
	 * Render Hero Area template part.
	 *
	 * @return void
	 */
	public static function render(): void {
		if ( ! self::should_render_hero() ) {
			return;
		}

		get_template_part( 'template-parts/page-header/hero' );
	}
}
