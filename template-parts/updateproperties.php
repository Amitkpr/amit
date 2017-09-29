<?php

global $wpdb,$current_user, $wp_session;
$role = user_role();
if($role == 'dataentry' || $role == 'administrator'){
	$disable = '';
}else{
	$disable = 'readonly';
}
if(isset($_POST['updatechanges']) && $_POST['updatechanges'] == 'updatechanges'){


	$PostArr = [];
	session_start();
	
	$userID = $current_user->ID;
	$pUserID = $current_user->ID;
	
	if($role == 'dataentry' || $role == 'administrator'){
		$disable = '';
	}else{
		$disable = 'readonly';
	}

	$propertyID = $_GET['id'];
	
	$checkAddress = $_POST['paddress'];
	$checklat = $_POST['lat'];
	$checklng = $_POST['lng'];
	
	/* $checkQuery = "select lat,lng,paddress,zipcode from wp_home_facts where paddress = '".$checkAddress."' and lat = $checklat and lng = $checklng";
	$addressExist = $wpdb->get_results($checkQuery); */
	/* if($addressExist){ wp_redirect(get_the_permalink().'/?tag=updateproperty&adau=exist'); }else{ */
	
	/* if(empty($_POST['hometype'])){
		
		$ErrorMesg = "Home type is required!";
	
	}elseif(empty($_POST['beds']) ){
		
		$ErrorMesg = "Number of beds is required!";
	
	}elseif( empty($_POST['finishedFeet']) ){
		$ErrorMesg = "Finished square feet is required!";
		
	}elseif( empty($_POST['lotSize']) ){
		$ErrorMesg = "Lot size is required!";
		
	}else{ */
		
		/* pt($_POST['appliances']);
		die; */
		
		$role = user_role();
		$adminID = $current_user->ID;
		$results = "SELECT * FROM wp_default_calculator";
		$result = $wpdb->get_row($results);
		$allvalues = unserialize($result->userinput);
		
		$filesn = explode(',',$_POST['files_append']);
		$newImage = array();	
		foreach($filesn as $filen){
			if($filen != '' && $filen != 'null'){
				$newImage[] = $filen;	
			}
		}
				
		
		$PostArr['user_id'] 				= $userID;
		$PostArr['home_type'] 				= $_POST['hometype'];
		$PostArr['images'] 					=  serialize($newImage);
		
		$PostArr['ptitle'] 					= $_POST['ptitle'];
		$PostArr['paddress'] 				= $_POST['paddress'];
		$PostArr['lat'] 					= $_POST['lat'];
		$PostArr['lng'] 					= $_POST['lng'];
		$PostArr['zipcode'] 				= $_POST['zipcode'];
		$PostArr['city'] 					= $_POST['city'];
		$PostArr['pprice'] 					= str_replace(',','',$_POST['pprice']);
		
		$PostArr['beds'] 	 				= $_POST['beds'];
		$PostArr['full_baths'] 				= $_POST['fbaths'];
		$PostArr['aby4baths'] 				= $_POST['aby4baths'];
		$PostArr['bby2baths'] 				= $_POST['bby2baths'];
		$PostArr['cby4baths'] 				= $_POST['cby4baths'];
		$PostArr['finished_feet'] 			= $_POST['finishedFeet'];
		$PostArr['lot_sze'] 				= $_POST['lotSize'];
		$PostArr['lot_units'] 				= $_POST['lotunits'];
		$PostArr['year_built'] 				= $_POST['yearBuilt'];
		$PostArr['remodal'] 				= $_POST['remodal'];
		$PostArr['sold_date'] 				= $_POST['sold_date'];
		$PostArr['hoadues'] 				= str_replace(',','',$_POST['hoadues']);
		$PostArr['base_sqft'] 				= $_POST['baseSqft'];
		$PostArr['garage_sqft'] 			= $_POST['garageSqft'];
		$PostArr['home_description'] 		= $_POST['descHome'];
		$PostArr['ZillowID'] = $_POST['ZillowID'];
        $PostArr['MLSID']    = $_POST['MLSID'];
		
		if($_POST['zipcode'] != $_POST['zipcode_old']){
			$PostArr['TRETID']   = $_POST['zipcode'] . rand(10000, 99999);
		}
		
				
if($role == 'dataentry' || $role == 'administrator'){
	/*Calcluation Fields start here*/
		$PostArr['upfrontimprovement']      = str_replace(',','',$_POST['upfrontimprovement']);
		$PostArr['closingcost']      		= $_POST['closingcost'];
		$PostArr['downpayment']      		= $_POST['downpayment'];
		$PostArr['interestrate']      		= $_POST['interestrate'];
		$PostArr['mortgageyears']      		= $_POST['mortgageyears'];
		$PostArr['monthlyrent']      		= str_replace(',','',$_POST['monthlyrent']);
		$PostArr['vacancyrate']      		= $_POST['vacancyrate'];
		$PostArr['expropertytaxes']      	= $_POST['expropertytaxes'];
		$PostArr['exinsurance']      		= str_replace(',','',$_POST['exinsurance']);
		$PostArr['exrepairs']      			= $_POST['exrepairs'];
		$PostArr['exutilities']      		= str_replace(',','',$_POST['exutilities']);
		$PostArr['expropertymgmt']      	= $_POST['expropertymgmt'];
		$PostArr['exhoa']      				= str_replace(',','',$_POST['exhoa']);
		$PostArr['exother']      			= $_POST['exother'];
		$PostArr['exotherfixed']      		= str_replace(',','',$_POST['exotherfixed']);
		$PostArr['marginaltaxrate']      	= $_POST['marginaltaxrate'];
		$PostArr['annualappreciation']      = $_POST['annualappreciation'];
		$PostArr['amortizationperiodyears'] = $_POST['amortizationperiodyears'];
		$PostArr['selltransactioncost']     = $_POST['selltransactioncost'];
		$PostArr['annualrentincrease']      = $_POST['annualrentincrease'];
		$PostArr['sellholdingperiod']      	= $_POST['sellholdingperiod'];
		$PostArr['sellcapitalgain']      	= $_POST['sellcapitalgain'];
		$PostArr['annualoprating']      	= $_POST['annualoprating'];
		$PostArr['sellstatetax']      		= $_POST['sellstatetax'];
		$PostArr['selldepreciationrecap']   = $_POST['selldepreciationrecap'];
		
		
		/*Calcluation Fields end here*/
		
		
}else{
	
	/*Calcluation Fields start here*/
		$PostArr['upfrontimprovement']      = str_replace(',','',$allvalues['upfrontimprovement']); 
		$PostArr['closingcost']      		= $allvalues['closingcost'];
		$PostArr['downpayment']      		= $allvalues['downpayment'];
		$PostArr['interestrate']      		= $allvalues['interestrate'];
		$PostArr['mortgageyears']      		= $allvalues['mortgageyears'];
		$PostArr['monthlyrent']      		= str_replace(',','',$allvalues['monthlyrent']);
		$PostArr['vacancyrate']      		= $allvalues['vacancyrate'];
		$PostArr['expropertytaxes']      	= $allvalues['expropertytaxes'];
		$PostArr['exinsurance']      		= str_replace(',','',$allvalues['exinsurance']);
		$PostArr['exrepairs']      			= $allvalues['exrepairs'];
		$PostArr['exutilities']      		= str_replace(',','',$allvalues['exutilities']);
		$PostArr['expropertymgmt']      	= $allvalues['expropertymgmt'];
		$PostArr['exhoa']      				= str_replace(',','',$allvalues['exhoa']);
		$PostArr['exother']      			= $allvalues['exother'];
		$PostArr['exotherfixed']      		= str_replace(',','',$allvalues['exotherfixed']);
		$PostArr['marginaltaxrate']      	= $allvalues['marginaltaxrate'];
		$PostArr['annualappreciation']      = $allvalues['annualappreciation'];
		$PostArr['amortizationperiodyears'] = $allvalues['amortizationperiodyears'];
		$PostArr['selltransactioncost']     = $allvalues['selltransactioncost'];
		$PostArr['annualrentincrease']      = $allvalues['annualrentincrease'];
		$PostArr['sellholdingperiod']      	= $allvalues['sellholdingperiod'];
		$PostArr['sellcapitalgain']      	= $allvalues['sellcapitalgain'];
		$PostArr['annualoprating']      	= $allvalues['annualoprating'];
		$PostArr['sellstatetax']      		= $allvalues['sellstatetax'];
		$PostArr['selldepreciationrecap']   = $allvalues['selldepreciationrecap'];
		
		
		/*Calcluation Fields end here*/
}
		
		$PostArr['add_info_home'] 			= $_POST['addInfoHome'];
		$PostArr['appliances'] 				= serialize($_POST['appliances']);//
		$PostArr['basement'] 				= $_POST['basement'];
		$PostArr['floor_cover'] 			= serialize($_POST['floorcover']);//
		$PostArr['rooms'] 					= serialize($_POST['rooms']);//
		$PostArr['totalrooms'] 				= $_POST['totalrooms'];
		$PostArr['indoor'] 					= serialize($_POST['indoor']);
		$PostArr['basement'] 				= $_POST['basement'];
		$PostArr['rooms'] 					= serialize($_POST['rooms']);//
		$PostArr['cooling_type'] 			= serialize($_POST['cooling_type']);//
		$PostArr['heating_type'] 			= serialize($_POST['heating_type']);//
		$PostArr['heating_fuel'] 			= serialize($_POST['heating_fuel']);//
		$PostArr['building_amenities'] 		= serialize($_POST['building_amenities']);//
		$PostArr['architectural_style'] 	= $_POST['architectural_style'];
		$PostArr['exterior'] 				= serialize($_POST['exterior']);//
		$PostArr['outdoor_amenities'] 		= serialize($_POST['outdoor_amenittes']);//
		$PostArr['stories_count'] 			= $_POST['StoriesCount'];
		$PostArr['parking'] 				= serialize($_POST['parking']);//
		$PostArr['covered_parking'] 		= $_POST['CoveredParking'];
		$PostArr['roof'] 					= serialize($_POST['roof']);//
		$PostArr['view']					= serialize($_POST['view']);//
		/* $_SESSION['user_start'] = time();*/
		$PostArr['modified_date'] = date('Y-m-d H:i:s');	
		
		/* echo $propertyID;
		die; */
		 
		$update = $wpdb->update('wp_home_facts',$PostArr,array('id'=>base64_decode($propertyID)));
		
	if(!function_exists('wp_handle_upload')){
		require_once(ABSPATH . 'wp-admin/includes/media.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');
	}
	$allowed_file_types = array('jpg' =>'image/jpg','jpeg' =>'image/jpeg', 'gif' => 'image/gif', 'png' => 'image/png');
	$upload_overrides = array('test_form' => false,'mimes' => $allowed_file_types);
	/* pt($_FILES);
	die; */
	if(isset($_FILES['homeImages']))
	{
		add_filter('upload_dir', 'my_upload_dirFunctionPropertyPhotoGallery');
		$files = $_FILES['homeImages'];
		
		$uploadSchollArrays = array();
		foreach ($files['name'] as $count => $value) 
		{
			if ($files['name'][$count]) 
			{
				$file = array(
					'name'     => $files['name'][$count],
					'type'     => $files['type'][$count],
					'tmp_name' => $files['tmp_name'][$count],
					'error'    => $files['error'][$count],
					'size'     => $files['size'][$count]
				);
				if($file['error'] == 0 && $file['size'] <=4096000 )
				{
					$upload_overrides = array('test_form' => false,'mimes' => $allowed_file_types);
					$upload = wp_handle_upload($file, $upload_overrides);
					if ( $upload && ! isset( $upload['error'] ) ) 
					{
						$uploadSchollArrays[] = $upload['url'];
					}
				}
			}
		}
	}
	if($uploadSchollArrays)
	{
		$meta_key = 'educatorSPUpload'.$propertyID;	
		update_user_meta($userID,$meta_key,$uploadSchollArrays);
	}

		if($update){
			
			/* $_SESSION['home_facts_success'] = "Data saved successfully."; */
			$_SESSION['home_facts_success'] = "";
			$_SESSION['home_facts_error']   = "";
			header("Location: " . site_url().'/your-profile/?tag=property_listing&agentid='.base64_encode($userID));
			exit;
			
		}else{
			
			$_SESSION['home_facts_success'] = "";
			$_SESSION['home_facts_error'] = "";
			header("Location: " . the_permalink());
			exit;
			
		}
		
	/* } */
	/* } */
}else{

			$role = user_role();
			global $wpdb;
			$UserID = get_current_user_id();
			$propertyID = base64_decode($_GET['id']);
			if($role == 'administrator'){
				$query = "SELECT * FROM wp_home_facts WHERE id = '".$propertyID."'";	
			}else{
				$query = "SELECT * FROM wp_home_facts WHERE id = '".$propertyID."' and user_id = '".$UserID."'";	
			}
			
			$result = $wpdb->get_row($query);
			/* pt($result); */
			$property_id = $result->id;
			$pUserID = $result->user_id;
			$pImages = unserialize($result->images);
				
			$ptitle = $result->ptitle;
			$paddress = $result->paddress;
			$lat = $result->lat;
			$lng = $result->lng;
			$zipcode = $result->zipcode;
			$city = $result->city;
			$pprice = $result->pprice;
			$ZillowID = $result->ZillowID;
			$MLSID = $result->MLSID;
			
			$home_type = $result->home_type;
			$beds = $result->beds;
			$full_baths = $result->full_baths;
			$aby4baths = $result->aby4baths;
			$bby2baths = $result->bby2baths;
			$cby4baths = $result->cby4baths;
			$finished_feet = $result->finished_feet;
			$lot_sze = $result->lot_sze;
			$lot_units = $result->lot_units;
			$year_built = $result->year_built;
			$remodal = $result->remodal;
			$sold_date = $result->sold_date;
			$hoadues = $result->hoadues;
			$base_sqft = $result->base_sqft;
			$garage_sqft = $result->garage_sqft;
			$home_description = $result->home_description;
			$add_info_home = $result->add_info_home;
			
			/*Calcluation Fields starts here*/
			
			$upfrontimprovement = $result->upfrontimprovement;
			$closingcost = $result->closingcost;
			$downpayment = $result->downpayment;
			$interestrate = $result->interestrate;
			$mortgageyears = $result->mortgageyears;
			$monthlyrent = $result->monthlyrent;
			$vacancyrate = $result->vacancyrate;
			$expropertytaxes = $result->expropertytaxes;
			$exinsurance = $result->exinsurance;
			$exrepairs = $result->exrepairs;
			$exutilities = $result->exutilities;
			$expropertymgmt = $result->expropertymgmt;
			$exhoa = $result->exhoa;
			$exother = $result->exother;
			$exotherfixed = $result->exotherfixed;
			$marginaltaxrate = $result->marginaltaxrate;
			$annualappreciation = $result->annualappreciation;
			$amortizationperiodyears = $result->amortizationperiodyears;
			$selltransactioncost = $result->selltransactioncost;
			$annualrentincrease = $result->annualrentincrease;
			$sellholdingperiod = $result->sellholdingperiod;
			$sellcapitalgain = $result->sellcapitalgain;
			$annualoprating = $result->annualoprating;
			$sellstatetax = $result->sellstatetax;
			$selldepreciationrecap = $result->selldepreciationrecap;
			
			/*Calcluation Fields ends here*/
			
			
			$appliances = unserialize($result->appliances);
			$basement = $result->basement;
			$floor_cover = unserialize($result->floor_cover);
			$rooms = unserialize($result->rooms);
			$totalrooms = $result->totalrooms;
			$indoor = unserialize($result->indoor);
		
			$cooling_type = unserialize($result->cooling_type);
			$heating_type = unserialize($result->heating_type);
			$heating_fuel = unserialize($result->heating_fuel);
			$building_amenities = unserialize($result->building_amenities);
			$architectural_style = $result->architectural_style;
			$exterior =  unserialize($result->exterior);
			$outdoor_amenities =  unserialize($result->outdoor_amenities);
			$stories_count = $result->stories_count;
			$parking = unserialize($result->parking);
			$covered_parking = $result->covered_parking;
			$roof = unserialize($result->roof);
			$view = unserialize($result->view);
	}		
	
?>
<form id="propertyfacts" method="POST" action="" enctype="multipart/form-data">
			<div class="row">				
				<!-- Begin Form container 1-->
				<input type="hidden" value="<?php echo $result->id; ?>" name="id"/>
				<input type="hidden" value="<?php echo $zipcode; ?>" name="zipcode_old"/>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					
					<div class="leftform_container">
						<div class="form_head" style="display:none">Correcting these home facts will likely affect your estimate.</div>
							<div class="form-group">
							  <label class="formLabels" for="homeType">Type <a data-toggle="tooltip" title="Single Family, Condo, Town House, Multi Family, Apartment"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
							  <select class="form-control" id="homeType" name="hometype">
								<option <?php echo($home_type == 'Single Family')? 'selected':''; ?>>Single Family</option>
								<option <?php echo($home_type == 'Condo')? 'selected':''; ?>>Condo</option>
								<option <?php echo($home_type == 'Townhouse')? 'selected':''; ?>>Townhouse</option>
								<option <?php echo($home_type == 'Multi Family')? 'selected':''; ?>>Multi Family</option>
								<option <?php echo($home_type == 'Apartment')? 'selected':''; ?>>Apartment</option>
							<!-- 	<option <?php //echo($home_type == 'Mobile / Manufactured')? 'selected':''; ?>>Mobile / Manufactured</option>
								<option <?php //echo($home_type == 'Coop Unit')? 'selected':''; ?>>Coop Unit</option>
								<option <?php //echo($home_type == 'Vacant Land')? 'selected':''; ?>>Vacant Land</option>
								<option <?php //echo($home_type == 'Other')? 'selected':''; ?>>Other</option> -->
							  </select>
							</div>
							
							<div class="form-group">
							  <label class="formLabels" for="beds">Beds <a data-toggle="tooltip" title="Number of bedrooms"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
							  <span class="valerror" style="display:none;"></span>
							  <input type="tel" class="form-control" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" value="<?php echo $beds; ?>" id="beds" placeholder="Number of Beds" name="beds">
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label class="formLabels" for="fbaths">Baths <a data-toggle="tooltip" title="Number of bathrooms"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										 <span class="valerror" style="display:none;"></span>
										<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" class="form-control" id="fbaths" value="<?php echo $full_baths; ?>" name="fbaths">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label class="formLabels" for="aby4baths">3/4 Baths</label>
										 <span class="valerror" style="display:none;"></span>
										<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" class="form-control" value="<?php echo $aby4baths; ?>" id="aby4baths" name="aby4baths">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label class="formLabels" for="bby2baths">1/2 Baths</label>
										 <span class="valerror" style="display:none;"></span>
										<input type="tel" onkeyup="numVal(this)" value="<?php echo $bby2baths; ?>" onkeypress="return isDecimalNumber(event)" class="form-control" id="bby2baths" name="bby2baths">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label class="formLabels" for="cby4baths">1/4 Baths</label>
										 <span class="valerror" style="display:none;"></span>
										<input type="tel" onkeyup="numVal(this)" value="<?php echo $cby4baths; ?>" onkeypress="return isDecimalNumber(event)" class="form-control" id="cby4baths" name="cby4baths">
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="formLabels" for="finishedFeet">Finished square feet</label>
							   <span class="valerror" style="display:none;"></span>
							  <input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" class="form-control" id="finishedFeet" value="<?php echo $finished_feet; ?>" name="finishedFeet">
							  <label id="finishedFeet-error" class="error" for="finishedFeet"></label>
							</div>
							
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<label class="formLabels" for="12baths">Lot <a data-toggle="tooltip" title="Total lot area size in sqft"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group inner_form_group">
									 <span class="valerror" style="display:none;"></span>
										<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" class="form-control" id="lotSize" value="<?php echo $lot_sze; ?>" name="lotSize">
										<label id="lotSize-error" class="error" for="lotSize"></label>
									</div>
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group inner_form_group">
										<select class="form-control" id="lotsizeunit" name="lotunits">
											<option <?php echo ($lot_units == 'Sq Ft')? 'selected':''; ?>>Sq Ft</option>
											<option <?php echo ($lot_units == 'Acres')? 'selected':''; ?>>Acres</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									 <label class="formLabels" for="yearBuilt">Year Built <a data-toggle="tooltip" title="Year unit was built"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<div class="input-group date" id="yearBuilt">
										<input type="text" class="form-control" value="<?php echo $year_built; ?>" name="yearBuilt" placeholder="Select Date" id="searchdate">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
									
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
									  <label class="formLabels" for="totalBeds">Structural remodel year</label>
									  
									<div class="input-group date" id="remodalyear">
										<input type="text" class="form-control" value="<?php echo $remodal; ?>" name="remodal" placeholder="Select Date" id="searchdate">
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
											<input type="text" class="form-control"  value="<?php echo $sold_date; ?>" name="sold_date" placeholder="Select Date" id="searchdate">
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
									<input type="text" class="required form-control" value="<?php echo $ptitle; ?>" id="ptitle" name="ptitle">
								</div>
							</div>
						</div>	
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<label class="formLabels" for="paddress">Address Address <a data-toggle="tooltip" title="Physical address of unit"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<input type="text" class="required form-control" value="<?php echo $paddress; ?>" id="paddress" name="paddress" placeholder="12909 Pegasus St, Austin, TX, 78727, USA">
									<input type="hidden" class="form-control" value="<?php echo $lat; ?>" id="lat" name="lat">
									<input type="hidden" class="form-control" value="<?php echo $lng; ?>" id="lng" name="lng">
								</div>
							</div>
						</div>	
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label class="formLabels" for="zipcode">Zipcode</label>
									<input type="tel" value="<?php echo $zipcode; ?>" class="required form-control" id="zipcode" name="zipcode">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label class="formLabels" for="city">City</label>
									<input type="text" value="<?php echo $city; ?>" class="required form-control" id="city" name="city">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label class="formLabels" for="ZillowID">Zillow ID</label>
									<input type="tel" value="<?php echo $ZillowID; ?>" class="required form-control" id="ZillowID" name="ZillowID">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label class="formLabels" for="MLSID">MLS ID</label>
									<input type="text" value="<?php echo $MLSID; ?>" class="required form-control" id="MLSID" name="MLSID">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label class="formLabels" for="12baths">Basement sq. ft.</label>
									<input type="tel" min="1" value="<?php echo $base_sqft; ?>" class="form-control" id="12baths" name="baseSqft">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label class="formLabels" for="14baths">Garage sq. ft.</label>
									<input type="tel" min="1" value="<?php echo $garage_sqft; ?>" class="form-control" id="14baths" name="garageSqft">
								</div>
							</div>
						</div>
						
						<div class="form-group textarea_form-group">
							<label class="formLabels" for="homeType">Describe your home</label>
							<textarea rows="4" class="form-control" value="<?php echo $home_description; ?>" id="yourhome" name="descHome" style="resize: none;"><?php echo $home_description; ?></textarea>
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
									<textarea rows="3" class="form-control" id="yourhome" value="<?php echo $add_info_home; ?>" name="addInfoHome" style="resize: none;"><?php echo $add_info_home; ?></textarea>
									<span class="mini_desc">Say what you love about it and what makes it unique, talk about the neighborhood and lifestyle it provides.</span>
								</div>
							</div>
						</div>
							
					</div>
				</div>
			</div>
			<div class="custom_separator"></div>
			
			<!--calculators fields starts here -->
<a class="collapseButton" data-toggle="collapse" href="#maincalculate" aria-expanded="true">Financials<i class="fa fa-angle-down collapse-fa"></i></a>
		<div class="optionsinner_wrapper collapse in" id="maincalculate" aria-expanded="true" style="width: 100%;">			
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="options_wrapper">
						<a class="collapseButton" data-toggle="collapse" href="#calculate" aria-expanded="true" style="display:none;">Calculations  <i class="fa fa-angle-down collapse-fa"></i></a>
						<div class="optionsinner_wrapper collapse in" id="calculate" aria-expanded="true" style="width: 100%;">
							
							<div class="options_container" id="calcu">
								<div class="row">
									
							
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad-left">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-pad common_responsive no-pad-left">
								<div class="form-group" style="position:relative;">
									<label class="formLabels" for="pprice">Price <a data-toggle="tooltip" title="Price of unit"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<input type="tel" class="required form-control" value="<?php echo get_val_by_number_format($pprice,true); ?>" maxlength="10" id="pprice" name="pprice" style="padding-left:22px;">
									<div class="dollar_sign">$</div>
									<label id="pprice-error" class="error" for="pprice"></label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-right">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="mortgageyears">Mortgage Years</label>
													<span class="valerror" style="display:none;"></span>
													<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> min="1" name="mortgageyears" id="mortgageyears" class="form-control compcalinput" rel="<?php echo $mortgageyears; ?>" max="30" maxlength="2" value="<?php echo $mortgageyears; ?>">
													<div class="percentage_sign">Yrs</div>
												</div>
											</div>
							<!--div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
								<div class="form-group" style="position:relative;">
									<label class="formLabels" for="hoadues">HOA dues<span> (per month)</span></label>
									<input type="tel" value="<@?php echo get_val_by_number_format($hoadues,true); ?>" maxlength="10" class="required form-control" id="hoadues" name="hoadues" style="padding-left:22px;">
									<div class="dollar_sign">$</div>
								</div>
							</div-->
									<!--  Begin Appliances Options class to add space from top 'COSTINPUTS'-->
										<a class="collapseButton" data-toggle="collapse" href="#COSTINPUTS" aria-expanded="true">Cost Inputs  <i class="fa fa-angle-down collapse-fa"></i></a>
						<div class="optionsinner_wrapper collapse in reduce_space" id="COSTINPUTS" aria-expanded="true" style="width: 100%;">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-left">
								<div class="form-group" style="position:relative;">
									<label class="formLabels" for="upfrontimprovement">Upfront Improvement <a data-toggle="tooltip" title="Money used to upgrade unit immediately after sale as a percentage of purchase price"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<span class="valerror" style="display:none;"></span>
									<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> class="required form-control comcalinput allow" maxlength="10" rel="<?php echo get_val_by_number_format($upfrontimprovement,true); ?>"  value="<?php echo get_val_by_number_format($upfrontimprovement,true); ?>" id="upfrontimprovement" name="upfrontimprovement">
									<div class="dollar_sign">$</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-right">
								<div class="form-group" style="position:relative;">
									<label class="formLabels" for="closingcost">Closing Cost <a data-toggle="tooltip" title="Miscellaneous fees charged by those involved with the home sale as a percentage of the purchase price"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<span class="valerror" style="display:none;"></span>
									<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" name="closingcost" <?php echo $disable; ?> id="closingcost" class="form-control compcalinput" rel="<?php echo $closingcost+0; ?>" maxlength="5" value="<?php echo $closingcost+0; ?>" type="tel">
									
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
													<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" name="monthlyrent" <?php echo $disable; ?> maxlength="10" rel="<?php echo get_val_by_number_format($monthlyrent,true); ?>" id="monthlyrent" type="tell" class="form-control comcalinput allow" value="<?php echo get_val_by_number_format($monthlyrent,true); ?>">
													<div class="dollar_sign">$</div>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-right">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="vacancyrate">Vacancy Rate <a data-toggle="tooltip" title="Percentage of time unit is vacant and not collecting rent"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
													<span class="valerror" style="display:none;"></span>
													<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" name="vacancyrate" <?php echo $disable; ?> id="vacancyrate" type="tell" rel="<?php echo $vacancyrate+0; ?>" class="form-control compcalinput" maxlength="5" value="<?php echo $vacancyrate+0; ?>">
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
													<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> name="downpayment" id="downpayment" class="form-control compcalinput" maxlength="5" rel="<?php echo $downpayment+0; ?>" value="<?php echo $downpayment+0; ?>">
													<div class="percentage_sign">%</div>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-right">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="interestrate">Interest Rate <a data-toggle="tooltip" title="Amount charged by a lender to a borrower for the use of assets expressed as a percentage of principal"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
													<span class="valerror" style="display:none;"></span>
													<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> name="interestrate" id="interestrate" class="form-control compcalinput" maxlength="5" rel="<?php echo $interestrate+0; ?>" value="<?php echo $interestrate+0; ?>">
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
														<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> maxlength="5" class="form-control compcalinput" name="expropertytaxes" id="expropertytaxes" rel="<?php echo $expropertytaxes+0; ?>" value="<?php echo $expropertytaxes+0; ?>" type="tel">
														<div class="percentage_sign">%</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive custom-pad">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="exinsurance">Insurance <a data-toggle="tooltip" title="Monthly amount paid to insure unit"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
														 <span class="valerror" style="display:none;"></span>
														<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" id="exinsurance" <?php echo $disable; ?> maxlength="8" class="form-control comcalinput allow" rel="<?php echo get_val_by_number_format($exinsurance,true); ?>" name="exinsurance" value="<?php echo get_val_by_number_format($exinsurance,true); ?>" type="tel">
														<div class="dollar_sign">$</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive custom-pad">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="exrepairs">Repairs <a data-toggle="tooltip" title="Estimated repair costs expressed as a percentage of rental income"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
														<span class="valerror" style="display:none;"></span>
														<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> maxlength="5" class="form-control compcalinput" name="exrepairs" id="exrepairs" rel="<?php echo $exrepairs+0; ?>" value="<?php echo $exrepairs+0; ?>">
														<div class="percentage_sign">%</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive no-pad-right">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="exutilities">Utilities <a data-toggle="tooltip" title="Monthly amount paid by owner toward unitlites (water, gas, etc.)"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
														<span class="valerror" style="display:none;"></span>
														<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> id="exutilities" maxlength="8" class="form-control comcalinput allow" name="exutilities" rel="<?php echo get_val_by_number_format($exutilities,true); ?>" value="<?php echo get_val_by_number_format($exutilities,true); ?>">
														<div class="dollar_sign">$</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive no-pad-left">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="expropertymgmt">Management Fee <a data-toggle="tooltip" title="Fee paid to management company expressed as a percentage of rental income"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
														<span class="valerror" style="display:none;"></span>
														<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> maxlength="5" class="form-control compcalinput" name="expropertymgmt" id="expropertymgmt" rel="<?php echo $expropertymgmt+0; ?>" value="<?php echo $expropertymgmt+0; ?>">
														<div class="percentage_sign">%</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive custom-pad">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="exhoa">HOA <a data-toggle="tooltip" title="Home owners association monthly fee"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
														<span class="valerror" style="display:none;"></span>
														<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> id="exhoa" maxlength="8" class="form-control comcalinput allow" rel="<?php echo get_val_by_number_format($exhoa,true); ?>" name="exhoa" value="<?php echo get_val_by_number_format($exhoa,true); ?>">
														<div class="dollar_sign">$</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive custom-pad">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="exother">Other Percentage Cost <a data-toggle="tooltip" title="Miscellaneous costs expressed as a percentage of rental income"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
														<span class="valerror" style="display:none;"></span>
														<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> maxlength="5" class="form-control compcalinput" id="exother" name="exother" rel="<?php echo $exother+0; ?>" value="<?php echo $exother+0; ?>">
														<div class="percentage_sign">%</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 common_responsive no-pad-right">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="exotherfixed">Other Fixed Cost <a data-toggle="tooltip" title="Miscellaneous flat costs"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
														<span class="valerror" style="display:none;"></span>
														<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" type="tel" <?php echo $disable; ?> id="exotherfixed" maxlength="8" class="form-control comcalinput allow" name="exotherfixed" rel="<?php echo get_val_by_number_format($exotherfixed,true); ?>" value="<?php echo get_val_by_number_format($exotherfixed,true); ?>">
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
													<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" name="marginaltaxrate" <?php echo $disable; ?> id="marginaltaxrate" type="tel" class="form-control compcalinput" maxlength="5" rel="<?php echo $marginaltaxrate+0; ?>" value="<?php echo $marginaltaxrate+0; ?>" >
													<div class="percentage_sign">%</div>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad-left">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="amortizationperiodyears">Amortization Years <a data-toggle="tooltip" title="Amount of years the IRS considers to be the useful life of a rental property"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
													<span class="valerror" style="display:none;"></span>
													<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> name="amortizationperiodyears" id="amortizationperiodyears" type="tel" class="form-control compcalinput" rel="<?php echo $amortizationperiodyears; ?>" value="<?php echo $amortizationperiodyears; ?>">
													<div class="percentage_sign">Yrs</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
										<a class="collapseButton" data-toggle="collapse" href="#ANNUALGROWTHINPUTS" aria-expanded="true">Annual Growth Input<i class="fa fa-angle-down collapse-fa"></i></a>
										<div class="optionsinner_wrapper collapse in reduce_space" id="ANNUALGROWTHINPUTS" aria-expanded="true" style="width: 100%;">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-right">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="marginaltaxrate">Appreciation <a data-toggle="tooltip" title="Estimated year over year percentile appreciation of home value"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
													<span class="valerror" style="display:none;"></span>
													<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> type="tel" maxlength="5" class="form-control compcalinput" name="annualappreciation" id="annualappreciation" rel="<?php echo $annualappreciation+0; ?>" value="<?php echo $annualappreciation+0; ?>">
													<div class="percentage_sign">%</div>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 common_responsive no-pad-right">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="annualrentincrease">Rent Increase <a data-toggle="tooltip" title="Estimated year over year percentile rent increase"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
													<span class="valerror" style="display:none;"></span>
													<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> type="tel" maxlength="5" class="form-control compcalinput" name="annualrentincrease" id="annualrentincrease" rel="<?php echo $selltransactioncost+0; ?>" value="<?php echo $selltransactioncost+0; ?>">
													<div class="percentage_sign">%</div>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad-right">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="annualoprating">Operating Expense Increase <a data-toggle="tooltip" title="Estimated year over year percentile expense increase"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
													<span class="valerror" style="display:none;"></span>
													<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> type="tel" class="form-control compcalinput" name="annualoprating" id="annualoprating" rel="<?php echo $annualrentincrease+0; ?>" value="<?php echo $annualrentincrease+0; ?>">
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
														<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> type="tel" class="form-control compcalinput" id="sellholdingperiod" name="sellholdingperiod" rel="<?php echo $sellholdingperiod; ?>" value="<?php echo $sellholdingperiod; ?>">
														<div class="percentage_sign">Yrs</div>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 custom-pad">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="selltransactioncost">Selling Transaction Cost <a data-toggle="tooltip" title="Total cost to close transaction expressed as a percentage of the selling price"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
														<span class="valerror" style="display:none;"></span>
														<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> type="tel" maxlength="5" class="form-control compcalinput" name="selltransactioncost" id="selltransactioncost" rel="<?php echo $sellcapitalgain+0; ?>" value="<?php echo $sellcapitalgain+0; ?>">
														<div class="percentage_sign">%</div>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 no-pad-right">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="sellcapitalgain">Capital Gains Tax Rate <a data-toggle="tooltip" title="Long-term capital gain tax rate for profits in selling the unit"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
														<span class="valerror" style="display:none;"></span>
														<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" <?php echo $disable; ?> type="tel" maxlength="5" class="form-control compcalinput" name="sellcapitalgain" id="sellcapitalgain" rel="<?php echo $annualoprating+0; ?>" value="<?php echo $annualoprating+0; ?>">
														<div class="percentage_sign">%</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad-left">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="selldepreciationrecap">Depreciation Recap Rate  <a data-toggle="tooltip" title="Tax rate on the profits from the sale after taking deductions for depreciation"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
														<span class="valerror" style="display:none;"></span>
														<input <?php echo $disable; ?> onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)"  type="tel" maxlength="5" class="form-control compcalinput" name="selldepreciationrecap" id="selldepreciationrecap" rel="<?php echo $selldepreciationrecap+0; ?>" value="<?php echo $selldepreciationrecap+0; ?>">
														<div class="percentage_sign">%</div>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad-right">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="sellstatetax">State Tax <a data-toggle="tooltip" title="Tax rate collected by the state from the profits of the home sale"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
														<span class="valerror" style="display:none;"></span>
														<input <?php echo $disable; ?> onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)"  type="tel" maxlength="5" class="form-control compcalinput" name="sellstatetax" rel="<?php echo $sellstatetax+0; ?>" id="sellstatetax" value="<?php echo $sellstatetax+0; ?>">
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
												<input type="checkbox" <?php echo ($appliances[1] == 'Dishwasher')? 'checked':''; ?> name="appliances[1]" value="Dishwasher" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Dishwasher</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
											<input type="checkbox" <?php echo ($appliances[2] == 'Dryer')? 'checked':''; ?> name="appliances[2]" value="Dryer" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Dryer</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($appliances[3] == 'Freezer')? 'checked':''; ?>  name="appliances[3]" value="Freezer" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Freezer</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($appliances[4] == 'Garbage Disposal')? 'checked':''; ?> name="appliances[4]" value="Garbage Disposal" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Garbage Disposal</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($appliances[5] == 'Microwave')? 'checked':''; ?> name="appliances[5]" value="Microwave" class="">
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
												<input type="checkbox" <?php echo ($appliances[6] == 'Range/Oven')? 'checked':''; ?> name="appliances[6]" value="Range/Oven" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Range / Oven</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($appliances[7] == 'Refrigerator')? 'checked':''; ?> name="appliances[7]" value="Refrigerator" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Refrigerator</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($appliances[8] == 'Trash Compactor')? 'checked':''; ?> name="appliances[8]" value="Trash Compactor" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Trash Compactor</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($appliances[9] == 'Washer')? 'checked':''; ?> name="appliances[9]" value="Washer" class="">
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
													<input type="radio" <?php echo ($basement == 'Finished')? 'checked':''; ?> name="basement" value="Finished" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Finished</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($basement == 'Unfinished')? 'checked':''; ?> name="basement" value="Unfinished" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Unfinished</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($basement == 'Partially Finished')? 'checked':''; ?> name="basement" value="Partially Finished" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Partially Finished</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($basement == 'None')? 'checked':''; ?> name="basement" value="None" class="">
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
												<input type="checkbox" <?php echo ($floor_cover[1] == 'Carpet')? 'checked':''; ?> name="floorcover[1]" value="Carpet" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Carpet</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($floor_cover[2] == 'Concrete')? 'checked':''; ?> name="floorcover[2]" value="Concrete" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Concrete</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($floor_cover[3] == 'Hardwood')? 'checked':''; ?> name="floorcover[3]" value="Hardwood" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Hardwood</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($floor_cover[4] == 'Laminate')? 'checked':''; ?> name="floorcover[4]" value="Laminate" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Laminate</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($floor_cover[5] == 'Linoleum/Vinyl')? 'checked':''; ?> name="floorcover[5]" value="Linoleum/Vinyl" class="">
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
												<input type="checkbox" <?php echo ($floor_cover[6] == 'Slate')? 'checked':''; ?> name="floorcover[6]" value="Slate" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Slate</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($floor_cover[7] == 'Softwood')? 'checked':''; ?> name="floorcover[7]" value="Softwood" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Softwood</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($floor_cover[8] == 'Tile')? 'checked':''; ?> name="floorcover[8]" value="Tile" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Tile</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($floor_cover[9] == 'Other')? 'checked':''; ?> name="floorcover[9]" value="Other" class="">
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
												<input type="checkbox" <?php echo ($rooms[1] == 'Breakfast Nook')? 'checked':''; ?> name="rooms[1]" value="Breakfast Nook" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Breakfast Nook</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($rooms[2] == 'Dining Room')? 'checked':''; ?> name="rooms[2]" value="Dining Room" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Dining Room</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($rooms[3] == 'Family Room')? 'checked':''; ?> name="rooms[3]" value="Family Room" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Family Room</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($rooms[4] == 'Laundry Room')? 'checked':''; ?> name="rooms[4]" value="Laundry Room" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Laundry Room</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($rooms[5] == 'Library')? 'checked':''; ?> name="rooms[5]" value="Library" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Library</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
													<input type="checkbox" <?php echo ($rooms[6] == 'Master Bath')? 'checked':''; ?> name="rooms[6]" value="Master Bath" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Master Bath</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($rooms[7] == 'Mud Room')? 'checked':''; ?> name="rooms[7]" value="Mud Room" class="">
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
												<input type="checkbox" <?php echo ($rooms[8] == 'Office')? 'checked':''; ?> name="rooms[8]" value="Office" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Office</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($rooms[9] == 'Pantry')? 'checked':''; ?> name="rooms[9]" value="Pantry" class="">
												<span class="cr"><i class="cr-icon fa fa-check"></i></span>
												<span class="cstmLabelText">Pantry</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($rooms[10] == 'Recreation room')? 'checked':''; ?> name="rooms[10]" value="Recreation room" class="">
												<span class="cr"><i class="cr-icon fa fa-check"></i></span>
												<span class="cstmLabelText">Recreation room</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($rooms[11] == 'Workshop')? 'checked':''; ?> name="rooms[11]" value="Workshop" class="">
												<span class="cr"><i class="cr-icon fa fa-check"></i></span>
												<span class="cstmLabelText">Workshop</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($rooms[12] == 'SolariumAtrium')? 'checked':''; ?> name="rooms[12]" value="SolariumAtrium" class="">
												<span class="cr"><i class="cr-icon fa fa-check"></i></span>
												<span class="cstmLabelText">Solarium / Atrium</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($rooms[13] == 'Sun Room')? 'checked':''; ?> name="rooms[13]" value="Sun Room" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Sun Room</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($rooms[14] == 'Walkincloset')? 'checked':''; ?> name="rooms[14]" value="Walkincloset" class="">
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
									<input type="number" min="1" name="totalrooms" value="<?php echo $totalrooms; ?>" class="form-control" id="totalrooms">
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
												<input type="checkbox" <?php echo ($cooling_type[1] == 'Central')? 'checked':''; ?> name="cooling_type[1]" value="Central" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Central</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($cooling_type[2] == 'Evaporative')? 'checked':''; ?> name="cooling_type[2]" value="Evaporative" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Evaporative</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($cooling_type[3] == 'Geothermal')? 'checked':''; ?> name="cooling_type[3]" value="Geothermal" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Geothermal</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($cooling_type[4] == 'Refrigeration')? 'checked':''; ?> name="cooling_type[4]" value="Refrigeration" class="">
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
												<input type="checkbox"  <?php echo ($cooling_type[5] == 'Solar')? 'checked':''; ?> name="cooling_type[5]" value="Solar" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Solar</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($cooling_type[6] == 'Wall')? 'checked':''; ?> name="cooling_type[6]" value="Wall" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Wall</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($cooling_type[7] == 'Other')? 'checked':''; ?> name="cooling_type[7]" value="Other" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Other</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($cooling_type[8] == 'None')? 'checked':''; ?> name="cooling_type[8]" value="None" class="">
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
												<input type="checkbox" <?php echo ($heating_type[1] == 'Baseboard')? 'checked':''; ?> name="heating_type[1]" value="Baseboard" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Baseboard</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($heating_type[2] == 'ForcedAir')? 'checked':''; ?> name="heating_type[2]" value="ForcedAir" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Forced Air</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($heating_type[3] == 'Geothermal')? 'checked':''; ?> name="heating_type[3]" value="Geothermal" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Geothermal</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($heating_type[4] == 'Heat pump')? 'checked':''; ?> name="heating_type[4]" value="Heat pump" class="">
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
												<input type="checkbox" <?php echo ($heating_type[5] == 'Radiant')? 'checked':''; ?> name="heating_type[5]" value="Radiant" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Radiant</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox"  <?php echo ($heating_type[6] == 'Stove')? 'checked':''; ?> name="heating_type[6]" value="Stove" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Stove</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($heating_type[7] == 'Wall')? 'checked':''; ?> name="heating_type[7]" value="Wall" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Wall</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($heating_type[8] == 'Other')? 'checked':''; ?> name="heating_type[8]" value="Other" class="">
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
												<input type="checkbox" <?php echo ($heating_fuel[1] == 'Coal')? 'checked':''; ?> name="heating_fuel[1]" value="Coal" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Coal</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($heating_fuel[2] == 'Electric')? 'checked':''; ?> name="heating_fuel[2]" value="Electric" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Electric</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($heating_fuel[3] == 'Gas')? 'checked':''; ?> name="heating_fuel[3]" value="Gas" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Gas</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($heating_fuel[4] == 'Oil')? 'checked':''; ?> name="heating_fuel[4]" value="Oil" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Oil</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($heating_fuel[5] == 'PropaneButane')? 'checked':''; ?> name="heating_fuel[5]" value="PropaneButane" class="">
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
												<input type="checkbox" <?php echo ($heating_fuel[6] == 'Solar')? 'checked':''; ?> name="heating_fuel[6]" value="Solar" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Solar</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($heating_fuel[7] == 'WoodPellet')? 'checked':''; ?> name="heating_fuel[7]" value="WoodPellet" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Wood / Pellet</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($heating_fuel[8] == 'Other')? 'checked':''; ?> name="heating_fuel[8]" value="Other" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Other</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($heating_fuel[9] == 'None')? 'checked':''; ?> name="heating_fuel[9]" value="None" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">None</span>
											</label>
										</div>
									</div>
								</div>
							</div>
							<!-- End Heating fuel Options -->
						</div>
					</div>
						<!-- Begin Indoor features options -->
							<div class="options_container" id="roomoptions">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad facts_category">
									Indoor features
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad">
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($indoor[1] == 'Attic')? 'checked':''; ?> name="Indoor[1]" value="Attic" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Attic</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($indoor[2] == 'Cable ready')? 'checked':''; ?> name="Indoor[2]" value="Cable ready" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Cable ready</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($indoor[3] == 'Ceiling Fans')? 'checked':''; ?> name="Indoor[3]" value="Ceiling Fans" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Ceiling Fans</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($indoor[4] == 'Doublepanestorm')? 'checked':''; ?> name="Indoor[4]" value="Doublepanestorm" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Double pane/storm windows</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($indoor[5] == 'Fireplace')? 'checked':''; ?> name="Indoor[5]" value="Fireplace" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Fireplace</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox"  <?php echo ($indoor[6] == 'Intercom System')? 'checked':''; ?> name="Indoor[6]" value="Intercom System" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Intercom System</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($indoor[7] == 'JettedTub')? 'checked':''; ?> name="Indoor[7]" value="JettedTub" class="">
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
												<input type="checkbox" <?php echo ($indoor[8] == 'Motherinlawapartment')? 'checked':''; ?> name="Indoor[8]" value="Motherinlawapartment" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Mother-in-law apartment</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($indoor[9] == 'SecuritySystem')? 'checked':''; ?> name="Indoor[9]" value="SecuritySystem" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Security System</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($indoor[10] == 'Skylights')? 'checked':''; ?> name="Indoor[10]" value="Skylights" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Skylights</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($indoor[11] == 'Vaultedceiling')? 'checked':''; ?> name="Indoor[11]" value="Vaultedceiling" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Vaulted ceiling</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($indoor[12] == 'WetBar')? 'checked':''; ?> name="Indoor[12]" value="WetBar" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Wet Bar</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($indoor[13] == 'Wired')? 'checked':''; ?> name="Indoor[13]" value="Wired" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Wired</span>
											</label>
										</div>
									</div>
								</div>
							</div>
							<!-- End Indoor Features options -->
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
												<input type="checkbox" <?php echo ($building_amenities[1] == 'Assistedlivingcommunity')? 'checked':''; ?> name="building_amenities[1]" value="Assistedlivingcommunity" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Assisted living community</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($building_amenities[2] == 'BasketballCourt')? 'checked':''; ?> name="building_amenities[2]" value="BasketballCourt" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Basketball Court</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($building_amenities[3] == 'Controlled Access')? 'checked':''; ?> name="building_amenities[3]" value="Controlled Access" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Controlled Access</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($building_amenities[4] == 'Disabled Access')? 'checked':''; ?> name="building_amenities[4]" value="Disabled Access" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Disabled Access</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($building_amenities[5] == 'Doorman')? 'checked':''; ?> name="building_amenities[5]" value="Doorman" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Doorman</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($building_amenities[6] == 'Elevator')? 'checked':''; ?> name="building_amenities[6]" value="Elevator" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Elevator</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($building_amenities[7] == 'Fitness center')? 'checked':''; ?> name="building_amenities[7]" value="Fitness center" class="">
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
												<input type="checkbox" <?php echo ($building_amenities[8] == 'Gated Entry')? 'checked':''; ?> name="building_amenities[8]" value="Gated Entry" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Gated Entry</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($building_amenities[9] == 'Near Transportation')? 'checked':''; ?> name="building_amenities[9]" value="Near Transportation" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Near Transportation</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($building_amenities[10] == 'Over 55+ active community')? 'checked':''; ?> name="building_amenities[10]" value="Over 55+ active community" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Over 55+ active community</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($building_amenities[11] == 'Sports Court')? 'checked':''; ?> name="building_amenities[11]" value="Sports Court" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Sports Court</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($building_amenities[12] == 'Storage')? 'checked':''; ?> name="building_amenities[12]" value="Storage" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Storage</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($building_amenities[13] == 'TennisCourt')? 'checked':''; ?> name="building_amenities[13]" value="TennisCourt" class="">
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
														<input type="radio" <?php echo ($architectural_style == 'Bungalow')? 'checked':''; ?> name="architectural_style" value="Bungalow" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Bungalow</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($architectural_style == 'Modern')? 'checked':''; ?> name="architectural_style" value="Modern" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Modern</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($architectural_style == 'Cape Cod')? 'checked':''; ?> name="architectural_style" value="Cape Cod" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Cape Cod</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio"  <?php echo ($architectural_style == 'QueenAnne/Victorian')? 'checked':''; ?> name="architectural_style" value="QueenAnne/Victorian" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Queen Anne / Victorian</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($architectural_style == 'Colonial')? 'checked':''; ?> name="architectural_style" value="Colonial" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Colonial</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($architectural_style == 'Ranch/Rambler')? 'checked':''; ?> name="architectural_style" value="Ranch/Rambler" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Ranch / Rambler</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($architectural_style == 'Contemporary')? 'checked':''; ?> name="architectural_style" value="Contemporary" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Contemporary</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($architectural_style == 'Santa Fe/Pueblo')? 'checked':''; ?> name="architectural_style" value="Santa Fe/Pueblo" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Santa Fe / Pueblo Style</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($architectural_style == 'Craftsmen')? 'checked':''; ?> name="architectural_style" value="Craftsmen" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Craftsman</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($architectural_style == 'Spanish')? 'checked':''; ?> name="architectural_style" value="Spanish" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Spanish</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($architectural_style == 'French')? 'checked':''; ?> name="architectural_style" value="French" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">French</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($architectural_style == 'Split Level')? 'checked':''; ?> name="architectural_style" value="Split Level" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Split Level</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($architectural_style == 'Georgian')? 'checked':''; ?> name="architectural_style" value="Georgian" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Georgian</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($architectural_style == 'Tudor')? 'checked':''; ?> name="architectural_style" value="Tudor" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Tudor</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($architectural_style == 'Loft')? 'checked':''; ?> name="architectural_style" value="Loft" class="">
														<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
														<span class="cstmLabelText">Loft</span>
												</label>
											</div>
										</div>
										<div class=" custom_radio">
											<div class="radio rd2">
												<label style="font-size:14px;">
													<input type="radio" <?php echo ($architectural_style == 'Other')? 'checked':''; ?> name="architectural_style" value="Other" class="">
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
													<input type="checkbox" <?php echo ($exterior[1] == 'Brick')? 'checked':''; ?> name="exterior[1]" value="Brick" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Brick</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($exterior[2] == 'Cement/Concrete')? 'checked':''; ?> name="exterior[2]" value="Cement/Concrete" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Cement/Concrete</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($exterior[3] == 'Composition')? 'checked':''; ?> name="exterior[3]" value="Composition" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Composition</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($exterior[4] == 'Metal')? 'checked':''; ?> name="exterior[4]" value="Metal" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Metal</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($exterior[5] == 'Shingle')? 'checked':''; ?> name="exterior[5]" value="Shingle" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Shingle</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($exterior[6] == 'Stone')? 'checked':''; ?> name="exterior[6]" value="Stone" class="">
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
												<input type="checkbox" <?php echo ($exterior[7] == 'Stucco')? 'checked':''; ?> name="exterior[7]" value="Stucco" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Stucco</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($exterior[8] == 'Vinyl')? 'checked':''; ?> name="exterior[8]" value="Vinyl" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Vinyl</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($exterior[9] == 'Wood')? 'checked':''; ?> name="exterior[9]" value="Wood" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Wood</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($exterior[10] == 'Wood Products')? 'checked':''; ?> name="exterior[]" value="Wood Products" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Wood Products</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($exterior[11] == 'Other Products')? 'checked':''; ?> name="exterior[11]" value="Other" class="">
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
												<input type="checkbox" <?php echo ($outdoor_amenities[1] == 'Balcony/Patio')? 'checked':''; ?> name="outdoor_amenities[1]" value="Balcony/Patio" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Balcony/Patio</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($outdoor_amenities[2] == 'Barbecue area')? 'checked':''; ?> name="outdoor_amenities[2]" value="Barbecue area" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Barbecue area</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($outdoor_amenities[3] == 'Deck')? 'checked':''; ?> name="outdoor_amenities[3]" value="Deck" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Deck</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($outdoor_amenities[4] == 'Dock')? 'checked':''; ?> name="outdoor_amenities[4]" value="Dock" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Dock</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($outdoor_amenities[5] == 'Fenced Yard')? 'checked':''; ?> name="outdoor_amenities[5]" value="Fenced Yard" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Fenced Yard</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($outdoor_amenities[6] == 'Garden')? 'checked':''; ?> name="outdoor_amenities[6]" value="Garden" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Garden</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($outdoor_amenities[7] == 'Greenhouse')? 'checked':''; ?> name="outdoor_amenities[7]" value="Greenhouse" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Greenhouse</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($outdoor_amenities[8] == 'Hot tub/spa')? 'checked':''; ?> name="outdoor_amenities[8]" value="Hot tub/spa" class="">
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
												<input type="checkbox" <?php echo ($outdoor_amenities[9] == 'Lawn')? 'checked':''; ?> name="outdoor_amenities[9]" value="Lawn" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Lawn</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($outdoor_amenities[10] == 'Pond')? 'checked':''; ?> name="outdoor_amenities[10]" value="Pond" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Pond</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($outdoor_amenities[11] == 'Pool')? 'checked':''; ?> name="outdoor_amenities[11]" value="Pool" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Pool</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($outdoor_amenities[12] == 'Porch')? 'checked':''; ?> name="outdoor_amenities[12]" value="Porch" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Porch</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($outdoor_amenities[13] == 'RV Parking')? 'checked':''; ?> name="outdoor_amenities[13]" value="RV Parking" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">RV Parking</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($outdoor_amenities[14] == 'Sauna')? 'checked':''; ?> name="outdoor_amenities[14]" value="Sauna" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Sauna</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($outdoor_amenities[15] == 'Sprinkler system')? 'checked':''; ?> name="outdoor_amenities[15]" value="Sprinkler system" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Sprinkler system</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($outdoor_amenities[16] == 'Waterfront')? 'checked':''; ?> name="outdoor_amenities[16]" value="Waterfront" class="">
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
									<input type="number" min="1" class="form-control" value="<?php echo ($stories_count)? $stories_count :''; ?>"  id="storiesCount" name="StoriesCount">
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
												<input type="checkbox" <?php echo ($parking[1] == 'Carport')? 'checked':''; ?> name="parking[1]" value="Carport" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Carport</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($parking[2] == 'GarageAttached')? 'checked':''; ?>  name="parking[2]" value="GarageAttached" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Garage - Attached</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox"  <?php echo ($parking[3] == 'GarageDeatached')? 'checked':''; ?> name="parking[3]" value="GarageDeatached" class="">
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
												<input type="checkbox" <?php echo ($parking[4] == 'OffStreet')? 'checked':''; ?> name="parking[4]" value="OffStreet" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Off - Street</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($parking[5] == 'OnStreet')? 'checked':''; ?> name="parking[5]" value="OnStreet" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">On - Street</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($parking[6] == 'None')? 'checked':''; ?> name="parking[6]" value="None" class="">
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
									<input type="number" class="form-control" value="<?php echo($covered_parking)? $covered_parking : ''; ?>" id="coveredPark" name="CoveredParking">
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
												<input type="checkbox" <?php echo ($roof[1] == 'Asphalt')? 'checked':''; ?> name="roof[1]" value="Asphalt" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Asphalt</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($roof[2] == 'Builtup')? 'checked':''; ?> name="roof[2]" value="Builtup" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Built - up</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($roof[3] == 'Composition')? 'checked':''; ?> name="roof[3]" value="Composition" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Composition</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($roof[4] == 'Metal')? 'checked':''; ?> name="roof[4]" value="Metal" class="">
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
												<input type="checkbox" <?php echo ($roof[5] == 'ShakeShingle')? 'checked':''; ?> name="roof[5]" value="ShakeShingle" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Shake / Shingle</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($roof[6] == 'Slate')? 'checked':''; ?> name="roof[6]" value="Slate" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Slate</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox"  <?php echo ($roof[7] == 'Tile')? 'checked':''; ?> name="roof[7]" value="Tile" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Tile</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($roof[8] == 'Other')? 'checked':''; ?> name="roof[8]" value="Other" class="">
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
												<input type="checkbox" <?php echo ($view[1] == 'City')? 'checked':''; ?> name="view[1]" value="City" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">City</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($view[2] == 'Park')? 'checked':''; ?> name="view[2]" value="Park" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Mountain</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($view[3] == 'Territorial')? 'checked':''; ?> name="view[3]" value="Territorial" class="">
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
												<input type="checkbox" <?php echo ($view[3] == 'Territorial')? 'checked':''; ?> name="view[3]" value="Territorial" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Territorial</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox"  <?php echo ($view[4] == 'Water')? 'checked':''; ?> name="view[4]" value="Water" class="">
													<span class="cr"><i class="cr-icon fa fa-check"></i></span>
													<span class="cstmLabelText">Water</span>
											</label>
										</div>
									</div>
									<div class="form-group custom_chbox">	
										<div class="radio rd2">
											<label style="font-size:14px;">
												<input type="checkbox" <?php echo ($view[5] == 'None')? 'checked':''; ?> name="view[5]" value="None" class="">
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
						<?php
							if(!empty($pImages)){		
								$c = 0;
								foreach($pImages as $pImagen){
									$imageNameone .= $pImagen.',';
									$c++;
								}
							}
						?>
						<div id="addpropertyFile" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="hidden" id="appendfiles" name="files_append" value="<?php echo $imageNameone; ?>">
							<input type="file" name="files">
						</div>
						
						<ul id="thumb-output-agentLogo" class="imageUpload">
							<?php 
							
								/* global $wpdb;
								$meta_key = 'educatorSPUpload'.base64_encode($property_id);
								$imagesQuery = "SELECT id,image,name FROM property_imaes WHERE property_id = '".$property_id."'";
								
								$results = $wpdb->get_results($imagesQuery); */
								/* pt($pImages); */
								if(!empty($pImages)){	
									$loaderUrl = get_template_directory_uri().'/images/image_1114484.gif';	
									foreach($pImages as $pImage){
										/* $imageid = $result->id;	
										$image = $result->image; */	
										$imageName = $pImage;	
										if($imageName != 'null'){
											$inser_url = site_url().'/wp-content/uploads/properties_gallery/'.$imageName;
											echo '<li class="factThumbnail"><a><img id="" class="factThumbnailimg" src="'.$inser_url.'"><i id="'.$propertyID.'" data="'.$imageName.'" class="fa fa-times-circle remove" aria-hidden="true"></i></a><img class="deleteImg" src="'.$loaderUrl.'"></li>';	
										}
										
									}
								}
								/* $images = get_user_meta($pUserID,$meta_key,true); */
/* pt($images);	 */				
							/* 	if(!empty($images)){								
									foreach($images as $image){
										echo '<li class="factThumbnail"><a><img id="" class="factThumbnailimg" src="'.$image.'"><i id="'.$pUserID.'" rel="'.$meta_key.'" data="'.$image.'" class="fa fa-times-circle remove" aria-hidden="true"></i></a><img class="deleteImg" src="'.$loaderUrl.'"></li>';
									}
								} */
							?>
						</ul>
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
						<button style="float: left;" type="submit" class="uploadPhotos" value="updatechanges" name="updatechanges"><i class="fa fa-check-circle" ></i> Update Changes</button>
						<a style="float: left;padding-top: 8px;width: 150px;" class="cancelPhotos" href="<?php echo get_site_url().'/your-profile/'; ?>" ><i class="fa fa-times-circle"></i> Cancel</a>
					</div>
				</div>
					
				<!-- End Image upload section -->
	</form>