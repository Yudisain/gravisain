<?php
/**
 * Global Color Options for Customizer
 *
 * @package Gravisain\Customizer\Options
 */

namespace Gravisain\Customizer\Options;

use Gravisain\Customizer\Controls\PaletteControl;

class ColorOptions {
	public function register( $wp_customize ): void {
		// Colors Section
		$wp_customize->add_section( 'gravisain_colors', [
			'title'    => __( 'Global Colors', 'gravisain' ),
			'panel'    => 'gravisain_options',
			'priority' => 15, // Put it after General but before others
		] );

		// Global Palette Setting
		$wp_customize->add_setting( 'gravisain_global_palette', [
			'default'           => wp_json_encode( [
				'#4f46e5', // 0: Primary
				'#0ea5e9', // 1: Secondary
				'#0f172a', // 2: Contrast
				'#475569', // 3: Contrast Alt
				'#ffffff', // 4: Base
				'#f8fafc', // 5: Base Alt
				'#e2e8f0', // 6: Border
				'#f43f5e', // 7: Accent
			] ),
			'sanitize_callback' => 'sanitize_text_field', // JSON string
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new PaletteControl( $wp_customize, 'gravisain_global_palette', [
			'label'       => __( 'Global Palette', 'gravisain' ),
			'description' => __( 'Choose a preset or customize the 8 global colors used throughout the theme.', 'gravisain' ),
			'section'     => 'gravisain_colors',
			'color_labels' => [
				__( 'Primary', 'gravisain' ),
				__( 'Secondary', 'gravisain' ),
				__( 'Contrast (Text)', 'gravisain' ),
				__( 'Contrast Alt (Muted)', 'gravisain' ),
				__( 'Base (Background)', 'gravisain' ),
				__( 'Base Alt (Surface)', 'gravisain' ),
				__( 'Border', 'gravisain' ),
				__( 'Accent', 'gravisain' ),
			],
			'presets'     => [
				[
					'name'   => __( 'Default', 'gravisain' ),
					'colors' => [ '#4f46e5', '#0ea5e9', '#0f172a', '#475569', '#ffffff', '#f8fafc', '#e2e8f0', '#f43f5e' ],
				],
				[
					'name'   => __( 'Dark Mode', 'gravisain' ),
					'colors' => [ '#818cf8', '#38bdf8', '#f8fafc', '#cbd5e1', '#0f172a', '#1e293b', '#334155', '#fb7185' ],
				],
				[
					'name'   => __( 'Earth', 'gravisain' ),
					'colors' => [ '#d97706', '#16a34a', '#292524', '#57534e', '#fafaf9', '#f5f5f4', '#e7e5e4', '#dc2626' ],
				],
				[
					'name'   => __( 'Ocean', 'gravisain' ),
					'colors' => [ '#0284c7', '#0d9488', '#082f49', '#0f172a', '#f0f9ff', '#e0f2fe', '#bae6fd', '#e11d48' ],
				]
			],
		] ) );

		// Dark Mode Palette Setting
		$wp_customize->add_setting( 'gravisain_dark_palette', [
			'default'           => wp_json_encode( [
				'#818cf8', // 0: Primary
				'#38bdf8', // 1: Secondary
				'#f8fafc', // 2: Contrast (Text)
				'#cbd5e1', // 3: Contrast Alt (Muted)
				'#0f172a', // 4: Base (Background)
				'#1e293b', // 5: Base Alt (Surface)
				'#334155', // 6: Border
				'#fb7185', // 7: Accent
			] ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new PaletteControl( $wp_customize, 'gravisain_dark_palette', [
			'label'        => __( 'Dark Mode Palette', 'gravisain' ),
			'description'  => __( 'Colors applied when website is viewed in Dark Mode.', 'gravisain' ),
			'section'      => 'gravisain_colors',
			'color_labels' => [
				__( 'Primary', 'gravisain' ),
				__( 'Secondary', 'gravisain' ),
				__( 'Contrast (Text)', 'gravisain' ),
				__( 'Contrast Alt (Muted)', 'gravisain' ),
				__( 'Base (Background)', 'gravisain' ),
				__( 'Base Alt (Surface)', 'gravisain' ),
				__( 'Border', 'gravisain' ),
				__( 'Accent', 'gravisain' ),
			],
			'presets'      => [
				[
					'name'   => __( 'Midnight (Default)', 'gravisain' ),
					'colors' => [ '#818cf8', '#38bdf8', '#f8fafc', '#cbd5e1', '#0f172a', '#1e293b', '#334155', '#fb7185' ],
				],
				[
					'name'   => __( 'Deep Navy', 'gravisain' ),
					'colors' => [ '#6366f1', '#06b6d4', '#ffffff', '#94a3b8', '#030712', '#111827', '#1f2937', '#f43f5e' ],
				],
				[
					'name'   => __( 'Charcoal Dark', 'gravisain' ),
					'colors' => [ '#a855f7', '#38bdf8', '#fafafa', '#a1a1aa', '#18181b', '#27272a', '#3f3f46', '#fb7185' ],
				],
			],
		] ) );

		// Site Background Setting
		$wp_customize->add_setting( 'gravisain_site_background', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_site_background', [
			'label'       => __( 'Site Background', 'gravisain' ),
			'description' => __( 'Leave empty to use Global Palette (Base Alt).', 'gravisain' ),
			'section'     => 'gravisain_colors',
		] ) );

		// Content Background Setting
		$wp_customize->add_setting( 'gravisain_content_background', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );

		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'gravisain_content_background', [
			'label'       => __( 'Content Background', 'gravisain' ),
			'description' => __( 'Leave empty to use Global Palette (Base).', 'gravisain' ),
			'section'     => 'gravisain_colors',
		] ) );
	}
}
