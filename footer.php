<?php

/**

 * The template for displaying the footer

 *

 * Contains the closing of the #content div and all content after

 *

 * @package WordPress

 * @subpackage Twenty_Sixteen

 * @since Twenty Sixteen 1.0

 */

?>

<?php

$get_site_url = get_site_url();

$footerContent = realestate_options('footer_content');

$footerLogo = realestate_options('custom_logo', '', 'url');



if(empty($footerContent)){

	$footerContent = '© 2017 <a href="'.$get_site_url.'">TheRealEstateTycoons</a> All rights reserved';

}

$followusTitle = realestate_options('realestate_footer_followus_title');

if(empty($followusTitle)){

	$followusTitle = 'Follow us';

}

$followusFbLink = realestate_options('realestate_footer_followus_fb_url');

$followusTwLink = realestate_options('realestate_footer_followus_tw_url');

$followusInsLink = realestate_options('realestate_footer_followus_insta_url');





?>



</div><!-- .site-content -->



<footer id="colophon" class="site-footer" role="contentinfo">

	<div class="container">

		<div class="row">

			

			<div class="col-md-7 col-lg-7 col-sm-7 col-xs-12 footer_content_sec">

				<?php echo $footerContent; ?> Total Visitors : 0008

			</div>

			

			<?php if($footerLogo){?>

			<div class="col-md-1 col-lg-1 col-sm-1 col-xs-12 footer_logo">

				<img src="<?php echo $footerLogo; ?>" class="vc_single_image-img attachment-full" alt="">

			</div>

			<?php } ?>

			<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 footer_follows_sec">

				<div class="footer_followus_title">

					<ul>

						<?php echo '<li><span>'.$followusTitle.'</span></li>'; 

						if($followusFbLink !=''){

							echo '<li><a href="#"><i class="fa fa-facebook"></i></a></li>';

						}

						if($followusTwLink !=''){

							echo '<li><a href="#"><i class="fa fa-twitter"></i></a></li>';

						}

						if($followusInsLink !=''){

							echo '<li><a href="#"><i class="fa fa-instagram"></i></a></li>';

						}	

						?>

					</div>

				</div>

				

			</div>

		</div>

	</footer><!-- .site-footer -->

</div><!-- .site-inner -->

</div><!-- .site -->

<script>

	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');



	ga('create', 'UA-96128162-1', 'auto');

	ga('send', 'pageview');



</script>

<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript">

	jQuery(document).ready(function(){
		jQuery('.paypalForm #field_1-1 #subject_1 ,.paypalForm #field_1-2 #message_1').removeClass('required');
		jQuery('.paypalForm #field_1-1 ,.paypalForm #field_1-2').addClass('hide');
		/*jQuery('.selectpicker').selectpicker({
			  style: 'btn-info',
			  size: 4,
			});*/

	});


</script>
<script>
	jQuery(document).ready(function(){
		jQuery(document).on('click','#user_owner',function(){
			if(jQuery(this).is(":checked")){
				jQuery('#user_agent').attr('checked', false);
			}
		});
		jQuery('#user_agent').click(function(){
			if(jQuery(this).is(":checked")){
				jQuery('#user_owner').attr('checked', false);
			}
		});	
		jQuery('.modal-btns.fb.fbenable').click(function(){
			if((jQuery('#user_agent').is(":checked")) && (jQuery('#normaluser').is(":checked"))){
				jQuery('.fbenable .common_thirdparty_logo').show();
				var str = 'action=ajax_for_fb_session&role=agent';
				jQuery.ajax({  
					context: this,      
					url: "<?php echo home_url();?>/wp-admin/admin-ajax.php",
					type: 'POST',             
					data: str,
					success: function(response) {						
						jQuery('.facebookaftersession').trigger('click');
						jQuery('.fbenable .common_thirdparty_logo').hide();
					} 
				});
				
			}else if((!jQuery('#user_agent').is(":checked")) && (jQuery('#normaluser').is(":checked"))){
				jQuery('.fbenable .common_thirdparty_logo').show();
				var str = 'action=ajax_for_fb_session&role=subscriber';
				jQuery.ajax({  
					context: this,  
					url: "<?php echo home_url();?>/wp-admin/admin-ajax.php",
					type: 'POST',  
					data: str,
					success: function(response) {
						jQuery('.facebookaftersession').trigger('click');
						jQuery('.fbenable .common_thirdparty_logo').hide();
					}  
				});
			}
		});
		
		jQuery('.google.googleenable').click(function(){
			
			if((jQuery('#user_agent').is(":checked")) && (jQuery('#normaluser').is(":checked"))){
				
				var str = 'action=ajax_for_google_session&role=agent';
				jQuery('.googleenable .common_thirdparty_logo').show();
				jQuery.ajax({  

					context: this,      

					url: "<?php echo home_url();?>/wp-admin/admin-ajax.php",

					type: 'POST',             

					data: str,

					success: function(response) {
						
						jQuery('.google_triggerbtn').trigger('click');
						jQuery('.googleenable .common_thirdparty_logo').hide();
						
					}           

				});
				
			}else if((!jQuery('#user_agent').is(":checked")) && (jQuery('#normaluser').is(":checked"))){
				
				var str = 'action=ajax_for_google_session&role=subscriber';
				jQuery('.googleenable .common_thirdparty_logo').show();
				jQuery.ajax({  

					context: this,      

					url: "<?php echo home_url();?>/wp-admin/admin-ajax.php",

					type: 'POST',             

					data: str,

					success: function(response) {
						
						jQuery('.google_triggerbtn').trigger('click');
						jQuery('.googleenable .common_thirdparty_logo').hide();
						
					}  
				});
			}	
		});




	});

	function goto_search(){
if(jQuery('#city_search').val() != ''){
	var link = jQuery('#city_search').find(":selected").data('link');
	window.location.href = link;
	}
}
</script>

<?php wp_footer(); ?>

</body>

</html>