	<?php
/**
*
* Template Name:Calculator Result
*
*
*/						
get_header();

if(!is_user_logged_in()){
	wp_redirect(site_url()."/login",301);
}
unset($_SESSION['purchase']);
unset($_SESSION['downpayment']);
unset($_SESSION['from']);

/* pt($_SESSION); */

/* $abc = 'sunday';
echo strtoupper("$abc"); */

?>
<script>
jQuery(document).ready(function(){
	eraseCookie('purchasePrice');
	eraseCookie('downPayment');	
	/* deleteAllCookies(); */
});
</script>
<style>
.margin0{
	margin-left:0px;
	margin-right:0px;
}
.marginbottom{
	margin-bottom:20px;
}
.sectionTitle {
  background: rgb(241, 241, 241) none repeat scroll 0 0;
  color: rgb(0, 0, 0);
  font-family: "RubikRegular";
  font-size: 19px;
  line-height: 26px;
  padding: 10px;
  position: relative;
  text-align: left;
  text-transform: uppercase;
  margin-bottom: 30px;
}
#.sectionTitle::after {
  border: 1px solid #ea0011;
  bottom: 0;
  content: "";
  left: 19px;
  position: absolute;
  width: 45px;
  z-index: 99;
}
#changevalue .panel-headings {
  background: #f7f7f7 none repeat scroll 0 0;
  border-bottom: 1px solid #d5d5d5;
  padding: 10px 22px;
}
#changevalue .panel-headings h3 {
  font-size: 16px;
}
#changevalue .main-form {
  margin-bottom: 0px;
  margin-top: 13px;
}
#changevalue .main-form label {
  font-size: 14px;
}
#changevalue .main-form .form-control {
  font-size: 14px;
  height: 44px;
}
#changevalue .main-form .form-group input + label + .fa, #changevalue .main-form .form-group input + .fa {
  top: 44px;
}
#changevalue .placeholder::after {
  color: black !important;
  content: attr(data-placeholder);
  pointer-events: none;
  position: absolute;
  right: 40px;
  top: 41px;
}
.custom_online_calculations.container {
  border: 1px solid #ddddde;
  display: inherit;
  max-width: 1138px;
  padding: 0 18px;
  width: 100%;
}
.custom_online_calculations.container .submit_btn_wrapper {
  margin-bottom: 22px;
}

.custom_online_calculations.container .mainPanel_title {
  border-color: -moz-use-text-color;
  border-style: none;
  border-width: 0;
  color: #000000;
  font-family: "RubikRegular";
  font-size: 24px;
  padding: 13px 0px;
}
#visualize1 .table-responsive {
  min-height: 0.01%;
  overflow-x: auto;
  padding-bottom: 50px;
}
/*.commongrafwrapper {
  border: 1px solid #dddddd;
}
.commongrafpadding {
  padding: 10px;
}*/
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="primary" class="content-area container" style="margin-bottom:0px;">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			the_content();

			// End of the loop.
		endwhile; ?>
</main>
</div>
<?php		
	
global $wpdb;

if((isset($_GET['from']) && $_GET['from'] !='') || (isset($_GET['id']) && $_GET['id'] !='')){
	
	if($_GET['from'] == 'home'){
		
		$price = str_replace(',','',base64_decode($_GET['price']));
		$getdata = array(
			'purchaseprice'=>$price,
			'downpayment'=>base64_decode($_GET['downpayment']),
		);
		$DefaultData = calculation_default_variables($getdata);
		$dataInsert = array(
			'user_id'=>get_current_user_ID(),
			'userinput'=>serialize($DefaultData),
			'status'=>0,
			'created_date'=> date('Y-m-d H:i:s'),
			'modified_date'=>date('Y-m-d H:i:s'),
		);
		$wpdb->insert('wp_calculator', $dataInsert, array( '%d', '%s','%s','%s','%s' ) );
		$lastid = base64_encode($wpdb->insert_id);
		wp_redirect(get_the_permalink('107')."/?id=$lastid");
		
	}else if($_GET['from'] == 'presult'){
		
		$price = str_replace(',','',base64_decode($_GET['price']));
		$getdata = array(
			'purchaseprice'=>$price,
			'monthlyrent'=>base64_decode($_GET['rent']),
		);
		$DefaultData = calculation_default_variables($getdata);
		/* pt($DefaultData); */
		$dataInsert = array(
			'user_id'=>get_current_user_ID(),
			'userinput'=>serialize($DefaultData),
			'status'=>0,
			'created_date'=> date('Y-m-d H:i:s'),
			'modified_date'=>date('Y-m-d H:i:s'),
		);
		$wpdb->insert( 'wp_calculator', $dataInsert, array( '%d', '%s','%s','%s','%s' ) );
		$lastid = base64_encode($wpdb->insert_id);
		wp_redirect(get_the_permalink('107')."/?id=$lastid");
		
		
	}else{
		
		$id = base64_decode($_GET['id']);
		$get_data = "SELECT * FROM wp_calculator WHERE id = '".$id."'";
		$data = $wpdb->get_row($get_data);
		$alldataRasult = unserialize($data->userinput); 
		$SavedData = unserialize($data->userinput); 
		
	}
	$SpropertyName = $SavedData['propertyName'];
	$SpropertyAddress = $SavedData['propertyAddress'];
	$Spurchaseprice = $SavedData['purchaseprice'];
	$SupfrontimprovementData = $SavedData['upfrontimprovement']/100;
	$Supfrontimprovement = $Spurchaseprice*$SupfrontimprovementData;
    $Sclosingcost = $SavedData['closingcost'];
    $Sdownpayment = $SavedData['downpayment'];
    $Sinterestrate = $SavedData['interestrate'];
    $Smortgageyears = $SavedData['mortgageyears'];
    $Smonthlyrent = $SavedData['monthlyrent'];
    $Svacancyrate = $SavedData['vacancyrate'];
    $Sexpropertytaxes = $SavedData['expropertytaxes'];
    $Sexinsurance = $SavedData['exinsurance'];
    $Sexrepairs = $SavedData['exrepairs'];
    $Sexutilities = $SavedData['exutilities'];
    $Sexpropertymgmt = $SavedData['expropertymgmt'];
    $Sexhoa = $SavedData['exhoa'];
    $Sexother = $SavedData['exother'];
    $Sexotherfixed = $SavedData['exotherfixed'];
    $Smarginaltaxrate = $SavedData['marginaltaxrate'];
    $Samortizationperiodyears = $SavedData['amortizationperiodyears'];
    $Sannualappreciation = $SavedData['annualappreciation'];
    $Sannualrentincrease = $SavedData['annualrentincrease'];
    $Sannualoprating = $SavedData['annualoprating'];
    $Ssellholdingperiod = $SavedData['sellholdingperiod'];
    $Sselltransactioncost = $SavedData['selltransactioncost'];
    $Ssellcapitalgain = $SavedData['sellcapitalgain'];
    $Sselldepreciationrecap = $SavedData['selldepreciationrecap'];
    $Ssellstatetax = $SavedData['sellstatetax'];
	
	if(isset($Spurchaseprice) && $Spurchaseprice !=''){
		$SpurchasepriceR = $Spurchaseprice;
	}
	if(isset($Supfrontimprovement) && $Supfrontimprovement != ''){
		$SupfrontimprovementR = $Supfrontimprovement;
	}
	if(isset($Sclosingcost) && $Sclosingcost != ''){
		$SclosingcostR = $Sclosingcost;
	}
	if(isset($Sdownpayment) && $Sdownpayment !='' ){
		$SdownpaymentR = $Sdownpayment;
	}
	if(isset($Sinterestrate) && $Sinterestrate !='' ){
		$SinterestrateR = $Sinterestrate;
	}
	if(isset($Smortgageyears) && $Smortgageyears != '' ){
		$SmortgageyearsR = $Smortgageyears;
	}
	if(isset($Smonthlyrent) && $Smonthlyrent != ''){
		$SmonthlyrentR = $Smonthlyrent;
	}
	if(isset($Svacancyrate) && $Svacancyrate !=''){
		$SvacancyrateR = $Svacancyrate;
	}
	if(isset($Sexpropertytaxes) && $Sexpropertytaxes != ''){
		$SexpropertytaxesR = $Sexpropertytaxes;
	}
	if(isset($Sexinsurance) && $Sexinsurance != ''){
		$SexinsuranceR = $Sexinsurance;
	}
	if(isset($Sexrepairs) && $Sexrepairs !=''){
		$SexrepairsR = $Sexrepairs;
	}
	if(isset($Sexutilities) && $Sexutilities != '' ){
		$SexutilitiesR = $Sexutilities;
	}
	if(isset($Sexpropertymgmt) && $Sexpropertymgmt !='' ){
		$SexpropertymgmtR = $Sexpropertymgmt;
	}
	if(isset($Sexhoa) && $Sexhoa != ''){
		$SexhoaR = $Sexhoa;
	}
	if(isset($Sexother) && $Sexother !='' ){
		$SexotherR = $Sexother;
	}
	if(isset($Sexotherfixed) && $Sexotherfixed != ''){
		$SexotherfixedR = $Sexotherfixed;
	}
	
	if(isset($Smarginaltaxrate) && $Smarginaltaxrate !='' ){
		$SmarginaltaxrateR = $Smarginaltaxrate;
	}
	if(isset($Samortizationperiodyears) && $Samortizationperiodyears != '' ){
		$SamortizationperiodyearsR = $Samortizationperiodyears;
	}
	if(isset($Sannualappreciation) && $Sannualappreciation != ''){
		$SannualappreciationR = $Sannualappreciation;
	}
	if(isset($Sannualrentincrease) && $Sannualrentincrease != ''){
		$SannualrentincreaseR = $Sannualrentincrease;
	}
	if(isset($Sannualoprating) && $Sannualoprating != ''){
		$SannualopratingR = $Sannualoprating;
	}
	if(isset($Ssellholdingperiod) && $Ssellholdingperiod !='' ){
		$SsellholdingperiodR = $Ssellholdingperiod;
	}
	if(isset($Sselltransactioncost) && $Sselltransactioncost !='' ){
		$SselltransactioncostR = $Sselltransactioncost;
	}
	if(isset($Ssellcapitalgain) && $Ssellcapitalgain != ''){
		$SsellcapitalgainR = $Ssellcapitalgain;
	}
	if(isset($Sselldepreciationrecap) && $Sselldepreciationrecap != ''){
		$SselldepreciationrecapR = $Sselldepreciationrecap;
	}
	if(isset($Ssellstatetax) && $Ssellstatetax !='' ){
		$SsellstatetaxR = $Ssellstatetax;
	}

if(isset($_GET['up']) && $_GET['up'] !=''){
	echo "<div class='container'><div class='ttResult'>Your calculation has been successfully updated.</div></div>";
?>
<script>
jQuery(document).ready(function(){
	jQuery('.ttResult').fadeOut( 6000 );
});
</script>
<?php	
}
?>

<div class="vc_row wpb_row vc_row-fluid result_dirst_sec"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<p style="text-align: justify;">The total cost of the purchase is estimated at <?php echo explodeMinusVal(get_val_by_number_format($SpurchasepriceR,true)); ?> This includes $1,000 of upfront improvements, $2,590 in closing fees, and a $25,900 downpayment. You will need roughly $29,490 in cash to close the deal.This is also known as the cash outlay. It will take an estimated 9 years for this property to pay for itself in gross received rent. This number is also known as the gross rent multiplier and the national average was about 19 years in 2016. The gross monthly rent equals %0.9 of the purchase price. Some investors believe this value should be at least %1 to expect good returns. If you buy this property in cash, you should expect roughly a %5 return. This is known as the cap-rate and should be evaluated against your other investment opportunites such as stock dividends. After the first full year of rental, you should expect an estimated $13,205 in gross income, before taxes, and a net operating income of $7,013, which is simply the annual rental income minus the operating expenses. The cash-on-cash return is expected to be %2.4. The cash-on-cash is typically important to investors seeking properties with high cash-flow potential. Finally, the total return on investment (ROI) after the first year is estimated at %8.1, which accounts for equity accrued, depreciation, and taxes on income. Many investors consider the ROI as the most important factor in their calculation.You can explore more details by expanding the sections below.</p>

		</div>
	</div>
<div class="vc_empty_space" style="height: 32px"><span class="vc_empty_space_inner"></span></div>
</div></div></div></div>
<div class="container pad0 mainPanel_container ListOneResult">
<div class="mainPanel_title">
	<h4>
		Summary of Inputs
		<i data-toggle="collapse" data-target="#mainpane0" class="fa fa-plus" aria-hidden="true"></i>
	</h4>
</div>
<div class="table-panel collapse" id="mainpane0">
<div class="summaryofresults">
<div class="main-row">
	<!-- //***********************ROW ONE ********************************// -->
		<div class="main_panel_summary col-md-6 col-sm-6 col-lg-6 col-xs-12">
			<div class="heading_details">
				<h4>Cost Inputs <i data-toggle="collapse" data-target="#formP1" class="fa fa-plus" aria-hidden="true"></i></h4>
			</div>
			<div class="table-panel collapse" id="formP1">
				<div class="table-responsive">
					<table>
						<tbody>
							<tr>
								<td>Purchase Price ($)</td>
								<td><?php echo explodeMinusVal(get_val_by_number_format($SpurchasepriceR,true)); ?></td>
							</tr>
							<tr>
								<td>Upfront Improvement (%)</td>
								<td><?php echo $SupfrontimprovementR; ?></td>
							</tr>
							<tr>
								<td>Closing Cost (%)</td>
								<td><?php echo $SclosingcostR; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<!-- //***********************ROW ONE ********************************// -->
		<div class="main_panel_summary col-md-6 col-sm-6 col-lg-6 col-xs-12">
			<div class="heading_details">
				<h4>Financing Inputs <i data-toggle="collapse" data-target="#formP2" class="fa fa-plus" aria-hidden="true"></i></h4>
			</div>
			<div class="table-panel collapse" id="formP2">
				<div class="table-responsive">
					<table>
						<tbody>
							<tr>
								<td>Down Payment (%)</td>
								<td><?php echo $SdownpaymentR; ?></td>
							</tr>
							<tr>
								<td>Interest Rate (%)</td>
								<td><?php echo $SinterestrateR; ?></td>
							</tr>
							<tr>
								<td>Mortgage Years </td>
								<td><?php echo $SmortgageyearsR; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
</div><!-- .main-row ends -->
<div class="main-row">
	<!-- //***********************ROW ONE ********************************// -->
		<div class="main_panel_summary col-md-6 col-sm-6 col-lg-6 col-xs-12">
			<div class="heading_details">
				<h4>Revenue Inputs <i data-toggle="collapse" data-target="#formP3" class="fa fa-plus" aria-hidden="true"></i></h4>
			</div>
			<div class="table-panel collapse" id="formP3">
				<div class="table-responsive">
					<table>
						<tbody>
							<tr>
								<td>Monthly Rent ($)</td>
								<td><?php echo explodeMinusVal(get_val_by_number_format($SmonthlyrentR,true)); ?></td>
							</tr>
							<tr>
								<td>Vacancy Rate (%)</td>
								<td><?php echo $SvacancyrateR; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<!-- //***********************ROW ONE ********************************// -->
		<div class="main_panel_summary col-md-6 col-sm-6 col-lg-6 col-xs-12">
			<div class="heading_details">
				<h4>Expenses Inputs <i data-toggle="collapse" data-target="#formP4" class="fa fa-plus" aria-hidden="true"></i></h4>
			</div>
			<div class="table-panel collapse" id="formP4">
				<div class="table-responsive">
					<table>
						<tbody>
							<tr>
								<td>Property Taxes (%)</td>
								<td><?php echo $SexpropertytaxesR; ?></td>
							</tr>
							<tr>
								<td>Insurance (Monthly $)</td>
								<td><?php echo explodeMinusVal(get_val_by_number_format($SexinsuranceR,true)); ?></td>
							</tr>
							<tr>
								<td>Repairs (%)</td>
								<td><?php echo $SexrepairsR; ?></td>
							</tr>
							<tr>
								<td>Utilities (Monthly $)</td>
								<td><?php echo explodeMinusVal(get_val_by_number_format($SexutilitiesR,true)); ?></td>
							</tr>
							<tr>
								<td>Property Mgmt Fee (%)</td>
								<td><?php echo $SexpropertymgmtR; ?></td>
							</tr>
							<tr>
								<td>HOA (Monthly $)</td>
								<td><?php echo explodeMinusVal(get_val_by_number_format($SexhoaR,true)); ?></td>
							</tr>
							<tr>
								<td>Other % Cost (%) </td>
								<td><?php echo $SexotherR; ?></td>
							</tr>
							<tr>
								<td>Other Fixed Cost (Monthly $)</td>
								<td><?php echo explodeMinusVal(get_val_by_number_format($SexotherfixedR,true)); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
</div><!-- .main-row ends -->
<div class="main-row">
	<!-- //***********************ROW ONE ********************************// -->
		<div class="main_panel_summary col-md-6 col-sm-6 col-lg-6 col-xs-12">
			<div class="heading_details">
				<h4>Tax Inputs <i data-toggle="collapse" data-target="#formP5" class="fa fa-plus" aria-hidden="true"></i></h4>
			</div>
			<div class="table-panel collapse" id="formP5">
				<div class="table-responsive">
					<table>
						<tbody>
							<tr>
								<td>Marginal Tax Rate (%)</td>
								<td><?php echo $SmarginaltaxrateR; ?></td>
							</tr>
							<tr>
								<td>Amortization Period Years</td>
								<td><?php echo $SamortizationperiodyearsR; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<!-- //***********************ROW ONE ********************************// -->
		<div class="main_panel_summary col-md-6 col-sm-6 col-lg-6 col-xs-12">
			<div class="heading_details">
				<h4>Annual Growth Inputs <i data-toggle="collapse" data-target="#formP6" class="fa fa-plus" aria-hidden="true"></i></h4>
			</div>
			<div class="table-panel collapse" id="formP6">
				<div class="table-responsive">
					<table>
						<tbody>
							<tr>
								<td>Appreciation (%)</td>
								<td><?php echo $SannualappreciationR; ?></td>
							</tr>
							<tr>
								<td>Rent Increase (%)</td>
								<td><?php echo $SannualrentincreaseR; ?></td>
							</tr>
							<tr>
								<td>Operating Expense Increase (%)</td>
								<td><?php echo $SannualopratingR; ?></td>
							</tr>
						</tbody> 
					</table>
				</div>
			</div>
		</div>
</div><!-- .main-row ends -->

<div class="main-row">
	<!-- //***********************ROW ONE ********************************// -->
		<div class="main_panel_summary col-md-6 col-sm-6 col-lg-6 col-xs-12">
			<div class="heading_details">
				<h4>Sell Inputs <i data-toggle="collapse" data-target="#formP7" class="fa fa-plus" aria-hidden="true"></i></h4>
			</div>
			<div class="table-panel collapse" id="formP7">
				<div class="table-responsive">
					<table>
						<tbody>
							<tr>
								<td>Holding Period (Years)</td>
								<td><?php echo $SsellholdingperiodR; ?></td>
							</tr>
							<tr>
								<td>Selling Transaction Cost (%)</td>
								<td><?php echo $SselltransactioncostR; ?></td>
							</tr>
							<tr>
								<td>Capital Gains Tax Rate (%)</td>
								<td><?php echo $SsellcapitalgainR; ?></td>
							</tr>
							<tr>
								<td>Depreciation Recap Tax Rate (%)</td>
								<td><?php echo $SselldepreciationrecapR; ?></td>
							</tr>
							<tr>
								<td>State Tax (%)</td>
								<td><?php echo $SsellstatetaxR; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<!-- //***********************ROW ONE ********************************// -->
 <div class="main_panel_summary col-md-6 col-sm-6 col-lg-6 col-xs-12">
			<div class="heading_details">
				<h4>Property Title <i data-toggle="collapse" data-target="#formP8" class="fa fa-plus" aria-hidden="true"></i></h4>
			</div>
			<div class="table-panel collapse" id="formP8">
				<div class="table-responsive">
					<table>
						<tbody>
							<tr style="display:none;">
								<td>Property Name</td>
								<td><?php echo $SpropertyName; ?></td>
							</tr>
							<tr>
								<td>Address</td>
								<td><?php echo $SpropertyAddress; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
</div><!-- .main-row ends -->
<form id="changevalue" method="POST" action="" name="changevalues">
<div class="col-xs-12 col-sm-12 col-lg-12 text-center submit_btn_wrapper custom_online_calculations"><a><input value="CHANGE" class="submit_btn-cal " name="changevalue" type="submit"></a></div>
</form>
</div>
</div><!-- mainpanel ends -->

				
			</form>
		</div>
<?php
if(isset($_POST['changevalue']) && $_POST['changevalue'] != ''){
	$lastid = base64_encode($id);						
	wp_redirect(get_the_permalink('70')."/?id=$lastid&update=true");
}	

							
function operatingNetOperatingIncomeNOI($barchart,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
							
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$exPropertyTaxes = $alldataRasult['expropertytaxes'];
	$monthlyRent = $alldataRasult['monthlyrent'];
	$calculateTotalRents = $monthlyRent*12;
	$vacancyRate = $alldataRasult['vacancyrate'];
	$exInsurance = $alldataRasult['exinsurance'];
	$exRepairs = $alldataRasult['exrepairs'];
	$exUtilities = $alldataRasult['exutilities'];
	$exPropertymgmt = $alldataRasult['expropertymgmt'];
	$exHOA = $alldataRasult['exhoa'];
	$exOther = $alldataRasult['exother'];
	$exOtherFixedXost = $alldataRasult['exotherfixed'];
	$annualOprating = $alldataRasult['annualoprating'];
	
	
	$annualRentIncrease = $alldataRasult['annualrentincrease'];
	$monthlyVal = array();
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
		$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
		$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		$calculateOperatingPropertyMgtFee = $totalCalculateOperatingPropertyMgtFeeYears;
		$calculateOperatingHOA = $totalCalculateOperatingHOAYears;
		$calculateOperatingOtherPercentileCost = $totalCalculateOperatingOtherPercentileCostYears;
		$calculateOperatingOtherFixedCost = $totalCalculateOperatingFixedCostYears;
		$calculateRevenueVacancyLoss = $totalCalculateRevenueVacanyLossYears;
		$calculateRevenueRentalIncome = $totalCalculateRevenueRentalIncomeYears;
		$calculateRentGrossIncome = $totalCalculateRevenueGrossIncomeYears;

		if(empty($calculateOperatingPropertyTaxes1Year)){
			$exPropertyTaxesResult = $exPropertyTaxes/100;
		
			$calculateOperatingPropertyTaxes1Year = round($exPropertyTaxesResult*$purchasePrice,0);
		}
		if(empty($calculateOperatingInsurance1Year)){
			$calculateOperatingInsurance1Year = round($exInsurance*12,0);
		}
		if(empty($calculateOperatingRepairs1Year)){
			$exRepairsResult = $exRepairs/100;
			$calculateOperatingRepairs1Year = round($exRepairsResult*$calculateTotalRents,0);
		}
		if(empty($calculateOperatingUtilities1Year)){
			$exUtilitiesResult = $exUtilities * 12;
			$calculateOperatingUtilities1Year = round($exUtilitiesResult,2);
		}
		if(empty($calculateOperatingPropertyMgtFee)){
			$calculateOperatingPropertyMgtFee = round($monthlyRent*12,0);			
			$exPropertymgmtResult = $exPropertymgmt/100;
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		}
		if(empty($calculateOperatingHOA)){
			$exHOAResult = $exHOA*12; 
			$calculateOperatingHOA = round($exHOAResult,0);
			$exPropertymgmtResult = $exPropertymgmt/100;
			
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingHOA,0);
		}
		if(empty($calculateOperatingOtherPercentileCost)){
			$calculateOperatingOtherPercentileCost = round($monthlyRent*12,0);
			$exOtherResult = $exOther/100;
			$otherPercentile1stYear = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		}
		if(empty($calculateOperatingOtherFixedCost)){
			$exOtherFixedXostResult = $exOtherFixedXost*12;
			$calculateOperatingOtherFixedCost = round($exOtherFixedXostResult,2);
		}
		if(empty($calculateRevenueVacancyLoss)){
			$calculateRevenueVacancyLoss = round($monthlyRent*12,0);
		}
		if(empty($calculateRevenueRentalIncome)){
			$calculateRevenueRentalIncome = round($monthlyRent*12,0);
		}
		if(empty($calculateRentGrossIncome)){
			$calculateRentGrossIncome = round($monthlyRent*12,0);
		}
		
		/***************OperatingProprtyMgtFees**********/
		$annualRentIncreaseResult = $annualRentIncrease/100;
	
		$calculateOperatingPropertyMgtFeeInc = $calculateOperatingPropertyMgtFee*$annualRentIncreaseResult;
		
		$exPropertymgmtResult = $exPropertymgmt/100;
		$totalCalculateOperatingPropertyMgtFeeYears = round($calculateOperatingPropertyMgtFee+$calculateOperatingPropertyMgtFeeInc,0);
		$totalCalculateOperatingPropertyMgtFeeYearsProperty = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		
		/***************OperatingHOA**********/
		$annualOpratingResult = $annualOprating/100;
		$calculateOperatingHOAInc = $calculateOperatingHOA*$annualOpratingResult;
		$totalCalculateOperatingHOAYears = round($calculateOperatingHOA+$calculateOperatingHOAInc,0);
		$totalCalculateOperatingHOAYearsHOA = round($calculateOperatingHOA,0);
		
		/***************OperatingOtherPercentileCost**********/
		$exOtherResult = $exOther/100;
		$calculateOperatingOtherPercentileCostInc = $calculateOperatingOtherPercentileCost*$annualRentIncreaseResult;
			
		$totalCalculateOperatingOtherPercentileCostYears = round($calculateOperatingOtherPercentileCost+$calculateOperatingOtherPercentileCostInc,0);
	
		$totalCalculateOperatingOtherPercentileCostYearsOPC = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
			
		/***************RevenueVacancyLoss**********/
		$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
		$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
		$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
		
		
		/***************RevenueGrossIncome**********/
		$calculateRentGrossIncomeInc = $calculateRentGrossIncome*$annualRentIncreaseResult;
		
		$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
		$vacancyLoss = round($calculateRentGrossIncome*($vacancyRate/100),0);
		$totalCalculateRevenueGrossIncomeYearsGI = $calculateRentGrossIncome-$vacancyLoss;
		if(isset($monthly) && $monthly == 'monthly'){
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOIResults = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOIResult = get_val_by_number_format($calculateOperatingNOIResults,true);
			$monthlyVal[] = $calculateOperatingNOIResults;
			
		}elseif($i==1){
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOIResults = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOIResult = get_val_by_number_format($calculateOperatingNOIResults,true);
			
			$calculateOperatingNOIResultVal = explodeMinusVal($calculateOperatingNOIResult);
			
			if(isset($barchart) && $barchart=='barchart'){
				$year = $xlabel.' : '.$i;
				$value .=  $BarchartTocalculateOperatingNOI = '["'.$year.'",'.$calculateOperatingNOIResults.'],';
			}else if(isset($barchart) && $barchart=='one'){
				$value .= $calculateOperatingNOI = $calculateOperatingNOIResultVal;
			}else if(isset($barchart) && $barchart=='capRate'){
				return $capRateCalculateOperatingNOI = $calculateOperatingNOIResults;
			}else{
				$calculateOperatingNOI = $calculateOperatingNOIResultVal;	
				$value .= "<td class='dep_First_$i'>$calculateOperatingNOI</td>";
			}
		} else{
			/***************OperatingPropertyTaxes**********/
			$annualOpratingResult = $annualOprating/100;
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingResult;
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
			
			/***************OperatingInsurance**********/
			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$annualOpratingResult;
			
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			
			/***************OperatingRepairs**********/
			$exOtherResult = $exOther/100;
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$exOtherResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			
			/***************OperatingUtilities**********/
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			
			
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			
			/***************OperatingOtherFixedCost**********/
			$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*$annualOpratingResult;
			
			$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
			$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
			
			$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
			
			$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
			$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
			/***************OperatingExpensesIncRevenueVacanyCalculations**********/
			$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
			
			$calculateOperatingNOIResults = $totalCalculateRevenueGrossIncomeYearsGI-$totalCalculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOIResult = get_val_by_number_format($calculateOperatingNOIResults,true);
			
			$calculateOperatingNOIResultVal = explodeMinusVal($calculateOperatingNOIResult);
			
			if(isset($barchart) && $barchart=='barchart'){
				if($i == $mortgageYears){
					$year = $xlabel.' : '.$i;
					$value .=  $BarchartTocalculateOperatingNOI = '["'.$year.'",'.$calculateOperatingNOIResults.'],';	
				}else{
					$year = $xlabel.' : '.$i;
					$value .=  $BarchartTocalculateOperatingNOI = '["'.$year.'",'.$calculateOperatingNOIResults.'],';	
				}
			}else if($barchart=='one'){
				$calculateOperatingNOIResultVal = '';
			}else if($barchart=='capRate'){
				$calculateOperatingNOIResultVal = '';
			}else{
				$totalCalculateOperatingNOI = $calculateOperatingNOIResultVal;
				$value .= "<td class='dep_First_$i'>$totalCalculateOperatingNOI</td>";
			}
		}
	}
	if(isset($monthly) && $monthly == 'monthly'){
		$value = round($monthlyVal[0]/12,0);
		return '$'.$value;
	}else{
		return $value;	
	}
	
}


	$purchasePrice = $alldataRasult['purchaseprice'];	
	$upfrontImprovementData = $alldataRasult['upfrontimprovement']/100;
	/* pt('line no 787 = '.$alldataRasult['upfrontimprovement']); */
	$upfrontImprovement = $purchasePrice*$upfrontImprovementData;						
	$closingCost = $alldataRasult['closingcost'];	
	$downPayment = $alldataRasult['downpayment'];						
	$interestRate= $alldataRasult['interestrate'];						
	$mortgageYears= $alldataRasult['mortgageyears'];
		
	$landValue = $purchasePrice*0.25;
	$buildingValue = $purchasePrice*0.75;
	/* $upfrontImprovementValue = $purchasePrice*0.01; */
	$closingCostMain = $purchasePrice*$closingCost/100;
	
	/* pt($closingCostMain); */

	$totalCostInputs = $purchasePrice+$upfrontImprovement+$closingCostMain;	
	$totalCostInputsRevised = $landValue+$buildingValue+$upfrontImprovement+$closingCostMain;	

	$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
	$DownpaymentValue = $downPayment/100*$purchasePrice;
	$mortgageYearsMonths = $mortgageYears*12;
	
/* 	pt($mortgageYearsMonths); */

						


/*    echo pmt($alldataRasult['interestrate'],$alldataRasult['mortgageyears'],102400); */

function pmtNewDebtMortgage($interestRate, $mortgageYearsMonths, $loanAmount) {
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
   $mortgageYearsMonths = $mortgageYearsMonths;
   $interestRate = $interestRate / 1200;
   $monthlyMortgagePay = $interestRate * -$loanAmount * pow((1 + $interestRate), $mortgageYearsMonths) / (1 - pow((1 + $interestRate), $mortgageYearsMonths));
   return $monthlyMortgagePay;
}

$monthlyMortgagePay = pmt($interestRate, $mortgageYearsMonths, $loanAmount);

$totalFinancingInputs = $DownpaymentValue+$upfrontImprovement+$closingCostMain;

$monthlyRent = $alldataRasult['monthlyrent'];						
$vacancyRate = $alldataRasult['vacancyrate'];			

$rentRatio = round($monthlyRent/$purchasePrice*100,2).'%';
$grossRentMultiplier = round($totalCostInputs/($monthlyRent*12),2);


$NetOperatingIncomeYear1 = operatingNetOperatingIncomeNOI('capRate','','');
$capRate = round(($NetOperatingIncomeYear1/$totalCostInputs)*100,2).'%';

$marginalTaxRate = $alldataRasult['marginaltaxrate'];
$amortizationPeriodYears = $alldataRasult['amortizationperiodyears'];
$annualRentIncrease = $alldataRasult['annualrentincrease'];

$taxDepreciationYearly =  round($buildingValue/$amortizationPeriodYears,0); 

$purchaseClosingCost = $upfrontImprovement+$closingCostMain;

/* pt('line no 846 = '.$upfrontImprovement);
pt('line no 846 = '.$purchaseClosingCost);
pt('line no 846 = '.$closingCostMain); */



$initialTaxBasis = $purchasePrice+$closingCostMain;
/* pt('line no 846 = '.$initialTaxBasis); */
$sellNetROIAfter3Y = '-9.94%';

$rentIncrease = $annualRentIncrease/100;
$vacancyLoss = round($monthlyRent*($vacancyRate/100),0);
$grossIncomeRevenues = round($monthlyRent-$vacancyLoss,0);
$revenueByYearsYear1 = $monthlyRent*12;
$revenueByYearsYearAll=$revenueByYearsYear1+($rentIncrease*$revenueByYearsYear1);

/*****************************Functions For Revenues Start********/
						
function revenueYearCalculations($barchart,$xlabel){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	// Get Rent Increase % (Annual Growth Inputs)
	$monthlyRent = $alldataRasult['monthlyrent'];
	$mortgageYears= $alldataRasult['mortgageyears'];
	$annualRentIncrease = $alldataRasult['annualrentincrease'];
	$rentIncrease = $annualRentIncrease/100;							
	for($i=1;$i<=$mortgageYears;$i++){
		$autoIncrementRentalIncome = $totalIncrementedRevenue;
		$totalIncrementedRevenue = $autoIncrementRentalIncome*$rentIncrease;
		
		$totalIncrementedValue = $autoIncrementRentalIncome+$totalIncrementedRevenue;
		$calculateRentAppreciation = $totalFormulaRevenueRentalIncome;
		
		if(empty($calculateRentAppreciation)){
			$calculateRentAppreciation = round($monthlyRent*12,0);
		}
		if($i==1){
			$calculateRentAppreciationsBarchart = $calculateRentAppreciation;
			$calculateRentAppreciations = number_format($calculateRentAppreciation,0);
			if(isset($barchart) && $barchart == 'barchart'){
				$year = $xlabel.' : '.$i;
				$value = '["'.$year.'",'.$calculateRentAppreciationsBarchart.'],';		
			}else{
				$value = "<td>$$calculateRentAppreciations</td>";	
			}
		} else{
			$calculateRentAppreciationInc = $calculateRentAppreciation*$rentIncrease;
			$totalFormulaRevenueRentalIncome = round($calculateRentAppreciation+$calculateRentAppreciationInc,0);
			$totalFormulaRevenueRentalIncomes = number_format($totalFormulaRevenueRentalIncome,0);
			$calculateRentAppreciationsBarchart = $totalFormulaRevenueRentalIncome;
			if(isset($barchart) && $barchart == 'barchart'){
				if($i == $mortgageYears){
					$year = 'Year:'.$i;
					$value .= '["'.$year.'",'.$calculateRentAppreciationsBarchart.'],';	
				}else{
					$year = 'Year:'.$i;
					$value .= '["'.$year.'",'.$calculateRentAppreciationsBarchart.'],';	
				}
			}else{
				$value .= "<td>$$totalFormulaRevenueRentalIncomes</td>";	
			}
		}
		
	}
	return $value;
}
						
function revenueVacancyLossCalculations($barchart,$xlabel){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	// Get Rent Increase % (Annual Growth Inputs)
	$monthlyRent = $alldataRasult['monthlyrent'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$vacancyRate = $alldataRasult['vacancyrate'];
	$annualRentIncrease = $alldataRasult['annualrentincrease'];
	$rentIncrease = $annualRentIncrease/100;
	for($i=1;$i<=$mortgageYears;$i++){
		$autoIncrementRentalIncome = $totalIncrementedRevenue;
		$totalIncrementedRevenue = $autoIncrementRentalIncome*$rentIncrease;
		$totalIncrementedValue = $autoIncrementRentalIncome+$totalIncrementedRevenue;
		$calculateRentAppreciation = $totalFormulaRevenueRentalIncome;
		if(empty($calculateRentAppreciation)){
			$calculateRentAppreciation = round($monthlyRent*12,0);
		}
		$calculateRentAppreciationInc = $calculateRentAppreciation*$rentIncrease;
		$totalFormulaRevenueRentalIncome = round($calculateRentAppreciation+$calculateRentAppreciationInc,0);
		$vacancyLoss = round($calculateRentAppreciation*($vacancyRate/100),0);
		if(isset($barchart) && $barchart != ''){
			if($i == $mortgageYears){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$vacancyLoss.'],';		
			}else{
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$vacancyLoss.'],';		
			}
		}else{
			$vacancyLossResult = explodeMinusVal(get_val_by_number_format(-$vacancyLoss,true));
			$value .= "<td>$vacancyLossResult</td>";	
		}
	}
	return $value;
}
						
function revenueGrossIncomeCalculations($barchart,$xlabel,$firstYear){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	// Get Rent Increase % (Annual Growth Inputs)
	$monthlyRent = $alldataRasult['monthlyrent'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$vacancyRate = $alldataRasult['vacancyrate'];
	$annualRentIncrease = $alldataRasult['annualrentincrease'];
	$rentIncrease = $annualRentIncrease/100;
	for($i=1;$i<=$mortgageYears;$i++){
		$autoIncrementRentalIncome = $totalIncrementedRevenue;
		$totalIncrementedRevenue = $autoIncrementRentalIncome*$rentIncrease;
		$totalIncrementedValue = $autoIncrementRentalIncome+$totalIncrementedRevenue;
		$calculateRentAppreciation = $totalFormulaRevenueRentalIncome;
		if(empty($calculateRentAppreciation)){
			$calculateRentAppreciation = round($monthlyRent*12,0);
		}
		$calculateRentAppreciationInc = $calculateRentAppreciation*$rentIncrease;
		$totalFormulaRevenueRentalIncome = round($calculateRentAppreciation+$calculateRentAppreciationInc,0);
		$vacancyLoss = round($calculateRentAppreciation*($vacancyRate/100),0);
		$revenueGrossIncomeCalculations = $calculateRentAppreciation-$vacancyLoss;
		if(isset($barchart)&& $barchart == 'barchart'){
			if($i==$mortgageYears){
				$year = $xlabel.' : '.$i;
				$value .= $barChartforGrossincome = '["'.$year.'",'.$revenueGrossIncomeCalculations.'],';		
			}else{
				$year = $xlabel.' : '.$i;
				$value .= $barChartforGrossincome = '["'.$year.'",'.$revenueGrossIncomeCalculations.'],';				
			}
		}elseif(isset($firstYear) && $firstYear == 'firstyear'){
			if($i == 1){
				$revenueGrossIncomeCalculationss = number_format($revenueGrossIncomeCalculations,0);
				$value .= $revenueGrossIncomeCalculationss;	
			}
		}else{
			$revenueGrossIncomeCalculationss = number_format($revenueGrossIncomeCalculations,0);
			$value .= "<td class='grossincomeyear' data='".$revenueGrossIncomeCalculations."'>$$revenueGrossIncomeCalculationss</td>";	
		}
	}
	return $value;
}
						
/*****************************Functions For Operarting Expenses Start********/

function operatingPropertyTaxesMonthly(){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	// Get Operating Expense Increase (Anuual Growth Inputs%
	// Get Property Taxes Percent (Expense Inputs)
	$purchasePrice = $alldataRasult['purchaseprice'];
	$monthlyRent = $alldataRasult['monthlyrent'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$exPropertyTaxes = $alldataRasult['expropertytaxes'];
	$exPropertyTaxesResult = $exPropertyTaxes/100; 						
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingPropertyTaxesMonthly = $totalCalculateOperatingPropertyTaxesYears;
		if(empty($calculateOperatingPropertyTaxesMonthly)){
			$calculateOperatingPropertyTaxesMonthly = number_format(round(($exPropertyTaxesResult*$purchasePrice)/12,0),0);
		}
		if($i==1){
			echo "<td>$$calculateOperatingPropertyTaxesMonthly</td>";
		}
	}
}
						
function operatingPropertyTaxesYearly($barchart,$xlabel){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	// Get Operating Expense Increase (Anuual Growth Inputs%
	// Get Property Taxes Percent (Expense Inputs)
	$purchasePrice = $alldataRasult['purchaseprice'];
	$monthlyRent = $alldataRasult['monthlyrent'];
	$mortgageYears = $alldataRasult['mortgageyears'];	
	$annualOprating = $alldataRasult['annualoprating'];	
	$annualOpratingResult = $annualOprating/100;	
	$exPropertyTaxes = $alldataRasult['expropertytaxes'];
	$exPropertyTaxesResult = $exPropertyTaxes/100;
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
		if(empty($calculateOperatingPropertyTaxes1Year)){
			$calculateOperatingPropertyTaxes1Year = round($exPropertyTaxesResult*$purchasePrice,0);
		}
		if($i==1){
			$calculateOperatingPropertyTaxes1Year1 = number_format($calculateOperatingPropertyTaxes1Year,0);
			if(isset($barchart) && $barchart != ''){
				
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$calculateOperatingPropertyTaxes1Year.'],';		

			}else{
				$value .= "<td>$$calculateOperatingPropertyTaxes1Year1</td>";	
			}
		} else{
			
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingResult;
			
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
			$totalCalculateOperatingPropertyTaxesYearss = number_format($totalCalculateOperatingPropertyTaxesYears,0);
			
			if(isset($barchart) && $barchart != ''){
				if($i == $mortgageYears){
					
					$year = $xlabel.' : '.$i;
					$value .= '["'.$year.'",'.$totalCalculateOperatingPropertyTaxesYears.'],';
				}else{
					$year = $xlabel.' : '.$i;
					$value .= '["'.$year.'",'.$totalCalculateOperatingPropertyTaxesYears.'],';
				}
			}else{
				$value .= "<td>$$totalCalculateOperatingPropertyTaxesYearss</td>";
			}
		}
	}
	return $value;
}
						
function operatingInsuranceMonthly(){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);	
	/* // Get Insurance Monthly Dynamically
	// Get Operating Expense Increase (Anuual Growth Inputs% */
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$exInsurance= $alldataRasult['exinsurance'];	
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingInsuranceMonthly = $totalCalculateOperatingInsuranceYears;
		if(empty($calculateOperatingInsuranceMonthly)){
			$calculateOperatingInsuranceMonthly = round(($exInsurance*12)/12,0);
		}
		if($i==1){
			$calculateOperatingInsuranceMonthly1 = number_format($calculateOperatingInsuranceMonthly,0);
			echo "<td>$$calculateOperatingInsuranceMonthly1</td>";
		}
	}
}
						
function operatingInsuranceYearly($barchart,$xlabel){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);	
	// Get Insurance Monthly Dynamically
	// Get Operating Expense Increase (Anuual Growth Inputs%
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$exInsurance= $alldataRasult['exinsurance'];
	$annualOprating = $alldataRasult['annualoprating'];
	$annualOpratingResult = $annualOprating/100;
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
		if(empty($calculateOperatingInsurance1Year)){
			$calculateOperatingInsurance1Year = round($exInsurance*12,0);
		}
		if($i==1){
			$calculateOperatingInsurance1Years = number_format($calculateOperatingInsurance1Year,0);
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$calculateOperatingInsurance1Year.'],';	
			}else{
				$value = "<td class='dep_First_$i'>$$calculateOperatingInsurance1Years</td>";	
			}			
		} else{
			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$annualOpratingResult;
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			$calculateOperatingInsurance1YearIncs = number_format($totalCalculateOperatingInsuranceYears,0);
			if(isset($barchart) && $barchart != ''){
				if($i == $mortgageYears){
					$year = $xlabel.' : '.$i;
					$value .= '["'.$year.'",'.$totalCalculateOperatingInsuranceYears.'],';	
				}else{
					$year = $xlabel.' : '.$i;
					$value .= '["'.$year.'",'.$totalCalculateOperatingInsuranceYears.'],';	
				}
			}else{
				$value .= "<td class='dep_First_$i'>$$calculateOperatingInsurance1YearIncs</td>";
			}	
		}
	}
	return $value;
}
						
function operatingRepairsMonthly(){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);	
	// Get Repairs Monthly Dynamically
	// Get Operating Expense Increase (Anuual Growth Inputs%
	$monthlyRent = $alldataRasult['monthlyrent'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$calculateTotalRents = $monthlyRent*12;
	$annualOprating = $alldataRasult['annualoprating'];
	$annualOpratingResult = $annualOprating/100;
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingRepairsMonthly = $totalCalculateOperatingRepairsYears;
		if(empty($calculateOperatingRepairsMonthly)){
			$calculateOperatingRepairsMonthly = round(($annualOpratingResult*$calculateTotalRents)/12,0);
		}
		if($i==1){
			$calculateOperatingRepairsMonthlys = number_format
			($calculateOperatingRepairsMonthly,0);
			echo "<td>$$calculateOperatingRepairsMonthlys</td>";
		}
		
	}
}
						
function operatingRepairsYearly($barchart,$xlabel){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);	
	/* 	pt($alldataRasult); */
	// Get Repairs Monthly Dynamically
	// Get Operating Expense Increase (Anuual Growth Inputs%
	$monthlyRent = $alldataRasult['monthlyrent'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$calculateTotalRents = $monthlyRent*12;
	$annualOprating = $alldataRasult['annualoprating'];
	$exOther = $alldataRasult['exother'];
	$exOtherResult = $exOther/100;
	$annualOpratingResult = $annualOprating/100;
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
		if(empty($calculateOperatingRepairs1Year)){
			$calculateOperatingRepairs1Year = round($exOtherResult*$calculateTotalRents,0);
		}
		if($i==1){
			$calculateOperatingRepairs1Years = number_format($calculateOperatingRepairs1Year,0);
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$calculateOperatingRepairs1Year.'],';	
			}else{
				$value .="<td class='dep_First_$i'>$$calculateOperatingRepairs1Years</td>";		
			}
		}else{
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$annualOpratingResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			$totalCalculateOperatingRepairsYearss = number_format($totalCalculateOperatingRepairsYears,0);
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$totalCalculateOperatingRepairsYears.'],';	
			}else{
				$value .="<td class='dep_First_$i'>$$totalCalculateOperatingRepairsYearss</td>";		
			}
		}
	}
	return $value;
}
						
function operatingUtilitiesMonthly(){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);	
	// Get Repairs Monthly Dynamically
	// Get Operating Expense Increase (Anuual Growth Inputs%
	$mortgageYears = $alldataRasult['mortgageyears'];	
	$utitlity = $alldataRasult['exutilities'];	
	
	/* pt($alldataRasult); */
	
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingUtilitiesMonthly = $totalCalculateOperatingUtilitiesYears;
		if(empty($calculateOperatingUtilitiesMonthly)){
			$calculateOperatingUtilitiesMonthly = round(($utitlity*12)/12,0);
		}
		if($i==1){
			$calculateOperatingUtilitiesMonthlys = number_format($calculateOperatingUtilitiesMonthly,0);
			echo "<td>$$calculateOperatingUtilitiesMonthlys</td>";
		}
		
	}
}
						
function operatingUtilitiesYearly($barchart,$xlabel){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	// Get Utilities Monthly Dynamically
	// Get Operating Expense Increase (Anuual Growth Inputs%
	$utitlity = $alldataRasult['exutilities'];	
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$annualOprating = $alldataRasult['annualoprating'];
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		if(empty($calculateOperatingUtilities1Year)){
			$calculateOperatingUtilities1Year = round($utitlity*12,2);
		}
		if($i==1){
			$calculateOperatingUtilities1Years = number_format($calculateOperatingUtilities1Year,0);
			
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value = '["'.$year.'",'.$calculateOperatingUtilities1Year.'],';	
			}else{
				$value ="<td>$$calculateOperatingUtilities1Year</td>";		
			}
			
		} else{
			$annualOpratingResult = $annualOprating/100;
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			$calculateOperatingUtilities1Years = number_format($totalCalculateOperatingUtilitiesYearsCall,0);
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$calculateOperatingUtilities1Year.'],';	
			}else{
				$value .="<td>$$calculateOperatingUtilities1Years</td>";		
			}
		}
	}
	return $value;
}
						
function operatingPropertyMangementFeeMonthly(){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);	
	// Get Rent Increase % (Annual Growth Inputs)
	// Get Property Management Fee % (Expenses Inputs)
	$monthlyRent = $alldataRasult['monthlyrent'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$exPropertymgmt= $alldataRasult['expropertymgmt'];	
	$exPropertymgmtResult = $exPropertymgmt/100;	
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateRentAppreciation = '';
		if(empty($calculateRentAppreciation)){
			$calculateRentAppreciation = round($monthlyRent*12,0);
			$propertyMgtFee1stYear = round(($exPropertymgmtResult*$calculateRentAppreciation)/12,0);
		}
		if($i==1){
			$propertyMgtFee1stYears = number_format($propertyMgtFee1stYear,0);
			echo "<td>$$propertyMgtFee1stYears</td>";
		}
	}
}
						
function operatingPropertyMangementFeeYearly($barchart,$xlabel){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	// Get Rent Increase % (Annual Growth Inputs)
	// Get Property Management Fee % (Expenses Inputs)
	$monthlyRent = $alldataRasult['monthlyrent'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$exPropertymgmt= $alldataRasult['expropertymgmt'];
	$exPropertymgmtResult = $exPropertymgmt/100;
	$annualRentIncrease = $alldataRasult['annualrentincrease'];
	$rentIncrease = $annualRentIncrease/100;
	for($i=1;$i<=$mortgageYears;$i++){
		$autoIncrementRentalIncome = $totalIncrementedRevenue;
		$totalIncrementedRevenue = $autoIncrementRentalIncome*$rentIncrease;
		$totalIncrementedValue = $autoIncrementRentalIncome+$totalIncrementedRevenue;
		$calculateRentAppreciation = $totalFormulaRevenueRentalIncome;
		if(empty($calculateRentAppreciation)){
			$calculateRentAppreciation = round($monthlyRent*12,0);
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateRentAppreciation,0);
		}
		$calculateRentAppreciationInc = $calculateRentAppreciation*$rentIncrease;
		$totalFormulaRevenueRentalIncome = round($calculateRentAppreciation+$calculateRentAppreciationInc,0);
		$propertyMgtFeeAllYears = round($exPropertymgmtResult*$calculateRentAppreciation,0);
		$propertyMgtFee1stYearss = number_format($propertyMgtFeeAllYears,0);
		
		if(isset($barchart) && $barchart != ''){
			$year = $xlabel.' : '.$i;
			$value .= '["'.$year.'",'.$propertyMgtFeeAllYears.'],';		;
		}else{
			$value .= "<td class='dep_First_$i'>$$propertyMgtFee1stYearss</td>";	
		}
	}
	return $value;
}
						
function operatingHOAMonthly(){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);	
	// Get Rent Increase % (Annual Growth Inputs)
	// Get Property Management Fee % (Expenses Inputs)
	$monthlyRent = $alldataRasult['monthlyrent'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$exHoa = $alldataRasult['exhoa'];	
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateRentAppreciation = '';
		if(empty($calculateRentAppreciation)){
			$calculateRentAppreciation = round(12*$exHoa,0);
			$propertyMgtFee1stYear = round($calculateRentAppreciation/12,0);
		}
		if($i==1){
			$propertyMgtFee1stYearss = number_format($propertyMgtFee1stYear,0);
			echo "<td>$$propertyMgtFee1stYearss</td>";
		}
	}
}
						
function operatingHOAYearly($barchart,$xlabel){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	// Get Operating Expense % (Annual Growth Inputs)
	// Get Property Management Fee % (Expenses Inputs)
	// Get HOA Monthly (Expenses Inputs)
	$monthlyRent = $alldataRasult['monthlyrent'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$annualRentIncrease = $alldataRasult['annualrentincrease'];
	$rentIncrease = $annualRentIncrease/100;
	$exHoa = $alldataRasult['exhoa'];
	$exPropertymgmt= $alldataRasult['expropertymgmt'];
	$exPropertymgmtResult = $exPropertymgmt/100;
	$exAnnualoprating = $alldataRasult['annualoprating'];
	$exAnnualopratingResult = $exAnnualoprating/100;
	
	for($i=1;$i<=$mortgageYears;$i++){
		$autoIncrementRentalIncome = $totalIncrementedRevenue;
		$totalIncrementedRevenue = $autoIncrementRentalIncome*$rentIncrease;
		$totalIncrementedValue = $autoIncrementRentalIncome+$totalIncrementedRevenue;
		$calculateRentAppreciation = $totalFormulaRevenueRentalIncome;
		if(empty($calculateRentAppreciation)){
			
			$calculateRentAppreciation = round(12*$exHoa,0);
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateRentAppreciation,0);
		}
		$calculateRentAppreciationInc = $calculateRentAppreciation*$exAnnualopratingResult;
		$totalFormulaRevenueRentalIncome = round($calculateRentAppreciation+$calculateRentAppreciationInc,0);
		$propertyMgtFeeAllYears = round($calculateRentAppreciation,0);
		$propertyMgtFee1stYearss = number_format($propertyMgtFeeAllYears,0);
		/* pt($propertyMgtFee1stYearss); */
		if(isset($barchart) && $barchart != ''){
			$year = $xlabel.' : '.$i;
			$value .= '["'.$year.'",'.$propertyMgtFeeAllYears.'],';		
		}else{
			$value .= "<td>$$propertyMgtFee1stYearss</td>";	
		}
	}
		return $value;
}
						
function operatingOtherPercentileCostMonthly(){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	// Get Rent Increase % (Annual Growth Inputs)
	// Get Other expense % (Expenses Inputs)
	$monthlyRent = $alldataRasult['monthlyrent'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$exOther = $alldataRasult['exother'];	
	$exOtherResult = $exOther/100;
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateRentAppreciation = '';
		if(empty($calculateRentAppreciation)){
			$calculateRentAppreciation = round($monthlyRent*12,0);
			$propertyMgtFee1stYear = round(($exOtherResult*$calculateRentAppreciation)/12,0);
		}
		if($i==1){
			$propertyMgtFee1stYears = number_format($propertyMgtFee1stYear,0);
			echo "<td>$$propertyMgtFee1stYears</td>";
		}
	}
}
						
function operatingOtherPercentileCostYearly($barchart,$xlabel){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	// Get Rent Increase % (Annual Growth Inputs)
	// Get Other expense % (Expenses Inputs)
	$monthlyRent = $alldataRasult['monthlyrent'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$annualRentIncrease = $alldataRasult['annualrentincrease'];
	$rentIncrease = $annualRentIncrease/100;
	$exOther = $alldataRasult['exother'];	
	$exOtherResult = $exOther/100;
	for($i=1;$i<=$mortgageYears;$i++){
		$autoIncrementRentalIncome = $totalIncrementedRevenue;
		$totalIncrementedRevenue = $autoIncrementRentalIncome*$rentIncrease;
		$totalIncrementedValue = $autoIncrementRentalIncome+$totalIncrementedRevenue;
		$calculateRentAppreciation = $totalFormulaRevenueRentalIncome;
		if(empty($calculateRentAppreciation)){
			$calculateRentAppreciation = round($monthlyRent*12,0);
			$propertyMgtFee1stYear = round($exOtherResult*$calculateRentAppreciation,0);
		}
		$calculateRentAppreciationInc = $calculateRentAppreciation*$rentIncrease;
		$totalFormulaRevenueRentalIncome = round($calculateRentAppreciation+$calculateRentAppreciationInc,0);
		$propertyMgtFeeAllYears = round($exOtherResult*$calculateRentAppreciation,0);
		$propertyMgtFeeAllYearsResult = number_format($propertyMgtFeeAllYears,0);
		if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$propertyMgtFeeAllYears.'],';		
			}else{
				$value .= "<td class='dep_First_$i'>$$propertyMgtFeeAllYearsResult</td>";;	
			}
		}
	return $value;
}
						
function operatingOtherFixedCostMonthly(){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	// Get Other Fixed Price
	// Get Operating Expense Increase (Anuual Growth Inputs%
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$exOtherFixed= $alldataRasult['exotherfixed'];	
	/* $annualOprating= $alldataRasult['annualoprating'];	 */
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingUtilitiesMonthly = $totalCalculateOperatingUtilitiesYears;
		if(empty($calculateOperatingUtilitiesMonthly)){
			$calculateOperatingUtilitiesMonthly = round((12*$exOtherFixed)/12,0);
		}
		if($i==1){
			$calculateOperatingUtilitiesMonthlyResult = number_format($calculateOperatingUtilitiesMonthly,0);
			echo "<td>$$calculateOperatingUtilitiesMonthlyResult</td>";
		}
		
	}
}
						
function operatingOtherFixedCostYearly($barchart,$xlabel){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	// Get Other Fixed Price
	// Get Operating Expense Increase (Anuual Growth Inputs%
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$exOtherFixed= $alldataRasult['exotherfixed'];	
	$annualOprating= $alldataRasult['annualoprating'];	
	$annualOpratingResult = $annualOprating/100;	
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		if(empty($calculateOperatingUtilities1Year)){
			$calculateOperatingUtilities1Year = round(12*$exOtherFixed,2);
		}
		if($i==1){
			$calculateOperatingUtilities1YearResult = number_format($calculateOperatingUtilities1Year,0);
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$calculateOperatingUtilities1Year.'],';		
				} else{
				$value .= "<td>$$calculateOperatingUtilities1YearResult</td>";	
				}
		} else{
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			$calculateOperatingUtilitiesYearResult = number_format($totalCalculateOperatingUtilitiesYearsCall,0);
			/* pt($calculateOperatingUtilitiesYearResult); */
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$totalCalculateOperatingUtilitiesYearsCall.'],';		
			} else{
				$value .= "<td>$$calculateOperatingUtilitiesYearResult</td>";
			}
		}
	}
	return $value;
}
						
function operatingTotalExpensesCalculationSum($barchart,$xlabel){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$exPropertyTaxes = $alldataRasult['expropertytaxes'];
	$monthlyRent = $alldataRasult['monthlyrent'];
	$calculateTotalRents = $monthlyRent*12;
	$vacancyRate = $alldataRasult['vacancyrate'];
	$exInsurance = $alldataRasult['exinsurance'];
	$exRepairs = $alldataRasult['exrepairs'];
	$exUtilities = $alldataRasult['exutilities'];
	$exPropertymgmt = $alldataRasult['expropertymgmt'];
	$exHOA = $alldataRasult['exhoa'];
	$exOther = $alldataRasult['exother'];
	$exOtherFixedXost = $alldataRasult['exotherfixed'];
	$annualOprating = $alldataRasult['annualoprating'];	
	$annualOpratingResult = $annualOprating/100;
	$annualRentIncrease = $alldataRasult['annualrentincrease'];
	$annualRentIncreaseResult = $annualRentIncrease/100;
	$exother = $alldataRasult['exother'];
	$exotherResult = $exother/100;
	$calculateTotalRents = $monthlyRent*12;
	
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
		$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
		$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		$calculateOperatingPropertyMgtFee = $totalCalculateOperatingPropertyMgtFeeYears;
		$calculateOperatingHOA = $totalCalculateOperatingHOAYears;
		$calculateOperatingOtherPercentileCost = $totalCalculateOperatingOtherPercentileCostYears;
		$calculateOperatingOtherFixedCost = $totalCalculateOperatingFixedCostYears;
		
		if(empty($calculateOperatingPropertyTaxes1Year)){
			$exPropertyTaxesResult = $exPropertyTaxes/100;
			$calculateOperatingPropertyTaxes1Year = round($exPropertyTaxesResult*$purchasePrice,0);
		}
		if(empty($calculateOperatingInsurance1Year)){
			$calculateOperatingInsurance1Year = round($exInsurance*12,0);
		}
		if(empty($calculateOperatingRepairs1Year)){
			$exRepairsResult = $exRepairs/100;
			$calculateOperatingRepairs1Year = round($exRepairsResult*$calculateTotalRents,0);
		}
		if(empty($calculateOperatingUtilities1Year)){
			$exUtilitiesResult = $exUtilities * 12;
			$calculateOperatingUtilities1Year = round($exUtilitiesResult,2);
		}
		if(empty($calculateOperatingPropertyMgtFee)){
			$calculateOperatingPropertyMgtFee = round($monthlyRent*12,0);			
			$exPropertymgmtResult = $exPropertymgmt/100;
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		}
		if(empty($calculateOperatingHOA)){
			$exHOAResult = $exHOA*12; 
			$calculateOperatingHOA = round($exHOAResult,0);
			$exPropertymgmtResult = $exPropertymgmt/100;
			
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingHOA,0);
		}
		if(empty($calculateOperatingOtherPercentileCost)){
			$calculateOperatingOtherPercentileCost = round($monthlyRent*12,0);
			$exOtherResult = $exOther/100;
			$otherPercentile1stYear = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		}
		if(empty($calculateOperatingOtherFixedCost)){
			$exOtherFixedXostResult = $exOtherFixedXost*12;
			$calculateOperatingOtherFixedCost = round($exOtherFixedXostResult,2);
		}
		if(empty($calculateRevenueVacancyLoss)){
			$calculateRevenueVacancyLoss = round($monthlyRent*12,0);
		}
		if(empty($calculateRevenueRentalIncome)){
			$calculateRevenueRentalIncome = round($monthlyRent*12,0);
		}
		if(empty($calculateRentGrossIncome)){
			$calculateRentGrossIncome = round($monthlyRent*12,0);
		}

		
		/***************OperatingProprtyMgtFees**********/
		$exPropertymgmtResult = $exPropertymgmt/100;
		$calculateOperatingPropertyMgtFeeInc = $calculateOperatingPropertyMgtFee*$annualRentIncreaseResult;
		$totalCalculateOperatingPropertyMgtFeeYears = round($calculateOperatingPropertyMgtFee+$calculateOperatingPropertyMgtFeeInc,0);
		$totalCalculateOperatingPropertyMgtFeeYearsProperty = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		
		/***************OperatingHOA**********/
		$calculateOperatingHOAInc = $calculateOperatingHOA*$annualOpratingResult;
		$totalCalculateOperatingHOAYears = round($calculateOperatingHOA+$calculateOperatingHOAInc,0);
		$totalCalculateOperatingHOAYearsHOA = round($calculateOperatingHOA,0);
		
		/***************OperatingOtherPercentileCost**********/
		$calculateOperatingOtherPercentileCostInc = $calculateOperatingOtherPercentileCost*$annualRentIncreaseResult;
		$totalCalculateOperatingOtherPercentileCostYears = round($calculateOperatingOtherPercentileCost+$calculateOperatingOtherPercentileCostInc,0);
		$totalCalculateOperatingOtherPercentileCostYearsOPC = round($exotherResult*$calculateOperatingOtherPercentileCost,0);
											
		if($i==1){
			
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			$calculateOperatingTotalExpensesCalculationSumResult = number_format($calculateOperatingTotalExpensesCalculationSum,0);
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$calculateOperatingTotalExpensesCalculationSum.'],';		
			}else{
				$value .= "<td>$$calculateOperatingTotalExpensesCalculationSumResult</td>";
			}	
		
			
		} else{
				/***************OperatingPropertyTaxes**********/
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingResult;
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
			
			/***************OperatingInsurance**********/
			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$annualOpratingResult;
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			
			/***************OperatingRepairs**********/
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$annualOpratingResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			
			/***************OperatingUtilities**********/
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			
			/***************OperatingOtherFixedCost**********/
			$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*$annualOpratingResult;
			$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
			$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
			
			/***************OperatingTotalExpensesCalculations**********/
			$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
			
			$calculateOperatingTotalExpensesCalculationSumResult = number_format($totalCalculateOperatingTotalExpensesCalculationSum,0);
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$totalCalculateOperatingTotalExpensesCalculationSum.'],';		
			}else{
				$value .= "<td>$$calculateOperatingTotalExpensesCalculationSumResult</td>";
			}
		}
	}
	return $value;
}
						
function operatingTotalExpensesCalculationSumMonthly($firstYear){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$exPropertyTaxes = $alldataRasult['expropertytaxes'];
	$monthlyRent = $alldataRasult['monthlyrent'];
	$calculateTotalRents = $monthlyRent*12;
	$vacancyRate = $alldataRasult['vacancyrate'];
	$exInsurance = $alldataRasult['exinsurance'];
	$exRepairs = $alldataRasult['exrepairs'];
	$exUtilities = $alldataRasult['exutilities'];
	$exPropertymgmt = $alldataRasult['expropertymgmt'];
	$exHOA = $alldataRasult['exhoa'];
	$exOther = $alldataRasult['exother'];
	$exOtherFixedXost = $alldataRasult['exotherfixed'];
	$annualOprating = $alldataRasult['annualoprating'];	
	$annualOpratingResult = $annualOprating/100;
	$annualRentIncrease = $alldataRasult['annualrentincrease'];
	$annualRentIncreaseResult = $annualRentIncrease/100;
	$exother = $alldataRasult['exother'];
	$exotherResult = $exother/100;
	$calculateTotalRents = $monthlyRent*12;
	
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
		$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
		$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		$calculateOperatingPropertyMgtFee = $totalCalculateOperatingPropertyMgtFeeYears;
		$calculateOperatingHOA = $totalCalculateOperatingHOAYears;
		$calculateOperatingOtherPercentileCost = $totalCalculateOperatingOtherPercentileCostYears;
		$calculateOperatingOtherFixedCost = $totalCalculateOperatingFixedCostYears;
		
		if(empty($calculateOperatingPropertyTaxes1Year)){
			$exPropertyTaxesResult = $exPropertyTaxes/100;
			$calculateOperatingPropertyTaxes1Year = round($exPropertyTaxesResult*$purchasePrice,0);
		}
		if(empty($calculateOperatingInsurance1Year)){
			$calculateOperatingInsurance1Year = round($exInsurance*12,0);
		}
		if(empty($calculateOperatingRepairs1Year)){
			$exRepairsResult = $exRepairs/100;
			$calculateOperatingRepairs1Year = round($exRepairsResult*$calculateTotalRents,0);
		}
		if(empty($calculateOperatingUtilities1Year)){
			$exUtilitiesResult = $exUtilities * 12;
			$calculateOperatingUtilities1Year = round($exUtilitiesResult,2);
		}
		if(empty($calculateOperatingPropertyMgtFee)){
			$calculateOperatingPropertyMgtFee = round($monthlyRent*12,0);			
			$exPropertymgmtResult = $exPropertymgmt/100;
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		}
		if(empty($calculateOperatingHOA)){
			$exHOAResult = $exHOA*12; 
			$calculateOperatingHOA = round($exHOAResult,0);
			$exPropertymgmtResult = $exPropertymgmt/100;
			
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingHOA,0);
		}
		if(empty($calculateOperatingOtherPercentileCost)){
			$calculateOperatingOtherPercentileCost = round($monthlyRent*12,0);
			$exOtherResult = $exOther/100;
			$otherPercentile1stYear = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		}
		if(empty($calculateOperatingOtherFixedCost)){
			$exOtherFixedXostResult = $exOtherFixedXost*12;
			$calculateOperatingOtherFixedCost = round($exOtherFixedXostResult,2);
		}
		if(empty($calculateRevenueVacancyLoss)){
			$calculateRevenueVacancyLoss = round($monthlyRent*12,0);
		}
		if(empty($calculateRevenueRentalIncome)){
			$calculateRevenueRentalIncome = round($monthlyRent*12,0);
		}
		if(empty($calculateRentGrossIncome)){
			$calculateRentGrossIncome = round($monthlyRent*12,0);
		}

		
		/***************OperatingProprtyMgtFees**********/
		$exPropertymgmtResult = $exPropertymgmt/100;
		$calculateOperatingPropertyMgtFeeInc = $calculateOperatingPropertyMgtFee*$annualRentIncreaseResult;
		$totalCalculateOperatingPropertyMgtFeeYears = round($calculateOperatingPropertyMgtFee+$calculateOperatingPropertyMgtFeeInc,0);
		$totalCalculateOperatingPropertyMgtFeeYearsProperty = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		
		/***************OperatingHOA**********/
		$calculateOperatingHOAInc = $calculateOperatingHOA*$annualOpratingResult;
		$totalCalculateOperatingHOAYears = round($calculateOperatingHOA+$calculateOperatingHOAInc,0);
		$totalCalculateOperatingHOAYearsHOA = round($calculateOperatingHOA,0);
		
		/***************OperatingOtherPercentileCost**********/
		$calculateOperatingOtherPercentileCostInc = $calculateOperatingOtherPercentileCost*$annualRentIncreaseResult;
		$totalCalculateOperatingOtherPercentileCostYears = round($calculateOperatingOtherPercentileCost+$calculateOperatingOtherPercentileCostInc,0);
		$totalCalculateOperatingOtherPercentileCostYearsOPC = round($exotherResult*$calculateOperatingOtherPercentileCost,0);
											
		if($i==1){
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			$calculateOperatingTotalExpensesCalculationSumResult = number_format($calculateOperatingTotalExpensesCalculationSum,0);
			
			if(isset($firstYear) && $firstYear == 'firstYear'){
				$value = number_format($calculateOperatingTotalExpensesCalculationSum,0);
			}elseif(isset($firstYear) && $firstYear == 'monthly'){
				$value = number_format($calculateOperatingTotalExpensesCalculationSum/12,0);
			}
		} 
	}
	return $value;
}
						
function operatingTotalExpensesIncludingVacancy($barchart,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$exPropertyTaxes = $alldataRasult['expropertytaxes'];
	$monthlyRent = $alldataRasult['monthlyrent'];
	$calculateTotalRents = $monthlyRent*12;
	$vacancyRate = $alldataRasult['vacancyrate'];
	$exInsurance = $alldataRasult['exinsurance'];
	$exRepairs = $alldataRasult['exrepairs'];
	$exUtilities = $alldataRasult['exutilities'];
	$exPropertymgmt = $alldataRasult['expropertymgmt'];
	$exHOA = $alldataRasult['exhoa'];
	$exOther = $alldataRasult['exother'];
	$exOtherFixedXost = $alldataRasult['exotherfixed'];
	$annualOprating = $alldataRasult['annualoprating'];
	$annualRentIncrease = $alldataRasult['annualrentincrease'];
	$annualRentIncreaseResult = $annualRentIncrease/100;
	$newVal = array();
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
		$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
		$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		$calculateOperatingPropertyMgtFee = $totalCalculateOperatingPropertyMgtFeeYears;
		$calculateOperatingHOA = $totalCalculateOperatingHOAYears;
		$calculateOperatingOtherPercentileCost = $totalCalculateOperatingOtherPercentileCostYears;
		$calculateOperatingOtherFixedCost = $totalCalculateOperatingFixedCostYears;
		$calculateRevenueVacancyLoss = $totalCalculateRevenueVacanyLossYears;
		$calculateRevenueRentalIncome = $totalCalculateRevenueRentalIncomeYears;
		
	if(empty($calculateOperatingPropertyTaxes1Year)){
			$exPropertyTaxesResult = $exPropertyTaxes/100;
			$calculateOperatingPropertyTaxes1Year = round($exPropertyTaxesResult*$purchasePrice,0);
		}
		if(empty($calculateOperatingInsurance1Year)){
			$calculateOperatingInsurance1Year = round($exInsurance*12,0);
		}
		if(empty($calculateOperatingRepairs1Year)){
			$exRepairsResult = $exRepairs/100;
			$calculateOperatingRepairs1Year = round($exRepairsResult*$calculateTotalRents,0);
		}
		if(empty($calculateOperatingUtilities1Year)){
			$exUtilitiesResult = $exUtilities * 12;
			$calculateOperatingUtilities1Year = round($exUtilitiesResult,2);
		}
		if(empty($calculateOperatingPropertyMgtFee)){
			$calculateOperatingPropertyMgtFee = round($monthlyRent*12,0);			
			$exPropertymgmtResult = $exPropertymgmt/100;
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		}
		if(empty($calculateOperatingHOA)){
			$exHOAResult = $exHOA*12; 
			$calculateOperatingHOA = round($exHOAResult,0);
			$exPropertymgmtResult = $exPropertymgmt/100;
			
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingHOA,0);
		}
		if(empty($calculateOperatingOtherPercentileCost)){
			$calculateOperatingOtherPercentileCost = round($monthlyRent*12,0);
			$exOtherResult = $exOther/100;
			$otherPercentile1stYear = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		}
		if(empty($calculateOperatingOtherFixedCost)){
			$exOtherFixedXostResult = $exOtherFixedXost*12;
			$calculateOperatingOtherFixedCost = round($exOtherFixedXostResult,2);
		}
		if(empty($calculateRevenueVacancyLoss)){
			$calculateRevenueVacancyLoss = round($monthlyRent*12,0);
		}
		if(empty($calculateRevenueRentalIncome)){
			$calculateRevenueRentalIncome = round($monthlyRent*12,0);
		}
		
		/***************OperatingProprtyMgtFees**********/
		$annualRentIncreaseResult = $annualRentIncrease/100;
	
		$calculateOperatingPropertyMgtFeeInc = $calculateOperatingPropertyMgtFee*$annualRentIncreaseResult;
		
		$exPropertymgmtResult = $exPropertymgmt/100;
		$totalCalculateOperatingPropertyMgtFeeYears = round($calculateOperatingPropertyMgtFee+$calculateOperatingPropertyMgtFeeInc,0);
		$totalCalculateOperatingPropertyMgtFeeYearsProperty = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		
		/***************OperatingHOA**********/
		$annualOpratingResult = $annualOprating/100;
		$calculateOperatingHOAInc = $calculateOperatingHOA*$annualOpratingResult;
		$totalCalculateOperatingHOAYears = round($calculateOperatingHOA+$calculateOperatingHOAInc,0);
		$totalCalculateOperatingHOAYearsHOA = round($calculateOperatingHOA,0);
		
		/***************OperatingOtherPercentileCost**********/
		$exOtherResult = $exOther/100;
		$calculateOperatingOtherPercentileCostInc = $calculateOperatingOtherPercentileCost*$annualRentIncreaseResult;
			
		$totalCalculateOperatingOtherPercentileCostYears = round($calculateOperatingOtherPercentileCost+$calculateOperatingOtherPercentileCostInc,0);
	
		$totalCalculateOperatingOtherPercentileCostYearsOPC = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
			
		/***************RevenueVacancyLoss**********/
		$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
		$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
		$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
		if($monthly == 'monthly'){
			
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingTotalExpensesIncludingVacancy = round(($calculateOperatingTotalExpensesCalculationSum+$totalCalculateRevenueVacanyLossYearsCall)/$calculateRevenueRentalIncome,2);
			
			$newVal[] = $calculateOperatingTotalExpensesIncludingVacancy*100;
			
		}elseif($i==1){
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingTotalExpensesIncludingVacancy = round(($calculateOperatingTotalExpensesCalculationSum+$totalCalculateRevenueVacanyLossYearsCall)/$calculateRevenueRentalIncome,2);
			
			$calculateOperatingTotalExpensesIncludingVacancy = $calculateOperatingTotalExpensesIncludingVacancy*100;
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$calculateOperatingTotalExpensesIncludingVacancy.'],';		
			}else{
			  $value .= "<td>$calculateOperatingTotalExpensesIncludingVacancy%</td>";
			}
		} else{
			/***************OperatingPropertyTaxes**********/
			$annualOpratingResult = $annualOprating/100;
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingResult;
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
			
			/***************OperatingInsurance**********/
			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$annualOpratingResult;
			
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			
			/***************OperatingRepairs**********/
			$exOtherResult = $exOther/100;
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$exOtherResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			
			/***************OperatingUtilities**********/
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			
			
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			
			/***************OperatingOtherFixedCost**********/
			$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*$annualOpratingResult;
			
			$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
			$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
			
			$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
			
			$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
			$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
			/***************OperatingExpensesIncRevenueVacanyCalculations**********/
			$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
			
			/***************RevenueRentalIncomeCalculations**********/
			$calculateRevenueRentalIncomeInc = $calculateRevenueRentalIncome*$annualRentIncreaseResult;
		
			$totalCalculateRevenueRentalIncomeYears = round($calculateRevenueRentalIncome+$calculateRevenueRentalIncomeInc,0);
			
			$totalCalculateOperatingTotalExpensesIncludingVacancy = round(($totalCalculateOperatingTotalExpensesCalculationSum+$totalCalculateRevenueVacanyLossYearsCall)/$totalCalculateRevenueRentalIncomeYears,2);
			
			$totalCalculateOperatingTotalExpensesIncludingVacancy = $totalCalculateOperatingTotalExpensesIncludingVacancy*100;
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$totalCalculateOperatingTotalExpensesIncludingVacancy.'],';
			}else{
			  $value .= "<td>$totalCalculateOperatingTotalExpensesIncludingVacancy%</td>";
			}	
		}
	}
	if($monthly == 'monthly'){
		$value = $newVal[0]/12;
		return $value.'%';
	}else{
		return $value;	
	}
	
}
						

						
/************************* NEW ************************************/
function operatingNetOperatingIncomeNOIRev($barchart,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
		$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$exPropertyTaxes = $alldataRasult['expropertytaxes'];
	$monthlyRent = $alldataRasult['monthlyrent'];
	$calculateTotalRents = $monthlyRent*12;
	$vacancyRate = $alldataRasult['vacancyrate'];
	$exInsurance = $alldataRasult['exinsurance'];
	$exRepairs = $alldataRasult['exrepairs'];
	$exUtilities = $alldataRasult['exutilities'];
	$exPropertymgmt = $alldataRasult['expropertymgmt'];
	$exHOA = $alldataRasult['exhoa'];
	$exOther = $alldataRasult['exother'];
	$exOtherFixedXost = $alldataRasult['exotherfixed'];
	$annualOprating = $alldataRasult['annualoprating'];
	$annualRentIncrease = $alldataRasult['annualrentincrease'];
	$annualRentIncreaseResult = $annualRentIncrease/100;
	$monthlyVal = array();
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
		$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
		$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		$calculateOperatingPropertyMgtFee = $totalCalculateOperatingPropertyMgtFeeYears;
		$calculateOperatingHOA = $totalCalculateOperatingHOAYears;
		$calculateOperatingOtherPercentileCost = $totalCalculateOperatingOtherPercentileCostYears;
		$calculateOperatingOtherFixedCost = $totalCalculateOperatingFixedCostYears;
		$calculateRevenueVacancyLoss = $totalCalculateRevenueVacanyLossYears;
		$calculateRevenueRentalIncome = $totalCalculateRevenueRentalIncomeYears;
		$calculateRentGrossIncome = $totalCalculateRevenueGrossIncomeYears;

		if(empty($calculateOperatingPropertyTaxes1Year)){
			$exPropertyTaxesResult = $exPropertyTaxes/100;
			$calculateOperatingPropertyTaxes1Year = round($exPropertyTaxesResult*$purchasePrice,0);
		}
		if(empty($calculateOperatingInsurance1Year)){
			$calculateOperatingInsurance1Year = round($exInsurance*12,0);
		}
		if(empty($calculateOperatingRepairs1Year)){
			$exRepairsResult = $exRepairs/100;
			$calculateOperatingRepairs1Year = round($exRepairsResult*$calculateTotalRents,0);
		}
		if(empty($calculateOperatingUtilities1Year)){
			$exUtilitiesResult = $exUtilities * 12;
			$calculateOperatingUtilities1Year = round($exUtilitiesResult,2);
		}
		if(empty($calculateOperatingPropertyMgtFee)){
			$calculateOperatingPropertyMgtFee = round($monthlyRent*12,0);			
			$exPropertymgmtResult = $exPropertymgmt/100;
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		}
		if(empty($calculateOperatingHOA)){
			$exHOAResult = $exHOA*12; 
			$calculateOperatingHOA = round($exHOAResult,0);
			$exPropertymgmtResult = $exPropertymgmt/100;
			
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingHOA,0);
		}
		if(empty($calculateOperatingOtherPercentileCost)){
			$calculateOperatingOtherPercentileCost = round($monthlyRent*12,0);
			$exOtherResult = $exOther/100;
			$otherPercentile1stYear = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		}
		if(empty($calculateOperatingOtherFixedCost)){
			$exOtherFixedXostResult = $exOtherFixedXost*12;
			$calculateOperatingOtherFixedCost = round($exOtherFixedXostResult,2);
		}
		if(empty($calculateRevenueVacancyLoss)){
			$calculateRevenueVacancyLoss = round($monthlyRent*12,0);
		}
		if(empty($calculateRentGrossIncome)){
			$calculateRentGrossIncome = round($monthlyRent*12,0);
		}
		
		/***************OperatingProprtyMgtFees**********/
		$annualRentIncreaseResult = $annualRentIncrease/100;
	
		$calculateOperatingPropertyMgtFeeInc = $calculateOperatingPropertyMgtFee*$annualRentIncreaseResult;
		
		$exPropertymgmtResult = $exPropertymgmt/100;
		$totalCalculateOperatingPropertyMgtFeeYears = round($calculateOperatingPropertyMgtFee+$calculateOperatingPropertyMgtFeeInc,0);
		$totalCalculateOperatingPropertyMgtFeeYearsProperty = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		
		/***************OperatingHOA**********/
		$annualOpratingResult = $annualOprating/100;
		$calculateOperatingHOAInc = $calculateOperatingHOA*$annualOpratingResult;
		$totalCalculateOperatingHOAYears = round($calculateOperatingHOA+$calculateOperatingHOAInc,0);
		$totalCalculateOperatingHOAYearsHOA = round($calculateOperatingHOA,0);
		
		/***************OperatingOtherPercentileCost**********/
		$exOtherResult = $exOther/100;
		$calculateOperatingOtherPercentileCostInc = $calculateOperatingOtherPercentileCost*$annualRentIncreaseResult;
			
		$totalCalculateOperatingOtherPercentileCostYears = round($calculateOperatingOtherPercentileCost+$calculateOperatingOtherPercentileCostInc,0);
	
		$totalCalculateOperatingOtherPercentileCostYearsOPC = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
			
		/***************RevenueVacancyLoss**********/
		$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
		$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
		$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
		
		/***************RevenueGrossIncome**********/
		$calculateRentGrossIncomeInc = $calculateRentGrossIncome*$annualRentIncreaseResult;
		$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
		$vacancyLoss = round($calculateRentGrossIncome*($vacancyRate/100),0);
		$totalCalculateRevenueGrossIncomeYearsGI = $calculateRentGrossIncome-$vacancyLoss;
		if(isset($monthly) && $monthly == 'monthly'){
			
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOIresult = get_val_by_number_format($calculateOperatingNOI,true);
			$calculateOperatingNOIresultVal = explodeMinusVal($calculateOperatingNOIresult);	
			$monthlyVal[] = $calculateOperatingNOI;
			
			
		}elseif($i==1){
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOIresult = get_val_by_number_format($calculateOperatingNOI,true);
			$calculateOperatingNOIresultVal = explodeMinusVal($calculateOperatingNOIresult);	
			if(isset($barchart) && $barchart != ''){
				$b = str_replace( ',', '', $calculateOperatingNOIresult );
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$b.'],';		

			}else{
			  $value .= "<td class=''>$calculateOperatingNOIresultVal</td>";
			}
		} else{
			/***************OperatingPropertyTaxes**********/
			$annualOpratingResult = $annualOprating/100;
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingResult;
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
			
			/***************OperatingInsurance**********/
			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$annualOpratingResult;
			
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			
			/***************OperatingRepairs**********/
			$exOtherResult = $exOther/100;
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$exOtherResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			
			/***************OperatingUtilities**********/
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			
			
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			
			/***************OperatingOtherFixedCost**********/
			$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*$annualOpratingResult;
			
			$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
			$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
			
			$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
			
			$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
			$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
			/***************OperatingExpensesIncRevenueVacanyCalculations**********/
			$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
			
			$totalCalculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$totalCalculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOIresult = get_val_by_number_format($totalCalculateOperatingNOI,true);
			$calculateOperatingNOIresultVal = explodeMinusVal($calculateOperatingNOIresult);
			if(isset($barchart) && $barchart != ''){
				$b = str_replace( ',', '', $calculateOperatingNOIresult );
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$b.'],';		
			}else{
			  $value .= "<td class=''>$calculateOperatingNOIresultVal</td>";
			}
		}
	}
	if($monthly == 'monthly'){
		$value = '$'.$monthlyVal[0]/12;
		/* pt($monthlyVal); */
		return $value;
	}else{
		return $value;
	}
	
}
						
						
						
/*****************************Functions For Cash Flow Start********/
		
function cashFlowBeforeTaxCashFlowmonthly($firstYear = 'monthly'){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);	
	
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$exPropertyTaxes = $alldataRasult['expropertytaxes'];
	$monthlyRent = $alldataRasult['monthlyrent'];
	$calculateTotalRents = $monthlyRent*12;
	$vacancyRate = $alldataRasult['vacancyrate'];
	$exInsurance = $alldataRasult['exinsurance'];
	$exRepairs = $alldataRasult['exrepairs'];
	$exUtilities = $alldataRasult['exutilities'];
	$exPropertymgmt = $alldataRasult['expropertymgmt'];
	$exHOA = $alldataRasult['exhoa'];
	$exOther = $alldataRasult['exother'];
	$exOtherFixedXost = $alldataRasult['exotherfixed'];
	$annualOprating = $alldataRasult['annualoprating'];
	$annualRentIncrease = $alldataRasult['annualrentincrease'];
	$annualRentIncreaseResult = $annualRentIncrease/100;
	
	$monthlyMortgageDynamic = round($monthlyMortgagePay,2);
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
		$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
		$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		$calculateOperatingPropertyMgtFee = $totalCalculateOperatingPropertyMgtFeeYears;
		$calculateOperatingHOA = $totalCalculateOperatingHOAYears;
		$calculateOperatingOtherPercentileCost = $totalCalculateOperatingOtherPercentileCostYears;
		$calculateOperatingOtherFixedCost = $totalCalculateOperatingFixedCostYears;
		$calculateRevenueVacancyLoss = $totalCalculateRevenueVacanyLossYears;
		$calculateRevenueRentalIncome = $totalCalculateRevenueRentalIncomeYears;
		$calculateRentGrossIncome = $totalCalculateRevenueGrossIncomeYears;

		if(empty($calculateOperatingPropertyTaxes1Year)){
			$exPropertyTaxesResult = $exPropertyTaxes/100;
			$calculateOperatingPropertyTaxes1Year = round($exPropertyTaxesResult*$purchasePrice,0);
		}
		if(empty($calculateOperatingInsurance1Year)){
			$calculateOperatingInsurance1Year = round($exInsurance*12,0);
		}
		if(empty($calculateOperatingRepairs1Year)){
			$exRepairsResult = $exRepairs/100;
			$calculateOperatingRepairs1Year = round($exRepairsResult*$calculateTotalRents,0);
		}
		if(empty($calculateOperatingUtilities1Year)){
			$exUtilitiesResult = $exUtilities * 12;
			$calculateOperatingUtilities1Year = round($exUtilitiesResult,2);
		}
		if(empty($calculateOperatingPropertyMgtFee)){
			$calculateOperatingPropertyMgtFee = round($monthlyRent*12,0);			
			$exPropertymgmtResult = $exPropertymgmt/100;
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		}
		if(empty($calculateOperatingHOA)){
			$exHOAResult = $exHOA*12; 
			$calculateOperatingHOA = round($exHOAResult,0);
			$exPropertymgmtResult = $exPropertymgmt/100;
			
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingHOA,0);
		}
		if(empty($calculateOperatingOtherPercentileCost)){
			$calculateOperatingOtherPercentileCost = round($monthlyRent*12,0);
			$exOtherResult = $exOther/100;
			$otherPercentile1stYear = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		}
		if(empty($calculateOperatingOtherFixedCost)){
			$exOtherFixedXostResult = $exOtherFixedXost*12;
			$calculateOperatingOtherFixedCost = round($exOtherFixedXostResult,2);
		}
		if(empty($calculateRevenueVacancyLoss)){
			$calculateRevenueVacancyLoss = round($monthlyRent*12,0);
		}
		if(empty($calculateRentGrossIncome)){
			$calculateRentGrossIncome = round($monthlyRent*12,0);
		}
		
		/***************OperatingProprtyMgtFees**********/
		$annualRentIncreaseResult = $annualRentIncrease/100;
	
		$calculateOperatingPropertyMgtFeeInc = $calculateOperatingPropertyMgtFee*$annualRentIncreaseResult;
		
		$exPropertymgmtResult = $exPropertymgmt/100;
		$totalCalculateOperatingPropertyMgtFeeYears = round($calculateOperatingPropertyMgtFee+$calculateOperatingPropertyMgtFeeInc,0);
		$totalCalculateOperatingPropertyMgtFeeYearsProperty = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		
		/***************OperatingHOA**********/
		$annualOpratingResult = $annualOprating/100;
		$calculateOperatingHOAInc = $calculateOperatingHOA*$annualOpratingResult;
		$totalCalculateOperatingHOAYears = round($calculateOperatingHOA+$calculateOperatingHOAInc,0);
		$totalCalculateOperatingHOAYearsHOA = round($calculateOperatingHOA,0);
		
		/***************OperatingOtherPercentileCost**********/
		$exOtherResult = $exOther/100;
		$calculateOperatingOtherPercentileCostInc = $calculateOperatingOtherPercentileCost*$annualRentIncreaseResult;
			
		$totalCalculateOperatingOtherPercentileCostYears = round($calculateOperatingOtherPercentileCost+$calculateOperatingOtherPercentileCostInc,0);
	
		$totalCalculateOperatingOtherPercentileCostYearsOPC = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
			
		/***************RevenueVacancyLoss**********/
		$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
		$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
		$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
		
		/***************RevenueGrossIncome**********/
		$calculateRentGrossIncomeInc = $calculateRentGrossIncome*$annualRentIncreaseResult;
		$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
		$vacancyLoss = round($calculateRentGrossIncome*($vacancyRate/100),0);
		$totalCalculateRevenueGrossIncomeYearsGI = $calculateRentGrossIncome-$vacancyLoss;
		
		$interestRate= $alldataRasult['interestrate'];	
		$mortgageYears= $alldataRasult['mortgageyears'];
		$downPayment = $alldataRasult['downpayment'];	
		$purchasePrice = $alldataRasult['purchaseprice'];

		$mortgageYearsMonths = $mortgageYears*12;

		$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
		
		$PMTFixedMonthlyMultiply = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
		$PMTFixedMonthlyMultiply = $PMTFixedMonthlyMultiply*12;
									
		if($i==1){
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOIt = $calculateOperatingNOI-$PMTFixedMonthlyMultiply;
			
			if(isset($firstYear) && $firstYear == 'firstYear'){
				$calculateOperatingNOItResult =  $calculateOperatingNOIt;
			}
			else if(isset($firstYear) && $firstYear == 'monthly'){
				$calculateOperatingNOItResult =  $calculateOperatingNOIt/12;
			}
			$calculateOperatingNOIResult = get_val_by_number_format($calculateOperatingNOItResult,true);
			$calculateOperatingNOIResultVal = explodeMinusVal($calculateOperatingNOIResult);
			
			echo $calculateOperatingNOIResultVal;
		}
	}
}
function cashFlowBeforeTaxCashFlow($barchart,$xlabel){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	/* pt($alldataRasult); */	
	
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$exPropertyTaxes = $alldataRasult['expropertytaxes'];
	$monthlyRent = $alldataRasult['monthlyrent'];
	$calculateTotalRents = $monthlyRent*12;
	$vacancyRate = $alldataRasult['vacancyrate'];
	$exInsurance = $alldataRasult['exinsurance'];
	$exRepairs = $alldataRasult['exrepairs'];
	$exUtilities = $alldataRasult['exutilities'];
	$exPropertymgmt = $alldataRasult['expropertymgmt'];
	$exHOA = $alldataRasult['exhoa'];
	$exOther = $alldataRasult['exother'];
	$exOtherFixedXost = $alldataRasult['exotherfixed'];
	$annualOprating = $alldataRasult['annualoprating'];
	$annualRentIncrease = $alldataRasult['annualrentincrease'];
	$annualRentIncreaseResult = $annualRentIncrease/100;
	
	$monthlyMortgageDynamic = round($monthlyMortgagePay,2);
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
		$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
		$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		$calculateOperatingPropertyMgtFee = $totalCalculateOperatingPropertyMgtFeeYears;
		$calculateOperatingHOA = $totalCalculateOperatingHOAYears;
		$calculateOperatingOtherPercentileCost = $totalCalculateOperatingOtherPercentileCostYears;
		$calculateOperatingOtherFixedCost = $totalCalculateOperatingFixedCostYears;
		$calculateRevenueVacancyLoss = $totalCalculateRevenueVacanyLossYears;
		$calculateRevenueRentalIncome = $totalCalculateRevenueRentalIncomeYears;
		$calculateRentGrossIncome = $totalCalculateRevenueGrossIncomeYears;

		if(empty($calculateOperatingPropertyTaxes1Year)){
			$exPropertyTaxesResult = $exPropertyTaxes/100;
			$calculateOperatingPropertyTaxes1Year = round($exPropertyTaxesResult*$purchasePrice,0);
		}
		if(empty($calculateOperatingInsurance1Year)){
			$calculateOperatingInsurance1Year = round($exInsurance*12,0);
		}
		if(empty($calculateOperatingRepairs1Year)){
			$exRepairsResult = $exRepairs/100;
			$calculateOperatingRepairs1Year = round($exRepairsResult*$calculateTotalRents,0);
		}
		if(empty($calculateOperatingUtilities1Year)){
			$exUtilitiesResult = $exUtilities * 12;
			$calculateOperatingUtilities1Year = round($exUtilitiesResult,2);
		}
		if(empty($calculateOperatingPropertyMgtFee)){
			$calculateOperatingPropertyMgtFee = round($monthlyRent*12,0);			
			$exPropertymgmtResult = $exPropertymgmt/100;
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		}
		if(empty($calculateOperatingHOA)){
			$exHOAResult = $exHOA*12; 
			$calculateOperatingHOA = round($exHOAResult,0);
			$exPropertymgmtResult = $exPropertymgmt/100;
			
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingHOA,0);
		}
		if(empty($calculateOperatingOtherPercentileCost)){
			$calculateOperatingOtherPercentileCost = round($monthlyRent*12,0);
			$exOtherResult = $exOther/100;
			$otherPercentile1stYear = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		}
		if(empty($calculateOperatingOtherFixedCost)){
			$exOtherFixedXostResult = $exOtherFixedXost*12;
			$calculateOperatingOtherFixedCost = round($exOtherFixedXostResult,2);
		}
		if(empty($calculateRevenueVacancyLoss)){
			$calculateRevenueVacancyLoss = round($monthlyRent*12,0);
		}
		if(empty($calculateRentGrossIncome)){
			$calculateRentGrossIncome = round($monthlyRent*12,0);
		}
		
		/***************OperatingProprtyMgtFees**********/
		$annualRentIncreaseResult = $annualRentIncrease/100;
	
		$calculateOperatingPropertyMgtFeeInc = $calculateOperatingPropertyMgtFee*$annualRentIncreaseResult;
		
		$exPropertymgmtResult = $exPropertymgmt/100;
		$totalCalculateOperatingPropertyMgtFeeYears = round($calculateOperatingPropertyMgtFee+$calculateOperatingPropertyMgtFeeInc,0);
		$totalCalculateOperatingPropertyMgtFeeYearsProperty = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		
		/***************OperatingHOA**********/
		$annualOpratingResult = $annualOprating/100;
		$calculateOperatingHOAInc = $calculateOperatingHOA*$annualOpratingResult;
		$totalCalculateOperatingHOAYears = round($calculateOperatingHOA+$calculateOperatingHOAInc,0);
		$totalCalculateOperatingHOAYearsHOA = round($calculateOperatingHOA,0);
		
		/***************OperatingOtherPercentileCost**********/
		$exOtherResult = $exOther/100;
		$calculateOperatingOtherPercentileCostInc = $calculateOperatingOtherPercentileCost*$annualRentIncreaseResult;
			
		$totalCalculateOperatingOtherPercentileCostYears = round($calculateOperatingOtherPercentileCost+$calculateOperatingOtherPercentileCostInc,0);
	
		$totalCalculateOperatingOtherPercentileCostYearsOPC = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
			
		/***************RevenueVacancyLoss**********/
		$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
		$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
		$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
		
		/***************RevenueGrossIncome**********/
		$calculateRentGrossIncomeInc = $calculateRentGrossIncome*$annualRentIncreaseResult;
		$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
		$vacancyLoss = round($calculateRentGrossIncome*($vacancyRate/100),0);
		$totalCalculateRevenueGrossIncomeYearsGI = $calculateRentGrossIncome-$vacancyLoss;
		
		$interestRate= $alldataRasult['interestrate'];	
		$mortgageYears= $alldataRasult['mortgageyears'];
		$downPayment = $alldataRasult['downpayment'];	
		$purchasePrice = $alldataRasult['purchaseprice'];

		$mortgageYearsMonths = $mortgageYears*12;

		$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
		
		$PMTFixedMonthlyMultiply = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
		$PMTFixedMonthlyMultiply = $PMTFixedMonthlyMultiply*12;
									
		if($i==1){
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOI = $calculateOperatingNOI-$PMTFixedMonthlyMultiply;
			
			$calculateOperatingNOIResult = get_val_by_number_format($calculateOperatingNOI,true);
			$calculateOperatingNOIResultVal = explodeMinusVal($calculateOperatingNOIResult);
			if(isset($barchart) && $barchart != ''){
					$b = str_replace( ',', '', $calculateOperatingNOIResult );
					$year = $xlabel.' : '.$i;
					$value .= '["'.$year.'",'.$b.'],';		
				}else{
				  $value .= "<td>$calculateOperatingNOIResultVal</td>";
				}
		} else{
			/***************OperatingPropertyTaxes**********/
			$annualOpratingResult = $annualOprating/100;
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingResult;
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
			
			/***************OperatingInsurance**********/
			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$annualOpratingResult;
			
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			
			/***************OperatingRepairs**********/
			$exOtherResult = $exOther/100;
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$exOtherResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			
			/***************OperatingUtilities**********/
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			
			
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			
			/***************OperatingOtherFixedCost**********/
			$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*$annualOpratingResult;
			
			$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
			$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
			
			$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
			
			$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
			$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
			/***************OperatingExpensesIncRevenueVacanyCalculations**********/
			$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
			
			$totalCalculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$totalCalculateOperatingTotalExpensesCalculationSum;
			
			$totalCalculateOperatingNOI = $totalCalculateOperatingNOI-$PMTFixedMonthlyMultiply;
			
			$calculateOperatingNOIResult = get_val_by_number_format($totalCalculateOperatingNOI,true);
			$calculateOperatingNOIResultVal = explodeMinusVal($calculateOperatingNOIResult);
			if(isset($barchart) && $barchart != ''){
					$b = str_replace( ',', '', $calculateOperatingNOIResult ); 
					$year = $xlabel.' : '.$i;
					$value .= '["'.$year.'",'.$b.'],';		
				}else{
				  $value .= "<td>$calculateOperatingNOIResultVal</td>";
				}
		}
	}
	return $value;
}
						
function cashFlowCashOnCashReturn($summry, $barchart,$xlabel,$monthly){
	
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$exPropertyTaxes = $alldataRasult['expropertytaxes'];
	$monthlyRent = $alldataRasult['monthlyrent'];
	$calculateTotalRents = $monthlyRent*12;
	$vacancyRate = $alldataRasult['vacancyrate'];
	$exInsurance = $alldataRasult['exinsurance'];
	$exRepairs = $alldataRasult['exrepairs'];
	$exUtilities = $alldataRasult['exutilities'];
	$exPropertymgmt = $alldataRasult['expropertymgmt'];
	$exHOA = $alldataRasult['exhoa'];
	$exOther = $alldataRasult['exother'];
	$exOtherFixedXost = $alldataRasult['exotherfixed'];
	$annualOprating = $alldataRasult['annualoprating'];
	$annualRentIncrease = $alldataRasult['annualrentincrease'];
	$annualRentIncreaseResult = $annualRentIncrease/100;
	$monthlyMortgageDynamic = round($monthlyMortgagePay,2);
	$monthlyVal = array();
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
		$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
		$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		$calculateOperatingPropertyMgtFee = $totalCalculateOperatingPropertyMgtFeeYears;
		$calculateOperatingHOA = $totalCalculateOperatingHOAYears;
		$calculateOperatingOtherPercentileCost = $totalCalculateOperatingOtherPercentileCostYears;
		$calculateOperatingOtherFixedCost = $totalCalculateOperatingFixedCostYears;
		$calculateRevenueVacancyLoss = $totalCalculateRevenueVacanyLossYears;
		$calculateRevenueRentalIncome = $totalCalculateRevenueRentalIncomeYears;
		$calculateRentGrossIncome = $totalCalculateRevenueGrossIncomeYears;

		if(empty($calculateOperatingPropertyTaxes1Year)){
			$exPropertyTaxesResult = $exPropertyTaxes/100;
			$calculateOperatingPropertyTaxes1Year = round($exPropertyTaxesResult*$purchasePrice,0);
		}
		if(empty($calculateOperatingInsurance1Year)){
			$calculateOperatingInsurance1Year = round($exInsurance*12,0);
		}
		if(empty($calculateOperatingRepairs1Year)){
			$exRepairsResult = $exRepairs/100;
			$calculateOperatingRepairs1Year = round($exRepairsResult*$calculateTotalRents,0);
		}
		if(empty($calculateOperatingUtilities1Year)){
			$exUtilitiesResult = $exUtilities * 12;
			$calculateOperatingUtilities1Year = round($exUtilitiesResult,2);
		}
		if(empty($calculateOperatingPropertyMgtFee)){
			$calculateOperatingPropertyMgtFee = round($monthlyRent*12,0);			
			$exPropertymgmtResult = $exPropertymgmt/100;
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		}
		if(empty($calculateOperatingHOA)){
			$exHOAResult = $exHOA*12; 
			$calculateOperatingHOA = round($exHOAResult,0);
			$exPropertymgmtResult = $exPropertymgmt/100;
			
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingHOA,0);
		}
		if(empty($calculateOperatingOtherPercentileCost)){
			$calculateOperatingOtherPercentileCost = round($monthlyRent*12,0);
			$exOtherResult = $exOther/100;
			$otherPercentile1stYear = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		}
		if(empty($calculateOperatingOtherFixedCost)){
			$exOtherFixedXostResult = $exOtherFixedXost*12;
			$calculateOperatingOtherFixedCost = round($exOtherFixedXostResult,2);
		}
		if(empty($calculateRevenueVacancyLoss)){
			$calculateRevenueVacancyLoss = round($monthlyRent*12,0);
		}
		if(empty($calculateRevenueRentalIncome)){
			$calculateRevenueRentalIncome = round($monthlyRent*12,0);
		}
		if(empty($calculateRentGrossIncome)){
			$calculateRentGrossIncome = round($monthlyRent*12,0);
		}
		
		/***************OperatingProprtyMgtFees**********/
		$annualRentIncreaseResult = $annualRentIncrease/100;
	
		$calculateOperatingPropertyMgtFeeInc = $calculateOperatingPropertyMgtFee*$annualRentIncreaseResult;
		
		$exPropertymgmtResult = $exPropertymgmt/100;
		$totalCalculateOperatingPropertyMgtFeeYears = round($calculateOperatingPropertyMgtFee+$calculateOperatingPropertyMgtFeeInc,0);
		$totalCalculateOperatingPropertyMgtFeeYearsProperty = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		
		/***************OperatingHOA**********/
		$annualOpratingResult = $annualOprating/100;
		$calculateOperatingHOAInc = $calculateOperatingHOA*$annualOpratingResult;
		$totalCalculateOperatingHOAYears = round($calculateOperatingHOA+$calculateOperatingHOAInc,0);
		$totalCalculateOperatingHOAYearsHOA = round($calculateOperatingHOA,0);
		
		/***************OperatingOtherPercentileCost**********/
		$exOtherResult = $exOther/100;
		$calculateOperatingOtherPercentileCostInc = $calculateOperatingOtherPercentileCost*$annualRentIncreaseResult;
			
		$totalCalculateOperatingOtherPercentileCostYears = round($calculateOperatingOtherPercentileCost+$calculateOperatingOtherPercentileCostInc,0);
	
		$totalCalculateOperatingOtherPercentileCostYearsOPC = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
			
		/***************RevenueVacancyLoss**********/
		$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
		$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
		$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
		
		/***************RevenueGrossIncome**********/
		$calculateRentGrossIncomeInc = $calculateRentGrossIncome*$annualRentIncreaseResult;
		$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
		$vacancyLoss = round($calculateRentGrossIncome*($vacancyRate/100),0);
		$totalCalculateRevenueGrossIncomeYearsGI = $calculateRentGrossIncome-$vacancyLoss;
		
		$interestRate= $alldataRasult['interestrate'];	
		$closingCost = $alldataRasult['closingcost'];
		$upfrontImprovement = $alldataRasult['upfrontimprovement'];
		$mortgageYears= $alldataRasult['mortgageyears'];
		$downPayment = $alldataRasult['downpayment'];	
		$purchasePrice = $alldataRasult['purchaseprice'];
		$DownpaymentValue = $downPayment/100*$purchasePrice;
		$closingCostMain = $closingCost/100*$purchasePrice;
		
		$mortgageYearsMonths = $mortgageYears*12;

		$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
		$totalFinancingInputs = $DownpaymentValue+$upfrontImprovement+$closingCostMain;
		
		$PMTFixedMonthlyMultiply = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
		$PMTFixedMonthlyMultiply = $PMTFixedMonthlyMultiply*12;
		
		if($i==1){
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOI = $calculateOperatingNOI-$PMTFixedMonthlyMultiply;
			$calculateOperatingNOI = round(($calculateOperatingNOI/$totalFinancingInputs)*100,2);
			$monthlyVal[] =  $calculateOperatingNOI;	
			if(isset($summry) && $summry == 'summry'){
				echo $calculateOperatingNOI.'%';
			}else{
				if(isset($barchart) && $barchart != ''){
					$year = $xlabel.' : '.$i;
					$value .= '["'.$year.'",'.$calculateOperatingNOI.'],';		
				}else{
					$value .= "<td>$calculateOperatingNOI%</td>";
				}
			}
		} else{
			/***************OperatingPropertyTaxes**********/
			$annualOpratingResult = $annualOprating/100;
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingResult;
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
			
			/***************OperatingInsurance**********/
			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$annualOpratingResult;
			
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			
			/***************OperatingRepairs**********/
			$exOtherResult = $exOther/100;
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$exOtherResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			
			/***************OperatingUtilities**********/
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			
			
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			
			/***************OperatingOtherFixedCost**********/
			$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*$annualOpratingResult;
			
			$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
			$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
			
			$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
			
			$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
			$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
			/***************OperatingExpensesIncRevenueVacanyCalculations**********/
			$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
			
			$totalCalculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$totalCalculateOperatingTotalExpensesCalculationSum;
			
			$totalCalculateOperatingNOI = $totalCalculateOperatingNOI-$PMTFixedMonthlyMultiply;
			$totalCalculateOperatingNOI = round(($totalCalculateOperatingNOI/$totalFinancingInputs)*100,2);
			if(isset($summry) && $summry == 'summry'){
				
			}else{
				if(isset($barchart) && $barchart != ''){
					$year = $xlabel.' : '.$i;
					$value .= '["'.$year.'",'.$totalCalculateOperatingNOI.'],';		
				}else{
				   $value .= "<td>$totalCalculateOperatingNOI%</td>";
				}
			}
		}
	}
	if(isset($monthly) && $monthly =='monthly'){
		$ResultVal = round($monthlyVal[0]/12,2).'%'; 
		/* pt($monthlyVal); */
		return $ResultVal;	
	}else{
		return $value;	
	}	
}
						
function cashFlowEquityAcruedPrincipal($barchart,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$interestRate= $alldataRasult['interestrate'];
	$downPayment = $alldataRasult['downpayment'];
	$mortgageYearsMonths = $mortgageYears*12;
	$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
	$toalMonthlyEmi = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
	
	$lamount = $loanAmount;
	$mi = $interestRate;
	$n = $mortgageYears;

	$ny = $n * 12;
	$mic = $mi /1200;

	$top = pow((1+$mic),$ny);
	$bottom = $top - 1;
	$sp = $top / $bottom;

	$emi = (($lamount * $mic) * $sp);
	$k=0;
	$ck=0;
	$monthlyVal = array();
	for($i=1;$i<=$mortgageYearsMonths;$i++){
		
		if(!empty($calculateTotalLoanAndInterest)){
			$lamount = $calculateTotalLoanAndInterest-$emi;
		}
		//$lamount = $calculateTotalLoanAndInterest-$emi;
		$interestPaymentMonth = $lamount*$mic;
		if(empty($CaluclatePreviousInterestPaymentMonth)){
		$CaluclatePreviousInterestPaymentMonth ='';
		}
		$CaluclatePreviousInterestPaymentMonth = $interestPaymentMonth+$CaluclatePreviousInterestPaymentMonth;
		$calculateTotalLoanAndInterest = $lamount+$interestPaymentMonth;
		$calculateTotalPrincipalAmount = $emi-$interestPaymentMonth;
		if(empty($calculatePreviousPayment)){
			$calculatePreviousPayment ='';
		}
		$calculatePreviousPayment = $calculateTotalPrincipalAmount+$calculatePreviousPayment;
		$calculateTotalPrincipalAmountMain = round($calculatePreviousPayment,2);
		
		$calculateTotalPrincipalAmountMainResult = get_val_by_number_format($calculateTotalPrincipalAmountMain,true);
		$calculateTotalPrincipalAmountMainResultVal = explodeMinusVal($calculateTotalPrincipalAmountMainResult);
		
		$k++;
		if($k==12){
			$k=0;
			if(isset($barchart) && $barchart != ''){
				$b = str_replace( ',', '', $calculateTotalPrincipalAmountMainResult );
				$year = $xlabel.' : '.$ck;
				$value .= '["'.$year.'",'.$b.'],';		
				/* $value .= '['.$ck.','.$b.'],'; */
			}else{
				 $value .= "<td class='taxableIncomeValuesCombine'>$calculateTotalPrincipalAmountMainResultVal</td>";
			}
			$monthlyVal[] = $calculateTotalPrincipalAmountMain;
			$calculatePreviousPayment ='';
			$ck++;
		}
	}
	if(isset($monthly) && $monthly == 'monthly'){
		$result = $monthlyVal[0]/12;	
		$resultVal = get_val_by_number_format($monthlyVal[0]/12,true);	
		$finalResultVal = explodeMinusVal($resultVal);	
		return $finalResultVal;	
	}else{
		return $value;	
	}
}
						
function cashFlowInterestPaid($barchart,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$interestRate= $alldataRasult['interestrate'];
	$downPayment = $alldataRasult['downpayment'];
	$mortgageYearsMonths = $mortgageYears*12;
	$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
	$toalMonthlyEmi = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
	
	$lamount = $loanAmount;
	$mi = $interestRate;
	$n = $mortgageYears;

	$ny = $n * 12;
	$mic = $mi /1200;

	$top = pow((1+$mic),$ny);
	$bottom = $top - 1;
	$sp = $top / $bottom;

	$emi = (($lamount * $mic) * $sp);
	$k=0;
	$clas = 1;
	$monthlyVal = array();
	for($i=1;$i<=$mortgageYearsMonths;$i++){
		
		if(!empty($calculateTotalLoanAndInterest)){
			$lamount = $calculateTotalLoanAndInterest-$emi;
		}
		//$lamount = $calculateTotalLoanAndInterest-$emi;
		$interestPaymentMonth = $lamount*$mic;
		if(empty($CaluclatePreviousInterestPaymentMonth)){
		$CaluclatePreviousInterestPaymentMonth ='';
		}
		$CaluclatePreviousInterestPaymentMonth = $interestPaymentMonth+$CaluclatePreviousInterestPaymentMonth;
		$calculateTotalLoanAndInterest = $lamount+$interestPaymentMonth;
		$calculateTotalPrincipalAmount = $emi-$interestPaymentMonth;
		if(empty($calculatePreviousPayment)){
			$calculatePreviousPayment ='';
		}
		$calculatePreviousPayment = $calculateTotalPrincipalAmount+$calculatePreviousPayment;
		$calculateTotalPrincipalAmountMain = round($CaluclatePreviousInterestPaymentMonth,2);
		
		$calculateTotalPrincipalAmountMainResult = get_val_by_number_format($calculateTotalPrincipalAmountMain,true);
		$calculateTotalPrincipalAmountMainResultVal = explodeMinusVal($calculateTotalPrincipalAmountMainResult);
		
		$k++;
		if($k==12){
			$k=0;
			if(isset($barchart) && $barchart != ''){
				$b = str_replace( ',', '', $calculateTotalPrincipalAmountMainResult );
				
				$year = $xlabel.' : '.$clas;
				$value .= '["'.$year.'",'.$b.'],';		
				
			}else{
				$value .= "<td class='taxableIncomeValuesCombine dep_First_$clas'>$calculateTotalPrincipalAmountMainResultVal</td>";
			}
			$monthlyVal[] = $calculateTotalPrincipalAmountMain;
			$clas++;
			$CaluclatePreviousInterestPaymentMonth ='';
		}
	}
	if(isset($monthly) && $monthly == 'monthly'){
		$resultVal = get_val_by_number_format(($monthlyVal[0]/12),true);
		$finalResultVal = '$'.round($resultVal,2);
		return $finalResultVal;	
	}else{
		return $value;	
	}
}
						
						function debtServiceMortgage($barchart,$xlabel){
							$id = base64_decode($_GET['id']);
							$alldataRasult = get_calculator_data_by_id($id);
							
							$mortgageYears= $alldataRasult['mortgageyears'];	
							$purchasePrice = $alldataRasult['purchaseprice'];
							$monthlyRent = $alldataRasult['monthlyrent'];
							$calculateTotalRents = $monthlyRent*12;
							$vacancyRate = $alldataRasult['vacancyrate'];
							$monthlyMortgageDynamic = round($monthlyMortgagePay,2);
							
							$interestRate= $alldataRasult['interestrate'];
							$downPayment = $alldataRasult['downpayment'];
							$mortgageYearsMonths = $mortgageYears*12;
							$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
							$toalMonthlyEmi = pmtNewDebtMortgage($interestRate, $mortgageYearsMonths, $loanAmount);
							$toalMonthlyEmiYearly = round($toalMonthlyEmi*12,0);
							
							for($i=1;$i<=$mortgageYears;$i++){
								$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
								$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
								$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
								$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
								$calculateOperatingPropertyMgtFee = $totalCalculateOperatingPropertyMgtFeeYears;
								$calculateOperatingHOA = $totalCalculateOperatingHOAYears;
								$calculateOperatingOtherPercentileCost = $totalCalculateOperatingOtherPercentileCostYears;
								$calculateOperatingOtherFixedCost = $totalCalculateOperatingFixedCostYears;
								$calculateRevenueVacancyLoss = $totalCalculateRevenueVacanyLossYears;
								$calculateRevenueRentalIncome = $totalCalculateRevenueRentalIncomeYears;
								$calculateRentGrossIncome = $totalCalculateRevenueGrossIncomeYears;
								
								$toalMonthlyEmiYearly12 = $getPreviousTotalMonthlyEmiYearly;
								if(empty($toalMonthlyEmiYearly12)){
									$toalMonthlyEmiYearly12 = $toalMonthlyEmiYearly;
									$toalMonthlyEmiYearly11 = get_val_by_number_format($toalMonthlyEmiYearly,true);
									
								}
							

								if(empty($calculateOperatingPropertyTaxes1Year)){
									$calculateOperatingPropertyTaxes1Year = round(0.022*$purchasePrice,0);
								}
								if(empty($calculateOperatingInsurance1Year)){
									$calculateOperatingInsurance1Year = round(30*12,0);
								}
								if(empty($calculateOperatingRepairs1Year)){
									$calculateOperatingRepairs1Year = round(0.01*$calculateTotalRents,0);
								}
								if(empty($calculateOperatingUtilities1Year)){
									$calculateOperatingUtilities1Year = round(1*12,2);
								}
								if(empty($calculateOperatingPropertyMgtFee)){
									$calculateOperatingPropertyMgtFee = round($monthlyRent*12,0);
									$propertyMgtFee1stYear = round(0.083*$calculateOperatingPropertyMgtFee,0);
								}
								if(empty($calculateOperatingHOA)){
									$calculateOperatingHOA = round(12*120,0);
									$propertyMgtFee1stYear = round(0.083*$calculateOperatingHOA,0);
								}
								if(empty($calculateOperatingOtherPercentileCost)){
									$calculateOperatingOtherPercentileCost = round($monthlyRent*12,0);
									$otherPercentile1stYear = round(0.01*$calculateOperatingOtherPercentileCost,0);
								}
								if(empty($calculateOperatingOtherFixedCost)){
									$calculateOperatingOtherFixedCost = round(12*5,2);
								}
								if(empty($calculateRevenueVacancyLoss)){
									$calculateRevenueVacancyLoss = round($monthlyRent*12,0);
								}
								if(empty($calculateRevenueRentalIncome)){
									$calculateRevenueRentalIncome = round($monthlyRent*12,0);
								}
								if(empty($calculateRentGrossIncome)){
									$calculateRentGrossIncome = round($monthlyRent*12,0);
								}
								
								/***************OperatingProprtyMgtFees**********/
								$calculateOperatingPropertyMgtFeeInc = $calculateOperatingPropertyMgtFee*0.02;
								$totalCalculateOperatingPropertyMgtFeeYears = round($calculateOperatingPropertyMgtFee+$calculateOperatingPropertyMgtFeeInc,0);
								$totalCalculateOperatingPropertyMgtFeeYearsProperty = round(0.083*$calculateOperatingPropertyMgtFee,0);
								
								/***************OperatingHOA**********/
								$calculateOperatingHOAInc = $calculateOperatingHOA*0.01;
								$totalCalculateOperatingHOAYears = round($calculateOperatingHOA+$calculateOperatingHOAInc,0);
								$totalCalculateOperatingHOAYearsHOA = round($calculateOperatingHOA,0);
								
								/***************OperatingOtherPercentileCost**********/
								$calculateOperatingOtherPercentileCostInc = $calculateOperatingOtherPercentileCost*0.02;
								$totalCalculateOperatingOtherPercentileCostYears = round($calculateOperatingOtherPercentileCost+$calculateOperatingOtherPercentileCostInc,0);
								$totalCalculateOperatingOtherPercentileCostYearsOPC = round(0.01*$calculateOperatingOtherPercentileCost,0);
								
								/***************RevenueVacancyLoss**********/
								$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*0.02;
								$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
								$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
								
								/***************RevenueGrossIncome**********/
								$calculateRentGrossIncomeInc = $calculateRentGrossIncome*0.02;
								$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
								$vacancyLoss = round($calculateRentGrossIncome*($vacancyRate/100),0);
								$totalCalculateRevenueGrossIncomeYearsGI = $calculateRentGrossIncome-$vacancyLoss;
								
								$interestRate= $alldataRasult['interestrate'];	
								$closingCost = $alldataRasult['closingcost'];
								$upfrontImprovement = $alldataRasult['upfrontimprovement'];
								$mortgageYears= $alldataRasult['mortgageyears'];
								$downPayment = $alldataRasult['downpayment'];	
								$purchasePrice = $alldataRasult['purchaseprice'];
								$DownpaymentValue = $downPayment/100*$purchasePrice;
								$closingCostMain = $closingCost/100*$purchasePrice;
								
								$mortgageYearsMonths = $mortgageYears*12;

								$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
								$totalFinancingInputs = $DownpaymentValue+$upfrontImprovement+$closingCostMain;
								
								$PMTFixedMonthlyMultiply = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
								$PMTFixedMonthlyMultiply = $PMTFixedMonthlyMultiply*12;
															
							/* 	if($i==1){ */
									$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
									
									$calculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
									
									$calculateOperatingNOI = $calculateOperatingNOI-$PMTFixedMonthlyMultiply;
									$calculateOperatingNOI = round(($calculateOperatingNOI/$totalFinancingInputs)*100,2);
									
									if(isset($barchart) && $barchart != ''){
										$year = $xlabel.' : '.$i;
										$value .= '["'.$year.'",'.$toalMonthlyEmiYearly12.'],';		
									}else{
										$value .= "<td>$$toalMonthlyEmiYearly11</td>";
									}
									
								/* } else{ */
									/***************OperatingPropertyTaxes**********/
									/* $calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*0.01;
									$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0); */
									
									/***************OperatingInsurance**********/
									/* $calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*0.01;
									$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0); */
									
									/***************OperatingRepairs**********/
									/* $calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*0.01;
									$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0); */
									
									/***************OperatingUtilities**********/
								/* 	$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*0.01;
									$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
									$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0); */
									
									/***************OperatingOtherFixedCost**********/
								/* 	$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*0.01;
									$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
									$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
									
									$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*0.02;
									$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
									$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0); */
									
									/***************OperatingExpensesIncRevenueVacanyCalculations**********/
								/* 	$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
									
									$totalCalculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$totalCalculateOperatingTotalExpensesCalculationSum;
									
									$totalCalculateOperatingNOI = $totalCalculateOperatingNOI-$PMTFixedMonthlyMultiply;
									$totalCalculateOperatingNOI = round(($totalCalculateOperatingNOI/$totalFinancingInputs)*100,2);
									
									$getPreviousTotalMonthlyEmiYearly = $toalMonthlyEmiYearly12;
									$getPreviousTotalMonthlyEmiYearlyPercentage = round($totalCalculateOperatingNOI/100,2);
									$getPreviousTotalMonthlyEmiYearly = $toalMonthlyEmiYearly12+$getPreviousTotalMonthlyEmiYearlyPercentage;
									$getPreviousTotalMonthlyEmiYearlyShow = round($toalMonthlyEmiYearly12+$getPreviousTotalMonthlyEmiYearlyPercentage,0);
									$getPreviousTotalMonthlyEmiYearlyShowResult = get_val_by_number_format($getPreviousTotalMonthlyEmiYearlyShow,true);
									if(isset($barchart) && $barchart != ''){
										$year = $xlabel.' : '.$i;
										$value .= '["'.$year.'",'.$getPreviousTotalMonthlyEmiYearlyShow.'],';		
									}else{
									   $value .= "<td>$$getPreviousTotalMonthlyEmiYearlyShowResult</td>";
									} */
									
									/* $value .= '["'.$year.'",'.$getPreviousTotalMonthlyEmiYearlyShow.'],';	 */
									
								/* } */
							}
							return $value;
						}
						
						/**************Function DebtServiceCumulativeInterestStart************/
						
function debtServiceCumulativeInterest($barchart,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$interestRate= $alldataRasult['interestrate'];
	$downPayment = $alldataRasult['downpayment'];
	$mortgageYearsMonths = $mortgageYears*12;
	$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
	$toalMonthlyEmi = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
	
	$lamount = $loanAmount;
	$mi = $interestRate;
	$n = $mortgageYears;

	$ny = $n * 12;
	$mic = $mi /1200;

	$top = pow((1+$mic),$ny);
	$bottom = $top - 1;
	$sp = $top / $bottom;

	$emi = (($lamount * $mic) * $sp);
	$k=0;
	$j=1;
	$monthlyVal = array();
	for($i=1;$i<=$mortgageYearsMonths;$i++){
		
		if(!empty($calculateTotalLoanAndInterest)){
			$lamount = $calculateTotalLoanAndInterest-$emi;
		}
		//$lamount = $calculateTotalLoanAndInterest-$emi;
		$interestPaymentMonth = $lamount*$mic;
		if(empty($CaluclatePreviousInterestPaymentMonth)){
		$CaluclatePreviousInterestPaymentMonth ='';
		}
		$CaluclatePreviousInterestPaymentMonth = $interestPaymentMonth+$CaluclatePreviousInterestPaymentMonth;
		$calculateTotalLoanAndInterest = $lamount+$interestPaymentMonth;
		$calculateTotalPrincipalAmount = $emi-$interestPaymentMonth;
		if(empty($calculatePreviousPayment)){
			$calculatePreviousPayment ='';
		}
		$calculatePreviousPayment = $calculateTotalPrincipalAmount+$calculatePreviousPayment;
		$calculateTotalPrincipalAmountMain = number_format(round($CaluclatePreviousInterestPaymentMonth,2));
		$k++;
		if($k==12){
			$k=0;
			if(isset($barchart) && $barchart != ''){
				$b = str_replace( ',', '', $calculateTotalPrincipalAmountMain );
				$year = $xlabel.' : '.$j;
				$value .= '["'.$year.'",'.$b.'],';		
			}else{
				$monthlyVal[] = $CaluclatePreviousInterestPaymentMonth;
			  $value .= "<td class='taxableIncomeValuesCombine'>$$calculateTotalPrincipalAmountMain</td>";
			}
			//$CaluclatePreviousInterestPaymentMonth ='';
			$j++;
		}
	}
	if(isset($monthly) && $monthly == 'monthly'){
		$result = $monthlyVal[0]/12; 
		$resultVal = '$'.number_format(round($result,2)); 
		return $resultVal;	
	}else{
		return $value;	
	}
}
							
function debtServiceCumulativeEquity($barchart,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$interestRate= $alldataRasult['interestrate'];
	$downPayment = $alldataRasult['downpayment'];
	$mortgageYearsMonths = $mortgageYears*12;
	$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
	$toalMonthlyEmi = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
	
	$lamount = $loanAmount;
	$mi = $interestRate;
	$n = $mortgageYears;
	$ny = $n * 12;
	$mic = $mi /1200;

	$top = pow((1+$mic),$ny);
	$bottom = $top - 1;
	$sp = $top / $bottom;

	$emi = (($lamount * $mic) * $sp);
	$k=0;
	$j=1;
	$monthlyVal = array();
	for($i=1;$i<=$mortgageYearsMonths;$i++){
		
		if(!empty($calculateTotalLoanAndInterest)){
			$lamount = $calculateTotalLoanAndInterest-$emi;
		}
		//$lamount = $calculateTotalLoanAndInterest-$emi;
		$interestPaymentMonth = $lamount*$mic;
		if(empty($CaluclatePreviousInterestPaymentMonth)){
		$CaluclatePreviousInterestPaymentMonth ='';
		}
		$CaluclatePreviousInterestPaymentMonth = $interestPaymentMonth+$CaluclatePreviousInterestPaymentMonth;
		$calculateTotalLoanAndInterest = $lamount+$interestPaymentMonth;
		$calculateTotalPrincipalAmount = $emi-$interestPaymentMonth;
		if(empty($calculatePreviousPayment)){
			$calculatePreviousPayment ='';
		}
		$calculatePreviousPayment = $calculateTotalPrincipalAmount+$calculatePreviousPayment;
		$calculateTotalPrincipalAmountMain = number_format(round($calculatePreviousPayment,2));
		$k++;
		if($k==12){
			$k=0;
			if(isset($barchart) && $barchart != ''){
				$b = str_replace(',', '', $calculateTotalPrincipalAmountMain);
				$year = $xlabel.' : '.$j;
				$value .= '["'.$year.'",'.$b.'],';		
			}else{
				$monthlyVal[] = $calculatePreviousPayment;
				$value .=  "<td class='taxableIncomeValuesCombine'>$$calculateTotalPrincipalAmountMain</td>";
			}
			$j++;
		}
	}
	if(isset($monthly) && $monthly == 'monthly'){
		$result = $monthlyVal[0]/12;
		$resultVal = '$'.number_format(round($result,2));
		return $resultVal;
	}else{
		return $value;	
	}
}

						
function debtServiceLoanPayOffAmount($barchart,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
							
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$interestRate= $alldataRasult['interestrate'];
	$downPayment = $alldataRasult['downpayment'];
	$mortgageYearsMonths = $mortgageYears*12;
	$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
	$toalMonthlyEmi = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
	
	$lamount = $loanAmount;
	$mi = $interestRate;
	$n = $mortgageYears;

	$ny = $n * 12;
	$mic = $mi /1200;

	$top = pow((1+$mic),$ny);
	$bottom = $top - 1;
	$sp = $top / $bottom;

	$emi = (($lamount * $mic) * $sp);
	$k=0;
	$n = 1;
	$monthlyVal = array();
	for($i=1;$i<=$mortgageYearsMonths;$i++){
		
		if(!empty($calculateTotalLoanAndInterest)){
			$lamount = $calculateTotalLoanAndInterest-$emi;
		}
		//$lamount = $calculateTotalLoanAndInterest-$emi;
		$interestPaymentMonth = $lamount*$mic;
		if(empty($CaluclatePreviousInterestPaymentMonth)){
		$CaluclatePreviousInterestPaymentMonth ='';
		}
		$CaluclatePreviousInterestPaymentMonth = $interestPaymentMonth+$CaluclatePreviousInterestPaymentMonth;
		$calculateTotalLoanAndInterest = $lamount+$interestPaymentMonth;
		$calculateTotalPrincipalAmount = $emi-$interestPaymentMonth;
		if(empty($calculatePreviousPayment)){
			$calculatePreviousPayment ='';
		}
		$calculatePreviousPayment = $calculateTotalPrincipalAmount+$calculatePreviousPayment;
		$calculateTotalPrincipalAmountMain = round($calculatePreviousPayment,2);
		$k++;
		if($k==12){
			$k=0;
			$calculateTotalPrincipalAmountMain = round($loanAmount-$calculateTotalPrincipalAmountMain,0);	
			if(isset($barchart) && $barchart == 'barchart'){
				if($n == $mortgageYearsMonths){
					
					$year = $xlabel.' : '.$n;
					$value .= $barchartTocalculateTotalPrincipalAmountMain = '["'.$year.'",'.$calculateTotalPrincipalAmountMain.'],';		
				}else{
					
					$year = $xlabel.' : '.$n;
					$value .= $barchartTocalculateTotalPrincipalAmountMain = '["'.$year.'",'.$calculateTotalPrincipalAmountMain.'],';
					
				}
				$n++;
			}else{
				$monthlyVal[] = $calculateTotalPrincipalAmountMain;
				$calculateTotalPrincipalAmountMainVal = get_val_by_number_format($calculateTotalPrincipalAmountMain,true);
				$calculateTotalPrincipalAmountMainValResult = explodeMinusVal($calculateTotalPrincipalAmountMainVal);
				$value .= "<td class='taxableIncomeValuesCombine'>$calculateTotalPrincipalAmountMainValResult</td>";	
			}
			
		}
	}
	if(isset($monthly) && $monthly == 'monthly'){
		$result = $monthlyVal[0]/12;
		$resultVal = '$'.number_format(round($result,2));
		return $resultVal;
	}else{
		return $value;	
	}
}
						
function cashFlowTaxableIncome(){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$interestRate= $alldataRasult['interestrate'];
	$downPayment = $alldataRasult['downpayment'];
	$mortgageYearsMonths = $mortgageYears*12;
	$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
	$toalMonthlyEmi = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
	
	$lamount = $loanAmount;
	$mi = $interestRate;
	$n = $mortgageYears;

	$ny = $n * 12;
	$mic = $mi /1200;

	$top = pow((1+$mic),$ny);
	$bottom = $top - 1;
	$sp = $top / $bottom;

	$emi = (($lamount * $mic) * $sp);
	$k=0;

	for($i=1;$i<=$mortgageYearsMonths;$i++){
		
		if(!empty($calculateTotalLoanAndInterest)){
			$lamount = $calculateTotalLoanAndInterest-$emi;
		}
		//$lamount = $calculateTotalLoanAndInterest-$emi;
		$interestPaymentMonth = $lamount*$mic;
		if(empty($CaluclatePreviousInterestPaymentMonth)){
		$CaluclatePreviousInterestPaymentMonth ='';
		}
		$CaluclatePreviousInterestPaymentMonth = $interestPaymentMonth+$CaluclatePreviousInterestPaymentMonth;
		$calculateTotalLoanAndInterest = $lamount+$interestPaymentMonth;
		$calculateTotalPrincipalAmount = $emi-$interestPaymentMonth;
		if(empty($calculatePreviousPayment)){
			$calculatePreviousPayment ='';
		}
		$calculatePreviousPayment = $calculateTotalPrincipalAmount+$calculatePreviousPayment;
		$calculateTotalPrincipalAmountMain = number_format(round($CaluclatePreviousInterestPaymentMonth,2));
		$k++;
		if($k==12){
		$k=0;
		echo "<td>$$calculateTotalPrincipalAmountMain</td>";
		$CaluclatePreviousInterestPaymentMonth ='';
		}
	}
	
}
						
						
function cashFlowDepreciationMonthlyCalculations(){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$buildingValue = $purchasePrice*0.75;
	$amortizationPeriodYears = $alldataRasult['amortizationperiodyears'];
	$cashFlowTaxDepreciationYearly =  round($buildingValue/$amortizationPeriodYears,0); 
	$cashFlowTaxDepreciationMonthly = round($cashFlowTaxDepreciationYearly/12,0);	

	$cashFlowTaxDepreciationMonthlyResult = get_val_by_number_format($cashFlowTaxDepreciationMonthly,true);
	$cashFlowTaxDepreciationMonthlyResultVal = explodeMinusVal($cashFlowTaxDepreciationMonthlyResult);
		
	echo "<td>$cashFlowTaxDepreciationMonthlyResultVal</td>";							
}
					
					
function cashflowtaxableincomeyearly($incomeTaxes,$barchart,$xlabel,$monthlyIncomeTaxes){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);

	$mortgageYears = $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$marginalTaxRate = $alldataRasult['marginaltaxrate'];
	$buildingValue = $purchasePrice*0.75;
	$amortizationPeriodYears = $alldataRasult['amortizationperiodyears'];
	$cashFlowTaxDepreciationYearly =  round($buildingValue/$amortizationPeriodYears,0); 
	$monthlyRent = $alldataRasult['monthlyrent'];
	$calculateTotalRents = $monthlyRent*12;
	$vacancyRate = $alldataRasult['vacancyrate'];
	$interestRate = $alldataRasult['interestrate'];
	$downPayment = $alldataRasult['downpayment'];
	$exUtilities = $alldataRasult['exutilities'];
	$exHoa = $alldataRasult['exhoa'];
	$exOtherfixed = $alldataRasult['exotherfixed'];
	$exOther = $alldataRasult['exother'];
	$exOtherResult = $exOther/100;
	$exRepairs = $alldataRasult['exrepairs'];
	$exRepairsResult = $exRepairs/100;
	$exproPertytaxes = $alldataRasult['expropertytaxes'];
	$exproPertytaxesResult = $exproPertytaxes/100;

	/*Annual Rent Increase in % */
	$AnuualRentIncrease = $alldataRasult['annualrentincrease'];
	$AnuualRentIncreaseResult = $AnuualRentIncrease/100;
	$propertYmGmt = $alldataRasult['expropertymgmt'];
	$propertYmGmtResult = $propertYmGmt/100;
	
	/*Monthly Issurance in $ */
	$monthlyInsurance = $alldataRasult['exinsurance'];
	
	/*Yearly Issurance in $ */
	$yearlyInsurance = $monthlyInsurance*12;
	
	/* Annual Operating Expenses % */
	$annualOpratingExpences = $alldataRasult['annualoprating']; 
	$annualOpratingExpencesResult = $annualOpratingExpences/100;
	$PropertyMgmtFee = $totalPropertyMgmtFee;
	
	if(empty($PropertyMgmtFee)){
		$PropertyMgmtFee = round($calculateTotalRents*$propertYmGmt/100,0);
	}
	
	$mortgageYearsMonths = $mortgageYears*12;
	$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
	$toalMonthlyEmi = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
	$lamount = $loanAmount;
	$mi = $interestRate;
	$n = $mortgageYears;

	$ny = $n * 12;
	$mic = $mi /1200;

	$top = pow((1+$mic),$ny);
	$bottom = $top - 1;
	$sp = $top / $bottom;

	$emi = (($lamount * $mic) * $sp);
	$k=0;
	
	
	$calculateTotalPrincipalAmountMainCustom = array();
	for($ik=1;$ik<=$mortgageYearsMonths;$ik++){
		
		if(!empty($calculateTotalLoanAndInterest)){
			$lamount = $calculateTotalLoanAndInterest-$emi;
		}
		$interestPaymentMonth = $lamount*$mic;
		if(empty($CaluclatePreviousInterestPaymentMonth)){
			$CaluclatePreviousInterestPaymentMonth ='';
		}
		$CaluclatePreviousInterestPaymentMonth = $interestPaymentMonth+$CaluclatePreviousInterestPaymentMonth;
		$calculateTotalLoanAndInterest = $lamount+$interestPaymentMonth;
		$calculateTotalPrincipalAmount = $emi-$interestPaymentMonth;
		if(empty($calculatePreviousPayment)){
			$calculatePreviousPayment ='';
		}
		$calculatePreviousPayment = $calculateTotalPrincipalAmount+$calculatePreviousPayment;
		$calculateTotalPrincipalAmountMain = round($CaluclatePreviousInterestPaymentMonth,0);
		
		$k++;
		
		if($k==12){
		
			$k=0;
		
			$calculateTotalPrincipalAmountMainCustom[] = $calculateTotalPrincipalAmountMain;
			array_unshift($calculateTotalPrincipalAmountMainCustom,"");
			unset($calculateTotalPrincipalAmountMainCustom[0]);
		
			$CaluclatePreviousInterestPaymentMonth ='';
		}
	}
	/* pt($calculateTotalPrincipalAmountMainCustom); */
	
	$monthlyIncomeTaxesVal = array();
	for($i=1;$i<=$mortgageYears;$i++){
		
		$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
		$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
		$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		$calculateOperatingPropertyMgtFee = $totalCalculateOperatingPropertyMgtFeeYears;
		$calculateOperatingHOA = $totalCalculateOperatingHOAYears;
		$calculateOperatingOtherPercentileCost = $totalCalculateOperatingOtherPercentileCostYears;
		$calculateOperatingOtherFixedCost = $totalCalculateOperatingFixedCostYears;
		$calculateRevenueVacancyLoss = $totalCalculateRevenueVacanyLossYears;
		$calculateRevenueRentalIncome = $totalCalculateRevenueRentalIncomeYears;
		$calculateRentGrossIncome = $totalCalculateRevenueGrossIncomeYears;

		if(empty($calculateOperatingPropertyTaxes1Year)){
			$calculateOperatingPropertyTaxes1Year = round($exproPertytaxesResult*$purchasePrice,0);
		}
		if(empty($calculateOperatingInsurance1Year)){
			$calculateOperatingInsurance1Year = round($monthlyInsurance*12,0);
		}
		if(empty($calculateOperatingRepairs1Year)){
			$calculateOperatingRepairs1Year = round($exRepairsResult*$calculateTotalRents,0);
		}
		if(empty($calculateOperatingUtilities1Year)){
			$calculateOperatingUtilities1Year = round($exUtilities*12,2);
		}
		if(empty($calculateOperatingPropertyMgtFee)){
			$calculateOperatingPropertyMgtFee = round($monthlyRent*12,0);
			$propertyMgtFee1stYear = round($propertYmGmtResult*$calculateOperatingPropertyMgtFee,0);
		}
		if(empty($calculateOperatingHOA)){
			$calculateOperatingHOA = round(12*$exHoa,0);
			$propertyMgtFee1stYear = round($propertYmGmtResult*$calculateOperatingHOA,0);
		}
		if(empty($calculateOperatingOtherPercentileCost)){
			$calculateOperatingOtherPercentileCost = round($monthlyRent*12,0);
			$otherPercentile1stYear = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		}
		if(empty($calculateOperatingOtherFixedCost)){
			$calculateOperatingOtherFixedCost = round(12*$exOtherfixed,2);
		}
		if(empty($calculateRevenueVacancyLoss)){
			$calculateRevenueVacancyLoss = round($monthlyRent*12,0);
		}
		if(empty($calculateRevenueRentalIncome)){
			$calculateRevenueRentalIncome = round($monthlyRent*12,0);
		}
		if(empty($calculateRentGrossIncome)){
			$calculateRentGrossIncome = round($monthlyRent*12,0);
		}
		
		/***************OperatingProprtyMgtFees**********/
		$calculateOperatingPropertyMgtFeeInc = $calculateOperatingPropertyMgtFee*$AnuualRentIncreaseResult;
		$totalCalculateOperatingPropertyMgtFeeYears = round($calculateOperatingPropertyMgtFee+$calculateOperatingPropertyMgtFeeInc,0);
		$totalCalculateOperatingPropertyMgtFeeYearsProperty = round($propertYmGmtResult*$calculateOperatingPropertyMgtFee,0);
		
		/***************OperatingHOA**********/
			$calculateOperatingHOAInc = $calculateOperatingHOA*$exOtherResult;
			$totalCalculateOperatingHOAYears = round($calculateOperatingHOA+$calculateOperatingHOAInc,0);
			$totalCalculateOperatingHOAYearsHOA = round($calculateOperatingHOA,0);
		
		/***************OperatingOtherPercentileCost**********/
			$calculateOperatingOtherPercentileCostInc = $calculateOperatingOtherPercentileCost*$AnuualRentIncreaseResult;
			$totalCalculateOperatingOtherPercentileCostYears = round($calculateOperatingOtherPercentileCost+$calculateOperatingOtherPercentileCostInc,0);
			$totalCalculateOperatingOtherPercentileCostYearsOPC = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		
		/***************RevenueVacancyLoss**********/
			$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$AnuualRentIncreaseResult;
			$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
			
			$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
		
		/***************RevenueGrossIncome**********/
			$calculateRentGrossIncomeInc = $calculateRentGrossIncome*$AnuualRentIncreaseResult;
			$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
			$vacancyLoss = round($calculateRentGrossIncome*($vacancyRate/100),0);
			$totalCalculateRevenueGrossIncomeYearsGI = $calculateRentGrossIncome-$vacancyLoss;
		
		if($i==1){
		
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOITT = $calculateOperatingNOI-$calculateTotalPrincipalAmountMainCustom[$i];
	
			
			$Netshell  = $calculateOperatingNOI-$calculateTotalPrincipalAmountMainCustom[$i]-$cashFlowTaxDepreciationYearly-$yearlyInsurance-$calculateOperatingRepairs1Year-$PropertyMgmtFee-$totalCalculateOperatingOtherPercentileCostYearsOPC;
			
			if($incomeTaxes == 'incomeTaxes'){
				if($Netshell < 0){
					$replaceNegativeVal = '$0';
				}else{
					$replaceNegativeResult = get_val_by_number_format($Netshell * $marginalTaxRate / 100,true);
					$replaceNegativeResultVal = explodeMinusVal($replaceNegativeResult);
					$replaceNegativeVal	= $replaceNegativeResultVal;				
				}
			}else{
				
				$replacePositiveResult = get_val_by_number_format($Netshell,true);
				$replacePositiveResultVal = explodeMinusVal($replacePositiveResult);
				$replaceNegativeVal = $replacePositiveResultVal;
				
			}
			
			if(isset($barchart) && $barchart != ''){
				$b = str_replace( '$', '', $replaceNegativeVal );
			   	$c = str_replace( ',', '', $b );
                
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$c.'],';		
			}else{
			   $value .= "<td class=''>$replaceNegativeVal</td>";
			}
			$replceDoller = str_replace( '$', '', $replaceNegativeVal );
			$replceComma = str_replace( ',', '', $replceDoller );
			$monthlyIncomeTaxesVal[] = $replceComma;
		} else{
			/* pt($calculateTotalPrincipalAmountMainCustom[$i]); */
			
			/***************OperatingPropertyTaxes**********/
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingExpencesResult;
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
			
			/***************OperatingInsurance**********/
			$yearInsurance = $yearlyInsurance;
			$operatingExpensesIncrease = $annualOpratingExpences++; 
			$operatingExpensesIncreaseAddedtoYear = $yearlyInsurance*$operatingExpensesIncrease/100;
			
			$thisYearInsurance =  round($yearInsurance+$operatingExpensesIncreaseAddedtoYear,0);
			

			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$operatingExpensesIncrease/100;
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			
			
			/***************OperatingRepairs**********/
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$annualOpratingExpencesResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			
			/***************OperatingUtilities**********/
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingExpencesResult;
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			
			/***************OperatingOtherFixedCost**********/
			$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*$annualOpratingExpencesResult;
			$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
			$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
			
			$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$AnuualRentIncreaseResult;
			$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
			$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
			/***************OperatingExpensesIncRevenueVacanyCalculations**********/
			$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
			
			$totalSumOfExpenses = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall+$thisYearInsurance;
			
			$totalCalculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$totalSumOfExpenses;
			
			/***************Other Percentile Cost**********/
			
			$calculateRentGrossIncomeInc = $calculateRentGrossIncome*$AnuualRentIncreaseResult;
			$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
			$OtherPercentileCost = round($totalCalculateRevenueGrossIncomeYears*$operatingExpensesIncrease,0);
			
			$TotalTaxableIncome = $totalCalculateOperatingNOI-$calculateTotalPrincipalAmountMainCustom[$i]-$cashFlowTaxDepreciationYearly-$thisYearInsurance-$totalCalculateOperatingRepairsYears-$totalCalculateOperatingPropertyMgtFeeYearsProperty-$totalCalculateOperatingOtherPercentileCostYearsOPC;
			
			if($incomeTaxes == 'incomeTaxes'){
				if($TotalTaxableIncome < 0){
					$replaceNegativeVals = '$0';
				}else{
					$incomeTaxesResult = get_val_by_number_format($TotalTaxableIncome * $marginalTaxRate / 100,true);
					$incomeTaxesResultVal = explodeMinusVal($incomeTaxesResult);
					$replaceNegativeVals = $incomeTaxesResultVal;	
				}
			}else{
				$incomeTaxesResult = get_val_by_number_format($TotalTaxableIncome,true);
				$replaceNegativeVals = explodeMinusVal($incomeTaxesResult);
			}
			
			if(isset($barchart) && $barchart != ''){
			   	$b = str_replace( '$', '', $replaceNegativeVals );
			   	$c = str_replace( ',', '', $b );
                
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$c.'],';	
				
			}else{
			   $value .= "<td class=''>$replaceNegativeVals</td>";
			}
		}
	}
	if(isset($monthlyIncomeTaxes) && $monthlyIncomeTaxes == 'monthlyIncomeTaxes'){
		$result = $monthlyIncomeTaxesVal[0]/12;
		$resultVal = get_val_by_number_format($result,true);
		$finalResultVal = explodeMinusVal($resultVal);
		return $finalResultVal;
	}else{
		return $value;	
	}
}



function AfterTaxCashFlow($monthly,$barchart,$xlabel){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	$mortgageYears = $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$buildingValue = $purchasePrice*0.75;
	$amortizationPeriodYears = $alldataRasult['amortizationperiodyears'];
	$cashFlowTaxDepreciationYearly =  round($buildingValue/$amortizationPeriodYears,0); 
	$monthlyRent = $alldataRasult['monthlyrent'];
	$calculateTotalRents = $monthlyRent*12;
	$vacancyRate = $alldataRasult['vacancyrate'];
	$interestRate= $alldataRasult['interestrate'];
	$marginaltaxrate = $alldataRasult['marginaltaxrate'];
	$marginaltaxrateResult = $marginaltaxrate/100;
	$downPayment = $alldataRasult['downpayment'];
	$exHOA = $alldataRasult['exhoa'];
	$exOther = $alldataRasult['exother'];
	$monthlyMortgageDynamic = round($monthlyMortgagePay,2);
	
	/*Annual Rent Increase in % */
	$AnuualRentIncrease = $alldataRasult['annualrentincrease'];
	
	$propertYmGmt = $alldataRasult['expropertymgmt'];
	
	/*Monthly Issurance in $ */
	$monthlyInsurance = $alldataRasult['exinsurance'];
	
	/*Yearly Issurance in $ */
	$yearlyInsurance = $monthlyInsurance*12;
	
	/* Annual Operating Expenses % */
	$annualOpratingExpences = $alldataRasult['annualoprating']; 
	
	$PropertyMgmtFee = $totalPropertyMgmtFee;
	if(empty($PropertyMgmtFee)){
		$PropertyMgmtFee = round($calculateTotalRents*$propertYmGmt/100,0);
	}

	
	$mortgageYearsMonths = $mortgageYears*12;
	$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
	$toalMonthlyEmi = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
	$lamount = $loanAmount;
	$mi = $interestRate;
	$n = $mortgageYears;

	$ny = $n * 12;
	$mic = $mi /1200;

	$top = pow((1+$mic),$ny);
	$bottom = $top - 1;
	$sp = $top / $bottom;

	$emi = (($lamount * $mic) * $sp);
	$k=0;
	
	
	$calculateTotalPrincipalAmountMainCustom = array();
	
	for($ik=1;$ik<=$mortgageYearsMonths;$ik++){
		
		if(!empty($calculateTotalLoanAndInterest)){
			$lamount = $calculateTotalLoanAndInterest-$emi;
		}
		$interestPaymentMonth = $lamount*$mic;
		if(empty($CaluclatePreviousInterestPaymentMonth)){
			$CaluclatePreviousInterestPaymentMonth ='';
		}
		$CaluclatePreviousInterestPaymentMonth = $interestPaymentMonth+$CaluclatePreviousInterestPaymentMonth;
		$calculateTotalLoanAndInterest = $lamount+$interestPaymentMonth;
		$calculateTotalPrincipalAmount = $emi-$interestPaymentMonth;
		if(empty($calculatePreviousPayment)){
			$calculatePreviousPayment ='';
		}
		$calculatePreviousPayment = $calculateTotalPrincipalAmount+$calculatePreviousPayment;
		$calculateTotalPrincipalAmountMain = round($CaluclatePreviousInterestPaymentMonth,0);
		
		$k++;
		
		if($k==12){
		
			$k=0;
		
			$calculateTotalPrincipalAmountMainCustom[] = $calculateTotalPrincipalAmountMain;
			array_unshift($calculateTotalPrincipalAmountMainCustom,"");
			unset($calculateTotalPrincipalAmountMainCustom[0]);
		
			$CaluclatePreviousInterestPaymentMonth ='';
		}
	}
	$monthlyInsurance = $alldataRasult['exinsurance'];	
	$exOtherFixedXost = $alldataRasult['exotherfixed'];
	$exRepairs = $alldataRasult['exrepairs'];
	$exPropertyTaxes = $alldataRasult['expropertytaxes'];
	$annualOpratingResult = $annualOpratingExpences/100;
	$operatingExpensesIncreaseResult = $operatingExpensesIncrease/100;
	for($i=1;$i<=$mortgageYears;$i++){
		
		$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
		$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
		$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		$calculateOperatingPropertyMgtFee = $totalCalculateOperatingPropertyMgtFeeYears;
		$calculateOperatingHOA = $totalCalculateOperatingHOAYears;
		$calculateOperatingOtherPercentileCost = $totalCalculateOperatingOtherPercentileCostYears;
		$calculateOperatingOtherFixedCost = $totalCalculateOperatingFixedCostYears;
		$calculateRevenueVacancyLoss = $totalCalculateRevenueVacanyLossYears;
		$calculateRevenueRentalIncome = $totalCalculateRevenueRentalIncomeYears;
		$calculateRentGrossIncome = $totalCalculateRevenueGrossIncomeYears;

		if(empty($calculateOperatingPropertyTaxes1Year)){
			$exPropertyTaxesResult = $exPropertyTaxes/100;
			$calculateOperatingPropertyTaxes1Year = round($exPropertyTaxesResult*$purchasePrice,0);
		}
		if(empty($calculateOperatingInsurance1Year)){
			$calculateOperatingInsurance1Year = round($monthlyInsurance*12,0);
		}
		if(empty($calculateOperatingRepairs1Year)){
			$exRepairsResult = $exRepairs/100;
			$calculateOperatingRepairs1Year = round($exRepairsResult*$calculateTotalRents,0);
		}
		if(empty($calculateOperatingUtilities1Year)){
			$exUtilitiesResult = $exUtilities * 12;
			$calculateOperatingUtilities1Year = round($exUtilitiesResult,2);
		}
		if(empty($calculateOperatingPropertyMgtFee)){
			$calculateOperatingPropertyMgtFee = round($monthlyRent*12,0);			
			$exPropertymgmtResult = $propertYmGmt/100;
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		}
		if(empty($calculateOperatingHOA)){
			$exHOAResult = $exHOA*12; 
			$calculateOperatingHOA = round($exHOAResult,0);
			$exPropertymgmtResult = $propertYmGmt/100;
			
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingHOA,0);
		}
		
		if(empty($calculateOperatingOtherPercentileCost)){
			$calculateOperatingOtherPercentileCost = round($monthlyRent*12,0);
			$exOtherResult = $exOther/100;
			$otherPercentile1stYear = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		}
		if(empty($calculateOperatingOtherFixedCost)){
			$exOtherFixedXostResult = $exOtherFixedXost*12;
		/* 	pt($exOtherFixedXostResult); */
			$calculateOperatingOtherFixedCost = round($exOtherFixedXostResult,2);
		}
		if(empty($calculateRevenueVacancyLoss)){
			$calculateRevenueVacancyLoss = round($monthlyRent*12,0);
		}
		if(empty($calculateRevenueRentalIncome)){
			$calculateRevenueRentalIncome = round($monthlyRent*12,0);
		}
		if(empty($calculateRentGrossIncome)){
			$calculateRentGrossIncome = round($monthlyRent*12,0);
		}
		
		/***************OperatingProprtyMgtFees**********/
		$annualRentIncreaseResult = $AnuualRentIncrease/100;
	
	
		$calculateOperatingPropertyMgtFeeInc = $calculateOperatingPropertyMgtFee*$annualRentIncreaseResult;
		
		$exPropertymgmtResult = $propertYmGmt/100;
	
		$totalCalculateOperatingPropertyMgtFeeYears = round($calculateOperatingPropertyMgtFee+$calculateOperatingPropertyMgtFeeInc,0);
		$totalCalculateOperatingPropertyMgtFeeYearsProperty = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		
		/***************OperatingHOA**********/
		
		/* pt($annualOpratingResult); */
		$calculateOperatingHOAInc = $calculateOperatingHOA*$annualOpratingResult;
		$totalCalculateOperatingHOAYears = round($calculateOperatingHOA+$calculateOperatingHOAInc,0);
		$totalCalculateOperatingHOAYearsHOA = round($calculateOperatingHOA,0);
		
		
		/***************OperatingOtherPercentileCost**********/
		$exOtherResult = $exOther/100;
		$calculateOperatingOtherPercentileCostInc = $calculateOperatingOtherPercentileCost*$annualRentIncreaseResult;
			
		$totalCalculateOperatingOtherPercentileCostYears = round($calculateOperatingOtherPercentileCost+$calculateOperatingOtherPercentileCostInc,0);
	
		$totalCalculateOperatingOtherPercentileCostYearsOPC = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		
		/***************RevenueVacancyLoss**********/
		$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
		$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
		$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
		/***************RevenueGrossIncome**********/
		$calculateRentGrossIncomeInc = $calculateRentGrossIncome*$annualRentIncreaseResult;
		
		$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
		$vacancyLoss = round($calculateRentGrossIncome*($vacancyRate/100),0);
		$totalCalculateRevenueGrossIncomeYearsGI = $calculateRentGrossIncome-$vacancyLoss;
		
		$interestRate= $alldataRasult['interestrate'];	
		$mortgageYears= $alldataRasult['mortgageyears'];
		$downPayment = $alldataRasult['downpayment'];	
		$purchasePrice = $alldataRasult['purchaseprice'];

		$mortgageYearsMonths = $mortgageYears*12;

		$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
		
		$PMTFixedMonthlyMultiply = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
		$PMTFixedMonthlyMultiply = $PMTFixedMonthlyMultiply*12;
		if($i==1){
		
		
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOIt = $calculateOperatingNOI-$PMTFixedMonthlyMultiply;
			
			
			
			
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOITT = $calculateOperatingNOI-$calculateTotalPrincipalAmountMainCustom[$i];
	
			
			$Netshell  = $calculateOperatingNOI-$calculateTotalPrincipalAmountMainCustom[$i]-$cashFlowTaxDepreciationYearly-$yearlyInsurance-$calculateOperatingRepairs1Year-$PropertyMgmtFee-$totalCalculateOperatingOtherPercentileCostYearsOPC;
			
			$TaxAbleIncome = $Netshell*$marginaltaxrateResult;
			if($TaxAbleIncome < 0){
				$TaxAbleIncome = 0;
			}
			/* pt($calculateOperatingNOI);
			pt($calculateTotalPrincipalAmountMainCustom[$i]);
			pt($cashFlowTaxDepreciationYearly);
			pt($yearlyInsurance);
			pt($calculateOperatingRepairs1Year);
			pt($PropertyMgmtFee);
			pt($totalCalculateOperatingOtherPercentileCostYearsOPC); */
			$replaceNegativeVal = $calculateOperatingNOIt-$TaxAbleIncome;
			$replaceNegativeValsn = explodeMinusVal(get_val_by_number_format(round($replaceNegativeVal,0),true));
			
			/* After-Tax Cash Flow output for monthly */
			
			if(isset($monthly) && $monthly == 12 && $i == 1){
				
				$replaceNegativeValueResult = get_val_by_number_format(round($replaceNegativeVal/12,0),true);
				$replaceNegativeValueResultVal = explodeMinusVal($replaceNegativeValueResult);
				if(isset($barchart) && $barchart != ''){
					$b = str_replace( ',', '', $replaceNegativeValueResult );

					$year = $xlabel.' : '.$i;
					$value .= '["'.$year.'",'.$b.'],';		
				}else{
				  $value .= "<td class=''>$replaceNegativeValueResultVal</td>";
				}

			}else if(isset($monthly) && $monthly == 'summry'){
				
				$replaceNegativeValueResult = get_val_by_number_format(round($replaceNegativeVal/12,0),true);
				$replaceNegativeValueResultVal = explodeMinusVal($replaceNegativeValueResult);
				if(isset($barchart) && $barchart != ''){
					$b = str_replace( ',', '', $replaceNegativeValueResult );
					$year = $xlabel.' : '.$i;
					$value .= '["'.$year.'",'.$b.'],';	
				}else{
					$value .= $replaceNegativeValue = $replaceNegativeValueResultVal;
				}
			}
			else if(isset($monthly) && $monthly == 'firstyear'){
				
				$replaceNegativeValueResult = get_val_by_number_format(round($replaceNegativeVal,0),true);
				$replaceNegativeValueResultVal = explodeMinusVal($replaceNegativeValueResult);
				if(isset($barchart) && $barchart != ''){
					$b = str_replace( ',', '', $replaceNegativeValueResult );
					$year = $xlabel.' : '.$i;
					$value .= '["'.$year.'",'.$b.'],';	
				}else{
					$value .= $replaceNegativeValue = $replaceNegativeValueResultVal;
				}
			}

			else{
			
				$value .= "<td class='cls'>$replaceNegativeValsn</td>";	
			}
			/* After-Tax Cash Flow output for yearly */
			if(isset($barchart) && $barchart != ''){
				$b = str_replace( ',', '', $replaceNegativeValsn );
				$c = str_replace( '$', '', $b );
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$c.'],';	
			}
			else{
			$value .= "<td class='cls'>$replaceNegativeValsn</td>";	
			}
			
		}else{
			
			/***************OperatingPropertyTaxes**********/
			/* $annualOpratingResult = $annualOpratingExpences/100; */
					/* pt($annualOpratingResult); */
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingResult;
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
		/***************OperatingInsurance**********/
			$yearInsurance = $yearlyInsurance;
			$operatingExpensesIncrease = $annualOpratingExpences++; 
			$operatingExpensesIncreaseAddedtoYear = $yearlyInsurance*$operatingExpensesIncreaseResult;
			
			/* pt($annualOpratingResult); */
			
			$thisYearInsurance =  round($yearInsurance+$operatingExpensesIncreaseAddedtoYear,0);
			
			
			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$operatingExpensesIncreaseResult;
			/* $operatingExpensesIncrease */
		
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			
			/***************OperatingRepairs**********/
			$exOtherResult = $exOther/100;
	
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$exOtherResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			
			/***************OperatingUtilities**********/
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			
			
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			
			/***************OperatingOtherFixedCost**********/
			$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*$annualOpratingResult;
			
			$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
			$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
			
			$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
			
			$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
			$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
			
			/***************OperatingExpensesIncRevenueVacanyCalculations**********/
			$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
			
			$totalSumOfExpenses = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall+$thisYearInsurance;
			
			$totalCalculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$totalSumOfExpenses;
			
			/***************Other Percentile Cost**********/
			
			$calculateRentGrossIncomeInc = $calculateRentGrossIncome*$annualRentIncreaseResult;
			$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
			$OtherPercentileCost = round($totalCalculateRevenueGrossIncomeYears*$annualOpratingResult,0);
			
			$TotalTaxableIncome = $totalCalculateOperatingNOI-$calculateTotalPrincipalAmountMainCustom[$i]-$cashFlowTaxDepreciationYearly-$thisYearInsurance-$totalCalculateOperatingRepairsYears-$totalCalculateOperatingPropertyMgtFeeYearsProperty-$totalCalculateOperatingOtherPercentileCostYearsOPC;
			
		
			/*=======================================================================*/
			
			/***************OperatingPropertyTaxes**********/
			/* $annualOpratingResult = $annualOpratingExpences/100; */
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingResult;
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
			
			/***************OperatingInsurance**********/
			$yearInsurance = $yearlyInsurance;
			$operatingExpensesIncrease = $annualOpratingExpences++; 
			$operatingExpensesIncreaseAddedtoYear = $yearlyInsurance*$operatingExpensesIncreaseResult;
			
			$thisYearInsurance =  round($yearInsurance+$operatingExpensesIncreaseAddedtoYear,0);
			

			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$operatingExpensesIncreaseResult;
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			
			$thisYearInsurance =  round($yearInsurance+$operatingExpensesIncreaseAddedtoYear,0);
			
			/***************OperatingRepairs**********/
			$exOtherResult = $exOther/100;
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$exOtherResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			
			/***************OperatingUtilities**********/
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			
			/***************OperatingOtherFixedCost**********/
			$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*$annualOpratingResult;
			
			$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
			$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
			
			$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
			
			$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
			$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
			/***************OperatingExpensesIncRevenueVacanyCalculations**********/
			$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
			
			$totalCalculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$totalCalculateOperatingTotalExpensesCalculationSum;
			
			$totalCalculateOperatingNOIt = $totalCalculateOperatingNOI-$PMTFixedMonthlyMultiply;
			
			/* 	$totalCalculateRevenueGrossIncomeYearsGI */
			/* PT($totalCalculateRevenueGrossIncomeYearsGI); */
			/* pt(); */
			/* pt($TotalTaxableIncome); */
			
			$TaxAbleIncome = $TotalTaxableIncome*$marginaltaxrateResult;
			
			if($TaxAbleIncome < 0){
				
				$TotalTaxableIncomes = 0;
				
			}else{
				
				$TotalTaxableIncomes = $TaxAbleIncome;
				
			}
			
		/* 	pt($totalCalculateOperatingNOI); */
			$replaceNegativeValueResult = get_val_by_number_format($totalCalculateOperatingNOIt - $TotalTaxableIncomes,true);
			$replaceNegativeValueResultVal = explodeMinusVal($replaceNegativeValueResult);
			
			$replaceNegativeVals = $replaceNegativeValueResultVal;
			if($monthly == 'summry' || $monthly == 'firstyear'){
				$replaceNegativeVals = '';
			}else{
				if(isset($barchart) && $barchart != ''){
					$b = str_replace( ',', '', $replaceNegativeValueResult );
					$year = $xlabel.' : '.$i;
					$value .= '["'.$year.'",'.$b.'],';	
				}else{
					$value .= "<td class=''>$replaceNegativeVals</td>";
				}
			}
		}
	}
return $value;	
}


/* Total Return */
function totalReturn($totalROI,$barchart,$xlabel,$monthly,$oneyear){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	$mortgageYears = $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$buildingValue = $purchasePrice*0.75;
	$amortizationPeriodYears = $alldataRasult['amortizationperiodyears'];
	$cashFlowTaxDepreciationYearly =  round($buildingValue/$amortizationPeriodYears,0); 
	$monthlyRent = $alldataRasult['monthlyrent'];
	$calculateTotalRents = $monthlyRent*12;
	$vacancyRate = $alldataRasult['vacancyrate'];
	$interestRate= $alldataRasult['interestrate'];
	$marginaltaxrate = $alldataRasult['marginaltaxrate'];
	$marginaltaxrateResult = $marginaltaxrate/100;
	$downPayment = $alldataRasult['downpayment'];
	$exHOA = $alldataRasult['exhoa'];
	$exOther = $alldataRasult['exother'];
	$monthlyMortgageDynamic = round($monthlyMortgagePay,2);
	
	/*Annual Rent Increase in % */
	$AnuualRentIncrease = $alldataRasult['annualrentincrease'];
	
	$propertYmGmt = $alldataRasult['expropertymgmt'];
	
	/*Monthly Issurance in $ */
	$monthlyInsurance = $alldataRasult['exinsurance'];
	
	/*Yearly Issurance in $ */
	$yearlyInsurance = $monthlyInsurance*12;
	
	/* Annual Operating Expenses % */
	$annualOpratingExpences = $alldataRasult['annualoprating']; 
	
	$PropertyMgmtFee = $totalPropertyMgmtFee;
	if(empty($PropertyMgmtFee)){
		$PropertyMgmtFee = round($calculateTotalRents*$propertYmGmt/100,0);
	}

	
	$mortgageYearsMonths = $mortgageYears*12;
	$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
	$toalMonthlyEmi = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
	$lamount = $loanAmount;
	
	$lamounts = $loanAmount;
	
	$mi = $interestRate;
	$n = $mortgageYears;

	$ny = $n * 12;
	$mic = $mi /1200;
	
	$mics = $mi /1200;

	$top = pow((1+$mic),$ny);
	$bottom = $top - 1;
	$sp = $top / $bottom;

	$emi = (($lamount * $mic) * $sp);
	$emis = (($lamount * $mic) * $sp);
	$k=0;
	
	$ji = 0;
	$ck=0;
	
	$calculateTotalPrincipalAmountMainResultValResult = array();
	for($i=1;$i<=$mortgageYearsMonths;$i++){
		
		if(!empty($calculateTotalLoanAndInterest)){
			$lamount = $calculateTotalLoanAndInterest-$emi;
		}
		//$lamount = $calculateTotalLoanAndInterest-$emi;
		$interestPaymentMonth = $lamount*$mic;
		if(empty($CaluclatePreviousInterestPaymentMonth)){
		$CaluclatePreviousInterestPaymentMonth ='';
		}
		$CaluclatePreviousInterestPaymentMonth = $interestPaymentMonth+$CaluclatePreviousInterestPaymentMonth;
		$calculateTotalLoanAndInterest = $lamount+$interestPaymentMonth;
		$calculateTotalPrincipalAmount = $emi-$interestPaymentMonth;
		if(empty($calculatePreviousPayment)){
			$calculatePreviousPayment ='';
		}
		$calculatePreviousPayment = $calculateTotalPrincipalAmount+$calculatePreviousPayment;
		$calculateTotalPrincipalAmountMain = round($calculatePreviousPayment,2);
		
		$calculateTotalPrincipalAmountMainResult = get_val_by_number_format($calculateTotalPrincipalAmountMain,true);
		$calculateTotalPrincipalAmountMainResultVal = explodeMinusVal($calculateTotalPrincipalAmountMainResult);
		
		
		$ji++;
		if($ji==12){
		$ji=0;
		$calculateTotalPrincipalAmountMainResultValResult[] = $calculateTotalPrincipalAmountMain;
		$calculatePreviousPayment ='';
		$ck++;
		}
	}
	
	
	/* pt($calculateTotalPrincipalAmountMainResultValResult); */
	
	
	$calculateTotalPrincipalAmountMainCustom = array();
	
	for($ik=1;$ik<=$mortgageYearsMonths;$ik++){
	
		if(!empty($calculateTotalLoanAndInterestp)){
			$lamounts = $calculateTotalLoanAndInterestp-$emis;
		}
		$interestPaymentMonths = $lamounts*$mics;
		if(empty($CaluclatePreviousInterestPaymentMonths)){
			$CaluclatePreviousInterestPaymentMonths ='';
		}
		$CaluclatePreviousInterestPaymentMonths = $interestPaymentMonths+$CaluclatePreviousInterestPaymentMonths;
		$calculateTotalLoanAndInterestp = $lamounts+$interestPaymentMonths;
		$calculateTotalPrincipalAmounts = $emis-$interestPaymentMonths;
		if(empty($calculatePreviousPayments)){
			$calculatePreviousPayments ='';
		}
		$calculatePreviousPayments = $calculateTotalPrincipalAmounts+$calculatePreviousPayments;
		$calculateTotalPrincipalAmountMains = round($CaluclatePreviousInterestPaymentMonths,0);
		
		$k++;
		
		if($k==12){
		
			$k=0;
		
			$calculateTotalPrincipalAmountMainCustom[] = $calculateTotalPrincipalAmountMains;
			array_unshift($calculateTotalPrincipalAmountMainCustom,"");
			unset($calculateTotalPrincipalAmountMainCustom[0]);
		
			$CaluclatePreviousInterestPaymentMonths ='';
		}
	}
	
	
	$monthlyInsurance = $alldataRasult['exinsurance'];	
	$exOtherFixedXost = $alldataRasult['exotherfixed'];
	$exRepairs = $alldataRasult['exrepairs'];
	$exPropertyTaxes = $alldataRasult['expropertytaxes'];
	$annualOpratingResult = $annualOpratingExpences/100;
	$operatingExpensesIncreaseResult = $operatingExpensesIncrease/100;
	$TotalReturnMonthlyVal = array();
	$totalROImonthlyVal = array();
	for($i=1;$i<=$mortgageYears;$i++){
		$downPayment = $alldataRasult['downpayment'];
		$purchasePrice = $alldataRasult['purchaseprice'];	
		$upfrontImprovement = $alldataRasult['upfrontimprovement'];
		$closingCost = $alldataRasult['closingcost'];
		$closingCostMain = $closingCost/100*$purchasePrice;
		$DownpaymentValue = $downPayment/100*$purchasePrice;
		
		$cashOutlay = $DownpaymentValue+$upfrontImprovement+$closingCostMain;
		$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
		$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
		$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		$calculateOperatingPropertyMgtFee = $totalCalculateOperatingPropertyMgtFeeYears;
		$calculateOperatingHOA = $totalCalculateOperatingHOAYears;
		$calculateOperatingOtherPercentileCost = $totalCalculateOperatingOtherPercentileCostYears;
		$calculateOperatingOtherFixedCost = $totalCalculateOperatingFixedCostYears;
		$calculateRevenueVacancyLoss = $totalCalculateRevenueVacanyLossYears;
		$calculateRevenueRentalIncome = $totalCalculateRevenueRentalIncomeYears;
		$calculateRentGrossIncome = $totalCalculateRevenueGrossIncomeYears;

		if(empty($calculateOperatingPropertyTaxes1Year)){
			$exPropertyTaxesResult = $exPropertyTaxes/100;
			$calculateOperatingPropertyTaxes1Year = round($exPropertyTaxesResult*$purchasePrice,0);
		}
		if(empty($calculateOperatingInsurance1Year)){
			$calculateOperatingInsurance1Year = round($monthlyInsurance*12,0);
		}
		if(empty($calculateOperatingRepairs1Year)){
			$exRepairsResult = $exRepairs/100;
			$calculateOperatingRepairs1Year = round($exRepairsResult*$calculateTotalRents,0);
		}
		if(empty($calculateOperatingUtilities1Year)){
			$exUtilitiesResult = $exUtilities * 12;
			$calculateOperatingUtilities1Year = round($exUtilitiesResult,2);
		}
		if(empty($calculateOperatingPropertyMgtFee)){
			$calculateOperatingPropertyMgtFee = round($monthlyRent*12,0);			
			$exPropertymgmtResult = $propertYmGmt/100;
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		}
		if(empty($calculateOperatingHOA)){
			$exHOAResult = $exHOA*12; 
			$calculateOperatingHOA = round($exHOAResult,0);
			$exPropertymgmtResult = $propertYmGmt/100;
			
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingHOA,0);
		}
		
		if(empty($calculateOperatingOtherPercentileCost)){
			$calculateOperatingOtherPercentileCost = round($monthlyRent*12,0);
			$exOtherResult = $exOther/100;
			$otherPercentile1stYear = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		}
		if(empty($calculateOperatingOtherFixedCost)){
			$exOtherFixedXostResult = $exOtherFixedXost*12;
		/* 	pt($exOtherFixedXostResult); */
			$calculateOperatingOtherFixedCost = round($exOtherFixedXostResult,2);
		}
		if(empty($calculateRevenueVacancyLoss)){
			$calculateRevenueVacancyLoss = round($monthlyRent*12,0);
		}
		if(empty($calculateRevenueRentalIncome)){
			$calculateRevenueRentalIncome = round($monthlyRent*12,0);
		}
		if(empty($calculateRentGrossIncome)){
			$calculateRentGrossIncome = round($monthlyRent*12,0);
		}
		
		/***************OperatingProprtyMgtFees**********/
		$annualRentIncreaseResult = $AnuualRentIncrease/100;
	
	
		$calculateOperatingPropertyMgtFeeInc = $calculateOperatingPropertyMgtFee*$annualRentIncreaseResult;
		
		$exPropertymgmtResult = $propertYmGmt/100;
	
		$totalCalculateOperatingPropertyMgtFeeYears = round($calculateOperatingPropertyMgtFee+$calculateOperatingPropertyMgtFeeInc,0);
		$totalCalculateOperatingPropertyMgtFeeYearsProperty = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		
		/***************OperatingHOA**********/
		
		/* pt($annualOpratingResult); */
		$calculateOperatingHOAInc = $calculateOperatingHOA*$annualOpratingResult;
		$totalCalculateOperatingHOAYears = round($calculateOperatingHOA+$calculateOperatingHOAInc,0);
		$totalCalculateOperatingHOAYearsHOA = round($calculateOperatingHOA,0);
		
		
		/***************OperatingOtherPercentileCost**********/
		$exOtherResult = $exOther/100;
		$calculateOperatingOtherPercentileCostInc = $calculateOperatingOtherPercentileCost*$annualRentIncreaseResult;
			
		$totalCalculateOperatingOtherPercentileCostYears = round($calculateOperatingOtherPercentileCost+$calculateOperatingOtherPercentileCostInc,0);
	
		$totalCalculateOperatingOtherPercentileCostYearsOPC = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		
		/***************RevenueVacancyLoss**********/
		$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
		$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
		$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
		/***************RevenueGrossIncome**********/
		$calculateRentGrossIncomeInc = $calculateRentGrossIncome*$annualRentIncreaseResult;
		
		$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
		$vacancyLoss = round($calculateRentGrossIncome*($vacancyRate/100),0);
		$totalCalculateRevenueGrossIncomeYearsGI = $calculateRentGrossIncome-$vacancyLoss;
		
		$interestRate= $alldataRasult['interestrate'];	
		$mortgageYears= $alldataRasult['mortgageyears'];
		$downPayment = $alldataRasult['downpayment'];	
		$purchasePrice = $alldataRasult['purchaseprice'];

		$mortgageYearsMonths = $mortgageYears*12;

		$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
		
		$PMTFixedMonthlyMultiply = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
		$PMTFixedMonthlyMultiply = $PMTFixedMonthlyMultiply*12;
		if($i==1){
		
		
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOIt = $calculateOperatingNOI-$PMTFixedMonthlyMultiply;
			
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
			
			$calculateOperatingNOITT = $calculateOperatingNOI-$calculateTotalPrincipalAmountMainCustom[$i];
	
			
			$Netshell  = $calculateOperatingNOI-$calculateTotalPrincipalAmountMainCustom[$i]-$cashFlowTaxDepreciationYearly-$yearlyInsurance-$calculateOperatingRepairs1Year-$PropertyMgmtFee-$totalCalculateOperatingOtherPercentileCostYearsOPC;
			
			$TaxAbleIncome = $Netshell*$marginaltaxrateResult;
			if($TaxAbleIncome < 0){
				$TaxAbleIncome = 0;
			}
			
			$replaceNegativeVal = $calculateOperatingNOIt-$TaxAbleIncome+$calculateTotalPrincipalAmountMainResultValResult[$i-1];
			$replaceNegativeValsn = explodeMinusVal(get_val_by_number_format(round($replaceNegativeVal,0),true));
			
			/* After-Tax Cash Flow output for monthly */
			
			if(isset($totalROI) && $totalROI == 'totalROI' ){
				
				$totalROIresult = $replaceNegativeVal/$cashOutlay;
				
				$replaceNegativeValResult = round($totalROIresult*100,2);
				$totalROImonthlyVal[] = $replaceNegativeValResult;
				
				$replaceNegativeVal =  "<td class=''>$replaceNegativeValResult%</td>";
				
			}else if(isset($totalROI) && $totalROI == 'summry' ){
				
				$totalROIresult = $replaceNegativeVal/$cashOutlay;
				$replaceNegativeValResult = round($totalROIresult*100,2);
				$replaceNegativeVal =  $replaceNegativeValResult.'%';
				
			}else if(isset($oneyear) && $oneyear == 'oneyear'){
				$replaceNegativeValResult = get_val_by_number_format($replaceNegativeVal,true);
				$TotalReturnMonthlyVal[] = $replaceNegativeVal;
				$yearone =  explodeMinusVal($replaceNegativeValResult);
			}else{
				
				$replaceNegativeValResult = get_val_by_number_format($replaceNegativeVal,true);
				$TotalReturnMonthlyVal[] = $replaceNegativeVal;
				$replaceNegativeVal =  "<td class=''>".explodeMinusVal($replaceNegativeValResult)."</td>";
				
			}
			
			if(isset($barchart) && $barchart != ''){
				$b = str_replace( ',', '', $replaceNegativeValResult );
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$b.'],';		
			}else{
			  $value .= $replaceNegativeVal;
			}
			
			
		}else{
			
			/***************OperatingPropertyTaxes**********/
			/* $annualOpratingResult = $annualOpratingExpences/100; */
					/* pt($annualOpratingResult); */
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingResult;
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
		/***************OperatingInsurance**********/
			$yearInsurance = $yearlyInsurance;
			$operatingExpensesIncrease = $annualOpratingExpences++; 
			$operatingExpensesIncreaseAddedtoYear = $yearlyInsurance*$operatingExpensesIncreaseResult;
			
			/* pt($annualOpratingResult); */
			
			$thisYearInsurance =  round($yearInsurance+$operatingExpensesIncreaseAddedtoYear,0);
			
			
			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$operatingExpensesIncreaseResult;
			/* $operatingExpensesIncrease */
		
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			
			/***************OperatingRepairs**********/
			$exOtherResult = $exOther/100;
	
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$exOtherResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			
			/***************OperatingUtilities**********/
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			
			
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			
			/***************OperatingOtherFixedCost**********/
			$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*$annualOpratingResult;
			
			$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
			$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
			
			$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
			
			$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
			$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
			
			/***************OperatingExpensesIncRevenueVacanyCalculations**********/
			$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
			
			$totalSumOfExpenses = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall+$thisYearInsurance;
			
			$totalCalculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$totalSumOfExpenses;
			
			/***************Other Percentile Cost**********/
			
			$calculateRentGrossIncomeInc = $calculateRentGrossIncome*$annualRentIncreaseResult;
			$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
			$OtherPercentileCost = round($totalCalculateRevenueGrossIncomeYears*$annualOpratingResult,0);
			
			
			
			$TotalTaxableIncome = $totalCalculateOperatingNOI-$calculateTotalPrincipalAmountMainCustom[$i]-$cashFlowTaxDepreciationYearly-$thisYearInsurance-$totalCalculateOperatingRepairsYears-$totalCalculateOperatingPropertyMgtFeeYearsProperty-$totalCalculateOperatingOtherPercentileCostYearsOPC;
			
		/* 	pt($calculateTotalPrincipalAmountMainCustom[$i]); */
			/*=======================================================================*/
			
			/***************OperatingPropertyTaxes**********/
			/* $annualOpratingResult = $annualOpratingExpences/100; */
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingResult;
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
			
			/***************OperatingInsurance**********/
			$yearInsurance = $yearlyInsurance;
			$operatingExpensesIncrease = $annualOpratingExpences++; 
			$operatingExpensesIncreaseAddedtoYear = $yearlyInsurance*$operatingExpensesIncreaseResult;
			
			$thisYearInsurance =  round($yearInsurance+$operatingExpensesIncreaseAddedtoYear,0);
			

			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$operatingExpensesIncreaseResult;
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			
			$thisYearInsurance =  round($yearInsurance+$operatingExpensesIncreaseAddedtoYear,0);
			
			/***************OperatingRepairs**********/
			$exOtherResult = $exOther/100;
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$exOtherResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			
			/***************OperatingUtilities**********/
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			
			/***************OperatingOtherFixedCost**********/
			$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*$annualOpratingResult;
			
			$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
			$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
			
			$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
			
			$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
			$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
			/***************OperatingExpensesIncRevenueVacanyCalculations**********/
			$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
			
			$totalCalculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$totalCalculateOperatingTotalExpensesCalculationSum;
			
			$totalCalculateOperatingNOIt = $totalCalculateOperatingNOI-$PMTFixedMonthlyMultiply;
			
			/* 	$totalCalculateRevenueGrossIncomeYearsGI */
			/* PT($totalCalculateRevenueGrossIncomeYearsGI); */
			/* pt(); */
			/* pt($TotalTaxableIncome); */
			
			$TaxAbleIncome = $TotalTaxableIncome*$marginaltaxrateResult;
			
			
			if($TaxAbleIncome < 0){
				
				$TotalTaxableIncomes = 0;
				
			}else{
				
				$TotalTaxableIncomes = $TaxAbleIncome;
				
			}
			
			
			$replaceNegativeValueResults = $totalCalculateOperatingNOIt - $TotalTaxableIncomes+$calculateTotalPrincipalAmountMainResultValResult[$i-1];
			
			$replaceNegativeValueResult = get_val_by_number_format($totalCalculateOperatingNOIt - $TotalTaxableIncomes+$calculateTotalPrincipalAmountMainResultValResult[$i-1],true);
			$replaceNegativeValueResultVal = explodeMinusVal($replaceNegativeValueResult);
			
			$replaceNegativeVals = $replaceNegativeValueResultVal;
			
			if(isset($totalROI) && $totalROI == 'totalROI' ){
				
				$totalROIresult = $replaceNegativeValueResults/$cashOutlay;
				
				$replaceNegativeValResult = round($totalROIresult*100,2);
				
				$replaceNegativeVal =   "<td class=''>".$replaceNegativeValResult."%</td>";
				

			}else if(isset($totalROI) && $totalROI == 'summry' ){
				
				$replaceNegativeVal = '';
				
			}else{
				
				$replaceNegativeValResult = get_val_by_number_format($replaceNegativeValueResults,true);
				$replaceNegativeVal =  "<td class=''>".explodeMinusVal($replaceNegativeValResult)."</td>";
				
			}
			if(isset($barchart) && $barchart != ''){
				$b = str_replace( ',', '', $replaceNegativeValueResults );
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$b.'],';		
			}else{
			  $value .= $replaceNegativeVal;
			}
		}
	}
	
	if(isset($monthly) && $monthly == 'monthly'){
		$monthlyValResult = $TotalReturnMonthlyVal[0]/12;
		$monthlyResultVal = $monthlyValResult;
		$FinalMonthlyResultVal = '$'.round($monthlyResultVal,2);
		$value = $FinalMonthlyResultVal;
	}
	
	if($totalROI == 'totalROI' && $monthly == 'monthly'){
		$monthlyValResultTotalROI = $totalROImonthlyVal[0]/12;
		$monthlyResultTotalROIVal = $monthlyValResultTotalROI;
		$FinalMonthlyResultTotalROIVal = number_format($monthlyResultTotalROIVal, 2, '.', '').'%';
		$value = $FinalMonthlyResultTotalROIVal;
	}
	
	if(isset($oneyear) && $oneyear == 'oneyear'){
		return $yearone;
	}else{
		return $value;		
	}
}
											
function cashFlowDepreciationYearlyCalculations($barchart,$xlabel){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
							
	$purchasePrice = $alldataRasult['purchaseprice'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$buildingValue = $purchasePrice*0.75;
	$amortizationPeriodYears = $alldataRasult['amortizationperiodyears'];
	$cashFlowTaxDepreciationYearly =  round($buildingValue/$amortizationPeriodYears,0); 
	for($i=1;$i<=$mortgageYears;$i++){	
		$cashFlowTaxDepreciationYearlyResult = get_val_by_number_format($cashFlowTaxDepreciationYearly,true);
		$cashFlowTaxDepreciationYearlyResultVal = explodeMinusVal($cashFlowTaxDepreciationYearlyResult);	
		if(isset($barchart) && $barchart != ''){
			$b = str_replace( ',', '', $cashFlowTaxDepreciationYearlyResult );
			$year = $xlabel.' : '.$i;
			$value .= '["'.$year.'",'.$b.'],';		
		}else{
		  $value .= "<td class='dep_First_$i'>$cashFlowTaxDepreciationYearlyResultVal</td>";
		}
	}
	return $value;
}
						
function cashFlowMortgageRatio($barchart,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	$interestRate= $alldataRasult['interestrate'];
	$downPayment = $alldataRasult['downpayment'];
	
	$mortgageYears = $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$exPropertyTaxes = $alldataRasult['expropertytaxes'];
	$monthlyRent = $alldataRasult['monthlyrent'];
	$calculateTotalRents = $monthlyRent*12;
	$vacancyRate = $alldataRasult['vacancyrate'];
	$exRepairs = $alldataRasult['exrepairs'];
	$exUtilities = $alldataRasult['exutilities'];
	$exHOA = $alldataRasult['exhoa'];
	$exOther = $alldataRasult['exother'];
	$exOtherFixedXost = $alldataRasult['exotherfixed'];
	
	$marginalTaxRate = $alldataRasult['marginaltaxrate'];
	
	$mortgageYearsMonths = $mortgageYears*12;
	$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
	$divideMortgage = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
	$divideMortgageYearly = round($divideMortgage*12,0);
	
	/*Annual Rent Increase in % */
	$AnuualRentIncrease = $alldataRasult['annualrentincrease'];
	
	$propertYmGmt = $alldataRasult['expropertymgmt'];
	
	/*Monthly Issurance in $ */
	$monthlyInsurance = $alldataRasult['exinsurance'];
	
	/*Yearly Issurance in $ */
	$yearlyInsurance = $monthlyInsurance*12;
	
	/* Annual Operating Expenses % */
	$annualOpratingExpences = $alldataRasult['annualoprating']; 
	
	$PropertyMgmtFee = $totalPropertyMgmtFee;
	$operatingExpensesIncreaseResult = $operatingExpensesIncrease/100;
	$annualOpratingResult = $annualOpratingExpences/100;
	$monthlyVal = array();
	for($i=1;$i<=$mortgageYears;$i++){
		$calculateOperatingPropertyTaxes1Year = $totalCalculateOperatingPropertyTaxesYears;
		$calculateOperatingInsurance1Year = $totalCalculateOperatingInsuranceYears;
		$calculateOperatingRepairs1Year = $totalCalculateOperatingRepairsYears;
		$calculateOperatingUtilities1Year = $totalCalculateOperatingUtilitiesYears;
		$calculateOperatingPropertyMgtFee = $totalCalculateOperatingPropertyMgtFeeYears;
		$calculateOperatingHOA = $totalCalculateOperatingHOAYears;
		$calculateOperatingOtherPercentileCost = $totalCalculateOperatingOtherPercentileCostYears;
		$calculateOperatingOtherFixedCost = $totalCalculateOperatingFixedCostYears;
		$calculateRevenueVacancyLoss = $totalCalculateRevenueVacanyLossYears;
		$calculateRevenueRentalIncome = $totalCalculateRevenueRentalIncomeYears;
		$calculateRentGrossIncome = $totalCalculateRevenueGrossIncomeYears;

		
		if(empty($calculateOperatingPropertyTaxes1Year)){
			$exPropertyTaxesResult = $exPropertyTaxes/100;
			$calculateOperatingPropertyTaxes1Year = round($exPropertyTaxesResult*$purchasePrice,0);
		}
		if(empty($calculateOperatingInsurance1Year)){
			$calculateOperatingInsurance1Year = round($monthlyInsurance*12,0);
		}
		if(empty($calculateOperatingRepairs1Year)){
			$exRepairsResult = $exRepairs/100;
			$calculateOperatingRepairs1Year = round($exRepairsResult*$calculateTotalRents,0);
		}
		if(empty($calculateOperatingUtilities1Year)){
			$exUtilitiesResult = $exUtilities * 12;
			$calculateOperatingUtilities1Year = round($exUtilitiesResult,2);
		}
		if(empty($calculateOperatingPropertyMgtFee)){
			$calculateOperatingPropertyMgtFee = round($monthlyRent*12,0);			
			$exPropertymgmtResult = $propertYmGmt/100;
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		}
		
		if(empty($calculateOperatingHOA)){
			$exHOAResult = $exHOA*12; 
			$calculateOperatingHOA = round($exHOAResult,0);
			$exPropertymgmtResult = $propertYmGmt/100;
			$propertyMgtFee1stYear = round($exPropertymgmtResult*$calculateOperatingHOA,0);
		}
		if(empty($calculateOperatingOtherPercentileCost)){
			$calculateOperatingOtherPercentileCost = round($monthlyRent*12,0);
			$exOtherResult = $exOther/100;
			$otherPercentile1stYear = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		}
		if(empty($calculateOperatingOtherFixedCost)){
			$exOtherFixedXostResult = $exOtherFixedXost*12;
			$calculateOperatingOtherFixedCost = round($exOtherFixedXostResult,2);
		}
		if(empty($calculateRevenueVacancyLoss)){
			$calculateRevenueVacancyLoss = round($monthlyRent*12,0);
		}
		if(empty($calculateRevenueRentalIncome)){
			$calculateRevenueRentalIncome = round($monthlyRent*12,0);
		}
		if(empty($calculateRentGrossIncome)){
			$calculateRentGrossIncome = round($monthlyRent*12,0);
		}
		
		/***************OperatingProprtyMgtFees**********/
		$annualRentIncreaseResult = $AnuualRentIncrease/100;
		$calculateOperatingPropertyMgtFeeInc = $calculateOperatingPropertyMgtFee*$annualRentIncreaseResult;
		
		$exPropertymgmtResult = $propertYmGmt/100;
		$totalCalculateOperatingPropertyMgtFeeYears = round($calculateOperatingPropertyMgtFee+$calculateOperatingPropertyMgtFeeInc,0);
		$totalCalculateOperatingPropertyMgtFeeYearsProperty = round($exPropertymgmtResult*$calculateOperatingPropertyMgtFee,0);
		
		/***************OperatingHOA**********/
		$calculateOperatingHOAInc = $calculateOperatingHOA*$annualOpratingResult;
		$totalCalculateOperatingHOAYears = round($calculateOperatingHOA+$calculateOperatingHOAInc,0);
		$totalCalculateOperatingHOAYearsHOA = round($calculateOperatingHOA,0);
		
		/***************OperatingOtherPercentileCost**********/
		$exOtherResult = $exOther/100;
		$calculateOperatingOtherPercentileCostInc = $calculateOperatingOtherPercentileCost*$annualRentIncreaseResult;
			
		$totalCalculateOperatingOtherPercentileCostYears = round($calculateOperatingOtherPercentileCost+$calculateOperatingOtherPercentileCostInc,0);
	
		$totalCalculateOperatingOtherPercentileCostYearsOPC = round($exOtherResult*$calculateOperatingOtherPercentileCost,0);
		
		/***************RevenueVacancyLoss**********/
			/* pt($annualOpratingResult); */
		$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
		$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
		$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
		
		/***************RevenueGrossIncome**********/
		$calculateRentGrossIncomeInc = $calculateRentGrossIncome*$annualRentIncreaseResult;
		$totalCalculateRevenueGrossIncomeYears = round($calculateRentGrossIncome+$calculateRentGrossIncomeInc,0);
		$vacancyLoss = round($calculateRentGrossIncome*($vacancyRate/100),0);
		$totalCalculateRevenueGrossIncomeYearsGI = $calculateRentGrossIncome-$vacancyLoss;
									
		if($i==1){
			$calculateOperatingTotalExpensesCalculationSum = $calculateOperatingPropertyTaxes1Year+$calculateOperatingInsurance1Year+$calculateOperatingRepairs1Year+$calculateOperatingUtilities1Year+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$calculateOperatingOtherFixedCost;
			
			$calculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$calculateOperatingTotalExpensesCalculationSum;
		
			$calculateCashFlowMortgageRatioReusltVal = round(($calculateOperatingNOI/$divideMortgageYearly)*100,0);
			if(isset($barchart) && $barchart=='barchart'){
				$year = $xlabel.' : '.$i;

				$value .= $BarchartTocalculateCashFlowMortgageRatio = '["'.$year.'",'.$calculateRentAppreciationsBarchart.'],';		
			}else{
				$monthlyVal[] = $calculateCashFlowMortgageRatioReusltVal;
				$calculateCashFlowMortgageRatio = $calculateCashFlowMortgageRatioReusltVal;
				$value .= "<td>$calculateCashFlowMortgageRatio%</td>";	
			}
		} else{
			/***************OperatingPropertyTaxes**********/
			
			/* $annualOpratingResult = $annualOpratingExpences/100; */
			$calculateOperatingPropertyTaxes1YearInc = $calculateOperatingPropertyTaxes1Year*$annualOpratingResult;
			$totalCalculateOperatingPropertyTaxesYears = round($calculateOperatingPropertyTaxes1Year+$calculateOperatingPropertyTaxes1YearInc,0);
			
			/***************OperatingInsurance**********/
			$yearInsurance = $yearlyInsurance;
			$operatingExpensesIncrease = $annualOpratingExpences++; 
			$operatingExpensesIncreaseAddedtoYear = $yearlyInsurance*$operatingExpensesIncrease/100;
			
			$thisYearInsurance =  round($yearInsurance+$operatingExpensesIncreaseAddedtoYear,0);
			

			$calculateOperatingInsurance1YearInc = $calculateOperatingInsurance1Year*$operatingExpensesIncreaseResult;
			$totalCalculateOperatingInsuranceYears = round($calculateOperatingInsurance1Year+$calculateOperatingInsurance1YearInc,0);
			
			/* pt($calculateOperatingInsurance1YearInc); */
			
			/***************OperatingRepairs**********/
			$exOtherResult = $exOther/100;
			$calculateOperatingRepairs1YearInc = $calculateOperatingRepairs1Year*$exOtherResult;
			$totalCalculateOperatingRepairsYears = round($calculateOperatingRepairs1Year+$calculateOperatingRepairs1YearInc,0);
			
			/***************OperatingUtilities**********/
			$calculateOperatingUtilities1YearInc = $calculateOperatingUtilities1Year*$annualOpratingResult;
			
			$totalCalculateOperatingUtilitiesYears = round($calculateOperatingUtilities1Year+$calculateOperatingUtilities1YearInc,2);
			$totalCalculateOperatingUtilitiesYearsCall = round($totalCalculateOperatingUtilitiesYears,0);
			
			/***************OperatingOtherFixedCost**********/
			$calculateOperatingOtherFixedCostInc = $calculateOperatingOtherFixedCost*$annualOpratingResult;
			
			$totalCalculateOperatingFixedCostYears = round($calculateOperatingOtherFixedCost+$calculateOperatingOtherFixedCostInc,2);
			$totalCalculateOperatingFixedCostYearsCall = round($totalCalculateOperatingFixedCostYears,0);
			
			$calculateRevenueVacancyLossInc = $calculateRevenueVacancyLoss*$annualRentIncreaseResult;
			
			$totalCalculateRevenueVacanyLossYears = round($calculateRevenueVacancyLoss+$calculateRevenueVacancyLossInc,0);
			$totalCalculateRevenueVacanyLossYearsCall = round($calculateRevenueVacancyLoss*($vacancyRate/100),0);
			
			/***************OperatingExpensesIncRevenueVacanyCalculations**********/
			$totalCalculateOperatingTotalExpensesCalculationSum = $totalCalculateOperatingPropertyTaxesYears+$totalCalculateOperatingInsuranceYears+$totalCalculateOperatingRepairsYears+$totalCalculateOperatingUtilitiesYearsCall+$totalCalculateOperatingPropertyMgtFeeYearsProperty+$totalCalculateOperatingHOAYearsHOA+$totalCalculateOperatingOtherPercentileCostYearsOPC+$totalCalculateOperatingFixedCostYearsCall;
			
			$totalCalculateOperatingNOI = $totalCalculateRevenueGrossIncomeYearsGI-$totalCalculateOperatingTotalExpensesCalculationSum;
			
			$calculateCashFlowMortgageRatioReusltVal = round(($totalCalculateOperatingNOI/$divideMortgageYearly)*100,0);
			if(isset($barchart) && $barchart=='barchart'){
				
				$year = $xlabel.' : '.$i;
				$value .= $BarchartTocalculateCashFlowMortgageRatio = '["'.$year.'",'.$calculateCashFlowMortgageRatioReusltVal.'],';		
				
			}else{
				
				$totalCalculateCashFlowMortgageRatio = $calculateCashFlowMortgageRatioReusltVal;
				$value .= "<td>$totalCalculateCashFlowMortgageRatio%</td>";	
			}
		}
	}
	if(isset($monthly) && $monthly == 'monthly'){
		/* pt($monthlyVal); */
		$resultmonthlyVal = $monthlyVal[0]/12;	
		return number_format($resultmonthlyVal, 2, '.', '').'%';		
	}else{
		return $value;		
	}
}	
						
function sellSellingPrice($barchart,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	// GEt appreciation value as well
	$purchasePrice = $alldataRasult['purchaseprice'];
	$mortgageYears = $alldataRasult['mortgageyears'];	
	$monthlyVal = array();
	for($i=1;$i<=$mortgageYears;$i++){
		
		if($i==1){
			
			$purchasePriceVal = get_val_by_number_format($purchasePrice,true);
			$purchasePriceValResult = explodeMinusVal($purchasePriceVal);
			if(isset($barchart) && $barchart != ''){
				$b = str_replace(',', '', $purchasePriceVal);
				/* $value .= '['.$i.','.$b.'],'; */
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$b.'],';		
			}else{
				$monthlyVal[] = $purchasePrice;
				$value .= "<td>$purchasePriceValResult</td>";
			}
			
		}else {
			
			$purchasePrice = $purchasePrice+(($purchasePrice*3)/100);
			$purchasePrice = round($purchasePrice,0);
			
			$purchasePriceVal = get_val_by_number_format($purchasePrice,true);
			$purchasePriceValResult = explodeMinusVal($purchasePriceVal);
			if(isset($barchart) && $barchart != ''){
			  $b = str_replace(',', '', $purchasePriceVal);
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$b.'],';	
			}else{
			   $value .= "<td>$purchasePriceValResult</td>";
			}
		}
	}	
	if(isset($monthly) && $monthly == 'monthly'){
		$resultmonthlyVal = $monthlyVal[0]/12;	
		$finalResult = explodeMinusVal(get_val_by_number_format($resultmonthlyVal,true));
		return $finalResult;
	}else{
		return $value;		
	}					
}
						
function sellExpenseOfSell($barchart,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
							
	// GEt appreciation value as well
	// selling transaction cost get as well
	$purchasePrice = $alldataRasult['purchaseprice'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$sellTransactioncost = $alldataRasult['selltransactioncost'];
	$monthlyVal = array();	
	for($i=1;$i<=$mortgageYears;$i++){
		if($i==1){
			$calculateExpenseOfSell = round(($sellTransactioncost*$purchasePrice)/100,0);
			$calculateExpenseOfSellVal = get_val_by_number_format($calculateExpenseOfSell,true);
			$calculateExpenseOfSellValResult = explodeMinusVal($calculateExpenseOfSellVal);
			if(isset($barchart) && $barchart != ''){
				$b = str_replace(',','',$calculateExpenseOfSellVal);
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$b.'],';		
			}else{
				$monthlyVal[] = $calculateExpenseOfSell;
				$value .= "<td>$calculateExpenseOfSellValResult</td>";
			}
		}
		else {
			$purchasePrice = $purchasePrice+(($purchasePrice*3)/100);
			$purchasePrice = round($purchasePrice,0);
			$totalCalculateExpenseOfSell = round(($sellTransactioncost*$purchasePrice)/100,0);
			$calculateExpenseOfSellVal = get_val_by_number_format($totalCalculateExpenseOfSell,true);
			$calculateExpenseOfSellValResult = explodeMinusVal($calculateExpenseOfSellVal);
			if(isset($barchart) && $barchart != ''){
			 $b = str_replace(',','',$calculateExpenseOfSellVal);
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$b.'],';	
			}else{
				$value .= "<td>$calculateExpenseOfSellValResult</td>";
			}
		}
		
	}	
	if(isset($monthly) && $monthly == 'monthly'){
		$resultmonthlyVal = $monthlyVal[0]/12;	
		$finalResult = explodeMinusVal(get_val_by_number_format($resultmonthlyVal,true));
		return $finalResult;
	}else{
		return $value;		
	}				
}
						
function sellGrossProceeds($barchart,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	// GEt appreciation value as well
	// selling transaction cost get as well
	$purchasePrice = $alldataRasult['purchaseprice'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$sellTransactioncost = $alldataRasult['selltransactioncost'];	
	$annualAppreciation = $alldataRasult['annualappreciation'];	
	$monthlyVal = array();	
	for($i=1;$i<=$mortgageYears;$i++){
		if($i==1){
			$calculateExpenseOfSell = round(($sellTransactioncost*$purchasePrice)/100,0);
			$calculateGrossProceeds = $purchasePrice-$calculateExpenseOfSell;
			$calculateGrossProceedsVal = get_val_by_number_format($calculateGrossProceeds,true);
			$calculateGrossProceedsValResult = explodeMinusVal($calculateGrossProceedsVal);
			if(isset($barchart) && $barchart != ''){
				$b = str_replace(',', '' , $calculateGrossProceedsVal);
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$b.'],';		
			}else{
				$monthlyVal[] = $calculateGrossProceeds;
				$value .= "<td>$calculateGrossProceedsValResult</td>";	
			}
		}
		else {
			$purchasePrice = $purchasePrice+(($purchasePrice*$annualAppreciation)/100);
			$purchasePrice = round($purchasePrice,0);
			$totalCalculateExpenseOfSell = round(($sellTransactioncost*$purchasePrice)/100,0);
			$totalCalculateGrossProceeds = $purchasePrice-$totalCalculateExpenseOfSell;
			$totalCalculateGrossProceedsVal = get_val_by_number_format($totalCalculateGrossProceeds,true);
			$totalCalculateGrossProceedsValResult = explodeMinusVal($totalCalculateGrossProceedsVal);
			if(isset($barchart) && $barchart != ''){
				$b = str_replace(',', '' , $totalCalculateGrossProceedsVal);
				/* $value .= '['.$i.','.$b.'],'; */
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$b.'],';		
			}else{
			  $value .= "<td>$totalCalculateGrossProceedsValResult</td>";	
			}
		}
		
	}	
	if(isset($monthly) && $monthly == 'monthly'){
		$resultmonthlyVal = $monthlyVal[0]/12;	
		$finalResult = explodeMinusVal(get_val_by_number_format($resultmonthlyVal,true));
		return $finalResult;
	}else{
		return $value;		
	}						
}
						
function cashAtClose($data,$barchart,$Year,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$purchasePrice = $alldataRasult['purchaseprice'];
	$interestRate= $alldataRasult['interestrate'];
	$closingCost = $alldataRasult['closingcost'];
	$upfrontImprovementData = $alldataRasult['upfrontimprovement']/100;
	$upfrontImprovement = $purchasePrice*$upfrontImprovementData;
	$sellStateTax = $alldataRasult['sellstatetax'];
	$sellCapitalGain = $alldataRasult['sellcapitalgain'];
	$downPayment = $alldataRasult['downpayment'];
	$closingCostMain = $closingCost/100*$purchasePrice;
	$purchaseClosingCost = $upfrontImprovement+$closingCostMain;
	$initialTaxBasis = $purchasePrice+$closingCostMain;
	$buildingValue = $purchasePrice*0.75;
	$amortizationPeriodYears = $alldataRasult['amortizationperiodyears'];
	$sellTransactioncost = $alldataRasult['selltransactioncost'];	
	$annualAppreciation = $alldataRasult['annualappreciation'];	
	$sellDepreciationRecap = $alldataRasult['selldepreciationrecap'];	
	$cashFlowTaxDepreciationYearly =  round($buildingValue/$amortizationPeriodYears,0); 
	$totalCashFlowTaxDepreciationYearly = $cashFlowTaxDepreciationYearly;
	
	$mortgageYearsMonths = $mortgageYears*12;
	$loanAmount = $purchasePrice-($purchasePrice*$downPayment/100);
	$toalMonthlyEmi = pmt($interestRate, $mortgageYearsMonths, $loanAmount);
	
	$DownpaymentValue = $downPayment/100*$purchasePrice;
	
	/*Cash Outlay*/
	$cashOutlay = $DownpaymentValue+$upfrontImprovement+$closingCostMain;
		
	$lamount = $loanAmount;
	$mi = $interestRate;
	$n = $mortgageYears;

	$ny = $n * 12;
	$mic = $mi /1200;

	$top = pow((1+$mic),$ny);
	$bottom = $top - 1;
	$sp = $top / $bottom;

	$emi = (($lamount * $mic) * $sp);
	$k=0;

	$calculateTotalPrincipalAmountMain = array();
	for($i=1;$i<=$mortgageYearsMonths;$i++){
		
		if(!empty($calculateTotalLoanAndInterest)){
			$lamount = $calculateTotalLoanAndInterest-$emi;
		}
		$interestPaymentMonth = $lamount*$mic;
		if(empty($CaluclatePreviousInterestPaymentMonth)){
		$CaluclatePreviousInterestPaymentMonth ='';
		}
		$CaluclatePreviousInterestPaymentMonth = $interestPaymentMonth+$CaluclatePreviousInterestPaymentMonth;
		$calculateTotalLoanAndInterest = $lamount+$interestPaymentMonth;
		$calculateTotalPrincipalAmount = $emi-$interestPaymentMonth;
		if(empty($calculatePreviousPayment)){
			$calculatePreviousPayment ='';
		}
		$calculatePreviousPayment = $calculateTotalPrincipalAmount+$calculatePreviousPayment;
		$calculateTotalPrincipalAmountMain = round($calculatePreviousPayment,2);
		$k++;
		if($k==12){
			$k=0;
			$calculateTotalPrincipalAmountMainl[] = round($loanAmount-$calculateTotalPrincipalAmountMain,0);
			array_unshift($calculateTotalPrincipalAmountMainl,"");
			unset($calculateTotalPrincipalAmountMainl[0]);
		}
	}
	$monthlyVal = array();
	for($i=1;$i<=$mortgageYears;$i++){
		
		if($i==1){
			$calculateExpenseOfSell = round(($sellTransactioncost*$purchasePrice)/100,0);
			$calculateGrossProceeds = $purchasePrice-$calculateExpenseOfSell;
			$calculateSellAdjustedBasis = $initialTaxBasis - $cashFlowTaxDepreciationYearly;
			
			if(isset($data) && $data == 'taxableGain'){
				
				$taxableGainResult = $calculateGrossProceeds-$calculateSellAdjustedBasis;
				$monthlyVal[] = $taxableGainResult;
				$taxableGainResultVal = get_val_by_number_format($taxableGainResult,true);
				$calculateCashAtClose = '<td>'.explodeMinusVal($taxableGainResultVal).'</td>';
				
			}else if(isset($data) && $data == 'taxableappreciation'){
				
				$calculateCashAtClose = $calculateGrossProceeds-$calculateTotalPrincipalAmountMainl[$i];
				$totalTaxableGain = $calculateGrossProceeds-$calculateSellAdjustedBasis;
				$taxableappreciationRasultVal = get_val_by_number_format($totalTaxableGain-$cashFlowTaxDepreciationYearly,true);
				$monthlyVal[] = $totalTaxableGain-$cashFlowTaxDepreciationYearly;
				$calculateCashAtClose = '<td>'.explodeMinusVal($taxableappreciationRasultVal).'</td>';	
				
			}else if(isset($data) && $data == 'statetax'){
				
				$totalStateTax = $calculateGrossProceeds-$calculateSellAdjustedBasis;
				$totalStateTaxResult = round($totalStateTax*$sellStateTax/100,0);
				
				$statetaxRasultVal = get_val_by_number_format($totalStateTaxResult,true);
				$monthlyVal[] = $totalStateTaxResult;
				$calculateCashAtClose = '<td>'.explodeMinusVal($statetaxRasultVal).'</td>';
				
			}else if(isset($data) && $data == 'FederalAppreciationTax'){
				
				$totalFederalAppreciationTax = $calculateGrossProceeds-$calculateSellAdjustedBasis-$cashFlowTaxDepreciationYearly;	
				
				$totalFederalAppreciationTaxResult = round($totalFederalAppreciationTax*$sellCapitalGain/100);
				
				$totalFederalAppreciationTaxResultVal = get_val_by_number_format($totalFederalAppreciationTaxResult,true);
				$monthlyVal[] = $totalFederalAppreciationTaxResult;
				$calculateCashAtClose = '<td>'.explodeMinusVal($totalFederalAppreciationTaxResultVal).'</td>';
				
			}else if(isset($data) && $data == 'totalTax'){
				
				/***Federal Appreciation Tax***/
				$totalFederalAppreciationTax = $calculateGrossProceeds-$calculateSellAdjustedBasis-$cashFlowTaxDepreciationYearly;	
				$totalFederalAppreciationTaxRasult = round($totalFederalAppreciationTax*$sellCapitalGain/100,0);
				
				/***Federal Depreciation Tax***/
				$calculateFederalDepreciationTax = 	round(($sellDepreciationRecap*$cashFlowTaxDepreciationYearly)/100,0);
				
				/***State Tax***/
				$totalStateTax = $calculateGrossProceeds-$calculateSellAdjustedBasis;
				$totalStateTaxResult = round($totalStateTax*$sellStateTax/100,0);
				
				/***Total Tax***/
				$totalTax = $totalFederalAppreciationTaxRasult+$calculateFederalDepreciationTax+$totalStateTaxResult;
				
				$totalTaxVal = get_val_by_number_format($totalTax,true);
				$monthlyVal[] = $totalTax;
				$calculateCashAtClose = '<td>'.explodeMinusVal($totalTaxVal).'</td>';
				
			}else if(isset($data) && $data == 'NetToSeller'){
				
				/***Federal Appreciation Tax***/
				$totalFederalAppreciationTax = $calculateGrossProceeds-$calculateSellAdjustedBasis-$cashFlowTaxDepreciationYearly;	
				$totalFederalAppreciationTaxRasult = round($totalFederalAppreciationTax*$sellCapitalGain/100,0);
				
				/***Federal Depreciation Tax***/
				$calculateFederalDepreciationTax = 	round(($sellDepreciationRecap*$cashFlowTaxDepreciationYearly)/100,0);
				
				/***State Tax***/
				$totalStateTax = $calculateGrossProceeds-$calculateSellAdjustedBasis;
				$totalStateTaxResult = round($totalStateTax*$sellStateTax/100,0);
				
				/***Total Tax***/
				$totalTax = $totalFederalAppreciationTaxRasult+$calculateFederalDepreciationTax+$totalStateTaxResult;
				
				$NetToSellerResult = $calculateGrossProceeds-$calculateTotalPrincipalAmountMainl[$i]-$totalTax;
				
				$NetToSellerResultVal = get_val_by_number_format($NetToSellerResult,true);
				$monthlyVal[] = $NetToSellerResult;
				$calculateCashAtClose = '<td>'.explodeMinusVal($NetToSellerResultVal).'</td>';
				
			}else if(isset($data) && $data == 'NetMinusOutlay'){
				
				/***Federal Appreciation Tax***/
				$totalFederalAppreciationTax = $calculateGrossProceeds-$calculateSellAdjustedBasis-$cashFlowTaxDepreciationYearly;	
				$totalFederalAppreciationTaxRasult = round($totalFederalAppreciationTax*$sellCapitalGain/100,0);
				
				/***Federal Depreciation Tax***/
				$calculateFederalDepreciationTax = 	round(($sellDepreciationRecap*$cashFlowTaxDepreciationYearly)/100,0);
				
				/***State Tax***/
				$totalStateTax = $calculateGrossProceeds-$calculateSellAdjustedBasis;
				$totalStateTaxResult = round($totalStateTax*$sellStateTax/100,0);
				
				/***Total Tax***/
				$totalTax = $totalFederalAppreciationTaxRasult+$calculateFederalDepreciationTax+$totalStateTaxResult;
				
				/***Net To Seller***/
				$NetToSellerRasult = $calculateGrossProceeds-$calculateTotalPrincipalAmountMainl[$i]-$totalTax;
				
				$NetMinusOutlayVal = get_val_by_number_format($NetToSellerRasult-$cashOutlay,true);
				$monthlyVal[] = $NetToSellerRasult-$cashOutlay;
				$calculateCashAtClose = '<td>'.explodeMinusVal($NetMinusOutlayVal).'</td>';
				
			}else if(isset($data) && $data == 'NetROIAfterSell'){
				
				/***Federal Appreciation Tax***/
				$totalFederalAppreciationTax = $calculateGrossProceeds-$calculateSellAdjustedBasis-$cashFlowTaxDepreciationYearly;	
				$totalFederalAppreciationTaxRasult = round($totalFederalAppreciationTax*$sellCapitalGain/100,0);
				
				/***Federal Depreciation Tax***/
				$calculateFederalDepreciationTax = 	round(($sellDepreciationRecap*$cashFlowTaxDepreciationYearly)/100,0);
				
				/***State Tax***/
				$totalStateTax = $calculateGrossProceeds-$calculateSellAdjustedBasis;
				$totalStateTaxResult = round($totalStateTax*$sellStateTax/100,0);
				
				/***Total Tax***/
				$totalTax = $totalFederalAppreciationTaxRasult+$calculateFederalDepreciationTax+$totalStateTaxResult;
				
				/***Net To Seller***/
				$NetToSellerResult = $calculateGrossProceeds-$calculateTotalPrincipalAmountMainl[$i]-$totalTax;
				
				/** Net ROI After Sell **/
				$NetROIAfterSellResults = $NetToSellerResult-$cashOutlay;
				$NetROIAfterSellResult = $NetROIAfterSellResults/$cashOutlay;
				$NetROIAfterSellResultVals = round($NetROIAfterSellResult*100,2);
				$NetROIAfterSellVal = $NetROIAfterSellResultVals.'%';
				
				if(isset($barchart) && $barchart == 'barchart'){
					$year = $xlabel.' : '.$i;
					$calculateCashAtClose = '["'.$year.'",'.$NetROIAfterSellResultVals.'],';		
				}else{
					$monthlyVal[] = $NetROIAfterSellResultVals;
					$calculateCashAtClose =  '<td>'.$NetROIAfterSellVal.'</td>';
				}
				if(isset($Year) && $Year == 'year3'){
					$calculateCashAtClose = '';
				}
			}else{
				$monthlyVal[] = $calculateGrossProceeds-$calculateTotalPrincipalAmountMainl[$i];
				$elseResult = get_val_by_number_format($calculateGrossProceeds-$calculateTotalPrincipalAmountMainl[$i],true);
				$calculateCashAtClose = '<td>'.explodeMinusVal($elseResult).'</td>';
			}
			
			if(isset($barchart) && $barchart != ''){
				if(isset($data) && $data == 'NetROIAfterSell'){
					$value .= $calculateCashAtClose;
				} else {
				$graphResult = remove_number_format($calculateCashAtClose);
				/* $value .= '['.$i.','.$graphResult.'],'; */
				
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$graphResult.'],';		
				}
			}else{
				$value .= $calculateCashAtClose;	
			}
		}else {
			$purchasePrice = $purchasePrice+(($purchasePrice*$annualAppreciation)/100);
			$purchasePrice = round($purchasePrice,0);
			$totalCalculateExpenseOfSell = round(($sellTransactioncost*$purchasePrice)/100,0);
			$totalCalculateGrossProceeds = $purchasePrice-$totalCalculateExpenseOfSell;
			
			$totalCashFlowTaxDepreciationYearly = $cashFlowTaxDepreciationYearly+$totalCashFlowTaxDepreciationYearly;
			$totalCalculateSellAdjustedBasis = $initialTaxBasis - $totalCashFlowTaxDepreciationYearly;

			if(isset($data) && $data == 'taxableGain'){
				
				$totalTaxableGain = $totalCalculateGrossProceeds-$totalCalculateSellAdjustedBasis;
				$taxableGainResult = get_val_by_number_format($totalTaxableGain,true);
				$calculateCashAtClose = '<td>'.explodeMinusVal($taxableGainResult).'</td>';
				
			}else if(isset($data) && $data == 'taxableappreciation'){
				
				$totalTaxableGain = $totalCalculateGrossProceeds-$totalCalculateSellAdjustedBasis;
				$taxableappreciationResult = get_val_by_number_format($totalTaxableGain-$totalCashFlowTaxDepreciationYearly,true);
				
				$calculateCashAtClose = '<td>'.explodeMinusVal($taxableappreciationResult).'</td>';	
				
			}else if(isset($data) && $data == 'FederalAppreciationTax'){
				
				$totalFederalAppreciationTax = $totalCalculateGrossProceeds-$totalCalculateSellAdjustedBasis-$totalCashFlowTaxDepreciationYearly;	
				 
				 $FederalAppreciationTaxResult = get_val_by_number_format(round($totalFederalAppreciationTax*$sellCapitalGain/100,0),true);
				 
				$calculateCashAtClose = '<td>'.explodeMinusVal($FederalAppreciationTaxResult).'</td>';
				
			}else if(isset($data) && $data == 'statetax'){
				
				$totalStateTax = $totalCalculateGrossProceeds-$totalCalculateSellAdjustedBasis;
				$totalStateTaxResult = get_val_by_number_format(round($totalStateTax*$sellStateTax/100,0),true);
				$calculateCashAtClose = '<td>'.explodeMinusVal($totalStateTaxResult).'</td>';
				
			}else if(isset($data) && $data == 'totalTax'){
				
				/***Federal Appreciation Tax***/
				$totalFederalAppreciationTax = $totalCalculateGrossProceeds-$totalCalculateSellAdjustedBasis-$totalCashFlowTaxDepreciationYearly;	
				$totalFederalAppreciationTaxRasult = round($totalFederalAppreciationTax*$sellCapitalGain/100,0);
				
				/***Federal Depreciation Tax***/
				$calculateFederalDepreciationTax = 	round(($sellDepreciationRecap*$totalCashFlowTaxDepreciationYearly)/100,0);
				
				/***State Tax***/
				$totalStateTax = $totalCalculateGrossProceeds-$totalCalculateSellAdjustedBasis;
				$totalStateTaxResult = round($totalStateTax*$sellStateTax/100,0);
				
				/***Total Tax***/
				$totalTax = $totalFederalAppreciationTaxRasult+$calculateFederalDepreciationTax+$totalStateTaxResult;
				
				$totalTaxResult = get_val_by_number_format($totalTax,true);
				
				$calculateCashAtClose = '<td>'.explodeMinusVal($totalTaxResult).'</td>';
				
			}else if(isset($data) && $data == 'NetToSeller'){
				
				/***Federal Appreciation Tax***/
				$totalFederalAppreciationTax = $totalCalculateGrossProceeds-$totalCalculateSellAdjustedBasis-$totalCashFlowTaxDepreciationYearly;	
				$totalFederalAppreciationTaxRasult = round($totalFederalAppreciationTax*$sellCapitalGain/100,0);
				
				/***Federal Depreciation Tax***/
				$calculateFederalDepreciationTax = 	round(($sellDepreciationRecap*$totalCashFlowTaxDepreciationYearly)/100,0);
				
				/***State Tax***/
				$totalStateTax = $totalCalculateGrossProceeds-$totalCalculateSellAdjustedBasis;
				$totalStateTaxResult = round($totalStateTax*$sellStateTax/100,0);
				
				/***Total Tax***/
				$totalTax = $totalFederalAppreciationTaxRasult+$calculateFederalDepreciationTax+$totalStateTaxResult;
				
				/***Net To Seller***/
				$NetToSellerResult = $totalCalculateGrossProceeds-$calculateTotalPrincipalAmountMainl[$i]-$totalTax;
				
				$NetToSellerResultVal = get_val_by_number_format($NetToSellerResult,true);
				
				$calculateCashAtClose = '<td>'.explodeMinusVal($NetToSellerResultVal).'</td>';
				
			}else if(isset($data) && $data == 'NetMinusOutlay'){
				
				/***Federal Appreciation Tax***/
				$totalFederalAppreciationTax = $totalCalculateGrossProceeds-$totalCalculateSellAdjustedBasis-$totalCashFlowTaxDepreciationYearly;	
				$totalFederalAppreciationTaxRasult = round($totalFederalAppreciationTax*$sellCapitalGain/100,0);
				
				/***Federal Depreciation Tax***/
				$calculateFederalDepreciationTax = 	round(($sellDepreciationRecap*$totalCashFlowTaxDepreciationYearly)/100,0);
				
				/***State Tax***/
				$totalStateTax = $totalCalculateGrossProceeds-$totalCalculateSellAdjustedBasis;
				$totalStateTaxResult = round($totalStateTax*$sellStateTax/100,0);
				
				/***Total Tax***/
				$totalTax = $totalFederalAppreciationTaxRasult+$calculateFederalDepreciationTax+$totalStateTaxResult;
				
				/***Net To Seller***/
				$NetToSellerRasult = $totalCalculateGrossProceeds-$calculateTotalPrincipalAmountMainl[$i]-$totalTax;
				
				/***Net Minus Outlay***/
				
				$NetMinusOutlayResultVal = get_val_by_number_format($NetToSellerRasult-$cashOutlay,true);
				
				$calculateCashAtClose = '<td>'.explodeMinusVal($NetMinusOutlayResultVal).'</td>';
				
			}else if(isset($data) && $data == 'NetROIAfterSell'){
				
				/***Federal Appreciation Tax***/
				$totalFederalAppreciationTax = $totalCalculateGrossProceeds-$totalCalculateSellAdjustedBasis-$totalCashFlowTaxDepreciationYearly;	
				$totalFederalAppreciationTaxRasult = round($totalFederalAppreciationTax*$sellCapitalGain/100,0);
				
				/***Federal Depreciation Tax***/
				$calculateFederalDepreciationTax = 	round(($sellDepreciationRecap*$totalCashFlowTaxDepreciationYearly)/100,0);
				
				/***State Tax***/
				$totalStateTax = $totalCalculateGrossProceeds-$totalCalculateSellAdjustedBasis;
				$totalStateTaxResult = round($totalStateTax*$sellStateTax/100,0);
				
				/***Total Tax***/
				$totalTax = $totalFederalAppreciationTaxRasult+$calculateFederalDepreciationTax+$totalStateTaxResult;
				
				/***Net To Seller***/
				$NetToSellerResult = $totalCalculateGrossProceeds-$calculateTotalPrincipalAmountMainl[$i]-$totalTax;
				
				/***Net Minus Outlay***/
				$NetMinusOutlayResult = $NetToSellerResult-$cashOutlay;
				
				/**NetROIAfterSell**/
				
				$NetROIAfterSellResults = $NetMinusOutlayResult/$cashOutlay;
				$NetROIAfterSellResultVals = round($NetROIAfterSellResults*100,2);
				$NetROIAfterSellResult = $NetROIAfterSellResultVals.'%';
				
				if(isset($barchart) && $barchart == 'barchart'){
					if($i == $mortgageYears){
						$year = $xlabel.' : '.$i;
						$calculateCashAtClose = '["'.$year.'",'.$NetROIAfterSellResultVals.'],';		
					}else{
						$year = $xlabel.' : '.$i;
						$calculateCashAtClose = '["'.$year.'",'.$NetROIAfterSellResultVals.'],';		
					}
				}else if(isset($Year) && $Year == 'year3'){
					
					if($i == 3){
						$calculateCashAtClose = $NetROIAfterSellResult;		
					}else{
						$calculateCashAtClose = '';		
					}
				}else{
					$calculateCashAtClose = '<td>'.$NetROIAfterSellResult.'</td>';
				}
			}else{
				
					$elseResult = get_val_by_number_format($totalCalculateGrossProceeds-$calculateTotalPrincipalAmountMainl[$i],true);
					$calculateCashAtClose = '<td>'.explodeMinusVal($elseResult).'</td>';		
				
			}	
			if(isset($barchart) && $barchart != ''){
				if(isset($data) && $data == 'NetROIAfterSell'){
					$value .= $calculateCashAtClose;
				} else {
						$graphResult = remove_number_format($calculateCashAtClose);
						$year = $xlabel.' : '.$i;
						$value .= '["'.$year.'",'.$graphResult.'],';	
				}
				}else{
					$value .= $calculateCashAtClose;	
				}		
		}
	}
	if($data == '' && $monthly == 'monthly'){
		$result = explodeMinusVal(get_val_by_number_format($monthlyVal[0]/12,true));
		return 	$result;
	}elseif($data == 'taxableGain' && $monthly == 'monthly'){
		$result = explodeMinusVal(get_val_by_number_format($monthlyVal[0]/12,true));
		return 	$result;
	}elseif($data == 'taxableappreciation' && $monthly == 'monthly'){
		$result = explodeMinusVal(get_val_by_number_format($monthlyVal[0]/12,true));
		return 	$result;
	}elseif($data == 'statetax' && $monthly == 'monthly'){
		$result = explodeMinusVal(get_val_by_number_format($monthlyVal[0]/12,true));
		return 	$result;
	}elseif($data == 'FederalAppreciationTax' && $monthly == 'monthly'){
		$result = explodeMinusVal(get_val_by_number_format($monthlyVal[0]/12,true));
		return 	$result;
	}elseif($data == 'totalTax' && $monthly == 'monthly'){
		$result = explodeMinusVal(get_val_by_number_format($monthlyVal[0]/12,true));
		return 	$result;
	}elseif($data == 'NetToSeller' && $monthly == 'monthly'){
		$result = explodeMinusVal(get_val_by_number_format($monthlyVal[0]/12,true));
		return 	$result;
	}elseif($data == 'NetMinusOutlay' && $monthly == 'monthly'){
		$result = explodeMinusVal(get_val_by_number_format($monthlyVal[0]/12,true));
		return 	$result;
	}elseif($data == 'NetROIAfterSell' && $monthly == 'monthly'){
		/* pt($monthlyVal); */
		$result = round($monthlyVal[0]/12,2);
		return 	$result.'%';
	}else{
		return 	$value;	
	}
}
			
function sellCumulativeDepreciation($barchart,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
							
	$purchasePrice = $alldataRasult['purchaseprice'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$buildingValue = $purchasePrice*0.75;
	$amortizationPeriodYears = $alldataRasult['amortizationperiodyears'];
	$cashFlowTaxDepreciationYearly =  round($buildingValue/$amortizationPeriodYears,0); 
	$totalCashFlowTaxDepreciationYearly = $cashFlowTaxDepreciationYearly;
	$monthlyVal = array();
	for($i=1;$i<=$mortgageYears;$i++){
		if($i==1){
			$cashFlowTaxDepreciationYearlyVal = get_val_by_number_format($cashFlowTaxDepreciationYearly,true);
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$cashFlowTaxDepreciationYearly.'],';	
			}else{
				$monthlyVal[] = $cashFlowTaxDepreciationYearly;
			   $value .= "<td>$$cashFlowTaxDepreciationYearlyVal</td>";		
			}				
		} else{
			$totalCashFlowTaxDepreciationYearly = $cashFlowTaxDepreciationYearly+$totalCashFlowTaxDepreciationYearly;
			$cashFlowTaxDepreciationYearlyVal = get_val_by_number_format($totalCashFlowTaxDepreciationYearly,true);
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$totalCashFlowTaxDepreciationYearly.'],';		
			}else{
			   $value .= "<td>$$cashFlowTaxDepreciationYearlyVal</td>";
			}
		}
	}	
	if($monthly == 'monthly'){
		$result = explodeMinusVal(get_val_by_number_format($monthlyVal[0]/12,true));
		return 	$result;
	}else{
		return 	$value;	
	}
}

function sellAdjustedBasis($barchart,$xlabel,$monthly){
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
							
	// Get initial tax basis
	$purchasePrice = $alldataRasult['purchaseprice'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$closingCost = $alldataRasult['closingcost'];
	$upfrontImprovementData = $alldataRasult['upfrontimprovement']/100;
	$upfrontImprovement = $purchasePrice*$upfrontImprovementData;
	$closingCostMain = $closingCost/100*$purchasePrice;
	$purchaseClosingCost = $upfrontImprovement+$closingCostMain;
	$initialTaxBasis = $purchasePrice+$closingCostMain;
	$buildingValue = $purchasePrice*0.75;
	$amortizationPeriodYears = $alldataRasult['amortizationperiodyears'];
	$cashFlowTaxDepreciationYearly =  round($buildingValue/$amortizationPeriodYears,0); 
	$totalCashFlowTaxDepreciationYearly = $cashFlowTaxDepreciationYearly;
	$monthlyVal = array();
	for($i=1;$i<=$mortgageYears;$i++){
		if($i==1){
			$calculateSellAdjustedBasisVal = $initialTaxBasis - $cashFlowTaxDepreciationYearly;
			$calculateSellAdjustedBasis = get_val_by_number_format($calculateSellAdjustedBasisVal,true);
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$calculateSellAdjustedBasisVal.'],';		
			}else{
				$monthlyVal[] = $calculateSellAdjustedBasisVal;
				$value .= "<td>$$calculateSellAdjustedBasis</td>";	
			}						
		} else{
			$totalCashFlowTaxDepreciationYearly = $cashFlowTaxDepreciationYearly+$totalCashFlowTaxDepreciationYearly;
			$calculateSellAdjustedBasisVal = $initialTaxBasis - $totalCashFlowTaxDepreciationYearly;
			$totalCalculateSellAdjustedBasis = get_val_by_number_format($calculateSellAdjustedBasisVal,true);
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$calculateSellAdjustedBasisVal.'],';
			  
			}else{
			  $value .= "<td>$$totalCalculateSellAdjustedBasis</td>";
			}
		}
	}	
	if($monthly == 'monthly'){
		$result = explodeMinusVal(get_val_by_number_format($monthlyVal[0]/12,true));
		return 	$result;
	}else{
		return 	$value;	
	}
}
						
function sellFederalDepreciationTax($barchart,$xlabel,$monthly){	
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	
	//Get Depreciation recap tax
	$purchasePrice = $alldataRasult['purchaseprice'];
	$mortgageYears= $alldataRasult['mortgageyears'];	
	$buildingValue = $purchasePrice*0.75;
	$amortizationPeriodYears = $alldataRasult['amortizationperiodyears'];
	$sellDepreciationRecap = $alldataRasult['selldepreciationrecap'];
	$cashFlowTaxDepreciationYearly =  round($buildingValue/$amortizationPeriodYears,0); 
	$totalCashFlowTaxDepreciationYearly = $cashFlowTaxDepreciationYearly;
	$monthlyVal = array();
	for($i=1;$i<=$mortgageYears;$i++){
		if($i==1){
			$calculateFederalDepreciationTax = 	round((25*$cashFlowTaxDepreciationYearly)/100,0);
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$calculateFederalDepreciationTax.'],';		
			}else{
				$monthlyVal[] = $calculateFederalDepreciationTax;
			   $value .= "<td>$$calculateFederalDepreciationTax</td>";	
			}						
		} else{
			$totalCashFlowTaxDepreciationYearly = $cashFlowTaxDepreciationYearly+$totalCashFlowTaxDepreciationYearly;
			$totalCalculateFederalDepreciationTax = round(($sellDepreciationRecap*$totalCashFlowTaxDepreciationYearly)/100,0);
			if(isset($barchart) && $barchart != ''){
				$year = $xlabel.' : '.$i;
				$value .= '["'.$year.'",'.$totalCalculateFederalDepreciationTax.'],';		
		    }else{
		      $value .= "<td>$$totalCalculateFederalDepreciationTax</td>";	
			}	
		}
	}	
	if($monthly == 'monthly'){
		$result = explodeMinusVal(get_val_by_number_format($monthlyVal[0]/12,true));
		return 	$result;
	}else{
		return 	$value;	
	}
}
						
?>

<div class="container pad0 mainPanel_container ListTwoResult">
<div class="mainPanel_title">
	<h4>
		Summary Of Results
		<i data-toggle="collapse" data-target="#mainpanel" class="fa fa-plus collapsed" aria-hidden="true"></i>
	</h4>
</div>

<div class="table-panel collapse" id="mainpanel">
<div class="summaryofresults">
	<div class="main-row">
		<div class="main_panel_summary col-md-6 col-sm-6 col-lg-6 col-xs-12">
			<div class="heading_details">
				<h4>Cost <i data-toggle="collapse" data-target="#panel1" class="fa fa-plus" aria-hidden="true"></i></h4>
			</div>
			<div class="table-panel collapse" id="panel1">
				<div class="table-responsive">
					<table>
						<tbody>
							<tr>
								<td>Land Value (25%)</td>
								<td><?php echo '$'.number_format($landValue,0,',',','); ?></td>
							</tr>
							<tr>
								<td>Building Value (75%)</td>
								<td><?php echo '$'.number_format($buildingValue,0,',',','); ?></td>
							</tr>
							<tr>
								<td>Upfront Improvements</td>
								<td><?php echo '$'.number_format($upfrontImprovementValue,0,',',','); ?></td>
							</tr>
							<tr>
								<td>Closing Cost</td>
								<td><?php 
								 echo '$'.number_format($closingCostMain,0,',',','); 
								//echo $closingCostMain; ?></td>
							</tr>
							<tr>
								<td>Total Cost</td>
								<td><?php 
								 echo '$'.number_format($totalCostInputsRevised,0,',',','); 
								//echo $totalCostInputs; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="main_panel_summary col-md-6 col-sm-6 col-lg-6 col-xs-12">
			<div class="heading_details">
				<h4>Financing <i data-toggle="collapse" data-target="#panel2" class="fa fa-plus" aria-hidden="true"></i></h4>
			</div>
			<div class="table-panel collapse" id="panel2">
				<div class="table-responsive">
					<table>
						<tbody>
							<tr>
								<td>Loan Amount</td>
								<td><?php echo '$'.number_format($loanAmount,0); ?></td>
							</tr>
							<tr>
								<td>Downpayment</td>
								<td><?php echo '$'.number_format($DownpaymentValue,0); ?></td>
							</tr>
							<tr>
								<td>Monthly Mortgage Payment</td>
								<td><?php echo '$'.number_format(round($monthlyMortgagePay,2),0); ?></td>
							</tr>
							<tr>
								<td>Cash Outlay</td>
								<td><?php echo '$'.number_format($totalFinancingInputs,0); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="main-row">
		<div class="main_panel_summary col-md-6 col-sm-6 col-lg-6 col-xs-12">
			<div class="heading_details">
				<h4>Revenue <i data-toggle="collapse" data-target="#panel3" class="fa fa-plus" aria-hidden="true"></i></h4>
			</div>
			<div class="table-panel reveue collapse" id="panel3">
				<div class="table-responsive">
					<table>
						<tbody>
							<tr>
								<td>Rent Ratio %</td>
								<td><?php echo $rentRatio; ?></td>
							</tr>
							<tr>
								<td>Gross Rent Multiplier</td>
								<td><?php echo $grossRentMultiplier; ?></td>
							</tr>
							<tr>
								<td>Cap Rate %</td>
								<td><?php echo $capRate; ?></td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="main_panel_summary col-md-6 col-sm-6 col-lg-6 col-xs-12">
			<div class="heading_details">
				<h4>Tax <i data-toggle="collapse" data-target="#panel4" class="fa fa-plus" aria-hidden="true"></i></h4>
			</div>
			<div class="table-panel collapse" id="panel4">
				<div class="table-responsive">
					<table>
						<tbody>
							<tr>
								<td>Depreciation Basis</td>
								<td><?php echo '$'.number_format($buildingValue,0); ?></td>
							</tr>
							<tr>
								<td>Depreciation Yearly</td>
								<td><?php echo '$'.number_format($taxDepreciationYearly,0); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>	
	</div>
	
	<div class="main-row">
		<div class="main_panel_summary col-md-6 col-sm-6 col-lg-6 col-xs-12">
			<div class="heading_details">
				<h4>Sell <i data-toggle="collapse" data-target="#panel5" class="fa fa-plus" aria-hidden="true"></i></h4>
			</div>
			<div class="table-panel collapse" id="panel5">
				<div class="table-responsive">
					<table>
						<tbody>
							<tr>
								<td>Initial Purchase Price</td>
								<td><?php echo '$'.number_format($purchasePrice,0); ?></td>
							</tr>
							<tr>
								<td>Purchase Closing Costs</td>
								<td><?php echo '$'.number_format($purchaseClosingCost,0); ?></td>
							</tr>
							<tr>
								<td>Initial Tax Basis</td>
								<td><?php echo '$'.number_format($initialTaxBasis,0); ?></td>
							</tr>
							<tr>
								<td>Net ROI After Sell (3y)</td>
								<td><?php echo cashAtClose('NetROIAfterSell','','year3','',''); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>	
		
		<div class="main_panel_summary col-md-6 col-sm-6 col-lg-6 col-xs-12">
			<div class="heading_details">
				<h4>Year 1 Summary <i data-toggle="collapse" data-target="#panel6" class="fa fa-plus" aria-hidden="true"></i></h4>
			</div>
			<div class="table-panel collapse" id="panel6">
				<div class="table-responsive">
					<table>
						<thead>
							<tr>
								<td><strong>Summary</strong></td>
								<td style="text-align:center;"><strong>Monthly</strong></td>
								<td style="text-align:center;"><strong>Yearly</strong></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Gross Income</td>
								<td style="text-align:right;">$<?php echo number_format($grossIncomeRevenues,0); ?></td>
								<td style="text-align:right;">$<?php echo revenueGrossIncomeCalculations('','','firstyear'); ?></td>
							</tr>
							<tr>
								<td>Total Expenses</td>
								<td style="text-align:right;">$<?php echo operatingTotalExpensesCalculationSumMonthly('monthly'); ?></td>
								<td style="text-align:right;">$<?php echo operatingTotalExpensesCalculationSumMonthly('firstYear'); ?></td>
							</tr>
							<tr>
								<td>Net Operating Income</td>
								<td style="text-align:right;"><?php echo operatingNetOperatingIncomeNOI('one','',''); ?></td>
								<td style="text-align:right;"><?php echo operatingNetOperatingIncomeNOI('one','',''); ?></td>
							</tr>
							<tr>
								<td>Before-Tax Cash Flow</td>
								<td style="text-align:right;"><?php cashFlowBeforeTaxCashFlowmonthly(); ?></td>
								<td style="text-align:right;"><?php cashFlowBeforeTaxCashFlowmonthly('firstYear'); ?></td>
							</tr>
							<tr>
								<td>CoC %</td>
								<td style="text-align:right;"><?php cashFlowCashOnCashReturn('summry','','','');?></td>
								<td style="text-align:right;"><?php cashFlowCashOnCashReturn('summry','','','');?></td>
							</tr>
							<tr>
								<td>After-Tax Cash Flow</td>
								<td style="text-align:right;"><?php echo AfterTaxCashFlow('summry','',''); ?></td>
								<td style="text-align:right;"><?php echo AfterTaxCashFlow('firstyear','',''); ?></td>
								<style>.main_panel_summary .cls{display:none;}</style>
							</tr>
							<tr>
								<td>Total Return</td>
								<td style="text-align:right;"><?php echo totalReturn('','','','monthly',''); ?></td>
								<td style="text-align:right;"><?php echo totalReturn('','','','','oneyear'); ?></td>
							</tr>
							<tr>
								<td>Total ROI</td>
								<td style="text-align:right;"><?php echo totalReturn('summry','','','',''); ?></td>
								<td style="text-align:right;"><?php echo totalReturn('summry','','','',''); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<div class="main_container container-fluid padtop0 resultListd">
	<div class="row">
		<div class="container">
			<div class="dt_ResultHead">Detailed Result</div>
			<div class="main-detail-section">
				<div class="heading_details">
					<h4>Revenue <i data-toggle="collapse" data-target="#details1" class="fa fa-plus" aria-hidden="true"></i></h4>
				</div>
				<div class="details_table_row collapse" id="details1">
					<div class="table-responsive">
						<table>
							<thead>
								<tr>
									<th></th>
									<th>Monthly</th>
									<?php 
									for($i=1;$i<=$mortgageYears;$i++){ ?>
									<th><div class="table_year_head">Year <?php echo $i; ?></div></th>
									<?php }?>
								</tr>
							</thead>
							
							<tbody>
								<tr>
									<td><div class="leftcell">Rental Income</div></td>
									<td>$<?php echo number_format($monthlyRent,0); ?></td>
									<!--td>$<?php echo $revenueByYearsYear1; ?></td-->
									<?php echo revenueYearCalculations('',''); ?>
									<?php 
									/*for($i=2;$i<=$mortgageYears;$i++){ ?>
									<td>$ <?php echo $revenueByYearsYearAll; ?></th>
									<?php } */?>
								</tr>
								<tr>
									<td>Vacancy Rate</td>
									<td><?php echo $vacancyRate.'%'; ?></td>
									<?php 
									for($i=1;$i<=$mortgageYears;$i++){ ?>
									<td><?php 
									$year = 'Year : '.$i;
									$uestd .= '["'.$year.'",'.$vacancyRate.'],';	
									echo $vacancyRate.'%'; ?></td>
									<?php } ?>													
								</tr>
								<tr>
									<td>Vacancy (Loss)</td>
									<td><?php echo '-$'.get_val_by_number_format($vacancyLoss,true); ?></td>
									<?php echo revenueVacancyLossCalculations('','');?>
								</tr>												
								<tr class="grossincome" id="grossincome">
									<td>Gross Income</td>
									<td>$<?php echo number_format($grossIncomeRevenues,0); ?></td>
									<?php echo revenueGrossIncomeCalculations('','',''); ?>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- <a href="#" class="visulise_btn" data-toggle="modal" data-target="#myModal">visualize</a>
					  Modal -->
					<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog">
						
						  <!-- Modal content-->
						  <div class="modal-content">
							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal">&times;</button>
							  <h4 class="modal-title">Visualize For Revenue</h4>
							</div>
							<div class="modal-body">
								<script type="text/javascript">
									google.charts.load("current", {packages:["corechart"]});
									google.charts.setOnLoadCallback(drawChart);
									function drawChart() {
										var data = google.visualization.arrayToDataTable
											([['X', 'Y'],<?php revenueGrossIncomeCalculations('barchart','',''); ?>
										]);

										var options = {
											width: 700,
											height: 400,
											title: "Gross Income According To Year",
											bar: {groupWidth: '100%'},
											legend: 'none',
											colors: ['#EA0011'],
											curveType: 'function',
											pointSize: 5,
											hAxis: {
											  title: 'Years'
											},
											vAxis: {
											  title: 'Gross Income',
											}
										};

										var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
										chart.draw(data, options);
									}
								</script>
								<div id='chart_div'></div>
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						  </div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="main-detail-section">
				<div class="heading_details">
					<h4>Operating Expenses <i data-toggle="collapse" data-target="#details2" class="fa fa-plus" aria-hidden="true"></i></h4>
				</div>
				<div class="details_table_row collapse" id="details2">
					<div class="table-responsive">
						<table>
							<thead>
								<tr>
									<th></th>
									<th>Monthly</th>
									<?php 
									for($i=1;$i<=$mortgageYears;$i++){ ?>
									<th><div class="table_year_head">Year <?php echo $i; ?></div></th>
									<?php }?>
								</tr>
							</thead>
							
							<tbody>
								<tr>
									<td><div class="leftcell">Property Taxes</div></td>
									<?php echo operatingPropertyTaxesMonthly(); ?>
									<?php echo operatingPropertyTaxesYearly('',''); ?>
								</tr>
								<tr>
									<td>Insurance</td>
									<?php echo operatingInsuranceMonthly();?>
									<?php echo operatingInsuranceYearly('','');?>
								</tr>
								<tr>
									<td>Repairs</td>
									<?php echo operatingRepairsMonthly();?>
									<?php echo operatingRepairsYearly('','');?>
								</tr>
								<tr>
									<td>Utilities</td>
									<?php echo operatingUtilitiesMonthly();?>
									<?php echo operatingUtilitiesYearly('','');?>
								</tr>
								<tr>
									<td>Property Mgmt Fee</td>
									<?php echo operatingPropertyMangementFeeMonthly();?>
									<?php $n15 = operatingPropertyMangementFeeYearly('',''); echo $n15;?>
								</tr>
								<tr>
									<td>HOA</td>
									<?php echo operatingHOAMonthly();?>
									<?php echo operatingHOAYearly('','');?>
								</tr>
								<tr>
									<td>Other Percentile Cost</td>
									<?php echo operatingOtherPercentileCostMonthly();?>
									<?php $n17 = operatingOtherPercentileCostYearly('',''); echo $n17;?>
								</tr>
								<tr>
									<td>Other Fixed Cost</td>
									<?php echo operatingOtherFixedCostMonthly();?>
									<?php echo operatingOtherFixedCostYearly('','');?>
								</tr>
								<tr>
									<td>Total Expenses</td>
									<td>$<?php echo operatingTotalExpensesCalculationSumMonthly('monthly'); ?></td>
									<?php echo operatingTotalExpensesCalculationSum('',''); ?>
								</tr>
								<tr>
									<td>Expenses as % of Income</td>
									<td><?php echo operatingTotalExpensesIncludingVacancy('','','monthly'); ?></td>
									<?php echo operatingTotalExpensesIncludingVacancy('','',''); ?>
								</tr>
								<tr>
									<td>Net Operating Income (NOI)</td>
									<td><?php
										
									echo operatingNetOperatingIncomeNOI('','','monthly'); 
									
									
									?></td>
									<?php
										
									echo operatingNetOperatingIncomeNOI('','',''); 
									
									
									?>
								</tr>
								
							</tbody>
						</table>
					</div>
					 <!-- <a href="#" class="visulise_btn" data-toggle="modal" data-target="#myModal1">visualize</a>
					Modal -->
					<div class="modal fade" id="myModal1" role="dialog">
						<div class="modal-dialog">
						
						  <!-- Modal content-->
						  <div class="modal-content">
							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal">&times;</button>
							  <h4 class="modal-title">Visualize For Operating Expenses</h4>
							</div>
							<div class="modal-body">
								<script type="text/javascript">
									google.charts.load("current", {packages:["corechart"]});
									google.charts.setOnLoadCallback(drawChart);
									function drawChart() {
										var data = google.visualization.arrayToDataTable
											([['X', 'Y'],<?php operatingNetOperatingIncomeNOI('barchart','',''); ?>
										]);

										var options = {
											width: 700,
											height: 400,
											title: "Net Operating Income (NOI) According to Years",
											/* chartArea: {'width': '100%', 'height': '80%'}, */
											legend: 'none',
											colors: ['#EA0011'],
											curveType: 'function',
											pointSize: 5,
											hAxis: {
											  title: 'Years'
											},
											vAxis: {
											  title: 'Net Operating Income (NOI)',
											}
										};

										var chart = new google.visualization.LineChart(document.getElementById('chart_div1'));
										chart.draw(data, options);
									}
								</script>
								<div id='chart_div1'></div>
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						  </div>
						</div>
					</div>
					<!-- Modal End -->
				</div>
			</div>
			
			
			<div class="main-detail-section">
				<div class="heading_details">
					<h4>Cash Flow <i data-toggle="collapse" data-target="#details3" class="fa fa-plus" aria-hidden="true"></i></h4>
				</div>
				<div class="details_table_row collapse" id="details3">
					<div class="table-responsive">
						<table>
							<thead>
								<tr>
									<th></th>
									<th>Monthly</th>
									<?php 
									for($i=1;$i<=$mortgageYears;$i++){ ?>
									<th class="calculateMyChoiceCashFlows"><div class="table_year_head">Year <?php echo $i; ?></div></th>
									<?php }?>
								</tr>
							</thead>
							
							<tbody>
								<tr>
									<td><div class="leftcell">NOI (cash available)</div></td>
									<td><?php echo operatingNetOperatingIncomeNOIRev('','','monthly');?></td>
									<?php echo operatingNetOperatingIncomeNOIRev('','','');?>
								</tr>
								<tr>
									<td>Mortgage</td>
									<td><?php echo explodeMinusVal(round($monthlyMortgagePay,0)); ?></td>
									<?php
									for($i=1;$i<=$mortgageYears;$i++){ 
									
									/* $monthlyMortgagePay; */
									
										 $MortgageResult = explodeMinusVal(get_val_by_number_format(round( $monthlyMortgagePay*12,0),true));
										
										/* $MortgageRasultVal = explodeMinusVal($MortgageRasult); */
										$c = str_replace( '$', '', $MortgageResult );
										$year = 'Year : '.$i;
										$MortgageResultGraph .= '["'.$year.'",'.round( $monthlyMortgagePay*12,0).'],';

										
										echo '<td>'.$MortgageResult.'</td>';
										
										
									} 
									
									?>
								</tr>
								<tr>
									<td>Before-Tax Cash Flow</td>
									<td><?php cashFlowBeforeTaxCashFlowmonthly(); ?></td>
									<?php echo cashFlowBeforeTaxCashFlow('',''); ?>
								</tr>
								<tr>
									<td>Cash-on-Cash Return</td>
									<td><?php echo cashFlowCashOnCashReturn('','','','monthly'); ?></td>
									<?php echo cashFlowCashOnCashReturn('','','',''); ?>
								</tr>
								<tr>
									<td>Interest Paid</td>
									<td><?php echo cashFlowInterestPaid('','','monthly');?></td>
									<?php $n29 = cashFlowInterestPaid('','',''); echo $n29;?>
								</tr>
								<tr>
									<td>Equity Accrued (Principle)</td>
									<td><?php echo cashFlowEquityAcruedPrincipal('','','monthly'); ?></td>
									<?php echo cashFlowEquityAcruedPrincipal('','',''); ?>
								</tr>
								<tr>
									<td>Depreciation</td>
									<?php cashFlowDepreciationMonthlyCalculations(); ?>
									<?php $n31 = cashFlowDepreciationYearlyCalculations('',''); echo $n31;?>
								</tr>
								<tr>
									<td>Taxable Income</td>
									<td><?php echo  cashflowtaxableincomeyearly('','','','monthlyIncomeTaxes'); ?></td>
									<?php //cashFlowTaxableIncome();  ?>
									<?php echo  cashflowtaxableincomeyearly('','','',''); ?>
								</tr>
								<tr>
									<td>Income Taxes</td>
									<td><?php echo  cashflowtaxableincomeyearly('incomeTaxes','','','monthlyIncomeTaxes'); ?></td>
									<?php echo  cashflowtaxableincomeyearly('incomeTaxes','','',''); ?>
								</tr>
								<tr>
									<td>After-Tax Cash Flow</td>
									<?php echo AfterTaxCashFlow(12,'',''); ?>
								</tr>
								<tr>
									<td>Total Return</td>
									<td><?php echo totalReturn('','','','monthly',''); ?></td>
									<?php echo totalReturn('','','','',''); ?>
								</tr>
								<tr>
									<td>Total ROI</td>
									<td><?php echo totalReturn('totalROI','','','monthly',''); ?></td>
									<?php echo totalReturn('totalROI','','','',''); ?>
								</tr>
								<tr>
									<td>Cash Flow/Mortgage Ratio</td>
									<td><?php echo cashFlowMortgageRatio('','','monthly'); ?></td>
									<?php echo cashFlowMortgageRatio('','',''); ?>
								</tr>
								
							</tbody>
						</table>
					</div>
					<!-- <a href="#" class="visulise_btn" data-toggle="modal" data-target="#myModal2">visualize</a>
					Modal -->
					<div class="modal fade" id="myModal2" role="dialog">
						<div class="modal-dialog">
						  <!-- Modal content-->
						  <div class="modal-content">
							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal">&times;</button>
							   <h4 class="modal-title">Visualize For Cash Flow</h4>
							</div>
							<div class="modal-body">
								<script type="text/javascript">
									google.charts.load("current", {packages:["corechart"]});
									google.charts.setOnLoadCallback(drawChart);
									function drawChart() {
										var data = google.visualization.arrayToDataTable
											([['X', 'Y'],<?php cashFlowMortgageRatio('barchart','',''); ?>
										]);

										var options = {
											width: 700,
											height: 400,
											title: "Cash Flow/Mortgage Ratio According To Year",
											bar: {groupWidth: '100%'},
											legend: 'none',
											colors: ['#EA0011'],
											curveType: 'function',
											pointSize: 5,
											hAxis: {
											  title: 'Years'
											},
											vAxis: {
											  title: 'Cash Flow/Mortgage Ratio',
											}
										};

										var chart = new google.visualization.LineChart(document.getElementById('chart_div2'));
										chart.draw(data, options);
									}
								</script>
								<div id='chart_div2'></div>
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						  </div>
						</div>
					</div>
					<!-- Modal End -->
				</div>
			</div>
			
			<div class="main-detail-section">
				<div class="heading_details">
					<h4>Debt Service <i data-toggle="collapse" data-target="#details4" class="fa fa-plus" aria-hidden="true"></i></h4>
				</div>
				<div class="details_table_row collapse" id="details4">
					<div class="table-responsive">
						<table>
							<thead>
								<tr>
									<th></th>
									<th>Monthly</th>
									<?php 
									for($i=1;$i<=$mortgageYears;$i++){ ?>
									<th><div class="table_year_head">Year <?php echo $i; ?></div></th>
									<?php }?>
								</tr>
							</thead>
							
							<tbody>
								<tr>
									<td><div class="leftcell">Mortgage</div></td>
									<td>$<?php echo get_val_by_number_format(round($monthlyMortgagePay,0),true); ?></td>
									<?php echo debtServiceMortgage('',''); ?>
								</tr>
								<tr>
									<td>Cumulative Interest</td>
									<td><?php echo debtServiceCumulativeInterest('','','monthly'); ?></td>
									<?php echo debtServiceCumulativeInterest('','',''); ?>		
								</tr>
								<tr>
									<td>Cumulative Equity</td>
									<td><?php echo debtServiceCumulativeEquity('','','monthly'); ?></td>
									<?php echo debtServiceCumulativeEquity('','',''); ?>
								</tr>												
								<tr>
									<td>Loan PayOff Amount</td>
									<td><?php echo debtServiceLoanPayOffAmount('','','monthly'); ?></td>
									<?php echo debtServiceLoanPayOffAmount('','',''); ?>
								</tr>
							</tbody>
						</table>
					</div>
					<!--<a href="#" class="visulise_btn" data-toggle="modal" data-target="#myModal3">visualize</a>
					 Modal -->
					<div class="modal fade" id="myModal3" role="dialog">
						<div class="modal-dialog">
						  <!-- Modal content-->
						  <div class="modal-content">
							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal">&times;</button>
							   <h4 class="modal-title">Visualize For Debt Service</h4>
							</div>
							<div class="modal-body">
								<script type="text/javascript">
									google.charts.load("current", {packages:["corechart"]});
									google.charts.setOnLoadCallback(drawChart);
									function drawChart() {
										var data = google.visualization.arrayToDataTable
											([['X', 'Y'],<?php debtServiceLoanPayOffAmount('barchart','',''); ?>
										]);

										var options = {
											width: 700,
											height: 400,
											title: "Cash Flow/Mortgage Ratio According To Year",
											bar: {groupWidth: '100%'},
											legend: 'none',
											colors: ['#EA0011'],
											curveType: 'function',
											pointSize: 5,
											hAxis: {
											  title: 'Years'
											},
											vAxis: {
											  title: 'Loan PayOff Amount',
											}
										};

										var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));
										chart.draw(data, options);
									}
								</script>
								<div id="chart_div3"></div>
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						  </div>
						</div>
					</div>
					<!-- Modal End -->
				</div>
			</div>
			
			
			<div class="main-detail-section">
				<div class="heading_details">
					<h4>Sell <i data-toggle="collapse" data-target="#details5" class="fa fa-plus" aria-hidden="true"></i></h4>
				</div>
				<div class="details_table_row collapse" id="details5">
					<div class="table-responsive">
						<table>
							<thead>
								<tr>
									<th></th>
									<th>Monthly</th>
									<?php 
									for($i=1;$i<=$mortgageYears;$i++){ ?>
									<th><div class="table_year_head">Year <?php echo $i; ?></div></th>
									<?php }?>
								</tr>
							</thead>
							
							<tbody>
								<tr>
									<td><div class="leftcell">Selling Price</div></td>
									<td><?php echo sellSellingPrice('','','monthly');?></td>
									<?php echo sellSellingPrice('','','');?>
								</tr>
								<tr>
									<td>Expense Of Sell</td>
									<td><?php echo sellExpenseOfSell('','','monthly');?></td>
									<?php echo sellExpenseOfSell('','','');?>
								</tr>
								<tr>
									<td>Gross Proceeds</td>
									<td><?php echo sellGrossProceeds('','','monthly'); ?></td>
									<?php echo sellGrossProceeds('','',''); ?>
								</tr>
								<tr>
									<td>Outstanding Debt</td>
									<td><?php echo debtServiceLoanPayOffAmount('','','monthly'); ?></td>
									<?php echo debtServiceLoanPayOffAmount('','',''); ?>
								</tr>
								<tr>
									<td>Cash At Close</td>
									<td><?php echo cashAtClose('','','','','monthly'); ?></td>
									<?php echo cashAtClose('','','','',''); ?>
								</tr>
								<tr>
									<td>Cumulative Depreciation</td>
									<td><?php echo sellCumulativeDepreciation('','','monthly'); ?></td>
									<?php echo sellCumulativeDepreciation('','',''); ?>
								</tr>
								<tr>
									<td>Adjusted Basis</td>
									<td><?php echo sellAdjustedBasis('','','monthly'); ?></td>
									<?php echo sellAdjustedBasis('','',''); ?>
								</tr>
								<tr>
									<td>Taxable Gain</td>
									<td><?php echo cashAtClose('taxableGain','','','','monthly'); ?></td>
									<?php echo cashAtClose('taxableGain','','','',''); ?>
								</tr>
								<tr>
									<td>Taxable Appreciation</td>
									<td><?php echo cashAtClose('taxableappreciation','','','','monthly'); ?></td>
									<?php echo cashAtClose('taxableappreciation','','','',''); ?>
								</tr>
								<tr>
									<td>State Tax</td>
									<td><?php echo cashAtClose('statetax','','','','monthly'); ?></td>
									<?php echo cashAtClose('statetax','','','',''); ?>
								</tr>
								<tr>
									<td>Federal Depreciation Tax</td>
									<td><?php echo sellFederalDepreciationTax('','','monthly'); ?></td>
									<?php echo sellFederalDepreciationTax('','',''); ?>
								</tr>
								<tr>
									<td>Federal Appreciation Tax</td>
									<td><?php echo cashAtClose('FederalAppreciationTax','','','','monthly'); ?></td>
									<?php echo cashAtClose('FederalAppreciationTax','','','',''); ?>
								</tr>
								<tr>
									<td>Total Tax</td>
									<td><?php echo cashAtClose('totalTax','','','','monthly'); ?></td>
									<?php echo cashAtClose('totalTax','','','',''); ?>
								</tr>
								<tr>
									<td>Net To Seller</td>
									<td><?php echo cashAtClose('NetToSeller','','','','monthly'); ?></td>
									<?php echo cashAtClose('NetToSeller','','','',''); ?>
								</tr>
								<tr>
									<td>Net Minus Outlay</td>
									<td><?php echo cashAtClose('NetMinusOutlay','','','','monthly'); ?></td>
									<?php echo cashAtClose('NetMinusOutlay','','','',''); ?>
								</tr>
								<tr>
									<td>Net ROI After Sell</td>
									<td><?php echo cashAtClose('NetROIAfterSell','','','','monthly'); ?></td>
									<?php echo cashAtClose('NetROIAfterSell','','','',''); ?>
								</tr>
								
							</tbody>
						</table>
					</div>
					<!-- <a href="#" class="visulise_btn" data-toggle="modal" data-target="#myModal4">visualize</a>
					Modal -->
					<div class="modal fade" id="myModal4" role="dialog">
						<div class="modal-dialog">
						  <!-- Modal content-->
						  <div class="modal-content">
							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal">&times;</button>
							   <h4 class="modal-title">Visualize For Sell</h4>
							</div>
							<div class="modal-body">
								<script type="text/javascript">
									google.charts.load("current", {packages:["corechart"]});
									google.charts.setOnLoadCallback(drawChart);
									function drawChart() {
										var data = google.visualization.arrayToDataTable
											([['X', 'Y'],<?php cashAtClose('NetROIAfterSell','barchart','','',''); ?>
										]);

										var options = {
											width: 700,
											height: 400,
											title: "Net ROI After Sell According To Year",
											bar: {groupWidth: '100%'},
											legend: 'none',
											colors: ['#EA0011'],
											curveType: 'function',
											pointSize: 5,
											hAxis: {
											  title: 'Years'
											},
											vAxis: {
											  title: 'Net ROI After Sell',
											}
										};
										var chart = new google.visualization.LineChart(document.getElementById('chart_div4'));
										chart.draw(data, options);
									}
								</script>
								<div id="chart_div4"></div>
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						  </div>
						</div>
					</div>
					<!-- Modal End -->
				</div>
			</div>
			<div class="main-detail-section GraphsBar">
				<div class="heading_details">
					<h4>Graphs <i data-toggle="collapse" data-target="#visualize1" class="fa fa-minus" aria-hidden="true"></i></h4>
				</div>
				<div class="details_table_row collapse in" id="visualize1">
					<div class="table-responsive">
					    <!-- /*************************************************************************************************
						**********************************>REVENUE STARTS ******************************************
						**************************************************************************************************/ -->
						<div class="row margin0 marginbottom MainBarWrap">
						<h4 class="sectionTitle">Revenue</h4>
						<div class="row margin0 marginbottom">
						<?php 
						/***************Barchart for Rental Income**********/
							$revenueYearCalculationsFunction = revenueYearCalculations('barchart','Year');
							$rentalIncome = array(
								'maintitle'=>'Rental Income ($)',
								'class1'=>'rentalincome', 
								'toggleid'=>'rentalincome1',
								'chartfunction'=>'rentalincomeBarchart',
								'getchart'=>$revenueYearCalculationsFunction,
								'toptitle'=>'Rental Income According To Year',
								'leftitle'=>'Rental Income ($)',
								'divid'=>'revenue',
							);
							get_barchart_by_datas($rentalIncome);
							/***************Barchart for Vacancy Rate**********/
							$VacancyRateResult = array(
								'maintitle'=>'Vacancy Rate (%)',
								'class1'=>'VacancyRate', 
								'toggleid'=>'VacancyRate1',
								'chartfunction'=>'VacancyRatechart',
								'getchart'=>$uestd,
								'toptitle'=>'Vacancy Rate According To Year',
								'leftitle'=>'Vacancy Rate (%)',
								'divid'=>'revenue',
							);
							get_barchart_by_datas($VacancyRateResult);
							/***************Barchart for Vacancy (Loss)**********/
							$VacancyLossFunction = revenueVacancyLossCalculations('barchart','Year');
							$VacancyLossResult = array(
								'maintitle'=>'Vacancy Loss (%)',
								'class1'=>'VacancyLoss', 
								'toggleid'=>'VacancyLoss1',
								'chartfunction'=>'VacancyLossBarchart',
								'getchart'=>$VacancyLossFunction,
								'toptitle'=>'Vacancy (Loss) According To Year',
								'leftitle'=>'Vacancy Loss (%)',
								'divid'=>'revenue',
							);
							get_barchart_by_datas($VacancyLossResult);
							/***************Barchart for Gross Income**********/
							$GrossIncomeFunction = revenueGrossIncomeCalculations('barchart','Year','');
							$GrossIncomeResult = array(
								'maintitle'=>'Gross Income ($)',
								'class1'=>'GrossIncome', 
								'toggleid'=>'GrossIncome1',
								'chartfunction'=>'GrossIncomeBarchart',
								'getchart'=>$GrossIncomeFunction,
								'toptitle'=>'Gross Income According To Year',
								'leftitle'=>'Gross Income ($)',
								'divid'=>'revenue',
							);
							get_barchart_by_datas($GrossIncomeResult);
							?>
                        </div>	
						<div id="DynamicAppendGraph_revenue" class="AppendGraph"></div>
						</div>
						<!-- /*************************************************************************************************
						**********************************>OPERATING EXPENSES STARTS ******************************************
						**************************************************************************************************/ -->
						<div class="row margin0 marginbottom MainBarWrap">
							<h4 class="sectionTitle">Operating Expenses</h4>
						
                           <div class="row margin0 marginbottom">
                           	<!-- /***************Barchart for Property Taxes**********/ -->
							<?php 
							$PropertyTaxeschartFunction = operatingPropertyTaxesYearly('barchart','Year');
							$IPropertyTaxeschartFunction = array(
								'maintitle'=>'Property Taxes ($)',
								'class1'=>'PropertyTaxes', 
								'toggleid'=>'PropertyTaxes1',
								'chartfunction'=>'PropertyTaxesBarchart',
								'getchart'=>$PropertyTaxeschartFunction,
								'toptitle'=>'Property Taxes According To Year',
								'leftitle'=>'Property Taxes ($)',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_datas($IPropertyTaxeschartFunction);
							/***************Barchart for Insurance**********/
							$InsuranceYearlychartFunction = operatingInsuranceYearly('barchart','Year');
							$InsuranceYearly = array(
								'maintitle'=>'Insurance ($)',
								'class1'=>'insurance', 
								'toggleid'=>'insurance1',
								'chartfunction'=>'insuranceBarchart',
								'getchart'=>$InsuranceYearlychartFunction,
								'toptitle'=>'Insurance According To Year',
								'leftitle'=>'Insurance ($)',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_datas($InsuranceYearly);
							/***************Barchart for Repairs**********/
							$repairsBarchart = operatingRepairsYearly('barchart','Year');
							$repairsBarchartResult = array(
								'maintitle'=>'Repairs ($)',
								'class1'=>'repairs', 
								'toggleid'=>'repairs1',
								'chartfunction'=>'repairsBarchart',
								'getchart'=>$repairsBarchart,
								'toptitle'=>'Repairs Values According To Year',
								'leftitle'=>'Repairs Values ($)',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_datas($repairsBarchartResult);
							/***************Barchart for Utilities**********/
							$UtilitiesFunction = operatingUtilitiesYearly('barchart','Year');
							$UtilitiesYearly = array(
								'maintitle'=>'Utilities ($)',
								'class1'=>'utilities', 
								'toggleid'=>'utilities1',
								'chartfunction'=>'utilitiesBarchart',
								'getchart'=>$UtilitiesFunction,
								'toptitle'=>'Utility Values According To Year',
								'leftitle'=>'Utility Values ($)',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_datas($UtilitiesYearly);
							?>
						</div>
						<div class="row margin0 marginbottom">	
							<?php 
							/***************Barchart for Property Mgmt Fee**********/
							$PropertyMgmt = operatingPropertyMangementFeeYearly('barchart','Year');
							$PropertyMgmtResult = array(
								'maintitle'=>'Property Mgmt Fee ($)',
								'class1'=>'PropertyMgmt', 
								'toggleid'=>'PropertyMgmt1',
								'chartfunction'=>'PropertyMgmtFun',
								'getchart'=>$PropertyMgmt,
								'toptitle'=>'Property Values According To Year',
								'leftitle'=>'Property Mgmt Fee ($)',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_datas($PropertyMgmtResult);
							?>
							<!-- BARCHART FOR operatingHOAYearly -->
							<?php 
							$HOA = operatingHOAYearly('barchart','Year');
							$HOAResult = array(
								'maintitle'=>'HOA ($)',
								'class1'=>'HOA', 
								'toggleid'=>'HOA1',
								'chartfunction'=>'HOAFun',
								'getchart'=>$HOA,
								'toptitle'=>'HOA Values According To Year',
								'leftitle'=>'HOA ($)',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_datas($HOAResult);
							?>
						<!-- /***************Other Percentile Cost**********/ -->
							<?php 
							$OtherPercentileCost = operatingOtherPercentileCostYearly('barchart','Year');
							$OtherPercentileCost2Result = array(
								'maintitle'=>'Other Percentile Cost ($)',
								'class1'=>'OtherPercentileCost', 
								'toggleid'=>'OtherPercentileCost1',
								'chartfunction'=>'OtherPercentileCostFun',
								'getchart'=>$OtherPercentileCost,
								'toptitle'=>'Other Percentile Cost Values According To Year',
								'leftitle'=>'Other Percentile Cost ($)',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_datas($OtherPercentileCost2Result);
							?>
							<!-- BARCHART FOR Other Fixed Cost -->
							<?php 
							$OtherFixedCost = operatingOtherFixedCostYearly('barchart','Year');
							$OtherFixedCostResult = array(
								'maintitle'=>'Other Fixed Cost ($)',
								'class1'=>'OtherFixedCost', 
								'toggleid'=>'OtherFixedCost1',
								'chartfunction'=>'OtherFixedCostFun',
								'getchart'=>$OtherFixedCost,
								'toptitle'=>'Other Fixed Cost According To Year',
								'leftitle'=>'Other Fixed Cost ($)',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_datas($OtherFixedCostResult);
							?>
						</div>
						<div class="row margin0 marginbottom">	
						<!-- BARCHART FOR Total expenses -->
							<?php 
							$TotalExpensesMgmt = operatingTotalExpensesCalculationSum('barchart','Year');
							$TotalExpensesMgmtResult = array(
								'maintitle'=>'Total Expenses ($)',
								'class1'=>'TotalExpenses', 
								'toggleid'=>'TotalExpenses1',
								'chartfunction'=>'TotalExpensesFun',
								'getchart'=>$TotalExpensesMgmt,
								'toptitle'=>'Total Expenses According To Year',
								'leftitle'=>'Total Expenses ($)',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_datas($TotalExpensesMgmtResult);
							?>
                        <!-- BARCHART FOR Expenses (incl Vacancy) as % of Gross Income -->
							<?php 
							$ExpensesinclVacancy = operatingTotalExpensesIncludingVacancy('barchart','Year','');
							$ExpensesinclVacancyResult = array(
								'maintitle'=>'Expenses as % of Income (%)',
								'class1'=>'ExpensesinclVacancy', 
								'toggleid'=>'ExpensesinclVacancy1',
								'chartfunction'=>'ExpensesinclVacancyFun',
								'getchart'=>$ExpensesinclVacancy,
								'toptitle'=>'Expenses as % of Income According To Year',
								'leftitle'=>'Expenses as % of Income (%)',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_datas($ExpensesinclVacancyResult);
							?>
							<!-- BARCHART FOR Net Operating Income (NOI) -->
							<?php 
							$NetOperatingIncome = operatingNetOperatingIncomeNOI('barchart','Year','');
							$NetOperatingIncomeResult = array(
								'maintitle'=>'Net Operating Inc. (NOI) ($)',
								'class1'=>'NetOperatingIncome', 
								'toggleid'=>'NetOperatingIncome1',
								'chartfunction'=>'NetOperatingIncomeFun',
								'getchart'=>$NetOperatingIncome,
								'toptitle'=>'Net Operating Income (NOI) According To Year',
								'leftitle'=>'Net Operating Inc. (NOI) ($)',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_datas($NetOperatingIncomeResult);
							?>

							</div>
                         <div id="DynamicAppendGraph_OpsExpensive" class="AppendGraph"></div>
					</div>
					<!-- /*************************************************************************************************
						**********************************>CASH FLOW STARTS ******************************************
						**************************************************************************************************/ -->
						<div class="row margin0 marginbottom MainBarWrap">
						<h4 class="sectionTitle">Cash Flow</h4>
						<div class="row margin0 marginbottom">
						<?php 
						/***************Barchart for NOI (cash available)**********/
							$NOIcashAvailableFunction = operatingNetOperatingIncomeNOIRev('barchart','Year','');
							$NOIcashAvailableResult = array(
								'maintitle'=>'Net Operating Inc. (NOI) ($)',
								'class1'=>'NOIcashAvailable', 
								'toggleid'=>'NOIcashAvailable1',
								'chartfunction'=>'NOIcashAvailableBarchart',
								'getchart'=>$NOIcashAvailableFunction,
								'toptitle'=>'NOI (cash available) According To Year',
								'leftitle'=>'Net Operating Inc. (NOI) ($)',
								'divid'=>'cashFlow',
							);
							get_barchart_by_datas($NOIcashAvailableResult);
							/***************Barchart for Mortgage**********/
							$MortgageResult = array(
								'maintitle'=>'Mortgage ($)',
								'class1'=>'Mortgage', 
								'toggleid'=>'Mortgage1',
								'chartfunction'=>'Mortgagechart',
								'getchart'=>$MortgageResultGraph,
								'toptitle'=>'Mortgage According To Year',
								'leftitle'=>'Mortgage ($)',
								'divid'=>'cashFlow',
							);
							get_barchart_by_datas($MortgageResult);
							/***************Barchart for Before-Tax Cash Flow**********/
							$BeforeTaxCashFlowFunction = cashFlowBeforeTaxCashFlow('barchart','Year');
							$BeforeTaxCashFlowResult = array(
								'maintitle'=>'Before-Tax Cash Flow ($)',
								'class1'=>'BeforeTaxCashFlow', 
								'toggleid'=>'BeforeTaxCashFlow1',
								'chartfunction'=>'BeforeTaxCashFlowBarchart',
								'getchart'=>$BeforeTaxCashFlowFunction,
								'toptitle'=>'Before-Tax Cash Flow According To Year',
								'leftitle'=>'Before-Tax Cash Flow ($)',
								'divid'=>'cashFlow',
							);
							get_barchart_by_datas($BeforeTaxCashFlowResult);
							/***************Barchart for Cash-on-Cash Return**********/
							$CashonCashReturnFunction = cashFlowCashOnCashReturn('','barchart','Year','');
							$CashonCashReturnResult = array(
								'maintitle'=>'Cash-on-Cash Return (%)',
								'class1'=>'CashonCashReturn', 
								'toggleid'=>'CashonCashReturn1',
								'chartfunction'=>'CashonCashReturnBarchart',
								'getchart'=>$CashonCashReturnFunction,
								'toptitle'=>'Cash-on-Cash Return According To Year',
								'leftitle'=>'Cash-on-Cash Return (%)',
								'divid'=>'cashFlow',
							);
							get_barchart_by_datas($CashonCashReturnResult);
							?>
                        </div>
                        <div class="row margin0 marginbottom">
						<?php 
						/***************Barchart for Interest Paid**********/
							$InterestPaidFunction = cashFlowInterestPaid('barchart','Year','');
							$InterestPaidResult = array(
								'maintitle'=>'Interest Paid ($)',
								'class1'=>'InterestPaid', 
								'toggleid'=>'InterestPaid1',
								'chartfunction'=>'InterestPaidBarchart',
								'getchart'=>$InterestPaidFunction,
								'toptitle'=>'Interest Paid According To Year',
								'leftitle'=>'Interest Paid ($)',
								'divid'=>'cashFlow',
							);
							get_barchart_by_datas($InterestPaidResult);
							/***************Barchart for Equity Accrued (Principle)**********/
							$EquityAccruedPrincipleFunction = cashFlowEquityAcruedPrincipal('barchart','Year','');
							$EquityAccruedPrincipleResult = array(
								'maintitle'=>'Equity (Principle) ($)',
								'class1'=>'EquityAccruedPrinciple', 
								'toggleid'=>'EquityAccruedPrinciple1',
								'chartfunction'=>'EquityAccruedPrinciplechart',
								'getchart'=>$EquityAccruedPrincipleFunction,
								'toptitle'=>'Equity Accrued (Principle) According To Year',
								'leftitle'=>'Equity (Principle) ($)',
								'divid'=>'cashFlow',
							);
							get_barchart_by_datas($EquityAccruedPrincipleResult);
							/***************Barchart for Depreciation**********/
							$DepreciationFunction = cashFlowDepreciationYearlyCalculations('barchart','Year');
							$DepreciationResult = array(
								'maintitle'=>'Depreciation ($)',
								'class1'=>'Depreciation', 
								'toggleid'=>'Depreciation1',
								'chartfunction'=>'DepreciationBarchart',
								'getchart'=>$DepreciationFunction,
								'toptitle'=>'Depreciation According To Year',
								'leftitle'=>'Depreciation ($)',
								'divid'=>'cashFlow',
							);
							get_barchart_by_datas($DepreciationResult);
							/***************Barchart for Taxable Income**********/
							$TaxableIncomeFunction = cashflowtaxableincomeyearly('','barchart','Year','');
							$TaxableIncomeResult = array(
								'maintitle'=>'Taxable Income ($)',
								'class1'=>'TaxableIncome', 
								'toggleid'=>'TaxableIncome1',
								'chartfunction'=>'TaxableIncomeBarchart',
								'getchart'=>$TaxableIncomeFunction,
								'toptitle'=>'Taxable Income According To Year',
								'leftitle'=>'Taxable Income ($)',
								'divid'=>'cashFlow',
							);
							get_barchart_by_datas($TaxableIncomeResult);
							?>
                        </div>
                        <div class="row margin0 marginbottom">
						<?php 
						/***************Barchart for Income Taxes**********/
							$IncomeTaxesFunction = cashflowtaxableincomeyearly('incomeTaxes','barchart','Year','');
							$IncomeTaxesResult = array(
								'maintitle'=>'Income Taxes ($)',
								'class1'=>'IncomeTaxes', 
								'toggleid'=>'IncomeTaxes1',
								'chartfunction'=>'IncomeTaxeschart',
								'getchart'=>$IncomeTaxesFunction,
								'toptitle'=>'Income Taxes According To Year',
								'leftitle'=>'Income Taxes ($)',
								'divid'=>'cashFlow',
							);
							get_barchart_by_datas($IncomeTaxesResult);
							/***************Barchart for After-Tax Cash Flow**********/
							$AfterTaxCashFlowFunction = AfterTaxCashFlow(12,'barchart','Year');
							$AfterTaxCashFlowResult = array(
								'maintitle'=>'After-Tax Cash Flow ($)',
								'class1'=>'AfterTaxCashFlow', 
								'toggleid'=>'AfterTaxCashFlow1',
								'chartfunction'=>'AfterTaxCashFlowchart',
								'getchart'=>$AfterTaxCashFlowFunction,
								'toptitle'=>'After-Tax Cash Flow According To Year',
								'leftitle'=>'After-Tax Cash Flow ($)',
								'divid'=>'cashFlow',
							);
							get_barchart_by_datas($AfterTaxCashFlowResult);
							/***************Barchart for Total Return**********/
							$TotalReturnFunction = totalReturn('','barchart','Year','','');
							$TotalReturnResult = array(
								'maintitle'=>'Total Return ($)',
								'class1'=>'TotalReturn', 
								'toggleid'=>'TotalReturn1',
								'chartfunction'=>'TotalReturnBarchart',
								'getchart'=>$TotalReturnFunction,
								'toptitle'=>'Total Return According To Year',
								'leftitle'=>'Total Return ($)',
								'divid'=>'cashFlow',
							);
							get_barchart_by_datas($TotalReturnResult);
							/***************Barchart for Total ROI **********/
							$TotalROIFunction = totalReturn('totalROI','barchart','Year','','');
							$TotalROIResult = array(
								'maintitle'=>'Total ROI (%)',
								'class1'=>'TotalROI', 
								'toggleid'=>'TotalROI1',
								'chartfunction'=>'TotalROIBarchart',
								'getchart'=>$TotalROIFunction,
								'toptitle'=>'Total ROI According To Year',
								'leftitle'=>'Total ROI (%)',
								'divid'=>'cashFlow',
							);
							get_barchart_by_datas($TotalROIResult);
							?>
                        </div>
                        <div class="row margin0 marginbottom">
							<?php 
							/***************Barchart for Cash Flow/Mortgage Ratio**********/
								$CashFlowMortgageRatiochartFunction = cashFlowMortgageRatio('barchart','Year','');
								$CashFlowMortgageRatioResult = array(
									'maintitle'=>'Cash Flow/Mortgage (%)',
									'class1'=>'CashFlowMortgageRatio', 
									'toggleid'=>'CashFlowMortgageRatio1',
									'chartfunction'=>'CashFlowMortgageRatiochart',
									'getchart'=>$CashFlowMortgageRatiochartFunction,
									'toptitle'=>'Cash Flow/Mortgage Ratio According To Year',
									'leftitle'=>'Cash Flow/Mortgage (%)',
									'divid'=>'cashFlow',
								); 
                                get_barchart_by_datas($CashFlowMortgageRatioResult);
								?>
						</div> 	
						<div id="DynamicAppendGraph_cashFlow" class="AppendGraph"></div>
						</div>
						<!-- /*************************************************************************************************
						**********************************>DEBT SERVICES STARTS ******************************************
						**************************************************************************************************/ -->
						<div class="row margin0 marginbottom MainBarWrap">
						<h4 class="sectionTitle">Debt Service</h4>
						<div class="row margin0 marginbottom">
						<?php 
						/***************Barchart for Mortgage**********/
							$MortgageSecFunction = debtServiceMortgage('barchart','Year');
							$MortgageSecIncome = array(
								'maintitle'=>'Mortgage ($)',
								'class1'=>'MortgageSec', 
								'toggleid'=>'MortgageSec2',
								'chartfunction'=>'MortgageSeccchart',
								'getchart'=>$MortgageSecFunction,
								'toptitle'=>'Mortgage According To Year',
								'leftitle'=>'Mortgage ($)',
								'divid'=>'DebtService',
							);
							get_barchart_by_datas($MortgageSecIncome);
							/***************Barchart for Cumulative Interest**********/
							$CumulativeInterest = debtServiceCumulativeInterest('barchart','Year','');
							$CumulativeInterestResult = array(
								'maintitle'=>'Cumulative Interest ($)',
								'class1'=>'CumulativeInterest', 
								'toggleid'=>'CumulativeInterest1',
								'chartfunction'=>'CumulativeInterestchart',
								'getchart'=>$CumulativeInterest,
								'toptitle'=>'Cumulative Interest According To Year',
								'leftitle'=>'Cumulative Interest ($)',
								'divid'=>'DebtService',
							);
							get_barchart_by_datas($CumulativeInterestResult);
							/***************Barchart for Cumulative Equity**********/
							$CumulativeEquityFunction = debtServiceCumulativeEquity('barchart','Year','');
							$CumulativeEquityResult = array(
								'maintitle'=>'Cumulative Equity ($)',
								'class1'=>'CumulativeEquity', 
								'toggleid'=>'CumulativeEquity1',
								'chartfunction'=>'CumulativeEquitychart',
								'getchart'=>$CumulativeEquityFunction,
								'toptitle'=>'Cumulative Equity According To Year',
								'leftitle'=>'Cumulative Equity ($)',
								'divid'=>'DebtService',
							);
							get_barchart_by_datas($CumulativeEquityResult);
							/***************Barchart for Loan PayOff Amount**********/
							$LoanPayOffAmountFunction = debtServiceLoanPayOffAmount('barchart','Year','');
							$LoanPayOffAmountResult = array(
								'maintitle'=>'Loan PayOff Amount ($)',
								'class1'=>'LoanPayOffAmount', 
								'toggleid'=>'LoanPayOffAmount1',
								'chartfunction'=>'LoanPayOffAmountchart',
								'getchart'=>$LoanPayOffAmountFunction,
								'toptitle'=>'Loan PayOff Amount According To Year',
								'leftitle'=>'Loan PayOff Amount ($)',
								'divid'=>'DebtService',
							);
							get_barchart_by_datas($LoanPayOffAmountResult);
							?>
                        </div>	
						<div id="DynamicAppendGraph_DebtService" class="AppendGraph"></div>
						</div>
						<!-- /*************************************************************************************************
						**********************************>SELL STARTS ******************************************
						**************************************************************************************************/ -->
						<div class="row margin0 marginbottom MainBarWrap">
						<h4 class="sectionTitle">Sell</h4>
						<div class="row margin0 marginbottom">
						<?php 
						/***************Barchart for Selling Price**********/
							$SellingPriceFunction = sellSellingPrice('barchart','Year','');
							$SellingPriceResult = array(
								'maintitle'=>'Selling Price ($)',
								'class1'=>'SellingPrice', 
								'toggleid'=>'SellingPrice2',
								'chartfunction'=>'SellingPricechart',
								'getchart'=>$SellingPriceFunction,
								'toptitle'=>'Selling Price According To Year',
								'leftitle'=>'Selling Price ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($SellingPriceResult);
							/***************Barchart for Expense Of Sell**********/
							$ExpenseOfSellInterest = sellExpenseOfSell('barchart','Year','');
							$ExpenseOfSellResult = array(
								'maintitle'=>'Expense Of Sell ($)',
								'class1'=>'ExpenseOfSell', 
								'toggleid'=>'ExpenseOfSell1',
								'chartfunction'=>'ExpenseOfSellchart',
								'getchart'=>$ExpenseOfSellInterest,
								'toptitle'=>'Expense Of Sell According To Year',
								'leftitle'=>'Expense Of Sell ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($ExpenseOfSellResult);
							/***************Barchart for Gross Proceeds**********/
							$GrossProceedsFunction = sellGrossProceeds('barchart','Year','');
							$GrossProceedsResult = array(
								'maintitle'=>'Gross Proceeds ($)',
								'class1'=>'GrossProceeds', 
								'toggleid'=>'GrossProceeds1',
								'chartfunction'=>'GrossProceedschart',
								'getchart'=>$GrossProceedsFunction,
								'toptitle'=>'Gross Proceeds According To Year',
								'leftitle'=>'Gross Proceeds ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($GrossProceedsResult);
							/***************Barchart for Outstanding Debt**********/
							$OutstandingDebtFunction = debtServiceLoanPayOffAmount('barchart','Year','');
							$OutstandingDebtResult = array(
								'maintitle'=>'Outstanding Debt ($)',
								'class1'=>'OutstandingDebt', 
								'toggleid'=>'OutstandingDebt1',
								'chartfunction'=>'OutstandingDebtchart',
								'getchart'=>$OutstandingDebtFunction,
								'toptitle'=>'Outstanding Debt According To Year',
								'leftitle'=>'Outstanding Debt ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($OutstandingDebtResult);
							?>
                        </div>	
                        <div class="row margin0 marginbottom">
						<?php 
						/***************Barchart for Cash At Close**********/
							$CashAtCloseFunction = cashAtClose('','barchart','','Year','');
							$CashAtCloseResult = array(
								'maintitle'=>'Cash At Close ($)',
								'class1'=>'CashAtClose', 
								'toggleid'=>'CashAtClose1',
								'chartfunction'=>'CashAtClosechart',
								'getchart'=>$CashAtCloseFunction,
								'toptitle'=>'Cash At Close According To Year',
								'leftitle'=>'Cash At Close ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($CashAtCloseResult);
							/***************Barchart for Cumulative Depreciation**********/
							$CumulativeDepreciationInterest = sellCumulativeDepreciation('barchart','Year','');
							$CumulativeDepreciationResult = array(
								'maintitle'=>'Cumulative Depreciation ($)',
								'class1'=>'CumulativeDepreciation', 
								'toggleid'=>'CumulativeDepreciation1',
								'chartfunction'=>'CumulativeDepreciationchart',
								'getchart'=>$CumulativeDepreciationInterest,
								'toptitle'=>'Cumulative Depreciation According To Year',
								'leftitle'=>'Cumulative Depreciation ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($CumulativeDepreciationResult);
							/***************Barchart for Adjusted Basis**********/
							$AdjustedBasisFunction = sellAdjustedBasis('barchart','Year','');
							$AdjustedBasisResult = array(
								'maintitle'=>'Adjusted Basis ($)',
								'class1'=>'AdjustedBasis', 
								'toggleid'=>'AdjustedBasis1',
								'chartfunction'=>'AdjustedBasischart',
								'getchart'=>$AdjustedBasisFunction,
								'toptitle'=>'Adjusted Basis According To Year',
								'leftitle'=>'Adjusted Basis ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($AdjustedBasisResult);
							/***************Barchart for Taxable Gain**********/
							$TaxableGainFunction = cashAtClose('taxableGain','barchart','','Year','');
							$TaxableGainResult = array(
								'maintitle'=>'Taxable Gain ($)',
								'class1'=>'TaxableGain', 
								'toggleid'=>'TaxableGain1',
								'chartfunction'=>'TaxableGainchart',
								'getchart'=>$TaxableGainFunction,
								'toptitle'=>'Taxable Gain According To Year',
								'leftitle'=>'Taxable Gain ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($TaxableGainResult);
							?>
                        </div>	
                         <div class="row margin0 marginbottom">
                         <?php
                         	/***************Barchart for Taxable Appreciation**********/
							$TaxableAppreciationFunction = cashAtClose('taxableappreciation','barchart','','Year','');
							$TaxableAppreciationResult = array(
								'maintitle'=>'Taxable Appreciation ($)',
								'class1'=>'TaxableAppreciation', 
								'toggleid'=>'TaxableAppreciation1',
								'chartfunction'=>'TaxableAppreciationchart',
								'getchart'=>$TaxableAppreciationFunction,
								'toptitle'=>'Taxable Appreciation According To Year',
								'leftitle'=>'Taxable Appreciation ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($TaxableAppreciationResult);
							/***************Barchart for State Tax**********/
							$StateTaxFunction = cashAtClose('statetax','barchart','','Year','');
							$StateTaxResult = array(
								'maintitle'=>'State Tax ($)',
								'class1'=>'StateTax', 
								'toggleid'=>'StateTax1',
								'chartfunction'=>'StateTaxchart',
								'getchart'=>$StateTaxFunction,
								'toptitle'=>'State Tax According To Year',
								'leftitle'=>'State Tax ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($StateTaxResult);
							/***************Barchart for Federal Depreciation Tax**********/
							$FederalDepreciationTaxFunction = sellFederalDepreciationTax('barchart','Year','');
							$FederalDepreciationTaxResult = array(
								'maintitle'=>'Federal Depreciation Tax ($)',
								'class1'=>'FederalDepreciationTax', 
								'toggleid'=>'FederalDepreciationTax1',
								'chartfunction'=>'FederalDepreciationTaxchart',
								'getchart'=>$FederalDepreciationTaxFunction,
								'toptitle'=>'Federal Depreciation Tax According To Year',
								'leftitle'=>'Federal Depreciation Tax ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($FederalDepreciationTaxResult);
							/***************Barchart for Federal Appreciation Tax**********/
							$FederalAppreciationTaxFunction = cashAtClose('FederalAppreciationTax','barchart','','Year','');
							$FederalAppreciationTaxResult = array(
								'maintitle'=>'Federal Appreciation Tax ($)',
								'class1'=>'FederalAppreciationTax', 
								'toggleid'=>'FederalAppreciationTax1',
								'chartfunction'=>'FederalAppreciationTaxchart',
								'getchart'=>$FederalAppreciationTaxFunction,
								'toptitle'=>'Federal Appreciation Tax According To Year',
								'leftitle'=>'Federal Appreciation Tax ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($FederalAppreciationTaxResult);
							?>
							</div>	
                            <div class="row margin0 marginbottom">
                            <?php
							/***************Barchart for Total Tax**********/
							$TotalTaxFunction = cashAtClose('totalTax','barchart','','Year','');
							$TotalTaxResult = array(
								'maintitle'=>'Total Tax ($)',
								'class1'=>'TotalTax', 
								'toggleid'=>'TotalTax1',
								'chartfunction'=>'TotalTaxTaxchart',
								'getchart'=>$TotalTaxFunction,
								'toptitle'=>'Total Tax According To Year',
								'leftitle'=>'Total Tax ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($TotalTaxResult);
							/***************Barchart for Net To Seller**********/
							$NetToSellerFunction = cashAtClose('NetToSeller','barchart','','Year','');
							$NetToSellerResult = array(
								'maintitle'=>'Net To Seller ($)',
								'class1'=>'NetToSeller', 
								'toggleid'=>'NetToSeller1',
								'chartfunction'=>'NetToSellerchart',
								'getchart'=>$NetToSellerFunction,
								'toptitle'=>'Net To Seller According To Year',
								'leftitle'=>'Net To Seller ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($NetToSellerResult);
							/***************Barchart for Net Minus Outlay**********/
							$NetMinusOutlayFunction = cashAtClose('NetMinusOutlay','barchart','','Year','');
							$NetMinusOutlayResult = array(
								'maintitle'=>'Net Minus Outlay ($)',
								'class1'=>'NetMinusOutlay', 
								'toggleid'=>'NetMinusOutlay1',
								'chartfunction'=>'NetMinusOutlaychart',
								'getchart'=>$NetMinusOutlayFunction,
								'toptitle'=>'Net Minus Outlay According To Year',
								'leftitle'=>'Net Minus Outlay ($)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($NetMinusOutlayResult);
							/***************Barchart for Net ROI After Sell**********/
							$NetROIAfterSellFunction = cashAtClose('NetROIAfterSell','barchart','','Year','');
							$NetROIAfterSellResult = array(
								'maintitle'=>'Net ROI After Sell (%)',
								'class1'=>'NetROIAfterSell', 
								'toggleid'=>'NetROIAfterSell1',
								'chartfunction'=>'NetROIAfterSellchart',
								'getchart'=>$NetROIAfterSellFunction,
								'toptitle'=>'Net ROI After Sell According To Year',
								'leftitle'=>'Net ROI After Sell (%)',
								'divid'=>'sell',
							);
							get_barchart_by_datas($NetROIAfterSellResult);
							?>
							</div>
						<div id="DynamicAppendGraph_sell" class="AppendGraph"></div>
						</div>
				</div>
			</div>
		</div><!-- GraphsBar div ends-->
			<div class="lastbtnWrapper">
			<?php if($data->status != 1){ ?>
				<form action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="status" value="1">
					<input value="SAVE RESULT" class="submit_btn-cal visulise_btn submit_total_result" name="totalresult" type="submit">
				</form>
			<?php }else{ ?>
				<a class="visulise_btn submit_total_result" href="<?php echo site_url().'/your-profile'; ?>">Go To Profile</a>
			<?php }	?>
			
			<form method="POST" action="" name="changevalues">
				<input value="CHANGE" class="submit_btn-cal submit_btn-cal visulise_btn submit_total_result" name="changevalue" type="submit">
			</form>
			</div>
			
	</div>
</div>
</div>
<?php

	if(isset($_POST['totalresult'])){
		global $wpdb;
		$id = base64_decode($_GET['id']);
		$name = $_POST['status'];
		echo "<meta http-equiv='refresh' content='0'>";
		$wpdb->update( 'wp_calculator', array('status' => $name), array( 'id' => $id));
		$lastid = base64_encode($id);
		wp_redirect(get_the_permalink('107')."/?id=$lastid");
		exit();
	}
	
?>		
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.heading_details .fa-plus, .mainPanel_title .fa-plus, .heading_details .fa-minus, .mainPanel_title .fa-minus').click(function(){
		jQuery(this).toggleClass('fa-plus')
		jQuery(this).toggleClass('fa-minus')
	});
	jQuery('#rentalincome1').trigger('click');
	jQuery('#rentalincome1').attr('checked');
});
</script>
<style>
.placeholder {
  font-size: 16px;
  position: relative;
}
.content-area.container {
  max-width: 1366px;
  width: 100%;
}
.visulise_btn.submit_total_result {
  display: block;
  float: none !important;
  margin: 0 auto !important;
  text-align: center;
}
a.visulise_btn.submit_total_result {
  display: block;
  max-width:215px;
  width:100%;
  float: none !important;
  margin: 0 auto !important;
  text-align: center;
}
.summaryofresults {
  display: inherit;
  float: none !important;
  margin: 0 auto !important;
  max-width: 1170px;
  padding: 10px;
  width: 100%;
}

.placeholder::after {
  content: attr(data-placeholder);
  right: 40px;
  pointer-events: none;
  position: absolute;
  top: 48px;
  color:black !important;
}
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  color: pink!important;
  float:right!important;
}
::-moz-placeholder { /* Firefox 19+ */
  color: pink!important;
  float:right!important;
}
:-ms-input-placeholder { /* IE 10+ */
  color: pink!important;
  float:right!important;
}
:-moz-placeholder { /* Firefox 18- */
  color: pink!important;
  float:right!important;
}
.main-form .form-group{position:relative;}
.main-form .form-group input+label+.fa,
.main-form .form-group input + .fa {
	  font-size: 17px;
  left: 21px;
  position: absolute;
  top: 50px;
  z-index: 9999;
}

.main-form .form-control {
  padding: 6px 20px!important;
 
}
#calculaterealestate .error {
  color: #dc0f1e !important;
}
#myModal .modal-dialog, #myModal1 .modal-dialog, #myModal2 .modal-dialog, #myModal3 .modal-dialog, #myModal4 .modal-dialog{
  max-width: 735px;
  width: 100%;
}
#myModal .modal-title, #myModal1 .modal-title, #myModal2 .modal-title, #myModal3 .modal-title, #myModal4 .modal-title{
	text-align:center;
}
#myModal .modal-body, #myModal1 .modal-body, #myModal2 .modal-body, #myModal3 .modal-body, #myModal4 .modal-body{
  overflow-y: hidden;
}

.summaryofresults {
  border: none;
   max-width: 1139px;
}
.summaryofresults h4{
	margin-bottom:0;
}
.mainPanel_container {
  background-color: #ffffff !important;
  border-bottom: 1px solid #dddddd;
  max-width: 1140px;
}
.mainPanel_title {
  color: #000000;
  font-family: "RubikRegular";
  font-size: 24px;
  padding: 13px 15px;
}
.mainPanel_title h4 > i {
  border: 2px solid;
  border-radius: 50px;
  cursor: pointer;
  display: block;
  float: right;
  height: 34px;
  line-height: 30px;
  text-align: center;
  width: 34px;
  font-size: 16px;
}
.mainPanel_title h4::after {
  border: 1px solid #ea0011;
  bottom: 0;
  content: "";
  left: 0;
  position: absolute;
  width: 45px;
  z-index: 99;
}
.mainPanel_title h4 {
  color: #000000;
  font-family: "RubikRegular";
  font-size: 24px;
  margin-bottom: 0px;
	padding-bottom: 10px;
  position: relative;
}
.pad0{
	padding-left:0px;
	padding-right:0px;
}
.marginAuto{margin:0 auto;}
#mainpanel{
	width:100%;
}
</style>						
<?php 

}	 

get_footer();

?>						