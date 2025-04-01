<?php // SETTINGS: GENERAL TAB

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// === HOOKS ===
add_action( 'admin_init', 'aaio_register_general_settings' ); // Register Settings
add_action( 'aaio_tab_general', 'aaio_render_general_tab_content' ); // Output tab content
add_action( 'init', 'aaio_apply_admin_bar_setting' ); // Apply admin bar logic 
add_action( 'init', 'aaio_apply_emoji_setting' ); // Apply Emoji removal logic


// Render content in General Tab
function aaio_render_general_tab_content() {

    ?>

    <form method="post" action="options.php">
        <?php 
        settings_fields( 'aaio_general_settings_group' );
        do_settings_sections( 'aaio_general_settings_page' );
        submit_button();
        ?>
    </form>

    <?php

}


// Register settings and field
function aaio_register_general_settings() {

    // Settings
    register_setting( 'aaio_general_settings_group', 'aaio_disable_admin_bar' );
    register_setting( 'aaio_general_settings_group', 'aaio_disable_emojis' );


    add_settings_section (
        'aaio_general_section', // Section ID
        __( 'General Settings', 'absolute-all-in-one'), // Title
        '__return_false', // Callback function for description
        'aaio_general_settings_page' // Slug this section belongs to
    );

    add_settings_field (
        'aaio_disable_admin_bar', // Field ID
        __( 'Disable Admin Bar for front-end', 'absolute-all-in-one' ), // Field label
        'aaio_render_admin_bar_checkbox', // Render callback function
        'aaio_general_settings_page', // Settings page slug
        'aaio_general_section' // Section ID this field is grouped under
    );

    add_settings_field (
        'aaio_disable_emojis',
        __( 'Disable Emoji Support', 'absolute-all-in-one' ),
        'aaio_render_emoji_checkbox',
        'aaio_general_settings_page',
        'aaio_general_section'
    );

}


// Render Admin Bar checkbox field
function aaio_render_admin_bar_checkbox() {
    
    $option = get_option( 'aaio_disable_admin_bar', false );
    
    ?>

    <div class="aaio-settings-row">
        <label class="aaio-toggle">
            <input type="checkbox" name="aaio_disable_admin_bar" value="1" <?php checked( $option, 1 ); ?> />
            <span class="aaio-slider"></span>
        </label>
        <span style="margin-left: 10px;">
            <?php esc_html_e( 'Hide admin bar when viewing website on front-end', 'absolute-all-in-one' ); ?>
        </span>
    </div>
    
    <?php 

}

// Render Emoji checkbox field
function aaio_render_emoji_checkbox() {

    $option = get_option( 'aaio_disable_emojis', false );

    ?>

    <div class="aaio-settings-row">
        <label class="aaio-toggle">
            <input type="checkbox" name="aaio_disable_emojis" class="aaio-toggle" value="1" <?php checked( $option, 1 ); ?> />
            <span class="aaio-slider"></span>
        </label>
        <span style="margin-left: 10px;">
            <?php esc_html_e( 'Remove emoji scripts/styles front-end & back-end', 'absolute-all-in-one' ); ?>
        </span>
    </div>

    <?php

}


// === Logic for Settings ===

// Hide admin bar based on setting
function aaio_apply_admin_bar_setting() {
    
    // Disable front-end admin bar for Everyone
    if ( ! is_admin() && get_option( 'aaio_disable_admin_bar' ) ){
        add_filter( 'show_admin_bar', '__return_false', 1000 );
        error_log( 'AAIO: Admin bar disabled on front-end' );
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