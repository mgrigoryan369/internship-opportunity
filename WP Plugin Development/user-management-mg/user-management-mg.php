<?php

// Exit if file is called directly
if (!defined('ABSPATH')){
    exit;
}

/**
 * Plugin Name: User Management (MG)
 * Description: Custom plugin to manage users — create, update, and delete.
 * Author: Martin Grigoryan
 * Version: 1.0.0
 * Text Domain: user-management-mg
 */


// Register admin menu
add_action( 'admin_menu', 'mgum_register_menu' );

function mgum_register_menu() {
	add_menu_page(
		'User Management',
		'User Management',
		'manage_options',
		'user-management-mg',
		'mgum_page_home',
		'dashicons-admin-users',
		80
	);

	add_submenu_page(
		'user-management-mg',
		'Create User',
		'Create User',
		'manage_options',
		'mgum-create-user',
		'mgum_page_create_user'
	);

	add_submenu_page(
		'user-management-mg',
		'Update User',
		'Update User',
		'manage_options',
		'mgum-update-user',
		'mgum_page_update_user'
	);

	add_submenu_page(
		'user-management-mg',
		'Delete User',
		'Delete User',
		'manage_options',
		'mgum-delete-user',
		'mgum_page_delete_user'
	);
}

// Page callbacks — used to display the forms

function mgum_page_home() {
	echo '<div class="wrap"><h1>User Management</h1><p>Select an action from the menu.</p></div>';
}

function mgum_page_create_user() {
	// todo: Add create user form display
	echo '<div class="wrap"><h1>Create User</h1></div>';
}

function mgum_page_update_user() {
	// todo: Add update user form display
	echo '<div class="wrap"><h1>Update User</h1></div>';
}

function mgum_page_delete_user() {
	// todo: Add delete user form display
	echo '<div class="wrap"><h1>Delete User</h1></div>';
}

// Form handlers — used to process form submissions

add_action( 'admin_init', 'mgum_handle_create_user' );
function mgum_handle_create_user() {
	// todo: Process create user form POST data
}

add_action( 'admin_init', 'mgum_handle_update_user' );
function mgum_handle_update_user() {
	// todo: Process update user form POST data
}

add_action( 'admin_init', 'mgum_handle_delete_user' );
function mgum_handle_delete_user() {
	// todo: Process delete user form POST data
}

// Admin notices — used to display result messages

add_action( 'admin_notices', 'mgum_admin_notices' );
function mgum_admin_notices() {
	// todo: Display admin notices based on result query param
}