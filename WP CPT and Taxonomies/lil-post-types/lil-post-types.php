<?php 
/** 
 * Plugin Name: Business Directory Post Types & Taxonomies
 * Plugin URI: http://github.com/mgrigoryan369
 * Description: A simple plugin for creating custom post types and taxonomies related to a business directory
 * Version: 1.0.3
 * Author: Martin Grigoryan
 * Author URI: https://github.com/mgrigoryan369
 * License: GPL-2.0+
 * License UIR: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: lil-post-types
 * Domain Path: /languages
 */

// Prevent direct access
if (!defined('WPINC')){
    exit;
}

//Define version, domain, and path
define('LIL_VERSION', '1.0.3');
define('LILDOMAIN', 'lil-post-types');
define('LILPATH', plugin_dir_path(__FILE__));

//Modules
require_once(LILPATH . '/post-types/register.php');
require_once(LILPATH . '/post-taxonomies/register.php');


//Actions
add_action('init', 'lil_register_business_type');
add_action('init', 'lil_register_event_type');
add_action('init', 'lil_register_size_taxonomy');