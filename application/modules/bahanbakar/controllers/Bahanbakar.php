<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Bahanbakar extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Bahanbakar_model');
    }

    public function index()
    {
        $data['ptitle'] = "Master";
        $data['title']  = "Bahan Bakar";

        $this->load->view('bahanbakar-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Bahanbakar_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<div class="text-center">' . $no . '</div>';
            $sub_array[] = $row->KODE_BAHAN_BAKAR;
            $sub_array[] = $row->NAMA_BAHAN_BAKAR;
            $edit = NULL;
            $del = NULL;

            if (check_button('edit') > 0) {
                $edit = '<a href="' . base_url('bahanbakar/edit/') . encrypt_url($row->ID) . '" class="btn btn-warning btn-sm waves-effect"><i class="ion ion-md-color-filter"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('bahanbakar/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('edit') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $edit . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Bahanbakar_model->get_all_data(),
            'recordsFiltered'   => $this->Bahanbakar_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "Master";
        $data['title']  = "Bahan Bakar";

        $this->form_validation->set_rules('kode', 'Kode', 'required|numeric|max_length[2]', [
            'required' => 'Kode Bahan Bakar tidak boleh kosong',
            'numeric'  => 'Kode Bahan Bakar harus berupa angka',
            'max_length'  => 'Kode Bahan Bakar maksimal 2 karakter',
        ]);

        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required'      => 'Nama Bahan Bakar tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('bahanbakar-add', $data);
        } else {
            cek_csrf();
            $data_menu = array(
                'KODE_BAHAN_BAKAR'   => $this->input->post('kode'),
                'NAMA_BAHAN_BAKAR'   => $this->input->post('nama'),
                'CREATED_BY'        => get_session_name(),
                'CREATED_ON'        => date('Y-m-d H:i:s'),
                'CHANGED_BY'        => get_session_name()
            );
            $add_id = $this->Bahanbakar_model->addBahanBakar($data_menu);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>Menu</strong> dengan <strong>ID #' . $add_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Master', 'ADD', 'success', $ket);
            redirect('bahanbakar');
        }
    }

    public function edit($bahanbakar_id)
    {
        $data['ptitle'] = "Master";
        $data['title']  = "Bahan Bakar";

        $bahanbakar_id = decrypt_url($bahanbakar_id);

        $data['kit']   = $this->Bahanbakar_model->getBahanBakarById($bahanbakar_id)->row_array();
        if ($data['kit'] != NULL) {

            if ($data['kit']['KODE_BAHAN_BAKAR'] != $this->input->post('kode')) {
                $this->form_validation->set_rules('kode', 'Kode', 'required|is_unique[bahan_bakar.KODE_BAHAN_BAKAR]', [
                    'required'      => 'Kode Bahan Bakar tidak boleh kosong',
                    'is_unique'     => 'Kode Bahan Bakar sudah ada'
                ]);
            } else {
                $this->form_validation->set_rules('kode', 'Kode', 'required', [
                    'required'      => 'Kode Bahan Bakar tidak boleh kosong'
                ]);
            }

            if ($data['kit']['NAMA_BAHAN_BAKAR'] != $this->input->post('nama')) {
                $this->form_validation->set_rules('nama', 'Nama', 'required|is_unique[bahan_bakar.NAMA_BAHAN_BAKAR]', [
                    'required'      => 'Nama Bahan Bakar tidak boleh kosong',
                    'is_unique'     => 'Nama Bahan Bakar sudah ada'
                ]);
            } else {
                $this->form_validation->set_rules('nama', 'Nama', 'required', [
                    'required'      => 'Nama Bahan Bakar tidak boleh kosong'
                ]);
            }
        }

        if ($this->form_validation->run() == FALSE) {
            if ($data['kit'] != NULL) {
                $this->load->view('bahanbakar-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $data_kit = array(
                'KODE_BAHAN_BAKAR'   => $this->input->post('kode'),
                'NAMA_BAHAN_BAKAR'   => $this->input->post('nama'),
                'CHANGED_BY'        => get_session_name()
            );

            $this->Bahanbakar_model->editBahanBakart($data_kit, $bahanbakar_id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah data <strong>Bahan Bakar</strong> dengan <strong>ID #' . $bahanbakar_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Master', 'UPDATE', 'primary', $ket);
            redirect('bahanbakar');
        }
    }

    public function delete($bahanbakar_id)
    {
        $bahanbakar_id = decrypt_url($bahanbakar_id);

        $data['kit']   = $this->Bahanbakar_model->getBahanBakarById($bahanbakar_id)->row_array();

        $delete = $this->Bahanbakar_model->deleteBahanBakar($bahanbakar_id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>Bahan Bakar</strong> dengan <strong>ID #' . $bahanbakar_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Master', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('bahanbakar');
    }
}
