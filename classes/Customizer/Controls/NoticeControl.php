<?php
/**
 * Customizer Notice Control
 *
 * @package Gravisain\Customizer\Controls
 */

namespace Gravisain\Customizer\Controls;

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Notice Control Class
 */
class NoticeControl extends \WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-notice';

	/**
	 * Type of notice (info, warning, error)
	 *
	 * @var string
	 */
	public $notice_type = 'info';

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
		$this->json['tab']         = $this->tab ?: ( isset( $this->wrapper_attrs['data-tab'] ) ? $this->wrapper_attrs['data-tab'] : '' );
		$this->json['notice_type'] = $this->notice_type;
	}

	/**
	 * Override render() to inject data-tab directly on the LI wrapper element.
	 * We must render the full LI manually because WP's parent::render() reads
	 * wrapper_attrs but only outputs key-value pairs - we need data-tab on the LI.
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
		$class = 'notice notice-' . esc_attr( $this->notice_type ) . ' inline';
		$tab   = isset( $this->wrapper_attrs['data-tab'] ) ? $this->wrapper_attrs['data-tab'] : '';
		?>
		<div class="<?php echo esc_attr( $class ); ?>" <?php echo $tab ? 'data-tab="' . esc_attr( $tab ) . '"' : ''; ?> style="padding: 10px; border-left: 4px solid <?php echo $this->notice_type === 'warning' ? '#ffb900' : '#00a0d2'; ?>; background: #fff; margin-bottom: 15px;">
			<?php if ( ! empty( $this->label ) ) : ?>
				<strong class="customize-control-title" style="display: block; margin-bottom: 5px; color: #d63638;"><?php echo esc_html( $this->label ); ?></strong>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description" style="display: block; font-size: 13px; color: #50575e;"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>
		</div>
		<?php
	}
}
