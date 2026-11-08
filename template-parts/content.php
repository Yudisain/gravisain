<?php
/**
 * Template part for displaying posts (Redirect to modular content)
 *
 * @package Gravisain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part( 'template-parts/content/content', get_post_type() );
