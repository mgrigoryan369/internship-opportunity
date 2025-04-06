<?php // Logic: Features Settings | applies logic

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Hook into init to register CPTs based on settings
add_action( 'admin_init', 'aaio_handle_features_settings_save' );
add_action( 'init', 'aaio_register_enabled_cpts' );

function aaio_register_enabled_cpts() {

	// === Testimonials ===
	if ( get_option( 'aaio_enable_testimonials' ) ) {
		require_once AAIO_PLUGIN_DIR . 'admin/cpt/testimonials/register.php';
        //require_once AAIO_PLUGIN_DIR . 'admin/cpt/testimonials/taxonomy.php';
        require_once AAIO_PLUGIN_DIR . 'admin/cpt/testimonials/meta.php';
	}

	// === Services ===
	if ( get_option( 'aaio_enable_services' ) ) {
		//require_once AAIO_PLUGIN_DIR . 'admin/cpt/services/register.php';
	}

	// === Portfolio ===
	if ( get_option( 'aaio_enable_portfolio' ) ) {
		//require_once AAIO_PLUGIN_DIR . 'admin/cpt/portfolio/register.php';
	}
}

// Admin notice for Features Tab
function aaio_handle_features_settings_save() {
	if ( 
        isset( $_GET['page'], $_GET['settings-updated'] ) &&
		$_GET['page'] === 'aaio' &&
		$_GET['settings-updated'] === 'true' 
    ) {

        // Treat no tab OR tab=general as "general"
        $tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'features';
        
        if ( $tab === 'features' ) {
            aaio_redirect_with_notice( 'features', 'settings_saved' );
        }
	}
}