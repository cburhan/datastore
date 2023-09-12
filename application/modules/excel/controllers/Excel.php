<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Excel extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Excel_model');
    }

    public function index()
    {
        $data['ptitle'] = "Master";
        $data['title']  = "Excel";

        $this->load->view('excel-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Excel_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->TEMPLATE;
            if ($row->STATUS == 1) {
                $sub_array[] = '<span class="badge bg-sm bg-success">AKTIF</span>';
            } else if ($row->STATUS == 0) {
                $sub_array[] = '<span class="badge bg-sm bg-danger">TIDAK AKTIF</span>';
            }
            $edit = NULL;
            $download = NULL;
            $del = NULL;

            if (check_button('edit') > 0) {
                $edit = '<a href="' . base_url('excel/edit/') . encrypt_url($row->ID) . '" class="btn btn-warning btn-sm waves-effect"><i class="ion ion-md-color-filter"></i></a>';
            }
            if (check_button('download') > 0) {
                $download = '<a href="' . base_url('excel/download/') . encrypt_url($row->ID) . '" class="btn btn-primary btn-sm waves-effect" onclick="return "><i class="ion ion-md-download"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('excel/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('edit') || check_button('download') || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $edit . ' ' . $download . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Excel_model->get_all_data(),
            'recordsFiltered'   => $this->Excel_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "Master";
        $data['title']  = "Excel";

        $this->form_validation->set_rules('nama', 'nama', 'required', [
            'required' => 'Nama Template tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('excel-add', $data);
        } else {
            cek_csrf();
            $data_excel = array(
                'TEMPLATE'      => $this->input->post('nama'),
                'STATUS'        => 1,
                'CREATED_BY'    => get_session_name(),
                'CREATED_ON'    => date('Y-m-d H:i:s'),
                'CHANGED_BY'    => get_session_name()
            );
            $add_id = $this->Excel_model->addExcel($data_excel);
            $this->do_upload($add_id, $this->input->post('nama'));
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Master Template berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>Master Template ' . $data_excel['TEMPLATE'] . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Master', 'ADD', 'success', $ket);
            redirect('excel');
        }
    }

    private function do_upload($id, $template)
    {
        $upload_file = $_FILES['template']['name'];
        if ($upload_file) {
            $upload_path = './public/template';
            $config['upload_path']      = $upload_path;
            $config['allowed_types']    = 'xls|xlsx';
            $config['remove_spaces']    = true;
            $config['file_name']        = 'Template_' . $template;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('template')) {
                $file = $this->upload->data('file_name');
                $data_excel = array(
                    'FILE'          => $file
                );
                $this->Excel_model->editExcel($data_excel, $id);
            } else {
                $error = $this->upload->display_errors();
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Gagal!</strong> ' . strip_tags($error) . '
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                $this->Excel_model->deleteExcel($id);
                redirect('excel');
            }
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> File kosong.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $this->Excel_model->deleteExcel($id);
            redirect('excel');
        }
    }

    public function edit($id = NULL)
    {
        $data['ptitle']     = "Master";
        $data['title']      = "Template";

        $id = decrypt_url($id);

        $data['excel']   = $this->Excel_model->getExcelById($id);
        $nama = $data['excel']['TEMPLATE'];

        if ($data['excel'] != NULL) {
            $this->form_validation->set_rules('status', 'Status', 'required', [
                'required' => 'Status harus dipilih'
            ]);
        }

        if ($this->form_validation->run() == FALSE) {
            if ($data['excel'] != NULL) {
                $this->load->view('excel-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $data = array(
                'STATUS'        => $this->input->post('status'),
                'CHANGED_BY'    => get_session_name()
            );

            $this->Excel_model->editExcel($data, $id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah data <strong>Master Template ' . $nama . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Master', 'UPDATE', 'primary', $ket);
            redirect('excel');
        }
    }

    public function download($id)
    {
        $id = decrypt_url($id);
        $db = $this->Excel_model->getExcelById($id);

        $ket = 'Mengunduh <strong>Master Template ' . $db['TEMPLATE'] . '</strong>';
        activity_log(get_session_id(), get_session_name(), 'Master', 'DOWNLOAD', 'dark', $ket);

        $this->load->helper('download');
        force_download('./public/template/' . $db['FILE'], NULL);
    }

    public function delete($id)
    {
        $id = decrypt_url($id);

        $db = $this->Excel_model->getExcelById($id);
        unlink('public/template/' . $db['FILE']);
        $delete = $this->Excel_model->deleteExcel($id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data Master Template ' . $db['TEMPLATE'] . ' berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus <strong>Master Template ' . $db['TEMPLATE'] . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Master', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data Master Template masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('excel');
    }
}
