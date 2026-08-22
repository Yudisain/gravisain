<?php
/**
 * Customizer Heading Section (Panel Divider)
 *
 * @package Gravisain\Customizer\Sections
 */

namespace Gravisain\Customizer\Sections;

if ( ! class_exists( 'WP_Customize_Section' ) ) {
	return;
}

/**
 * Heading Section Class
 */
class HeadingSection extends \WP_Customize_Section {
	/**
	 * Section type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-heading-section';

	/**
	 * Render content template for Underscore JS templates.
	 */
	protected function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section gravisain-customizer-panel-heading control-section control-section-{{ data.type }}">
			<# if ( data.title ) { #>
				<h4 class="gravisain-panel-heading-title">{{ data.title }}</h4>
			<# } #>
			<# if ( data.description ) { #>
				<span class="gravisain-panel-heading-desc">{{{ data.description }}}</span>
			<# } #>
		</li>
		<?php
	}
}
