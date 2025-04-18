<?php // Absolute All-in-One Plugin

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Plugin Name: Absolute All-In-One
 * Description: Modular plugin that includes admin tools, custom post types, shortcodes, Ajax examples, and more. 
 * Author: Martin Grigoryan
 * Version: 1.2.1
 * Text Domain: absolute-all-in-one
 * Domain Path: /languages
*/

// Constants
define( 'AAIO_VERSION', '1.0.0');
define( 'AAIO_PLUGIN_DIR', plugin_dir_path( __FILE__ )); // for includes/require
define( 'AAIO_PLUGIN_URL', plugin_dir_url( __FILE__ )); // for asset URLs (css/js)
define( 'AAIO_TD', 'absolute-all-in-one' ); // tired of typing the text domain

// Helpers (Admin notice...)
require_once AAIO_PLUGIN_DIR . 'admin/helpers.php';

// Load text domain for i18n
function aaio_load_textdomain() {
	load_plugin_textdomain( 'absolute-all-in-one', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

// Load admin menu logic
if ( is_admin() ) {
	require_once AAIO_PLUGIN_DIR . 'admin/admin-menu.php'; 
}

// === Load Settings (Both Admin and Front-End Logic) ===
require_once AAIO_PLUGIN_DIR . 'admin/settings/settings-loader.php';


// === Hooked Actions ===

add_action( 'plugins_loaded', 'aaio_load_textdomain' ); // plugins_loaded to make sure all translations are ready

//error_log( 'WP_DEBUG is working and writing to the log.' );