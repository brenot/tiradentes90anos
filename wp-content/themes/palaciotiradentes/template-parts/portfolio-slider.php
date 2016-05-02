<?php
/**
 * @author MrTieuTien
 * @copyright 2015
 */
?><?php
global $post;
$attachments = get_post_meta( get_the_ID(), 'essence_portfolio_slider', 1 );

?><?php if ( !empty( $attachments ) ) : ?>
    <div class="ts-images-slider-wrap">
        <div id="portfolio-slider" class="ts-slider-img ts-portfolio-slide essence-owl-carousel owl-carousel" data-number="1" data-Dots="no" data-navcontrol="yes" data-autoheight="yes" >
            <!--Portfolio Slide Item-->
            <?php foreach ( $attachments as $attachment ) { ?><?php
                $attachments_thumbs = essence_resize_image( null, $attachment, 1170, 700, true, true, false );
                ?>
                <div class="img-item">
                    <figure>
                        <img src="<?php echo esc_url( $attachments_thumbs[ 'url' ] ); ?>" alt="<?php the_title() ?>">
                    </figure>
                </div>
            <?php } ?>
            <!--End Portfolio Slide Item-->

        </div>
    </div>
<?php endif; ?>