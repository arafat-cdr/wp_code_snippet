<?php
$nonce_verify_name = 'wl_Nonce_string_TO_Generate';
$nonce_name = 'wl_nonce_field_name';
?>
<?php wp_nonce_field($nonce_verify_name, $nonce_name); ?>

<?php

if( isset( $_POST[$nonce_name] ) &&  wp_verify_nonce($_POST[$nonce_name], $nonce_verify_name) )
{
	return $_POST;
}

# For AJax Nonce
$nonce = wp_create_nonce( 'MY_NONCE_STRING' );
// include the nonce in the data for the AJAX request
?>

<script>
	var data = {
	  'action': 'my_action',
	  'nonce': $nonce,
	  'data': 'some_data'
	};

	// make the AJAX request
	$.post(ajaxurl, data, function(response) {
	  // handle the response
	});


	$nonce = $_REQUEST['nonce'];

	if ( ! wp_verify_nonce( $nonce, 'MY_NONCE_STRING' ) ) {
	    die( 'Security check' );
	}

</script>