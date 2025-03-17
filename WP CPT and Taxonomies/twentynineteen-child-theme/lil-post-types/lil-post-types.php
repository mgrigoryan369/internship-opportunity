<?php 
define('LILDOMAIN', 'lil-post-types');
define('LILPATH', get_stylesheet_directory() . '/lil-post-types/');

//Modules
require_once(LILPATH . '/post-types/register.php');
require_once(LILPATH . '/post-taxonomies/register.php');


//Actions
add_action('init', 'lil_register_business_type');
add_action('init', 'lil_register_event_type');
add_action('init', 'lil_register_size_taxonomy');
add_action('init', 'lil_register_location_taxonomy');

//Register
function lil_register_everything() {
    lil_register_business_type();
    lil_register_event_type();
    lil_register_size_taxonomy();
    lil_register_location_taxonomy();
}
