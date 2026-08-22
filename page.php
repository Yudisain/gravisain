<?php
/**
 * The template for displaying all pages (Root Fallback)
 *
 * @package Gravisain
 */

if ( file_exists( __DIR__ . '/templates/page.php' ) ) {
	require __DIR__ . '/templates/page.php';
	return;
}
