<?php



//require_once("dbcontroller.php");

require_once("pagination.class.php");

require_once("../../../wp-load.php");

//$db_handle = new DBController();

$perPage = new PerPage();

/*pt($perPage);die();*/

global $wpdb;

//$city = $_POST['city'];

//id,lat,paddress,home_type,zipcode,lot_sze,sold_date,exhoa,year_built,monthlyrent,lng,beds,full_baths,pprice,city,finished_feet,TRETID

$sql = "SELECT * FROM wp_home_facts WHERE city = '".$_POST["city"]."' ";

$sql1 = "SELECT count(id) as records FROM wp_home_facts WHERE city = '".$_POST["city"]."'";

if($_POST["home_id"] != ''){
	$sql .=' and id = '.$_POST["home_id"].'';
}

if($_POST["saved_status"] != 'all'){
	$userid = '"'.get_current_user_ID().'"';
	$sql .=" and saved_status_user_id LIKE '%".$userid."%'";
	$sql1 .=" and saved_status_user_id LIKE '%".$userid."%'";
}

$sql .= ' order by id desc';
// WHERE city = '".$city."'

$paginationlink = get_template_directory_uri()."/gethomeresult.php?page=";	

$pagination_setting = $_POST["pagination_setting"];

				

$page = 1;

if(!empty($_POST["page"])) {

$page = $_POST["page"];

$next_page = $page+1;
$previous_page = $page-1;

}
else{
$next_page = 2;
$previous_page = '';
}



$start = ($page-1)*$perPage->perpage;

if($start < 0) $start = 0;



$query =  $sql . " limit " . $start . ", " . $perPage->perpage; 



$faq = (array)$wpdb->get_row($query);

/*if(empty($_POST["rowcount"])) {*/

$rwcount = (array)$wpdb->get_row($sql1);



$_POST["rowcount"] = $rwcount['records'];

/*}*/



if($pagination_setting == "prev-next") {

	$perpageresult = $perPage->getPrevNext($_POST["rowcount"], $paginationlink,$faq);	

} else {

	$perpageresult = $perPage->getAllPageLinks($_POST["rowcount"], $paginationlink,$pagination_setting);	

}





$output = '';

/*foreach($faq as $k=>$v) {

 $output .= '<div class="question"><input type="hidden" id="rowcount" name="rowcount" value="' . $_POST["rowcount"] . '" />' . $faq[$k]["paddress"] . '</div>';

 $output .= '<div class="answer">' . $faq[$k]["zipcode"] . '</div>';

}*/



/*$output .= '<div class="question"><input type="hidden" id="rowcount" name="rowcount" value="' . $_POST["rowcount"] . '" />' . $faq["paddress"] . '</div>';

 $output .= '<div class="answer">' . $faq["zipcode"] . '</div>';*/







if(!empty($perpageresult)) {

$output .= '<div id="pagination">' . $perpageresult . '</div>';

}


$pImages = unserialize($faq["images"]);
$home_slider = '';
$home_slider .= '<div class="owl-carousel" id="propertySlider">';	
$main_count = 1;
$imgCounts = count($pImages);
/*pt($imgCounts);die();*/
if(!empty($pImages)){	
		$count = 1;
		foreach($pImages as $pImage){	
			$imageName = $pImage;

				$inser_url = site_url().'/wp-content/uploads/properties_gallery/'.$imageName;	
				if($inser_url == ''){
					get_template_directory_uri()."/images/EstateDefault.jpg";
				}
			
		$home_slider .= '<div class="item">										
					<div class="sliderContainer" data="'.$main_count.'" rel="'. $count.'">	
						<img src="'.$inser_url.'">
					</div>
				</div>';
				
				$count++;
			} 

		}else{
			
			$home_slider .='<img class="img-responsive" src="'. get_template_directory_uri().'/images/EstateDefault.jpg">';
			} 
if($imgCounts == 0){
	$imsgs = 'N/A';
}else{
	$imsgs = '<span class="regular_count my_count_'.$main_count.'">1</span>'.' of <span class="total_count">'.$imgCounts.'</span>';
}
	$home_slider .='</div>
<div class="images_count">'.$imsgs.' </div>';
/*var_dump($home_slider);die;*/

$output .= '

<input type="hidden" id="rowcount" name="rowcount" value="' . $_POST["rowcount"] . '" />
<input type="hidden" id="next_page" name="next_page" value="' . $next_page . '" />
<input type="hidden" id="previous_page" name="previous_page" value="' . $previous_page . '" />

<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 bottom-sections no-padding-left">

	<p class="sub-hgeading"> Home Facts</p>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding-left pr7">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bordered-wrap">

			'.$home_slider.'

		</div>

	</div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad-right pl7">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bordered-wrap">

			<div class="row bottom-border padded-row">

				<div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">Price</div> 

				<div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 right">$'.$faq["pprice"].'</div>

	

		</div>

		

			<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Beds</div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right">'.$faq["beds"].'</div> 

				

		</div>

		

			<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Baths</div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right"> '.$faq["full_baths"].'</div>

				

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Sqft</div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right">'.$faq["finished_feet"].'</div>

				

		</div>

	<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Lot </div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right">'.$faq["lot_sze"].'</div>

				

		</div>

			

			<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Type</div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right no-padding-left"> '.$faq["home_type"].'</div>

				

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Year Built</div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right">'.$faq["year_built"].'</div>

				

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Last Sold </div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right">'.$faq["sold_date"].'</div>

				

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Zillow ID</div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right">'.$faq["ZillowID"].'</div>

				

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">TRET ID </div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right">'.$faq["TRETID"].'</div>

				

		</div>

		

		<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">MLS ID </div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right"> '.$faq["MSLID"].'</div>

				

		</div>

	</div>

</div>

</div>



<!--financial-->



<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 bottom-sections">

	<p class="sub-hgeading"> Financials</p>



		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pr7 no-padding-left">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bordered-wrap">

			<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">Upfront Improvement</div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right">'.$faq["upfrontimprovement"].'%</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="upfrontimprovement" class="edit_fields" placeholder="$19,251" value="'.$faq["upfrontimprovement"].'"/> 

			</div>

		</div>

		

			<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Closing Cost</div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right">'.$faq["closingcost"].'%</div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="closingcost" class="edit_fields" placeholder="$19,251" value="'.$faq["closingcost"].'"/> 

			</div>

		</div>

		

			<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">Down Payment</div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left">'.$faq["downpayment"].'%</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="downpayment" class="edit_fields" placeholder="$19,251" value="'.$faq["downpayment"].'"/>  

			</div>

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Rent</div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right">$'.$faq["monthlyrent"].'

</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="monthlyrent" class="edit_fields" placeholder="$19,251" name="'.$faq["monthlyrent"].'"/>  

			</div>

		</div>

	<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Vacancy Rate </div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right no-padding-left"> '.$faq["vacancyrate"].'%</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="vacancyrate" class="edit_fields" placeholder="$19,251" value="'.$faq["vacancyrate"].'"/>  

			</div>

		</div>

			

			<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">Property Taxes</div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left">'.$faq["expropertytaxes"].'%</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="expropertytaxes" class="edit_fields" placeholder="$19,251" value="'.$faq["expropertytaxes"].'"/>  

			</div>

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Insurance </div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right"> $'.$faq["exinsurance"].'</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="exinsurance" class="edit_fields" placeholder="$19,251" value="'.$faq["exinsurance"].'"/>  

			</div>

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Repairs</div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right">'.$faq["exrepairs"].'%</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="exrepairs" class="edit_fields" placeholder="$19,251" value="'.$faq["exrepairs"].'"/>  

			</div>

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Utilities</div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right">$'.$faq["exutilities"].'</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="exutilities" class="edit_fields" placeholder="$19,251" value="'.$faq["exutilities"].'"/>  

			</div>

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">Management Fee</div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left">'.$faq["expropertymgmt"].'%</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="expropertymgmt" class="edit_fields" placeholder="$19,251" value="'.$faq["expropertymgmt"].'"/>  

			</div>

		</div>

		

		<div class="row bottom-border padded-row">

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">HOA</div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right">$'.$faq["exhoa"].'</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="exhoa" class="edit_fields" placeholder="$19,251" value="'.$faq["exhoa"].'"/>  

			</div>

		</div>

	</div>

</div>



<!--section-inner-->

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad-right pl7">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bordered-wrap">

			<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">Other % Cost</div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left">'.$faq["exother"].'%</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="exother" class="edit_fields" placeholder="$19,251" value="'.$faq["exother"].'"/> 

			</div>

		</div>

		

			<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">Other Fixed Cost </div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left">$'.$faq["exotherfixed"].'</div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="exotherfixed" class="edit_fields" placeholder="$19,251" value="'.$faq["exotherfixed"].'"/> 

			</div>

		</div>

		

			<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">Marginal Tax Rate </div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left">'.$faq["marginaltaxrate"].'%</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="marginaltaxrate" class="edit_fields" placeholder="$19,251" value="'.$faq["marginaltaxrate"].'"/>  

			</div>

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">Amortization Years</div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"> '.$faq["amortizationperiodyears"].'</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="amortizationperiodyears" class="edit_fields" placeholder="$19,251" value="'.$faq["amortizationperiodyears"].'"/>  

			</div>

		</div>

	<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">Appreciation</div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left">'.$faq["annualappreciation"].'%</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="annualappreciation" class="edit_fields" placeholder="$19,251" value="'.$faq["annualappreciation"].'"/>  

			</div>

		</div>

			

			<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">Rent Increase</div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"> '.$faq["annualrentincrease"].'%</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="annualrentincrease" class="edit_fields" placeholder="$19,251" value="'.$faq["annualrentincrease"].'"/>  

			</div>

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">Op. Expense Increase</div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left">'.$faq["annualoprating"].'%</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="'.$faq["annualoprating"].'" class="edit_fields" placeholder="$19,251" value="'.$faq["annualoprating"].'"/>  

			</div>

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6 no-pad-right">Selling Transaction Cost</div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left">'.$faq["selltransactioncost"].'%</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="selltransactioncost" class="edit_fields" placeholder="$19,251" value="'.$faq["selltransactioncost"].'"/>  

			</div>

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">Cap Gains Tax Rate  </div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left">'.$faq["sellcapitalgain"].'%</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="sellcapitalgain" class="edit_fields" placeholder="$19,251" value="'.$faq["sellcapitalgain"].'"/>  

			</div>

		</div>



		<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6 no-pad-right">Depreciation Recap Rate </div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left">'.$faq["selldepreciationrecap"].'%</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="selldepreciationrecap" class="edit_fields" placeholder="$19,251" value="'.$faq["selldepreciationrecap"].'"/>  

			</div>

		</div>

		

		<div class="row bottom-border padded-row">

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">State Tax Rate9</div> 

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left">'.$faq["sellstatetax"].'%</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 right no-padding-left"><input type="text" name="sellstatetax" class="edit_fields" placeholder="$19,251" value="'.$faq["sellstatetax"].'"/>  

			</div>

		</div>

	</div>

</div>

</div>



<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 no-pad-right">

	<p class="sub-hgeading"> Year One Performance</p>
<div class=" bordered-wrap col-md-12 col-sm-12 col-xs-12">
							<div class="row bottom-border padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">Gross Income  </div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right">$19,251</div> 
							</div>

							<div class="row bottom-border padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">Total Expenses</div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right">$8396</div> 
							</div>

							<div class="row bottom-border padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">Net Operating Income</div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right">$10854</div> 
							</div>

							<div class="row bottom-border padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">Before-Tax Cash Flow</div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right">$1,757</div> 
							</div>

							<div class="row bottom-border padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">Cash-On-Cash</div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right"> 3.4%</div> 
							</div>

							<div class="row bottom-border padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">After-Tax Cash Flow</div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right">$1,757</div> 
							</div>

							<div class="row bottom-border padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">Total Return</div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right">$4,553</div> 
							</div>

							<div class="row padded-row">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">Total ROI</div> 
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 right">8.8%</div> 
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad right-info-section mb10">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-padding-left no-pad-right up-btn">
								<button type="submit" class="large-btn">Update Now</button>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-pad-right more-btn">
								<button type="submit" class="large-btn">More Details</button>
							</div>
						</div>
</div>








';









print $output;





?>