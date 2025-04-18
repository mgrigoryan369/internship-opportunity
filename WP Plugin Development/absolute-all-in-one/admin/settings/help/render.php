<?php // Render: Help Tab Sections

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// === HOOKS ===
add_action( 'aaio_help_tab_sections', 'aaio_render_help_maintenance_section' );

// Output Help Tab: Maintenance (Cache + Reset)
function aaio_render_help_maintenance_section() {
    ?>


    <!-- === SECTION: SHORTCODE USAGE === -->
    <?php if ( get_option( 'aaio_enable_testimonials' ) ) : ?>
    <h3><?php esc_html_e( 'Testimonials Shortcode', AAIO_TD ); ?></h3>
    <p><?php esc_html_e( 'Use the shortcode below to display testimonials anywhere on the website:', AAIO_TD ); ?></p>
    <code>[aaio_testimonials]</code>

    <h4><?php esc_html_e( 'Customization Options:', AAIO_TD ); ?></h4>
    <ul>
        <li><code>posts="5"</code> — <?php esc_html_e( 'Limit number of testimonials (default: 10)', AAIO_TD ); ?></li>
        <li><code>show_author="false"</code> — <?php esc_html_e( 'Hide the author name', AAIO_TD ); ?></li>
        <li><code>show_url="false"</code> — <?php esc_html_e( 'Hide the author website link', AAIO_TD ); ?></li>
        <li><code>show_rating="false"</code> — <?php esc_html_e( 'Hide star rating', AAIO_TD ); ?></li>
    </ul>

    <p><?php esc_html_e( 'Example:', AAIO_TD ); ?> <code>[aaio_testimonials posts="3" show_author="false"]</code></p>
    <hr style="margin: 40px 0;">
    <?php endif; ?>


    <!-- === SECTION: CACHE MANAGEMENT === -->
    <h3><?php esc_html_e( 'Cache Management', AAIO_TD ); ?></h3>

    <?php aaio_render_cache_section( 'testimonials', 'Testimonials' ); ?>
    <?php aaio_render_cache_section( 'services', 'Services' ); ?>
    <?php aaio_render_cache_section( 'portfolio', 'Portfolio' ); ?>

    <form method="post" style="margin-top: 30px;">
        <?php wp_nonce_field( 'aaio_clear_all_transients_action', 'aaio_clear_all_transients_nonce' ); ?>
        <input type="submit" class="button button-primary" name="aaio_clear_all_transients" value="<?php esc_attr_e( 'Clear All Caches', AAIO_TD ); ?>">
    </form>

    <hr style="margin: 40px 0;">

    
    <!-- === SECTION: SETTINGS OVERVIEW === -->
    <h3><?php esc_html_e( 'Settings Overview & Reset', AAIO_TD ); ?></h3>
    <p><?php esc_html_e( 'These reflect the current saved options. Resetting will restore default values.', AAIO_TD ); ?></p>

    <table class="widefat striped" style="max-width: 600px;">
        <thead>
            <tr>
                <th><?php esc_html_e( 'Option', AAIO_TD ); ?></th>
                <th><?php esc_html_e( 'Status', AAIO_TD ); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $options = [
                'aaio_disable_admin_bar' => __( 'Hide Admin Bar', AAIO_TD ),
                'aaio_disable_emojis' => __( 'Disable Emojis', AAIO_TD ),
                'aaio_disable_wp_version' => __( 'Hide WP Version', AAIO_TD ),
                'aaio_enable_svg_uploads' => __( 'Enable SVG Uploads', AAIO_TD ),
                'aaio_enable_testimonials' => __( 'Enable Testimonials CPT', AAIO_TD ),
            ];

            foreach ( $options as $key => $label ) {
                $is_enabled = get_option( $key );
                $status = $is_enabled
                    ? '<span style="color: green;">✅ ' . __( 'On', AAIO_TD ) . '</span>'
                    : '<span style="color: red;">❌ ' . __( 'Off', AAIO_TD ) . '</span>';

                echo '<tr><td>' . esc_html( $label ) . '</td><td>' . $status . '</td></tr>';
            }
            ?>
        </tbody>
    </table>

    
    <!-- === Reset All Options === -->
    <form method="post" style="margin-top: 20px;">
        <?php wp_nonce_field( 'aaio_reset_options_action', 'aaio_reset_options_nonce' ); ?>
        <input type="submit" class="button button-secondary" name="aaio_reset_general_options" value="<?php esc_attr_e( 'Reset All Options to Defaults', AAIO_TD ); ?>" onclick="return confirm('<?php esc_attr_e( 'Are you sure you want to reset all options?', AAIO_TD ); ?>');">
    </form>

    <?php
}