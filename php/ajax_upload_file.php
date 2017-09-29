<?php

    include('class.fileuploader.php');
	
	ob_start();
	global $wpdb;
	if(!isset($wpdb))
	{
		require_once('../../../../wp-config.php');
		require_once('../../../../wp-includes/wp-db.php');
		
	}

	
/* pt($_REQUEST);
die; */




	
    $FileUploader = new FileUploader('files', array(
        'uploadDir' => UPLOADSPATH,
        'title' => 'auto',
		/* 'editor' => array(
			// image maxWidth in pixels {null, Number}
			'maxWidth' => null,
			// image maxHeight in pixels {null, Number}
			'maxHeight' => null,
			// crop image {Boolean}
			'crop' => false,
			// image quality after save {Number}
			'quality' => 90
		), */
    ));
	
	/* if(isset($_GET['tag']) && $_GET['tag'] == 'updateproperty'){
		
		$propertyID = base64_decode($_GET['propertyID']);
		$data = array();
		$data = $FileUploader->upload();
		$userID = base64_decode($_GET['userID']);
		$inser_url = site_url().'/wp-content/uploads/properties_gallery/'.$data['files']['0']['name'];
		
		if(!empty($inser_url)){
			
			$arrayuPropertIamges = array();
			$arrayuPropertIamges['user_id'] = $userID;
			$arrayuPropertIamges['property_id'] = $propertyID;
			$arrayuPropertIamges['image'] = $inser_url;
			$arrayuPropertIamges['name'] = $data['files']['0']['name'];
			$wpdb->insert('property_imaes',$arrayuPropertIamges);
			
		}
		
	}else{ */
			// call to upload the files
		$data = array();
		$data = $FileUploader->upload();
		
	/* 	$userID = base64_decode($_GET['userID']);
		
		
		$inser_url = site_url().'/wp-content/uploads/properties_gallery/'.$data['files']['0']['name'];
		
		if(!isset($_SESSION['lastpropertyid'])){
			
			$imagesArray = array();
			$imagesArray['images'] = '1';
			$wpdb->insert('wp_home_facts',$imagesArray);
			$InsertID = $wpdb->insert_id;
			session_start();
			$_SESSION['lastpropertyid'] = $InsertID;
			
			
			
		}else if(isset($_SESSION['lastpropertyid']) && $_SESSION['lastpropertyid'] == ''){
			
			$lastInsertID = $_SESSION['lastpropertyid'];
			$getImages = "SELECT images FROM wp_home_facts WHERE id = '".$lastInsertID."'";
			$results = $wpdb->get_row($getImages);
			if($results){
				$arrayPropertIamges = array();
				$arrayPropertIamges['user_id'] = $userID;
				$arrayPropertIamges['property_id'] = $_SESSION['lastpropertyid'];
				$arrayPropertIamges['image'] = $inser_url;
				$arrayPropertIamges['name'] = $data['files']['0']['name'];
				$wpdb->insert('property_imaes',$arrayPropertIamges);
				$data['image_id'] = $wpdb->insert_id;	
			}	
			
		} */
	/* } */
	echo json_encode($data);
	exit;