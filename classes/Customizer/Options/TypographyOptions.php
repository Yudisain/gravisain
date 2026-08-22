<?php
/**
 * Global Typography Options for Customizer
 *
 * @package Gravisain\Customizer\Options
 */

namespace Gravisain\Customizer\Options;

use Gravisain\Customizer\Controls\TypographyControl;

class TypographyOptions {
	public function register( $wp_customize ): void {
		// Typography Section
		$wp_customize->add_section( 'gravisain_typography', [
			'title'       => __( 'Global Typography', 'gravisain' ),
			'description' => __( 'Set the default typography for your website.', 'gravisain' ),
			'panel'       => 'gravisain_options',
			'priority'    => 16,
		] );

		// Base Font
		$wp_customize->add_setting( 'gravisain_typography_base', [
			'default'           => '{"family":"Inter","style":"400","size":"16","spacing":"0"}',
			'sanitize_callback' => 'sanitize_text_field', // Validated via JSON later
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new TypographyControl( $wp_customize, 'gravisain_typography_base', [
			'label'       => __( 'Base Font', 'gravisain' ),
			'description' => __( 'Used for standard paragraph text (body).', 'gravisain' ),
			'section'     => 'gravisain_typography',
			'preview_text'=> __( 'The quick brown fox jumps over the lazy dog.', 'gravisain' ),
		] ) );

		// H1 Font
		$wp_customize->add_setting( 'gravisain_typography_h1', [
			'default'           => '{"family":"Inter","style":"700","size":"40","spacing":"-1"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new TypographyControl( $wp_customize, 'gravisain_typography_h1', [
			'label'       => __( 'Heading 1 (H1)', 'gravisain' ),
			'section'     => 'gravisain_typography',
			'preview_text'=> __( 'Heading 1 Typography', 'gravisain' ),
		] ) );

		// H2 Font
		$wp_customize->add_setting( 'gravisain_typography_h2', [
			'default'           => '{"family":"Inter","style":"700","size":"32","spacing":"-0.5"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new TypographyControl( $wp_customize, 'gravisain_typography_h2', [
			'label'       => __( 'Heading 2 (H2)', 'gravisain' ),
			'section'     => 'gravisain_typography',
			'preview_text'=> __( 'Heading 2 Typography', 'gravisain' ),
		] ) );

		// H3 Font
		$wp_customize->add_setting( 'gravisain_typography_h3', [
			'default'           => '{"family":"Inter","style":"700","size":"28","spacing":"0"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new TypographyControl( $wp_customize, 'gravisain_typography_h3', [
			'label'       => __( 'Heading 3 (H3)', 'gravisain' ),
			'section'     => 'gravisain_typography',
			'preview_text'=> __( 'Heading 3 Typography', 'gravisain' ),
		] ) );

		// H4 Font
		$wp_customize->add_setting( 'gravisain_typography_h4', [
			'default'           => '{"family":"Inter","style":"600","size":"24","spacing":"0"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new TypographyControl( $wp_customize, 'gravisain_typography_h4', [
			'label'       => __( 'Heading 4 (H4)', 'gravisain' ),
			'section'     => 'gravisain_typography',
			'preview_text'=> __( 'Heading 4 Typography', 'gravisain' ),
		] ) );

		// H5 Font
		$wp_customize->add_setting( 'gravisain_typography_h5', [
			'default'           => '{"family":"Inter","style":"600","size":"20","spacing":"0"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new TypographyControl( $wp_customize, 'gravisain_typography_h5', [
			'label'       => __( 'Heading 5 (H5)', 'gravisain' ),
			'section'     => 'gravisain_typography',
			'preview_text'=> __( 'Heading 5 Typography', 'gravisain' ),
		] ) );

		// H6 Font
		$wp_customize->add_setting( 'gravisain_typography_h6', [
			'default'           => '{"family":"Inter","style":"600","size":"16","spacing":"0"}',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( new TypographyControl( $wp_customize, 'gravisain_typography_h6', [
			'label'       => __( 'Heading 6 (H6)', 'gravisain' ),
			'section'     => 'gravisain_typography',
			'preview_text'=> __( 'Heading 6 Typography', 'gravisain' ),
		] ) );
	}
}
