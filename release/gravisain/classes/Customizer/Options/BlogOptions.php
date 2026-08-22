<?php
/**
 * Blog and Single Post Options for Customizer
 *
 * @package Gravisain\Customizer\Options
 */

namespace Gravisain\Customizer\Options;

class BlogOptions {
	public function register( $wp_customize ): void {
		// 1. Blog / Archive Section
		$wp_customize->add_section( 'gravisain_blog_archive_section', [
			'title'       => __( 'Blog / Archive', 'gravisain' ),
			'description' => __( 'Customize archive, category, search, and blog index layouts.', 'gravisain' ),
			'panel'       => 'gravisain_options',
			'priority'    => 35,
		] );

		// Archive Layout (Grid, List, Standard)
		$wp_customize->add_setting( 'gravisain_blog_archive_layout', [
			'default'           => 'grid',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_blog_archive_layout', [
			'type'    => 'select',
			'label'   => __( 'Post Archive Layout', 'gravisain' ),
			'section' => 'gravisain_blog_archive_section',
			'choices' => [
				'grid'     => __( 'Grid Cards', 'gravisain' ),
				'list'     => __( 'List / Row Cards', 'gravisain' ),
				'standard' => __( 'Standard Large Image', 'gravisain' ),
			],
		] );

		// Grid Columns (only relevant if grid is selected)
		$wp_customize->add_setting( 'gravisain_blog_archive_grid_columns', [
			'default'           => 3,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_blog_archive_grid_columns', [
			'type'    => 'select',
			'label'   => __( 'Grid Columns', 'gravisain' ),
			'section' => 'gravisain_blog_archive_section',
			'choices' => [
				2 => __( '2 Columns', 'gravisain' ),
				3 => __( '3 Columns', 'gravisain' ),
			],
		] );

		// Sidebar Position
		$wp_customize->add_setting( 'gravisain_blog_archive_sidebar', [
			'default'           => 'right',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_blog_archive_sidebar', [
			'type'    => 'select',
			'label'   => __( 'Sidebar Position', 'gravisain' ),
			'section' => 'gravisain_blog_archive_section',
			'choices' => [
				'right' => __( 'Right Sidebar', 'gravisain' ),
				'left'  => __( 'Left Sidebar', 'gravisain' ),
				'none'  => __( 'No Sidebar (Full Width)', 'gravisain' ),
			],
		] );

		// Excerpt Word Count
		$wp_customize->add_setting( 'gravisain_blog_archive_excerpt_length', [
			'default'           => 25,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_blog_archive_excerpt_length', [
			'type'        => 'number',
			'label'       => __( 'Excerpt Length (words)', 'gravisain' ),
			'section'     => 'gravisain_blog_archive_section',
			'input_attrs' => [
				'min'  => 5,
				'max'  => 100,
				'step' => 5,
			],
		] );

		// Read More Text
		$wp_customize->add_setting( 'gravisain_blog_archive_read_more', [
			'default'           => __( 'Read More &rarr;', 'gravisain' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_blog_archive_read_more', [
			'type'    => 'text',
			'label'   => __( 'Read More Button Text', 'gravisain' ),
			'section' => 'gravisain_blog_archive_section',
		] );


		// 2. Single Post Section
		$wp_customize->add_section( 'gravisain_single_post_section', [
			'title'       => __( 'Single Post', 'gravisain' ),
			'description' => __( 'Customize individual blog post layout and features.', 'gravisain' ),
			'panel'       => 'gravisain_options',
			'priority'    => 36,
		] );

		// Single Post Sidebar Position
		$wp_customize->add_setting( 'gravisain_single_post_sidebar', [
			'default'           => 'right',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_single_post_sidebar', [
			'type'    => 'select',
			'label'   => __( 'Sidebar Position', 'gravisain' ),
			'section' => 'gravisain_single_post_section',
			'choices' => [
				'right' => __( 'Right Sidebar', 'gravisain' ),
				'left'  => __( 'Left Sidebar', 'gravisain' ),
				'none'  => __( 'No Sidebar (Narrow Focused Width)', 'gravisain' ),
			],
		] );

		// Show Author Box
		$wp_customize->add_setting( 'gravisain_single_post_author_box', [
			'default'           => true,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_single_post_author_box', [
			'type'    => 'checkbox',
			'label'   => __( 'Show Author Bio Box', 'gravisain' ),
			'section' => 'gravisain_single_post_section',
		] );

		// Show Post Navigation
		$wp_customize->add_setting( 'gravisain_single_post_navigation', [
			'default'           => true,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_single_post_navigation', [
			'type'    => 'checkbox',
			'label'   => __( 'Show Previous / Next Post Navigation', 'gravisain' ),
			'section' => 'gravisain_single_post_section',
		] );

		// Show Native Social Share Buttons
		$wp_customize->add_setting( 'gravisain_single_post_social_share', [
			'default'           => true,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_single_post_social_share', [
			'type'    => 'checkbox',
			'label'   => __( 'Show Native Social Share Buttons (Zero Tracking)', 'gravisain' ),
			'section' => 'gravisain_single_post_section',
		] );

		// Show Related Posts Grid
		$wp_customize->add_setting( 'gravisain_single_post_related_posts', [
			'default'           => true,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_single_post_related_posts', [
			'type'    => 'checkbox',
			'label'   => __( 'Show Related Posts Grid', 'gravisain' ),
			'section' => 'gravisain_single_post_section',
		] );

		// Related Posts Count
		$wp_customize->add_setting( 'gravisain_single_post_related_count', [
			'default'           => 3,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'gravisain_single_post_related_count', [
			'type'    => 'select',
			'label'   => __( 'Number of Related Posts', 'gravisain' ),
			'section' => 'gravisain_single_post_section',
			'choices' => [
				3 => __( '3 Posts (1 Row)', 'gravisain' ),
				6 => __( '6 Posts (2 Rows)', 'gravisain' ),
			],
		] );
	}
}
