<?php

/*

If you would like to edit this file, copy it to your current theme's directory and edit it there.

Theme My Login will always look in your theme's directory first, before using this default template.

*/
$role = user_role();
$userID = $current_user->ID;
$userData = get_userdata($userID);
$role = $userData->roles['0'];

?>

<script>

jQuery(document).ready(function(){
	jQuery('.img_small').click(function(){
		jQuery('#wpua-file-existing').trigger('click');
	});	
	jQuery('#ChangePassword .wp-generate-pw').click(function(){
		jQuery('#ChangePassword .tml-form-table').css('width','100%');
	});
	jQuery('#ChangePassword .wp-cancel-pw').click(function(){
		jQuery('#ChangePassword .tml-form-table').css('width','222px');
	});
	var src = jQuery('#wpua-thumbnail-existing img').attr('src');
	var newSrc = src;
	jQuery('.img_main').attr("src",newSrc);	

});

</script>
<?php 

if($role == 'agent' || $role == 'administrator'){
	$telephone = get_user_meta( $userID, 'telephone', true );   
	$Useraddress = get_user_meta( $userID, 'Useraddress', true );   
	$website_user = get_user_meta( $userID, 'website_user', true );   
	$screenname = get_user_meta( $userID, 'screenname', true ); 	
	$aboutDes = get_user_meta( $userID, 'aboutdes', true ); 	
} 

?>
<div class="quizSaveLoaderMain"></div>

			<div class="quizPublishedModalResponse"></div>

<div class="tml tml-profile" id="theme-my-login<?php $template->the_instance(); ?>">

	<?php $template->the_action_template_message( 'profile' ); ?>

	<?php $template->the_errors(); ?>

	<form name="myprofile" id="your-profile" action="<?php $template->the_action_url( 'profile', 'login_post' ); ?>" method="post">

		<?php wp_nonce_field( 'update-user_' . $current_user->ID ); ?>

		<p>

			<input type="hidden" name="from" value="profile" />

			<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />

		</p>	

		

		<div id="UserProfile" class="col-lg-12 col-md-12 col-xs-12 col-sm-12 pad0 main_sec">

		

		<?php //do_action( 'profile_personal_options', $profileuser ); ?>

		
		<?php if($role != 'dataentry'){	?> 
		<div class="row imagerow">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0 linput profiledescsetting">

			

					<?php 
					
					
							
						/* $agentID = $current_user->ID; */
						$postID = get_user_meta($userID,'front_end_profile_page',true);
					
					?>
					
				
				
				
				<div class="positionrelative">

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0" style="display:none;">

					<textarea placeholder="Enter your description" spellcheck="false" class="profiletextarea UserDescRiption" name="description" id="description" rows="5" cols="30"><?php echo esc_html( $profileuser->description ); ?></textarea>

					</div>

				</div>

				<div class="inner_div">

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0 mainWrapImg">

						<div class="placeholder_wrapper pad0">

							<div class="placeholder_inwrapper">
							<?php
							
								parse_str(get_avatar_url($userID),$userImg);
								$fbUserImg =  get_user_meta($userID, 'fb_profile_picture', true);
								$googleUserImg =  get_user_meta($userID, 'google_profile_picture', true);
								if($userImg['d'] != 'blank'){ 
								
							?>
					 		
								<img class="img_main" src="<?php echo get_avatar_url($userID); ?>">
							
							<?php }else if($fbUserImg !=''){ ?>
								<img class="img_main" src="<?php echo $fbUserImg; ?>">
							<?php }else if($googleUserImg != ''){?>
								<img class="img_main" src="<?php echo $googleUserImg; ?>">
							<?php }else{ ?>
							
							<img class="img_main" src="<?php echo get_template_directory_uri(); ?>/images/profile-placeholder.jpg">"
							<?php } ?>
							</div>

							<img class="img_small" src="<?php echo get_template_directory_uri().'/images/edit.png' ?>">

						</div>

					</div>

					<!--div class="col-lg-4 text-center">

						<p class="upload_img">Upload your profile photo</p-->

						<?php 
						
							do_action( 'show_user_profile', $profileuser );
							
							/* placeholder_wrapper pad0 */
							
						?>

					<!--/div-->	

				</div>
				
					<h4 class="quizprofiletitle"> 

						<?php 
						
							
							echo '<span class="userProfileName">'.$profileuser->display_name.'</span>';

							echo($role == 'agent' || $role == 'administrator') ? ' ('.ucfirst($role).')' : '';
								
							/* $agentID = $current_user->ID; */
							$postID = get_user_meta($userID,'front_end_profile_page',true);
						
						?>
						
					</h4>	
			
				<?php if($role == 'administrator'){	?>
			
					<div class="editProfileContainer" style="bottom:22px !important;">
						<a href="<?php echo get_the_permalink(403); ?>" target="_blank" class="hidden-mobile" title="View Public Profile">View Public Profile</a>
						<a href="<?php echo get_the_permalink(403); ?>" target="_blank" class="display-mobile" title="View Public Profile"><i class="fa fa-user"></i></a>
					</div>
					
				<?php }else{ ?>
					<div class="editProfileContainer">
						<a href="<?php echo get_the_permalink($postID); ?>" target="_blank" class="hidden-mobile" title="View Public Profile">View Public Profile</a>
						<a href="<?php echo get_the_permalink($postID); ?>" target="_blank" class="display-mobile" title="View Public Profile"></a>
					</div>	
				
				<?php } ?>		
			</div>

		</div>
		<?php } ?>
		</div>
		<?php if($role != "dataentry"){ ?>	
		<div id="ChangeEmailAddress" class="col-lg-12 col-md-12 col-xs-12 col-sm-12 pad0 main_sec2 UserDetailForM">

		<div class="row">

		<h4 class="quizprofiletitle">Change Your Email Address or Password</h4>

			

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0 linput">

				<div class="inner_div input_left">

				<?php /* print_r(esc_attr( $profileuser->first_name )); */ ?>

					<label for="first_name"><?php _e( 'First Name', 'theme-my-login' ); ?><span class="star">*</span></label> 

					<input type="text" name="first_name" id="first_name" value="<?php echo esc_attr( $profileuser->first_name ); ?>" class="regular-text" />

				</div>

			</div>



			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0 linput">

				<div class="inner_div input_right">

					<label for="last_name"><?php _e( 'Last Name', 'theme-my-login' ); ?><span class="star">*</span></label>

					<input type="text" name="last_name" id="last_name" value="<?php echo esc_attr( $profileuser->last_name ); ?>" class="regular-text" />

				</div>	

			</div>

			

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0 linput hidenickname">

				<div class="inner_div input_left">

					<label for="nickname"><?php _e( 'Nickname', 'theme-my-login' ); ?> <span class="star">*</span></label>

					<input type="text" name="nickname" id="nickname" value="<?php echo esc_attr( $profileuser->nickname ); ?>" class="regular-text" />

				</div>	

			</div>

			

		</div>

		

		<div class="row">

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0 linput">

				<div class="inner_div input_left">

					<label for="email"><?php _e( 'Email Address', 'theme-my-login' ); ?> <span class="star">*</span></label>

					<input type="text" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ); ?>" class="regular-text" />

					<?php

					$new_email = get_option( $current_user->ID . '_new_email' );

					if ( $new_email && $new_email['newemail'] != $current_user->user_email ) : ?>

					<div class="updated inline">

					<p><?php

						printf(

							__( 'There is a pending change of your e-mail to %1$s. <a href="%2$s">Cancel</a>', 'theme-my-login' ),

							'<code>' . $new_email['newemail'] . '</code>',

							esc_url( self_admin_url( 'profile.php?dismiss=' . $current_user->ID . '_new_email' ) )

					); ?></p>

					</div>

					<?php endif; ?>

				</div>
			</div>
			<?php if($role == 'agent' || $role == 'administrator'){  ?>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0 linput">

					<div class="inner_div input_right">

						<label for="phonenumber">Phone No.<span class="star"></span></label>

						<input type="text" name="telephone" id="phonenumber" value="<?php echo ($telephone) ? $telephone :''; ?>" class="regular-text" />

					</div>	

				</div>
				<?php } ?>
		</div>
		<?php if($role == 'agent' || $role == 'administrator'){  ?>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0 linput">

				<div class="inner_div input_left">

					<label for="phonenumber">Address.<span class="star"></span></label>

					<input type="text" name="Useraddress" id="AddRess" value="<?php echo ($Useraddress) ? $Useraddress :''; ?>" class="regular-text" />

				</div>	

			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0 linput">

				<div class="inner_div input_right">

					<label for="webSite">Website<span class="star"></span></label>

					<input type="text" name="website_user" id="webSite" value="<?php echo ($website_user) ? $website_user :''; ?>" class="regular-text" />

				</div>	

			</div>
		</div>
		<?php } ?>
		<div class="row">
			<?php if($role == 'agent' || $role == 'administrator'){  ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0 linput">

				<div class="inner_div input_right pad0">

					<label for="screenName">Screen Name<span class="star"></span></label>

					<input type="text" name="screenname" id="screenName" value="<?php echo ($screenname) ? $screenname :''; ?>" class="regular-text" />
					
				</div>	

			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0 linput">

				<div class="inner_div input_right pad0">

					<label for="AboutDes">Description<span class="star"></span></label>

					<textarea name="aboutdes" id="AboutDes" value="<?php echo ($aboutDes) ? $aboutDes :''; ?>" class="regular-text" ><?php echo ($aboutDes) ? $aboutDes :''; ?></textarea>

				</div>	

			</div>
			<?php } ?>
				<div id="ChangePassword" class="row profilepasswordrow">
					<div class="inner_div input_right pad0">
						<label for="mypass1">Password<span class="star"></span></label>
						<input type="password" name="mypass1" id="mypass1" >
					</div>
					<div class="inner_div input_right pad0 mypass2">
						<label for="mypass2">Confirm Password<span class="star"></span></label>
						<input type="password" name="mypass2" id="mypass2" >
							<div class="confirmp"></div>
                    </div>
                    <input name="pass1" type="hidden" id="confirmpass1"/>
                    <input name="pass2" type="hidden" id="confirmpass2"/>
                    
		<?php

		/* $show_password_fields = apply_filters( 'show_password_fields', false, $profileuser );

		if ( $show_password_fields ) : */

		?>

		<!--table class="tml-form-table col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0 linput">

		<tr id="password" class="user-pass1-wrap">

			

			<td>

				<input class="hidden" value=" " />

				<button type="button" class="button button-secondary wp-generate-pw hide-if-no-js"><?php /* _e( 'Generate Password', 'theme-my-login' ); */ ?></button>

				<div class="wp-pwd hide-if-js">

					<span class="password-input-wrapper inner_div">

				<label for="email"><?php /* _e( 'New Password', 'theme-my-login' ); */ ?> <span class="star">*</span></label>

						<input type="password" name="pass1" id="pass1" class="regular-text" value="" autocomplete="off" data-pw="<?php /* echo esc_attr( wp_generate_password( 24 ) ); */ ?>" aria-describedby="pass-strength-result" />

					</span>

					<div style="display:none" id="pass-strength-result" aria-live="polite"></div>

					<button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php /* esc_attr_e( 'Hide password', 'theme-my-login' ); */ ?>">

						<span class="dashicons dashicons-hidden"></span>

						<span class="text"><?php /* _e( 'Hide', 'theme-my-login' ); */ ?></span>

					</button>

					<button type="button" class="button button-secondary wp-cancel-pw hide-if-no-js" data-toggle="0" aria-label="<?php /* esc_attr_e( 'Cancel password change', 'theme-my-login' ); */ ?>">

						<span class="text"><?php /* _e( 'Cancel', 'theme-my-login' ); */ ?></span>

					</button>

				</div>

			</td>

		</tr>

		<tr class="user-pass2-wrap hide-if-js">

			<th scope="row"><label for="pass2"><?php /* _e( 'Repeat New Password', 'theme-my-login' ); */ ?></label></th>

			<td>

			<input name="pass2" type="password" id="pass2" class="regular-text" value="" autocomplete="off" />

			<p class="description"><?php /* _e( 'Type your new password again.', 'theme-my-login' ); */ ?></p>

			</td>

		</tr>

		<tr class="pw-weak">

			<td>

				<label>

					<input type="checkbox" name="pw_weak" class="pw-checkbox" />

					<span><?php /* _e( 'Confirm use of weak password', 'theme-my-login' ); */ ?></span>				

				</label>

			</td>

		</tr>

		<?php /* endif; */ ?>



		</table-->
	
		<p class="tml-submit-wrap update_profile">

			<input type="hidden" name="action" value="profile" />

			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />

			<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />

			<input type="submit" class="button-primary" value="<?php esc_attr_e( 'SAVE', 'theme-my-login' ); ?>" name="submit" id="submit" />
			<a id="saveNew" style="display:none;">Save</a>

		</p>

		</div>

	</div>

			

			<!--div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pad0 linput">

				<div class="inner_div input_right">

					<label for="user_country"><?php _e( 'Country', 'theme-my-login' ); ?> <span class="star">*</span></label>

					<input type="text" name="user_country" id="country" value="<?php echo esc_attr( $profileuser->user_country ); ?>" class="regular-text" />

				</div>	

			</div-->



			

		</div>

		<?php } ?>

		

		<div class="row">

		

			<!--div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pad0 linput">

				<div class="inner_div input_left">

						<label for="user_state"><?php _e( 'State', 'theme-my-login' ); ?> <span class="star">*</span></label>

						<input type="text" name="user_state" id="user_state" value="<?php echo esc_attr( $profileuser->user_state ); ?>" class="regular-text" />

				</div-->	

			</div>

			

			<!--div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pad0 linput">

				<div class="inner_div input_right">

						<label for="user_city"><?php _e( 'City', 'theme-my-login' ); ?> <span class="star">*</span></label>

						<input type="text" name="user_city" id="user_city" value="<?php echo esc_attr( $profileuser->user_city ); ?>" class="regular-text" />

				</div>	

			</div-->

			

		</div>

	

		<!--

		<table class="tml-form-table">

	

		<?php

			foreach ( wp_get_user_contact_methods() as $name => $desc ) {

		?>

		<tr class="tml-user-contact-method-<?php echo $name; ?>-wrap">

			<th><label for="<?php echo $name; ?>"><?php echo apply_filters( 'user_'.$name.'_label', $desc ); ?></label></th>

			<td><input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_attr( $profileuser->$name ); ?>" class="regular-text" /></td>

		</tr>

		<?php	}	?>

		</table>-->





		

		



	

	</div>

	</form>

	

	<!--div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 pad0 main_sec">

		<div class="row profiledeleterow">

			<div class="quizdashboardfilteresults">

				<h3 class="quizfiltertitle"> Delete Account </h3>

			</div>

			

			<div class="profilepermanentdelete">

				<h3 class="deleteprofileerror"> This action cannot be undone!</h3>

				

				<button class="button-primary" name="permanentDelete" id="permanentDelete" />

				PERMANENTLY DELETE MY ACCOUNT</button>

			</div>

		</div>

	

	</div-->
	<?php
		/* if($role == 'agent' || $role == 'owner'){}else{ */
	?>
	<div id="PreviouslySavedCalculations" class="col-lg-12 col-md-12 col-xs-12 col-sm-12 pad0 main_sec UserDetailForM main_sec3">

		

		<?php //do_action( 'profile_personal_options', $profileuser ); ?>

		

		<div class="row imagerow" <?php echo($role == 'dataentry')?'style="padding:0px"':''; ?>>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0 linput profiledescsetting">

				<h4 class="quizprofiletitle" > Previously Saved Calculations</h4>

			    <div class="PreSavedBox">

<table id="myTable">
	<thead>
		<tr>
			<th>No.</th>
			<th>Date Saved</th>
			<th style="display:none;">Name</th>
			<th>Address</th>
			<th>Purchase Price</th>
			<th>Rental ROI</th>
			<th>View/Edit/Delete</th>
		</tr>
	</thead>
<tbody>
<?php 
global $wpdb;
$querystr = "SELECT * FROM wp_calculator WHERE user_id =".$current_user->ID." and status='1'";
$savedCalculation = $wpdb->get_results($querystr, OBJECT);
/* echo count($savedCalculation);
echo $current_user->ID; */
if(!empty($savedCalculation)){
					
function totalReturn($totalROI,$barchart,$xlabel,$ids){
	/* $id = base64_decode($ids); */

	$alldataRasult = get_calculator_data_by_id($ids);
	$mortgageYears = $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$buildingValue = $purchasePrice*0.75;
	$amortizationPeriodYears = $alldataRasult['amortizationperiodyears'];
	$cashFlowTaxDepreciationYearly =  round($buildingValue/$amortizationPeriodYears,0); 
	$monthlyRent = $alldataRasult['monthlyrent'];
	$calculateTotalRents = $monthlyRent*12;
	$vacancyRate = $alldataRasult['vacancyrate'];
	$interestRate= $alldataRasult['interestrate'];
	$marginaltaxrate = $alldataRasult['marginaltaxrate'];
	$marginaltaxrateResult = $marginaltaxrate/100;
	$downPayment = $alldataRasult['downpayment'];
	$exHOA = $alldataRasult['exhoa'];
	$exOther = $alldataRasult['exother'];
	/* $monthlyMortgageDynamic = round($monthlyMortgagePay,2); */
	
	/*Annual Rent Increase in % */
	$AnuualRentIncrease = $alldataRasult['annualrentincrease'];
	
	$propertYmGmt = $alldataRasult['expropertymgmt'];
	
	/*Monthly Issurance in $ */
	$monthlyInsurance = $alldataRasult['exinsurance'];
	
	/*Yearly Issurance in $ */
	$yearlyInsurance = $monthlyInsurance*12;
	
	/* Annual Operating Expenses % */
	$annualOpratingExpences = $alldataRasult['annualoprating']; 
	
	$PropertyMgmtFee = $totalPropertyMgmtFee;
	if(empty($PropertyMgmtFee)){
		$PropertyMgmtFee = round($calculateTotalRents*$propertYmGmt/100,0);
	}

	
	$mortgageYearsMonths = $mortgageYears*12;
	$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
	$toalMonthlyEmi = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
	$lamount = $loanAmount;
	
	$lamounts = $loanAmount;
	
	$mi = $interestRate;
	$n = $mortgageYears;

	$ny = $n * 12;
	$mic = $mi /1200;
	
	$mics = $mi /1200;

	$top = pow((1+$mic),$ny);
	$bottom = $top - 1;
	$sp = $top / $bottom;

	$emi = (($lamount * $mic) * $sp);
	$emis = (($lamount * $mic) * $sp);
	$k=0;
	
	$ji = 0;
	$ck=0;
	
	$calculateTotalPrincipalAmountMainResultValResult = array();
	for($i=1;$i<=$mortgageYearsMonths;$i++){
		
		if(!empty($calculateTotalLoanAndInterest)){
			$lamount = $calculateTotalLoanAndInterest-$emi;
		}
		//$lamount = $calculateTotalLoanAndInterest-$emi;
		$interestPaymentMonth = $lamount*$mic;
		if(empty($CaluclatePreviousInterestPaymentMonth)){
		$CaluclatePreviousInterestPaymentMonth ='';
		}
		$CaluclatePreviousInterestPaymentMonth = $interestPaymentMonth+$CaluclatePreviousInterestPaymentMonth;
		$calculateTotalLoanAndInterest = $lamount+$interestPaymentMonth;
		$calculateTotalPrincipalAmount = $emi-$interestPaymentMonth;
		if(empty($calculatePreviousPayment)){
			$calculatePreviousPayment ='';
		}
		$calculatePreviousPayment = $calculateTotalPrincipalAmount+$calculatePreviousPayment;
		$calculateTotalPrincipalAmountMain = round($calculatePreviousPayment,2);
		
		$calculateTotalPrincipalAmountMainResult = get_val_by_number_format($calculateTotalPrincipalAmountMain,true);
		$calculateTotalPrincipalAmountMainResultVal = explodeMinusVal($calculateTotalPrincipalAmountMainResult);
		
		
		$ji++;
		if($ji==12){
		$ji=0;
		$calculateTotalPrincipalAmountMainResultValResult[] = $calculateTotalPrincipalAmountMain;
		$calculatePreviousPayment ='';
		$ck++;
		}
	}
	
	
	/* pt($calculateTotalPrincipalAmountMainResultValResult); */
	
	
	$calculateTotalPrincipalAmountMainCustom = array();
	
	for($ik=1;$ik<=$mortgageYearsMonths;$ik++){
	
		if(!empty($calculateTotalLoanAndInterestp)){
			$lamounts = $calculateTotalLoanAndInterestp-$emis;
		}
		$interestPaymentMonths = $lamounts*$mics;
		if(empty($CaluclatePreviousInterestPaymentMonths)){
			$CaluclatePreviousInterestPaymentMonths ='';
		}
		$CaluclatePreviousInterestPaymentMonths = $interestPaymentMonths+$CaluclatePreviousInterestPaymentMonths;
		$calculateTotalLoanAndInterestp = $lamounts+$interestPaymentMonths;
		$calculateTotalPrincipalAmounts = $emis-$interestPaymentMonths;
		if(empty($calculatePreviousPayments)){
			$calculatePreviousPayments ='';
		}
		$calculatePreviousPayments = $calculateTotalPrincipalAmounts+$calculatePreviousPayments;
		$calculateTotalPrincipalAmountMains = round($CaluclatePreviousInterestPaymentMonths,0);
		
		$k++;
		
		if($k==12){
		
			$k=0;
		
			$calculateTotalPrincipalAmountMainCustom[] = $calculateTotalPrincipalAmountMains;
			array_unshift($calculateTotalPrincipalAmountMainCustom,"");
			unset($calculateTotalPrincipalAmountMainCustom[0]);
		
			$CaluclatePreviousInterestPaymentMonths ='';
		}
	}
	
	
	$monthlyInsurance = $alldataRasult['exinsurance'];	
	$exOtherFixedXost = $alldataRasult['exotherfixed'];
	$exRepairs = $alldataRasult['exrepairs'];
	$exPropertyTaxes = $alldataRasult['expropertytaxes'];
	$annualOpratingResult = $annualOpratingExpences/100;
	$operatingExpensesIncreaseResult = $operatingExpensesIncrease/100;
	for($i=1;$i<=$mortgageYears;$i++){
		$downPayment = $alldataRasult['downpayment'];
		$purchasePrice = $alldataRasult['purchaseprice'];	
		$upfrontImprovement = $alldataRasult['upfrontimprovement'];
		$closingCost = $alldataRasult['closingcost'];
		$closingCostMain = $closingCost/100*$purchasePrice;
		$DownpaymentValue = $downPayment/100*$purchasePrice;
		
		$cashOutlay = $DownpaymentValue+$upfrontImprovement+$closingCostMain;
		$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
		$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
		$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		$calculateOperatingPropertyMgtFee = $totalCalculateOperatingPropertyMgtFeeYears;
		$calculateOperatingHOA = $totalCalculateOperatingHOAYears;
		$calculateOperatingOtherPercentileCost = $totalCalculateOperatingOtherPercentileCostYears;
		$calculateOperatingOtherFixedCost = $totalCalculateOperatingFixedCostYears;
		$calculateRevenueVacancyLoss = $totalCalculateRevenueVacanyLossYears;
		$calculateRevenueRentalIncome = $totalCalculateRevenueRentalIncomeYears;
		$calculateRentGrossIncome = $totalCalculateRevenueGrossIncomeYears;

		if(empty($calculateOperatingPropertyTaxes1Year)){
			$exPropertyTaxesResult = $exPropertyTaxes/100;
			$calculateOperatingPropertyTaxes1Year = round($exPropertyTaxesResult*$purchasePrice,0);
		}
		if(empty($calculateOperatingInsurance1Year)){
			$calculateOperatingInsurance1Year = round($monthlyInsurance*12,0);
		}
		if(empty($calculateOperatingRepairs1Year)){
			$exRepairsResult = $exRepairs/100;
			$calculateOperatingRepairs1Year = round($exRepairsResult*$calculateTotalRents,0);
		}
		if(empty($calculateOperatingUtilities1Year)){
			$exUtilitiesResult = $exUtilities * 12;
			$calculateOperatingUtilities1Year = round($exUtilitiesResult,2);
		}
		if(empty($calculateOperatingPropertyMgtFee)){
			$calculateOperatingPropertyMgtFee = round($monthlyRent*12,0);			
			$exPropertymgmtResult = $propertYmGmt/100;
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		}
		if(empty($calculateOperatingHOA)){
			$exHOAResult = $exHOA*12; 
			$calculateOperatingHOA = round($exHOAResult,0);
			$exPropertymgmtResult = $propertYmGmt/100;
			
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingHOA,0);
		}
		
		if(empty($calculateOperatingOtherPercentileCost)){
			$calculateOperatingOtherPercentileCost = round($monthlyRent*12,0);
			$exOtherResult = $exOther/100;
			$otherPercentile1stYear = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		}
		if(empty($calculateOperatingOtherFixedCost)){
			$exOtherFixedXostResult = $exOtherFixedXost*12;
		/* 	pt($exOtherFixedXostResult); */
			$calculateOperatingOtherFixedCost = round($exOtherFixedXostResult,2);
		}
		if(empty($calculateRevenueVacancyLoss)){
			$calculateRevenueVacancyLoss = round($monthlyRent*12,0);
		}
		if(empty($calculateRevenueRentalIncome)){
			$calculateRevenueRentalIncome = round($monthlyRent*12,0);
		}
		if(empty($calculateRentGrossIncome)){
			$calculateRentGrossIncome = round($monthlyRent*12,0);
		}
		
		/***************OperatingProprtyMgtFees**********/
		$annualRentIncreaseResult = $AnuualRentIncrease/100;
	
	
		$calculateOperatingPropertyMgtFeeInc = $calculateOperatingPropertyMgtFee*$annualRentIncreaseResult;
		
		$exPropertymgmtResult = $propertYmGmt/100;
	
		$totalCalculateOperatingPropertyMgtFeeYears = round($calculateOperatingPropertyMgtFee+$calculateOperatingPropertyMgtFeeInc,0);
		$totalCalculateOperatingPropertyMgtFeeYearsProperty = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		
		/***************OperatingHOA**********/
		
		/* pt($annualOpratingResult); */
		$calculateOperatingHOAInc = $calculateOperatingHOA*$annualOpratingResult;
		$totalCalculateOperatingHOAYears = round($calculateOperatingHOA+$calculateOperatingHOAInc,0);
		$totalCalculateOperatingHOAYearsHOA = round($calculateOperatingHOA,0);
		
		
		/***************OperatingOtherPercentileCost**********/
		$exOtherResult = $exOther/100;
		$calculateOperatingOtherPercentileCostInc = $calculateOperatingOtherPercentileCost*$annualRentIncreaseResult;
			
		$totalCalculateOperatingOtherPercentileCostYears = round($calculateOperatingOtherPercentileCost+$calculateOperatingOtherPercentileCostInc,0);
	
		$totalCalculateOperatingOtherPercentileCostYearsOPC = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		
		/***************RevenueVacancyLoss**********/
		$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
		$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
		$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
		/***************RevenueGrossIncome**********/
		$calculateRentGrossIncomeInc = $calculateRentGrossIncome*$annualRentIncreaseResult;
		
		$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
		$vacancyLoss = round($calculateRentGrossIncome*($vacancyRate/100),0);
		$totalCalculateRevenueGrossIncomeYearsGI = $calculateRentGrossIncome-$vacancyLoss;
		
		$interestRate= $alldataRasult['interestrate'];	
		$mortgageYears= $alldataRasult['mortgageyears'];
		$downPayment = $alldataRasult['downpayment'];	
		$purchasePrice = $alldataRasult['purchaseprice'];

		$mortgageYearsMonths = $mortgageYears*12;

		$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
		
		$PMTFixedMonthlyMultiply = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
		$PMTFixedMonthlyMultiply = $PMTFixedMonthlyMultiply*12;
		if($i==1){
		
		
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOIt = $calculateOperatingNOI-$PMTFixedMonthlyMultiply;
			
			
			
			
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOITT = $calculateOperatingNOI-$calculateTotalPrincipalAmountMainCustom[$i];
	
			
			$Netshell  = $calculateOperatingNOI-$calculateTotalPrincipalAmountMainCustom[$i]-$cashFlowTaxDepreciationYearly-$yearlyInsurance-$calculateOperatingRepairs1Year-$PropertyMgmtFee-$totalCalculateOperatingOtherPercentileCostYearsOPC;
			
			$TaxAbleIncome = $Netshell*$marginaltaxrateResult;
			if($TaxAbleIncome < 0){
				$TaxAbleIncome = 0;
			}
			
			$replaceNegativeVal = $calculateOperatingNOIt-$TaxAbleIncome+$calculateTotalPrincipalAmountMainResultValResult[$i-1];
			$replaceNegativeValsn = explodeMinusVal(get_val_by_number_format(round($replaceNegativeVal,0),true));
			
			/* After-Tax Cash Flow output for monthly */
			
			if(isset($totalROI) && $totalROI == 'totalROI' ){
				
				$totalROIresult = $replaceNegativeVal/$cashOutlay;
				
				$replaceNegativeValResult = round($totalROIresult*100,2);
				
				$replaceNegativeVal =  "<td class=''>$replaceNegativeValResult%</td>";
				
			}else if(isset($totalROI) && $totalROI == 'summry' ){
				
				$totalROIresult = $replaceNegativeVal/$cashOutlay;
				
				$replaceNegativeValResult = round($totalROIresult*100,2);
				
				$replaceNegativeVal =  $replaceNegativeValResult.'%';
				
			}else{
				
				$replaceNegativeValResult = get_val_by_number_format($replaceNegativeVal,true);
				
				$replaceNegativeVal =  "<td class=''>".explodeMinusVal($replaceNegativeValResult)."</td>";
				
			}
			if(isset($barchart) && $barchart != ''){
				$b = str_replace( ',', '', $replaceNegativeValResult );
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$b.'],';		
			}else{
			  $value .= $replaceNegativeVal;
			}
			
			
		}else{
			
			/***************OperatingPropertyTaxes**********/
			/* $annualOpratingResult = $annualOpratingExpences/100; */
					/* pt($annualOpratingResult); */
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingResult;
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
		/***************OperatingInsurance**********/
			$yearInsurance = $yearlyInsurance;
			$operatingExpensesIncrease = $annualOpratingExpences++; 
			$operatingExpensesIncreaseAddedtoYear = $yearlyInsurance*$operatingExpensesIncreaseResult;
			
			/* pt($annualOpratingResult); */
			
			$thisYearInsurance =  round($yearInsurance+$operatingExpensesIncreaseAddedtoYear,0);
			
			
			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$operatingExpensesIncreaseResult;
			/* $operatingExpensesIncrease */
		
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			
			/***************OperatingRepairs**********/
			$exOtherResult = $exOther/100;
	
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$exOtherResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			
			/***************OperatingUtilities**********/
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			
			
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			
			/***************OperatingOtherFixedCost**********/
			$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*$annualOpratingResult;
			
			$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
			$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
			
			$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
			
			$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
			$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
			
			/***************OperatingExpensesIncRevenueVacanyCalculations**********/
			$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
			
			$totalSumOfExpenses = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall+$thisYearInsurance;
			
			$totalCalculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$totalSumOfExpenses;
			
			/***************Other Percentile Cost**********/
			
			$calculateRentGrossIncomeInc = $calculateRentGrossIncome*$annualRentIncreaseResult;
			$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
			$OtherPercentileCost = round($totalCalculateRevenueGrossIncomeYears*$annualOpratingResult,0);
			
			
			
			$TotalTaxableIncome = $totalCalculateOperatingNOI-$calculateTotalPrincipalAmountMainCustom[$i]-$cashFlowTaxDepreciationYearly-$thisYearInsurance-$totalCalculateOperatingRepairsYears-$totalCalculateOperatingPropertyMgtFeeYearsProperty-$totalCalculateOperatingOtherPercentileCostYearsOPC;
			
		/* 	pt($calculateTotalPrincipalAmountMainCustom[$i]); */
			/*=======================================================================*/
			
			/***************OperatingPropertyTaxes**********/
			/* $annualOpratingResult = $annualOpratingExpences/100; */
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingResult;
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
			
			/***************OperatingInsurance**********/
			$yearInsurance = $yearlyInsurance;
			$operatingExpensesIncrease = $annualOpratingExpences++; 
			$operatingExpensesIncreaseAddedtoYear = $yearlyInsurance*$operatingExpensesIncreaseResult;
			
			$thisYearInsurance =  round($yearInsurance+$operatingExpensesIncreaseAddedtoYear,0);
			

			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$operatingExpensesIncreaseResult;
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			
			$thisYearInsurance =  round($yearInsurance+$operatingExpensesIncreaseAddedtoYear,0);
			
			/***************OperatingRepairs**********/
			$exOtherResult = $exOther/100;
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$exOtherResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			
			/***************OperatingUtilities**********/
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			
			/***************OperatingOtherFixedCost**********/
			$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*$annualOpratingResult;
			
			$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
			$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
			
			$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
			
			$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
			$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
			/***************OperatingExpensesIncRevenueVacanyCalculations**********/
			$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
			
			$totalCalculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$totalCalculateOperatingTotalExpensesCalculationSum;
			
			$totalCalculateOperatingNOIt = $totalCalculateOperatingNOI-$PMTFixedMonthlyMultiply;
			
			/* 	$totalCalculateRevenueGrossIncomeYearsGI */
			/* PT($totalCalculateRevenueGrossIncomeYearsGI); */
			/* pt(); */
			/* pt($TotalTaxableIncome); */
			
			$TaxAbleIncome = $TotalTaxableIncome*$marginaltaxrateResult;
			
			
			if($TaxAbleIncome < 0){
				
				$TotalTaxableIncomes = 0;
				
			}else{
				
				$TotalTaxableIncomes = $TaxAbleIncome;
				
			}
			
			
			$replaceNegativeValueResults = $totalCalculateOperatingNOIt - $TotalTaxableIncomes+$calculateTotalPrincipalAmountMainResultValResult[$i-1];
			
			$replaceNegativeValueResult = get_val_by_number_format($totalCalculateOperatingNOIt - $TotalTaxableIncomes+$calculateTotalPrincipalAmountMainResultValResult[$i-1],true);
			$replaceNegativeValueResultVal = explodeMinusVal($replaceNegativeValueResult);
			
			$replaceNegativeVals = $replaceNegativeValueResultVal;
			
			if(isset($totalROI) && $totalROI == 'totalROI' ){
				
				$totalROIresult = $replaceNegativeValueResults/$cashOutlay;
				
				$replaceNegativeValResult = round($totalROIresult*100,2);
				
				$replaceNegativeVal =   "<td class=''>".$replaceNegativeValResult."%</td>";
				

			}else if(isset($totalROI) && $totalROI == 'summry' ){
				
				$replaceNegativeVal = '';
				
			}else{
				
				$replaceNegativeValResult = get_val_by_number_format($replaceNegativeValueResults,true);
				$replaceNegativeVal =  "<td class=''>".explodeMinusVal($replaceNegativeValResult)."</td>";
				
			}
			if(isset($barchart) && $barchart != ''){
				$b = str_replace( ',', '', $replaceNegativeValueResults );
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$b.'],';		
			}else{
			  $value .= $replaceNegativeVal;
			}
		}
	}
return $value;	
	
}

			$i=1;
			foreach ($savedCalculation as $savedCalculate) {
				$ViewPageId = base64_encode($savedCalculate->id);						
				$Id = $savedCalculate->id;						
				$ViewpageLink = get_the_permalink('107')."?id=$ViewPageId";
				$EditLink = get_the_permalink('70')."?id=$ViewPageId&update=true";
				$userinput = unserialize($savedCalculate->userinput); 
				$alldataRasult = unserialize($savedCalculate->userinput); 
				global $wpdb;
				
				$originalDate = $savedCalculate->created_date;
				$newDate = date("m/d/y", strtotime($originalDate));
				echo '<tr>';
				echo '<td>'.$i.'</td>';
				echo '<td>'.$newDate.'</td>';
				echo '<td style="display:none;">'.$userinput['propertyName'].'</td>';
				echo '<td>'.$userinput['propertyAddress'].'</td>';
				echo '<td>$'.$userinput['purchaseprice'].'</td>';
				echo '<td>'.totalReturn('summry','','',$Id).'</td>';
				echo '<td><div class="action_wrapper"><a target="_blank" class="ViewPreSavedBox" href="'.$ViewpageLink.'" data-toggle="tooltip" title="View"/><img src="'.get_template_directory_uri().'/images/ViewIconp.png"></a><a target="_blank" class="ViewPreSavedBox" href="'.$EditLink.'" data-toggle="tooltip" title="Edit"/><img src="'.get_template_directory_uri().'/images/EditIconp.png"></a> <a class="DeletePreSavedBox" data_id="'.$ViewPageId.'" href="javascript:void(0);" data-toggle="tooltip" title="Delete"/><img src="'.get_template_directory_uri().'/images/DeleteIconp.png"></a></div></td>';
				echo '</tr>';
				 $i++;
			}
		
}
?>    	

</tbody> </table>
<div><div id="deleteMsg"></div></div>
			    </div>

			    <!--div class="PreMapBox"><img src="<?php //echo get_template_directory_uri(); ?>/images/mapImage.png"/></div-->

			</div>

		</div>

		</div>
	<?php /* } */ ?>
	

</div>



<style>

.tml .error {

  border: 0 none;

  background : 0 none;

}

p.error {

  background: #ffebe8 none repeat scroll 0 0 !important;

  color: red !important;

}

</style>



<script>



jQuery(document).ready(function() {

jQuery('.DeletePreSavedBox').click(function(){

    var x;

    if (confirm("Are you sure you want to delete this calculation") == true) {

	
    	var CalculateID = jQuery(this).attr('data_id')

    	var str = 'action=deleteUserSavedCalculations&CalculateID=' + CalculateID;

    	 jQuery.ajax({  

    	    context: this,      

            url: "<?php echo home_url();?>/wp-admin/admin-ajax.php",

            type: 'POST',             

            data: str,

            success: function(response) {

            jQuery('#deleteMsg').html('Your Calculation has been deleted');

            jQuery(this).closest('tr').hide(2000);

            }           

        });

    }

   

});

	



	

/* 	var description = "Please enter your description"; */

	var first_name = "Please enter your first name";

	var last_name = "Please enter your last name";

	var email = "Please enter your email address";

	var user_country = "Please enter your country name";

	var user_state = "Please enter your state name";

	var user_city = "Please enter your city name";

	

	jQuery('#theme-my-login #your-profile').validate({

		onfocusout: function(element) {

	this.element(element);

	//$(".pmpro_error").removeClass("pmpro_error"); 

	},

	rules: {

	/* description: {

	required: true,

	}, */

	first_name: {

	required: true,

	},

	last_name: {

	required: true,

	},

	email: {

	required: true,

	email: true

	},

	/* user_country: {

	required: true,

	},

	user_state: {

	required: true,

	},

	user_city: {

	required: true,

	}, */

	},

	

	messages: {

	description: description,

	first_name: first_name,

	last_name: last_name,

	email: email,

	user_country: user_country,

	user_state: user_state,

	user_city: user_city,

	},

	

	

	errorElement: "div",

	errorPlacement: function(error, element) 

	{

	element.after(error);

	}

	

	});

	

});



</script>

			  
<link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
jQuery(document).ready(function(){
    jQuery('#myTable').DataTable({
		"pagingType": "full_numbers",
		"language": {
			  "emptyTable": "Nothing saved yet"
			}
		}
		
	);	  

});
</script>
<script>
jQuery(document).ready(function(){
    jQuery('[data-toggle="tooltip"]').tooltip(); 
});
</script>