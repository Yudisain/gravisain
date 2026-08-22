<?php
/**
 * Page Header Hero Banner Template Part
 *
 * @package Gravisain
 */

use Gravisain\Components\PageHeader;
use Gravisain\Components\Breadcrumbs;

$alignment     = get_theme_mod( 'gravisain_page_header_alignment', 'center' );
$bg_type       = get_theme_mod( 'gravisain_page_header_bg_type', 'gradient' );
$breadcrumbs   = get_theme_mod( 'gravisain_page_header_breadcrumbs', 'below_title' );
$title         = PageHeader::get_title();

$classes = [
	'gravisain-page-header-hero',
	'align-' . esc_attr( $alignment ),
	'bg-' . esc_attr( $bg_type ),
];

$bg_style = '';
if ( 'featured' === $bg_type && has_post_thumbnail() && ( is_single() || is_page() ) ) {
	$img_url = get_the_post_thumbnail_url( null, 'full' );
	if ( $img_url ) {
		$bg_style  = 'background-image: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.75)), url(' . esc_url( $img_url ) . ');';
		$classes[] = 'has-featured-bg';
	}
}
?>
<header class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" <?php echo ! empty( $bg_style ) ? 'style="' . esc_attr( $bg_style ) . '"' : ''; ?>>
	<div class="gravisain-hero-container">
		<?php if ( 'above_title' === $breadcrumbs ) : ?>
			<div class="hero-breadcrumbs-wrapper above-title">
				<?php Breadcrumbs::render(); ?>
			</div>
		<?php endif; ?>

		<h1 class="gravisain-hero-title"><?php echo wp_kses_post( $title ); ?></h1>

		<?php if ( 'below_title' === $breadcrumbs ) : ?>
			<div class="hero-breadcrumbs-wrapper below-title">
				<?php Breadcrumbs::render(); ?>
			</div>
		<?php endif; ?>
	</div>
</header>
