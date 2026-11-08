<?php
/**
 * Customizer Visibility Control
 *
 * @package Gravisain\Customizer\Controls
 */

namespace Gravisain\Customizer\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Visibility Control Class
 */
class VisibilityControl extends \WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-visibility';

	/**
	 * Devices available for visibility toggle.
	 *
	 * @var array
	 */
	public $devices = [];

	/**
	 * Constructor.
	 *
	 * @param \WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string                $id      Control ID.
	 * @param array                 $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = [] ) {
		$this->devices = [
			'desktop' => [
				'label' => __( 'Desktop', 'gravisain' ),
				'icon'  => 'dashicons-desktop',
			],
			'tablet'  => [
				'label' => __( 'Tablet', 'gravisain' ),
				'icon'  => 'dashicons-tablet',
			],
			'mobile'  => [
				'label' => __( 'Mobile', 'gravisain' ),
				'icon'  => 'dashicons-smartphone',
			],
		];
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Pass data to the Customizer JS API.
	 */
	public function to_json() {
		parent::to_json();

		$this->json['devices'] = $this->devices;
		$val = $this->value();
		if ( is_array( $val ) ) {
			$this->json['value'] = $val;
		} elseif ( is_string( $val ) ) {
			if ( '' === $val || 'none' === $val ) {
				$this->json['value'] = [];
			} else {
				$this->json['value'] = array_values( array_filter( array_map( 'trim', explode( ',', $val ) ) ) );
			}
		} else {
			$this->json['value'] = [ 'desktop', 'tablet', 'mobile' ];
		}
	}

	protected function content_template() {
		?>
		<div class="gravisain-visibility-control">
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>

			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{ data.description }}</span>
			<# } #>

			<div class="gravisain-visibility-buttons">
				<# _.each( data.devices, function( dev, key ) { 
					var isActive = _.contains( data.value, key ) ? 'active' : '';
				#>
					<button type="button" class="gravisain-visibility-btn {{ isActive }}" data-device="{{ key }}" title="{{ dev.label }}">
						<span class="dashicons {{ dev.icon }}"></span>
					</button>
				<# } ); #>
			</div>

			<input type="hidden" class="gravisain-visibility-hidden-value" value="{{ Array.isArray(data.value) && data.value.length ? data.value.join(',') : 'none' }}" {{{ data.link }}} />
		</div>
		<?php
	}

	protected function render_content() {}
}
