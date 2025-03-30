<?php // Select Var 

// Exit if file is called directly
if (!defined('ABSPATH')) {
	exit;
}

// Example 1: Count users
function mg_dbq_get_user_count() {
	global $wpdb;

	$query = "SELECT COUNT(*) FROM $wpdb->users";
	$results = $wpdb->get_var($query);

    // Display the results
	if ($results !== null) {
		echo '<div><strong>Number of users:</strong> ' . esc_html($results) . '</div>';
	} else {
		echo '<div>No results found.</div>';
	}
}

// Example 2: Sum custom field values
function mg_dbq_sum_custom_meta() {
	global $wpdb;

	$meta_key = 'minutes';
	$query = "SELECT SUM(meta_value) FROM $wpdb->postmeta WHERE meta_key = %s";
	$prepared = $wpdb->prepare($query, $meta_key);
	$results = $wpdb->get_var($prepared);

    // Display the results
	if ($results !== null) {
		echo '<div><strong>Total minutes:</strong> ' . esc_html($results) . '</div>';
	} else {
		echo '<div>No results found.</div>';
	}
}