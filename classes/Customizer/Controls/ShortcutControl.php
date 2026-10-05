<?php
/**
 * Customizer Section Shortcut Control
 *
 * @package Gravisain\Customizer\Controls
 */

namespace Gravisain\Customizer\Controls;

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Shortcut Control Class
 */
class ShortcutControl extends \WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-shortcut';

	/**
	 * Target Section ID to focus.
	 *
	 * @var string
	 */
	public $target_section = '';

	/**
	 * Button text.
	 *
	 * @var string
	 */
	public $button_text = '';

	/**
	 * Tab identifier for SectionTabs integration.
	 *
	 * @var string
	 */
	public $tab = '';

	/**
	 * Export data to JS.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['tab']            = $this->tab ?: ( isset( $this->wrapper_attrs['data-tab'] ) ? $this->wrapper_attrs['data-tab'] : '' );
		$this->json['target_section'] = $this->target_section;
		$this->json['button_text']    = $this->button_text;
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
	 * Render control HTML for PHP.
	 */
	public function render_content() {
		$target   = esc_attr( $this->target_section );
		$btn_text = $this->button_text ? $this->button_text : __( 'Configure Section', 'gravisain' );
		$tab      = isset( $this->wrapper_attrs['data-tab'] ) ? $this->wrapper_attrs['data-tab'] : '';
		?>
		<div class="gravisain-customizer-shortcut" <?php echo $tab ? 'data-tab="' . esc_attr( $tab ) . '"' : ''; ?> style="padding: 12px; background: #f0f6fc; border: 1px solid #c8d7e1; border-radius: 8px; margin: 12px 0;">
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title" style="display: block; margin-bottom: 4px; font-weight: 600; color: #1d2327;"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description" style="display: block; margin-bottom: 10px; font-size: 12px; line-height: 1.4; color: #646970;"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>
			<button type="button" class="button button-secondary gravisain-focus-section-btn" data-target-section="<?php echo $target; ?>" style="width: 100%; display: flex; align-items: center; justify-content: space-between; font-weight: 600; padding: 6px 12px; height: auto; cursor: pointer;">
				<span><?php echo esc_html( $btn_text ); ?></span>
				<span class="dashicons dashicons-arrow-right-alt2" style="font-size: 18px; width: 18px; height: 18px; line-height: 1; display: inline-flex; align-items: center;"></span>
			</button>
		</div>
		<?php
	}

	/**
	 * Render content template for JS (Used when registered via register_control_type).
	 */
	protected function content_template() {
		?>
		<div class="gravisain-customizer-shortcut" style="padding: 12px; background: #f0f6fc; border: 1px solid #c8d7e1; border-radius: 8px; margin: 12px 0;">
			<# if ( data.label ) { #>
				<span class="customize-control-title" style="display: block; margin-bottom: 4px; font-weight: 600; color: #1d2327;">{{ data.label }}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description" style="display: block; margin-bottom: 10px; font-size: 12px; line-height: 1.4; color: #646970;">{{{ data.description }}}</span>
			<# } #>
			<button type="button" class="button button-secondary gravisain-focus-section-btn" data-target-section="{{ data.target_section }}" style="width: 100%; display: flex; align-items: center; justify-content: space-between; font-weight: 600; padding: 6px 12px; height: auto; cursor: pointer;">
				<span><# if ( data.button_text ) { #>{{ data.button_text }}<# } else { #><?php esc_html_e( 'Configure Section', 'gravisain' ); ?><# } #></span>
				<span class="dashicons dashicons-arrow-right-alt2" style="font-size: 18px; width: 18px; height: 18px; line-height: 1; display: inline-flex; align-items: center;"></span>
			</button>
		</div>
		<?php
	}
}
