<?php // Shortcode: Testimonials

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// === HOOKS ===
add_shortcode( 'aaio_testimonials', 'aaio_render_testimonials_shortcode' );

// Render testimonials with Swiper + transient caching
function aaio_render_testimonials_shortcode( $atts ) {

    // Check if testimonials are enabled
    if ( ! get_option( 'aaio_enable_testimonials' ) ) {
        return ''; // Exit silently
    }

    // Modular enqueue
    aaio_enqueue_testimonials_assets();

    // Check for cached output
    $cached = get_transient( 'aaio_testimonials_cache' );
    
    if ( false !== $cached ) {
        return $cached; // Serve cached version
    }

    // Fetch testimonials
    $query = new WP_Query( array(
        'post_type'      => 'testimonial',
        'posts_per_page' => 10,
        'post_status'    => 'publish',
    ) );

    if ( ! $query->have_posts() ) {
        return '<p>' . esc_html__( 'No testimonials found.', AAIO_TD ) . '</p>';
    }

    ob_start();
    
    ?>

    <div class="swiper aaio-testimonials-swiper">
        <div class="swiper-wrapper">

            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-content"><?php the_content(); ?></div>
                        <div class="testimonial-author">
                            <?php echo esc_html( get_post_meta( get_the_ID(), '_aaio_testimonial_name', true ) ); ?>
                        </div>
                        <div class="testimonial-rating">
                            <?php
                                $rating = (int) get_post_meta( get_the_ID(), '_aaio_testimonial_rating', true );
                                echo str_repeat( '★', $rating );
                            ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>

        </div>
        <div class="swiper-pagination"></div>
    </div>

    <?php

    $output = ob_get_clean();

    // Cache the output for 24 hours
    set_transient( 'aaio_testimonials_cache', $output, 24 * HOUR_IN_SECONDS );

    return $output;

}
