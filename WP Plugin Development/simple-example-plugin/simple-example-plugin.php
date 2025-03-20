<?php
/* 
Plugin Name: Simple Example Plugin
Description: Welcome to WordPress plugin development.
Plugin URI: https://github.com/mgrigoryan369
Author: Martin Grigoryan
Version: 1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpls-2.0.txt

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version
2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
with this program. If not, visit: https://www.gnu.org/licenses/

*/

/* Using wp_mail as a visual confirmation temporarily,
perhaps create a specific function to to handle this using the error_log() function
maybe it is part of the course, holding off on it.
*/

function myplugin_action_hook_example() {
    wp_mail('email@example.com', 'Subject', 'Message...');
}
add_action('init', 'myplugin_action_hook_example');

function myplugin_filter_hook_example($content){
    $content = $content . '<p>This custom content will be attached to the_content...</p>';

    return $content;
}
add_filter('the_content', 'myplugin_filter_hook_example');

function myplugin_on_activation(){
    if(!current_user_can('activate_plugins')){
        return;
    }
    wp_mail('email@example.com', 'Plugin Activated', 'Options added to DB');
    add_option('myplugin_posts_per_page', 10);
    add_option('myplugin_show_welcome_page', true);
}
register_activation_hook(__FILE__, 'myplugin_on_activation');

function myplugin_on_deactivation(){
    if(!current_user_can('activate_plugins')){
        return;
    }
    wp_mail('email@example.com', 'Plugin Deactivated', 'Rewrite rules flushed');
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'myplugin_on_deactivation');

function myplugin_on_uninstall(){
    if(!current_user_can('activate_plugins')){
        return;
    }
    wp_mail('email@example.com', 'Plugin Uninstalled', 'Options deleted from DB');
    delete_option('myplugin_posts_per_page', 10);
    delete_option('myplugin_show_welcome_page', true);
}
register_uninstall_hook(__FILE__, 'myplugin_on_uninstall');

/* Customize pluggable logout function with a hook, can also bring in the entire function here to
make even more changes, but that would not be ideal as core updates won't reflect */
function myplugin_custom_logout() {
    wp_mail('email@example.com', 'Logout Triggered' , 'Looks like somone just logged out!');
}
add_action('wp_logout', 'myplugin_custom_logout');

//Validation example
function is_phone_number($phone_number){
    if(empty($phone_number)){
        return false;
    }

    if (! preg_match("/^\(?([0-9[{3})\)?([ .-]?)([0-9]{3})([ .-]?)([0-9]{4})$/", $phone_number)){ 
        return false;
    }

    return true;
}