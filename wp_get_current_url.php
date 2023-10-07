<?php

# The url we want to match
$wl_allowed_url = array( 
    '/',
    'race/eleveurs',
    'ajouter-annonces',
);



# Getting the Query String Here
$args = '?'.$_SERVER['QUERY_STRING'];

# Cleaing the Query String and Retriving the URl only
$wl_current_url = str_replace( $args, '',  $_SERVER['REQUEST_URI']);

# Checking if it is home page or Other Page
# If Not Home Page then Clean / This
if( strlen($wl_current_url) > 1 ){
    $wl_current_url = trim( $wl_current_url, '/' );
}

# Check the URl If it is Our Target Url
if ( in_array( $wl_current_url,  $wl_allowed_url) ) {
	# Do Our Things Here
}


## Or Get the Full Page
$page_url  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

echo "Current URL: " . $page_url;