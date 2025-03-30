<?php // General Query

// Exit if file is called directly
if (!defined('ABSPATH')) {
	exit;
}

// Example: Insert a custom field into postmeta
function mg_dbq_add_custom_field() {
	global $wpdb;

	$post_id = 1;
	$meta_key = 'favorite-season';
	$meta_value = 'Autumn';

	$query = "
		INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value)
		VALUES (%d, %s, %s)
	";

	$prepared = $wpdb->prepare($query, $post_id, $meta_key, $meta_value);
	$result = $wpdb->query($prepared);

	echo '<div><strong>Add Custom Field:</strong> ';
	if ($result === false) {
		echo 'Error during insertion.';
	} elseif ($result === 0) {
		echo 'No rows affected.';
	} else {
		echo 'Custom field added.';
	}
	echo '</div>';
}