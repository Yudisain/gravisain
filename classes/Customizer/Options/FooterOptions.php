<?php
/**
 * Footer Options Panel for Customizer
 *
 * @package Gravisain\Customizer\Options
 */

namespace Gravisain\Customizer\Options;

use Gravisain\Customizer\Controls\ButtonGroupControl;
use Gravisain\Customizer\Controls\SliderControl;
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

		// Register Scroll to Top Section inside Footer Panel
		$wp_customize->add_section( 'gravisain_footer_scroll_top', [
			'title'       => __( 'Scroll to Top & Interactive UX', 'gravisain' ),
			'panel'       => 'gravisain_footer_panel',
			'priority'    => 10,
		] );

		$wp_customize->add_control( 'gravisain_enable_scroll_top_footer_control', [
			'label'       => __( 'Enable Scroll to Top Button', 'gravisain' ),
			'description' => __( 'Displays a floating back-to-top button with a scroll progress ring in the bottom-right corner when scrolling down.', 'gravisain' ),
			'section'     => 'gravisain_footer_scroll_top',
			'settings'    => 'gravisain_enable_scroll_top',
			'type'        => 'checkbox',
		] );

		$scroll_top_active_callback = function() {
			return get_theme_mod( 'gravisain_enable_scroll_top', true );
		};

		$wp_customize->add_control( new ButtonGroupControl( $wp_customize, 'gravisain_scroll_top_position_footer_control', [
			'label'           => __( 'Scroll to Top Position', 'gravisain' ),
			'description'     => __( 'Choose whether the button appears on the left or right side of the screen.', 'gravisain' ),
			'section'         => 'gravisain_footer_scroll_top',
			'settings'        => 'gravisain_scroll_top_position',
			'active_callback' => $scroll_top_active_callback,
			'choices'         => [
				'left'  => __( 'Left', 'gravisain' ),
				'right' => __( 'Right', 'gravisain' ),
			],
		] ) );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_scroll_top_icon_size_footer_control', [
			'label'           => __( 'Scroll to Top Icon Size', 'gravisain' ),
			'description'     => __( 'Adjust the size of the floating back-to-top button container and icon proportionally across devices.', 'gravisain' ),
			'section'         => 'gravisain_footer_scroll_top',
			'settings'        => 'gravisain_scroll_top_icon_size',
			'active_callback' => $scroll_top_active_callback,
			'responsive'      => true,
			'units'           => [ 'px', 'em', 'rem' ],
			'input_attrs'     => [
				'px'  => [ 'min' => 10, 'max' => 50, 'step' => 1 ],
				'em'  => [ 'min' => 0.8, 'max' => 3.5, 'step' => 0.1 ],
				'rem' => [ 'min' => 0.8, 'max' => 3.5, 'step' => 0.1 ],
			],
		] ) );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_scroll_top_side_offset_footer_control', [
			'label'           => __( 'Scroll to Top Side Offset', 'gravisain' ),
			'description'     => __( 'Adjust distance from the left or right edge of the screen.', 'gravisain' ),
			'section'         => 'gravisain_footer_scroll_top',
			'settings'        => 'gravisain_scroll_top_side_offset',
			'active_callback' => $scroll_top_active_callback,
			'responsive'      => true,
			'units'           => [ 'rem', 'px', '%' ],
			'input_attrs'     => [
				'rem' => [ 'min' => 0, 'max' => 10, 'step' => 0.1 ],
				'px'  => [ 'min' => 0, 'max' => 150, 'step' => 1 ],
				'%'   => [ 'min' => 0, 'max' => 50, 'step' => 1 ],
			],
		] ) );

		$wp_customize->add_control( new SliderControl( $wp_customize, 'gravisain_scroll_top_bottom_offset_footer_control', [
			'label'           => __( 'Scroll to Top Bottom Offset', 'gravisain' ),
			'description'     => __( 'Adjust distance from the bottom edge of the screen.', 'gravisain' ),
			'section'         => 'gravisain_footer_scroll_top',
			'settings'        => 'gravisain_scroll_top_bottom_offset',
			'active_callback' => $scroll_top_active_callback,
			'responsive'      => true,
			'units'           => [ 'rem', 'px', '%' ],
			'input_attrs'     => [
				'rem' => [ 'min' => 0, 'max' => 10, 'step' => 0.1 ],
				'px'  => [ 'min' => 0, 'max' => 150, 'step' => 1 ],
				'%'   => [ 'min' => 0, 'max' => 50, 'step' => 1 ],
			],
		] ) );

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
