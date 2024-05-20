<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Kit_fsru extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Kit_fsru_model');
    }

    public function index()
    {
        $data['ptitle'] = "FSRU";
        $data['title']  = "FSRU";

        $this->load->view('kit-fsru-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Kit_fsru_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<div class="text-center">' . $no . '</div>';
            $sub_array[] = $row->FSRU;
            if ($row->IS_ACTIVE == 1) {
                $sub_array[] = '<span class="badge bg-sm bg-success">AKTIF</span>';
            } else if ($row->IS_ACTIVE == 0) {
                $sub_array[] = '<span class="badge bg-sm bg-danger">TIDAK AKTIF</span>';
            }

            $edit = NULL;
            $del = NULL;

            if (check_button('edit') > 0) {
                $edit = '<a href="' . base_url('kit_fsru/edit/') . encrypt_url($row->ID) . '" class="btn btn-warning btn-sm waves-effect"><i class="ion ion-md-color-filter"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('kit_fsru/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('edit') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $edit . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Kit_fsru_model->get_all_data(),
            'recordsFiltered'   => $this->Kit_fsru_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "FSRU";
        $data['title']  = "FSRU";

        $this->form_validation->set_rules('fsru', 'FSRU', 'required', [
            'required' => 'FSRU tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('kit-fsru-add', $data);
        } else {
            cek_csrf();
            $data_kit = array(
                'FSRU'          => $this->input->post('fsru'),
                'IS_ACTIVE'     => 1,
                'CREATED_BY'    => get_session_name(),
                'CREATED_ON'    => date('Y-m-d H:i:s'),
                'CHANGED_BY'    => get_session_name()
            );
            $add_id = $this->Kit_fsru_model->addFsru($data_kit);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>FSRU</strong> dengan <strong>ID #' . $add_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Pembangkit', 'ADD', 'success', $ket);
            redirect('kit_fsru');
        }
    }

    public function edit($id)
    {
        $data['ptitle'] = "FSRU";
        $data['title']  = "FSRU";

        $id = decrypt_url($id);

        $data['fsru']   = $this->Kit_fsru_model->getFsruById($id)->row_array();
        if ($data['fsru'] != NULL) {

            if ($data['fsru']['FSRU'] != $this->input->post('fsru')) {
                $this->form_validation->set_rules('fsru', 'FSRU', 'required|is_unique[pembangkit_fsru.FSRU]', [
                    'required'      => 'FSRU tidak boleh kosong',
                    'is_unique'     => 'FSRU sudah ada'
                ]);
            } else {
                $this->form_validation->set_rules('fsru', 'FSRU', 'required', [
                    'required'      => 'FSRU tidak boleh kosong'
                ]);
            }

            $this->form_validation->set_rules('status', 'Status', 'required', [
                'required'      => 'Status harus dipilih'
            ]);
        }

        if ($this->form_validation->run() == FALSE) {
            if ($data['fsru'] != NULL) {
                $this->load->view('kit-fsru-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $data_kit = array(
                'FSRU'          => $this->input->post('fsru'),
                'IS_ACTIVE'     => $this->input->post('status'),
                'CHANGED_BY'    => get_session_name()
            );

            $this->Kit_fsru_model->editFsru($data_kit, $id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah data <strong>FSRU</strong> dengan <strong>ID #' . $id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Pembangkit', 'UPDATE', 'primary', $ket);
            redirect('kit_fsru');
        }
    }

    public function delete($id)
    {
        $id = decrypt_url($id);

        $data['reg']   = $this->Kit_fsru_model->getFsruById($id)->row_array();

        $delete = $this->Kit_fsru_model->deleteFsru($id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>FSRU</strong> dengan <strong>ID #' . $id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Pembangkit', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('kit_fsru');
    }
}
