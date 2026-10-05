<?php
/**
 * Footer Options Panel for Customizer
 *
 * @package Gravisain\Customizer\Options
 */

namespace Gravisain\Customizer\Options;

use Gravisain\Customizer\Options\Footer\TopRowOptions;
use Gravisain\Customizer\Options\Footer\MainRowOptions;
use Gravisain\Customizer\Options\Footer\BottomRowOptions;
use Gravisain\Customizer\Options\Footer\ComponentOptions;

class FooterOptions {
	public function register( $wp_customize ): void {
		// Register Footer Panel
		$wp_customize->add_panel( 'gravisain_footer_panel', [
			'title'       => __( 'Footer', 'gravisain' ),
			'description' => __( 'Build your footer layout.', 'gravisain' ),
			'priority'    => 50,
		] );


		// Register Footer Builder Layout Setting
		$wp_customize->add_setting( 'gravisain_footer_builder_layout', [
			'default'           => '',
			'sanitize_callback' => [ __CLASS__, 'sanitize_layout_json' ],
			'transport'         => 'postMessage',
		] );

		// Register Hidden Control for the Layout
		$wp_customize->add_control( 'gravisain_footer_builder_layout', [
			'type'     => 'hidden',
			'section'  => 'gravisain_footer_main_row', // Assign to main footer section
			'settings' => 'gravisain_footer_builder_layout',
		] );

		// Load Footer Row Options
		( new TopRowOptions() )->register( $wp_customize );
		( new MainRowOptions() )->register( $wp_customize );
		( new BottomRowOptions() )->register( $wp_customize );
		( new ComponentOptions() )->register( $wp_customize );

		// Setup Selective Refresh for the entire Footer
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'gravisain_footer_builder_layout', [
				'selector'            => '#colophon',
				'settings'            => [ 'gravisain_footer_builder_layout' ],
				'render_callback'     => function() {
					// Re-render the footer template part
					get_template_part( 'template-parts/footer' );
				},
				'container_inclusive' => true,
				'fallback_refresh'    => true,
			] );
		}
	}

	/**
	 * Sanitize Footer Builder Layout JSON.
	 *
	 * @param string $json The JSON string from Customizer.
	 * @return string
	 */
	public static function sanitize_layout_json( $json ): string {
		if ( empty( $json ) || ! is_string( $json ) ) {
			return '';
		}
		$data = json_decode( $json, true );
		if ( ! is_array( $data ) ) {
			return '';
		}
		$clean = [];
		foreach ( ['top', 'main', 'bottom'] as $row ) {
			if ( isset( $data[ $row ] ) && is_array( $data[ $row ] ) ) {
				foreach ( ['col-1', 'col-2', 'col-3', 'col-4'] as $col ) {
					if ( isset( $data[ $row ][ $col ] ) && is_array( $data[ $row ][ $col ] ) ) {
						$clean[ $row ][ $col ] = array_map( 'sanitize_key', $data[ $row ][ $col ] );
					} else {
						$clean[ $row ][ $col ] = [];
					}
				}
			}
		}
		return wp_json_encode( $clean );
	}
}
