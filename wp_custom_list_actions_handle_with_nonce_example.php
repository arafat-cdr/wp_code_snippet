<?php

# For creatng custom actions

$approve_url = wp_nonce_url(admin_url('admin-post.php?action=approve_user&user_id=' . $user_id), 'approve_user_' . $user_id);
$decline_url = wp_nonce_url(admin_url('admin-post.php?action=decline_user&user_id=' . $user_id), 'decline_user_' . $user_id);

$value = "<a href='".$decline_url."' class='button' style='background:red; color:white; margin-right: 7px; margin-bottom:7px;'>".__('Decline', 'listeo')."</a>";
$value .= "<a href='".$approve_url."' class='button'>".__('Approve', 'listeo')."</a>";

# end custom action 

// Now need to process this 
// Use it as a plugin or theme funcitons.php file

// web_lover handle owner approve reject

// This is written in user.php user list table row programmatically
// $approve_url = wp_nonce_url(admin_url('admin-post.php?action=approve_user&user_id=' . $user_id), 'approve_user_' . $user_id);
// $decline_url = wp_nonce_url(admin_url('admin-post.php?action=decline_user&user_id=' . $user_id), 'decline_user_' . $user_id);

function web_lover_handle_approve_request() {
    // Verify the nonce
    if (!wp_verify_nonce($_GET['_wpnonce'], 'approve_user_' . $_GET['user_id'])) {
        wp_die('Invalid nonce');
    }
    // Check if the user can approve users
    if (!current_user_can('edit_users')) {
        wp_die('You do not have permission to approve users');
    }

    // Get the user ID from the query parameter
    $user_id = $_GET['user_id'];

    $user_role = $user_meta = get_user_meta($user_id, 'pup_capabilities', true);

    if (isset($user_role['owner']) && $user_role['owner'] == 1) {
            // Update the user's metadata to mark them as approved
    update_user_meta($user_id, 'user_status', 'approved');

    // $value = get_user_meta($user_id, 'user_status', true);

    // echo $value;

    // die('here we go');
    }



    // Redirect back to the user list table
    wp_redirect(admin_url('users.php'));
    exit;
}
add_action('admin_post_approve_user', 'web_lover_handle_approve_request');




function web_lover_handle_decline_request() {
    // Verify the nonce
    if (!wp_verify_nonce($_GET['_wpnonce'], 'decline_user_' . $_GET['user_id'])) {
        wp_die('Invalid nonce');
    }

    // Check if the user can approve users
    if (!current_user_can('edit_users')) {
        wp_die('You do not have permission to decline users');
    }

    // Get the user ID from the query parameter
    $user_id = $_GET['user_id'];

    $user_role = $user_meta = get_user_meta($user_id, 'pup_capabilities', true);

    if (isset($user_role['owner']) && $user_role['owner'] == 1) {
         // Update the user's metadata to mark them as approved
    update_user_meta($user_id, 'user_status', 'decline');

    // $value = get_user_meta($user_id, 'user_status', true);

    // echo $value;

    // die('see result');

    }

   
    // Redirect back to the user list table
    wp_redirect(admin_url('users.php'));
    exit;
}
add_action('admin_post_decline_user', 'web_lover_handle_decline_request');


// end web_lover handle owner approve reject