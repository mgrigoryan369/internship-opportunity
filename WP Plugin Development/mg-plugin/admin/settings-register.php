<?php // MG Plugin - Register Settings

// exit if file is called directly
if (!defined('ABSPATH')){
    exit;
}

// register plugin settings
function mg_plugin_register_settings() {
	
	/*
	register_setting( 
		string   $option_group, 
		string   $option_name, 
		callable $sanitize_callback
	);
	
	*/
	
	register_setting( 
		'mg_plugin_options', 
		'mg_plugin_options', 
		'mg_plugin_callback_validate_options' 
	);
    
    /*
	
	add_settings_section( 
		string   $id, 
		string   $title, 
		callable $callback, 
		string   $page
	);
	
	*/
	
	add_settings_section( 
		'mg_plugin_section_login', 
		esc_html__('Customize Login Page', 'mg-plugin'), 
		'mg_plugin_callback_section_login', 
		'mg_plugin'
	);
	
	add_settings_section( 
		'mg_plugin_section_admin', 
		esc_html__('Customize Admin Area', 'mg-plugin'), 
		'mg_plugin_callback_section_admin', 
		'mg_plugin'
	);

    	/*

	add_settings_field(
    	string   $id,
		string   $title,
		callable $callback,
		string   $page,
		string   $section = 'default',
		array    $args = []
	);

	*/

	add_settings_field(
		'custom_url',
		esc_html__('Custom URL', 'mg-plugin'),
		'mg_plugin_callback_field_text',
		'mg_plugin',
		'mg_plugin_section_login',
		[ 'id' => 'custom_url', 'label' => esc_html__('Custom URL for the login logo link', 'mg-plugin') ]
	);

	add_settings_field(
		'custom_title',
		esc_html__('Custom Title', 'mg-plugin'),
		'mg_plugin_callback_field_text',
		'mg_plugin',
		'mg_plugin_section_login',
		[ 'id' => 'custom_title', 'label' => esc_html__('Custom title attribute for the logo link', 'mg-plugin') ]
	);

	add_settings_field(
		'custom_style',
		esc_html__('Custom Style', 'mg-plugin'),
		'mg_plugin_callback_field_radio',
		'mg_plugin',
		'mg_plugin_section_login',
		[ 'id' => 'custom_style', 'label' => esc_html__('Custom CSS for the Login screen', 'mg-plugin') ]
	);

	add_settings_field(
		'custom_message',
		esc_html__('Custom Message', 'mg-plugin'),
		'mg_plugin_callback_field_textarea',
		'mg_plugin',
		'mg_plugin_section_login',
		[ 'id' => 'custom_message', 'label' => esc_html__('Custom text and/or markup', 'mg-plugin') ]
	);

	add_settings_field(
		'custom_footer',
		esc_html__('Custom Footer', 'mg-plugin'),
		'mg_plugin_callback_field_text',
		'mg_plugin',
		'mg_plugin_section_admin',
		[ 'id' => 'custom_footer', 'label' => esc_html__('Custom footer text', 'mg-plugin') ]
	);

	add_settings_field(
		'custom_toolbar',
		esc_html__('Custom Toolbar', 'mg-plugin'),
		'mg_plugin_callback_field_checkbox',
		'mg_plugin',
		'mg_plugin_section_admin',
		[ 'id' => 'custom_toolbar', 'label' => esc_html__('Remove new post and comment links from the Toolbar', 'mg-plugin') ]
	);

	add_settings_field(
		'custom_scheme',
		esc_html__('Custom Scheme', 'mg-plugin'),
		'mg_plugin_callback_field_select',
		'mg_plugin',
		'mg_plugin_section_admin',
		[ 'id' => 'custom_scheme', 'label' => esc_html__('Default color scheme for new users', 'mg-plugin') ]
	);


}
add_action( 'admin_init', 'mg_plugin_register_settings' );