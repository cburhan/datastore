<?php

function get_csrf_token()
{
    $ci = get_instance();
    if (!$ci->session->csrf_token) {
        $ci->session->csrf_token = hash('sha1', time());
    }
    return $ci->session->csrf_token;
}

function get_csrf_name()
{
    return "token";
}

function cek_csrf()
{
    $ci = get_instance();
    if ($ci->input->post('token') != $ci->session->csrf_token || !$ci->input->post('token') || !$ci->session->csrf_token) {
        $ci->session->unset_userdata('csrf_token');
        $ci->output->set_status_header(403);
        show_error('This action is not allowed');
        return false;
    }
}

function csrf()
{
    return "<input type='hidden' name='" . get_csrf_name() . "' value='" . get_csrf_token() . "'/>";
}
