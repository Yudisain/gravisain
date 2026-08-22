<?php
/**
 * Companion Plugin Recommendation Admin Notice
 *
 * @package Gravisain\Integrations
 */

declare(strict_types=1);

namespace Gravisain\Integrations;

/**
 * CompanionNotice Class
 *
 * Displays a non-intrusive admin notice recommending the Gravisain Companion
 * plugin to activate Hooked Elements and Starter Sites Demo Importer.
 */
class CompanionNotice {

	/**
	 * Dismiss notice meta key.
	 */
	private const DISMISS_KEY = 'gravisain_companion_notice_dismissed';

	/**
	 * Initialize the notice service.
	 *
	 * @return void
	 */
	public static function init(): void {
		add_action( 'admin_notices', [ self::class, 'render_notice' ] );
		add_action( 'admin_init', [ self::class, 'handle_dismiss' ] );
	}

	/**
	 * Check if the Starter Sites plugin is active.
	 *
	 * @return bool
	 */
	public static function is_starter_sites_active(): bool {
		return defined( 'GRAVISAIN_COMPANION_VERSION' ) || class_exists( '\\Gravisain\\Companion\\Plugin' );
	}

	/**
	 * Check if the Gravisain Blocks plugin is active.
	 *
	 * @return bool
	 */
	public static function is_blocks_active(): bool {
		return defined( 'GRAVISAIN_BLOCKS_VERSION' ) || class_exists( '\\Gravisain\\Blocks\\Plugin' );
	}

	/**
	 * Check if all Companion plugins are active.
	 *
	 * @return bool
	 */
	public static function is_companion_active(): bool {
		return self::is_starter_sites_active() && self::is_blocks_active();
	}

	/**
	 * Render the recommendation notice in WordPress admin dashboard.
	 *
	 * @return void
	 */
	public static function render_notice(): void {
		if ( ! current_user_can( 'install_plugins' ) || self::is_companion_active() ) {
			return;
		}

		$user_id   = get_current_user_id();
		$dismissed = get_user_meta( $user_id, self::DISMISS_KEY, true );

		if ( ! empty( $dismissed ) ) {
			return;
		}

		$dismiss_url = wp_nonce_url(
			add_query_arg( 'gravisain_dismiss_companion_notice', '1' ),
			'gravisain_dismiss_companion_notice_nonce'
		);
		?>
		<div class="notice notice-info is-dismissible" style="border-left-color: #4f46e5; padding: 12px 16px;">
			<h3 style="margin: 0 0 6px 0; font-size: 15px;">
				<?php esc_html_e( 'Supercharge Gravisain with Official Companion Plugins', 'gravisain' ); ?>
			</h3>
			<p style="margin: 0 0 10px 0;">
				<?php
				esc_html_e(
					'Activate Gravisain Blocks (Gutenberg Pattern Library) and Gravisain Starter Sites (1-Click Demo Importer) to unlock the full design ecosystem.',
					'gravisain'
				);
				?>
			</p>
			<p style="margin: 0;">
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=gravisain-dashboard' ) ); ?>" class="button button-primary" style="background: #4f46e5; border-color: #4338ca;">
					<?php esc_html_e( 'View Companion Status', 'gravisain' ); ?>
				</a>
				<a href="<?php echo esc_url( admin_url( 'plugins.php' ) ); ?>" class="button" style="margin-left: 8px;">
					<?php esc_html_e( 'Manage Plugins', 'gravisain' ); ?>
				</a>
				<a href="<?php echo esc_url( $dismiss_url ); ?>" style="margin-left: 12px; text-decoration: none; color: #646970;">
					<?php esc_html_e( 'Dismiss this notice', 'gravisain' ); ?>
				</a>
			</p>
		</div>
		<?php
	}

	/**
	 * Handle notice dismissal action.
	 *
	 * @return void
	 */
	public static function handle_dismiss(): void {
		if ( ! isset( $_GET['gravisain_dismiss_companion_notice'] ) ) {
			return;
		}

		if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'gravisain_dismiss_companion_notice_nonce' ) ) {
			return;
		}

		$user_id = get_current_user_id();
		update_user_meta( $user_id, self::DISMISS_KEY, '1' );

		wp_safe_redirect( remove_query_arg( [ 'gravisain_dismiss_companion_notice', '_wpnonce' ] ) );
		exit;
	}
}
