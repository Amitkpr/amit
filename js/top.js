jQuery(window).load(function() {
jQuery(".se-pre-con").fadeOut("slow");
});
jQuery('.right_panel_1 .calculate_btn').click(function(){
	var amount = jQuery(this).attr('data');
	/* alert(amount); */
	jQuery('#loginformpopup #purchasePrice').val(amount);
});
