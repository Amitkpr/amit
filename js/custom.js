jQuery(document).ready(function($) {
	
	/**********Login Page Validation***********/
/* 	var user_email = "Please enter your email address";
	$('#loginformpopup').validate({
	rules: {
	username: {
	required: true,
	email: true
	},
	},

	messages: {
	username: user_email,
	},
	errorElement: "div",
	errorPlacement: function(error, element) {
	element.after(error);
	},
	submitHandler: function(form) {
	   form.submit();
	}
}); */



var beds = "Please enter number of Beds.";
var fbaths = "Please enter number of Full Baths.";
var lotSize = "Please enter Lot Size.";
var finishedFeet = "Please enter Finished Square Feet.";
var aby4baths = "Please enter number of 3/4 Baths.";
var bby2baths = "Please enter number of 1/2 Baths.";
var cby4baths = "Please enter number of 1/4 Baths.";

var paddress = "Please enter valid Address.";
var zipcode = "Please enter valid Zip Code.";
var city = "Please enter valid City.";
var pprice = "Please enter valid Price.";
var hoadues = "Please enter valid Price.";
var closingcost = "Please enter valid closing cost.";

	/* jQuery.validator.addMethod("lettersonly", function(value, element) {
		  return this.optional(element) || /^[a-z]+$/i.test(value);
		}, "Letters only please");	 */
		
	/* jQuery(document).on('keyup', '#propertyfacts #pprice', function() {
		var vx = jQuery(this).val();
		jQuery(this).val(vx.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));	
	}); */
	
	jQuery(document).on('keyup', '#propertyfacts #hoadues', function() {
		var dx = jQuery(this).val();
		jQuery(this).val(dx.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));	
	});

	jQuery.validator.addMethod("lettersonly", function (value, element) {
		return this.optional(element) || /^\d+(,\d+)*$/.test(value);
	}, "Please specify the correct number format");

	jQuery('#propertyfacts').validate({
		rules: {
			beds: {
				required: true,
			/* number: true,
			min: 1 */
		},
		fbaths: {
			required: true,
			/* number: true,
			min: 1 */
		},
		lotSize:{
			required: true,
			/* number: true,
			min: 1 */
		},
		finishedFeet:{
			required: true,
			/* number: true,
			min: 1 */
		},
		aby4baths:{
			required: true,
			/* number: true,
			min: 1 */
		},
		bby2baths:{
			required: true,
			/* number: true,
			min: 1 */
		},
		cby4baths:{
			required: true,
			/* number: true,
			min: 1 */
		},
		paddress:{
			required: true,
		},
		zipcode:{
			required: true,
			/* number: true,
			min: 1 */
		},
		city:{
			required: true,
		},
		pprice:{
			required: true,
			/* lettersonly: true, */
		},
		hoadues:{
			required: true,
			lettersonly: true,
		},
		closingcost:{
			required: true,
		}
	}, 
	messages: {
		beds: {
			required: beds,
			number: "Please enter numbers only",
			min: "Please enter value more than 1."
		},
		fbaths: {
			required: fbaths,
           /*  number: "Please enter numbers only",
           min: "Please enter value more than 1." */
       },
       aby4baths: {
       	required: aby4baths,
          /*   number: "Please enter numbers only",
          min: "Please enter value more than 1." */
      },
      bby2baths: {
      	required: bby2baths,
            /* number: "Please enter numbers only",
            min: "Please enter value more than 1." */
        },
        cby4baths: {
        	required: cby4baths,
            /* number: "Please enter numbers only",
            min: "Please enter value more than 1." */
        },
        lotSize: {
        	required: lotSize,
           /*  number: "Please enter numbers only",
           min: "Please enter value more than 1." */
       },
       finishedFeet: {
       	required: finishedFeet,
           /*  number: "Please enter numbers only",
           min: "Please enter value more than 1." */
       },
       hoadues: {
       	required: hoadues,
            /* number: "Please enter numbers only",
            min: "Please enter value more than 1." */
        },
        zipcode: {
        	required: zipcode,
        	number: "Please enter numbers only",
        	min: "Please enter value more than 1."
        },
        closingcost:{
        	required: closingcost,
        }
    },
}); 

	jQuery(document).ready(function(){	
		
		jQuery('#calcu input, #calculaterealestate input, #onlinecaclulatenow input, #propertyfacts input').focusout(function(){
			var valn = jQuery(this).val();
			var rel = jQuery(this).attr('rel');
			
			if(valn == ''){
				/* alert(rel); */
				jQuery(this).val(rel);
				finalVal = jQuery(this).val();
				if(finalVal<100){
					var error = jQuery(this).prev('.valerror');
					jQuery(error).hide();
					jQuery(error).html(' ');
				}
			}
		});
		jQuery('#calcu input.form-control, #propertyfacts input.form-control, #calculaterealestate input.form-control, #onlinecaclulatenow input.form-control').focusin(function(){
			var valn = jQuery(this).val(jQuery.trim(" "));
		});
		/* jQuery('#propertyfacts #lotsizeunit').on('change',function () {
			
			var value = jQuery(this).val();
			alert(value);
			if(value == "Acres"){
				jQuery('.lotsize_acres').css('display','block');
				jQuery('.lotsize_sqft').css('display','none');
			}else{
				jQuery('.lotsize_acres').css('display','none');
				jQuery('.lotsize_sqft').css('display','block');
			} */
			/* lotsize_acres */
		/* }); */
		
		/* jQuery('#calcu input.sirf_number').val(); */
		
		
	/* function sirf_number(){
		var val = jQuery(this).val();
	
		var id = jQuery(this).attr('id');

		if(val >= 100){
			
		}
	}  */
	
	/* jQuery('#calcu input').on('keyup',function(){
		alert('123');
	}); */
	/* jQuery('#calcu input').keyup(validateMaxLength);
	function validateMaxLength(){
		var text = jQuery(this).val();
		var maxlength = jQuery(this).data('maxlength');

		if(maxlength > 0){
			jQuery(this).val(text.substr(0, maxlength)); 
		}
	} */
	
});


	/**********Join IN Validation***********/
	
	jQuery('.fbDisable, .googleDisable').click(function(){
		if(jQuery('#normaluser').is(":checked")){
			jQuery('#error-message').html('');
			jQuery('#error-message').hide();
			jQuery('.radioButton #agent-error').show();
			jQuery('.radioButton #agent-error').text('');
		}else{
			jQuery('.radioButton #agent-error').text('You must agree to the Terms of Service to continue.');
		}
	});
	
	jQuery('.fbenable, .googleenable').click(function(){
		if(jQuery('#normaluser').is(":checked")){
			jQuery('.radioButton #agent-error').text('');
		}else{
			jQuery('.radioButton #agent-error').show();
			jQuery('.radioButton #agent-error').text('You must agree to the Terms of Service to continue.');
		}
	});
	
	jQuery('#normaluser').click(function(){
		if(jQuery(this).is(":checked")){
			jQuery('.fbDisable').addClass('disableClick');
			jQuery('.googleDisable').addClass('disableClick');
			
			jQuery('.fbenable').removeClass('disableClick');
			jQuery('.googleenable').removeClass('disableClick');
			jQuery('.radioButton #agent-error').text('');
			
			
			jQuery('#joinin_submit').css('opacity','1');
		}else{
			
			jQuery('.fbDisable').removeClass('disableClick');
			jQuery('.googleDisable').removeClass('disableClick');
			
			jQuery('.fbenable').addClass('disableClick');
			jQuery('.googleenable').addClass('disableClick');
			
			jQuery('.radioButton #agent-error').text('You must agree to the Terms of Service to continue.');
			
			jQuery('#joinin_submit').css('opacity','0.7');
		}
	});
	
	jQuery('.lable1').click(function(){
		if(jQuery('#user_agent').is(":checked")){
			jQuery('.lable4 #normal_agent').prop('checked', false);	
		}
	});	
	
	jQuery('.lable4').click(function(){
		if(jQuery('#normal_agent').is(":checked")){
			jQuery('.lable4 #normal_agent').prop('checked', true);
			jQuery('.lable1 #user_agent').prop('checked', false);
		}	
	});
	
	
	jQuery('#disagreeuser').click(function(){
		jQuery('#myJoininPopupModal .close').trigger('click');
	});
	
	
	jQuery('.ls-modal-joinin').click(function(){
		var errorDiv = jQuery('#myJoininPopupModal').find('div.error');
		var errorP = jQuery('#error-message').find('p.error');
		jQuery(errorDiv).text('');
		jQuery(errorP).text('');
	});
	jQuery('.ls-modal-login').click(function(){
		var errorDivLogin = jQuery('#loginformpopup').find('#result span');
		jQuery(errorDivLogin).text('');
	});
	
	
	
	var user_full_name = "Please enter your full name";
	var user_email = "Please enter your email address";
	var user_password = "Please enter your password";
	var user_confirm_password = "Please enter confirm password";
	var normaluser = "You must agree to the Terms of Service to continue.";
	
	jQuery('#joininformpopup').validate({
		ignore: ":hidden:not(.user_agent_policy)",
		rules: {	
			user_full_name: {
				required: true,
			},
			normaluser:{ 
				required:true 
			},
			user_email: {
				required: true,
				email: true
			},
			user_password: {
				required: true,
				minlength: 6
			},
			user_confirm_password: {
				required: true,
				equalTo: "#user_password",
				minlength: 6
			}
		}, 
		messages: {
			user_full_name: user_full_name,
			user_email: user_email,
			normaluser: normaluser,
			user_password: {
				required: user_password,
				minlength: "Please enter at least 6 characters."
			},
			user_confirm_password: {
				required: user_confirm_password,
				equalTo: "Failed to confirm your password."
			}
		},
		errorElement: "div",
		errorPlacement: function(error, element) {
			element.after(error);
		},
		submitHandler: function(form) {
			
			var action = 'register_actionCustom';
			var user_full_name = jQuery("#user_full_name").val();
			var user_email = jQuery("#user_email").val();
			var user_password = jQuery("#user_password").val();
			var user_phone_no = jQuery("#user_phone_no").val();
			var userOwner = jQuery("#user_owner").val();
			var userAgent = jQuery("#user_agent").val();
			
			
			if(jQuery("#user_owner").is(":checked")){
				userole = 'owner';
			}else if(jQuery("#user_agent").is(":checked")){
				userole = 'agent';
			}else{
				userole = '';
			}
			
			var ajaxdata = {
				action: 'register_actionCustom',
				user_full_name: user_full_name,
				user_email: user_email,
				user_password: user_password,
				user_phone_no: user_phone_no,
				userRole:userole,
			};
			jQuery('#error-message').html('<div class="loader"><img class="loader" src="'+loaderImage+'"/></div>').fadeIn();
			jQuery.post( ajaxurl, ajaxdata, function(res){
				jQuery('.loader').remove();
				jQuery("#error-message").html(res);
			});
		}
	});
	
	
	jQuery('#Resetpass').validate({
		rules: {
			uemail: {
				required: true,
				email: true
			},
		},
		messages: {
			uemail: user_email,
		},
		errorElement: "div",
		errorPlacement: function(error, element) {
			element.after(error);
		}
	});
	
	jQuery('#setPass').validate({
		rules: {
			newpass: {
				required: true,
				minlength : 6
			},
			repeatpass : {
				required: true,
				minlength : 6,
				equalTo : "#newpass"
			},
		},
/* 	messages: {
	newpass: newpass,
	repeatpass: repeatpass,
}, */
errorElement: "div",
errorPlacement: function(error, element) {
	element.after(error);
}
});
	
	/* Phone Number Formation Start******/
	jQuery("input[name='user_phone_no']").keyup(function() {
		jQuery(".form-group").on('keydown', '#user_phone_no', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
		
		var curchr = this.value.length;
		var curval = jQuery(this).val();
		if (curchr == 3) {
			jQuery("input[name='user_phone_no']").val("(" + curval + ")" + "-");
		} else if (curchr == 9) {
			jQuery("input[name='user_phone_no']").val(curval + "-");
		}
	});
	
});



function numberValidation(id){
	jQuery(id).keydown(function (e) {
		/* var newClass = $(this); */
		if (e.shiftKey || e.ctrlKey || e.altKey) {
			e.preventDefault();
				
		} else {
			var key = e.keyCode;
			if (!((key == 8) || (key == 9) || (key == 13) || (key == 16) || (key == 17) ||  (key == 110) || (key == 46) || (key >= 33 && key <= 47) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105))) {
				e.preventDefault();
				jQuery(id+'-error').html(' ');
				var parents = jQuery(id+'-error').html('<span style="color:red;">please enter numeric value.</span>');
			}else{
				jQuery(id+'-error').html(' ');
			}
		}
	});	
}


function numVal(e) {
	/* .numeric(); */
	/* jQuery(e.value).replace(/[^0-9\.]/g,''); */

	var cls = jQuery('#'+e.id).hasClass('allow');
	if(cls == true){
		/* alert(cls); */
	}else{
		if((e.value >= 100)){
			var parentVal = jQuery('#'+e.id).prev('.valerror');
			jQuery(parentVal).show();
			jQuery(parentVal).html('<span style="color:red;">Please enter a value less than 100.</span>'); 
			jQuery('#'+e.id).attr('aria-required','true');
			jQuery('#'+e.id).attr('aria-invalid','true');
		}else{
			var parentVal = jQuery('#'+e.id).prev('.valerror');
			jQuery(parentVal).hide();
			jQuery(parentVal).html(' '); 
			jQuery('#'+e.id).attr('aria-invalid','false');
		}	
	}
	
}


function isDecimalNumber(evt){
   var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode != 46 && (charCode < 48 || charCode > 57))) return false;
   return true;
}

/* calculation form validation */
jQuery(function() {

	jQuery.validator.addMethod("mynumber", function (value, element) {
		return this.optional(element) || /^\d+(,\d+)*$/.test(value);
	}, "Please specify the correct number format");
	
	jQuery.validator.addMethod("lettersonly", function (value, element) {
		return this.optional(element) || /^\d+(,\d+)*$/.test(value);
	}, "Please specify the correct number format");
	
	numberValidation('#purchaseprice');
	numberValidation('#upfrontimprovement');
	numberValidation('#closingcost');
	numberValidation('#downpayment');
	numberValidation('#interestrate');
	numberValidation('#mortgageyears');
	numberValidation('#monthlyrent');
	numberValidation('#vacancyrate');
	numberValidation('#expropertytaxes');
	numberValidation('#exinsurance');
	numberValidation('#exrepairs');
	numberValidation('#exutilities');
	numberValidation('#expropertymgmt');
	numberValidation('#exhoa');
	numberValidation('#exother');
	numberValidation('#exotherfixed');
	numberValidation('#marginaltaxrate');
	numberValidation('#amortizationperiodyears');
	numberValidation('#annualappreciation');
	numberValidation('#annualrentincrease');
	numberValidation('#annualoprating');
	numberValidation('#sellholdingperiod');
	numberValidation('#selltransactioncost');
	numberValidation('#sellcapitalgain');
	numberValidation('#selldepreciationrecap');
	numberValidation('#sellstatetax');
	
    // Setup form validation on the #register-form element
    jQuery("#calculaterealestate").validate({
    	
        // Specify the validation rules
        rules: {
        	propertyName: {
        		required: true,
        	},
        	propertyAddress: {
        		required: true,
        	},
        	purchaseprice: {
        		required: true, 
        		/* lettersonly: true, */
        	},
        	upfrontimprovement: {
        		required: true, 
        		/* mynumber: true, */
        	},
        	closingcost: {
        		required: true, 
        		/* number: true,
        		max:99, */
        	},
        	downpayment: {
        		required: true, 
        		/* number: true,
        		max:99, */
        	},
        	interestrate: {
        		required: true, 
        		number: true,
        		max:99,
        	},
        	mortgageyears: {
        		required: true,
        		number: true,				
        		max:30,
        	},
        	monthlyrent: {
        		required: true, 
        		maxlength: 9,
        	},
        	vacancyrate: {
        		required: true, 
        		number: true,
        		max:99,
        	},
        	expropertytaxes: {
        		required: true, 
        		number: true,
        	},
        	exinsurance: {
        		required: true, 
        		mynumber: true,
        	},
        	exrepairs: {
        		required: true, 
        		number: true,
        		max:99,
        	},
        	exutilities: {
        		required: true, 
        		
        	},			
        	expropertymgmt: {
        		required: true, 
        		number: true,
        		max:99,
        	},		
        	exhoa: {
        		required: true, 
        		/* number: true, */
        	},			
        	exother: {
        		required: true, 
        		number: true,
        		max:99,
        	},
        	exotherfixed: {
        		required: true, 
        		/* number: true, */
        	},			
        	marginaltaxrate: {
        		required: true, 
        		number: true,
        		max:99,
        	},				
        	amortizationperiodyears: {
        		required: true, 
        		number: true,
        		max:99,
        	},			
        	annualappreciation: {
        		required: true, 
        		max:99,
        	},
        	annualrentincrease: {
        		required: true, 
        		number: true,
        		max:99,
        	},
        	annualoprating: {
        		required: true, 
        		number: true,
        		max:99,
        	},
        	sellholdingperiod: {
        		required: true, 
        		number: true,
        		max:99,
        	},
        	selltransactioncost: {
        		required: true, 
        		number: true,
        		max:99,
        	},
        	sellcapitalgain: {
        		required: true, 
        		number: true,
        		max:99,
        	},
        	selldepreciationrecap: {
        		required: true, 
        		number: true,
        		max:99,
        	},
        	sellstatetax: {
        		required: true, 
        		number: true,
        		max:99,
        	},       
        }, 
        
        // Specify the validation error messages
        messages: {
        	propertyName: "Please enter your property name",
        	propertyAddress: "Please enter your address",
        	purchaseprice: {
        		required:"Please enter your purchase price",
        		pattern:'Please enter a valid number',
        	},
        	upfrontimprovement: "Please enter your upfront improvement",
        	closingcost: {
        		required: "Please enter your closing cost",
        		max: "Please enter less than 100%"
        	},
        	downpayment: {
        		required: "Please enter your down payment",
        		max: "Please enter less than 100%"
        	},
        	interestrate: {
        		required: "Please enter your interest rate",
        		max: "Please enter less than 100%"
        	},
        	mortgageyears: {
        		required: "Please enter your mortgage years",
        		max: "Please enter less than 30 years"
        	},
        	monthlyrent: {
				required: "Please enter your monthly rent",
        		maxlength: "Please enter less than 9 length including commas(,)"
			},
        	vacancyrate: {
        		required: "Please enter your vacancy rate",
        		max: "Please enter less than 100%"
        	},
        	expropertytaxes: {
        		required: "Please enter your property taxes",
        		max: "Please enter less than 100%"
        	},
        	exinsurance: "Please enter your insurance",
        	exrepairs: {
        		required: "Please enter your repairs",
        		max: "Please enter less than 100%"
        	},
        	exutilities: "Please enter your utilities",
        	expropertymgmt: {
        		required: "Please enter your property mgmt fee",
        		max: "Please enter less than 100%"
        	},
        	exhoa: "Please enter your hoa",
        	exother: {
        		required: "Please enter your other",
        		max: "Please enter less than 100%"
        	},
        	exotherfixed: "Please enter your other fixed cost",
        	marginaltaxrate: {
        		required: "Please enter your marginal tax rate",
        		max: "Please enter less than 100%"
        	},
        	amortizationperiodyears: {
        		required: "Please enter your amortization period years",
        		max: "Please enter less than 100 years"
        	},
        	annualappreciation: {
        		required: "Please enter your appreciation",
        		max: "Please enter less than 100%"
        	},
        	annualrentincrease: {
        		required: "Please enter your rent increase",
        		max: "Please enter less than 100%"
        	},
        	annualoprating: {
        		required: "Please enter your operating expense increase",
        		max: "Please enter less than 100%"
        	},
        	sellholdingperiod: {
        		required: "Please enter your holding period",
        		max: "Please enter less than 100"
        	},
        	selltransactioncost: {
        		required: "Please enter your selling transaction cost",
        		max: "Please enter less than 100%"
        	},
        	sellcapitalgain: {
        		required: "Please enter your capital gains tax rate",
        		max: "Please enter less than 100%"
        	},
        	selldepreciationrecap: {
        		required: "Please enter your depreciation recap tax rate",
        		max: "Please enter less than 100%"
        	},
        	sellstatetax: {
        		required: "Please enter your state tax", 
        		max: "Please enter less than 100%"
        	},  
        },
        
        submitHandler: function(form) {
        	form.submit();
        }
    });

});


jQuery(function() {

    // Setup form validation on the #register-form element
    jQuery("#onlinecaclulatenow").validate({
    	
        // Specify the validation rules
        rules: {
        	purchaseprice: {
        		required: true, 
        		/* number: true, */
				//max:10,
			},
            /* downpayment: {
                required: true, 
				number: true,
			},	 */ 
			downpayment: {
				required: true, 
				number: true,
				max:100,
				min:1,
			},			
		}, 
		
        // Specify the validation error messages
        messages: {
        	purchaseprice: "Please enter your purchase price",  
            //downpayment: "Please enter your down payment",  
            downpayment: {
            	required: "Please enter your closing cost",
            	max: "Please enter less than 100%"
            }
        },
        
        submitHandler: function(form) {
        	form.submit();
        }
    });

});

/* /* /* /* /* /* /* /* /* /* /* */

jQuery(document).ready(function($) {
	$('.form-validated').keydown(function (e) {
		if (e.shiftKey || e.ctrlKey || e.altKey) {
			e.preventDefault();
		} else {
			var key = e.keyCode;
			if (!((key == 8) || (key == 9) || (key == 13) || (key == 16) || (key == 17) ||  (key == 110) || (key == 46) || (key >= 33 && key <= 47) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105))) {
				e.preventDefault();
			}
		}

	});
});



	


/******** number currency format  *************/

jQuery(document).on('keyup', '#purchaseprice', function() {
	var x = jQuery(this).val();
	jQuery(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
});

jQuery(document).on('keyup', '#pprice', function() {
	var x = jQuery(this).val();
	jQuery(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
});
/* jQuery(document).on('keyup', '#upfrontimprovement', function() {
	var x = jQuery(this).val();
	jQuery(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
}); */

jQuery(document).on('keyup', '#monthlyrent', function() {
	var x = jQuery(this).val();
	jQuery(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
});

jQuery(document).on('keyup', '#exinsurance', function() {
	var x = jQuery(this).val();
	jQuery(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
});

jQuery(document).on('keyup', '#exutilities', function() {
	var x = jQuery(this).val();
	jQuery(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
});

jQuery(document).on('keyup', '#exhoa', function() {
	var x = jQuery(this).val();
	jQuery(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
});

jQuery(document).on('keyup', '#exotherfixed', function() {
	var x = jQuery(this).val();
	jQuery(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
});



jQuery(document).on('keyup', '#Insurance_Monthly', function() {
	var x = jQuery(this).val();
	jQuery(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
});
jQuery(document).on('keyup', '#Utilities_Monthly', function() {
	var x = jQuery(this).val();
	jQuery(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
});
jQuery(document).on('keyup', '#HOA_Monthly', function() {
	var x = jQuery(this).val();
	jQuery(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
});
jQuery(document).on('keyup', '#ther_Fixed_Cost_Monthly', function() {
	var x = jQuery(this).val();
	jQuery(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
});


jQuery(document).ready(function(){
	jQuery('#msgsResult').closest('#propertyListingTbl').addClass('text');
});

/*****//*** number currency format  **//***********/

/* calculation form validation */
jQuery(function() {

    // Setup form validation on the #register-form element
    jQuery("#zillowapi").validate({
    	
        // Specify the validation rules
        rules: {
        	zillowadd: {
        		required: true, 
        	}, 
        	zipcode: {
        		required: true, 
        		number: true,
        	},     
        }, 
        
        // Specify the validation error messages
        messages: {
        	zillowadd: {
        		required: "Please enter address here",
        	},
        	zipcode: {
        		required: "Please enter zipcode",
        		number:"Please enter numbers only",
        	},
        },
        
        submitHandler: function(form) {
        	form.submit();
        }
    });

});

/* add user id to form */
jQuery(document).ready(function(){
	var userId = jQuery('#userId').val();
	jQuery('#User_ID').val(userId);
	
	/*up down arrows*/
	jQuery('.options_wrapper .collapseButton').click(function(){
		var iVar = jQuery(this).find('i');
		if(jQuery(iVar).hasClass('fa-angle-down')){
			jQuery(iVar).removeClass('fa-angle-down');
			jQuery(iVar).addClass('fa-angle-up');	
		}else{
			jQuery(iVar).removeClass('fa-angle-up');
			jQuery(iVar).addClass('fa-angle-down');	
		}
		
	});
}); 

/*profile page password*/




	/* var mypass1 = "Please enter your password";
	var mypass2 = "Please enter confirm password"; */
	jQuery(document).ready(function(){
	/* jQuery('#mypass1').focusout(function(){
		var passTwo = jQuery('#mypass2').val();
		if(passTwo != ''){
			var passOne = jQuery(this).val();
			if(passTwo == passOne){
				jQuery('div.confirmp').text('');
			}else{
				jQuery('div.confirmp').text('Failed to confirm password.');
			}
		}else{
			jQuery('div.confirmp').text('Please Confirm the password.');
		}
	});	 */
	jQuery('#mypass1').focusout(function(){
		var passOne = jQuery(this).val();
		var passTwo = jQuery('#mypass2').val();
		
		jQuery('#confirmpass1').val(passOne);
		if(passOne != '' || passTwo !='' ){
			if(passOne == passTwo){
				jQuery('#saveNew').hide();
				jQuery('#submit').show();
				jQuery('div.confirmp').text('');
			}else{
				jQuery('#saveNew').show();
				jQuery('#submit').hide();
				jQuery('div.confirmp').text('Please Confirm the password.');
			}
		}else{
			jQuery('#saveNew').hide();
			jQuery('#submit').show();
		}
	});
	
	jQuery('#mypass2').focusout(function(){
		var passTwo = jQuery(this).val();
		var passOne = jQuery('#mypass1').val();
		jQuery('#confirmpass2').val(passTwo);
		if(passTwo == passOne){
			jQuery('#saveNew').hide();
			jQuery('#submit').show();
			jQuery('div.confirmp').text('');
		}else{
			jQuery('#saveNew').show();
			jQuery('#submit').hide();
			jQuery('div.confirmp').text('Please Confirm the password.');
		}
	});
	
});
jQuery(document).ready(function(){
	jQuery('.fbDisable, .googleDisable').click(function(){
		var errorText = jQuery('#agent-error').text();	
		if(errorText != ''){
			jQuery('#myJoininPopupModal').animate({
				scrollTop: jQuery("#agent-error").offset().top
			}, 2000);
		}
	});
	var windowsWidth = jQuery(window).width();
	/* var newwindowsWidth = windowsWidth; */
	if(windowsWidth>=769){
		/* jQuery('#search_main_container').css('max-width',newwindowsWidth); */
		var mapWidth = windowsWidth - 681;
		jQuery('#search_main_container .map_img').css('width',mapWidth);
	}
});

	