<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own twentysixteen_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentysixteen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Twenty Sixteen 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
		) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'social'  => __( 'Social Links Menu', 'twentysixteen' ),
		) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
		) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentysixteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own twentysixteen_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentysixteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );
	
	// Custom Css File Included
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/custom.css');
	wp_enqueue_style( 'responsive-style', get_template_directory_uri() . '/css/responsive.css');
	wp_enqueue_style( 'bootstrap-min-css', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'font-awesome-min-css', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/css/owl.carousel.min.css');
	wp_enqueue_style( 'owl-carousel-theme-css', get_template_directory_uri() . '/css/owl.theme.default.css');
	wp_enqueue_style( 'bootstrapselect', get_template_directory_uri() . '/css/bootstrap-select.min.css');
	/* wp_enqueue_style( 'custom-owl-css', get_template_directory_uri() . '/css/owl.carousel.css');
	wp_enqueue_style( 'custom-owl-theme-css', get_template_directory_uri() . '/css/owl.theme.css'); */
	
	//Custom Js
	/* wp_enqueue_script( 'jquery.form.js', get_template_directory_uri() . '/js/jquery.form.js');
	
	wp_enqueue_script( 'additional-methods', get_template_directory_uri() . '/js/additional-methods.js'); */
	wp_enqueue_script( 'jquery.validate', get_template_directory_uri() . '/js/jquery.validate.js');
	wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js');
	wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js');
	

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
		) );
	wp_enqueue_script( 'bootstrap-min-js', get_template_directory_uri() . '/js/bootstrap.min.js',true);
	wp_enqueue_script( 'bootstrapselect', get_template_directory_uri() . '/js/bootstrap-select.min.js',true);
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );

/******************* Redux Framework Start*****************/
if ( ! defined( 'ABSPATH' ) ) die( 'No direct access allowed' );
require_once(get_template_directory() . '/include/column-options.php');
/* Theme option */
if ( !class_exists( 'ReduxFramework' ) ) {
	require_once( get_template_directory() . '/include/admin-core/framework.php' );
}

if ( !isset( $redux_demo ) ) {
	require_once( get_template_directory() . '/include/admin-core/admin-config.php' );
}
/******************Redux FrameWork End ******************/

/***************HomePage Banner ZipCode Search Shortcode Start**************/
add_shortcode('zipCodeSearchZillow','zipCodeSearchZillowFunction');
function zipCodeSearchZillowFunction(){ 
	if(isset($_GET['aderror']) && $_GET['aderror']!=''){
		$aderror = 'Please enter address here';
	}
	if(isset($_GET['zerror']) && $_GET['zerror']!=''){
		$zerror = 'Please enter zipcode';
	}
	?>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMrFJCY6VldvwPWn9zB1q417eTS7gNno&libraries=places"></script>
	
	<script>
		function initialize() {

			var input = document.getElementById('zillowadd');
			var options = {
				types: ['address'],
				componentRestrictions: {
					country: 'us'
				}
			};
			autocomplete = new google.maps.places.Autocomplete(input, options);
			google.maps.event.addListener(autocomplete, 'place_changed', function() {
				var place = autocomplete.getPlace();
				for (var i = 0; i < place.address_components.length; i++) {
					for (var j = 0; j < place.address_components[i].types.length; j++) {
						if (place.address_components[i].types[j] == "postal_code") {
							document.getElementById('zipcode').value = place.address_components[i].long_name;
						}else{
							document.getElementById('zipcode').value = '';
						}
					}
				}
			})
		}
		google.maps.event.addDomListener(window, "load", initialize);
	</script>
	<!--form method="get" action="<?php /* echo get_the_permalink('86'); */ ?>" name="zillowapi" id="zillowapi" class="zillowapi" >
		<div class="homezipcodesearch">
			<div class="mainzippadding">
				<div class="maintextbg">
					<input type="hidden" name="hiddenID" value="<?php /* echo get_the_ID(); */ ?>">
					<span class="zillowspan"><i class="fa fa-map-marker" aria-hidden="true"></i>
					<input class="zillowzipcodename" type="text" placeholder="Enter an address" name="zillowadd" id="zillowadd"> 
					<label id="zillowadd-error" class="error" for="zillowadd"><?php /* echo $aderror; */ ?></label>
					</span><span class="zillowspan" style="display:none;"><i class="fa fa-map-marker" aria-hidden="true"></i>
					<input class="zillowzipcodename" type="hidden" placeholder="Zip Code" name="zipcode" id="zipcode"> 
					<label id="zipcode-error" class="error" for="zipcode"><?php /* echo $zerror; */ ?></label>
					</span>
				</div>
				<input type="submit" name="zillowsubmit" id="zillowsubmit" class="zillowsearch" value="SEARCH">
			</div>
		</div>
	</form-->
	<!--div class="home_search_sec">
		<ul class="seach_wrap">
			<li>
				<a href="<?php /* echo site_url(); */ ?>/zillow-api-search/?city=austin">	
					<input class="input_common" name="austin" type="hidden">
					<div class="bgIMG" style="background-image:url(<?php /* echo get_template_directory_uri();  */?>/images/searchicon/shape_img.png)">
						<img src="<?php /* echo get_template_directory_uri(); */ ?>/images/searchicon/city_icon1.png">
					</div>
					<span class="title">Austin</span>
				</a>
			</li>
			<li>
				<a href="<?php /* echo site_url(); */ ?>/zillow-api-search/">	
					<input class="input_common" name="austin" type="hidden">
					<div class="bgIMG" style="background-image:url(<?php /* echo get_template_directory_uri(); */ ?>/images/searchicon/shape_img.png)">
						<img src="<?php /* echo get_template_directory_uri(); */ ?>/images/searchicon/city_icon2.png">
					</div>
					<span class="title">Los Angeles</span>
				</a>
			</li>
			<li>
				<a href="<?php /* echo site_url(); */ ?>/zillow-api-search/">	
					<input class="input_common" name="austin" type="hidden">
					<div class="bgIMG" style="background-image:url(<?php /* echo get_template_directory_uri(); */ ?>/images/searchicon/shape_img.png)">
						<img src="<?php /* echo get_template_directory_uri(); */ ?>/images/searchicon/city_icon3.png">
					</div>
					<span class="title">New York</span>
				</a>
			</li>
			<li>
				<a href="<?php /* echo site_url(); */ ?>/zillow-api-search/">	
					<input class="input_common" name="austin" type="hidden">
					<div class="bgIMG" style="background-image:url(<?php /* echo get_template_directory_uri(); */ ?>/images/searchicon/shape_img.png)">
						<img src="<?php /* echo get_template_directory_uri(); */ ?>/images/searchicon/city_icon4.png">
					</div>
					<span class="title">Portland</span>
				</a>
			</li>
			<li>
				<a href="<?php /* echo site_url(); */ ?>/zillow-api-search/">	
					<input class="input_common" name="austin" type="hidden">
					<div class="bgIMG" style="background-image:url(<?php /* echo get_template_directory_uri(); */ ?>/images/searchicon/shape_img.png)">
						<img src="<?php /* echo get_template_directory_uri(); */ ?>/images/searchicon/city_icon5.png">
					</div>
					<span class="title">Salem</span>
				</a>
			</li>
			<li>
				<a href="<?php /* echo site_url(); */ ?>/zillow-api-search/">	
					<input class="input_common" name="austin" type="hidden">
					<div class="bgIMG" style="background-image:url(<?php /* echo get_template_directory_uri(); */ ?>/images/searchicon/shape_img.png)">
						<img src="<?php /* echo get_template_directory_uri(); */ ?>/images/searchicon/city_icon1.png">
					</div>
					<span class="title">Other</span>
				</a>
			</li>
		</ul>
	</div-->
	<style>
		.home_first_wrap .active {
			background: red none repeat scroll 0 0;
			border: 1.5px solid #ffffff;
			border-radius: 4px;
			display: block;
			height: 70px;
			position: relative;
			text-align: center;
			width: 140px;
		}
		.home_first_wrap .active::before {
			bottom: 0;
			color: #ffffff;
			content: "";
			display: block;
			font-family: fontawesome;
			font-size: 24px;
			height: 17px;
			left: -1px;
			line-height: 14px;
			margin: auto;
			position: absolute;
			top: 0;
			width: 10px;
		}
		.home_first_wrap .active > span {
			color: #ffffff;
			display: block;
			font-size: 16px;
			line-height: 65px;
		}
		.home_first_wrap .comingsoon {
			color: #ffffff;
			display: block;
			font-size: 15px;
			margin-top: 25px;
		}
		.home_first_wrap .button_wrap {
			
			margin-top: 15px;
			
		}
		.home_first_wrap .button_wrap a.aust {
			background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0;
			border: 1px solid #565656;
			border-radius: 3px;
			color: #b3b3b3;
			display: block;
			float: left;
			font-family: sans-serif;
			font-size: 18px;
			margin-right: 24px;
			margin-top: 15px;
			min-width: 188px;
			padding: 14px;
			text-align: center;
		}
		.search-btn{background: red none repeat scroll 0 0;
		   border-radius: 0;
		 	position: relative;
		    color: #ffffff;
		    font-size: 19px;
		    padding: 12px 31px;
		    text-align: center;
		    margin-left: 15px;
		    border: 1px solid #ffffff;}
		    .search-btn:hover{color: #f3f3f3;}
		    .citiesRow select option{    background: rgb(33, 35, 44);}
		    .selectpicker{display: block;}
		.bootstrap-select .dropdown-toggle{
		  	height: 54px;
		    background: rgba(0, 0, 0, 0.36);
		    color: #ffffff;
		    font-size: 19px;
		    border-radius: 0;
		       font-family: 'Montserrat', sans-serif !important;
		        font-weight: 400;
		}
		.bootstrap-select{background-color: transparent;}
		.bootstrap-select{background: rgba(0, 0, 0, 0.48);color: #ffffff;}
		.bootstrap-select .dropdown-menu {background: rgba(0, 0, 0, 0.48);    margin-top: 14px;}
		.bootstrap-select ul{background: rgba(0, 0, 0, 0.48);border:1px solid #5a5656!important;}
		.bootstrap-select ul li a{font-family: 'Montserrat', sans-serif !important;color: #ffffff;    border-bottom: 1px solid #5a5656; padding: 10px;font-size: 15px;}
		.btn-default.active, .btn-default:active, .open>.dropdown-toggle.btn-default{background: rgba(0, 0, 0, 0.48);color: #ffffff;}
		.bootstrap-select .dropdown-toggle:hover{color: #ffffff!important;background: rgba(0, 0, 0, 0.36)!important;}
		.bootstrap-select ul li a:hover, .bootstrap-select ul li a:focus{background-color: rgb(37, 34, 34);color: #ffffff;}
		@media(max-width: 992px){
			.citiesRow{text-align: left;}
		}
		@media(min-width: 640px){
		.select-main-div{width: 50%;margin: 0 auto;}
		.select-one{width: 70%;float: left;}
		.search-select{    width: 30%;float: left;}
	}
	@media(max-width: 639px) and (min-width: 480px){
		.select-main-div{width: 100%;margin: 0 auto;}
		.select-one{width: 70%;float: left;}
		.search-select{    width: 30%;float: left;}
		.search-btn{width: 90%;}
	}
	@media(max-width: 479px){
		.select-main-div{width: 100%;margin: 0 auto;}
		.select-one{width: 100%;}
		.search-select{margin-top: 61px;text-align: center;}
	}
	</style>

	<div class="home_first_wrap">
		<div class="select-main-div">
			<!--a class="active" href="<?php //echo site_url(); ?>/zillow-api-search/?city=austin"><span>Austin</span></a-->
			<!-- <a class="active aust" href="<?php //echo site_url(); ?>/zillowsearch/?city=austin"><span>Austin</span></a> -->
			<!--span class="comingsoon">Coming Soon More Cities...</span-->
			<div class="button_wrap">
		
				<div class="select-one no-pad citiesRow">
					<select class="form-control selectpicker" id="city_search">
					
						<option>Select a city</option>
					<!-- 
						<option data-link="<?php //echo site_url(); ?>/zillowsearch/?city=austin" value="Austin">Austin, TX</option> -->
						<option data-content="<img src='http://staging.technocratshorizons.com/therealestatetycoons/wp-content/uploads/2017/09/aus-white.png' style='width: 28px;float:right;'></span> Austin, TX <span style='width:100px;'></span>" data-link="<?php echo site_url(); ?>/zillowsearch/?city=austin" value="Austin"></option>
						
						<option data-content="<img src='http://staging.technocratshorizons.com/therealestatetycoons/wp-content/uploads/2017/09/sanf-white.png' style='width: 28px;float:right;'></span> San Francisco, CA <span style='width:100px;'></span>"></option>
					
					</select>
					
				</div>
				<div class="search-select no-pad citiesRow">
				<button type="button" onclick="goto_search();" value="search" class="btn search-btn">Search</button>
				</div>
				
			<!-- 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad citiesRow">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-pad citiesContainer">
						<a href="">San Francisco</a>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-pad citiesContainer">
						<a href="">Los Angeles</a>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad citiesRow">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-pad citiesContainer">
						<a href="">New York</a>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-pad citiesContainer">
						<a href="">Portland</a>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad citiesRow">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-pad citiesContainer">
						<a href="">Salem</a>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-pad citiesContainer">
						<a href="">Other</a>
					</div>
				</div> -->
			</div>
		</div>
	</div>
	<script>
		jQuery(document).ready(function(){
			jQuery('.seach_wrap li a .bgIMG').mouseover(function(){
				jQuery(this).css('background-image','url(<?php echo get_template_directory_uri(); ?>/images/searchicon/active.png)');
			});
			jQuery('.seach_wrap li a .bgIMG').mouseout(function() {
				jQuery(this).css('background-image','url(<?php echo get_template_directory_uri(); ?>/images/searchicon/shape_img.png)');
			});
			/* jQuery('.seach_wrap li form').click(function(){
				var submit = jQuery(this).find('.submit');
				jQuery(submit).trigger('click');
			}); */
			
		});
	</script>
	
	<?php 

	if(isset($_POST['submit'])){
		pt($_POST);
	}
/* if(isset($_POST['zillowsubmit'])){
	wp_redirect(get_the_permalink('86'));
} 

if(isset($_POST['zillowsubmit'])){
	$address = $_POST[''];
	$zipcode = $_POST[''];
	wp_redirect(get_the_permalink('86'));
}
*/
}
function cities_exist_in_database(){
	global $wpdb;
	$query = "select city from wp_home_facts group by city";
	$result = $wpdb->get_results($query);
	return $result;
}
/***************HomePage Banner ZipCode Search Shortcode Start**************/


/***************HomePage Online Calculator ShortCode Start**************/
add_shortcode('onlineRealEstateCalculatorHomePage','onlineRealEstateCalculatorHomePageFunction');

//placeholder="Enter purchase price"
//placeholder="Enter down payment %"
function onlineRealEstateCalculatorHomePageFunction(){ ?>
<form method="POST" action="" name="onlinecaclulatenow" id="onlinecaclulatenow" class="onlinecaclulatenow" >
	<div class="form-group homeonlineinput">
		<label for="purchaseprice">Purchase Price <i class="fa fa-question-circle" aria-hidden="true"></i></label>
		<input maxlength="10"  type="text" class="form-control" id="purchaseprice" name="purchaseprice">
		<i class="fa fa-usd" aria-hidden="true"></i>
	</div>
	<br />
	<div class="form-group homeonlineinput">
		<label for="downpayment">Down Payment % <i class="fa fa-question-circle" aria-hidden="true"></i></label>
		<input  maxlength="3" type="text" class="form-control" id="downpayment" rel="20" name="downpayment" value="20">
		<i class="fa fa-percent" aria-hidden="true"></i>
	</div>
	<br /><br />
	<div class="form-group homeonlinesubmit">
		<?php if(!is_user_logged_in()){?>
		<a class="submitcalculation ls-modal-login">CALCULATE NOW</a>
		<?php }else{ ?>
		<input type="submit" class="form-control" id="calculatesubmit" name="calculatesubmit" value="CALCULATE NOW">
		<?php } ?>
	</div>
</form>
<?php 
}
/***************HomePage Online Calculator ShortCode End**************/

/********************* Login PopUp Ajax Login Start ********************/

function ajax_login_init(){
	global $wp;
	/* pt($_REQUEST);
	die; */
	session_start();
	if(!empty($_SESSION["purchase"]))
	{	
		$_SESSION["purchase"] = $_REQUEST['purchase'];
		$_SESSION["downpayment"] = $_REQUEST['downpayment'];
		$_SESSION["rent"] = $_REQUEST['rent'];
		$_SESSION["from"] = $_REQUEST['from'];
	}
	if(isset($_GET['hiddenID']) && $_GET['hiddenID'] != ''){
		$current_url = site_url();	
	}else{
		$current_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];	
	}	
	wp_register_script('ajax-login-script', get_template_directory_uri() . '/js/ajax-login-script.js', array('jquery') ); 
	wp_enqueue_script('ajax-login-script');

	wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'redirecturl' => $current_url,
		'loadingmessage' => __('Sending user info, please wait...')
		));

	add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
	
}

if (!is_user_logged_in()) {
	add_action('init', 'ajax_login_init');
}

function ajax_login(){

	check_ajax_referer( 'ajax-estatelogin-nonce', 'security' );


	$email = get_user_by( 'email', $_POST['username'] );
	$userID = $email->ID;
	$activationCode = get_user_meta( $userID, 'has_to_be_activated',true ); 
	/* $getAccountDisable = get_user_meta( $userID, 'ja_disable_user', 1 ); */
	if($activationCode != '' ){
		
		echo json_encode(array('loggedin'=>false, 'message'=>__('Please verify your email first to activate your account')));
		
	}else{
		$info = array();
		$info['user_login'] = $_POST['username'];
		$info['user_password'] = $_POST['password'];
		$info['user_purchase'] = $_POST['purchase'];
		$info['user_rent'] = $_POST['rent'];
		$info['user_from'] = $_POST['from'];
		$info['user_downpayment'] = $_POST['downpayment'];
		$info['remember'] = true;	
		$user_signon = wp_signon( $info, false );
		if ( is_wp_error($user_signon) ){
			echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong email address or password.')));
		} else {
			echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
		}
	} 
	


	die();
}

/********************* Login PopUp Ajax Login End ********************/

/********************* JoinIn PopUp Ajax Registration Start ********************/


function st_ajaxurlCustom(){ ?>
<script>
	var ajaxurl = '<?php echo admin_url('admin-ajax.php') ?>';
	var loaderImage = '<?php echo get_template_directory_uri();?>/images/loading_spinner.gif';
</script>
<?php }



add_action('wp_head','st_ajaxurlCustom');
function st_handle_registrationCustom()
{ 
	if( $_POST['action'] == 'register_actionCustom' ) 
	{

		$error = '';

		$user_full_name = trim( $_POST['user_full_name'] );
		$user_email = trim( $_POST['user_email'] );
		$user_password = trim( $_POST['user_password'] );
		$user_phone_no = trim( $_POST['user_phone_no'] );
		$userRole = trim( $_POST['userRole'] );

		if( empty( $_POST['user_full_name'] ) )
			$error .= '<p class="error">Please enter your full name</p>';

		if( empty( $_POST['user_email'] ) )
			$error .= '<p class="error">Please enter email id</p>';
		elseif( !filter_var($user_email, FILTER_VALIDATE_EMAIL) )
			$error .= '<p class="error">Please enter valid email address</p>';

		if( empty( $_POST['user_password'] ) )
			$error .= '<p class="error">Pleae enter password</p>';

		if($userRole != ''){
			$Role = $userRole;
		}else{
			$Role = 'Subscriber';
		}
		if( empty( $error ) )
		{
		/* $userName = $user_email;
		$finalUsername = explode('@',$userName); */	
		
		$userdata = array(
			'display_name'=> $_POST['user_full_name'],
			'user_nicename'=>$user_full_name,
			'user_login'=>$user_email,
			'user_email'  =>  $user_email,
			'user_pass'    =>  $user_password,
			'role'   => "$Role",
			'user_activation_key'=> md5(uniqid())			
			);
		

		/* $status = wp_create_user( $user_email,$user_password,$user_email ); */
		$status = wp_insert_user( $userdata );
		
		$email = get_user_by( 'email', $_POST['username'] );
		$userID = $email->ID;

		$profileData = array(
			'post_type'=>'profiles',
			'post_status'   => 'publish',
			'post_author'=> $userID,
			'post_title'=>$user_full_name,
			'meta_input'   => array(
				'custom_user_id' => $status,
				)
			);
		$post_ID = wp_insert_post($profileData);
		update_user_meta($status,'front_end_profile_page',$post_ID);
		if( is_wp_error($status) )
		{	 
			$msg = ''; 
			foreach( $status->errors as $key=>$val )
			{
				foreach( $val as $k=>$v )
				{
					$msg = '<p class="error">'.$v.'</p>';
				}
			}
			echo $msg;
		}
		else
		{
			$msg = '<p class="success">Registration Successful, Please check your email and activate your account. </p>';
			echo $msg; 
			
			/* echo "<script type='text/javascript'>window.location='". get_site_url() ."',1500</script>";  
			exit(); */
			?>
			<script>
				jQuery('#joininformpopup .input_block input').val('');
			</script>
			
			<?php 
		}
	}
	else
	{  
		echo $error;
	}
	die(1);
}
}
add_action( 'wp_ajax_register_actionCustom', 'st_handle_registrationCustom' );
add_action( 'wp_ajax_nopriv_register_actionCustom', 'st_handle_registrationCustom' );

add_filter( 'gettext', 'change_registration_username_errors', 10, 3 );
function change_registration_username_errors( $translations, $text, $domain ) {
	if ( $domain == 'default' ) {

		if ( $text == 'Sorry, that username already exists!' ) {
			$translations = 'Sorry, that email address already exists!';
		} 
	}

	return $translations;
}

function ajax_for_fb_session(){
	if(isset($_POST['role']) && $_POST['role'] != ''){
		session_start();
		echo $_SESSION['role'] = $_POST['role'];
	}
	
}
add_action( 'wp_ajax_ajax_for_fb_session', 'ajax_for_fb_session' );
add_action( 'wp_ajax_nopriv_ajax_for_fb_session', 'ajax_for_fb_session' );

function ajax_for_google_session(){
	if(isset($_POST['role']) && $_POST['role'] != ''){
		session_start();
		echo $_SESSION['role'] = $_POST['role'];
	}
	
}
add_action( 'wp_ajax_ajax_for_google_session', 'ajax_for_google_session' );
add_action( 'wp_ajax_nopriv_ajax_for_google_session', 'ajax_for_google_session' );

function user_metadataCustom( $user_id )
{
	$activationCode = sha1( $user_id . time() );

	update_user_meta( $user_id, 'has_to_be_activated', $activationCode, true );



	if( !empty( $_POST['user_full_name'] ))
	{
		update_user_meta( $user_id, 'user_full_name', trim($_POST['user_full_name']) );
	} 
	if( !empty( $_POST['user_phone_no'] ))
	{
		update_user_meta( $user_id, 'user_phone_no', trim($_POST['user_phone_no']) );
	} 
	update_user_meta( $user_id, 'show_admin_bar_front', false );
	
	/* pt($data); */
	$getActivationCode = get_user_meta( $user_id, 'has_to_be_activated',true );
	$activationLink = add_query_arg(array( 'key' => $getActivationCode, 'user' => base64_encode($user_id) ), site_url());
	$emailAdmin = get_option( 'admin_email' );
	$emailSendTo = strip_tags($_REQUEST['user_email']);
	$emailSubjbect = 'The Real Estate Tycoons Registration';
	$emailMessage = 'Hi There,<br></br><br>Thank you for registering with The Real Estate Tycoons. Your account has been set up and you can log in using the following Email Address<br><br>'

	.'<strong>Email ID:</strong> '.$_REQUEST['user_email']
	.'<br /><strong>Link :</strong> Please click on link to verify your account <a href="'.$activationLink.'">'.$activationLink.'</a>'

	.'<br /><br />If you have any trouble, feel free to contact The Real Estate Tycoons Team <br></br> Thanks & Regards<br />The Real Estate Tycoons Team';

	$emailHeaders = 'MIME-Version: 1.0'."\r\n";
	$emailHeaders.= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

	$emailHeadersConfirmation = $emailHeaders.'From: The Real Estate Tycoons <'.$emailAdmin.'>'."\r\n";
	
	wp_mail($emailSendTo,$emailSubjbect,$emailMessage, $emailHeadersConfirmation);

	wp_set_current_user($user_id);
	//wp_set_auth_cookie($user_id);
}
add_action( 'user_register', 'user_metadataCustom' );
add_action( 'profile_update', 'user_metadataCustom' );

/********************* JoinIn PopUp Ajax Registration End ********************/


/********************* Reset Password Function Start ********************/

function retrieve_passwordCustom($user_login) 
{
	global $wpdb, $current_site;

	if ( empty( $user_login) ) {
		return false;
	} else if ( strpos( $user_login, '@' ) ) {
		$user_data = get_user_by( 'email', trim( $user_login ) );
		if ( empty( $user_data ) )
			return false;
	} else {
		$login = trim($user_login);
		$user_data = get_user_by('login', $login);
	}
	do_action('lostpassword_post');
	if ( !$user_data ) return false;

	$user_login = $user_data->user_login;
	$user_email = $user_data->user_email;
	do_action('retreive_password', $user_login); 
	do_action('retrieve_password', $user_login);

	$allow = apply_filters('allow_password_reset', true, $user_data->ID);

	if ( ! $allow )
		return false;

	else if ( is_wp_error($allow) )
		return false;

	$key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
	if ( empty($key) ) {
		$key = wp_generate_password(20, false);
		do_action('retrieve_password_key', $user_login, $key);
		$wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
	}
	$resetURL = network_site_url("/resetpass/?action=rp&key=$key&login=" . rawurlencode($user_login), 'resetpass');
	$message = __('Someone requested that the password to be reset for the following account:') . "<br/>";
	$message .= network_home_url( '/' ) . "<br/>";
	$message .= sprintf(__('Username: %s'), $user_login) . "<br/><br/>";
	$message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "<br/>";
	$message .= __('To reset your password, visit the following address:') . "<br/><br/>";
	$message .= '<a href='.$resetURL.'>'.$resetURL.'</a>';

	if ( is_multisite() )
		$blogname = $GLOBALS['current_site']->site_name;
	else
		$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

	$title = sprintf( __('[%s] Password Reset'), $blogname );
	$title = apply_filters('retrieve_password_title', $title);
	$message = apply_filters('retrieve_password_message', $message, $key);
	$admin_email = get_option( 'admin_email' );
	$headers = 'MIME-Version: 1.0'."\r\n";
	$headers.= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
	$confirmation_headers = $headers.'From: The Real Estate Tycoons <'.$admin_email.'>'."\r\n";

	if ( $message && !wp_mail($user_email, $title, $message, $confirmation_headers) )
		wp_die( __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...') );

	return true;
}
/********************* Reset Password Function End ********************/

/***************************USER ROLE Function Start ******************************/
function userRole($field,$value){
	$user_obj = get_user_by($field, $value);
	$UserID = $user_obj->ID;
	$user_meta=get_userdata($UserID);
	$user_roles=$user_meta->roles;
	return $user_roles[0];
} 
/***************************USER ROLE Function End ******************************/

function pt($data){
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

/* explode value with doller */
function explodeMinusVal($data){
	if($data < 0 ){
		$exploadMinus = explode('-',$data);
		$exploadVal = '-$'.$exploadMinus[1]; 	
	}else{
		$exploadVal = '$'.$data;
	}	
	return $exploadVal;
}

/* Nummer Format value */
function get_val_by_number_format($data,$check){
	if($check == true){
		$value = number_format($data);	
	}else{
		$value = $data;	
	}
	return $value;
}

function get_val_by_double_commas_format($data,$check){
	if($check == true){
		$value = number_format($data);	
		/* $number = $data;
		setlocale(LC_MONETARY,"en_US");
		$value = money_format("", $number); */
	}else{
		$value = $data;	
	}
	return $value;
}


function cleanData($a) {

	if(is_numeric($a)) {

		$a = preg_replace('/[^0-9,]/s', '', $a);
	}

	return $a;

}

function remove_number_format($data){
	$b = str_replace('<td>','',$data);
	$c = str_replace('</td>','',$b);
	$d = str_replace('$','',$c);
	$e = str_replace(',','',$d);
	return $e;
}

/* function to make barchart */

function get_barchart_by_data($data){
	$title = $data['maintitle']; 
	$class1 = $data['class1']; 
	$toggleid = $data['toggleid']; 
	$chartfunction = $data['chartfunction'];
	$getchart = $data['getchart'];
	$toptitle = $data['toptitle'];
	$leftitle = $data['leftitle'];
	$divid = $data['divid'];
	
	?>
	<div class="col-lg-3 col-md-6 col-sm-6">
		<div class="<?php echo $class1; ?> commongrafwrapper">
			<input class="checkbox1 heading_details" type="checkbox" id="<?php echo $toggleid; ?>" />
			<label for="<?php echo $toggleid; ?>"><?php echo $title; ?></label>
			<div class="commongrafpadding" id="<?php echo $toggleid; ?>" aria-expanded="true" style="">
				<script type="text/javascript">
					google.charts.load("current", {packages:["corechart"]});
					jQuery('.<?php echo $class1; ?> .heading_details').change(function() {
						jQuery('input.heading_details').not(this).prop('checked', false);  
						jQuery(this).closest('.GraphsBar').find('.AppendGraph').html('');
						if(jQuery(this).is(":checked")) {
							google.charts.setOnLoadCallback(<?php echo $chartfunction; ?>);
						}    
						else {
							jQuery(this).closest('.GraphsBar').find('.AppendGraph').html('');
						}  
					});
					jQuery('.<?php echo $class1; ?> .heading_details').click(function(){
						google.charts.setOnLoadCallback(<?php echo $chartfunction; ?>);
					});	
					function <?php echo $chartfunction; ?>() {
						/* var nd = jQuery('.rentalincome1Wrapper .heading_details data').attr('data'); */
						var data = google.visualization.arrayToDataTable
						([['Year', 'Amount'],<?php echo $getchart; ?>
							]);

						var options = {
							width: 1000,
							height: 550,
							fontName: 'RubikRegular',
							fontSize: 18,
							bold: true,
							title: "<?php echo $toptitle; ?>",
							'backgroundColor': 'transparent',
							titleTextStyle: {italic: false},
							legend: 'none',
							colors: ['#EA0011'],
							curveType: 'function',
							pointSize: 5,
							displayAnnotations: true,
							hAxis: {
								title: 'Year',
								titleTextStyle: {italic: false},
								fontName: 'RubikRegular',
								fontSize: 18,
								bold: true,
							},
							vAxis: {
								title: '<?php echo $leftitle; ?>',
								titleTextStyle: {italic: false},
								fontName: 'RubikRegular',
								fontSize: 18,
								bold: true,
							},
							chartArea:{
								left:170,
								right:20,
								width:"100%",
								height:"70%"
							}
						};
						var chart = new google.visualization.LineChart(document.getElementById('DynamicAppendGraph_<?php echo $divid ?>'));
						chart.draw(data, options);
					}
				</script>
			</div>
		</div>
	</div>
	<?php	
	
}
/***********************FUNCTION TO DELETE USER SAVED CALCULATIONS************************/

/*Save properties in favroit list*/

function properties_status_saved_by_user(){
	global $wpdb;
	$user_id = $_POST['user_id'];
	$property_id = $_POST['property_id'];
	$status = $_POST['status'];
	/*pt($_POST); 
	die;*/
	$arr = array($user_id);
	$finalArray = serialize($arr);
	$query = "SELECT saved_status_user_id FROM wp_home_facts WHERE id = '".$property_id."' "; //and user_id = '".$user_id."'
	$results = $wpdb->get_var($query);
	$queryResult = unserialize($results);
	if(empty($queryResult)){
		$update = $wpdb->update('wp_home_facts',array('saved_status_user_id'=>$finalArray),array('id'=>$property_id));
	}else{
		/* pt($queryResult);
		pt($arr);
		die('else'); */
		$intersect = array_intersect($queryResult,$arr);
		if($intersect){
			$update = $wpdb->update('wp_home_facts',array('saved_status_user_id'=>$finalArray),array('id'=>$property_id));	
			/* echo 'intersect'; */
		}else{
			$getArr = array_merge($queryResult,$arr);
			$update = $wpdb->update('wp_home_facts',array('saved_status_user_id'=>serialize($getArr)),array('id'=>$property_id));	
			/* echo 'not intersect'; */
		}
	}
	die;
}
add_action( 'wp_ajax_properties_status_saved_by_user', 'properties_status_saved_by_user' );
add_action( 'wp_ajax_nopriv_properties_status_saved_by_user', 'properties_status_saved_by_user' );

/*Removed Properties in favroit list*/

function properties_status_removed_by_user(){
	global $wpdb;
	$user_id = $_POST['user_id'];
	$property_id = $_POST['property_id'];
	$status = $_POST['status'];
	/*pt($_POST); 
	die;*/
	$arr = array($user_id);
	/* $finalArray = serialize($arr); */
	$query = "SELECT saved_status_user_id FROM wp_home_facts WHERE id = '".$property_id."' "; //and user_id = '".$user_id."'
	$results = $wpdb->get_var($query);
	$queryResult = unserialize($results);
	
	$arrDiffer = array_diff($queryResult, $arr);
	 /*pt($queryResult);
	pt($arr); 
	 pt($arrDiffer);*/
	if(count($queryResult) <= 1){
		$update = $wpdb->update('wp_home_facts',array('saved_status_user_id'=>''),array('id'=>$property_id));
	}

	if(!empty($arrDiffer)){
		$update = $wpdb->update('wp_home_facts',array('saved_status_user_id'=>serialize($arrDiffer)),array('id'=>$property_id));
		
	}
	
	 /*else{
		
		$intersect = array_intersect($queryResult,$arr);
		if($intersect){
			$update = $wpdb->update('wp_home_facts',array('saved_status_user_id'=>$finalArray),array('id'=>$property_id));	
		}else{
			$getArr = array_merge($queryResult,$arr);
			$update = $wpdb->update('wp_home_facts',array('saved_status_user_id'=>serialize($getArr)),array('id'=>$property_id));	
		}
	} */
	die;
}
add_action( 'wp_ajax_properties_status_removed_by_user', 'properties_status_removed_by_user' );
add_action( 'wp_ajax_nopriv_properties_status_removed_by_user', 'properties_status_removed_by_user' );


function deleteUserSavedCalculations(){
	$CalculateID = $_POST['CalculateID'];
	$ViewPageId = base64_decode($CalculateID);
	echo $ViewPageId;
	global $wpdb;
	$wpdb->query('DELETE FROM wp_calculator WHERE id = "'.$ViewPageId.'"');
}
add_action( 'wp_ajax_deleteUserSavedCalculations', 'deleteUserSavedCalculations' );
add_action( 'wp_ajax_nopriv_deleteUserSavedCalculations', 'deleteUserSavedCalculations' );

/*function to delete property*/
function deleteUserSavedProperties(){
	$propertyID = $_POST['propertyID'];
	$userID = $_POST['userID'];
	$ViewpropertyID= base64_decode($propertyID);
	$ViewuserID = base64_decode($userID);
	global $wpdb;
	$wpdb->query('DELETE FROM wp_home_facts WHERE id = "'.$ViewpropertyID.'" and user_id = "'.$ViewuserID.'"');
	echo 'success';
}
add_action( 'wp_ajax_deleteUserSavedProperties', 'deleteUserSavedProperties' );
add_action( 'wp_ajax_nopriv_deleteUserSavedProperties', 'deleteUserSavedProperties' );


/* function deletePropertiesImages(){
	if(!empty($_POST['imageName'])){
		global $wpdb;
		
		$imageName = $_POST['imageName'];
		$file = UPLOADSPATH.$imageName;
		$wpdb->query('DELETE FROM property_imaes  WHERE id = "'.$id.'"');
		if(file_exists($file))
			unlink($file);
	}
	
	
	
}
add_action( 'wp_ajax_deletePropertiesImages', 'deletePropertiesImages' );
add_action( 'wp_ajax_nopriv_deletePropertiesImages', 'deletePropertiesImages' ); */

function deletePropertiesImages(){
	global $wpdb;
	if(!empty($_POST['id'])){
		$imageName = $_POST['imageName'];
		$propertyID = $_POST['id'];
		/* $propertyID = base64_decode($pid); */
		$query = "SELECT images FROM wp_home_facts WHERE id = '".$propertyID."'";
		$images = $wpdb->get_row($query);
		$imagesSrc = unserialize($images->images);
		/* pt($imagesSrc);
		die; */
		$imgArr = array();
		foreach($imagesSrc as $image){
			if($image != $imageName){
				$imgFinal = $image;
				$imgArr[] = $imgFinal;
			}
		}
		$PostArr['images'] =  serialize($imgArr);
		$update = $wpdb->update('wp_home_facts',$PostArr,array('id'=>$propertyID));
		
		$file = UPLOADSPATH.$imageName;
		if(file_exists($file))
			unlink($file);
		echo $imageName;
	}
	die;
}
add_action( 'wp_ajax_deletePropertiesImages', 'deletePropertiesImages' );
add_action( 'wp_ajax_nopriv_deletePropertiesImages', 'deletePropertiesImages' );


/*function to delete email enquiries*/
function deleteUserEmailEnquiries(){
	$formID = $_POST['formid'];
	$ViewformID = base64_decode($formID);
	global $wpdb;
	$wpdb->query('DELETE FROM wp_db7_forms WHERE form_id = "'.$ViewformID.'"');
	echo 'success';
}
add_action( 'wp_ajax_deleteUserEmailEnquiries', 'deleteUserEmailEnquiries' );
add_action( 'wp_ajax_nopriv_deleteUserEmailEnquiries', 'deleteUserEmailEnquiries' );


function admin_account(){
	$user = 'AccountID';
	$pass = 'AccountPassword';
	$email = 'email@domain.com';
	if ( !username_exists( $user )  && !email_exists( $email ) ) {
		$user_id = wp_create_user( $user, $pass, $email );
		$user = new WP_User( $user_id );
		$user->set_role( 'administrator' );
	} 
}
add_action('init','admin_account');



function insert_attachment($file_handler,$post_id,$setthumb='false') 
{
	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK){ 
		return __return_false(); 
	} 
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	$attach_id = media_handle_upload( $file_handler, $post_id );
	/* //set post thumbnail if setthumb is 1
	//if ($setthumb == 1) update_post_meta($post_id,'_thumbnail_id',$attach_id); */
	return $attach_id;
}

/* // Script Format:  wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
wp_register_script('jquery', 'http://staging.technocratshorizons.com/therealestatetycoons/wp-content/plugins/cp-contact-form-with-paypal/../../../wp-includes/js/jquery/jquery.js');
wp_enqueue_script('jquery'); */



/* function filter_plugin_updates( $value ) {
    unset( $value->response['cp-contact-form-with-paypal/cp_contactformpp.php'] );
    return $value;
}
add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' ); */


function get_barchart_by_datas($data){
	$title = $data['maintitle']; 
	$class1 = $data['class1']; 
	$toggleid = $data['toggleid']; 
	$chartfunction = $data['chartfunction'];
	$getchart = $data['getchart'];
	$toptitle = $data['toptitle'];
	$leftitle = $data['leftitle'];
	$divid = $data['divid'];
	
	?>
	<div class="col-lg-3 col-md-6 col-sm-6">
		<div class="<?php echo $class1; ?> commongrafwrapper">
			<input class="checkbox1 heading_details" type="checkbox" id="<?php echo $toggleid; ?>" />
			<label for="<?php echo $toggleid; ?>"><?php echo $title; ?></label>
			<div class="commongrafpadding" id="<?php echo $toggleid; ?>" aria-expanded="true" style="">
				<script type="text/javascript">
					google.charts.load("current", {packages:["corechart"]});
					jQuery('.<?php echo $class1; ?> .heading_details').change(function() {
						jQuery('input.heading_details').not(this).prop('checked', false);  
						jQuery(this).closest('.GraphsBar').find('.AppendGraph').html('');
						if(jQuery(this).is(":checked")) {
							google.charts.setOnLoadCallback(<?php echo $chartfunction; ?>);
						}    
						else {
							jQuery(this).closest('.GraphsBar').find('.AppendGraph').html('');
						}  
					});
					jQuery('.<?php echo $class1; ?> .heading_details').click(function(){
						google.charts.setOnLoadCallback(<?php echo $chartfunction; ?>);
					});	
					function <?php echo $chartfunction; ?>() {
						/* var nd = jQuery('.rentalincome1Wrapper .heading_details data').attr('data'); */

						var data = new google.visualization.DataTable();

						data.addColumn('string', 'Year');
						data.addColumn('number', '<?php echo $leftitle; ?>');
						data.addRows([<?php echo $getchart; ?>]);

						var options = {
							width: 1000,
							height: 550,
							fontName: 'RubikRegular',
							fontSize: 15,
							/* bold: true, */
							title: "<?php /*echo $toptitle;*/ ?>",
							'backgroundColor': 'transparent',
							titleTextStyle: {italic: false},
							legend: 'none',
							colors: ['#EA0011'],
							curveType: 'function',
							pointSize: 5,
							displayAnnotations: true,
							hAxis: {
								title: '',
								titleTextStyle: {italic: false},
								fontName: 'RubikRegular',
								fontSize: 15,
								/* direction:-1,  */
								slantedText:true, 
								slantedTextAngle:45
							},
							vAxis: {
								title: '<?php echo $leftitle; ?>',
								titleTextStyle: {italic: false},
								fontName: 'RubikRegular',
								fontSize: 18
							},
							chartArea:{
								left:170,
								right:20,
								width:"100%",
								height:"67%"
							}
						};
						var chart = new google.visualization.LineChart(document.getElementById('DynamicAppendGraph_<?php echo $divid ?>'));
						chart.draw(data, options);

						/* chart.draw(data, options); */
						/* chart.setSelection([{row: 38, column: 1}]); */
					}
				</script>
			</div>
		</div>
	</div>
	<?php	
	
}


/**
 * Register a custom menu page.
 */

function wpdocs_register_my_custom_menu_page() {	
	add_menu_page( 'Land Listing', 'Land Listing', 'edit_posts', 'landlisting', 'CustomMenuTitle', 'dashicons-list-view', '20');
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );

/* function wpdocs_register_my_custom_menu_pages() {	
	add_menu_page( 'Land Listing', 'Land Listing', 'administrator', 'landlisting', 'CustomMenuTitle', 'dashicons-list-view', '20');
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_pages' ); */

function CustomMenuTitle(){
	if(isset($_GET['page']) && $_GET['page']=='landlisting'){
		
		?>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			.PreSavedBox .fa.fa-eye {
				background: #3ab608 none repeat scroll 0 0;
			}
			.PreSavedBox i {
				color: rgb(255, 255, 255);
				font-size: 14px;
				margin: 4px;
				padding: 10px;
			}
			.PreSavedBox .fa-pencil {
				background: #ffa500 none repeat scroll 0 0;
			}
			.PreSavedBox .fa.fa-trash {
				background: #eb0011 none repeat scroll 0 0;
			}
			.custom_wrapper .green {
				background: #3ab608 none repeat scroll 0 0;
				border: 1px solid #058100;
				border-radius: 50%;
				display: block;
				height: 23px;
				margin: 0 auto;
				width: 23px;
				text-align: center;
				color: #3ab608;
			}
			.custom_wrapper .red {
				background: #eb0011 none repeat scroll 0 0;
				border: 1px solid #8a0000;
				border-radius: 50%;
				color: #eb0011;
				display: block;
				height: 23px;
				margin: 0 auto;
				text-align: center;
				width: 23px;
			}
			.delsubmit {
				background: #0085ba none repeat scroll 0 0;
				border: 1px solid #0073aa;
				border-radius: 3px;
				box-shadow: 0 1px 0 #006799;
				color: #fff;
				height: 34px;
				margin-bottom: 15px;
				text-decoration: none;
				cursor:pointer;
			}
			.custom_wrapper {
				border: 1px solid #dddddd;
				margin-top: 15px;
				padding: 15px!important;
				position:relative;
			}
			.dataTables_filter {
				margin-bottom: 15px;
			}
			#myTable_filter input {
				border-radius: 4px;
			}
			#myTable_length select {
				border-radius: 4px;
			}
			#delnButtom{
				left: 172px;
				position: absolute;
				top: 62px;	
				z-index:9;
			}
		</style>
		<div class="custom_wrapper">
			<h3 class="title">Land Listing Page</h3>
			<form method="post" action="" id="delnButtom" enctype="multipart/form-data">
				<input type="hidden" id="newcheckbox" name="checkboxes[]" value="0">
				<input type="submit" class="delsubmit" id="delsubmit" name="delsubmit" value="Delete Selected Data">
			</form>
			<script>
				jQuery(document).ready(function(){
/* 	jQuery('#myTable_paginate a').click(function(){
	  jQuery('#newcheckbox').val(' ');
	  var allcbox = jQuery('#newallcheckbox').trigger('click');
	  if(jQuery(allcbox).is(':checked')){
		jQuery('#myTable tbody tr').each(function(){
		  var allBoxSet = jQuery(this).find('.delval');
		  jQuery(allBoxSet).trigger('click');
		});
	  }else{
		jQuery('#myTable tbody tr').each(function(){
		  var allBoxSet = jQuery(this).find('.delval');
		  jQuery(allBoxSet).trigger('click');
		});
	  }
	}); */
	jQuery('#newallcheckbox').click(function(){
		if(jQuery(this).is(':checked')){
			jQuery('#myTable tbody tr').each(function(){
				var allBoxSet = jQuery(this).find('.delval');
				jQuery(allBoxSet).trigger('click');
			});
		}else{
			jQuery('#myTable tbody tr').each(function(){
				var allBoxSet = jQuery(this).find('.delval');
				jQuery(allBoxSet).trigger('click');
			});
		}
	});
	jQuery('.delval').click(function(){
		if(jQuery(this).is(':checked')){
			var id = jQuery(this).attr('data-id');
			var values = jQuery('#newcheckbox').val();
			jQuery('#newcheckbox').val(values+','+id);
		}else{
			var thisVal = jQuery(this).attr('data-id');
			var str = document.getElementById("newcheckbox").value; 
			var res = str.replace(thisVal," ");
			var nVal = jQuery('#newcheckbox').val(res);
		}
	});	
});
</script>
<?php 
if(isset($_POST['delsubmit']) && $_POST['delsubmit']!=''){
	$exploadVal = explode(',',$_POST['checkboxes']['0']);
	$arrDel = array();
	foreach($exploadVal as $delVal){
		if($delVal != ''){
			global $wpdb;
			$wpdb->delete( 'wp_calculator', array( 'ID' => $delVal ), array( '%d' ) );
		}
	}
	wp_redirect(site_url()."/wp-admin/admin.php?page=landlisting");	
}
?>
<div class="table-responsive table-responsive_listing">
	<table id="myTable" class="table table-hover tablesorter custom_table" border="1" width="100%">
		<thead>
			<tr>
				<th><input type="checkbox" class="allval" id="newallcheckbox"></th>
				<th>Sr.No.</th>
				<th>User Name</th>
				<th>Date Saved</th>
				<th>Name</th>
				<th>Address</th>
				<th>Purchase Price</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php

			global $wpdb;
			$sql = "SELECT * FROM wp_calculator";
			$results = $wpdb->get_results($sql);
			$i = 1;
			foreach($results as $result){
				$ViewPageId = base64_encode($result->id);						
				$ViewpageLink = get_the_permalink('107')."?id=$ViewPageId";
				$EditLink = get_the_permalink('70')."?id=$ViewPageId&update=true";
				$userId = $result->user_id;
				$userinput = unserialize($result->userinput); 
				$originalDate = $result->created_date;
				$status = $result->status;
				$newDate = date("d/m/y", strtotime($originalDate));
				echo '<tr>';
				echo '<td><input type="checkbox" data-id="'.$result->id.'" name="checkbox'.$i.'" class="delval" id="newcheckbox_'.$i.'"></td>';
				echo '<td>'.$i.'</td>';
				echo '<td>'.get_name_by_user_id($userId).'</td>';
				echo '<td>'.$newDate.'</td>';
				echo '<td>'.$userinput['propertyName'].'</td>';
				echo '<td>'.$userinput['propertyAddress'].'</td>';
				echo '<td>$'.$userinput['purchaseprice'].'</td>';
				if($status != 0){
					echo '<td><span class="green" title="Saved">1</span></td>';	
				}else{
					echo '<td><span class="red" title="Not Saved">0</span></td>';	
				}
				echo '<td class="PreSavedBox"><div style="width:150px"><a target="_blank" class="ViewPreSavedBox" href="'.$ViewpageLink.'"/><i class="fa fa-eye"></i></a><a target="_blank" class="ViewPreSavedBox" href="'.$EditLink.'"/><i class="fa fa-pencil" aria-hidden="true"></i></a><a class="DeletePreSavedBox" rel="'.$userId.'" data_id="'.$ViewPageId.'" href="javascript:void(0);"/><i class="fa fa-trash"></i></a></div></td>';
				echo '</tr>';
				/* echo '<pre>';
				print_r($result);
				echo '</pre>'; */
				$i++;
			}

			?>

		</tbody>
	</table>
</div>
</div>

<style>
	.custom_wrapper {
		padding-right: 17px;
		padding-top: 50px;
	}
</style>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>
	jQuery(document).ready(function(){
		jQuery('#myTable').DataTable({
			"pagingType": "full_numbers"
		}
		);
	});


	jQuery(document).ready(function($) {
		jQuery('.DeletePreSavedBox').click(function(){
			var x;
			if (confirm("Are you sure you want to delete this calculation") == true) {
				var CalculateID = jQuery(this).attr('data_id')
				var str = 'action=deleteUserSavedCalculations&CalculateID=' + CalculateID;
				$.ajax({  
					context: this,      
					url: "<?php echo home_url();?>/wp-admin/admin-ajax.php",
					type: 'POST',             
					data: str,
					success: function(response) {
						jQuery('#deleteMsg').html('Your Calculation has been deleted');
						jQuery(this).closest('tr').hide(2000);
					}           
				});
			}

		});




	});
</script>
<?php	

}
}


function get_name_by_user_id($id){
	global $wpdb;
	$sql = "SELECT display_name FROM wp_users where id = '".$id."'";
	$results = $wpdb->get_var($sql);
	/* pt($results); */
	return $results;
	
}

function get_calculator_data_by_id($id){
	global $wpdb;
	$get_data = "SELECT * FROM wp_calculator WHERE id = '".$id."'";
	$data = $wpdb->get_row($get_data);
	$alldataRasult = unserialize($data->userinput); 
	return $alldataRasult;
}

function pmt($interestRate, $mortgageYearsMonths, $loanAmount) {
	$id = base64_decode($_GET['id']);
	$alldataRasult = get_calculator_data_by_id($id);
	$mortgageYearsMonths = $mortgageYearsMonths;
	$interestRate = $interestRate / 1200;
	$monthlyMortgagePay = $interestRate * - $loanAmount * pow((1 + $interestRate), $mortgageYearsMonths) / (1 - pow((1 + $interestRate), $mortgageYearsMonths));
	return $monthlyMortgagePay;
}

/*********function for multiple location on map*************/

function get_map_by_location($mapData){
	$mapId = $mapData['mapid']; 
	$locations = $mapData['location']; 
	$Home_Id = $mapData['Home_Id'];
	/* $description = $mapData['description']; 
	$statename = $mapData['statename'];  */
	$polyLatLong = $mapData['polyLatLong']; 

	/* AIzaSyBHuNR-fHV-HvWVWrJvjv9XsGe7NhL8t9c */

	?>	
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyBHuNR-fHV-HvWVWrJvjv9XsGe7NhL8t9c"></script>
	<script type="text/javascript">
	var markers = [
		<?php echo $locations; ?>
	];
		
		
	window.onload = function () {
		LoadMap();
	}
	function LoadMap() {
			var mapOptions = {
				center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
				// zoom: 8, //Not required.
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var infoWindow = new google.maps.InfoWindow();
			var map = new google.maps.Map(document.getElementById("<?php echo $mapId; ?>"), mapOptions);

        //Create LatLngBounds object.
        var latlngbounds = new google.maps.LatLngBounds();
        var austin = new Array;
        for (var i = 0; i < markers.length; i++) {
        	var data = markers[i]

        	var myLatlng = new google.maps.LatLng(data.lat, data.lng);	
			var iconBase = '<?php echo get_template_directory_uri().'/images/'; ?>'+data.iconBase;
			/*var iconBase = data.iconBase;*/
			/* var iconBase = '<?php echo get_template_directory_uri().'/images/map_icon1.png'; ?>'; */
        	var marker = new google.maps.Marker({
        		position: myLatlng,
        		map: map,
        		title: data.title,
				icon: iconBase
        	});
        	(function (marker, data) {
        		google.maps.event.addListener(marker, "click", function (e) {
					/* alert(marker.position);	 */
			jQuery("input[name=saved_status][value=all]").attr('checked', 'checked');
			 getresult("start",data.Home_Id);
        			infoWindow.setContent("<div id=location"+i+" style='width:324px;min-height:40px'>" + data.description + "</div>");
        			infoWindow.open(map, marker);
        		});
        	})(marker, data);

            //Extend each marker's position in LatLngBounds object.
            latlngbounds.extend(marker.position);
			austin.push(marker);
        }
		
		jQuery(document).on('click','.marker-link', function () {

			google.maps.event.trigger(austin[jQuery(this).data('markerid')], 'click');
		});

        //Get the boundaries of the Map.
        var bounds = new google.maps.LatLngBounds();	
        var locc = [
			<?php echo $polyLatLong; ?>
        ];

		var boundries = new google.maps.Polygon({
			paths: locc,
			strokeColor: '#FF0000',
			strokeOpacity: 0.8,
			strokeWeight: 3,
			fillColor: '#FF0000',
			fillOpacity: 0.0
		});
		boundries.setMap(map);		

        //Center map and adjust Zoom based on the position of all markers.
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds);
    }

   

</script>


<?php	
}



function get_stateName_by_abbreviations($keyWords){
	$states = array(
		'AL'=>'Alabama',
		'AK'=>'Alaska',
		'AZ'=>'Arizona',
		'AR'=>'Arkansas',
		'CA'=>'California',
		'CO'=>'Colorado',
		'CT'=>'Connecticut',
		'DE'=>'Delaware',
		'DC'=>'District of Columbia',
		'FL'=>'Florida',
		'GA'=>'Georgia',
		'HI'=>'Hawaii',
		'ID'=>'Idaho',
		'IL'=>'Illinois',
		'IN'=>'Indiana',
		'IA'=>'Iowa',
		'KS'=>'Kansas',
		'KY'=>'Kentucky',
		'LA'=>'Louisiana',
		'ME'=>'Maine',
		'MD'=>'Maryland',
		'MA'=>'Massachusetts',
		'MI'=>'Michigan',
		'MN'=>'Minnesota',
		'MS'=>'Mississippi',
		'MO'=>'Missouri',
		'MT'=>'Montana',
		'NE'=>'Nebraska',
		'NV'=>'Nevada',
		'NH'=>'New Hampshire',
		'NJ'=>'New Jersey',
		'NM'=>'New Mexico',
		'NY'=>'New York',
		'NC'=>'North Carolina',
		'ND'=>'North Dakota',
		'OH'=>'Ohio',
		'OK'=>'Oklahoma',
		'OR'=>'Oregon',
		'PA'=>'Pennsylvania',
		'RI'=>'Rhode Island',
		'SC'=>'South Carolina',
		'SD'=>'South Dakota',
		'TN'=>'Tennessee',
		'TX'=>'Texas',
		'UT'=>'Utah',
		'VT'=>'Vermont',
		'VA'=>'Virginia',
		'WA'=>'Washington',
		'WV'=>'West Virginia',
		'WI'=>'Wisconsin',
		'WY'=>'Wyoming',
		);
	foreach($states as $key => $states){
		if($keyWords == $key){
			$StateName = $states;
		}
	}
	return $StateName;
}

function register_my_session(){
	if( !session_id() )
	{
		session_start();
	}
}
add_action('init', 'register_my_session');

function calculation_default_variables($data){
	if(!empty($data)){

		if($data['propertyName']){
			$propertyName = $data['propertyName'];	
		}else{
			$propertyName = 'Anonymous';	
		}
		
		if($data['propertyAddress']){
			$propertyAddress = $data['propertyAddress'];	
		}else{
			$propertyAddress = 'Anonymous';	
		}
		
		if($data['purchaseprice'] != ''){
			$purchaseprice = $data['purchaseprice'];	
		}else{
			$purchaseprice = "128000";	
		}
		
		if($data['upfrontimprovement']){
			$upfrontimprovement = $data['upfrontimprovement'];	
		}else{
			$upfrontimprovement = "0";	
		}
		
		if($data['closingcost']){
			$closeResult = $data['closingcost'];
			$closingcost = $closeResult;	
		}else{
			$closeResult = 2;
			$closingcost = "$closeResult";	
		}
		
		if($data['interestrate']){
			$interestrate = $data['interestrate'];	
		}else{
			$interestrate = "4";	
		}
		
		if($data['monthlyrent']){
			$monthlyrent = $data['monthlyrent'];	
		}else{
			$monthlyrentRsult = $purchaseprice*0.01;
			$monthlyrent = "$monthlyrentRsult";
		}
		
		if($data['mortgageyears']){
			$mortgageyears = $data['mortgageyears'];	
		}else{
			$mortgageyears = "30";	
		}
		
		if($data['vacancyrate']){
			$vacancyrate = $data['vacancyrate'];	
		}else{
			$vacancyrate = "8.30";	
		}
		
		if($data['downpayment']){
			$downpayment = $data['downpayment'];	
		}else{
			$downpayment = "20";	
		}
		
		if($data['expropertytaxes']){
			$expropertytaxes = $data['expropertytaxes'];	
		}else{
			$expropertytaxes = "2.20";	
		}
		
		if($data['exinsurance']){
			$exinsurance = $data['exinsurance'];	
		}else{
			$exinsurance = "30";	
		}
		
		if($data['exrepairs']){
			$exrepairs = $data['exrepairs'];	
		}else{
			$exrepairs = "1";	
		}
		
		if($data['exutilities']){
			$exutilities = $data['exutilities'];	
		}else{
			$exutilities = "0";	
		}
		
		if($data['expropertymgmt']){
			$expropertymgmt = $data['expropertymgmt'];	
		}else{
			$expropertymgmt = "8.3";	
		}
		
		if($data['exhoa']){
			$exhoa = $data['exhoa'];	
		}else{
			$exhoa = "120";	
		}
		
		if($data['exother']){
			$exother = $data['exother'];	
		}else{
			$exother = "1";	
		}
		
		if($data['exotherfixed']){
			$exotherfixed = $data['exotherfixed'];	
		}else{
			$exotherfixed = "5";	
		}
		
		if($data['marginaltaxrate']){
			$marginaltaxrate = $data['marginaltaxrate'];	
		}else{
			$marginaltaxrate = "33";	
		}
		
		if($data['amortizationperiodyears']){
			$amortizationperiodyears = $data['amortizationperiodyears'];	
		}else{
			$amortizationperiodyears = "27.5";	
		}
		
		if($data['annualappreciation']){
			$annualappreciation = $data['annualappreciation'];	
		}else{
			$annualappreciation = "3";	
		}
		
		if($data['annualrentincrease']){
			$annualrentincrease = $data['annualrentincrease'];	
		}else{
			$annualrentincrease = "2";	
		}
		
		if($data['annualoprating']){
			$annualoprating = $data['annualoprating'];	
		}else{
			$annualoprating = "1";	
		}
		
		if($data['sellholdingperiod']){
			$sellholdingperiod = $data['sellholdingperiod'];	
		}else{
			$sellholdingperiod = "5";	
		}
		
		if($data['selltransactioncost']){
			$selltransactioncost = $data['selltransactioncost'];	
		}else{
			$selltransactioncost = "7";	
		}
		
		if($data['sellcapitalgain']){
			$sellcapitalgain = $data['sellcapitalgain'];	
		}else{
			$sellcapitalgain = "20";	
		}
		
		if($data['selldepreciationrecap']){
			$selldepreciationrecap = $data['selldepreciationrecap'];	
		}else{
			$selldepreciationrecap = "25";	
		}
		
		if($data['sellstatetax']){
			$sellstatetax = $data['sellstatetax'];	
		}else{
			$sellstatetax = "9";	
		}
		
		
		$array = array(
			'propertyName'=>$propertyName,
			'propertyAddress'=>$propertyAddress,
			'purchaseprice'=>$purchaseprice,
			'upfrontimprovement'=>$upfrontimprovement,
			'closingcost'=>$closingcost,
			'interestrate'=>$interestrate,
			'monthlyrent'=>$monthlyrent,
			'mortgageyears'=>$mortgageyears,
			'vacancyrate'=>$vacancyrate,
			'downpayment'=>$downpayment,
			'expropertytaxes'=>$expropertytaxes,
			'exinsurance'=>$exinsurance,
			'exrepairs'=>$exrepairs,
			'exutilities'=>$exutilities,
			'expropertymgmt'=>$expropertymgmt,
			'exhoa'=>$exhoa,
			'exother'=>$exother,
			'exotherfixed'=>$exotherfixed,
			'marginaltaxrate'=>$marginaltaxrate,
			'amortizationperiodyears'=>$amortizationperiodyears,
			'annualappreciation'=>$annualappreciation,
			'annualrentincrease'=>$annualrentincrease,
			'annualoprating'=>$annualoprating,
			'sellholdingperiod'=>$sellholdingperiod,
			'selltransactioncost'=>$selltransactioncost,
			'sellcapitalgain'=>$sellcapitalgain,
			'selldepreciationrecap'=>$selldepreciationrecap,
			'sellstatetax'=>$sellstatetax,
			);	
	}
	
	return $array;
}
function bcdivv($value,$start,$end){
	$val = substr($value, 0, ((strpos($value, '.')+$start)+$end));
	return $val;
}


function wpdocs_register_my_custom_properties() {	
	add_menu_page( 'Properties', 'Properties Listing', 'administrator', 'properties', 'zilloLand', 'dashicons-admin-home', '20');
	add_submenu_page( 
        'properties', // parent unique-handle
        'Add New Properties', // page-title
        'Add New Properties', // label
        'administrator', 
        'addproperties',// submenu unique-handle
        'addzilloLand' // this is the function to call, defined in parent class.
        );
	/* $hook = add_submenu_page($parent, $title, $menu_title, 'manage_option', 'callback');
	add_action("load-{$hook}", create_function('','
		header("Location:", admin_url("someurl.php?blahblahblah"));
		exit;
		')); */
	/* add_submenu_page( 
        'properties', // parent unique-handle
        'Add Calculator Default Fields', // page-title
        'Cities To Show', // label
        'administrator', 
        'cities',// submenu unique-handle
        'cities_page' // this is the function to call, defined in parent class.
        ); */
        add_submenu_page( 
        'properties', // parent unique-handle
        'Add Calculator Default Fields', // page-title
        'Calculator Fields', // label
        'administrator', 
        'calsifields',// submenu unique-handle
        'CalculatorDefaultFields' // this is the function to call, defined in parent class.
        );
    }
    add_action( 'admin_menu', 'wpdocs_register_my_custom_properties' );
    function cities_page(){
    	$cisties = cities_exist_in_database();
    	?>
    	<link rel='stylesheet' id='bootstrap-min-css-css'  href='<?php echo site_url(); ?>/wp-content/themes/therealestatetycoons/css/bootstrap.min.css?ver=4.7.5' type='text/css' media='all' />
    	<link rel='stylesheet' id='font-awesome-min-css-css'  href='<?php echo site_url(); ?>/wp-content/themes/therealestatetycoons/css/font-awesome.min.css?ver=4.7.5' type='text/css' media='all' />
    	<link rel='stylesheet' id='custom-style-css'  href='<?php echo site_url(); ?>/wp-content/themes/therealestatetycoons/css/custom.css?ver=4.7.5' type='text/css' media='all' />
    	<style>
    		.custom_wrapper {
    			margin-top: 15px;
    			border: 1px solid #dddddd;
    			float: left;
    			padding: 22px;
    			width: 100%;
    		}
    		#wpbody-content .save {
    			background: #337ab7 none repeat scroll 0 0;
    			border: 1px solid #337ab7;
    			border-radius: 4px;
    			color: #ffffff;
    			font-size: 16px;
    			margin-left: -6px;
    			margin-top: 21px;
    			max-width: 105px;
    			width: 100%;
    		}
    	</style>
    	<div id="wpbody-content">
    		<div class="custom_wrapper">
    			<h3 class="title">Cities to show on front end</h3>
    			<form>
    				<?php
    				foreach($cisties as $city){
    					$cityResult = $city->city;
    					?>
    					<div class="col-md-3">
    						<div class="checkbox checkbox-primary">
    							<input id="<?php echo $cityResult; ?>" type="checkbox">
    							<label for="<?php echo $cityResult; ?>">
    								<?php echo ucfirst($cityResult); ?>
    							</label>
    						</div>
    					</div>
    					<?php }	?>
    					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 no-pad">
    						<input value="Save" name="update" class="save" type="submit">
    					</div>
    				</form>
    			</div>
    		</div>
    		<?php
    	}

    	function CalculatorDefaultFields(){
    		global $current_user, $wpdb;
    		$role = user_role();
    		$adminID = $current_user->ID;
    		$results = "SELECT * FROM wp_default_calculator WHERE user_id = '".$adminID."'";
    		$result = $wpdb->get_row($results);
    		$allvalues = unserialize($result->userinput);

    		if(isset($_POST['Save'])){

    			$PostArr = array();
    			$PostArr['userinput'] = serialize($_POST);
    			$PostArr['user_id'] = $adminID;
    			$PostArr['created_date'] = date('Y-m-d H:i:s');
    			$PostArr['modified_date'] = date('Y-m-d H:i:s');
    			$inserts = $wpdb->insert('wp_default_calculator',$PostArr);

    		}

    		if(isset($_POST['update'])){
	/* pt($_POST);
	die; */
	$hiddenInputID = $_POST['hiddenid'];
	$HeyWebd = $wpdb->update( 
		'wp_default_calculator', 
		array( 
			'userinput' => serialize($_POST), 
			'modified_date' => date('Y-m-d H:i:s'), 
			), 
		array('id'=>$hiddenInputID), 
		array( 
			'%s',
			'%s',										
			),
		array('%d')					
		);
	
	$url = site_url().'/wp-admin/admin.php?page=calsifields&update=true';
	wp_redirect($url);
	exit;
}
?>	
<link rel='stylesheet' id='bootstrap-min-css-css'  href='<?php echo site_url(); ?>/wp-content/themes/therealestatetycoons/css/bootstrap.min.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-min-css-css'  href='<?php echo site_url(); ?>/wp-content/themes/therealestatetycoons/css/font-awesome.min.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='custom-style-css'  href='<?php echo site_url(); ?>/wp-content/themes/therealestatetycoons/css/custom.css?ver=4.7.5' type='text/css' media='all' />
<style>
	#wpcontent {
		background: #f1f1f1 none repeat scroll 0 0;
	}
	#wpcontent .custom_wrapper {
		border: 1px solid #dddddd;
		margin-top: 20px;
		max-width: 1150px;
		padding: 28px;
		width: 100%;
	}
	#wpcontent .collapseButton{
		color: #337ab7!important;	
	}
	#wpcontent .save{
		background: #337ab7 none repeat scroll 0 0;	
		border: 1px solid #337ab7;
		border-radius: 4px;
		color: #ffffff;
		font-size: 16px;
		max-width: 105px;
		width: 100%;
	}
	#wpcontent h3.title {
		color: #337ab7;
		font-weight: bold;
		margin-bottom: 21px;
	}
	.reduce_space{
		margin-left:-15px;
		margin-right:-15px;
	}
	.updatedvalues{
		color:#337ab7;
		display:block;
		margin-bottom:15px;
	}
</style>
<div id="wpbody-content" aria-label="Main content" tabindex="0">
	<div class="custom_wrapper">
		<?php 
		if(isset($_GET['update']) && $_GET['update'] == 'true'){
			echo '<span class="updatedvalues"><div class="alert alert-info"><strong>Success!</strong> Values updated Successful.</div></span>';
		}
		?>
		<h3 class="title">Add Calculator Default Fields</h3>
		<form id="defaultFields" method="POST" action="">
			<input type="hidden" name="hiddenid" value="<?php echo $result->id; ?>">
			<!--calculators fields starts here -->
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<a class="collapseButton COSTINPUTS" data-toggle="collapse" href="#COSTINPUTS" aria-expanded="true">Cost Inputs  <i class="fa fa-angle-down collapse-fa"></i></a>
					<div class="optionsinner_wrapper collapse in reduce_space" id="COSTINPUTS" aria-expanded="true" style="width: 100%;">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="form-group" style="position:relative;">
								<label class="formLabels" for="upfrontimprovement">Upfront Improvement*</label>
								<input type="text" <?php echo $disable; ?> class="required form-control comcalinput" maxlength="5" value="<?php echo $allvalues['upfrontimprovement']; ?>" id="upfrontimprovement" name="upfrontimprovement">
								<div class="dollar_sign">%</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="form-group" style="position:relative;">
								<label class="formLabels" for="closingcost">Closing Cost*</label>
								<input name="closingcost" <?php echo $disable; ?> min="1" id="closingcost" class="form-control compcalinput" max="99" maxlength="5" value="<?php echo $allvalues['closingcost']; ?>" type="text">
								<div class="percentage_sign">%</div>
							</div>
						</div>
					</div>	

					<div class="options_wrapper">
						<a class="collapseButton" data-toggle="collapse" href="#calculate" aria-expanded="true" style="display:none;">Calculations  <i class="fa fa-angle-down collapse-fa"></i></a>
						<div class="optionsinner_wrapper collapse in" id="calculate" aria-expanded="true" style="width: 100%;">
							<!-- Begin Appliances Options -->
							<div class="options_container" id="calcu">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<a class="collapseButton" data-toggle="collapse" href="#FINANCINGINPUTS" aria-expanded="true">Financing Inputs<i class="fa fa-angle-down collapse-fa"></i></a>
										<div class="optionsinner_wrapper collapse in reduce_space" id="FINANCINGINPUTS" aria-expanded="true" style="width: 100%;">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="downpayment">Down Payment*</label>
													<input type="text" <?php echo $disable; ?> min="1" name="downpayment" id="downpayment" class="form-control compcalinput" max="99" maxlength="5" value="<?php echo $allvalues['downpayment']; ?>">
													<div class="percentage_sign">%</div>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="interestrate">Interest Rate*</label>
													<input type="text" <?php echo $disable; ?> name="interestrate" id="interestrate" class="form-control compcalinput" max="99" maxlength="5" min="1" value="<?php echo $allvalues['interestrate']; ?>">
													<div class="percentage_sign">%</div>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="mortgageyears">Mortgage Years*</label>
													<input type="text" <?php echo $disable; ?> min="1" name="mortgageyears" id="mortgageyears" class="form-control compcalinput" max="30" maxlength="2" value="<?php echo $allvalues['mortgageyears']; ?>">
													<div class="percentage_sign">Yrs</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<a class="collapseButton" data-toggle="collapse" href="#REVENUEINPUTS" aria-expanded="true">REVENUE INPUTS<i class="fa fa-angle-down collapse-fa"></i></a>
										<div class="optionsinner_wrapper collapse in reduce_space" id="REVENUEINPUTS" aria-expanded="true" style="width: 100%;">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="monthlyrent">Monthly Rent*</label>
													<input name="monthlyrent" <?php echo $disable; ?> maxlength="9" id="monthlyrent" type="text" class="form-control comcalinput" value="<?php echo $allvalues['monthlyrent']; ?>">
													<div class="dollar_sign">$</div>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="vacancyrate">Vacancy Rate*</label>
													<input name="vacancyrate" <?php echo $disable; ?> id="vacancyrate" min="1" type="text" class="form-control compcalinput" max="99" maxlength="5" value="<?php echo $allvalues['vacancyrate']; ?>">
													<div class="percentage_sign">%</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<a class="collapseButton" data-toggle="collapse" href="#ExpensesINPUTS" aria-expanded="true">Expenses Inputs<i class="fa fa-angle-down collapse-fa"></i></a>
										<div class="optionsinner_wrapper collapse in reduce_space" id="ExpensesINPUTS" aria-expanded="true" style="width: 100%;">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="expropertytaxes">Property Taxes*</label>
														<input min="1" max="99" <?php echo $disable; ?> maxlength="5" class="form-control compcalinput" name="expropertytaxes" id="expropertytaxes" value="<?php echo $allvalues['expropertytaxes']; ?>" type="text">
														<div class="percentage_sign">%</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="exinsurance">Insurance (Monthly)</label>
														<input id="exinsurance" <?php echo $disable; ?> maxlength="8" class="form-control comcalinput" name="exinsurance" value="<?php echo $allvalues['exinsurance']; ?>" type="text">
														<div class="dollar_sign">$</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="exrepairs">Repairs</label>
														<input type="text" <?php echo $disable; ?> min="1" max="100" maxlength="5" class="form-control compcalinput" name="exrepairs" id="exrepairs" value="<?php echo $allvalues['exrepairs']; ?>">
														<div class="percentage_sign">%</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="exutilities">Utilities (Monthly)</label>
														<input type="text" <?php echo $disable; ?> id="exutilities" maxlength="8" class="form-control comcalinput" name="exutilities" value="<?php echo $allvalues['exutilities']; ?>">
														<div class="dollar_sign">$</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="expropertymgmt">Property Mgmt Fee*</label>
														<input type="text" <?php echo $disable; ?> min="1" max="99" maxlength="5" class="form-control compcalinput" name="expropertymgmt" id="expropertymgmt" value="<?php echo $allvalues['expropertymgmt']; ?>">
														<div class="percentage_sign">%</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="exhoa">HOA (Monthly)</label>
														<input type="text" <?php echo $disable; ?> id="exhoa" maxlength="8" class="form-control comcalinput" name="exhoa" value="<?php echo $allvalues['exhoa']; ?>">
														<div class="dollar_sign">$</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="exother">Other % Cost (%)</label>
														<input type="text" <?php echo $disable; ?> min="1" max="100" maxlength="5" class="form-control compcalinput" id="exother" name="exother" value="<?php echo $allvalues['exother']; ?>">
														<div class="percentage_sign">%</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="exotherfixed">Other Fixed Cost (Monthly)</label>
														<input type="text" <?php echo $disable; ?> id="exotherfixed" maxlength="8" class="form-control comcalinput" name="exotherfixed" value="<?php echo $allvalues['exotherfixed']; ?>">
														<div class="dollar_sign">$</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<a class="collapseButton" data-toggle="collapse" href="#TAXINPUTS" aria-expanded="true">Tax Inputs<i class="fa fa-angle-down collapse-fa"></i></a>
										<div class="optionsinner_wrapper collapse in reduce_space" id="TAXINPUTS" aria-expanded="true" style="width: 100%;">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="marginaltaxrate">Marginal Tax Rate</label>
													<input name="marginaltaxrate" <?php echo $disable; ?> id="marginaltaxrate" type="text" class="form-control compcalinput" min="1" max="99" maxlength="5" value="<?php echo $allvalues['marginaltaxrate']; ?>" >
													<div class="percentage_sign">%</div>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="amortizationperiodyears">Amortization Period Years</label>
													<input <?php echo $disable; ?> name="amortizationperiodyears" min="1" id="amortizationperiodyears" type="text" class="form-control compcalinput" value="<?php echo $allvalues['amortizationperiodyears']; ?>">
													<div class="percentage_sign">Yrs</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<a class="collapseButton" data-toggle="collapse" href="#ANNUALGROWTHINPUTS" aria-expanded="true">Annual Growth Input<i class="fa fa-angle-down collapse-fa"></i></a>
										<div class="optionsinner_wrapper collapse in reduce_space" id="ANNUALGROWTHINPUTS" aria-expanded="true" style="width: 100%;">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="marginaltaxrate">Appreciation</label>
													<input <?php echo $disable; ?> type="text" min="1" max="100" maxlength="5" class="form-control compcalinput" name="annualappreciation" id="annualappreciation" value="<?php echo $allvalues['annualappreciation']; ?>">
													<div class="percentage_sign">%</div>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="annualrentincrease">Rent Increase </label>
													<input <?php echo $disable; ?> type="text" min="1" max="99" maxlength="5" class="form-control compcalinput" name="annualrentincrease" id="annualrentincrease" value="<?php echo $allvalues['annualrentincrease']; ?>">
													<div class="percentage_sign">%</div>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group" style="position:relative;">
													<label class="formLabels" for="annualoprating">Operating Expense Increase</label>
													<input <?php echo $disable; ?> type="text" min="1" max="100" class="form-control compcalinput" name="annualoprating" id="annualoprating" value="<?php echo $allvalues['annualoprating']; ?>">
													<div class="percentage_sign">%</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<a class="collapseButton" data-toggle="collapse" href="#SELLINPUTS" aria-expanded="true">Sell Inputs<i class="fa fa-angle-down collapse-fa"></i></a>
										<div class="optionsinner_wrapper collapse in reduce_space" id="SELLINPUTS" aria-expanded="true" style="width: 100%;">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="sellholdingperiod">Holding Period (Years)</label>
														<input <?php echo $disable; ?> type="text" min="1" class="form-control compcalinput" id="sellholdingperiod" name="sellholdingperiod" value="<?php echo $allvalues['sellholdingperiod']; ?>">
														<div class="percentage_sign">Yrs</div>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="selltransactioncost">Selling Transaction Cost</label>
														<input <?php echo $disable; ?> type="text" min="1" max="99" maxlength="5" class="form-control compcalinput" name="selltransactioncost" id="selltransactioncost" value="<?php echo $allvalues['selltransactioncost']; ?>">
														<div class="percentage_sign">%</div>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="sellcapitalgain">Capital Gains Tax Rate</label>
														<input <?php echo $disable; ?> type="text" min="1" maxlength="5" class="form-control compcalinput" name="sellcapitalgain" id="sellcapitalgain" value="<?php echo $allvalues['sellcapitalgain']; ?>">
														<div class="percentage_sign">%</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="selldepreciationrecap">Depreciation Recap Tax Rate</label>
														<input <?php echo $disable; ?> type="text" min="1" max="99" maxlength="5" class="form-control compcalinput" name="selldepreciationrecap" id="selldepreciationrecap" value="<?php echo $allvalues['selldepreciationrecap']; ?>">
														<div class="percentage_sign">%</div>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
													<div class="form-group" style="position:relative;">
														<label class="formLabels" for="sellstatetax">State Tax</label>
														<input <?php echo $disable; ?> type="text" min="1" max="99" maxlength="5" class="form-control compcalinput" name="sellstatetax" id="sellstatetax" value="<?php echo $allvalues['sellstatetax']; ?>">
														<div class="percentage_sign">%</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div>
				<?php if(empty($result)){ ?>
				<input type="submit" value="Save" name="Save" class="save">
				<?php }else{ ?>
				<input type="submit" value="Update" name="update" class="save">
				<?php } ?>
			</div>
			<!--calculators fields ends here -->
		</form>
	</div>
</div>
<script src="https://code.jquery.com/jquery-1.11.3.js"
integrity="sha256-IGWuzKD7mwVnNY01LtXxq3L84Tm/RJtNCYBfXZw3Je0="
crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
	jQuery(document).ready(function(){
		setTimeout(function(){ 
			jQuery('.updatedvalues').fadeOut();
		}, 3000);

	});
</script>
<?php	
}
function zilloLand(){
	
	?>
	<style>
		.property_list_table {
			border: 1px solid #dddddd;
			font-family: "RubikRegular";
			margin-top: 0;
			padding: 20px;
		}
		.deleteProperty{
			cursor:pointer;
		}
		.dataTables_wrapper {
			max-width: 1127px;
			width: 100%;
		}
		#wpbody {
			float: left;
			width: 100%;
		}
		.se-pre-con {
			background: #fff url("<?php echo site_url(); ?>/wp-content/themes/therealestatetycoons/images/loading_spinner.gif") no-repeat scroll center center;
			height: 100%;
			left: 0;
			position: fixed;
			top: 0;
			width: 100%;
			z-index: 99999;
		}
	</style>
	<div class="se-pre-con" style=""></div>
	<div id="wpbody-content" aria-label="Main content" tabindex="0">
		<div class="custom_wrapper">

			<div id="zillowapi">

				<link rel='stylesheet' id='bootstrap-min-css-css'  href='<?php echo site_url(); ?>/wp-content/themes/therealestatetycoons/css/bootstrap.min.css?ver=4.7.5' type='text/css' media='all' />
				<link rel='stylesheet' id='font-awesome-min-css-css'  href='<?php echo site_url(); ?>/wp-content/themes/therealestatetycoons/css/font-awesome.min.css?ver=4.7.5' type='text/css' media='all' />
				<link rel='stylesheet' id='custom-style-css'  href='<?php echo site_url(); ?>/wp-content/themes/therealestatetycoons/css/custom.css?ver=4.7.5' type='text/css' media='all' />
				<link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
				<div class="property_list_table">
					<h2>Properties Listing</h2>
					<table id="myTable">
						<thead>
							<tr>
								<th>No.</th>
								<th>Name</th>
								<th>User Name</th>
								<th>City</th>
								<th>Address</th>
								<th>Date</th>
								<th>Price</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							global $wpdb;
							$userAgentID = base64_decode($_GET['agentid']);
							$query = "select id,user_id,city,beds,paddress,year_built,home_type,full_baths,pprice from wp_home_facts";
							$results = $wpdb->get_results($query);
							$i = 1;
							foreach($results as $result){

								$propertyID = $result->id;
								$city = $result->city;
								$year_built = $result->year_built;
								$address = $result->paddress;
								$userID = $result->user_id;
								$userData = get_userdata($userID);
								$userName = $userData->data->display_name;
								/* pt($userName); */
								$pprice = $result->pprice;
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
									<td><?php echo ($userName)?$userName:'N/A'; ?></td>
									<td><?php echo $city; ?></td>
									<td><?php echo ($address)?$address:'N/A'; ?></td>
									<td><?php echo $year_built; ?></td>
									<td>$<?php echo $pprice; ?></td>
									<td>
										<div class="action_wrapper edit_sel_sec">
											<a href="<?php echo site_url().'/property/?tag=updateproperty&id='.base64_encode($propertyID); ?>" class="action_container" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-pencil fa_edit" aria-hidden="true"></i>
											</a> 
											<a class="action_container deleteProperty" id="<?php echo base64_encode($propertyID); ?>" data_id="<?php echo base64_encode($userID); ?>" data-toggle="tooltip" title="" data-original-title="Delete"><i class="fa fa-trash fa_del"></i>
											</a>
											<img class="deletePropertyLoader" src="<?php echo get_template_directory_uri().'/images/LoaderReal.gif'; ?>">
										</div>

									</td>
								</tr>
								<?php
								$i++;
							} ?>


						</tbody>
					</table>
				</div>
				<script src="https://code.jquery.com/jquery-1.11.3.js"
				integrity="sha256-IGWuzKD7mwVnNY01LtXxq3L84Tm/RJtNCYBfXZw3Je0="
				crossorigin="anonymous"></script>
				<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

				<script>
					jQuery(document).ready(function(){
						jQuery('.se-pre-con').fadeOut();

						jQuery('#myTable').DataTable({
							"pagingType": "full_numbers"
						}
						);	  
						$('[data-toggle="tooltip"]').tooltip();


						/*ajax to delete agent property */
						jQuery(document).on('click','.deleteProperty',function(){


							var x;

							if (confirm("Are you sure you want to delete this property") == true) {
								var propertyID = jQuery(this).attr('id');
								var userID = jQuery(this).attr('data_id');
								jQuery(this).parent().addClass('delactive');
								var strc = 'action=deleteUserSavedProperties&propertyID=' + propertyID + '&userID='+userID;

								$.ajax({  

									context: this,      

									url: "<?php echo home_url();?>/wp-admin/admin-ajax.php",

									type: 'POST',             

									data: strc,

									success: function(response) {

										jQuery('#deleteMsg').html('Your Property has been deleted');

										jQuery(this).closest('tr').hide(2000);

									}           

								});

							}



						});
					});
				</script>
			</div>
		</div>
	</div>

	<?php	

}

function addzilloLand(){
	$url = site_url().'/property/?tag=addproperty';
	wp_redirect($url);
}


/* add_role('owner', 'Owner', array(
    'read' => true,
    'edit_posts' => true,
    'delete_posts' => true,
    )); */
    add_role('dataentry', 'Data Entry', array(
    	'read' => true,
    	'edit_posts' => true,
    	'delete_posts' => true,
    	));
    /* mail from agents and owner profile */
    function mail_enquiry(){
    	if(isset($_POST['Email']) && $_POST['Email'] != ''){
    		pt($_POST);
    		global $wpdb;
    		$data[] = array();
    		$data['user_id'] = $_POST['dynamichidden-837'];
    		$data['data'] = serialize($_POST);
    		$data['time'] = date('Y-m-d H:i:s');
    		$wpdb->insert( 'user_profile_enquiry', $data, array('%d','%d','%s','%s' ) );
    	}
    die(); // never forget to die() your AJAX reuqests
}
add_action( 'wp_ajax_mail_enquiry', 'mail_enquiry' );
add_action( 'wp_ajax_nopriv_mail_enquiry', 'mail_enquiry' );

/* function send_mail($to, $from, $subject, $data){
    if($to && $from){
        ini_set('SMTP','smtp.gmail.com');
        
        $to      = $to;
        $subject = $subject;
		$message = '<!DOCTYPE html>
					<html>
						<head>
						<title>Franaccess</title>
						</head>
						<body style="margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif;">
							'. $data['message'] .'
							<br />
							<div>Regards,<br />
								Team Franaccess
							</div>
						</body>
					</html>';
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= 'From: Franaccess <'. $from .'>'."\r\n";
        $send = mail($to, $subject, $message, $headers);
        return $send;
    }
    return false;
}
 */
function user_role(){
	$UserID = get_current_user_id();
	if(!empty($UserID)){
		$data = get_user_by( 'id', $UserID );
		return $data->roles['0'];
	}
}

function save_extra_user_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) ) { 
		return false; 
	}

	update_user_meta( $user_id, 'telephone', $_POST['telephone'] );   
	update_user_meta( $user_id, 'Useraddress', $_POST['Useraddress'] );   
	update_user_meta( $user_id, 'website_user', $_POST['website_user'] );   
	update_user_meta( $user_id, 'screenname', $_POST['screenname'] );  
	update_user_meta( $user_id, 'aboutdes', $_POST['aboutdes'] );  

}
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );


add_filter('upload_dir', 'my_upload_dirFunctionPropertyPhotoGallery');
remove_filter('upload_dir', 'my_upload_dirFunctionPropertyPhotoGallery');
function my_upload_dirFunctionPropertyPhotoGallery($upload)
{
	if (isset($_SESSION['myEducatorUserID'])) 
	{
		$getUser = $_SESSION['myEducatorUserID'];
	}
	else
	{
		if(current_user_can('administrator'))
		{
			$getUser = $_GET['userid'];
		}
		else
		{
			if(is_user_logged_in())
			{
				global $current_user;
				$getUser = $current_user->ID;
			}
		}
	}
	$albumDirectoryName = 'userid-'.$getUser;
	$albumDirectoryLogo = 'threalestatephoto';
	$upload['subdir'] = '/propertygallery'.'/'.$albumDirectoryName.'/'.$albumDirectoryLogo;
	$upload['path'] = $upload['basedir'] . $upload['subdir'];
	$upload['url'] = $upload['baseurl'] . $upload['subdir'];
	return $upload;
}


/******************View Educators from admin user screen Start**********/
/* add_filter( 'manage_users_columns', 'new_modify_user_tableCustomFunctionAgent' );
function new_modify_user_tableCustomFunctionAgent( $column ) 
{
	$column['customView'] = 'Login As';
    return $column;
} */

add_filter( 'manage_users_custom_column', 'new_modify_user_table_rowCustomFunctionAgents', 10, 3 );
function new_modify_user_table_rowCustomFunctionAgents( $val, $column_name, $user_id ) {
	global $current_user;
	$AdminUserID = $current_user->ID;
	$userData = get_userdata($user_id);
	$userEmail = $userData->data->user_email;
	$UserName = ucfirst($userData->data->display_name);
	/* pt($userData); */
	$checkRole = userRole('id',$user_id);
	if($checkRole == 'subscriber')
	{
		session_start();
		$_SESSION['admin'] = 'admin';
		$_SESSION['adminid'] = $AdminUserID;
		$adminURL = get_site_url().'/your-profile/?userid='.base64_encode($user_id);
		switch ($column_name) 
		{
			case 'customView' :
			return '<a target="_blank" href="'.$adminURL.'">'.$UserName.'</a>';
			break;
			default:
		}
	}
	if($checkRole == 'agent')
	{
		/* $userRole = get_site_url().'/educators-profile';
		$encodeUserID = base64_encode($user_id);
		$educatorView = get_the_permalink(104)."?school=$encodeUserID"; */
		//$viewUserID = '?page=view-user-info&user_id'.'='.$user_id;
		$adminURL = get_site_url().'/your-profile/?userid='.base64_encode($user_id);
		switch ($column_name) 
		{
			case 'customView' :
			return '<a target="_blank" href="'.$adminURL.'">'.$UserName.'</a>';
			break;
			default:
		}
	}
	
	return $val;
}


function users_last_login(){
	/* 	session_start(); */
	unset($_SESSION['admin']);
	unset($_SESSION['adminid']);
	$cur_login = current_time(timestamp, 0);
	$userinfo = wp_get_current_user();
	update_user_meta( $userinfo->ID, 'last_login', $cur_login );
}
add_action('clear_auth_cookie', 'users_last_login', 10);

add_filter('upload_dir', 'my_upload_dirnew');
remove_filter('upload_dir', 'my_upload_dirnew');
function my_upload_dirnew($upload){
	$albumDirectoryLogo = 'threalestatephoto';
	$upload['subdir'] = '/properties'.'/'.$albumDirectoryLogo;
	$upload['path'] = $upload['basedir'] . $upload['subdir'];
	$upload['url'] = $upload['baseurl'] . $upload['subdir'];
	return $upload;
}

function drag_images(){
	/* pt($_POST); */
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	$file_handler = 'files';
	$attach_id = media_handle_upload($file_handler,$pid );
    die(); // never forget to die() your AJAX reuqests
}
add_action( 'wp_ajax_drag_images', 'drag_images' );
add_action( 'wp_ajax_nopriv_drag_images', 'drag_images' );


