<?php // Controller: General Setings | displays the tab's form

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// === HOOKS ===
add_action( 'admin_init', 'aaio_register_general_settings' ); // Register Settings
add_action( 'aaio_tab_general', 'aaio_render_general_tab_content' ); // Output tab content


// Render content in General Tab
function aaio_render_general_tab_content() {

    ?>

    <form method="post" action="options.php">
        <?php 
        settings_fields( 'aaio_general_settings_group' );
        do_settings_sections( 'aaio_general_settings_page' );
        submit_button();
        ?>
    </form>

    <?php

}
