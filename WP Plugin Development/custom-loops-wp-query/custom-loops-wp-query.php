<?php
/*
Plugin Name: Custom Loops: WP_Query
Description: Demonstrates how to customize the WordPress Loop using WP_Query.
Plugin URI:  https://github.com/mgrigoryan369
Author:      Martin Grigoryan
Version:     1.0.1
Text Domain: myplugin
*/

// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// allow custom query var in URL (?wpq_page=2)
add_filter( 'query_vars', function( $vars ) {
	$vars[] = 'wpq_page';
	return $vars;
});

// custom loop shortcode: [wp_query_example]
function custom_loop_shortcode_wp_query($atts) {
	
	// define shortcode variables
	$atts = shortcode_atts( array( 
		'posts_per_page' => 5,
		'orderby' => 'date',
	), $atts );

	$current_page = get_query_var( 'wpq_page' ) ? intval( get_query_var( 'wpq_page' ) ) : 1;
	
	// create unique key using page + atts
	$atts_hash = md5( serialize( $atts ) );
	$transient_key = 'mg_plugin_wp_query_args_' . $current_page . '_' . $atts_hash;
	
	// try to get args from transient 
	$args = get_transient( $transient_key );

	if ( $args === false ) {

		// define query parameters
		$args = array(
			'posts_per_page' => intval( $atts['posts_per_page'] ),
			'orderby' => sanitize_text_field( $atts['orderby'] ),
			'paged' => $current_page,
		);
		
		// set transient to cache results for 12 hours
		set_transient( $transient_key, $args, 12 * HOUR_IN_SECONDS );
	}

	// query the posts
	$posts = new WP_Query( $args );
	
	// begin output variable
	$output = '<h3>'. esc_html__( 'Custom Loop Example: WP_Query', 'myplugin' ) .'</h3>';
	
	// begin the loop
	if ( $posts->have_posts() ) {
		
		while ( $posts->have_posts() ) {
			
			$posts->the_post();
			
			$output .= '<h4><a href="'. esc_url(get_permalink()) .'">'. esc_html(get_the_title()) .'</a></h4>';
			$output .= '<div>' . wp_kses_post( get_the_content() ) . '</div>';
			$output .= '<p>' . esc_html__( 'Comments: ', 'myplugin' ) . get_comments_number() . '</p>';
			
		}

		// use paginate_links with custom query var
		$pagination = paginate_links( array(
			'base'    => esc_url( add_query_arg( 'wpq_page', '%#%' ) ),
			'format'  => '',
			'current' => $current_page,
			'total'   => $posts->max_num_pages,
			'type'    => 'plain',
		) );

		if ( $pagination ) {
			$output .= '<div class="custom-pagination">' . $pagination . '</div>';
		}
		
		// reset post data
		wp_reset_postdata();
		
	} else {
		
		// if no posts are found
		$output .= esc_html__( 'Sorry, no posts matched your criteria.', 'myplugin' );
		
	}
	
	// return output
	return $output;
	
}
// register shortcode function
add_shortcode( 'wp_query_example', 'custom_loop_shortcode_wp_query' );


// delete transient on plugin deactivation
function custom_loop_shortcode_wp_query_on_deactivation() {
	if( ! current_user_can( 'activate_plugins' ) ){
		return;
	}

	global $wpdb;

	// delete all transients that start with 'mg_plugin_wp_query_args_'
	$transient_prefix = '_transient_mg_plugin_wp_query_args_';

	$wpdb->query(
		$wpdb->prepare(
			"DELETE FROM $wpdb->options WHERE option_name LIKE %s",
			$wpdb->esc_like( $transient_prefix ) . '%'
		)
	);
}
register_deactivation_hook( __FILE__ , 'custom_loop_shortcode_wp_query_on_deactivation' );