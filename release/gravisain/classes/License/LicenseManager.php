<?php
/**
 * License Manager
 *
 * @package Gravisain\License
 */

namespace Gravisain\License;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class LicenseManager {

	// The API Endpoint of the Laravel License Server
	const API_URL = 'https://ls.undagital.com/api/v1/license';

	// The name of the product identifier in the DB
	const PRODUCT_SLUG = 'gravisain-theme'; // Must match the product slug in Laravel

	public static function init(): void {
		$instance = new self();
		add_action( 'wp_ajax_gravisain_activate_license', [ $instance, 'ajax_activate_license' ] );
		add_action( 'wp_ajax_gravisain_deactivate_license', [ $instance, 'ajax_deactivate_license' ] );

		// Hook for daily license verification
		add_action( 'gravisain_daily_license_verification', [ $instance, 'cron_verify_license' ] );
		
		// Verify license instantly when opening the dashboard (Max once every 5 minutes)
		add_action( 'current_screen', [ $instance, 'dashboard_verify_license' ] );
		
		// Schedule the event if it hasn't been scheduled
		if ( ! wp_next_scheduled( 'gravisain_daily_license_verification' ) ) {
			wp_schedule_event( time(), 'daily', 'gravisain_daily_license_verification' );
		}
	}

	/**
	 * Get the current license key.
	 */
	public static function get_license_key(): string {
		return get_option( 'gravisain_license_key', '' );
	}

	/**
	 * Check if the license is currently marked as active in WP.
	 */
	public static function is_active(): bool {
		return get_option( 'gravisain_license_status' ) === 'active';
	}

	/**
	 * Helper to get the current domain without scheme for the API
	 */
	private function get_domain(): string {
		$url = home_url();
		$parsed = wp_parse_url($url);
		return isset($parsed['host']) ? $parsed['host'] : $url;
	}

	/**
	 * Helper to collect environment telemetry for analytics.
	 */
	private function get_telemetry_data(): array {
		global $wp_version;
		$theme = wp_get_theme();
		
		return [
			'wp_version'  => $wp_version,
			'php_version' => phpversion(),
			'theme_name'  => $theme->get('Name'),
			'theme_version' => $theme->get('Version'),
			'server'      => isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : 'Unknown',
		];
	}

	/**
	 * CRON Handler: Periodically verify license status with the server
	 */
	public function cron_verify_license(): void {
		if ( ! self::is_active() ) {
			return;
		}

		$license_key = self::get_license_key();
		if ( empty( $license_key ) ) {
			return;
		}

		$response = wp_remote_post( self::API_URL . '/verify', [
			'headers' => [ 'Content-Type' => 'application/json', 'Accept' => 'application/json' ],
			'body'    => wp_json_encode( [
				'license_key' => $license_key,
				'domain'      => $this->get_domain(),
				'product'     => self::PRODUCT_SLUG,
				'telemetry'   => $this->get_telemetry_data(),
			] ),
			'timeout'   => 15,
		] );

		// If network request failed entirely, don't revoke. (Assume temporary network issue)
		if ( is_wp_error( $response ) ) {
			return;
		}

		$status_code = wp_remote_retrieve_response_code( $response );
		$body = json_decode( wp_remote_retrieve_body( $response ), true );

		// If server responded with 200 OK and success=true, license is still valid.
		if ( $status_code === 200 && ! empty( $body['success'] ) ) {
			return;
		}

		// If server explicitly responds with client errors or success=false, it means invalid/expired/revoked.
		// (We ignore 5xx errors to prevent revoking during server downtime)
		if ( in_array( $status_code, [ 400, 401, 403, 404, 422 ], true ) || ( isset( $body['success'] ) && $body['success'] === false ) ) {
			delete_option( 'gravisain_license_key' );
			delete_option( 'gravisain_license_status' );
		}
	}

	/**
	 * Hook: Verify license when opening the Gravisain Dashboard page
	 */
	public function dashboard_verify_license(): void {
		$screen = get_current_screen();
		if ( ! $screen || $screen->id !== 'toplevel_page_gravisain-dashboard' ) {
			return;
		}

		if ( ! self::is_active() ) {
			return;
		}

		// Prevent spamming the API and slowing down the WP admin on multiple rapid refreshes.
		// Cooldown: 5 minutes.
		if ( get_transient( 'gravisain_license_dashboard_verify' ) ) {
			return;
		}
		set_transient( 'gravisain_license_dashboard_verify', true, 5 * 60 );

		$this->cron_verify_license();
	}

	/**
	 * AJAX Handler: Activate License
	 */
	public function ajax_activate_license(): void {
		check_ajax_referer( 'gravisain_license_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( [ 'message' => __( 'Unauthorized access.', 'gravisain' ) ] );
		}

		$license_key = sanitize_text_field( $_POST['license_key'] ?? '' );
		if ( empty( $license_key ) ) {
			wp_send_json_error( [ 'message' => __( 'License key is required.', 'gravisain' ) ] );
		}

		$response = wp_remote_post( self::API_URL . '/activate', [
			'headers' => [ 'Content-Type' => 'application/json', 'Accept' => 'application/json' ],
			'body'    => wp_json_encode( [
				'license_key' => $license_key,
				'domain'      => $this->get_domain(),
				'product'     => self::PRODUCT_SLUG,
				'telemetry'   => $this->get_telemetry_data(),
			] ),
			'timeout'   => 15,
		] );

		if ( is_wp_error( $response ) ) {
			wp_send_json_error( [ 'message' => sprintf( __( 'Failed to connect to the license server. Error: %s', 'gravisain' ), $response->get_error_message() ) ] );
		}

		$body = json_decode( wp_remote_retrieve_body( $response ), true );
		$status_code = wp_remote_retrieve_response_code( $response );

		if ( $status_code === 200 && ! empty( $body['success'] ) ) {
			// Save active status locally
			update_option( 'gravisain_license_key', $license_key );
			update_option( 'gravisain_license_status', 'active' );
			wp_send_json_success( [ 'message' => $body['message'] ?? __( 'License activated.', 'gravisain' ) ] );
		}

		wp_send_json_error( [ 'message' => $body['message'] ?? __( 'Invalid license key or activation limit reached.', 'gravisain' ) ] );
	}

	/**
	 * AJAX Handler: Deactivate License
	 */
	public function ajax_deactivate_license(): void {
		check_ajax_referer( 'gravisain_license_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( [ 'message' => __( 'Unauthorized access.', 'gravisain' ) ] );
		}

		$license_key = self::get_license_key();
		
		if ( ! empty( $license_key ) ) {
			// Try to deactivate on the remote server
			wp_remote_post( self::API_URL . '/deactivate', [
				'headers' => [ 'Content-Type' => 'application/json', 'Accept' => 'application/json' ],
				'body'    => wp_json_encode( [
					'license_key' => $license_key,
					'domain'      => $this->get_domain(),
					'product'     => self::PRODUCT_SLUG
				] ),
				'timeout'   => 15,
			] );
		}

		// Always clear local options so the user can enter a new key even if the server is unreachable
		delete_option( 'gravisain_license_key' );
		delete_option( 'gravisain_license_status' );

		wp_send_json_success( [ 'message' => __( 'License deactivated successfully.', 'gravisain' ) ] );
	}
}
