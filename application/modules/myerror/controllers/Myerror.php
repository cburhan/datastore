<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Myerror extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_session();
    }

    public function index()
    {
        $data['ptitle'] = "404";
        $data['title']  = "404";
        $this->load->view('error404', $data);
    }

    public function error404()
    {
        $data['ptitle'] = "404";
        $data['title']  = "404";
        $this->load->view('error404', $data);
    }

    public function blocked()
    {
        $data['ptitle'] = "403";
        $data['title']  = "403";

        $this->load->view('blocked', $data);
    }
}
