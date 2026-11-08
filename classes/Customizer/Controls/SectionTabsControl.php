<?php
/**
 * Section Tabs Customizer Control
 *
 * @package Gravisain\Customizer\Controls
 */

namespace Gravisain\Customizer\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SectionTabsControl extends \WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-section-tabs';

	/**
	 * Tabs definition.
	 *
	 * @var array
	 */
	public $tabs = [];

	/**
	 * Constructor.
	 *
	 * @param \WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string                $id      Control ID.
	 * @param array                 $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = [] ) {
		$this->tabs = [
			'layout' => __( 'Layout', 'gravisain' ),
			'style'  => __( 'Style', 'gravisain' ),
		];
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Export data to JS.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['tabs'] = $this->tabs;
	}

	/**
	 * Render content template for JS.
	 */
	protected function content_template() {
		?>
		<div class="gravisain-section-tabs-wrapper">
			<div class="gravisain-section-tabs">
				<# _.each( data.tabs, function( label, key ) { #>
					<button type="button" class="gravisain-tab-btn <# if ( key === 'layout' || key === 'design' ) { #>active<# } #>" data-tab="{{ key }}">
						<# if ( key === 'layout' ) { #>
							<span class="dashicons dashicons-layout"></span>
						<# } else if ( key === 'design' ) { #>
							<span class="dashicons dashicons-admin-appearance"></span>
						<# } else if ( key === 'style' ) { #>
							<span class="dashicons dashicons-art"></span>
						<# } #>
						{{ label }}
					</button>
				<# } ); #>
			</div>
		</div>
		<?php
	}
}
