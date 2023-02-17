<?php

# ALl user status
# pending | decline | approved

# When User Login Restrict User to login
# If we want we can use this feature for any type user only
# For example use this for subscriber or admin or owner type user
# In this case just check the user_type and then Restrict only that user
# I am not doing that here but if I need I can do that
# Later I will do a plugin that is restrict all user / Any certain user

function web_lover_restriction_on_login( $user_login, $user ) {
    // Check if the user is approved
    $status = get_user_meta( $user->ID, 'user_status', true );
    if ( $status !== 'approved' ) {
        // If the user is not approved, log them out and redirect to the homepage
        wp_logout();

        # if use Ajax login then use
        echo json_encode(
            array(
                'loggedin'=>false, 
                'message'=>esc_html__('Login Failed ! Account Status '.$status,'listeo_core')
            )
        );
        die();

        # If use Normal form login then use this
        wp_redirect( home_url() );
        exit;
    }
}
add_action( 'wp_login', 'web_lover_restriction_on_login', 10, 2 );

function web_lover_set_default_user_status_on_registration( $user_id ) {
    // Set the default user status to 'pending'
    add_user_meta( $user_id, 'user_status', 'pending' );
}
add_action( 'user_register', 'web_lover_set_default_user_status_on_registration' );


# Now we need to Create custom action for Decline or Approve user from user.php in wp-admin

# Creating the thead Column
function web_lover_show_custom_user_action($columns)
{
    $columns['owner_status'] = __('Owner Status', 'listeo');
    $columns['owner_action'] = __('owner actions', 'listeo');


    return $columns;
}
add_filter('manage_users_columns', 'web_lover_show_custom_user_action', 15);


# Now Creating the row for thead 

function web_lover_show_admin_user_list_action_rows($value, $column_name, $user_id)
{


    $user_role = $user_meta = get_user_meta($user_id, 'pup_capabilities', true);

    # Here we are using custom user type
    if ('owner_status' == $column_name && isset($user_role['owner']) && $user_role['owner'] == 1) {
        $value = get_user_meta($user_id, 'user_status', true);
    }

    # Here we are using custom user type

    if ('owner_action' == $column_name && isset($user_role['owner']) && $user_role['owner'] == 1) {
        
        $approve_url = wp_nonce_url(admin_url('admin-post.php?action=approve_user&user_id=' . $user_id), 'approve_user_' . $user_id);
        $decline_url = wp_nonce_url(admin_url('admin-post.php?action=decline_user&user_id=' . $user_id), 'decline_user_' . $user_id);

        $value = "<a href='".$decline_url."' class='button' style='background:red; color:white; margin-right: 7px; margin-bottom:7px;'>".__('Decline', 'listeo')."</a>";
        $value .= "<a href='".$approve_url."' class='button'>".__('Approve', 'listeo')."</a>";
    }



    return $value;
}
add_filter('manage_users_custom_column', 'web_lover_show_admin_user_list_action_rows', 15, 3);


# Now Processing Our Custom Action

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

# ALL are done now