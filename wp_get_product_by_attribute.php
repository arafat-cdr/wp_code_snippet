<?php

$args = array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'tax_query'      => array(
        'relation' => 'AND', // Set the relation to 'AND' for multiple attribute conditions
        array(
            'taxonomy' => 'pa_rok-year',
            'field'    => 'slug',
            'terms'    => '2010',
        ),
        array(
            'taxonomy' => 'pa_marka-make',
            'field'    => 'slug',
            'terms'    => 'bmw',
        ),
        array(
            'taxonomy' => 'pa_model',
            'field'    => 'slug',
            'terms'    => '518-d',
        ),

        array(
            'taxonomy' => 'pa_kod-fabryczny-chassis',
            'field'    => 'slug',
            'terms'    => 'f11',
        ),

        // Add more attribute conditions as needed
    ),
);


$products = wc_get_products($args);

$product_id_arr = array();

if ($products) {
    foreach ($products as $product) {
        $product_id = $product->get_id();
        $product_id_arr[] = $product_id;
    }
} 


pr( $product_id_arr );


# Checking If a Product list has This Attribute

#------------------------------------------
# add by web_lover
#------------------------------------------

$term_id =  102;


$wl_has_term = wl_check_if_any_product_has_term( $product_id_arr, $term_id );

if( $wl_has_term ){
	$found_count[] = $term_id;

	echo '<br/> Term_Found_on_Product :'.$term_id;

}else{
	echo 'Not_found_term <br/>';
}



#------------------------------------------
# end by web_lover
#------------------------------------------