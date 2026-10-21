<?php
/**
 * Logo Component
 *
 * @package Gravisain\Components
 */

$show_title   = get_theme_mod( 'gravisain_show_site_title', true );
$title_vis    = get_theme_mod( 'gravisain_site_title_visibility', 'desktop,tablet,mobile' );
$show_tagline = get_theme_mod( 'gravisain_show_site_tagline', true );
$tagline_vis  = get_theme_mod( 'gravisain_site_tagline_visibility', 'desktop,tablet,mobile' );

// Calculate visibility classes for title
$title_classes = [];
if ( ! empty( $title_vis ) ) {
	if ( false === strpos( $title_vis, 'desktop' ) ) {
		$title_classes[] = 'gravisain-hide-desktop';
	}
	if ( false === strpos( $title_vis, 'tablet' ) ) {
		$title_classes[] = 'gravisain-hide-tablet';
	}
	if ( false === strpos( $title_vis, 'mobile' ) ) {
		$title_classes[] = 'gravisain-hide-mobile';
	}
}

// Calculate visibility classes for tagline
$tagline_classes = [];
if ( ! empty( $tagline_vis ) ) {
	if ( false === strpos( $tagline_vis, 'desktop' ) ) {
		$tagline_classes[] = 'gravisain-hide-desktop';
	}
	if ( false === strpos( $tagline_vis, 'tablet' ) ) {
		$tagline_classes[] = 'gravisain-hide-tablet';
	}
	if ( false === strpos( $tagline_vis, 'mobile' ) ) {
		$tagline_classes[] = 'gravisain-hide-mobile';
	}
}

$trans_logo_id  = get_theme_mod( 'gravisain_transparent_header_logo' );
$trans_logo_url = ( \Gravisain\Helpers\HeaderHelper::is_transparent_header() && $trans_logo_id )
	? wp_get_attachment_image_url( $trans_logo_id, 'full' )
	: false;
$has_trans_logo = ! empty( $trans_logo_url );

$sticky_logo_id  = get_theme_mod( 'gravisain_sticky_header_logo' );
$sticky_logo_url = ( 'none' !== \Gravisain\Helpers\HeaderHelper::get_sticky_header_mode() && $sticky_logo_id )
	? wp_get_attachment_image_url( $sticky_logo_id, 'full' )
	: false;
$has_sticky_logo = ! empty( $sticky_logo_url );

$branding_classes = [ 'site-branding' ];
if ( $has_trans_logo ) {
	$branding_classes[] = 'has-transparent-logo';
}
if ( $has_sticky_logo ) {
	$branding_classes[] = 'has-sticky-logo';
}
?>
<div class="<?php echo esc_attr( implode( ' ', $branding_classes ) ); ?>">
	<?php
	if ( $has_trans_logo ) {
		echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="transparent-custom-logo-link" rel="home">';
		echo '<img src="' . esc_url( $trans_logo_url ) . '" class="transparent-logo custom-logo" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
		echo '</a>';
	}

	if ( $has_sticky_logo ) {
		echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="sticky-custom-logo-link" rel="home">';
		echo '<img src="' . esc_url( $sticky_logo_url ) . '" class="sticky-logo custom-logo" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
		echo '</a>';
	}

	if ( has_custom_logo() ) {
		the_custom_logo();
	}

	if ( ( $show_title || is_customize_preview() ) || ( $show_tagline || is_customize_preview() ) ) :
		?>
		<div class="site-title-wrapper">
			<?php if ( $show_title || is_customize_preview() ) : ?>
				<h1 class="site-title <?php echo esc_attr( implode( ' ', $title_classes ) ); ?>" <?php if ( ! $show_title ) { echo 'style="display:none;"'; } ?>>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
			<?php endif; ?>

			<?php
			$description = get_bloginfo( 'description', 'display' );
			if ( ( $description && $show_tagline ) || is_customize_preview() ) :
				?>
				<p class="site-description <?php echo esc_attr( implode( ' ', $tagline_classes ) ); ?>" <?php if ( ! $show_tagline ) { echo 'style="display:none;"'; } ?>>
					<?php echo wp_kses_post( $description ); ?>
				</p>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
