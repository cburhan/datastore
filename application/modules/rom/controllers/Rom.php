<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Rom extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Rom_model');
    }

    public function index()
    {
        $data['ptitle'] = "Rencana Operasi";
        $data['title']  = "Mingguan";

        $this->load->view('rom-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Rom_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<small>' . $no . '</small>';
            $sub_array[] = '<small>' . $row->FILE . '</small>';
            $sub_array[] = '<small>W' . $row->WEEK . '</small>';
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
                $detail = '<a href="' . base_url('rom/detail/') . encrypt_url($row->ID) . '" class="btn btn-info btn-sm waves-effect"><i class="ion ion-md-eye"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('rom/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('detail') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $detail . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Rom_model->get_all_data(),
            'recordsFiltered'   => $this->Rom_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "Rencana Operasi";
        $data['title']  = "ROM";

        $this->form_validation->set_rules('week', 'week', 'required', [
            'required' => 'Week harus dipilih'
        ]);

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
            $this->load->view('rom-add', $data);
        } else {
            cek_csrf();
            $time = date('Y-m-d H:i:s');
            $tipe = $this->input->post('tipe');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $week = $this->input->post('week');
            $time_name = date('YmdHis', strtotime($time));
            if ($tipe == 1) {
                $file_name = 'ROM_S_W' . $week . '_' . $bulan . '_' . $tahun . '_' . $time_name;
            } else if ($tipe == 2) {
                $file_name = 'ROM_F_W' . $week . '_' . $bulan . '_' . $tahun . '_' . $time_name;
            }
            $data_rom = array(
                'WEEK'          => $week,
                'BULAN'         => bulan($bulan),
                'BLN'           => $bulan,
                'TAHUN'         => $tahun,
                'TIPE'          => $tipe,
                'CREATED_BY'    => get_session_name(),
                'CREATED_ON'    => $time
            );
            $add_id = $this->Rom_model->addRom($data_rom);
            $this->do_upload($this->input->post('tipe'), $add_id, $file_name);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data ROM berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>Rencana Operasi Mingguan</strong> periode <strong>' . $data_rom['BULAN'] . ' ' . $data_rom['TAHUN'] . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Rencana Operasi', 'ADD', 'success', $ket);
            redirect('rom');
        }
    }

    private function do_upload($tipe, $id, $file_name)
    {
        $upload_file = $_FILES['rom']['name'];
        if ($upload_file) {
            if ($tipe == 1) {
                $upload_path = './public/upload_file/rom_s';
            } else if ($tipe == 2) {
                $upload_path = './public/upload_file/rom_f';
            }
            $config['upload_path']      = $upload_path;
            $config['allowed_types']    = 'xls|xlsx';
            $config['remove_spaces']    = true;
            $config['file_name']        = $file_name;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('rom')) {
                $file = $this->upload->data('file_name');
                $data_rom = array(
                    'FILE'          => $file
                );
                $this->Rom_model->editRom($data_rom, $id);
            } else {
                $error = $this->upload->display_errors();
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Gagal!</strong> ' . strip_tags($error) . '
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                $this->Rom_model->deleteRom($id);
                redirect('rom');
            }
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> File kosong.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $this->Rom_model->deleteRom($id);
            redirect('rom');
        }
    }

    public function detail($rom_id)
    {
        $data['ptitle'] = "Rencana Operasi";
        $data['title']  = "ROM";

        $rom_id = decrypt_url($rom_id);

        $rom = $this->Rom_model->getRomById($rom_id);
        if ($rom != NULL) {
            if ($rom['TIPE'] == 1) {
                $path = 'public/upload_file/rom_s/' . $rom['FILE'];
            } else if ($rom['TIPE'] == 2) {
                $path = 'public/upload_file/rom_f/' . $rom['FILE'];
            }

            $this->load->library('Excel');
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($path);
            $data['sheet'] = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data['file'] = $rom;

            $this->load->view('rom-detail', $data);
        } else {
            $this->load->view('myerror/error404', $data);
        }
    }

    public function delete($rom_id)
    {
        $rom_id = decrypt_url($rom_id);

        $rom = $this->Rom_model->getRomById($rom_id);
        if ($rom['TIPE'] == 1) {
            unlink('public/upload_file/rom_s/' . $rom['FILE']);
        } else if ($rom['TIPE'] == 2) {
            unlink('public/upload_file/rom_f/' . $rom['FILE']);
        }
        $delete = $this->Rom_model->deleteRom($rom_id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data ROM berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>Rencana Operasi Mingguan</strong> periode <strong>' . $rom['BULAN'] . ' ' . $rom['TAHUN'] . '</strong> dengan nama file <strong>' . $rom['FILE'] . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Rencana Operasi', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data ROM masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('rom');
    }
}
