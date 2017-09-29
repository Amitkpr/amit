<?php
/**
 * Template Name: Online Real Estate Calculator
 *
 */
get_header(); 

if(!is_user_logged_in()){
	wp_redirect(site_url().'/wp-admin');
}
/* pt(base64_decode($_GET['id'])); */
?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMrFJCY6VldvwPWn9zB1q417eTS7gNno&libraries=places"></script>
	
	<script>
	function initialize() {
		
	  var input = document.getElementById('propertyAddress');
	  var options = {
		types: ['address'],
		componentRestrictions: {
		  country: 'us'
		}
	  };
	  autocomplete = new google.maps.places.Autocomplete(input, options);
	  google.maps.event.addListener(autocomplete, 'place_changed', function() {
		
		var place = autocomplete.getPlace();
	/* 	var lat = place.geometry.location.lat();
		var lng = place.geometry.location.lng();
		var city = place.vicinity;
		document.getElementById('city').value = city;
		document.getElementById('lat').value = lat;
		document.getElementById('lng').value = lng; */
		/* for (var i = 0; i < place.address_components.length; i++) {
		  for (var j = 0; j < place.address_components[i].types.length; j++) {
			if (place.address_components[i].types[j] == "postal_code") {
			  document.getElementById('zipcode').value = place.address_components[i].long_name;
			}else{
				document.getElementById('zipcode').value = '';
			}
		  }
		} */
	  })
	}
	google.maps.event.addDomListener(window, "load", initialize);
	</script>
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
		
		<div class="custom_online_calculations">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="row">
				
				<?php
				
				$role = user_role();
				$adminID = $current_user->ID;
				$results = "SELECT * FROM wp_default_calculator";
				$result = $wpdb->get_row($results);
				$allvalues = unserialize($result->userinput);
					
					if(isset($_REQUEST['calculatemainsubmit'])){
					
						
						/* $price = str_replace(',','',$_REQUEST['purchaseprice']);
						$upfrontimprovement = str_replace(',','',$_REQUEST['upfrontimprovement']);
						$monthlyrent = str_replace(',','',$_REQUEST['monthlyrent']);
						
						$price = str_replace(',','',$_REQUEST['purchaseprice']);
						$upfrontimprovement = str_replace(',','',$_REQUEST['upfrontimprovement']);
						$monthlyrent = str_replace(',','',$_REQUEST['monthlyrent']);
						
						pt($price);
						pt($upfrontimprovement);*/
						
						
						$propertyName = $_REQUEST['propertyName'];						 
						$propertyAddress = $_REQUEST['propertyAddress'];						 
						$purchasePrice = $_REQUEST['purchaseprice'];						 
						$upfrontImprovement = $_REQUEST['upfrontimprovement'];						
						$closingCost = $_REQUEST['closingcost'];	
						$downPayment = $_REQUEST['downpayment'];						
						$interestRate = $_REQUEST['interestrate'];						
						$mortgageYears= $_REQUEST['mortgageyears'];	
						$monthlyRent= $_REQUEST['monthlyrent'];	
						$vacancyRate= $_REQUEST['vacancyrate'];	
						$expropertyTaxes= $_REQUEST['expropertytaxes'];	
						$Exinsurance= $_REQUEST['exinsurance'];	
						$Exrepairs= $_REQUEST['exrepairs'];	
						$Exutilities= $_REQUEST['exutilities'];	
						$expropertyMgmt= $_REQUEST['expropertymgmt'];	
						$Exhoa= $_REQUEST['exhoa'];	
						$Exother= $_REQUEST['exother'];	
						$Exotherfixed= $_REQUEST['exotherfixed'];	
						$Marginaltaxrate= $_REQUEST['marginaltaxrate'];	
						$amortizationPeriodYears= $_REQUEST['amortizationperiodyears'];	
						$annualAppreciation= $_REQUEST['annualappreciation'];	
						$annualrentIncrease= $_REQUEST['annualrentincrease'];	
						$annualOprating= $_REQUEST['annualoprating'];	
						$sellHoldingPeriod= $_REQUEST['sellholdingperiod'];	
						$sellTransactionCost= $_REQUEST['selltransactioncost'];	
						$sellCapitalGain= $_REQUEST['sellcapitalgain'];	
						$sellDepreciationRecap= $_REQUEST['selldepreciationrecap'];	
						$sellStateTax= $_REQUEST['sellstatetax'];	
						$calculateMainSubmit= $_REQUEST['calculatemainsubmit'];	


						$error_msg = array(); /* initializing the $error */
						$idErr = $propertyNameErr = $propertyAddressErr = $purchasepriceErr = $upfrontimprovementErr = $closingcostErr = $downpaymentErr = $interestrateErr = $mortgageyearsErr = $monthlyRentErr = $vacancyRateErr = $expropertyTaxesErr = $ExinsuranceErr = $ExrepairsErr = $ExutilitiesErr = $expropertyMgmtErr = $ExhoaErr = $ExotherErr = $ExotherfixedErr = $MarginaltaxrateErr = $amortizationPeriodYearsErr = $annualAppreciationErr = $annualrentIncreaseErr = $annualOpratingErr = $sellHoldingPeriodErr = $sellTransactionCostErr = $sellCapitalGainErr = $sellDepreciationRecapErr = $sellStateTaxErr = $calculatemainsubmitErr = "";
						
						
						$idvalue = $propertyNameValue = $propertyAddressValue = $purchasepriceValue = $upfrontimprovementValue = $closingcostValue = $downpaymentValue = $interestrateValue = $mortgageyearsValue = $monthlyRentValue = $vacancyRateValue = $expropertyTaxesValue = $ExinsuranceValue = $ExrepairsValue = $ExutilitiesValue = $expropertyMgmtValue = $ExhoaValue = $ExotherValue = $ExotherfixedValue = $MarginaltaxrateValue = $amortizationPeriodYearsValue = $annualAppreciationValue = $annualrentIncreaseValue = $annualOpratingValue = $sellHoldingPeriodValue = $sellTransactionCostValue = $sellCapitalGainValue = $sellDepreciationRecapValue = $sellStateTaxValue = $calculatemainsubmitValue = "";

						if(empty($propertyName)){
							$error_msg[] = "Please enter your property name";
							$propertyNameErr = "Please enter your property name";
						}else{
							$propertyNameValue = $propertyName;	
						}

						if(empty($propertyAddress)){
							$error_msg[] = "Please enter your address";
							$propertyAddressErr = "Please enter your address";
						}else{
							$propertyAddressValue = $propertyAddress;	
						}
						
						if(empty($purchasePrice)){
							$error_msg[] = "Please enter your purchase price";
							$purchasepriceErr = "Please enter your purchase price";
						}else{
							$purchasepriceValue = $purchasePrice;	
						}
					
						if(empty($upfrontImprovement)){
							$error_msg[] = "Please enter your upfront improvement";
							$upfrontimprovementErr = "Please enter your upfront improvement";
						}else{
							$upfrontimprovementValue = $upfrontImprovement;	
						}
						
						if(empty($closingCost)){
							$error_msg[] = "Please enter your closing cost";
							$closingcostErr = "Please enter your closing cost";
						}else{
							$closingcostValue = $upfrontImprovement;	
						}
						
						
						if(empty($downPayment)){
							$error_msg[] = "Please enter your down payment";
							$downPaymentErr = "Please enter your down payment";
						}else{
							$downpaymentValue = $downPayment;	
						}
						
						if(empty($mortgageYears)){
							$error_msg[] = "Please enter your mortgage years";
							$mortgageyearsErr = "Please enter your mortgage years";
						}else{
							$mortgageyearsValue = $mortgageYears;	
						}
						
						if(empty($interestRate)){
							$error_msg[] = "Please enter your interest rate";
							$interestrateErr = "Please enter your interest rate";
						}else{
							$interestrateValue = $interestRate;	
						}
						
						if(empty($monthlyRent)){
							$error_msg[] = "Please enter your monthly rent";
							$monthlyRentErr = "Please enter your monthly rent";
						}else{
							$monthlyRentValue = $monthlyRent;	
						}
						
						if(empty($vacancyRate)){
							$error_msg[] = "Please enter your vacancy rate";
							$vacancyRateErr = "Please enter your vacancy rate";
						}else{
							$vacancyRateValue = $vacancyRate;	
						}
						
						if(empty($expropertyTaxes)){
							$error_msg[] = "Please enter your property taxes";
							$expropertyTaxesErr = "Please enter your property taxes";
						}else{
							$expropertyTaxesValue = $expropertyTaxes;	
						}
						
						if(empty($Exinsurance)){
							$error_msg[] = "Please enter your insurance";
							$ExinsuranceErr = "Please enter your insurance";
						}else{
							$ExinsuranceValue = $Exinsurance;	
						}
						
						if(empty($Exrepairs)){
							$error_msg[] = "Please enter your repairs";
							$ExrepairsErr = "Please enter your repairs";
						}else{
							$ExrepairsValue = $Exrepairs;	
						}
						
						if((empty($Exutilities)) && ($Exutilities != 0)){
							$error_msg[] = "Please enter your utilities";
							$ExutilitiesErr = "Please enter your utilities";
						}else{
							$ExutilitiesValue = $Exutilities;	
						}
						
						if(empty($expropertyMgmt)){
							$error_msg[] = "Please enter your property mgmt fee";
							$expropertyMgmtErr = "Please enter your property mgmt fee";
						}else{
							$expropertyMgmtValue = $expropertyMgmt;	
						}
						
						if(empty($Exhoa)){
							$error_msg[] = "Please enter your hoa";
							$ExhoaErr = "Please enter your hoa";
						}else{
							$ExhoaValue = $Exhoa;	
						}
						
						if(empty($Exother)){
							$error_msg[] = "Please enter your other";
							$ExotherErr = "Please enter your other";
						}else{
							$ExotherValue = $Exother;	
						}
						
						if(empty($Exother)){
							$error_msg[] = "Please enter your other";
							$ExotherErr = "Please enter your other";
						}else{
							$ExotherValue = $Exother;	
						}
						
						if(empty($Exotherfixed)){
							$error_msg[] = "Please enter your other fixed cost";
							$ExotherfixedErr = "Please enter your other fixed cost";
						}else{
							$ExotherfixedValue = $Exotherfixed;	
						}
						
						if(empty($Marginaltaxrate)){
							$error_msg[] = "Please enter your marginal tax rate";
							$MarginaltaxrateErr = "Please enter your marginal tax rate";
						}else{
							$MarginaltaxrateValue = $Marginaltaxrate;	
						}
						
						if(empty($amortizationPeriodYears)){
							$error_msg[] = "Please enter your amortization period years";
							$amortizationPeriodYearsErr = "Please enter your amortization period years";
						}else{
							$amortizationPeriodYearsValue = $amortizationPeriodYears;	
						}
						
						if(empty($annualAppreciation)){
							$error_msg[] = "Please enter your appreciation";
							$annualAppreciationErr = "Please enter your appreciation";
						}else{
							$annualAppreciationValue = $annualAppreciation;	
						}
						
						if(empty($annualrentIncrease)){
							$error_msg[] = "Please enter your rent increase";
							$annualrentIncreaseErr = "Please enter your rent increase";
						}else{
							$annualrentIncreaseValue = $annualrentIncrease;	
						}
						
						if(empty($annualOprating)){
							$error_msg[] = "Please enter your operating expense increase";
							$annualOpratingErr = "Please enter your operating expense increase";
						}else{
							$annualOpratingValue = $annualOprating;	
						}
						
						/*if(empty($sellHoldingPeriod)){
							$error_msg[] = "Please enter your holding period";
							$sellHoldingPeriodErr = "Please enter your holding period";
						}else{
							$sellHoldingPeriodValue = $sellHoldingPeriod;	
						}*/
						
						if(empty($sellTransactionCost)){
							$error_msg[] = "Please enter your selling transaction cost";
							$sellTransactionCostErr = "Please enter your selling transaction cost";
						}else{
							$sellTransactionCostValue = $sellTransactionCost;	
						}
						
						if(empty($sellCapitalGain)){
							$error_msg[] = "Please enter your capital gains tax rate";
							$sellCapitalGainErr = "Please enter your capital gains tax rate";
						}else{
							$sellCapitalGainValue = $sellCapitalGain;	
						}
						
						if(empty($sellDepreciationRecap)){
							$error_msg[] = "Please enter your depreciation recap tax rate";
							$sellDepreciationRecapErr = "Please enter your depreciation recap tax rate";
						}else{
							$sellDepreciationRecapValue = $sellDepreciationRecap;	
						}
						
						if(empty($sellStateTax)){
							$error_msg[] = "Please enter your depreciation recap tax rate";
							$sellStateTaxErr = "Please enter your depreciation recap tax rate";
						}else{
							$sellStateTaxSValue = $sellStateTax;	
						}
						
						/* pt($error_msg);
						die;  */	
						if(count($error_msg)==0){
							global $wpdb;
							
							$price = str_replace(',','',$_REQUEST['purchaseprice']);
							$upfrontimprovement = str_replace(',','',$_REQUEST['upfrontimprovement']);
							$monthlyrent = str_replace(',','',$_REQUEST['monthlyrent']);
							$exinsurance = str_replace(',','',$_REQUEST['exinsurance']);
							$exutilities = str_replace(',','',$_REQUEST['exutilities']);
							$exhoa = str_replace(',','',$_REQUEST['exhoa']);
							$exotherfixed = str_replace(',','',$_REQUEST['exotherfixed']);
							
							$valuesArray = array(	
								'propertyName' => $_REQUEST['propertyName'],						 
								'propertyAddress' => $_REQUEST['propertyAddress'],						 
								'purchaseprice' => $price,						 
								'upfrontimprovement' => $upfrontimprovement,						
								'closingcost' => $_REQUEST['closingcost'],	
								'downpayment' => $_REQUEST['downpayment'],						
								'interestrate' => $_REQUEST['interestrate'],						
								'mortgageyears' => $_REQUEST['mortgageyears'],	
								'monthlyrent' => $monthlyrent,	
								'vacancyrate' => $_REQUEST['vacancyrate'],	
								'expropertytaxes' => $_REQUEST['expropertytaxes'],	
								'exinsurance' => $exinsurance,	
								'exrepairs' => $_REQUEST['exrepairs'],	
								'exutilities' => $exutilities,	
								'expropertymgmt' => $_REQUEST['expropertymgmt'],	
								'exhoa' => $exhoa,	
								'exother' => $_REQUEST['exother'],	
								'exotherfixed' => $exotherfixed,	
								'marginaltaxrate' => $_REQUEST['marginaltaxrate'],	
								'amortizationperiodyears' => $_REQUEST['amortizationperiodyears'],	
								'annualappreciation' => $_REQUEST['annualappreciation'],	
								'annualrentincrease' => $_REQUEST['annualrentincrease'],	
								'annualoprating' => $_REQUEST['annualoprating'],	
								'sellholdingperiod' => $_REQUEST['sellholdingperiod'],	
								'selltransactioncost' => $_REQUEST['selltransactioncost'],	
								'sellcapitalgain' => $_REQUEST['sellcapitalgain'],	
								'selldepreciationrecap' => $_REQUEST['selldepreciationrecap'],	
								'sellstatetax'=> $_REQUEST['sellstatetax'],	
								'calculatemainsubmit'=> $_REQUEST['calculatemainsubmit'],	
							);	
						
							$data = array(
								'user_id'=>get_current_user_ID(),
								'userinput'=>serialize($valuesArray),
								'status'=>0,
								'created_date'=> date('Y-m-d H:i:s'),
								'modified_date'=>date('Y-m-d H:i:s'),
							);
							$wpdb->insert( 'wp_calculator', $data, array( '%d', '%s','%s','%s','%s' ) );
							$lastid = base64_encode($wpdb->insert_id);
							
							wp_redirect(get_the_permalink('107')."/?id=$lastid");
						
						}
					} 
					if(isset($_GET['price']) && $_GET['price'] !=''){
						
						$prices = str_replace(',','',$_GET['price']);
						
						$mainPrice = base64_decode($prices);
					}else{
						$mainPrice = '';
					}
					
					if(isset($_GET['downpayment']) && $_GET['downpayment'] !=''){
						$mainDownpayment = base64_decode($_GET['downpayment']);
					}else{
						$mainDownpayment = '';
					}
					
					if(isset($_GET['id']) && $_GET['id'] !='' && isset($_GET['update']) && $_GET['update'] =='true' ){
						
						
						
						$id = base64_decode($_GET['id']);
						global $wpdb;
						$get_data = "SELECT * FROM wp_calculator WHERE id = '".$id."'";
						$data = $wpdb->get_row($get_data);
						$alldataRasult = unserialize($data->userinput); 
						$SavedData = unserialize($data->userinput); 
						/* pt($SavedData); */
						$SpropertyName = $SavedData['propertyName'];
						$SpropertyAddress = $SavedData['propertyAddress'];
						$Spurchaseprice = $SavedData['purchaseprice'];
						$Supfrontimprovement = $SavedData['upfrontimprovement'];
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
					}
/************************************************************************************************************************************
*****************************************UPDATE CALCULATIONS*************************************************************************
************************************************************************************************************************************/
if(isset($_REQUEST['updateMainSubmit'])){
						/* pt($_REQUEST); */
						/* die; */
						
						$hiddenInputID = $_REQUEST['hiddenInputID'];						 
						$propertyName = $_REQUEST['propertyName'];						 
						$propertyAddress = $_REQUEST['propertyAddress'];						 
						$purchasePrice = $_REQUEST['purchaseprice'];						 
						$upfrontImprovement = $_REQUEST['upfrontimprovement'];						
						$closingCost = $_REQUEST['closingcost'];	
						$downPayment = $_REQUEST['downpayment'];						
						$interestRate = $_REQUEST['interestrate'];						
						$mortgageYears= $_REQUEST['mortgageyears'];	
						$monthlyRent= $_REQUEST['monthlyrent'];	
						$vacancyRate= $_REQUEST['vacancyrate'];	
						$expropertyTaxes= $_REQUEST['expropertytaxes'];	
						$Exinsurance= $_REQUEST['exinsurance'];	
						$Exrepairs= $_REQUEST['exrepairs'];	
						$Exutilities= $_REQUEST['exutilities'];	
						$expropertyMgmt= $_REQUEST['expropertymgmt'];	
						$Exhoa= $_REQUEST['exhoa'];	
						$Exother= $_REQUEST['exother'];	
						$Exotherfixed= $_REQUEST['exotherfixed'];	
						$Marginaltaxrate= $_REQUEST['marginaltaxrate'];	
						$amortizationPeriodYears= $_REQUEST['amortizationperiodyears'];	
						$annualAppreciation= $_REQUEST['annualappreciation'];	
						$annualrentIncrease= $_REQUEST['annualrentincrease'];	
						$annualOprating= $_REQUEST['annualoprating'];	
						$sellHoldingPeriod= $_REQUEST['sellholdingperiod'];	
						$sellTransactionCost= $_REQUEST['selltransactioncost'];	
						$sellCapitalGain= $_REQUEST['sellcapitalgain'];	
						$sellDepreciationRecap= $_REQUEST['selldepreciationrecap'];	
						$sellStateTax= $_REQUEST['sellstatetax'];	
						$calculateMainSubmit= $_REQUEST['calculatemainsubmit'];	


						$error_msg = array(); /* initializing the $error */
						$idErr = $propertyNameErr = $propertyAddressErr = $purchasepriceErr = $upfrontimprovementErr = $closingcostErr = $downpaymentErr = $interestrateErr = $mortgageyearsErr = $monthlyRentErr = $vacancyRateErr = $expropertyTaxesErr = $ExinsuranceErr = $ExrepairsErr = $ExutilitiesErr = $expropertyMgmtErr = $ExhoaErr = $ExotherErr = $ExotherfixedErr = $MarginaltaxrateErr = $amortizationPeriodYearsErr = $annualAppreciationErr = $annualrentIncreaseErr = $annualOpratingErr = $sellHoldingPeriodErr = $sellTransactionCostErr = $sellCapitalGainErr = $sellDepreciationRecapErr = $sellStateTaxErr = $calculatemainsubmitErr = "";
						
						
						$idvalue = $propertyNameValue = $propertyAddressValue = $purchasepriceValue = $upfrontimprovementValue = $closingcostValue = $downpaymentValue = $interestrateValue = $mortgageyearsValue = $monthlyRentValue = $vacancyRateValue = $expropertyTaxesValue = $ExinsuranceValue = $ExrepairsValue = $ExutilitiesValue = $expropertyMgmtValue = $ExhoaValue = $ExotherValue = $ExotherfixedValue = $MarginaltaxrateValue = $amortizationPeriodYearsValue = $annualAppreciationValue = $annualrentIncreaseValue = $annualOpratingValue = $sellHoldingPeriodValue = $sellTransactionCostValue = $sellCapitalGainValue = $sellDepreciationRecapValue = $sellStateTaxValue = $calculatemainsubmitValue = "";

						if(empty($propertyName)){
							$error_msg[] = "Please enter your property name";
							$propertyNameErr = "Please enter your property name";
						}else{
							$propertyNameValue = $propertyName;	
						}

						if(empty($propertyAddress)){
							$error_msg[] = "Please enter your address";
							$propertyAddressErr = "Please enter your address";
						}else{
							$propertyAddressValue = $propertyAddress;	
						}
						
						if(empty($purchasePrice)){
							$error_msg[] = "Please enter your purchase price";
							$purchasepriceErr = "Please enter your purchase price";
						}else{
							$purchasepriceValue = $purchasePrice;	
						}
					
						if(empty($upfrontImprovement)){
							$error_msg[] = "Please enter your upfront improvement";
							$upfrontimprovementErr = "Please enter your upfront improvement";
						}else{
							$upfrontimprovementValue = $upfrontImprovement;	
						}
						
						if(empty($closingCost)){
							$error_msg[] = "Please enter your closing cost";
							$closingcostErr = "Please enter your closing cost";
						}else{
							$closingcostValue = $closingCost;	
						}
						
						
						if(empty($downPayment)){
							$error_msg[] = "Please enter your down payment";
							$downPaymentErr = "Please enter your down payment";
						}else{
							$downpaymentValue = $downPayment;	
						}
						
						if(empty($mortgageYears)){
							$error_msg[] = "Please enter your mortgage years";
							$mortgageyearsErr = "Please enter your mortgage years";
						}else{
							$mortgageyearsValue = $mortgageYears;	
						}
						
						if(empty($interestRate)){
							$error_msg[] = "Please enter your interest rate";
							$interestrateErr = "Please enter your interest rate";
						}else{
							$interestrateValue = $interestRate;	
						}
						
						if(empty($monthlyRent)){
							$error_msg[] = "Please enter your monthly rent";
							$monthlyRentErr = "Please enter your monthly rent";
						}else{
							$monthlyRentValue = $monthlyRent;	
						}
						
						if(empty($vacancyRate)){
							$error_msg[] = "Please enter your vacancy rate";
							$vacancyRateErr = "Please enter your vacancy rate";
						}else{
							$vacancyRateValue = $vacancyRate;	
						}
						
						if(empty($expropertyTaxes)){
							$error_msg[] = "Please enter your property taxes";
							$expropertyTaxesErr = "Please enter your property taxes";
						}else{
							$expropertyTaxesValue = $expropertyTaxes;	
						}
						
						if(empty($Exinsurance)){
							$error_msg[] = "Please enter your insurance";
							$ExinsuranceErr = "Please enter your insurance";
						}else{
							$ExinsuranceValue = $Exinsurance;	
						}
						
						if(empty($Exrepairs)){
							$error_msg[] = "Please enter your repairs";
							$ExrepairsErr = "Please enter your repairs";
						}else{
							$ExrepairsValue = $Exrepairs;	
						}
						
						if((empty($Exutilities)) && ($Exutilities != 0)){
							$error_msg[] = "Please enter your utilities";
							$ExutilitiesErr = "Please enter your utilities";
						}else{
							$ExutilitiesValue = $Exutilities;	
						}
						
						if(empty($expropertyMgmt)){
							$error_msg[] = "Please enter your property mgmt fee";
							$expropertyMgmtErr = "Please enter your property mgmt fee";
						}else{
							$expropertyMgmtValue = $expropertyMgmt;	
						}
						
						if(empty($Exhoa)){
							$error_msg[] = "Please enter your hoa";
							$ExhoaErr = "Please enter your hoa";
						}else{
							$ExhoaValue = $Exhoa;	
						}
						
						if(empty($Exother)){
							$error_msg[] = "Please enter your other";
							$ExotherErr = "Please enter your other";
						}else{
							$ExotherValue = $Exother;	
						}
						
						if(empty($Exother)){
							$error_msg[] = "Please enter your other";
							$ExotherErr = "Please enter your other";
						}else{
							$ExotherValue = $Exother;	
						}
						
						if(empty($Exotherfixed)){
							$error_msg[] = "Please enter your other fixed cost";
							$ExotherfixedErr = "Please enter your other fixed cost";
						}else{
							$ExotherfixedValue = $Exotherfixed;	
						}
						
						if(empty($Marginaltaxrate)){
							$error_msg[] = "Please enter your marginal tax rate";
							$MarginaltaxrateErr = "Please enter your marginal tax rate";
						}else{
							$MarginaltaxrateValue = $Marginaltaxrate;	
						}
						
						if(empty($amortizationPeriodYears)){
							$error_msg[] = "Please enter your amortization period years";
							$amortizationPeriodYearsErr = "Please enter your amortization period years";
						}else{
							$amortizationPeriodYearsValue = $amortizationPeriodYears;	
						}
						
						if(empty($annualAppreciation)){
							$error_msg[] = "Please enter your appreciation";
							$annualAppreciationErr = "Please enter your appreciation";
						}else{
							$annualAppreciationValue = $annualAppreciation;	
						}
						
						if(empty($annualrentIncrease)){
							$error_msg[] = "Please enter your rent increase";
							$annualrentIncreaseErr = "Please enter your rent increase";
						}else{
							$annualrentIncreaseValue = $annualrentIncrease;	
						}
						
						if(empty($annualOprating)){
							$error_msg[] = "Please enter your operating expense increase";
							$annualOpratingErr = "Please enter your operating expense increase";
						}else{
							$annualOpratingValue = $annualOprating;	
						}
						
						/*if(empty($sellHoldingPeriod)){
							$error_msg[] = "Please enter your holding period";
							$sellHoldingPeriodErr = "Please enter your holding period";
						}else{
							$sellHoldingPeriodValue = $sellHoldingPeriod;	
						}*/
						
						if(empty($sellTransactionCost)){
							$error_msg[] = "Please enter your selling transaction cost";
							$sellTransactionCostErr = "Please enter your selling transaction cost";
						}else{
							$sellTransactionCostValue = $sellTransactionCost;	
						}
						
						if(empty($sellCapitalGain)){
							$error_msg[] = "Please enter your capital gains tax rate";
							$sellCapitalGainErr = "Please enter your capital gains tax rate";
						}else{
							$sellCapitalGainValue = $sellCapitalGain;	
						}
						
						if(empty($sellDepreciationRecap)){
							$error_msg[] = "Please enter your depreciation recap tax rate";
							$sellDepreciationRecapErr = "Please enter your depreciation recap tax rate";
						}else{
							$sellDepreciationRecapValue = $sellDepreciationRecap;	
						}
						
						if(empty($sellStateTax)){
							$error_msg[] = "Please enter your depreciation recap tax rate";
							$sellStateTaxErr = "Please enter your depreciation recap tax rate";
						}else{
							$sellStateTaxSValue = $sellStateTax;	
						}
					
						if(count($error_msg)==0){
							
							$price = str_replace(',','',$_REQUEST['purchaseprice']);
							/* $upfrontimprovement = $_REQUEST['upfrontimprovement']; */
							$monthlyrent = str_replace(',','',$_REQUEST['monthlyrent']);
							$exinsurance = str_replace(',','',$_REQUEST['exinsurance']);
							$exutilities = str_replace(',','',$_REQUEST['exutilities']);
							$exhoa = str_replace(',','',$_REQUEST['exhoa']);
							$exotherfixed = str_replace(',','',$_REQUEST['exotherfixed']);
							
							$valuesArray = array(	
								'propertyName' => $_REQUEST['propertyName'],						 
								'propertyAddress' => $_REQUEST['propertyAddress'],						 
								'purchaseprice' => $price,						 
								'upfrontimprovement' => $_REQUEST['upfrontimprovement'],						
								'closingcost' => $_REQUEST['closingcost'],	
								'downpayment' => $_REQUEST['downpayment'],						
								'interestrate' => $_REQUEST['interestrate'],						
								'mortgageyears' => $_REQUEST['mortgageyears'],	
								'monthlyrent' => $monthlyrent,	
								'vacancyrate' => $_REQUEST['vacancyrate'],	
								'expropertytaxes' => $_REQUEST['expropertytaxes'],	
								'exinsurance' => $exinsurance,	
								'exrepairs' => $_REQUEST['exrepairs'],	
								'exutilities' => $exutilities,	
								'expropertymgmt' => $_REQUEST['expropertymgmt'],	
								'exhoa' => $exhoa,	
								'exother' => $_REQUEST['exother'],	
								'exotherfixed' => $exotherfixed,	
								'marginaltaxrate' => $_REQUEST['marginaltaxrate'],	
								'amortizationperiodyears' => $_REQUEST['amortizationperiodyears'],	
								'annualappreciation' => $_REQUEST['annualappreciation'],	
								'annualrentincrease' => $_REQUEST['annualrentincrease'],	
								'annualoprating' => $_REQUEST['annualoprating'],	
								'sellholdingperiod' => $_REQUEST['sellholdingperiod'],	
								'selltransactioncost' => $_REQUEST['selltransactioncost'],	
								'sellcapitalgain' => $_REQUEST['sellcapitalgain'],	
								'selldepreciationrecap' => $_REQUEST['selldepreciationrecap'],	
								'sellstatetax'=> $_REQUEST['sellstatetax'],	
								'calculatemainsubmit'=> $_REQUEST['calculatemainsubmit'],	
							);	
							
							global $wpdb;
							$HeyWebd = $wpdb->update( 
							'wp_calculator', 
							array( 
								'userinput' => serialize($valuesArray), 
								'modified_date' => date('Y-m-d H:i:s'), 
							), 
							array('id'=>$hiddenInputID), 
							array( 
								'%s',
								'%s',										
							),
							array('%d')					
							);
							
							$lastid = base64_encode($hiddenInputID);
							
							wp_redirect(get_the_permalink('107')."/?id=$lastid&up=true");
						
						}
					} 
				?>
					
					<form method="POST" autocomplete="off" action="" name="calculaterealestate" id="calculaterealestate">
					<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12" style="display:none;">
						<div class="form_panel">
								<div class="panel-headings">
									<h3>PROPERTY TITLE</h3>
								</div>
								<div class="main-form">
									<div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12" style="display:none;">
										<label>Property Name<a data-toggle="tooltip" title="Property Name"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input name="propertyName" id="propertyName" type="text" class="form-control"  value="<?php echo ($SpropertyName)? $SpropertyName : 'Anonymous'; ?>">
										
										<?php
										
											if($propertyNameErr){
												echo '<label id="propertyName-error" class="error" for="propertyName">'.$propertyNameErr.'</label>';
											}
										
										?>
									</div>
								</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form_panel">
							<div class="panel-headings">
								<h3>PROPERTY TITLE & COST INPUTS</h3>
							</div>
							<div class="main-form">
								<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xs-12">
									<label>Purchase Price ($)<a data-toggle="tooltip" title="Purchase Price($)"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<?php 
									if(isset($_GET['id']) && $_GET['id'] !='' && isset($_GET['update']) && $_GET['update'] =='true' ){ ?>
									<input name="purchaseprice" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" id="purchaseprice" type="tel" rel="<?php if(!empty($Spurchaseprice)){echo get_val_by_number_format($Spurchaseprice,true);} ?>" class="form-control" maxlength="10" value="<?php if(!empty($Spurchaseprice)){echo get_val_by_number_format($Spurchaseprice,true);} ?>">
									<?php 
										} else if(isset($_GET['price']) && $_GET['price']){
										
									?>
									<input name="purchaseprice" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" id="purchaseprice" min="1" rel="<?php if(!empty($Spurchaseprice)){echo get_val_by_number_format($Spurchaseprice,true);} ?>" type="tel" class="form-control" maxlength="10" value="<?php echo base64_decode($_GET['price']); ?>">
									<?php }else{?>
										<input name="purchaseprice" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" id="purchaseprice" rel="<?php if(!empty($Spurchaseprice)){echo get_val_by_number_format($Spurchaseprice,true);} ?>" type="tel" class="form-control" maxlength="10" value="<?php echo $mainPrice; ?>">
									<?php } ?>
									<i class="fa fa-usd" aria-hidden="true"></i>
									<?php
									
									if(!empty($purchasepriceErr)){
										echo '<label id="purchaseprice-error" class="error" for="purchaseprice">'.$purchasepriceErr.'</label>';
									}
									
									?>
									<label id="purchaseprice-error" class="error" for="purchaseprice"></label>
								</div>
								<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xs-12 placeholder" data-placeholder="%">
									<label>
										Upfront Improvement (%)
										<a data-toggle="tooltip" title="Upfront Improvement(%)">
											<i class="fa fa-question-circle-o" aria-hidden="true"></i>
										</a>
									</label>
									<span class="valerror" style="display:none;"></span>
									<input onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" name="upfrontimprovement" rel="<?php if(!empty($Supfrontimprovement)){echo $Supfrontimprovement; }else{echo $allvalues['upfrontimprovement'];} ?>" id="upfrontimprovement" type="tel" class="form-control" maxlength="5" value="<?php if(!empty($Supfrontimprovement)){echo $Supfrontimprovement;}else{echo $allvalues['upfrontimprovement'];} ?>">
									<!--i class="fa fa-usd" aria-hidden="true"></i-->
									<?php
										if(!empty($upfrontimprovementErr)){
											echo '<label id="upfrontimprovement-error" class="error" for="upfrontimprovement">'.$upfrontimprovementErr.'</label>';
										}							
									?>
									<label id="upfrontimprovement-error" class="error" for="upfrontimprovement"></label>
								</div>
								
								<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xs-12">
									<label>Address<a data-toggle="tooltip" title="Property Address"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<input name="propertyAddress" id="propertyAddress" type="text" class="form-control" rel="<?php echo (!empty($SpropertyAddress))?$SpropertyAddress:'Unknown'; ?>" value="<?php echo (!empty($SpropertyAddress))?$SpropertyAddress:'Unknown'; ?>">
									<?php
									
									if(!empty($propertyAddressErr)){
										echo '<label id="propertyAddress-error" class="error" for="propertyAddress">'.$propertyAddressErr.'</label>';
									}
									
									?>
								</div>
								
								<div class="form-group right-form-group col-sm-12 col-md-6 col-lg-6 col-xs-12 placeholder" data-placeholder="%">
									<label>Closing Cost (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<span class="valerror" style="display:none;"></span>
									<input name="closingcost" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" rel="<?php echo (!empty($Sclosingcost))?$Sclosingcost:$allvalues['closingcost']; ?>" id="closingcost" type="tel" class="form-control" maxlength="5"  value="<?php echo (!empty($Sclosingcost))?$Sclosingcost:$allvalues['closingcost']; ?>">
								
									<?php
									
										if(!empty($closingcostErr)){
											echo '<label id="closingcost-error" class="error" for="closingcost">'.$closingcostErr.'</label>';
										}
									
									?>
									<label id="closingcost-error" class="error" for="closingcost"></label>
								</div>
							</div>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form_panel">
							<div class="panel-headings">
								<h3>financing INPUTS</h3>
							</div>
							<div class="main-form">
								<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xs-12 placeholder" data-placeholder="%">
									<label>Down Payment (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<span class="valerror" style="display:none;"></span>
									<?php 
									if(isset($_GET['id']) && $_GET['id'] !='' && isset($_GET['update']) && $_GET['update'] =='true' ){ ?>
									<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" name="downpayment" rel="<?php echo $Sdownpayment; ?>" id="downpayment" class="form-control" maxlength="5" value="<?php echo $Sdownpayment; ?>">
									<?php } else {
									?>
									<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" name="downpayment" rel="<?php echo (!empty($mainDownpayment))?$mainDownpayment:$allvalues['downpayment']; ?>" id="downpayment" class="form-control" maxlength="5"  value="<?php echo (!empty($mainDownpayment))?$mainDownpayment:$allvalues['downpayment']; ?>">
									<?php } ?>
									
									<?php
										if(!empty($downPaymentErr)){
											echo '<label id="downpayment-error" class="error" for="downpayment">'.$downPaymentErr.'</label>';
										}
									?>
									<label id="downpayment-error" class="error" for="downpayment"></label>
								</div>
								<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xs-12 placeholder" data-placeholder="%">
									<label>Interest Rate (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<span class="valerror" style="display:none;"></span>
									<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" name="interestrate" rel="<?php echo (!empty($Sinterestrate))?$Sinterestrate:$allvalues['interestrate']; ?>" id="interestrate" class="form-control" maxlength="5" value="<?php echo(!empty($Sinterestrate))?$Sinterestrate:$allvalues['interestrate']; ?>" >
									<?php
										if(!empty($interestrateErr)){
											echo '<label id="interestrate-error" class="error" for="interestrate">'.$interestrateErr.'</label>';
										}
									?>
									<label id="interestrate-error" class="error" for="interestrate"></label>
								</div>
								<div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12 placeholder" data-placeholder="Yrs">
									<label>Mortgage Years <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<span class="valerror" style="display:none;"></span>
									<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" name="mortgageyears" rel="<?php echo (!empty($Smortgageyears))?$Smortgageyears:$allvalues['mortgageyears']; ?>" id="mortgageyears" class="form-control" maxlength="2" value="<?php echo (!empty($Smortgageyears))?$Smortgageyears:$allvalues['mortgageyears']; ?>">
									<?php
									if(!empty($mortgageyearsErr)){
										echo '<label id="mortgageyears-error" class="error" for="mortgageyears">'.$mortgageyearsErr.'</label>';
									}
									?>
									<label id="mortgageyears-error" class="error" for="mortgageyears"></label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form_panel">
							<div class="panel-headings">
								<h3>Revenue INPUTS</h3>
							</div>
							<div class="main-form">
								<div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<label>Monthly Rent ($) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<span class="valerror" style="display:none;"></span>
									<input name="monthlyrent" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" maxlength="9" rel="<?php if(!empty($Smonthlyrent)){echo get_val_by_number_format($Smonthlyrent,true);}else{ echo get_val_by_number_format($allvalues['monthlyrent'],true);} ?>" id="monthlyrent" type="tel" class="allow form-control" value="<?php if(!empty($Smonthlyrent)){echo get_val_by_number_format($Smonthlyrent,true);}else{ echo get_val_by_number_format($allvalues['monthlyrent'],true);} ?>">
									<i class="fa fa-usd" aria-hidden="true"></i>
									<?php
									if(!empty($monthlyRentErr)){
										echo '<label id="monthlyrent-error" class="error" for="monthlyrent">'.$monthlyRentErr.'</label>';
									}
									?>
									<label id="monthlyrent-error" class="error" for="monthlyrent"></label>
								</div>
								<div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12 placeholder" data-placeholder="%">
									<label>Vacancy Rate (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<span class="valerror" style="display:none;"></span>
									<input id="vacancyrate" name="vacancyrate" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" rel="<?php echo (!empty($Svacancyrate))?$Svacancyrate:$allvalues['vacancyrate']; ?>" type="tel" class="form-control" maxlength="5"  value="<?php echo (!empty($Svacancyrate))?$Svacancyrate:$allvalues['vacancyrate']; ?>">
									<?php
									if(!empty($vacancyRateErr)){
										echo '<label id="vacancyrate-error" class="error" for="vacancyrate">'.$vacancyRateErr.'</label>';
									}
									?>
									<label id="vacancyrate-error" class="error" for="vacancyrate"></label>
								</div>
							</div>
						</div>
					</div>					
					</div>

						

						
<!-- //*************************************************************************************************************************
******************************************************* IF UPDATE FORM REQUEST EXIST *******************************************
***************************************************************************************************************************//-->
						<?php if(isset($_GET['id']) && $_GET['id'] !='' && isset($_GET['update']) && $_GET['update'] =='true' ){
                         $calculateID = base64_decode($_GET['id']);
						 ?>
						 <div class="row">
						 <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form_panel">
							<div class="panel-headings">
								<h3>Expenses INPUTSss <!--i>"This section has default criteria based on default values. You can also change this value accordingly"</i--></h3>
							</div>
							<div class="main-form">
								<div class="row">
									<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xs-12 placeholder" data-placeholder="%">
										<label>Property Taxes (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<span class="valerror" style="display:none;"></span>
										<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" rel="<?php echo (!empty($Sexpropertytaxes))?$Sexpropertytaxes:''; ?>" maxlength="5"  class="form-control" name="expropertytaxes" value="<?php echo (!empty($Sexpropertytaxes))?$Sexpropertytaxes:''; ?>">
										<?php
											if(!empty($$expropertyTaxesErr)){
												echo '<label id="expropertytaxes-error" class="error" for="expropertytaxes">'.$expropertyTaxesErr.'</label>';
											}
										?>
										<label id="expropertytaxes-error" class="error" for="expropertytaxes"></label>
									</div>
									<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xs-12">
										<label>Insurance (Monthly $)<a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<span class="valerror" style="display:none;"></span>
										<input type="tel" id="Insurance_Monthly" maxlength="8" class="form-control" name="exinsurance" rel="<?php if(!empty($Sexinsurance)){echo get_val_by_number_format($Sexinsurance,true);} ?>" value="<?php if(!empty($Sexinsurance)){echo get_val_by_number_format($Sexinsurance,true);} ?>">
										<i class="fa fa-usd" aria-hidden="true"></i>
										<?php
											if(!empty($ExinsuranceErr)){
												echo '<label id="exinsurance-error" class="error" for="exinsurance">'.$ExinsuranceErr.'</label>';
											}
										?>
										<label id="exinsurance-error" class="error" for="exinsurance"></label>
									</div>
									<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xs-12 placeholder" data-placeholder="%">
										<label>Repairs (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<span class="valerror" style="display:none;"></span>
										<input type="tel" id="exrepairs" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)" maxlength="5" rel="<?php echo (!empty($Sexrepairs))?$Sexrepairs:''; ?>" class="form-control" name="exrepairs" value="<?php echo (!empty($Sexrepairs))?$Sexrepairs:''; ?>">
										<?php
											if(!empty($ExrepairsErr)){
												echo '<label id="exrepairs-error" class="error" for="exrepairs">'.$ExrepairsErr.'</label>';
											}
										?>
										<label id="exrepairs-error" class="error" for="exrepairs"></label>
									</div>
									<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xs-12">
										<label>Utilities (Monthly $) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<span class="valerror" style="display:none;"></span>
										<input type="tel" onkeyup="numVal(this)" onkeypress="return isDecimalNumber(event)"  id="Utilities_Monthly" maxlength="8" class="form-control allow" name="exutilities" rel="<?php if(!empty($Sexutilities)){echo get_val_by_number_format($Sexutilities,true);}  ?>" value="<?php if(!empty($Sexutilities)){echo get_val_by_number_format($Sexutilities,true);}  ?>">
										<i class="fa fa-usd" aria-hidden="true"></i>
										<?php
											if(!empty($ExutilitiesErr)){
												echo '<label id="exutilities-error" class="error" for="exutilities">'.$ExutilitiesErr.'</label>';
											}
										?>
										<label id="exutilities-error" class="error" for="exutilities"></label>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xs-12 placeholder" data-placeholder="%">
										<label>Property Mgmt Fee (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="expropertymgmt" min="1" max="99" maxlength="5"  class="form-control" name="expropertymgmt" rel="<?php echo (!empty($Sexpropertymgmt))?$Sexpropertymgmt:''; ?>" value="<?php echo (!empty($Sexpropertymgmt))?$Sexpropertymgmt:''; ?>">
										<?php
											if(!empty($expropertyMgmtErr)){
												echo '<label id="expropertymgmt-error" class="error" for="expropertymgmt">'.$expropertyMgmtErr.'</label>';
											}
										?>
										<label id="expropertymgmt-error" class="error" for="expropertymgmt"></label>
									</div>
									<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xs-12">
										<label>HOA (Monthly $) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" min="1" id="HOA_Monthly" maxlength="8" class="form-control" name="exhoa" rel="<?php if(!empty($Sexhoa)){echo get_val_by_number_format($Sexhoa,true);}  ?>" value="<?php if(!empty($Sexhoa)){echo get_val_by_number_format($Sexhoa,true);}  ?>">
										<i class="fa fa-usd" aria-hidden="true"></i>
										<?php
											if(!empty($ExhoaErr)){
												echo '<label id="exhoa-error" class="error" for="exhoa">'.$ExhoaErr.'</label>';
											}
										?>
										<label id="exhoa-error" class="error" for="exhoa"></label>
									</div>
									<div class="form-group col-sm-6 col-md-3 col-lg-3 col-xs-12 placeholder" data-placeholder="%">
										<label>Other % Cost (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" min="1" max="99" maxlength="5"  rel="<?php echo (!empty($Sexother))?$Sexother:''; ?>" class="form-control" name="exother" value="<?php echo (!empty($Sexother))?$Sexother:''; ?>">
										<?php
											if(!empty($ExotherErr)){
												echo '<label id="exother-error" class="error" for="exother">'.$ExotherErr.'</label>';
											}
										?>
										<label id="exother-error" class="error" for="exother"></label>
									</div>
									<div class="form-group col-sm-6 col-md-3 col-lg-3 col-xs-12">
										<label>Other Fixed Cost (Monthly $) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="ther_Fixed_Cost_Monthly" maxlength="8" class="form-control" name="exotherfixed" rel="<?php if(!empty($Sexotherfixed)){echo get_val_by_number_format($Sexotherfixed,true);} ?>" value="<?php if(!empty($Sexotherfixed)){echo get_val_by_number_format($Sexotherfixed,true);} ?>">
										<i class="fa fa-usd" aria-hidden="true"></i>
										<?php
											if(!empty($ExotherfixedErr)){
												echo '<label id="exotherfixed-error" class="error" for="exotherfixed">'.$ExotherfixedErr.'</label>';
											}
										?>
										<label id="exotherfixed-error" class="error" for="exotherfixed"></label>
									</div>
								</div>
							</div>
						</div>
						</div>
						</div>
						<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form_panel">
							<div class="panel-headings">
								<h3>Tax INPUTS <!--i>"This section has default criteria based on default values. You can also change this value accordingly"</i--></h3>
							</div>
							<div class="main-form">
								<div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12 placeholder" data-placeholder="%">
									<label>Marginal Tax Rate (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<input name="marginaltaxrate" min="1" id="marginaltaxrate" type="tel" class="form-control" max="99" maxlength="5" rel="<?php echo (!empty($Smarginaltaxrate))?$Smarginaltaxrate:''; ?>" name="taxmarginal" value="<?php echo (!empty($Smarginaltaxrate))?$Smarginaltaxrate:''; ?>">
									<?php
										if(!empty($MarginaltaxrateErr)){
											echo '<label id="marginaltaxrate-error" class="error" for="marginaltaxrate">'.$MarginaltaxrateErrw.'</label>';
										}
									?>
									<label id="marginaltaxrate-error" class="error" for="marginaltaxrate"></label>
								</div>
								<div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12 placeholder" data-placeholder="Yrs">
									<label>Amortization Period Years <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<input name="amortizationperiodyears" min="1" max="99" id="amortizationperiodyears" type="tel" class="form-control" name="taxamortizationperiod" rel="<?php echo (!empty($Samortizationperiodyears))?$Samortizationperiodyears:''; ?>" value="<?php echo (!empty($Samortizationperiodyears))?$Samortizationperiodyears:''; ?>">
									<?php
										if(!empty($amortizationPeriodYearsErr)){
											echo '<label id="amortizationperiodyears-error" class="error" for="amortizationperiodyears">'.$amortizationPeriodYearsErr.'</label>';
										}
									?>
									<label id="amortizationperiodyears-error" class="error" for="amortizationperiodyears"></label>
								</div>
							</div>
						</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form_panel">
							<div class="panel-headings">
								<h3>Annual growth INPUTS <!--i>"This section has default criteria based on default values. You can also change this value accordingly"</i--></h3>
							</div>
							<div class="main-form">
								<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xs-12 placeholder" data-placeholder="%">
									<label>Appreciation (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<input type="tel" id="annualappreciation" min="1" max="99" maxlength="5"  class="form-control" name="annualappreciation" rel="<?php echo (!empty($Sannualappreciation))?$Sannualappreciation:''; ?>" value="<?php echo (!empty($Sannualappreciation))?$Sannualappreciation:''; ?>">
									<?php
										if(!empty($annualAppreciationErr)){
											echo '<label id="annualappreciation-error" class="error" for="annualappreciation">'.$annualAppreciationErr.'</label>';
										}
									?>
									<label id="annualappreciation-error" class="error" for="annualappreciation"></label>
								</div>
								<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xs-12 placeholder" data-placeholder="%">
									<label>Rent Increase (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<input type="tel" min="1" max="99" maxlength="5" class="form-control" name="annualrentincrease" rel="<?php echo (!empty($Sannualrentincrease))?$Sannualrentincrease:''; ?>" value="<?php echo (!empty($Sannualrentincrease))?$Sannualrentincrease:''; ?>">
									<?php
										if(!empty($annualrentIncreaseErr)){
											echo '<label id="annualappreciation-error" class="error" for="annualappreciation">'.$annualrentIncreaseErr.'</label>';
										}
									?>
									<label id="annualappreciation-error" class="error" for="annualappreciation"></label>
								</div>
								<div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12  placeholder" data-placeholder="%">
									<label>Operating Expense Increase (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<input type="tel" min="1" max="99" rel="<?php echo (!empty($Sannualoprating))?$Sannualoprating:''; ?>" class="form-control" name="annualoprating" value="<?php echo (!empty($Sannualoprating))?$Sannualoprating:''; ?>">
									<?php
									
										if(!empty($annualOpratingErr)){
											echo '<label id="annualrentincrease-error" class="error" for="annualrentincrease">'.$annualrentIncreaseErr.'</label>';
										}
										
									?>
									<label id="annualrentincrease-error" class="error" for="annualrentincrease"></label>
								</div>
							</div>
						</div>
						</div>
						</div>
						<div class="form_panel">
							<div class="panel-headings">
								<h3>Sell INPUTS <!--i>"This section has default criteria based on default values. You can also change this value accordingly"</i--></h3>
							</div>
							<div class="main-form">
								<div class="row">
									<!-- <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xs-12 placeholder" data-placeholder="Yrs">
										<label>Holding Period (Years) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="sellholdingperiod" min="1" class="form-control" rel="<?php// echo (!empty($Ssellholdingperiod))?$Ssellholdingperiod:''; ?>" name="sellholdingperiod" value="<?php //echo (!empty($Ssellholdingperiod))?$Ssellholdingperiod:''; ?>">
										<?php
											if(!empty($sellHoldingPeriodErr)){
												echo '<label id="sellholdingperiod-error" class="error" for="sellholdingperiod">'.$sellHoldingPeriodErr.'</label>';
											}
										?>
										<label id="sellholdingperiod-error" class="error" for="sellholdingperiod"></label>
									</div> -->
									<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xs-12  placeholder" data-placeholder="%">
										<label>Selling Transaction Cost (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="selltransactioncost" min="1" max="100" maxlength="5"  class="form-control" name="selltransactioncost" rel="<?php echo (!empty($Sselltransactioncost))?$Sselltransactioncost:''; ?>" value="<?php echo (!empty($Sselltransactioncost))?$Sselltransactioncost:''; ?>">
										<?php
											if(!empty($sellTransactionCostErr)){
												echo '<label id="selltransactioncost-error" class="error" for="selltransactioncost">'.$sellTransactionCostErr.'</label>';
											}
										?>
										<label id="selltransactioncost-error" class="error" for="selltransactioncost"></label>
									</div>
									<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xs-12  placeholder" data-placeholder="%">
										<label>Capital Gains Tax Rate (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="sellcapitalgain" min="1" max="99" maxlength="5"  class="form-control" name="sellcapitalgain" rel="<?php echo (!empty($Ssellcapitalgain))?$Ssellcapitalgain:''; ?>" value="<?php echo (!empty($Ssellcapitalgain))?$Ssellcapitalgain:''; ?>">
										<?php
											if(!empty($sellCapitalGainErr)){
												echo '<label id="sellcapitalgain-error" class="error" for="sellcapitalgain">'.$sellCapitalGainErr.'</label>';
											}
										?>
										<label id="sellcapitalgain-error" class="error" for="sellcapitalgain"></label>
									</div>	
								</div>	
								<div class="row">					
									<div class="form-group col-sm-6 col-md-6 col-lg-6 col-xs-12  placeholder" data-placeholder="%">
										<label>Depreciation Recap Tax Rate (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="selldepreciationrecap" min="1" max="100" maxlength="5"  class="form-control" name="selldepreciationrecap" rel="<?php echo (!empty($Sselldepreciationrecap))?$Sselldepreciationrecap:''; ?>" value="<?php echo (!empty($Sselldepreciationrecap))?$Sselldepreciationrecap:''; ?>">
										<?php
											if(!empty($sellDepreciationRecapErr)){
												echo '<label id="selldepreciationrecap-error" class="error" for="selldepreciationrecap">'.$sellDepreciationRecapErr.'</label>';
											}
										?>
										<label id="selldepreciationrecap-error" class="error" for="selldepreciationrecap"></label>
									</div>							
									<div class="form-group col-sm-6 col-md-6 col-lg-6 col-xs-12  placeholder" data-placeholder="%">
										<label>State Tax (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="sellstatetax" min="1" max="100" maxlength="5" class="form-control" name="sellstatetax" rel="<?php echo (!empty($Ssellstatetax))?$Ssellstatetax:''; ?>" value="<?php echo (!empty($Ssellstatetax))?$Ssellstatetax:''; ?>">
										<?php
											if(!empty($sellStateTaxErr)){
												echo '<label id="sellstatetax-error" class="error" for="sellstatetax">'.$sellStateTaxErr.'</label>';
											}
										?>
										<label id="sellstatetax-error" class="error" for="sellstatetax"></label>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" class="form-control" name="hiddenInputID" rel="<?php echo $calculateID; ?>" value="<?php echo $calculateID; ?>">
						<div class="col-xs-12 col-sm-12 col-lg-12 text-center submit_btn_wrapper"><input type="submit" value="UPDATE NOW" class="submit_btn-cal" name="updateMainSubmit"></div>
<!-- //*************************************************************************************************************************
******************************************************* IF UPDATE FORM REQUEST NOT EXISTS *********************x*********************
***************************************************************************************************************************//-->
                        <?php } else { ?>
						 <div class="row">
						 <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form_panel">
							<div class="panel-headings">
								<h3>Expenses INPUTS <!--i>"This section has default criteria based on default values. You can also change this value accordingly"</i--></h3>
							</div>
							<div class="main-form">
								<div class="row">
									<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xs-12 placeholder" data-placeholder="%">
										<label>Property Taxes (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input id="expropertytaxes" type="tel" min="1" max="99" maxlength="5"  class="form-control" name="expropertytaxes" rel="<?php echo (!empty($allvalues['expropertytaxes']))?$allvalues['expropertytaxes']:''; ?>" value="<?php echo (!empty($allvalues['expropertytaxes']))?$allvalues['expropertytaxes']:''; ?>">
										<?php
											if(!empty($expropertyTaxesErr)){
												echo '<label id="expropertytaxes-error" class="error" for="expropertytaxes">'.$expropertyTaxesErr.'</label>';
											}
										?>
										<label id="expropertytaxes-error" class="error" for="expropertytaxes"></label>
									</div>
									<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xs-12">
										<label>Insurance (Monthly $)<a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="exinsurance" maxlength="8" class="form-control" name="exinsurance" rel="<?php echo (!empty($allvalues['exinsurance']))?$allvalues['exinsurance']:''; ?>"  value="<?php echo (!empty($allvalues['exinsurance']))?$allvalues['exinsurance']:''; ?>">
										<i class="fa fa-usd" aria-hidden="true"></i>
										<?php
											if(!empty($ExinsuranceErr)){
												echo '<label id="exinsurance-error" class="error" for="exinsurance">'.$ExinsuranceErr.'</label>';
											}
										?>
										<label id="exinsurance-error" class="error" for="exinsurance"></label>
									</div>
									<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xs-12 placeholder" data-placeholder="%">
										<label>Repairs (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="exrepairs" min="1" max="100" maxlength="5"  class="form-control" name="exrepairs" rel="<?php echo (!empty($allvalues['exrepairs']))?$allvalues['exrepairs']:''; ?>" value="<?php echo (!empty($allvalues['exrepairs']))?$allvalues['exrepairs']:''; ?>">
										<?php
											if(!empty($ExrepairsErr)){
												echo '<label id="exrepairs-error" class="error" for="exrepairs">'.$ExrepairsErr.'</label>';
											}
										?>
										<label id="exrepairs-error" class="error" for="exrepairs"></label>
									</div>
									<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xs-12">
										<label>Utilities (Monthly $) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="exutilities" maxlength="8" class="form-control" name="exutilities" rel="<?php echo (!empty($allvalues['exutilities']))?$allvalues['exutilities']:''; ?>" value="<?php echo (!empty($allvalues['exutilities']) || $allvalues['exutilities']==0)?$allvalues['exutilities']:''; ?>">
										<i class="fa fa-usd" aria-hidden="true"></i>
										<?php
											if(!empty($ExutilitiesErr)){
												echo '<label id="exutilities-error" class="error" for="exutilities">'.$ExutilitiesErr.'</label>';
											}
										?>
										<label id="exutilities-error" class="error" for="exutilities"></label>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xs-12 placeholder" data-placeholder="%">
										<label>Property Mgmt Fee (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="expropertymgmt" min="1" max="99" maxlength="5"  class="form-control" name="expropertymgmt" rel="<?php echo (!empty($allvalues['expropertymgmt']))?$allvalues['expropertymgmt']:''; ?>" value="<?php echo (!empty($allvalues['expropertymgmt']))?$allvalues['expropertymgmt']:''; ?>">
										<?php
											if(!empty($expropertyMgmtErr)){
												echo '<label id="expropertymgmt-error" class="error" for="expropertymgmt">'.$expropertyMgmtErr.'</label>';
											}
										?>
										<label id="expropertymgmt-error" class="error" for="expropertymgmt"></label>
									</div>
									<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xs-12">
										<label>HOA (Monthly $) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="exhoa" maxlength="8" rel="<?php echo (!empty($allvalues['exhoa']))?$allvalues['exhoa']:''; ?>" class="form-control" name="exhoa" value="<?php echo (!empty($allvalues['exhoa']))?$allvalues['exhoa']:''; ?>">
										<i class="fa fa-usd" aria-hidden="true"></i>
										<?php
											if(!empty($ExhoaErr)){
												echo '<label id="exhoa-error" class="error" for="exhoa">'.$ExhoaErr.'</label>';
											}
										?>
										<label id="exhoa-error" class="error" for="exhoa"></label>
									</div>
									<div class="form-group col-sm-6 col-md-3 col-lg-3 col-xs-12 placeholder" data-placeholder="%">
										<label>Other % Cost (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="exother" min="1" max="100" maxlength="5"  class="form-control" name="exother" rel="<?php echo (!empty($allvalues['exother']))?$allvalues['exother']:''; ?>" value="<?php echo (!empty($allvalues['exother']))?$allvalues['exother']:''; ?>">
										<?php
											if(!empty($ExotherErr)){
												echo '<label id="exother-error" class="error" for="exother">'.$ExotherErr.'</label>';
											}
										?>
										<label id="exother-error" class="error" for="exother"></label>
									</div>
									<div class="form-group col-sm-6 col-md-3 col-lg-3 col-xs-12">
										<label>Other Fixed Cost (Monthly $) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="exotherfixed" maxlength="8" class="form-control" name="exotherfixed" rel="<?php echo (!empty($allvalues['exotherfixed']))?$allvalues['exotherfixed']:''; ?>" value="<?php echo $allvalues['exotherfixed']; ?>">
										<i class="fa fa-usd" aria-hidden="true"></i>
										<?php
											if(!empty($ExotherfixedErr)){
												echo '<label id="exotherfixed-error" class="error" for="exotherfixed">'.$ExotherfixedErr.'</label>';
											}
										?>
										<label id="exotherfixed-error" class="error" for="exotherfixed"></label>
									</div>
								</div>
							</div>
						</div>
						</div>
						</div>

						<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form_panel">
							<div class="panel-headings">
								<h3>Tax INPUTS <!--i>"This section has default criteria based on default values. You can also change this value accordingly"</i--></h3>
							</div>
							<div class="main-form">
								<div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12 placeholder" data-placeholder="%">
									<label>Marginal Tax Rate (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<input name="marginaltaxrate" id="marginaltaxrate" type="tel" class="form-control" min="1" max="99" maxlength="5" rel="<?php echo (!empty($allvalues['marginaltaxrate']))?$allvalues['marginaltaxrate']:''; ?>" name="taxmarginal" value="<?php echo (!empty($allvalues['marginaltaxrate']))?$allvalues['marginaltaxrate']:''; ?>">
									<?php
										if(!empty($MarginaltaxrateErr)){
											echo '<label id="marginaltaxrate-error" class="error" for="marginaltaxrate">'.$MarginaltaxrateErrw.'</label>';
										}
									?>
									<label id="marginaltaxrate-error" class="error" for="marginaltaxrate"></label>
								</div>
								<div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12 placeholder" data-placeholder="Yrs">
									<label>Amortization Period Years <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<input name="amortizationperiodyears" min="1" id="amortizationperiodyears" type="tel" class="form-control" rel="<?php echo (!empty($allvalues['amortizationperiodyears']))?$allvalues['amortizationperiodyears']:''; ?>" name="taxamortizationperiod" value="<?php echo (!empty($allvalues['amortizationperiodyears']))?$allvalues['amortizationperiodyears']:''; ?>">
									<?php
										if(!empty($amortizationPeriodYearsErr)){
											echo '<label id="amortizationperiodyears-error" class="error" for="amortizationperiodyears">'.$amortizationPeriodYearsErr.'</label>';
										}
									?>
									<label id="amortizationperiodyears-error" class="error" for="amortizationperiodyears"></label>
								</div>
							</div>
						</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form_panel">
							<div class="panel-headings">
								<h3>Annual growth INPUTS <!--i>"This section has default criteria based on default values. You can also change this value accordingly"</i--></h3>
							</div>
							<div class="main-form">
								<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xs-12 placeholder" data-placeholder="%">
									<label>Appreciation (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<input type="tel" id="annualappreciation" min="1" max="100" maxlength="5"  class="form-control" name="annualappreciation" rel="<?php echo (!empty($allvalues['annualappreciation']))?$allvalues['annualappreciation']:''; ?>" value="<?php echo (!empty($allvalues['annualappreciation']))?$allvalues['annualappreciation']:''; ?>">
									<?php
										if(!empty($annualAppreciationErr)){
											echo '<label id="annualappreciation-error" class="error" for="annualappreciation">'.$annualAppreciationErr.'</label>';
										}
									?>
									<label id="annualappreciation-error" class="error" for="annualappreciation"></label>
								</div>
								<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xs-12 placeholder" data-placeholder="%">
									<label>Rent Increase (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<input type="tel" id="annualrentincrease" min="1" max="99" maxlength="5" class="form-control" name="annualrentincrease" rel="<?php  echo (!empty($allvalues['annualrentincrease']))?$allvalues['annualrentincrease']:''; ?>" value="<?php echo (!empty($allvalues['annualrentincrease']))?$allvalues['annualrentincrease']:''; ?>">
									<?php
										if(!empty($annualrentIncreaseErr)){
											echo '<label id="annualrentincrease-error" class="error" for="annualrentincrease">'.$annualrentIncreaseErr.'</label>';
										}
									?>
									<label id="annualrentincrease-error" class="error" for="annualrentincrease"></label>
								</div>
								<div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12  placeholder" data-placeholder="%">
									<label>Operating Expense Increase (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
									<input type="tel" id="annualoprating" min="1" max="100" class="form-control" name="annualoprating" rel="<?php echo (!empty($allvalues['annualoprating']))?$allvalues['annualoprating']:''; ?>" value="<?php echo (!empty($allvalues['annualoprating']))?$allvalues['annualoprating']:''; ?>">
									<?php
										if(!empty($annualOpratingErr)){
											echo '<label id="annualoprating-error" class="error" for="annualoprating">'.$annualopratingErr.'</label>';
										}
									?>
									<label id="annualoprating-error" class="error" for="annualoprating"></label>
								</div>
							</div>
						</div>
						</div>
						</div>
						<div class="form_panel">
							<div class="panel-headings">
								<h3>Sell INPUTS <!--i>"This section has default criteria based on default values. You can also change this value accordingly"</i--></h3>
							</div>
							<div class="main-form">
								<div class="row">
									<!-- <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xs-12 placeholder" data-placeholder="Yrs">
										<label>Holding Period (Years) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="sellholdingperiod" min="1" class="form-control" name="sellholdingperiod" rel="<?php echo (!empty($allvalues['sellholdingperiod']))?$allvalues['sellholdingperiod']:''; ?>" value="<?php echo (!empty($allvalues['sellholdingperiod']))?$allvalues['sellholdingperiod']:''; ?>">
										<?php
											if(!empty($sellHoldingPeriodErr)){
												echo '<label id="sellholdingperiod-error" class="error" for="sellholdingperiod">'.$sellHoldingPeriodErr.'</label>';
											}
										?>
										<label id="sellholdingperiod-error" class="error" for="sellholdingperiod"></label>
									</div> -->
									<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xs-12  placeholder" data-placeholder="%">
										<label>Selling Transaction Cost (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="selltransactioncost" min="1" max="99" maxlength="5" class="form-control" name="selltransactioncost" rel="<?php echo (!empty($allvalues['selltransactioncost']))?$allvalues['selltransactioncost']:''; ?>" value="<?php echo (!empty($allvalues['selltransactioncost']))?$allvalues['selltransactioncost']:''; ?>">
										<?php
											if(!empty($sellTransactionCostErr)){
												echo '<label id="selltransactioncost-error" class="error" for="selltransactioncost">'.$sellTransactionCostErr.'</label>';
											}
										?>
										<label id="selltransactioncost-error" class="error" for="selltransactioncost"></label>
									</div>
									<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xs-12  placeholder" data-placeholder="%">
										<label>Capital Gains Tax Rate (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="sellcapitalgain" min="1" maxlength="5" class="form-control" rel="<?php echo (!empty($allvalues['sellcapitalgain']))?$allvalues['sellcapitalgain']:''; ?>" name="sellcapitalgain" value="<?php echo (!empty($allvalues['sellcapitalgain']))?$allvalues['sellcapitalgain']:''; ?>">
										<?php
											if(!empty($sellCapitalGainErr)){
												echo '<label id="sellcapitalgain-error" class="error" for="sellcapitalgain">'.$sellCapitalGainErr.'</label>';
											}
										?>
										<label id="sellcapitalgain-error" class="error" for="sellcapitalgain"></label>
									</div>	
								</div>	
								<div class="row">					
									<div class="form-group col-sm-6 col-md-6 col-lg-6 col-xs-12  placeholder" data-placeholder="%">
										<label>Depreciation Recap Tax Rate (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="selldepreciationrecap" min="1" max="99" maxlength="5" class="form-control" name="selldepreciationrecap" rel="<?php echo (!empty($allvalues['selldepreciationrecap']))?$allvalues['selldepreciationrecap']:''; ?>" value="<?php echo (!empty($allvalues['selldepreciationrecap']))?$allvalues['selldepreciationrecap']:''; ?>">
										<?php
											if(!empty($sellDepreciationRecapErr)){
												echo '<label id="selldepreciationrecap-error" class="error" for="selldepreciationrecap">'.$sellDepreciationRecapErr.'</label>';
											}
										?>
										<label id="selldepreciationrecap-error" class="error" for="selldepreciationrecap"></label>
									</div>							
									<div class="form-group col-sm-6 col-md-6 col-lg-6 col-xs-12  placeholder" data-placeholder="%">
										<label>State Tax (%) <a data-toggle="tooltip" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><i class="fa fa-question-circle-o" aria-hidden="true"></i></a></label>
										<input type="tel" id="sellstatetax" min="1" max="99" maxlength="5" class="form-control" name="sellstatetax" rel="<?php echo (!empty($allvalues['sellstatetax']))?$allvalues['sellstatetax']:''; ?>" value="<?php echo (!empty($allvalues['sellstatetax']))?$allvalues['sellstatetax']:''; ?>">
										<?php
											if(!empty($sellStateTaxErr)){
												echo '<label id="sellstatetax-error" class="error" for="sellstatetax">'.$sellStateTaxErr.'</label>';
											}
										?>
										<label id="sellstatetax-error" class="error" for="sellstatetax"></label>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-lg-12 text-center submit_btn_wrapper"><input type="submit" value="CALCULATE NOW" class="submit_btn-cal" name="calculatemainsubmit"></div>
						 <?php } ?>
<!-- //*************************************************************************************************************************
******************************************************* END OF IF CONDITION *********************x*********************
***************************************************************************************************************************//-->
					</form>
				</div>
			</div>
		</div>
	</main><!-- .site-main -->
</div><!-- .content-area -->
<script>
jQuery(document).ready(function(){
	/* jQuery('#propertyName').keypress(function (e) {
		var regex = new RegExp("^[a-zA-Z]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if (regex.test(str)) {
			return true;
		}
		else
		{
		e.preventDefault();
		alert('Please Enter Alphabate');
		return false;
		}
	}); */
	
});
</script>
<script>


jQuery(document).ready(function(){
/* jQuery('#closingcost').keyup(function(){
	if (jQuery(this).val() >= 101){
		jQuery('#closingcost-error').text("Please enter value less than or equal to 100");
	}
});	 */
function allLetter(value)  
{  
 var letters = '/^\s*[A-Za-z]+\s*$/';  
 if(value.match(letters))  
   {
    return true;  
   }  
 else  
   {  
   alert("first, last and middle name contain only letters");  
   return false;  
   }  
} 	
    jQuery('[data-toggle="tooltip"]').tooltip();   
});

/* var yourArray = [];
jQuery('td.dep_First_1').each(function() {
	alert(jQuery(this).text());
  var strOne = jQuery(this).text().replace('$', '');
   var str = strOne.replace(',','');
  console.log(str);
  yourArray.push(str);
});
var sum = '';
 for(var i = 0; i < yourArray.length; i++) {
		if(sum == ''){
			 sum = yourArray[i]; 
		}
		if(i == 0 ){
		}
		else{
		sum =  sum - yourArray[i] ;
		}
 }


		jQuery('.DynamicVal.dep_First').html(sum); */
</script>

<style>
.form-group {
  height: 89px;
  margin: 0!important;
}
.valerror {
  bottom: 1px;
  display: block;
  float: left;
  font-size: 14px;
  position: absolute;
  text-align: left;
}
#.submit_btn_wrapper .submit_btn-cal{
	display:none;
}
#.submit_btn_wrapper .submit_btn-cal.block{
	display:inline-block;
}
.placeholder {
  font-size: 16px;
  position: relative;
}
.placeholder::after {
  content: attr(data-placeholder);
  right: 26px;
  pointer-events: none;
  position: absolute;
  top: 35px;
  color:black !important;
}
/*
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
*/
.main-form .form-group{position:relative;}
.main-form .form-group input+label+.fa,
.main-form .form-group input + .fa {
	  font-size: 15px;
  left: 21px;
  position: absolute;
  top: 39px;
  z-index: 9999;
}
.main-form .form-control {
  padding: 6px 20px!important;
 
}
#calculaterealestate .error {
  color: red !important;
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

</style>
<!--
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>-->
<?php get_footer(); ?>