<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
//CHECK STATUS ACTIVE
function check_active($is_active)
{
    if ($is_active == 1) {
        return "checked='checked'";
    }
}

//CHECK USER ROLE
function check_user_role($role_id, $user_id)
{
    $CI = &get_instance();
    $CI->db->where('ROLE_ID', $role_id);
    $CI->db->where('USER_ID', $user_id);
    $result = $CI->db->get('user_group_role');
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

//GET ROLE ACCESS
function get_role_access($role_id)
{
    $CI = &get_instance();
    $CI->db->select('b.TITLE, a.SUB_MENU_ID, b.CLASS_METHOD');
    $CI->db->from('user_access_menu a');
    $CI->db->join('user_sub_menu b', 'a.SUB_MENU_ID = b.ID');
    $CI->db->where('a.ROLE_ID', $role_id);
    $CI->db->order_by('b.CLASS_METHOD');
    return $CI->db->get()->result_array();
}

//CHECK ACCESS
function check_access($role_id, $sub_menu_id)
{
    $CI = &get_instance();
    $CI->db->where('ROLE_ID', $role_id);
    $CI->db->where('SUB_MENU_ID', $sub_menu_id);
    $result = $CI->db->get('user_access_menu');
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function check_permission()
{
    $CI = &get_instance();
    if (!$CI->session->userdata('p2ep')) {
        redirect('login');
    } else {
        $role_id = $CI->session->userdata('p2ep')['role_id'];
        //$sub_menu = $CI->uri->segment(2);
        $roles = array_column($role_id, 'ROLE_ID');
        $class_method = $CI->router->fetch_class() . "/" . $CI->router->fetch_method();
        //echo json_encode($class_method);
        //exit;
        if ($roles == NULL) {
            redirect('blocked');
        }

        $CI->db->select('*');
        $CI->db->from('user_sub_menu');
        $CI->db->where('CLASS_METHOD', $class_method);
        $query_menu = $CI->db->get()->row_array();
        //echo json_encode($query_menu);
        //exit;
        $sub_menu_id = $query_menu['ID'];

        $CI->db->select('*');
        $CI->db->from('user_access_menu');
        $CI->db->where_in('ROLE_ID', $roles);
        $CI->db->where('SUB_MENU_ID', $sub_menu_id);
        $user_access = $CI->db->get()->num_rows();
        //echo json_encode($user_access);
        //exit;

        if ($user_access < 1) {
            redirect('blocked');
        }

        //return $user_access;
    }
}

function check_button($button)
{
    $CI = &get_instance();
    if (!$CI->session->userdata('p2ep')) {
        redirect('login');
    } else {
        $role_id = $CI->session->userdata('p2ep')['role_id'];
        //$sub_menu = $CI->uri->segment(2);
        $roles = array_column($role_id, 'ROLE_ID');
        $class_method = $CI->router->fetch_class() . "/" . $button;
        //echo json_encode($class_method);
        //exit;

        $CI->db->select('*');
        $CI->db->from('user_sub_menu');
        $CI->db->where('CLASS_METHOD', $class_method);
        $query_menu = $CI->db->get()->row_array();
        //echo json_encode($query_menu);
        //exit;
        $sub_menu_id = $query_menu['ID'];

        $CI->db->select('*');
        $CI->db->from('user_access_menu');
        $CI->db->where_in('ROLE_ID', $roles);
        $CI->db->where('SUB_MENU_ID', $sub_menu_id);
        $user_access = $CI->db->get()->num_rows();
        //echo json_encode($user_access);
        //exit;

        return $user_access;
    }
}

function check_session()
{
    $CI = &get_instance();
    if (!$CI->session->userdata('p2ep')) {
        redirect('login');
    }
}

function change_session_image($param, $username)
{
    $CI = &get_instance();
    if (get_session_username() == $username) {
        $session            = $CI->session->userdata('p2ep');
        $session['image']   = $param;
        $CI->session->set_userdata('p2ep', $session);
    }
}

function get_session()
{
    $CI = &get_instance();
    return $CI->session->userdata('p2ep');
}

function get_session_id()
{
    $CI = &get_instance();
    return $CI->session->userdata('p2ep')['id'];
}

function get_session_name()
{
    $CI = &get_instance();
    return $CI->session->userdata('p2ep')['fullname'];
}

function get_session_username()
{
    $CI = &get_instance();
    return $CI->session->userdata('p2ep')['username'];
}

function get_session_image()
{
    $CI = &get_instance();
    return $CI->session->userdata('p2ep')['image'];
}

function get_session_role()
{
    $CI = &get_instance();
    $role = isset($CI->session->userdata('p2ep')['role_id']) ? $CI->session->userdata('p2ep')['role_id'] : '';
    return $role;
}

function get_parent_org($id)
{
    $CI = &get_instance();
    $CI->load->model('org/Org_model');

    $org = $CI->Org_model->getOrgById($id)->row_array();
    return $org['SHORT_ORG'];
}

function get_user($username)
{
    $CI = &get_instance();
    $CI->load->model('user/User_model');

    $org = $CI->User_model->getUserByUsername($username)->row_array();
    return $org['ID'];
}

function apps()
{
    $CI = &get_instance();
    $CI->db->select('NAME, LOGO, LOGO_BIG, BG, ENV, ENV_TEXT');
    $CI->db->from('apps');
    return $CI->db->get()->row_array();
}

function api()
{
    $CI = &get_instance();
    $CI->db->select('DATABASE, SCHEMA, INTEGRASI_TOKEN, INTEGRASI_LOAD');
    $CI->db->from('apps_api');
    return $CI->db->get()->row_array();
}

function lastVersion()
{
    $CI = &get_instance();
    $CI->db->select('*');
    $CI->db->from('apps_ver');
    $CI->db->order_by('CREATED_ON', 'DESC');
    $CI->db->limit(1);
    $query = $CI->db->get();
    return $query->row_array();
}

function cek_rot_f($tahun)
{
    $CI = &get_instance();
    $CI->load->database();

    $CI->db->select('COUNT(*) as count');
    $CI->db->from('rot');
    $CI->db->where('TIPE', 2);
    $CI->db->where('TAHUN', $tahun);
    $query = $CI->db->get();
    $result = $query->row_array();

    return $result;
}

function cek_rob_f($bulan, $tahun)
{
    $CI = &get_instance();
    $CI->load->database();

    $CI->db->select('COUNT(*) as count');
    $CI->db->from('rob');
    $CI->db->where('TIPE', 2);
    $CI->db->where('BLN', $bulan);
    $CI->db->where('TAHUN', $tahun);
    $query = $CI->db->get();
    $result = $query->row_array();

    return $result;
}

function cek_rom_f($week, $bulan, $tahun)
{
    $CI = &get_instance();
    $CI->load->database();

    $CI->db->select('COUNT(*) as count');
    $CI->db->from('rom');
    $CI->db->where('TIPE', 2);
    $CI->db->where('WEEK', $week);
    $CI->db->where('BLN', $bulan);
    $CI->db->where('TAHUN', $tahun);
    $query = $CI->db->get();
    $result = $query->row_array();

    return $result;
}

function formatBytes($bytes, $precision = 2)
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
}

function get_pembangkit($kode)
{
    $CI = &get_instance();
    $CI->load->model('pembangkit/Pembangkit_model');

    $kit = $CI->Pembangkit_model->getPembangkitByKode($kode)->row_array();
    return $kit['NAMA_PEMBANGKIT'];
}
