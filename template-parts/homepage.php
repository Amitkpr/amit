<?php
/**
 * Template Name: Home Page
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
		?>

	</main><!-- .site-main -->

</div><!-- .content-area -->
<script>



function deleteAllCookies() {
	/* alert('1213'); */
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}
	
jQuery(document).ready(function(){
	var price = readCookie('purchasePrice');
	var downpayment = readCookie('downPayment');
	/* alert(price); */
	var priceResult = price.replace(/,/g , 'null');
	var downpaymentResult = downpayment.replace(/,/g , ''); 
	var path = 'home';
	if(price != ''){
		var url = '<?php echo site_url() ?>?price='+priceResult+'&downpayment='+downpaymentResult+'&from='+path;
		document.location.href = url;
	}
	if(price == 'null'){
		document.location.href = '<?php echo site_url() ?>';
		return false;
	}
	
});



</script>
<?php 

if(isset($_GET['price']) && $_GET['price'] != ''){ 
	/* pt($_GET['from']);
	die; */
	$price = base64_encode($_GET['price']);
	$downpayment = base64_encode($_GET['downpayment']);
	$from = $_GET['from'];
	wp_redirect(get_the_permalink('107')."/?price=$priceResult&downpayment=$downpaymentResult&from=$from");
	exit();
}
if(isset($_SESSION['purchase']) && $_SESSION['purchase'] != ''){
	$from = $_SESSION['from'];
	$priceResult = base64_encode($_SESSION['purchase']);
	$downpaymentResult = base64_encode($_SESSION['downpayment']);
	wp_redirect(get_the_permalink('107')."/?price=$priceResult&downpayment=$downpaymentResult&from=$from");
	exit();
}
if(isset($_POST['calculatesubmit'])){
	$price = $_POST['purchaseprice'];
	$downpayment = $_POST['downpayment'];
	$from = "home";
	if(!empty($price) && $price !=0){
		$priceResult = base64_encode($price);
	}
	if(!empty($downpayment) && $downpayment !=0){
		$downpaymentResult = base64_encode($downpayment);
	}
	wp_redirect(get_the_permalink('107')."/?price=$priceResult&downpayment=$downpaymentResult&from=$from");
	exit();
}
/* paypalCustom(); */

?>
<?php




/* $args = array(
	'post_type'=> 'wp_paypal_order',
	'posts_per_page' => 1,
	'order_by'=>'DESC'
);
$the_query = new WP_query($args);
if($the_query->have_posts()){
	while($the_query->have_posts()):
		$the_query->the_post();
		$id = $the_query->post->ID;  
		$txnId = get_post_meta($id,'_txn_id',true);
		pt($txnId);
		
	endwhile; 
}    
    */       
							
/* if($_POST['kapoor']=='submit') {
	
$BookingID = '';	
$MerchantEmail = 'demotester8-facilitator@yahoo.com';	
$CurrencyCode = 'USD';
$TotalFare = 1;
	
echo '<center style="font-size:18px;"><p>Redirecting to PayPal&hellip;<br><span style="font-weight:bold">Please do not refresh or close your browser.</span><br><br></p></center><form id="paypal" name="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"><div class="submit_login" style="width:100%; padding-top:10px;"><input type="hidden" name="cmd" value="_xclick" /><input type="hidden" name="item_name" value="Booking Ride"><input type="hidden" name="quantity" value="1"><input type="hidden" name="business" value="'.$MerchantEmail.'" /><input type="hidden" name="custom" value="'.$BookingID.'" /><input type="hidden" name="currency_code" value="'.$CurrencyCode.'" /><input type="hidden" name="rm" value="2"><input type="hidden" name="amount" value="'.$TotalFare.'" class="amount" /><input type="hidden" name="notify_url" value="'.site_url().'" class="return" /><input type="hidden" name="return" class="return" value="'.site_url().'" /><input type="hidden" name="cancel_return" value="'.site_url().'" /></div></form>';	

} */




?>
<!--form method="POST" action="#">
	<input type="submit" name="kapoor" value="submit">
</form-->
<button id="modalButoon" style="display:none;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade paypalForm" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Payment Form</h4>
      </div>
      <div class="modal-body">
	     <p>You will be emailed the offline calculator once your payment is processed, 
		 please enter your desired email below</p>
        <?php echo do_shortcode('[CP_CONTACT_FORM_PAYPAL id="1"]'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
jQuery(document).ready(function(){
    jQuery('[data-toggle="tooltip"]').tooltip();   
	jQuery('.paynowpaypal').click(function(){
		jQuery('#modalButoon').trigger('click');
	});
});

</script>
<style>
.paynowpaypal figure {
  cursor: pointer;
}
#myModal #fbuilder input {
  border: 1px solid #dddddd;
  border-radius: 4px;
  display: block !important;
  padding: 7px 15px !important;
  width: 100% !important;
}
#myModal #fbuilder textarea {
  border: 1px solid #dddddd;
  border-radius: 4px;
  height: 150px;
  padding: 15px;
  width: 100% !important;
}
#myModal #fbuilder .pbreak .pbPrevious, .pbreak .pbNext, .pbSubmit {
  background: #EA0011;
  border-radius: 4px;
  color: #ffff;
  cursor: pointer;
  display: block;
  font-size: 18px!important;
  margin-top:0px!important;
  margin-bottom: 30px!important;
  max-width: 121px;
  padding: 5px 20px;
  text-align: center;
  width: 100%;
  float:none!important;
}
#myModal .cpp_form {
  padding: 0 35px 0 35px;
  text-align: left;
}
#myModal .modal-title {
  font-size: 22px;
  text-align: center;
}
#myModal #fbuilder label {
  color: #4d4d4d;
  display: inline-block;
  font-family: rubikregular;
  font-size: 15px;
  font-weight: 700;
  margin-bottom: 5px;
  max-width: 100%;
}
</style>
<?php 


/* pt($_REQUEST); */
get_footer(); ?>