<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Bio_trans extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('BioTrans_model');
    }

    public function index()
    {
        $data['ptitle'] = "Biomassa";
        $data['title']  = "Transaksi Bio";

        $this->load->view('bio-trans-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->BioTrans_model->make_datatables();
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
            $sub_array[] = $row->BULAN;
            $sub_array[] = $row->TAHUN;
            $sub_array[] = $row->CREATED_BY;
            $tgl_out = date("Y-m-d", strtotime($row->CREATED_ON));
            $jam_out = date("H:i:s", strtotime($row->CREATED_ON));
            $sub_array[] = tgl_indo($tgl_out) . ' ' . $jam_out;
            $detail = NULL;
            $del = NULL;

            if (check_button('detail') > 0) {
                $detail = '<a href="' . base_url('bio_trans/detail/') . encrypt_url($row->ID) . '" class="btn btn-info btn-sm waves-effect"><i class="ion ion-md-eye"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('bio_trans/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('detail') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $detail . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->BioTrans_model->get_all_data(),
            'recordsFiltered'   => $this->BioTrans_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "Biomassa";
        $data['title']  = "Transaksi Bio";

        $this->form_validation->set_rules('bulan', 'bulan', 'required', [
            'required' => 'Bulan harus dipilih'
        ]);

        $this->form_validation->set_rules('tahun', 'Tahun', 'required', [
            'required' => 'Tahun harus dipilih'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('bio-trans-add', $data);
        } else {
            cek_csrf();
            $time = date('Y-m-d H:i:s');
            $time_name = date('YmdHis', strtotime($time));
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $file_name = $time_name . '_BIO_TRANS_' . $bulan . '_' . $tahun;
            $data_bio = array(
                'BULAN'         => bulan($bulan),
                'BLN'           => $bulan,
                'TAHUN'         => $tahun,
                'CREATED_BY'    => get_session_name(),
                'CREATED_ON'    => $time
            );
            $add_id = $this->BioTrans_model->addBioTrans($data_bio);
            $this->do_upload($add_id, $file_name);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data Transaksi Biomassa berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>Transaksi Biomassa</strong> periode <strong>' . $data_bio['BULAN'] . ' ' . $data_bio['TAHUN'] . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Biomassa', 'ADD', 'success', $ket);
            redirect('bio_trans');
        }
    }

    private function do_upload($id, $file_name)
    {
        $upload_file = $_FILES['bio']['name'];
        if ($upload_file) {
            $upload_path                = './public/upload_file/bio_trans';
            $config['upload_path']      = $upload_path;
            $config['allowed_types']    = 'xls|xlsx';
            $config['remove_spaces']    = true;
            $config['file_name']        = $file_name;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('bio')) {
                $file = $this->upload->data('file_name');
                $data_bio = array(
                    'FILE'          => $file
                );
                $this->BioTrans_model->editBioTrans($data_bio, $id);
            } else {
                $error = $this->upload->display_errors();
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Gagal!</strong> ' . strip_tags($error) . '
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                $this->BioTrans_model->deleteBioTrans($id);
                redirect('bio_trans');
            }
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> File kosong.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $this->BioTrans_model->deleteBioTrans($id);
            redirect('bio_trans');
        }
    }

    public function detail($id)
    {
        $data['ptitle'] = "Biomassa";
        $data['title']  = "Transaksi Bio";

        $id = decrypt_url($id);

        $bio = $this->BioTrans_model->getBioTransById($id);
        if ($bio != NULL) {
            $path = 'public/upload_file/bio_trans/' . $bio['FILE'];

            $this->load->library('Excel');
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($path);
            $data['sheet'] = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data['file'] = $bio;

            $this->load->view('bio-trans-detail', $data);
        } else {
            $this->load->view('myerror/error404', $data);
        }
    }

    public function delete($id)
    {
        $id = decrypt_url($id);

        $bio = $this->BioTrans_model->getBioTransById($id);
        $delete = $this->BioTrans_model->deleteBioTrans($id);
        if ($delete) {
            unlink('public/upload_file/bio_trans/' . $bio['FILE']);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data Transaksi Biomassa berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>Transaksi Biomassa</strong> data <strong>' . $bio['TIPE_TEXT'] . '</strong> dengan nama file <strong>' . $bio['FILE'] . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Biomassa', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data Transaksi Biomassa masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('bio_trans');
    }
}
