<?php
/**
 * Color Group Customizer Control
 *
 * @package Gravisain\Customizer\Controls
 */

namespace Gravisain\Customizer\Controls;

class ColorGroupControl extends \WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-color-group';

	/**
	 * Color fields definition.
	 *
	 * @var array
	 */
	public $fields = [];

	/**
	 * Tab identifier for SectionTabs integration.
	 *
	 * @var string
	 */
	public $tab = 'style';

	/**
	 * Wrapper attributes for the control's li element.
	 *
	 * @var array
	 */
	public $wrapper_attrs = [ 'data-tab' => 'style' ];

	/**
	 * Export data to JS.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['label']  = $this->label;
		$this->json['fields'] = $this->fields;
		$this->json['tab']    = $this->tab ?: ( isset( $this->wrapper_attrs['data-tab'] ) ? $this->wrapper_attrs['data-tab'] : 'style' );
		
		$val = $this->value();
		if ( is_string( $val ) && ! empty( $val ) ) {
			$val = json_decode( $val, true );
		}
		if ( ! is_array( $val ) ) {
			$val = [];
		}
		$this->json['value'] = $val;
	}

	/**
	 * Render content template for JS.
	 */
	protected function content_template() {
		?>
		<div class="gravisain-control-accordion collapsed">
			<div class="gravisain-accordion-header">
				<span class="gravisain-accordion-title">{{ data.label }}</span>
				<div class="gravisain-accordion-actions">
					<button type="button" class="gravisain-accordion-reset" title="<?php esc_attr_e( 'Reset', 'gravisain' ); ?>"><span class="dashicons dashicons-image-rotate"></span></button>
					<span class="gravisain-accordion-toggle dashicons dashicons-arrow-down-alt2"></span>
				</div>
			</div>
			<div class="gravisain-accordion-body" style="display: none;">
				<# _.each( data.fields, function( fieldLabel, fieldKey ) { 
					var colorVal = data.value && data.value[fieldKey] ? data.value[fieldKey] : '';
				#>
					<div class="gravisain-color-group-row" data-field="{{ fieldKey }}">
						<label class="gravisain-color-group-label">{{ fieldLabel }}</label>
						<div class="gravisain-color-group-picker-wrap">
							<button type="button" class="gravisain-color-globe-btn" title="<?php esc_attr_e( 'Global Palette', 'gravisain' ); ?>"><span class="dashicons dashicons-admin-site-alt3"></span></button>
							<input type="text" class="gravisain-color-picker-input" data-field="{{ fieldKey }}" value="{{ colorVal }}" />
						</div>
					</div>
				<# } ); #>
			</div>
		</div>
		<?php
	}

	/**
	 * We don't render HTML directly here, we use content_template()
	 */
	protected function render_content() {}
}
