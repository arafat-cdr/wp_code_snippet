<?php

//prevent direct access it is asecurity issue
if ( !function_exists( 'add_action' ) ) { 
	echo 'Direct Access Not Allowed';
	exit;
}

//setup
define('PLUGIN_CONSTANT',__FILE__);


//Includes
include( 'includes/call_back_func_1.php' );

//Hooks
add_action( 'plugins_loaded', 'arafat_load_textdomain' );


//Shortcodes
add_shortcode( 'my_cusotom_code', 'func_to_call' );