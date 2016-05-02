<?php
/**
 * Template part for displaying header layout.
 * 
 * @package Essence
 */
 
$essence = essence_get_global_essence();

$header_logo = isset( $essence['opt_general_logo'] ) ? $essence['opt_general_logo'] : array( 'url' => get_template_directory_uri() . '/assets/images/logo.png' );

?>

<header id="masthead" class="header site-header header-style-2" >
    <div class="main-header container">
        
        <div class="main-header">
			<?php if ( trim( $header_logo['url'] ) != '' ): ?>
			   <div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_logo['url'] ); ?>" alt="logo" /></a></div>
            <?php endif; ?>
			<div class="header-right">
                
				<nav class="navigation-essence-2">
					<?php wp_nav_menu( 
                    array( 'theme_location' => 'primary', 
                        'container' =>  false,
                        'menu_id' => 'primary-menu',
                        'walker' => new ts_wp_bootstrap_navwalker(),
                        'fallback_cb' => 'ts_wp_bootstrap_navwalker::fallback'
                    ) 
                ); ?>
				</nav>
                
			</div>
		</div>

    </div><!-- /.main-header -->
    
</header><!-- #masthead -->
<header id="site-head" class="site-header">
    <div class="container">
        <div class="site-logo">
            <?php if ( trim( $header_logo['url'] ) != '' ): ?>
               <div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_logo['url'] ); ?>" alt="logo" /></a></div>
            <?php endif; ?>
        </div><!-- .site-branding -->   
        <div class="main-nav">
            <?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?> 
                <?php if ( has_nav_menu( 'primary' ) ) : ?>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-navigation" aria-expanded="false" aria-controls="site-navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <nav id="site-navigation" class="collapse main-navigation">
                        <?php
                            // Primary navigation menu.
                            wp_nav_menu( array(
                                'menu_class'     => 'nav-menu',
                                'menu_id'     => 'navbar',
                                'theme_location' => 'primary',
                            ) );
                        ?>
                    </nav><!-- .main-navigation -->
                <?php endif; ?>

                <?php if ( has_nav_menu( 'social' ) ) : ?>
                    <nav id="social-navigation" class="social-navigation">
                        <?php
                            // Social links navigation menu.
                            wp_nav_menu( array(
                                'theme_location' => 'social',
                                'depth'          => 1,
                                'link_before'    => '<span class="screen-reader-text">',
                                'link_after'     => '</span>',
                            ) );
                        ?>
                    </nav><!-- .social-navigation -->
                <?php endif; ?> 
            <?php endif; ?>
        </div><!-- .main-nav -->    
    </div>      
    
</header><!-- .site-header -->




