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