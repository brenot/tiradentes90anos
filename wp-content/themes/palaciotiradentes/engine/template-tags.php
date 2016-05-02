<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Essence
 */

if ( ! function_exists( 'essence_posted_on_latestposts' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function essence_posted_on_latestposts() {
        global $essence;

        $default_blog_metas = array( 'date', 'author', 'comment', 'category', 'tags' );
        $blog_metas = isset( $essence['opt_blog_metas'] ) ? $essence['opt_blog_metas'] : $default_blog_metas;

        if ( !isset( $blog_metas ) ) {
            $blog_metas = $default_blog_metas;
        }

        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <span>' . esc_html__( 'Update', 'essence' ) . '</span> <time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = $time_string = get_the_date();
        $posted_on = sprintf(
            esc_html_x( '%s', 'post date', 'essence' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
            esc_html_x( 'by %s', 'post author', 'essence' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );
        echo '<ul class="essence-meta-latestpost">';
        if( in_array( 'author', $blog_metas ) ) {
            echo '<li class="byline post-by"> ' . $byline . '</li>'; // WPCS: XSS OK.
        }

        if( in_array( 'date', $blog_metas ) ) {
            echo '<li class="posted-on post-date">' . $posted_on . '</li>';
        }
        echo '</ul> <!--End .essence-meta-latestpost-->';

    }
endif; // End if ( ! function_exists( 'essence_posted_on' ) )


if ( ! function_exists( 'essence_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function essence_posted_on() {
        global $essence;
        
        $default_blog_metas = array( 'date', 'author', 'comment', 'category', 'tags' );
        $blog_metas = isset( $essence['opt_blog_metas'] ) ? $essence['opt_blog_metas'] : $default_blog_metas;
        
        if ( !isset( $blog_metas ) ) {
            $blog_metas = $default_blog_metas;
        }
        
    	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <span>' . esc_html__( 'Update', 'essence' ) . '</span> <time class="updated" datetime="%3$s">%4$s</time>';
    	}
    
    	$time_string = get_the_date();
    
    	$posted_on = sprintf(
    		esc_html_x( '%s', 'post date', 'essence' ),
    		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    	);
    
    	$byline = sprintf(
    		esc_html_x( 'by %s', 'post author', 'essence' ),
    		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    	);
        
        if( in_array( 'author', $blog_metas ) ) {
            echo '<li class="byline post-by"> ' . $byline . '</li>'; // WPCS: XSS OK.   
        }
        
        if( in_array( 'date', $blog_metas ) ) {
            echo '<li class="posted-on post-date">' . $posted_on . '</li>';
        }
        
        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) && in_array( 'comment', $blog_metas ) ) {
            echo '<li class="post-comment">';
            echo comments_popup_link( esc_html__( 'Leave a comment', 'essence' ), esc_html__( '1 Comment', 'essence' ), esc_html__( '% Comments', 'essence' ) );
            echo '</li>';
    	}
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ', ', 'essence' ) );
            if ( $categories_list && essence_categorized_blog() && in_array( 'category', $blog_metas ) ) {
                printf( '<li class="cat-links">' . esc_html__( '%1$s', 'essence' ) . '</li>', $categories_list ); // WPCS: XSS OK.
            }
        }
    
    }
endif; // End if ( ! function_exists( 'essence_posted_on' ) )

if ( ! function_exists( 'essence_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function essence_entry_footer() {
        global $essence;
        
        $default_blog_metas = array( 'date', 'author', 'comment', 'category', 'tags' );
        $blog_metas = isset( $essence['opt_blog_metas'] ) ? $essence['opt_blog_metas'] : $default_blog_metas;
        
        if ( !isset( $blog_metas ) ) {
            $blog_metas = $default_blog_metas;
        }
        
        if ( is_sticky() && is_home() && ! is_paged() ) {
    		printf( '<span class="sticky-post">%s</span>', esc_html__( 'Sticky', 'essence' ) );
    	}
        
    	// Hide category and tag text for pages.
    	if ( 'post' === get_post_type() ) {
    		/* translators: used between list items, there is a space after the comma */
    		$tags_list = get_the_tag_list( '', esc_html__( ',', 'essence' ) );
    		if ( $tags_list && in_array( 'tags', $blog_metas ) ) {
    			printf( '<div class="tags-links tagcloud"> <span>'. esc_html__( 'Tags:', 'essence' ).' </span>' . esc_html__( '%1$s', 'essence' ) . '</div>', $tags_list ); // WPCS: XSS OK.
    		}
    	}
    
    }
endif; // End if ( ! function_exists( 'essence_entry_footer' ) ) 

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function essence_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'essence_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'essence_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so essence_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so essence_categorized_blog should return false.
		return false;
	}
}


if ( ! function_exists( 'essence_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since Essence 1.0
 */
function essence_post_thumbnail() {
    global $essence;
    
	if ( post_password_required() || is_attachment() ) {
		return;
	}
    
    $blog_layout_style = isset( $essence['opt_blog_layout_style'] ) ? $essence['opt_blog_layout_style'] : 'default';
    
    // Show place hold thumbnail when the post thumbnail does not exist
    $show_placehold_thumb = isset( $essence['opt_blog_' . esc_attr( $blog_layout_style ) . '_show_place_hold_img'] ) ? $essence['opt_blog_' . esc_attr( $blog_layout_style ) . '_show_place_hold_img'] == 1 : false;
    
    if ( !$show_placehold_thumb && !has_post_thumbnail() ) {
        return;
    }

    if ( $show_placehold_thumb && !is_singular() ):

        $thumb_w = 1140; $thumb_h = 462; // Single always use this size
        if ( $blog_layout_style == 'standard' && !is_singular() ) { // For blog loop standard
            $thumb_w = 712; $thumb_h = 624;
        }                
        if ( $blog_layout_style == 'grid' && !is_singular() ) { // For blog loop grid                         
            $thumb_w = 720; $thumb_h = 540;
        }

        $img = essence_resize_image( get_post_thumbnail_id(), null, $thumb_w, $thumb_h, true, true, false );
        
        ?>
        <a class="post-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" aria-hidden="true">
    		<img width="<?php echo esc_attr( $thumb_w ); ?>" height="<?php echo esc_attr( $thumb_h ); ?>" class="attachment-post-thumbnail wp-post-image" src="<?php echo esc_attr( $img['url'] ) ?>" alt="<?php the_title(); ?>" />
    	</a>
        <?php
        
        return;
    endif; // End if ( $show_placehold_thumb )

	if ( is_singular() ) :
        
        // Collecting single post images for slideshow
        $imgs_url = array();
        if ( has_post_thumbnail() ) {
            $img_featured = essence_resize_image( get_post_thumbnail_id(), null, 1333, 687, true, true, false );
            $imgs_url[] = $img_featured['url']; 
        }
        
        $gallery = (array) get_post_meta( get_the_ID(), '_essence_images_gallery', true );
        
        if ( !empty( $gallery ) ) {
            foreach ( $gallery as $img_id => $img_url ):
                
                $img = essence_resize_image( $img_id, null, 1333, 687, true, true, false );
                if ( !in_array( $img['url'], $imgs_url ) ) {
                    $imgs_url[] = $img['url'];   
                }
                
            endforeach;
            //$imgs = array_merge( $imgs, $gallery );
        }
        
    	?>
        
        <?php if ( !empty( $imgs_url ) ): ?>
            
            <?php if ( count( $imgs_url ) > 1 ): // Show as slideshow ?>
                
                <div class="post-format ts-post-slide">
                    
                    <?php foreach ( $imgs_url as $img_url ): ?>
                        <div class="item-slide"><img src="<?php echo esc_url( $img_url ); ?>" alt=""></div>
                    <?php endforeach; ?>
                    
                </div><!-- /.ts-post-slide -->
                
            <?php else: // Show as thumbnail (has 1 image) ?>
                
                	<div class="post-thumbnail">
                        <img src="<?php echo esc_url( $imgs_url[0] ); ?>" class="attachment-post-thumbnail wp-post-image" alt="<?php echo esc_attr( get_the_title() ); ?>" />
                	</div><!-- .post-thumbnail -->
                
            <?php endif; // End if ( count( $imgs_url ) > 1 ) ?>
            
        <?php endif; // End if ( !empty( $imgs_url ) ) ?>

	<?php else : // Is loop 
        $thumb_w = 1140; $thumb_h = 462; // Single always use this size
        if ( $blog_layout_style == 'standard' && !is_singular() ) { // For blog loop standard
            $thumb_w = 712; $thumb_h = 624;
        }                
        if ( $blog_layout_style == 'grid' && !is_singular() ) { // For blog loop grid                         
            $thumb_w = 720; $thumb_h = 540;
        }

        $img = essence_resize_image( get_post_thumbnail_id(), null, $thumb_w, $thumb_h, true, true, false );
        
        ?>
        <a class="post-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" aria-hidden="true">
            <img width="<?php echo esc_attr( $thumb_w ); ?>" height="<?php echo esc_attr( $thumb_h ); ?>" class="attachment-post-thumbnail wp-post-image" src="<?php echo esc_attr( $img['url'] ) ?>" alt="<?php the_title(); ?>" />
        </a>
        <?php

    ?>

	<?php endif; // End is_singular()
}
endif;

if ( !function_exists( 'essence_single_title' ) ) {
    function essence_single_title( $post_id = 0 ) {
        global $essence;
        
        $post_id = max( 0, intval( $post_id ) );
        $title = '';
        
        if ( $post_id == 0 && is_singular() ) {
            $post_id = get_the_ID();
        }
        
        if ( $post_id > 0 ) {
            
            $show_single_title_section_setting = get_post_meta( $post_id, '_essence_single_header_title_section', true );
            $use_custom_title = get_post_meta( $post_id, '_essence_use_custom_title', true ) == 'yes';
            
            // if is single post, check options title type 
            if ( get_post_type( $post_id ) == 'post' ) {
                // check using single post title or blgo title for header title section
                $title_type = isset( $essence['opt_single_post_title_type'] ) ? trim( $essence['opt_single_post_title_type'] ) : 'single'; // single, blog
                if ( $title_type == 'blog' ) {
                    // if using global setting or show title but not use custom title
                    if ( $show_single_title_section_setting == 'global' || $show_single_title_section_setting == 'show' && !$use_custom_title ) {
                        $post_id = get_option( 'page_for_posts' );
                        $use_custom_title = get_post_meta( $post_id, '_essence_use_custom_title', true ) == 'yes';
                    }
                    
                }
            }
            
            $title = get_the_title( $post_id );
            
            if ( $use_custom_title ) {
                $title = get_post_meta( $post_id, '_essence_custom_header_title', true );
            } 
            else{
                
            }
            
        }
        
        return $title;
        
    }
}

if ( !function_exists( 'essence_single_header_bg_style' ) ) {
    function essence_single_header_bg_style( $post_id = 0 ) {
        global $essence;
        $post_id = max( 0, intval( $post_id ) );
        $top_banner_style = '';
        
        if ( $post_id == 0 && is_singular() ) {
            $post_id = get_the_ID();
        }
        
        $header_img = array(
            'url' => get_template_directory_uri() . '/assets/images/pattern1.png'
        );
        $header_img_repeat = 'repeat';
        
        if ( $post_id > 0 ) {
            $header_bg_type = get_post_meta( $post_id, '_essence_header_bg_type', true );
            if ( trim( $header_bg_type ) == '' ) {
                $header_bg_type = 'global';
            }
            
            switch ( $header_bg_type ){
                case 'global':
                    $header_img = isset( $essence['opt_header_img'] ) ? $essence['opt_header_img'] : $header_img;
                    $header_img_repeat =  isset( $essence['opt_header_img_repeat'] ) ? $essence['opt_header_img_repeat'] : $header_img_repeat;
                    break;
                case 'image':
                    $header_img['url'] = trim( get_post_meta( $post_id, '_essence_header_bg_src', true ) ) != '' ? esc_url( get_post_meta( $post_id, '_essence_header_bg_src', true ) ) : $header_img['url'];
                    $header_img_repeat = trim( get_post_meta( $post_id, '_essence_header_bg_repeat', true ) ) != '' ? trim( get_post_meta( $post_id, '_essence_header_bg_repeat', true ) ) : $header_img_repeat;
                    break;
                case 'no_image':
                    $header_img['url'] = '';
                    break;
            }
        }
        
        if ( trim( $header_img['url'] ) != '' ) {
            if ( $header_img_repeat == 'no-repeat' ) {
                $top_banner_style = 'style="background: url(' . esc_url( $header_img['url'] ) . ') ' . esc_attr( $header_img_repeat ) . ' center center; background-size: cover !important;"';   
            }
            else{
                $top_banner_style = 'style="background: url(' . esc_url( $header_img['url'] ) . ') ' . esc_attr( $header_img_repeat ) . ' center center;"';
            }
        }
        
        return $top_banner_style;
        
    }
}

if ( !function_exists( 'essence_single_title_align' ) ) {
    function essence_single_title_align( $post_id = 0 ) {
        global $essence;
        
        $header_title_text_align =  isset( $essence['opt_header_title_text_align'] ) ? $essence['opt_header_title_text_align'] : 'left';
        
        $post_id = max( 0, intval( $post_id ) );
        
        if ( $post_id == 0 && is_singular() ) {
            $post_id = get_the_ID();
        }
        
        if ( $post_id > 0 ) {
            
            $post_title_align = get_post_meta( $post_id, '_essence_header_title_text_align', true );
            
            if ( $post_title_align != 'global' ) {
                $header_title_text_align = $post_title_align;
            }
            
        }
        
        return $header_title_text_align;
        
    }
}

if ( !function_exists( 'essence_theme_comment' ) ) {
    
    function essence_theme_comment($comment, $args, $depth) {
    	$GLOBALS['comment'] = $comment;
    	extract($args, EXTR_SKIP);
    
    	if ( 'div' == $args['style'] ) {
    		$tag = 'div';
    		$add_below = 'comment';
    	} else {
    		$tag = 'li';
    		$add_below = 'div-comment';
    	}
    ?>
    	<<?php echo esc_attr( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    	<?php if ( 'div' != $args['style'] ) : ?>
    	<div id="div-comment-<?php comment_ID() ?>" class="comment-item">
    	<?php endif; ?>
    	<div class="comment-author vcard">
    	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    	<?php //printf( esc_html__( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
    	</div>
        <div class="comment-body">
            <h5 class="author"><?php echo get_comment_author(); ?></h5>
            <?php if ( $comment->comment_approved == '0' ) : ?>
        		<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'essence' ); ?></em>
        		<br />
        	<?php endif; ?>
            
            <div class="date-reply-comment">
                <?php comment_reply_link( 
                    array_merge( $args, 
                            array( 
                                'add_below' => $add_below, 
                                'depth' => $depth, 
                                'max_depth' => $args['max_depth']
                            )
                        ) 
                    ); ?>
            </div><!-- /.date-reply-comment -->
            
            <div class="comment-content">
                <?php comment_text(); ?>
                <span class="date-comment"><?php echo get_comment_date(); ?></span>
            </div><!-- /.comment-content -->
            
        </div><!-- /.comment-body -->
    	
    	<?php if ( 'div' != $args['style'] ) : ?>
    	</div>
    	<?php endif; ?>
    <?php
    }
    
}

if ( !function_exists( 'essence_the_posts_navigation' ) ) {
    
    /**
     * Display navigation to next/previous set of posts when applicable (Except blog layout style masonry)
     *
     * @since 1.0
     *
     * @param array $args Optional. See {@see get_the_posts_navigation()} for available
     *                    arguments. Default empty array.
     */
    function essence_the_posts_navigation( $args = array() ) {
        global $essence;
        
        $blog_layout_style = isset( $essence['opt_blog_layout_style'] ) ? $essence['opt_blog_layout_style'] : 'standard';
        $sidebar_pos = isset( $essence['opt_blog_sidebar_pos'] ) ? trim( $essence['opt_blog_sidebar_pos'] ) : 'right';        
        
        // Don't show navigation on masonry blog layout style
        if ( $blog_layout_style == 'masonry' ) {
            
            // Masonry load more text 
            $load_more_text = isset( $essence['opt_blog_masonry_loadmore_text'] ) ? $essence['opt_blog_masonry_loadmore_text'] : esc_html__( 'Load more', 'essence' );
            ?>
            <?php if ( trim( $load_more_text ) != '' ): ?>
                <div class="masonry-loadmore-wrap">
                    <a href="#" data-sidebar-pos="<?php echo esc_attr( $sidebar_pos ); ?>" class="button btn blog-masonry-loadmore-btn"><?php echo sanitize_text_field( $load_more_text ); ?></a>
                </div>
            <?php endif; // End if ( trim( $load_more_text ) != '' ) ?>
            <?php
        }
        else{
            $args =  array(
                'mid_size' => 2,
                'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'textdomain' ),
                'next_text' => __( '<i class="fa fa-angle-right"></i>', 'textdomain' ),
                );
            the_posts_pagination( $args );
        }   
    }
    
}

if ( !function_exists( 'essence_modify_read_more_link' ) ) {
    function essence_modify_read_more_link() {
        global $essence;
            $read_more_text = isset( $essence['opt_blog_continue_reading'] ) ? sanitize_text_field( $essence['opt_blog_continue_reading'] ) : esc_html__( 'Read more', 'essence' );        
        return '<a class="read-more ts-button" href="' . get_permalink() . '">' . $read_more_text . '<span class="screen-reader-text">' . get_the_title() . '</span><span class="icon-elegant arrow_right"></span> </a>';
    }
    add_filter( 'the_content_more_link', 'essence_modify_read_more_link' );
}

if ( !function_exists( 'essence_before_loop_posts_wrap' ) ) {
    
    function essence_before_loop_posts_wrap() {
        global $essence;
        
        $blog_layout_style = isset( $essence['opt_blog_layout_style'] ) ? $essence['opt_blog_layout_style'] : 'standard';
        
        echo '<div class="posts-wrap posts-' . esc_attr( $blog_layout_style ) . '">';
        
    }
    add_action( 'essence_before_loop_posts', 'essence_before_loop_posts_wrap', 10 );
}

if ( !function_exists( 'essence_after_loop_posts_wrap' ) ) {
    
    function essence_after_loop_posts_wrap() {
        global $essence;
        
        $blog_layout_style = isset( $essence['opt_blog_layout_style'] ) ? $essence['opt_blog_layout_style'] : 'standard';
        
        echo '</div><!-- /.posts-wrap .posts-' . esc_attr( $blog_layout_style ) . ' -->';
        
    }
    add_action( 'essence_after_loop_posts', 'essence_after_loop_posts_wrap', 10 );
}


/**
 * Flush out the transients used in essence_categorized_blog.
 */
function essence_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'essence_categories' );
}
add_action( 'edit_category', 'essence_category_transient_flusher' );
add_action( 'save_post',     'essence_category_transient_flusher' );
