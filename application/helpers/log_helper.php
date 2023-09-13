<?php
function activity_log($id, $user, $modul, $action, $color, $ket)
{
    $CI = &get_instance();

    $CI->db->select('ICON');
    $CI->db->from('user_menu');
    $CI->db->where('MENU', $modul);
    $menu = $CI->db->get()->row_array();

    $data = array(
        'USER_ID'       => $id,
        'USER'          => $user,
        'MODUL'         => $modul,
        'ACTION'        => $action,
        'ICON'          => $menu['ICON'],
        'COLOR'         => $color,
        'KETERANGAN'    => $ket,
        'BROWSER'       => $CI->agent->browser(),
        'VER'           => $CI->agent->version(),
        'PLATFORM'      => $CI->agent->platform(),
        'IP'            => $CI->input->ip_address()
    );
    $CI->db->insert('user_activity_log', $data);
}
