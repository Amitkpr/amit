<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header(); 

?>
<?php
// Start the loop.
while ( have_posts() ) : the_post();
	
	$id = get_the_ID();
	/* echo '<br/>'; */
	$authorID = get_post_field( 'post_author', $id );
	/* echo '<br/>';
	echo get_avatar_url($authorID);  */
	/* echo '<br/>'; */
	 
	/* echo '<br/>'; */
	$UserID = get_current_user_id();
	$userData = get_userdata($authorID);
	$role = user_role();
	$USerEmail = $userData->data->user_email;
	$USerRegistered = $userData->data->user_registered;
	$registerArr = explode(' ',$USerRegistered);
	/* pt($registerArr); */
	$memberSince =  date("d/m/Y", strtotime($registerArr[0])); 
	$profileImgid = get_post_thumbnail_id($id);
	$profileImg = wp_get_attachment_url($profileImgid);
	$checkId = get_post_meta($id,'custom_user_id', true);
	$userImg = get_avatar($authorID);
	/* parse_str(get_avatar_url($authorID),$userImg); */
	$fbUserImg =  get_user_meta($authorID, 'fb_profile_picture', true);
	$googleUserImg =  get_user_meta($authorID, 'google_profile_picture', true);
	
	/* $telephone = get_metadata($authorID,'Useraddress',true); */
	$telephone = get_user_meta($UserID,'telephone',true); 
	$Useraddress = get_user_meta($authorID,'Useraddress',true);
	$website_user = get_user_meta($authorID,'website_user',true);
	$screenname = get_user_meta($authorID,'screenname',true);
	$description = get_user_meta($authorID,'aboutdes',true);
	$userAgentID = get_post_meta($id,'custom_user_id',true); 

?>
<div class="container main_Container">
	<div class="row" style="display:none;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<ol class="customprofile_breadcrumb" >
			  <li><a href="#">Texas</a></li>
			  <li><a href="#">Austin</a></li>
			  <li><a href="#">Author Name</a></li>  
			</ol>
		</div>
	</div>
	<div class="row">
	<!-- Profile section -->
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 profilesection_container">
			<div class="prof_container">			
				<div class="profileimage_container">
					<?php
					
					/* pt($userImg); */
					 if($userImg != ''){ 
						echo $userImg;
					 ?>
					 		<!-- <img src="</div>/?php echo $userImg; ?>" alt="profile-image"/>"
							
							<img class="img-responsive" src="<?php/*  echo get_avatar_url($authorID); */ ?>"> -->
					<?php }elseif($fbUserImg !=''){ ?>
						<img class="img-responsive" src="<?php echo $fbUserImg; ?>">
					<?php }elseif($googleUserImg != ''){ ?>
						<img class="img-responsive" src="<?php echo $googleUserImg; ?>">
					<?php }else{ ?>
							<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/profile-placeholder.jpg">"
					<?php 	} ?>
				</div>					
				<div class="profiledesc_container">

					<div class="profile_teammember" style="display:none;">
						<i class="fa fa-users"></i>
						 Team Member Of <a href="#">TYCOONS</a>
					</div>

					<div class="profile_username">
						<span class="prof_name"><?php the_title(); ?></span>
						<span class="prof_role">
						<?php 
							if($role != 'dataentry'){
								echo '('.ucfirst($role).')'; 
							}
						?>
						</span>
						<span class="prof_role" style="display:block;font-size:15px;">
							Member Since: <?php echo $memberSince; ?>
						</span>
						<!--span class="achivement_label">Premier Agent</span-->						
						<!-- <h4><strong>Realtor</strong></h4> -->
						<!--dl class="user_skills">
							<dt>Specialties:</dt> 
							<dd>Buyer's Agent,</dd> 
							<dd>Listing Agent,</dd> 
							<dd>Relocation</dd> 
						</dl-->						
					</div>

					<div class="review_container" style="display:none;">
						<ul class="review_list">
							<li>All Activities</li>
							<li><i class="fa fa-star star-icon"></i>
								<i class="fa fa-star star-icon"></i>
								<i class="fa fa-star star-icon"></i>
								<i class="fa fa-star star-icon"></i>
								<i class="fa fa-star star-icon"></i>
								<a href="#">10 Reviews</a>
							</li>							
							<li>15 sales in last 10 months</li>
						</ul>
					</div>
					<?php 
					
						/* $UserID = get_current_user_id();
	$userData = get_userdata($authorID); */
					
					if((is_user_logged_in()) && ($UserID == $authorID)){?>
					<div class="editProfileContainer">
						<a href="<?php echo site_url(); ?>/your-profile/" class="hidden-mobile" title="Edit Profile">Edit Profile <i class="fa fa-pencil"></i></a>
						<a href="<?php echo site_url(); ?>/your-profile/" class="display-mobile" title="Edit Profile"><i class="fa fa-user"></i></a>
					</div>
					<?php } ?>
				</div>
			
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<span class="common_heading">About</span>				
				<p><?php echo($description) ? $description : 'No Description Available Here.'; ?></p>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section_margin">
				<span class="common_heading">Listings & Sales</span>
				<?php
				
					global $wpdb;
					$mapQuery = "select id,lat,lng,ptitle,paddress,zipcode,city,pprice,user_id from wp_home_facts where user_id = $userAgentID";
					/* pt($mapQuery); */
					$mapResults = $wpdb->get_results($mapQuery);
					foreach($mapResults as $mapResult){
						$latitude = $mapResult->lat;
						$longitude = $mapResult->lng;
						$ptitle = $mapResult->ptitle;
						$pprice = $mapResult->pprice;
						$address = $mapResult->paddress;
						$description = '<strong>Title: </strong>'.$ptitle.'</br><strong>Address: </strong>'.$address.'</br><strong>Price: </strong>$'.$pprice;
						if($address != ''){
							$locations .= '{"title": "'.$ptitle.'", "lat": "'.$latitude.'", "lng": "'.$longitude.'","description": "'.$description.'"},';
						}
					}
					if(!empty($locations)){
						$mapData = array(
							'mapid'=>'map_canvas',
							'location'=>$locations,
							'description'=>$description,
							'statename'=>''
						);
						get_map_by_location($mapData);	
						echo '<div id="map_canvas" class="mapping" style="width:100%; height:400px; border: 2px solid #3872ac;"></div>';
					}else{
						echo '<iframe allowfullscreen="" class="maps" style="width:100%; height:400px; border: 2px solid #3872ac;" frameborder="0" id="mapnavi" name="mapnavi" src="https://www.google.com/maps/embed/v1/directions?origin=current+location&destination=usa&key=AIzaSyC-5CY9mOCeg5Y3IhPqi_Yd0-DZtWrJl-E"></iframe>';
					}
					
				?>
				
				
				

				<!--iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d6846.536832058635!2d75.83493928200073!3d30.907120625236846!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1495797042128" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe-->
			</div>
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section_margin">
				<span class="common_heading listing_heading">Active Listings</span> <span class="listing_counting"></span>	

				<table id="ProperyListing">
					<thead>
						<tr>
							<th>PROPERTY ADDRESS</th>
							<th>BED / BATH</th>
							<th>PRICE($)</th>
						</tr>
					</thead>
					<tbody>	
					<?php 
					global $wpdb;
					$query = "select id,ptitle,paddress,zipcode,city,pprice,user_id,beds,home_type,full_baths from wp_home_facts where user_id = $userAgentID";
					$results = $wpdb->get_results($query);
					foreach($results as $result){
						$pid = base64_encode($result->id);
						$user_Id = $result->user_id;
						$meta_key = 'educatorSPUpload'.$pid;
						$images = get_user_meta($user_Id,$meta_key,true);
						$ptitle = $result->ptitle;
						$paddress = $result->paddress;
						$zipcode = $result->zipcode;
						$city = $result->city;
						$pprice = $result->pprice;
						
						$name = $result->home_type;
						$bed = $result->beds;
						$baths = $result->full_baths;
						if($bed > 1){
							$bedResult = $bed.' Beds';
						}else{
							$bedResult = $bed.' Bed';
						}
						
						if($baths > 1){
							$bathsResult = $baths.' Baths';
						}else{
							$bathsResult = $baths.' Bath';
						}
						
						
				?>
				<tr>
						<td style="width: 40%;">
							<div class="imgcntWrapper">
								<div class="leftWrapper"> 
									<?php
									$i = 1;
									/* pt($images); */
									if(!empty($images)){
										foreach($images as $image){
											if($i == 1){
												echo '<a><img width="110" height="75" src="'.$image.'" alt="'.$paddress.'"></a>';	
											}
											$i++;
										}	
									}else{
										$Image = get_template_directory_uri().'/images/realhs.png';
										echo '<a><img src="'.$Image.'" alt="'.$paddress.'"></a>';
									}
									
									
									?>
								</div>
								<div class="rightWrapper">
									<a> 
										<span class="address-line address-street"><?php echo $name; ?></span> 
										<br><span class="address-line address-city-state-zip"><?php echo $ptitle; ?></span> 
									</a> 
								</div>
							</div>
						</td>
						<td>
							<div class="zsg-lg-1-4 zsg-md-hide zsg-sm-hide al-bed-bath sh-cell"><?php echo $bedResult.', '.$bathsResult; ?></div>
						</td>
						<td>
							<div class="zsg-lg-1-4 zsg-md-1-4 zsg-sm-1-3 sh-sold-price sh-cell">$<?php echo $pprice; ?></div>
						</td>
					</tr>
				<?php } ?>
					</tbody> 
				</table>	
			</div>
			<script src="https://code.jquery.com/jquery-1.11.3.js"
			  integrity="sha256-IGWuzKD7mwVnNY01LtXxq3L84Tm/RJtNCYBfXZw3Je0="
			  crossorigin="anonymous"></script>
			  
			<link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
			<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

			<script>
			jQuery(document).ready(function(){
				jQuery('#ProperyListing').DataTable({
					"pagingType": "full_numbers"
					}
				);	  

			});
			</script>

		</div>
		<!-- Profile section ends -->

		<!-- Contact Form -->
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form_maincontainer">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form_inner" style="display:none;">
				<div class="col-lg-7 form_teammember">
					<a href="#">
					<span class="form_teamhead1">Team Member of</span>
					<span class="form_teamhead2">Tycoons</span>
					</a>
				</div>
				<div class="col-lg-5 form_reviews">
					<ul class="teamreviewslist">
						<li><i class="fa fa-star star-icon"></i></li>
						<li><i class="fa fa-star star-icon"></i></li>
						<li><i class="fa fa-star star-icon"></i></li>
						<li><i class="fa fa-star star-icon"></i></li>
						<li><i class="fa fa-star star-icon"></i></li>
					</ul>					
					<span class="team_reviews">303 Reviews</span>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contct_container">
			
				<script>
					jQuery(document).ready(function(){
						jQuery('#newdynamicid').val('<?php echo $USerEmail; ?>');
					});
				</script>
				<span class="contact_heading">Contact <?php the_title(); ?></span>
			
				<input type="hidden" name="user" id="userId" value="<?php echo $userAgentID; ?>">
				<?php echo do_shortcode('[contact-form-7 id="294" title="Custom Form"]'); ?>
				<!--form class="contact_form" method="POST" action="">				  
					
					<div class="form-group">					
				    <input type="text" name="name" class="form-control" id="username" placeholder="Name">				 
				 	<label class="form_label label_error">This field is required*</label>
					</div>

					<div class="form-group">
				    <input type="tel" name="phone" class="form-control" id="Phone" placeholder="Phone">
				    <label class="form_label label_error">This field is required*</label>			    
				    </div>
				 
				 	<div class="form-group">
				    <input type="email" name="email" class="form-control" id="Email" placeholder="Email">
				    <label class="form_label label_error">This field is required*</label>
				    </div>
					
					<div class="form-group">
				    <textarea rows="5" name="des" class="form-control" id="enquiryMessage"></textarea>
				    <label class="form_label label_error">This field is required*</label>
				    </div>
				    <div class="submitbtn_container">		
				  		<a type="submit" class="contact_submit">Contact</a>
				  	</div>
				</form-->				
			</div>
			<!-- End of Contact form -->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 information_container">
				<span class="pro_heading">Professional Information</span>
					<ul class="information_list">
						<li>Address:</li>
						<li><?php echo($Useraddress)? $Useraddress : 'Not Available'; ?></li>
						<li>Phone:</li>
						<li><?php echo($telephone)? $telephone : 'Not Available'; ?></li>
						<li>Websites:</li>
						<li><a href="<?php echo($website_user)? $website_user : ''; ?>"><?php echo($website_user)? 'Click here to visit' : 'Not Available'; ?></a></li>
						<li>Screen name:</li>
						<li><?php echo($screenname)? $screenname : 'Not Available'; ?></li>
						<li>Member since:</li>
						<li><?php echo $memberSince; ?></li>
					</ul>
				</div>
			</div>
		</div>		
		
	</div>
	<script>
	/* jQuery(document).ready(function(){
		jQuery('.contct_container .wpcf7-form .wpcf7-submit').click(function(){
			var name = jQuery('.text-459 input').val();
			var Phone = jQuery('.tel-513 input').val();
			var Email = jQuery('.email-993 input').val();
			var UserID = jQuery('#User_ID').val();
			var enquiryMessage = jQuery('.your-message .textarea').val();
			if(name != ''){
				jQuery.ajax({
					type: 'POST',
					dataType: 'json',
					url: '<?php echo admin_url('admin-ajax.php'); ?>/mail_enquiry',	
					data: { 
						'action': 'mail_enquiry',
						'userEmail': name, 
						'Phone': Phone, 
						'Email': Email, 
						'user_id': UserID, 
						'enquiryMessage': enquiryMessage, 
					},	
					success: function(data){
						
					}
				});	
			}
			
		});
	}); */
</script>
<?php 

endwhile;

get_footer(); 


?>