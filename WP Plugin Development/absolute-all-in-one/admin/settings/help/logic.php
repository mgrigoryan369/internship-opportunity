<?php // Logic: Help Tab | Handle POST actions (clearing transients)

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// === HOOKS ===
add_action( 'admin_init', 'aaio_handle_cache_clear_requests' );


// Clear Trasient Cache Logic
function aaio_handle_cache_clear_requests() {
	$types = ['testimonials', 'services', 'portfolio'];

	foreach ( $types as $type ) {
		$nonce_action = "aaio_clear_{$type}_transients_action";
		$nonce_name   = "aaio_clear_{$type}_transients_nonce";
		$submit_name  = "aaio_clear_{$type}_transients";

		if ( isset( $_POST[$submit_name] ) && check_admin_referer( $nonce_action, $nonce_name ) ) {
			delete_transient( "aaio_{$type}_cache" );
			aaio_redirect_with_notice( 'help', "transients_cleared_{$type}" );
		}
	}

    // Clear All
	if ( isset( $_POST['aaio_clear_all_transients'] ) && check_admin_referer( 'aaio_clear_all_transients_action', 'aaio_clear_all_transients_nonce' ) ) {
		foreach ( $types as $type ) {
			delete_transient( "aaio_{$type}_cache" );
		}
		aaio_redirect_with_notice( 'help', 'transients_cleared_all' );
	}
}

// Reset options to default values
function aaio_handle_reset_general_options() {
	if (
		isset( $_POST['aaio_reset_general_options'] ) &&
		check_admin_referer( 'aaio_reset_options_action', 'aaio_reset_options_nonce' )
	) {
		// Set all options to false (or your preferred defaults)
		update_option( 'aaio_disable_admin_bar', false );
		update_option( 'aaio_disable_emojis', false );
		update_option( 'aaio_disable_wp_version', false );
		update_option( 'aaio_enable_svg_uploads', false );
        update_option( 'aaio_enable_testimonials', false );

		aaio_redirect_with_notice( 'help', 'options_reset' );
	}
}
add_action( 'admin_init', 'aaio_handle_reset_general_options' );