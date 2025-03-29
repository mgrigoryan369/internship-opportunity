<?php
/*
Plugin Name: Enqueue Examples
Description: More examples of JavaScript and CSS enqueue functions.
Plugin URI:  https://github.com/mgrigoryan369
Author:      Martin Grigoryan
Version:     1.0.0
*/


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

