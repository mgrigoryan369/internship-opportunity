<?php // Meta-box: Testimonials

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// === HOOKS ====
add_action( 'add_meta_boxes', 'aaio_testimonials_add_meta_box' );


// Register the meta box
function aaio_testimonials_add_meta_box() {

    add_meta_box(
        'aaio_testimonials_meta_box', // Unique ID
        __( 'Testimonial Details', AAIO_TD ), // Title
        'aaio_testimonials_render_meta_box', // Callback function
        'testimonial', // Where to appear (post type)
        'normal', // Context: normal, side, advanced
        'default' // Priority: default, low, high
    );

}


// Render the meta box content
function aaio_testimonials_render_meta_box( $post ) {

    // Retrieve values
    $name = get_post_meta( $post->ID, '_aaio_testimonial_name', true ); // ID, meta_key, true for single value returned
    $url = get_post_meta( $post->ID, '_aaio_testimonial_url', true );
    $rating = get_post_meta( $post->ID, '_aaio_testimonial_rating', true );

    // Nonce field for security
    wp_nonce_field( 'aaio_testimonial_meta_box', 'aaio_testimonial_meta_box_nonce' );

    ?>

    <div class="meta-wrapper">
        <p class="meta-item">
            <label for="aaio_testimonial_name">
                <strong><?php esc_html_e( 'Author Name', AAIO_TD ); ?>:</strong>
            </label><br>
            <input type="text" id="aaio_testimonial_name" name="aaio_testimonial_name" class="regular-text" value="<?php echo esc_attr( $name ); ?>">
        </p>

        <p class="meta-item">
            <label for="aaio_testimonial_url">
                <strong><?php esc_html_e( 'Author Website URL', AAIO_TD ); ?>:</strong>
            </label><br>
            <input type="text" id="aaio_testimonial_url" name="aaio_testimonial_url" class="regular-text" value="<?php echo esc_url( $url ); ?>">
        </p>

        <p class="meta-item">
            <label for="aaio_testimonial_rating">
                <strong><?php esc_html_e( 'Rating (1-5)', AAIO_TD ); ?>:</strong>
            </label><br>
            <select id="aaio_testimonial_rating" name="aaio_testimonial_rating">
                <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                    <option value="<?php echo $i; ?>" <?php selected( $rating, $i); ?>><?php echo $i; ?> <?php echo str_repeat( '★', $i ); ?></option>
                <?php endfor; ?>
            </select>
        </p>
    </div>

    <?php 

}