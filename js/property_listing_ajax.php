<script>
	/*Save properties in favroit list*/
	/*jQuery('.ajax_saved').click(function(){ //.address */
		function mark_saved(obj){
		jQuery(obj).parent('.star_div').find('.loading_heart').show();
		jQuery(obj).hide();
		var selector = jQuery(obj);
		/* jQuery(this+' .custom_loader').show(); */
		var x;
		var pid = jQuery(obj).attr('data-id');
		var user_id = jQuery(obj).attr('rel');
		//var status = jQuery(obj).attr('value');
		var str = 'action=properties_status_saved_by_user&property_id=' + pid + '&user_id='+user_id; //+'&status='+status
		jQuery.ajax({  
			context: obj,      
			url: "<?php echo home_url();?>/wp-admin/admin-ajax.php",
			type: 'POST',             
			data: str,
			success: function(response) {
				var parent = selector.parent();
				jQuery(parent).append('<i class="ajax_remove fa fa-star common_ajax_icon" aria-hidden="true" data-id='+pid+' rel='+user_id+' onclick="remove_saved(this);"></i>');
				
				jQuery(parent).find('.loading_heart').hide();
				selector.remove();
			}           
		});
/*	});*/
}

	/*Removed Properties in favroit list*/		

	function remove_saved(obj){
		jQuery(obj).parent('.star_div').find('.loading_heart').show();
		jQuery(obj).hide();
		var x;
		var selector = jQuery(obj);
		var pid = jQuery(obj).attr('data-id');
		var user_id = jQuery(obj).attr('rel');
		var str = 'action=properties_status_removed_by_user&property_id=' + pid + '&user_id='+user_id;
		jQuery.ajax({  
			context: obj,      
			url: "<?php echo home_url();?>/wp-admin/admin-ajax.php",
			type: 'POST',             
			data: str,
			success: function(response) {

				var parent = selector.parent();
				jQuery(parent).append('<i class="fa fa-fa-star-o common_ajax_icon" data-id='+pid+' rel='+user_id+' aria-hidden="true" onclick="mark_saved(this);"></i>');
				
				jQuery(parent).find('.loading_heart').hide();
				selector.remove();
			}           
		});

}

</script>