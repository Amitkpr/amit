<?php

class PerPage {

	public $perpage;

	

	function __construct() {

	require_once("../../../wp-load.php");
		$this->perpage = 1;

	}

	

	function getAllPageLinks($count,$href) {

		$output = '';

		if(!isset($_POST["page"])) $_POST["page"] = 1;

		if($this->perpage != 0){

			$pages  = ceil($count/$this->perpage);

		}

		if($pages>1) {

			if($_POST["page"] == 1) 

				$output = $output . '<span class="link first disabled">&#8810;</span><span class="link disabled">&#60;</span>';

			else	

				$output = $output . '<a class="link first" onclick="getresult(\'' . $href . (1) . '\')" >&#8810;</a><a class="link" onclick="getresult(\'' . $href . ($_POST["page"]-1) . '\')" >&#60;</a>';

			

			

			if(($_POST["page"]-3)>0) {

				if($_POST["page"] == 1)

					$output = $output . '<span id=1 class="link current">1</span>';

				else				

					$output = $output . '<a class="link" onclick="getresult(\'' . $href . '1\')" >1</a>';

			}

			if(($_POST["page"]-3)>1) {

					$output = $output . '<span class="dot">...</span>';

			}

			

			for($i=($_POST["page"]-2); $i<=($_POST["page"]+2); $i++)	{

				if($i<1) continue;

				if($i>$pages) break;

				if($_POST["page"] == $i)

					$output = $output . '<span id='.$i.' class="link current">'.$i.'</span>';

				else				

					$output = $output . '<a class="link" onclick="getresult(\'' . $href . $i . '\')" >'.$i.'</a>';

			}

			

			if(($pages-($_POST["page"]+2))>1) {

				$output = $output . '<span class="dot">...</span>';

			}

			if(($pages-($_POST["page"]+2))>0) {

				if($_POST["page"] == $pages)

					$output = $output . '<span id=' . ($pages) .' class="link current">' . ($pages) .'</span>';

				else				

					$output = $output . '<a class="link" onclick="getresult(\'' . $href .  ($pages) .'\')" >' . ($pages) .'</a>';

			}

			

			if($_POST["page"] < $pages)

				$output = $output . '<a  class="link" onclick="getresult(\'' . $href . ($_POST["page"]+1) . '\')" >></a><a  class="link" onclick="getresult(\'' . $href . ($pages) . '\')" >&#8811;</a>';

			else				

				$output = $output . '<span class="link disabled">></span><span class="link disabled">&#8811;</span>';

			

			

		}

		return $output;

	}

	function getPrevNext($count,$href,$data) {

		$User_saved_status = unserialize($data['saved_status_user_id']);


		global $current_user;
		$agentID = get_current_user_ID();//$current_user->ID;

	if(is_user_logged_in()){
		$loader = get_template_directory_uri().'/images/loading_heart.gif';
		if(is_array($User_saved_status) && in_array($agentID, $User_saved_status)){
			$star_status = '<i class="fa fa-star" data-id="'.$data['id'].'" rel="'.$agentID.'"  onclick="remove_saved(this);" aria-hidden="true"></i>
			<span class="loading_heart" style="display:none"><img src="'.$loader.'" ></span>';
		}else{
			$star_status = '<i class="fa fa-star-o" data-id="'.$data['id'].'" rel="'.$agentID.'" onclick="mark_saved(this);" aria-hidden="true"></i><span class="loading_heart" style="display:none"><img src="'.$loader.'" ></span>';
		}
	}else{
		$star_status = '';
	}

		$preveous = '';

		$next = '';

		if(!isset($_POST["page"])) $_POST["page"] = 1;

		if($this->perpage != 0)

			$pages  = ceil($count/$this->perpage);

		if($pages>1) {

			if($_POST["page"] == 1) 

				$preveous = '';//'<span class="link disabled first">Prev</span>';

			else	

				$preveous = 'onclick=getresult("previous")';

				/*$output = $output . '<a class="link first" onclick="getresult(\'' . $href . ($_POST["page"]-1) . '\')" >Prev</a>';*/			

			

			if($_POST["page"] < $pages)

				$next = 'onclick=getresult("next")';

				/*$output = $output . '<a  class="link" onclick="getresult(\'' . $href . ($_POST["page"]+1) . '\')" >Next</a>';*/

			else

			$next = '';				

				/*$output = $output . '<span class="link disabled">Next</span>';*/

		}

		if($_POST["page"] == ''){
			$page = 1;
		}
		else{
			$page = $_POST["page"];
		}



		$output = ('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bordered-wrap colored-bg no-pad mtb10">

								<span class="counts-slider">'.($page).' of '.$count.'</span>

									<div class="center-div">



										<a '.$preveous.' style="background:transparent;border:none;"><span>Prev</span><i class="fa fa-caret-left" aria-hidden="true"></i></a>



										<p class="center-text">'.$data['paddress'].'</p>

										<a '.$next.' style="background:transparent;border:none;"><i class="fa fa-caret-right" aria-hidden="true"></i><span>Next</span></a>



							<div style="background:transparent;border:none;float: right; font-size:27px" class="star_div">'.$star_status.'</div>

									</div>

								

								</div>

								</div>');



		return $output;

	}

}

?>