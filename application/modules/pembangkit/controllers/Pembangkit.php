<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Pembangkit extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Pembangkit_model');
    }

    public function index()
    {
        $data['ptitle'] = "Master";
        $data['title']  = "Pembangkit";

        $this->load->view('pembangkit-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Pembangkit_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<div class="text-center">' . $no . '</div>';
            $sub_array[] = $row->KODE_PEMBANGKIT;
            $sub_array[] = $row->NAMA_PEMBANGKIT;
            $edit = NULL;
            $del = NULL;

            if (check_button('edit') > 0) {
                $edit = '<a href="' . base_url('pembangkit/edit/') . encrypt_url($row->ID) . '" class="btn btn-warning btn-sm waves-effect"><i class="ion ion-md-color-filter"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('pembangkit/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('edit') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $edit . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Pembangkit_model->get_all_data(),
            'recordsFiltered'   => $this->Pembangkit_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "Master";
        $data['title']  = "Pembangkit";

        $this->form_validation->set_rules('kode', 'Kode', 'required|numeric|max_length[6]', [
            'required' => 'Kode Pembangkit tidak boleh kosong',
            'numeric'  => 'Kode Pembangkit harus berupa angka',
            'max_length'  => 'Kode Pembangkit maksimal 6 karakter',
        ]);

        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required'      => 'Nama Pembangkit tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pembangkit-add', $data);
        } else {
            cek_csrf();
            $data_menu = array(
                'KODE_PEMBANGKIT'   => $this->input->post('kode'),
                'NAMA_PEMBANGKIT'   => $this->input->post('nama'),
                'CREATED_BY'        => get_session_name(),
                'CREATED_ON'        => date('Y-m-d H:i:s'),
                'CHANGED_BY'        => get_session_name()
            );
            $add_id = $this->Pembangkit_model->addPembangkit($data_menu);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>Menu</strong> dengan <strong>ID #' . $add_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Master', 'ADD', 'success', $ket);
            redirect('pembangkit');
        }
    }

    public function edit($pembangkit_id)
    {
        $data['ptitle'] = "Master";
        $data['title']  = "Pembangkit";

        $pembangkit_id = decrypt_url($pembangkit_id);

        $data['kit']   = $this->Pembangkit_model->getPembangkitById($pembangkit_id)->row_array();
        if ($data['kit'] != NULL) {

            if ($data['kit']['KODE_PEMBANGKIT'] != $this->input->post('kode')) {
                $this->form_validation->set_rules('kode', 'Kode', 'required|is_unique[pembangkit.KODE_PEMBANGKIT]', [
                    'required'      => 'Kode Pembangkit tidak boleh kosong',
                    'is_unique'     => 'Kode Pembangkit sudah ada'
                ]);
            } else {
                $this->form_validation->set_rules('kode', 'Kode', 'required', [
                    'required'      => 'Kode Pembangkit tidak boleh kosong'
                ]);
            }

            if ($data['kit']['NAMA_PEMBANGKIT'] != $this->input->post('nama')) {
                $this->form_validation->set_rules('nama', 'Nama', 'required|is_unique[pembangkit.NAMA_PEMBANGKIT]', [
                    'required'      => 'Nama Pembangkit tidak boleh kosong',
                    'is_unique'     => 'Nama Pembangkit sudah ada'
                ]);
            } else {
                $this->form_validation->set_rules('nama', 'Nama', 'required', [
                    'required'      => 'Nama Pembangkit tidak boleh kosong'
                ]);
            }
        }

        if ($this->form_validation->run() == FALSE) {
            if ($data['kit'] != NULL) {
                $this->load->view('pembangkit-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $data_kit = array(
                'KODE_PEMBANGKIT'   => $this->input->post('kode'),
                'NAMA_PEMBANGKIT'   => $this->input->post('nama'),
                'CHANGED_BY'        => get_session_name()
            );

            $this->Pembangkit_model->editPembangkit($data_kit, $pembangkit_id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah data <strong>Pembangkit</strong> dengan <strong>ID #' . $pembangkit_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Master', 'UPDATE', 'primary', $ket);
            redirect('pembangkit');
        }
    }

    public function delete($pembangkit_id)
    {
        $pembangkit_id = decrypt_url($pembangkit_id);

        $data['kit']   = $this->Pembangkit_model->getPembangkitById($pembangkit_id)->row_array();

        $delete = $this->Pembangkit_model->deletePembangkit($pembangkit_id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>Pembangkit</strong> dengan <strong>ID #' . $pembangkit_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Master', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('pembangkit');
    }
}
