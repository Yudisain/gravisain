<?php
/**
 * Main Template File (Root Fallback)
 *
 * @package Gravisain
 */

if ( file_exists( __DIR__ . '/templates/index.php' ) ) {
	require __DIR__ . '/templates/index.php';
	return;
}

get_header();
?>
<main id="primary" class="site-main">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content/content', get_post_type() );
		endwhile;
	endif;
	?>
</main>
<?php
get_footer();
