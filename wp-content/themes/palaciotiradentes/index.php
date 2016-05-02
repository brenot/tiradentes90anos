<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Essence
 */

$blog_layout_style = isset( $essence[ 'opt_blog_layout_style' ] ) ? $essence[ 'opt_blog_layout_style' ] : 'default'; // default, starndard (= Thumb)
$primary_class = essence_primary_class( 'blog-content-area blog-' . esc_attr( $blog_layout_style ) . '-content-area' );


get_header(); ?>

<div id="primary" class="content-area <?php echo esc_attr( $primary_class ); ?>">
    <main id="main" class="site-main">

        <?php if ( have_posts() ) : ?>

            <?php if ( is_home() && !is_front_page() ) : ?>
                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>

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
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content', get_post_format() );
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
