<?php
/*
Plugin Name: Custom Loops: WP_Query
Description: Demonstrates how to customize the WordPress Loop using WP_Query.
Plugin URI:  https://github.com/mgrigoryan369
Author:      Martin Grigoryan
Version:     1.0
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

	// get current page from custom query var
	$current_page = get_query_var( 'wpq_page' ) ? intval( get_query_var( 'wpq_page' ) ) : 1;

	// define query parameters
	$args = array(
		'posts_per_page' => intval( $atts['posts_per_page'] ),
		'orderby' => sanitize_text_field( $atts['orderby'] ),
		'paged' => $current_page,
	);
	
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