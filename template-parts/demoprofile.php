<?php
/**
 * Template Name: Demo Profile
 *
 */

get_header(); 

?>
<style>

.customprofile_breadcrumb{
	font-family: "RubikRegular";
	padding:0;
	/* list-style-type: none; */
}
.main_Container{
	font-family: "RubikRegular";
}
.customprofile_breadcrumb li{
	display: inline-block;
}
.customprofile_breadcrumb li a{
	text-decoration: none;
	color:#aaa;
	font-size: 12px;
	display: inline;
}
.customprofile_breadcrumb li:not(:last-child):after{
	content:"\2022";
	margin-left:4px;
	color:#aaa;
	font-size:8px;
}

.profilesection_container .profileimage_container{
	width: 200px;
	height: 150px;
	display: table-cell;
    vertical-align: middle;
	border-right:5px solid #ddd;	    
    margin-right: 30px;
    position: relative;    
}
.profilesection_container .profileimage_container img{
	max-width: 100%;
	width: 150px;
	position: absolute;
    top: 0;
    bottom: 0;    
    left: 0;
    margin: auto;    
    border-radius: 50%;
    border:1px solid #ddd;
}
.profilesection_container{
    padding-right:0;
    padding-left:0;
}
.profilesection_container .profiledesc_container{
	display: table-cell;
	vertical-align: middle;
}
.profilesection_container .profiledesc_container .profile_teammember{
	padding-left: 10px;
	color:#999;
	font-size:12px;
}
.profilesection_container .profiledesc_container .profile_teammember a{
	text-transform: uppercase;
	color:inherit;
}
.profilesection_container .profiledesc_container .profile_username{
	padding-left:10px;	
	text-transform: capitalize;
	word-wrap: break-word;
}
.profilesection_container .profiledesc_container .profile_username .prof_name{
	display: inline-block;
	font-size:36px;	
}
.profilesection_container .profiledesc_container .achivement_label{
	border:1px solid #999;
	color:#999;
	border-radius: 3px;
	font-size: 11px;
	font-weight: 600;
	width: 60px;
    display: inline-block;
    font-weight: 600;
    text-align: center;
    padding: 3px;
    line-height: 10px;
    margin:0 10px;
}
.profilesection_container .profiledesc_container .review_container{
	background-color: #eee;
	padding:10px;
	width: 200px;
	min-height: 82px;
}
.profilesection_container .profiledesc_container .review_container .review_list{
	list-style-type: none;
	padding:0;
	margin:0;
}
.form_inner [class*='col-'] {
    padding-right:0;
    padding-left:0;
}
.form_maincontainer a{
	color: inherit;
}
.form_maincontainer .form_teamhead1{
	font-size: 13px;
	display: inline-block;
}
.form_maincontainer .form_teamhead2{
	font-size: 20px;
	display: inline-block;
	word-wrap: break-word;
	text-transform: uppercase;
}
.form_inner{
	border:1px solid #ddd;
	padding:5px 15px;
	margin-bottom: 15px;
}
.form_maincontainer .form_reviews{
	word-wrap: break-word;
	text-align: right;
}
.star-icon{
	color:#ea0011;
}
.form_maincontainer .teamreviewslist{
	display: block;
	list-style-type:none;
	padding:0;
	margin:0;
}
.form_maincontainer .teamreviewslist li{
	display: inline-block;	
}
.contct_container{
	border:1px solid #ddd;
}
.contct_container .contact_form .form-group{
	 margin:0;
}
.contct_container .contact_heading{
	margin:10px 0 !important;
	font-size:20px;
	display: block;
}
.contct_container .contact_submit{
	background: #fff;
    border: 2px solid #ea0011;
    border-radius: 5px;
    color: #ea0011;
    height: 40px;
    min-width: 130px;
    width: 100%;
    text-align: center;
    transition: 0.4s;
    margin: 0 0 15px 0;
}
.contct_container .contact_submit:hover{
	background: #ea0011;
    color: #fff;
}
.contct_container .form_label{
	font-size:12px;
	margin:3px 0;
	visibility: hidden;
}
.contct_container .label_error{
	color:red;
}
.profilesection_container .common_heading,.profilesection_container .common_headingsmall{
	font-size:28px;
	display: block;
	margin:15px 0; 	
}
.profilesection_container .common_headingsmall{
	font-size:20px !important;
}
.profilesection_container .listing_counting{
	vertical-align: super;
}
.profilesection_container .user_skills dt,.profilesection_container .user_skills dd{
	display: inline-block;
}
.form_maincontainer .information_container{
	border:1px solid #ddd;
	margin:15px 0;
}
.form_maincontainer .information_list{
	display: inline-block;
	list-style-type: none;
	width: 100%;
	padding:0;
	margin-bottom:5px;
}
.form_maincontainer .information_list li{
	display: inline-block;
	width: 50%;
	float: left;
	margin:5px 0;
}
.form_maincontainer .information_list li:nth-child(odd){
	font-weight: 600;
}
.form_maincontainer .pro_heading{
	font-size: 20px;
    margin: 10px 0;
    display: block;
}
.profilesection_container .listing_heading{
	display: inline-block !important;
}
.profilesection_container .prof_container{
	display: table;
	width: 100%;
	table-layout: fixed;
}

@media (max-width: 767px){
	.profilesection_container .profiledesc_container .profile_username .prof_name{
		display: block;
	}
	.profilesection_container .profiledesc_container .achivement_label{		
		margin:10px 5px 10px 0;
	}
	.profilesection_container .profileimage_container img{
		right:0;
	}
}
@media (max-width: 600px){
	.profilesection_container{
		text-align: center;
	}
	.profilesection_container .profiledesc_container .profile_teammember{
		margin-top:5px;
	}
	.profilesection_container .profileimage_container,.profilesection_container .profiledesc_container{
		width: 100%;
		float: left;
		border:none;
	}
	.profilesection_container .profiledesc_container{
		text-align: center;
	}
	.profilesection_container .profiledesc_container .review_container{
		width: 100%;
	}
}
</style>

<?php
// Start the loop.
while ( have_posts() ) : the_post();
	$id = get_the_ID();
	$profileImgid = get_post_thumbnail_id($id);
	$profileImg = wp_get_attachment_url($profileImgid);
	$checkId = get_post_meta($id,'custom_user_id', true);
	$userImg = get_avatar_url($checkId);
	$telephone = get_user_meta($id,'telephone',true);
	$Useraddress = get_user_meta($id,'Useraddress',true);
	$website_user = get_user_meta($id,'website_user',true);
	$screenname = get_user_meta($id,'screenname',true);
	$description = get_user_meta($id,'aboutdes',true);
	
  
?>
<!-- Breadcrumb -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<ol class="customprofile_breadcrumb">
			  <li><a href="#">Texas</a></li>
			  <li><a href="#">Austin</a></li>
			  <li><a href="#">Author Name</a></li>  
			</ol>
		</div>
	</div>
</div>
<!-- End of Breadcrumb -->


<div class="container">
	<div class="row">
	<!-- Profile section -->
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profilesection_container">
			<div class="prof_container">			
				<div class="profileimage_container">
					<?php if($userImg){ ?>
							<img src="<?php echo $userImg; ?>" alt="profile-image"/>
					<?php }else{ ?>
							<img src="<?php echo get_template_directory_uri(); ?>/images/profile-placeholder.jpg">
					<?php 	} ?>
				</div>					
				<div class="profiledesc_container">

					<div class="profile_teammember">
						<i class="fa fa-users"></i>
						 Team Member Of <a href="#">TYCOONS</a>
					</div>

					<div class="profile_username">
						<span class="prof_name"><?php the_title(); ?></span>
						<span class="achivement_label">Premier Agent</span>
						<a href="#"><i class="fa fa-flag"></i></a>
					</div>

					<div class="review_container">
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
	
				</div>
			
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<span class="common_heading">About</span>
				<span class="common_headingsmall">Realtor</span>
				<dl class="user_skills">
				<dt>Specialties:</dt> 
				<dd>Buyer's Agent,</dd> 
				<dd>Listing Agent,</dd> 
				<dd>Relocation</dd> 
				</dl>
				<p><?php echo($description) ? $description : ''; ?></p>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<span class="common_heading">Listings & Sales</span>
				<div style="width:100%;height:300px;border:1px solid #ddd">MAP</div>
			</div>
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<span class="common_heading listing_heading">Active Listings</span> <span class="listing_counting">( 4 )</span>					
			</div>

		</div>
		<!-- Profile section ends -->

		<!-- Contact Form -->
		<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 form_maincontainer">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form_inner">
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
				<form class="contact_form">				  
					<span class="contact_heading">Contact Agent</span>

					<div class="form-group">					
				    <input type="text" class="form-control" id="username" placeholder="Name">				 
				 	<label class="form_label label_error">This field is required*</label>
					</div>

					<div class="form-group">
				    <input type="tel" class="form-control" id="phone" placeholder="Phone">
				    <label class="form_label label_error">This field is required*</label>			    
				    </div>
				 
				 	<div class="form-group">
				    <input type="email" class="form-control" id="email" placeholder="Email">
				    <label class="form_label label_error">This field is required*</label>
				    </div>
					
					<div class="form-group">
				    <textarea rows="5" class="form-control"></textarea>
				    <label class="form_label label_error">This field is required*</label>
				    </div>

				  	<button type="submit" class="contact_submit">Contact</button>
				</form>				
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
						<li><?php echo($website_user)? $website_user : 'Not Available'; ?></li>
						<li>Screen name:</li>
						<li><?php echo($screenname)? $screenname : 'Not Available'; ?></li>
						<li>Member since:</li>
						<li>06/30/2014</li>
					</ul>
				</div>
			</div>
		</div>		
		
	</div>

<?php 

	endwhile;
		
/* pt($_REQUEST); */
get_footer(); ?>