<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Bb_trans extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('BbTrans_model');
    }

    public function index()
    {
        $data['ptitle'] = "Batubara";
        $data['title']  = "Transaksi Batubara";

        $this->load->view('bb-trans-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->BbTrans_model->make_datatables();
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
            $sub_array[] = $row->BULAN . ' ' . $row->TAHUN;
            $sub_array[] = '<span class="badge bg-sm bg-' . $row->MODEL_COLOR . '">' . $row->MODEL_TEXT . '</span>';
            $detail = NULL;
            $del = NULL;

            if (check_button('detail') > 0) {
                $detail = '<a href="' . base_url('bb_trans/detail/') . encrypt_url($row->ID) . '" class="btn btn-info btn-sm waves-effect"><i class="ion ion-md-eye"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('bb_trans/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('detail') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $detail . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->BbTrans_model->get_all_data(),
            'recordsFiltered'   => $this->BbTrans_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "Batubara";
        $data['title']  = "Transaksi Batubara";

        $this->form_validation->set_rules('bulan', 'bulan', 'required', [
            'required' => 'Bulan harus dipilih'
        ]);

        $this->form_validation->set_rules('tahun', 'Tahun', 'required', [
            'required' => 'Tahun harus dipilih'
        ]);

        $this->form_validation->set_rules('model', 'Model', 'required', [
            'required' => 'Model harus dipilih'
        ]);

        $model = $this->input->post('model');
        if ($model == 1) {
            $model_text = 'GCV FORECAST';
            $model_color = 'warning';
        } else if ($model == 2) {
            $model_text = 'ALOKASI';
            $model_color = 'primary';
        } else if ($model == 3) {
            $model_text = 'PENJADWALAN';
            $model_color = 'info';
        } else if ($model == 4) {
            $model_text = 'LEAD TIME';
            $model_color = 'success';
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('bb-trans-add', $data);
        } else {
            cek_csrf();
            $time = date('Y-m-d H:i:s');
            $time_name = date('YmdHis', strtotime($time));
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            if ($model == 1) {
                $file_name = $time_name . '_P2EP_BBO_ML_KUALITAS_BATUBARA_' . $bulan . '_' . $tahun;
            } else if ($model == 2) {
                $file_name = $time_name . '_P2EP_BBO_ALOKASI_' . $bulan . '_' . $tahun;
            } else if ($model == 3) {
                $file_name = $time_name . '_P2EP_BBO_PENJADWALAN_' . $bulan . '_' . $tahun;
            } else if ($model == 4) {
                $file_name = $time_name . '_P2EP_BBO_LEADTIME_' . $bulan . '_' . $tahun;
            }
            $data_bio = array(
                'BULAN'         => bulan($bulan),
                'BLN'           => $bulan,
                'TAHUN'         => $tahun,
                'MODEL'         => $model,
                'MODEL_COLOR'   => $model_color,
                'MODEL_TEXT'    => $model_text,
                'CREATED_BY'    => get_session_name(),
                'CREATED_ON'    => $time
            );
            $add_id = $this->BbTrans_model->addBbTrans($data_bio);
            $this->do_upload($add_id, $file_name);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data Transaksi Batubara berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>Transaksi Batubara</strong> periode <strong>' . $data_bio['BULAN'] . ' ' . $data_bio['TAHUN'] . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Batubara', 'ADD', 'success', $ket);

            $subject = 'Data Batubara Transaksi ' . $data_bio['MODEL_TEXT'] . ' ' . $data_bio['BULAN'] . ' ' . $data_bio['TAHUN'];
            $data_email = array(
                "modul"     => "BATUBARA",
                "modul_id"  => $add_id,
                "model"     => $data_bio['MODEL_TEXT'],
                "bulan"     => $data_bio['BULAN'],
                "tahun"     => $data_bio['TAHUN'],
                "file"      => $file_name,
                "time"      => $time,
                "color"     => "succcess",
                "url"       => "bb_trans/detail/" . encrypt_url($add_id)
            );
            $message = 'User ' . get_session_name() . ' telah melakukan upload data ' . $data_email['modul'] . ' TRANSAKSI ' . $data_email['model'] . ' periode ' . $data_email['bulan'] . ' ' . $data_email['tahun'] . ' dengan nama file ' . $data_email['file'];
            send_notification(get_session_id(), $data_email, $subject, 'email/bb_trans', $message);

            redirect('bb_trans');
        }
    }

    private function do_upload($id, $file_name)
    {
        $upload_file = $_FILES['bio']['name'];
        if ($upload_file) {
            $upload_path                = './public/upload_file/bb_trans';
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
                $this->BbTrans_model->editBbTrans($data_bio, $id);
            } else {
                $error = $this->upload->display_errors();
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Gagal!</strong> ' . strip_tags($error) . '
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                $this->BioTrans_model->deleteBioTrans($id);
                redirect('bb_trans');
            }
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> File kosong.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $this->BbTrans_model->deleteBbTrans($id);
            redirect('bb_trans');
        }
    }

    public function detail($id)
    {
        $data['ptitle'] = "Batubara";
        $data['title']  = "Transaksi Batubara";

        $id = decrypt_url($id);

        $bb = $this->BbTrans_model->getBbTransById($id);
        if ($bb != NULL) {
            $path = 'public/upload_file/bb_trans/' . $bb['FILE'];

            $this->load->library('Excel');
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($path);
            $data['sheet'] = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data['file'] = $bb;

            $this->load->view('bb-trans-detail', $data);
        } else {
            $this->load->view('myerror/error404', $data);
        }
    }

    public function delete($id)
    {
        $id = decrypt_url($id);

        $bio = $this->BbTrans_model->getBbTransById($id);
        $delete = $this->BbTrans_model->deleteBbTrans($id);
        if ($delete) {
            unlink('public/upload_file/bb_trans/' . $bio['FILE']);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data Transaksi Batubara berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>Transaksi Batubara</strong> data <strong>' . $bio['TIPE_TEXT'] . '</strong> dengan nama file <strong>' . $bio['FILE'] . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Batubara', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data Transaksi Batubara masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('bb_trans');
    }
}
