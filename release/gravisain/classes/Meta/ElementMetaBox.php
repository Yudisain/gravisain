<?php
/**
 * Element Meta Box
 *
 * @package Gravisain\Meta
 */

declare(strict_types=1);

namespace Gravisain\Meta;

/**
 * Element Meta Box Class
 * 
 * Registers and handles the metaboxes for Hooked Elements.
 */
class ElementMetaBox {

	/**
	 * Initialize the Meta Box service.
	 *
	 * @return void
	 */
	public static function init(): void {
		$instance = new self();
		add_action( 'add_meta_boxes', [ $instance, 'register_meta_boxes' ] );
		add_action( 'save_post_gravisain_element', [ $instance, 'save_meta_boxes' ] );
	}

	/**
	 * Register the metabox on the Hooked Elements editor.
	 *
	 * @return void
	 */
	public function register_meta_boxes(): void {
		add_meta_box(
			'gravisain_element_settings',
			__( 'Element Settings', 'gravisain' ),
			[ $this, 'render_meta_box' ],
			'gravisain_element',
			'side',
			'high'
		);
	}

	/**
	 * Render the metabox HTML interface.
	 *
	 * @param \WP_Post $post Current post object.
	 * @return void
	 */
	public function render_meta_box( \WP_Post $post ): void {
		wp_nonce_field( 'gravisain_element_meta_nonce', 'gravisain_element_meta_nonce' );

		$hook           = get_post_meta( $post->ID, '_gravisain_element_hook', true );
		$priority       = get_post_meta( $post->ID, '_gravisain_element_priority', true );
		$display_rule   = get_post_meta( $post->ID, '_gravisain_element_display_rule', true );
		$user_condition = get_post_meta( $post->ID, '_gravisain_element_user_condition', true );

		$priority = ! empty( $priority ) ? $priority : '10';

		$hooks = apply_filters( 'gravisain_element_hooks', [
			'wp_head'                  => 'wp_head (Inside <head>)',
			'wp_body_open'             => 'wp_body_open (After <body>)',
			'gravisain_before_header'  => 'Before Header',
			'gravisain_after_header'   => 'After Header',
			'gravisain_before_content' => 'Before Content',
			'gravisain_after_content'  => 'After Content',
			'gravisain_before_footer'  => 'Before Footer',
			'gravisain_after_footer'   => 'After Footer',
			'wp_footer'                => 'wp_footer (Before </body>)',
		] );

		$display_rules = apply_filters( 'gravisain_element_display_rules', [
			'entire_website' => 'Entire Website',
			'front_page'     => 'Front Page',
			'single_post'    => 'Single Post',
			'single_page'    => 'Single Page',
			'archive'        => 'Archive / Blog',
			'404'            => '404 Page',
		] );

		$user_conditions = apply_filters( 'gravisain_element_user_conditions', [
			'all'        => 'All Users',
			'logged_in'  => 'Logged-in Only',
			'logged_out' => 'Logged-out Only',
		] );
		?>
		<style>
			.gravisain-element-meta { padding: 10px 0; }
			.gravisain-element-field { margin-bottom: 20px; }
			.gravisain-element-field label { display: block; font-weight: 600; margin-bottom: 8px; color: #1d2327; }
			.gravisain-element-field select, .gravisain-element-field input { width: 100%; box-sizing: border-box; max-width: 400px; }
		</style>
		<div class="gravisain-element-meta">
			<div class="gravisain-element-field">
				<label for="gravisain_element_hook"><?php esc_html_e( 'Action Hook Location', 'gravisain' ); ?></label>
				<select name="gravisain_element_hook" id="gravisain_element_hook">
					<option value=""><?php esc_html_e( '— Select Hook —', 'gravisain' ); ?></option>
					<?php foreach ( $hooks as $value => $label ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $hook, $value ); ?>>
							<?php echo esc_html( $label ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			
			<div class="gravisain-element-field">
				<label for="gravisain_element_priority"><?php esc_html_e( 'Priority', 'gravisain' ); ?></label>
				<input type="number" name="gravisain_element_priority" id="gravisain_element_priority" value="<?php echo esc_attr( $priority ); ?>" min="1" max="999">
				<p class="description"><?php esc_html_e( 'Lower numbers execute earlier. Default is 10.', 'gravisain' ); ?></p>
			</div>

			<div class="gravisain-element-field">
				<label for="gravisain_element_display_rule"><?php esc_html_e( 'Display Rule', 'gravisain' ); ?></label>
				<select name="gravisain_element_display_rule" id="gravisain_element_display_rule">
					<?php foreach ( $display_rules as $value => $label ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $display_rule, $value ); ?>>
							<?php echo esc_html( $label ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="gravisain-element-field">
				<label for="gravisain_element_user_condition"><?php esc_html_e( 'User Condition', 'gravisain' ); ?></label>
				<select name="gravisain_element_user_condition" id="gravisain_element_user_condition">
					<?php foreach ( $user_conditions as $value => $label ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $user_condition, $value ); ?>>
							<?php echo esc_html( $label ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<?php
	}

	/**
	 * Save the metabox data when the post is saved.
	 *
	 * @param int $post_id Post ID being saved.
	 * @return void
	 */
	public function save_meta_boxes( int $post_id ): void {
		if ( ! isset( $_POST['gravisain_element_meta_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['gravisain_element_meta_nonce'] ) ), 'gravisain_element_meta_nonce' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

		$fields = [
			'gravisain_element_hook',
			'gravisain_element_priority',
			'gravisain_element_display_rule',
			'gravisain_element_user_condition',
		];

		foreach ( $fields as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_post_meta( $post_id, '_' . $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
			}
		}
	}
}
