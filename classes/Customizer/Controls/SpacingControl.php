<?php
/**
 * Spacing Customizer Control
 *
 * @package Gravisain\Customizer\Controls
 */

namespace Gravisain\Customizer\Controls;

class SpacingControl extends \WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-spacing';

	/**
	 * Wrapper attributes.
	 *
	 * @var array
	 */
	public $wrapper_attrs = [];

	/**
	 * Export data to JS.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}

		$val = $this->value();
		if ( is_string( $val ) && ! empty( $val ) ) {
			$val = json_decode( $val, true );
		}
		if ( ! is_array( $val ) ) {
			$val = [
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
				'unit'   => 'px',
				'linked' => true,
			];
		}

		$this->json['value']         = $val;
		$this->json['link']          = $this->get_link();
		$this->json['id']            = $this->id;
		$this->json['wrapper_attrs'] = $this->wrapper_attrs;
	}

	/**
	 * Render content template for JS.
	 */
	protected function content_template() {
		?>
		<div class="gravisain-control-wrapper gravisain-spacing-wrapper" <# if ( data.wrapper_attrs ) { _.each( data.wrapper_attrs, function( value, key ) { #> {{ key }}="{{ value }}" <# } ); } #>>
			<div class="gravisain-control-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
				<# if ( data.label ) { #>
					<span class="customize-control-title" style="margin-bottom: 0;">{{ data.label }}</span>
				<# } #>
				<span class="gravisain-spacing-reset dashicons dashicons-image-rotate" title="<?php esc_attr_e( 'Reset', 'gravisain' ); ?>"></span>
			</div>
			
			<# if ( data.description ) { #>
				<span class="description customize-control-description" style="margin-bottom: 8px; display: block;">{{ data.description }}</span>
			<# } #>
			
			<div class="gravisain-spacing-inputs-wrapper" style="display: flex; flex-direction: column; gap: 8px;">
				<div class="gravisain-spacing-inputs" style="display: flex; width: 100%; gap: 6px;">
					<div class="gravisain-spacing-input-item" style="flex: 1; text-align: center;">
						<input type="number" class="gravisain-spacing-input" data-id="top" value="{{ data.value.top }}" />
						<span class="gravisain-spacing-label" style="font-size: 11px; color: #50575e; display: block; margin-top: 4px;"><?php esc_html_e( 'Top', 'gravisain' ); ?></span>
					</div>
					<div class="gravisain-spacing-input-item" style="flex: 1; text-align: center;">
						<input type="number" class="gravisain-spacing-input" data-id="right" value="{{ data.value.right }}" />
						<span class="gravisain-spacing-label" style="font-size: 11px; color: #50575e; display: block; margin-top: 4px;"><?php esc_html_e( 'Right', 'gravisain' ); ?></span>
					</div>
					<div class="gravisain-spacing-input-item" style="flex: 1; text-align: center;">
						<input type="number" class="gravisain-spacing-input" data-id="bottom" value="{{ data.value.bottom }}" />
						<span class="gravisain-spacing-label" style="font-size: 11px; color: #50575e; display: block; margin-top: 4px;"><?php esc_html_e( 'Bottom', 'gravisain' ); ?></span>
					</div>
					<div class="gravisain-spacing-input-item" style="flex: 1; text-align: center;">
						<input type="number" class="gravisain-spacing-input" data-id="left" value="{{ data.value.left }}" />
						<span class="gravisain-spacing-label" style="font-size: 11px; color: #50575e; display: block; margin-top: 4px;"><?php esc_html_e( 'Left', 'gravisain' ); ?></span>
					</div>
				</div>

				<div class="gravisain-spacing-actions" style="display: flex; justify-content: flex-end; gap: 6px; width: 100%; border-top: 1px solid #e2e8f0; padding-top: 8px;">
					<button type="button" class="gravisain-spacing-link" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; background: #fff; border: 1px solid #dcdcde; cursor: pointer; border-radius: 4px; padding: 0;">
						<span class="dashicons dashicons-admin-links" <# if ( ! data.value.linked ) { #> style="display: none;" <# } #>></span>
						<span class="dashicons dashicons-editor-unlink" <# if ( data.value.linked ) { #> style="display: none;" <# } #>></span>
					</button>

					<div class="gravisain-spacing-units">
						<select class="gravisain-spacing-unit" style="height: 30px; padding: 0 20px 0 8px; font-size: 12px; line-height: 1;">
							<option value="px" <# if ( 'px' === data.value.unit ) { #> selected <# } #>>px</option>
							<option value="em" <# if ( 'em' === data.value.unit ) { #> selected <# } #>>em</option>
							<option value="rem" <# if ( 'rem' === data.value.unit ) { #> selected <# } #>>rem</option>
						</select>
					</div>
				</div>
			</div>
			
			<input type="hidden" class="gravisain-spacing-hidden-value" {{{ data.link }}} value="{{ JSON.stringify(data.value).replace(/\"/g, '&quot;') }}" />
		</div>
		<?php
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	protected function render_content() {}
}
