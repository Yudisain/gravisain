<?php
/**
 * Dynamic CSS Generator Orchestrator
 *
 * @package Gravisain\CSS
 */

declare(strict_types=1);

namespace Gravisain\CSS;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Gravisain\CSS\Builder;
use Gravisain\CSS\CSSFileCache;
use Gravisain\CSS\Generators\GeneralCSS;
use Gravisain\CSS\Generators\HeaderCSS;
use Gravisain\CSS\Generators\FooterCSS;
use Gravisain\CSS\Generators\WooCommerceCSS;

/**
 * DynamicCSS Class
 *
 * Coordinates modular CSS generators and injects dynamic styles.
 */
class DynamicCSS {

	/**
	 * Initialize the Dynamic CSS service.
	 *
	 * @return void
	 */
	public static function init(): void {
		$instance = new self();
		$instance->setup_hooks();
	}

	/**
	 * Setup hooks for injecting dynamic CSS.
	 *
	 * @return void
	 */
	private function setup_hooks(): void {
		add_action( 'wp_enqueue_scripts', [ $this, 'inject_dynamic_css' ], 99 );
		add_action( 'enqueue_block_editor_assets', [ $this, 'inject_editor_dynamic_css' ], 99 );
	}

	/**
	 * Generate and output dynamic CSS to the `<head>` or file cache.
	 *
	 * @return void
	 */
	public function inject_dynamic_css(): void {
		$builder = new Builder();

		$generators = [
			new GeneralCSS(),
			new HeaderCSS(),
			new FooterCSS(),
			new WooCommerceCSS(),
		];

		foreach ( $generators as $generator ) {
			$generator->generate( $builder );
		}

		// Compile the CSS.
		$css = $builder->build();

		if ( empty( $css ) ) {
			return;
		}

		// Enqueue via physical file cache or fallback to inline <style>.
		CSSFileCache::enqueue_or_inject( $css );
	}

	/**
	 * Generate and inject dynamic CSS directly into the Block Editor canvas.
	 *
	 * @return void
	 */
	public function inject_editor_dynamic_css(): void {
		$builder = new Builder();

		$generators = [
			new GeneralCSS(),
			new HeaderCSS(),
			new FooterCSS(),
			new WooCommerceCSS(),
		];

		foreach ( $generators as $generator ) {
			$generator->generate( $builder );
		}

		$css = $builder->build();

		if ( empty( $css ) ) {
			return;
		}

		// Map body/:root selector rules to `.editor-styles-wrapper` when needed so root variables/styles apply inside the editor canvas.
		$editor_css = str_replace( [ ':root', 'body' ], [ '.editor-styles-wrapper', '.editor-styles-wrapper' ], $css );

		$deps = [];
		if ( wp_style_is( 'gravisain-vite-editor-css', 'registered' ) || wp_style_is( 'gravisain-vite-editor-css', 'enqueued' ) ) {
			$deps[] = 'gravisain-vite-editor-css';
		}
		if ( wp_style_is( 'gravisain-editor-canvas', 'registered' ) || wp_style_is( 'gravisain-editor-canvas', 'enqueued' ) ) {
			$deps[] = 'gravisain-editor-canvas';
		}
		wp_register_style( 'gravisain-editor-dynamic-css', false, $deps );
		wp_enqueue_style( 'gravisain-editor-dynamic-css' );
		wp_add_inline_style( 'gravisain-editor-dynamic-css', $editor_css );
	}
}
