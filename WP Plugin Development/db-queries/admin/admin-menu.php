<?php // Admin Menu

// Exit if file is called directly
if (!defined('ABSPATH')) {
	exit;
}

// Register admin menu
add_action('admin_menu', 'mg_db_queries_add_menu');

function mg_db_queries_add_menu() {
	add_menu_page(
		esc_html__('Database Examples', 'db-queries'),
		esc_html__('DB Queries', 'db-queries'),
		'manage_options',
		'db-queries',
		'mg_db_queries_render_page',
		'dashicons-database',
		80
	);
}

// Render the admin page
function mg_db_queries_render_page() {
	if (!current_user_can('manage_options')) {
		return;
	}

	echo '<div class="wrap">';
	echo '<h1>' . esc_html(get_admin_page_title()) . '</h1>';
	echo '<p>' . esc_html__('This plugin demo shows ways to query the database.', 'db-queries') . '</p>';

	echo '<h2>Select a variable example</h2>';

	require_once MG_DBQ_PLUGIN_PATH . 'includes/select-var.php';
	mg_dbq_get_user_count();
	mg_dbq_sum_custom_meta();

    echo '<h2>Select a row</h2>';

	require_once MG_DBQ_PLUGIN_PATH . 'includes/select-row.php';
	mg_dbq_get_primary_admin_user();

    echo '<h2>Select a column</h2>';

	require_once MG_DBQ_PLUGIN_PATH . 'includes/select-col.php';
	mg_dbq_get_all_user_ids();

    echo '<h2>Select generic results</h2>';

	require_once MG_DBQ_PLUGIN_PATH . 'includes/select-results.php';
	mg_dbq_get_draft_posts();

	echo '</div>';
}