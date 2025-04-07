<?php // Helper functions

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

//error_log( 'Helpers loaded' );

// === Admin Notice Helpers ===

// Redirect to settings page with notice by adding query parameters to the URL
// Example: aaio_redirect_with_notice( 'general', 'settings_saved' );
function aaio_redirect_with_notice( $tab = '', $notice = '' ) {
    $url = admin_url( 'admin.php?page=aaio' );

    if ( $tab ) {
        $url = add_query_arg( 'tab', $tab, $url );
    }

    if ( $notice ) {
        $url = add_query_arg( 'aaio_notice', $notice, $url );
    }

    wp_safe_redirect( $url );
    exit;
}


// One-off (programmatic) admin notice, no redirect
// Example: aaio_add_admin_notice( 'Option name was toggled.', 'info' );
function aaio_add_admin_notice( $message, $type = 'success' ) {
    if ( ! is_admin() ) return;

    // Sanitize and validate type
	$allowed_types = ['success', 'error', 'warning', 'info'];
	$type = in_array( $type, $allowed_types, true ) ? $type : 'success';

    // Anonymous function hooked into admin_notices
    add_action( 'admin_notices', function () use ( $message, $type ) {
        printf(
            '<div class="notice notice-%s is-dismissible"><p>%s</p></div>',
            esc_attr( $type ),
            esc_html( $message )
        );
    } );
}


// Static notice system: displays notice based on ?aaio_notice= key in the URL
// Example: admin.php?page=aaio-settings&tab=general&aaio_notice=settings_saved
add_action( 'admin_notices', function () {
	if ( empty( $_GET['aaio_notice'] ) ) return;

	$notices = [
		'transients_cleared_all' => [
			'message' => __( 'All transients have been cleared.', AAIO_TD ),
			'type' => 'success',
		],
		'transients_cleared_testimonials' => [
			'message' => __( 'Testimonials cache cleared.', AAIO_TD ),
			'type' => 'success',
		],
		'services_cleared_services' => [
			'message' => __( 'Services cache cleared.', AAIO_TD ),
			'type' => 'success',
		],
		'portfolio_cleared_portfolio' => [
			'message' => __( 'Portfolio cache cleared.', AAIO_TD ),
			'type' => 'success',
		],
        'options_reset' => [
	        'message' => __( 'Options have been reset to defaults.', AAIO_TD ),
	        'type'    => 'warning',
        ],
		'settings_saved' => [
			'message' => __( 'Settings saved successfully.', AAIO_TD ),
			'type' => 'success',
		],
		'something_failed' => [
			'message' => __( 'Something went wrong. Please try again.', AAIO_TD ),
			'type' => 'error',
		],
	];

	$key = sanitize_key( $_GET['aaio_notice'] );

	if ( isset( $notices[ $key ] ) ) {
		$data = $notices[ $key ];
		printf(
			'<div class="notice notice-%s is-dismissible"><p>%s</p></div>',
			esc_attr( $data['type'] ),
			esc_html( $data['message'] )
		);
	}
} );


// === Transient Helpers ===

// Transient Render Section
function aaio_render_cache_section( $slug, $label ) {
	$transient_key = "aaio_{$slug}_cache"; // Static
	$tracked_keys = get_option( "aaio_{$slug}_cache_keys", [] ); // Dynamic keys
	$is_cached = false;

	// Check dynamic keys first
	if ( is_array( $tracked_keys ) && ! empty( $tracked_keys ) ) {
		foreach ( $tracked_keys as $key ) {
			if ( get_transient( $key ) !== false ) {
				$is_cached = true;
				break;
			}
		}
	} else {
		// Fallback to check static key
		$is_cached = ( get_transient( $transient_key ) !== false );
	}

	$nonce_action = "aaio_clear_{$slug}_transients_action";
	$nonce_name = "aaio_clear_{$slug}_transients_nonce";
	$submit_name = "aaio_clear_{$slug}_transients";

	echo '<div style="margin-bottom: 20px;">';
	echo '<strong>' . esc_html( $label ) . ' ' . __( 'Cache Status:', AAIO_TD ) . '</strong> ';
	echo $is_cached 
		? '<span style="color: green;">✅ ' . esc_html__( 'Cached', AAIO_TD ) . '</span>' 
		: '<span style="color: red;">❌ ' . esc_html__( 'Not Cached', AAIO_TD ) . '</span>';

	echo '<form method="post" style="margin-top: 5px;">';
	wp_nonce_field( $nonce_action, $nonce_name );
	echo '<input type="submit" class="button button-secondary" name="' . esc_attr( $submit_name ) . '" value="' . esc_attr__( "Clear {$label} Cache", AAIO_TD ) . '">';
	echo '</form></div>';
}


// Track dynamic transient cache keys for a given type
// Example: aaio_track_dynamic_transient( 'testimonials', $cache_key );
function aaio_track_dynamic_transient( $type, $cache_key ) {
	$option_key = "aaio_{$type}_cache_keys";
	$keys = get_option( $option_key, [] );

	if ( ! in_array( $cache_key, $keys, true ) ) {
		$keys[] = $cache_key;
		update_option( $option_key, $keys ); // Update the tracker option
	}
}


// Delete all dynamic cache keys for a given type
// Example: aaio_delete_dynamic_transients( 'testimonials' );
function aaio_delete_dynamic_transients( $type ) {
	$option_key = "aaio_{$type}_cache_keys";
	$keys = get_option( $option_key, [] );

	if ( is_array( $keys ) ) {
		foreach ( $keys as $transient ) {
			delete_transient( $transient );
		}
	}

	delete_option( $option_key ); // Clear the tracker option
}