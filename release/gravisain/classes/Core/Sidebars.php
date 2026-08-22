<?php
/**
 * Sidebars and Widget Areas Management
 *
 * @package Gravisain\Core
 */

namespace Gravisain\Core;

/**
 * Sidebars Class
 * 
 * Registers WordPress widget areas (sidebars) for the blog and modular footer builder.
 */
class Sidebars {

	/**
	 * Initialize the Sidebars service.
	 *
	 * @return void
	 */
	public static function init(): void {
		$instance = new self();
		add_action( 'widgets_init', [ $instance, 'register_sidebars' ] );
	}

	/**
	 * Register sidebars and widget areas.
	 *
	 * @return void
	 */
	public function register_sidebars(): void {
		// 1. Main Blog Sidebar
		register_sidebar( [
			'name'          => __( 'Main Blog Sidebar', 'gravisain' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your blog sidebar.', 'gravisain' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		] );

		// 2. Footer Widget Areas (1 to 4)
		for ( $i = 1; $i <= 4; $i++ ) {
			register_sidebar( [
				/* translators: %d: Footer widget number. */
				'name'          => sprintf( __( 'Footer Widget %d', 'gravisain' ), $i ),
				'id'            => 'footer-widget-' . $i,
				'description'   => sprintf( __( 'Add widgets here to appear in Footer column %d.', 'gravisain' ), $i ),
				'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title footer-widget-title">',
				'after_title'   => '</h3>',
			] );
		}
	}
}
