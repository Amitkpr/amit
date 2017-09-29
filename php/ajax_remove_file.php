<?php

ob_start();
global $wpdb;
if(!isset($wpdb))
{
	require_once('../../../../wp-config.php');
	require_once('../../../../wp-includes/wp-db.php');
	
}
if (isset($_POST['file'])) {
	
    $file = UPLOADSPATH.$_POST['file'];
	$imgID = $_POST['imgid'];
	$wpdb->query('DELETE FROM property_imaes  WHERE id = "'.$imgID.'"');
    if(file_exists($file))
		unlink($file);
}