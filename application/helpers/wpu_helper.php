<?php 

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        if($role_id > 2){
            $menu = $ci->uri->segment(3);
            if(is_numeric($menu)){
                if($menu !== NULL){
                    $queryMenu = $ci->db->where('id', $menu)->get('user_menu')->row_array();
                    $menu_id = $queryMenu['id'];

                    $userAccess = $ci->db->get_where('user_access_menu', [
                        'role_id' => $role_id,
                        'menu_id' => $menu_id
                    ]);

                    if ($userAccess->num_rows() < 1) {
                        redirect('auth/blocked');
                    }
                }
            } else {
                if(!is_numeric($ci->uri->segment(2))){
                    $menu = $ci->uri->segment(3);
                    if(is_numeric($menu)){
                        $menu = $ci->uri->segment(3);
                        $queryMenu = $ci->db->where('id', $menu)->get('user_menu')->row_array();
                        $menu_id = $queryMenu['id'];

                        $userAccess = $ci->db->get_where('user_access_menu', [
                            'role_id' => $role_id,
                            'menu_id' => $menu_id
                        ]);

                        if ($userAccess->num_rows() < 1) {
                            redirect('auth/blocked');
                        }
                    } 
                } else {
                    $menu = $ci->uri->segment(4);
                    if(is_numeric($menu)){
                        $menu = $ci->uri->segment(4);
                        $queryMenu = $ci->db->where('id', $menu)->get('user_menu')->row_array();
                        $menu_id = $queryMenu['id'];

                        $userAccess = $ci->db->get_where('user_access_menu', [
                            'role_id' => $role_id,
                            'menu_id' => $menu_id
                        ]);

                        if ($userAccess->num_rows() < 1) {
                            redirect('auth/blocked');
                        }
                    } else {
                        $menu = $ci->uri->segment(1);
                        $queryMenu = $ci->db->like('menu', $menu)->get('user_menu')->row_array();
                        $menu_id = $queryMenu['id'];

                        $userAccess = $ci->db->get_where('user_access_menu', [
                            'role_id' => $role_id,
                            'menu_id' => $menu_id
                        ]);

                        if ($userAccess->num_rows() < 1) {
                            redirect('auth/blocked');
                        }
                    }
                }
            }
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
