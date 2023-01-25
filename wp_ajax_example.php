<?php

/**
 *
 * ** Remember In ajax if send data 
 * as Json_encode then In jquery
 * You need to parse that Data Before using it
 *
 */


function wl_custom_fun_to_run_at_call(){

	 # We have to do 2 query
	 global $wpdb;
	 $wl_db_prefix =  $wpdb->prefix;
	 $table_term_taxonomy = $wl_db_prefix.'term_taxonomy';
	 $table_term = $wl_db_prefix.'terms';

	 // echo '-----------------------------------<br/>'
	 // echo $table_term_taxonomy;

	 # Saved the data here for later use
	 $wl_all_child = array();

	 if( $_POST['type_data_arr'] ){
	     foreach( $_POST['type_data_arr'] as $k => $v ){
	         $term_name = sanitize_text_field( $v );

	         # Now Query term by name to get it id
	         $term_res = get_term_by('name', $term_name, 'listing_category');
	         if( $term_res ){

	             $term_id = $term_res->term_id;
	             $parent_category_id = $term_id;

	             # 1st wp_term_taxonomy
	             $all_cat_childs =  $wpdb->get_results( "SELECT * FROM $table_term_taxonomy WHERE parent=$parent_category_id" );
	             
	             if( $all_cat_childs ){
	                 foreach ($all_cat_childs as $k => $v) {
	                     $term_id = $v->term_id;
	                     $term = get_term_by('id', $term_id, 'listing_category');

	                     // pr($term_id);
	                     // pr($term->name);

	                     $wl_all_child[] = array(
	                         'id' => $term_id,
	                         'text' => $term->name,
	                     );
	                 }
	             }

	         }

	     }
	 }
	echo $select_2_data = json_encode($wl_all_child);
	wp_die();

}

# For Login user
add_action( 'wp_ajax_wl_custom_fun_to_run_at_call', 'wl_custom_fun_to_run_at_call' );
# For Non Login User
add_action( 'wp_ajax_nopriv_wl_custom_fun_to_run_at_call', 'wl_custom_fun_to_run_at_call' );



function wl_footer_jquery_script(){
?>
<script>
    jQuery(document).ready(function($){

       // on change the function send data
       $("#_type").on('change', function(e) {

           var type_data = $(this).select2('data');
           // console.log(type_data);
           var type_data_arr = [];
           
           // Iterate the selected data
           $.each(type_data, function(key,valueObj){
              // console.log('my text: '+valueObj.text);
              type_data_arr.push(valueObj.text);
           });

           // do a ajax here
           jQuery.post(
               "<?php echo admin_url( 'admin-ajax.php' ); ?>",
               {
                   'action': 'wl_custom_fun_to_run_at_call',
                   'type_data_arr': type_data_arr,
                   // add as much post data here
                   // key value pair
               }, 
               function(res){
                   // console.log(res);
                   if(res){
                       var my_data = JSON.parse(res);
                       jQuery('#tax-listing_category').select2('destroy').empty().select2({data: my_data});
                   }
               }
           );

       });
 /*      setTimeout(function(){
       jQuery('#tax-listing_category').select2('destroy').empty().select2({data: [{
             "id": 3,
             "text": "Option 3",
           }]});
       }, 800);
   */

    });
</script>
<?php
}
add_action( 'wp_footer', 'wl_footer_jquery_script', 8 );