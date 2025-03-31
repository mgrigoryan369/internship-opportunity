<?php // ADMIN MENU

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// === HOOKS === 
add_action( 'admin_menu', 'aaio_register_admin_menu' ); // Register admin menu
add_action( 'admin_enqueue_scripts', 'aaio_enqueue_admin_assets' ); // Enqueue CSS for admin page

// Register admin menu
function aaio_register_admin_menu() {

    add_menu_page(
        __( 'Absolute All-in-One', 'absolute-all-in-one' ),
        __( 'AAIO', 'absolute-all-in-one' ),
        'manage_options',
        'aaio',
        'aaio_render_admin_page',
        'dashicons-admin-generic',
        80
    );

}


// Enqueue admin style only on AAIO plugin page
function aaio_enqueue_admin_assets( $hook ) {
	if ( $hook !== 'toplevel_page_aaio' ) {
		return;
	}

	wp_enqueue_style( 'aaio-admin-style', AAIO_PLUGIN_URL . 'assets/admin/css/admin.css', array(), AAIO_VERSION	);
}


// Render the admin page
function aaio_render_admin_page() {
    
    $active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'general';

    ?>

    <div class="wrap">
        <h1><?php esc_html_e( 'Absolute All-In-One Plugin', 'absolute-all-in-one' ); ?></h1>

        <h2 class="nav-tab-wrapper">
            <a href="?page=aaio&tab=general" class="nav-tab <?php if ( $active_tab === 'general' ) echo 'nav-tab-active'; ?>">
                <?php esc_html_e( 'General', 'absolute-all-in-one' ); ?>
            </a>
            <a href="?page=aaio&tab=features" class="nav-tab <?php if ( $active_tab === 'features' ) echo 'nav-tab-active'; ?>">
                <?php esc_html_e( 'Features', 'absolute-all-in-one' ); ?>
            </a>
            <a href="?page=aaio&tab=help" class="nav-tab <?php if ( $active_tab === 'help' ) echo 'nav-tab-active'; ?>">
                <?php esc_html_e( 'Help', 'absolute-all-in-one' ); ?>
            </a>
        </h2>

        <div class="aaio-tab-content">
            <?php
            switch ( $active_tab ) {
                case 'features':
                    do_action( 'aaio_tab_features' );
                    break;
                case 'help':
                    do_action( 'aaio_tab_help' );
                    break;
                default:
                    do_action( 'aaio_tab_general' );
                    break;
            }
            ?>
        </div>
    </div>

    <?php

}


// === TAB CONTENT CALLBACKS === 
// todo: once working on each, perhaps move it into admin/tabs/features.php... make it more modular

add_action( 'aaio_tab_general', 'aaio_render_tab_general' );
function aaio_render_tab_general() {
	echo '<p>' . esc_html__( 'This is the General tab content.', 'absolute-all-in-one' ) . '</p>';
}

add_action( 'aaio_tab_features', 'aaio_render_tab_features' );
function aaio_render_tab_features() {
	echo '<p>' . esc_html__( 'This is the Features tab content.', 'absolute-all-in-one' ) . '</p>';
}

add_action( 'aaio_tab_help', 'aaio_render_tab_help' );
function aaio_render_tab_help() {
	echo '<p>' . esc_html__( 'This is the Help tab content.', 'absolute-all-in-one' ) . '</p>';
}