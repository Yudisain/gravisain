<?php
/**
 * Page Settings Meta Box
 *
 * Provides per-page and per-post settings for controlling header, footer, page title, and sidebar layout.
 *
 * @package Gravisain\Meta
 */

namespace Gravisain\Meta;

class PageSettings {

	/**
	 * Nonce action string.
	 */
	const NONCE_ACTION = 'gravisain_page_settings_nonce_action';

	/**
	 * Nonce field name.
	 */
	const NONCE_NAME = 'gravisain_page_settings_nonce';

	/**
	 * Initialize hooks.
	 *
	 * @return void
	 */
	public static function init(): void {
		$instance = new self();
		add_action( 'init', [ $instance, 'register_meta' ] );
		add_action( 'add_meta_boxes', [ $instance, 'add_meta_box' ] );
		add_action( 'save_post', [ $instance, 'save_meta_box' ], 10, 2 );
		add_action( 'enqueue_block_editor_assets', [ $instance, 'enqueue_assets' ] );
		add_filter( 'render_block', [ $instance, 'filter_post_title_block' ], 10, 2 );
		add_filter( 'admin_body_class', [ $instance, 'add_admin_body_class' ] );
		add_filter( 'body_class', [ $instance, 'add_body_classes' ] );
		add_action( 'rest_api_init', [ $instance, 'register_preview_endpoint' ] );
	}

	/**
	 * Register custom REST endpoint for real-time preview meta sync.
	 */
	public function register_preview_endpoint() {
		register_rest_route( 'gravisain/v1', '/preview-meta/(?P<id>\d+)', [
			'methods'             => 'POST',
			'callback'            => [ $this, 'save_preview_meta' ],
			'permission_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
		] );
	}

	/**
	 * Save preview meta sent directly from the React editor to a transient.
	 */
	public function save_preview_meta( \WP_REST_Request $request ) {
		$post_id = (int) $request->get_param( 'id' );
		$meta    = $request->get_param( 'meta' );

		if ( $post_id && ! empty( $meta ) && is_array( $meta ) ) {
			$user_id = get_current_user_id();
			if ( $user_id ) {
				$transient_key = 'gravisain_preview_meta_' . $post_id . '_' . $user_id;
				set_transient( $transient_key, $meta, HOUR_IN_SECONDS );
				return rest_ensure_response( [ 'success' => true ] );
			}
		}
		return rest_ensure_response( [ 'success' => false ] );
	}

	/**
	 * Register the post meta for REST API / Gutenberg.
	 */
	public function register_meta(): void {
		$bool_keys = [
			'_gravisain_hide_title'     => 'boolean',
			'_gravisain_hide_header'    => 'boolean',
			'_gravisain_hide_footer'    => 'boolean',
		];

		foreach ( $bool_keys as $key => $type ) {
			register_post_meta( '', $key, [
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => $type,
				'default'           => false,
				'revisions_enabled' => true,
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			] );
		}

		$string_keys = [
			'_gravisain_sidebar_layout'      => 'default',
			'_gravisain_sidebar_choice'      => 'default',
			'_gravisain_title_mode'          => 'default',
			'_gravisain_transparent_header'  => 'default',
			'_gravisain_content_style'       => 'default',
			'_gravisain_vertical_spacing'    => 'default',
			'_gravisain_show_featured_image' => 'default',
			'_gravisain_body_class'          => '',
		];

		foreach ( $string_keys as $key => $default_val ) {
			register_post_meta( '', $key, [
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => 'string',
				'default'           => $default_val,
				'revisions_enabled' => true,
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			] );
		}
	}



	public function add_meta_box(): void {
		// Only show the classic PHP metabox if the block editor is NOT active.
		// If block editor is active, we use the React PluginSidebar.
		$screen = get_current_screen();
		if ( $screen && $screen->is_block_editor() ) {
			return;
		}

		$screens = [ 'post', 'page' ];
		foreach ( $screens as $screen_name ) {
			add_meta_box(
				'gravisain_page_settings_meta_box',
				__( 'Gravisain Page Settings', 'gravisain' ),
				[ $this, 'render_meta_box' ],
				$screen_name,
				'side',
				'default'
			);
		}
	}

	/**
	 * Render the Meta Box UI.
	 *
	 * @param \WP_Post $post Current post object.
	 */
	public function render_meta_box( $post ): void {
		wp_nonce_field( self::NONCE_ACTION, self::NONCE_NAME );

		$hide_header    = get_post_meta( $post->ID, '_gravisain_hide_header', true );
		$hide_footer    = get_post_meta( $post->ID, '_gravisain_hide_footer', true );
		$hide_title     = get_post_meta( $post->ID, '_gravisain_hide_title', true );
		$title_mode     = get_post_meta( $post->ID, '_gravisain_title_mode', true );
		$sidebar_layout = get_post_meta( $post->ID, '_gravisain_sidebar_layout', true );
		$sidebar_choice = get_post_meta( $post->ID, '_gravisain_sidebar_choice', true );

		if ( empty( $title_mode ) || 'default' === $title_mode ) {
			$title_mode = $hide_title ? 'hide' : 'default';
		}
		if ( empty( $sidebar_layout ) ) {
			$sidebar_layout = 'default';
		}
		if ( empty( $sidebar_choice ) ) {
			$sidebar_choice = 'default';
		}
		?>
		<div class="gravisain-meta-box-options" style="padding: 8px 4px 16px 4px; box-sizing: border-box; width: 100%; max-width: 100%;">
			<div style="margin-bottom: 12px;">
				<label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
					<input type="checkbox" name="gravisain_hide_header" value="1" <?php checked( $hide_header, 1 ); ?> style="margin: 0;" />
					<span><?php esc_html_e( 'Disable Header', 'gravisain' ); ?></span>
				</label>
			</div>
			<div style="margin-bottom: 14px;">
				<label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
					<input type="checkbox" name="gravisain_hide_footer" value="1" <?php checked( $hide_footer, 1 ); ?> style="margin: 0;" />
					<span><?php esc_html_e( 'Disable Footer', 'gravisain' ); ?></span>
				</label>
			</div>
			<div style="margin-bottom: 14px; box-sizing: border-box; width: 100%;">
				<label for="gravisain_title_mode" style="display: block; font-weight: 600; margin-bottom: 6px;"><?php esc_html_e( 'Page Title / Hero Area:', 'gravisain' ); ?></label>
				<select name="gravisain_title_mode" id="gravisain_title_mode" style="box-sizing: border-box; width: 100%; max-width: 100%; height: 36px; padding: 0 8px;">
					<option value="default" <?php selected( $title_mode, 'default' ); ?>><?php esc_html_e( 'Default (Customizer)', 'gravisain' ); ?></option>
					<option value="show" <?php selected( $title_mode, 'show' ); ?>><?php esc_html_e( 'Enable (Show Page Title)', 'gravisain' ); ?></option>
					<option value="hide" <?php selected( $title_mode, 'hide' ); ?>><?php esc_html_e( 'Disable (Hide Page Title)', 'gravisain' ); ?></option>
				</select>
			</div>
			<div style="margin-bottom: 8px; box-sizing: border-box; width: 100%;">
				<label for="gravisain_sidebar_layout" style="display: block; font-weight: 600; margin-bottom: 6px;"><?php esc_html_e( 'Sidebar Layout:', 'gravisain' ); ?></label>
				<select name="gravisain_sidebar_layout" id="gravisain_sidebar_layout" style="box-sizing: border-box; width: 100%; max-width: 100%; height: 36px; padding: 0 8px;">
					<option value="default" <?php selected( $sidebar_layout, 'default' ); ?>><?php esc_html_e( 'Default (Customizer)', 'gravisain' ); ?></option>
					<option value="no-sidebar" <?php selected( $sidebar_layout, 'no-sidebar' ); ?>><?php esc_html_e( 'No Sidebar (Full Width)', 'gravisain' ); ?></option>
					<option value="left-sidebar" <?php selected( $sidebar_layout, 'left-sidebar' ); ?>><?php esc_html_e( 'Left Sidebar', 'gravisain' ); ?></option>
					<option value="right-sidebar" <?php selected( $sidebar_layout, 'right-sidebar' ); ?>><?php esc_html_e( 'Right Sidebar', 'gravisain' ); ?></option>
				</select>
			</div>
			<?php if ( in_array( $sidebar_layout, [ 'left-sidebar', 'right-sidebar', 'default' ], true ) ) : ?>
			<div style="margin-bottom: 12px; box-sizing: border-box; width: 100%;">
				<label for="gravisain_sidebar_choice" style="display: block; font-weight: 600; margin-bottom: 6px;"><?php esc_html_e( 'Page sidebar:', 'gravisain' ); ?></label>
				<select name="gravisain_sidebar_choice" id="gravisain_sidebar_choice" style="box-sizing: border-box; width: 100%; max-width: 100%; height: 36px; padding: 0 8px;">
					<option value="default" <?php selected( $sidebar_choice, 'default' ); ?>><?php esc_html_e( 'Default', 'gravisain' ); ?></option>
					<option value="sidebar-1" <?php selected( $sidebar_choice, 'sidebar-1' ); ?>><?php esc_html_e( 'Main Blog Sidebar', 'gravisain' ); ?></option>
				</select>
			</div>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Save Meta Box values.
	 *
	 * @param int      $post_id Post ID.
	 * @param \WP_Post $post    Post object.
	 */
	public function save_meta_box( int $post_id, $post ): void {
		if ( ! isset( $_POST[ self::NONCE_NAME ] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ self::NONCE_NAME ] ) ), self::NONCE_ACTION ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
			return;
		}

		// Check permissions per post type
		$post_type = isset( $_POST['post_type'] ) ? sanitize_key( wp_unslash( $_POST['post_type'] ) ) : 'post';
		if ( 'page' === $post_type ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$hide_header = isset( $_POST['gravisain_hide_header'] ) ? 1 : 0;
		$hide_footer = isset( $_POST['gravisain_hide_footer'] ) ? 1 : 0;

		$title_mode_raw = isset( $_POST['gravisain_title_mode'] ) ? sanitize_key( wp_unslash( $_POST['gravisain_title_mode'] ) ) : 'default';
		$allowed_modes  = [ 'default', 'show', 'hide' ];
		$title_mode     = in_array( $title_mode_raw, $allowed_modes, true ) ? $title_mode_raw : 'default';
		$hide_title     = ( 'hide' === $title_mode ) ? 1 : 0;

		$sidebar_raw     = isset( $_POST['gravisain_sidebar_layout'] ) ? sanitize_key( wp_unslash( $_POST['gravisain_sidebar_layout'] ) ) : 'default';
		$allowed_sidebars = [ 'default', 'normal', 'narrow', 'no-sidebar', 'left-sidebar', 'right-sidebar' ];
		$sidebar         = in_array( $sidebar_raw, $allowed_sidebars, true ) ? $sidebar_raw : 'default';

		$sidebar_choice_raw = isset( $_POST['gravisain_sidebar_choice'] ) ? sanitize_key( wp_unslash( $_POST['gravisain_sidebar_choice'] ) ) : 'default';
		$sidebar_choice     = ! empty( $sidebar_choice_raw ) ? $sidebar_choice_raw : 'default';

		$transparent_raw = isset( $_POST['gravisain_transparent_header'] ) ? sanitize_key( wp_unslash( $_POST['gravisain_transparent_header'] ) ) : 'default';
		$allowed_trans   = [ 'default', 'enable', 'disable' ];
		$transparent     = in_array( $transparent_raw, $allowed_trans, true ) ? $transparent_raw : 'default';

		$style_raw       = isset( $_POST['gravisain_content_style'] ) ? sanitize_key( wp_unslash( $_POST['gravisain_content_style'] ) ) : 'default';
		$allowed_styles  = [ 'default', 'boxed', 'unboxed' ];
		$content_style   = in_array( $style_raw, $allowed_styles, true ) ? $style_raw : 'default';

		$spacing_raw     = isset( $_POST['gravisain_vertical_spacing'] ) ? sanitize_key( wp_unslash( $_POST['gravisain_vertical_spacing'] ) ) : 'default';
		$allowed_spacing = [ 'default', 'enable', 'disable', 'top-only', 'bottom-only' ];
		$vertical_spacing = in_array( $spacing_raw, $allowed_spacing, true ) ? $spacing_raw : 'default';

		$featured_raw    = isset( $_POST['gravisain_show_featured_image'] ) ? sanitize_key( wp_unslash( $_POST['gravisain_show_featured_image'] ) ) : 'default';
		$allowed_featured = [ 'default', 'enable', 'disable' ];
		$featured_image  = in_array( $featured_raw, $allowed_featured, true ) ? $featured_raw : 'default';

		$body_class_clean = isset( $_POST['gravisain_body_class'] ) ? sanitize_text_field( wp_unslash( $_POST['gravisain_body_class'] ) ) : '';

		update_post_meta( $post_id, '_gravisain_hide_header', $hide_header );
		update_post_meta( $post_id, '_gravisain_hide_footer', $hide_footer );
		update_post_meta( $post_id, '_gravisain_title_mode', $title_mode );
		update_post_meta( $post_id, '_gravisain_hide_title', $hide_title );
		update_post_meta( $post_id, '_gravisain_sidebar_layout', $sidebar );
		update_post_meta( $post_id, '_gravisain_sidebar_choice', $sidebar_choice );
		update_post_meta( $post_id, '_gravisain_transparent_header', $transparent );
		update_post_meta( $post_id, '_gravisain_content_style', $content_style );
		update_post_meta( $post_id, '_gravisain_vertical_spacing', $vertical_spacing );
		update_post_meta( $post_id, '_gravisain_show_featured_image', $featured_image );
		update_post_meta( $post_id, '_gravisain_body_class', $body_class_clean );
	}

	/**
	 * Enqueue React script for the sidebar.
	 */
	public function enqueue_assets(): void {
		$asset_file = get_template_directory() . '/assets/meta/index.asset.php';
		if ( ! file_exists( $asset_file ) ) {
			return;
		}

		$asset = require $asset_file;

		$theme_version = wp_get_theme()->get( 'Version' );

		wp_enqueue_script(
			'gravisain-page-settings',
			get_template_directory_uri() . '/assets/meta/index.js',
			$asset['dependencies'],
			$asset['version'] . '.' . $theme_version,
			true
		);

		// Add comprehensive editor inline CSS so preview editor exactly matches frontend (1:1 parity)
		$custom_css = '
			/* Hide Title / Hero inside editor preview */
			body.gravisain-editor-hide-title .editor-post-title,
			body.gravisain-editor-hide-title .wp-block-post-title,
			body.gravisain-editor-hide-title .editor-post-title__block {
				display: none !important;
			}
			/* Hide Header / Footer block template parts inside editor preview */
			body.gravisain-editor-hide-header .wp-block-template-part[className*="header"],
			body.gravisain-editor-hide-header header.wp-block-template-part {
				display: none !important;
			}
			body.gravisain-editor-hide-footer .wp-block-template-part[className*="footer"],
			body.gravisain-editor-hide-footer footer.wp-block-template-part {
				display: none !important;
			}
			/* Narrow Layout in Editor Preview */
			body.gravisain-page-layout-narrow .editor-styles-wrapper .is-root-container > *,
			body.gravisain-page-layout-narrow .editor-styles-wrapper .block-editor-block-list__layout.is-root-container > * {
				max-width: 800px !important;
				margin-left: auto !important;
				margin-right: auto !important;
			}
			body.gravisain-page-layout-narrow .editor-styles-wrapper .is-root-container > .alignwide,
			body.gravisain-page-layout-narrow .editor-styles-wrapper .block-editor-block-list__layout.is-root-container > .alignwide {
				max-width: 800px !important;
			}
			/* Normal Layout in Editor Preview */
			body.gravisain-page-layout-normal .editor-styles-wrapper .is-root-container > *,
			body.gravisain-page-layout-normal .editor-styles-wrapper .block-editor-block-list__layout.is-root-container > * {
				max-width: var(--gravisain-container-width, 1200px) !important;
				margin-left: auto !important;
				margin-right: auto !important;
			}
			/* Boxed Content Style in Editor Preview */
			body.gravisain-content-style-boxed .editor-styles-wrapper {
				background-color: transparent !important;
			}
			body.gravisain-content-style-boxed .editor-styles-wrapper .is-root-container,
			body.gravisain-content-style-boxed .editor-styles-wrapper .block-editor-block-list__layout.is-root-container {
				background-color: var(--gravisain-content-bg, #ffffff) !important;
				border-radius: 12px !important;
				box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
				padding: 2.5rem !important;
				max-width: var(--gravisain-container-width, 1200px);
				margin: 2rem auto !important;
			}
			body.gravisain-content-style-boxed.gravisain-page-layout-narrow .editor-styles-wrapper .is-root-container,
			body.gravisain-content-style-boxed.gravisain-page-layout-narrow .editor-styles-wrapper .block-editor-block-list__layout.is-root-container {
				max-width: 800px !important;
			}
			/* Spacing for Gravisain Page Settings ToggleControls */
			.gravisain-page-settings-panel .components-base-control {
				margin-bottom: 16px !important;
			}
			.gravisain-page-settings-panel .components-base-control:last-child {
				margin-bottom: 0 !important;
			}
		';
		wp_add_inline_style( 'wp-edit-blocks', $custom_css );
		wp_add_inline_style( 'gravisain-editor-canvas', $custom_css );
	}

	/**
	 * Add custom class to block editor body.
	 *
	 * @param string $classes Existing body classes.
	 * @return string
	 */
	public function add_admin_body_class( string $classes ): string {
		$screen = get_current_screen();
		if ( $screen && $screen->is_block_editor() ) {
			$post_id = isset( $_GET['post'] ) ? (int) $_GET['post'] : 0;
			if ( ! $post_id && isset( $GLOBALS['post'] ) && $GLOBALS['post']->ID ) {
				$post_id = $GLOBALS['post']->ID;
			}

			if ( self::is_title_hidden( $post_id ) ) {
				$classes .= ' gravisain-editor-hide-title';
			}
			if ( self::is_header_hidden( $post_id ) ) {
				$classes .= ' gravisain-editor-hide-header';
			}
			if ( self::is_footer_hidden( $post_id ) ) {
				$classes .= ' gravisain-editor-hide-footer';
			}

			if ( $post_id ) {
				$sidebar_layout = self::get_meta_value( $post_id, '_gravisain_sidebar_layout', 'default' );
				if ( ! empty( $sidebar_layout ) && 'default' !== $sidebar_layout ) {
					$classes .= ' gravisain-page-layout-' . esc_attr( $sidebar_layout );
				}

				$content_style = self::get_meta_value( $post_id, '_gravisain_content_style', 'default' );
				if ( ! empty( $content_style ) && 'default' !== $content_style ) {
					$classes .= ' gravisain-content-style-' . esc_attr( $content_style );
				}

				$vertical_spacing = self::get_meta_value( $post_id, '_gravisain_vertical_spacing', 'default' );
				if ( ! empty( $vertical_spacing ) && 'default' !== $vertical_spacing ) {
					$classes .= ' gravisain-spacing-' . esc_attr( $vertical_spacing );
				}

				$show_featured_image = self::get_meta_value( $post_id, '_gravisain_show_featured_image', 'default' );
				if ( 'disable' === $show_featured_image ) {
					$classes .= ' gravisain-hide-featured-image';
				}

				$custom_classes = self::get_meta_value( $post_id, '_gravisain_body_class', '' );
				if ( ! empty( $custom_classes ) ) {
					$parts = explode( ' ', $custom_classes );
					foreach ( $parts as $part ) {
						$part_clean = trim( sanitize_html_class( $part ) );
						if ( ! empty( $part_clean ) ) {
							$classes .= ' ' . $part_clean;
						}
					}
				}
			}
		}
		return $classes;
	}

	/**
	 * Add custom classes to frontend body.
	 *
	 * @param array $classes Existing body classes.
	 * @return array
	 */
	public function add_body_classes( array $classes ): array {
		if ( ! is_singular() ) {
			return $classes;
		}

		$post_id = get_the_ID();
		if ( ! $post_id ) {
			return $classes;
		}

		if ( self::is_header_hidden( $post_id ) ) {
			$classes[] = 'gravisain-hide-header';
		}
		if ( self::is_footer_hidden( $post_id ) ) {
			$classes[] = 'gravisain-hide-footer';
		}
		if ( self::is_title_hidden( $post_id ) ) {
			$classes[] = 'gravisain-hide-title';
		}

		$sidebar_layout = self::get_meta_value( $post_id, '_gravisain_sidebar_layout', 'default' );
		if ( ! empty( $sidebar_layout ) && 'default' !== $sidebar_layout ) {
			$classes[] = 'gravisain-page-layout-' . esc_attr( $sidebar_layout );
		}

		$content_style = self::get_meta_value( $post_id, '_gravisain_content_style', 'default' );
		if ( ! empty( $content_style ) && 'default' !== $content_style ) {
			$classes[] = 'gravisain-content-style-' . esc_attr( $content_style );
		}

		$vertical_spacing = self::get_meta_value( $post_id, '_gravisain_vertical_spacing', 'default' );
		if ( ! empty( $vertical_spacing ) && 'default' !== $vertical_spacing ) {
			$classes[] = 'gravisain-spacing-' . esc_attr( $vertical_spacing );
		}

		$show_featured_image = self::get_meta_value( $post_id, '_gravisain_show_featured_image', 'default' );
		if ( 'disable' === $show_featured_image ) {
			$classes[] = 'gravisain-hide-featured-image';
		}

		$custom_classes = self::get_meta_value( $post_id, '_gravisain_body_class', '' );
		if ( ! empty( $custom_classes ) ) {
			$parts = explode( ' ', $custom_classes );
			foreach ( $parts as $part ) {
				$part_clean = trim( sanitize_html_class( $part ) );
				if ( ! empty( $part_clean ) ) {
					$classes[] = $part_clean;
				}
			}
		}

		return $classes;
	}

	/**
	 * Intercept the core/post-title block rendering.
	 */
	public function filter_post_title_block( $block_content, $block ): string {
		if ( 'core/post-title' === $block['blockName'] ) {
			if ( self::is_title_hidden() ) {
				return '';
			}
		}
		return $block_content;
	}

	/**
	 * Get meta value with autosave / live preview fallback support.
	 *
	 * @param int|null $post_id Optional post ID.
	 * @param string   $meta_key Meta key to retrieve.
	 * @param mixed    $default Default value if empty or not set.
	 * @return mixed
	 */
	public static function get_meta_value( ?int $post_id, string $meta_key, $default = '' ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}
		if ( ! $post_id ) {
			return $default;
		}

		if ( is_preview() ) {
			// Check transient first for perfectly synced REST API preview meta
			$user_id = get_current_user_id();
			if ( $user_id ) {
				$transient_key = 'gravisain_preview_meta_' . $post_id . '_' . $user_id;
				$preview_meta  = get_transient( $transient_key );
				if ( is_array( $preview_meta ) && array_key_exists( $meta_key, $preview_meta ) ) {
					$val = $preview_meta[ $meta_key ];
					if ( '' !== $val && false !== $val && null !== $val ) {
						return $val;
					}
				}
			}

			// Fallback: Check autosave
			if ( function_exists( 'wp_get_post_autosave' ) ) {
				$autosave = wp_get_post_autosave( $post_id, get_current_user_id() );
				if ( ! $autosave ) {
					$autosave = wp_get_post_autosave( $post_id );
				}
				if ( $autosave instanceof \WP_Post && ! empty( $autosave->ID ) && (int) $autosave->ID !== $post_id ) {
					$preview_val = get_post_meta( (int) $autosave->ID, $meta_key, true );
					if ( '' !== $preview_val && false !== $preview_val && null !== $preview_val ) {
						return $preview_val;
					}
				}
			}
			// Fallback: check latest revision
			if ( function_exists( 'wp_get_post_revisions' ) ) {
				$revisions = wp_get_post_revisions( $post_id, [ 'posts_per_page' => 1 ] );
				if ( ! empty( $revisions ) && is_array( $revisions ) ) {
					$latest_rev = reset( $revisions );
					if ( $latest_rev instanceof \WP_Post && ! empty( $latest_rev->ID ) && (int) $latest_rev->ID !== $post_id ) {
						$preview_val = get_post_meta( (int) $latest_rev->ID, $meta_key, true );
						if ( '' !== $preview_val && false !== $preview_val && null !== $preview_val ) {
							return $preview_val;
						}
					}
				}
			}
		}

		$val = get_post_meta( $post_id, $meta_key, true );
		return ( '' !== $val && false !== $val && null !== $val ) ? $val : $default;
	}

	/**
	 * Check if header is disabled for current page/post.
	 *
	 * @param int|null $post_id Optional post ID.
	 * @return bool
	 */
	public static function is_header_hidden( ?int $post_id = null ): bool {
		if ( ! is_singular() && null === $post_id ) {
			return false;
		}
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}
		if ( ! $post_id ) {
			return false;
		}
		return (bool) self::get_meta_value( $post_id, '_gravisain_hide_header', false );
	}

	/**
	 * Check if footer is disabled for current page/post.
	 *
	 * @param int|null $post_id Optional post ID.
	 * @return bool
	 */
	public static function is_footer_hidden( ?int $post_id = null ): bool {
		if ( ! is_singular() && null === $post_id ) {
			return false;
		}
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}
		if ( ! $post_id ) {
			return false;
		}
		return (bool) self::get_meta_value( $post_id, '_gravisain_hide_footer', false );
	}

	/**
	 * Get title mode for current page/post.
	 *
	 * @param int|null $post_id Optional post ID.
	 * @return string ('default', 'show', 'hide')
	 */
	public static function get_title_mode( ?int $post_id = null ): string {
		if ( ! is_singular() && null === $post_id ) {
			return 'default';
		}
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}
		if ( ! $post_id ) {
			return 'default';
		}

		$mode = self::get_meta_value( $post_id, '_gravisain_title_mode', 'default' );
		if ( 'show' === $mode || 'hide' === $mode ) {
			return $mode;
		}

		// Fallback to legacy hide_title meta
		$legacy_hide = (bool) self::get_meta_value( $post_id, '_gravisain_hide_title', false );
		return $legacy_hide ? 'hide' : 'default';
	}

	/**
	 * Check if title/hero is disabled for current page/post.
	 *
	 * @param int|null $post_id Optional post ID.
	 * @return bool
	 */
	public static function is_title_hidden( ?int $post_id = null ): bool {
		return 'hide' === self::get_title_mode( $post_id );
	}

	/**
	 * Check if title/hero is explicitly forced to show for current page/post.
	 *
	 * @param int|null $post_id Optional post ID.
	 * @return bool
	 */
	public static function is_title_forced_show( ?int $post_id = null ): bool {
		return 'show' === self::get_title_mode( $post_id );
	}

	/**
	 * Get sidebar layout for current page/post.
	 *
	 * @param int|null $post_id Optional post ID.
	 * @return string
	 */
	public static function get_sidebar_layout( ?int $post_id = null ): string {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}
		if ( ! $post_id ) {
			return 'default';
		}
		$val = self::get_meta_value( $post_id, '_gravisain_sidebar_layout', 'default' );
		return ! empty( $val ) ? $val : 'default';
	}

	public static function get_sidebar_choice( ?int $post_id = null ): string {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}
		if ( ! $post_id ) {
			return 'default';
		}
		$val = self::get_meta_value( $post_id, '_gravisain_sidebar_choice', 'default' );
		return ! empty( $val ) ? $val : 'default';
	}

	public static function get_transparent_header( ?int $post_id = null ): string {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}
		if ( ! $post_id ) {
			return 'default';
		}
		$val = self::get_meta_value( $post_id, '_gravisain_transparent_header', 'default' );
		return ! empty( $val ) ? $val : 'default';
	}

	public static function get_content_style( ?int $post_id = null ): string {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}
		if ( ! $post_id ) {
			return 'default';
		}
		$val = self::get_meta_value( $post_id, '_gravisain_content_style', 'default' );
		return ! empty( $val ) ? $val : 'default';
	}

	public static function get_vertical_spacing( ?int $post_id = null ): string {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}
		if ( ! $post_id ) {
			return 'default';
		}
		$val = self::get_meta_value( $post_id, '_gravisain_vertical_spacing', 'default' );
		return ! empty( $val ) ? $val : 'default';
	}

	public static function get_show_featured_image( ?int $post_id = null ): string {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}
		if ( ! $post_id ) {
			return 'default';
		}
		$val = self::get_meta_value( $post_id, '_gravisain_show_featured_image', 'default' );
		return ! empty( $val ) ? $val : 'default';
	}

	public static function get_custom_body_class( ?int $post_id = null ): string {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}
		if ( ! $post_id ) {
			return '';
		}
		return (string) self::get_meta_value( $post_id, '_gravisain_body_class', '' );
	}
}
