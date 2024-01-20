<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Rot extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Rot_model');
    }

    public function index()
    {
        $data['ptitle'] = "Rencana Operasi";
        $data['title']  = "ROT";

        $this->load->view('rot-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Rot_model->make_datatables();
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
            $sub_array[] = $row->TAHUN;
            if ($row->TIPE == 1) {
                $sub_array[] = '<span class="badge bg-sm bg-info">SEMENTARA</span>';
            } else if ($row->TIPE == 2) {
                $sub_array[] = '<span class="badge bg-sm bg-success">FINAL</span>';
            }
            $detail = NULL;
            $del = NULL;

            if (check_button('detail') > 0) {
                $detail = '<a href="' . base_url('rot/detail/') . encrypt_url($row->ID) . '" class="btn btn-info btn-sm waves-effect"><i class="ion ion-md-eye"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('rot/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('detail') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $detail . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Rot_model->get_all_data(),
            'recordsFiltered'   => $this->Rot_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "Rencana Operasi";
        $data['title']  = "ROT";

        $this->form_validation->set_rules('tahun', 'Tahun', 'required', [
            'required' => 'Tahun harus dipilih'
        ]);

        $this->form_validation->set_rules('tipe', 'Tipe', 'required', [
            'required' => 'Tipe harus dipilih'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('rot-add', $data);
        } else {
            cek_csrf();
            $time = date('Y-m-d H:i:s');
            $tipe = $this->input->post('tipe');
            $tahun = $this->input->post('tahun');
            $cek_rot = cek_rot_f($tahun);
            if ($tipe == 1 && $cek_rot['count'] != 0) {
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data ROT Tahun ' . $tahun . ' sudah ada yang Final.
                        </div>';
                $this->session->set_flashdata('flash', $flash);
            } else {
                $time_name = date('YmdHis', strtotime($time));
                if ($tipe == 1) {
                    $file_name = $time_name . '_ROT_S_' . $tahun;
                    $rot_email = "Sementara";
                } else if ($tipe == 2) {
                    $file_name = $time_name . '_ROT_F_' . $tahun;
                    $rot_email = "Final";
                }
                $data_rot = array(
                    'TAHUN'         => $tahun,
                    'TIPE'          => $tipe,
                    'CREATED_BY'    => get_session_name(),
                    'CREATED_ON'    => $time
                );
                $add_id = $this->Rot_model->addRot($data_rot);
                $this->do_upload($this->input->post('tipe'), $add_id, $file_name);
                $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Sukses!</strong> Data ROT berhasil ditambah.
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                $ket = 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>' . $data_rot['TAHUN'] . '</strong>';
                activity_log(get_session_id(), get_session_name(), 'Rencana Operasi', 'ADD', 'success', $ket);

                $subject = 'Data ROT ' .  $data_rot['TAHUN'];
                $data_email = array(
                    "modul"     => "ROT",
                    "modul_id"  => $add_id,
                    "tipe"      => $rot_email,
                    "tahun"     => $data_rot['TAHUN'],
                    "file"      => $file_name,
                    "time"      => $time,
                    "color"     => "primary",
                    "url"       => "rot/detail/" . encrypt_url($add_id)
                );
                $message = 'User ' . get_session_name() . ' telah melakukan upload data ' . $data_email['modul'] . ' ' . $data_email['tipe'] . ' periode ' . $data_email['tahun'] . ' dengan nama file ' . $data_email['file'];
                send_notification(get_session_id(), $data_email, $subject, 'email/rot', $message);
            }
            redirect('rot');
        }
    }

    private function do_upload($tipe, $id, $file_name)
    {
        $upload_file = $_FILES['rot']['name'];
        if ($upload_file) {
            if ($tipe == 1) {
                $upload_path = './public/upload_file/rot_s';
            } else if ($tipe == 2) {
                $upload_path = './public/upload_file/rot_f';
            }
            $config['upload_path']      = $upload_path;
            $config['allowed_types']    = 'xls|xlsx';
            $config['remove_spaces']    = true;
            $config['file_name']        = $file_name;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('rot')) {
                $file = $this->upload->data('file_name');
                $data_rot = array(
                    'FILE'          => $file
                );
                $this->Rot_model->editRot($data_rot, $id);
            } else {
                $error = $this->upload->display_errors();
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Gagal!</strong> ' . strip_tags($error) . '
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                $this->Rot_model->deleteRot($id);
                redirect('rot');
            }
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> File kosong.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $this->Rot_model->deleteRot($id);
            redirect('rot');
        }
    }

    public function detail($rot_id)
    {
        $data['ptitle'] = "Rencana Operasi";
        $data['title']  = "ROT";

        $rot_id = decrypt_url($rot_id);

        $rot = $this->Rot_model->getRotById($rot_id);
        if ($rot != NULL) {
            if ($rot['TIPE'] == 1) {
                $path = 'public/upload_file/rot_s/' . $rot['FILE'];
            } else if ($rot['TIPE'] == 2) {
                $path = 'public/upload_file/rot_f/' . $rot['FILE'];
            }

            $this->load->library('Excel');
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($path);
            $data['sheet'] = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data['file'] = $rot;

            $this->load->view('rot-detail', $data);
        } else {
            $this->load->view('myerror/error404', $data);
        }
    }

    public function delete($rot_id)
    {
        $rot_id = decrypt_url($rot_id);

        $rot   = $this->Rot_model->getRotById($rot_id);
        if ($rot['TIPE'] == 1) {
            unlink('public/upload_file/rot_s/' . $rot['FILE']);
        } else if ($rot['TIPE'] == 2) {
            unlink('public/upload_file/rot_f/' . $rot['FILE']);
        }
        $delete = $this->Rot_model->deleteRot($rot_id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data ROT berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>Rencana Operasi Tahunan</strong> tahun <strong>' . $rot['TAHUN'] . '</strong> dengan nama file <strong>' . $rot['FILE'] . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Rencana Operasi', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data ROT masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('rot');
    }
}
