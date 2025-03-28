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

        // can also use 'extract($args)' to customize widget
        extract( $args );

        // add another class to the widget wrapper as demo
        $custom_class = 'clean-markup-widget-another-class';
        $before_widget = str_replace('class="', 'class="' . esc_attr($custom_class) . ' ', $before_widget);

        // Output the widget
	    echo $before_widget;
		
		// outputs the content of the widget
        $markup = '';

        if (isset($instance['markup'])){
            echo wp_kses_post($instance['markup']);
        }

        echo $after_widget;
		
	}
	
	// output widget form fields
	public function form( $instance ) {
		
		// outputs the widget form fields in the Admin Area
        $id = $this->get_field_id('markup');
        $for = $this->get_field_id('markup');
        $name = $this->get_field_name('markup');
        $label = __('Markup/text:', 'custom-widget');
        $markup = '<p>' . __('Clean markup.', 'custom-widget') . '</p>';

        if(isset($instance['markup']) && !empty($instance['markup'])){
            $markup = $instance['markup'];
        }
        ?>
        <p>
            <label for="<?php echo esc_attr($for); ?>"><?php echo esc_html($label); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>"><?php echo esc_textarea($markup); ?></textarea>
        </p>
    
    <?php }
	
	// process widget options
	public function update( $new_instance, $old_instance ) {
		
		// processes the widget options
        $instance = array();

        if (isset($new_instance['markup']) && !empty($new_instance['markup'])){
            $instance['markup'] = $new_instance['markup'];
        }

        return $instance;

	}
	
}

// register widget
function myplugin_register_widgets() {
	register_widget( 'Clean_Markup_Widget' );
}
// hook into widgets_init
add_action( 'widgets_init', 'myplugin_register_widgets' );


