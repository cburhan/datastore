<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Notif extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Notif_model');
    }

    public function index()
    {
        $data['ptitle'] = "Notif";
        $data['title']  = "Notif";

        $this->load->view('notif-view', $data);
    }

    public function get_data()
    {
        $user_id = get_session_id();
        $fetch_data = $this->Notif_model->make_datatables($user_id);
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<div class="text-center"><small>' . $no . '<small></div>';
            $sub_array[] = '<small>' . $row->FROM . '</small>';
            $sub_array[] = '<a href="' . base_url('notif/readThenRedirect/') . encrypt_url($row->ID) . '"><small>' . $row->SUBJECT . '</small></a>';
            $sub_array[] = '<small>' . $row->MESSAGE . '</small>';
            if ($row->STATUS == 'READ') {
                $sub_array[] = '<span class="badge bg-sm bg-success">' . $row->STATUS . '</span>';
            } else if ($row->STATUS == 'UNREAD') {
                $sub_array[] = '<span class="badge bg-sm bg-danger">' . $row->STATUS . '</span>';
            }
            $tgl = date("Y-m-d", strtotime($row->CREATED_ON));
            $jam = date("H:i:s", strtotime($row->CREATED_ON));
            $sub_array[] = '<small>' . tgl_indo($tgl) . ' ' . $jam . '<br>' . hitung_mundur($row->CREATED_ON) . '</small>';

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Notif_model->get_all_data($user_id),
            'recordsFiltered'   => $this->Notif_model->get_filtered_data($user_id),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function readThenRedirect($id)
    {
        $id      = decrypt_url($id);
        $notif   = $this->Notif_model->getNotifById($id)->row_array();

        $data = array('STATUS' => "READ");
        $this->Notif_model->editNotif($data, $id);

        redirect(base_url() . '' . $notif['URL']);
    }
}
