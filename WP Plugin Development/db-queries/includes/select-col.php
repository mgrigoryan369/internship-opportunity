<?php // Select Var 

// Exit if file is called directly
if (!defined('ABSPATH')) {
	exit;
}

// Example: Get all user IDs
function mg_dbq_get_all_user_ids() {
	global $wpdb;

	$query = "SELECT ID FROM $wpdb->users";
	$results = $wpdb->get_col($query);

	if (!empty($results)) {
		echo '<div><strong>All User IDs:</strong></div>';
		echo '<ul>';
		foreach ($results as $id) {
			echo '<li>' . esc_html($id) . '</li>';
		}
		echo '</ul>';
	} else {
		echo '<div>No users found.</div>';
	}
}