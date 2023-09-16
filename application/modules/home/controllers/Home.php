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

        //DISK
        $totalDiskSpace = disk_total_space('/');
        $freeDiskSpace = disk_free_space('/');
        $usedDiskSpace = $totalDiskSpace - $freeDiskSpace;
        $data['totaldisk'] = $totalDiskSpace;
        $data['freedisk'] = $freeDiskSpace;
        $data['useddisk'] = $usedDiskSpace;

        $this->load->view('home-view', $data);
    }
}
