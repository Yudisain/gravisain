<?php
/**
 * Button Group Customizer Control
 *
 * @package Gravisain\Customizer\Controls
 */

namespace Gravisain\Customizer\Controls;

class ButtonGroupControl extends \WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-button-group';

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
		$this->json['value'] = $this->value();
		$this->json['choices'] = $this->choices;
		$this->json['link'] = $this->get_link();
		$this->json['id'] = $this->id;
		$this->json['wrapper_attrs'] = $this->wrapper_attrs;
	}

	/**
	 * Render content template for JS.
	 */
	protected function content_template() {
		?>
		<div class="gravisain-control-wrapper gravisain-button-group-wrapper" <# if ( data.wrapper_attrs ) { _.each( data.wrapper_attrs, function( value, key ) { #> {{ key }}="{{ value }}" <# } ); } #>>
			<div class="gravisain-control-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
				<# if ( data.label ) { #>
					<span class="customize-control-title" style="margin-bottom: 0;">{{ data.label }}</span>
				<# } #>
				<span class="gravisain-button-group-reset dashicons dashicons-image-rotate" title="<?php esc_attr_e( 'Reset', 'gravisain' ); ?>"></span>
			</div>
			<# if ( data.description ) { #>
				<span class="description customize-control-description" style="margin-bottom: 8px; display: block;">{{ data.description }}</span>
			<# } #>
			<div class="gravisain-button-group-buttons" style="display: flex; gap: 4px; background: #f6f7f7; padding: 8px; border: 1px solid #dcdcde; border-radius: 3px;">
				<# if ( data.choices ) { _.each( data.choices, function( label, choice ) { #>
					<label style="flex: 1; margin: 0; display: block;">
						<input type="radio" value="{{ choice }}" name="_customize-radio-{{ data.id }}" {{{ data.link }}} <# if ( data.value === choice ) { #> checked="checked" <# } #> style="display: none;" class="gravisain-button-group-input" />
						<span class="gravisain-button-group-label" style="display: flex; align-items: center; justify-content: center; height: 34px; padding: 0 8px; cursor: pointer; border: 1px solid #c3c4c7; background: #fff; color: #50575e; font-size: 12px; font-weight: 600; text-transform: uppercase; border-radius: 3px; transition: all 0.15s ease-in-out;">
							{{ label }}
						</span>
					</label>
				<# } ); } #>
			</div>
		</div>
		<?php
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	protected function render_content() {}
}
