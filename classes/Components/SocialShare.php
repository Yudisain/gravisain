<?php
/**
 * Native Social Share Component
 *
 * Lightweight, zero-tracking social share links with inline SVG icons
 * and native browser clipboard copy support.
 *
 * @package Gravisain\Components
 */

namespace Gravisain\Components;

class SocialShare {

	/**
	 * Check if Social Share buttons should render on the current page.
	 *
	 * @return bool
	 */
	public static function should_render(): bool {
		if ( ! is_single() || 'post' !== get_post_type() ) {
			return false;
		}

		return (bool) get_theme_mod( 'gravisain_single_post_social_share', true );
	}

	/**
	 * Get list of share buttons with their URLs and SVG icons.
	 *
	 * @param int $post_id Post ID.
	 * @return array<string, array{label: string, url: string, icon: string, action?: string}>
	 */
	public static function get_share_links( int $post_id = 0 ): array {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$url   = rawurlencode( get_permalink( $post_id ) );
		$title = rawurlencode( html_entity_decode( get_the_title( $post_id ), ENT_QUOTES, 'UTF-8' ) );

		return [
			'twitter'  => [
				'label' => __( 'Share on X / Twitter', 'gravisain' ),
				'url'   => 'https://twitter.com/intent/tweet?text=' . $title . '&url=' . $url,
				'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
			],
			'facebook' => [
				'label' => __( 'Share on Facebook', 'gravisain' ),
				'url'   => 'https://www.facebook.com/sharer/sharer.php?u=' . $url,
				'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
			],
			'linkedin' => [
				'label' => __( 'Share on LinkedIn', 'gravisain' ),
				'url'   => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $url,
				'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>',
			],
			'whatsapp' => [
				'label' => __( 'Share on WhatsApp', 'gravisain' ),
				'url'   => 'https://api.whatsapp.com/send?text=' . $title . '%20-%20' . $url,
				'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.168-.008-.36-.01-.558-.01-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>',
			],
			'telegram' => [
				'label' => __( 'Share on Telegram', 'gravisain' ),
				'url'   => 'https://t.me/share/url?url=' . $url . '&text=' . $title,
				'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>',
			],
			'copy'     => [
				'label'  => __( 'Copy Link', 'gravisain' ),
				'url'    => '#',
				'action' => 'copy',
				'icon'   => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>',
			],
		];
	}

	/**
	 * Render Social Share component.
	 *
	 * @return void
	 */
	public static function render(): void {
		if ( ! self::should_render() ) {
			return;
		}

		get_template_part( 'template-parts/content/single-share' );
	}
}
