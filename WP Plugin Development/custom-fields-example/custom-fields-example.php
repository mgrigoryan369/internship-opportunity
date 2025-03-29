<?php
/* 
Plugin Name: Custom Fields Example
Description: Basic plugin demonstrating how to work with Custom Fields (Post Metadata).
Plugin URI: https://github.com/mgrigoryan369
Author: Martin Grigoryan
Version: 1.0
Text Domain: mg-plugin
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpls-2.0.txt
*/

// exit if file is called directly
if (!defined('ABSPATH')) {
    exit;
}


// Add custom field
function mg_plugin_add_custom_field($content) {
	if (is_singular() && in_the_loop() && is_main_query()) {
		if (!get_post_meta(get_the_ID(), 'weekday', true)) {
			$calendar = cal_to_jd(CAL_GREGORIAN, date('m'), date('d'), date('Y'));
			$weekday = jddayofweek($calendar, 1);
			add_post_meta(get_the_ID(), 'weekday', $weekday, true);
		}
	}
	return $content;
}


// Update custom field
function mg_plugin_update_custom_field($content) {
    if (is_singular() && in_the_loop() && is_main_query()) {
		update_post_meta(get_the_ID(), 'mood', 'full of joy', 'happy');
	}
	return $content;
}


// Delete custom field 
function mg_plugin_delete_custom_field($content) {
    if (is_singular() && in_the_loop() && is_main_query()) {
		delete_post_meta(get_the_ID(), 'weekday');
	}
	return $content;
}


// Display specific custom field
function mg_plugin_display_specific_custom_field($content) {

	if (is_singular() && in_the_loop() && is_main_query()) {
		$current_mood = get_post_meta(get_the_ID(), 'mood', true);
		if ($current_mood) {
			$content .= '<div><strong>Feeling:</strong> ' . esc_html($current_mood) . '</div>';
		}
	}
	return $content;
}

// Display all custom fields
function mg_plugin_display_all_custom_fields( $content ) {
	if (is_singular() && in_the_loop() && is_main_query()) {
		$custom_fields = '<h3>Custom Fields</h3>';
        $custom_fields .= '<div class="custom-field-display">';
		$all_custom_fields = get_post_custom();

		foreach ($all_custom_fields as $key => $array) {
			foreach ($array as $value) {
				if (substr($key, 0, 1) !== '_') {
					$custom_fields .= '<div><strong>' . esc_html($key) . ' =></strong> ' . esc_html($value) . '</div>';
				}
			}
		}

		$content .= $custom_fields;
        $content .= '</div>';
	}
	return $content;
}


/* Filters for the_content to add/update/delete custom field */
//add_filter('the_content', 'mg_plugin_add_custom_field');
//add_filter('the_content', 'mg_plugin_update_custom_field');
//add_filter('the_content', 'mg_plugin_delete_custom_field');

/* Filters for the_content to display custom fields */
//add_filter('the_content', 'mg_plugin_display_specific_custom_field');
//add_filter('the_content', 'mg_plugin_display_all_custom_fields');