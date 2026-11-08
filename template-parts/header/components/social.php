<?php
/**
 * Social Media Icons Component
 *
 * @package Gravisain\Components
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$all_networks  = \Gravisain\Helpers\SocialNetworksHelper::get_all();
$brand_mode    = get_theme_mod( 'gravisain_header_social_brand_colors', 'no' );

$items_json = get_theme_mod( 'gravisain_header_social_items', '' );
$items      = null;
if ( ! empty( $items_json ) ) {
	$decoded = json_decode( $items_json, true );
	if ( is_array( $decoded ) ) {
		$items = $decoded;
	}
}

if ( null === $items ) {
	$init_keys = [ 'facebook', 'threads', 'youtube', 'instagram', 'shopee' ];
	$items     = [];
	foreach ( $init_keys as $key ) {
		if ( isset( $all_networks[ $key ] ) ) {
			$net = $all_networks[ $key ];
			$items[] = [
				'id'          => $key,
				'label'       => $net['label'],
				'url'         => get_theme_mod( 'gravisain_header_social_' . $key, '' ),
				'source_type' => 'icon',
				'icon_style'  => 'filled',
				'max_width'   => '24',
			];
		}
	}
}

if ( empty( $items ) ) {
	return;
}

// Check if any valid URL is set
$has_any_url = false;
foreach ( $items as $item ) {
	if ( ! empty( $item['url'] ) && '#' !== trim( (string) $item['url'] ) ) {
		$has_any_url = true;
		break;
	}
}

if ( ! $has_any_url && ! is_customize_preview() ) {
	return;
}

$brand_class = 'no' !== $brand_mode ? ' social-brand-' . sanitize_html_class( $brand_mode ) : '';
?>
<div class="ghb-component ghb-social-icons<?php echo esc_attr( $brand_class ); ?>">
	<ul class="social-icons-list">
		<?php foreach ( $items as $item ) : ?>
			<?php
			$id          = ! empty( $item['id'] ) ? sanitize_key( (string) $item['id'] ) : 'social';
			$label       = ! empty( $item['label'] ) ? (string) $item['label'] : ucfirst( $id );
			$url         = ! empty( $item['url'] ) ? trim( (string) $item['url'] ) : '';
			$source_type = ! empty( $item['source_type'] ) ? (string) $item['source_type'] : 'icon';
			$max_width   = ! empty( $item['max_width'] ) ? absint( $item['max_width'] ) : 24;
			$show_label  = ! empty( $item['show_label'] ) && ( true === $item['show_label'] || 'true' === $item['show_label'] || 'yes' === $item['show_label'] || 1 === $item['show_label'] || '1' === $item['show_label'] || 'on' === $item['show_label'] );

			if ( ( empty( $url ) || '#' === $url ) && is_customize_preview() ) {
				$url = '#';
			} elseif ( empty( $url ) || '#' === $url ) {
				continue;
			}

			$icon_html = '';
			if ( 'svg' === $source_type && ! empty( $item['custom_svg'] ) ) {
				$icon_html = (string) $item['custom_svg'];
			} elseif ( 'image' === $source_type && ! empty( $item['custom_image'] ) ) {
				$icon_html = '<img src="' . esc_url( (string) $item['custom_image'] ) . '" alt="' . esc_attr( $label ) . '" style="max-width: 100%; height: auto;" />';
			} else {
				$def       = isset( $all_networks[ $id ] ) ? $all_networks[ $id ] : [ 'filled' => '' ];
				$icon_html = ! empty( $def['filled'] ) ? (string) $def['filled'] : '';
			}

			$link_class = 'social-icon-link' . ( $show_label ? ' has-label' : '' );
			$link_style = $show_label ? 'display: inline-flex; align-items: center; justify-content: center;' : 'display: inline-flex; align-items: center; justify-content: center; width: ' . $max_width . 'px; height: ' . $max_width . 'px;';
			$icon_style = 'display: inline-flex; align-items: center; justify-content: center; width: ' . $max_width . 'px; height: ' . $max_width . 'px;';
			?>
			<li class="social-icon-item social-<?php echo esc_attr( $id ); ?>">
				<a href="<?php echo esc_url( $url ); ?>" class="<?php echo esc_attr( $link_class ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $label ); ?>" style="<?php echo esc_attr( $link_style ); ?>">
					<span class="social-icon-icon" style="<?php echo esc_attr( $icon_style ); ?>">
						<?php echo wp_kses( $icon_html, \Gravisain\Helpers\SVG::allowed_svg_html() ); ?>
					</span>
					<?php if ( $show_label && ! empty( $label ) ) : ?>
						<span class="social-icon-label"><?php echo esc_html( $label ); ?></span>
					<?php endif; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
