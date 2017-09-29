<?php
/**
 * Template Name: Zillow Api Search
 *
 */

get_header(); 

?>

<div id="primary" class="content-area container">
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
			$query = "SELECT lat,paddress,lng,beds,full_baths,pprice,city,finished_feet FROM wp_home_facts WHERE city = '".$city."'";
			$locationsResult = $wpdb->get_results($query);
			$i = 0;
			foreach($locationsResult as $location){
				$latitude = $location->lat;
				$longitude = $location->lng;
				$address = $location->paddress;
				$Amount = $location->pprice;
				$city = $location->city;
				$bedroomsResult = $location->beds;
				$bathroomsResult = $location->full_baths;
				$finishedSqFtResult = $location->finished_feet;
				
				$completeAdd = $address.', '.$zipcode;
				$otherDetails = $bedroomsResult.' Beds'.', '.$bathroomsResult.' Baths'.', '.$finishedSqFtResult.' sqft';
				$AmountDetail = '$'.get_val_by_number_format($Amount,true).' Price Estimate';
				
				$infor = $completeAdd.'<br>'.$otherDetails.'<br>'.$AmountDetail;
				
				if($address){
					$locations .= '{"title": "'.$address.'", "lat": "'.$latitude.'", "lng": "'.$longitude.'","description": "'.$infor.'"},';
					$i++;
				}
				$otherFinalDetails .= $bedroomsResult.' Beds'.', '.$bathroomsResult.' Baths'.', '.$finishedSqFtResult.' sqft';
			}
			
			$PropertiesCount = $i;
			$mapData = array(
				'mapid'=>'map_canvas',
				'location'=>$locations,
				'description'=>$otherFinalDetails,
				'statename'=>$stateFullName
			);
			get_map_by_location($mapData);
		?>

		<div class="main_container_search">
			
			<div class="main_titile">
				<h4>Found <?php echo $PropertiesCount; ?> properties for sale.</h4>
			</div>
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 map_img">
				
				<div id="map_canvas" class="mapping" style="width:568px; height:800px; border: 2px solid #3872ac;"></div>
			</div>
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 leftsecn">
				<div class="right_panel_1">
					<ul>
					<table id="propertyListingTbl">
						<thead>
							<tr>
								<th>Sort By Price</th>
								<th>Sort By Sqft.</th>
								<th style="display:none;">Data</th>
							</tr>
						</thead>
					<tbody>	
						<?php
								$city = $_GET['city'];
								$listquery = "SELECT ptitle,images,paddress,zipcode,city,pprice,beds,full_baths,finished_feet,zipcode,year_built,monthlyrent FROM wp_home_facts WHERE city = '".$city."'";
								$wpdb->get_results($query);
								$listingResult = $wpdb->get_results($listquery);
								foreach($listingResult as $location){
									$latitude = $location->lat;
									$longitude = $location->lng;
									$rent = $location->monthlyrent;
									$address = $location->paddress;
									$zipcode = $location->zipcode;
									$Amount = $location->pprice;
									$city = $location->city;
									$bedroomsResult = $location->beds;
									$bathroomsResult = $location->full_baths;
									$finishedSqFtResult = $location->finished_feet;
									$pImages = unserialize($location->images);
									/* pt($images); */
									$from = 'presult';
						
						?>
						<tr class="tdWrap">
							<td style="display:none;"><?php echo ($Amount)?  get_val_by_double_commas_format($Amount,true) : 'Not Available'; ?></td>
							<td>
								<div class="img-wraper">
									<div class="img-wrpa">
									<?php 
									
										if(!empty($pImages)){	
											$count = 0;
											foreach($pImages as $pImage){
												if($count == 1){
													
												
												/* $imageid = $result->id;	
												$image = $result->image; */	
												$imageName = $pImage;	
												if($imageName != 'null'){
													$inser_url = site_url().'/wp-content/uploads/properties_gallery/'.$imageName;
									?>
										<img src="<?php if($inser_url != '' ){ echo $inser_url; }else{ echo get_template_directory_uri().'/images/realhs.png'; }  ?>">
										
									<?php	
												}
												}	
												$count++;
											}
										}else{
									?>
										
											<img src="<?php echo get_template_directory_uri().'/images/realhs.png'; ?>">
									<?php		
										}
											
									?>
										
										
									
									</div>
								</div>
								<span style="display:none;"><?php echo ($finishedSqFt)? $finishedSqFt : ''; ?></span>
							</td>
							<td class="desSec">
							<li>
								
								<div class="right_content">
									<div class="details">
										<h3 class="zipWrap"><?php echo $address.' '.$zipcode; ?></h3>
										<h2 class="bedWarp"><?php echo $bedroomsResult.' Beds'.', '.$bathroomsResult.' Baths'.', '.$finishedSqFtResult.' sqft.'; ?></h2>
										<!--p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php /* echo $FullStateName; */ ?></p-->
										<span class="amountWrap on"><?php echo ($Amount)? '$'.get_val_by_double_commas_format($Amount,true).' Price Estimate' : 'Not Available'; ?></span>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn_warp">
										<a class="homeDetails" target="_blank" href="<?php echo $homeDetails; ?>">See More Details</a>
										<?php if(!is_user_logged_in()){ ?>
											<a href="javascript:void(0);" class="ls-modal-login visulise_btn calculate_btn mainpPrice">
											<input type="hidden" id="hprice" name="price" value="<?php echo get_val_by_double_commas_format($Amount,true); ?>">
											<input type="hidden" id="hrent" name="rent" value="<?php echo $rent; ?>">
											<input type="hidden" id="hfrom" name="downpayment" value="<?php echo $from; ?>">
											CALCULATE</a>
										<?php }else{ ?>
											<a href="<?php echo get_the_permalink('107').'?price='.base64_encode($Amount).'&from='.$from.'&rent='.base64_encode($rent); ?>" class="visulise_btn calculate_btn">CALCULATE</a>
										<?php } ?>	
									</div>
									
								</div>
							</li>
							</td>
							</tr>
							<?php }	 ?>
								<div id="msgsResult" style="display:none;">
									<i class="fa fa-exclamation-triangle fa_custom" aria-hidden="true"></i>
									<p class="textWrap"><?php echo $msgsResult; ?></p>
									<div class="backbtnWrapper">
										<a class="searchPage" href="<?php echo site_url(); ?>">Back to Search Page</a>
									</div>
								</div>
								<script>
									jQuery(document).ready(function(){
										fnDrawCallback: function (settings) {
											jQuery("#propertyListingTbl").parent().toggle(settings.fnRecordsDisplay() > 0);
										}
									});
								</script>
							</tbody>
						</table>	
					</ul>
					<link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
					<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

					<script>
					jQuery(document).ready(function(){
						jQuery('#propertyListingTbl').DataTable({
							"pagingType": "full_numbers",
							"lengthMenu": [[6, 12, 25, -1], [4, 16, 32,"All"]],
							'iDisplayLength': 4,
							language: {
								searchPlaceholder: "Search Records By Purchase Price, Sqft."
							}
						});
						/* var table = jQuery('#propertyListingTbl').DataTable({
							columnDefs : [
								{ 
								  targets: [2],
								  render: function ( data, type, full, meta ) {                  
									  if (type == 'sort') {
										  return $(data).find('span').hasClass('on') ? 1 : 0;
									  }  else {
										  return data;
									  }    
								  }   
							   }
							]                                     
						}); */
					});
					</script>
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

<?php
		
	
get_footer(); ?>