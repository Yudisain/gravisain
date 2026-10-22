<?php
/**
 * Gravisain Theme Functions
 *
 * @package Gravisain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// 1. Graceful PHP Version Compatibility Check (Prevents Critical Errors on old hosting PHP versions).
if ( version_compare( PHP_VERSION, '8.0.0', '<' ) ) {
	add_action( 'admin_notices', function () {
		printf(
			'<div class="notice notice-error"><p><strong>%1$s</strong>: %2$s</p></div>',
			esc_html__( 'Gravisain Theme', 'gravisain' ),
			sprintf(
				/* translators: %s: Current PHP version */
				esc_html__( 'Gravisain requires PHP 8.0 or higher. Your server is currently running PHP %s. Please update your PHP version in your hosting control panel (e.g. Hostinger hPanel / cPanel).', 'gravisain' ),
				esc_html( PHP_VERSION )
			)
		);
	} );
	return;
}

// 2. Define Theme Constants.
define( 'GRAVISAIN_VERSION', '1.0.1' );
define( 'GRAVISAIN_THEME_DIR', get_template_directory() . '/' );
define( 'GRAVISAIN_THEME_URL', get_template_directory_uri() . '/' );

// 3. Register Native Universal PSR-4 Autoloader for Gravisain classes.
spl_autoload_register( function ( $class ) {
	$prefix   = 'Gravisain\\';
	$base_dir = __DIR__ . '/classes/';

	$len = strlen( $prefix );
	if ( strncmp( $prefix, $class, $len ) !== 0 ) {
		return;
	}

	$relative_class = substr( $class, $len );
	$file           = $base_dir . str_replace( '\\', '/', $relative_class ) . '.php';

	if ( file_exists( $file ) ) {
		require_once $file;
	}
} );

// 3. Load Composer Autoloader if present.
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
}

// 4. Initialize the Theme with Safe Exception Catching (Prevents Critical Error white screen on Linux/Shared Hosting).
try {
	\Gravisain\Core\Bootstrap::init();
} catch ( \Throwable $e ) {
	add_action( 'admin_notices', function () use ( $e ) {
		printf(
			'<div class="notice notice-error is-dismissible"><p><strong>%1$s</strong>: %2$s <br><code>%3$s:%4$d</code></p></div>',
			esc_html__( 'Gravisain Theme Initialization Notice', 'gravisain' ),
			esc_html( $e->getMessage() ),
			esc_html( $e->getFile() ),
			(int) $e->getLine()
		);
	} );

	if ( ! is_admin() && current_user_can( 'manage_options' ) ) {
		add_action( 'wp_footer', function () use ( $e ) {
			printf(
				'<div style="background:#fee2e2;color:#991b1b;padding:15px;border-top:2px solid #ef4444;font-family:monospace;z-index:999999;position:relative;"><strong>Gravisain Debug:</strong> %s in %s:%d</div>',
				esc_html( $e->getMessage() ),
				esc_html( $e->getFile() ),
				(int) $e->getLine()
			);
		} );
	}
}
