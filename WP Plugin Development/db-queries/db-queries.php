<?php
/* 
Plugin Name: DB Queries
Description: Basic WP Plugin for DB Queries
Plugin URI: https://github.com/mgrigoryan369
Author: Martin Grigoryan
Version: 1.0.0
Text Domain: db-queries
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpls-2.0.txt
*/

// Exit if file is called directly
if (!defined('ABSPATH')){
    exit;
}

// Optional: Define constants for paths (best practice for modular plugins)
define('MG_DBQ_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('MG_DBQ_PLUGIN_URL', plugin_dir_url(__FILE__));


// Load admin features
if (is_admin()) {
	require_once MG_DBQ_PLUGIN_PATH . 'admin/admin-menu.php';
}