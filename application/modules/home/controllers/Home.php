<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

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

        //BIO
        $data['bio_m'] = $this->Home_model->getBioMaster();
        $data['bio_t'] = $this->Home_model->getBioTrans();
        $data['bio_total'] = $data['bio_m']['BIO_M'] + $data['bio_t']['BIO_T'];

        //GAS PIPA
        $data['gpm'] = $this->Home_model->getGaspipaMaster();
        $data['gpt'] = $this->Home_model->getGaspipaTrans();
        $data['gp_total'] = $data['gpm']['GP_M'] + $data['gpt']['GP_T'];

        //LNG
        $data['lngm'] = $this->Home_model->getLngMaster();
        $data['lngt'] = $this->Home_model->getLngTrans();
        $data['lng_total'] = $data['lngm']['LNG_M'] + $data['lngt']['LNG_T'];

        //BBM
        $data['bbmm'] = $this->Home_model->getBbmMaster();
        $data['bbmt'] = $this->Home_model->getBbmTrans();
        $data['bbm_total'] = $data['bbmm']['BBM_M'] + $data['bbmt']['BBM_T'];

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
