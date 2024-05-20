<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Kit_bio_publish extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Kit_bio_publish_model');
        $this->load->model('Kit_bio_publish_detail_model');
    }

    public function index()
    {
        $data['ptitle'] = "Pembangkit";
        $data['title']  = "Publish Bio Historical";

        $this->load->view('kit-bio-publish-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Kit_bio_publish_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<div class="text-center">' . $no . '</div>';
            $sub_array[] = $row->FILE;
            $sub_array[] = $row->PUBLISH_BY;
            $tgl_out = date("Y-m-d", strtotime($row->PUBLISH_ON));
            $jam_out = date("H:i:s", strtotime($row->PUBLISH_ON));
            $sub_array[] = tgl_indo($tgl_out) . ' ' . $jam_out;

            $detail = NULL;

            if (check_button('detail') > 0) {
                $detail = '<a href="' . base_url('kit_bio_publish/detail/') . encrypt_url($row->ID) . '" class="btn btn-info btn-sm waves-effect"><i class="ion ion-md-eye"></i></a>';
            }
            if (check_button('detail') > 0) {
                $sub_array[] = '<div class="text-center">' . $detail . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Kit_bio_publish_model->get_all_data(),
            'recordsFiltered'   => $this->Kit_bio_publish_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function detail($id)
    {
        $data['ptitle'] = "Pembangkit";
        $data['title']  = "Publish Bio Historical";

        $id_publish     = decrypt_url($id);
        $data['pub']    = $this->Kit_bio_publish_model->getPublishById($id_publish)->row_array();
        $data['detail_id'] = $id;

        $this->load->view('kit-bio-publish-detail-view', $data);
    }

    public function get_data_detail($id)
    {
        $id = decrypt_url($id);
        $fetch_data = $this->Kit_bio_publish_detail_model->make_datatables($id);
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<div class="text-center"><smalld>' . $no . '</smalld></div>';
            $sub_array[] = '<smalld>' . $row->KODE_PEMBANGKIT . '</smalld>';
            $sub_array[] = '<smalld>' . $row->NAMA_PEMBANGKIT . '</smalld>';
            $sub_array[] = '<smalld>' . $row->TAHUN . '</smalld>';
            $sub_array[] = '<smalld>' . $row->TARGET_PEMAKAIAN_BIO . '</smalld>';
            $sub_array[] = '<smalld>' . $row->INTENSITAS_EMISI_BIO . '</smalld>';
            $sub_array[] = '<smalld>' . $row->KAPASITAS_MAX_PENYIMPANAN_BIO . '</smalld>';
            $sub_array[] = '<smalld>' . $row->KAPASITAS_MAX_BONGKAR_HARIAN_BIO . ' MW</smalld>';

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Kit_bio_publish_detail_model->get_all_data($id),
            'recordsFiltered'   => $this->Kit_bio_publish_detail_model->get_filtered_data($id),
            'data'              => $data
        );

        echo json_encode($output);
    }
}
