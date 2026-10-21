<?php
/**
 * Sticky Header Options for Customizer
 *
 * @package Gravisain\Customizer\Options
 */

namespace Gravisain\Customizer\Options;

class StickyHeaderOptions {
	public function register( $wp_customize ): void {
		$wp_customize->add_section( 'gravisain_header_sticky', [
			'title'       => __( 'Sticky Header', 'gravisain' ),
			'panel'       => 'gravisain_header_panel',
			'priority'    => 13,
			'description' => __( 'Configure the sticky header settings. Keep navigation accessible at the top of the viewport when scrolling.', 'gravisain' ),
		] );

		// Enable Sticky Header Mode
		$wp_customize->add_setting( 'gravisain_sticky_header_enable', [
			'default'           => 'none',
			'sanitize_callback' => [ $this, 'sanitize_sticky_mode' ],
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \Gravisain\Customizer\Controls\StickyRowsControl( $wp_customize, 'gravisain_sticky_header_enable', [
			'label'       => __( 'Sticky Header Rows', 'gravisain' ),
			'description' => __( 'Check rows that should stick on scroll. Choose Disable or Entire Header to toggle all.', 'gravisain' ),
			'section'     => 'gravisain_header_sticky',
		] ) );

		// Enable on Desktop
		$wp_customize->add_setting( 'gravisain_sticky_header_desktop', [
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_sticky_header_desktop', [
			'label'   => __( 'Enable on Desktop', 'gravisain' ),
			'section' => 'gravisain_header_sticky',
			'type'    => 'checkbox',
		] );

		// Enable on Mobile/Tablet
		$wp_customize->add_setting( 'gravisain_sticky_header_mobile', [
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_sticky_header_mobile', [
			'label'   => __( 'Enable on Mobile & Tablet', 'gravisain' ),
			'section' => 'gravisain_header_sticky',
			'type'    => 'checkbox',
		] );

		// Sticky Behavior
		$wp_customize->add_setting( 'gravisain_sticky_header_behavior', [
			'default'           => 'always',
			'sanitize_callback' => [ $this, 'sanitize_behavior' ],
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_sticky_header_behavior', [
			'label'       => __( 'Sticky Behavior', 'gravisain' ),
			'description' => __( 'Choose how the sticky header behaves while scrolling.', 'gravisain' ),
			'section'     => 'gravisain_header_sticky',
			'type'        => 'select',
			'choices'     => [
				'always'    => __( 'Always Sticky When Scrolled', 'gravisain' ),
				'scroll_up' => __( 'Smart Reveal (Hide on Scroll Down, Show on Scroll Up)', 'gravisain' ),
			],
		] );

		// Sticky Header Logo (Alternate Logo on Scroll)
		$wp_customize->add_setting( 'gravisain_sticky_header_logo', [
			'default'           => '',
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Media_Control( $wp_customize, 'gravisain_sticky_header_logo', [
			'label'       => __( 'Sticky Header Logo', 'gravisain' ),
			'description' => __( 'Upload an alternate logo to display when header is scrolled/sticky (e.g. a light/white logo). Leave empty to use default logo.', 'gravisain' ),
			'section'     => 'gravisain_header_sticky',
			'mime_type'   => 'image',
		] ) );

		// Shrink Header
		$wp_customize->add_setting( 'gravisain_sticky_header_shrink', [
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_sticky_header_shrink', [
			'label'       => __( 'Shrink Header on Scroll', 'gravisain' ),
			'description' => __( 'Compact the header height and logo slightly when in sticky state.', 'gravisain' ),
			'section'     => 'gravisain_header_sticky',
			'type'        => 'checkbox',
		] );

		// Shrink Row Height
		$wp_customize->add_setting( 'gravisain_sticky_header_shrink_height', [
			'default'           => '54px',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \Gravisain\Customizer\Controls\SliderControl( $wp_customize, 'gravisain_sticky_header_shrink_height', [
			'label'       => __( 'Shrink Row Height', 'gravisain' ),
			'description' => __( 'Set custom row height when header is shrunk.', 'gravisain' ),
			'section'     => 'gravisain_header_sticky',
			'units'       => [ 'px' ],
			'input_attrs' => [
				'px' => [ 'min' => 30, 'max' => 120, 'step' => 1 ],
			],
		] ) );

		// Shrink Logo Height
		$wp_customize->add_setting( 'gravisain_sticky_header_shrink_logo_height', [
			'default'           => '40px',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \Gravisain\Customizer\Controls\SliderControl( $wp_customize, 'gravisain_sticky_header_shrink_logo_height', [
			'label'       => __( 'Shrink Logo Height', 'gravisain' ),
			'description' => __( 'Set custom maximum height for logo when header is shrunk.', 'gravisain' ),
			'section'     => 'gravisain_header_sticky',
			'units'       => [ 'px' ],
			'input_attrs' => [
				'px' => [ 'min' => 20, 'max' => 100, 'step' => 1 ],
			],
		] ) );

		// Sticky Background Color
		$wp_customize->add_setting( 'gravisain_sticky_header_bg_color', [
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_sticky_header_bg_color', [
			'label'       => __( 'Sticky Background Color', 'gravisain' ),
			'description' => __( 'Choose the background color when header is sticky.', 'gravisain' ),
			'section'     => 'gravisain_header_sticky',
		] ) );

		// Sticky Text Color
		$wp_customize->add_setting( 'gravisain_sticky_header_text_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_sticky_header_text_color', [
			'label'       => __( 'Sticky Navigation Text Color', 'gravisain' ),
			'description' => __( 'Optional custom text color when sticky.', 'gravisain' ),
			'section'     => 'gravisain_header_sticky',
		] ) );

		// Sticky Hamburger / Trigger Color
		$wp_customize->add_setting( 'gravisain_sticky_header_trigger_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_sticky_header_trigger_color', [
			'label'       => __( 'Sticky Hamburger / Trigger Color', 'gravisain' ),
			'description' => __( 'Optional custom color for hamburger button when sticky. If left empty, it will follow Sticky Navigation Text Color.', 'gravisain' ),
			'section'     => 'gravisain_header_sticky',
		] ) );

		// Sticky Hamburger / Trigger Hover Color
		$wp_customize->add_setting( 'gravisain_sticky_header_trigger_color_hover', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_sticky_header_trigger_color_hover', [
			'label'       => __( 'Sticky Hamburger Hover Color', 'gravisain' ),
			'description' => __( 'Optional custom hover color for hamburger button when sticky.', 'gravisain' ),
			'section'     => 'gravisain_header_sticky',
		] ) );

		// Sticky Shadow
		$wp_customize->add_setting( 'gravisain_sticky_header_shadow', [
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_sticky_header_shadow', [
			'label'       => __( 'Enable Subtle Drop Shadow', 'gravisain' ),
			'section'     => 'gravisain_header_sticky',
			'type'        => 'checkbox',
		] );
	}

	/**
	 * Sanitize sticky mode setting.
	 *
	 * @param string $input Input value.
	 * @return string
	 */
	public function sanitize_sticky_mode( string $input ): string {
		if ( empty( $input ) ) {
			return 'none';
		}
		$tokens = array_map( 'trim', explode( ',', $input ) );
		$valid  = [ 'none', 'entire_header', 'top_row', 'main_row', 'bottom_row' ];
		$clean  = [];
		foreach ( $tokens as $token ) {
			if ( in_array( $token, $valid, true ) ) {
				$clean[] = $token;
			}
		}
		return ! empty( $clean ) ? implode( ',', $clean ) : 'none';
	}

	/**
	 * Sanitize sticky behavior setting.
	 *
	 * @param string $input Input value.
	 * @return string
	 */
	public function sanitize_behavior( string $input ): string {
		$valid = [ 'always', 'scroll_up' ];
		return in_array( $input, $valid, true ) ? $input : 'always';
	}
}
