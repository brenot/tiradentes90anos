
jQuery(document.body).on('click','div.ccas_colorPicker_div',function(e){
	
	var currentDivId = jQuery(this).attr("id");
	
	var currentInputId = jQuery(this).parent().prev().find('input').attr("id");

	jQuery('#'+currentDivId).ColorPicker({
	  		onChange: function(hsb, hex, rgb){
		  		jQuery("#"+currentInputId).val('#' + hex);
		  		jQuery('#'+currentDivId).css('backgroundColor', '#' + hex);
		  		
	 		 },
	 		onSubmit: function(hsb, hex, rgb, el) {
	 			jQuery(el).val(hex);
	 			jQuery(el).ColorPickerHide();
	 		},
		});

	jQuery( this ).trigger( "click" );

});