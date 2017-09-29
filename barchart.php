<div class="heading_details">
					<h4>Graphs <i data-toggle="collapse" data-target="#visualize1" class="fa fa-plus" aria-hidden="true"></i></h4>
				</div>
				<div class="details_table_row collapse" id="visualize1">
					<div class="table-responsive">
						<div class="row margin0 marginbottom MainBarWrap">
						<h4 class="sectionTitle">Revenue</h4>
						<div class="row margin0 marginbottom">
						<?php 
						/***************Barchart for Rental Income**********/
							$revenueYearCalculationsFunction = revenueYearCalculations('barchart');
							$rentalIncome = array(
								'maintitle'=>'Rental Income',
								'class1'=>'rentalincome', 
								'toggleid'=>'rentalincome1',
								'chartfunction'=>'rentalincomeBarchart',
								'getchart'=>$revenueYearCalculationsFunction,
								'toptitle'=>'Rental Income According To Year',
								'leftitle'=>'Rental Income',
								'divid'=>'revenue',
							);
							get_barchart_by_data($rentalIncome);
							/***************Barchart for Vacancy Rate**********/
							$VacancyRateResult = array(
								'maintitle'=>'Vacancy Rate',
								'class1'=>'VacancyRate', 
								'toggleid'=>'VacancyRate1',
								'chartfunction'=>'VacancyRatechart',
								'getchart'=>$uestd,
								'toptitle'=>'Vacancy Rate According To Year',
								'leftitle'=>'Vacancy Rate',
								'divid'=>'revenue',
							);
							get_barchart_by_data($VacancyRateResult);
							/***************Barchart for Vacancy (Loss)**********/
							$VacancyLossFunction = revenueVacancyLossCalculations('barchart');
							$VacancyLossResult = array(
								'maintitle'=>'Vacancy (Loss)',
								'class1'=>'VacancyLoss', 
								'toggleid'=>'VacancyLoss1',
								'chartfunction'=>'VacancyLossBarchart',
								'getchart'=>$VacancyLossFunction,
								'toptitle'=>'Vacancy (Loss) According To Year',
								'leftitle'=>'Vacancy (Loss)',
								'divid'=>'revenue',
							);
							get_barchart_by_data($VacancyLossResult);
							/***************Barchart for Gross Income**********/
							$GrossIncomeFunction = revenueGrossIncomeCalculations('barchart');
							$GrossIncomeResult = array(
								'maintitle'=>'Gross Income',
								'class1'=>'GrossIncome', 
								'toggleid'=>'GrossIncome1',
								'chartfunction'=>'GrossIncomeBarchart',
								'getchart'=>$GrossIncomeFunction,
								'toptitle'=>'Gross Income According To Year',
								'leftitle'=>'Gross Income',
								'divid'=>'revenue',
							);
							get_barchart_by_data($GrossIncomeResult);
							?>
                        </div>	
						<div id="DynamicAppendGraph_revenue" class="AppendGraph"></div>
						</div>
						<div class="row margin0 marginbottom MainBarWrap">
							<h4 class="sectionTitle">Operating Expenses</h4>
						
                           <div class="row margin0 marginbottom">
                           	<!-- /***************Barchart for Property Taxes**********/ -->
							<?php 
							$PropertyTaxeschartFunction = operatingPropertyTaxesYearly('barchart');
							$IPropertyTaxeschartFunction = array(
								'maintitle'=>'Property Taxes',
								'class1'=>'PropertyTaxes', 
								'toggleid'=>'PropertyTaxes1',
								'chartfunction'=>'PropertyTaxesBarchart',
								'getchart'=>$PropertyTaxeschartFunction,
								'toptitle'=>'Property Taxes According To Year',
								'leftitle'=>'Property Taxes',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_data($IPropertyTaxeschartFunction);
							/***************Barchart for Insurance**********/
							$InsuranceYearlychartFunction = operatingInsuranceYearly('barchart');
							$InsuranceYearly = array(
								'maintitle'=>'Insurance',
								'class1'=>'insurance', 
								'toggleid'=>'insurance1',
								'chartfunction'=>'insuranceBarchart',
								'getchart'=>$InsuranceYearlychartFunction,
								'toptitle'=>'Insurance According To Year',
								'leftitle'=>'Insurance',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_data($InsuranceYearly);
							/***************Barchart for Repairs**********/
							$repairsBarchart = operatingRepairsYearly('barchart');
							$repairsBarchartResult = array(
								'maintitle'=>'Repairs',
								'class1'=>'repairs', 
								'toggleid'=>'repairs1',
								'chartfunction'=>'repairsBarchart',
								'getchart'=>$repairsBarchart,
								'toptitle'=>'Repairs Values According To Year',
								'leftitle'=>'Repairs Values',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_data($repairsBarchartResult);
							/***************Barchart for Utilities**********/
							$UtilitiesFunction = operatingUtilitiesYearly('barchart');
							$UtilitiesYearly = array(
								'maintitle'=>'Utilities',
								'class1'=>'utilities', 
								'toggleid'=>'utilities1',
								'chartfunction'=>'utilitiesBarchart',
								'getchart'=>$UtilitiesFunction,
								'toptitle'=>'Utility Values According To Year',
								'leftitle'=>'Utility Values',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_data($UtilitiesYearly);
							?>
						</div>
						<div class="row margin0 marginbottom">	
							<?php 
							/***************Barchart for Property Mgmt Fee**********/
							$PropertyMgmt = operatingPropertyMangementFeeYearly('barchart');
							$PropertyMgmtResult = array(
								'maintitle'=>'Property Mgmt Fee',
								'class1'=>'PropertyMgmt', 
								'toggleid'=>'PropertyMgmt1',
								'chartfunction'=>'PropertyMgmtFun',
								'getchart'=>$PropertyMgmt,
								'toptitle'=>'Property Values According To Year',
								'leftitle'=>'Property Mgmt Fee',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_data($PropertyMgmtResult);
							?>
							<!-- BARCHART FOR operatingHOAYearly -->
							<?php 
							$HOA = operatingHOAYearly('barchart');
							$HOAResult = array(
								'maintitle'=>'HOA',
								'class1'=>'HOA', 
								'toggleid'=>'HOA1',
								'chartfunction'=>'HOAFun',
								'getchart'=>$HOA,
								'toptitle'=>'HOA Values According To Year',
								'leftitle'=>'HOA',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_data($HOAResult);
							?>
						<!-- /***************Other Percentile Cost**********/ -->
							<?php 
							$OtherPercentileCost = operatingOtherPercentileCostYearly('barchart');
							$OtherPercentileCost2Result = array(
								'maintitle'=>'Other Percentile Cost',
								'class1'=>'OtherPercentileCost', 
								'toggleid'=>'OtherPercentileCost1',
								'chartfunction'=>'OtherPercentileCostFun',
								'getchart'=>$OtherPercentileCost,
								'toptitle'=>'Other Percentile Cost Values According To Year',
								'leftitle'=>'Other Percentile Cost',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_data($OtherPercentileCost2Result);
							?>
							<!-- BARCHART FOR Other Fixed Cost -->
							<?php 
							$OtherFixedCost = operatingOtherFixedCostYearly('barchart');
							$OtherFixedCostResult = array(
								'maintitle'=>'Other Fixed Cost',
								'class1'=>'OtherFixedCost', 
								'toggleid'=>'OtherFixedCost1',
								'chartfunction'=>'OtherFixedCostFun',
								'getchart'=>$OtherFixedCost,
								'toptitle'=>'Other Fixed Cost According To Year',
								'leftitle'=>'Other Fixed Cost',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_data($OtherFixedCostResult);
							?>
						</div>
						<div class="row margin0 marginbottom">	
						<!-- BARCHART FOR Total expenses -->
							<?php 
							$TotalExpensesMgmt = operatingTotalExpensesCalculationSum('barchart');
							$TotalExpensesMgmtResult = array(
								'maintitle'=>'Total Expenses',
								'class1'=>'TotalExpenses', 
								'toggleid'=>'TotalExpenses1',
								'chartfunction'=>'TotalExpensesFun',
								'getchart'=>$TotalExpensesMgmt,
								'toptitle'=>'Total Expenses According To Year',
								'leftitle'=>'Total Expenses',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_data($TotalExpensesMgmtResult);
							?>
                        <!-- BARCHART FOR Expenses (incl Vacancy) as % of Gross Income -->
							<?php 
							$ExpensesinclVacancy = operatingTotalExpensesIncludingVacancy('barchart');
							$ExpensesinclVacancyResult = array(
								'maintitle'=>'Expenses (incl Vacancy) as % of Gross Income',
								'class1'=>'ExpensesinclVacancy', 
								'toggleid'=>'ExpensesinclVacancy1',
								'chartfunction'=>'ExpensesinclVacancyFun',
								'getchart'=>$ExpensesinclVacancy,
								'toptitle'=>'Expenses (incl Vacancy) as % of Gross Income According To Year',
								'leftitle'=>'Expenses (incl Vacancy)',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_data($ExpensesinclVacancyResult);
							?>
							<!-- BARCHART FOR Net Operating Income (NOI) -->
							<?php 
							$NetOperatingIncome = operatingNetOperatingIncomeNOI('barchart');
							$NetOperatingIncomeResult = array(
								'maintitle'=>'Net Operating Income (NOI)',
								'class1'=>'NetOperatingIncome', 
								'toggleid'=>'NetOperatingIncome1',
								'chartfunction'=>'NetOperatingIncomeFun',
								'getchart'=>$NetOperatingIncome,
								'toptitle'=>'Net Operating Income (NOI) According To Year',
								'leftitle'=>'Net Operating Income (NOI)',
								'divid'=>'OpsExpensive',
							);
							get_barchart_by_data($NetOperatingIncomeResult);
							?>

							</div>

						
						
						
							<div id="DynamicAppendGraph_OpsExpensive" class="AppendGraph"></div>
					</div>
				</div>