<?php // Loader: Features - Testimonials

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if testimonials feature is enabled before loading anything
if ( ! get_option( 'aaio_enable_testimonials' ) ) {
	return;
}

// === Load Testimonials Feature Modules ===
require_once __DIR__ . '/styles.php';
require_once __DIR__ . '/shortcode.php';