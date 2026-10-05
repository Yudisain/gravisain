<?php
/**
 * Elements Engine
 *
 * @package Gravisain\Core
 */

declare(strict_types=1);

namespace Gravisain\Core;

/**
 * Elements Engine Class
 * 
 * Registers the gravisain_element post type and handles hooking blocks into the theme.
 */
class ElementsEngine {

	/**
	 * Initialize the Elements Engine service.
	 *
	 * @return void
	 */
	public static function init(): void {
		$instance = new self();
		// Removed init action for CPT to comply with Theme Check.
		add_action( 'wp', [ $instance, 'setup_hooks' ] );
		add_action( 'save_post_gravisain_element', [ $instance, 'clear_cache' ] );
	}



	/**
	 * Read elements and hook them into WordPress actions.
	 *
	 * @return void
	 */
	public function setup_hooks(): void {
		if ( is_admin() ) {
			return;
		}

		$elements = $this->get_active_elements();

		foreach ( $elements as $element ) {
			if ( $this->should_display( $element->ID ) ) {
				$hook     = get_post_meta( $element->ID, '_gravisain_element_hook', true );
				$priority = get_post_meta( $element->ID, '_gravisain_element_priority', true );
				
				if ( ! empty( $hook ) ) {
					$priority = is_numeric( $priority ) ? (int) $priority : 10;
					
					add_action( $hook, function() use ( $element ) {
						echo '<div class="gravisain-element gravisain-element-' . esc_attr( $element->ID ) . '">';
						$content = do_blocks( $element->post_content );
						echo do_shortcode( $content );
						echo '</div>';
					}, $priority );
				}
			}
		}
	}

	/**
	 * Get active published elements.
	 *
	 * @return array
	 */
	private function get_active_elements(): array {
		$cache_key = 'gravisain_active_elements';
		$elements  = get_transient( $cache_key );

		if ( false === $elements ) {
			$query = new \WP_Query( [
				'post_type'      => 'gravisain_element',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'no_found_rows'  => true, // Optimize query speed
			] );
			
			$elements = $query->posts;
			set_transient( $cache_key, $elements, HOUR_IN_SECONDS * 12 );
		}

		return is_array( $elements ) ? $elements : [];
	}

	/**
	 * Clear elements cache upon save.
	 *
	 * @return void
	 */
	public function clear_cache(): void {
		delete_transient( 'gravisain_active_elements' );
	}

	/**
	 * Determine if an element should be displayed based on rules.
	 *
	 * @param int $post_id Element Post ID.
	 * @return bool
	 */
	private function should_display( int $post_id ): bool {
		$display_rule   = get_post_meta( $post_id, '_gravisain_element_display_rule', true );
		$user_condition = get_post_meta( $post_id, '_gravisain_element_user_condition', true );

		// Check User Condition
		if ( 'logged_in' === $user_condition && ! is_user_logged_in() ) {
			return false;
		}
		if ( 'logged_out' === $user_condition && is_user_logged_in() ) {
			return false;
		}

		// Check Display Rules
		if ( 'entire_website' === $display_rule || empty( $display_rule ) ) {
			return true;
		}

		if ( 'front_page' === $display_rule && ( is_front_page() || is_home() ) ) {
			return true;
		}

		if ( 'single_post' === $display_rule && is_singular( 'post' ) ) {
			return true;
		}

		if ( 'single_page' === $display_rule && is_page() ) {
			return true;
		}

		if ( 'archive' === $display_rule && ( is_archive() || is_search() ) ) {
			return true;
		}
		
		if ( '404' === $display_rule && is_404() ) {
			return true;
		}

		return apply_filters( 'gravisain_element_should_display', false, $display_rule, $post_id );
	}
}
