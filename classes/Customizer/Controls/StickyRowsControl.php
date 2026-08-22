<?php
/**
 * Sticky Rows Checklist Customizer Control
 *
 * @package Gravisain\Customizer\Controls
 */

namespace Gravisain\Customizer\Controls;

class StickyRowsControl extends \WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'gravisain-sticky-rows';

	/**
	 * Render control template.
	 */
	public function render_content() {
		$current_value = $this->value();
		if ( empty( $current_value ) ) {
			$current_value = 'none';
		}
		$selected = array_map( 'trim', explode( ',', $current_value ) );
		$ctrl_id  = 'gravisain-sticky-rows-' . $this->id;
		?>
		<div id="<?php echo esc_attr( $ctrl_id ); ?>" class="gravisain-sticky-rows-control">
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>

			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>

			<div class="gravisain-sticky-rows-checklist" style="display: flex; flex-direction: column; gap: 8px; margin-top: 10px; background: #fff; border: 1px solid #dcdcde; padding: 12px; border-radius: 4px;">
				<label style="font-weight: 600; display: flex; align-items: center; gap: 8px; cursor: pointer;">
					<input type="checkbox" class="gravisain-sticky-row-cb" data-item="none" <?php checked( 'none' === $current_value ); ?> />
					<?php esc_html_e( 'Disable (Turn Off Sticky)', 'gravisain' ); ?>
				</label>

				<label style="font-weight: 600; display: flex; align-items: center; gap: 8px; cursor: pointer;">
					<input type="checkbox" class="gravisain-sticky-row-cb" data-item="entire_header" <?php checked( 'entire_header' === $current_value || ( in_array( 'top_row', $selected, true ) && in_array( 'main_row', $selected, true ) && in_array( 'bottom_row', $selected, true ) ) ); ?> />
					<?php esc_html_e( 'Entire Header (All Rows)', 'gravisain' ); ?>
				</label>

				<hr style="margin: 4px 0; border: none; border-top: 1px solid #f0f0f1;" />

				<label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
					<input type="checkbox" class="gravisain-sticky-row-cb" data-item="top_row" <?php checked( in_array( 'top_row', $selected, true ) || 'entire_header' === $current_value ); ?> />
					<?php esc_html_e( 'Stick Top Row', 'gravisain' ); ?>
				</label>

				<label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
					<input type="checkbox" class="gravisain-sticky-row-cb" data-item="main_row" <?php checked( in_array( 'main_row', $selected, true ) || 'entire_header' === $current_value ); ?> />
					<?php esc_html_e( 'Stick Main Row', 'gravisain' ); ?>
				</label>

				<label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
					<input type="checkbox" class="gravisain-sticky-row-cb" data-item="bottom_row" <?php checked( in_array( 'bottom_row', $selected, true ) || 'entire_header' === $current_value ); ?> />
					<?php esc_html_e( 'Stick Bottom Row', 'gravisain' ); ?>
				</label>
			</div>

			<input type="hidden" class="gravisain-sticky-rows-hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $current_value ); ?>" />
		</div>

		<script>
		jQuery(document).ready(function($) {
			var $wrapper = $('#<?php echo esc_js( $ctrl_id ); ?>');
			if (!$wrapper.length) return;

			var $hidden = $wrapper.find('.gravisain-sticky-rows-hidden');
			var $cbs = $wrapper.find('.gravisain-sticky-row-cb');

			$cbs.on('change', function() {
				var item = $(this).attr('data-item');

				if (item === 'none' && this.checked) {
					$cbs.not(this).prop('checked', false);
					updateVal('none');
					return;
				}

				if (item === 'entire_header' && this.checked) {
					$cbs.not(this).prop('checked', false);
					updateVal('entire_header');
					return;
				}

				// Individual row clicked (top_row, main_row, bottom_row)
				$wrapper.find('[data-item="none"]').prop('checked', false);
				$wrapper.find('[data-item="entire_header"]').prop('checked', false);

				var active = [];
				$cbs.each(function() {
					var k = $(this).attr('data-item');
					if ((k === 'top_row' || k === 'main_row' || k === 'bottom_row') && this.checked) {
						active.push(k);
					}
				});

				if (active.length === 3) {
					$cbs.prop('checked', false);
					$wrapper.find('[data-item="entire_header"]').prop('checked', true);
					updateVal('entire_header');
				} else if (active.length === 0) {
					$wrapper.find('[data-item="none"]').prop('checked', true);
					updateVal('none');
				} else {
					updateVal(active.join(','));
				}
			});

			function updateVal(val) {
				$hidden.val(val).trigger('change');
			}
		});
		</script>
		<?php
	}
}
