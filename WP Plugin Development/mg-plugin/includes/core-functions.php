<?php // MG Plugin - Core Functionality

// exit if file is called directly
if (!defined('ABSPATH')){
    exit;
}

// custom login logo url
function mg_plugin_custom_login_url( $url ) {
	
	$options = get_option( 'mg_plugin_options', mg_plugin_options_default() );
	
	if ( isset( $options['custom_url'] ) && ! empty( $options['custom_url'] ) ) {
		
		$url = esc_url( $options['custom_url'] );
		
	}
	
	return $url;
	
}
add_filter( 'login_headerurl', 'mg_plugin_custom_login_url' );

// custom login logo title
function mg_plugin_custom_login_title( $title ) {
	
	$options = get_option( 'mg_plugin_options', mg_plugin_options_default() );
	
	if ( isset( $options['custom_title'] ) && ! empty( $options['custom_title'] ) ) {
		
		$title = esc_attr( $options['custom_title'] );
		
	}
	
	return $title;
	
}
add_filter( 'login_headertext', 'mg_plugin_custom_login_title' );

// custom login styles
function mg_plugin_custom_login_styles() {
	
	$styles = false;
	
	$options = get_option( 'mg_plugin_options', mg_plugin_options_default() );
	
	if ( isset( $options['custom_style'] ) && ! empty( $options['custom_style'] ) ) {
		
		$styles = sanitize_text_field( $options['custom_style'] );
		
	}
	
	if ( 'enable' === $styles ) {
		
		/*
		
		wp_enqueue_style( 
			string           $handle, 
			string           $src = '', 
			array            $deps = array(), 
			string|bool|null $ver = false, 
			string           $media = 'all' 
		)
		
		wp_enqueue_script( 
			string           $handle, 
			string           $src = '', 
			array            $deps = array(), 
			string|bool|null $ver = false, 
			bool             $in_footer = false 
		)
		
		*/
		
		wp_enqueue_style( 'mg-plugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/mg-plugin-login.css', array(), null, 'screen' );
		wp_enqueue_script( 'mg-plugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/mg-plugin-login.js', array(), null, true );
		
	}
	
}
add_action( 'login_enqueue_scripts', 'mg_plugin_custom_login_styles' );

// custom login message
function mg_plugin_custom_login_message( $message ) {
	
	$options = get_option( 'mg_plugin_options', mg_plugin_options_default() );
	
	if ( isset( $options['custom_message'] ) && ! empty( $options['custom_message'] ) ) {
		
		$message = wp_kses_post( $options['custom_message'] ) . $message;
		
	}
	
	return $message;
	
}
add_filter( 'login_message', 'mg_plugin_custom_login_message' );

// custom admin footer
function mg_plugin_custom_admin_footer( $message ) {
	
	$options = get_option( 'mg_plugin_options', mg_plugin_options_default() );
	
	if ( isset( $options['custom_footer'] ) && ! empty( $options['custom_footer'] ) ) {
		
		$message = sanitize_text_field( $options['custom_footer'] );
		
	}
	
	return $message;
	
}
add_filter( 'admin_footer_text', 'mg_plugin_custom_admin_footer' );

// custom toolbar items
function mg_plugin_custom_admin_toolbar() {
	
	$toolbar = false;
	$options = get_option( 'mg_plugin_options', mg_plugin_options_default() );
	
	if ( isset( $options['custom_toolbar'] ) && ! empty( $options['custom_toolbar'] ) ) {
		
		$toolbar = (bool) $options['custom_toolbar'];
		
	}
	
	if ( $toolbar ) {
		
		global $wp_admin_bar;
		
		$wp_admin_bar->remove_menu( 'comments' );
		$wp_admin_bar->remove_menu( 'new-content' );
		
	}
	
}
add_action( 'wp_before_admin_bar_render', 'mg_plugin_custom_admin_toolbar', 999 );

// custom admin color scheme
function mg_plugin_custom_admin_scheme( $user_id ) {
	
	$scheme = 'default';
	$options = get_option( 'mg_plugin_options', mg_plugin_options_default() );
	
	if ( isset( $options['custom_scheme'] ) && ! empty( $options['custom_scheme'] ) ) {
		
		$scheme = sanitize_text_field( $options['custom_scheme'] );
		
	}
	
	$args = array( 'ID' => $user_id, 'admin_color' => $scheme );
	
	wp_update_user( $args );
	
}
add_action( 'user_register', 'mg_plugin_custom_admin_scheme' );