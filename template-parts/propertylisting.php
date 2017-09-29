<?php
/**
 * Template Name: property listing
 *
 */

get_header(); 


?>

<div class="container">
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#sign_popup">signup</button>

  <!-- Modal -->
 
  
</div>


<div class="container">
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#loginModal">login</button>

  <!-- Modal -->
  
  
</div> 


<div class="container">
	<div class="property_list_table">
	<table id="myTable">
		<thead>
			<tr>
				<th>No.</th>
				<th>Name</th>
				<th>Beds / Baths</th>
				<th>Price</th>
				<th>View/Edit/Delete</th>
			</tr>
		</thead>
	<tbody>
	<?php 
					global $wpdb;
					$query = "select user_id,beds,home_type,full_baths from wp_home_facts where user_id = $userAgentID";
					$results = $wpdb->get_results($query);
					$i = 1;
					foreach($results as $result){
						$name = $result->home_type;
						$bed = $result->beds;
						$baths = $result->full_baths;
						if($bed > 1){
							$bedResult = $bed.' Beds';
						}else{
							$bedResult = $bed.' Bed';
						}
						
						if($baths > 1){
							$bathsResult = $baths.' Baths';
						}else{
							$bathsResult = $baths.' Bath';
						}
				?>
			<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $name; ?></td>
			<td><?php echo $bedResult.', '.$bathsResult; ?></td>
			<td>Price</td>
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
		</tr>
				<?php
				$i++;
				} ?>
	
		
	</tbody>
	</table>
	</div>
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