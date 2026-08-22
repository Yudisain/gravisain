<?php
/**
 * Social Icons Customizer Control
 *
 * @package Gravisain\Customizer\Controls
 */

namespace Gravisain\Customizer\Controls;

class SocialIconsControl extends \WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-social-icons';

	/**
	 * Default icons definition.
	 *
	 * @var array
	 */
	public $default_icons = [];

	/**
	 * Constructor.
	 *
	 * @param \WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string                $id      Control ID.
	 * @param array                 $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = [] ) {
		parent::__construct( $manager, $id, $args );

		$this->default_icons = \Gravisain\Helpers\SocialNetworksHelper::get_all();
	}

	/**
	 * Export data to JS.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['value']        = $this->value();
		$this->json['defaultIcons'] = $this->default_icons;
		$this->json['tab']          = isset( $this->wrapper_attrs['data-tab'] ) ? $this->wrapper_attrs['data-tab'] : 'design';
	}

	/**
	 * Render content template for JS.
	 */
	protected function content_template() {
		?>
		<div class="gravisain-social-icons-control">
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{ data.description }}</span>
			<# } #>

			<div class="gravisain-social-accordion-list"></div>
			<div class="gravisain-social-add-wrap" style="margin-top: 12px; display: flex; gap: 8px;">
				<button type="button" class="button button-secondary gravisain-social-add-btn" style="flex: 1; justify-content: center; display: flex; align-items: center; gap: 6px;">
					<span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px; line-height: 16px;"></span> Add Social Network
				</button>
				<button type="button" class="button gravisain-social-reset-btn" title="Reset to default icons" style="display: flex; align-items: center; justify-content: center; gap: 6px;">
					<span class="dashicons dashicons-image-rotate" style="font-size: 16px; width: 16px; height: 16px; line-height: 16px;"></span> Defaults
				</button>
			</div>

			<div class="gravisain-social-network-picker" style="display: none; margin-top: 12px; border: 1px solid #c3c4c7; background: #fff; border-radius: 4px; padding: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); max-height: 350px; overflow-y: auto;">
				<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding-bottom: 8px; border-bottom: 1px solid #eee;">
					<strong style="font-size: 13px; color: #1d2327;">Select Social Network</strong>
					<button type="button" class="button-link gravisain-close-picker-btn" style="color: #646970; text-decoration: none;">
						<span class="dashicons dashicons-no-alt"></span>
					</button>
				</div>
				<div class="gravisain-social-picker-grid"></div>
			</div>

			<input type="hidden" class="social-items-value-input" value="{{ data.value }}" {{{ data.link }}} />
		</div>
		<?php
	}

	/**
	 * We don't render HTML directly here, we use content_template()
	 */
	protected function render_content() {}
}
