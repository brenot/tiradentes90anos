<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

$essence = essence_get_global_essence();

?>

<?php if ( trim( $essence[ 'opt_twitter_link' ] ) != '' ): ?>
    <li>
        <a href="<?php echo esc_url( $essence[ 'opt_twitter_link' ] ); ?>">
            <i class="fa fa-twitter"></i>
            <span class="screen-reader-text"><?php esc_html_e( 'Twitter link', 'essence' ); ?></span>
        </a>
    </li>
<?php endif; ?>
<?php if ( trim( $essence[ 'opt_fb_link' ] ) != '' ): ?>
    <li>
        <a href="<?php echo esc_url( $essence[ 'opt_fb_link' ] ); ?>">
            <i class="fa fa-facebook"></i>
            <span class="screen-reader-text"><?php esc_html_e( 'Facebook link', 'essence' ); ?></span>
        </a>
    </li>
<?php endif; ?>
<?php if ( trim( $essence[ 'opt_google_plus_link' ] ) != '' ): ?>
    <li>
        <a href="<?php echo esc_url( $essence[ 'opt_google_plus_link' ] ); ?>">
            <i class="fa fa-google-plus"></i>
            <span class="screen-reader-text"><?php esc_html_e( 'Google Plus link', 'essence' ); ?></span>
        </a>
    </li>
<?php endif; ?>
<?php if ( trim( $essence[ 'opt_dribbble_link' ] ) != '' ): ?>
    <li>
        <a href="<?php echo esc_url( $essence[ 'opt_dribbble_link' ] ); ?>">
            <i class="fa fa-dribbble"></i>
            <span class="screen-reader-text"><?php esc_html_e( 'Dribbble link', 'essence' ); ?></span>
        </a>
    </li>
<?php endif; ?>
<?php if ( trim( $essence[ 'opt_behance_link' ] ) != '' ): ?>
    <li>
        <a href="<?php echo esc_url( $essence[ 'opt_behance_link' ] ); ?>">
            <i class="fa fa-behance"></i>
            <span class="screen-reader-text"><?php esc_html_e( 'Behance link', 'essence' ); ?></span>
        </a>
    </li>
<?php endif; ?>
<?php if ( trim( $essence[ 'opt_tumblr_link' ] ) != '' ): ?>
    <li>
        <a href="<?php echo esc_url( $essence[ 'opt_tumblr_link' ] ); ?>">
            <i class="fa fa-tumblr"></i>
            <span class="screen-reader-text"><?php esc_html_e( 'Tumblr link', 'essence' ); ?></span>
        </a>
    </li>
<?php endif; ?>
<?php if ( trim( $essence[ 'opt_instagram_link' ] ) != '' ): ?>
    <li>
        <a href="<?php echo esc_url( $essence[ 'opt_instagram_link' ] ); ?>">
            <i class="fa fa-instagram"></i>
            <span class="screen-reader-text"><?php esc_html_e( 'Instagram link', 'essence' ); ?></span>
        </a>
    </li>
<?php endif; ?>
<?php if ( trim( $essence[ 'opt_pinterest_link' ] ) != '' ): ?>
    <li>
        <a href="<?php echo esc_url( $essence[ 'opt_pinterest_link' ] ); ?>">
            <i class="fa fa-pinterest"></i>
            <span class="screen-reader-text"><?php esc_html_e( 'Pinterest link', 'essence' ); ?></span>
        </a>
    </li>
<?php endif; ?>
<?php if ( trim( $essence[ 'opt_youtube_link' ] ) != '' ): ?>
    <li>
        <a href="<?php echo esc_url( $essence[ 'opt_youtube_link' ] ); ?>">
            <i class="fa fa-youtube"></i>
            <span class="screen-reader-text"><?php esc_html_e( 'Youtube link', 'essence' ); ?></span>
        </a>
    </li>
<?php endif; ?>
<?php if ( trim( $essence[ 'opt_vimeo_link' ] ) != '' ): ?>
    <li>
        <a href="<?php echo esc_url( $essence[ 'opt_vimeo_link' ] ); ?>">
            <i class="fa fa-vimeo"></i>
            <span class="screen-reader-text"><?php esc_html_e( 'Vimeo link', 'essence' ); ?></span>
        </a>
    </li>
<?php endif; ?>
<?php if ( trim( $essence[ 'opt_linkedin_link' ] ) != '' ): ?>
    <li>
        <a href="<?php echo esc_url( $essence[ 'opt_linkedin_link' ] ); ?>">
            <i class="fa fa-linkedin"></i>
            <span class="screen-reader-text"><?php esc_html_e( 'LinkedIn link', 'essence' ); ?></span>
        </a>
    </li>
<?php endif; ?>
<?php if ( trim( $essence[ 'opt_rss_link' ] ) != '' ): ?>
    <li>
        <a href="<?php echo esc_url( $essence[ 'opt_rss_link' ] ); ?>">
            <i class="fa fa-rss"></i>
            <span class="screen-reader-text"><?php esc_html_e( 'RSS feed', 'essence' ); ?></span>
        </a>
    </li>
<?php endif; ?>