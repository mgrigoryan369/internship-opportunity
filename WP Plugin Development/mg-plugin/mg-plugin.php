<?php
/* 
Plugin Name: MG Plugin
Description: Basic WP Plugin for LinkedIn Learning Course
Plugin URI: https://github.com/mgrigoryan369
Author: Martin Grigoryan
Version: 1.0
Text Domain: mg-plugin
Domain Path: /languages
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpls-2.0.txt
*/

// exit if file is called directly
if (!defined('ABSPATH')){
    exit;
}

// load text domain
function mg_plugin_load_textdomain() {
	
	load_plugin_textdomain( 'mg-plugin', false, plugin_dir_path( __FILE__ ) . 'languages/' );
	
}
add_action( 'plugins_loaded', 'mg_plugin_load_textdomain' );

// if admin area
if (is_admin()) {
    // Include dependencies
    require_once plugin_dir_path(__FILE__) . 'admin/admin-menu.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-register.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-callbacks.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-validate.php';
}

// include dependencies: admin & public
require_once plugin_dir_path(__FILE__) . 'includes/core-functions.php';

// default plugin options
function mg_plugin_options_default() {

	return array(
		'custom_url'     => 'https://wordpress.org/',
		'custom_title'   => esc_html__('Powered by WordPress', 'mg-plugin'),
		'custom_style'   => 'disable',
		'custom_message' => '<p class="custom-message">' . esc_html__('My custom message', 'mg-plugin') . '</p>',
		'custom_footer'  => esc_html__('Special message for users', 'mg-plugin'),
		'custom_toolbar' => false,
		'custom_scheme'  => 'default',
	);
}