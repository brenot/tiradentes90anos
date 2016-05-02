<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Essence
 */

$essence = essence_get_global_essence();

$title_404 = isset( $essence[ 'opt_404_header_title' ] ) ? sanitize_text_field( $essence[ 'opt_404_header_title' ] ) : esc_html__( 'Oops, page not found !', 'essence' );
$text_404 = isset( $essence[ 'opt_404_text' ] ) ? $essence[ 'opt_404_text' ] : esc_html__( 'It looks like nothing was found at this location. Maybe try a search?', 'essence' );
$img_404 = isset( $essence[ 'opt_404_img' ] ) ? $essence[ 'opt_404_img' ] : array( 'url' => get_template_directory_uri() . '/assets/images/page404.png' );


get_header(); ?>

<div id="primary" class="content-area col-xs-12">
    <main id="main" class="site-main">

        <div class="page-inner page-404">
            <div class="content-404 text-center">
                <?php if ( trim( $title_404 ) != '' ): ?>
                    <h2><?php echo sanitize_text_field( $title_404 ); ?></h2>
                <?php endif; ?>
                <?php if ( trim( $img_404[ 'url' ] ) != '' ): ?>
                    <figure><img src="<?php echo esc_url( $img_404[ 'url' ] ); ?>" alt="404"/></figure>
                <?php endif; // End if ( trim( $img_404['url'] ) != '' ) ?>
                <?php if ( trim( $text_404 ) != '' ): ?>
                    <h4><?php echo sanitize_text_field( $text_404 ); ?></h4>
                <?php endif; // End if ( trim( $text_404 ) != '' ) ?>
                <?php get_search_form(); ?>
            </div>
        </div>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
