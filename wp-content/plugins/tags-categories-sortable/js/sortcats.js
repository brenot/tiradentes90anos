jQuery(document).ready(function() {
	

	
	jQuery('.sortable-top .sortable-taxonomy-ul li').click(function(event){
		var rand = jQuery(this).parent().parent().parent().attr('rand'); 
		event.preventDefault(); 
		if(jQuery(this).attr('catid')=='all'){ jQuery(this).parent().find('li').removeClass('sortable-selected'); }
		else { jQuery(this).parent().find('.sortable-tax-all').removeClass('sortable-selected'); }
		if(!jQuery(this).hasClass('sortable-selected'))jQuery(this).addClass('sortable-selected');
		else jQuery(this).removeClass('sortable-selected');
		var sortbytext = jQuery('#sortableTop'+rand+' .sortable-dropdown-toggle span').text(); 
		jQuery('#sortableTop'+rand+' .sortable-dropdown-ul a').each(function(){
			if(jQuery(this).text()==sortbytext){
				jQuery(this).click();
			}
		});
	});
	
	
});

function sortable_get_terms(rand){
	var terms = '';
	jQuery('#sortableTop'+rand+' .sortable-taxonomy-ul').each(function(){
		terms += jQuery(this).attr('tax')+'*';
		jQuery(this).find('li.sortable-selected').each(function(){
			terms += jQuery(this).attr('catid')+',';
		});
		terms += '|';
	});
	
	return terms;
}

function sortable_ajax(rand,sortby,post_type,per_page,paged,sortbytext,sort_social_media){
var terms = sortable_get_terms(rand); 
if(sort_social_media==undefined){ sort_social_media ='facebook,twitter,stumbleupon,googleplus,linkedin,pinterest';}
	jQuery('#sortableContainer'+rand+' .sortable-row').animate({'opacity':'0'},300);
	jQuery('#sortableContainer'+rand+' .sortable-loading').css({'display':'table','opacity':'1'});
	var data = {
		'action': 'sortable2',
		'sortby': sortby,
		'post_type':post_type,
		'per_page':per_page,
		'paged':paged,
		'rand':rand,
		'sort_social_media':sort_social_media,
		'terms':terms,
		'whatever': ajax_object.we_value      // We pass php values differently!
	};
	
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	
	jQuery.post(ajax_object.ajax_url, data, function(response) {
		jQuery("#sortableMenu"+rand+" span").html(sortbytext);
		 jQuery('#sortableContainer'+rand).html(response);
		jQuery('#sortableContainer'+rand).animate({'opacity':'1'},300);
		jQuery('#sortableContainer'+rand+' .sortable-loading').hide().css({'opacity':'0'});
		paginationClick();
	});

}