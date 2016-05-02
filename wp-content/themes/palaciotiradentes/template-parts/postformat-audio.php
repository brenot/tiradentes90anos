<?php
/** @author MrTieuTien */


$link_audio = get_post_meta( $post->ID, 'ts-post_audio_embed',true );

?>
<?php if( trim( $link_audio) !='' ): ?>
    <div class="west-porfolio-audio">
        <?php echo apply_filters('the_content', $link_audio); ?>
    </div>
<?php elseif ( has_post_thumbnail() ) :
    $thumb_src = essence_resize_image( get_post_thumbnail_id() , null , '870', '403', true, true, false );
    ?>
    <div class="img-post post-thumbnail">
        <figure><a href="<?php echo get_permalink(); ?>"><img src="<?php echo esc_url( $thumb_src['url'] ); ?>" alt="" /></a></figure>
    </div>
<?php endif; ?>