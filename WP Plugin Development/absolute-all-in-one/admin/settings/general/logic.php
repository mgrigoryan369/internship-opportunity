<?php // Logic: General Settings | applies logic

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// === HOOKS ===
add_action( 'init', 'aaio_apply_admin_bar_setting' ); // Apply admin bar logic 
add_action( 'init', 'aaio_apply_emoji_setting' ); // Apply Emoji removal logic
add_action( 'init', 'aaio_disable_wp_version' ); // Apply WP metadata removal logic


// Hide admin bar based on setting
function aaio_apply_admin_bar_setting() {
    
    // Disable front-end admin bar for Everyone
    if ( ! is_admin() && get_option( 'aaio_disable_admin_bar' ) ){
        add_filter( 'show_admin_bar', '__return_false', 1000 );
        // error_log( 'AAIO: Admin bar disabled on front-end' );
    }

}


// Remove Emojis from everywhere
function aaio_apply_emoji_setting() {
   
    if ( get_option( 'aaio_disable_emojis') ){

        // Front-end
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );

        // Back-end
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );

        // TinyMCE
        add_filter( 'tiny_mce_plugins', function( $plugins ) {
            if ( is_array( $plugins) ){
                return array_diff( $plugins, array( 'wpemoji' ) );
            }
            return [];
        });

    }

}


// Disable WP Version from website metadata
function aaio_disable_wp_version() {
    
    if ( get_option( 'aaio_disable_wp_version' ) ) {
        remove_action( 'wp_head', 'wp_generator' );
    }

}
