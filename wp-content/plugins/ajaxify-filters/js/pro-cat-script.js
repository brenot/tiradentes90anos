
//code for saving fiters in Save Active filter plugin
jQuery(document.body).on('click', '#ced_caf_save_active_filters' ,function(){
	
	var currentURL = window.location.href;
	
	jQuery.ajax({
		url : pro_cat_script_ajax.ajax_url,
		type : 'post',
		data : {
					action : 'setCookieForSavingFilters',
					currentURL : currentURL
				},
		success : function( data ) 
		{
			data = JSON.parse(data);
			var changesMade = data.changesMade;
			
			data = JSON.parse(data.cookieArray);
			
			var count = 0;
			jQuery('span.ced_caf_saced_filter_div').html('');
			for (var key in data)
			{
				count++;
				jQuery('span.ced_caf_saced_filter_div').append('<a href="'+data[key]+'" >Saved Filter-'+(count)+'</a><br/>');
			}
			
			if(changesMade == "true_new")
			{
				alert("Your curent combination of filters has been saved successfully.");
			}
			else if(changesMade == "true_replace")
			{
				alert("Your curent combination of filters has been saved successfully. Your oldest combination of filters has been removed as you are only allowed to save 5.");
			}
			else
			{
				alert("This combination of filters is already saved. Try another one.");
			}	
			
		}
	});
	
});

/*
 * script for clicking on cancel button also
 */
jQuery(document.body).on('click','li.my_chosen',function(e){
	var hrefToBeUsed = jQuery(this).find("a").first().attr('href');
	e.preventDefault();//preventing the anchor tag to open the link
	window.history.pushState('','',hrefToBeUsed);//pushing the href to browser history
	ajaxifyShop(hrefToBeUsed);
	window.scrollTo(0, 0);
});



/*
 * script for fetching product text blink
 */
(function blink() { 
    jQuery('.blink_me').fadeOut(500).fadeIn(500, blink); 
})();



/*
 * script to work with orderby without page-load
 */
jQuery('select.orderby').addClass('orderbydev');
jQuery('select.orderby').removeClass('orderby');

jQuery(document.body).on('change', '.woocommerce-ordering select.orderbydev' ,function(e){
	/*
	 * code for creating the new URL using the existing one and current price filter choosen
	 */
	var currentURL = window.location.href;
	var URLparts = currentURL.split("?");
	var baseURL = URLparts[0];
	var restURL = URLparts[1];
	
	
	var newURL = baseURL+"?";
	if(jQuery.type(restURL) == 'undefined')
	{
		newURL += 'orderby='+this.value;
	}
	else if(jQuery.type(restURL) != 'undefined')
	{
		newURL += 'orderby='+this.value;
		
		var getArray = restURL.split('&');
		
		var count = 0;
		for(count=0;count<getArray.length;count++)
		{
			var test1 = "orderby".localeCompare(getArray[count].split('=')[0]);
			
			if(test1 === 0)
			{
			}
			else
			{
				newURL += '&'+getArray[count];
			}	

		}	
	}
	/*
	 * URL making code ends here
	 */
	
	window.history.pushState('','',newURL);
	ajaxifyShop(newURL);
	window.scrollTo(0, 0);
	
});



//using same class and script for category filter widget
//using same class and script for active filter widget
// script for handling the click on anchor-tags of attribte filters
jQuery(document.body).on('click', 'a.ccas_ajax_attribute_filter_anchor_class' ,function(e){
	e.preventDefault();//preventing the anchor tag to open the link
	window.history.pushState('','',jQuery(this).attr('href'));//pushing the href to browser history
	ajaxifyShop(jQuery(this).attr('href'));
	window.scrollTo(0, 0);
});


// script for handling the click on woocommerce-pagination 
jQuery(document.body).on('click', 'nav.woocommerce-pagination li a' ,function(e){
	e.preventDefault();//preventing the anchor tag to open the link
	window.history.pushState('','',jQuery(this).attr('href'));//pushing the href to browser history
	ajaxifyShop(jQuery(this).attr('href'));
	window.scrollTo(0, 0);
});


//on browsers back button press
jQuery(document).ready(function(jQuery) {
	
	if (window.history && window.history.pushState) 
	{
		jQuery(window).on('popstate', function() {
			ajaxifyShop(window.location.href);
			window.scrollTo(0, 0);
		});
	}

});

// code jquery function to fetch and replace products
function ajaxifyShop(sourceURL)
{
	jQuery('div.ccas_ajax_shop_loading_div').show();
	
	jQuery.ajax({
		url : sourceURL,
		type : 'get',
		success : function( data ) 
		{	
			
			//showing changed product content
			var pageContent = jQuery('ul.products',jQuery(data)).html();
			jQuery('ul.products').html(pageContent);
			
			
			//changing product count text
			var proCountText = jQuery('p.woocommerce-result-count',jQuery(data)).html();
			if(jQuery.type(proCountText) != 'undefined')
			{
				jQuery('p.woocommerce-result-count').show();
				jQuery('p.woocommerce-result-count').html(proCountText);
			}
			else
			{
				jQuery('p.woocommerce-result-count').hide();
			}

			//changing breadcrum
			var breadcrum = jQuery('nav.woocommerce-breadcrumb',jQuery(data)).html();
			if(jQuery.type(breadcrum) != 'undefined')
			{
				jQuery('nav.woocommerce-breadcrumb').show();
				jQuery('nav.woocommerce-breadcrumb').html(breadcrum);
			}
			else
			{
				jQuery('nav.woocommerce-breadcrumb').hide();
			}
			
			//changing pagination

			var pagination = jQuery('nav.woocommerce-pagination',jQuery(data)).html();
			if(jQuery.type(pagination) != 'undefined')
			{
				jQuery('nav.woocommerce-pagination').show();
				jQuery('nav.woocommerce-pagination').html(pagination);
			}
			else
			{
				jQuery('nav.woocommerce-pagination').hide();
			}

			/*
			 * code for showing filters in sidebars::product attribute filters (1)
			 */
			var filterContentArray=[];
			var filterIdsArray=[];
			jQuery('.ccas_ajax_layered_nav_widget_id',jQuery(data)).each(function () {
				filterContentArray.push(jQuery(this).html());
				filterIdsArray.push(jQuery(this).attr('id'));
			});

			var counter=0;
			jQuery('.ccas_ajax_layered_nav_widget_id').each(function () {
				
				if( jQuery(this).attr('id') == filterIdsArray[counter] )
				{
					jQuery(this).html(filterContentArray[counter]);
					jQuery(this).show();
					counter++;
				}
				else
				{
					jQuery(this).hide();
				}	
				
			});

			/*
			 * code for price filter (2)
			 */
			var priceFilterHTML = jQuery('.ccas_ajax_price_filter_widget',jQuery(data)).html();
			
			if(jQuery.type(priceFilterHTML) != 'undefined')
			{

				
      	jQuery( function( jQuery ) {
      		
      		var currenySymbol = jQuery('#ccas_ajax_hidden_currency_symbol',jQuery(data)).text();
      		var minPrice = parseInt(jQuery('#ccas_ajax_hidden_min_price',jQuery(data)).text());
      		var maxPrice = parseInt(jQuery('#ccas_ajax_hidden_max_price',jQuery(data)).text());
      		var minPriceRange = parseInt(jQuery('#ccas_ajax_hidden_min_price_range',jQuery(data)).text());
      		var maxPriceRange = parseInt(jQuery('#ccas_ajax_hidden_max_price_range',jQuery(data)).text());
      		
      		jQuery( "#sliderOfPriceWidget" ).slider({
      			range:true,
      			min: minPrice,
      			max: maxPrice,
      			values: [ minPriceRange, maxPriceRange ],
      			slide: function( event, ui ) {
      				jQuery( "#price" ).val( currenySymbol + ui.values[ 0 ] + " - " + currenySymbol + ui.values[ 1 ] );
      			},
      			stop: function( event, ui ) {
      				
      				/*
      				 * code for creating the new URL using the existing one and current price filter choosen
      				 */
      				var currentURL = window.location.href;
      				var URLparts = currentURL.split("?");
      				var baseURL = URLparts[0];
      				var restURL = URLparts[1];
      				
      				var newURL = baseURL+"?";
      				newURL += 'min_price='+ui.values[ 0 ]+'&max_price='+ui.values[ 1 ];
      				
      				if(jQuery.type(restURL) != 'undefined')
      				{
      					var getArray = restURL.split('&');
      					
      					var count = 0;
      					for(count=0;count<getArray.length;count++)
      					{
      						var test1 = "min_price".localeCompare(getArray[count].split('=')[0]);
      						var test2 = "max_price".localeCompare(getArray[count].split('=')[0]);
      		
      						if(test1 === 0 || test2 === 0)
      						{
      						}
      						else
      						{
      							newURL += '&'+getArray[count];
      						}	

      					}	
      				}
      				/*
      				 * URL making code ends here
      				 */
      				
      				// pushing the new URL to nrowser history and calling core ajax function
      				window.history.pushState('','',newURL);
      				ajaxifyShop(newURL);

      			},
      		});
      		
      		jQuery( "#price" ).val( currenySymbol + jQuery( "#sliderOfPriceWidget" ).slider( "values", 0 ) +
      				" - " + currenySymbol + jQuery( "#sliderOfPriceWidget" ).slider( "values", 1 ) );
      		
      	});

				
				jQuery('.ccas_ajax_price_filter_widget').show();
			}
			else
			{
				jQuery('.ccas_ajax_price_filter_widget').hide();
			}	
			
			/*
			 * code for active filters (3)
			 */
			var activeFilterHTML = jQuery('.ccas_ajax_active_filters',jQuery(data)).html();
			
			if( jQuery('.ccas_ajax_active_filters ul',jQuery(data)).length < 1 )
			{
				jQuery('.ccas_ajax_active_filters').hide();
			}
			else
			{
				jQuery('.ccas_ajax_active_filters').html(activeFilterHTML);
				jQuery('.ccas_ajax_active_filters').show();
			}	
		
			
			/*
			 * code for category filter (4)
			 */
			var categoryFilterHTML = jQuery('.ccas_ajax_category_filter',jQuery(data)).html();
			
			if(jQuery.type(categoryFilterHTML) != 'undefined')
			{
				jQuery('.ccas_ajax_category_filter').html(categoryFilterHTML);
				jQuery('.ccas_ajax_category_filter').show();
			}
			else
			{
				jQuery('.ccas_ajax_category_filter').hide();
			}

			/*
			* code for type-n-search (5) :: no replacement needed
			*/

			/*
			 * code for tag filter (6)
			 */
			var tagFilterHTML = jQuery('.widget_product_tag_cloud',jQuery(data)).html();
			if(jQuery.type(tagFilterHTML) != 'undefined')
			{
				jQuery('.widget_product_tag_cloud').html(tagFilterHTML);
				jQuery('.widget_product_tag_cloud').show();
			}
			else
			{
				jQuery('.widget_product_tag_cloud').hide();
			}


			jQuery('div.ccas_ajax_shop_loading_div').hide();
			
		
		}
		
	});
}


/*
 * hiding the activeFilter section if there is nothing to show on page load/ or for first time
 */
if( jQuery('.ccas_ajax_active_filters ul').length < 1 )
{
	jQuery('.ccas_ajax_active_filters').hide();
}

