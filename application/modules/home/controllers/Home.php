<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Home_model');
        $this->load->model('User/User_model');
        $this->load->model('org/Org_model');
    }

    public function index()
    {
        $data['ptitle']     = "Home";
        $data['title']      = "Home";

        //RO
        $data['rot'] = $this->Home_model->getTotalRot();
        $data['rob'] = $this->Home_model->getTotalRob();
        $data['rom'] = $this->Home_model->getTotalRom();
        $data['ro_total'] = $data['rot']['ROT'] + $data['rob']['ROB'] + $data['rom']['ROM'];

        //BIO
        $data['bio_m'] = $this->Home_model->getBioMaster();
        $data['bio_t'] = $this->Home_model->getBioTrans();
        $data['bio_total'] = $data['bio_m']['BIO_M'] + $data['bio_t']['BIO_T'];

        //DISK
        $totalDiskSpace = disk_total_space('/');
        $freeDiskSpace = disk_free_space('/');
        $usedDiskSpace = $totalDiskSpace - $freeDiskSpace;
        $data['totaldisk'] = $totalDiskSpace;
        $data['freedisk'] = $freeDiskSpace;
        $data['useddisk'] = $usedDiskSpace;

        //LAST RO
        $data['last_rot'] = $this->Home_model->getLastRot();
        $data['last_rob'] = $this->Home_model->getLastRob();
        $data['last_rom'] = $this->Home_model->getLastRom();

        //USER
        $data['user'] = $this->Home_model->getTotalUser();

        $this->load->view('home-view', $data);
    }
}
