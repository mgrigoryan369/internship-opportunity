<?php // Loader: Features - Testimonials

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//error_log('Testimonials loader.php triggered');

// Check if testimonials feature is enabled before loading anything
if ( ! get_option( 'aaio_enable_testimonials' ) ) {
	return;
}

//error_log('Testimonials loader.php the required items triggered');

// === Load Testimonials Feature Modules ===
require_once __DIR__ . '/styles.php';
require_once __DIR__ . '/shortcode.php';