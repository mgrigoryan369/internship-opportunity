<?php // Register: Features Settings | defines settings + fields

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// Register settings and field
function aaio_register_features_settings() {

    // Settings
    register_setting( 'aaio_features_settings_group', 'aaio_enable_testimonials' );
    register_setting( 'aaio_features_settings_group', 'aaio_enable_services' );
    register_setting( 'aaio_features_settings_group', 'aaio_enable_portfolio' );


    add_settings_section (
        'aaio_features_section', // Section ID
        __( 'Custom Post Types (CPT)', 'absolute-all-in-one'), // Title
        '__return_false', // Callback function for description
        'aaio_features_settings_page' // Slug this section belongs to
    );

    add_settings_field (
        'aaio_enable_testimonials', // Field ID
        __( 'Enable Testimonials', 'absolute-all-in-one' ), // Field label
        'aaio_render_testimonials_checkbox', // Render callback function
        'aaio_features_settings_page', // Settings page slug
        'aaio_features_section' // Section ID this field is grouped under
    );

    add_settings_field (
        'aaio_enable_services',
        __( 'Enable Services', 'absolute-all-in-one' ),
        'aaio_render_services_checkbox',
        'aaio_features_settings_page',
        'aaio_features_section'
    );

    add_settings_field (
        'aaio_enable_portfolio',
        __( 'Enable Portfolio', 'absolute-all-in-one' ),
        'aaio_render_portfolio_checkbox',
        'aaio_features_settings_page',
        'aaio_features_section'
    );

}