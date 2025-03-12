<?php

/**
 * Plugin Name: LinkedIn Learning Gravity Forms
 * Plugin URI: https://github.com/mgrigoryan369
 * Description: Simple plugin using hooks to modify GF
 * Version: 1.0.1
 * Author: Martin Grigoryan
 * Author URI: https:/github.com/mgrigoryan369
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Prevent direct access
if (!defined('WPINC')){
    exit;
}

// Plugin version & URL constant
define('LIL_GF_VERSION', '1.0.1');
define('LIL_GF_URL', plugin_dir_url(__FILE__));

// Modify the default form label for 'First Name' in Gravity Forms (Form ID: 1)
function lil_gf_change_first($label, $form_id){
    if ($form_id == 1) {
        return "What's your first name?";
    }

    return $label;
}

// Modify and sort the default Gravity Forms countries array to allow only specific countries
function lil_gf_limit_countries($countries){
    $countries = ['United States', 'Armenia', 'Russia', 'Canada', 'Mexico', 'United Kingdom', 'Ireland', 'Italy'];
    sort($countries);

    return $countries;
}


// Hook: Modify the 'First Name' label in Gravity Forms
add_filter('gform_name_first', 'lil_gf_change_first', 10, 2);

// Hook: Restrict the available countries in the Gravity Forms dropdown
add_filter('gform_countries', 'lil_gf_limit_countries');

// Hook: Prevent Gravity Forms from saving the user's IP address
add_filter('gform_ip_address', '__return_empty_string');