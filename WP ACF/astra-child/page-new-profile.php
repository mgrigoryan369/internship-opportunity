<?php
// Template Name: User Profile

 // Disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

acf_form_head();

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) { ?>

	<?php get_sidebar(); ?>

<?php } ?>

	<div id="primary" <?php astra_primary_class(); ?>>

        <article
            <?php
                    echo wp_kses_post(
                        astra_attr(
                            'article-page',
                            array(
                                'id'    => 'post-' . get_the_id(),
                                'class' => join( ' ', get_post_class() ),
                            )
                        )
                    );
                    ?>
            >
                <?php astra_entry_top(); ?>

                <?php astra_entry_content_single_page(); ?>

                <?php
                    
                    acf_form(array(
                        'post_id'		=> 'new_post',
                        'post_title'	=> true,
                        'post_content'	=> true,
                        'new_post'		=> array(
                            'post_type'		=> 'post',
                            'post_status'	=> 'draft',
                            'post_category' => array( 3 ),
                        ),
                    ));
                    
                    ?>

                <?php astra_entry_bottom(); ?>

        </article><!-- #post-## -->

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) { ?>

	<?php get_sidebar(); ?>

<?php } ?>

<?php get_footer(); ?>
