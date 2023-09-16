<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Rob extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Rob_model');
    }

    public function index()
    {
        $data['ptitle'] = "Rencana Operasi";
        $data['title']  = "ROB";

        $this->load->view('rob-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Rob_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<div class="text-center"><small>' . $no . '</small></div>';
            $sub_array[] = '<small>' . $row->FILE . '</small>';
            $sub_array[] = '<small>' . $row->BULAN . '</small>';
            $sub_array[] = '<small>' . $row->TAHUN . '</small>';
            if ($row->TIPE == 1) {
                $sub_array[] = '<span class="badge bg-sm bg-info">SEMENTARA</span>';
            } else if ($row->TIPE == 2) {
                $sub_array[] = '<span class="badge bg-sm bg-success">FINAL</span>';
            }
            $sub_array[] = '<small>' . $row->CREATED_BY . '</small>';
            $tgl_out = date("Y-m-d", strtotime($row->CREATED_ON));
            $jam_out = date("H:i:s", strtotime($row->CREATED_ON));
            $sub_array[] = '<small>' . tgl_indo($tgl_out) . ' ' . $jam_out . '</small>';
            $detail = NULL;
            $del = NULL;

            if (check_button('detail') > 0) {
                $detail = '<a href="' . base_url('rob/detail/') . encrypt_url($row->ID) . '" class="btn btn-info btn-sm waves-effect"><i class="ion ion-md-eye"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('rob/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('detail') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $detail . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Rob_model->get_all_data(),
            'recordsFiltered'   => $this->Rob_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "Rencana Operasi";
        $data['title']  = "ROB";

        $this->form_validation->set_rules('bulan', 'bulan', 'required', [
            'required' => 'Bulan harus dipilih'
        ]);

        $this->form_validation->set_rules('tahun', 'Tahun', 'required', [
            'required' => 'Tahun harus dipilih'
        ]);

        $this->form_validation->set_rules('tipe', 'Tipe', 'required', [
            'required' => 'Tipe harus dipilih'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('rob-add', $data);
        } else {
            cek_csrf();
            $time = date('Y-m-d H:i:s');
            $tipe = $this->input->post('tipe');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $cek_rob = cek_rob_f($bulan, $tahun);
            if ($tipe == 1 && $cek_rob['count'] != 0) {
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data ROB Bulan ' . bulan($bulan) . ' Tahun ' . $tahun . ' sudah ada yang Final.
                        </div>';
                $this->session->set_flashdata('flash', $flash);
            } else {
                $time_name = date('YmdHis', strtotime($time));
                if ($tipe == 1) {
                    $file_name = $time_name . '_ROB_S_' . $bulan . '_' . $tahun;
                } else if ($tipe == 2) {
                    $file_name = $time_name . '_ROB_F_' . $bulan . '_' . $tahun;
                }
                $data_rob = array(
                    'BULAN'         => bulan($bulan),
                    'BLN'           => $bulan,
                    'TAHUN'         => $tahun,
                    'TIPE'          => $tipe,
                    'CREATED_BY'    => get_session_name(),
                    'CREATED_ON'    => $time
                );
                $add_id = $this->Rob_model->addRob($data_rob);
                $this->do_upload($this->input->post('tipe'), $add_id, $file_name);
                $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Sukses!</strong> Data ROB berhasil ditambah.
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                $ket = 'Menambah data <strong>Rencana Operasi Bulanan</strong> periode <strong>' . $data_rob['BULAN'] . ' ' . $data_rob['TAHUN'] . '</strong>';
                activity_log(get_session_id(), get_session_name(), 'Rencana Operasi', 'ADD', 'success', $ket);
            }
            redirect('rob');
        }
    }

    private function do_upload($tipe, $id, $file_name)
    {
        $upload_file = $_FILES['rob']['name'];
        if ($upload_file) {
            if ($tipe == 1) {
                $upload_path = './public/upload_file/rob_s';
            } else if ($tipe == 2) {
                $upload_path = './public/upload_file/rob_f';
            }
            $config['upload_path']      = $upload_path;
            $config['allowed_types']    = 'xls|xlsx';
            $config['remove_spaces']    = true;
            $config['file_name']        = $file_name;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('rob')) {
                $file = $this->upload->data('file_name');
                $data_rob = array(
                    'FILE'          => $file
                );
                $this->Rob_model->editRob($data_rob, $id);
            } else {
                $error = $this->upload->display_errors();
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Gagal!</strong> ' . strip_tags($error) . '
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                $this->Rob_model->deleteRob($id);
                redirect('rob');
            }
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> File kosong.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $this->Rob_model->deleteRob($id);
            redirect('rob');
        }
    }

    public function detail($rob_id)
    {
        $data['ptitle'] = "Rencana Operasi";
        $data['title']  = "ROB";

        $rob_id = decrypt_url($rob_id);

        $rob = $this->Rob_model->getRobById($rob_id);
        if ($rob != NULL) {
            if ($rob['TIPE'] == 1) {
                $path = 'public/upload_file/rob_s/' . $rob['FILE'];
            } else if ($rob['TIPE'] == 2) {
                $path = 'public/upload_file/rob_f/' . $rob['FILE'];
            }

            $this->load->library('Excel');
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($path);
            $data['sheet'] = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data['file'] = $rob;

            $this->load->view('rob-detail', $data);
        } else {
            $this->load->view('myerror/error404', $data);
        }
    }

    public function delete($rob_id)
    {
        $rob_id = decrypt_url($rob_id);

        $rob  = $this->Rob_model->getRobById($rob_id);
        if ($rob['TIPE'] == 1) {
            unlink('public/upload_file/rob_s/' . $rob['FILE']);
        } else if ($rob['TIPE'] == 2) {
            unlink('public/upload_file/rob_f/' . $rob['FILE']);
        }
        $delete = $this->Rob_model->deleteRob($rob_id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data ROB berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>Rencana Operasi Bulanan</strong> periode <strong>' . $rob['BULAN'] . ' ' . $rob['TAHUN'] . '</strong> dengan nama file <strong>' . $rob['FILE'] . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Rencana Operasi', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data ROB masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('rob');
    }
}
