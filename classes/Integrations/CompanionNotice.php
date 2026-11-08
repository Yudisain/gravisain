<?php
/**
 * Companion Plugin Recommendation Admin Notice
 *
 * @package Gravisain\Integrations
 */

declare(strict_types=1);

namespace Gravisain\Integrations;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
		add_action( 'gravisain_dashboard_main_bottom', [ self::class, 'render_dashboard_card' ] );
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
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=gravisain-dashboard' ) ); ?>" class="button button-primary" style="background: #4f46e5; border-color: #4338ca;">
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

	/**
	 * Render Official Companion Plugins card on Theme Dashboard.
	 *
	 * @return void
	 */
	public static function render_dashboard_card(): void {
		$blocks_active        = self::is_blocks_active();
		$starter_sites_active = self::is_starter_sites_active();
		?>
		<div class="gravisain-card" style="margin-bottom: 20px;">
			<h2><?php esc_html_e( 'Official Companion Plugins', 'gravisain' ); ?></h2>
			<p style="color: #50575e; margin-bottom: 15px;"><?php esc_html_e( 'Extend Gravisain with standalone modular extensions for Gutenberg patterns and demo templates.', 'gravisain' ); ?></p>
			<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
				<div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 16px; border-radius: 6px;">
					<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
						<strong style="color: #0f172a; font-size: 14px;"><?php esc_html_e( 'Gravisain Blocks', 'gravisain' ); ?></strong>
						<?php if ( $blocks_active ) : ?>
							<span style="background: #dcfce7; color: #166534; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 12px;"><?php esc_html_e( 'ACTIVE', 'gravisain' ); ?></span>
						<?php else : ?>
							<span style="background: #f1f5f9; color: #64748b; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 12px;"><?php esc_html_e( 'NOT INSTALLED', 'gravisain' ); ?></span>
						<?php endif; ?>
					</div>
					<p style="font-size: 12px; color: #64748b; margin: 0 0 12px 0; line-height: 1.5;"><?php esc_html_e( 'Official Gutenberg Block Patterns (Heroes, Feature Grids, Pricing, CTAs, FAQ) & Block Styles.', 'gravisain' ); ?></p>
					<a href="<?php echo esc_url( admin_url( 'plugins.php' ) ); ?>" style="font-size: 12px; font-weight: 600; color: #4f46e5; text-decoration: none;"><?php esc_html_e( 'Manage Plugin →', 'gravisain' ); ?></a>
				</div>

				<div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 16px; border-radius: 6px;">
					<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
						<strong style="color: #0f172a; font-size: 14px;"><?php esc_html_e( 'Gravisain Starter Sites', 'gravisain' ); ?></strong>
						<?php if ( $starter_sites_active ) : ?>
							<span style="background: #dcfce7; color: #166534; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 12px;"><?php esc_html_e( 'ACTIVE', 'gravisain' ); ?></span>
						<?php else : ?>
							<span style="background: #f1f5f9; color: #64748b; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 12px;"><?php esc_html_e( 'NOT INSTALLED', 'gravisain' ); ?></span>
						<?php endif; ?>
					</div>
					<p style="font-size: 12px; color: #64748b; margin: 0 0 12px 0; line-height: 1.5;"><?php esc_html_e( '1-Click Demo Importer with Agency, Logistics, & Gravitour Travel starter sites.', 'gravisain' ); ?></p>
					<?php if ( $starter_sites_active ) : ?>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=gravisain-starter-sites' ) ); ?>" style="font-size: 12px; font-weight: 600; color: #4f46e5; text-decoration: none;"><?php esc_html_e( 'Open Importer →', 'gravisain' ); ?></a>
					<?php else : ?>
						<a href="<?php echo esc_url( admin_url( 'plugins.php' ) ); ?>" style="font-size: 12px; font-weight: 600; color: #4f46e5; text-decoration: none;"><?php esc_html_e( 'Manage Plugin →', 'gravisain' ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}
}
