<?php
/*
	
	uninstall.php
	
	- fires when plugin is uninstalled via the Plugins screen
	
*/



// exit if uninstall constant is not defined
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// delete the plugin options
delete_option( 'mg_plugin_options' );
//delete_transient('');
//delete_metadata('');

// Delete DB table
//global $wpdb;
//$table_name = $wpdb->prefix . 'mg_plugin_table';
//$wpdb->query( "DROP TABLE IF EXISTS {$table_name}" );

//Delete cron event
//$timestamp = wp_next_scheduled( 'sfs_cron_cache' );
//wp_unschedule_event( $timestamp, 'sfs_cron_cache' );

