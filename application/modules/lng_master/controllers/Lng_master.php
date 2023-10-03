<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Lng_master extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('LngMaster_model');
    }

    public function index()
    {
        $data['ptitle'] = "LNG";
        $data['title']  = "Master LNG";

        $this->load->view('lng-master-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->LngMaster_model->make_datatables();
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
            $sub_array[] = '<span class="badge bg-sm bg-' . $row->TIPE_COLOR . '">' . $row->TIPE_TEXT . '</span>';
            $sub_array[] = $row->CREATED_BY;
            $tgl_out = date("Y-m-d", strtotime($row->CREATED_ON));
            $jam_out = date("H:i:s", strtotime($row->CREATED_ON));
            $sub_array[] = tgl_indo($tgl_out) . ' ' . $jam_out;
            $detail = NULL;
            $del = NULL;

            if (check_button('detail') > 0) {
                $detail = '<a href="' . base_url('lng_master/detail/') . encrypt_url($row->ID) . '" class="btn btn-info btn-sm waves-effect"><i class="ion ion-md-eye"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('lng_master/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('detail') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $detail . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->LngMaster_model->get_all_data(),
            'recordsFiltered'   => $this->LngMaster_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "LNG";
        $data['title']  = "Master LNG";

        $this->form_validation->set_rules('tipe', 'Tipe', 'required', [
            'required' => 'Tipe harus dipilih'
        ]);

        $tipe = $this->input->post('tipe');
        if ($tipe == 1) {
            $tipe_text = 'PEMBANGKIT';
            $tipe_color = 'primary';
        } else if ($tipe == 2) {
            $tipe_text = 'KONTRAK';
            $tipe_color = 'info';
        } else if ($tipe == 3) {
            $tipe_text = 'AMANDEMEN';
            $tipe_color = 'warning';
        } else if ($tipe == 4) {
            $tipe_text = 'PEMASOK';
            $tipe_color = 'success';
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('lng-master-add', $data);
        } else {
            cek_csrf();
            $time = date('Y-m-d H:i:s');
            $time_name = date('YmdHis', strtotime($time));
            $file_name = $time_name . '_LNG_MASTER_' . $tipe_text;
            $data_bio = array(
                'TIPE'          => $tipe,
                'TIPE_TEXT'     => $tipe_text,
                'TIPE_COLOR'    => $tipe_color,
                'CREATED_BY'    => get_session_name(),
                'CREATED_ON'    => $time
            );
            $add_id = $this->LngMaster_model->addLngMaster($data_bio);
            $this->do_upload($add_id, $file_name);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data Master LNG berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>Master LNG</strong> data <strong>' . $tipe_text . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'LNG', 'ADD', 'success', $ket);
            redirect('lng_master');
        }
    }

    private function do_upload($id, $file_name)
    {
        $upload_file = $_FILES['bio']['name'];
        if ($upload_file) {
            $upload_path                = './public/upload_file/lng_master';
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
                $this->LngMaster_model->editLngMaster($data_bio, $id);
            } else {
                $error = $this->upload->display_errors();
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Gagal!</strong> ' . strip_tags($error) . '
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                $this->LngMaster_model->deleteLngMaster($id);
                redirect('lng_master');
            }
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> File kosong.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $this->LngMaster_model->deleteLngMaster($id);
            redirect('lng_master');
        }
    }

    public function detail($id)
    {
        $data['ptitle'] = "LNG";
        $data['title']  = "Master LNG";

        $id = decrypt_url($id);

        $bio = $this->LngMaster_model->getLngMasterById($id);
        if ($bio != NULL) {
            $path = 'public/upload_file/lng_master/' . $bio['FILE'];

            $this->load->library('Excel');
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($path);
            $data['sheet'] = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data['file'] = $bio;

            $this->load->view('lng-master-detail', $data);
        } else {
            $this->load->view('myerror/error404', $data);
        }
    }

    public function delete($id)
    {
        $id = decrypt_url($id);

        $bio = $this->LngMaster_model->getLngMasterById($id);
        $delete = $this->LngMaster_model->deleteLngMaster($id);
        if ($delete) {
            unlink('public/upload_file/lng_master/' . $bio['FILE']);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data Master LNG berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>Master LNG</strong> data <strong>' . $bio['TIPE_TEXT'] . '</strong> dengan nama file <strong>' . $bio['FILE'] . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'LNG', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data Master LNG masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('lng_master');
    }
}
