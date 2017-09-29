<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
	<?php endif; ?>
	<!-- 	<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">  -->
	<?php wp_head(); ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/top.js"></script>
</head>
<style>
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con {position: fixed;left: 0px;top: 0px;width: 100%;height: 100%;z-index: 99999;background: url(<?php echo  get_template_directory_uri();?>/images/loading_spinner.gif) center no-repeat #fff;}
/*.disableClick{
    pointer-events: none;
}*/
.disableClick{
	display: none;
}

</style>
<script>

	jQuery('#bs-navbar .login').click(function(){
		var priceNull = createCookie('purchasePrice','null');
		var dpNull = createCookie('downPayment','null');
	});
	jQuery('select.selectpicker').on('click', function(){
		alert('hello');
		jQuery('.bootstrap-select').removeClass('open');
		jQuery(this).addClass('open');
	});
	function createCookie(name, value, days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			var expires = "; expires=" + date.toGMTString();
		}
		else var expires = "";               

		document.cookie = name + "=" + value + expires + "; path=/";
	}

	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
		}
		return null;
	}

	function eraseCookie(name) {
		createCookie(name, "", -1);
	}
</script>

<body <?php body_class(); ?>>

	<?php



/* $parsed = parse_url( wp_get_attachment_url( 190) );
echo $url    = dirname( $parsed [ 'path' ] ) . '/' . rawurlencode( basename( $parsed[ 'path' ] ) ); */
/* echo get_attached_file( 190, false ); */

?>
<div class="se-pre-con"></div>
<div id="page" class="site">
	<div class="site-inner">
		<header class="bs-docs-nav navbar navbar-static-top navbar-default mainheaderposition" id="masthead"> 
			<div class="container"> 
				<div class="navbar-header"> 
					<button aria-controls="bs-navbar" aria-expanded="false" class="collapsed navbar-toggle" data-target="#bs-navbar" data-toggle="collapse" type="button"> 
						<span class="sr-only">Toggle navigation</span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span> 
					</button> 
					<a class="navbar-brand desktop-hide" title="RealEstate Tycoons" href="<?php echo home_url();?>">
						<span> The RealEstate Tycoons</span></a>
					</div> 

					<nav class="collapse navbar-collapse" id="bs-navbar"> 
						<?php
						wp_nav_menu( array(
							'menu' => 'primary',
							'menu_class'     => 'nav navbar-nav',
							) );
							?>
							<ul class="nav navbar-nav navbar-right"> 
								<?php
								if(!is_user_logged_in()){ ?>
								<li><a class="login ls-modal-login" href="javascript:void(0);"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</a></li> 
								<li><a class="login ls-modal-joinin" href="javascript:void(0);"><i class="fa fa-user-plus" aria-hidden="true"></i>Sign Up</a></li>
								<?php } else { ?>
								<li><a class="login" href="<?php echo site_url().'/your-profile/'; ?>"><i class="fa fa-user-plus" aria-hidden="true"></i>My Profile</a></li> 
								<li><a class="login" onclick="deleteAllCookies()" href="<?php echo wp_logout_url(home_url()); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i>
									LogOut</a></li>
									<?php } ?>
								</ul> 
							</nav> 
						</div> 
					</header>

					<div id="content" class="site-content">
						<!-- AJAX Login Start-->
						<div class="signup_modal">
							<div class="modal fade" id="myLoginPopupModal" role="dialog">
								<div class="modal-dialog">

									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"><img src="<?php echo site_url(); ?>/wp-content/uploads/2017/06/close-btn.png"/></button>
											<h4 class="modal-title">Welcome Back!</h4>
										</div>
										<?php 
										if(isset($_GET['key']) && $_GET['key'] != '')
										{
			// Include the page content template.
											if(isset($_GET['user']) && $_GET['user'] !='' )
											{

												?>	
												<div class="alert alert-success" style="margin-top:15px;">
													<strong>Success!</strong> Your account has been activated, login to continue.
												</div>
												<?php 


												$id = base64_decode($_GET['user']);
												delete_user_meta( $id, 'has_to_be_activated');
											}
										}	
										?>
										<div class="modal-body">
											<a class="modal-btns fb fbloginpopup" href="<?php echo site_url();?>/?loginFacebook=1&redirect=<?php echo site_url();?>" onclick="window.location = '<?php echo site_url();?>/?loginFacebook=1&redirect='+window.location.href; return false;" >
												<i class="fa fa-facebook" aria-hidden="true"></i> Login with Facebook
											</a>
											<a href="<?php echo site_url();?>/login/?loginGoogle=1&redirect=<?php echo site_url();?>" onclick="window.location = '<?php echo site_url();?>/login/?loginGoogle=1&redirect='+window.location.href; return false;" class="modal-btns google">
												<i class="fa fa-google-plus" aria-hidden="true"></i>
												Login with Google
											</a>
											<form name="loginformpopup" id="loginformpopup" class="loginformpopup" action="#" method="post">
												<div id="resulted"></div>
												<input type="hidden" id="purchasePrice" name="price" value="">
												<input type="hidden" id="downPayment" name="downpayment" value="">
												<input type="hidden" id="From" name="from" value="">
												<div id="result"><span class="error"></span></div>
												<div class="input_block">
													<input name="username" id="username" type="text" class="form-control" placeholder="Email Address">
													<i class="fa fa-envelope" aria-hidden="true"></i>
												</div>
												<div class="input_block">
													<input name="password" id="password" type="password" class="form-control" placeholder="Password">
													<i class="fa fa-unlock-alt" aria-hidden="true"></i>
												</div>
												<button type="submit" id="login_submit" class="modal-btns sign-up">Log In 
													<i class="fa fa-share-square-o" aria-hidden="true"></i>
												</button>
												<?php wp_nonce_field( 'ajax-estatelogin-nonce', 'security' ); ?>
												<span class="lostPassWrap">
													<a href="<?php echo get_site_url().'/resetpass'?>">Lost Password?</a>
												</span>
											</form>

										</div>
										<div class="modal-footer">	
										</div>
									</div>

								</div>
							</div>
						</div>
						<!-- AJAX Login End-->

						<!-- AJAX SignUP Start-->
						<div class="signup_modal">
							<div class="modal fade" id="myJoininPopupModal" role="dialog">
								<div class="modal-dialog">

									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"><img src="<?php echo site_url();?>/wp-content/uploads/2017/06/close-btn.png"/></button>
											<h4 class="modal-title">Ready to Join?</h4>
											<?php
											if((isset($_GET['fbau']) && $_GET['fbau'] == 'false') || (isset($_GET['gau']) && $_GET['gau'])){
												?>  
												<div class="alert alert-danger newAlert" style="display:none;">
													Email Id Or Username Already Exist.<br/> Please Sign Up With Different Account.
												</div>
												<?php } ?>
											</div>
											<div class="modal-body">
												<div id="error-message"></div>

												<span class="modal-btns fb fbDisable" style="opacity: 0.7;"><i class="fa fa-facebook" aria-hidden="true"></i> Sign Up with Facebook</span>
												<span class="fbError"></span>
												<?php /*disableClick class used for disable this google button and trigger*/ ?>
												<a class="modal-btns fb fbenable disableClick"><i class="fa fa-facebook" aria-hidden="true"></i> Sign Up with Facebook
													<img class="common_thirdparty_logo" src="<?php echo get_template_directory_uri().'/images/image_1114484.gif'; ?>">
												</a>

												<a  style="display:none;" class="facebookaftersession" href="<?php echo site_url();?>/?loginFacebook=1&redirect=<?php echo site_url();?>" onclick="window.location = '<?php echo site_url();?>/?loginFacebook=1&redirect='+window.location.href; return false;"><i class="fa fa-facebook" aria-hidden="true"></i> Sign Up with Facebook</a>
												<span class="modal-btns google googleDisable" style="opacity: 0.7;">
													<i class="fa fa-google-plus" aria-hidden="true"></i>
													Sign Up with Google
												</span>
												<span class="googleError"></span>		
												<?php /*disableClick class used for disable this google button and trigger*/ ?>
												<a class="modal-btns google googleenable disableClick">
													<i class="fa fa-google-plus" aria-hidden="true"></i>
													Sign Up with Google
													<img class="common_thirdparty_logo" src="<?php echo get_template_directory_uri().'/images/image_1114484.gif'; ?>">
												</a>
												<a style="display:none;" href="<?php echo site_url();?>/login/?loginGoogle=1&redirect=<?php echo site_url();?>" onclick="window.location = '<?php echo site_url();?>/login/?loginGoogle=1&redirect='+window.location.href; return false;" class="google_triggerbtn">
													<i class="fa fa-google-plus" aria-hidden="true"></i>
													Sign Up with Google
												</a>		
												<form name="joininformpopup" id="joininformpopup" class="loginformpopup" action="#" method="post">

													<div class="input_block">
														<input name="user_full_name" id="user_full_name" type="text" class="form-control" placeholder="Full Name">
														<i class="fa fa-user" aria-hidden="true"></i>
													</div>
													<div class="input_block">
														<input name="user_email" id="user_email" type="text" class="form-control" placeholder="Email Address">
														<i class="fa fa-envelope" aria-hidden="true"></i>
													</div>
													<div class="input_block">
														<input name="user_password" id="user_password" type="password" class="form-control" placeholder="Password">
														<i class="fa fa-unlock-alt" aria-hidden="true"></i>
													</div>
													<div class="input_block">
														<input name="user_confirm_password" id="user_confirm_password" type="password" class="form-control" placeholder="Confirm Password">
														<i class="fa fa-unlock-alt" aria-hidden="true"></i>
													</div>
			<!--div class="input_block">
				<input name="user_phone_no" id="user_phone_no" type="text" class="form-control" placeholder="Phone Number (Optional)">
				<i class="fa fa-mobile" aria-hidden="true"></i>
			</div-->
			
			<div class="radioButton">
				<div class="aggrement_wrapper">
					<div class="text_wrap">
						<a href="#" style="font-size:17px;">Terms of Service</a><br>
						It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
						It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
						It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
						It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
						It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
					</div>
					<div class="lable2">
						<input type="checkbox" value="" name="normaluser" id="normaluser" class="form-control terms_policy user_agent_policy">
						<label for="normaluser">
							<p>
								I agree with the <a href="">Terms of Service</a>.
							</p>
						</label>
					</div>
					<!--div class="lable3">
						<input type="checkbox" value="" name="disagreeuser" id="disagreeuser" class="form-control terms_policy user_agent_policy">
						<label for="disagreeuser">
							<p>
								I disagree with the <a href="">Terms of Service</a>.	
							</p>
						</label>
					</div-->
				</div>
				<div class="lable1">
					<input type="checkbox" value="" name="agent" id="user_agent" class="form-control terms_policy user_agent_policy">
					<label for="user_agent">
						<p>I am a registered Real Estate Agent.</p>
					</label>
					<div id="agent-error" class="error"></div>
				</div>
				
				<!--div class="lable4">
					<input type="checkbox" value="" checked="checked" name="agent" id="normal_agent" class="form-control terms_policy user_agent_policy">
					<label for="normal_agent">
						<p>I am not a registered Real Estate Agent.</p>
					</label>
					<div id="agent-error" class="error"></div>
				</div-->
				
			</div>
			
			<button type="submit" id="joinin_submit" class="modal-btns sign-up" style="opacity: 0.7;">Sign Up 
				<i class="fa fa-share-square-o" aria-hidden="true"></i>
			</button>
			<p class="alreadyhvac">
				Already have an account?  
				<a href="#" class="ls-modal-login"> 
					Log In 
				</a>	
			</p>
		</form>	
	</div>
	<div class="modal-footer">	
	</div>
</div>

</div>
</div>
</div>
<!-- AJAX SignUP End-->

<script>
	jQuery(document).ready(function($){
		$('.ls-modal-login a').attr('href','javascript:void(0);');

		$('#myLoginPopupModal').on('hidden.bs.modal', function (e) {
			$(this).find('form')[0].reset();
			$('header.mainheaderposition').removeClass('disableNav');
		})

		$('#myJoininPopupModal').on('hidden.bs.modal', function (e) {
			$(this).find('form')[0].reset();
			$('header.mainheaderposition').removeClass('disableNav');
		})

		$('#myJoininPopupModal').click(function(){
			$('body').removeClass('oveflow');	
		});

		/* Ajax Login Modal Start*/
		$('.ls-modal-login').on('click', function(e){
			e.preventDefault();
			setTimeout(function(){ $('body').addClass('modal-open'); }, 500);
			$('header.mainheaderposition').addClass('disableNav');
			$('#myJoininPopupModal').modal('hide');
			$('#myLoginPopupModal').modal('show');
			$('#myLoginPopupModal').modal({backdrop: 'static', keyboard: false});
		});
		/* Ajax Login Modal End*/

		/* Ajax SignUP Modal Start*/
		$('.ls-modal-joinin').on('click', function(e){
			e.preventDefault();
			$('body').addClass('oveflow');	
			$('header.mainheaderposition').addClass('disableNav');
			$('#myLoginPopupModal').modal('hide');
			$('#myJoininPopupModal').modal('show');
			$('#myJoininPopupModal').modal({backdrop: 'static', keyboard: false});
		});
		/* Ajax SignUP Modal Start*/

		<?php 

		if((isset($_GET['fbau']) && $_GET['fbau'] != '') || (isset($_GET['gau']) && $_GET['gau'] != '')){
			unset($_SESSION['role']);
			?>
			$('.ls-modal-joinin').trigger('click');
			$('.newAlert').show();
			$('.newAlert').delay(6000).fadeOut();
			<?php } ?>
			
		});

	</script>
	<?php


	if((isset($_GET['key']) && $_GET['key'] != '') || (isset($_GET['au']) && $_GET['au'] != '')){ ?>
	<script>
		
		jQuery(document).ready(function(){	
			jQuery('.ls-modal-login').trigger('click');
		});
		
	</script>
	<?php } 


	?>