<?php
/**
 * SVG Icons Helper
 *
 * @package Gravisain\Helpers
 */

namespace Gravisain\Helpers;

/**
 * SVG Helper Class
 *
 * Returns inline SVG markup for theme icons to avoid dashicons dependency on frontend.
 */
class SVG {

	/**
	 * Get SVG markup for a specific icon.
	 *
	 * @param string $icon Name of the icon.
	 * @param array  $attrs Optional extra HTML attributes (e.g. ['class' => 'my-class']).
	 * @return string SVG HTML markup.
	 */
	public static function icon( string $icon, array $attrs = [] ): string {
		$icons = [
			// User/author icon
			'user' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="gravisain-svg-icon icon-user" style="display: inline-block; vertical-align: text-bottom; margin-right: 4px;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>',
			
			// Calendar/date icon
			'calendar' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="gravisain-svg-icon icon-calendar" style="display: inline-block; vertical-align: text-bottom; margin-right: 4px;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>',
			
			// Tag icon
			'tag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="gravisain-svg-icon icon-tag" style="display: inline-block; vertical-align: text-bottom; margin-right: 4px;"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>',
			
			// Comments icon
			'comments' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="gravisain-svg-icon icon-comments" style="display: inline-block; vertical-align: text-bottom; margin-right: 4px;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>',
			
			// Arrow left
			'arrow-left' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="gravisain-svg-icon icon-arrow-left" style="display: inline-block; vertical-align: middle;"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
			
			// Arrow right
			'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="gravisain-svg-icon icon-arrow-right" style="display: inline-block; vertical-align: middle;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
			
			// Arrow up
			'arrow-up' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="gravisain-svg-icon icon-arrow-up" style="display: inline-block; vertical-align: middle;"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>',
		];

		if ( ! isset( $icons[ $icon ] ) ) {
			return '';
		}

		$svg = $icons[ $icon ];

		if ( ! empty( $attrs ) ) {
			$attr_strings = [];
			// Extract any style attributes if they need to be merged
			$extra_style = isset( $attrs['style'] ) ? trim( $attrs['style'], ';' ) : '';
			unset( $attrs['style'] );

			foreach ( $attrs as $key => $val ) {
				$attr_strings[] = sprintf( '%s="%s"', esc_attr( $key ), esc_attr( $val ) );
			}
			$attr_html = implode( ' ', $attr_strings );

			if ( ! empty( $attr_html ) ) {
				$svg = str_replace( '<svg ', '<svg ' . $attr_html . ' ', $svg );
			}

			if ( ! empty( $extra_style ) ) {
				// Append to existing inline style
				$svg = preg_replace( '/style="([^"]*)"/', 'style="$1; ' . esc_attr( $extra_style ) . ';"', $svg );
			}
		}

		return $svg;
	}
}
