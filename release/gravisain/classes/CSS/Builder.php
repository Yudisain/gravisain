<?php
/**
 * CSS Builder Class
 *
 * @package Gravisain\CSS
 */

namespace Gravisain\CSS;

/**
 * Utility class for constructing minified CSS from arrays.
 */
class Builder {
	/**
	 * Stores the CSS properties.
	 * Format: $css[ $media ][ $selector ][ $property ] = $value;
	 *
	 * @var array
	 */
	private array $css = [];

	/**
	 * Add a CSS rule.
	 *
	 * @param string $selector The CSS selector (e.g., '.site-header').
	 * @param string $property The CSS property (e.g., 'background-color').
	 * @param string $value    The CSS value (e.g., '#000000').
	 * @param string $media    Optional. The media query (e.g., 'all' or 'max-width: 768px').
	 * @return self
	 */
	public function add( string $selector, string $property, string $value, string $media = 'all' ): self {
		if ( empty( $value ) ) {
			return $this;
		}

		// Sanitize selector, property, and value against CSS injection / style tag breakout
		$selector = $this->sanitize_css_string( $selector );
		$property = $this->sanitize_css_string( $property );
		$value    = $this->sanitize_css_string( $value );

		if ( empty( $selector ) || empty( $property ) || empty( $value ) ) {
			return $this;
		}

		if ( ! isset( $this->css[ $media ] ) ) {
			$this->css[ $media ] = [];
		}

		if ( ! isset( $this->css[ $media ][ $selector ] ) ) {
			$this->css[ $media ][ $selector ] = [];
		}

		$this->css[ $media ][ $selector ][ $property ] = $value;

		return $this;
	}

	/**
	 * Compile the stored rules into a minified CSS string.
	 *
	 * @return string
	 */
	public function build(): string {
		if ( empty( $this->css ) ) {
			return '';
		}

		$output = '';

		foreach ( $this->css as $media => $selectors ) {
			$is_media_query = ( 'all' !== $media );
			$media_css      = '';

			foreach ( $selectors as $selector => $properties ) {
				$media_css .= $selector . '{';
				foreach ( $properties as $property => $value ) {
					$media_css .= $property . ':' . $value . ';';
				}
				$media_css .= '}';
			}

			if ( $is_media_query ) {
				$output .= '@media (' . $this->sanitize_css_string( $media ) . '){' . $media_css . '}';
			} else {
				$output .= $media_css;
			}
		}

		return $output;
	}

	/**
	 * Sanitize CSS string to prevent injection attacks and style tag breakouts.
	 *
	 * @param string $string Raw CSS string.
	 * @return string Sanitized CSS string.
	 */
	private function sanitize_css_string( string $string ): string {
		$string = trim( $string );

		// Remove null bytes
		$string = str_replace( "\0", '', $string );

		// Prevent breaking out of <style> tag
		$string = preg_replace( '/<\/?style[^>]*>/i', '', $string );

		// Remove potentially dangerous expression() or javascript: patterns
		$string = preg_replace( '/expression\s*\(/i', '', $string );
		$string = preg_replace( '/javascript\s*:/i', '', $string );

		return $string;
	}
}
