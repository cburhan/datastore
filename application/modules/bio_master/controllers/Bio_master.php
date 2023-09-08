<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Bio_master extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('BioMaster_model');
    }

    public function index()
    {
        $data['ptitle'] = "Biomassa";
        $data['title']  = "Master Bio";

        $this->load->view('bio-master-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->BioMaster_model->make_datatables();
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
                $detail = '<a href="' . base_url('bio_master/detail/') . encrypt_url($row->ID) . '" class="btn btn-info btn-sm waves-effect"><i class="ion ion-md-eye"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('bio_master/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('detail') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $detail . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->BioMaster_model->get_all_data(),
            'recordsFiltered'   => $this->BioMaster_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "Biomassa";
        $data['title']  = "Master Bio";

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
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('bio-master-add', $data);
        } else {
            cek_csrf();
            $file_name = generate_filename_biomaster($tipe, $tipe_text);
            $data_bio = array(
                'TIPE'          => $tipe,
                'TIPE_TEXT'     => $tipe_text,
                'TIPE_COLOR'    => $tipe_color,
                'CREATED_BY'    => get_session_name(),
                'CREATED_ON'    => date('Y-m-d H:i:s')
            );
            $add_id = $this->BioMaster_model->addBioMaster($data_bio);
            $this->do_upload($add_id, $file_name);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data Master Biomassa berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>Master Biomassa</strong> data <strong>' . $tipe_text . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Biomassa', 'ADD', 'success', $ket);
            redirect('bio_master');
        }
    }

    private function do_upload($id, $file_name)
    {
        $upload_file = $_FILES['bio']['name'];
        if ($upload_file) {
            $upload_path                = './public/upload_file/bio_master';
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
                $this->BioMaster_model->editBioMaster($data_bio, $id);
            } else {
                $error = $this->upload->display_errors();
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Gagal!</strong> ' . strip_tags($error) . '
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                $this->BioMaster_model->deleteBioMaster($id);
                redirect('bio_master');
            }
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> File kosong.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $this->BioMaster_model->deleteBioMaster($id);
            redirect('bio_master');
        }
    }

    public function detail($id)
    {
        $data['ptitle'] = "Biomassa";
        $data['title']  = "Master Bio";

        $id = decrypt_url($id);

        $bio = $this->BioMaster_model->getBioMasterById($id);
        if ($bio != NULL) {
            $path = 'public/upload_file/bio_master/' . $bio['FILE'];

            $this->load->library('Excel');
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($path);
            $data['sheet'] = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data['file'] = $bio;

            $this->load->view('bio-master-detail', $data);
        } else {
            $this->load->view('myerror/error404', $data);
        }
    }

    public function delete($id)
    {
        $id = decrypt_url($id);

        $bio = $this->BioMaster_model->getBioMasterById($id);
        unlink('public/upload_file/bio_master/' . $bio['FILE']);
        $delete = $this->BioMaster_model->deleteBioMaster($id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data Master Biomassa berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>Master Biomassa</strong> data <strong>' . $bio['TIPE_TEXT'] . '</strong> dengan nama file <strong>' . $bio['FILE'] . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Biomassa', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data Master Biomassa masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('bio_master');
    }
}
