<?php

if(!function_exists('wl_check_if_any_product_has_term')){
	function wl_check_if_any_product_has_term( $product_ids, $term_id ){
		
		if( $product_ids ){

			foreach( $product_ids as $product_id ){

				$res =  get_term($term_id);
				$taxonomy = $res->taxonomy;

				# add by web_lover
				if (has_term($term_id, $taxonomy, $product_id)){
					return true;
				}

			}
		}

		# Term Not Found
		return false;

	}
}

