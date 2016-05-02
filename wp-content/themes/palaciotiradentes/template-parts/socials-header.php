<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

$essence = essence_get_global_essence();

if ( trim(
        $essence[ 'opt_twitter_link' ] . $essence[ 'opt_fb_link' ] . $essence[ 'opt_google_plus_link' ] . $essence[ 'opt_dribbble_link' ] .
        $essence[ 'opt_behance_link' ] . $essence[ 'opt_tumblr_link' ] . $essence[ 'opt_instagram_link' ] . $essence[ 'opt_pinterest_link' ] .
        $essence[ 'opt_youtube_link' ] . $essence[ 'opt_vimeo_link' ] . $essence[ 'opt_linkedin_link' ] . $essence[ 'opt_rss_link' ]
    ) != ''
):
    ?>
    <ul class="social-header">
        <?php get_template_part( 'template-parts/social', 'items' ); ?>
    </ul><!-- /.social-header -->
    <?php
endif;
