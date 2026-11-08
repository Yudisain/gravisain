<?php
/**
 * Main Application
 *
 * @package Gravisain\Core
 */

namespace Gravisain\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
		add_action( 'init', [ $this, 'register_pattern_categories' ] );
	}

	/**
	 * Register custom block pattern categories.
	 *
	 * @return void
	 */
	public function register_pattern_categories(): void {
		if ( function_exists( 'register_block_pattern_category' ) ) {
			register_block_pattern_category(
				'gravisain',
				[
					'label' => __( 'Gravisain', 'gravisain' ),
				]
			);
		}
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
		add_theme_support( 'custom-background' );

		// Editor styling (resolved dynamically from Vite manifest)
		$manifest_path = get_template_directory() . '/assets/manifest.json';
		if ( file_exists( $manifest_path ) ) {
			// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			$manifest_json = file_get_contents( $manifest_path );
			$manifest      = $manifest_json ? json_decode( $manifest_json, true ) : null;
			if ( is_array( $manifest ) && ! empty( $manifest['src/css/main.css']['file'] ) ) {
				add_editor_style( 'assets/' . ltrim( (string) $manifest['src/css/main.css']['file'], '/' ) );
			}
		}

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
