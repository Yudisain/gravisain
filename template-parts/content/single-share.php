<?php
/**
 * Template part for displaying native social share buttons on single posts.
 *
 * @package Gravisain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Gravisain\Components\SocialShare;

if ( ! SocialShare::should_render() ) {
	return;
}

$share_links = SocialShare::get_share_links();
if ( empty( $share_links ) ) {
	return;
}
?>
<div class="gravisain-single-share" role="region" aria-label="<?php esc_attr_e( 'Share Article', 'gravisain' ); ?>">
	<span class="share-label"><?php esc_html_e( 'Share this article:', 'gravisain' ); ?></span>
	<div class="share-buttons-list">
		<?php foreach ( $share_links as $network => $item ) : ?>
			<?php if ( isset( $item['action'] ) && 'copy' === $item['action'] ) : ?>
				<button type="button" class="share-btn share-btn-copy" data-copy-url="<?php echo esc_url( get_permalink() ); ?>" data-copied-label="<?php esc_attr_e( 'Copied!', 'gravisain' ); ?>" title="<?php echo esc_attr( $item['label'] ); ?>">
					<span class="share-icon"><?php echo wp_kses( $item['icon'], \Gravisain\Helpers\SVG::allowed_svg_html() ); ?></span>
					<span class="share-text"><?php echo esc_html( $item['label'] ); ?></span>
				</button>
			<?php else : ?>
				<a href="<?php echo esc_url( $item['url'] ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-btn-<?php echo esc_attr( $network ); ?>" title="<?php echo esc_attr( $item['label'] ); ?>">
					<span class="share-icon"><?php echo wp_kses( $item['icon'], \Gravisain\Helpers\SVG::allowed_svg_html() ); ?></span>
					<span class="share-text"><?php echo esc_html( $item['label'] ); ?></span>
				</a>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
