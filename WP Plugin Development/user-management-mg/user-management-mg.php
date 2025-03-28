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
	if (!current_user_can('manage_options')) return;

	?>

	<div class="wrap">
			<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
			<form method="post">
				<h3><?php esc_html_e('Add New User', 'user-management-mg'); ?></h3>
				<p>
					<label for="username"><?php esc_html_e('Username', 'user-management-mg'); ?></label><br />
					<input class="regular-text" type="text" size="40" name="username" id="username">
				</p>
				<p>
					<label for="email"><?php esc_html_e('Email', 'user-management-mg'); ?></label><br />
					<input class="regular-text" type="text" size="40" name="email" id="email">
				</p>
				<p>
					<label for="password"><?php esc_html_e('Password', 'user-management-mg'); ?></label><br />
					<input class="regular-text" type="text" size="40" name="password" id="password">
				</p>

				<p><?php esc_html_e('The user will receive this information via email.', 'user-management-mg'); ?></p>

				<input type="hidden" name="mgum_nonce" value="<?php echo wp_create_nonce('mgum_nonce'); ?>">
				<input type="submit" class="button button-primary" value="<?php esc_html_e('Add User', 'user-management-mg'); ?>">
			</form>
		</div>

	<?php
}

function mgum_page_update_user() {
	if ( ! current_user_can( 'manage_options' ) ) return;
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form method="post">
			<h3><?php esc_html_e('Update User', 'user-management-mg'); ?></h3>
			<p>
				<label for="email"><?php esc_html_e('Enter the user&rsquo;s email (required)', 'user-management-mg'); ?></label><br />
				<input class="regular-text" type="text" size="40" name="email" id="email">
			</p>
			<p>
				<label for="display-name"><?php esc_html_e('Enter a new Display Name for this user:', 'user-management-mg'); ?></label><br />
				<input class="regular-text" type="text" size="40" name="display-name" id="display-name">
			</p>
			<p>
				<label for="user-url"><?php esc_html_e('Enter a new Website URL for this user:', 'user-management-mg'); ?></label><br />
				<input class="regular-text" type="text" size="40" name="user-url" id="user-url">
			</p>

			<input type="hidden" name="mgum_update_nonce" value="<?php echo wp_create_nonce('mgum_update_nonce'); ?>">
			<input type="submit" class="button button-primary" value="<?php esc_html_e('Update User', 'user-management-mg'); ?>">
		</form>
	</div>
	<?php
}

function mgum_page_delete_user() {
	// todo: Add delete user form display
	echo '<div class="wrap"><h1>Delete User</h1></div>';
}

// Form handlers — used to process form submissions

// Create User
add_action( 'admin_init', 'mgum_handle_create_user' );
function mgum_handle_create_user() {
	if (isset($_POST['mgum_nonce']) && wp_verify_nonce($_POST['mgum_nonce'], 'mgum_nonce')) {

		if (!current_user_can('manage_options')) wp_die();

		$username = !empty($_POST['username']) ? sanitize_user( $_POST['username']) : '';
		$email = !empty($_POST['email']) ? sanitize_email( $_POST['email']) : '';
		$password = !empty($_POST['password']) ? $_POST['password'] : wp_generate_password();

		$result = '';

		if (username_exists($username) || email_exists($email)) {
			$result = esc_html__('The user already exists.', 'user-management-mg');
		} else if (empty($username) || empty($email)) {
			$result = esc_html__('Required: username and email.', 'user-management-mg');
		} else {
			$user_id = wp_create_user($username, $password, $email);

			if (is_wp_error($user_id)) {
				$result = $user_id->get_error_message();
			} else {
				$subject = __('Welcome to WordPress!', 'user-management-mg');
				$message = __('You can log in using your chosen username and this password: ', 'user-management-mg') . $password;

				wp_mail($email, $subject, $message);

				$result = $user_id;
			}
		}

		$redirect_url = admin_url('admin.php?page=mgum-create-user&result=' . urlencode($result));
		wp_redirect( $redirect_url );
		exit;
	}
}

// Update User
add_action( 'admin_init', 'mgum_handle_update_user' );
function mgum_handle_update_user() {
	if (isset($_POST['mgum_update_nonce']) && wp_verify_nonce($_POST['mgum_update_nonce'], 'mgum_update_nonce') ) {
		
		if (!current_user_can('manage_options')) wp_die();

		$email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
		$display_name = isset($_POST['display-name']) ? sanitize_text_field($_POST['display-name']) : '';
		$user_url = isset($_POST['user-url']) ? esc_url_raw($_POST['user-url']) : '';

		$user_id = email_exists($email);
		if (is_numeric( $user_id )) {
			$userdata = array(
				'ID' => $user_id,
				'display_name' => $display_name,
				'user_url' => $user_url
			);
			$user_id = wp_update_user($userdata);
			if (is_wp_error($user_id)) {
				$user_id = $user_id->get_error_message();
			}
		} else {
			$user_id = __('User not found.', 'user-management-mg');
		}

		$redirect = admin_url('admin.php?page=mgum-update-user&result=' . urlencode($user_id));
		wp_redirect($redirect);
		exit;
	}
}

// Delete User
add_action( 'admin_init', 'mgum_handle_delete_user' );
function mgum_handle_delete_user() {
	// todo: Process delete user form POST data
}

// Admin notices — used to display result messages

add_action( 'admin_notices', 'mgum_admin_notices' );
function mgum_admin_notices() {
	$screen = get_current_screen();

	// Adding User - admin msg
	if ('user-management_page_mgum-create-user' === $screen->id && isset($_GET['result'])) {
		$result = sanitize_text_field($_GET['result']);

		if (is_numeric($result)) {
			echo '<div class="notice notice-success is-dismissible"><p><strong>' . esc_html__('User added successfully.', 'user-management-mg') . '</strong></p></div>';
		} else {
			echo '<div class="notice notice-warning is-dismissible"><p><strong>' . esc_html($result) . '</strong></p></div>';
		}
	}

	// Updating User - admin msg
	if ('user-management_page_mgum-update-user' === $screen->id && isset($_GET['result'])) {
		$result = sanitize_text_field($_GET['result']);
	
		if (is_numeric($result)) {
			echo '<div class="notice notice-success is-dismissible"><p><strong>' . esc_html__('User updated successfully.', 'user-management-mg') . '</strong></p></div>';
		} else {
			echo '<div class="notice notice-warning is-dismissible"><p><strong>' . esc_html($result) . '</strong></p></div>';
		}
	}
}