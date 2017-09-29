<?php

/**

 * Template Name: ZillowSearch

 *

 */



get_header(); 

global $current_user;

$role = user_role();

$agentID = $current_user->ID;



?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/scroller.css" />

<link href="<?php echo get_template_directory_uri(); ?>/css/properties_listing.css" media="all" rel="stylesheet">

<?php echo get_template_part('css/properties_listing'); ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mCustomScrollbar.js"></script>

<div id="primary" class="content-area" style="border-top:1px solid #ddd;">

	<main id="main" class="site-main" role="main">

		<?php

		// Start the loop.

		while ( have_posts() ) : the_post();



			// Include the page content template.

		the_content();



			// End of the loop.

		endwhile;

		

		global $wpdb;

		

		if(isset($_GET['city']) && !empty($_GET['city'])){

			$city = $_GET['city'];

			$query = "SELECT id,lat,paddress,home_type,zipcode,lot_sze,sold_date,exhoa,year_built,monthlyrent,lng,beds,full_baths,pprice,city,finished_feet,TRETID FROM wp_home_facts WHERE city = '".$city."'";

			$locationsResult = $wpdb->get_results($query);

			$i = 0;

			$count = count($locationsResult);

			$locations = '';

			foreach($locationsResult as $location){

				$main_id = $location->id;

				$pid = $location->TRETID;

				$latitude = $location->lat;

				$longitude = $location->lng;

				$zipcode = $location->zipcode;

				$address = $location->paddress;

				$sold_date = $location->sold_date;

				$Amount = $location->pprice;

				$year_built = $location->year_built;

				$city = $location->city;

				$beds = $location->beds;

				$monthlyrent = $location->monthlyrent;

				$exhoa = $location->exhoa;

				$bathroomsResult = $location->full_baths;

				$finishedSqFtResult = $location->finished_feet;

				$lotSize = $location->lot_sze;

				$hometype = $location->home_type;

				

				$completeAdd = '<span class=adressbar><b>'.$address.'</b></span>';

				$otherDetails = '<span class=additional_info><span class=left_sec_new><span class=outerRow><span class=inner_row><span class=inner_left>Price:</span><span class=inner_right>$'.get_val_by_number_format($Amount,true).'</span></span></span><span class=outerRow><span class=inner_row><span class=inner_left>Beds:</span><span class=inner_right>'.$beds.'</span></span></span><span class=outerRow><span class=inner_row><span class=inner_left>Baths:</span><span class=inner_right>'.$bathroomsResult.'</span></span></span><span class=outerRow><span class=inner_row><span class=inner_left>Sqft:</span><span class=inner_right>'.$finishedSqFtResult.'</span></span></span><span class=outerRow><span class=inner_row><span class=inner_left>Lot:</span><span class=inner_right>'.$lotSize.'</span></span></span><span class=outerRow><span class=inner_row><span class=inner_left>Type:</span><span class=inner_right>'.$hometype.'</span></span></span></span><span class=right_sec_new><span class=outerRow><span class=inner_row><span class=inner_left>Year Built</span><span class=inner_right>'.$year_built.'</span></span></span><span class=outerRow><span class=inner_row><span class=inner_left>Last Sold</span><span class=inner_right>'.$sold_date.'</span></span></span><span class=outerRow><span class=inner_row><span class=inner_left>HOA</span><span class=inner_right>$'.$exhoa.'</span></span></span><span class=outerRow><span class=inner_row><span class=inner_left>Rent</span><span class=inner_right>$'.get_val_by_number_format($monthlyrent,true).'</span></span></span><span class=outerRow><span class=inner_row><span class=inner_left>TRET ID</span><span class=inner_right>'.$pid.'</span></span></span><span class=outerRow><span class=inner_row><span class=inner_left>MLS</span><span class=inner_right>'.$location->MLSID.'</span></span></span></span></span>';

				$infor = $completeAdd.$otherDetails;

				

				if($address){

					$polyLatLong = '';

					$locations .= '{"title": "'.$address.'", "lat": "'.$latitude.'", "lng": "'.$longitude.'","description": "'.$infor.'","Home_Id": "'.$main_id.'","iconBase": "icon_map.png"},';

					if($latitude){

						if($i == $count-1){

							$polyLatLong .= '{"lat": '.$latitude.', "lng": '.$longitude.'}';

						}else{

							$polyLatLong .= '{"lat": '.$latitude.', "lng": '.$longitude.'},';	

						}

					}

					

					$i++;

				}

				/* $otherFinalDetails .= $bedroomsResult.' Beds'.', '.$bathroomsResult.' Baths'.', '.$finishedSqFtResult.' sqft'; */

			}

			

			$PropertiesCount = $i;

			$mapData = array(

				'mapid'=>'map_canvas',

				'location'=>$locations,

				'polyLatLong'=>$polyLatLong,

				

				);

			get_map_by_location($mapData);

			?>

<div id="search_main_container" class="container">
	

		<div class="main_container_search" style="margin-top:0 !important;">



			<div class="col-md-9 col-lg-9 col-sm-8 col-xs-12 map_img2 no-pad-right no-padding-left">
			<div class="bordered mb10">
			<span class="showingno">Found <?php echo $count; ?> homes in Austin, TX.</span>

			<div class="save_properties">

				<a class="more_filters_wrap save_btn more_filters">

					Filters

					<i class="fa fa-angle-down" aria-hidden="true"></i>

				</a>

				<a class="regularbtn save_btn regularToggle">

					<input type="radio" class="sort" name="saved_status" value="all"  checked onclick="getresult('start')" />

					<label for="regular"></label

						Show All

					</a> 

					<?php if(is_user_logged_in()){?>

					<a class="save_btn savedToggle">

						<input type="radio" class="sort" name="saved_status" value="saved"    onclick="getresult('start')"/>

						<label for="saved"></label

							Show Starred

						</a> 

						<?php }else{ ?>

						<a class="ls-modal-login save_btn">

						<!--input type="radio" class="sort" name="sort" value="8"  id="saved" />

						<label for="saved"></label-->

							Saved

						</a> 	

						<?php } ?>
								</div>
							</div>

						<div id="map_canvas" class="mapping" style="width:100%; height:345px;"></div>


					</div>

					<div class="col-md-3 col-lg-3 col-sm-4 col-xs-12 leftsecn2 no-pad-right">
					<div class="right-info">
						<div class="main-heading bordered-wrap">
							<p style="margin:0;">Average Year One Performance Across All Listing</p>
						</div>
						<div class="right-info-section bordered-wrap col-md-12 col-sm-12 col-xs-12">
							<div class="row bottom-border padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">Gross Income  </div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right">$19,251</div> 
							</div>

							<div class="row bottom-border padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">Total Expenses</div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right">$8396</div> 
							</div>

							<div class="row bottom-border padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">Net Operating Income</div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right">$10854</div> 
							</div>

							<div class="row bottom-border padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">Before-Tax Cash Flow</div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right">$1,757</div> 
							</div>

							<div class="row bottom-border padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">Cash-On-Cash</div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right"> 3.4%</div> 
							</div>

							<div class="row bottom-border padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">After-Tax Cash Flow</div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right">$1,757</div> 
							</div>

							<div class="row bottom-border padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">Total Return</div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right">$4,553</div> 
							</div>

							<div class="row padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">Total ROI</div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right">8.8%</div> 
							</div>
						</div>
						</div>

					<!-- 	<div class="right_panel_1 mCustomScrollbar">

							<div class="stickyWrap">	

								<div class="main_stripe">

									<div class="sortcustom">

										<span class="sorting_custom_wrap">

											

											

											<span class="sortingc asc">Sort

												<div class="funkyradio" id="sorting">	

													<div class="inner_funkyradio">	

														<span class="sortbyascwrapper">							

															<input type="radio" name="sortby" id="sortbyasc" checked="checked" class="sortby" value="asc" style="display:none"/>

															<label class="text" for="sortbyasc">A-Z</label>							

														</span>						

														<span class="sortbydeswrapper">

															<input type="radio" name="sortby" id="sortbydes" class="sortby" value="desc" style="display:none"/>		

															<label class="text" for="sortbydes">Z-A</label>		

														</span>												

														<div class="funkyradio-primary">							

															<input type="radio" class="sort" name="sort" value="0" id="price" />							<label for="price">Price</label>						

														</div>						

														<div class="funkyradio-primary">							

															<input type="radio" class="sort" name="sort" value="1" id="beds" />							

															<label for="beds">Beds</label>						

														</div>						

														<div class="funkyradio-primary">							

															<input type="radio" class="sort" name="sort" value="2"  id="bathrooms" />					

															<label for="bathrooms">Bathrooms</label>						

														</div>						

														<div class="funkyradio-primary">							

															<input type="radio" class="sort" name="sort" value="5"  id="address" />							<label for="address">Address</label>						

														</div>						

														<div class="funkyradio-primary">							

															<input type="radio" class="sort" name="sort" value="6"  id="location" />						<label for="location">Location</label>						

														</div>						

														<div class="funkyradio-primary">							

															<input type="radio" class="sort" name="sort" value="3"  id="sequare-feet" />				

															<label for="sequare-feet">Square feet</label>						

														</div>					

													</div>	

												</div>	

											</span>

										</span>



									</div>

								

										</div>	

									</div>	 -->


<div class="right_panel_2">
<div class="newFilters">

<div class="newFilters_inner_wrap">

<div class="newFilters_inner_wrap2">

	<span class="close"><i class="fa fa-times" aria-hidden="true"></i></span>

	<div class="row main_row_filters">

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0">

			<span class="label">Price</span>

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

				<span class="sectwo">

					<select id="min" value="" class="selectpicker">

						<option value="">No min</option>

						<option value="1">1</option>

						<option value="50000">$50k</option>

						<option value="75000">$75k</option>

						<option value="100000">$100k</option>

						<option value="125000">$125k</option>

						<option value="150000">$150k</option>

						<option value="175000">$175k</option>

						<option value="200000">$200k</option>

						<option value="225000">$225k</option>

						<option value="250000">$250k</option>

						<option value="275000">$275k</option>

						<option value="300000">$300k</option>

						<option value="325000">$325k</option>

						<option value="350000">$350k</option>

						<option value="375000">$375k</option>

						<option value="400000">$400k</option>

						<option value="425000">$425k</option>

						<option value="450000">$450k</option>

						<option value="475000">$475k</option>

						<option value="500000">$500k</option>

						<option value="550000">$550k</option>

						<option value="600000">$600k</option>

						<option value="650000">$650k</option>

						<option value="700000">$700k</option>

						<option value="750000">$750k</option>

						<option value="800000">$800k</option>

						<option value="850000">$850k</option>

						<option value="900000">$900k</option>

						<option value="950000">$950k</option>

						<option value="1000000">$1M</option>

						<option value="1250000">$1.25M</option>

						<option value="1500000">$1.5M</option>

						<option value="1750000">$1.75M</option>

						<option value="2000000">$2M</option>

						<option value="2250000">$2.25M</option>

						<option value="2500000">$2.5M</option>

						<option value="2750000">$2.75M</option>

						<option value="3000000">$3M</option>

						<option value="3250000">$3.25M</option>

						<option value="3500000">$3.5M</option>

						<option value="3750000">$3.75M</option>

						<option value="4000000">$4M</option>

						<option value="4250000">$4.25M</option>

						<option value="4500000">$4.5M</option>

						<option value="4750000">$4.75M</option>

						<option value="5000000">$5M</option>

						<option value="6000000">$6M</option>

						<option value="7000000">$7M</option>

						<option value="8000000">$8M</option>

						<option value="9000000">$9M</option>

						<option value="10000000">$10M</option>

						<!--input type="text" id="min" name="min"-->

					</select>	

				</span>

			</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

					<span class="secfour">

						<select id="max" value="" class="selectpicker">

							<option selected="">No max</option>

							<option value="4">$4</option>

							<option value="50000">$50k</option>

							<option value="75000">$75k</option>

							<option value="100000">$100k</option>

							<option value="125000">$125k</option>

							<option value="150000">$150k</option>

							<option value="175000">$175k</option>

							<option value="200000">$200k</option>

							<option value="225000">$225k</option>

							<option value="250000">$250k</option>

							<option value="275000">$275k</option>

							<option value="300000">$300k</option>

							<option value="325000">$325k</option>

							<option value="350000">$350k</option>

							<option value="375000">$375k</option>

							<option value="400000">$400k</option>

							<option value="425000">$425k</option>

							<option value="450000">$450k</option>

							<option value="475000">$475k</option>

							<option value="500000">$500k</option>

							<option value="550000">$550k</option>

							<option value="600000">$600k</option>

							<option value="650000">$650k</option>

							<option value="700000">$700k</option>

							<option value="750000">$750k</option>

							<option value="800000">$800k</option>

							<option value="850000">$850k</option>

							<option value="900000">$900k</option>

							<option value="950000">$950k</option>

							<option value="1000000">$1M</option>

							<option value="1250000">$1.25M</option>

							<option value="1500000">$1.5M</option>

							<option value="1750000">$1.75M</option>

							<option value="2000000">$2M</option>

							<option value="2250000">$2.25M</option>

							<option value="2500000">$2.5M</option>

							<option value="2750000">$2.75M</option>

							<option value="3000000">$3M</option>

							<option value="3250000">$3.25M</option>

							<option value="3500000">$3.5M</option>

							<option value="3750000">$3.75M</option>

							<option value="4000000">$4M</option>

							<option value="4250000">$4.25M</option>

							<option value="4500000">$4.5M</option>

							<option value="4750000">$4.75M</option>

							<option value="5000000">$5M</option>

							<option value="6000000">$6M</option>

							<option value="7000000">$7M</option>

							<option value="8000000">$8M</option>

							<option value="9000000">$9M</option>

							<option value="10000000">$10M</option>

						</select>

					</span>

				</div>

			</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0">

						<span class="label">Beds</span>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

							<select id="Bedsmin" value="" class="selectpicker">

								<option value="default">No min</option>

								<option value="1">1</option>

								<option value="2">2</option>

								<option value="3">3</option>

								<option value="4">4</option>

								<option value="5">5</option>

								<option value="6">6</option>

							</select>

						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

							<select id="Bedsmax" value="" class="selectpicker">

								<option value="default">No max</option>

								<option value="1">1</option>

								<option value="2">2</option>

								<option value="3">3</option>

								<option value="4">4</option>

								<option value="5">5</option>

								<option value="6">6</option>

							</select>

						</div>

					</div>

				</div>

				<div class="row main_row_filters">

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0">

						<span class="label">Baths</span>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

							<select id="Bathsmin" value="" class="selectpicker">

								<option value="default">No min</option>

								<option value="1">1</option>

								<option value="2">2</option>

								<option value="3">3</option>

								<option value="4">4</option>

								<option value="5">5</option>

								<option value="6">6</option>

							</select>

						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

							<select id="Bathsmax" value="" class="selectpicker">

								<option value="default">No max</option>

								<option value="1">1</option>

								<option value="2">2</option>

								<option value="3">3</option>

								<option value="4">4</option>

								<option value="5">5</option>

								<option value="6">6</option>

							</select>

						</div>

					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0">

						<span class="label">Rent</span>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

							<select id="Rentmin" value="" class="selectpicker">

								<option value="default">No min</option>

								<option value="500">$500/month</option>

								<option value="600">$600/month</option>

								<option value="700">$700/month</option>

								<option value="800">$800/month</option>

								<option value="900">$900/month</option>

								<option value="1000">$1000/month</option>

								<option value="1000">$1100/month</option>

								<option value="1000">$1200/month</option>

								<option value="1000">$1300/month</option>

								<option value="1000">$1400/month</option>

								<option value="1000">$1500/month</option>

								<option value="1000">$1600/month</option>

							</select>

						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

							<select id="Rentmax" value="" class="selectpicker">

								<option value="default">No max</option>

								<option value="500">$500/month</option>

								<option value="600">$600/month</option>

								<option value="700">$700/month</option>

								<option value="800">$800/month</option>

								<option value="900">$900/month</option>

								<option value="1000">$1000/month</option>

								<option value="1000">$1100/month</option>

								<option value="1000">$1200/month</option>

								<option value="1000">$1300/month</option>

								<option value="1000">$1400/month</option>

								<option value="1000">$1500/month</option>

								<option value="1000">$1600/month</option>

							</select>

						</div>

					</div>

				</div>

		<div class="row main_row_filters">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rowicons_div">

				<div class="row">

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0">

						<span class="label">Property Type</span>

					</div>

				</div>

				<div class="row margin0">

					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 pad0 common_home">

						<input type="radio" name="hometypes" class="hometypes" id="SingleFamily" value="Single Family">

						<label class="hometypeslabel" for="SingleFamily">

							<span class="img_wrap"><img src="<?php echo get_template_directory_uri().'/images/single_family_icon.png'; ?>"></span>

							Single Family

						</label>

					</div>

					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 pad0 common_home">

						<input type="radio" name="hometypes" class="hometypes" id="Condo" value="Condo">

						<label class="hometypeslabel" for="Condo">

							<span class="img_wrap"><img src="<?php echo get_template_directory_uri().'/images/condo_icon.png'; ?>"></span>

							Condo</label>

						</div>

						<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 pad0 common_home">

							<input type="radio" name="hometypes" class="hometypes" id="Townhouse" value="Townhouse">

							<label class="hometypeslabel" for="Townhouse">

								<span class="img_wrap"><img src="<?php echo get_template_directory_uri().'/images/townhouse_icon.png'; ?>"></span>

								Town House</label>

							</div>

							<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 pad0 common_home">

								<input type="radio" name="hometypes" class="hometypes" id="MultiFamily" value="Multi Family">

								<label class="hometypeslabel" for="MultiFamily">

									<span class="img_wrap"><img src="<?php echo get_template_directory_uri().'/images/multifamily_icon.png'; ?>"></span>

									Multi Family</label>

								</div>

								<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 pad0 common_home">

									<input type="radio" name="hometypes" class="hometypes" id="Apartment" value="Apartment">

									<label class="hometypeslabel" for="Apartment">

										<span class="img_wrap"><img src="<?php echo get_template_directory_uri().'/images/apartment_icon.png'; ?>"></span>

										Apartment</label>

									</div>

			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 pad0 common_home">

				<input type="radio" name="hometypes" class="hometypes" id="Mobile" value="Mobile">

				<label class="hometypeslabel" for="Mobile">

					<span class="img_wrap"><img src="<?php echo get_template_directory_uri().'/images/mobile_icon.png'; ?>"></span>

					Mobile</label>

				</div>

			</div>

			<div class="row margin0">

				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 pad0 common_home">

					<input type="radio" name="hometypes" class="hometypes" id="CoopUnit" value="Coop Unit">

					<label class="hometypeslabel" for="CoopUnit">

						<span class="img_wrap"><img src="<?php echo get_template_directory_uri().'/images/CoopUnit_icon.png'; ?>"></span>

						Coop Unit</label>

					</div>

					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 pad0 common_home">

						<input type="radio" name="hometypes" class="hometypes" id="VacantLand" value="Vacant Land">

						<label class="hometypeslabel" for="VacantLand">

							<span class="img_wrap"><img src="<?php echo get_template_directory_uri().'/images/Vacant-Land.png'; ?>"></span>

							Vacant Land</label>

						</div>

						<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 pad0 common_home">

							<input type="radio" name="hometypes" class="hometypes" id="Other" value="Other">

							<label class="hometypeslabel" for="Other">

								<span class="img_wrap"><img src="<?php echo get_template_directory_uri().'/images/townhouse_icon.png'; ?>"></span>

								Other</label>

							</div>

						</div>

					</div>

				</div>

				<div class="row main_row_filters">

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0">

						<span class="label">Finished Square Feet</span>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

							<select id="SquarefeetMin" value="" class="selectpicker">

								<option value="default">No min</option>

								<option value="500">500</option>

								<option value="750">750</option>

								<option value="1000">1,000</option>

								<option value="1250">1,250</option>

								<option value="1500">1,500</option>

								<option value="1750">1,750</option>

								<option value="2000">2,000</option>

								<option value="2250">2,250</option>

								<option value="2500">2,500</option>

								<option value="2750">2,750</option>

								<option value="3000">3,000</option>

								<option value="3500">3,500</option>

								<option value="4000">4,000</option>

								<option value="5000">5,000</option>

								<option value="7500">7,500</option>

							</select>

						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

							<select id="SquarefeetMax" value="" class="selectpicker">

								<option value="default">No max</option>

								<option value="500">500</option>

								<option value="750">750</option>

								<option value="1000">1,000</option>

								<option value="1250">1,250</option>

								<option value="1500">1,500</option>

								<option value="1750">1,750</option>

								<option value="2000">2,000</option>

								<option value="2250">2,250</option>

								<option value="2500">2,500</option>

								<option value="2750">2,750</option>

								<option value="3000">3,000</option>

								<option value="3500">3,500</option>

								<option value="4000">4,000</option>

								<option value="5000">5,000</option>

								<option value="7500">7,500</option>

							</select>

						</div>

					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0">

						<span class="label">Lot Size</span>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

							<select id="LotsizeMin" value="" class="selectpicker">

								<option value="default">No min</option>

								<option value="4500">4,500 sq ft</option>

								<option value="6500">6,500 sq ft</option>

								<option value="8000">8,000 sq ft</option>

								<option value="10890">.25 acres</option>

								<option value="21780">.5 acres</option>

								<option value="43560">1 acre</option>

								<option value="87120">2 acres</option>

								<option value="130680">3 acres</option>

								<option value="174240">4 acres</option>

								<option value="217800">5 acres</option>

								<option value="435600">10 acres</option>

								<option value="1742400">40 acres</option>

								<option value="4356000">100 acres</option>

							</select>

						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

							<select id="LotsizeMax" value="" class="selectpicker">

								<option value="default">No max</option>

								<option value="4500">4,500 sq ft</option>

								<option value="6500">6,500 sq ft</option>

								<option value="8000">8,000 sq ft</option>

								<option value="10890">.25 acres</option>

								<option value="21780">.5 acres</option>

								<option value="43560">1 acre</option>

								<option value="87120">2 acres</option>

								<option value="130680">3 acres</option>

								<option value="174240">4 acres</option>

								<option value="217800">5 acres</option>

								<option value="435600">10 acres</option>

								<option value="1742400">40 acres</option>

								<option value="4356000">100 acres</option>

							</select>

						</div>

					</div>

				</div>

				<div class="row main_row_filters">

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0">

						<span class="label">Year Built</span>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

							<select id="YearBuiltMin" value="" class="selectpicker">

								<option value="default">No min</option>

								<?php														

								$startYear = '1920';

								$endYear = date("Y");

								for($i = $startYear;$i <= $endYear;$i++){

									echo '<option value="'.$i.'">'.$i.'</option>';

								}

								?>

							</select>

						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

							<select id="YearBuiltMax" value="" class="selectpicker">

								<option value="default">No max</option>

								<?php														

								$startYear = '1920';

								$endYear = date("Y");

								for($i = $startYear;$i <= $endYear;$i++){

									echo '<option value="'.$i.'">'.$i.'</option>';

								}

								?>

							</select>

						</div>

					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad0">

						<span class="label">Max HOA Fees</span>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

							<select id="HOAFeesMin" value="" class="selectpicker">

								<option value="default">No min</option>

								<option value="25">$25/month</option>

								<option value="50">$50/month</option>

								<option value="75">$75/month</option>

								<option value="100">$100/month</option>

								<option value="150">$150/month</option>

								<option value="200">$200/month</option>

								<option value="250">$250/month</option>

								<option value="300">$300/month</option>

								<option value="400">$400/month</option>

								<option value="500">$500/month</option>

								<option value="600">$600/month</option>

								<option value="700">$700/month</option>

								<option value="800">$800/month</option>

								<option value="900">$900/month</option>

								<option value="1000">$1000/month</option>

							</select>

						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

							<select id="HOAFeesMax" value="" class="selectpicker">

								<option value="default">No max</option>

								<option value="25">$25/month</option>

								<option value="50">$50/month</option>

								<option value="75">$75/month</option>

								<option value="100">$100/month</option>

								<option value="150">$150/month</option>

								<option value="200">$200/month</option>

								<option value="250">$250/month</option>

								<option value="300">$300/month</option>

								<option value="400">$400/month</option>

								<option value="500">$500/month</option>

								<option value="600">$600/month</option>

								<option value="700">$700/month</option>

								<option value="800">$800/month</option>

								<option value="900">$900/month</option>

								<option value="1000">$1000/month</option>

							</select>

						</div>

					</div>

				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0 bottom_stripe">

					<span class="applyfilters">Apply Filters</span>

				</div>

			</div>

		</div>

	</div>



	<table id="propertyListingTbl" class="propTab">

		<thead>

			<tr>

				<div class="sortContainer">

					<th class="propSort">Price</th>

					<th class="propSort" style="display:none !important;">Beds</th>

					<th class="propSort" style="display:none !important;">bathrooms</th>

					<th class="propSort">Sort By Sqft.</th>

					<th style="display:none !important;">Data</th>									<th class="propSort" style="display: none!important;">Address</th>

					<th class="propSort" style="display:none !important;">Location</th>

					<th class="propSort" style="display:none !important;">Hometype</th>

					<th class="propSort" style="display:none !important;">Finished Squarefeet</th>

					<th class="propSort" style="display:none !important;">Lost size</th>

					<th class="propSort" style="display:none !important;">Year Built</th>

					<th class="propSort" style="display:none !important;">HOA</th>

					<th class="propSort" style="display:none !important;">Rent</th>

	<!--th class="propSort" style="display:none !important;">Saved</th>

	<th class="propSort" style="display:none !important;">unaved</th-->

	</div>

</tr>

							<!--tr>

								<td colspan="3">

									<div class="main_titile">

										<span><strong>Showing <?php /* echo $PropertiesCount; */ ?> Properties</strong></span>

									</div>

								</td>

							</tr-->

						</thead>

						<tbody>	

							<?php

							$city = $_GET['city'];

							$listquery = "SELECT id,ptitle,user_id,home_type,lat,lng,images,sold_date,saved_status_user_id,paddress,zipcode,city,pprice,beds,lot_sze,full_baths,finished_feet,year_built,monthlyrent,exhoa,TRETID FROM wp_home_facts WHERE city = '".$city."'";

							/* $wpdb->get_results($query); */

							$listingResult = $wpdb->get_results($listquery);	

							/* 	pt($listingResult); */

							$main_count = 1;	

							$map_count = 0;	

							foreach($listingResult as $location){

								$id = $location->id;

								$pid = $location->TRETID;

								$user_id = $location->user_id;

								$saved_status_user_id = unserialize($location->saved_status_user_id);

								$latitude = $location->lat;

								$longitude = $location->lng;

								$rent = $location->monthlyrent;

								$hometype = $location->home_type;

								$address = $location->paddress;

								$zipcode = $location->zipcode;

								$Amount = $location->pprice;

								$sold_date = $location->sold_date;

								$lotSize = $location->lot_sze;

								$city = $location->city;

								$bedroomsResult = $location->beds;

								$bathroomsResult = $location->full_baths;

								$finishedSqFtResult = $location->finished_feet;

								$yBuilt = $location->year_built;

								$exhoa = $location->exhoa;

								$pImages = unserialize($location->images);

								$from = 'presult';

								$userArr = array($user_id);	

								$saved_array = $saved_status_user_id;

								

								if(is_user_logged_in()){

									if(is_array($saved_array) && in_array($agentID, $saved_array)){

										$value = 'saved';

									}else{

										$value = 'unsaved';

									}

								}else{

									$value = '';

								}

								

								?>

								<tr class="tdWrap <?php echo $value; ?>">								

									<td class="price" style="display:none!important;">

										<?php echo $Amount; ?>

									</td>

									<td class="beds" style="display:none!important;">

										<?php echo $bedroomsResult; ?>

									</td>

									<td class="bathrooms" style="display:none!important;">

										<?php echo $bathroomsResult; ?>

									</td>

									<td class="propertyCarouselWrap" style="display:none!important;">



									</td>

									<!-- <td class="desSec propertyDesc">

										<div class="overRelay"></div>

										<div id="markers"></div>

										<div class="main_wrap new_style_property">

											<div class="address" data-id="<?php echo $id;?>" rel="<?php echo $agentID;?>" value="<?php echo $id;?>">

												<a class="marker-link" data-markerid="<?php echo $map_count; ?>" ><?php echo $address; ?></a>

												<span class="loading_heart">

													<img src="<?php echo get_template_directory_uri().'/images/loading_heart.gif'; ?>">

												</span>

												

												<?php if(is_user_logged_in()){?>

												<?php if($value == 'unsaved'){ ?>

												<i class="ajax_saved fa fa-heart-o common_ajax_icon" aria-hidden="true" onclick="mark_saved(this);"></i>

												<?php }else{ ?>

												<i class="ajax_remove fa fa-heart common_ajax_icon" aria-hidden="true" onclick="remove_saved(this);"></i>

												<?php } ?>

												<?php }else{ ?>

												<i class="ls-modal-login fa fa-heart-o common_ajax_icon" aria-hidden="true"></i>

												<?php } ?>

											</div>

											<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 pad0 pull-right">

												<div class="inner_4_wrap">

													<div class="owl-carousel" id="propertySlider">	

														<?php

														$imgCounts = count($pImages);

														if(!empty($pImages)){	

															$count = 1;

															foreach($pImages as $pImage){	

																$imageName = $pImage;

																/* if($imageName != 'null'){ */

																	$inser_url = site_url().'/wp-content/uploads/properties_gallery/'.$imageName;	

																	?>

																	<div class="item">										

																		<div class="sliderContainer" data="<?php echo $main_count; ?>" rel="<?php echo $count; ?>">	

																			<img src="<?php if($inser_url != '' ){ echo $inser_url; }else{ echo get_template_directory_uri().'/images/EstateDefault.jpg'; }  ?>">

																		</div>

																	</div>

																	<?php 

																	$count++;

																	/* } */

																} 



															}else{

																?>

																<img class="img-responsive" src="<?php echo get_template_directory_uri().'/images/EstateDefault.jpg'; ?>">

																<?php } ?>

															</div>

															<script>

																jQuery(document).ready(function(){

																	jQuery(".owl-carousel").owlCarousel({

																		slideSpeed : 300,						

																		loop:true,

																		margin:10,

																		nav:true,

																		navText: ["<i class='fa fa-angle-left custom_left_icon' aria-hidden='true'></i>","<i class='fa fa-angle-right custom_right_icon' aria-hidden='true'></i>"],

																		items:1,

																		animateOut: 'fadeOut',

														/* afterMove: function (elem) {

														  var current = this.currentItem;

														  var src = elem.find(".owl-item").eq(current).find("img").attr('src');

														  console.log('Image current is ' + src);

														} */

													});

													// jQuery method on

													

												});

											</script>

										</div>

										<div class="images_count">

											<?php if($imgCounts == 0){ ?>

											N/A

											<?php }else{ ?>

											<span class="regular_count my_count_<?php echo $main_count; ?>">1</span> of <span class="total_count"><?php echo $imgCounts; ?></span>

											<?php } ?>

										</div> -->

									</div>



									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0">

										<div class="inner_8_wrap">

											

											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-6 p-l-0">

												<div class="left_info common_style">

<!-- 
													<div class="borderwrap">

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 headlabel">Price</div> 

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 text_align_r">$<?php //echo get_val_by_number_format($Amount,true); ?></div> 

													</div>

													<div class="borderwrap">

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 headlabel">Beds</div> 

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 text_align_r"><?php //echo $bedroomsResult; ?></div> 

													</div>

													<div class="borderwrap">

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 headlabel">Baths</div> 

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 text_align_r"><?php //echo $bathroomsResult; ?></div> 

													</div>

													<div class="borderwrap">

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 headlabel">Sqft</div> 

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 text_align_r"><?php //echo $finishedSqFtResult; ?></div> 

													</div>

													<div class="borderwrap">

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 headlabel">Lot</div> 

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 text_align_r"><?php //echo $lotSize; ?></div> 

													</div>

													<div class="borderwrap">

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 headlabel">Type</div> 

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 text_align_r"><?php //echo $hometype; ?></div> 

													</div>
 -->
												<!-- 	<div class="borderwrap">

                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 headlabel">TRET ID</div> 

                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 text_align_r"><?php// echo $location->TRETID; ?></div> 

                                                    </div> -->

												</div>

											</div>

										<!-- 	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l-0 p-l-01">

												<div class="right_info common_style">

													<div class="borderwrap">

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 headlabel">Year Built</div> 

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 text_align_r"><?php echo $yBuilt; ?></div> 

													</div>

													<div class="borderwrap">

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 headlabel">Last Sold</div> 

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 text_align_r"><?php echo ($sold_date)?$sold_date:'N/A'; ?></div> 

													</div>

													<div class="borderwrap">

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 headlabel">HOA</div> 

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 text_align_r">$<?php echo $exhoa; ?></div> 

													</div>

													<div class="borderwrap">

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 headlabel">Rent</div> 

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 text_align_r">$<?php echo get_val_by_number_format($rent,true); ?></div> 

													</div>

													<div class="borderwrap">

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 headlabel">TRET ID</div> 

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 text_align_r"><?php echo $pid; ?></div> 

													</div>

													<div class="borderwrap">

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 headlabel">MLS</div> 

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad0 text_align_r"><?php echo $location->MLSID; ?></div> 

													</div>



													

												</div>

											</div> -->

										</div>

									</div>


									</div>

								</td>							

								<td class="address" style="display:none;">								

									<?php echo $address; ?>							

								</td>							

								<td class="location" style="display:none;">								

									<?php echo $city; ?>							

								</td>

								<td class="hometype_list" style="display:none;">								

									<?php echo $hometype; ?>							

								</td>

								<td class="finishedSqFtResult" style="display:none;">								

									<?php echo $finishedSqFtResult; ?>							

								</td>

								<td class="lotSize" style="display:none;">								

									<?php echo $lotSize; ?>							

								</td>

								<td class="YearBuilt" style="display:none;">								

									<?php echo $yBuilt; ?>							

								</td>

								<td class="MaxHOAFees" style="display:none;">								

									<?php echo $exhoa; ?>							

								</td>

								<td class="rent" style="display:none;">								

									<?php echo $rent; ?>							

								</td>

							</tr>

							<?php 

							

							$main_count++;

							$map_count++;

						}	 

						

						

						?>

						<div id="msgsResult" style="display:none;">

							<i class="fa fa-exclamation-triangle fa_custom" aria-hidden="true"></i>

							<p class="textWrap"><?php echo $msgsResult; ?></p>

							<div class="backbtnWrapper">

								<a class="searchPage" href="<?php echo site_url(); ?>">Back to Search Page</a>

							</div>

						</div>

						<script>

									/* jQuery(document).ready(function(){

										fnDrawCallback: function (settings) {

											jQuery("#propertyListingTbl").parent().toggle(settings.fnRecordsDisplay() > 0);

										}										

									});

									*/

								</script>

							</tbody>

						</table>

						<link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">

						<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>

						<script src="<?php echo get_template_directory_uri(); ?>/js/properties_listing.js"></script>

					</div>

				</div>


<div id="overlay"><div><img src="https://media.giphy.com/media/6L84czrwSd9DO/giphy.gif" width="64px" height="64px"/></div></div>
<div class="page-content">

	<input type="hidden" name="pagination-setting" id="pagination-setting" value="prev-next"/>
	<div id="pagination-result">
	<input type="hidden" name="rowcount" id="rowcount" />
	<input type="hidden" id="next_page" name="next_page" value="" />
<input type="hidden" id="previous_page" name="previous_page" value="" />
	</div>
</div>




			</div>

		</div>

		<?php 	}else{ ?>

		<div class="fa_customWrapper">

			<!--i class="fa fa-exclamation-triangle fa_custom" aria-hidden="true"></i-->

			<p class="textWrap"><?php echo $msg; ?></p>

			<div class="backbtnWrapper">

				<a class="searchPage" href="<?php echo site_url(); ?>">

					Coming Soon

				</a>

			</div>

		</div>

		<?php } ?>

	</main><!-- .site-main -->

</div><!-- .content-area -->




<script>
function getresult(type,home_id='') {
	var page = '';
	if(type == 'next'){
		page = jQuery("#next_page").val();
	}
	else if(type == 'previous'){
		page = jQuery("#previous_page").val();
	}
	else if(type == 'start'){
		page = '';
	}

	url = '<?php echo get_template_directory_uri(); ?>/gethomeresult.php';
	jQuery.ajax({
		url: url,
		type: "POST",
		data:  {rowcount:jQuery("#rowcount").val(),"pagination_setting":jQuery("#pagination-setting").val(), page:page, city:'<?php echo $city; ?>',
		home_id:home_id,
		saved_status: jQuery('input[name="saved_status"]:checked').val()
	},
		beforeSend: function(){jQuery("#overlay").show();},
		success: function(data){

		jQuery("#pagination-result").html(data);
		jQuery(".owl-carousel").owlCarousel({
		slideSpeed : 300,						
		loop:true,
		margin:10,
		nav:true,
		navText: ["<i class='fa fa-angle-left custom_left_icon' aria-hidden='true'></i>","<i class='fa fa-angle-right custom_right_icon' aria-hidden='true'></i>"],
		items:1,
		animateOut: 'fadeOut',
		});

		},
		complete: function(){
		setTimeout(function() {jQuery("#overlay").hide()}, 500);
		},
		error: function() 
		{} 	        
   });
}
function changePagination(option) {
	if(option!= "") {
		getresult("<?php echo get_template_directory_uri(); ?>/gethomeresult.php");
	}
}

getresult("start");

</script>

<?php

echo get_template_part('js/property_listing_ajax');

get_footer(); ?>