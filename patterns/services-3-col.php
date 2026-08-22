<?php
/**
 * Title: Our Services (3 Columns)
 * Slug: gravisain/services-3-col
 * Categories: gravisain, services
 * Description: A responsive 3-column features grid for services or highlights.
 * Keywords: services, features, grid
 */
?>
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
	<!-- wp:heading {"textAlign":"center"} -->
	<h2 class="wp-block-heading has-text-align-center">Our Premium Services</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center">Discover what makes Gravisain the best choice for your next project.</p>
	<!-- /wp:paragraph -->

	<!-- wp:spacer {"height":"30px"} -->
	<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:gravisain/features-grid {"columns":3} -->
	<div class="wp-block-gravisain-features-grid gravisain-features-grid has-3-columns">
		<!-- wp:gravisain/feature-card {"title":"Lightning Fast","description":"Achieve a perfect 100/100 Core Web Vitals score out of the box.","icon":"performance","iconColor":"#4f46e5"} /-->
		<!-- wp:gravisain/feature-card {"title":"Developer Friendly","description":"Built with modern PHP 8.2+ and strict OOP SOLID architecture.","icon":"editor-code","iconColor":"#4f46e5"} /-->
		<!-- wp:gravisain/feature-card {"title":"SEO Optimized","description":"Clean semantic HTML5 structure that search engines love.","icon":"chart-line","iconColor":"#4f46e5"} /-->
	</div>
	<!-- /wp:gravisain/features-grid -->
</div>
<!-- /wp:group -->
