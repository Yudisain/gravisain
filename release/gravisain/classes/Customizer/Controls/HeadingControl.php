<?php
/**
 * Customizer Heading Control
 *
 * @package Gravisain\Customizer\Controls
 */

namespace Gravisain\Customizer\Controls;

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Heading Control Class
 */
class HeadingControl extends \WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-heading';

	/**
	 * Tab identifier for SectionTabs integration.
	 *
	 * @var string
	 */
	public $tab = '';

	/**
	 * Export data to JS so the control constructor can read control.params.tab.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['tab'] = $this->tab ?: ( isset( $this->wrapper_attrs['data-tab'] ) ? $this->wrapper_attrs['data-tab'] : '' );
	}

	/**
	 * Override render() to inject data-tab directly on the LI wrapper element.
	 */
	protected function render() {
		$tab   = $this->tab ?: ( isset( $this->wrapper_attrs['data-tab'] ) ? $this->wrapper_attrs['data-tab'] : '' );
		$id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
		$class = 'customize-control customize-control-' . $this->type;

		printf(
			'<li id="%s" class="%s"%s>',
			esc_attr( $id ),
			esc_attr( $class ),
			$tab ? ' data-tab="' . esc_attr( $tab ) . '"' : ''
		);
		$this->render_content();
		echo '</li>';
	}

	/**
	 * Render control HTML.
	 */
	public function render_content() {
		?>
		<div class="gravisain-customizer-heading">
			<?php if ( ! empty( $this->label ) ) : ?>
				<h4 class="gravisain-heading-title"><?php echo esc_html( $this->label ); ?></h4>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="gravisain-heading-desc"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Render content template for JS.
	 */
	protected function content_template() {
		?>
		<div class="gravisain-customizer-heading">
			<# if ( data.label ) { #>
				<h4 class="gravisain-heading-title">{{ data.label }}</h4>
			<# } #>
			<# if ( data.description ) { #>
				<span class="gravisain-heading-desc">{{{ data.description }}}</span>
			<# } #>
		</div>
		<?php
	}
}
