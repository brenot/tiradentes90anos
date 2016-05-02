<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package    West
 * @subpackage West
 * @since      West 1.0
 */
get_header();


?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php
            $portfolio_type = get_post_meta( get_the_ID(), 'essence_portfolio-type', true );
            $porfolio_info = get_post_meta( get_the_ID(), 'essence_portfolio-info', true );
            $porfolio_sharing = get_post_meta( get_the_ID(), 'essence_social-sharing', true );
            ?>
            <!-- Single Portfolio -->
            <div class="essence-portfolio-content-wrap">
                <?php get_template_part( 'template-parts/portfolio', $portfolio_type ) ?>
                <div class="essence-portfolio-content equal-container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="essence-portfolio-content-inner equal-elem">
                                <h4 class="portfolio-title-single">
                                    <?php the_title(); ?>
                                </h4>
                                <div class="portfolio-single-content">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="essence-portfolio-info equal-elem">
                                <div class="portfolio-info-box">
                                    <?php
                                    foreach ( (array) $porfolio_info as $key => $entry ) {


                                        if ( isset( $entry[ 'essence_title' ] ) && trim( $entry[ 'essence_title' ] ) != '' ) {
                                            $title = esc_html( $entry[ 'essence_title' ] );
                                        }

                                        if ( isset( $entry[ 'essence_value' ] ) && trim( $entry[ 'essence_value' ] ) != '' ) {
                                            $value = $entry[ 'essence_value' ];
                                        }
                                        if ( trim( $title ) != '' && trim( $value ) != '' ) :
                                            ?>
                                            <p><span><?php echo esc_attr( $title ); ?>
                                                    : </span> <?php echo esc_attr( $value ) ?> </p>
                                        <?php endif; ?>
                                    <?php } ?>
                                    <?php if ( !empty( $porfolio_sharing ) ): ?>
                                        <p>
                                            <span> <?php esc_html_e( 'Share :', 'essence' ); ?></span>
										<span class="west-port-socialshare">

                                            <?php if ( in_array( 'facebook', $porfolio_sharing ) ): ?>

                                                <a class="social-item"
                                                   href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
                                                   target="_blank">
                                                    <i class="fa fa-facebook"></i>
                                                        <span
                                                            class="screen-reader-text"><?php echo sprintf( esc_html__( 'Share "%s" on Facebook', 'essence' ), get_the_title() ); ?></span>
                                                </a>

                                            <?php endif; ?>
                                            <?php if ( in_array( 'twitter', $porfolio_sharing ) ): ?>

                                                <a class="social-item"
                                                   href="https://twitter.com/home?status=<?php the_permalink(); ?>"
                                                   target="_blank">
                                                    <i class="fa fa-twitter"></i>
                                                                    <span
                                                                        class="screen-reader-text"><?php echo sprintf( esc_html__( 'Post status "%s" on Twitter', 'essence' ), get_the_title() ); ?></span>
                                                </a>

                                            <?php endif; ?>
                                            <?php if ( in_array( 'google-plus', $porfolio_sharing ) ): ?>

                                                <a class="social-item"
                                                   href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
                                                   target="_blank">
                                                    <i class="fa fa-google-plus"></i>
                                                                    <span
                                                                        class="screen-reader-text"><?php echo sprintf( esc_html__( 'Share "%s" on Google Plus', 'essence' ), get_the_title() ); ?></span>
                                                </a>

                                            <?php endif; ?>
                                            <?php if ( in_array( 'printerest', $porfolio_sharing ) ): ?>

                                                <a class="social-item"
                                                   href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo esc_url( $img_url ); ?>&amp;description=<?php echo urlencode( get_the_excerpt() ); ?>"
                                                   target="_blank">
                                                    <i class="fa fa-pinterest"></i>
                                                                    <span
                                                                        class="screen-reader-text"><?php echo sprintf( esc_html__( 'Pin "%s" on Pinterest', 'essence' ), get_the_title() ); ?></span>
                                                </a>

                                            <?php endif; ?>
                                            <?php if ( in_array( 'linkedin', $porfolio_sharing ) ): ?>

                                                <a class="social-item"
                                                   href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode( get_the_title() ); ?>&amp;summary=<?php echo urlencode( get_the_excerpt() ); ?>&amp;source=<?php echo urlencode( get_bloginfo( 'name' ) ); ?>"
                                                   target="_blank">
                                                    <i class="fa fa-linkedin"></i>
                                                                    <span
                                                                        class="screen-reader-text"><?php echo sprintf( esc_html__( 'Share "%s" on LinkedIn', 'essence' ), get_the_title() ); ?></span>
                                                </a>

                                            <?php endif; ?>
                                            </span>

                                        </p>
                                    <?php endif; // End if ( !empty( $porfolio_sharing ) ) ?>
                                </div> <!--End .info-->

                                <?php
                                $url_button = get_post_meta( get_the_ID(), 'essence_visited-url', true );
                                $text_button = get_post_meta( get_the_ID(), 'essence_visited-text', true );
                                if ( $url_button != '' ) :
                                    ?>
                                    <a class="essence-button" href="<?php echo esc_url( $url_button ); ?>"
                                       target=" _blank"><?php echo sanitize_text_field( $text_button ) ?>
                                        <span class="icon-elegant arrow_right"></span></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="showcase-page-nav">
                    <?php
                    $prev_post = get_previous_post(); ?>
                    <div class="pull-left">
                        <?php if ( !empty( $prev_post ) ): ?>
                            <a href=" <?php echo get_permalink( $prev_post->ID ); ?> "><i
                                    class="fa fa-angle-left"></i><?php echo esc_html__( 'PREVIOUS PROJECT', 'essence' ) ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="showcase-page-icon text-center">
                        <a href="#">
                            <i class="fa fa-th-large"></i>
                        </a>
                    </div>
                    <div class="pull-right">
                        <?php
                        $next_post = get_next_post();
                        if ( !empty( $next_post ) ) : ?>
                            <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo esc_html__( 'NEXT PROJECT', 'essence' ) ?>
                                <i class="fa fa-angle-right"></i></a>
                        <?php else : ?>
                            <a class="ts-next" href="#">
                                <?php echo esc_html__( 'END PROJECT', 'essence' ) ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div> <!--End .showcase-page-nav-->
            </div>
            <!-- End Single Portfolio -->
        <?php endwhile; ?>
    </main>
</div> <!--End .content-area-->
<?php get_footer(); ?>
