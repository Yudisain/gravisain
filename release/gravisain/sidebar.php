<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gravisain
 */

$sidebar_id = 'sidebar-1';
if ( class_exists( '\\Gravisain\\Meta\\PageSettings' ) ) {
	$meta_choice = \Gravisain\Meta\PageSettings::get_sidebar_choice();
	if ( ! empty( $meta_choice ) && 'default' !== $meta_choice && is_active_sidebar( $meta_choice ) ) {
		$sidebar_id = $meta_choice;
	}
}

if ( ! is_active_sidebar( $sidebar_id ) ) {
	?>
	<aside id="secondary" class="widget-area sidebar-area" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar Area', 'gravisain' ); ?>">
		<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
			<section class="widget widget_placeholder" style="padding: 1.5rem; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px;">
				<h2 class="widget-title" style="font-size: 1.1rem; font-weight: 700; margin-bottom: 0.5rem; color: #0f172a;"><?php esc_html_e( 'Main Sidebar', 'gravisain' ); ?></h2>
				<p style="font-size: 0.9rem; color: #64748b; margin-bottom: 0;">
					<?php
					printf(
						/* translators: %s: URL to widgets administration screen. */
						wp_kses_post( __( 'This sidebar widget area is currently empty. You can add widgets from the <a href="%s" style="color: #2563eb; text-decoration: underline;">Widgets dashboard</a> or Customizer.', 'gravisain' ) ),
						esc_url( admin_url( 'widgets.php' ) )
					);
					?>
				</p>
			</section>
		<?php else : ?>
			<?php if ( class_exists( 'WP_Widget_Search' ) ) { the_widget( 'WP_Widget_Search', [ 'title' => __( 'Search', 'gravisain' ) ] ); } ?>
			<?php if ( class_exists( 'WP_Widget_Recent_Posts' ) ) { the_widget( 'WP_Widget_Recent_Posts', [ 'title' => __( 'Recent Posts', 'gravisain' ), 'number' => 5 ] ); } ?>
		<?php endif; ?>
	</aside><!-- #secondary -->
	<?php
	return;
}
?>

<aside id="secondary" class="widget-area sidebar-area" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar Area', 'gravisain' ); ?>">
	<?php dynamic_sidebar( $sidebar_id ); ?>
</aside><!-- #secondary -->
