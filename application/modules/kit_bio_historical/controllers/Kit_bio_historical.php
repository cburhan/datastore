<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Kit_bio_historical extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Kit_bio_historical_model');
        $this->load->model('Pembangkit/Pembangkit_model');
    }

    public function index()
    {
        $data['ptitle'] = "Pembangkit";
        $data['title']  = "Bio Historical";

        $this->load->view('kit-bio-historical-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Kit_bio_historical_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<div class="text-center"><smalls>' . $no . '</smalls></div>';
            $sub_array[] = '<smalls>' . $row->TAHUN . '</smalls>';
            $sub_array[] = '<smalls>' . $row->KODE_PEMBANGKIT . '</smalls>';
            $sub_array[] = '<smalls>' . $row->NAMA_PEMBANGKIT . '</smalls>';
            $sub_array[] = '<smalls>' . $row->TARGET_PEMAKAIAN_BIO . '</smalls>';
            $sub_array[] = '<smalls>' . $row->INTENSITAS_EMISI_BIO . '</smalls>';
            $sub_array[] = '<smalls>' . $row->KAPASITAS_MAX_PENYIMPANAN_BIO . '</smalls>';
            $sub_array[] = '<smalls>' . $row->KAPASITAS_MAX_BONGKAR_HARIAN_BIO . '</smalls>';

            $edit = NULL;
            $del = NULL;

            if (check_button('edit') > 0) {
                $edit = '<a href="' . base_url('kit_bio_historical/edit/') . encrypt_url($row->ID) . '" class="btn btn-warning btn-sm waves-effect"><smalls><i class="ion ion-md-color-filter"></i></smalls></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('kit_bio_historical/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><smalls><i class="ion ion-md-trash"></i></smalls></a>';
            }
            if (check_button('edit') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $edit . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Kit_bio_historical_model->get_all_data(),
            'recordsFiltered'   => $this->Kit_bio_historical_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "Pembangkit";
        $data['title']  = "Bio Historical";

        $data['kit']    = $this->Kit_bio_historical_model->getPembangkitBio()->result_array();

        $this->form_validation->set_rules('tahun', 'Tahun', 'required', [
            'required' => 'Tahun harus dipilih'
        ]);

        $this->form_validation->set_rules('kit', 'Pembangkit', 'required', [
            'required' => 'Pembangkit harus dipilih'
        ]);

        $this->form_validation->set_rules('target', 'Target', 'required|numeric', [
            'required' => 'Target Pemakaian tidak boleh kosong',
            'numeric'   => 'Target Pemakaian hanya dapat berupa angka'
        ]);

        $this->form_validation->set_rules('inten', 'Intensitas', 'required|numeric', [
            'required' => 'Intensitas Emisi tidak boleh kosong',
            'numeric'   => 'Intensitas Emisi hanya dapat berupa angka'
        ]);

        $this->form_validation->set_rules('max_simpan', 'Max Simpan', 'required|numeric', [
            'required' => 'Kapasitas Max Penyimpanan tidak boleh kosong',
            'numeric'   => 'Kapasitas Max Penyimpanan hanya dapat berupa angka'
        ]);

        $this->form_validation->set_rules('max_bongkar', 'Max Simpan', 'required|numeric', [
            'required'  => 'Kapasitas Max Bongkar Harian tidak boleh kosong',
            'numeric'   => 'Kapasitas Max Bongkar Harian hanya dapat berupa angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('kit-bio-historical-add', $data);
        } else {
            cek_csrf();
            $kit            = $this->Pembangkit_model->getPembangkitById($this->input->post('kit'))->row_array();
            $cek_bio        = $this->Kit_bio_historical_model->getBioHistoricalExist($this->input->post('tahun'), $this->input->post('kit'))->row_array();

            if ($cek_bio != NULL) {
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data Bio Historical Pembangkit ' . $kit['NAMA_PEMBANGKIT'] . ' di tahun ' . $this->input->post('tahun') . ' sudah ada
                        </div>';
                $this->session->set_flashdata('flash', $flash);
                redirect('kit_bio_historical');
            }

            $data_kit = array(
                'PEMBANGKIT_ID'                     => $this->input->post('kit'),
                'KODE_PEMBANGKIT'                   => $kit['KODE_PEMBANGKIT'],
                'NAMA_PEMBANGKIT'                   => $kit['NAMA_PEMBANGKIT'],
                'TAHUN'                             => $this->input->post('tahun'),
                'TARGET_PEMAKAIAN_BIO'              => $this->input->post('target'),
                'INTENSITAS_EMISI_BIO'              => $this->input->post('inten'),
                'KAPASITAS_MAX_PENYIMPANAN_BIO'     => $this->input->post('max_simpan'),
                'KAPASITAS_MAX_BONGKAR_HARIAN_BIO'  => $this->input->post('max_bongkar'),
                'CREATED_BY'                        => get_session_name(),
                'CREATED_ON'                        => date('Y-m-d H:i:s'),
                'CHANGED_BY'                        => get_session_name()
            );
            $add_id = $this->Kit_bio_historical_model->addBioHistorical($data_kit);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>BIO Historical</strong> dengan <strong>ID #' . $add_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Pembangkit', 'ADD', 'success', $ket);
            redirect('kit_bio_historical');
        }
    }

    public function edit($id)
    {
        $data['ptitle'] = "Pembangkit";
        $data['title']  = "Bio Historical";

        $id = decrypt_url($id);

        $data['bio']   = $this->Kit_bio_historical_model->getBioHistoricalById($id)->row_array();


        $this->form_validation->set_rules('target', 'Target', 'required|numeric', [
            'required' => 'Target Pemakaian tidak boleh kosong',
            'numeric'   => 'Target Pemakaian hanya dapat berupa angka'
        ]);

        $this->form_validation->set_rules('inten', 'Intensitas', 'required|numeric', [
            'required' => 'Intensitas Emisi tidak boleh kosong',
            'numeric'   => 'Intensitas Emisi hanya dapat berupa angka'
        ]);

        $this->form_validation->set_rules('max_simpan', 'Max Simpan', 'required|numeric', [
            'required' => 'Kapasitas Max Penyimpanan tidak boleh kosong',
            'numeric'   => 'Kapasitas Max Penyimpanan hanya dapat berupa angka'
        ]);

        $this->form_validation->set_rules('max_bongkar', 'Max Simpan', 'required|numeric', [
            'required'  => 'Kapasitas Max Bongkar Harian tidak boleh kosong',
            'numeric'   => 'Kapasitas Max Bongkar Harian hanya dapat berupa angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            if ($data['bio'] != NULL) {
                $this->load->view('kit-bio-historical-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $data_kit = array(
                'TARGET_PEMAKAIAN_BIO'              => $this->input->post('target'),
                'INTENSITAS_EMISI_BIO'              => $this->input->post('inten'),
                'KAPASITAS_MAX_PENYIMPANAN_BIO'     => $this->input->post('max_simpan'),
                'KAPASITAS_MAX_BONGKAR_HARIAN_BIO'  => $this->input->post('max_bongkar'),
                'CHANGED_BY'                        => get_session_name()
            );

            $this->Kit_bio_historical_model->editBioHistorical($data_kit, $id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah data <strong>BIO Historical</strong> dengan <strong>ID #' . $id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Pembangkit', 'UPDATE', 'primary', $ket);
            redirect('kit_bio_historical');
        }
    }

    public function delete($id)
    {
        $id = decrypt_url($id);

        $delete = $this->Kit_bio_historical_model->deleteBioHistorical($id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>BIO Historical</strong> dengan <strong>ID #' . $id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Pembangkit', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('kit_bio_historical');
    }

    public function publish()
    {
        $bio        = $this->Kit_bio_historical_model->getBioHistorical()->result_array();
        $publish_on = date('Y-m-d H:i:s');

        $token      = get_token();
        $db         = api()['DATABASE'];
        $schema     = api()['SCHEMA'];
        $table      = 'DATASTORE_INTEGRASI_BIOHISTORICAL';
        $table_name = $db . '.' . $schema . '.' . $table;

        if ($token) {
            foreach ($bio as $d) {
                $data[] = [
                    'ID'                                => $d['ID'],
                    'KODE_PEMBANGKIT'                   => $d['KODE_PEMBANGKIT'],
                    'NAMA_PEMBANGKIT'                   => $d['NAMA_PEMBANGKIT'],
                    'TAHUN'                             => $d['TAHUN'],
                    'TARGET_PEMAKAIAN_BIO'              => $d['TARGET_PEMAKAIAN_BIO'],
                    'INTENSITAS_EMISI_BIO'              => $d['INTENSITAS_EMISI_BIO'],
                    'KAPASITAS_MAX_PENYIMPANAN_BIO'     => $d['KAPASITAS_MAX_PENYIMPANAN_BIO'],
                    'KAPASITAS_MAX_BONGKAR_HARIAN_BIO'  => $d['KAPASITAS_MAX_BONGKAR_HARIAN_BIO'],
                    'CREATED_BY'                        => $d['CREATED_BY'],
                    'CREATED_ON'                        => $d['CREATED_ON'],
                    'CHANGED_BY'                        => $d['CHANGED_BY'],
                    'CHANGED_ON'                        => $d['CHANGED_ON'],
                    'PUBLISH_ON'                        => $publish_on,
                    'SOURCE'                            => 'DATASTORE_INTEGRASI_BIOHISTORICAL'
                ];
            }
            insert_data($token, $table_name, $data);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Sukses!</strong> Data berhasil dipublish di Snowflake!
            </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mempublish data <strong>Bio Historical</strong> ke <strong>Snowflake</strong>';
            activity_log(get_session_id(), get_session_name(), 'Pembangkit', 'PUBLISH', 'success', $ket);
            redirect('kit_bio_historical');
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Token tidak berhasil digenerate.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            redirect('kit_bio_historical');
        }
    }
}
