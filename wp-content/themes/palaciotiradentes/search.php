<?php
/**
 * The template for displaying search results pages.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Essence
 */

$blog_layout_style = isset( $essence[ 'opt_blog_layout_style' ] ) ? $essence[ 'opt_blog_layout_style' ] : 'standard';
$primary_class = essence_primary_class( 'blog-content-area blog-' . esc_attr( $blog_layout_style ) . '-content-area' );
if ( $blog_layout_style == 'masonry' ) {
    $primary_class .= ' masonry-container';
}

get_header(); ?>

<div id="primary" class="content-area <?php echo esc_attr( $primary_class ); ?>">
    <main id="main" class="site-main">

        <?php if ( have_posts() ) : ?>

            <?php

            /**
             * essence_before_loop_posts hook
             *
             * @hooked essence_before_loop_posts_wrap - 10 (locate in engine/template-tags.php )
             **/
            do_action( 'essence_before_loop_posts' );
            ?>

            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php

                /*
                 * Run the loop for the search to output the results.
                 * If you want to overload this in a child theme then include a file
                 * called content-search.php and that will be used instead.
                 */
                get_template_part( 'template-parts/content', 'search' );
                ?>

            <?php endwhile; ?>

            <?php

            /**
             * essence_after_loop_posts hook
             *
             * @hooked essence_after_loop_posts_wrap - 10 (locate in engine/template-tags.php )
             **/
            do_action( 'essence_after_loop_posts' );
            ?>

            <?php essence_the_posts_navigation(
                array(
                    'prev_text'          => esc_html__( 'Previous page', 'essence' ),
                    'next_text'          => esc_html__( 'Next page', 'essence' ),
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'essence' ) . ' </span>',
                )
            ); ?>

        <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
