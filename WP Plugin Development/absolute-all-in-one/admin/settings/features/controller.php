<?php // SETTINGS: FEATURES TAB

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// === HOOKS ===
add_action( 'admin_init', 'aaio_register_features_settings' ); // Register Settings
add_action( 'aaio_tab_features', 'aaio_render_features_tab_content' ); // Output tab content


// Render content in Features Tab
function aaio_render_features_tab_content() {

    ?>

    <form method="post" action="options.php">
        <?php
        settings_fields( 'aaio_features_settings_group' );
        do_settings_sections( 'aaio_features_settings_page' );
        submit_button();
        ?>
    </form>

    <?php

}