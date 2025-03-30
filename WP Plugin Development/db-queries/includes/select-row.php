<?php // Select Var 

// Exit if file is called directly
if (!defined('ABSPATH')) {
	exit;
}

// Example: Get primary admin user by ID
function mg_dbq_get_primary_admin_user() {
	global $wpdb;

	$user_id = 1;
	$query = "SELECT * FROM $wpdb->users WHERE ID = %d";
	$prepared = $wpdb->prepare($query, $user_id);
	$user = $wpdb->get_row($prepared);

	if ($user !== null) {
		echo '<div><strong>Primary Admin User:</strong></div>';
		echo '<ul>';
		echo '<li><strong>User ID:</strong> ' . esc_html($user->ID) . '</li>';
		echo '<li><strong>Username:</strong> ' . esc_html($user->user_login) . '</li>';
		echo '<li><strong>Email:</strong> ' . esc_html($user->user_email) . '</li>';
		echo '</ul>';
	} else {
		echo '<div>No admin user found.</div>';
	}
}