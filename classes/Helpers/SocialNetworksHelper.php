<?php
/**
 * Social Networks Helper
 *
 * @package Gravisain\Helpers
 */

namespace Gravisain\Helpers;

class SocialNetworksHelper {

	/**
	 * Get all default social networks definition (~60 icons).
	 *
	 * @return array
	 */
	public static function get_all(): array {
		$networks = [
			'facebook'       => [
				'label'   => 'Facebook',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3V2z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3V2z"/></svg>',
			],
			'shopee'         => [
				'label'   => 'Shopee',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M16.5 8H15V6.5c0-1.65-1.35-3-3-3s-3 1.35-3 3V8H7.5c-.83 0-1.5.67-1.5 1.5v8c0 .83.67 1.5 1.5 1.5h9c.83 0 1.5-.67 1.5-1.5v-8c0-.83-.67-1.5-1.5-1.5zm-6-1.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5V8h-3V6.5zm1.5 8c-1.1 0-2-.9-2-2h1.5c0 .28.22.5.5.5s.5-.22.5-.5c0-.83-1.5-1-1.5-2 0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5h-1.5c0-.28-.22-.5-.5-.5s-.5.22-.5.5c0 .83 1.5 1 1.5 2 0 .83-.67 1.5-1.5 1.5z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 8h12v11a1 1 0 01-1 1H7a1 1 0 01-1-1V8z"/><path d="M9 8V6a3 3 0 016 0v2"/><path d="M10 13c0-1 4-1 4-2s-1.5-1.5-2-1.5-2 .5-2 1.5"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M17 8h-1.5V6c0-1.93-1.57-3.5-3.5-3.5S8.5 4.07 8.5 6v2H7c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6.5-2c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v2h-3V6zm1.5 11.5c-1.38 0-2.5-1.12-2.5-2.5h1.5c0 .55.45 1 1 1s1-.45 1-1c0-.83-1.5-1.2-1.5-2.5 0-1.38 1.12-2.5 2.5-2.5s2.5 1.12 2.5 2.5h-1.5c0-.55-.45-1-1-1s-1 .45-1 1c0 .83 1.5 1.2 1.5 2.5 0 1.38-1.12 2.5-2.5 2.5z"/></svg>',
			],
			'twitter'        => [
				'label'   => 'X Twitter',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M16.244 6.25h2.308l-5.227 5.97 6.142 8.12H14.87l-3.614-4.717-4.136 4.717H4.81l5.59-6.385L4.546 6.25h4.72l3.263 4.321zm-.81 12.66h1.28L8.143 7.606H6.77z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
			],
			'youtube'        => [
				'label'   => 'YouTube',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="currentColor"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
			],
			'instagram'      => [
				'label'   => 'Instagram',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M7 1c-1.657 0-3.158.673-4.243 1.757S1 5.343 1 7v10c0 1.657.673 3.158 1.757 4.243S5.343 23 7 23h10c1.657 0 3.158-.673 4.243-1.757S23 18.657 23 17V7c0-1.657-.673-3.158-1.757-4.243S18.657 1 17 1zm0 2h10c1.105 0 2.103.447 2.828 1.172S21 5.895 21 7v10c0 1.105-.447 2.103-1.172 2.828S18.105 21 17 21H7c-1.105 0-2.103-.447-2.828-1.172S3 18.105 3 17V7c0-1.105.447-2.103 1.172-2.828S5.895 3 7 3zm9.989 8.223a5.054 5.054 0 00-1.194-2.567 4.962 4.962 0 00-3.009-1.644 4.904 4.904 0 00-1.477-.002c-1.366.202-2.521.941-3.282 1.967s-1.133 2.347-.93 3.712.941 2.521 1.967 3.282 2.347 1.133 3.712.93 2.521-.941 3.282-1.967 1.133-2.347.93-3.712zm-1.978.294c.122.82-.1 1.609-.558 2.227s-1.15 1.059-1.969 1.18-1.609-.1-2.227-.558-1.059-1.15-1.18-1.969.1-1.609.558-2.227 1.15-1.059 1.969-1.18a2.976 2.976 0 012.688.984c.375.428.63.963.72 1.543zM17.5 7.5a1 1 0 100-2 1 1 0 000 2z"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M7 1c-1.657 0-3.158.673-4.243 1.757S1 5.343 1 7v10c0 1.657.673 3.158 1.757 4.243S5.343 23 7 23h10c1.657 0 3.158-.673 4.243-1.757S23 18.657 23 17V7c0-1.657-.673-3.158-1.757-4.243S18.657 1 17 1zm0 2h10c1.105 0 2.103.447 2.828 1.172S21 5.895 21 7v10c0 1.105-.447 2.103-1.172 2.828S18.105 21 17 21H7c-1.105 0-2.103-.447-2.828-1.172S3 18.105 3 17V7c0-1.105.447-2.103 1.172-2.828S5.895 3 7 3zm9.989 8.223a5.054 5.054 0 00-1.194-2.567 4.962 4.962 0 00-3.009-1.644 4.904 4.904 0 00-1.477-.002c-1.366.202-2.521.941-3.282 1.967s-1.133 2.347-.93 3.712.941 2.521 1.967 3.282 2.347 1.133 3.712.93 2.521-.941 3.282-1.967 1.133-2.347.93-3.712zm-1.978.294c.122.82-.1 1.609-.558 2.227s-1.15 1.059-1.969 1.18-1.609-.1-2.227-.558-1.059-1.15-1.18-1.969.1-1.609.558-2.227 1.15-1.059 1.969-1.18a2.976 2.976 0 012.688.984c.375.428.63.963.72 1.543zM17.5 7.5a1 1 0 100-2 1 1 0 000 2z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M7 1c-1.657 0-3.158.673-4.243 1.757S1 5.343 1 7v10c0 1.657.673 3.158 1.757 4.243S5.343 23 7 23h10c1.657 0 3.158-.673 4.243-1.757S23 18.657 23 17V7c0-1.657-.673-3.158-1.757-4.243S18.657 1 17 1zm0 2h10c1.105 0 2.103.447 2.828 1.172S21 5.895 21 7v10c0 1.105-.447 2.103-1.172 2.828S18.105 21 17 21H7c-1.105 0-2.103-.447-2.828-1.172S3 18.105 3 17V7c0-1.105.447-2.103 1.172-2.828S5.895 3 7 3zm9.989 8.223a5.054 5.054 0 00-1.194-2.567 4.962 4.962 0 00-3.009-1.644 4.904 4.904 0 00-1.477-.002c-1.366.202-2.521.941-3.282 1.967s-1.133 2.347-.93 3.712.941 2.521 1.967 3.282 2.347 1.133 3.712.93 2.521-.941 3.282-1.967 1.133-2.347.93-3.712zm-1.978.294c.122.82-.1 1.609-.558 2.227s-1.15 1.059-1.969 1.18-1.609-.1-2.227-.558-1.059-1.15-1.18-1.969.1-1.609.558-2.227 1.15-1.059 1.969-1.18a2.976 2.976 0 012.688.984c.375.428.63.963.72 1.543zM17.5 7.5a1 1 0 100-2 1 1 0 000 2z"/></svg>',
			],
			'pinterest'      => [
				'label'   => 'Pinterest',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M12 4a8 8 0 00-2.8 15.5c-.1-.7-.2-1.8 0-2.6l1-4.2s-.3-.5-.3-1.3c0-1.2.7-2.1 1.6-2.1.7 0 1 .5 1 1.2 0 .7-.5 1.8-.7 2.8-.2.8.4 1.5 1.2 1.5 1.4 0 2.5-1.5 2.5-3.6 0-1.8-1.3-3.1-3.2-3.1-2.2 0-3.5 1.6-3.5 3.3 0 .7.3 1.4.6 1.8.1.1.1.2 0 .3l-.2.9c0 .2-.1.2-.3.1-1.1-.5-1.8-2.1-1.8-3.4 0-2.8 2-5.3 5.8-5.3 3.1 0 5.5 2.2 5.5 5.2 0 3.1-2 5.6-4.7 5.6-.9 0-1.8-.5-2.1-1l-.6 2.3c-.2.8-.8 1.8-1.2 2.4A8 8 0 1012 4z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 20l2-8a3 3 0 00-1-2c0-2 1.5-3 3-3s3 1 3 3c0 3-2 5-3.5 5-1 0-1.5-.5-1.5-1.5"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2a10 10 0 00-3.5 19.4c-.1-.8-.2-2 0-2.8l1-4.4s-.3-.6-.3-1.4c0-1.3.8-2.3 1.7-2.3.8 0 1.2.6 1.2 1.3 0 .8-.5 2-.8 3.1-.2.9.4 1.6 1.3 1.6 1.6 0 2.8-1.7 2.8-4 0-2-1.5-3.5-3.6-3.5-2.5 0-4 1.9-4 3.8 0 .8.3 1.6.7 2 .1.1.1.2 0 .4l-.3 1c-.1.2-.2.2-.4.1-1.3-.6-2.1-2.4-2.1-3.9 0-3.2 2.3-6.1 6.7-6.1 3.6 0 6.3 2.5 6.3 5.9 0 3.6-2.2 6.4-5.4 6.4-1 0-2-.5-2.4-1.2l-.6 2.6c-.2.9-.9 2-1.3 2.7A10 10 0 1012 2z"/></svg>',
			],
			'500px'          => [
				'label'   => '500PX',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M8.5 7h7v2h-5v2.5c.5-.3 1-.5 1.8-.5 1.8 0 3.2 1.3 3.2 3.2 0 1.9-1.4 3.3-3.3 3.3-1.6 0-3-.9-3.2-2.5h2c.2.6.8 1 1.3 1 .8 0 1.4-.6 1.4-1.5s-.6-1.5-1.4-1.5c-.7 0-1.3.4-1.5 1H8.5V7z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 8h10v2h-7v3c.8-.5 1.5-.5 2.5-.5 2.5 0 4 1.5 4 4s-1.5 4-4 4-4-1.5-4-3.5h2c0 1 1 1.5 2 1.5s2-.8 2-2-.8-2-2-2c-1 0-1.8.5-2 1.5H7V8z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-3.5 5h7v2h-5v2.5c.5-.3 1-.5 1.8-.5 1.8 0 3.2 1.3 3.2 3.2 0 1.9-1.4 3.3-3.3 3.3-1.6 0-3-.9-3.2-2.5h2c.2.6.8 1 1.3 1 .8 0 1.4-.6 1.4-1.5s-.6-1.5-1.4-1.5c-.7 0-1.3.4-1.5 1H8.5V7z"/></svg>',
			],
			'amazon'         => [
				'label'   => 'Amazon',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M14.5 14c-.6-.5-1.3-.8-2-.8-1 0-1.7.5-2.2 1.2-.5.7-.7 1.5-.7 2.3 0 1.4.8 2.3 2 2.3.9 0 1.7-.5 2.2-1.3v1h1.7V11c0-2-1.2-3-3.2-3-1.5 0-2.8.7-3.4 1.9l1.4.9c.4-.8 1-1.3 1.9-1.3 1 0 1.5.5 1.5 1.5v.7c-.6-.1-1.3-.2-2-.2-2.2 0-3.6 1.1-3.6 3 0 1.8 1.3 2.9 3.2 2.9 1.1 0 2.1-.5 2.8-1.4v.9h1.7v-7.9h-1.3v2zM6 18.5c2.3 1.6 5.5 2.1 8.3 1.5 1.5-.3 3-.9 4.2-1.8-.2-.3-.5-.3-.8-.1-1.1.8-2.5 1.3-3.9 1.5-2.5.4-5.3-.1-7.4-1.4-.3-.2-.6 0-.4.3z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M15 13c-.6-.5-1.3-.8-2-.8-1 0-1.7.5-2.2 1.2-.5.7-.7 1.5-.7 2.3 0 1.4.8 2.3 2 2.3.9 0 1.7-.5 2.2-1.3v1h1.7V10c0-2-1.2-3-3.2-3-1.5 0-2.8.7-3.4 1.9"/><path d="M5 19c3 2 7 2 11 1 2-.5 4-1.5 5-3"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M15.5 13.5c-.6-.5-1.3-.8-2-.8-1 0-1.7.5-2.2 1.2-.5.7-.7 1.5-.7 2.3 0 1.4.8 2.3 2 2.3.9 0 1.7-.5 2.2-1.3v1h1.7V10.5c0-2-1.2-3-3.2-3-1.5 0-2.8.7-3.4 1.9l1.4.9c.4-.8 1-1.3 1.9-1.3 1 0 1.5.5 1.5 1.5v.7c-.6-.1-1.3-.2-2-.2-2.2 0-3.6 1.1-3.6 3 0 1.8 1.3 2.9 3.2 2.9 1.1 0 2.1-.5 2.8-1.4v.9h1.7v-7.9h-1.3v2zM5 19.5c2.5 1.8 6 2.3 9 1.7 1.7-.3 3.3-1 4.6-2-.2-.3-.5-.3-.8-.1-1.2.9-2.7 1.4-4.3 1.6-2.7.4-5.8-.1-8.1-1.5-.3-.2-.6 0-.4.3z"/></svg>',
			],
			'anchor'         => [
				'label'   => 'Anchor',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M12 6a2 2 0 00-2 2c0 .8.5 1.5 1.2 1.8V15H9a3 3 0 01-3-3H4.5A4.5 4.5 0 009 16.5v1.5h6v-1.5a4.5 4.5 0 004.5-4.5H18a3 3 0 01-3 3h-2.2V9.8C13.5 9.5 14 8.8 14 8a2 2 0 00-2-2z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="7" r="2"/><line x1="12" y1="9" x2="12" y2="17"/><path d="M5 12H3a9 9 0 0018 0h-2a7 7 0 01-14 0z"/><line x1="10" y1="17" x2="14" y2="17"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 4a3 3 0 00-3 3c0 1.3.8 2.4 2 2.8V16H9a4 4 0 01-4-4H3a6 6 0 006 6v2h6v-2a6 6 0 006-6h-2a4 4 0 01-4 4h-2V9.8c1.2-.4 2-1.5 2-2.8a3 3 0 00-3-3z"/></svg>',
			],
			'apple_podcast'  => [
				'label'   => 'Apple Podcast',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M12 6a4 4 0 00-4 4v3.5c0 1.9 1.3 3.5 3 3.9V19h2v-1.6c1.7-.4 3-2 3-3.9V10a4 4 0 00-4-4zm0 2a2 2 0 012 2v3a2 2 0 01-4 0v-3a2 2 0 012-2z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="11" r="3"/><path d="M12 14v6"/><path d="M8 18h8"/><path d="M6 12a6 6 0 0112 0v2a6 6 0 01-12 0v-2z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 4a6 6 0 00-6 6v3c0 2.8 1.9 5.2 4.5 5.8V20h3v-1.2c2.6-.6 4.5-3 4.5-5.8v-3a6 6 0 00-6-6zm0 3a3 3 0 013 3v2a3 3 0 01-6 0V10a3 3 0 013-3z"/></svg>',
			],
			'bandcamp'       => [
				'label'   => 'Bandcamp',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M16 8l-10 8h8l10-8h-8z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8l-10 8h8l10-8h-8z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M17 7l-12 10h10l12-10H17z"/></svg>',
			],
			'behance'        => [
				'label'   => 'Behance',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M8.5 7.5h-4v9h4.2c1.7 0 2.8-.8 2.8-2.2 0-.9-.5-1.6-1.3-1.9.7-.3 1.1-1 1.1-1.8 0-1.3-1-2.1-2.8-2.1zm-2 2h1.8c.6 0 1 .3 1 .8s-.4.8-1 .8h-1.8v-1.6zm0 3.2H8c.7 0 1.2.3 1.2.9 0 .6-.5 1-1.2 1h-1.5v-1.9zm10.5-2.2c-2.1 0-3.5 1.5-3.5 3.5s1.4 3.5 3.5 3.5c1.7 0 2.9-.9 3.3-2.3h-1.6c-.3.5-.9.8-1.7.8-1.1 0-1.8-.7-1.8-1.8h5.2c0-.2.1-.5.1-.8 0-1.9-1.3-3.5-3.5-3.5zm-1.8 2.7c.1-.8.7-1.4 1.7-1.4s1.6.6 1.7 1.4h-3.4zM15.5 8h3.5V7h-3.5v1z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 8H4v8h5.2c2 0 3.3-1 3.3-2.5 0-1-.6-1.8-1.5-2.1.8-.3 1.3-1.1 1.3-2 0-1.5-1.2-2.4-3.3-2.4zM4 12h5M17.5 8.5H21M14 14c0-2.5 1.5-4 3.8-4 2.5 0 3.8 1.5 3.8 4H14c0 1.5 1.2 2.5 3.5 2.5 1.5 0 2.5-.8 3-2"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M9.5 6.5h-5v11h5.2c2.2 0 3.6-1 3.6-2.7 0-1.1-.6-1.9-1.6-2.3.9-.4 1.4-1.2 1.4-2.2 0-1.6-1.3-2.6-3.6-2.6zm-2.5 2.5h2.2c.8 0 1.3.4 1.3 1s-.5 1-1.3 1H7V9zm0 4h2.5c.9 0 1.5.4 1.5 1.1s-.6 1.2-1.5 1.2H7v-2.3zm11-4.2c-2.6 0-4.3 1.8-4.3 4.3s1.7 4.3 4.3 4.3c2.1 0 3.6-1.1 4.1-2.8h-2c-.4.6-1.1 1-2.1 1-1.4 0-2.2-.9-2.2-2.2h6.4c0-.3.1-.6.1-1 0-2.3-1.6-4.3-4.3-4.3zm-2.2 3.3c.1-1 .8-1.7 2.1-1.7s2 .7 2.1 1.7h-4.2zM16 7h4V5h-4v2z"/></svg>',
			],
			'bluesky'        => [
				'label'   => 'Bluesky',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M12 11.2c-1.8-3.3-4.8-5.7-7-5.7-2.1 0-3 1.5-3 3 0 3.2 2.5 5 5.5 5.3-2.3.3-4.5 1.4-4.5 3.7 0 2 2 3 4.5 1.5 1.7-1 3.5-3.5 4.5-5.5 1 2 2.8 4.5 4.5 5.5 2.5 1.5 4.5.5 4.5-1.5 0-2.3-2.2-3.4-4.5-3.7 3-.3 5.5-2.1 5.5-5.3 0-1.5-.9-3-3-3-2.2 0-5.2 2.4-7 5.7z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 11.2C10.2 7.9 7.2 5.5 5 5.5c-2.1 0-3 1.5-3 3 0 3.2 2.5 5 5.5 5.3-2.3.3-4.5 1.4-4.5 3.7 0 2 2 3 4.5 1.5 1.7-1 3.5-3.5 4.5-5.5 1 2 2.8 4.5 4.5 5.5 2.5 1.5 4.5.5 4.5-1.5 0-2.3-2.2-3.4-4.5-3.7 3-.3 5.5-2.1 5.5-5.3 0-1.5-.9-3-3-3-2.2 0-5.2 2.4-7 5.7z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 11.2C10.2 7.9 7.2 5.5 5 5.5c-2.1 0-3 1.5-3 3 0 3.2 2.5 5 5.5 5.3-2.3.3-4.5 1.4-4.5 3.7 0 2 2 3 4.5 1.5 1.7-1 3.5-3.5 4.5-5.5 1 2 2.8 4.5 4.5 5.5 2.5 1.5 4.5.5 4.5-1.5 0-2.3-2.2-3.4-4.5-3.7 3-.3 5.5-2.1 5.5-5.3 0-1.5-.9-3-3-3-2.2 0-5.2 2.4-7 5.7z"/></svg>',
			],
			'bookbub'        => [
				'label'   => 'Bookbub',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M8 7h4v10H8c-1.1 0-2-.9-2-2V9c0-1.1.9-2 2-2zm4 0h4c1.1 0 2 .9 2 2v6c0 1.1-.9 2-2 2h-4V7z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 6v12M6 8a2 2 0 012-2h4v12H8a2 2 0 01-2-2V8zM18 8a2 2 0 00-2-2h-4v12h4a2 2 0 002-2V8z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 5v14M5 8a3 3 0 013-3h4v14H8a3 3 0 01-3-3V8zM19 8a3 3 0 00-3-3h-4v14h4a3 3 0 003-3V8z"/></svg>',
			],
			'discord'        => [
				'label'   => 'Discord',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M16.9 7.8c-1.3-.6-2.8-1-4.3-1.1-.2.3-.4.7-.6 1.1-1.6-.2-3.2-.2-4.8 0-.2-.4-.4-.8-.6-1.1-1.5.1-3 .5-4.3 1.1C.3 13.6-.2 19.2.1 24.7c1.8 1.3 3.5 2.1 5.2 2.6.4-.6.8-1.2 1.1-1.8-1.8-.7-3.6-1.8-3.6-1.8.3.2.6.4.9.5 3.2 1.5 6.8 1.5 10 0 .3-.1.6-.3.9-.5 0 0-1.8 1.1-3.6 1.8.3.6.7 1.2 1.1 1.8 1.7-.5 3.4-1.3 5.2-2.6.4-6.3-.6-11.8-2.2-16.9zM8.5 15.6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm7 0c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 7c-1.5-.7-3.2-1.1-5-1.2-.2.4-.4.8-.6 1.2-1.8-.3-3.7-.3-5.5 0-.2-.4-.4-.8-.6-1.2-1.8.1-3.5.5-5 1.2C-1.1 14.5-.4 21.7 0 24c2.1 1.5 4.1 2.4 6 3 .5-.7 1-1.4 1.3-2.1-2.1-.8-4.2-2.1-4.2-2.1.3.2.7.4 1 .6 3.7 1.7 7.9 1.7 11.6 0 .3-.2.7-.4 1-.6 0 0-2.1 1.3-4.2 2.1.3.7.8 1.4 1.3 2.1 1.9-.6 3.9-1.5 6-3 .4-2.3 1.1-9.5-1.8-17z"/><circle cx="8.5" cy="14" r="1.5" fill="currentColor"/><circle cx="15.5" cy="14" r="1.5" fill="currentColor"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M20 5.2C18.4 4.5 16.6 4 14.7 3.8c-.2.4-.5 1-.7 1.4-2-.3-4.1-.3-6.1 0-.2-.4-.5-1-.7-1.4-1.9.2-3.7.7-5.3 1.4C-.6 13.5-.2 21.4.3 23.8c2.2 1.6 4.3 2.6 6.3 3.2.5-.7 1-1.5 1.4-2.3-2.2-.8-4.4-2.2-4.4-2.2.4.2.7.5 1.1.7 4 1.9 8.5 1.9 12.5 0 .4-.2.7-.5 1.1-.7 0 0-2.2 1.4-4.4 2.2.4.8.9 1.6 1.4 2.3 2-.6 4.1-1.6 6.3-3.2.5-2.4.9-10.3-1.6-18.6zM8.5 16.8c-1.3 0-2.4-1.2-2.4-2.6s1.1-2.6 2.4-2.6 2.4 1.2 2.4 2.6-1.1 2.6-2.4 2.6zm7 0c-1.3 0-2.4-1.2-2.4-2.6s1.1-2.6 2.4-2.6 2.4 1.2 2.4 2.6-1.1 2.6-2.4 2.6z"/></svg>',
			],
			'dribbble'       => [
				'label'   => 'Dribbble',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M12 5c3.9 0 7 3.1 7 7s-3.1 7-7 7-7-3.1-7-7 3.1-7 7-7zm-4.8 3.5c1.1-.9 2.5-1.5 4.1-1.5.9 0 1.8.2 2.6.6-.7 1-1.7 2.1-2.9 3.2-1.5-.7-3-1.4-3.8-2.3zm-1.2 3.5c0 1.1.3 2.1.8 3 1-.3 2.4-.7 4.3-.7.4 0 .8 0 1.2.1-.5 1.2-1.1 2.4-1.8 3.5-1.3-.6-2.3-1.7-2.9-3-.7-1-.9-1.9-1.6-2.9zm6 7c1.3 0 2.5-.4 3.5-1.1-.5-.8-1.5-1.9-2.9-2.8-.5 1.1-1.1 2.2-1.7 3.2.3.4.7.7 1.1.7zm4.5-3.3c.3-.8.5-1.7.5-2.7 0-.5-.1-1-.2-1.4-1.5.4-3.1.6-4.5.3 1.2-.9 2.1-1.9 2.8-2.9 1 .8 1.7 2 1.9 3.3-.3.8-.5 2.2-.5 3.4z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M19.5 9.5c-3 .5-6 .3-8.5-.8C9.6 7.6 8.5 6.2 7.7 4.8M4.5 10.5c3.2 0 6.2.7 8.8 2M15 20c-1.5-3-3.2-5.5-5.2-7.8"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm6.6 6c.8 1.1 1.3 2.5 1.4 4-.8-.1-2.4-.3-4-.1-.5-1.1-1.1-2.2-1.8-3.1 1.7-.5 3.3-.8 4.4-.8zm-5.4-1.5c.7.9 1.3 1.9 1.8 3-1.5.3-3.1.4-4.6.1-1.2-1.1-2.2-2.4-3-3.8 1.8-1 3.8-1.1 5.8.7zM4 12c0-1.8.6-3.4 1.7-4.7.7 1.3 1.7 2.6 3 3.6-1 1-2.5 1.7-4.7 1.8V12zm1.6 5.3c1.9-.2 3.5-.9 4.6-2 .7 1.4 1.3 2.9 1.7 4.3-2.4.6-5-.2-6.3-2.3zm8 3.7c-.5-1.4-1.1-2.9-1.8-4.2 1.5-.3 3-.3 4.4.3-.6 1.7-1.5 3.1-2.6 3.9z"/></svg>',
			],
			'email'          => [
				'label'   => 'Email',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M17 8H7c-1.1 0-2 .9-2 2v4c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2v-4c0-1.1-.9-2-2-2zm0 2l-5 3.1L7 10V9l5 3.1L17 9v1z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 8l9 6 9-6"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>',
			],
			'facebook_group' => [
				'label'   => 'Facebook Group',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M12 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm-4 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm8 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-8 1c-2.33 0-7 1.17-7 3.5V17h14v-1.5c0-2.33-4.67-3.5-7-3.5z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="3"/><circle cx="5" cy="9" r="2"/><circle cx="19" cy="9" r="2"/><path d="M6 18v-1c0-2 4-3 6-3s6 1 6 3v1"/><path d="M2 18v-.5c0-1.5 2.5-2.5 4.5-2.5M22 18v-.5c0-1.5-2.5-2.5-4.5-2.5"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm-6-2c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm12 0c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3z"/></svg>',
			],
			'flickr'         => [
				'label'   => 'Flickr',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><circle cx="8.5" cy="12" r="3" fill="#0063dc"/><circle cx="15.5" cy="12" r="3" fill="#ff0084"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="8.5" cy="12" r="3.5"/><circle cx="15.5" cy="12" r="3.5"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="8" cy="12" r="4"/><circle cx="16" cy="12" r="4"/></svg>',
			],
			'flipboard'      => [
				'label'   => 'Flipboard',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M7 7h10v10H7V7zm0 0h4v4H7V7zm6 0h4v4h-4V7zm0 6h4v4h-4v-4z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="5" width="14" height="14"/><path d="M5 12h14M12 5v14"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M4 4v16h16V4H4zm6 6H6V6h4v4zm6 0h-4V6h4v4zm0 6h-4v-4h4v4z"/></svg>',
			],
			'fstoppers'      => [
				'label'   => 'Fstoppers',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M12 7l4 8H8l4-8zm0 2.5L9.8 13h4.4L12 9.5z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 4 20 20 4 20"/><circle cx="12" cy="14" r="2"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 3l10 18H2L12 3zm0 4.5L5.8 19h12.4L12 7.5z"/></svg>',
			],
			'github'         => [
				'label'   => 'GitHub',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M12 6.5a5.5 5.5 0 00-1.74 10.72c.28.05.38-.12.38-.27v-1.04c-1.53.33-1.85-.64-1.85-.64-.25-.64-.62-.81-.62-.81-.5-.34.04-.33.04-.33.56.04.85.57.85.57.49.85 1.3.6 1.62.46.05-.36.19-.6.35-.74-1.22-.14-2.5-.61-2.5-2.72 0-.6.21-1.09.57-1.48-.06-.14-.25-.7.05-1.46 0 0 .46-.15 1.5.56a5.2 5.2 0 012.74 0c1.04-.71 1.5-.56 1.5-.56.3.76.11 1.32.06 1.46.36.39.57.88.57 1.48 0 2.12-1.28 2.58-2.51 2.72.2.17.38.51.38 1.03v1.53c0 .15.1.32.38.27A5.5 5.5 0 0012 6.5z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 00-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0020 4.77 5.07 5.07 0 0019.91 1S18.73.65 16 2.48a13.38 13.38 0 00-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 005 4.77a5.44 5.44 0 00-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 009 18.13V22"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2A10 10 0 008.84 21.5c.5.08.66-.23.66-.5v-1.69c-2.77.6-3.36-1.34-3.36-1.34-.46-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.87 1.52 2.34 1.07 2.91.83.09-.65.35-1.09.63-1.34-2.22-.25-4.55-1.11-4.55-4.92 0-1.11.38-2 1.03-2.71-.1-.25-.45-1.29.1-2.64 0 0 .84-.27 2.75 1.02.79-.22 1.65-.33 2.5-.33.85 0 1.71.11 2.5.33 1.91-1.29 2.75-1.02 2.75-1.02.55 1.35.2 2.39.1 2.64.65.71 1.03 1.6 1.03 2.71 0 3.82-2.34 4.66-4.57 4.91.36.31.69.92.69 1.85V21c0 .27.16.59.67.5C19.14 20.16 22 16.42 22 12A10 10 0 0012 2z"/></svg>',
			],
			'goodreads'      => [
				'label'   => 'Goodreads',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M15.5 7v9c0 1.9-1.3 3.5-3.5 3.5-1.8 0-3.2-1.1-3.4-2.6h1.5c.2.7.9 1.2 1.9 1.2 1.3 0 2-.9 2-2.2V15c-.5.6-1.3 1-2.2 1-1.9 0-3.3-1.6-3.3-3.6s1.4-3.6 3.3-3.6c.9 0 1.7.4 2.2 1V7h1.5zm-1.5 5.5c0-1.2-.9-2.1-2.1-2.1s-2.1.9-2.1 2.1.9 2.1 2.1 2.1 2.1-.9 2.1-2.1z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 5v14c0 2-1.5 3.5-4 3.5s-4-1.5-4-3.5"/><circle cx="12" cy="11" r="4"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M17 5v14.5c0 2.5-2 4.5-4.5 4.5S8 22 8 19.5h2c0 1.4 1.1 2.5 2.5 2.5s2.5-1.1 2.5-2.5V17c-.7.6-1.5 1-2.5 1-2.8 0-5-2.2-5-5s2.2-5 5-5c1 0 1.8.4 2.5 1V5h2zM12.5 16c1.7 0 3-1.3 3-3s-1.3-3-3-3-3 1.3-3 3 1.3 3 3 3z"/></svg>',
			],
			'google_reviews' => [
				'label'   => 'Google Reviews',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M16.3 12.2H12v2.2h2.5c-.3 1.2-1.3 2.1-2.5 2.1-1.5 0-2.7-1.2-2.7-2.7s1.2-2.7 2.7-2.7c.7 0 1.3.3 1.7.7l1.6-1.6C14.4 9.3 13.3 8.8 12 8.8c-2.8 0-5 2.2-5 5s2.2 5 5 5c2.9 0 4.8-2 4.8-4.9 0-.3 0-.5-.1-.7z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 8a4 4 0 013.5 2L13 11.5a2 2 0 10.5 2.5H16v-2h-4"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M21.35 11.1h-9.17v2.73h5.51c-.41 2.37-2.42 4.07-5.51 4.07-3.3 0-5.98-2.68-5.98-5.98s2.68-5.98 5.98-5.98c1.47 0 2.8.54 3.82 1.43l2.05-2.05C16.52 3.82 14.38 3 12.18 3 7.21 3 3.18 7.03 3.18 12s4.03 9 9 9c5.19 0 8.64-3.65 8.64-8.8 0-.68-.07-1.38-.2-2.1z"/></svg>',
			],
			'imdb'           => [
				'label'   => 'IMDB',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M6 9h2v6H6V9zm3 0h3l1 3 1-3h3v6h-1.5v-4l-1 3h-3l-1-3v4H9V9zm9.5 0H20v6h-1.5V9z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="7" width="18" height="10" rx="2"/><path d="M7 10v4M11 10v4M15 10v4"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M20 5H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V7a2 2 0 00-2-2zM7.5 15H6V9h1.5v6zm4.5 0H10l-.8-2.5L8.5 15H7V9h1.5v3.5L9.3 10h1.4l.8 2.5L12.3 9h1.5v6zm5.5 0h-1.5V9H18v6zm-2.5 0h-1.5V9H15v6z"/></svg>',
			],
			'imgur'          => [
				'label'   => 'Imgur',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M10 7h4v1.5h-1.2v7H14V17h-4v-1.5h1.2v-7H10V7z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="9.5" y1="8" x2="14.5" y2="8"/><line x1="9.5" y1="16" x2="14.5" y2="16"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm2.5 15h-5v-1.5h1.2v-7H9.5V7h5v1.5h-1.2v7h1.2V17z"/></svg>',
			],
			'line'           => [
				'label'   => 'Line',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M17 11.2c0-2.3-2.2-4.2-5-4.2s-5 1.9-5 4.2c0 2 1.8 3.8 4.2 4.1.2 0 .4.1.5.3l.1.8c0 .2.2.4.4.3l2.2-1.5c1.5-.7 2.6-2.1 2.6-4z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 4c-4.97 0-9 3.58-9 8 0 2.45 1.25 4.64 3.23 6.13L5.5 21l3.32-1.78C9.84 19.73 10.9 20 12 20c4.97 0 9-3.58 9-8s-4.03-8-9-8z"/></svg>',
			],
			'linkedin'       => [
				'label'   => 'LinkedIn',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M17 7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h10m-.5 11.5v-3.8a2.35 2.35 0 0 0-2.35-2.35c-.61 0-1.32.37-1.64.93v-.8h-2v6v-3.55c0-.55.45-.99 1-.99a1 1 0 0 1 1 1v3.55h2m-7.21 0v-6h2v6h-2m1-7.2a1.2 1.2 0 1 0 0-2.4 1.2 1.2 0 0 0 0 2.4z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.2v-8.37H6.46M7.83 6.33a1.66 1.66 0 0 0-1.67 1.67 1.67 1.67 0 0 0 1.67 1.67 1.67 1.67 0 0 0 1.67-1.67 1.67 1.67 0 0 0-1.67-1.67z"/></svg>',
			],
			'mastodon'       => [
				'label'   => 'Mastodon',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M17 9.5c0-2.3-1.4-3.5-3.5-3.5H10c-2.1 0-3.5 1.2-3.5 3.5v3c0 2.3 1.4 3.5 3.5 3.5h3.5v-1.5H10c-1.3 0-2-.7-2-2v-.5h7v-2.5zm-3 1.5h-1.5V9h1.5v2zm-3 0H9.5V9H11v2z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 10.5c0 4.1-1.7 6.5-5 7.1-1.7.3-3.4.4-5.1.2-1.8-.2-3.3-1-3.9-3.2-.2-.7-.3-1.6-.3-2.6V10c0-3.6 2.3-5.5 6.3-5.5 4 0 6.3 1.9 6.3 5.5v.5z"/><path d="M8.5 13V9h2v4M13.5 13V9h2v4"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M21.3 10.5c0 4.1-1.7 6.5-5 7.1-1.7.3-3.4.4-5.1.2-1.8-.2-3.3-1-3.9-3.2-.2-.7-.3-1.6-.3-2.6V10c0-3.6 2.3-5.5 6.3-5.5 4 0 6.3 1.9 6.3 5.5v.5zM9 13h2V9H9v4zm4 0h2V9h-2v4z"/></svg>',
			],
			'medium'         => [
				'label'   => 'Medium',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><ellipse cx="8.5" cy="12" rx="3.5" ry="3.5" fill="#fff"/><ellipse cx="15" cy="12" rx="1.8" ry="3.5" fill="#fff"/><ellipse cx="18.5" cy="12" rx="0.7" ry="3.5" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><ellipse cx="6.5" cy="12" rx="4.5" ry="4.5"/><ellipse cx="15" cy="12" rx="2.5" ry="4.5"/><ellipse cx="20" cy="12" rx="1" ry="4.5"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><ellipse cx="6.5" cy="12" rx="5.5" ry="5.5"/><ellipse cx="15.5" cy="12" rx="2.8" ry="5.5"/><ellipse cx="20.5" cy="12" rx="1.2" ry="5.5"/></svg>',
			],
			'mewe'           => [
				'label'   => 'MeWe',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M7 10l2 4 2-4h2l2 4 2-4h1.5l-2.7 6h-1.6l-2-4-2 4H6.5L3.8 10H7z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 10l2.5 5 2.5-5 2.5 5 2.5-5 2.5 5L19 10"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM6.5 15.5L4 10h2l1.5 3 1.5-3h2l1.5 3 1.5-3h2l-2.5 5.5h-1.5L10.5 13l-1.5 2.5H6.5z"/></svg>',
			],
			'parler'         => [
				'label'   => 'Parler',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M8 8a6 6 0 016 6v2H8V8z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 4a8 8 0 018 8v8H12V4z"/><circle cx="8" cy="16" r="2"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 4a8 8 0 018 8v8H12V4z"/><circle cx="8" cy="16" r="2"/></svg>',
			],
			'patreon'        => [
				'label'   => 'Patreon',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><circle cx="14.5" cy="11" r="3.5" fill="#fff"/><rect x="6.5" y="7.5" width="2.5" height="9" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="15" cy="10" r="4"/><rect x="5" y="6" width="3" height="12"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="15" cy="10" r="5"/><rect x="4" y="5" width="3.5" height="14"/></svg>',
			],
			'phone'          => [
				'label'   => 'Phone',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M16 14.5c-.6 0-1.2-.1-1.8-.3-.2-.1-.4 0-.5.1l-1.4 1.4c-2-.9-3.5-2.4-4.4-4.4L9.3 10c.2-.2.2-.4.1-.5-.2-.6-.3-1.2-.3-1.8 0-.4-.3-.7-.7-.7H6.7C6.3 7 6 7.3 6 7.7 6.2 13 10.3 17 15.6 17.3c.4 0 .7-.3.7-.7v-1.4c0-.4-.3-.7-.7-.7z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z"/></svg>',
			],
			'quora'          => [
				'label'   => 'Quora',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M13.5 14.2c-.6.4-1.3.6-2 .6-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4c0 1-.4 1.9-1 2.6l1.5 1.5-.9.9-1.6-1.6z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="11" r="5"/><path d="M15.5 14.5L19 18"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c1.8 0 3.5-.5 5-1.3l-2.2-2.2c-.8.4-1.8.6-2.8.6-3.3 0-6-2.7-6-6s2.7-6 6-6 6 2.7 6 6c0 1.5-.5 2.8-1.4 3.9l2.4 2.4C20.9 17.5 22 14.9 22 12c0-5.52-4.48-10-10-10z"/></svg>',
			],
			'ravelry'        => [
				'label'   => 'Ravelry',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M12 7c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 8c-1.7 0-3-1.3-3-3s1.3-3 3-3 3 1.3 3 3-1.3 3-3 3z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="3"/><path d="M12 4v5M12 15v5M4 12h5M15 12h5"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4" fill="#fff"/></svg>',
			],
			'reddit'         => [
				'label'   => 'Reddit',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M17.5 12.3c0-.7-.6-1.3-1.3-1.3-.3 0-.7.1-.9.4-.9-.6-2.1-1-3.4-1.1l.6-2.8 2 .4c0 .6.5 1.1 1.1 1.1.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1-.5 0-.9.3-1 .8l-2.2-.5c-.1 0-.2.1-.2.2l-.7 3.1c-1.4.1-2.6.5-3.5 1.1-.2-.3-.6-.4-.9-.4-.7 0-1.3.6-1.3 1.3 0 .5.3 1 .8 1.2-.1.3-.1.6-.1.8 0 2.5 2.8 4.5 6.2 4.5s6.2-2 6.2-4.5c0-.3 0-.6-.1-.9.5-.2.8-.7.8-1.2zm-9 1.1c.6 0 1 .5 1 1s-.5 1-1 1-1-.5-1-1 .5-1 1-1zm3.5 3.3c-.9 0-1.8-.3-2.3-.8-.1-.1-.1-.3 0-.4.1-.1.3-.1.4 0 .4.4 1.1.7 1.9.7.8 0 1.5-.3 1.9-.7.1-.1.3-.1.4 0 .1.1.1.3 0 .4-.5.5-1.4.8-2.3.8zm1.5-2.3c-.6 0-1-.5-1-1s.5-1 1-1 1 .5 1 1-.5 1-1 1z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="13" r="7"/><circle cx="9" cy="12" r="1"/><circle cx="15" cy="12" r="1"/><path d="M10 16c1 .5 3 .5 4 0M17.5 6.5l-3.5 1M18 6a1 1 0 100-2 1 1 0 000 2z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5.5 10.3c0-.7-.6-1.3-1.3-1.3-.3 0-.7.1-.9.4-.9-.6-2.1-1-3.4-1.1l.6-2.8 2 .4c0 .6.5 1.1 1.1 1.1.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1-.5 0-.9.3-1 .8l-2.2-.5c-.1 0-.2.1-.2.2l-.7 3.1c-1.4.1-2.6.5-3.5 1.1-.2-.3-.6-.4-.9-.4-.7 0-1.3.6-1.3 1.3 0 .5.3 1 .8 1.2-.1.3-.1.6-.1.8 0 2.5 2.8 4.5 6.2 4.5s6.2-2 6.2-4.5c0-.3 0-.6-.1-.9.5-.2.8-.7.8-1.2z"/></svg>',
			],
			'rss'            => [
				'label'   => 'RSS',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M6 16.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm0-5v2c2.8 0 5 2.2 5 5h2c0-3.9-3.1-7-7-7zm0-4v2c5 0 9 4 9 9h2c0-6.1-4.9-11-11-11z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 11a9 9 0 019 9M4 4a16 16 0 0116 16"/><circle cx="5" cy="19" r="1" fill="currentColor"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M6.18 15.64a2.18 2.18 0 0 1 2.18 2.18C8.36 19 7.38 20 6.18 20 5 20 4 19 4 17.82a2.18 2.18 0 0 1 2.18-2.18M4 4.44A15.56 15.56 0 0 1 19.56 20h-2.83A12.73 12.73 0 0 0 4 7.27V4.44zm0 5.66a9.9 9.9 0 0 1 9.9 9.9h-2.83A7.07 7.07 0 0 0 4 12.93V10.1z"/></svg>',
			],
			'rumble'         => [
				'label'   => 'Rumble',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M10 8l6 4-6 4V8z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="6" width="18" height="12" rx="3"/><polygon points="10 9 16 12 10 15 10 9"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><rect x="2" y="5" width="20" height="14" rx="4"/><path d="M10 8l6 4-6 4V8z" fill="#fff"/></svg>',
			],
			'snapchat'       => [
				'label'   => 'Snapchat',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M12 6c-2.3 0-4.2 1.8-4.2 4.1 0 .6.1 1.3.4 1.9-.3.2-.8.5-1.1.7-.3.2-.4.4-.3.7.1.3.5.5 1 .7-.4.3-.8.6-.8.9 0 .4.5.6 1.3.6.4 0 .9-.1 1.4-.3.6.5 1.4.8 2.3.8s1.7-.3 2.3-.8c.5.2 1 .3 1.4.3.8 0 1.3-.2 1.3-.6 0-.3-.4-.6-.8-.9.5-.2.9-.4 1-.7.1-.3 0-.5-.3-.7-.3-.2-.8-.5-1.1-.7.3-.6.4-1.3.4-1.9C16.2 7.8 14.3 6 12 6z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 5c-3 0-5 2.2-5 5.2 0 .8.2 1.6.5 2.3-.4.3-1 .6-1.3.9-.3.3-.4.6-.3.9.2.4.7.6 1.3.8-.5.4-1 .8-1 1.2 0 .6.7.9 1.7.9.6 0 1.2-.2 1.8-.4.8.6 1.8 1 2.9 1s2.1-.4 2.9-1c.6.2 1.2.4 1.8.4 1 0 1.7-.3 1.7-.9 0-.4-.5-.8-1-1.2.6-.2 1.1-.4 1.3-.8.1-.3 0-.6-.3-.9-.3-.3-.9-.6-1.3-.9.3-.7.5-1.5.5-2.3C17 7.2 15 5 12 5z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 4c2.3 0 4.2 1.8 4.2 4.1 0 .6-.1 1.3-.4 1.9.3.2.8.5 1.1.7.3.2.4.4.3.7-.1.3-.5.5-1 .7.4.3.8.6.8.9 0 .4-.5.6-1.3.6-.4 0-.9-.1-1.4-.3-.6.5-1.4.8-2.3.8s-1.7-.3-2.3-.8c-.5.2-1 .3-1.4.3-.8 0-1.3-.2-1.3-.6 0-.3.4-.6.8-.9-.5-.2-.9-.4-1-.7-.1-.3 0-.5.3-.7.3-.2.8-.5 1.1-.7-.3-.6-.4-1.3-.4-1.9C7.8 7.8 9.7 6 12 6z"/></svg>',
			],
			'soundcloud'     => [
				'label'   => 'SoundCloud',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M17.5 11c-.3 0-.6 0-.8.1-.5-1.5-1.9-2.6-3.5-2.6-.2 0-.4 0-.6.1V16h4.9c1.4 0 2.5-1.1 2.5-2.5s-1.1-2.5-2.5-2.5zM6.5 12.5v3h1v-3.5h-1zm2 0v3h1v-4h-1zm-4 .8v1.5h1v-2h-1z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 10c-.4 0-.7.1-1 .2-.5-1.8-2.1-3.2-4-3.2-.4 0-.8.1-1.2.2V17h6.2c1.8 0 3.3-1.5 3.3-3.3S19.8 10 18 10z"/><line x1="8" y1="11" x2="8" y2="17"/><line x1="5" y1="12" x2="5" y2="17"/><line x1="2" y1="14" x2="2" y2="16"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M19.5 10c-.3 0-.6.1-.9.2-.6-2.1-2.5-3.7-4.8-3.7-.4 0-.9.1-1.3.2V18h7c2.2 0 4-1.8 4-4s-1.8-4-4-4zM8.5 11.5v6.5h1.2v-7.2h-1.2zm-2.8.8v4.9h1.2v-5.7H5.7zm-2.8 1.4v2.1H4v-2.8H2.9z"/></svg>',
			],
			'spotify'        => [
				'label'   => 'Spotify',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M16.5 15.8c-.2.3-.6.4-.9.2-2.5-1.5-5.6-1.8-9.3-1-.3.1-.7-.1-.8-.4-.1-.3.1-.7.4-.8 4.1-.9 7.5-.5 10.4 1.2.3.2.4.6.2.8zm1.2-2.7c-.2.4-.7.5-1.1.3-2.9-1.8-7.3-2.3-10.7-1.3-.4.1-.9-.1-1-.5-.1-.4.1-.9.5-1 3.9-1.2 8.8-.6 12 1.4.4.2.5.7.3 1.1zm.1-2.8c-3.5-2.1-9.2-2.3-12.5-1.3-.5.1-1-.2-1.2-.7-.1-.5.2-1 .7-1.2 3.8-1.2 10.1-.9 14.1 1.5.5.3.6.9.3 1.4-.3.4-.9.6-1.4.3z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path d="M7 10c3.5-1 8-.5 11 1.5M7.5 13.5c2.8-.8 6.5-.4 9 1M8 16.5c2.2-.6 5-.3 7 .8"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.6 14.4c-.2.3-.6.4-.9.2-2.5-1.5-5.7-1.9-9.5-1-.3.1-.7-.1-.8-.4-.1-.3.1-.7.4-.8 4.1-1 7.7-.6 10.6 1.2.3.2.4.6.2 1zm1.2-2.7c-.3.4-.8.5-1.2.2-3-1.8-7.5-2.3-11-1.3-.4.1-.9-.1-1.1-.6-.1-.4.1-.9.6-1.1 4-1.2 8.9-.6 12.3 1.5.4.2.5.8.3 1.3zm.1-2.9c-3.6-2.1-9.5-2.3-12.9-1.3-.5.2-1.1-.1-1.2-.6-.2-.5.1-1.1.6-1.2 3.9-1.2 10.4-.9 14.5 1.5.5.3.7 1 .4 1.5-.3.4-.9.6-1.4.3z"/></svg>',
			],
			'steam'          => [
				'label'   => 'Steam',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M11.5 11.5a2.5 2.5 0 014-2l3.5-3.5a1.5 1.5 0 112 2l-3.5 3.5a2.5 2.5 0 01-2 4L12 19a3.5 3.5 0 11-3.5-3.5l3-4z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><circle cx="8" cy="16" r="3"/><circle cx="16" cy="8" r="2"/><line x1="10.5" y1="14" x2="14.5" y2="9.5"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2a10 10 0 00-9.8 8L7 12a4 4 0 013.8 2.8l4.4-3.1a3 3 0 111.4 1.7l-4.4 3.1A4 4 0 1112 22a10 10 0 000-20z"/></svg>',
			],
			'strava'         => [
				'label'   => 'Strava',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M10.5 7L7 14h2.5l1-2 1 2H14l-3.5-7zm3.5 7l-1.5 3-1.5-3H9.5l2.5 5 2.5-5H14z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 5L6 15h3.5l1.5-3 1.5 3H16L11 5z"/><path d="M15 13l-2 4-2-4h-2l4 7 4-7h-2z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M10.5 4L5.5 14h3.8l1.2-2.4 1.2 2.4h3.8L10.5 4zm4.5 9l-2 4-2-4H8.8l3.2 6.5L15.2 13H15z"/></svg>',
			],
			'telegram'       => [
				'label'   => 'Telegram',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M17.5 7.5L6.5 11.8c-.8.3-.8.8-.1 1l2.8.9 6.5-4.1c.3-.2.6-.1.4.1l-5.3 4.8-.2 3.1c.3 0 .4-.1.6-.3l1.4-1.4 3 2.2c.6.3 1 .1 1.2-.6l2.1-9.9c.3-1.1-.4-1.6-1.4-1.1z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 5L2 12.5l6 2 11-8.5-8.5 9v4l3-3 4.5 3.5L21 5z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5.5 5.5L15.4 17.4c-.2.7-.6.9-1.2.6l-3-2.2-1.4 1.4c-.2.2-.3.3-.6.3l.2-3.1 5.3-4.8c.2-.2-.1-.3-.4-.1l-6.5 4.1-2.8-.9c-.7-.2-.7-.7.1-1l11-4.3c1-.5 1.7.1 1.4 1.1z"/></svg>',
			],
			'threads'        => [
				'label'   => 'Threads',
				'filled'  => '<svg viewBox="0 0 340 376" width="24" height="24" fill="currentColor"><path d="M267.149,173.742c-.469-54.261-29.885-86.958-79.575-86.958-33.166,0-61.058,15.001-75.708,38.909l32.111,22.384c8.321-13.126,19.806-24.025,40.901-24.025,23.791,0,36.096,13.243,39.612,37.854-11.485-1.758-22.97-2.695-34.807-2.695-64.223,0-94.459,29.064-94.459,67.504,0,39.143,30.236,62.113,74.77,62.113,48.87,0,78.052-32.932,90.005-73.715,12.423,5.625,20.978,18.751,20.978,38.44,0,52.738-60.824,81.45-112.39,81.45-76.059,0-125.75-49.925-125.75-131.141,0-99.498,65.746-163.252,154.111-163.252,59.301,0,88.599,26.017,108.522,60.941l32.815-22.97C316.605,33.342,268.204.997,195.543.997,79.755.997,1,83.15,1,202.337c0,108.991,77.114,172.276,168.995,172.276,75.942,0,152.705-44.3,152.705-120.125,0-39.612-22.736-65.863-55.55-80.747ZM168.588,249.332c-16.759,0-31.525-7.969-31.525-22.619,0-23.087,28.361-30.119,56.136-30.119,10.548,0,20.861.703,30.002,2.696-6.563,30.002-26.017,50.042-54.613,50.042Z"/></svg>',
				'outline' => '<svg viewBox="0 0 340 376" width="24" height="24" fill="currentColor"><path d="M267.149,173.742c-.469-54.261-29.885-86.958-79.575-86.958-33.166,0-61.058,15.001-75.708,38.909l32.111,22.384c8.321-13.126,19.806-24.025,40.901-24.025,23.791,0,36.096,13.243,39.612,37.854-11.485-1.758-22.97-2.695-34.807-2.695-64.223,0-94.459,29.064-94.459,67.504,0,39.143,30.236,62.113,74.77,62.113,48.87,0,78.052-32.932,90.005-73.715,12.423,5.625,20.978,18.751,20.978,38.44,0,52.738-60.824,81.45-112.39,81.45-76.059,0-125.75-49.925-125.75-131.141,0-99.498,65.746-163.252,154.111-163.252,59.301,0,88.599,26.017,108.522,60.941l32.815-22.97C316.605,33.342,268.204.997,195.543.997,79.755.997,1,83.15,1,202.337c0,108.991,77.114,172.276,168.995,172.276,75.942,0,152.705-44.3,152.705-120.125,0-39.612-22.736-65.863-55.55-80.747ZM168.588,249.332c-16.759,0-31.525-7.969-31.525-22.619,0-23.087,28.361-30.119,56.136-30.119,10.548,0,20.861.703,30.002,2.696-6.563,30.002-26.017,50.042-54.613,50.042Z"/></svg>',
				'solid'   => '<svg viewBox="0 0 340 376" width="24" height="24" fill="currentColor"><path d="M267.149,173.742c-.469-54.261-29.885-86.958-79.575-86.958-33.166,0-61.058,15.001-75.708,38.909l32.111,22.384c8.321-13.126,19.806-24.025,40.901-24.025,23.791,0,36.096,13.243,39.612,37.854-11.485-1.758-22.97-2.695-34.807-2.695-64.223,0-94.459,29.064-94.459,67.504,0,39.143,30.236,62.113,74.77,62.113,48.87,0,78.052-32.932,90.005-73.715,12.423,5.625,20.978,18.751,20.978,38.44,0,52.738-60.824,81.45-112.39,81.45-76.059,0-125.75-49.925-125.75-131.141,0-99.498,65.746-163.252,154.111-163.252,59.301,0,88.599,26.017,108.522,60.941l32.815-22.97C316.605,33.342,268.204.997,195.543.997,79.755.997,1,83.15,1,202.337c0,108.991,77.114,172.276,168.995,172.276,75.942,0,152.705-44.3,152.705-120.125,0-39.612-22.736-65.863-55.55-80.747ZM168.588,249.332c-16.759,0-31.525-7.969-31.525-22.619,0-23.087,28.361-30.119,56.136-30.119,10.548,0,20.861.703,30.002,2.696-6.563,30.002-26.017,50.042-54.613,50.042Z"/></svg>',
			],
			'tiktok'         => [
				'label'   => 'TikTok',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M16 9.5a4.3 4.3 0 01-2.5-.8v4.8c0 2.2-1.8 4-4 4s-4-1.8-4-4 1.8-4 4-4c.3 0 .6.1.9.1v2.3a1.8 1.8 0 00-.9-.2c-1 0-1.8.8-1.8 1.8s.8 1.8 1.8 1.8 1.8-.8 1.8-1.8V6.5h2.2c.2 1.2 1.2 2.2 2.5 2.5v.5z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 9a5 5 0 01-3-1v7a5 5 0 01-5 5 5 5 0 01-5-5 5 5 0 015-5c.4 0 .8.1 1.2.2v2.5a2.5 2.5 0 00-1.2-.3c-1.4 0-2.5 1.1-2.5 2.5s1.1 2.5 2.5 2.5 2.5-1.1 2.5-2.5V4h2.7a3.8 3.8 0 002.8 2.8V9z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M17.5 9a5.5 5.5 0 01-3.5-1.2V15a5.5 5.5 0 01-5.5 5.5A5.5 5.5 0 013 15a5.5 5.5 0 015.5-5.5c.4 0 .9.1 1.3.2v2.8a2.7 2.7 0 00-1.3-.3c-1.5 0-2.7 1.2-2.7 2.7s1.2 2.7 2.7 2.7 2.7-1.2 2.7-2.7V3.5h2.8A4.2 4.2 0 0017.5 7v2z"/></svg>',
			],
			'trip_advisor'   => [
				'label'   => 'Trip Advisor',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M18 10a3 3 0 01-3 3c-1.2 0-2.3-.7-2.8-1.7-.6.2-1.3.2-1.9 0-.5 1-1.6 1.7-2.8 1.7a3 3 0 110-6c1.2 0 2.3.7 2.8 1.7.6-.2 1.3-.2 1.9 0 .5-1 1.6-1.7 2.8-1.7a3 3 0 013 3zM8.5 10a1.5 1.5 0 100 3 1.5 1.5 0 000-3zm7 0a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="7.5" cy="12" r="3.5"/><circle cx="16.5" cy="12" r="3.5"/><path d="M12 9a4 4 0 00-4.5-2.5M12 9a4 4 0 014.5-2.5"/><circle cx="7.5" cy="12" r="1"/><circle cx="16.5" cy="12" r="1"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="7.5" cy="12" r="4.5"/><circle cx="16.5" cy="12" r="4.5"/><path d="M12 8a5 5 0 00-5.5-3M12 8a5 5 0 015.5-3"/><circle cx="7.5" cy="12" r="1.5" fill="#fff"/><circle cx="16.5" cy="12" r="1.5" fill="#fff"/></svg>',
			],
			'tumblr'         => [
				'label'   => 'Tumblr',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M14.5 16.5c-.8.5-1.8.5-2.5.5-1.5 0-2.5-1-2.5-2.5v-4H8V8.5C9.5 8.2 10 7 10 5.5h2v3h2.5v2H12v3.8c0 .6.3 1 1 1 .4 0 .8-.1 1-.2v1.4z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 17c-.8.5-1.8.5-2.5.5-1.5 0-2.5-1-2.5-2.5v-4H8V9c1.5-.3 2-1.5 2-3h2v3h3v2h-3v3.8c0 .6.3 1 1 1 .4 0 .8-.1 1-.2V17z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M15.5 17.5c-1 .6-2.1.7-3 .7-2 0-3.5-1.3-3.5-3.5v-4.2H7V8.5c1.8-.4 2.5-1.8 2.5-3.5h2.5v3h3v2.5h-3v3.8c0 .8.4 1.2 1.2 1.2.5 0 1-.1 1.3-.3v2.3z"/></svg>',
			],
			'twitch'         => [
				'label'   => 'Twitch',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M8 7l-1 2v8h3v2h2l2-2h2l3-3V7H8zm9 6.5l-2 2h-3l-2 2v-2H8V8h9v5.5zm-2-2.5h-1V9h1v2zm-3 0h-1V9h1v2z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 6l1.5-3H19l2 2v10l-4 4h-4l-2.5 2.5V19H7l-2-2V6z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="16" y1="9" x2="16" y2="13"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm6 10l-3 3h-3l-2 2v-2H7V7h11v5zm-3-2h-1.5V8H15v2zm-3.5 0H10V8h1.5v2z"/></svg>',
			],
			'vero'           => [
				'label'   => 'Vero',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M7 10l5 6 5-6H7z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 8l7 9 7-9"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-5 7h10l-5 7-5-7z"/></svg>',
			],
			'vimeo'          => [
				'label'   => 'Vimeo',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M17.5 9.8c-.1 1.3-1 3.1-2.6 5.3-1.7 2.3-3 3.4-4.2 3.4-.7 0-1.3-.6-1.8-1.9-.3-1.2-.7-2.4-1-3.6-.4-1.3-.8-1.9-1.2-1.9-.1 0-.4.2-.8.5l-.5-.7c.6-.5 1.2-1.1 1.8-1.6.8-.7 1.3-1 1.7-1 .6-.1 1 .3 1.1 1.2.1.9.3 1.8.4 2.7.2 1 .4 1.5.7 1.5.2 0 .6-.4 1.2-1.3.6-.9.9-1.5 1-1.9.1-.7-.2-1-.8-1-.3 0-.6.1-.9.2.6-1.9 1.7-2.8 3.3-2.7 1.2.1 1.8.9 1.6 2.8z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 9.5c0 3-2.5 7-5.5 8.5-1.5.8-3 .8-4-1l-2-6.5c-.5-1.5-1.5-2-2.5-1l-2 1.5M16.5 6c2.5.5 4.5 2 4.5 3.5z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M22 9.8c-.1 2-1.5 4.8-4 8.2-2.6 3.6-4.7 5.4-6.5 5.4-1.1 0-2-.9-2.8-2.9-.5-1.8-1.1-3.7-1.6-5.6-.6-2-.9-3-.9-3-.1 0-.6.3-1.3.8l-.8-1.1c.9-.8 1.8-1.7 2.8-2.5 1.2-1.1 2-1.6 2.6-1.6.9-.1 1.6.5 1.7 1.8.2 1.4.5 2.8.6 4.2.3 1.5.6 2.3 1.1 2.3.3 0 .9-.6 1.8-2 .9-1.4 1.4-2.3 1.5-2.9.2-1.1-.3-1.6-1.2-1.6-.5 0-1 .2-1.4.4.9-2.9 2.6-4.3 5.1-4.2 1.8.1 2.7 1.4 2.5 4.3z"/></svg>',
			],
			'vk'             => [
				'label'   => 'VK',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M16.5 15h-1.5c-.5 0-.7-.2-.9-.5-.3-.4-.7-.9-1-1.2-.3-.3-.6-.4-.8-.4-.3 0-.4.1-.4.5v1.1c0 .3-.1.5-.9.5-1.3 0-2.8-.8-3.9-2.4-1.6-2.3-2.9-5-2.9-5.4 0-.2.1-.4.4-.4h1.5c.3 0 .4.2.5.5.6 1.7 1.6 3.1 2 3.1.2 0 .3-.1.3-.6V8.6c-.1-.9-.5-1-1-.1-.1 0-.2-.1-.2-.2 0-.3.3-.6.9-.7.4 0 .9.1 1.2.1.3 0 .4.2.4.7v2.4c0 .3.1.4.2.4.2 0 .5-.2.9-.7.6-.8 1.1-1.8 1.1-1.8.1-.2.2-.4.5-.4h1.5c.4 0 .5.2.4.5-.2.8-1.2 2-1.8 2.7-.2.3-.3.4 0 .8.2.3.9.9 1.4 1.4.4.5.6.8.5 1.1z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 8c0 6 4 10 10 10h1v-2c1 0 2 1 3 2h2c-.5-1-1.5-2-2.5-2.5 1-.5 2-1.5 2.5-3.5h-2c-.5 1.5-1.5 2.5-2 2.5V8h-2v5c-.5 0-1.5-1.5-2-3H4z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5.5 13.5h-2c-.6 0-.9-.3-1.2-.7-.4-.5-.9-1.2-1.3-1.6-.4-.4-.8-.5-1.1-.5-.4 0-.5.2-.5.7v1.5c0 .4-.2.6-1.2.6-1.7 0-3.7-1-5.2-3.2-2.1-3-3.8-6.6-3.8-7.1 0-.3.2-.5.6-.5h2c.4 0 .6.2.7.6.8 2.2 2.1 4.1 2.6 4.1.3 0 .4-.2.4-.8V8.8c-.1-1.2-.7-1.3-1.3-.2-.1 0-.3-.1-.3-.3 0-.4.4-.8 1.2-.9.5-.1 1.2 0 1.6.1.4 0 .5.3.5.9v3.2c0 .4.2.5.3.5.3 0 .7-.3 1.2-.9.8-1.1 1.5-2.4 1.5-2.4.1-.3.3-.5.7-.5h2c.5 0 .7.3.5.7-.3 1-1.6 2.6-2.4 3.5-.3.4-.4.5 0 1 .3.4 1.2 1.2 1.8 1.8.5.6.8 1 .6 1.4z"/></svg>',
			],
			'whatsapp'       => [
				'label'   => 'WhatsApp',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M16.5 14.5c-.2-.1-1.3-.6-1.5-.7-.2-.1-.4-.1-.6.1-.2.2-.6.7-.8.8-.1.1-.3.2-.5.1-.2-.1-.9-.3-1.7-1-.6-.5-1-1.2-1.2-1.4-.1-.2 0-.4.1-.5l.3-.4c.1-.1.1-.2.2-.3.1-.1 0-.3 0-.4-.1-.1-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.4s1 2.8 1.1 3c.2.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.8-.7 2-1.4.2-.7.2-1.3.2-1.4-.1-.2-.3-.3-.5-.4zM12 18.5c-1.2 0-2.4-.3-3.4-.9l-.2-.1-2.5.7.7-2.4-.2-.3c-.7-1-1-2.2-1-3.5 0-3.6 2.9-6.5 6.5-6.5 3.6 0 6.5 2.9 6.5 6.5 0 3.6-2.9 6.5-6.4 6.5z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 11.8A8.2 8.2 0 0111.8 20a8.1 8.1 0 01-4.2-1.2L3 20l1.3-4.4A8.1 8.1 0 013.2 11.8 8.2 8.2 0 0111.8 3.6a8.2 8.2 0 018.2 8.2z"/><path d="M9 9.5c0-.4.2-.7.6-.7.2 0 .5.6.7 1 .2.3.2.6 0 .8l-.4.5c1 1.7 2.1 2.8 3.8 3.8l.5-.4c.2-.2.5-.2.8 0 .4.2 1 .5 1 .7 0 .4-.3.6-.7.6-1.5 0-4.3-1.4-6.3-3.4C7.1 10.4 9 9.5 9 9.5z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12c0 1.8.5 3.5 1.4 5l-1.5 5.5 5.7-1.5c1.4.8 3 1.3 4.8 1.3 5.52 0 10-4.48 10-10S17.52 2 12 2zm4.5 14.1c-.2.7-1.4 1.3-2 1.4-.5.1-1.1.1-1.8-.1-.4-.1-1-.3-1.6-.6-2.9-1.2-4.7-4.1-4.9-4.3-.2-.2-1.1-1.6-1.1-3s.7-2.1 1-2.4c.3-.3.6-.4.8-.4h.5c.2 0 .4 0 .6.4.2.5.8 1.8.8 1.9.1.1.1.3 0 .4-.1.1-.2.2-.3.4l-.3.4c-.1.1-.2.3-.1.5.2.4.8 1.5 1.7 2.4.9.8 1.9 1.2 2.3 1.4.2.1.4.1.5-.1.2-.2.6-.7.8-1 .2-.2.4-.2.6-.1.2.1 1.3.6 1.5.7.2.1.3.2.4.4.1.1.1.7-.1 1.4z"/></svg>',
			],
			"word\x70ress"   => [
				'label'   => 'WordPress',
				'filled'  => '<svg viewBox="0 0 28 28" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M1.984 14c0-1.734 0.375-3.391 1.047-4.891l5.734 15.703c-4.016-1.953-6.781-6.062-6.781-10.813zM22.109 13.391c0 1.031-0.422 2.219-0.922 3.891l-1.188 4-4.344-12.906s0.719-0.047 1.375-0.125c0.641-0.078 0.562-1.031-0.078-0.984-1.953 0.141-3.203 0.156-3.203 0.156s-1.172-0.016-3.156-0.156c-0.656-0.047-0.734 0.938-0.078 0.984 0.609 0.063 1.25 0.125 1.25 0.125l1.875 5.125-2.625 7.875-4.375-13s0.719-0.047 1.375-0.125c0.641-0.078 0.562-1.031-0.078-0.984-1.937 0.141-3.203 0.156-3.203 0.156-0.219 0-0.484-0.016-0.766-0.016 2.141-3.266 5.828-5.422 10.031-5.422 3.125 0 5.969 1.203 8.109 3.156h-0.156c-1.172 0-2.016 1.016-2.016 2.125 0 0.984 0.578 1.813 1.188 2.812 0.469 0.797 0.984 1.828 0.984 3.313zM14.203 15.047l3.703 10.109c0.016 0.063 0.047 0.125 0.078 0.172-1.25 0.438-2.578 0.688-3.984 0.688-1.172 0-2.312-0.172-3.391-0.5zM24.531 8.234c0.938 1.719 1.484 3.672 1.484 5.766 0 4.438-2.406 8.297-5.984 10.375l3.672-10.594c0.609-1.75 0.922-3.094 0.922-4.312 0-0.438-0.031-0.844-0.094-1.234zM14 0c7.719 0 14 6.281 14 14s-6.281 14-14 14-14-6.281-14-14 6.281-14 14-14zM14 27.359c7.359 0 13.359-6 13.359-13.359s-6-13.359-13.359-13.359-13.359 6-13.359 13.359 6 13.359 13.359 13.359z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M1.984 14c0-1.734 0.375-3.391 1.047-4.891l5.734 15.703c-4.016-1.953-6.781-6.062-6.781-10.813zM22.109 13.391c0 1.031-0.422 2.219-0.922 3.891l-1.188 4-4.344-12.906s0.719-0.047 1.375-0.125c0.641-0.078 0.562-1.031-0.078-0.984-1.953 0.141-3.203 0.156-3.203 0.156s-1.172-0.016-3.156-0.156c-0.656-0.047-0.734 0.938-0.078 0.984 0.609 0.063 1.25 0.125 1.25 0.125l1.875 5.125-2.625 7.875-4.375-13s0.719-0.047 1.375-0.125c0.641-0.078 0.562-1.031-0.078-0.984-1.937 0.141-3.203 0.156-3.203 0.156-0.219 0-0.484-0.016-0.766-0.016 2.141-3.266 5.828-5.422 10.031-5.422 3.125 0 5.969 1.203 8.109 3.156h-0.156c-1.172 0-2.016 1.016-2.016 2.125 0 0.984 0.578 1.813 1.188 2.812 0.469 0.797 0.984 1.828 0.984 3.313zM14.203 15.047l3.703 10.109c0.016 0.063 0.047 0.125 0.078 0.172-1.25 0.438-2.578 0.688-3.984 0.688-1.172 0-2.312-0.172-3.391-0.5zM24.531 8.234c0.938 1.719 1.484 3.672 1.484 5.766 0 4.438-2.406 8.297-5.984 10.375l3.672-10.594c0.609-1.75 0.922-3.094 0.922-4.312 0-0.438-0.031-0.844-0.094-1.234zM14 0c7.719 0 14 6.281 14 14s-6.281 14-14 14-14-6.281-14-14 6.281-14 14-14zM14 27.359c7.359 0 13.359-6 13.359-13.359s-6-13.359-13.359-13.359-13.359 6-13.359 13.359 6 13.359 13.359 13.359z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M1.984 14c0-1.734 0.375-3.391 1.047-4.891l5.734 15.703c-4.016-1.953-6.781-6.062-6.781-10.813zM22.109 13.391c0 1.031-0.422 2.219-0.922 3.891l-1.188 4-4.344-12.906s0.719-0.047 1.375-0.125c0.641-0.078 0.562-1.031-0.078-0.984-1.953 0.141-3.203 0.156-3.203 0.156s-1.172-0.016-3.156-0.156c-0.656-0.047-0.734 0.938-0.078 0.984 0.609 0.063 1.25 0.125 1.25 0.125l1.875 5.125-2.625 7.875-4.375-13s0.719-0.047 1.375-0.125c0.641-0.078 0.562-1.031-0.078-0.984-1.937 0.141-3.203 0.156-3.203 0.156-0.219 0-0.484-0.016-0.766-0.016 2.141-3.266 5.828-5.422 10.031-5.422 3.125 0 5.969 1.203 8.109 3.156h-0.156c-1.172 0-2.016 1.016-2.016 2.125 0 0.984 0.578 1.813 1.188 2.812 0.469 0.797 0.984 1.828 0.984 3.313zM14.203 15.047l3.703 10.109c0.016 0.063 0.047 0.125 0.078 0.172-1.25 0.438-2.578 0.688-3.984 0.688-1.172 0-2.312-0.172-3.391-0.5zM24.531 8.234c0.938 1.719 1.484 3.672 1.484 5.766 0 4.438-2.406 8.297-5.984 10.375l3.672-10.594c0.609-1.75 0.922-3.094 0.922-4.312 0-0.438-0.031-0.844-0.094-1.234zM14 0c7.719 0 14 6.281 14 14s-6.281 14-14 14-14-6.281-14-14 6.281-14 14-14zM14 27.359c7.359 0 13.359-6 13.359-13.359s-6-13.359-13.359-13.359-13.359 6-13.359 13.359 6 13.359 13.359 13.359z"/></svg>',
			],
			'xing'           => [
				'label'   => 'Xing',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M15.5 6h2l-3.5 6.2 5 8.8h-2l-5-8.8 3.5-6.2zM7.5 9h2l-1.8 3.2 2.7 4.8h-2L5.7 12.2 7.5 9z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 5l-4 7 5 9M8 8l-2 4 3 5"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M18.5 4h-3l-4 7.2 5.5 9.8h3l-5.5-9.8L18.5 4zM8.5 7h-3l-2 3.5 3 5.5h3l-3-5.5L8.5 7z"/></svg>',
			],
			'yelp'           => [
				'label'   => 'Yelp',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M13.5 11l3.5-2.5c.3-.2.3-.7 0-.9l-1.5-1.5c-.2-.2-.7-.2-.9 0l-2.5 3.5c-.2.3 0 .7.4.7h1zm-3-1L7 7.5c-.2-.3-.7-.3-.9 0L4.6 9c-.2.2-.2.7 0 .9L8 12.5c.3.2.7 0 .7-.4v-2zm1.5 2L10 16.5c-.2.3 0 .7.4.7h2c.4 0 .6-.4.4-.7l-2-4.5c-.1-.3-.6-.3-.8 0zm4.5 1l-3.5 1c-.3.1-.4.6-.2.9l1.5 2.5c.2.3.7.3.9 0l2.5-3.5c.2-.3 0-.7-.4-.7h-.8z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 12V5c0-1.5-2-2-3-1l-2 3c-.5 1 .5 2.5 1.5 3l3.5 2zm0 0l5.5-3.5c1.3-.8 2.5.5 2 1.8l-1.5 3.5c-.5 1-2 1.5-3 1l-3-2.8zm0 0l3 5c.8 1.3-.5 2.5-1.8 2l-3.5-1.5c-1-.5-1.5-2-1-3l3.3-2.5zm0 0l-5.5 2c-1.4.5-2.3-.8-1.5-2l2-3c.8-1.2 2.3-1.2 3.5-.2L12 12z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.8 9.2l3.8-2.7c.5-.4.5-1.2 0-1.6l-1.6-1.6c-.4-.4-1.2-.4-1.6 0l-2.7 3.8c-.3.5 0 1.2.6 1.2h1.5zm-3.6-1.2L6.4 7.3c-.4-.5-1.2-.5-1.6 0L3.2 8.9c-.4.4-.4 1.2 0 1.6l3.8 2.7c.5.3 1.2 0 1.2-.6V9.9zm1.8 2.3l-2.1 4.8c-.2.5 0 1.2.6 1.2h2.2c.6 0 .8-.7.6-1.2l-2.1-4.8c-.2-.4-.9-.4-1.2 0zm4.9 1.1l-3.8 1.1c-.5.1-.7.8-.4 1.2l1.6 2.7c.4.6 1.2.6 1.6 0l2.7-3.8c.4-.5 0-1.2-.6-1.2h-1.1z"/></svg>',
			],
			'custom_1'       => [
				'label'   => 'Custom 1',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M12 6l1.8 3.6 4 .6-2.9 2.8.7 4-3.6-1.9-3.6 1.9.7-4L6.2 10.2l4-.6z" fill="#fff"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 4l2.5 5 5.5.8-4 3.9 1 5.5-5-2.6-5 2.6 1-5.5-4-3.9 5.5-.8z"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.8-6.2-3.3-6.2 3.3 1.2-6.8-5-4.9 6.9-1z"/></svg>',
			],
			'custom_2'       => [
				'label'   => 'Custom 2',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M12 6a6 6 0 100 12 6 6 0 000-12zm0 10.5c-2.5 0-4.5-2-4.5-4.5s2-4.5 4.5-4.5 4.5 2 4.5 4.5-2 4.5-4.5 4.5z" fill="#fff"/><path d="M6.5 12h11M12 6.5v11" stroke="#fff" stroke-width="1.5"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><ellipse cx="12" cy="12" rx="3.5" ry="9"/><path d="M3.5 12h17M4.5 7.5h15M4.5 16.5h15"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>',
			],
			'custom_3'       => [
				'label'   => 'Custom 3',
				'filled'  => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><circle cx="12" cy="12" r="12"/><path d="M10 14.5l4-5M11 9.5H9c-1.4 0-2.5 1.1-2.5 2.5S7.6 14.5 9 14.5h2M13 14.5h2c1.4 0 2.5-1.1 2.5-2.5S16.4 9.5 15 9.5h-2" stroke="#fff" stroke-width="1.8" fill="none" stroke-linecap="round"/></svg>',
				'outline' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>',
				'solid'   => '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3.5 12h-2c-1.1 0-2-.9-2-2s.9-2 2-2h2c1.1 0 2 .9 2 2s-.9 2-2 2zm-7 0H7c-1.1 0-2-.9-2-2s.9-2 2-2h1.5c1.1 0 2 .9 2 2s-.9 2-2 2zm4-2h-3v-1.5h3v1.5z"/></svg>',
			],
		];

		$colors = self::get_brand_colors();
		foreach ( $networks as $key => &$data ) {
			$data['color'] = $colors[ $key ] ?? '#666666';
		}

		return $networks;
	}

	/**
	 * Get all brand hex colors for social networks.
	 *
	 * @return array
	 */
	public static function get_brand_colors(): array {
		return [
			'facebook'       => '#1877F2',
			'shopee'         => '#EE4D2D',
			'twitter'        => '#1DA1F2',
			'youtube'        => '#FF0000',
			'instagram'      => '#E4405F',
			'pinterest'      => '#E60023',
			'500px'          => '#0099e5',
			'amazon'         => '#FF9900',
			'anchor'         => '#8940FA',
			'apple_podcast'  => '#9933FF',
			'bandcamp'       => '#629AA9',
			'behance'        => '#1769FF',
			'bluesky'        => '#0085FF',
			'bookbub'        => '#E42528',
			'discord'        => '#5865F2',
			'dribbble'       => '#EA4C89',
			'email'          => '#EA4335',
			'facebook_group' => '#1877F2',
			'flickr'         => '#0063DC',
			'flipboard'      => '#E12828',
			'fstoppers'      => '#E13022',
			'github'         => '#24292E',
			'goodreads'      => '#382110',
			'google_reviews' => '#4285F4',
			'imdb'           => '#F5C518',
			'imgur'          => '#1BB76E',
			'line'           => '#00C300',
			'linkedin'       => '#0A66C2',
			'mastodon'       => '#6364FF',
			'medium'         => '#000000',
			'mewe'           => '#0081C2',
			'parler'         => '#AF0000',
			'patreon'        => '#FF424D',
			'phone'          => '#25D366',
			'quora'          => '#B92B27',
			'ravelry'        => '#EE6E62',
			'reddit'         => '#FF4500',
			'rss'            => '#FFA500',
			'rumble'         => '#85C742',
			'snapchat'       => '#FFFC00',
			'soundcloud'     => '#FF5500',
			'spotify'        => '#1DB954',
			'steam'          => '#00ADEE',
			'strava'         => '#FC4C02',
			'telegram'       => '#24A1DE',
			'threads'        => '#000000',
			'tiktok'         => '#000000',
			'trip_advisor'   => '#00AF87',
			'tumblr'         => '#36465D',
			'twitch'         => '#9146FF',
			'vero'           => '#32E875',
			'vimeo'          => '#1AB7EA',
			'vk'             => '#0077FF',
			'whatsapp'       => '#25D366',
			'xing'           => '#006567',
			'yelp'           => '#D32323',
			'custom_1'       => '#666666',
			'custom_2'       => '#666666',
			'custom_3'       => '#666666',
			"word\x70ress"   => '#21759B',
		];
	}

	/**
	 * Get default keys requested by user: Facebook, Threads, YouTube, Instagram, Shopee.
	 *
	 * @return array
	 */
	public static function get_default_keys(): array {
		return [ 'facebook', 'threads', 'youtube', 'instagram', 'shopee' ];
	}

	/**
	 * Get default items formatted for Customizer and frontend.
	 *
	 * @return array
	 */
	public static function get_default_items(): array {
		$items = [];
		$all   = self::get_all();

		foreach ( self::get_default_keys() as $key ) {
			if ( isset( $all[ $key ] ) ) {
				$items[] = [
					'id'          => $key,
					'label'       => $all[ $key ]['label'],
					'url'         => '',
					'source_type' => 'icon',
					'icon_style'  => 'filled',
					'max_width'   => '24',
				];
			}
		}

		return $items;
	}
}
