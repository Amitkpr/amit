<?php  
/* 
Template Name: Reset password
*/
get_header(); 
global $wpdb, $user_ID;
if (!$user_ID) 
{ ?>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

<div id="primary" class="content-area container">
	<main id="main" class="site-main" role="main">
		<?php
		while ( have_posts() ) : the_post();
		the_content();
		endwhile;
		?>
		<div class="signUpPageMain">
			<div class="text-center">
				<div class="resetpass_form"> 
					<div class="popup_login">
						<?php
						if((isset($_REQUEST['update_confirm'])) AND ($_REQUEST['update_confirm']='update_confirm') )
						{
						$new_password=$_POST['newpass'];
						$user_login=$_POST['useremail'];
						$reset_key =$_POST['key'];
						$user_data = $wpdb->get_row($wpdb->prepare("SELECT ID, user_login, user_email FROM $wpdb->users WHERE user_login = %s", $user_login));
						$user_login = $user_data->user_login;
						$user_email = $user_data->user_email;
						if(!empty($reset_key) && !empty($user_data)) {
							wp_set_password(wp_slash($new_password), $user_data->ID);
								
								echo '<span class="success">You password has been changed. Now you can login with your new password</span>';
								?>
								<script>    
									redirecturl = '<?php echo get_site_url() ?>/?resetPass=true';
									setTimeout(function () {
									window.location.href = redirecturl;
									}, 2000);
								</script>
						<?php }
						else exit('Not a Valid Key.');
						}

						if( (isset($_REQUEST['update'])) AND ($_REQUEST['update']=='update'))
							{
							$uemail = $_REQUEST['uemail'];
							$rowcount = $wpdb->get_row($wpdb->prepare("SELECT ID FROM $wpdb->users WHERE user_login = %s", $uemail));
							if($rowcount){
							 retrieve_passwordCustom($uemail);
							echo "<span class='msgg-ok'>Check your e-mail for the confirmation link.</span>";
							}
							else
							{
						   echo '<div style="text-align:center; font-size:16px;" class="error">There is no user registered with that email.</div>';
							 }
							}
						if( (isset($_REQUEST['action'])) AND ($_REQUEST['action']=='rp')) {?>
							<span class="signup_header">RESET PASSWORD</span>
							<form action="" method="post" id="setPass" class="loginformpopup">
							<p class="ResetTag">Please enter your new password.</p>
							
							<div class="form-group">
								<input name="newpass" id="newpass" class="form-control" placeholder="Enter new password" type="password">
								<i class="fa fa-key fa-rotate-90" aria-hidden="true"></i>
							</div>
							
							<div class="form-group">
								<input name="repeatpass" id="repeatpass" class="form-control" placeholder="Confirm new password" type="password">
								<i class="fa fa-key fa-rotate-90" aria-hidden="true"></i>
							</div>
							
							<div class="btn-section">
								<input id="joinin_submit" class="login_submit" name="submit" value="Change Password" type="submit">
							</div>
							<input type="hidden" name="update_confirm"  value="update_confirm"/>
							<input type="hidden" value="<?php echo $_REQUEST['login'];?>" name="useremail" />
							<input type="hidden" name="key" value="<?php echo $_REQUEST['key'];?>" />
							</form>
						<?php }
						elseif(isset($_GET['action']) && $_GET['action'] == "reset_success") {
							echo '<span class="success">You password has been changed. Now you can login with your new password</span>';
						} 
						else {
						?>
							<span class="signup_header">Forget PASSWORD</span>
							<form action="" method="post" id="Resetpass" class="loginformpopup">
							 <p class="ResetTag">Please enter your username or email address.You will receive a link to create a new password via email.</p>
							 
							 <div class="form-group">
								<input name="uemail" id="uemail" class="form-control" placeholder="Enter E-mail Address" type="text">
								<i class="fa fa-envelope-o" aria-hidden="true"></i>
							</div>
							
							<div class="btn-section">
								<input id="joinin_submit" class="login_submit" name="submit" value="Get New Password" type="submit">
							</div>
							<input type="hidden" name="update" value="update"/>
							</form>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</main><!-- .site-main -->
</div><!-- .content-area -->
<?php } else {
		wp_redirect( home_url() ); exit;
		}
	get_footer(); ?>