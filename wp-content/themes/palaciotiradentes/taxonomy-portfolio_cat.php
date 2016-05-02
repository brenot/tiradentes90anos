<?php

get_header();

global $post, $term;

$post_id = 0;

$queried_object = get_queried_object();

$term_id = $queried_object->term_id;


$taxonomy_custom_portfolio = get_option( 'taxonomy_' . $term_id );

$taxonomy_custom_portfolio = str_replace( '\\', '', $taxonomy_custom_portfolio );


?>
    <!-- <div class="wolfe-page-title">
        <div class="container">
            <h6 class="wolfe-custom-title"><?php echo sanitize_text_field( $queried_object->name ); ?></h6>

        </div>
    </div> -->
    <div id="full-width-content" class="blog2 work4">

        <div class="container">

            <?php

            if ( trim($taxonomy_custom_portfolio) !='' && $taxonomy_custom_portfolio[ 'custom_term_meta' ] != '' ) {

                echo do_shortcode( $taxonomy_custom_portfolio[ 'custom_term_meta' ] );

            }
            else {

                ?>

                <?php if ( have_posts() ) : ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <div class="essence-portfolio-category">


                            <div class="row">

                                <div class="col-sm-12 col-xs-12 img-feature">

                                    <div class="item-feature">

                                        <?php

                                        $img = get_template_directory_uri() . '/assets/images/noimage/no_image.png';

                                        if ( has_post_thumbnail() ) {

                                            $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full-size' );

                                            if ( isset( $image[ 0 ] ) && !empty( $image[ 0 ] ) ) {
                                                $img = $image[ 0 ];
                                            }

                                        }

                                        ?>

                                        <figure><img src="<?php echo esc_url( $img ); ?>" alt=""/></figure>

                                    </div>

                                </div>


                                <div class="col-sm-12 col-xs-12 feature-content">

                                    <div class="pull-left">

                                        <div class="ts-work4-left">

                                            <h5 class="ts_title"> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>

                                            <span
                                                class="ts_cats"><?php echo get_the_term_list( $post->ID, 'portfolio_cat', '', ', ' ); ?></span>

                                        </div>

                                    </div>

                                    <div class="feature-content-text">
                                        
                                    </div>

                                    <div class="pull-right">

                                        <div class="ts-work4-right">
                                            <a href="<?php the_permalink() ?>" class="read-more ts-button"><?php _e( 'View Project', 'wolfe' ); ?>
                                                <span class="icon-elegant arrow_right"></span>
                                            </a> 

                                        </div>

                                    </div>

                                </div>


                            </div>


                        </div> <!--End .essence-portfolio-category-->

                    <?php endwhile; ?>


                    <div class="navigation">

                        <div class="alignright"><?php next_posts_link( 'Newer posts' ) ?></div>

                        <div class="alignleft"><?php previous_posts_link( 'Older posts' ) ?></div>

                    </div>


                <?php else: ?>

                    <p><?php _e( "Sorry, but you are looking for something that isn't here.", 'wolfe' ); ?></p>

                <?php endif; ?>

            <?php } ?>

        </div>

    </div>

<?php get_footer(); ?>