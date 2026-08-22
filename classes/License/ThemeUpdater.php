<?php
/**
 * Theme Updater
 *
 * @package Gravisain\License
 */

namespace Gravisain\License;

class ThemeUpdater {

	const API_URL = 'https://ls.undagital.com/api/v1/update';

	public static function init(): void {
		$instance = new self();
		add_filter( 'pre_set_site_transient_update_themes', [ $instance, 'check_for_updates' ] );
	}

	public function check_for_updates( $transient ) {
		if ( empty( $transient->checked ) ) {
			return $transient;
		}

		if ( ! LicenseManager::is_active() ) {
			return $transient;
		}

		$theme = wp_get_theme();
		$current_version = $theme->get( 'Version' );
		$theme_slug = $theme->get_stylesheet();

		$license_key = LicenseManager::get_license_key();
		if ( empty( $license_key ) ) {
			return $transient;
		}

		$url = home_url();
		$parsed = wp_parse_url($url);
		$domain = isset($parsed['host']) ? $parsed['host'] : $url;

		$api_url = self::API_URL . '/check?license_key=' . urlencode( $license_key ) . '&domain=' . urlencode( $domain ) . '&product=' . LicenseManager::PRODUCT_SLUG;

		$response = wp_remote_get( $api_url, [
			'timeout' => 15,
			'sslverify' => false,
		] );

		if ( is_wp_error( $response ) ) {
			return $transient;
		}

		$status_code = wp_remote_retrieve_response_code( $response );
		if ( $status_code !== 200 ) {
			return $transient;
		}

		$body = json_decode( wp_remote_retrieve_body( $response ), true );
		if ( empty( $body['success'] ) || empty( $body['data'] ) ) {
			return $transient;
		}

		$data = $body['data'];

		if ( version_compare( $current_version, $data['version'], '<' ) ) {
			$update = [
				'theme'       => $theme_slug,
				'new_version' => $data['version'],
				'url'         => '',
				'package'     => $data['package'],
			];
			if ( ! empty( $data['requires_wp'] ) ) {
				$update['requires'] = $data['requires_wp'];
			}
			if ( ! empty( $data['requires_php'] ) ) {
				$update['requires_php'] = $data['requires_php'];
			}
			$transient->response[ $theme_slug ] = $update;
		}

		return $transient;
	}
}
