<?php
/**
 * The template for displaying search results pages (Root Fallback)
 *
 * @package Gravisain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( file_exists( __DIR__ . '/templates/search.php' ) ) {
	require __DIR__ . '/templates/search.php';
	return;
}
