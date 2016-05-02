/* jQuery v1.10.2 */
/*= Grid View Switcher */
// @Since 1.0.0
jQuery(document).ready(function(){
	if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
		animate_elements();
	}
	// Changing grids
	jQuery('.spg-loop-actions .spg-view a').on('click', function(e) {
		e.preventDefault();
		var viewType = jQuery(this).attr('data-type'),
			loop = jQuery('.switchable-view'),
			loopView = loop.attr('data-view');
		
		if(viewType == loopView)
			return false;
		
		jQuery(this).addClass('current').siblings('a').removeClass('current');
		loop.stop().fadeOut(100, function(){
			if(loopView)
				loop.removeClass(loopView);
			// if mansory layout
			if(jQuery("#loop-content").hasClass("spg-masonry")){
				spg_masonry();
			}
			jQuery(this).fadeIn().attr('data-view', viewType).addClass(viewType);
		});
		// jQuery('.spg-loop-content .video').remove();
		jQuery('.spg-loop-content .spg-thumb').show();
		
		return false;
	});
	// Change Opacity of overlay on thumb hover
/*	var thumb = jQuery(".spg-thumb");
	thumb.hover(
		function(){
				var opacity = jQuery(this).find(".overlay").data("opacity");
				jQuery(this).find(".overlay").css("opacity",opacity);
			},
		function(){
				jQuery(this).find(".overlay").css("opacity","0");
			}
	);
*/
	jQuery(".spg-custom-sort-opt").each(function(){
		var x = jQuery(this).data('placeholder');
		jQuery(this).select2({
			//placeholder: x,
			//allowClear: true
		});
	});
});
jQuery(window).load(function(){
	jQuery(".spg-loop-actions .spg-view a.current").trigger("click");
});
/* Loading content with ajax*/
// @Since 1.1.0
jQuery(document).ready(function(){
	var container = jQuery('#loop-content');
	var orderby = jQuery(".spg-orderby-select");
	var order = jQuery(".spg-order");
	var paginate = jQuery(".spg-pagination a");
	// Check for load_with_ajax class
	if(container.data('ajaxload')){
		// Load content on orderby
		orderby.bind('change',function(e){
			e.preventDefault();
			var url = jQuery(this).val();
			if(url){
				container.load(url+" #loop-content > *",function(){
					// if mansory layout
					if(jQuery("#loop-content").hasClass("spg-masonry")){
						spg_masonry();
					}
					console.log("data loaded");
				} );
				animate_elements();
				if(url!=window.location.href){
					window.history.pushState({path:url},'',url);
				}
				//stop refreshing to the page given in
				return false;
			}
		});
		// Load content on order
		order.bind('click',function(e){
			e.preventDefault();
			var new_order = jQuery(this).data('order');
			var url = jQuery(this).children('a').attr('href')
			if(url){
				container.load(url+" #loop-content > *",function(){
					// if mansory layout
					if(jQuery("#loop-content").hasClass("spg-masonry")){
						spg_masonry();
					}
					console.log("data loaded");
				});
				order.load(url+" .spg-order > *" );
				animate_elements();
				if(url!=window.location){
					window.history.pushState({path:url},'',url);
				}
				//stop refreshing to the page given in
				return false;
			}
		});
		// Ajaxify content on pagination
		paginate.bind('click',function(e){
			e.preventDefault();
			var url = jQuery(this).attr('href')
			if(url){
				container.load(url+" #loop-content > *",function(){
					// if mansory layout
					if(jQuery("#loop-content").hasClass("spg-masonry")){
						spg_masonry();
					}
					console.log("data loaded");
				});
				jQuery('.spg-pagination').load(url+" .spg-pagination > *" );
				paginate.each(function(){
					jQuery(this).removeClass('current');
				});
				jQuery(this).addClass('current');
				animate_elements();
				if(url!=window.location.href){
					window.history.pushState({path:url},'',url);
				}
				//stop refreshing to the page given in
				return false;
			}
		});
	} else {
		// bind change event to select
		jQuery('.spg-orderby-select').bind('change', function () {
			var url = jQuery(this).val(); // get selected value
			if(url) { // require a URL
				window.location = url; // redirect
			}
			return false;
		});
	}
	
	// Display quick view
	// jQuery(".spg-clip-overview").click(function(e){
	jQuery("body").on("click",".spg-clip-overview",function(e){
		e.preventDefault();
		jQuery(".spg-quick-view-overlay").fadeOut('slow').remove();
		jQuery(".spg-quick-view").fadeOut('slow').remove();
		jQuery("html").removeClass("spg-html-fixed");
		var $this = jQuery(this);
		
		
		var post_id = $this.data('post-id');
		
		var post_id_prev = $this.parents('.spg-item').prev('.spg-item').find(".spg-clip-overview").data("post-id");
		var post_id_next = $this.parents('.spg-item').next('.spg-item').find(".spg-clip-overview").data("post-id");
		//console.log("Prev Post ID - "+post_id_prev);
		//console.log("Next Post ID - "+post_id_next);

		var popup_title = $this.data('title');
		var html = '<div class="spg-quick-view-overlay"></div>';
		var next_post = '';
		var prev_post = '';
		var style = '';
		
		var next_is_ok = typeof post_id_next === 'undefined' ? false : true;
		var prev_is_ok = typeof post_id_prev === 'undefined' ? false : true;
	
		if(post_id_next !== '' && next_is_ok)
			next_post = '<span class="spg-overlay-quick-view-next" data-post-id="'+post_id_next+'"></span>';
		else
			style = 'style="right: 50px;"';
		if(post_id_prev !== '' && prev_is_ok)
			prev_post = '<span class="spg-overlay-quick-view-prev" data-post-id="'+post_id_prev+'" '+style+'></span>';

		html += '<div class="spg-quick-view">';
		html += '<div class="spg-quick-heading"><h3 class="spg-popup-title">'+popup_title+'</h3>'+prev_post+' '+next_post+'<span class="spg-overlay-quick-view-close"></span></div>';
		html += '<div class="spg-quick-view-content"><div class="spg-overlay-quick-view-loader"></div></div>';
		html += '</div>';
		jQuery('body').append(html);
		jQuery("html").addClass("spg-html-fixed");
		var data = {action:'spg_get_data',post_id:post_id};
		jQuery.ajax({
			url:spg_ajax,
			data:data,
			type:"POST",
			success: function(res){
				console.log("Content loaded for post ID - "+post_id);
				jQuery(".spg-quick-view-content").html(res);
			}
		});
	});
	
	// Close the overview
	jQuery("body").on("click",".spg-overlay-quick-view-close, .spg-quick-view-overlay",function(e){
		e.preventDefault();
		//console.clear();
		jQuery(".spg-quick-view-overlay").fadeOut('slow').remove();
		jQuery(".spg-quick-view").fadeOut('slow').remove();
		jQuery("html").removeClass("spg-html-fixed");
	});
	
	// load next post
	jQuery("body").on("click",".spg-overlay-quick-view-next",function(e){
		var post_id = jQuery(this).data('post-id');
		//jQuery(".next-post-"+post_id).trigger("click");
		spg_get_content_ajax(post_id);
	});
	// load previous post
	jQuery("body").on("click",".spg-overlay-quick-view-prev",function(e){
		var post_id = jQuery(this).data('post-id');
		//jQuery(".prev-post-"+post_id).trigger("click");
		spg_get_content_ajax(post_id);
	});
	
});
jQuery(window).scroll(function(){
	animate_elements();
});
jQuery(window).load(function(){
	animate_elements();
});

function animate_elements(){
	jQuery(".spg-item").each(function(index, element) {
		var $this = jQuery(element);
		//console.log($this);
		var animate = $this.data('animate');
		if(animate !== "animate no-animation"){
			if(isAppeared($this)){
				//console.log(animate);
				jQuery($this).addClass(animate);
			}
		}
	});
}

function isAppeared(element){
    var win = jQuery(window);
    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height() - 180;
    var bounds = jQuery(element).offset();
    bounds.right = bounds.left + jQuery(element).outerWidth();
    bounds.bottom = bounds.top + jQuery(element).outerHeight();
    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
};


function spg_get_content_ajax(post_id){
	jQuery(".spg-quick-view-overlay").fadeOut('slow').remove();
	jQuery(".spg-quick-view").fadeOut('slow').remove();
	jQuery("html").removeClass("spg-html-fixed");
	var $this = jQuery('a[data-post-id="'+post_id+'"]');
	var post_id = post_id;

	// var pid = jQuery(".post-id-"+post_id);
	var post_id_prev = $this.parents('.spg-item').prev('.spg-item').find(".spg-clip-overview").data("post-id");
	var post_id_next = $this.parents('.spg-item').next('.spg-item').find(".spg-clip-overview").data("post-id");
	//console.log("New Prev Post ID - "+post_id_prev);
	//console.log("New Next Post ID - "+post_id_next);

	var popup_title = $this.data('title');
	var html = '<div class="spg-quick-view-overlay"></div>';
	var next_post = '';
	var prev_post = '';
	var style = '';
	var next_is_ok = typeof post_id_next === 'undefined' ? false : true;
	var prev_is_ok = typeof post_id_prev === 'undefined' ? false : true;
	//console.log(next_is_ok);
	if(post_id_next !== '' && next_is_ok)
		next_post = '<span class="spg-overlay-quick-view-next" data-post-id="'+post_id_next+'"></span>';
	else
		style = 'style="right: 50px;"';
	if(post_id_prev !== '' && prev_is_ok)
		prev_post = '<span class="spg-overlay-quick-view-prev" data-post-id="'+post_id_prev+'" '+style+'></span>';
	html += '<div class="spg-quick-view">';
	html += '<div class="spg-quick-heading"><h3 class="spg-popup-title">'+popup_title+'</h3>'+prev_post+' '+next_post+'<span class="spg-overlay-quick-view-close"></span></div>';
	html += '<div class="spg-quick-view-content"><div class="spg-overlay-quick-view-loader"></div></div>';
	html += '</div>';
	jQuery('body').append(html);
	jQuery("html").addClass("spg-html-fixed");
	var data = {action:'spg_get_data',post_id:post_id};
	jQuery.ajax({
		url:spg_ajax,
		data:data,
		type:"POST",
		success: function(res){
			console.log("Content loaded for post ID - "+post_id);
			jQuery(".spg-quick-view-content").html(res);
		}
	});
}