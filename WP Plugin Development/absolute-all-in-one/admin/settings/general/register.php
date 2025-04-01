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
    register_setting( 'aaio_general_settings_group', 'aaio_enable_svg_uploads' );


    add_settings_section (
        'aaio_general_section', // Section ID
        __( 'General Settings', AAIO_TD ), // Title
        '__return_false', // Callback function for description
        'aaio_general_settings_page' // Slug this section belongs to
    );

    add_settings_field (
        'aaio_disable_admin_bar', // Field ID
        __( 'Disable Admin Bar for front-end', AAIO_TD ), // Field label
        'aaio_render_admin_bar_checkbox', // Render callback function
        'aaio_general_settings_page', // Settings page slug
        'aaio_general_section' // Section ID this field is grouped under
    );

    add_settings_field (
        'aaio_disable_emojis',
        __( 'Disable Emoji Support', AAIO_TD ),
        'aaio_render_emoji_checkbox',
        'aaio_general_settings_page',
        'aaio_general_section'
    );

    add_settings_field (
        'aaio_disable_wp_version',
        __( 'Disable WP Version', AAIO_TD ),
        'aaio_render_wp_version_checkbox',
        'aaio_general_settings_page',
        'aaio_general_section'
    );

    add_settings_field (
        'aaio_enable_svg_uploads',
        __( 'Allow SVG Uploads', AAIO_TD),
        'aaio_render_svg_upload_checkbox',
        'aaio_general_settings_page',
        'aaio_general_section'
    );

}