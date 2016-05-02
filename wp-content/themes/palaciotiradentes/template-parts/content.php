<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Essence
 */

$essence = essence_get_global_essence();

$blog_layout_style = isset( $essence[ 'opt_blog_layout_style' ] ) ? $essence[ 'opt_blog_layout_style' ] : 'default'; // default, standard (= list)
$sidebar_pos = isset( $essence[ 'opt_blog_sidebar_pos' ] ) ? trim( $essence[ 'opt_blog_sidebar_pos' ] ) : 'right';
$the_excerpt_max_chars = 300;
$allow_the_excerpt = false;

if ( $blog_layout_style == 'standard' ) { // Always $allow_the_excerpt
    $the_excerpt_max_chars = isset( $essence[ 'opt_excerpt_max_char_length_standard' ] ) ? max( 1, intval( $essence[ 'opt_excerpt_max_char_length_standard' ] ) ) : 400;
    $allow_the_excerpt = true;
}

if ( $blog_layout_style == 'default' ) {
    $the_excerpt_max_chars = isset( $essence[ 'opt_excerpt_max_char_length' ] ) ? max( 1, intval( $essence[ 'opt_excerpt_max_char_length' ] ) ) : 200;
    $allow_the_excerpt = isset( $essence[ 'opt_blog_loop_content_type' ] ) ? $essence[ 'opt_blog_loop_content_type' ] != 1 : false;
}

$show_read_more = isset( $essence[ 'opt_blog_show_readmore' ] ) ? $essence[ 'opt_blog_show_readmore' ] == 1 : false;

$postgrid = '';
if ( $blog_layout_style == 'grid' ) {
    if ( $sidebar_pos != 'fullwidth' ) {
        $postgrid = 'col-sm-6';
    }
    else {
        $postgrid = 'col-sm-4';
    }

    $the_excerpt_max_chars = isset( $essence[ 'opt_excerpt_max_char_length' ] ) ? max( 1, intval( $essence[ 'opt_excerpt_max_char_length' ] ) ) : 150;
    $allow_the_excerpt = isset( $essence[ 'opt_blog_loop_content_type' ] ) ? $essence[ 'opt_blog_loop_content_type' ] != 1 : false;

}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-item ' . esc_attr( $postgrid ) ); ?>>

    <?php if ( $blog_layout_style == 'default' ):  //Listing in psd == default ?>

        <?php essence_post_thumbnail(); ?>

        <header class="entry-header">
            <?php the_title( sprintf( '<h4 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>

            <?php if ( 'post' === get_post_type() ) : ?>
                <ul class="entry-meta post-meta">
                    <?php essence_posted_on(); ?>
                </ul><!-- .entry-meta -->
            <?php endif; ?>
        </header><!-- .entry-header -->

        <div class="entry-content content-post">
            <div class="entry-content-post">
                <?php if ( $allow_the_excerpt ): ?>
                    <?php echo function_exists( 'essence_get_the_excerpt_max_charlength' ) ? essence_get_the_excerpt_max_charlength( $the_excerpt_max_chars ) : get_the_excerpt(); ?>
                <?php else: ?>
                    <?php
                    the_content(
                        sprintf(
                        /* translators: %s: Name of current post. */
                            wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'essence' ), array( 'span' => array( 'class' => array() ) ) ),
                            the_title( '<span class="screen-reader-text">"', '"</span>', false )
                        )
                    );
                    ?>

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
                <?php endif; ?>
            </div><!-- .entry-content-post -->

            <?php if ( $allow_the_excerpt ) {
                echo essence_modify_read_more_link();
            } ?>
        </div> <!--.entry-content content-post-->
    <?php endif; // End if ( $blog_layout_style == 'default' ) ?>

    <?php if ( $blog_layout_style == 'standard' ): // Style List ?>
        <div class="row equal-container">
            <div class="tr-img-post equal-elem col-md-6">
                <?php if ( !post_password_required() && !is_attachment() ): ?>
                    <div class="post-format post-format-<?php echo esc_attr( get_post_format() ); ?>">
                        <?php essence_post_thumbnail(); ?>
                    </div>
                <?php endif; // End if ( has_post_thumbnail() && !post_password_required() && !is_attachment() ) ?>
            </div>
            <div class="tr-content-post equal-elem col-md-6">
                <div class="info-post">
                    <?php the_title( sprintf( '<h3 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                    <?php if ( 'post' === get_post_type() ) : ?>
                        <ul class="entry-meta post-meta">
                            <?php essence_posted_on(); ?>
                        </ul><!-- /.entry-meta -->
                    <?php endif; ?>
                    <div class="entry-content content-post">
                        <?php echo function_exists( 'essence_get_the_excerpt_max_charlength' ) ? essence_get_the_excerpt_max_charlength( $the_excerpt_max_chars ) : get_the_excerpt(); ?>
                    </div><!-- /.entry-content -->
                    <?php if ( $allow_the_excerpt && $show_read_more ) {
                        echo essence_modify_read_more_link();
                    } ?>
                </div><!-- /.info-post -->
            </div>
        </div>

    <?php endif; // End if ( $blog_layout_style == 'standard' ) ?>
    <?php if ( $blog_layout_style == 'grid' ):  // Grid ?>
        <div class="tr-content-grid">
            <?php essence_post_thumbnail(); ?>

            <header class="entry-header">
                <?php the_title( sprintf( '<h3 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

                <?php if ( 'post' === get_post_type() ) : ?>
                    <ul class="entry-meta post-meta">
                        <?php essence_posted_on(); ?>
                    </ul><!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->

            <div class="entry-content content-post">
                <?php if ( $allow_the_excerpt ): ?>
                    <?php echo function_exists( 'essence_get_the_excerpt_max_charlength' ) ? essence_get_the_excerpt_max_charlength( $the_excerpt_max_chars ) : get_the_excerpt(); ?>
                <?php else: ?>
                    <?php
                    the_content(
                        sprintf(
                        /* translators: %s: Name of current post. */
                            wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'essence' ), array( 'span' => array( 'class' => array() ) ) ),
                            the_title( '<span class="screen-reader-text">"', '"</span>', false )
                        )
                    );
                    ?>

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
                <?php endif; ?>
            </div><!-- .entry-content -->

            <?php if ( $allow_the_excerpt && $show_read_more ) {
                echo essence_modify_read_more_link();
            } ?>
        </div>

    <?php endif; // End if ( $blog_layout_style == 'grid' ) ?>


</article><!-- #post-<?php the_ID(); ?> -->
