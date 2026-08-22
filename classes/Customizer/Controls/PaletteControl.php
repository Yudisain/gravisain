<?php
/**
 * Global Color Palette Customizer Control
 *
 * @package Gravisain\Customizer\Controls
 */

namespace Gravisain\Customizer\Controls;

class PaletteControl extends \WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-palette';

	/**
	 * Tab identifier for SectionTabs integration.
	 *
	 * @var string
	 */
	public $tab = 'general';

	/**
	 * Wrapper attributes for the control's li element.
	 *
	 * @var array
	 */
	public $wrapper_attrs = [ 'data-tab' => 'general' ];

	/**
	 * Preset palettes.
	 *
	 * @var array
	 */
	public $presets = [];

	/**
	 * Color labels.
	 *
	 * @var array
	 */
	public $color_labels = [];

	/**
	 * Export data to JS.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['label']        = $this->label;
		$this->json['description']  = $this->description;
		$this->json['presets']      = $this->presets;
		$this->json['color_labels'] = $this->color_labels;
		$this->json['tab']          = $this->tab ?: ( isset( $this->wrapper_attrs['data-tab'] ) ? $this->wrapper_attrs['data-tab'] : 'general' );

		$val = $this->value();
		if ( is_string( $val ) && ! empty( $val ) ) {
			$val = json_decode( $val, true );
		}
		if ( ! is_array( $val ) ) {
			// Fallback default colors if empty
			$val = [
				'#4f46e5', // 1: Primary
				'#0ea5e9', // 2: Secondary
				'#0f172a', // 3: Contrast
				'#475569', // 4: Contrast Alt
				'#ffffff', // 5: Base
				'#f8fafc', // 6: Base Alt
				'#e2e8f0', // 7: Border
				'#f43f5e', // 8: Accent
			];
		}
		$this->json['value'] = $val;
	}

	/**
	 * Render content template for JS.
	 */
	protected function content_template() {
		?>
		<div class="gravisain-palette-control">
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{ data.description }}</span>
			<# } #>

			<div class="gravisain-palette-presets">
				<span class="gravisain-palette-presets-title"><?php esc_html_e( 'Presets', 'gravisain' ); ?></span>
				<div class="gravisain-palette-presets-list">
					<# _.each( data.presets, function( preset, index ) { #>
						<button type="button" class="gravisain-palette-preset-btn" data-preset="{{ index }}" title="{{ preset.name }}">
							<span class="gravisain-palette-preset-name">{{ preset.name }}</span>
							<div class="gravisain-palette-preset-colors">
								<# _.each( preset.colors, function( color ) { #>
									<span class="gravisain-palette-preset-color" style="background-color: {{ color }};"></span>
								<# } ); #>
							</div>
						</button>
					<# } ); #>
				</div>
			</div>

			<div class="gravisain-palette-colors">
				<# _.each( data.value, function( color, index ) { 
					var realIndex = index;
					var label = data.color_labels[realIndex] ? data.color_labels[realIndex] : 'Color ' + (parseInt(realIndex) + 1);
				#>
					<div class="gravisain-palette-color-item" data-index="{{ realIndex }}">
						<div class="gravisain-palette-color-preview" style="background-color: {{ color }};" title="{{ label }}"></div>
					</div>
				<# } ); #>
			</div>
			
			<div class="gravisain-palette-pickers-container">
				<# _.each( data.value, function( color, index ) { 
					var realIndex = index;
				#>
					<div class="gravisain-palette-color-picker-wrap" data-index="{{ realIndex }}">
						<input type="text" class="gravisain-palette-color-input" value="{{ color }}" data-index="{{ realIndex }}" />
					</div>
				<# } ); #>
			</div>
			
			<input type="hidden" class="gravisain-palette-value" {{{ data.link }}} value="{{ JSON.stringify(data.value) }}" />
		</div>
		<?php
	}

	/**
	 * We don't render HTML directly here, we use content_template()
	 */
	protected function render_content() {}
}
