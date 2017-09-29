<?php
/**
 * Template Name: Online Real Estate Calculator Results
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
										<td>43234554</td>
									</tr>
									<tr>
										<td>Building Value (75%)</td>
										<td>43234554</td>
									</tr>
									<tr>
										<td>Closing Cost</td>
										<td>43234554</td>
									</tr>
									<tr>
										<td>Total Cost</td>
										<td>43234554</td>
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
										<td>43234554</td>
									</tr>
									<tr>
										<td>Downpayment</td>
										<td>43234554</td>
									</tr>
									<tr>
										<td>Monthly Mortgage Payment</td>
										<td>43234554</td>
									</tr>
									<tr>
										<td>Cash Outlay</td>
										<td>43234554</td>
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
										<td>15%</td>
									</tr>
									<tr>
										<td>Gross Rent Multiplier</td>
										<td>0.4%</td>
									</tr>
									<tr>
										<td>Cap Rate %</td>
										<td>0.12%</td>
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
										<td>$96,000</td>
									</tr>
									<tr>
										<td>Depreciation Yearly</td>
										<td>$3,491</td>
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
										<td>Intial Purchase Price</td>
										<td>43234554</td>
									</tr>
									<tr>
										<td>Purchase Closing Costs</td>
										<td>43234554</td>
									</tr>
									<tr>
										<td>Intail Tax Basis</td>
										<td>43234554</td>
									</tr>
									<tr>
										<td>Net ROI After Sell (3y)</td>
										<td>-9.94%</td>
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
								<tbody>
									<tr>
										<td>Net Operating Income</td>
										<td>$7,041</td>
									</tr>
									<tr>
										<td>Before-Tax Cash Flow (Monthly)</td>
										<td>$68</td>
									</tr>
									<tr>
										<td>After-Tax Cash Flow (Monthly)</td>
										<td>$68</td>
									</tr>
									<tr>
										<td>CoC %</td>
										<td>2.68%</td>
									</tr>
									<tr>
										<td>Total ROI</td>
										<td>8.10%</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main><!-- .site-main -->
</div><!-- .content-area -->
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.heading_details .fa-plus').click(function(){
		jQuery(this).toggleClass('fa-plus')
		jQuery(this).toggleClass('fa-minus')
	})

})
</script>

	<div class="main_container container-fluid">
		<div class="row">
			<div class="container">
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
										<th>Year 1</th>
										<th>Year 2</th>
										<th>Year 3</th>
										<th>Year 5</th>
										<th>Year 6</th>
										<th>Year 7</th>
										<th>Year 9</th>
										<th>Year 10</th>
										<th>Year 11</th>
										<th>Year 12</th>
										<th>Year 13</th>
										<th>Year 14</th>
										<th>Year 15</th>
										<th>Year 16</th>
										<th>Year 17</th>
										<th>Year 18</th>
										<th>Year 19</th>
										<th>Year 20</th>
										<th>Year 21</th>
										<th>Year 22</th>
										<th>Year 23</th>
										<th>Year 24</th>
										<th>Year 25</th>
										<th>Year 26</th>
										<th>Year 27</th>
										<th>Year 28</th>
										<th>Year 29</th>
										<th>Year 30</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Gross Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
								</tbody>
							</table>
						</div>
						<a href="#" class="visulise_btn">visualize</a>
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
										<th>Year 1</th>
										<th>Year 2</th>
										<th>Year 3</th>
										<th>Year 5</th>
										<th>Year 6</th>
										<th>Year 7</th>
										<th>Year 9</th>
										<th>Year 10</th>
										<th>Year 11</th>
										<th>Year 12</th>
										<th>Year 13</th>
										<th>Year 14</th>
										<th>Year 15</th>
										<th>Year 16</th>
										<th>Year 17</th>
										<th>Year 18</th>
										<th>Year 19</th>
										<th>Year 20</th>
										<th>Year 21</th>
										<th>Year 22</th>
										<th>Year 23</th>
										<th>Year 24</th>
										<th>Year 25</th>
										<th>Year 26</th>
										<th>Year 27</th>
										<th>Year 28</th>
										<th>Year 29</th>
										<th>Year 30</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Gross Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
								</tbody>
							</table>
						</div>
						<a href="#" class="visulise_btn">visualize</a>
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
										<th>Year 1</th>
										<th>Year 2</th>
										<th>Year 3</th>
										<th>Year 5</th>
										<th>Year 6</th>
										<th>Year 7</th>
										<th>Year 9</th>
										<th>Year 10</th>
										<th>Year 11</th>
										<th>Year 12</th>
										<th>Year 13</th>
										<th>Year 14</th>
										<th>Year 15</th>
										<th>Year 16</th>
										<th>Year 17</th>
										<th>Year 18</th>
										<th>Year 19</th>
										<th>Year 20</th>
										<th>Year 21</th>
										<th>Year 22</th>
										<th>Year 23</th>
										<th>Year 24</th>
										<th>Year 25</th>
										<th>Year 26</th>
										<th>Year 27</th>
										<th>Year 28</th>
										<th>Year 29</th>
										<th>Year 30</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Gross Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
								</tbody>
							</table>
						</div>
						<a href="#" class="visulise_btn">visualize</a>
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
										<th>Year 1</th>
										<th>Year 2</th>
										<th>Year 3</th>
										<th>Year 5</th>
										<th>Year 6</th>
										<th>Year 7</th>
										<th>Year 9</th>
										<th>Year 10</th>
										<th>Year 11</th>
										<th>Year 12</th>
										<th>Year 13</th>
										<th>Year 14</th>
										<th>Year 15</th>
										<th>Year 16</th>
										<th>Year 17</th>
										<th>Year 18</th>
										<th>Year 19</th>
										<th>Year 20</th>
										<th>Year 21</th>
										<th>Year 22</th>
										<th>Year 23</th>
										<th>Year 24</th>
										<th>Year 25</th>
										<th>Year 26</th>
										<th>Year 27</th>
										<th>Year 28</th>
										<th>Year 29</th>
										<th>Year 30</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Gross Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
								</tbody>
							</table>
						</div>
						<a href="#" class="visulise_btn">visualize</a>
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
										<th>Year 1</th>
										<th>Year 2</th>
										<th>Year 3</th>
										<th>Year 5</th>
										<th>Year 6</th>
										<th>Year 7</th>
										<th>Year 9</th>
										<th>Year 10</th>
										<th>Year 11</th>
										<th>Year 12</th>
										<th>Year 13</th>
										<th>Year 14</th>
										<th>Year 15</th>
										<th>Year 16</th>
										<th>Year 17</th>
										<th>Year 18</th>
										<th>Year 19</th>
										<th>Year 20</th>
										<th>Year 21</th>
										<th>Year 22</th>
										<th>Year 23</th>
										<th>Year 24</th>
										<th>Year 25</th>
										<th>Year 26</th>
										<th>Year 27</th>
										<th>Year 28</th>
										<th>Year 29</th>
										<th>Year 30</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Rental Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
									<tr>
										<td>Gross Income</td>
										<td>$1,200</td>
										<td>$14,400</td>
										<td>$14,688</td>
										<td>$14,982</td>
										<td>$14,982</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,281</td>
										<td>$15,899</td>
										<td>$16,217</td>
										<td>$16,541</td>
									</tr>
								</tbody>
							</table>
						</div>
						<a href="#" class="visulise_btn">visualize</a>
					</div>
				</div>
				<div class="center-blcok text-center"><a href="#" class="visulise_btn">SAVE RESULTS</a>
				<a href="#" class="visulise_btn back_so">GO BACK</a></div>
			</div>
		</div>
	</div>
	<?php get_footer(); ?>
