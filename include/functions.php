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
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Twenty Sixteen, use a find and replace
     * to change 'twentysixteen' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'twentysixteen', get_template_directory() . '/languages' );
   
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
      'footer-menu'  => __( 'Footer Menu', 'twentysixteen' ),
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
   
    register_sidebar( array(
      'name'          => __( 'Video Blog Sidebar', 'twentyfifteen' ),
      'id'            => 'video-blog-cat',
      'description'   => __( 'Add Video Blog Categories/Tags here to appear in your sidebar.', 'twentyfifteen' ),
      'before_widget' => '',
      'after_widget'  => '',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
      'name'          => __( 'Image Blog Sidebar', 'twentyfifteen' ),
      'id'            => 'image-blog-cat',
      'description'   => __( 'Add Image Blog Categories/Tags here to appear in your sidebar.', 'twentyfifteen' ),
      'before_widget' => '',
      'after_widget'  => '',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>',
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
   
    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160412' );
    wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );
   
    // Load the Internet Explorer 8 specific stylesheet.
    wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160412' );
    wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );
   
    // Load the Internet Explorer 7 specific stylesheet.
    wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160412' );
    wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );
   
   
   
       // LOAD THE THEME CSS
    wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/custom.css', array( 'twentysixteen-style' ), '20160412' );
    
   wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array( 'twentysixteen-style' ), '20160412' );
   wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array( 'twentysixteen-style' ), '20160412' );
   wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array( 'twentysixteen-style' ), '20160412' );
   wp_enqueue_style( 'font-awesome.min', get_template_directory_uri() . '/css/font-awesome.min.css', array( 'twentysixteen-style' ), '20160412' );
   wp_enqueue_style( 'form-validation', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css', array( 'twentysixteen-style' ), '20160412' );
   
    // Load the html5 shiv.
    wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
    wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );
   
    wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160412', true );
   
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }
   
    if ( is_singular() && wp_attachment_is_image() ) {
      wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160412' );
    }
   
    wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160412', true );
   
    wp_enqueue_script( 'twentysixteen-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '20160412', true );
    
    wp_enqueue_script( 'twentysixteen-script-bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), '20160412', true );
    wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/npm.js', array( 'jquery' ), '20160412', true );
    wp_enqueue_script( 'form-validation-js', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js', array( 'jquery' ), '20160412', true );
    
    wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
      'expand'   => __( 'expand child menu', 'twentysixteen' ),
      'collapse' => __( 'collapse child menu', 'twentysixteen' ),
    ) );
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
   
   
   /*************************************************/
   /******************* Redux Framework *****************/
   /*************************************************/
   if ( ! defined( 'ABSPATH' ) ) die( 'No direct access allowed' );
   require_once('column-options.php');
   /* Theme option */
   if ( !class_exists( 'ReduxFramework' ) ) {
    require_once( get_template_directory() . '/include/admin-core/framework.php' );
   }
   
   if ( !isset( $redux_demo ) ) {
    require_once( get_template_directory() . '/include/admin-core/admin-config.php' );
   }
   
   
   // CODE TO SHOW MAIN MENU ON SIDEBAR
   add_action('admin_menu', 'add_dashboard_menu');
   
   function add_dashboard_menu(){
      add_menu_page('Home Page', 'Home Page', 'manage_options', 'post.php?post=19&action=edit', '','dashicons-admin-page',7);
      add_menu_page('Contact Page', 'Contact Page', 'manage_options', 'post.php?post=55&action=edit', '','dashicons-admin-page',7);
      add_menu_page('Video Blogs', 'Video Blogs', 'manage_options', 'post.php?post=109&action=edit', '','dashicons-admin-page',7);
      add_menu_page('Image Blogs', 'Image Blogs', 'manage_options', 'post.php?post=123&action=edit', '','dashicons-admin-page',7);
      add_menu_page('Protect Your Home', 'Protect your home', 'manage_options', 'post.php?post=130&action=edit', '','dashicons-admin-page',7);
      add_menu_page('Protect Your Business', 'Protect your business', 'manage_options', 'post.php?post=135&action=edit', '','dashicons-admin-page',7);
      add_menu_page('Comercial and Industrial Solutions', 'Comercial & Ind Solutions', 'manage_options', 'post.php?post=137&action=edit', '','dashicons-admin-page',7);
    }
   // CODE TO SHOW SUB MAIN MENU ON SIDEBAR`
   function make_menu(){
   add_submenu_page('edit.php?post_type=home-products', 'Protect Your Home', 'Manage Page Content', 'manage_options', 'post.php?post=130&action=edit');
   add_submenu_page('edit.php?post_type=business-products', 'Protect Your Business', 'Manage Page Content', 'manage_options', 'post.php?post=135&action=edit');
   add_submenu_page('edit.php?post_type=comercial-products', 'Commercial and Industrial Solutions', 'Manage Page Content', 'manage_options', 'post.php?post=137&action=edit');
   }
   add_action('admin_init','make_menu');
   
   
   // CREATE SHORTCODE FOR VIDEO BLOGS SEARCH MODULE 
   
   
   add_shortcode( 'custom_video_blogs_search', 'custom_search_function_videos' );
   function custom_search_function_videos(){
    $string = "<form role='search' method='get' class='search-form' action='". esc_url( home_url( '/' ) ) ."'>
    <label>
      <input type='search' class='search-field' placeholder='Search' value='". get_search_query() ."' name='s' />
    </label>
   <input type='hidden' name='post_type' value='video-blogs' />
    <button type='submit' class='search-submit'></button>
   </form>";
    return $string ;
   }
   
   // CREATE SHORTCODE FOR IMAGE BLOGS SEARCH MODULE 
   
   add_shortcode( 'custom_image_blogs_search', 'custom_search_function_images' );
   function custom_search_function_images(){
    $string = "<form role='search' method='get' class='search-form' action='". esc_url( home_url( '/' ) ) ."'>
    <label>
      <input type='search' class='search-field' placeholder='Search' value='". get_search_query() ."' name='s' />
    </label>
   <input type='hidden' name='post_type' value='image-blogs' />
    <button type='submit' class='search-submit'>
    
    </button>
   </form>";
    return $string ;
   }
   
   
   // remove WEBSITE URL comments 
   
   function crunchify_disable_comment_url($fields) { 
       unset($fields['url']);
       return $fields;
   }
   add_filter('comment_form_default_fields','crunchify_disable_comment_url');
   
   // MOVE COMMENT TEXTAREA ON BOTTOM   
   function wp34731_move_comment_field_to_bottom( $fields ) {
   $comment_field = $fields['comment'];
   unset( $fields['comment'] );
   $fields['comment'] = $comment_field;
   
   return $fields;
   }
   add_filter( 'comment_form_fields', 'wp34731_move_comment_field_to_bottom' );
   
   
   
   
   /* Function which remove Plugin Update Notices – Post count share*/
   function disable_plugin_updates( $value ) {
      unset( $value->response['post-share-count/post-share-count.php'] );
      return $value;
   }
   add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );
   
   
   // custom pagination FOR BLOG LISTING
   
       function custom_pagination($numpages = '', $pagerange = '', $paged = '') {
      if (empty($pagerange)) {
        $pagerange = 2;
       }
   
    global $paged;
    if (empty($paged)) {
      $paged = 1;
    }
     if ($numpages == '') {
     global $wp_query;
     $numpages = $wp_query->max_num_pages;
     if (!$numpages) {
    $numpages = 1;
    }
    }
    $pagination_args = array(
    'base' => get_pagenum_link(1) . '%_%',
    // 'format' => 'page/%#%',
   
    'format' => 'page/%#%',
     'total' => $numpages,
    'current' => $paged,
     'show_all' => false,
    'end_size' => 1,
    'mid_size' => $pagerange,
    'prev_next' => true,
     'prev_text' => __('&laquo;'),
    'next_text' => __('&raquo;'),
     'type' => 'plain',
      'add_args' => false,
    'add_fragment' => '',
     );
     $paginate_links = paginate_links($pagination_args);
     if ($paginate_links) {
                echo "<nav class='custom-pagination'>";
                echo "<span class='page-numbers page-num'> </span> ";
                /* echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";*/
                echo $paginate_links;
                echo "</nav>";
   
            }
     }
   
   
   
   // custom pagination FOR BLOG CATEGORIES AND TAGS PAGES 
   
   function custom_pagination_arc($numpages = '', $pagerange = '', $paged='') {
     if (empty($pagerange)) {
   $pagerange = 2;
     }
     global $paged;
     if (empty($paged)) {
       $paged = 1;
     }
     if ($numpages == '') {
       global $wp_query;
       $numpages = $wp_query->max_num_pages;
       if(!$numpages) {
           $numpages = 1;
       }
     }
     $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
     $Myurl = 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];
     $pagination_args = array(
       'base'            => $Myurl . '%_%',
       'format'          => '?page_no=%#%',
       'total'           => $numpages,
       'current'         => $paged,
       'show_all'        => False,
       'end_size'        => 1,
       'mid_size'        => $pagerange,
       'prev_next'       => True,
       'prev_text'       => __('&laquo;'),
       'next_text'       => __('&raquo;'),
       'type'            => 'plain',
       'add_args'        => false,
       'add_fragment'    => ''
     );
     $paginate_links = paginate_links($pagination_args);
     if ($paginate_links) {
       echo "<nav class='custom-pagination'>";
       echo $paginate_links;
       echo "</nav>";
     } 
   }
   
   
   // CROP THUMB IMAGE FOR PRODUCTS
   add_image_size( 'product-thumb', 100, 75 ); 
   
   
   //// AJAX FUNCTION TO GET THE SERVICE DATA
   function get_service_data(){
   $termid = $_POST['termid'];
   $taxname = $_POST['taxname']; 
   $dynamic_post_type = $_POST['dynamic_post_type'];

  // echo $termid;
   //echo $taxname;
  // echo $dynamic_post_type;
   
    $service_left_image = get_term_meta($termid,'ba_image_field_id_3',true);
    $service_right_content = get_term_meta($termid,'ba_wysiwyg_field_4',true);
    $service_full_banner = get_term_meta($termid,'ba_image_field_id_5',true);
   ?>
<!-- Tab panes -->
<div class="tab-content">
   <div role="tabpanel" class="tab-pane active" id="service_<?php echo $termid; ?>">
      <!--Burlglary Section Starts-->
      <div class="burglary-section">
         <div class="fl-row-fixed-width">
            <div class="row">
               <div class="col-md-5 left-area">
                  <img src="<?php echo $service_left_image['url']; ?>">
               </div>
               <div class="col-md-7 right-area">
                  <?php echo $service_right_content; ?>
               </div>
            </div>
         </div>
      </div>
      <!--Burglary Section Ends-->
      <!--Full Width Section Starts-->
      <div class="full-width-burglar-section">
         <img src="<?php echo $service_full_banner['url']; ?>">
      </div>
      <!--Full Width Section Ends-->
      <!--Product Section Starts-->   
      <div class="product-section">
         <div class="fl-row-fixed-width">            
              <?php
               $myterms = get_terms($taxname);
               foreach ($myterms as $myterm ) {
                 wp_reset_query();
                 $term_args = array('post_type' => $dynamic_post_type,
                       'tax_query' => array(
                           array(
                               'taxonomy' => $taxname,
                               'field' => 'term_id',
                               'terms' => $termid,
                           ),
                       ),
                    );
                }
               // echo '<pre>';
               //    print_r($term_args);
               //    echo '</pre>';
               $loop = new WP_Query($term_args);
               if($loop->have_posts())
               {
                echo '<p class="main-heading">Beacon Protection Products</p>';
               while($loop->have_posts()) : $loop->the_post();
               endwhile;
               ?>
              <div class="inner-content-section">
                 <div class="row">
                    <div class="col-md-4 slider-section">
                       <div class="pro_arrow"></div>
                       <div class="owl-carousel">
                          <?php
                             $args = array(
                             'post_type' => $dynamic_post_type,
                             'tax_query' => array(
                                 array(
                                 'taxonomy' => $taxname,
                                 'field' => 'id',
                                 'terms' => $termid
                                  )
                               )
                             );
                             $the_query = new WP_Query( $args ); 
                             if ( $the_query->have_posts() ) 
                             {
                                   $i = 1 ;
                                   echo '<ul>';
                                   while ( $the_query->have_posts() ) 
                                   {
                                       $the_query->the_post(); 
                                        if($i % 7 == 0) {echo '</ul><ul>';}
                                           ?>
                          <li class="get_product <?php if($i==1){echo "first_product current";} ?>" id="product-<?php echo get_the_ID(); ?>" rel="<?php echo get_the_ID(); ?>">
                             <?php echo get_the_post_thumbnail( $post->ID, 'product-thumb' ); ?>
                             <span><?php the_title(); ?></span>

                             <script type="text/javascript">
                             jQuery(document).ready(function()
                             {
                             // GET PRODUCT DATA SCRIPT
                             jQuery("#product-<?php echo get_the_ID(); ?>").click(function(){
                              jQuery('.product_all_data').html('');
                              jQuery('.ajaxloader_pro').html('<img src="<?php echo get_template_directory_uri() ?>/images/loader.gif" />');
                              jQuery('.product_all_data').html('<div class="ajaxloader"><img src="<?php echo get_template_directory_uri() ?>/images/loader.gif" /></div>');
                              var prod_id = jQuery(this).attr('rel');
                             // alert(termid);
                              
                              jQuery.ajax({
                                method: "POST",
                                url:"<?php echo site_url(); ?>/wp-admin/admin-ajax.php",   
                                data: "action=get_product_data"+"&prod_id="+prod_id,
                                success:function(data) {
                                   jQuery('.product_all_data').html(data);
                               }
                             })
                             
                             });
                             
                             });
                          </script>
                          </li>
                          
                          <?php
                             $i++; 
                             }  
                             wp_reset_query();
                             }
                             echo '</ul>';
                             ?> 
                       </div>
                    </div>
                    <div class="col-md-8 product_all_data">
                       <div class="ajaxloader_pro"></div>
                       <script type="text/javascript">
                          jQuery(document).ready(function(){
                          var first_pro_id = jQuery(".first_product").attr("rel");
                           jQuery('.ajaxloader_pro').html('<img src="<?php echo get_template_directory_uri() ?>/images/loader.gif" />');
                            jQuery.ajax({
                                  method: "POST",
                                  url:"<?php echo site_url(); ?>/wp-admin/admin-ajax.php",   
                                 data: "action=get_product_data"+"&prod_id="+first_pro_id,
                                  success:function(data) {
                                     jQuery('.product_all_data').html(data);
                                    
                                 }
                            });
                          });
                       </script> 
                    </div>
                    <!--Modal Ends-->
                 </div>
              </div>
               <?php
               }
                else{
                // echo '<h2 class="text-center alert alert-danger">No Product Found</h2>';
               
               }
               ?>
         </div> <!--End Container-->
      </div><!--End Product Section-->

   </div>
</div>
<!-- Tab panes end-->
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/owl.carousel.min.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function()
   {
   
    jQuery('.active ul li').click(function() {
      //alert('test');
       jQuery('.active ul li').removeClass('current');
      jQuery(this).addClass('current');
      // jQuery(this).closest('li').addClass('current');
   });
   
   
     jQuery('#myTabs li a').click(function (e) 
     {
          e.preventDefault()
          jQuery(this).tab('show');
     })
     jQuery('.owl-carousel').owlCarousel({
       //  loop:true,
         margin:0,
         nav:true,
         dots:false,
         items:1,
         autoplay:false,
         autoplaySpeed:2000,
         navText: [
        "<i class='fa fa-caret-left icons'></i>",
        "<i class='fa fa-caret-right icons'></i>",
        ],
         responsive:
         {
             0:{
                 items:1
             },
             600:{
                 items:1
             },
             1000:{
                 items:1
             }
         }
     
     });
   
  var carousel = jQuery('.owl-carousel').data('owlCarousel');

// and then you can use this function on window resize or do whatever you like
    if (carousel._items.length <= carousel.settings.items) 
    {
      
       jQuery('.owl-carousel').addClass('hide-controls');
    }
   /* if(jQuery('.owl-carousel .owl-item').length === 1) 
    {
        //There is one image
        jQuery('.owl-prev, .owl-next').hide();
    }*/


   });
</script>
<script>
  jQuery(window).resize(function()
  {
        if(jQuery('.owl-carousel .owl-item').length === 1) 
      {
          //There is one image
          jQuery('.owl-prev, .owl-next').hide();
      }
  });
</script>
<?php 
  die();
   }
// creating Ajax call for WordPress
add_action( 'wp_ajax_nopriv_get_service_data', 'get_service_data' );
add_action( 'wp_ajax_get_service_data', 'get_service_data' );
   
   
   //**************************AJAX FUNCTION END FOR GETTING SERVICES DATA ******************************//
       // END SCRIPT
   
// AJAX FUNCTION TO GET PRODUCT DATA
function get_product_data(){
 $prod_id = $_POST['prod_id'];
// echo $prod_id." HELL";
 ?>
<div class="ajaxloader_pro"></div>
<div class="col-md-7 content-section padding-left">
   <?php echo get_the_post_thumbnail($prod_id, 'full' ); ?>
   <h3 id="pro_name_for_email">
      <?php  echo get_the_title( $prod_id ); ?>
   </h3>
   <div class="prod_desc">
      <?php
         $content_post = get_post($prod_id);
         $content = $content_post->post_content;
         $content = apply_filters('the_content', $content);
         $content = str_replace(']]>', ']]&gt;', $content);
         echo $content;
                                       ?>
   </div>
</div>
<div class="col-md-5 content-section">
   <btn class="request-btn" data-toggle="modal" data-target="#productModal">Request A Consultation</btn>
   <div class="clearfix"></div>
   <div class="feature_wrap">
      <h3>Features</h3>
      <div class="featuredata">
         <?php
            $product_features = get_post_meta($prod_id, 'wpcf-product-features',true);
            echo $product_features;
            ?>
      </div>
   </div>
   <!--Modal-->
    <?php // this form is added on SERVICE TEMPLATE ?>
   <!--Modal end-->
</div>
<?php
die(); 
}
// creating Ajax call for WordPress
add_action( 'wp_ajax_nopriv_get_product_data', 'get_product_data' );
add_action( 'wp_ajax_get_product_data', 'get_product_data' );

/* Get percentage according to count of question */
function get_que_percentage($que_count = 0){
  if($que_count){
    $always_val   = 100/$que_count;
    $sometime_val = $always_val/2;    
    $total = $always_val*$que_count;    
    $plus  = $always_val + $always_val + $always_val;
    return array('always_val' => $always_val, 'sometime_val' => $sometime_val, 'total' => $total, 'plus' => $plus);
  }
  return false;
}
/* End of percentage.*/

/* Send score calculation to user. */
function send_calculation(){
    if(isset($_REQUEST['email']) && $_REQUEST['email']){
      $data       = $_REQUEST;      
      $answers    = explode(',', $data['answers']);
      $questions  = get_post_meta($data['page_id'],'wpcf-question', false);
      $check      = '<img src="http://branddemos.com/beaconprotection/wp-content/uploads/2016/05/check-1.png" />';
      $close      = '<img src="http://branddemos.com/beaconprotection/wp-content/uploads/2016/05/cross.png" />';
     
      /* Create Email template for Admin */
      $admin_message   =   '<html>
                              <head>
                              <title>Safety Score</title>
                              </head>
                              <body>
                                <div style="width:100%;max-width:650px;padding:10px;margin:20px auto;float:left;clear:both;">
                                  <div style="padding:15px;float: left;width:95%;">
                                    <div style="width:100%;padding:10px 0 7px;text-align:center;"><img src="http://branddemos.com/beaconprotection/wp-content/uploads/2016/04/logo.png" style="max-width:200px" alt="" /></div>
                                    <div style="margin:15px 0;line-height:20px;">
                                      <strong>Hi Admin, </strong><br/><br/>
                                      '.$data['name'].', calculated safety score are <strong>'.$data['score'].'%</strong> according to below calculated quiz.<br /><br />
                                      <table>
                                        <tr>
                                          <th width="60%"></th>
                                          <th width="10%">Never</th>
                                          <th width="30%">Sometimes</th>
                                          <th width="20%">Always</th>
                                        </tr>';
                                        foreach ($questions as $qk => $qv) {
                                          $n = ($answers[$qk] == 1) ? $check : $close;
                                          $s = ($answers[$qk] == 2) ? $check : $close;
                                          $a = ($answers[$qk] == 3) ? $check : $close;
                       $admin_message   .= '<tr>
                                              <td valign="middle" style="border:1px solid;padding-left:10px;padding-top:0;">'.$qv.'</td>
                                              <td valign="middle" style="border:1px solid;text-align:center;padding-top:5px;">'. $n .'</td>
                                              <td valign="middle" style="border:1px solid;text-align:center;padding-top:5px;">'. $s .'</td>
                                              <td valign="middle" style="border:1px solid;text-align:center;padding-top:5px;">'. $a .'</td>
                                            </tr>';     
                                        }                                        
                 $admin_message   .= '</table>
                                      <br /><br />
                                      Regards,<br />
                                      Beacon Protection Team.
                                    </div>
                                  </div>
                                </div>                
                              </body>
                            </html>';                            
      /* End of admin email template. */

      /* Admin Email Header */
      $subject = $data['name'] .' calculated safety score';
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
      $headers .= "X-Priority: 1 (Highest)". "\r\n";
      $headers .= "X-MSMail-Priority: High". "\r\n";
      $headers .= "Importance: High". "\r\n";

      /* More headers*/      
      $from  = $data['email'];
      $admin = 'testertech91@gmail.com';
      $headers .= 'From: Beacon Protection <'.$from.'>' . "\r\n";
      mail($admin, $subject, $admin_message, $headers );
      /* End of admin email header. */

      /* Create Email Template for client. */
      $client_message   =   '<html>
                              <head>
                              <title>Safety Score</title>
                              </head>
                              <body>
                                <div style="width:100%;max-width:650px;padding:10px;margin:20px auto;float:left;clear:both;">
                                  <div style="padding:15px;float: left;width:95%;">
                                    <div style="width:100%;padding:10px 0 7px;text-align:center;"><img src="http://branddemos.com/beaconprotection/wp-content/uploads/2016/04/logo.png" style="max-width:200px" alt="" /></div>
                                    <div style="margin:15px 0;line-height:20px;">
                                      <strong>Hi '.$data['name'].', </strong><br/><br/>
                                      Your calculated safety score are <strong>'.$data['score'].'%</strong> according to below your calculated quiz.<br /><br />
                                      <table>
                                        <tr>
                                          <th width="60%"></th>
                                          <th width="10%">Never</th>
                                          <th width="30%">Sometimes</th>
                                          <th width="20%">Always</th>
                                        </tr>';
                                        foreach ($questions as $qk => $qv) {
                                          $n = ($answers[$qk] == 1) ? $check : $close;
                                          $s = ($answers[$qk] == 2) ? $check : $close;
                                          $a = ($answers[$qk] == 3) ? $check : $close;
                       $client_message   .= '<tr>
                                              <td valign="middle" style="border:1px solid;padding-left:10px;padding-top:0;">'.$qv.'</td>
                                              <td valign="middle" style="border:1px solid;text-align:center;padding-top:5px;">'. $n .'</td>
                                              <td valign="middle" style="border:1px solid;text-align:center;padding-top:5px;">'. $s .'</td>
                                              <td valign="middle" style="border:1px solid;text-align:center;padding-top:5px;">'. $a .'</td>
                                            </tr>';     
                                        }                                        
                 $client_message   .= '</table>
                                      <br /><br />
                                      Regards,<br />
                                      Beacon Protection Team.
                                    </div>
                                  </div>
                                </div>                
                              </body>
                            </html>';
      /* End of client email template. */

      $subject = $data['name'] .' calculated safety score';
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
      $headers .= "X-Priority: 1 (Highest)". "\r\n";
      $headers .= "X-MSMail-Priority: High". "\r\n";
      $headers .= "Importance: High". "\r\n";

      /* More headers*/      
      $from = 'testertech91@gmail.com';
      $headers .= 'From: Beacon Protection <'.$from.'>' . "\r\n";     
      
      $to_client = $data['email'];
      if(@mail($to_client, $subject, $client_message, $headers )){
        $response['success'] = 1;
        $response['msg']     = 'Your e-mail has been sent.';
      } else {
        $response['success'] = 0;
        $response['msg']     = 'Please try again!';
      }
      echo json_encode($response);
    }
    die();
}

/* End of send score calculation to user. */
add_action( 'wp_ajax_nopriv_send_calculation', 'send_calculation' );
add_action( 'wp_ajax_send_calculation', 'send_calculation' );

// function digisavvy_beaver_builder( $post_ids ) {
//    $args = array( 'posts_per_page' => -1, 'post_type' => 'page' );
//    $post_ids[] = get_posts( $args );
   
//    return $post_ids; }

//    add_action('init','abcd');
//    function abcd(){

//  add_filter( 'fl_builder_global_posts', 'digisavvy_beaver_builder' , 10,3);

//    }

/*add_action( 'wp_default_scripts', function( $scripts ) {
    if ( ! empty( $scripts->registered['jquery'] ) ) {
        $jquery_dependencies = $scripts->registered['jquery']->deps;
        $scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
    }
} );*/