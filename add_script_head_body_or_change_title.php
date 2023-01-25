<?php

# -----------------------------
# add jquery to head
#-------------------------------
function insert_jqueryin_head(){
wp_enqueue_script('jquery', false, array(), false, false);
}
add_filter('wp_enqueue_scripts','insert_jqueryin_head',1);
# end

add_filter('body_class','add_my_custom_body_class');
function add_my_custom_body_class( $classes ){
	$classes[] = 'my-custom-body-class';
	return $classes;
}

# add After <body> Here it will add ....
add_action('wp_body_open', 'wl_setting_page_load');

# If I want add something in the post content and post title
add_filter('the_content', 'content_filter_func');
add_filter('the_title', 'title_filter_func');

# 100 The higher the number it will add in the end in footer tag
add_action('wp_footer', 'add_this_script_main_file_footer', 100);

# To check a url
# or we can use add_action('init', 'fun_to_call')
add_action('parse_request', 'wl_learn_end_points_list', 0);
function wl_learn_end_points_list(){
	global $wp;
	if( $wp->request == 'my_page.php' ){
		// do my stuuf
	}
}

# load style to admin
add_action( 'admin_enqueue_scripts', 'my_admin_sc_call' );

function my_admin_sc_call(){
	# Allowed CSS and Js Pages
	$admin_css_page = array(
	    'admin_page_query_string',
	);

	if( isset( $_GET['page'] ) && in_array($_GET['page'], $admin_css_page) ){

	    // loading data table css
	    wp_register_style( WL_PRETTY_API_PREFIX.'datatable', 'https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css', false, '1.0.0' );
	    wp_enqueue_style( WL_PRETTY_API_PREFIX.'datatable' );


	    # loading script
	    wp_register_script( 'wl_satellite_tether', WL_SATELLITE_URL.'assets/plugins/bootstrap/js/tether.min.js', array('jquery-core'), false, true );
	    wp_enqueue_script( 'wl_satellite_tether' );

	}

}

# Load style to front-end
add_action('wp_enqueue_scripts', 'front_end_load_sc');
function front_end_load_sc(){
	// style
	wp_register_style( 'wl_satellite_bootstrap_css', WL_SATELLITE_URL.'assets/plugins/bootstrap/css/bootstrap.min.css', false, '1.0.0' );
	wp_enqueue_style( 'wl_satellite_bootstrap_css' );

	// script
	wp_register_script( 'wl_satellite_tether', WL_SATELLITE_URL.'assets/plugins/bootstrap/js/tether.min.js', array('jquery-core'), false, true );
	wp_enqueue_script( 'wl_satellite_tether' );
}


# Call My template That I want to use
add_filter('template_include', 'example_tem_use', 1,1);

function example_tem_use($curr){
	# here is mine one
	# I use full Header footer I mean a full tem
	# with doctype to end
	$temp =  __DIR__."/tem_to_use_with_full_head_footer.php";

	return $temp;
}


# change any custom template tytle
function cnge_custom_tem_title($all){

	// pr($all['title']);

	# conditions
	global $wp;

	if( "my_custom_page" == $wp->request ){
		$all['title'] = 'custom title to add';
	}

	return $all;

}

add_filter('wp_nav_menu_items', 'satellite_add_setting_to_menu', 20, 2);

function satellite_add_setting_to_menu($items, $args) {
				$current_uri = home_url('satellite_page_setting');
        $link = '<a href="'.$current_uri.'" style="white-space: nowrap;">'.
    	__('Settings', SATELLITE_TD).'
    </a>';

        return $items . $link;

}

add_filter( 'document_title_parts', 'cnge_custom_tem_title', 1);

# for a code snippet I can use
# Mostly you can use inside your short code call
// include_once/require_once that can solve a lot of issue

# But when I need to create a custom front-end page
# Then tempalte use is the only Succ solutions

# Anything want to do ? do after wp load 
add_action('init', 'anything_want_to_do_do_after_wp_load');
