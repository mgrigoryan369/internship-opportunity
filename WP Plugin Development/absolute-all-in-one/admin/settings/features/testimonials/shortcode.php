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

    //error_log('Shortcode function loaded');

    // Modular enqueue
    aaio_enqueue_testimonials_assets();
    
    //error_log('Enqueue called from shortcode');

    // Parse shortcode atts
    $atts = shortcode_atts( [
        'posts' => 10,
        'show_rating' => 'true',
        'show_author' => 'true',
        'show_url' => 'true',
    ], $atts, 'aaio_testimonials' );

    // Sanitize shortcode values
    $posts = max( 1, intval( $atts['posts'] ) );
    $show_rating = filter_var( $atts['show_rating'], FILTER_VALIDATE_BOOLEAN );
    $show_author = filter_var( $atts['show_author'], FILTER_VALIDATE_BOOLEAN );
    $show_url = filter_var( $atts['show_url'], FILTER_VALIDATE_BOOLEAN );

    // Build a unique cache key based on attributes then Check for cached output
    $cache_key = 'aaio_testimonials_cache_' . md5( serialize( $atts ) );
    $cached = get_transient( $cache_key );
    
    if ( false !== $cached ) {
        return $cached; // Serve cached version
    }

    // Fetch testimonials
    $query = new WP_Query( array(
        'post_type'      => 'testimonial',
        'posts_per_page' => $posts,
        'post_status'    => 'publish',
    ) );

    // In case no testimonials exist
    if ( ! $query->have_posts() ) {
        return '<p>' . esc_html__( 'No testimonials found.', AAIO_TD ) . '</p>';
    }

    ob_start();
    
    ?>

    <div class="swiper aaio-testimonials-swiper">
        <div class="swiper-wrapper">

            <?php 
            
            //error_log( 'Total testimonials found: ' . $query->found_posts );
            //error_log( print_r( $query->posts, true ) );
            
            while ( $query->have_posts() ) : $query->the_post(); 

            ?>
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-content"><?php the_content(); ?></div>

                        <?php if ( $show_author ) : ?>

                        <div class="testimonial-author">
                            <?php echo esc_html( get_post_meta( get_the_ID(), '_aaio_testimonial_name', true ) ); ?>
                        </div>

                        <?php endif; ?>
                        
                        <?php if ( $show_url ) :
                        
                            $url = get_post_meta( get_the_ID(), '_aaio_testimonial_url', true );
                            if ( $url ) : ?>
                            <div class="testimonial-url">
                                <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer">Visit Website</a>
                            </div>

                        <?php endif; endif; ?>
                        
                        <?php if ( $show_rating ) :
                            $rating = (int) get_post_meta( get_the_ID(), '_aaio_testimonial_rating', true );
                            if ( $rating >= 1 && $rating <= 5 ) : ?>
                            <div class="testimonial-rating">
                                <?php echo str_repeat( '★', $rating ); ?>
                            </div>

                        <?php endif; endif; ?>

                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

    <?php

    $output = ob_get_clean();

    // Cache the output for 24 hours
    set_transient( $cache_key, $output, 24 * HOUR_IN_SECONDS );

    // User helpers.php to handle the tracking
    aaio_track_dynamic_transient( 'testimonials', $cache_key );

    return $output;

}