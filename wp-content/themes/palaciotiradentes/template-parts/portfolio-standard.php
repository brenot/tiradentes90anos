<?php

/**
 * @author MrTieuTien
 * @copyright 2015
 */
?><?php

$portfolio_img = '';
    if ( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) ) {
        $portfolio_img_src = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
        $portfolio_img =  essence_resize_image(null, $portfolio_img_src, 1170,700,true, true, false );
    }
?><?php if ( $portfolio_img != '' ): ?>
    <div class="owl-portfolio-singer">
        <div class="image"><img width="<?php echo esc_attr($portfolio_img['width'])?>" height="<?php echo esc_attr($portfolio_img['height'])?>" src="<?php echo esc_url( $portfolio_img['url'] ) ?>" alt="<?php the_title(); ?>"></div>
    </div>
<?php endif;