/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	$(document).ready(function(){
        "use strict";

        $('.img-item').each(function(){            
            
               $(this).owlCarousel({
                    items: 1,
                    loop:true,
                    nav: false,
                    dots:false,
                    margin: 0,
                    center: false,
                    autoplay:true,
                    lazyLoad:true,
                    lazyContent:true,
                    autoHeight: false,
                    navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
                    responsiveClass: true,
                    responsive:{
                        0:{
                            items:1
                        },
                        480:{
                            items:1
                        },
                        768:{
                            items:1
                        },
                        992:{
                            items:1
                        },
                        1199:{
                            items:1
                        }
                    }
                })

        });
} )( jQuery );
