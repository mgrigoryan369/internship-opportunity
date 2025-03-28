<?php
/*
Plugin Name: Clean Markup Widget
Description: Add clean, well-formatted markup to any widgetized area.
Plugin URI:  https://github.com/mgrigoryan369
Author:      Martin Grigoryan
Version:     1.0
Text Domain: custom-widget
*/

// example widget class
class Clean_Markup_Widget extends WP_Widget {

	// set up widget
	public function __construct() {
		
        $id = 'clean_markup_widget';
        $title = esc_html__('Clean Markup Widget', 'custom-widget');
        
		$options = array( 
			'classname' => 'clean-markup-widget',
			'description' => esc_html__('Allow markup display within this widget', 'custom-widget'),
		);
		
		parent::__construct( $id, $title, $options );
		
	}
	
	// output widget content
	public function widget( $args, $instance ) {
		
		// outputs the content of the widget
		
	}
	
	// output widget form fields
	public function form( $instance ) {
		
		// outputs the widget form fields in the Admin Area
		
	}
	
	// process widget options
	public function update( $new_instance, $old_instance ) {
		
		// processes the widget options
		
	}
	
}

// register widget
function myplugin_register_widgets() {
	register_widget( 'Clean_Markup_Widget' );
}
// hook into widgets_init
add_action( 'widgets_init', 'myplugin_register_widgets' );


