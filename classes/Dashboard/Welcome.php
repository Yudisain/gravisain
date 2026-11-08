<?php
/**
 * Theme Dashboard Welcome Page
 *
 * @package Gravisain\Dashboard
 */

namespace Gravisain\Dashboard;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Welcome {
	public static function init(): void {
		$instance = new self();
		add_action( 'admin_menu', [ $instance, 'add_menu_page' ] );
		add_action( 'wp_ajax_gravisain_purge_cache', [ $instance, 'ajax_purge_cache' ] );
	}

	public function ajax_purge_cache(): void {
		check_ajax_referer( 'gravisain_purge_cache', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( [ 'message' => __( 'Unauthorized access.', 'gravisain' ) ] );
		}

		// Rate limiting protection to prevent local DoS / filesystem lock contention
		$user_id        = get_current_user_id();
		$rate_limit_key = 'gravisain_purge_rate_limit_' . $user_id;

		if ( get_transient( $rate_limit_key ) ) {
			wp_send_json_error( [ 'message' => __( 'Please wait a few seconds before purging cache again.', 'gravisain' ) ] );
		}

		set_transient( $rate_limit_key, true, 3 );

		\Gravisain\CSS\LocalFontDownloader::clear_cache();
		\Gravisain\CSS\CSSFileCache::clear_cache();

		wp_send_json_success( [ 'message' => __( 'Performance cache purged successfully.', 'gravisain' ) ] );
	}

	public function add_menu_page(): void {
		$menu_label = __( 'Gravisain', 'gravisain' );
		$page_title = __( 'Gravisain Dashboard', 'gravisain' );

		// Register theme dashboard under Appearance (themes.php) per Theme Review Guidelines
		add_theme_page(
			$page_title,
			$menu_label,
			'manage_options',
			'gravisain-dashboard',
			[ $this, 'render_page' ]
		);

		// Submenus under Appearance
		add_submenu_page(
			'themes.php',
			__( 'Gravisain Status & Diagnostics', 'gravisain' ),
			__( 'Gravisain Status', 'gravisain' ),
			'manage_options',
			'gravisain-system-status',
			[ '\Gravisain\Dashboard\SystemStatus', 'render_page' ]
		);
	}

	private function get_system_status(): array {
		return [
			__( 'WP Version', 'gravisain' )    => get_bloginfo( 'version' ),
			__( 'PHP Version', 'gravisain' )   => phpversion(),
			__( 'Memory Limit', 'gravisain' )  => WP_MEMORY_LIMIT,
			__( 'Max Exec Time', 'gravisain' ) => ini_get( 'max_execution_time' ) . 's',
			__( 'Debug Mode', 'gravisain' )    => defined( 'WP_DEBUG' ) && WP_DEBUG ? __( 'Enabled', 'gravisain' ) : __( 'Disabled', 'gravisain' ),
		];
	}

	public function render_page(): void {
		$status = $this->get_system_status();
		?>
		<style>
			.gravisain-wrap { max-width: 1080px; margin-top: 20px; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif; }
			.gravisain-header { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
			.gravisain-header h1 { margin: 0; font-size: 28px; font-weight: 600; color: #1e1e1e; }
			.gravisain-badge { background: #4f46e5; color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; }
			.gravisain-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; }
			.gravisain-card { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
			.gravisain-card h2 { margin-top: 0; font-size: 18px; border-bottom: 1px solid #f0f0f1; padding-bottom: 15px; margin-bottom: 15px; color: #1d2327; }
			.gravisain-status-list { list-style: none; padding: 0; margin: 0; }
			.gravisain-status-list li { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px dashed #e2e4e7; }
			.gravisain-status-list li:last-child { border-bottom: none; }
			.gravisain-status-label { font-weight: 600; color: #50575e; }
			.gravisain-input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #8c8f94; border-radius: 4px; box-sizing: border-box; }
			.gravisain-btn { background: #4f46e5; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; font-weight: 500; }
			.gravisain-btn:hover { background: #4338ca; color: white; }
			.gravisain-links a { display: block; margin-bottom: 10px; color: #4f46e5; text-decoration: none; font-weight: 500; }
			.gravisain-links a:hover { text-decoration: underline; color: #4338ca; }
			.gravisain-quick-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }
			.gravisain-quick-item { background: #f8fafc; border: 1px solid #e2e8f0; padding: 16px; border-radius: 6px; transition: all 0.2s ease; text-decoration: none; display: block; }
			.gravisain-quick-item:hover { background: #f1f5f9; border-color: #cbd5e1; transform: translateY(-2px); box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
			.gravisain-quick-title { font-weight: 600; font-size: 14px; color: #0f172a; margin-bottom: 4px; display: block; }
			.gravisain-quick-sub { font-size: 12px; color: #4f46e5; font-weight: 500; display: flex; align-items: center; gap: 4px; }
			@media (max-width: 768px) { .gravisain-quick-grid { grid-template-columns: 1fr; } }
		</style>
		<div class="wrap gravisain-wrap">
			<?php
			$display_name = 'Gravisain';
			$display_desc = __( 'The ultimate performance-first WordPress theme.', 'gravisain' );
			?>
			<div class="gravisain-header">
				<div>
					<h1><?php echo esc_html( sprintf( __( 'Welcome to %s', 'gravisain' ), $display_name ) ); ?> <span class="gravisain-badge">v<?php echo esc_html( defined( 'GRAVISAIN_VERSION' ) ? GRAVISAIN_VERSION : '1.0.0' ); ?></span></h1>
					<p style="color: #646970; font-size: 16px; margin-top: 5px;"><?php echo esc_html( $display_desc ); ?></p>
				</div>
				<div>
					<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="gravisain-btn"><?php esc_html_e( 'Open Customizer', 'gravisain' ); ?></a>
				</div>
			</div>

			<div class="gravisain-grid">
				<div class="gravisain-main">
					<?php do_action( 'gravisain_dashboard_main_top' ); ?>

					<div class="gravisain-card" style="margin-bottom: 20px;">
						<div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f0f0f1; padding-bottom: 15px; margin-bottom: 15px;">
							<h2 style="margin: 0; border: none; padding: 0;"><?php esc_html_e( 'Quick Settings', 'gravisain' ); ?></h2>
							<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" style="color: #4f46e5; text-decoration: none; font-weight: 600; font-size: 13px;"><?php esc_html_e( 'Go to Customizer ↗', 'gravisain' ); ?></a>
						</div>
						<div class="gravisain-quick-grid">
							<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=title_tagline' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title"><?php esc_html_e( 'Site Identity', 'gravisain' ); ?></span>
								<span class="gravisain-quick-sub"><?php esc_html_e( 'Customize ↗', 'gravisain' ); ?></span>
							</a>
							<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=gravisain_header_panel' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title"><?php esc_html_e( 'Header Builder', 'gravisain' ); ?></span>
								<span class="gravisain-quick-sub"><?php esc_html_e( 'Customize ↗', 'gravisain' ); ?></span>
							</a>
							<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=gravisain_colors' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title"><?php esc_html_e( 'Color Palette', 'gravisain' ); ?></span>
								<span class="gravisain-quick-sub"><?php esc_html_e( 'Customize ↗', 'gravisain' ); ?></span>
							</a>
							<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=gravisain_typography' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title"><?php esc_html_e( 'Typography', 'gravisain' ); ?></span>
								<span class="gravisain-quick-sub"><?php esc_html_e( 'Customize ↗', 'gravisain' ); ?></span>
							</a>
							<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=gravisain_layout' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title"><?php esc_html_e( 'Layout & Container', 'gravisain' ); ?></span>
								<span class="gravisain-quick-sub"><?php esc_html_e( 'Customize ↗', 'gravisain' ); ?></span>
							</a>
							<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=gravisain_blog_archive_section' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title"><?php esc_html_e( 'Blog Options', 'gravisain' ); ?></span>
								<span class="gravisain-quick-sub"><?php esc_html_e( 'Customize ↗', 'gravisain' ); ?></span>
							</a>
							<?php do_action( 'gravisain_dashboard_quick_items' ); ?>
							<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=gravisain_footer_panel' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title"><?php esc_html_e( 'Footer Builder', 'gravisain' ); ?></span>
								<span class="gravisain-quick-sub"><?php esc_html_e( 'Customize ↗', 'gravisain' ); ?></span>
							</a>
							<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=wp_block' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title"><?php esc_html_e( 'Synced Patterns', 'gravisain' ); ?></span>
								<span class="gravisain-quick-sub"><?php esc_html_e( 'Manage ↗', 'gravisain' ); ?></span>
							</a>
						</div>
					</div>

					<?php do_action( 'gravisain_dashboard_main_bottom' ); ?>

					<div class="gravisain-card">
						<h2><?php esc_html_e( 'Quick Links & Resources', 'gravisain' ); ?></h2>
						<div class="gravisain-links">
							<a href="<?php echo esc_url( 'https://undagital.com/' ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Theme Homepage & Documentation ↗', 'gravisain' ); ?></a>
							<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=gravisain_performance' ) ); ?>"><?php esc_html_e( 'Performance & GDPR Font Settings ↗', 'gravisain' ); ?></a>
							<a href="<?php echo esc_url( admin_url( 'themes.php?page=gravisain-system-status' ) ); ?>"><?php esc_html_e( 'System Status & Diagnostics ↗', 'gravisain' ); ?></a>
						</div>
					</div>
				</div>

				<div class="gravisain-sidebar">
					<div class="gravisain-card">
						<h2><?php esc_html_e( 'System Status', 'gravisain' ); ?></h2>
						<ul class="gravisain-status-list">
							<?php foreach ( $status as $label => $value ) : ?>
								<li>
									<span class="gravisain-status-label"><?php echo esc_html( $label ); ?></span>
									<span class="gravisain-status-value"><?php echo esc_html( $value ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
						<a href="<?php echo esc_url( admin_url( 'themes.php?page=gravisain-system-status' ) ); ?>" style="display: block; margin-top: 14px; font-size: 13px; font-weight: 600; color: #4f46e5; text-decoration: none;"><?php esc_html_e( 'View Full Diagnostics Report ↗', 'gravisain' ); ?></a>
					</div>
					<div class="gravisain-card" style="margin-top: 20px;">
						<h2><?php esc_html_e( 'Performance Cache', 'gravisain' ); ?></h2>
						<p style="color: #50575e; margin-bottom: 15px; font-size: 13px;"><?php esc_html_e( 'Purge local Google Fonts and Dynamic CSS file cache.', 'gravisain' ); ?></p>
						<button type="button" id="gravisain-purge-cache-btn" class="gravisain-btn" style="width: 100%;"><?php esc_html_e( 'Purge Cache', 'gravisain' ); ?></button>
						<span id="gravisain-purge-status" style="display: block; margin-top: 10px; font-size: 12px; font-weight: 600;"></span>
					</div>
				</div>
			</div>
		</div>
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			const purgeBtn = document.getElementById('gravisain-purge-cache-btn');
			const statusSpan = document.getElementById('gravisain-purge-status');
			if (purgeBtn) {
				purgeBtn.addEventListener('click', function() {
					purgeBtn.disabled = true;
					purgeBtn.textContent = '<?php echo esc_js( __( 'Purging...', 'gravisain' ) ); ?>';
					statusSpan.textContent = '';

					const formData = new FormData();
					formData.append('action', 'gravisain_purge_cache');
					formData.append('nonce', '<?php echo esc_js( wp_create_nonce( 'gravisain_purge_cache' ) ); ?>');

					fetch(ajaxurl, {
						method: 'POST',
						body: formData
					})
					.then(response => response.json())
					.then(data => {
						purgeBtn.disabled = false;
						purgeBtn.textContent = '<?php echo esc_js( __( 'Purge Cache', 'gravisain' ) ); ?>';
						if (data.success) {
							statusSpan.style.color = '#16a34a';
							statusSpan.textContent = '✓ ' + data.data.message;
						} else {
							statusSpan.style.color = '#dc2626';
							statusSpan.textContent = '✕ ' + (data.data.message || '<?php echo esc_js( __( 'Error', 'gravisain' ) ); ?>');
						}
					})
					.catch(err => {
						purgeBtn.disabled = false;
						purgeBtn.textContent = '<?php echo esc_js( __( 'Purge Cache', 'gravisain' ) ); ?>';
						statusSpan.style.color = '#dc2626';
						statusSpan.textContent = '✕ <?php echo esc_js( __( 'Network error.', 'gravisain' ) ); ?>';
					});
				});
			}
		});
		</script>
		<?php
	}
}
