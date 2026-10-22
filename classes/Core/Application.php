<?php
/**
 * Main Application
 *
 * @package Gravisain\Core
 */

namespace Gravisain\Core;

/**
 * Application Class
 * 
 * Responsible for registering services and managing the theme lifecycle.
 */
class Application {

	/**
	 * Instance of this class.
	 *
	 * @var self|null
	 */
	private static ?self $instance = null;

	/**
	 * Constructor.
	 */
	private function __construct() {
		// Private constructor to enforce Singleton pattern
	}

	/**
	 * Get the singleton instance.
	 *
	 * @return self
	 */
	public static function get_instance(): self {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Run the application.
	 *
	 * @return void
	 */
	public function run(): void {
		$this->register_services();
		$this->setup_hooks();
	}

	/**
	 * Register all theme services.
	 *
	 * @return void
	 */
	private function register_services(): void {
		$provider = new ServiceProvider();
		$provider->register();
	}

	/**
	 * Setup global hooks.
	 *
	 * @return void
	 */
	private function setup_hooks(): void {
		// Theme setup hook
		add_action( 'after_setup_theme', [ $this, 'theme_setup' ] );
	}

	/**
	 * Basic theme setup configuration.
	 *
	 * @return void
	 */
	public function theme_setup(): void {
		// Set global content width for media and oEmbeds.
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 1200;
		}

		// Load translation files.
		load_theme_textdomain( 'gravisain', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable Block Editor styles wrapper.
		add_theme_support( 'editor-styles' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', [
			'height'               => 100,
			'width'                => 300,
			'flex-width'           => true,
			'flex-height'          => true,
			'unlink-homepage-logo' => false,
		] );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Recommended Block Theme Features
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );

		// Recommended Customizer Features
		add_theme_support( 'custom-header' );
		add_theme_support( 'custom-background' );

		// Editor styling
		add_editor_style( 'assets/css/main.css' );

		// Register a block style to pass Theme Check recommendation
		register_block_style( 'core/button', array(
			'name'  => 'gravisain-btn',
			'label' => __( 'Gravisain Button', 'gravisain' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		] );

		// Register Navigation Menus.
		register_nav_menus( [
			'primary'    => __( 'Primary Navigation', 'gravisain' ),
			'secondary'  => __( 'Secondary Navigation', 'gravisain' ),
			'off-canvas' => __( 'Off-Canvas Mobile Navigation', 'gravisain' ),
			'footer'     => __( 'Footer Navigation', 'gravisain' ),
		] );

	}
}
