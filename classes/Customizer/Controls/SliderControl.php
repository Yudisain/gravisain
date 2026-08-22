<?php
/**
 * Customizer Slider Control
 *
 * @package Gravisain\Customizer\Controls
 */

namespace Gravisain\Customizer\Controls;

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Slider Control Class
 */
class SliderControl extends \WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-slider';

	/**
	 * The units available for this control.
	 *
	 * @var array
	 */
	public $units = [ 'px', 'em', 'rem', 'vw' ];

	/**
	 * Whether this control supports responsive device switching.
	 *
	 * @var bool
	 */
	public $responsive = false;

	/**
	 * Minimum, maximum, and step values per unit.
	 *
	 * @var array
	 */
	public $input_attrs = [];

	/**
	 * Tab identifier for SectionTabs integration.
	 *
	 * @var string
	 */
	public $tab = '';

	/**
	 * Wrapper attributes for the control's li element.
	 *
	 * @var array
	 */
	public $wrapper_attrs = [];

	/**
	 * Pass data to the Customizer JS API.
	 */
	public function to_json() {
		parent::to_json();

		$this->json['units']      = $this->units;
		$this->json['default']    = $this->setting->default;
		$this->json['responsive'] = $this->responsive;
		$this->json['tab']        = $this->tab ?: ( isset( $this->wrapper_attrs['data-tab'] ) ? $this->wrapper_attrs['data-tab'] : '' );
		
		// Set default input attrs if not provided
		$default_attrs = [
			'px'  => [ 'min' => 0, 'max' => 1000, 'step' => 1 ],
			'em'  => [ 'min' => 0, 'max' => 100, 'step' => 0.1 ],
			'rem' => [ 'min' => 0, 'max' => 100, 'step' => 0.1 ],
			'vw'  => [ 'min' => 0, 'max' => 100, 'step' => 1 ],
			'%'   => [ 'min' => 0, 'max' => 100, 'step' => 1 ],
		];

		$this->json['input_attrs'] = wp_parse_args(
			$this->input_attrs,
			$default_attrs
		);
	}

	protected function content_template() {
		?>
		<div class="gravisain-slider-control <# if ( data.responsive ) { #>has-responsive<# } #>">
			<div class="gravisain-slider-header">
				<# if ( data.label ) { #>
					<span class="customize-control-title">{{ data.label }}</span>
				<# } #>
				
				<div class="gravisain-slider-actions">
					<# if ( data.responsive ) { #>
						<ul class="gravisain-responsive-devices">
							<li class="desktop active"><button type="button" class="preview-desktop" data-device="desktop" title="Desktop"><span class="dashicons dashicons-desktop"></span></button></li>
							<li class="tablet"><button type="button" class="preview-tablet" data-device="tablet" title="Tablet"><span class="dashicons dashicons-tablet"></span></button></li>
							<li class="mobile"><button type="button" class="preview-mobile" data-device="mobile" title="Mobile"><span class="dashicons dashicons-smartphone"></span></button></li>
						</ul>
					<# } #>
					<span class="gravisain-slider-reset dashicons dashicons-image-rotate" title="Reset"></span>
				</div>
			</div>

			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{ data.description }}</span>
			<# } #>

			<div class="gravisain-slider-wrapper">
				<div class="gravisain-slider-range-wrap">
					<input type="range" class="gravisain-slider-range" value="" />
				</div>
				<div class="gravisain-slider-input-wrap">
					<input type="number" class="gravisain-slider-input" value="" />
					<# if ( data.units && data.units.length > 0 ) { #>
						<select class="gravisain-slider-unit-select">
							<# _.each( data.units, function( unit ) { #>
								<option value="{{ unit }}">{{ unit }}</option>
							<# } ); #>
						</select>
					<# } #>
				</div>
			</div>
			
			<!-- Hidden input to store the actual setting string value -->
			<input type="hidden" class="gravisain-slider-hidden-value" value="{{ data.value }}" {{{ data.link }}} />
		</div>
		<?php
	}

	/**
	 * We don't render HTML directly here, we use content_template()
	 */
	protected function render_content() {}
}
