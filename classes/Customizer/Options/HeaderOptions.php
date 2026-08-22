<?php
/**
 * Header Options Panel for Customizer
 *
 * @package Gravisain\Customizer\Options
 */

namespace Gravisain\Customizer\Options;

use Gravisain\Customizer\Options\Header\TopRowOptions;
use Gravisain\Customizer\Options\Header\MainRowOptions;
use Gravisain\Customizer\Options\Header\BottomRowOptions;
use Gravisain\Customizer\Options\Header\ComponentOptions;
use Gravisain\Customizer\Sections\HeadingSection;

class HeaderOptions {
	public function register( $wp_customize ): void {
		// Register Header Panel
		$wp_customize->add_panel( 'gravisain_header_panel', [
			'title'       => __( 'Header', 'gravisain' ),
			'description' => __( 'Build your header layout.', 'gravisain' ),
			'priority'    => 40,
		] );

		// Register Section Group Headings for Header Panel
		$wp_customize->add_section( new HeadingSection( $wp_customize, 'gravisain_header_heading_general', [
			'title'    => __( 'Global Settings', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 5,
		] ) );

		$wp_customize->add_section( new HeadingSection( $wp_customize, 'gravisain_header_heading_rows', [
			'title'    => __( 'Header Rows', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 20,
		] ) );

		$wp_customize->add_section( new HeadingSection( $wp_customize, 'gravisain_header_heading_navigation', [
			'title'    => __( 'Navigation & Menus', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 30,
		] ) );

		$wp_customize->add_section( new HeadingSection( $wp_customize, 'gravisain_header_heading_components', [
			'title'    => __( 'Builder Components', 'gravisain' ),
			'panel'    => 'gravisain_header_panel',
			'priority' => 40,
		] ) );

		// Register Header Builder Layout Setting
		$wp_customize->add_setting( 'gravisain_header_builder_layout', [
			'default'           => '',
			'sanitize_callback' => [ __CLASS__, 'sanitize_layout_json' ],
			'transport'         => 'postMessage',
		] );

		// Register Hidden Control for the Layout
		$wp_customize->add_control( 'gravisain_header_builder_layout', [
			'type'     => 'hidden',
			'section'  => 'gravisain_header_main_row', // Assign to any header section
			'settings' => 'gravisain_header_builder_layout',
		] );

		// Load Header Row Options
		( new TopRowOptions() )->register( $wp_customize );
		( new MainRowOptions() )->register( $wp_customize );
		( new BottomRowOptions() )->register( $wp_customize );
		( new ComponentOptions() )->register( $wp_customize );

		// Setup Selective Refresh for the entire Header
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'gravisain_header_builder_layout', [
				'selector'            => '#masthead',
				'settings'            => [ 'gravisain_header_builder_layout' ],
				'render_callback'     => function() {
					// We need to re-render the header template part
					get_template_part( 'template-parts/header' );
				},
				'container_inclusive' => true,
				'fallback_refresh'    => true,
			] );
		}
	}

	/**
	 * Sanitize Header Builder Layout JSON to prevent injection or invalid structures.
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
				foreach ( ['left', 'center', 'right'] as $col ) {
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
