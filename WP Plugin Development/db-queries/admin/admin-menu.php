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
