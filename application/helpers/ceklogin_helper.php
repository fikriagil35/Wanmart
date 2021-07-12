<?php

function cek_logged_in()
{
    $ci = get_instance();
    if (is_null($ci->session->userdata('role_id'))) {
        redirect('auth');
    }
}
function is_admin()
{
    $ci = get_instance();
    if (is_null($ci->session->userdata('role_id'))) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        // yg admin rolenya 1 apa 2? kalo admin 1 malah error
        if ($role_id != 1) {
            redirect('user');
        }
    }
}


function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
