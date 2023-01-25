<?php


//  is_shop()

$cate = get_queried_object();
   if(is_product_category()  && $cate->parent != 0 ){

        // Write code here
        //include sidebar here
   }

// is_cart()

// is_checkout()

// check which page tempalte is using
// global $template;

# use Show current page template page

# Check if it is a product details page
# check if it is using page template
// plugins/woocommerce/templates/single-product.php

// Or we can check using 

// if ( is_singular('product') ) {
// 	echo 'Single Product Details Page';
// }

# check this : https://njengah.com/woocommerce-check-product-page/

# check this : https://www.hardworkingnerd.com/using-is_single-in-woocommerce/