<?php 
/*
Plugin Name: WP Cron Example
Description: Example demonstrating how to use the CRON API to schedule events
Plugin URI: https://github.com/mgrigoryan369
Author: Martin Grigoryan
Version: 1.0.0
*/


 // Exit if file is called directly
 if (!defined('ABSPATH')){
    exit;
}

// Add custom CRON intervals
function wpcron_intervals( $schedules ){
    
    // One minute
    $one_minute = array(
        'interval' => 60,
        'display' => 'One Minute',
    );

    $schedules[ 'one_minute' ] = $one_minute;

    // Five minute
    $five_minutes = array(
        'interval' => 300,
        'display' => 'Five Minutes',
    );

    $schedules[ 'five_minutes' ] = $five_minutes;

    // Return data
	return $schedules;

}
add_filter( 'cron_schedules', 'wpcron_intervals' );


// Add the CRON event
function wpcron_activation() {

	if ( ! wp_next_scheduled( 'example_event' ) ) {

		wp_schedule_event( time(), 'one_minute', 'example_event' );

	}

}
register_activation_hook( __FILE__, 'wpcron_activation' );


// The CRON event
function wpcron_example_event(){

    if( ! defined( 'DOING_CRON' ) ) return;

    // Create a draft post when it runs as an example
    $time = current_time( 'mysql' );

	$post_data = array(
		'post_title' => 'CRON Post - ' . $time,
		'post_content' => 'This post was automatically created by WP-Cron at ' . $time,
		'post_status' => 'draft',
		'post_type' => 'post',
	);

	wp_insert_post( $post_data );

    // Logging
    $option = get_option( 'wpcron_log' );

    if ( ! empty( $option ) && is_array( $option ) ){
        $option[] = date( 'g:i:s A');
    } else {
        $option = array( date( 'g:i:s A' ) );
    }

    update_option( 'wpcron_log', $option );

}
add_action( 'example_event', 'wpcron_example_event' );


// Remove cron event
function wpcron_deactivation() {

	wp_clear_scheduled_hook( 'example_event' );
	delete_option( 'wpcron_log' );

}
register_deactivation_hook( __FILE__, 'wpcron_deactivation' );


// Add top-level admin menu
function wpcron_add_toplevel_menu() {

	add_menu_page(
		'WP-Cron Example',
		'Cron API',
		'manage_options',
		'wpcron-example',
		'wpcron_display_settings_page',
		'dashicons-admin-generic',
		null
	);

}
add_action( 'admin_menu', 'wpcron_add_toplevel_menu' );


// Display the plugin settings page
function wpcron_display_settings_page() {

	// Check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;

	?>

	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<?php echo wpcron_log(); ?>
	</div>

<?php

}


// Display the CRON log
function wpcron_log() {

	$option = get_option( 'wpcron_log' );
	echo '<p>Cron log for <code>example_event</code></p>';

    if ( is_array( $option) ){
        foreach ( $option as $key => $value ) {
            echo '<p>' . $key . ' : ' . $value . '</p>';
        }
    } else {
        echo '<p>No log entries yet.</p>';
    }

}