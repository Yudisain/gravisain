<?php
/**
 * Related Posts Component
 *
 * Retrieves related posts based on categories or tags with transient caching
 * for high-performance MySQL query execution.
 *
 * @package Gravisain\Components
 */

namespace Gravisain\Components;

class RelatedPosts {

	/**
	 * Initialize component hooks.
	 *
	 * @return void
	 */
	public static function init(): void {
		add_action( 'save_post', [ __CLASS__, 'clear_post_transient' ] );
		add_action( 'deleted_post', [ __CLASS__, 'clear_post_transient' ] );
	}

	/**
	 * Clear transient cache when post is saved or updated.
	 *
	 * @param int $post_id Post ID.
	 * @return void
	 */
	public static function clear_post_transient( $post_id ): void {
		if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
			return;
		}

		delete_transient( 'gravisain_related_' . (int) $post_id . '_3' );
		delete_transient( 'gravisain_related_' . (int) $post_id . '_6' );
	}

	/**
	 * Get related posts query object.
	 *
	 * @param int $post_id Current post ID.
	 * @param int $limit   Number of posts to retrieve.
	 * @return \WP_Query
	 */
	public static function get_related_posts( int $post_id = 0, int $limit = 3 ): \WP_Query {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$cache_key = 'gravisain_related_' . (int) $post_id . '_' . (int) $limit;
		$cached    = get_transient( $cache_key );

		if ( false !== $cached && $cached instanceof \WP_Query ) {
			return $cached;
		}

		$categories = get_the_category( $post_id );
		$cat_ids    = [];

		if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $cat ) {
				$cat_ids[] = (int) $cat->term_id;
			}
		}

		$args = [
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => $limit,
			'post__not_in'        => [ $post_id ],
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		];

		if ( ! empty( $cat_ids ) ) {
			$args['category__in'] = $cat_ids;
		}

		$query = new \WP_Query( $args );

		// Cache for 24 hours
		set_transient( $cache_key, $query, DAY_IN_SECONDS );

		return $query;
	}

	/**
	 * Check if Related Posts should render.
	 *
	 * @return bool
	 */
	public static function should_render(): bool {
		if ( ! is_single() || 'post' !== get_post_type() ) {
			return false;
		}

		return (bool) get_theme_mod( 'gravisain_single_post_related_posts', true );
	}

	/**
	 * Render Related Posts component.
	 *
	 * @return void
	 */
	public static function render(): void {
		if ( ! self::should_render() ) {
			return;
		}

		get_template_part( 'template-parts/content/single-related' );
	}
}
