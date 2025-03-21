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

// if admin area
if (is_admin()) {
    // Include dependencies
    require_once plugin_dir_path(__FILE__) . 'admin/admin-menu.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
}