<?php
/*** SCRIPTS AND STYLES ***/
add_action( 'wp_enqueue_scripts', 'theme_scripts' );
function theme_scripts() {
  if(is_page_template('template-anniversary.php') || is_page_template('template-tou.php')) {
    wp_enqueue_style('anniversary-style',get_stylesheet_directory_uri().'/anniversary.css',array(),(rand(0,100)/10));
    wp_enqueue_script('anniversary-script',get_stylesheet_directory_uri() . '/inc/anniversary.js',array( 'jquery' ),'1.0',true);
  } else {
    wp_enqueue_style('main',get_stylesheet_uri(),array(),(rand(0,100)/10));
    wp_enqueue_script('main-script',get_stylesheet_directory_uri() . '/inc/script.js',array( 'jquery' ),'1.0',true);
  }
}



/*** IMAGE SIZES ***/
add_theme_support('post-thumbnails');
add_image_size('Anniversary Slideshow',790,620,true);
add_image_size('Anniversary Slideshow Thumb',109,85,true);
add_image_size('Large Slideshow',825,520,true);
add_image_size('Project Quote Photo',255,340,true);
add_image_size('Homepage Slideshow Thumb',350,260,true);
add_image_size('Grid Slideshow Small',270,190,true);
add_image_size('Grid Slideshow Large',570,410,true);
add_image_size('Leadership Thumb',120,120,true);
add_image_size('Services Background',877,999999);


/*** ADD SUPPORT FOR CUSTOM MENUS ***/
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
  register_nav_menu( 'footer-menu', __( 'Footer Nav' ) );
  register_nav_menu( 'top-menu', __( 'Top Nav' ) );
}


/*** THEME CUSTOMIZATION SETTINGS ***/
function mytheme_customize_register( $wp_customize ) {

  // ANNIVERSARY SITE INFO
  $wp_customize->add_section( 'smw_anniv' , array(
    'title'      => __( 'Anniversary Info', 'mytheme' ),
    'priority'   => 30,) 
  );

  // Add Settings
  $wp_customize->add_setting( 'smw_anniv_tagline'    , array('transport' => 'refresh','type' => 'option'));
  
  // Add Controls
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'smw_anniv_tagline', array(
	'label'        => __( 'Tagline', 'mytheme' ),
	'section'    => 'smw_anniv',
	'settings'   => 'smw_anniv_tagline',
  ) ) );
  
  // CONTACT INFO
  $wp_customize->add_section( 'smw_contact' , array(
    'title'      => __( 'Contact Info', 'mytheme' ),
    'priority'   => 30,) 
  );

  // Add Settings
  $wp_customize->add_setting( 'smw_email'    , array('transport' => 'refresh','type' => 'option'));
  $wp_customize->add_setting( 'smw_copyright'    , array('transport' => 'refresh','type' => 'option'));
  $wp_customize->add_setting( 'smw_fb'    , array('transport' => 'refresh','type' => 'option'));
  $wp_customize->add_setting( 'smw_fbtext'    , array('transport' => 'refresh','type' => 'option'));
  $wp_customize->add_setting( 'smw_tw'    , array('transport' => 'refresh','type' => 'option'));
  $wp_customize->add_setting( 'smw_twtext'    , array('transport' => 'refresh','type' => 'option'));
  $wp_customize->add_setting( 'smw_li'    , array('transport' => 'refresh','type' => 'option'));
  $wp_customize->add_setting( 'smw_litext'    , array('transport' => 'refresh','type' => 'option'));
  
  
  // Add Controls
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'smw_email', array(
	'label'        => __( 'Email', 'mytheme' ),
	'section'    => 'smw_contact',
	'settings'   => 'smw_email',
  ) ) );
  
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'smw_copyright', array(
	'label'        => __( 'Copyright info', 'mytheme' ),
	'section'    => 'smw_contact',
	'settings'   => 'smw_copyright',
  ) ) );
  
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'smw_fb', array(
	'label'        => __( 'Facebook (URL)', 'mytheme' ),
	'section'    => 'smw_contact',
	'settings'   => 'smw_fb',
  ) ) );
  
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'smw_fbtext', array(
	'label'        => __( 'Facebook Text', 'mytheme' ),
	'section'    => 'smw_contact',
	'settings'   => 'smw_fbtext',
  ) ) );
  
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'smw_tw', array(
	'label'        => __( 'Twitter (URL)', 'mytheme' ),
	'section'    => 'smw_contact',
	'settings'   => 'smw_tw',
  ) ) );
  
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'smw_twtext', array(
	'label'        => __( 'Twitter Text', 'mytheme' ),
	'section'    => 'smw_contact',
	'settings'   => 'smw_twtext',
  ) ) );
  
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'smw_li', array(
	'label'        => __( 'LinkedIn (URL)', 'mytheme' ),
	'section'    => 'smw_contact',
	'settings'   => 'smw_li',
  ) ) );
  
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'smw_litext', array(
	'label'        => __( 'LinkedIn Text', 'mytheme' ),
	'section'    => 'smw_contact',
	'settings'   => 'smw_litext',
  ) ) );
  
  
  // SITE IDENTITY
  
  // Add Settings
  $wp_customize->add_setting( 'smw_logo'    , array('transport' => 'refresh','type' => 'option'));
  $wp_customize->add_setting( 'smw_anniversary_logo'    , array('transport' => 'refresh','type' => 'option'));
  
  // Add Controls
  $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'smw_logo', array(
	'label'      => __( 'Logo', 'mytheme' ),
	'section'    => 'title_tagline',
	'settings'   => 'smw_logo',
  ) ) );
  $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'smw_anniversary_logo', array(
	'label'      => __( 'Anniversary Logo', 'mytheme' ),
	'section'    => 'title_tagline',
	'settings'   => 'smw_anniversary_logo',
  ) ) );
  
  
}
add_action( 'customize_register', 'mytheme_customize_register' );

/*** ALLOW SVG IN MEDIA LIBRARY ***/
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/*** POST TYPES ***/
add_action('init', 'register_post_types');
function register_post_types() {

    
    /**** REGISTER PROJECTS POST TYPE ****/
	$labels = array(
		'name' => _x('Projects', 'post type general name'),
		'singular_name' => _x('Project', 'post type singular name'),
		'add_new' => _x('Add New Project', 'portfolio item'),
		'add_new_item' => __('Add New Project'),
		'edit_item' => __('Edit Project'),
		'new_item' => __('New Project'),
		'view_item' => __('View Project'),
		'search_items' => __('Search Projects'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/image/nav_team.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','tags')
		//"menu_position" => 21
	  ); 
 
	register_post_type( 'projects' , $args );
	
	// Project Tags Taxonomy
    register_taxonomy(
        'project_tags',
        'projects',
        array(
            'labels' => array(
                'name'              => _x( 'Project Tags' , 'taxonomy general name' ),
                'singular_name'     => _x( 'Project Tag' , 'taxonomy singular name'),
                'add_new_item' => 'Add Project Tag',
                'new_item_name' => "New Project Tag"
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'show_tagcloud' => false,
            'hierarchical' => false,
            'support' => array('tags')
        )
    );

    
    /**** REGISTER SERVICES POST TYPE ****/
	$labels = array(
		'name' => _x('Services', 'post type general name'),
		'singular_name' => _x('Service', 'post type singular name'),
		'add_new' => _x('Add New Service', 'portfolio item'),
		'add_new_item' => __('Add New Service'),
		'edit_item' => __('Edit Service'),
		'new_item' => __('New Service'),
		'view_item' => __('View Service'),
		'search_items' => __('Search Services'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/image/nav_team.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt'),
		'show_in_menu' => 'edit.php?post_type=projects',
		//"menu_position" => 21
	  ); 
 
	register_post_type( 'services' , $args );

    
    /**** REGISTER EXPERTISE POST TYPE ****/
	$labels = array(
		'name' => _x('Industries', 'post type general name'),
		'singular_name' => _x('Industry', 'post type singular name'),
		'add_new' => _x('Add New Industry', 'portfolio item'),
		'add_new_item' => __('Add New Industry'),
		'edit_item' => __('Edit Industry'),
		'new_item' => __('New Industry'),
		'view_item' => __('View Industry'),
		'search_items' => __('Search Industries'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/image/nav_team.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt'),
		'show_in_menu' => 'edit.php?post_type=projects',
		//"menu_position" => 21
	  ); 
	register_post_type( 'industry' , $args );

    
    /**** REGISTER REGION POST TYPE ****/
	$labels = array(
		'name' => _x('Regions', 'post type general name'),
		'singular_name' => _x('Region', 'post type singular name'),
		'add_new' => _x('Add New Region', 'portfolio item'),
		'add_new_item' => __('Add New Region'),
		'edit_item' => __('Edit Region'),
		'new_item' => __('New Region'),
		'view_item' => __('View Region'),
		'search_items' => __('Search Region'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/image/nav_team.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt'),
		'show_in_menu' => 'edit.php?post_type=projects',
		//"menu_position" => 21
	  ); 
	register_post_type( 'region' , $args );

    
    /**** REGISTER LEADERSHIP POST TYPE ****/
	$labels = array(
		'name' => _x('Leadership', 'post type general name'),
		'singular_name' => _x('Bio', 'post type singular name'),
		'add_new' => _x('Add New Bio', 'portfolio item'),
		'add_new_item' => __('Add New Bio'),
		'edit_item' => __('Edit Bio'),
		'new_item' => __('New Bio'),
		'view_item' => __('View Bio'),
		'search_items' => __('Search Leadership'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/image/nav_team.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt'),
		//"menu_position" => 21
	  ); 
 
	register_post_type( 'leadership' , $args );
    flush_rewrite_rules();
}
?>