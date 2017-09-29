jQuery(document).ready(function(){

	

	/*condition to user crollbar on desktop only*/

	var wWidth = jQuery(window).width();

	if(wWidth < 768){

		jQuery('.right_panel_1').removeClass('mCustomScrollbar');

	}else{

		jQuery(".right_panel_1").mCustomScrollbar({

		  mouseWheelPixels: 300 //change this to a value, that fits your needs

		});	

	}

	

	/*add height to listing as per window height*/

	var newh = jQuery(window).height();

	jQuery('.right_panel_2').css('height','100%');	



	/*click on Sort icons for accendin and desending*/

	jQuery('.sortingc').click(function(){

		jQuery('#sorting').toggleClass('active');

	});

	

	jQuery(document).click(function(e){

	  var container = jQuery(".sortingc");    // if the target of the click isn't the container nor a descendant of the container

	  if (!container.is(e.target) && container.has(e.target).length === 0)

	  {

		 jQuery('#sorting').removeClass('active');

	  }

	});

	jQuery('.sortbyascwrapper').click(function(){

		jQuery('.sortingc').addClass('acs');

		jQuery('.sortingc').removeClass('desc');

	});



	jQuery('.sortbydeswrapper').click(function(){

		jQuery('.sortingc').addClass('desc');

		jQuery('.sortingc').removeClass('acs');

	});

	

	/*sticky header for listing*/

	var windowWidthv = jQuery(window).width();

		if(windowWidthv > 768){

			jQuery(".stickyWrap").css("position","fixed");

			jQuery(window).scroll(function(){

				var scroll_top =  jQuery(this).scrollTop(); // get scroll position top

				var height_element_parent =  jQuery(".stickyWrap").parent().outerHeight(); //get high parent element

				var height_element = jQuery(".stickyWrap").height(); //get high of elemeneto

				var position_fixed_max = height_element_parent - height_element; // get the maximum position of the elemen

				var position_fixed = scroll_top < 80 ? 80 - scroll_top : position_fixed_max > scroll_top ? 0 : position_fixed_max - scroll_top ;

				jQuery(".stickyWrap").css("top",position_fixed);

			});

		}

	jQuery(".new_style_property .borderwrap:nth-child(even)").css("background-color", "#f3f3f3");  

	var heightElement = jQuery(".stickyWrap").height();

	jQuery('.newFilters').css('top',heightElement);

	

	jQuery('#showingCountnow').html(' ');

	var count = jQuery("#propertyListingTbl tbody tr" ).size();

	jQuery('#showingCountnow').html(count);	

	

	

	setTimeout(function(){ 

		var windowWidth = jQuery(window).width();

		/*if(windowWidth > 768){

			var w = jQuery('.main_container_search .right_panel_1').width();

			jQuery('.stickyWrap').css('width',w);	

			jQuery('#propertyListingTbl').css('width',w);	

			var h = jQuery(window).height();

			jQuery('.map_img').css('height',h);

			jQuery('.leftsecn').css('height',h);

			jQuery('.map_img').css('overflow','hidden');	

		}	*/	

	}, 2000);

	

	var saved = jQuery('.right_panel_1 .savedToggle');

	var unsaved = jQuery('.right_panel_1 .regularToggle');

	jQuery(saved).click(function(){

		jQuery(this).addClass('border_bottom');

		jQuery(unsaved).removeClass('border_bottom');

		jQuery('.right_panel_1 .tdWrap.saved').show();

		jQuery('.right_panel_1 .tdWrap.unsaved').hide();

	});

	jQuery(unsaved).click(function(){

		jQuery(this).addClass('border_bottom');

		jQuery(saved).removeClass('border_bottom');

		jQuery('.right_panel_1 .tdWrap.saved').hide();

		jQuery('.right_panel_1 .tdWrap.unsaved').show();

	});

	

	

	/*listing owl carousel*/

	var owl = jQuery(".owl-carousel");

	owl.on('changed.owl.carousel',function(property){

		var current = property.item.index;

		var src = jQuery(property.target).find(".owl-item").eq(current).find("img").attr('src');

		var count = jQuery(property.target).find(".owl-item").eq(current).find('.sliderContainer').attr('rel'); 

		var changeCount = jQuery(property.target).find(".owl-item").eq(current).find('.sliderContainer').attr('data'); 

		jQuery('.my_count_'+changeCount).html(count);

	});	

	

	/*table record*/

	var table = jQuery('#propertyListingTbl').DataTable({

		"pagingType": "full_numbers",

		"lengthMenu": [[6, 12, 25, -1], [4, 16, 32,"All"]],

		'iDisplayLength': 10,

		language: {

			searchPlaceholder: "Search Records By Purchase Price, Sqft."

		}												

	});

	

	/*filters starts here*/

	jQuery.fn.dataTable.ext.search.push(

		function( settings, data, dataIndex ) {

			var min = parseInt( jQuery('#min').val(), 10 );

			var max = parseInt( jQuery('#max').val(), 10 );

			var Price = parseFloat( data[0] ) || 0; // use data for the age column

			/* alert(Price); */



			if ( ( isNaN( min ) && isNaN( max ) ) ||

				( isNaN( min ) && Price <= max ) ||

				( min <= Price   && isNaN( max ) ) ||

				( min <= Price   && Price <= max ) )

			{

				return true;

			}								

			return false;

		}

	);	

	jQuery.fn.dataTable.ext.search.push(

		function( settings, data, dataIndex ) {

			var min = parseInt( jQuery('#Bedsmin').val(), 10 );

			var max = parseInt( jQuery('#Bedsmax').val(), 10 );

			var Beds = parseFloat( data[1] ) || 0; // use data for the age column

			

			if ( ( isNaN( min ) && isNaN( max ) ) ||

				( isNaN( min ) && Beds <= max ) ||

				( min <= Beds   && isNaN( max ) ) ||

				( min <= Beds   && Beds <= max ) )

			{

				return true;

			}								

			return false;

		} 

	);	

	jQuery.fn.dataTable.ext.search.push(

		function( settings, data, dataIndex ) {

			var min = parseInt( jQuery('#Bathsmin').val(), 10 );

			var max = parseInt( jQuery('#Bathsmax').val(), 10 );

			var Baths = parseFloat( data[2] ) || 0; // use data for the age column

			

			if ( ( isNaN( min ) && isNaN( max ) ) ||

				( isNaN( min ) && Baths <= max ) ||

				( min <= Baths   && isNaN( max ) ) ||

				( min <= Baths   && Baths <= max ) )

			{

				return true;

			}								

			return false;

		} 

	);	

	jQuery.fn.dataTable.ext.search.push(

		function( settings, data, dataIndex ) {

			var min = parseInt( jQuery('#SquarefeetMin').val(), 10 );

			var max = parseInt( jQuery('#SquarefeetMax').val(), 10 );

			var Squarefeet = parseFloat( data[8] ) || 0; // use data for the age column

			

			if ( ( isNaN( min ) && isNaN( max ) ) ||

				( isNaN( min ) && Squarefeet <= max ) ||

				( min <= Squarefeet   && isNaN( max ) ) ||

				( min <= Squarefeet   && Squarefeet <= max ) )

			{

				return true;

			}								

			return false;

		} 

	);	

	jQuery.fn.dataTable.ext.search.push(

		function( settings, data, dataIndex ) {

			var min = parseInt( jQuery('#LotsizeMin').val(), 10 );

			var max = parseInt( jQuery('#LotsizeMax').val(), 10 );

			var Lotsize = parseFloat( data[9] ) || 0; // use data for the age column

			

			if ( ( isNaN( min ) && isNaN( max ) ) ||

				( isNaN( min ) && Lotsize <= max ) ||

				( min <= Lotsize   && isNaN( max ) ) ||

				( min <= Lotsize   && Lotsize <= max ) )

			{

				return true;

			}								

			return false;

		} 

	);	

	jQuery.fn.dataTable.ext.search.push(

		function( settings, data, dataIndex ) {

			var min = parseInt( jQuery('#YearBuiltMin').val(), 10 );

			var max = parseInt( jQuery('#YearBuiltMax').val(), 10 );

			var YearBuilt = parseFloat( data[10] ) || 0; // use data for the age column

			

			if ( ( isNaN( min ) && isNaN( max ) ) ||

				( isNaN( min ) && YearBuilt <= max ) ||

				( min <= YearBuilt   && isNaN( max ) ) ||

				( min <= YearBuilt   && YearBuilt <= max ) )

			{

				return true;

			}								

			return false;

		} 

	);	

	jQuery.fn.dataTable.ext.search.push(

		function( settings, data, dataIndex ) {

			var min = parseInt( jQuery('#HOAFeesMin').val(), 10 );

			var max = parseInt( jQuery('#HOAFeesMax').val(), 10 );

			var HOAFees = parseFloat( data[10] ) || 0; // use data for the age column

			

			if ( ( isNaN( min ) && isNaN( max ) ) ||

				( isNaN( min ) && HOAFees <= max ) ||

				( min <= HOAFees  && isNaN( max ) ) ||

				( min <= HOAFees  && HOAFees <= max ) )

			{

				return true;

			}								

			return false;

		} 

	);

	jQuery.fn.dataTable.ext.search.push(

		function( settings, data, dataIndex ) {

			var min = parseInt( jQuery('#Rentmin').val(), 10 );

			var max = parseInt( jQuery('#RentMax').val(), 10 );

			var RentMax = parseFloat( data[10] ) || 0; // use data for the age column

			

			if ( ( isNaN( min ) && isNaN( max ) ) ||

				( isNaN( min ) && RentMax <= max ) ||

				( min <= RentMax  && isNaN( max ) ) ||

				( min <= RentMax  && RentMax <= max ) )

			{

				return true;

			}								

			return false;

		} 

	);

	

	jQuery('#min, #max').on('change',function() {

		table.draw();

	});		

	jQuery('#Bedsmin, #Bedsmax').on('change',function() {

		table.draw();

	});	

	jQuery('#Bathsmin, #Bathsmax').on('change',function() {

		table.draw();

	});	

	jQuery('#SquarefeetMin, #SquarefeetMax').on('change',function() {

		table.draw();

	});	

	jQuery('#LotsizeMin, #LotsizeMax').on('change',function() {

		table.draw();

	});

	jQuery('#YearBuiltMin, #YearBuiltMax').on('change',function() {

		table.draw();

	});

	jQuery('#HOAFeesMin, #HOAFeesMax').on('change',function() {

		table.draw();

	});

	jQuery('#Rentmin, #RentMax').on('change',function() {

		table.draw();

	});

	

	jQuery('.more_filters_wrap').click(function(){

		jQuery('#more_filters_wrap').css('position','static');

		var icon = jQuery(this).find('i');

		if(jQuery(icon).hasClass('fa-angle-down')){

			jQuery(icon).removeClass('fa-angle-down');

			jQuery(icon).addClass('fa-angle-up');

		}else{

			jQuery(icon).removeClass('fa-angle-up');

			jQuery(icon).addClass('fa-angle-down');

		}

		jQuery('.newFilters').toggleClass('active');

	});	

	jQuery('.close, .applyfilters').click(function(){

		jQuery('.newFilters').removeClass('active');

	});

	jQuery('.sort,.sortby,.sortval').change(function() { 							

		var orderType = jQuery(".sortby:checked").val();

		var col = jQuery(".sort:checked").val();													

		table.order([col, orderType]).draw();

	});		

	jQuery('.rowicons_div .common_home').click(function(){

		jQuery('.common_home').removeClass('active');

		jQuery(this).addClass('active');

	});

	jQuery('.hometypes').on('change',function () {

		table.columns(7).search(this.value).draw();

	});

});

					