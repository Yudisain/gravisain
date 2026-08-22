<?php
/**
 * Title: GraviLP Header
 * Slug: gravisain/header-gravilp
 * Categories: header
 * Block Types: core/template-part/header
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"white","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignfull has-white-background-color has-background" style="padding-top:1rem;padding-right:var(--wp--preset--spacing--40);padding-bottom:1rem;padding-left:var(--wp--preset--spacing--40)">
	<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group">
		<!-- wp:site-logo {"width":60,"shouldSyncIcon":false} /-->
		<!-- wp:site-title {"level":0,"style":{"typography":{"fontStyle":"normal","fontWeight":"700","fontSize":"1.5rem"}},"textColor":"gravisain-dark"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group">
		<!-- wp:navigation {"ref":__NAV_ID__,"textColor":"gravisain-dark","layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"right"}} /-->
		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"style":{"color":{"background":"#d97706"}},"textColor":"white"} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-white-color has-text-color has-background wp-element-button" style="background-color:#d97706" href="#pesan">PESAN SEKARANG</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
