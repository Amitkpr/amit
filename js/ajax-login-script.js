jQuery(document).ready(function($) {
	
	$('#onlinecaclulatenow .submitcalculation').click(function(){
		var price = $('form#onlinecaclulatenow #purchaseprice').val();
		var priceC = createCookie('purchasePrice',price,'');
		$('#loginformpopup #purchasePrice').val(price);
		var downPayment = $('form#onlinecaclulatenow #downpayment').val();
		$('#loginformpopup #downPayment').val(downPayment);
		$('#loginformpopup #From').val('home');
		var downPaymentC = createCookie('downPayment',downPayment,'');
	});
	
	$('.main_container_search #propertyListingTbl .mainpPrice').click(function(){
		var hprice = $(this).find('#hprice').val();
		$('#loginformpopup #purchasePrice').val(hprice);
		var hRent = $(this).find('#hrent').val();
		$('#loginformpopup #downPayment').val(hRent);
		var hFrom = $(this).find('#hfrom').val();
		$('#loginformpopup #From').val(hFrom);
	});
	
    $('form#loginformpopup').on('submit', function(e){
		/* console.log($('form#loginformpopup #purchasePrice').val()); */
        $('form#loginformpopup #result .error').show().text(ajax_login_object.loadingmessage);
		jQuery('#resulted').html('<div class="loader"><img class="loader" src="'+loaderImage+'"/></div>').fadeIn();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: { 
                'action': 'ajaxlogin',
                'username': $('form#loginformpopup #username').val(), 
                'password': $('form#loginformpopup #password').val(), 
                'purchase': $('form#loginformpopup #purchasePrice').val(), 
                'downpayment': $('form#loginformpopup #downPayment').val(), 
                'from': $('form#loginformpopup #From').val(), 
                'security': $('form#loginformpopup #security').val() 
			},
			success: function(data){
				jQuery('.loader').remove();
				if(data.message == 'Login successful, redirecting...'){
					$('form#loginformpopup #result .error').text(data.message).css('color','#3b5998');
				} else{
					$('form#loginformpopup #result .error').text(data.message);
				}
				if (data.loggedin == true){
				   document.location.href = ajax_login_object.redirecturl;
				}
			}
        });
        e.preventDefault();
    });


});

