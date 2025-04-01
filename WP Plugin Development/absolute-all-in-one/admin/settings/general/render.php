<?php // Render: General Settings | renders individual field UIs

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// Render Admin Bar checkbox field
function aaio_render_admin_bar_checkbox() {
    
    $option = get_option( 'aaio_disable_admin_bar', false );
    
    ?>

    <div class="aaio-settings-row">
        <label class="aaio-toggle">
            <input type="checkbox" name="aaio_disable_admin_bar" value="1" <?php checked( $option, 1 ); ?> />
            <span class="aaio-slider"></span>
        </label>
        <span style="margin-left: 10px;">
            <?php esc_html_e( 'Hide admin bar when viewing website on front-end', AAIO_TD ); ?>
        </span>
    </div>
    
    <?php 

}


// Render Emoji checkbox field
function aaio_render_emoji_checkbox() {

    $option = get_option( 'aaio_disable_emojis', false );

    ?>

    <div class="aaio-settings-row">
        <label class="aaio-toggle">
            <input type="checkbox" name="aaio_disable_emojis" class="aaio-toggle" value="1" <?php checked( $option, 1 ); ?> />
            <span class="aaio-slider"></span>
        </label>
        <span style="margin-left: 10px;">
            <?php esc_html_e( 'Remove emoji scripts/styles front-end & back-end', AAIO_TD ); ?>
        </span>
    </div>

    <?php

}


// Render Disable WP Version checkbox field
function aaio_render_wp_version_checkbox() {

    $option = get_option( 'aaio_disable_wp_version', false );

    ?>

    <div class="aaio-settings-row">
        <label class="aaio-toggle">
            <input type="checkbox" name="aaio_disable_wp_version" class="aaio-toggle" value="1" <?php checked( $option, 1 ); ?> />
            <span class="aaio-slider"></span>
        </label>
        <span style="margin-left: 10px;">
            <?php esc_html_e( 'Disable WordPress Version', AAIO_TD ); ?>
        </span>
    </div>

    <?php

}


// Render SVG Upload checkbox field
function aaio_render_svg_upload_checkbox() {

    $option = get_option( 'aaio_enable_svg_uploads', false );

    ?>

    <div class="aaio-settings-row">
        <label class="aaio-toggle">
            <input type="checkbox" name="aaio_enable_svg_uploads" value="1" <?php checked( $option, 1 ); ?> />
            <span class="aaio-slider"></span>
        </label>
        <span style="margin-left: 10px;">
            <?php esc_html_e( 'Enable SVG Uploads', AAIO_TD ); ?>
        </span>
    </div>

    <?php

}