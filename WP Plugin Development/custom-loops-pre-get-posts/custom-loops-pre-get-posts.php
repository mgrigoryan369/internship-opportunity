<?php
/*
Plugin Name: Custom Loops: pre_get_posts
Description: Demonstrates how to customize the WordPress Loop using pre_get_posts.
Plugin URI:  https://github.com/mgrigoryan369
Author:      Martin Grigoryan
Version:     1.0
*/

function custom_loop_pre_get_posts( $query ) {
	if ( ! is_admin() && $query->is_main_query() ) {
        //customize query with set
		$query->set('posts_per_page', 1);
        //$query->set('order', 'ASC');
        //$query->set('cat', '-4,-5);
	}
}

add_action( 'pre_get_posts', 'custom_loop_pre_get_posts' );