<?php // Meta Save: Testimonials

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// === HOOKS ===
add_action( 'save_post_testimonial', 'aaio_save_testimonial_meta' );


// Save testimonial custom fields
function aaio_save_testimonial_meta( $post_id ) {

    // Verify nonce
    if ( ! isset( $_POST['aaio_testimonial_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['aaio_testimonial_meta_box_nonce'], 'aaio_testimonial_meta_box' ) ) {
        return;
    }

    // Abort during autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Abort if can't edit
    if ( ! current_user_can( 'edit_post', $post_id ) ){
        return;
    }

    // Sanitize & Save the fields
    if ( isset( $_POST['aaio_testimonial_name'] ) ) {
        update_post_meta( $post_id, '_aaio_testimonial_name', sanitize_text_field( $_POST['aaio_testimonial_name'] ) );
    }

    if ( isset( $_POST['aaio_testimonial_url'] ) ) {
        update_post_meta( $post_id, '_aaio_testimonial_url', esc_url_raw( $_POST['aaio_testimonial_url'] ) );
    }

    if ( isset( $_POST['aaio_testimonial_rating'] ) ){
        $rating = (int) $_POST['aaio_testimonial_rating'];
        $rating = max( 1, min( 5, $rating ) ); // Clamp to 1-5 just in case 
        update_post_meta( $post_id, '_aaio_testimonial_rating', $rating );
    }

    // Clear testimonial shortcode cache
    delete_transient( 'aaio_testimonials_cache' );

}