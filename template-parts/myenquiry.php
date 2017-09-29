<?php
/**
 * Template Name: My Enquiry
 *
 */

get_header(); 


?>
<style>
.myenquiry_list_table{margin:30px 0;}

/*Listing table CSS, June 9,2017 */
.myenquiry_list_table{
	font-family: "RubikRegular";
}
.myenquiry_list_table #myTable{
	font-size:15px;
}
.myenquiry_list_table td, .myenquiry_list_table th {
    border: 1px solid rgb(222, 222, 222);
    padding: 10px 5px;
    text-align: center;
    color: #373737;
}
.myenquiry_list_table #myTable_length select{
	margin: 0 5px !important;
    padding: 5px !important;
	border-radius: 4px;
	border-color:rgb(222, 222, 222);
	outline:none;
}
.myenquiry_list_table #myTable_filter input {
    border: 1px solid rgb(222, 222, 222);
    height: 36px;
    padding: 8px;
    font-weight: normal;
    color: #595959;
	margin-bottom:15px;
	border-radius: 5px;
}
.myenquiry_list_table #myTable_info{
    font-weight: normal;
    color: #515151;
	padding:10px 0;
}
.myenquiry_list_table .action_wrapper{
	margin:auto;
}
.action_wrapper .action_container i{
	color: rgb(255, 255, 255);
    font-size: 14px;
    padding: 10px;
    margin: 4px;
}
.action_wrapper .action_container .fa_view{
	background: #3AB608;
}
.action_wrapper .action_container .fa_edit{
	background: #ffa500;
}
.action_wrapper .action_container .fa_del{
	background: #ea0011;
}
.myenquiry_list_table #myTable_paginate{
	padding:10px 0;
}
.myenquiry_list_table #myTable_paginate a:hover,.myenquiry_list_table #myTable_paginate a:active,.myenquiry_list_table #myTable_paginate a:focus,.myenquiry_list_table .paginate_button.current,.myenquiry_list_table #myTable_paginate span a.paginate_button.current {
    background: rgb(235, 0, 17) none repeat scroll 0 0 !important;
    border: 1px solid #fff !important;
    color: rgb(255, 255, 255) !important;
}
.myenquiry_list_table #myTable_paginate a.paginate_button.disabled{
	cursor:not-allowed !important;
}

</style>
<div class="container">
	
		<?php 
		
		global $wpdb;
		if(isset($_GET['id']) && $_GET['id'] !=''){
			
		?>
	<div class="myenquiry_list_table">
		<table id="myTable">
			<thead>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Phone No.</th>
					<th>Email</th>
					<th>Message</th>
					<th>View/Edit/Delete</th>
				</tr>
			</thead>
			<tbody>
		<?php	
			$id = base64_decode($_GET['id']);
			$get_data = "SELECT * FROM wp_db7_forms";
			$data = $wpdb->get_results($get_data);
		
			$i = 1;
			foreach($data as $dataVals){
				$data = unserialize($dataVals->form_value);
				$dataAgentID = $data['user_iD'];
				$senderEmailID = $data['email-993'];
				$senderContactno = $data['tel-513'];
				$senderName = $data['text-459'];
				$senderMessage = $data['your-message'];
				if($dataAgentID == $id){
				echo'<tr>
					<td>'.$i.'</td>
					<td>'.$senderName.'</td>
					<td>'.$senderContactno.'</td>
					<td>'.$senderEmailID.'</td>
					<td>'.$senderMessage.'</td>
					<td>
						<div class="action_wrapper">
							<a target="_blank" class="action_container" data-toggle="tooltip" title="" data-original-title="View"><i class="fa fa-eye fa_view"></i>
							</a>
							
							<a target="_blank" class="action_container" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-pencil fa_edit" aria-hidden="true"></i>
							</a> 
							
							<a class="action_container" data_id="NTE=" data-toggle="tooltip" title="" data-original-title="Delete"><i class="fa fa-trash fa_del"></i>
							</a>
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
	<?php	
		} 
	
	?>
	
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
});
</script>
<?php 

get_footer(); ?>