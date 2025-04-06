<?php // Styles: Testimonials CSS + JS

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load the CSS/JS only if testimonials is enabled
function aaio_enqueue_testimonials_assets() {
    if ( ! get_option( 'aaio_enable_testimonials' ) ) {
        return;
    }

    // Swiper core CSS & JS
    wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11.0.0' );
    wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11.0.0', true );

    // Our own CSS/JS for additonal control
    //wp_enqueue_style( 'aaio-testimonials-style', AAIO_PLUGIN_URL . 'admin/settings/features/testimonials/assets/testimonials.css', [], AAIO_VERSION );
    wp_enqueue_script( 'aaio-testimonials-init', AAIO_PLUGIN_URL . 'admin/settings/features/testimonials/assets/testimonials.js', ['swiper-js'], AAIO_VERSION, true );
}