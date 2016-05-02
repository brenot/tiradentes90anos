<?php
/**
 * Template part for displaying single posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Essence
 */


$post_format = get_post_format();
?>

<div class="blog-single">
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-item' ); ?>>
        <?php if ( $post_format == 'audio' || $post_format == 'video' || $post_format == 'gallery' || $post_format == 'image' ) :
            get_template_part( 'template-parts/postformat', $post_format );
        else :
            essence_post_thumbnail();
        endif; ?>
        <header class="entry-header">
            <?php the_title( sprintf( '<h3 class="screen-reader-text"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
            <ul class="entry-meta post-meta">
                <?php essence_posted_on(); ?>
            </ul><!-- .entry-meta -->
        </header><!-- .entry-header -->

        <div class="entry-content content-post">
            <?php the_content(); ?>
            <?php
            wp_link_pages(
                array(
                    'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'essence' ),
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'essence' ) . ' </span>%',
                    'separator'   => '<span class="screen-reader-text">, </span>',
                )
            );
            ?>
        </div><!-- .entry-content -->
        <div class="entry-footer entry-links">
            <?php essence_entry_footer(); ?>
            <?php get_template_part( 'template-parts/single-post-sharing' ); ?>
        </div><!-- .entry-footer -->

    </article><!-- #post-<?php the_ID(); ?> -->
</div><!-- /.blog-single -->



