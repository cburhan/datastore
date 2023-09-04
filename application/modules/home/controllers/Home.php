<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('User/User_model');
        $this->load->model('org/Org_model');
    }

    public function index()
    {
        $data['ptitle']     = "Home";
        $data['title']      = "Home";
        $this->load->view('home-view', $data);
    }
}
