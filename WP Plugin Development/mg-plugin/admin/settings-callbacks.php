<?php // MG Plugin - Settings Callbacks

// exit if file is called directly
if (!defined('ABSPATH')){
    exit;
}

// validate plugin settings
function mg_plugin_callback_validate_options($input) {
    // todo: add validation functionality

    return $input;
}

// callback: login section
function mg_plugin_callback_section_login() {
	
	echo '<p>These settings enable you to customize the WP Login screen.</p>';
	
}

// callback: admin section
function mg_plugin_callback_section_admin() {
	
	echo '<p>These settings enable you to customize the WP Admin Area.</p>';
	
}

// callback: text field
function mg_plugin_callback_field_text( $args ) {
	// todo: add callback functionality..

	echo 'This will be a text field.';

}

// callback: radio field
function mg_plugin_callback_field_radio( $args ) {

	// todo: add callback functionality..

	echo 'This will be a radio field.';

}

// callback: textarea field
function mg_plugin_callback_field_textarea( $args ) {

	// todo: add callback functionality..

	echo 'This will be a textarea.';

}

// callback: checkbox field
function mg_plugin_callback_field_checkbox( $args ) {

	// todo: add callback functionality..

	echo 'This will be a checkbox.';

}

// callback: select field
function mg_plugin_callback_field_select( $args ) {

	// todo: add callback functionality..

	echo 'This will be a select menu.';

}

