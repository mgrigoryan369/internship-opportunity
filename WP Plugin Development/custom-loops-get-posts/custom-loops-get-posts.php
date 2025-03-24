<?php
/*
Plugin Name: Custom Loops: get_posts()
Description: Demonstrates how to customize the WordPress Loop using get_posts().
Plugin URI:  https://github.com/mgrigorayan369 
Author:      Martin Grigoryan
Version:     1.0
*/

// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// custom loop shortcode: [get_posts posts_per_page="" orderby=""]
function custom_loop_shortcode_get_posts($atts){

    // get global post variable
    global $post;

    // define shortcode variable
    extract(shortcode_atts( array(
        'posts_per_page' => 5,
        'orderby' => 'date',
    ), $atts));

    // define get_post parameters 
    $args = array(
        'posts_per_page' => $posts_per_page, 
        'orderby' => $orderby,
    );

    // get the posts
    $posts = get_posts($args);

    // begin output variable
    $output = '<h3>Custom Loop: get_posts()</h3>';
    $output .= '<ul>';

    // loop 
    foreach($posts as $post){
        // prepare post data
        setup_postdata($post);

        // append each post data
        $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
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