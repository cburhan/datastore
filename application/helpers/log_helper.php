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

function generate_kode_pembangkit($milik)
{
    $CI = &get_instance();
    $CI->load->database();

    $CI->db->select('COUNT(*) as count');
    $CI->db->from('pembangkit');
    $query = $CI->db->get();
    $result = $query->row_array();

    $count = $result['count'] + 1;
    $kode_pembangkit = $milik . '' . str_pad($count, 4, '0', STR_PAD_LEFT);

    return $kode_pembangkit;
}

function seq_pembangkit()
{
    $CI = &get_instance();
    $CI->load->database();

    $CI->db->select('COUNT(*) as count');
    $CI->db->from('pembangkit');
    $query = $CI->db->get();
    $result = $query->row_array();

    $count = $result['count'] + 1;
    $seq = str_pad($count, 0, '0', STR_PAD_LEFT);

    return $seq;
}
