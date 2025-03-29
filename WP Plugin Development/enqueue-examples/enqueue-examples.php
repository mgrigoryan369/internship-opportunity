<?php
/*
Plugin Name: Enqueue Examples
Description: More examples of JavaScript and CSS enqueue functions.
Plugin URI:  https://github.com/mgrigoryan369
Author:      Martin Grigoryan
Version:     1.0.0
*/

// exit if file is called directly
if (!defined('ABSPATH')){
    exit;
}


// enqueue admin stylesheet on specific page
add_action('admin_enqueue_scripts', 'mg_plugin_enqueue_style_admin_page');

function mg_plugin_enqueue_style_admin_page($hook){
    //wp_die($hook);

    // This will conditionally target the admin settings page for the mg-plugin created earlier in this course
    if('settings_page_mg_plugin' === $hook){
        $src = plugin_dir_url(__FILE__) . 'admin/css/example-admin.css';
        
        wp_enqueue_style('mg-plugin-admin-page', $src, array(), null, 'all');
    }
}

// enqueue admin stylesheet on specific page type
add_action('admin_enqueue_scripts', 'mg_plugin_enqueue_style_admin_pages');

function mg_plugin_enqueue_style_admin_pages($hook){

    if ('edit.php' === $hook) {
		$src = plugin_dir_url(__FILE__) .'admin/css/example-admin.css';

        wp_enqueue_style('mg-plugin-admin-pages', $src, array(), null, 'all');
	}
}

// enqueue with jQuery dependency example for specific admin page (settings page for mg plugin)
add_action('admin_enqueue_scripts', 'mg_plugin_enqueue_jquery_admin');

function mg_plugin_enqueue_jquery_admin($hook){

    if ($hook !== 'settings_page_mg_plugin') return; // uncomment to load it everywhere in admin

    $src = plugin_dir_url(__FILE__) . 'admin/js/example-admin.js';

    wp_enqueue_script('mg-plugin-admin', $src, array('jquery'), '1.0');
}

// enqueue with jQuery dependency example for public pages
add_action('wp_enqueue_scripts', 'mg_plugin_enqueue_jquery_public');

function mg_plugin_enqueue_jquery_public(){

    $src = plugin_dir_url(__FILE__) . 'public/js/example-public.js';

    wp_enqueue_script('mg-plugin-public', $src, array('jquery'), '1.0');
}

// enqueue login style
add_action( 'login_enqueue_scripts', 'mg_plugin_enqueue_style_login' );

function mg_plugin_enqueue_style_login() {

	$src = plugin_dir_url(__FILE__) . 'admin/css/example-admin.css';

	wp_enqueue_style('mg-plugin-login', $src, array(), null, 'all');
}

// enqueue login script
add_action('login_enqueue_scripts', 'mg_plugin_enqueue_script_login');

function mg_plugin_enqueue_script_login() {

	$src = plugin_dir_url(__FILE__) . 'admin/js/example-admin.js';

	wp_enqueue_script('mg-plugin-login', $src, array('jquery'), null, false);
}

// enqueue public style
add_action('wp_enqueue_scripts', 'mg_plugin_enqueue_style_public');

function mg_plugin_enqueue_style_public() {

	$src = plugin_dir_url(__FILE__) . 'public/css/example-public.css';

	wp_enqueue_style('mg-plugin-public-css', $src, array(), null, 'all');
}

// enqueue public script
add_action('wp_enqueue_scripts', 'mg_plugin_enqueue_script_public');

function mg_plugin_enqueue_script_public() {

	$src = plugin_dir_url(__FILE__) . 'public/js/example-public.js';

	wp_enqueue_script('mg-plugin-public-js', $src, array('jquery'), null, false);

}

