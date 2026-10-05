<?php
/**
 * System Status & Diagnostics Page
 *
 * @package Gravisain\Dashboard
 */

namespace Gravisain\Dashboard;

/**
 * SystemStatus Class
 *
 * Collects diagnostic info on server, WordPress, and theme environment
 * and renders an interactive admin page with one-click report copying.
 */
class SystemStatus {

	/**
	 * Get comprehensive diagnostic report grouped by category.
	 *
	 * @return array
	 */
	public static function get_environment_report(): array {
		$wp_upload_dir = wp_upload_dir();
		$fonts_dir     = trailingslashit( $wp_upload_dir['basedir'] ) . 'gravisain/fonts';
		$css_dir       = trailingslashit( $wp_upload_dir['basedir'] ) . 'gravisain';

		return [
			'WordPress Environment' => [
				'WordPress Version' => get_bloginfo( 'version' ),
				'Site URL'          => get_option( 'siteurl' ),
				'Home URL'          => home_url(),
				'WP Debug Mode'     => defined( 'WP_DEBUG' ) && WP_DEBUG ? 'Enabled' : 'Disabled',
				'WP Multisite'      => is_multisite() ? 'Yes' : 'No',
				'Permalink Structure' => get_option( 'permalink_structure' ) ?: 'Default',
				'Language'          => get_locale(),
			],
			'Server Environment'    => [
				'PHP Version'       => phpversion(),
				'PHP Memory Limit'  => ini_get( 'memory_limit' ) ?: WP_MEMORY_LIMIT,
				'Max Execution Time'=> ini_get( 'max_execution_time' ) . ' seconds',
				'Max Input Vars'    => ini_get( 'max_input_vars' ) ?: 'Not set',
				'cURL Support'      => function_exists( 'curl_version' ) ? 'Enabled' : 'Disabled',
				'GD Library Support'=> extension_loaded( 'gd' ) ? 'Enabled' : 'Disabled',
				'mbstring Extension'=> extension_loaded( 'mbstring' ) ? 'Enabled' : 'Disabled',
				'OPcache Status'    => function_exists( 'opcache_get_status' ) && @opcache_get_status( false ) ? 'Enabled' : 'Disabled',
			],
			'Gravisain Theme Status'=> [
				'Theme Name'        => 'Gravisain',
				'Theme Version'     => defined( 'GRAVISAIN_VERSION' ) ? GRAVISAIN_VERSION : '1.0.0',
				'CSS Cache Writable'=> wp_is_writable( $css_dir ) || wp_is_writable( $wp_upload_dir['basedir'] ) ? 'Yes' : 'No',
				'Font Cache Writable'=> wp_is_writable( $fonts_dir ) || wp_is_writable( $wp_upload_dir['basedir'] ) ? 'Yes' : 'No',
				'Active Plugins'    => count( (array) get_option( 'active_plugins', [] ) ),
			],
		];
	}

	/**
	 * Generate plaintext markdown report for clipboard copying.
	 *
	 * @param array $report Structured report data.
	 * @return string
	 */
	public static function generate_plaintext_report( array $report ): string {
		$output = "### GRAVISAIN SYSTEM STATUS REPORT ###\n\n";
		foreach ( $report as $section => $data ) {
			$output .= "## {$section}\n";
			foreach ( $data as $label => $value ) {
				$output .= sprintf( "%-22s : %s\n", $label, $value );
			}
			$output .= "\n";
		}
		return trim( $output );
	}

	/**
	 * Render System Status Admin Tab UI.
	 */
	public static function render_page(): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'gravisain' ) );
		}

		$report    = self::get_environment_report();
		$plaintext = self::generate_plaintext_report( $report );
		?>
		<style>
			.gravisain-wrap { max-width: 1080px; margin-top: 20px; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif; }
			.gravisain-header { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
			.gravisain-header h1 { margin: 0; font-size: 28px; font-weight: 600; color: #1e1e1e; }
			.gravisain-badge { background: #4f46e5; color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; }
			.gravisain-card { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 20px; }
			.gravisain-card h2 { margin-top: 0; font-size: 18px; border-bottom: 1px solid #f0f0f1; padding-bottom: 15px; margin-bottom: 15px; color: #1d2327; }
			.gravisain-diag-table { width: 100%; border-collapse: collapse; }
			.gravisain-diag-table th, .gravisain-diag-table td { padding: 12px 14px; text-align: left; border-bottom: 1px solid #f1f5f9; }
			.gravisain-diag-table th { width: 35%; font-weight: 600; color: #475569; background: #f8fafc; }
			.gravisain-diag-table td { color: #0f172a; }
			.gravisain-status-ok { color: #16a34a; font-weight: 600; }
			.gravisain-btn { background: #4f46e5; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; font-weight: 500; }
			.gravisain-btn:hover { background: #4338ca; color: white; }
		</style>
		<div class="wrap gravisain-wrap">
			<div class="gravisain-header">
				<div>
					<h1>System Status & Diagnostics <span class="gravisain-badge">Gravisain v<?php echo esc_html( defined( 'GRAVISAIN_VERSION' ) ? GRAVISAIN_VERSION : '1.0.0' ); ?></span></h1>
					<p style="color: #646970; font-size: 16px; margin-top: 5px;">Inspect server readiness, WordPress environment, and filesystem permissions.</p>
				</div>
				<div>
					<button type="button" id="gravisain-copy-report-btn" class="gravisain-btn">Copy System Report</button>
					<span id="gravisain-copy-status" style="margin-left: 10px; font-size: 13px; font-weight: 600;"></span>
				</div>
			</div>

			<textarea id="gravisain-report-data" style="position: absolute; left: -9999px; opacity: 0;" readonly><?php echo esc_textarea( $plaintext ); ?></textarea>

			<?php foreach ( $report as $section_title => $items ) : ?>
				<div class="gravisain-card">
					<h2><?php echo esc_html( $section_title ); ?></h2>
					<table class="gravisain-diag-table">
						<tbody>
							<?php foreach ( $items as $label => $value ) : ?>
								<tr>
									<th><?php echo esc_html( $label ); ?></th>
									<td>
										<?php
										if ( in_array( $value, [ 'Enabled', 'Yes' ], true ) ) {
											echo '<span class="gravisain-status-ok">✓ ' . esc_html( $value ) . '</span>';
										} else {
											echo esc_html( $value );
										}
										?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			<?php endforeach; ?>
		</div>
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			const copyBtn = document.getElementById('gravisain-copy-report-btn');
			const copyStatus = document.getElementById('gravisain-copy-status');
			const reportArea = document.getElementById('gravisain-report-data');

			if (copyBtn && reportArea) {
				copyBtn.addEventListener('click', function() {
					reportArea.select();
					try {
						if (navigator.clipboard && navigator.clipboard.writeText) {
							navigator.clipboard.writeText(reportArea.value);
						} else {
							document.execCommand('copy');
						}
						copyStatus.style.color = '#16a34a';
						copyStatus.textContent = '✓ Copied to clipboard!';
						setTimeout(() => { copyStatus.textContent = ''; }, 3000);
					} catch (e) {
						copyStatus.style.color = '#dc2626';
						copyStatus.textContent = 'Failed to copy';
					}
				});
			}
		});
		</script>
		<?php
	}
}
