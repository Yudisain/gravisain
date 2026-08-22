<?php
/**
 * Google Fonts Helper
 *
 * Single source of truth for all font data in the Gravisain theme.
 * Reads from a static JSON catalog (assets/data/google-fonts.json) so
 * that the font library can be updated without changing PHP source.
 * Contains NO business logic.
 *
 * @package Gravisain\Helpers
 */

namespace Gravisain\Helpers;

/**
 * GoogleFontsHelper Class
 *
 * Provides utility methods to retrieve Google Fonts data for use in
 * the Customizer, Dynamic CSS, and the Google Fonts loader service.
 * All font data is loaded lazily from the JSON catalog on first access.
 */
class GoogleFontsHelper {

	/**
	 * Path to the static Google Fonts JSON catalog, relative to the theme root.
	 *
	 * @var string
	 */
	private const CATALOG_PATH = '/data/google-fonts.json';

	/**
	 * In-memory cache of the parsed JSON catalog.
	 * Populated on first access via load_catalog().
	 *
	 * Format:
	 * [
	 *   'Inter'  => [ 'category' => 'sans-serif', 'weights' => [100,200,...] ],
	 *   'Roboto' => [ 'category' => 'sans-serif', 'weights' => [100,300,...] ],
	 * ]
	 *
	 * @var array<string, array{category: string, weights?: int[]}>|null
	 */
	private static ?array $catalog = null;

	/**
	 * System font families that do not require loading from Google Fonts.
	 * These are always available in the browser natively.
	 *
	 * Key   = the CSS font-family value stored in the DB.
	 * Value = the human-readable label shown in the UI.
	 *
	 * @var array<string, string>
	 */
	private static array $system_fonts = [
		'inherit'                  => 'Inherit',
		'system-stack'             => 'System Stack',
		'Arial, sans-serif'        => 'Arial',
		'Helvetica, sans-serif'    => 'Helvetica',
		'Times New Roman, serif'   => 'Times New Roman',
		'Courier New, monospace'   => 'Courier New',
		'Verdana, sans-serif'      => 'Verdana',
		'Georgia, serif'           => 'Georgia',
		'Palatino, serif'          => 'Palatino',
		'Garamond, serif'          => 'Garamond',
		'Bookman, serif'           => 'Bookman',
		'Tahoma, sans-serif'       => 'Tahoma',
		'Trebuchet MS, sans-serif' => 'Trebuchet MS',
		'Impact, sans-serif'       => 'Impact',
	];

	// ─────────────────────────────────────────────────────────────────────────
	// CATALOG LOADING
	// ─────────────────────────────────────────────────────────────────────────

	/**
	 * Load and cache the JSON catalog from disk (lazy, runs only once).
	 *
	 * On failure (file missing, malformed JSON), falls back to an empty
	 * array so the rest of the theme continues to work gracefully.
	 *
	 * @return array<string, array{category: string, weights?: int[]}>
	 */
	private static function load_catalog(): array {
		if ( null !== self::$catalog ) {
			return self::$catalog;
		}

		$path = get_template_directory() . self::CATALOG_PATH;

		if ( ! file_exists( $path ) ) {
			self::$catalog = [];
			return self::$catalog;
		}

		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		$json = file_get_contents( $path );

		if ( false === $json || '' === $json ) {
			self::$catalog = [];
			return self::$catalog;
		}

		$decoded = json_decode( $json, true );

		if ( JSON_ERROR_NONE !== json_last_error() || ! is_array( $decoded ) ) {
			self::$catalog = [];
			return self::$catalog;
		}

		// Filter: only keep entries that have 'category' defined — defensive.
		self::$catalog = array_filter(
			$decoded,
			static fn( $entry ) => isset( $entry['category'] )
		);

		return self::$catalog;
	}

	/**
	 * Return only entries from the catalog that are Google Fonts
	 * (i.e., not system fonts).
	 *
	 * @return array<string, array{category: string, weights?: int[]}>
	 */
	private static function get_google_catalog(): array {
		$catalog = self::load_catalog();

		// Exclude system fonts from the Google catalog by checking their category.
		return array_filter(
			$catalog,
			static fn( $entry ) => isset( $entry['category'] ) && 'system' !== $entry['category']
		);
	}

	// ─────────────────────────────────────────────────────────────────────────
	// PUBLIC API
	// ─────────────────────────────────────────────────────────────────────────

	/**
	 * Check whether a given font family name is a Google Font.
	 *
	 * Performs a catalog lookup after normalizing the name.
	 *
	 * @param string $font_family The font family name to check.
	 *
	 * @return bool True if it is a Google Font, false otherwise.
	 */
	public static function is_google_font( string $font_family ): bool {
		if ( empty( $font_family ) ) {
			return false;
		}

		$name    = self::normalize_font_name( $font_family );
		$catalog = self::get_google_catalog();

		return array_key_exists( $name, $catalog );
	}

	/**
	 * Get the available weights for a specific Google Font.
	 * Returns an empty array if the font is not found in the catalog.
	 *
	 * @param string $font_family The font family name.
	 *
	 * @return int[]
	 */
	public static function get_font_weights( string $font_family ): array {
		$name    = self::normalize_font_name( $font_family );
		$catalog = self::get_google_catalog();

		if ( ! isset( $catalog[ $name ]['weights'] ) ) {
			return [];
		}

		return (array) $catalog[ $name ]['weights'];
	}

	/**
	 * Return the full catalog as an array ready to be JSON-encoded and
	 * sent to JavaScript via wp_localize_script().
	 *
	 * Each entry: [ 'category' => string, 'weights' => int[] ]
	 *
	 * @return array<string, array{category: string, weights?: int[]}>
	 */
	public static function get_catalog_for_js(): array {
		return self::load_catalog();
	}

	/**
	 * Get the system fonts list.
	 *
	 * @return array<string, string>
	 */
	public static function get_system_fonts(): array {
		return self::$system_fonts;
	}

	/**
	 * Normalize a font family string by extracting only the primary
	 * font name and stripping any CSS fallback stack.
	 *
	 * Examples:
	 *   "Inter, sans-serif"   → "Inter"
	 *   "'Open Sans', serif"  → "Open Sans"
	 *   "Inter"               → "Inter"
	 *
	 * @param string $font_family The raw font-family string.
	 *
	 * @return string The normalized font name.
	 */
	public static function normalize_font_name( string $font_family ): string {
		if ( empty( $font_family ) ) {
			return '';
		}

		// Take only the first item before any comma.
		$parts = explode( ',', $font_family, 2 );
		$name  = trim( $parts[0] );

		// Strip surrounding single or double quotes.
		$name = trim( $name, "\"'" );

		return $name;
	}
}
