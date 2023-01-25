<?php

function custom_function() {
    // Create the nonce
    $nonce = wp_create_nonce( 'custom_nonce' );
    // Add the nonce to a hidden field
    echo '<input type="hidden" name="custom_nonce" value="' . $nonce . '" />';
}
add_action( 'wp_head', 'custom_function' );


function custom_processing_function() {
    // Verify the nonce
    if ( ! wp_verify_nonce( $_POST['custom_nonce'], 'custom_nonce' ) ) {
        wp_die( 'Invalid nonce' );
    }
    // If the nonce is valid, do something
    // ...
}
add_action( 'wp_ajax_custom_action', 'custom_processing_function' );
