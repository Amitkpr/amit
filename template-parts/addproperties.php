<?php 
/* this file included in zillo-customform.php and action submit on zillo-customform.php file*/
global $current_user, $wpdb;
$role = user_role();
if($role == 'dataentry' || $role == 'administrator'){
	$disable = '';
}else{
	$disable = 'readonly';
}

$role = user_role();
$adminID = $current_user->ID;
$results = "SELECT * FROM wp_default_calculator";
$result = $wpdb->get_row($results);
$allvalues = unserialize($result->userinput);

?>
<form id="propertyfacts" method="POST" action="" enctype="multipart/form-data">
	<div class="row">				
		<!-- Begin Form container 1-->
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

			<div class="leftform_container">
				<div class="form_head" style="display:none">Correcting these home facts will likely affect your estimate.</div>
				<div class="form-group">
					<label class="formLabels" for="homeType">Type <a data-toggle="tooltip" title="Single Family, Condo, Town House, Multi Family, Apartment"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
					<select class="form-control" id="homeType" name="hometype">
						<option>Single Family</option>
						<option>Condo</option>
						<option>Townhouse</option>
						<option>Multi Family</option>
						<option>Apartment</option>
						<!-- <option>Mobile / Manufactured</option>
						<option>Coop Unit</option>
						<option>Vacant Land</option>
						<option>Other</option> -->
					</select>
				</div>

				<div class="form-group">
					<label class="formLabels" for="beds">Beds <a data-toggle="tooltip" title="Number of bedrooms"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
					<span class="valerror" style="display:none;"></span>
					<input type="tel" class="form-control" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)"  id="beds" placeholder="Number of Beds" name="beds" value="3" rel="3">
					<label id="beds-error" class="error" for="beds">
						<?php
						if($ErrorMesg == 'beds'){
							echo 'Please enter number of beds.';
						}
						?>
					</label>
				</div>

				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="fbaths">Baths <a data-toggle="tooltip" title="Number of bathrooms"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
							<span class="valerror" style="display:none;"></span>
							<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" class="form-control" id="fbaths" name="fbaths" value="2.5" rel="2.5">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="aby4baths">3/4 Baths</label>
							<span class="valerror" style="display:none;"></span>
							<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" class="form-control" id="aby4baths" name="aby4baths">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="bby2baths">1/2 Baths</label>
							<span class="valerror" style="display:none;"></span>
							<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" class="form-control" id="bby2baths" name="bby2baths">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="cby4baths">1/4 Baths</label>
							<span class="valerror" style="display:none;"></span>
							<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" class="form-control" id="cby4baths" name="cby4baths">
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="formLabels" for="finishedFeet">Finished square feet</label>
					<span class="valerror" style="display:none;"></span>
					<input type="tel" class="form-control" id="finishedFeet" name="finishedFeet">
					<label id="finishedFeet-error" class="error" for="finishedFeet"></label>
				</div>

				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label class="formLabels" for="12baths">Lot <a data-toggle="tooltip" title="Total lot area size in sqft"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group inner_form_group">
							<span class="valerror" style="display:none;"></span>
							<!--input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" class="form-control lotsize_acres" id="lotSize" name="lotSize" style="display:none;"-->
							<input type="tel" class="form-control lotsize_sqft" id="lotSize" name="lotSize" value="3055" rel="3055">
							<label id="lotSize-error" class="error" for="lotSize"></label>
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group inner_form_group">
							<select class="form-control" id="lotsizeunit" name="lotunits">
								<option value="Sq Ft">Sq Ft</option>
								<option value="Acres">Acres</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="yearBuilt">Year Built <a data-toggle="tooltip" title="Year unit was built"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
							<div class="input-group date" id="yearBuilt">
								<input type="text" class="form-control" name="yearBuilt" placeholder="Select Date" id="searchdate" value="1994" rel="1994">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>

					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="remodalyear">Structural remodel year</label>

							<div class="input-group date" id="remodalyear">
								<input type="text" class="form-control" name="remodal" placeholder="Select Date" id="searchdate">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>

						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="sold_date">Last Sold <a data-toggle="tooltip" title="Year unit was last sold"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>

							<div class="input-group date" id="sold_date">
								<input type="text" class="form-control" name="sold_date" placeholder="Select Date" id="searchdate" value="2017" rel="2017">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="rightform_container">	
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="ptitle">Property Title</label>
							<input type="text" class="required form-control" id="ptitle" name="ptitle">
						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="paddress">Address <a data-toggle="tooltip" title="Physical address of unit"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
							<input type="text" class="required form-control" id="paddress" name="paddress" placeholder="12909 Pegasus St, Austin, TX, 78727, USA">
							<input type="hidden" class="form-control" id="lat" name="lat">
							<input type="hidden" class="form-control" id="lng" name="lng">
						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="zipcode">Zipcode</label>
							<input type="tel" class="required form-control" id="zipcode" name="zipcode">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="city">City</label>
							<input type="text" class="required form-control" id="city" name="city">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="ZillowID">Zillow ID</label>
							<input type="tel" class="required form-control" id="ZillowID" name="ZillowID" value="83822632" rel="83822632">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="MLSID">MLS ID</label>
							<input type="text" class="required form-control" id="MLSID" name="MLSID" value="2515728" rel="2515728">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="12baths">Basement sq. ft.</label>
							<input type="tel" min="1" class="form-control" id="12baths" name="baseSqft">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="formLabels" for="14baths">Garage sq. ft.</label>
							<input type="tel" min="1" class="form-control" id="14baths" name="garageSqft">
						</div>
					</div>
				</div>

				<div class="form-group textarea_form-group">
					<label class="formLabels" for="homeType">Describe your home</label>
					<textarea rows="4" class="form-control" id="yourhome" name="descHome" style="resize: none;"></textarea>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h2 class="collapseButton">Additional information</h2>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group addInfoForm">
							<label class="formLabels" for="homeType">What I love about this home</label>
							<textarea rows="3" class="form-control" id="yourhome" name="addInfoHome" style="resize: none;"></textarea>
							<span class="mini_desc">Say what you love about it and what makes it unique, talk about the neighborhood and lifestyle it provides.</span>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="custom_separator"></div>

	<!--calculators fields starts here -->
	<div class="row">
		<a class="collapseButton maincalculateToggle" data-toggle="collapse" href="#maincalculate" aria-expanded="true">Financials<i class="fa fa-angle-down collapse-fa"></i></a>
		<div class="optionsinner_wrapper collapse in" id="maincalculate" aria-expanded="true" style="width: 100%;">
				
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="options_wrapper">
				<a class="collapseButton" data-toggle="collapse" href="#calculate" aria-expanded="true" style="display:none;">Calculations  <i class="fa fa-angle-down collapse-fa"></i></a>
				<div class="optionsinner_wrapper collapse in" id="calculate" aria-expanded="true" style="width: 100%;">

					<div class="options_container" id="calcu">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad-left">
								<!--  Begin Appliances Options class to add space from top 'COSTINPUTS'-->
								<a class="collapseButton" data-toggle="collapse" href="#COSTINPUTS" aria-expanded="true">Cost Inputs  <i class="fa fa-angle-down collapse-fa"></i></a>
								<div class="optionsinner_wrapper collapse in reduce_space" id="COSTINPUTS" aria-expanded="true" style="width: 100%;">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-pad common_responsive no-pad-left">
										<div class="form-group" style="position:relative;">
											<label class="formLabels" for="pprice">Price <a data-toggle="tooltip" title="Price of unit"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
											<input type="tel" class="required form-control" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" maxlength="10" id="pprice" name="pprice" style="padding-left:22px;">
											<div class="dollar_sign">$</div>
											<label id="pprice-error" class="error" for="pprice"></label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-right">
										<div class="form-group" style="position:relative;">
											<label class="formLabels" for="mortgageyears">Mortgage Years</label>
											<span class="valerror" style="display:none;"></span>
											<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> min="1" name="mortgageyears" id="mortgageyears" class="form-control compcalinput" rel="<?php echo $allvalues['mortgageyears']; ?>" max="30" maxlength="2" value="<?php echo $allvalues['mortgageyears']; ?>">
											<div class="percentage_sign">Yrs</div>
										</div>
									</div>
									<!--div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
										<div class="form-group" style="position:relative;">
											<label class="formLabels" for="hoadues">HOA dues<span> (per month)</span></label>
											<input type="tel" maxlength="10" class="required form-control" id="hoadues" name="hoadues" style="padding-left:22px;">
											<div class="dollar_sign">$</div>
										</div>
									</div-->
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-left">
										<div class="form-group" style="position:relative;">
											<label class="formLabels" for="upfrontimprovement">Upfront Improvement  <a data-toggle="tooltip" title="Money used to upgrade unit immediately after sale as a percentage of purchase price"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
											<span class="valerror" style="display:none;"></span>
											<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> class="required form-control comcalinput allow" maxlength="10" rel="<?php echo $allvalues['upfrontimprovement']; ?>" value="<?php echo $allvalues['upfrontimprovement']; ?>" id="upfrontimprovement" name="upfrontimprovement">
											<div class="dollar_sign">$</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-right">
										<div class="form-group" style="position:relative;">
											<label class="formLabels" for="closingcost">Closing Cost <a data-toggle="tooltip" title="Miscellaneous fees charged by those involved with the home sale as a percentage of the purchase price"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
											<span class="valerror" style="display:none;"></span>
											<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" name="closingcost" <?php echo $disable; ?> id="closingcost" class="form-control compcalinput" rel="<?php echo $allvalues['closingcost']; ?>" maxlength="5" value="<?php echo $allvalues['closingcost']; ?>" type="tel">

											<div class="percentage_sign">%</div>

										</div>
									</div>
								</div>	
								


							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad-right">
								<a class="collapseButton" data-toggle="collapse" href="#REVENUEINPUTS" aria-expanded="true">REVENUE INPUTS<i class="fa fa-angle-down collapse-fa"></i></a>
								<div class="optionsinner_wrapper collapse in reduce_space" id="REVENUEINPUTS" aria-expanded="true" style="width: 100%;">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-left">
										<div class="form-group" style="position:relative;">
											<label class="formLabels" for="monthlyrent">Monthly Rent <a data-toggle="tooltip" title="Rent amount collected per month"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
											<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" name="monthlyrent" <?php echo $disable; ?> maxlength="10" rel="<?php echo $allvalues['monthlyrent']; ?>" id="monthlyrent" type="tell" class="form-control comcalinput allow" value="<?php echo $allvalues['monthlyrent']; ?>">
											<div class="dollar_sign">$</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-right">
										<div class="form-group" style="position:relative;">
											<label class="formLabels" for="vacancyrate">Vacancy Rate <a data-toggle="tooltip" title="Percentage of time unit is vacant and not collecting rent"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
											<span class="valerror" style="display:none;"></span>
											<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" name="vacancyrate" <?php echo $disable; ?> id="vacancyrate" type="tell" rel="<?php echo $allvalues['vacancyrate']; ?>" class="form-control compcalinput" maxlength="5" value="<?php echo $allvalues['vacancyrate']; ?>">
											<div class="percentage_sign">%</div>
										</div>
									</div>
								</div>
								
								<a class="collapseButton" data-toggle="collapse" href="#FINANCINGINPUTS" aria-expanded="true">Financing Inputs<i class="fa fa-angle-down collapse-fa"></i></a>
								<div class="optionsinner_wrapper collapse in reduce_space" id="FINANCINGINPUTS" aria-expanded="true" style="width: 100%;">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-left">
										<div class="form-group" style="position:relative;">
											<label class="formLabels" for="downpayment">Downpayment <a data-toggle="tooltip" title="Amount of upfront money paid at closing expressed as a percentage of the purchase price"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
											<span class="valerror" style="display:none;"></span>
											<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> name="downpayment" id="downpayment" class="form-control compcalinput" maxlength="5" rel="<?php echo $allvalues['downpayment']; ?>" value="<?php echo $allvalues['downpayment']; ?>">
											<div class="percentage_sign">%</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-right">
										<div class="form-group" style="position:relative;">
											<label class="formLabels" for="interestrate">Interest Rate <a data-toggle="tooltip" title="Amount charged by a lender to a borrower for the use of assets expressed as a percentage of principal"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
											<span class="valerror" style="display:none;"></span>
											<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> name="interestrate" id="interestrate" class="form-control compcalinput" maxlength="5" rel="<?php echo $allvalues['interestrate']; ?>" value="<?php echo $allvalues['interestrate']; ?>">
											<div class="percentage_sign">%</div>
										</div>
									</div>									
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
								<a class="collapseButton" data-toggle="collapse" href="#ExpensesINPUTS" aria-expanded="true">Expenses Inputs<i class="fa fa-angle-down collapse-fa"></i></a>
								<div class="optionsinner_wrapper collapse in reduce_space" id="ExpensesINPUTS" aria-expanded="true" style="width: 100%;">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
										<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive no-pad-left">
											<div class="form-group" style="position:relative;">
												<label class="formLabels" for="expropertytaxes">Property Taxes <a data-toggle="tooltip" title="Tax rate levied by the governing authority of the jurisdiction in which the property is located"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
												<span class="valerror" style="display:none;"></span>
												<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> maxlength="5" class="form-control compcalinput" name="expropertytaxes" id="expropertytaxes" rel="<?php echo $allvalues['expropertytaxes']; ?>" value="<?php echo $allvalues['expropertytaxes']; ?>" type="tel">
												<div class="percentage_sign">%</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive custom-pad">
											<div class="form-group" style="position:relative;">
												<label class="formLabels" for="exinsurance">Insurance <a data-toggle="tooltip" title="Monthly amount paid to insure unit"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
												<span class="valerror" style="display:none;"></span>
												<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" id="exinsurance" <?php echo $disable; ?> maxlength="8" class="form-control comcalinput allow" rel="<?php echo $allvalues['exinsurance']; ?>" name="exinsurance" value="<?php echo $allvalues['exinsurance']; ?>" type="tel">
												<div class="dollar_sign">$</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive custom-pad">
											<div class="form-group" style="position:relative;">
												<label class="formLabels" for="exrepairs">Repairs <a data-toggle="tooltip" title="Estimated repair costs expressed as a percentage of rental income"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
												<span class="valerror" style="display:none;"></span>
												<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> maxlength="5" class="form-control compcalinput" name="exrepairs" id="exrepairs" rel="<?php echo $allvalues['exrepairs']; ?>" value="<?php echo $allvalues['exrepairs']; ?>">
												<div class="percentage_sign">%</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive no-pad-right">
											<div class="form-group" style="position:relative;">
												<label class="formLabels" for="exutilities">Utilities <a data-toggle="tooltip" title="Monthly amount paid by owner toward unitlites (water, gas, etc.)"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
												<span class="valerror" style="display:none;"></span>
												<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> id="exutilities" maxlength="8" class="form-control comcalinput allow" name="exutilities" rel="<?php echo $allvalues['exutilities']; ?>" value="<?php echo $allvalues['exutilities']; ?>">
												<div class="dollar_sign">$</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
										<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive no-pad-left">
											<div class="form-group" style="position:relative;">
												<label class="formLabels" for="expropertymgmt">Management Fee <a data-toggle="tooltip" title="Fee paid to management company expressed as a percentage of rental income"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
												<span class="valerror" style="display:none;"></span>
												<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> maxlength="5" class="form-control compcalinput" name="expropertymgmt" id="expropertymgmt" rel="<?php echo $allvalues['expropertymgmt']; ?>" value="<?php echo $allvalues['expropertymgmt']; ?>">
												<div class="percentage_sign">%</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive custom-pad">
											<div class="form-group" style="position:relative;">
												<label class="formLabels" for="exhoa">HOA <a data-toggle="tooltip" title="Home owners association monthly fee"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
												<span class="valerror" style="display:none;"></span>
												<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> id="exhoa" maxlength="8" class="form-control comcalinput allow" rel="<?php echo $allvalues['exhoa']; ?>" name="exhoa" value="<?php echo $allvalues['exhoa']; ?>">
												<div class="dollar_sign">$</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive custom-pad">
											<div class="form-group" style="position:relative;">
												<label class="formLabels" for="exother">Other Percentage Cost <a data-toggle="tooltip" title="Miscellaneous costs expressed as a percentage of rental income"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
												<span class="valerror" style="display:none;"></span>
												<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> maxlength="5" class="form-control compcalinput" id="exother" name="exother" rel="<?php echo $allvalues['exother']; ?>" value="<?php echo $allvalues['exother']; ?>">
												<div class="percentage_sign">%</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive no-pad-right">
											<div class="form-group" style="position:relative;">
												<label class="formLabels" for="exotherfixed">Other Fixed Cost <a data-toggle="tooltip" title="Miscellaneous flat costs"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
												<span class="valerror" style="display:none;"></span>
												<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> id="exotherfixed" maxlength="8" class="form-control comcalinput allow" name="exotherfixed" rel="<?php echo $allvalues['exotherfixed']; ?>" value="<?php echo $allvalues['exotherfixed']; ?>">
												<div class="dollar_sign">$</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
								<a class="collapseButton" data-toggle="collapse" href="#TAXINPUTS" aria-expanded="true">Tax Inputs<i class="fa fa-angle-down collapse-fa"></i></a>
								<div class="optionsinner_wrapper collapse in reduce_space" id="TAXINPUTS" aria-expanded="true" style="width: 100%;"> 
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad-left">
										<div class="form-group" style="position:relative;">
											<label class="formLabels" for="marginaltaxrate">Marginal Tax Rate <a data-toggle="tooltip" title="Percentage of tax applied to income for each tax bracket in which one qualifies"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
											<span class="valerror" style="display:none;"></span>
											<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" name="marginaltaxrate" <?php echo $disable; ?>  rel="<?php echo $allvalues['marginaltaxrate']; ?>" id="marginaltaxrate" type="tel" class="form-control compcalinput" maxlength="5" value="<?php echo $allvalues['marginaltaxrate']; ?>" >
											<div class="percentage_sign">%</div>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad-left">
										<div class="form-group" style="position:relative;">
											<label class="formLabels" for="amortizationperiodyears">Amortization Years <a data-toggle="tooltip" title="Amount of years the IRS considers to be the useful life of a rental property"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
											<span class="valerror" style="display:none;"></span>
											<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> name="amortizationperiodyears" id="amortizationperiodyears" type="tel" class="form-control compcalinput" rel="<?php echo $allvalues['amortizationperiodyears']; ?>" value="<?php echo $allvalues['amortizationperiodyears']; ?>">
											<div class="percentage_sign">Yrs</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
								<a class="collapseButton" data-toggle="collapse" href="#ANNUALGROWTHINPUTS" aria-expanded="true">Annual Growth Input<i class="fa fa-angle-down collapse-fa"></i></a>
								<div class="optionsinner_wrapper collapse in reduce_space" id="ANNUALGROWTHINPUTS" aria-expanded="true" style="width: 100%;">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive custom-pad">
										<div class="form-group" style="position:relative;">
											<label class="formLabels" for="marginaltaxrate">Appreciation <a data-toggle="tooltip" title="Estimated year over year percentile appreciation of home value"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
											<span class="valerror" style="display:none;"></span>
											<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> type="tel" maxlength="5" class="form-control compcalinput" name="annualappreciation" id="annualappreciation" rel="<?php echo $allvalues['annualappreciation']; ?>" value="<?php echo $allvalues['annualappreciation']; ?>">
											<div class="percentage_sign">%</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-right">
										<div class="form-group" style="position:relative;">
											<label class="formLabels" for="annualrentincrease">Rent Increase <a data-toggle="tooltip" title="Estimated year over year percentile rent increase"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
											<span class="valerror" style="display:none;"></span>
											<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> type="tel" maxlength="5" class="form-control compcalinput" name="annualrentincrease" id="annualrentincrease" rel="<?php echo $allvalues['annualrentincrease']; ?>" value="<?php echo $allvalues['annualrentincrease']; ?>">
											<div class="percentage_sign">%</div>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad-right">
										<div class="form-group" style="position:relative;">
											<label class="formLabels" for="annualoprating">Operating Expense Increase <a data-toggle="tooltip" title="Estimated year over year percentile expense increase"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
											<span class="valerror" style="display:none;"></span>
											<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> type="tel" class="form-control compcalinput" name="annualoprating" id="annualoprating" rel="<?php echo $allvalues['annualoprating']; ?>" value="<?php echo $allvalues['annualoprating']; ?>">
											<div class="percentage_sign">%</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
								<a class="collapseButton" data-toggle="collapse" href="#SELLINPUTS" aria-expanded="true">Sell Inputs<i class="fa fa-angle-down collapse-fa"></i></a>
								<div class="optionsinner_wrapper collapse in reduce_space" id="SELLINPUTS" aria-expanded="true" style="width: 100%;">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 no-pad-left">
											<div class="form-group" style="position:relative;">
												<label class="formLabels" for="sellholdingperiod">Holding Period (Years)</label>
												<span class="valerror" style="display:none;"></span>
												<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> type="tel" class="form-control compcalinput" id="sellholdingperiod" name="sellholdingperiod" rel="<?php echo $allvalues['sellholdingperiod']; ?>" value="<?php echo $allvalues['sellholdingperiod']; ?>">
												<div class="percentage_sign">Yrs</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 custom-pad">
											<div class="form-group" style="position:relative;">
												<label class="formLabels" for="selltransactioncost">Selling Transaction Cost <a data-toggle="tooltip" title="Total cost to close transaction expressed as a percentage of the selling price"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
												<span class="valerror" style="display:none;"></span>
												<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> type="tel" maxlength="5" class="form-control compcalinput" name="selltransactioncost" id="selltransactioncost" rel="<?php echo $allvalues['selltransactioncost']; ?>" value="<?php echo $allvalues['selltransactioncost']; ?>">
												<div class="percentage_sign">%</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 no-pad-right">
											<div class="form-group" style="position:relative;">
												<label class="formLabels" for="sellcapitalgain">Capital Gains Tax Rate <a data-toggle="tooltip" title="Long-term capital gain tax rate for profits in selling the unit"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
												<span class="valerror" style="display:none;"></span>
												<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> type="tel" maxlength="5" class="form-control compcalinput" name="sellcapitalgain" id="sellcapitalgain" rel="<?php echo $allvalues['sellcapitalgain']; ?>" value="<?php echo $allvalues['sellcapitalgain']; ?>">
												<div class="percentage_sign">%</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad-left">
											<div class="form-group" style="position:relative;">
												<label class="formLabels" for="selldepreciationrecap">Depreciation Recap Rate <a data-toggle="tooltip" title="Tax rate on the profits from the sale after taking deductions for depreciation"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
												<span class="valerror" style="display:none;"></span>
												<input <?php echo $disable; ?> onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)"  type="tel" maxlength="5" class="form-control compcalinput" name="selldepreciationrecap" rel="<?php echo $allvalues['selldepreciationrecap']; ?>" id="selldepreciationrecap" value="<?php echo $allvalues['selldepreciationrecap']; ?>">
												<div class="percentage_sign">%</div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad-right">
											<div class="form-group" style="position:relative;">
												<label class="formLabels" for="sellstatetax">State Tax <a data-toggle="tooltip" title="Tax rate collected by the state from the profits of the home sale"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
												<span class="valerror" style="display:none;"></span>
												<input <?php echo $disable; ?> onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)"  type="tel" maxlength="5" class="form-control compcalinput" name="sellstatetax" id="sellstatetax" rel="<?php echo $allvalues['sellstatetax']; ?>" value="<?php echo $allvalues['sellstatetax']; ?>">
												<div class="percentage_sign">%</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<!--calculators fields ends here -->
	<!--End Form Container1 -->
	

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="options_wrapper">
				<a class="collapseButton" data-toggle="collapse" href="#optionswrapper">Room Details  <i class="fa fa-angle-down collapse-fa"></i></a>
				<div class="optionsinner_wrapper collapse in" id="optionswrapper">
					<!-- Begin Appliances Options -->
					<div class="options_container" id="appliances">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
							APPLIANCES
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="appliances[1]" value="Dishwasher" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Dishwasher</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="appliances[2]" value="Dryer" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Dryer</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="appliances[3]" value="Freezer" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Freezer</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="appliances[4]" value="Garbage Disposal" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Garbage Disposal</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="appliances[5]" value="Microwave" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Microwave</span>
									</label>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="appliances[6]" value="Range/Oven" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Range / Oven</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="appliances[7]" value="Refrigerator" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Refrigerator</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="appliances[8]" value="Trash Compactor" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Trash Compactor</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="appliances[9]" value="Washer" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Washer</span>
									</label>
								</div>
							</div>
						</div>
					</div>
					<!-- Appliances Options End-->

					<!-- Begin Basement Options -->
					<div class="options_container" id="basement">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
							BASEMENT
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
							<div class="form-group">
								<div class=" custom_radio">
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="radio" name="basement" value="Finished" class="">
											<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
											<span class="cstmLabelText">Finished</span>
										</label>
									</div>
								</div>
								<div class=" custom_radio">
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="radio" name="basement" value="Unfinished" class="">
											<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
											<span class="cstmLabelText">Unfinished</span>
										</label>
									</div>
								</div>
								<div class=" custom_radio">
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="radio" name="basement" value="Partially Finished" class="">
											<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
											<span class="cstmLabelText">Partially Finished</span>
										</label>
									</div>
								</div>
								<div class=" custom_radio">
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="radio" name="basement" value="None" class="">
											<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
											<span class="cstmLabelText">None</span>
										</label>
									</div>
								</div>
							</div>									
						</div>
					</div>
					<!-- Basement Options End -->

					<!-- Begin Floor Covering Options -->
					<div class="options_container" id="floorcover">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
							FLOOR COVERING
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="floorcover[1]" value="Carpet" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Carpet</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="floorcover[2]" value="Concrete" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Concrete</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="floorcover[3]" value="Hardwood" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Hardwood</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="floorcover[4]" value="Laminate" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Laminate</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="floorcover[5]" value="Linoleum/Vinyl" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Linoleum / Vinyl</span>
									</label>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="floorcover[6]" value="Slate" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Slate</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="floorcover[7]" value="Softwood" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Softwood</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="floorcover[8]" value="Tile" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Tile</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="floorcover[9]" value="Other" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Other</span>
									</label>
								</div>
							</div>
						</div>
					</div>
					<!-- End Floor Covering Options -->

					<!-- Begin Rooms Options -->
					<div class="options_container" id="roomoptions">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
							Rooms
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="rooms[1]" value="Breakfast Nook" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Breakfast Nook</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="rooms[2]" value="Dining Room" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Dining Room</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="rooms[3]" value="Family Room" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Family Room</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="rooms[4]" value="Laundry Room" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Laundry Room</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="rooms[5]" value="Library" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Library</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="rooms[6]" value="Master Bath" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Master Bath</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="rooms[7]" value="Mud Room" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Mud Room</span>
									</label>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="rooms[8]" value="Office" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Office</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="rooms[9]" value="Pantry" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Pantry</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="rooms[10]" value="Recreation room" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Recreation room</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="rooms[11]" value="Workshop" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Workshop</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="rooms[12]" value="SolariumAtrium" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Solarium / Atrium</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="rooms[13]" value="Sun Room" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Sun Room</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="rooms[14]" value="Walkincloset" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Walk-in closet</span>
									</label>
								</div>
							</div>
						</div>
					</div>
					<!-- End Rooms Options -->

					<!-- Total rooms section -->
					<div class="options_container" id="roomoptions">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
							Total rooms
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad facts_category">
							<input type="number" min="1" name="totalrooms" class="form-control" id="totalrooms">
						</div>
					</div>
					<!-- End total rooms section -->


				</div>
			</div>
		</div>
		<!-- End Left Options -->

		<!-- Begin Right Options -->
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="options_wrapper">
				<a class="collapseButton" data-toggle="collapse" href="#optionswrapper2">Utility Details  <i class="fa fa-angle-down collapse-fa"></i></a>
				<div class="optionsinner_wrapper collapse in" id="optionswrapper2">
					<!-- Begin Cooling type Options -->
					<div class="options_container" id="coolingType">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
							COOLING TYPE
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="cooling_type[1]" value="Central" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Central</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="cooling_type[2]" value="Evaporative" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Evaporative</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="cooling_type[3]" value="Geothermal" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Geothermal</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="cooling_type[4]" value="Refrigeration" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Refrigeration</span>
									</label>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="cooling_type[5]" value="Solar" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Solar</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="cooling_type[6]" value="Wall" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Wall</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="cooling_type[7]" value="Other" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Other</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="cooling_type[8]" value="None" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">None</span>
									</label>
								</div>
							</div>
						</div>
					</div>
					<!-- Cooling Options End-->

					<!-- Begin Heating type Options -->
					<div class="options_container" id="heatingtype">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
							Heating type
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_type[1]" value="Baseboard" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Baseboard</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_type[2]" value="ForcedAir" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Forced Air</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_type[3]" value="Geothermal" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Geothermal</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_type[4]" value="Heat pump" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Heat pump</span>
									</label>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_type[5]" value="Radiant" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Radiant</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_type[6]" value="Stove" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Stove</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_type[7]" value="Wall" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Wall</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_type[8]" value="Other" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Other</span>
									</label>
								</div>
							</div>
						</div>
					</div>
					<!-- End Heating type Options -->

					<!-- Begin Heating Fuel Options -->
					<div class="options_container" id="heatingFuel">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
							Heating Fuel
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_fuel[1]" value="Coal" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Coal</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_fuel[2]" value="Electric" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Electric</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_fuel[3]" value="Gas" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Gas</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_fuel[4]" value="Oil" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Oil</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_fuel[5]" value="PropaneButane" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Propane / Butane</span>
									</label>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_fuel[6]" value="Solar" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Solar</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_fuel[7]" value="WoodPellet" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Wood / Pellet</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_fuel[8]" value="Other" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Other</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="heating_fuel[9]" value="None" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">None</span>
									</label>
								</div>
							</div>
						</div>
					</div>
					<!-- End Heating fuel Options -->

					<!-- Begin Indoor features options -->
					<div class="options_container" id="roomoptions">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
							Indoor features
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="Indoor[1]" value="Attic" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Attic</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="Indoor[2]" value="Cable ready" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Cable ready</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="Indoor[3]" value="Ceiling Fans" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Ceiling Fans</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="Indoor[4]" value="Doublepanestorm" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Double pane/storm windows</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="Indoor[5]" value="Fireplace" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Fireplace</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="Indoor[6]" value="Intercom System" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Intercom System</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="Indoor[7]" value="JettedTub" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Jetted Tub</span>
									</label>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="Indoor[8]" value="Motherinlawapartment" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Mother-in-law apartment</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="Indoor[9]" value="SecuritySystem" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Security System</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="Indoor[10]" value="Skylights" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Skylights</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="Indoor[11]" value="Vaultedceiling" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Vaulted ceiling</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="Indoor[12]" value="WetBar" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Wet Bar</span>
									</label>
								</div>
							</div>
							<div class="form-group custom_chbox">	
								<div class="radio rd2">
									<label style="font-size:14px;">
										<input type="checkbox" name="Indoor[13]" value="Wired" class="">
										<span class="cr"><i class="cr-icon fa fa-check"></i></span>
										<span class="cstmLabelText">Wired</span>
									</label>
								</div>
							</div>
						</div>
					</div>
					<!-- End Indoor Features options -->

				</div>
			</div>

		</div>
		<!--button type="submit">Submit</button-->
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="options_wrapper">
				<a class="collapseButton" data-toggle="collapse" href="#buildingdetails">Building Details<i class="fa fa-angle-down collapse-fa"></i></a>
				<div class="optionsinner_wrapper collapse in" id="buildingdetails">
					<!-- Begin building amenities Options -->
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="options_container" id="buildingamenities">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
								Building Amenities
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="building_amenities[1]" value="Assistedlivingcommunity" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Assisted living community</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="building_amenities[2]" value="BasketballCourt" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Basketball Court</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="building_amenities[3]" value="Controlled Access" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Controlled Access</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="building_amenities[4]" value="Disabled Access" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Disabled Access</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="building_amenities[5]" value="Doorman" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Doorman</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="building_amenities[6]" value="Elevator" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Elevator</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="building_amenities[7]" value="Fitness center" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Fitness center</span>
										</label>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="building_amenities[8]" value="Gated Entry" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Gated Entry</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="building_amenities[9]" value="Near Transportation" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Near Transportation</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="building_amenities[10]" value="true" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Over 55+ active community</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="building_amenities[11]" value="Sports Court" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Sports Court</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="building_amenities[12]" value="Storage" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Storage</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="building_amenities[13]" value="TennisCourt" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Tennis Court</span>
										</label>
									</div>
								</div>
							</div>
						</div>


						<!-- Building Amenities Options End-->

						<!-- Begin Architectural Options -->
						<div class="options_container" id="architecturalstyle">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
								ARCHITECTURAL STYLE
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
								<div class="form-group">
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="Bungalow" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Bungalow</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="Modern" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Modern</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="Cape Cod" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Cape Cod</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="QueenAnne/Victorian" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Queen Anne / Victorian</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="Colonial" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Colonial</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="Ranch/Rambler" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Ranch / Rambler</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="Contemporary" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Contemporary</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="Santa Fe/Pueblo" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Santa Fe / Pueblo Style</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="Craftsmen" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Craftsman</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="Spanish" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Spanish</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="French" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">French</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="Split Level" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Split Level</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="Georgian" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Georgian</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="Tudor" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Tudor</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="Loft" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Loft</span>
											</label>
										</div>
									</div>
									<div class=" custom_radio">
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="radio" name="architectural_style" value="Other" class="">
												<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
												<span class="cstmLabelText">Other</span>
											</label>
										</div>
									</div>
								</div>									
							</div>
						</div>
						<!-- Architectural Options End -->

						<!-- Begin Exterior Options -->
						<div class="options_container" id="exterior">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
								Exterior
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="exterior[1]" value="Brick" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Brick</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="exterior[2]" value="Cement/Concrete" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Cement/Concrete</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="exterior[3]" value="Composition" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Composition</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="exterior[4]" value="Metal" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Metal</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="exterior[5]" value="Shingle" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Shingle</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="exterior[6]" value="Stone" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Stone</span>
										</label>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="exterior[7]" value="Stucco" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Stucco</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="exterior[8]" value="Vinyl" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Vinyl</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="exterior[9]" value="Wood" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Wood</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="exterior[10]" value="Wood Products" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Wood Products</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="exterior[11]" value="Other" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Other</span>
										</label>
									</div>
								</div>
							</div>
						</div>
						<!-- End Floor Covering Options -->


					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad ">
						<!-- Begin Outdoor aminities Options -->
						<div class="options_container" id="outdoor">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
								OUTDOOR AMENITIES
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[1]" value="Balcony/Patio" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Balcony/Patio</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[2]" value="Barbecue area" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Barbecue area</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[3]" value="Deck" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Deck</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[4]" value="Dock" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Dock</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[5]" value="Fenced Yard" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Fenced Yard</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[6]" value="Garden" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Garden</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[7]" value="Greenhouse" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Greenhouse</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[8]" value="Hot tub/spa" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Hot tub/spa</span>
										</label>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[9]" value="Lawn" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Lawn</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[10]" value="Pond" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Pond</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[11]" value="Pool" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Pool</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[12]" value="Porch" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Porch</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[13]" value="RV Parking" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">RV Parking</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[14]" value="Sauna" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Sauna</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[15]" value="Sprinkler system" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Sprinkler system</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="outdoor_amenittes[16]" value="Waterfront" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Waterfront</span>
										</label>
									</div>
								</div>
							</div>
						</div>
						<!-- End Outdoor amenities Options -->

						<!-- Numer of Stories section -->
						<div class="options_container" id="roomoptions">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
								# of Stories
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad facts_category">
								<input type="number" min="1" class="form-control" id="storiesCount" name="StoriesCount">
							</div>
						</div>
						<!-- End number of stories section -->

						<!-- Begin Parking options -->
						<div class="options_container" id="parking">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
								Parking
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="parking[1]" value="Carport" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Carport</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="parking[2]" value="GarageAttached" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Garage - Attached</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="parking[3]" value="GarageDeatached" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Garage - Deatached</span>
										</label>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="parking[4]" value="OffStreet" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Off - Street</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="parking[5]" value="OnStreet" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">On - Street</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="parking[6]" value="None" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">None</span>
										</label>
									</div>
								</div>
							</div>
						</div>
						<!-- End Parking options -->

						<!-- Covered Parking section -->
						<div class="options_container" id="roomoptions">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
								# Covered parking 
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad facts_category">
								<input type="number" min="1" class="form-control" id="coveredPark" name="CoveredParking">
							</div>
						</div>
						<!-- End of Covered Parking  -->

						<!-- Begin Roof options -->
						<div class="options_container" id="roofOptions">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
								Roof
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="roof[1]" value="Asphalt" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Asphalt</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="roof[2]" value="Builtup" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Built - up</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="roof[3]" value="Composition" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Composition</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="roof[4]" value="Metal" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Metal</span>
										</label>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="roof[5]" value="ShakeShingle" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Shake / Shingle</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="roof[6]" value="Slate" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Slate</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="roof[7]" value="Tile" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Tile</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="roof[8]" value="Other" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Other</span>
										</label>
									</div>
								</div>
							</div>
						</div>
						<!-- End Roof options -->

						<!-- Begin View options -->
						<div class="options_container" id="viewOptions">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
								View
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="view[1]" value="City" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">City</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="view[2]" value="Mountain" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Mountain</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="view[3]" value="Park" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Park</span>
										</label>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="view[4]" value="Territorial" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Territorial</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="view[5]" value="Water" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">Water</span>
										</label>
									</div>
								</div>
								<div class="form-group custom_chbox">	
									<div class="radio rd2">
										<label style="font-size:14px;">
											<input type="checkbox" name="view[6]" value="None" class="">
											<span class="cr"><i class="cr-icon fa fa-check"></i></span>
											<span class="cstmLabelText">None</span>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Roof options -->
				</div>
			</div>
		</div>
	</div>
	<div class="custom_separator"></div>

	<div class="row">
		<div id="uploaderNewWrap" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h2 class="facts_headingsmall">Photos & media</h2>
						<!--div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 upload_left_sec">
							<span class="uploadPhotos uploadPic" style="cursor:pointer;display: block;height: 38px;padding-top: 6px;width: 124px;">Upload Photos</span>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 upload_right_sec">
							<img src="<?php /* echo get_template_directory_uri(); */ ?>/images/uploading_icon.png">
						</div-->
						<div id="addpropertyFile" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0">
							<input type="hidden" id="appendfiles" name="files_append" value="null">
							<input type="file" name="files">
						</div>
						<!--input type="file" name="homeImages[]" id="homeImages" multiple="multiple" style="visibility:hidden;width:0px;height:0px;"-->
					</div>
				</div>
				
				<!-- Image upload section -->
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<ul id="thumb-output-agentLogo" class="imageUpload"></ul>
					</div>
				</div>
				<div class="custom_separator"></div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 formButtonContainer">
						<button type="submit" class="uploadPhotos" value="savechanges" name="savechanges"><i class="fa fa-check-circle" ></i> Save </button>
						<button class="cancelPhotos"><i class="fa fa-times-circle"></i> Cancel</button>
					</div>
				</div>

				<!-- End Image upload section -->
			</form>
