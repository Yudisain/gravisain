<?php
/**
 * The template for displaying all single posts (Root Fallback)
 *
 * @package Gravisain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( file_exists( __DIR__ . '/templates/single.php' ) ) {
	require __DIR__ . '/templates/single.php';
	return;
}
