<?php
/** @author MrTieuTien */

$link_video = get_post_meta( $post->ID, 'ts-post_video_embed', true );

?><?php if ( trim( $link_video ) != '' ): ?>
    <div class="essence-portfolio-video">
        <?php echo apply_filters( 'the_content', $link_video ); ?>
    </div>
<?php elseif ( has_post_thumbnail() ) :
    $thumb_src = essence_resize_image( get_post_thumbnail_id(), null, '870', '403', true, true, false );
    ?>
    <div class="essence-portfolio-thumbnail">
        <figure><a href="<?php echo get_permalink(); ?>"><img src="<?php echo esc_url( $thumb_src[ 'url' ] ); ?>"
                                                              alt=""/></a></figure>
    </div>
<?php endif; ?>