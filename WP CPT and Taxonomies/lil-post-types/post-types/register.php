<?php

// Business CPT
function lil_register_business_type() {
    $labels = array(
        'name' => __('Businesses, LILDOMAIN'), 
        'singular_name' => __('Business'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
    );

    register_post_type('business', $args);
}