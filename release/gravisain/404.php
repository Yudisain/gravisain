<?php
/**
 * The template for displaying 404 pages (Root Fallback)
 *
 * @package Gravisain
 */

if ( file_exists( __DIR__ . '/templates/404.php' ) ) {
	require __DIR__ . '/templates/404.php';
	return;
}
