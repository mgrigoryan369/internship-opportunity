<?php // MG Plugin - Settings Page

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

		
		<?php 
			// can enable below to just display WP default admin messages (save/error...)
			// settings_errors();
		?>

		<form action="options.php" method="post">
			
			<?php
			
			// output security fields
			settings_fields( 'mg_plugin_options' );
			
			// output setting sections
			do_settings_sections( 'mg_plugin' );
			
			// submit button
			submit_button();
			
			?>
			
		</form>
	</div>
	
	<?php
	
}


// display admin notices using a function
function mg_plugin_admin_notices() {
	settings_errors();
}
// add_action( 'admin_notices', 'mg_plugin_admin_notices' );

// display CUSTOM admin notices
function mg_plugin_custom_admin_notices() {
	// get the current screen
	$screen = get_current_screen();

	// return if not myplugin settings page
	if ( $screen->id !== 'toplevel_page_mg_plugin' ) return;

	// check if settings updated
	if ( isset( $_GET[ 'settings-updated' ] ) ) {
	
		// if settings updated successfully
		if ( 'true' === $_GET[ 'settings-updated' ] ) : 
		
		?>
			
			<div class="notice notice-success is-dismissible">
				<p><strong><?php _e( 'Congratulations, you are awesome!', 'mg_plugin' ); ?></strong></p>
			</div>
			
		<?php 
		
		// if there is an error
		else : 
		
		?>
			
			<div class="notice notice-error is-dismissible">
				<p><strong><?php _e( 'Houston, we have a problem.', 'mg_plugin' ); ?></strong></p>
			</div>
			
		<?php 
		
		endif;
		
	}

}
add_action( 'admin_notices', 'mg_plugin_custom_admin_notices' );


