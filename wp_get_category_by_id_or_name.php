<?php

# Category in wordPress Mean Term
# Now Query term by name to get it id
# Check the database what its third parameter set and pass it here
# It can be category, or any_custom_key_name set exactly that here
$term_res = get_term_by('name', $term_name, 'listing_category');

# Get Term by id
$term = get_term_by('id', $term_id, 'listing_category');


// Doing Custom Query

global $wpdb;
$wl_db_prefix =  $wpdb->prefix;

$table_term_taxonomy = $wl_db_prefix.'term_taxonomy';

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