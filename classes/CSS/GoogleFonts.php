<?php
/**
 * Google Fonts Loader
 *
 * Collects all Google Fonts that are actively selected in the Customizer,
 * deduplicates them, and enqueues a single, consolidated Google Fonts URL
 * into the page <head>. This ensures zero redundant HTTP requests and
 * supports optimal Core Web Vitals performance.
 *
 * @package Gravisain\CSS
 */

namespace Gravisain\CSS;

use Gravisain\Helpers\GoogleFontsHelper;

/**
 * GoogleFonts Class
 *
 * Service class responsible for:
 * 1. Collecting active Google Fonts from all Customizer typography settings.
 * 2. Deduplicating and merging required font weights.
 * 3. Enqueueing a single consolidated Google Fonts API URL (v2).
 *
 * Architecture note: This class follows the Conditional Asset Loading principle.
 * If no Google Fonts are active, no external request is made.
 */
class GoogleFonts {

	/**
	 * Registry of Google Fonts to be loaded, keyed by normalized font name.
	 *
	 * Format:
	 * [
	 *   'Inter' => [ 400, 500, 700 ],
	 *   'Poppins' => [ 400, 600 ],
	 * ]
	 *
	 * @var array<string, int[]>
	 */
	private array $queued_fonts = [];

	/**
	 * Singleton instance of the class.
	 *
	 * @var self|null
	 */
	private static ?self $instance = null;

	/**
	 * Private constructor to enforce singleton pattern.
	 */
	private function __construct() {}

	/**
	 * Initialize the Google Fonts service and register hooks.
	 *
	 * @return void
	 */
	public static function init(): void {
		// Instantiate the singleton.
		self::$instance = new self();
		self::$instance->setup_hooks();
	}

	/**
	 * Retrieve the singleton instance (for use by DynamicCSS or other callers).
	 *
	 * @return self
	 */
	public static function get_instance(): self {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Register WordPress action hooks.
	 *
	 * @return void
	 */
	private function setup_hooks(): void {
		/*
		 * Collect active fonts from Customizer settings early, before
		 * wp_enqueue_scripts fires, so that DynamicCSS or other hooks
		 * can also register fonts before the final enqueue.
		 */
		add_action( 'wp_enqueue_scripts', [ $this, 'collect_and_enqueue' ], 5 );

		/*
		 * Also inject fonts in the Customizer preview iframe so that the
		 * live preview reflects font changes in real time.
		 */
		add_action( 'customize_preview_init', [ $this, 'collect_and_enqueue' ] );

		/*
		 * And inject fonts into the Gutenberg Block Editor canvas.
		 */
		add_action( 'enqueue_block_editor_assets', [ $this, 'collect_and_enqueue' ], 5 );
	}

	/**
	 * Queue a Google Font family with a specific weight for loading.
	 *
	 * This is the public API that other classes (e.g., DynamicCSS) use
	 * to register fonts they require. Weights are merged and deduplicated.
	 *
	 * @param string $font_family The Google Font name (e.g., "Inter", "Poppins").
	 * @param int    $weight      The font weight (e.g., 400, 700).
	 *
	 * @return void
	 */
	public function queue_font( string $font_family, int $weight = 400 ): void {
		$name = GoogleFontsHelper::normalize_font_name( $font_family );

		if ( empty( $name ) || ! GoogleFontsHelper::is_google_font( $name ) ) {
			return;
		}

		if ( ! isset( $this->queued_fonts[ $name ] ) ) {
			$this->queued_fonts[ $name ] = [];
		}

		if ( ! in_array( $weight, $this->queued_fonts[ $name ], true ) ) {
			$this->queued_fonts[ $name ][] = $weight;
		}
	}

	/**
	 * Collect all active Google Fonts from Customizer typography settings
	 * and enqueue the consolidated Google Fonts stylesheet.
	 *
	 * Hooked to `wp_enqueue_scripts` at priority 5 so that other hooks
	 * running at the default priority 10 can still read the URL if needed.
	 *
	 * @return void
	 */
	public function collect_and_enqueue(): void {
		$this->collect_from_customizer();
		$this->enqueue();
	}

	/**
	 * Scan all registered typography Customizer settings and queue
	 * any Google Fonts that are currently active.
	 *
	 * @return void
	 */
	private function collect_from_customizer(): void {
		/*
		 * List of all theme_mod keys that store typography settings.
		 * Each entry maps a theme_mod key to its default value.
		 * Add new entries here whenever a new TypographyControl is added
		 * to the Customizer — no other code needs to change.
		 */
		$typography_mods = [
			'gravisain_typography_base'           => '{"family":"Inter","style":"400","size":"16","spacing":"0"}',
			'gravisain_typography_h1'             => '{"family":"Inter","style":"700","size":"40","spacing":"-1"}',
			'gravisain_typography_h2'             => '{"family":"Inter","style":"700","size":"32","spacing":"-0.5"}',
			'gravisain_typography_h3'             => '{"family":"Inter","style":"700","size":"28","spacing":"0"}',
			'gravisain_typography_h4'             => '{"family":"Inter","style":"600","size":"24","spacing":"0"}',
			'gravisain_typography_h5'             => '{"family":"Inter","style":"600","size":"20","spacing":"0"}',
			'gravisain_typography_h6'             => '{"family":"Inter","style":"600","size":"16","spacing":"0"}',
			'gravisain_header_primary_nav_font'   => '{"family":"inherit","style":"normal","size":"16"}',
			'gravisain_header_secondary_nav_font' => '{"family":"inherit","style":"normal","size":"16"}',
			'gravisain_header_button_font'        => '{"family":"inherit","style":"600","size":""}',
		];

		foreach ( $typography_mods as $mod_key => $default ) {
			$value = get_theme_mod( $mod_key, $default );
			$this->process_typography_mod( $value );
		}
	}

	/**
	 * Parse a single typography theme_mod value and queue the font
	 * if it is an active Google Font.
	 *
	 * @param mixed $value The raw value from get_theme_mod().
	 *
	 * @return void
	 */
	private function process_typography_mod( $value ): void {
		if ( empty( $value ) ) {
			return;
		}

		// Decode if it is still a JSON string.
		if ( is_string( $value ) ) {
			$decoded = json_decode( $value, true );

			// Skip on invalid JSON (json_decode returns null on failure).
			if ( JSON_ERROR_NONE !== json_last_error() || ! is_array( $decoded ) ) {
				return;
			}

			$value = $decoded;
		}

		if ( ! is_array( $value ) ) {
			return;
		}

		$family = isset( $value['family'] ) ? (string) $value['family'] : '';
		$style  = isset( $value['style'] ) ? (string) $value['style'] : 'normal';

		// Skip non-Google, inherited, or system fonts.
		if ( empty( $family ) || 'inherit' === $family || 'system-stack' === $family ) {
			return;
		}

		if ( ! GoogleFontsHelper::is_google_font( $family ) ) {
			return;
		}

		// Resolve the weight from the style string (e.g. "700", "700 italic", "normal").
		$weight = $this->resolve_weight_from_style( $style );

		$this->queue_font( $family, $weight );

		// If italic is chosen, also ensure the italic variant is loadable.
		if ( false !== strpos( $style, 'italic' ) ) {
			// We queue both the weight and 400 italic as a minimum.
			$this->queue_font( $family, 400 );
		}
	}

	/**
	 * Derive a numeric font weight from a style string stored in the DB.
	 *
	 * @param string $style The style string (e.g., "normal", "italic", "700", "700 italic").
	 *
	 * @return int The resolved font weight.
	 */
	private function resolve_weight_from_style( string $style ): int {
		if ( empty( $style ) || 'normal' === $style || 'italic' === $style ) {
			return 400;
		}

		preg_match( '/\d+/', $style, $matches );

		if ( ! empty( $matches[0] ) ) {
			$weight = (int) $matches[0];

			// Clamp to the valid CSS font-weight range.
			return max( 100, min( 900, $weight ) );
		}

		if ( 'bold' === $style || 'bold italic' === $style ) {
			return 700;
		}

		return 400;
	}

	/**
	 * Enqueue the consolidated Google Fonts stylesheet.
	 *
	 * Generates a Google Fonts API v2 URL requesting all queued fonts
	 * and their weights in a single HTTP request.
	 *
	 * If no Google Fonts are queued, no external request is made.
	 *
	 * @return void
	 */
	private function enqueue(): void {
		if ( empty( $this->queued_fonts ) ) {
			return;
		}

		$url = $this->build_google_fonts_url( $this->queued_fonts );

		if ( empty( $url ) ) {
			return;
		}

		// Download fonts locally for GDPR compliance and optimal Core Web Vitals.
		$final_url = \Gravisain\CSS\LocalFontDownloader::get_local_url( $url );

		wp_enqueue_style(
			'gravisain-google-fonts',
			$final_url,
			[],
			null // No version: the URL itself acts as the cache key.
		);
	}

	/**
	 * Build a single consolidated Google Fonts API v2 URL.
	 *
	 * Example output for Inter (400, 700) and Poppins (400, 600):
	 * https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;600&display=swap
	 *
	 * @param array<string, int[]> $fonts Associative array of font name => weights[].
	 *
	 * @return string The fully assembled URL, or empty string on failure.
	 */
	private function build_google_fonts_url( array $fonts ): string {
		if ( empty( $fonts ) ) {
			return '';
		}

		$families = [];

		foreach ( $fonts as $name => $weights ) {
			if ( empty( $name ) || empty( $weights ) ) {
				continue;
			}

			// Sort weights ascending for a stable, predictable URL.
			$weights = array_unique( $weights );
			sort( $weights );

			/*
			 * Google Fonts API v2 format:
			 * family=Font+Name:wght@400;700
			 * Spaces in font names are encoded as '+'.
			 */
			$encoded_name = str_replace( ' ', '+', $name );

			if ( 1 === count( $weights ) ) {
				$families[] = $encoded_name . ':wght@' . $weights[0];
			} else {
				$families[] = $encoded_name . ':wght@' . implode( ';', $weights );
			}
		}

		if ( empty( $families ) ) {
			return '';
		}

		/*
		 * Concatenate all family params with '&family=' as separator,
		 * then append display=swap for optimal CLS performance.
		 */
		$query = 'family=' . implode( '&family=', $families ) . '&display=swap';

		return 'https://fonts.googleapis.com/css2?' . $query;
	}

	/**
	 * Retrieve the list of currently queued fonts.
	 *
	 * Useful for debugging or for Customizer preview scripts.
	 *
	 * @return array<string, int[]>
	 */
	public function get_queued_fonts(): array {
		return $this->queued_fonts;
	}
}
