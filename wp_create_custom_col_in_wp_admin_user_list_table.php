<?php

# Create table thead column

function web_lover_show_admin_user_list_documents($columns)
{
    $columns['owner_status'] = __('Owner Status', 'listeo');
    $columns['kbis_url'] = __('kbis', 'listeo');
    $columns['identity_doc_url'] = __('identity doc', 'listeo');
    $columns['owner_action'] = __('owner actions', 'listeo');


    return $columns;
}
add_filter('manage_users_columns', 'web_lover_show_admin_user_list_documents', 15); 
// for showing end we use 15 as priority


// Now show the row on that new thead column

function web_lover_show_admin_user_list_document_row($value, $column_name, $user_id)
{

    if ('kbis_url' == $column_name) {

        $value = get_user_meta($user_id, 'kbis_url', true);

        if ($value) {
            $value = "<a href='" . esc_attr($value) . "' target='_blank'>" . __('Kbis Document', 'listeo') . "</a>";
        }
    }

    if ('identity_doc_url' == $column_name) {
        $value = get_user_meta($user_id, 'kbis_url', true);
        if ($value) {
            $value = "<a href='" . esc_attr($value) . "' target='_blank'>" . __('Identity Document', 'listeo') . "</a>";
        }
    }

    $user_role = $user_meta = get_user_meta($user_id, 'pup_capabilities', true);

    if ('owner_status' == $column_name && isset($user_role['owner']) && $user_role['owner'] == 1) {
        $value = get_user_meta($user_id, 'user_status', true);
    }

    if ('owner_action' == $column_name && isset($user_role['owner']) && $user_role['owner'] == 1) {
        
        $approve_url = wp_nonce_url(admin_url('admin-post.php?action=approve_user&user_id=' . $user_id), 'approve_user_' . $user_id);
        $decline_url = wp_nonce_url(admin_url('admin-post.php?action=decline_user&user_id=' . $user_id), 'decline_user_' . $user_id);

        $value = "<a href='".$decline_url."' class='button' style='background:red; color:white; margin-right: 7px; margin-bottom:7px;'>".__('Decline', 'listeo')."</a>";
        $value .= "<a href='".$approve_url."' class='button'>".__('Approve', 'listeo')."</a>";
    }



    return $value;
}
add_filter('manage_users_custom_column', 'web_lover_show_admin_user_list_document_row', 15, 3);

