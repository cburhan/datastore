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

function generate_filename_rot($tipe, $tahun)
{
    $CI = &get_instance();
    $CI->load->database();

    // Membuat nomor transaksi baru
    if ($tipe == 1) {
        $prefix = 'ROT_S_' . $tahun . '_';
    } else if ($tipe == 2) {
        $prefix = 'ROT_F_' . $tahun . '_';
    }

    $CI->db->select('COUNT(*) as count');
    $CI->db->from('rot');
    $CI->db->where('TAHUN', $tahun);
    $CI->db->where('TIPE', $tipe);
    $query = $CI->db->get();
    $result = $query->row_array();
    $count = $result['count'] + 1;
    $rot = $prefix . str_pad($count, 2, '0', STR_PAD_LEFT);

    return $rot;
}

function generate_filename_rob($tipe, $bulan, $tahun)
{
    $CI = &get_instance();
    $CI->load->database();

    // Membuat nomor transaksi baru
    if ($tipe == 1) {
        $prefix = 'ROB_S_' . $bulan . '_' . $tahun . '_';
    } else if ($tipe == 2) {
        $prefix = 'ROB_F_' . $bulan . '_' . $tahun . '_';
    }

    $CI->db->select('COUNT(*) as count');
    $CI->db->from('rob');
    $CI->db->where('BLN', $bulan);
    $CI->db->where('TAHUN', $tahun);
    $CI->db->where('TIPE', $tipe);
    $query = $CI->db->get();
    $result = $query->row_array();
    $count = $result['count'] + 1;
    $rot = $prefix . str_pad($count, 2, '0', STR_PAD_LEFT);

    return $rot;
}

function generate_filename_rom($tipe, $week, $bulan, $tahun)
{
    $CI = &get_instance();
    $CI->load->database();

    // Membuat nomor transaksi baru
    if ($tipe == 1) {
        $prefix = 'ROM_S_W' . $week . '_' . $bulan . '_' . $tahun . '_';
    } else if ($tipe == 2) {
        $prefix = 'ROM_F_W' . $week . '_' . $bulan . '_' . $tahun . '_';
    }

    $CI->db->select('COUNT(*) as count');
    $CI->db->from('rom');
    $CI->db->where('WEEK', $bulan);
    $CI->db->where('BLN', $bulan);
    $CI->db->where('TAHUN', $tahun);
    $CI->db->where('TIPE', $tipe);
    $query = $CI->db->get();
    $result = $query->row_array();
    $count = $result['count'] + 1;
    $rot = $prefix . str_pad($count, 2, '0', STR_PAD_LEFT);

    return $rot;
}

function generate_filename_biotrans($bulan, $tahun)
{
    $CI = &get_instance();
    $CI->load->database();

    // Membuat nomor transaksi baru
    $prefix = 'BIO_TRANS_' . $bulan . '_' . $tahun . '_';

    $CI->db->select('COUNT(*) as count');
    $CI->db->from('bio_trans');
    $CI->db->where('BLN', $bulan);
    $CI->db->where('TAHUN', $tahun);
    $query = $CI->db->get();
    $result = $query->row_array();
    $count = $result['count'] + 1;
    $bio = $prefix . str_pad($count, 2, '0', STR_PAD_LEFT);

    return $bio;
}

function generate_filename_biomaster($tipe, $tipe_text)
{
    $CI = &get_instance();
    $CI->load->database();

    // Membuat nomor transaksi baru
    $prefix = 'BIO_MASTER_' . $tipe_text . '_';

    $CI->db->select('COUNT(*) as count');
    $CI->db->from('bio_master');
    $CI->db->where('TIPE', $tipe);
    $query = $CI->db->get();
    $result = $query->row_array();
    $count = $result['count'] + 1;
    $bio = $prefix . str_pad($count, 2, '0', STR_PAD_LEFT);

    return $bio;
}
