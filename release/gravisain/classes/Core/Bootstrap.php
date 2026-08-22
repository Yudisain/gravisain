<?php
/**
 * Theme Bootstrap
 *
 * @package Gravisain\Core
 */

namespace Gravisain\Core;

/**
 * Bootstrap Class
 * 
 * Acts as the primary entry point for the theme.
 */
class Bootstrap {

	/**
	 * Initialize the application.
	 *
	 * @return void
	 */
	public static function init(): void {
		// Ensure it only runs once per request
		static $initialized = false;

		if ( $initialized ) {
			return;
		}

		$initialized = true;

		// Initialize the main Application
		$application = Application::get_instance();
		$application->run();
	}
}
