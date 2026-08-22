<?php
/**
 * Menu Enhancements Component
 *
 * Extends WordPress navigation menus with Menu Badges (HOT, NEW, SALE)
 * and Mega Menu column layout settings.
 *
 * @package Gravisain\Components
 */

namespace Gravisain\Components;

class MenuEnhancements {

	/**
	 * Initialize menu enhancement hooks.
	 *
	 * @return void
	 */
	public static function init(): void {
		// Admin: Render custom fields in Appearance > Menus
		add_action( 'wp_nav_menu_item_custom_fields', [ __CLASS__, 'render_menu_item_fields' ], 10, 5 );

		// Admin: Save custom menu fields
		add_action( 'wp_update_nav_menu_item', [ __CLASS__, 'save_menu_item_fields' ], 10, 2 );

		// Frontend: Append badge markup to menu item title
		add_filter( 'nav_menu_item_title', [ __CLASS__, 'add_badge_to_menu_title' ], 10, 4 );

		// Frontend: Add Mega Menu classes to top-level menu items
		add_filter( 'nav_menu_css_class', [ __CLASS__, 'add_mega_menu_classes' ], 10, 4 );
	}

	/**
	 * Render custom fields inside the WordPress menu editor item box.
	 *
	 * @param int       $item_id Menu item ID.
	 * @param \WP_Post  $item    Menu item data object.
	 * @param int       $depth   Depth of menu item.
	 * @param \stdClass $args    Menu item args.
	 * @param int       $id      Nav menu ID.
	 * @return void
	 */
	public static function render_menu_item_fields( $item_id, $item, $depth, $args, $id ): void {
		$badge_text  = get_post_meta( $item_id, '_gravisain_menu_badge_text', true );
		$badge_color = get_post_meta( $item_id, '_gravisain_menu_badge_color', true );
		$mega_menu   = get_post_meta( $item_id, '_gravisain_mega_menu', true );
		?>
		<div class="gravisain-menu-custom-fields" style="clear: both; margin: 12px 0; padding: 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px;">
			<p class="description description-wide">
				<label for="gravisain-badge-text-<?php echo esc_attr( (string) $item_id ); ?>">
					<strong><?php esc_html_e( 'Gravisain Badge Text (e.g. HOT, NEW, SALE):', 'gravisain' ); ?></strong><br />
					<input type="text" id="gravisain-badge-text-<?php echo esc_attr( (string) $item_id ); ?>" class="widefat" name="gravisain_menu_badge_text[<?php echo esc_attr( (string) $item_id ); ?>]" value="<?php echo esc_attr( (string) $badge_text ); ?>" />
				</label>
			</p>

			<p class="description description-thin">
				<label for="gravisain-badge-color-<?php echo esc_attr( (string) $item_id ); ?>">
					<strong><?php esc_html_e( 'Badge Color:', 'gravisain' ); ?></strong><br />
					<select id="gravisain-badge-color-<?php echo esc_attr( (string) $item_id ); ?>" class="widefat" name="gravisain_menu_badge_color[<?php echo esc_attr( (string) $item_id ); ?>]">
						<option value="primary" <?php selected( $badge_color, 'primary' ); ?>><?php esc_html_e( 'Primary Brand (Indigo)', 'gravisain' ); ?></option>
						<option value="danger" <?php selected( $badge_color, 'danger' ); ?>><?php esc_html_e( 'Hot / Sale (Red)', 'gravisain' ); ?></option>
						<option value="success" <?php selected( $badge_color, 'success' ); ?>><?php esc_html_e( 'New (Green)', 'gravisain' ); ?></option>
						<option value="warning" <?php selected( $badge_color, 'warning' ); ?>><?php esc_html_e( 'Featured (Amber)', 'gravisain' ); ?></option>
						<option value="dark" <?php selected( $badge_color, 'dark' ); ?>><?php esc_html_e( 'Pro / VIP (Dark)', 'gravisain' ); ?></option>
					</select>
				</label>
			</p>

			<?php if ( 0 === (int) $depth ) : ?>
				<p class="description description-thin">
					<label for="gravisain-mega-menu-<?php echo esc_attr( (string) $item_id ); ?>">
						<strong><?php esc_html_e( 'Mega Menu Layout:', 'gravisain' ); ?></strong><br />
						<select id="gravisain-mega-menu-<?php echo esc_attr( (string) $item_id ); ?>" class="widefat" name="gravisain_mega_menu[<?php echo esc_attr( (string) $item_id ); ?>]">
							<option value="none" <?php selected( $mega_menu, 'none' ); ?>><?php esc_html_e( 'Standard Dropdown', 'gravisain' ); ?></option>
							<option value="2-col" <?php selected( $mega_menu, '2-col' ); ?>><?php esc_html_e( '2 Columns Mega Menu', 'gravisain' ); ?></option>
							<option value="3-col" <?php selected( $mega_menu, '3-col' ); ?>><?php esc_html_e( '3 Columns Mega Menu', 'gravisain' ); ?></option>
							<option value="4-col" <?php selected( $mega_menu, '4-col' ); ?>><?php esc_html_e( '4 Columns Mega Menu', 'gravisain' ); ?></option>
						</select>
					</label>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Save custom menu fields on item update.
	 *
	 * @param int $menu_id         Nav menu ID.
	 * @param int $menu_item_db_id Menu item database ID.
	 * @return void
	 */
	public static function save_menu_item_fields( $menu_id, $menu_item_db_id ): void {
		// Verify nonce or permission handled by WordPress save_nav_menu action
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		// Save Badge Text
		if ( isset( $_POST['gravisain_menu_badge_text'][ $menu_item_db_id ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			$badge_text = sanitize_text_field( wp_unslash( $_POST['gravisain_menu_badge_text'][ $menu_item_db_id ] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_post_meta( $menu_item_db_id, '_gravisain_menu_badge_text', $badge_text );
		} else {
			delete_post_meta( $menu_item_db_id, '_gravisain_menu_badge_text' );
		}

		// Save Badge Color
		if ( isset( $_POST['gravisain_menu_badge_color'][ $menu_item_db_id ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			$badge_color = sanitize_text_field( wp_unslash( $_POST['gravisain_menu_badge_color'][ $menu_item_db_id ] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_post_meta( $menu_item_db_id, '_gravisain_menu_badge_color', $badge_color );
		}

		// Save Mega Menu Column
		if ( isset( $_POST['gravisain_mega_menu'][ $menu_item_db_id ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			$mega_menu = sanitize_text_field( wp_unslash( $_POST['gravisain_mega_menu'][ $menu_item_db_id ] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_post_meta( $menu_item_db_id, '_gravisain_mega_menu', $mega_menu );
		}
	}

	/**
	 * Append badge HTML to the menu item title if a badge is set.
	 *
	 * @param string   $title The menu item title.
	 * @param \WP_Post $item  The menu item data object.
	 * @param \stdClass $args An object of wp_nav_menu() arguments.
	 * @param int      $depth Depth of menu item.
	 * @return string
	 */
	public static function add_badge_to_menu_title( $title, $item, $args, $depth ): string {
		// Do not add badges inside admin editor
		if ( is_admin() ) {
			return $title;
		}

		$badge_text = get_post_meta( $item->ID, '_gravisain_menu_badge_text', true );
		if ( empty( $badge_text ) ) {
			return $title;
		}

		$badge_color = get_post_meta( $item->ID, '_gravisain_menu_badge_color', true );
		if ( empty( $badge_color ) ) {
			$badge_color = 'primary';
		}

		$badge_html = sprintf(
			'<span class="gravisain-menu-badge badge-%1$s">%2$s</span>',
			esc_attr( $badge_color ),
			esc_html( $badge_text )
		);

		return $title . ' ' . $badge_html;
	}

	/**
	 * Add CSS classes to menu items for Mega Menu dropdown styling.
	 *
	 * @param string[]  $classes Array of the CSS classes applied to the menu item's <li> element.
	 * @param \WP_Post  $item    The current menu item data object.
	 * @param \stdClass $args    An object of wp_nav_menu() arguments.
	 * @param int       $depth   Depth of menu item.
	 * @return string[]
	 */
	public static function add_mega_menu_classes( $classes, $item, $args, $depth ): array {
		if ( 0 === (int) $depth ) {
			$mega_menu = get_post_meta( $item->ID, '_gravisain_mega_menu', true );
			if ( ! empty( $mega_menu ) && 'none' !== $mega_menu ) {
				$classes[] = 'has-gravisain-mega-menu';
				$classes[] = 'gravisain-mega-' . sanitize_html_class( $mega_menu );
			}
		}

		return $classes;
	}
}
