<?php

/**
 * Plugin Name: LinkedIn Learning Gravity Forms
 * Plugin URI: https://github.com/mgrigoryan369
 * Description: Simple plugin using hooks to modify GF
 * Version: 1.0.3
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
define('LIL_GF_VERSION', '1.0.3');
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

/* Email notification on partial form submission/save with some extras
*  There is an addon for this, but playing with the data was the purpose.*/
function lil_gf_notify_admin($submission, $resume_token, $form, $entry) {
    GFCommon::log_debug('LILGF Submission Contents: ' . print_r($submission, true));

    $form_title = $form['title'];
    $first_name = "Empty";
    $last_name = "Empty";
    $email = "Empty";
    $phone = "Empty";
    $partial = $submission['partial_entry'];

    // Check if Form ID 2 - Job Application - then extract the Gold
    if ($form['id'] === 2) {

        // First Name (Field ID: 3.3)
        if (!empty($partial['3.3'])) {
            $first_name = $partial['3.3'];
        }

        // Last Name (Field ID: 3.6)
        if (!empty($partial['3.6'])) {
            $last_name = $partial['3.6'];
        }

        // Email (Field ID: 7)
        if (!empty($partial['7'])) {
            $email = $partial['7'];
        }

        // Phone (Field ID: 8)
        if (!empty($partial['8'])) {
            $phone = $partial['8'];
        }
    }

    // Check if this is Form ID 5 - Survey - then extract the Gold
    if ($form['id'] === 5) {

        // First Name (Field ID: 3.3)
        if (!empty($partial['3.3'])) {
            $first_name = $partial['3.3'];
        }

        // Last Name (Field ID: 3.6)
        if (!empty($partial['3.6'])) {
            $last_name = $partial['3.6'];
        }

        // Email (Field ID: 5)
        if (!empty($partial['5'])) {
            $email = $partial['5'];
        }

        // Phone (Field ID: 6)
        if (!empty($partial['6'])) {
            $phone = $partial['6'];
        }
    }

    //GFCommon::log_debug("LILGF Extracted Data - First Name: $first_name, Last Name: $last_name, Email: $email, Phone: $phone");

    //Gather the details & compose the basic email 
    $to = "martin.grigoryan.369@gmail.com";
    $subject = "Partial Form Saved";
    $message = "Guess what! Someone submitted/saved a partial form, and they don't know that we know!\n" .
    "So perhaps we can warmly follow up after some days... that's if they left anything valuable.\n\n" .
    "Form: $form_title\n\n" .
    "First Name: $first_name\n" .
    "Last Name: $last_name\n" .
    "Email: $email\n" .
    "Phone#: $phone";

    wp_mail($to, $subject, $message);
}


// Hook: Modify the 'First Name' label in Gravity Forms
add_filter('gform_name_first', 'lil_gf_change_first', 10, 2);

// Hook: Restrict the available countries in the Gravity Forms dropdown
add_filter('gform_countries', 'lil_gf_limit_countries');

// Hook: Prevent Gravity Forms from saving the user's IP address
add_filter('gform_ip_address', '__return_empty_string');

// Hook: Runs after a Gravity Forms submission to star the entry
add_action('gform_after_submission', 'lil_gf_star_donors', 10, 2);

// Hook: Notify admin when user saves progress
add_action('gform_incomplete_submission_post_save', 'lil_gf_notify_admin', 10, 4);