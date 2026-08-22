<?php
/**
 * Typography Customizer Control with Live Preview
 *
 * @package Gravisain\Customizer\Controls
 */

namespace Gravisain\Customizer\Controls;

use Gravisain\Helpers\GoogleFontsHelper;

class TypographyControl extends \WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-typography';

	/**
	 * Preview text.
	 *
	 * @var string
	 */
	public $preview_text = '';

	/**
	 * Font families list.
	 *
	 * @var array
	 */
	public $font_families = [];

	/**
	 * Font styles list.
	 *
	 * @var array
	 */
	public $font_styles = [];

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
	 * Constructor.
	 *
	 * @param \WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string                $id      Control ID.
	 * @param array                 $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = [] ) {
		parent::__construct( $manager, $id, $args );

		if ( empty( $this->font_families ) ) {
			/*
			 * Opsi font sekarang dimuat sepenuhnya melalui JavaScript dari GravisainFonts.catalog
			 * sehingga kita tidak perlu me-load array raksasa di sisi PHP.
			 */
			$this->font_families = [];
		}

		if ( empty( $this->font_styles ) ) {
			$this->font_styles = [
				'normal'      => __( 'Normal', 'gravisain' ),
				'italic'      => __( 'Italic', 'gravisain' ),
				'500'         => __( 'Medium (500)', 'gravisain' ),
				'600'         => __( 'Semi-Bold (600)', 'gravisain' ),
				'700'         => __( 'Bold (700)', 'gravisain' ),
				'700 italic'  => __( 'Bold Italic', 'gravisain' ),
				'300'         => __( 'Light (300)', 'gravisain' ),
				'400'         => __( 'Regular (400)', 'gravisain' ),
			];
		}

		if ( empty( $this->preview_text ) ) {
			$this->preview_text = __( 'Everything based on your mindset', 'gravisain' );
		}
	}

	/**
	 * Export data to JS.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['label']         = $this->label;
		$this->json['preview_text']  = $this->preview_text;
		$this->json['font_families'] = $this->font_families;
		$this->json['font_styles']   = $this->font_styles;
		$this->json['tab']           = $this->tab ?: ( isset( $this->wrapper_attrs['data-tab'] ) ? $this->wrapper_attrs['data-tab'] : 'style' );

		$val = $this->value();
		if ( is_string( $val ) && ! empty( $val ) ) {
			$val = json_decode( $val, true );
		}
		if ( ! is_array( $val ) ) {
			$val = [ 'family' => 'inherit', 'style' => 'normal', 'size' => '16', 'line_height' => '1.5', 'spacing' => '0' ];
		}
		if ( ! isset( $val['spacing'] ) ) {
			$val['spacing'] = '0';
		}
		if ( ! isset( $val['line_height'] ) ) {
			$val['line_height'] = '1.5';
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
				<div class="gravisain-typography-field-row gravisain-font-family-row">
					<label class="gravisain-typography-label"><?php _e( 'Font Family', 'gravisain' ); ?></label>
					<div class="gravisain-font-picker" tabindex="0">
						<div class="gravisain-font-picker-selected">
							<span class="gravisain-font-picker-value">{{ data.value.family || 'inherit' }}</span>
							<span class="dashicons dashicons-arrow-down-alt2"></span>
						</div>
						<div class="gravisain-font-picker-dropdown" style="display: none;">
							<div class="gravisain-font-picker-search">
								<input type="text" placeholder="<?php esc_attr_e( 'Search fonts...', 'gravisain' ); ?>" />
							</div>
							<ul class="gravisain-font-picker-list">
								<!-- Populated via JS -->
							</ul>
						</div>
					</div>
					<input type="hidden" class="gravisain-typography-input-family" data-field="family" value="{{ data.value.family || 'inherit' }}" />
				</div>
				<div class="gravisain-typography-field-row">
					<label class="gravisain-typography-label"><?php _e( 'Font Style', 'gravisain' ); ?></label>
					<select class="gravisain-typography-select" data-field="style">
						<# _.each( data.font_styles, function( label, key ) { #>
							<option value="{{ key }}" <# if ( (data.value.style || 'normal') === key ) { #>selected<# } #>>{{ label }}</option>
						<# } ); #>
					</select>
				</div>
				<div class="gravisain-typography-field-row">
					<label class="gravisain-typography-label"><?php _e( 'Font Size (px)', 'gravisain' ); ?></label>
					<input type="number" class="gravisain-typography-input" data-field="size" value="{{ data.value.size || '16' }}" min="8" max="100" step="1" />
				</div>
				<div class="gravisain-typography-field-row">
					<label class="gravisain-typography-label"><?php _e( 'Line Height', 'gravisain' ); ?></label>
					<input type="number" class="gravisain-typography-input" data-field="line_height" value="{{ data.value.line_height !== undefined && data.value.line_height !== '' ? data.value.line_height : '1.5' }}" min="0.5" max="5" step="0.1" />
				</div>
				<div class="gravisain-typography-field-row gravisain-typography-slider-row">
					<label class="gravisain-typography-label"><?php _e( 'Letter Spacing (px)', 'gravisain' ); ?></label>
					<div class="gravisain-slider-wrapper">
						<div class="gravisain-slider-range-wrap">
							<input type="range" class="gravisain-slider-range gravisain-typography-range-slider" min="-5" max="15" step="0.1" value="{{ data.value.spacing || '0' }}" />
						</div>
						<div class="gravisain-slider-input-wrap">
							<input type="number" class="gravisain-typography-input" data-field="spacing" value="{{ data.value.spacing || '0' }}" min="-5" max="15" step="0.1" style="border:none !important;" />
							<span class="gravisain-slider-unit-select" style="line-height:28px !important; cursor: default; user-select: none;">px</span>
						</div>
					</div>
				</div>
				<div class="gravisain-typography-preview-wrap">
					<div class="gravisain-typography-live-preview" style="font-family: {{ data.value.family || 'inherit' }}; font-style: {{ (data.value.style || 'normal').indexOf('italic') !== -1 ? 'italic' : 'normal' }}; font-weight: {{ (data.value.style || 'normal').replace('italic', '').trim() || '500' }}; font-size: {{ data.value.size || '16' }}px; line-height: {{ data.value.line_height !== undefined && data.value.line_height !== '' ? data.value.line_height : '1.5' }}; letter-spacing: {{ data.value.spacing || '0' }}px;">
						{{ data.preview_text }}
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * We don't render HTML directly here, we use content_template()
	 */
	protected function render_content() {}
}
