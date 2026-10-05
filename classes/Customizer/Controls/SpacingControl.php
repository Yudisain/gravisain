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
			<div class="gravisain-control-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
				<# if ( data.label ) { #>
					<span class="customize-control-title" style="margin-bottom: 0;">{{ data.label }}</span>
				<# } #>
				<div class="gravisain-spacing-header-actions" style="display: flex; align-items: center; gap: 6px;">
					<button type="button" class="gravisain-spacing-link <# if ( data.value.linked ) { #>is-active<# } #>" title="<?php esc_attr_e( 'Link / Unlink Values', 'gravisain' ); ?>">
						<span class="dashicons dashicons-admin-links" <# if ( ! data.value.linked ) { #> style="display: none;" <# } #>></span>
						<span class="dashicons dashicons-editor-unlink" <# if ( data.value.linked ) { #> style="display: none;" <# } #>></span>
					</button>
					<span class="gravisain-spacing-reset dashicons dashicons-image-rotate" title="<?php esc_attr_e( 'Reset', 'gravisain' ); ?>" style="cursor: pointer; color: #64748b;"></span>
				</div>
			</div>
			
			<# if ( data.description ) { #>
				<span class="description customize-control-description" style="margin-bottom: 8px; display: block;">{{ data.description }}</span>
			<# } #>
			
			<div class="gravisain-spacing-box-group <# if ( data.value.linked ) { #>is-linked<# } else { #>is-unlinked<# } #>">
				<div class="gravisain-spacing-box" data-side="top">
					<span class="gravisain-box-label"><?php esc_html_e( 'Top', 'gravisain' ); ?></span>
					<input type="number" class="gravisain-spacing-input" data-id="top" value="{{ data.value.top }}" placeholder="-" />
				</div>
				<div class="gravisain-spacing-box" data-side="right">
					<span class="gravisain-box-label"><?php esc_html_e( 'Right', 'gravisain' ); ?></span>
					<input type="number" class="gravisain-spacing-input" data-id="right" value="{{ data.value.right }}" placeholder="-" />
				</div>
				<div class="gravisain-spacing-box" data-side="bottom">
					<span class="gravisain-box-label"><?php esc_html_e( 'Bottom', 'gravisain' ); ?></span>
					<input type="number" class="gravisain-spacing-input" data-id="bottom" value="{{ data.value.bottom }}" placeholder="-" />
				</div>
				<div class="gravisain-spacing-box" data-side="left">
					<span class="gravisain-box-label"><?php esc_html_e( 'Left', 'gravisain' ); ?></span>
					<input type="number" class="gravisain-spacing-input" data-id="left" value="{{ data.value.left }}" placeholder="-" />
				</div>

				<div class="gravisain-unit-wrapper">
					<select class="gravisain-spacing-unit">
						<option value="px" <# if ( 'px' === data.value.unit ) { #> selected <# } #>>PX</option>
						<option value="em" <# if ( 'em' === data.value.unit ) { #> selected <# } #>>EM</option>
						<option value="rem" <# if ( 'rem' === data.value.unit ) { #> selected <# } #>>REM</option>
						<option value="%" <# if ( '%' === data.value.unit ) { #> selected <# } #>>%</option>
					</select>
				</div>
			</div>

			<!-- Stepped Slider Section (Appears when TOP/RIGHT/BOTTOM/LEFT is clicked) -->
			<div class="gravisain-spacing-slider-section" style="display: none;">
				<div class="gravisain-slider-header"></div>
				<div class="gravisain-slider-row">
					<div class="gravisain-slider-track-wrap">
						<div class="gravisain-slider-stepped-track">
							<span class="gravisain-step-tick"></span>
							<span class="gravisain-step-tick"></span>
							<span class="gravisain-step-tick"></span>
							<span class="gravisain-step-tick"></span>
							<span class="gravisain-step-tick"></span>
							<span class="gravisain-step-tick"></span>
							<span class="gravisain-step-tick"></span>
							<span class="gravisain-step-tick"></span>
							<span class="gravisain-step-tick"></span>
							<span class="gravisain-step-tick"></span>
							<span class="gravisain-step-tick"></span>
							<span class="gravisain-step-tick"></span>
							<span class="gravisain-step-tick"></span>
						</div>
						<input type="range" class="gravisain-spacing-range" min="0" max="120" step="1" value="0" />
						<div class="gravisain-slider-tooltip" style="display: none;"></div>
					</div>
					<button type="button" class="gravisain-slider-side-reset-btn"><?php esc_html_e( 'Reset', 'gravisain' ); ?></button>
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
