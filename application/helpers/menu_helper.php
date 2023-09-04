<?php
function query_menu($role_id)
{
    $CI = &get_instance();
    $CI->db->select('a.ID, a.MENU, a.ICON, b.TITLE, b.SUB_MENU');
    $CI->db->from('user_menu a');
    $CI->db->join('user_sub_menu b', 'b.MENU_ID = a.ID');
    $CI->db->join('user_access_menu c', 'c.SUB_MENU_ID = b.ID');
    $CI->db->where_in('c.ROLE_ID', $role_id);
    $CI->db->group_by('a.MENU');
    $CI->db->order_by('a.SEQUENCE ASC');
    return $CI->db->get()->result_array();
}

function query_submenu($menu_id, $role_id)
{
    $CI = &get_instance();
    $CI->db->select('*');
    $CI->db->from('user_sub_menu a');
    $CI->db->join('user_menu b', 'a.MENU_ID = b.ID');
    $CI->db->join('user_access_menu c', 'c.SUB_MENU_ID = a.ID');
    $CI->db->where_in('c.ROLE_ID', $role_id);
    $CI->db->where('a.MENU_ID', $menu_id);
    $CI->db->where('a.IS_ACTIVE', 1);
    $CI->db->group_by('a.TITLE');
    $CI->db->order_by('a.ID');
    return $CI->db->get()->result_array();
}

function query_jumlah_menu($menu_id, $role_id)
{
    $CI = &get_instance();
    $CI->db->select('a.MENU');
    $CI->db->from('user_menu a');
    $CI->db->join('user_sub_menu b', 'b.MENU_ID = a.ID');
    $CI->db->join('user_access_menu c', 'c.SUB_MENU_ID = b.ID');
    $CI->db->where_in('c.ROLE_ID', $role_id);
    $CI->db->where('b.MENU_ID', $menu_id);
    $CI->db->where('b.IS_ACTIVE', 1);
    return $CI->db->get()->num_rows();
}
