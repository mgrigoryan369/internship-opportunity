<?php // Render: Features Settings | renders individual field UIs

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// Render Testimonials checkbox field
function aaio_render_testimonials_checkbox() {
    $val = get_option( 'aaio_enable_testimonials', false );
    ?>
    <div class="aaio-settings-row">
        <label class="aaio-toggle">
            <input type="checkbox" name="aaio_enable_testimonials" value="1" <?php checked( $val, 1 ); ?> />
            <span class="aaio-slider"></span>
        </label>
        <span style="margin-left: 10px;"><?php esc_html_e( 'Register Testimonials CPT', 'absolute-all-in-one' ); ?></span>
    </div>
    <?php
}

// Render Portfolio checkbox field
function aaio_render_portfolio_checkbox() {
    $val = get_option( 'aaio_enable_portfolio', false );
    ?>
    <div class="aaio-settings-row">
        <label class="aaio-toggle">
            <input type="checkbox" name="aaio_enable_portfolio" value="1" <?php checked( $val, 1 ); ?> />
            <span class="aaio-slider"></span>
        </label>
        <span style="margin-left: 10px;"><?php esc_html_e( 'Register Portfolio CPT', 'absolute-all-in-one' ); ?></span>
    </div>
    <?php
}

// Render Services checkbox field
function aaio_render_services_checkbox() {
    $val = get_option( 'aaio_enable_services', false );
    ?>
    <div class="aaio-settings-row">
        <label class="aaio-toggle">
            <input type="checkbox" name="aaio_enable_services" value="1" <?php checked( $val, 1 ); ?> />
            <span class="aaio-slider"></span>
        </label>
        <span style="margin-left: 10px;"><?php esc_html_e( 'Register Services CPT', 'absolute-all-in-one' ); ?></span>
    </div>
    <?php
}