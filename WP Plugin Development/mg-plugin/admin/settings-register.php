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
		'Customize Login Page', 
		'mg_plugin_callback_section_login', 
		'mg_plugin'
	);
	
	add_settings_section( 
		'mg_plugin_section_admin', 
		'Customize Admin Area', 
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
		'Custom URL',
		'mg_plugin_callback_field_text',
		'mg_plugin',
		'mg_plugin_section_login',
		[ 'id' => 'custom_url', 'label' => 'Custom URL for the login logo link' ]
	);

	add_settings_field(
		'custom_title',
		'Custom Title',
		'mg_plugin_callback_field_text',
		'mg_plugin',
		'mg_plugin_section_login',
		[ 'id' => 'custom_title', 'label' => 'Custom title attribute for the logo link' ]
	);

	add_settings_field(
		'custom_style',
		'Custom Style',
		'mg_plugin_callback_field_radio',
		'mg_plugin',
		'mg_plugin_section_login',
		[ 'id' => 'custom_style', 'label' => 'Custom CSS for the Login screen' ]
	);

	add_settings_field(
		'custom_message',
		'Custom Message',
		'mg_plugin_callback_field_textarea',
		'mg_plugin',
		'mg_plugin_section_login',
		[ 'id' => 'custom_message', 'label' => 'Custom text and/or markup' ]
	);

	add_settings_field(
		'custom_footer',
		'Custom Footer',
		'mg_plugin_callback_field_text',
		'mg_plugin',
		'mg_plugin_section_admin',
		[ 'id' => 'custom_footer', 'label' => 'Custom footer text' ]
	);

	add_settings_field(
		'custom_toolbar',
		'Custom Toolbar',
		'mg_plugin_callback_field_checkbox',
		'mg_plugin',
		'mg_plugin_section_admin',
		[ 'id' => 'custom_toolbar', 'label' => 'Remove new post and comment links from the Toolbar' ]
	);

	add_settings_field(
		'custom_scheme',
		'Custom Scheme',
		'mg_plugin_callback_field_select',
		'mg_plugin',
		'mg_plugin_section_admin',
		[ 'id' => 'custom_scheme', 'label' => 'Default color scheme for new users' ]
	);


}
add_action( 'admin_init', 'mg_plugin_register_settings' );