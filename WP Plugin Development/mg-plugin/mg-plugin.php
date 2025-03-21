<?php
/* 
Plugin Name: MG Plugin
Description: Basic WP Plugin for LinkedIn Learning Course
Plugin URI: https://github.com/mgrigoryan369
Author: Martin Grigoryan
Version: 1.0
Text Domain: mg-plugin
Domain Path: /languages
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpls-2.0.txt
*/

// exit if file is called directly
if (!defined('ABSPATH')){
    exit;
}

// display the plugin settings page
function mg_display_settings_page() {
	
	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;
	
	?>
	
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			
			<?php
			
			// output security fields
			settings_fields( 'myplugin_options' );
			
			// output setting sections
			do_settings_sections( 'myplugin' );
			
			// submit button
			submit_button();
			
			?>
			
		</form>
	</div>
	
	<?php
	
}

// add top-level administrative menu
function mg_add_toplevel_menu() {
	
	/* 
		add_menu_page(
			string   $page_title, 
			string   $menu_title, 
			string   $capability, 
			string   $menu_slug, 
			callable $function = '', 
			string   $icon_url = '', 
			int      $position = null 
		)
	*/
	
	add_menu_page(
		'MG Plugin Settings',
		'MG Plugin',
		'manage_options',
		'mg-plugin',
		'mg_display_settings_page',
		'dashicons-admin-generic',
		null
	);
	
}
//add_action( 'admin_menu', 'mg_add_toplevel_menu' );


// add sub-level administrative menu
function mg_add_sublevel_menu() {
	
	/*
	
	add_submenu_page(
		string   $parent_slug,
		string   $page_title,
		string   $menu_title,
		string   $capability,
		string   $menu_slug,
		callable $function = ''
	);
	
	*/
	
	add_submenu_page(
		'options-general.php',
		'MG Plugin Settings',
		'MG Plugin',
		'manage_options',
		'mg-plugin',
		'mg_display_settings_page'
	);
	
}
add_action( 'admin_menu', 'mg_add_sublevel_menu' );

