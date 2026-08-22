<?php
/**
 * Customizer Toggle Control
 *
 * @package Gravisain\Customizer\Controls
 */

namespace Gravisain\Customizer\Controls;

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Toggle Control Class
 */
class ToggleControl extends \WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-toggle';

	/**
	 * Wrapper attributes for the control's li element.
	 *
	 * @var array
	 */
	public $wrapper_attrs = [];

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
	 * Render control HTML.
	 */
	public function render_content() {
		$value = $this->value();
		$id    = 'gravisain-toggle-' . $this->id;
		?>
		<div class="gravisain-toggle-wrapper">
			<label class="gravisain-toggle-label" for="<?php echo esc_attr( $id ); ?>">
				<input
					type="checkbox"
					id="<?php echo esc_attr( $id ); ?>"
					class="gravisain-toggle-input"
					value="1"
					<?php checked( (bool) $value, true ); ?>
					<?php $this->link(); ?>
				/>
				<span class="gravisain-toggle-slider"></span>
				<?php if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>
			</label>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
		</div>
		<?php
	}
}
