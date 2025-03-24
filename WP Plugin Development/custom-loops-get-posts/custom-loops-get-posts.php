<?php
/*
Plugin Name: Custom Loops: get_posts()
Description: Demonstrates how to customize the WordPress Loop using get_posts().
Plugin URI:  https://github.com/mgrigorayan369 
Author:      Martin Grigoryan
Version:     1.0
*/

// Example usage:  [get_posts post_type="post,portfolio" posts_per_page="6" orderby="title" order="ASC"]

// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// custom loop shortcode
function custom_loop_shortcode_get_posts($atts){

    // get global post variable
    global $post;

    // define shortcode variable
    extract(shortcode_atts( array(
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
    ), $atts));

    //sanitize inputs
    $posts_per_page = intval($posts_per_page);
    $orderby = sanitize_key($orderby);
    $post_type = trim($post_type);
    $order = strtoupper(trim($order));

    // allowlist of valid 'orderby' values
	$allowed_orderby = array(
		'none', 'ID', 'author', 'title', 
        'name', 'date', 'modified',
		'rand', 'menu_order'
	);

    //fallback for orderby
    if ( ! in_array( $orderby, $allowed_orderby, true ) ) {
		$orderby = 'date';
	}

    // allow only ASC or DESC for order
	if ( $order !== 'ASC' && $order !== 'DESC' ) {
		$order = 'DESC';
	}

    // define get_post parameters 
    $args = array(
        'posts_per_page' => $posts_per_page, 
        'orderby' => $orderby,
        'post_type' => strpos( $post_type, ',' ) !== false
                       ? array_map( 'sanitize_key', array_map( 'trim', explode( ',', $post_type )))
                       : sanitize_key($post_type),
    );

    // get the posts
    $posts = get_posts($args);

    // begin output variable
    $output = '<h3>Custom Loop: get_posts(';

    if ( is_array( $args['post_type'] ) ) {
        $output .= esc_html(implode( ', ', $args['post_type'] ));
    } else {
        $output .= esc_html($args['post_type']);
    }
    
    $output .= ' | orderby=' . esc_html( $orderby );
	$output .= ' | order=' . esc_html( $order ) . ')</h3>';
    $output .= '<ul>';

    // loop 
    if ( ! empty( $posts ) ) {
        foreach($posts as $post){
            // prepare post data
            setup_postdata($post);

            // append each post data
            $output .= '<li><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></li>';
        }
    } else {
        $output .= '<li>No posts found.</li>';
    }

    // reset query
    wp_reset_postdata();

    // append closing ul tag
    $output .= '</ul>';

    // return crafted output
    return $output;
}

// register shortcode 
add_shortcode('get_posts', 'custom_loop_shortcode_get_posts');