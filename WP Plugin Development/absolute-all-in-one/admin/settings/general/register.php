<?php // Register: General Settings | defines settings + fields

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Register settings and field
function aaio_register_general_settings() {

    // Settings
    register_setting( 'aaio_general_settings_group', 'aaio_disable_admin_bar' );
    register_setting( 'aaio_general_settings_group', 'aaio_disable_emojis' );
    register_setting( 'aaio_general_settings_group', 'aaio_disable_wp_version' );


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

    add_settings_field (
        'aaio_disable_wp_version',
        __( 'Disable WP Version', 'absolute-all-in-one' ),
        'aaio_render_wp_version_checkbox',
        'aaio_general_settings_page',
        'aaio_general_section'
    );

}