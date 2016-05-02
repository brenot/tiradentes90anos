<?php

/**
 * @author MrTieuTien
 * @copyright 2015
 */
?><?php
global $post;
$essence_post_img_url = '';
$essence_post_img_url = get_post_meta( $post->ID, 'ts-post_image', true );

if ( $essence_post_img_url == '' ) {
    if ( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) ) {
        $essence_post_img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
    }
}

?><?php if ( $essence_post_img_url != '' ): ?><?php
    $img_src = essence_resize_image( null, $essence_post_img_url, '870', '403', true, true, false );
    ?>
    <div class="owl-portfolio-singer">
        <div class="image"><img src="<?php echo esc_url( $img_src['url'] ) ?>" alt="<?php the_title(); ?>"></div>
    </div>
<?php endif;