<?php

add_filter( 'redux-backup-description', 'admin_change_default_texts' );

function admin_change_default_texts(){

	return __('You can copy/download your current options settings. This is a backup solution in case anything goes wrong.', 'realestate');

}

/**

	ReduxFramework Sample Config File

	For full documentation, please visit http://reduxframework.com/docs/

**/





/** 

	Most of your editing will be done in this section.

	Here you can override default values, uncomment args and change their values.

	No $args are required, but they can be overridden if needed.

	

**/

$args = array();





// For use with a tab example below

$tabs = array();





// BEGIN Sample Config



// Default: true

$args['dev_mode'] = false;



// Set a custom option name. Don't forget to replace spaces with underscores!

$args['opt_name'] = 'realestate_options';



// Theme Panel Main Display Name

$args['display_name'] 	 = __('Real Estate Theme Options Panel','realestate');

$args['display_version'] = false;



// If you want to use Google Webfonts, you MUST define the api key.

$args['google_api_key']  = 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII';



// Define the starting tab for the option panel.

// Default: '0';

$args['last_tab'] = '0';



// Default: 'standard'

$args['admin_stylesheet'] = 'standard';



// Default: null

$args['import_icon_class'] = 'el-icon-large';



// Set a custom menu icon.

$args['menu_icon']  = get_template_directory_uri() .'/images/theme_options.png';



// Set a custom title for the options page.

// Default: Options

$args['menu_title'] = __('Theme Options', 'realestate');



// Set a custom page title for the options page.

// Default: Options

$args['page_title'] = __('Theme Options', 'realestate');



// Set a custom page slug for options page (wp-admin/themes.php?page=***).

// Default: redux_options

$args['page_slug']  = 'realestate_options';



// Show Default

$args['default_show'] = false;



// Default Mark

$args['default_mark'] = '';



// Set a custom page icon class (used to override the page icon next to heading)

$args['page_icon'] = 'icon-themes';



// Declare sections array

$sections = array();







// General -------------------------------------------------------------------------- >	

$sections[] = array(

	'title' => __('Header', 'realestate'),

	'header' => __('Welcome to the realestate Options Framework', 'realestate'),

	'desc' => '',

	'icon_class' => 'el-icon-large',

	'icon' => 'el-icon-flag',

	'submenu' => true,

	'fields' => array(

		

		array(

			'id'=>'custom_logo',

			'url'=> true,

			'type' => 'media', 

			'title' => __('Website Logo', 'realestate'),

			'default' =>'',

			'subtitle' => __('Upload custom logo to your website. (Width X Height : 213 x 40)', 'realestate'),

		),
		array(

			'id'=>'favicon',

			'url'=> true,

			'type' => 'media', 

			'title' => __('Your Favicon', 'realestate'),

			'default' => array( 'url' => get_template_directory_uri() .'/images/favicon.png' ),

			'subtitle' => __('Upload a file( png, ico, jpg, gif or bmp ) from your computer (maximum size:1MB ).', 'realestate'),

		),
		
	),

);







// Footer -------------------------------------------------------------------------- >	

$sections[] = array(

	'icon' => 'el-icon-bookmark',

	'icon_class' => 'el-icon-large',

    'title' => __('Footer Section', 'realestate'),

	'submenu' => true,

	'fields' => array(

		
		array(

			'id'=>'footer_content',

 			'type' => 'editor',      

			'title' => __('Footer Content', 'realestate'),

 			'subtitle' => __('Desciption', 'realestate'),

 			'desc' => "",

			'default' => ""

 		),	
		
		array(

			'id'=>'realestate_footer_followus_title',

		    'url'=> true,

			'type' => 'text', 

			'title' => __('Footer Followus Title', 'realestate'),

			'subtitle' => __('Add Footer Followus Titl here', 'realestate'),

			'default' =>""

		),
		
		array(

			'id'=>'realestate_footer_followus_fb_url',

		    'url'=> true,

			'type' => 'text', 

			'title' => __('FaceBook URL', 'realestate'),

			'subtitle' => __('Add FaceBook Url Here', 'realestate'),

			'default' =>""

		),
		
		array(

			'id'=>'realestate_footer_followus_tw_url',

		    'url'=> true,

			'type' => 'text', 

			'title' => __('Twitter URL', 'realestate'),

			'subtitle' => __('Add Twitter Url Here', 'realestate'),

			'default' =>""

		),
		
		array(

			'id'=>'realestate_footer_followus_insta_url',

		    'url'=> true,

			'type' => 'text', 

			'title' => __('Instagram URL', 'realestate'),

			'subtitle' => __('Add Instagram Url Here', 'realestate'),

			'default' =>""

		),
		
		
				
	)

);

global $ReduxFramework;

$ReduxFramework = new ReduxFramework($sections, $args, $tabs);



// Function used to retrieve theme option values

if ( ! function_exists('realestate_options') ) {

	function realestate_options($id, $fallback = false, $param = false ) {

		global $realestate_options;

		if ( $fallback == false ) $fallback = '';

		$output = ( isset($realestate_options[$id]) && $realestate_options[$id] !== '' ) ? $realestate_options[$id] : $fallback;

		if ( !empty($realestate_options[$id]) && $param ) {

			$output = $realestate_options[$id][$param];

		}

		return $output;

	}

}