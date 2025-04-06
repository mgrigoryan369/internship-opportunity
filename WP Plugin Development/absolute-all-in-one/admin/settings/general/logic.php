<?php // Logic: General Settings | applies logic

// TODO:
//  Move each function to its own file for
//  easier future maintenance and additions 

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// === HOOKS ===
add_action( 'admin_init', 'aaio_handle_general_settings_save' ); // Admin notices
add_action( 'init', 'aaio_apply_admin_bar_setting' ); // Apply admin bar logic 
add_action( 'init', 'aaio_apply_emoji_setting' ); // Apply Emoji removal logic
add_action( 'init', 'aaio_disable_wp_version' ); // Apply WP metadata removal logic

add_filter( 'upload_mimes', 'aaio_enable_svg_uploads' ); // Add SVG to mimes
add_filter( 'wp_check_filetype_and_ext', 'aaio_check_svg_file', 10, 4 ); // Additional basic check, safety net
add_filter( 'wp_generate_attachment_metadata', 'aaio_skip_svg_sizes', 10, 2 ); // Skip size generation 


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


// === SVG === Add SVG to allowed mime types for admins only
function aaio_enable_svg_uploads( $mimes ) {
    
    if ( ! get_option( 'aaio_enable_svg_uploads' ) ){
        return $mimes;
    }

    // Allow only admins for safety
    if ( current_user_can( 'administrator' ) ){
        $mimes['svg'] = 'image/svg+xml';
    }

    return $mimes;

}

// === SVG === Add SVG filetype check, another basic layer of security a safety net
function aaio_check_svg_file( $data, $file, $filename, $mimes ) {

    if ( ! get_option( 'aaio_enable_svg_uploads' ) ){
        return $data;
    }

    // Verify if admin and file has .svg extension then manually set it
    if ( current_user_can( 'administrator' ) && 'svg' === strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) ) ) {
        $data['ext'] = 'svg';
        $data['type'] = 'image/svg+xml';
    }

    return $data;

}

// === SVG === Prevent WordPress from trying to generate image sizes for SVGs
function aaio_skip_svg_sizes( $metadata, $attachment_id ) {
	
    $mime = get_post_mime_type( $attachment_id );
	
    if ( $mime === 'image/svg+xml' ) {
		// Don't generate image sizes
		return array();
	}

	return $metadata;

}

// Admin notice for General Tab
function aaio_handle_general_settings_save() {
	if ( 
        isset( $_GET['page'], $_GET['settings-updated'] ) &&
		$_GET['page'] === 'aaio' &&
		$_GET['settings-updated'] === 'true' 
    ) {

        // Treat no tab OR tab=general as "general"
        $tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general';
        
        if ( $tab === 'general' ) {
            aaio_redirect_with_notice( 'general', 'settings_saved' );
        }
	}
}