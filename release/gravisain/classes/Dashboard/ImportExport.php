<?php
/**
 * Theme Dashboard Import/Export Settings
 *
 * @package Gravisain\Dashboard
 */

namespace Gravisain\Dashboard;

class ImportExport {

	public static function init(): void {
		$instance = new self();
		add_action( 'admin_init', [ $instance, 'handle_export' ] );
		add_action( 'admin_init', [ $instance, 'handle_import' ] );
	}

	public function handle_export(): void {
		if ( ! isset( $_POST['gravisain_export_settings'] ) || ! isset( $_POST['gravisain_export_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['gravisain_export_nonce'] ) ), 'gravisain_export' ) ) {
			wp_die( esc_html__( 'Invalid nonce. Please try again.', 'gravisain' ) );
		}

		if ( ! current_user_can( 'edit_theme_options' ) ) {
			wp_die( esc_html__( 'Unauthorized access.', 'gravisain' ) );
		}

		$theme_slug = get_option( 'stylesheet' );
		$theme_mods = get_option( "theme_mods_{$theme_slug}" );

		if ( ! $theme_mods ) {
			$theme_mods = [];
		}

		// Clean up transients or unwanted mods if needed
		unset( $theme_mods['nav_menu_locations'] );
		unset( $theme_mods['custom_css_post_id'] );

		$json_data = wp_json_encode( $theme_mods, JSON_PRETTY_PRINT );
		$filename  = 'gravisain-settings-' . date( 'Y-m-d-H-i-s' ) . '.json';

		// Clean output buffer to ensure valid JSON download
		if ( ob_get_length() ) {
			ob_end_clean();
		}

		header( 'Content-Description: File Transfer' );
		header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
		header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
		header( 'Expires: 0' );
		header( 'Cache-Control: must-revalidate' );
		header( 'Pragma: public' );
		header( 'Content-Length: ' . strlen( $json_data ) );

		echo $json_data;
		exit;
	}

	public function handle_import(): void {
		if ( ! isset( $_POST['gravisain_import_settings'] ) || ! isset( $_POST['gravisain_import_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['gravisain_import_nonce'] ) ), 'gravisain_import' ) ) {
			add_settings_error( 'gravisain_import', 'invalid_nonce', __( 'Invalid nonce. Please try again.', 'gravisain' ), 'error' );
			return;
		}

		if ( ! current_user_can( 'edit_theme_options' ) ) {
			add_settings_error( 'gravisain_import', 'unauthorized', __( 'Unauthorized access.', 'gravisain' ), 'error' );
			return;
		}

		if ( empty( $_FILES['import_file']['tmp_name'] ) ) {
			add_settings_error( 'gravisain_import', 'no_file', __( 'Please select a file to import.', 'gravisain' ), 'error' );
			return;
		}

		$file_content = file_get_contents( $_FILES['import_file']['tmp_name'] );
		$theme_mods   = json_decode( $file_content, true );

		if ( json_last_error() !== JSON_ERROR_NONE || ! is_array( $theme_mods ) ) {
			add_settings_error( 'gravisain_import', 'invalid_file', __( 'Invalid JSON file format.', 'gravisain' ), 'error' );
			return;
		}

		foreach ( $theme_mods as $key => $value ) {
			set_theme_mod( $key, $value );
		}

		// Trigger hook to clear CSS cache if needed.
		do_action( 'gravisain_after_import_settings' );
		\Gravisain\CSS\CSSFileCache::clear_cache();

		add_settings_error( 'gravisain_import', 'success', __( 'Settings imported successfully!', 'gravisain' ), 'success' );
	}

	public static function render_page(): void {
		?>
		<style>
			.gravisain-wrap { max-width: 1080px; margin-top: 20px; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif; }
			.gravisain-header { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
			.gravisain-header h1 { margin: 0; font-size: 28px; font-weight: 600; color: #1e1e1e; }
			.gravisain-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
			.gravisain-card { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
			.gravisain-card h2 { margin-top: 0; font-size: 18px; border-bottom: 1px solid #f0f0f1; padding-bottom: 15px; margin-bottom: 15px; color: #1d2327; }
			.gravisain-btn { background: #4f46e5; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; font-weight: 500; font-size: 14px; }
			.gravisain-btn:hover { background: #4338ca; color: white; }
			.gravisain-btn-outline { background: transparent; color: #4f46e5; border: 1px solid #4f46e5; padding: 9px 19px; border-radius: 4px; cursor: pointer; display: inline-block; font-weight: 500; font-size: 14px; }
			.gravisain-btn-outline:hover { background: #f8fafc; }
			.gravisain-input-file { margin-bottom: 15px; display: block; }
			@media (max-width: 768px) { .gravisain-grid { grid-template-columns: 1fr; } }
		</style>
		<div class="wrap gravisain-wrap">
			<div class="gravisain-header">
				<div>
					<h1><?php esc_html_e( 'Import / Export Settings', 'gravisain' ); ?></h1>
					<p style="color: #646970; font-size: 16px; margin-top: 5px;"><?php esc_html_e( 'Backup or restore your Customizer settings.', 'gravisain' ); ?></p>
				</div>
			</div>

			<?php settings_errors( 'gravisain_import' ); ?>

			<div class="gravisain-grid">
				<div class="gravisain-card">
					<h2><?php esc_html_e( 'Export Settings', 'gravisain' ); ?></h2>
					<p style="color: #50575e; margin-bottom: 20px; line-height: 1.5;">
						<?php esc_html_e( 'Click the button below to download your current Customizer settings as a JSON file. This is useful for creating a backup before making major changes or for moving your design to another Gravisain-powered website.', 'gravisain' ); ?>
					</p>
					<form method="post" action="">
						<?php wp_nonce_field( 'gravisain_export', 'gravisain_export_nonce' ); ?>
						<input type="hidden" name="gravisain_export_settings" value="1">
						<button type="submit" class="gravisain-btn"><?php esc_html_e( 'Export to JSON', 'gravisain' ); ?></button>
					</form>
				</div>

				<div class="gravisain-card">
					<h2><?php esc_html_e( 'Import Settings', 'gravisain' ); ?></h2>
					<p style="color: #50575e; margin-bottom: 20px; line-height: 1.5;">
						<?php esc_html_e( 'Upload a valid JSON file generated by Gravisain to restore settings. Please note that importing settings will overwrite your current Customizer configuration.', 'gravisain' ); ?>
					</p>
					<form method="post" action="" enctype="multipart/form-data">
						<?php wp_nonce_field( 'gravisain_import', 'gravisain_import_nonce' ); ?>
						<input type="hidden" name="gravisain_import_settings" value="1">
						<input type="file" name="import_file" accept=".json" class="gravisain-input-file" required>
						<button type="submit" class="gravisain-btn-outline"><?php esc_html_e( 'Import Settings', 'gravisain' ); ?></button>
					</form>
				</div>
			</div>
		</div>
		<?php
	}
}
