<?php // Select Results

// Exit if file is called directly
if (!defined('ABSPATH')) {
	exit;
}

// Example: Get draft posts by a specific author
function mg_dbq_get_draft_posts() {
	global $wpdb;

	$post_author = 1;

	$query = "
		SELECT ID, post_title
		FROM $wpdb->posts
		WHERE post_status = 'draft'
		AND post_type = 'post'
		AND post_author = %d
	";

	$prepared = $wpdb->prepare($query, $post_author);
	$drafts = $wpdb->get_results($prepared);

	if (!empty($drafts)) {
		echo '<div><strong>Draft Posts by Author ID 1:</strong></div><ul>';
		foreach ($drafts as $post) {
			echo '<li>' . esc_html($post->post_title) . ' (ID: ' . esc_html($post->ID) . ')</li>';
		}
		echo '</ul>';
	} else {
		echo '<div>No draft posts found.</div>';
	}
}