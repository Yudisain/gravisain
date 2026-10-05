<?php
/**
 * Theme Dashboard Welcome Page
 *
 * @package Gravisain\Dashboard
 */

namespace Gravisain\Dashboard;

class Welcome {
	public static function init(): void {
		$instance = new self();
		add_action( 'admin_menu', [ $instance, 'add_menu_page' ] );
		add_action( 'wp_ajax_gravisain_purge_cache', [ $instance, 'ajax_purge_cache' ] );
		add_filter( 'parent_file', [ $instance, 'filter_parent_file' ] );
		add_filter( 'submenu_file', [ $instance, 'filter_submenu_file' ] );
	}

	/**
	 * Keep Gravisain menu active when viewing or editing Reusable Blocks (wp_block).
	 *
	 * @param string $parent_file
	 * @return string
	 */
	public function filter_parent_file( string $parent_file ): string {
		global $current_screen;
		if ( $current_screen && 'wp_block' === $current_screen->post_type ) {
			return 'gravisain-dashboard';
		}
		return $parent_file;
	}

	/**
	 * Keep Reusable Blocks submenu active when viewing or editing Reusable Blocks (wp_block).
	 *
	 * @param string|null $submenu_file
	 * @return string|null
	 */
	public function filter_submenu_file( ?string $submenu_file ): ?string {
		global $current_screen;
		if ( $current_screen && 'wp_block' === $current_screen->post_type ) {
			return 'edit.php?post_type=wp_block';
		}
		return $submenu_file;
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
		$menu_label  = 'Gravisain';
		$page_title  = 'Gravisain Dashboard';

		// Custom SVG Icon for Gravisain (Custom Diamond GRV Monogram)
		$svg_icon = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBmaWxsPSJub25lIiBzdHJva2U9IiNmZmYiIHN0cm9rZS13aWR0aD0iMzAiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+CiAgPHBhdGggZD0ibTI1NiA0OCAxNjQgMTUyTTI1NiA0OCA5MiAxOTJtMCA5NiAxNjQgMTc2bTE2NC0xNzZMMjU2IDQ2NE05MiAxOTJsMTY0IDE0NG0tOTYtMTMxaDI2MG0tMTY0IDB2MTI1bTI5LTEyNSAxMDAgMTEzIi8+Cjwvc3ZnPg==';

		// 1. Register Top-Level Menu (Position 59 sets it right above Appearance which is 60)
		add_menu_page(
			$page_title,
			$menu_label,
			'manage_options',
			'gravisain-dashboard',
			[ $this, 'render_page' ],
			$svg_icon,
			59
		);

		// 2. Rename the first default submenu item to "Dashboard"
		add_submenu_page(
			'gravisain-dashboard',
			'Gravisain Dashboard',
			'Dashboard',
			'manage_options',
			'gravisain-dashboard',
			[ $this, 'render_page' ]
		);

		// 3. Direct shortcut to Customizer
		add_submenu_page(
			'gravisain-dashboard',
			'Customize Theme',
			'Customize',
			'manage_options',
			'customize.php',
			null
		);

		// 4. Direct shortcut to Header Builder
		add_submenu_page(
			'gravisain-dashboard',
			'Header Builder',
			'Header Builder',
			'manage_options',
			'customize.php?autofocus[panel]=gravisain_header_panel',
			null
		);

		// 5. Reusable Blocks (Synced Patterns)
		add_submenu_page(
			'gravisain-dashboard',
			__( 'Reusable Blocks', 'gravisain' ),
			__( 'Reusable Blocks', 'gravisain' ),
			'edit_posts',
			'edit.php?post_type=wp_block',
			null
		);

		// 6. Full System Status & Diagnostics Tab
		add_submenu_page(
			'gravisain-dashboard',
			'System Status & Diagnostics',
			'System Status',
			'manage_options',
			'gravisain-system-status',
			[ '\Gravisain\Dashboard\SystemStatus', 'render_page' ]
		);

		// 7. Import / Export
		add_submenu_page(
			'gravisain-dashboard',
			'Import / Export Settings',
			'Import / Export',
			'manage_options',
			'gravisain-import-export',
			[ '\Gravisain\Dashboard\ImportExport', 'render_page' ]
		);
	}

	private function get_system_status(): array {
		return [
			'WP Version'   => get_bloginfo( 'version' ),
			'PHP Version'  => phpversion(),
			'Memory Limit' => WP_MEMORY_LIMIT,
			'Max Exec Time'=> ini_get('max_execution_time') . 's',
			'Debug Mode'   => defined('WP_DEBUG') && WP_DEBUG ? 'Enabled' : 'Disabled',
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
					<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="gravisain-btn">Open Customizer</a>
				</div>
			</div>

			<div class="gravisain-grid">
				<div class="gravisain-main">
					<?php
					$is_active = \Gravisain\License\LicenseManager::is_active();
					$license_key = \Gravisain\License\LicenseManager::get_license_key();
					?>
					<div class="gravisain-card" style="margin-bottom: 20px;">
						<h2>License Activation</h2>
						<p style="color: #50575e; margin-bottom: 15px;">Activate your license key to receive automatic updates and premium support.</p>
						
						<div id="gravisain-license-status" style="margin-bottom: 15px; font-weight: bold; <?php echo $is_active ? 'color: #16a34a;' : 'display: none;'; ?>">
							✓ License is Active
						</div>

						<form id="gravisain-license-form" method="post" action="">
							<input type="password" id="gravisain-license-key" class="gravisain-input" placeholder="Enter your license key here..." value="<?php echo esc_attr($is_active ? '****************' : $license_key); ?>" <?php echo $is_active ? 'disabled' : ''; ?>>
							
							<?php if ( $is_active ) : ?>
								<button type="button" id="gravisain-deactivate-btn" class="gravisain-btn" style="background: #dc2626;">Deactivate License</button>
							<?php else : ?>
								<button type="button" id="gravisain-activate-btn" class="gravisain-btn">Activate License</button>
							<?php endif; ?>
							
							<span id="gravisain-license-msg" style="display: block; margin-top: 10px; font-size: 13px;"></span>
						</form>
					</div>

					<div class="gravisain-card" style="margin-bottom: 20px;">
						<div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f0f0f1; padding-bottom: 15px; margin-bottom: 15px;">
							<h2 style="margin: 0; border: none; padding: 0;">Quick Settings</h2>
							<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" style="color: #4f46e5; text-decoration: none; font-weight: 600; font-size: 13px;">Go to Customizer ↗</a>
						</div>
						<div class="gravisain-quick-grid">
							<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=title_tagline' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title">Site Identity</span>
								<span class="gravisain-quick-sub">Customize ↗</span>
							</a>
							<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=gravisain_header_panel' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title">Header Builder</span>
								<span class="gravisain-quick-sub">Customize ↗</span>
							</a>
							<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=gravisain_colors' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title">Color Palette</span>
								<span class="gravisain-quick-sub">Customize ↗</span>
							</a>
							<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=gravisain_typography' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title">Typography</span>
								<span class="gravisain-quick-sub">Customize ↗</span>
							</a>
							<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=gravisain_layout' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title">Layout & Container</span>
								<span class="gravisain-quick-sub">Customize ↗</span>
							</a>
							<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=gravisain_blog_archive_section' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title">Blog Options</span>
								<span class="gravisain-quick-sub">Customize ↗</span>
							</a>
							<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=gravisain_element' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title">Hooked Elements</span>
								<span class="gravisain-quick-sub">Manage ↗</span>
							</a>
							<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=wp_block' ) ); ?>" class="gravisain-quick-item">
								<span class="gravisain-quick-title"><?php esc_html_e( 'Reusable Blocks', 'gravisain' ); ?></span>
								<span class="gravisain-quick-sub"><?php esc_html_e( 'Manage ↗', 'gravisain' ); ?></span>
							</a>
						</div>
					</div>

					<div class="gravisain-card" style="margin-bottom: 20px;">
						<h2>Official Companion Plugins</h2>
						<p style="color: #50575e; margin-bottom: 15px;">Extend Gravisain with standalone modular extensions for Gutenberg patterns and demo templates.</p>
						<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
							<?php
							$blocks_active        = class_exists( '\\Gravisain\\Blocks\\Plugin' );
							$starter_sites_active = class_exists( '\\Gravisain\\Companion\\Plugin' );
							?>
							<div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 16px; border-radius: 6px;">
								<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
									<strong style="color: #0f172a; font-size: 14px;">Gravisain Blocks</strong>
									<?php if ( $blocks_active ) : ?>
										<span style="background: #dcfce7; color: #166534; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 12px;">ACTIVE</span>
									<?php else : ?>
										<span style="background: #f1f5f9; color: #64748b; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 12px;">NOT INSTALLED</span>
									<?php endif; ?>
								</div>
								<p style="font-size: 12px; color: #64748b; margin: 0 0 12px 0; line-height: 1.5;">Official Gutenberg Block Patterns (Heroes, Feature Grids, Pricing, CTAs, FAQ) & Block Styles.</p>
								<a href="<?php echo esc_url( admin_url( 'plugins.php' ) ); ?>" style="font-size: 12px; font-weight: 600; color: #4f46e5; text-decoration: none;">Manage Plugin →</a>
							</div>

							<div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 16px; border-radius: 6px;">
								<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
									<strong style="color: #0f172a; font-size: 14px;">Gravisain Starter Sites</strong>
									<?php if ( $starter_sites_active ) : ?>
										<span style="background: #dcfce7; color: #166534; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 12px;">ACTIVE</span>
									<?php else : ?>
										<span style="background: #f1f5f9; color: #64748b; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 12px;">NOT INSTALLED</span>
									<?php endif; ?>
								</div>
								<p style="font-size: 12px; color: #64748b; margin: 0 0 12px 0; line-height: 1.5;">1-Click Demo Importer with Agency, Logistics, & Gravitour Travel starter sites.</p>
								<?php if ( $starter_sites_active ) : ?>
									<a href="<?php echo esc_url( admin_url( 'admin.php?page=gravisain-starter-sites' ) ); ?>" style="font-size: 12px; font-weight: 600; color: #4f46e5; text-decoration: none;">Open Importer →</a>
								<?php else : ?>
									<a href="<?php echo esc_url( admin_url( 'plugins.php' ) ); ?>" style="font-size: 12px; font-weight: 600; color: #4f46e5; text-decoration: none;">Manage Plugin →</a>
								<?php endif; ?>
							</div>
						</div>
					</div>

					<div class="gravisain-card">
						<h2>Quick Links & Support</h2>
						<div class="gravisain-links">
							<a href="#">📚 Read Documentation</a>
							<a href="#">💬 Community Forum</a>
							<a href="#">🐛 Report a Bug</a>
						</div>
					</div>
				</div>

				<div class="gravisain-sidebar">
					<div class="gravisain-card">
						<h2>System Status</h2>
						<ul class="gravisain-status-list">
							<?php foreach ( $status as $label => $value ) : ?>
								<li>
									<span class="gravisain-status-label"><?php echo esc_html( $label ); ?></span>
									<span class="gravisain-status-value"><?php echo esc_html( $value ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=gravisain-system-status' ) ); ?>" style="display: block; margin-top: 14px; font-size: 13px; font-weight: 600; color: #4f46e5; text-decoration: none;">View Full Diagnostics Report ↗</a>
					</div>
					<div class="gravisain-card" style="margin-top: 20px;">
						<h2>Performance Cache</h2>
						<p style="color: #50575e; margin-bottom: 15px; font-size: 13px;">Purge local Google Fonts and Dynamic CSS file cache.</p>
						<button type="button" id="gravisain-purge-cache-btn" class="gravisain-btn" style="width: 100%;">Purge Cache</button>
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
					purgeBtn.textContent = 'Purging...';
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
						purgeBtn.textContent = 'Purge Cache';
						if (data.success) {
							statusSpan.style.color = '#16a34a';
							statusSpan.textContent = '✓ ' + data.data.message;
						} else {
							statusSpan.style.color = '#dc2626';
							statusSpan.textContent = '✕ ' + (data.data.message || 'Error');
						}
					})
					.catch(err => {
						purgeBtn.disabled = false;
						purgeBtn.textContent = 'Purge Cache';
						statusSpan.style.color = '#dc2626';
						statusSpan.textContent = '✕ Network error.';
					});
				});
			}

			// License Activation
			const activateBtn = document.getElementById('gravisain-activate-btn');
			const deactivateBtn = document.getElementById('gravisain-deactivate-btn');
			const licenseMsg = document.getElementById('gravisain-license-msg');
			const licenseInput = document.getElementById('gravisain-license-key');

			if (activateBtn) {
				activateBtn.addEventListener('click', function() {
					const key = licenseInput.value.trim();
					if (!key) {
						licenseMsg.style.color = '#dc2626';
						licenseMsg.textContent = '✕ Please enter a license key.';
						return;
					}

					activateBtn.disabled = true;
					activateBtn.textContent = 'Activating...';
					licenseMsg.textContent = '';

					const formData = new FormData();
					formData.append('action', 'gravisain_activate_license');
					formData.append('license_key', key);
					formData.append('nonce', '<?php echo esc_js( wp_create_nonce( 'gravisain_license_nonce' ) ); ?>');

					fetch(ajaxurl, {
						method: 'POST',
						body: formData
					})
					.then(response => response.json())
					.then(data => {
						if (data.success) {
							licenseMsg.style.color = '#16a34a';
							licenseMsg.textContent = '✓ ' + data.data.message;
							setTimeout(() => location.reload(), 1500);
						} else {
							activateBtn.disabled = false;
							activateBtn.textContent = 'Activate License';
							licenseMsg.style.color = '#dc2626';
							licenseMsg.textContent = '✕ ' + (data.data.message || 'Activation failed.');
						}
					})
					.catch(err => {
						activateBtn.disabled = false;
						activateBtn.textContent = 'Activate License';
						licenseMsg.style.color = '#dc2626';
						licenseMsg.textContent = '✕ Network error.';
					});
				});
			}

			if (deactivateBtn) {
				deactivateBtn.addEventListener('click', function() {
					if (!confirm('Are you sure you want to deactivate this license? Premium features will be disabled.')) return;

					deactivateBtn.disabled = true;
					deactivateBtn.textContent = 'Deactivating...';
					licenseMsg.textContent = '';

					const formData = new FormData();
					formData.append('action', 'gravisain_deactivate_license');
					formData.append('nonce', '<?php echo esc_js( wp_create_nonce( 'gravisain_license_nonce' ) ); ?>');

					fetch(ajaxurl, {
						method: 'POST',
						body: formData
					})
					.then(response => response.json())
					.then(data => {
						if (data.success) {
							licenseMsg.style.color = '#16a34a';
							licenseMsg.textContent = '✓ ' + data.data.message;
							setTimeout(() => location.reload(), 1500);
						} else {
							deactivateBtn.disabled = false;
							deactivateBtn.textContent = 'Deactivate License';
							licenseMsg.style.color = '#dc2626';
							licenseMsg.textContent = '✕ ' + (data.data.message || 'Deactivation failed.');
						}
					})
					.catch(err => {
						deactivateBtn.disabled = false;
						deactivateBtn.textContent = 'Deactivate License';
						licenseMsg.style.color = '#dc2626';
						licenseMsg.textContent = '✕ Network error.';
					});
				});
			}
		});
		</script>
		<?php
	}
}
