<?php
	
	// ppp($delivery_zones); 

	$shipping           = new \WC_Shipping();
	$shipping_classes   = $shipping->get_shipping_classes();
	// ppp($shipping_classes);

// Shipping zones > Locations not covered by your other zones
	$res = new WC_Shipping_Zone(0);
	$res = $res->get_shipping_methods();

	// ppp($res);
// end
	// die();

		$delivery_zones = WC_Shipping_Zones::get_zones();
	   //define the array outside of the loop
	   $shipping_costs = [];
	   $min_zone = "";
	   //get all costs in a loop and store them in the array
	   foreach ((array) $delivery_zones as $key => $the_zone ) {

	   foreach ($the_zone['shipping_methods'] as $value) {
	       $shipping_costs[] = $value->cost;
	       if(min($shipping_costs) == $value->cost) $min_zone = $the_zone['zone_name'];
	       }
	   }

	  echo $content = $min_zone . " - " . get_woocommerce_currency_symbol() . " " . min($shipping_costs);

	   // var_dump($content); die();






	$product = wc_get_product($product_id);
	// echo "<pre>";
	// print_r($product);
	// echo "<pre>";

	$shipping_class_id = 31;
	$shipping_class= $product->get_shipping_class();

	var_dump($shipping_class);

	$fee = 0;

	if ($shipping_class_id) {
	   $flat_rates = get_option("woocommerce_flat_rates");
	   var_dump($flat_rates);
	   $fee = $flat_rates[$shipping_class]['cost'];
	}

	$flat_rate_settings = get_option("woocommerce_flat_rate_settings");

	if( $flat_rate_settings && isset($flat_rate_settings['cost_per_order']) ){
		return  $flat_rate_settings['cost_per_order'] + $fee;
	}

	// return $fee;