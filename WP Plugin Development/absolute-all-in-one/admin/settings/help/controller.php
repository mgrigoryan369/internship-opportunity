<?php // Controller: Help Tab

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// === HOOKS ===
add_action( 'aaio_tab_help', 'aaio_render_help_tab_content' );

// Output the Help tab content
function aaio_render_help_tab_content() {
    ?>
    <div class="wrap">
        <h2><?php esc_html_e( 'Help & Shortcodes', AAIO_TD ); ?></h2>
        
        <?php
        // Output reusable help sections
        do_action( 'aaio_help_tab_sections' );
        ?>
    </div>
    <?php
}