<?php
/* 
Plugin Name: Options API
Description: Mini plugin demonstrating how to add/update/delete options using the options api
Plugin URI: https://github.com/mgrigoryan369
Author: Martin Grigoryan
Version: 1.0
Text Domain: mg-plugin
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpls-2.0.txt
*/

// exit if file is called directly
if (!defined('ABSPATH')){
    exit;
}

// ADD option
function mg_plugin_add_option(){
    /*
		add_option(
			string      $option,
			mixed       $value = '',
			string      $deprecated = '',
			string|bool $autoload = 'yes'
		)
	*/

    $option_value = 'Example option value';

    add_option('mg-plugin-option-name', $option_value);
}


// UPDATE option
function mg_plugin_update_option(){
    /*
		update_option(
			string      $option,
			mixed       $value,
			string|bool $autoload = null
		)
	*/

    $option_value = array(
        'option1' => 'val1', 
        'option2' => 'val2', 
        'option3' => 'val3' 
    );

    update_option('mg-plugin-option-name', $option_value);
}


// DELETE option
function mg_plugin_delete_option(){
    /*
		delete_option(
			string $option
		)
	*/

    delete_option('mg-plugin-option-name');
}

// Hook into admin_init and add/update/delete option
// add_action('admin_init', 'mg_plugin_add_option'); 
// add_action('admin_init', 'mg_plugin_update_option'); 
// add_action('admin_init', 'mg_plugin_delete_option'); 