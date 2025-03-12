<?php

/**
 * Plugin Name: LinkedIn Learning Gravity Forms
 * Plugin URI: https://github.com/mgrigoryan369
 * Description: Simple plugin using hooks to modify GF
 * Version: 1.0.2
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
define('LIL_GF_VERSION', '1.0.2');
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

// Star the entry after donation form submission (Form ID: 4)
function lil_gf_star_donors($entry, $form){
    //GFCommon::log_debug('LILGF Entry : ' . print_r($entry, true));
    //GFCommon::log_debug('LILGF Form: ' . print_r($form, true));
    //GFCommon::log_debug('LILGF Entry Payment Amount: ' . print_r($entry['payment_amount'], true));
    //GFCommon::log_debug('LILGF Entry Form ID: ' . print_r($entry['form_id'], true));

    //$donation = rgar($entry, 'payment_amount');
    //$form_id = $form['id'];

    if($entry['form_id'] == 4 && $entry['payment_amount'] > 99){
        GFAPI::update_entry_property(rgar($entry, 'id'), 'is_starred', 1);
    }
}


// Hook: Modify the 'First Name' label in Gravity Forms
add_filter('gform_name_first', 'lil_gf_change_first', 10, 2);

// Hook: Restrict the available countries in the Gravity Forms dropdown
add_filter('gform_countries', 'lil_gf_limit_countries');

// Hook: Prevent Gravity Forms from saving the user's IP address
add_filter('gform_ip_address', '__return_empty_string');

// Hook: Runs after a Gravity Forms submission to star the entry
add_action('gform_after_submission', 'lil_gf_star_donors', 10, 2);