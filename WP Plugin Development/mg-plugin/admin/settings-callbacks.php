<?php // MG Plugin - Settings Callbacks

// exit if file is called directly
if (!defined('ABSPATH')){
    exit;
}

// callback: login section
function mg_plugin_callback_section_login() {
	
	echo '<p>' . esc_html__('These settings enable you to customize the WP Login screen.', 'mg-plugin') . '</p>';
	
}

// callback: admin section
function mg_plugin_callback_section_admin() {
	
	echo '<p>' . esc_html__('These settings enable you to customize the WP Admin Area.', 'mg-plugin') . '</p>';
	
}

// callback: text field
function mg_plugin_callback_field_text( $args ) {
	
    $options = get_option( 'mg_plugin_options', mg_plugin_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
	echo '<input id="mg_plugin_options_'. $id .'" name="mg_plugin_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	echo '<label for="mg_plugin_options_'. $id .'">'. $label .'</label>';

    //quick debug - why are fields blank...
    //echo '<pre>';
    //print_r( $options );
    //echo '</pre>';

}

// callback: radio field
function mg_plugin_callback_field_radio( $args ) {
	
    $options = get_option( 'mg_plugin_options', mg_plugin_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
	$radio_options = array(
		
		'enable'  => esc_html__('Enable custom styles', 'mg-plugin'),
		'disable' => esc_html__('Disable custom styles', 'mg-plugin')
		
	);
	
	foreach ( $radio_options as $value => $label ) {
		
		$checked = checked( $selected_option === $value, true, false );
		
		echo '<label><input name="mg_plugin_options['. $id .']" type="radio" value="'. $value .'"'. $checked .'> ';
		echo '<span>'. $label .'</span></label><br />';
		
	}
	

}

// callback: textarea field
function mg_plugin_callback_field_textarea( $args ) {

	$options = get_option( 'mg_plugin_options', mg_plugin_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$allowed_tags = wp_kses_allowed_html( 'post' );
	
	$value = isset( $options[$id] ) ? wp_kses( stripslashes_deep( $options[$id] ), $allowed_tags ) : '';
	
	echo '<textarea id="mg_plugin_options_'. $id .'" name="mg_plugin_options['. $id .']" rows="5" cols="50">'. $value .'</textarea><br />';
	echo '<label for="mg_plugin_options_'. $id .'">'. $label .'</label>';

}

// callback: checkbox field
function mg_plugin_callback_field_checkbox( $args ) {

	$options = get_option( 'mg_plugin_options', mg_plugin_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';
	
	echo '<input id="mg_plugin_options_'. $id .'" name="mg_plugin_options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
	echo '<label for="mg_plugin_options_'. $id .'">'. $label .'</label>';

}

// callback: select field
function mg_plugin_callback_field_select( $args ) {

	$options = get_option( 'mg_plugin_options', mg_plugin_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
	$select_options = array(
		
		'default'   => esc_html__('Default',    'mg-plugin'),
		'light'     => esc_html__('Light',      'mg-plugin'),
		'blue'      => esc_html__('Blue',       'mg-plugin'),
		'coffee'    => esc_html__('Coffee',     'mg-plugin'),
		'ectoplasm' => esc_html__('Ectoplasm',  'mg-plugin'),
		'midnight'  => esc_html__('Midnight',   'mg-plugin'),
		'ocean'     => esc_html__('Ocean',      'mg-plugin'),
		'sunrise'   => esc_html__('Sunrise',    'mg-plugin'),
		
	);
	
	echo '<select id="mg_plugin_options_'. $id .'" name="mg_plugin_options['. $id .']">';
	
	foreach ( $select_options as $value => $option ) {
		
		$selected = selected( $selected_option === $value, true, false );
		
		echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';
		
	}
	
	echo '</select> <label for="mg_plugin_options_'. $id .'">'. $label .'</label>';

}

