<?php
/**
 * REST API Demo Data Endpoint
 * Exposes demo site configurations (Theme Mods, Menus, Pages with raw blocks)
 * for automatic starter site importing.
 *
 * @package Gravisain\Rest
 */

namespace Gravisain\Rest;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DemoDataEndpoint {

	/**
	 * Initialize endpoint hooks.
	 */
	public static function init(): void {
		$instance = new self();
		add_action( 'rest_api_init', [ $instance, 'register_routes' ] );
	}

	/**
	 * Register REST route.
	 */
	public function register_routes(): void {
		register_rest_route( 'gravisain/v1', '/demo-data', [
			'methods'             => \WP_REST_Server::READABLE,
			'callback'            => [ $this, 'get_demo_data' ],
			'permission_callback' => function () {
				// Allow if this server is explicitly designated as a showcase/demo server
				if ( defined( 'GRAVISAIN_ENABLE_SHOWCASE' ) && GRAVISAIN_ENABLE_SHOWCASE ) {
					return true;
				}
				// Otherwise require administrator privilege to prevent unauthorized info disclosure
				return current_user_can( 'manage_options' );
			},
		] );
	}

	/**
	 * Get complete demo package.
	 *
	 * @param \WP_REST_Request $request
	 * @return \WP_REST_Response
	 */
	public function get_demo_data( \WP_REST_Request $request ): \WP_REST_Response {
		return new \WP_REST_Response( [
			'success'    => true,
			'site_info'  => $this->get_site_info(),
			'theme_mods' => $this->get_theme_mods_data(),
			'nav_menus'  => $this->get_nav_menus_data(),
			'pages'      => $this->get_pages_data(),
		], 200 );
	}

	/**
	 * Get basic site information and frontpage settings.
	 */
	private function get_site_info(): array {
		$page_on_front_id   = (int) get_option( 'page_on_front', 0 );
		$page_on_front_slug = '';

		if ( $page_on_front_id > 0 ) {
			$front_post = get_post( $page_on_front_id );
			if ( $front_post ) {
				$page_on_front_slug = $front_post->post_name;
			}
		}

		return [
			'title'              => get_bloginfo( 'name' ),
			'tagline'            => get_bloginfo( 'description' ),
			'show_on_front'      => get_option( 'show_on_front', 'posts' ),
			'page_on_front_slug' => $page_on_front_slug,
		];
	}

	/**
	 * Get exported theme_mods including logo image URLs.
	 */
	private function get_theme_mods_data(): array {
		$mods = get_theme_mods();

		if ( ! is_array( $mods ) ) {
			$mods = [];
		}

		// Remove internal or transient data
		unset( $mods['nav_menu_locations'] );
		unset( $mods['custom_css_post_id'] );

		// Provide direct URLs for logos so remote importers can download them
		if ( ! empty( $mods['custom_logo'] ) && is_numeric( $mods['custom_logo'] ) ) {
			$logo_url = wp_get_attachment_image_url( (int) $mods['custom_logo'], 'full' );
			if ( $logo_url ) {
				$mods['_gravisain_custom_logo_url'] = $logo_url;
			}
		}

		if ( ! empty( $mods['gravisain_transparent_header_logo'] ) && is_numeric( $mods['gravisain_transparent_header_logo'] ) ) {
			$trans_logo_url = wp_get_attachment_image_url( (int) $mods['gravisain_transparent_header_logo'], 'full' );
			if ( $trans_logo_url ) {
				$mods['_gravisain_transparent_logo_url'] = $trans_logo_url;
			}
		}

		return $mods;
	}

	/**
	 * Get navigation menus structure and location assignments.
	 */
	private function get_nav_menus_data(): array {
		$menus_data = [];
		$locations  = get_theme_mod( 'nav_menu_locations', [] );
		$nav_menus  = wp_get_nav_menus();

		foreach ( $nav_menus as $menu ) {
			// Find assigned theme locations (e.g. 'primary', 'footer')
			$assigned_locations = [];
			if ( is_array( $locations ) ) {
				foreach ( $locations as $loc_slug => $menu_term_id ) {
					if ( (int) $menu_term_id === (int) $menu->term_id ) {
						$assigned_locations[] = $loc_slug;
					}
				}
			}

			// If no location assigned but it's the main/only navigation, default to 'primary'
			if ( empty( $assigned_locations ) && ( count( $nav_menus ) === 1 || stripos( $menu->name, 'nav' ) !== false || stripos( $menu->name, 'menu' ) !== false || stripos( $menu->name, 'main' ) !== false ) ) {
				$assigned_locations[] = 'primary';
			}

			$items = wp_get_nav_menu_items( $menu->term_id );
			$items_data = [];

			if ( is_array( $items ) ) {
				foreach ( $items as $item ) {
					$target_slug = '';
					if ( 'page' === $item->object ) {
						$target_post = get_post( (int) $item->object_id );
						if ( $target_post ) {
							$target_slug = $target_post->post_name;
						}
					}

					$items_data[] = [
						'id'               => (int) $item->ID,
						'title'            => $item->title,
						'url'              => $item->url,
						'object'           => $item->object,
						'target_page_slug' => $target_slug,
						'menu_order'       => (int) $item->menu_order,
						'parent_id'        => (int) $item->menu_item_parent,
					];
				}
			}

			$menus_data[] = [
				'name'      => $menu->name,
				'slug'      => $menu->slug,
				'locations' => $assigned_locations,
				'items'     => $items_data,
			];
		}

		return $menus_data;
	}

	/**
	 * Get published pages with raw Gutenberg block contents and layout meta.
	 */
	private function get_pages_data(): array {
		$pages_data = [];
		$pages = get_posts( [
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 100,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		] );

		foreach ( $pages as $page ) {
			$featured_img_url = '';
			$thumb_id         = get_post_thumbnail_id( $page->ID );
			if ( $thumb_id ) {
				$featured_img_url = wp_get_attachment_image_url( $thumb_id, 'full' );
			}

			$pages_data[] = [
				'title'              => $page->post_title,
				'slug'               => $page->post_name,
				'content'            => $page->post_content, // Raw block markup!
				'menu_order'         => (int) $page->menu_order,
				'featured_image_url' => $featured_img_url,
				'meta'               => [
					'_gravisain_vertical_spacing'   => get_post_meta( $page->ID, '_gravisain_vertical_spacing', true ),
					'_gravisain_page_layout'        => get_post_meta( $page->ID, '_gravisain_page_layout', true ),
					'_gravisain_header_transparent' => get_post_meta( $page->ID, '_gravisain_header_transparent', true ),
					'_gravisain_disable_header'     => get_post_meta( $page->ID, '_gravisain_disable_header', true ),
					'_gravisain_disable_footer'     => get_post_meta( $page->ID, '_gravisain_disable_footer', true ),
				],
			];
		}

		return $pages_data;
	}
}
