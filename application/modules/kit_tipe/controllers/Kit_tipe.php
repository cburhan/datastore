<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Kit_tipe extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Kit_tipe_model');
    }

    public function index()
    {
        $data['ptitle'] = "Tipe Pembangkit";
        $data['title']  = "Tipe Pembangkit";

        $this->load->view('kit-tipe-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Kit_tipe_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<div class="text-center">' . $no . '</div>';
            $sub_array[] = $row->TIPE;
            if ($row->IS_ACTIVE == 1) {
                $sub_array[] = '<span class="badge bg-sm bg-success">AKTIF</span>';
            } else if ($row->IS_ACTIVE == 0) {
                $sub_array[] = '<span class="badge bg-sm bg-danger">TIDAK AKTIF</span>';
            }

            $edit = NULL;
            $del = NULL;

            if (check_button('edit') > 0) {
                $edit = '<a href="' . base_url('kit_tipe/edit/') . encrypt_url($row->ID) . '" class="btn btn-warning btn-sm waves-effect"><i class="ion ion-md-color-filter"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('kit_tipe/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('edit') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $edit . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Kit_tipe_model->get_all_data(),
            'recordsFiltered'   => $this->Kit_tipe_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "Tipe Pembangkit";
        $data['title']  = "Tipe Pembangkit";

        $this->form_validation->set_rules('tipe', 'Tipe', 'required', [
            'required' => 'Tipe tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('kit-tipe-add', $data);
        } else {
            cek_csrf();
            $data_kit = array(
                'TIPE'          => $this->input->post('tipe'),
                'IS_ACTIVE'     => 1,
                'CREATED_BY'    => get_session_name(),
                'CREATED_ON'    => date('Y-m-d H:i:s'),
                'CHANGED_BY'    => get_session_name()
            );
            $add_id = $this->Kit_tipe_model->addTipe($data_kit);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>Tipe Pembangkit</strong> dengan <strong>ID #' . $add_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Pembangkit', 'ADD', 'success', $ket);
            redirect('kit_tipe');
        }
    }

    public function edit($id)
    {
        $data['ptitle'] = "Tipe Pembangkit";
        $data['title']  = "Tipe Pembangkit";

        $id = decrypt_url($id);

        $data['tipe']   = $this->Kit_tipe_model->getTipeById($id)->row_array();
        if ($data['tipe'] != NULL) {

            if ($data['tipe']['TIPE'] != $this->input->post('tipe')) {
                $this->form_validation->set_rules('tipe', 'Tipe', 'required|is_unique[pembangkit_tipe.TIPE]', [
                    'required'      => 'Tipe tidak boleh kosong',
                    'is_unique'     => 'Tipe sudah ada'
                ]);
            } else {
                $this->form_validation->set_rules('tipe', 'Tipe', 'required', [
                    'required'      => 'Tipe tidak boleh kosong'
                ]);
            }

            $this->form_validation->set_rules('status', 'Status', 'required', [
                'required'      => 'Status harus dipilih'
            ]);
        }

        if ($this->form_validation->run() == FALSE) {
            if ($data['tipe'] != NULL) {
                $this->load->view('kit-tipe-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $data_kit = array(
                'TIPE'          => $this->input->post('tipe'),
                'IS_ACTIVE'     => $this->input->post('status'),
                'CHANGED_BY'    => get_session_name()
            );

            $this->Kit_tipe_model->editTipe($data_kit, $id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah data <strong>Tipe Pembangkit</strong> dengan <strong>ID #' . $id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Pembangkit', 'UPDATE', 'primary', $ket);
            redirect('kit_tipe');
        }
    }

    public function delete($id)
    {
        $id = decrypt_url($id);

        $data['tipe']   = $this->Kit_tipe_model->getTipeById($id)->row_array();

        $delete = $this->Kit_tipe_model->deleteTipe($id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>Tipe Pembangkit</strong> dengan <strong>ID #' . $id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Pembangkit', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('kit_tipe');
    }
}
