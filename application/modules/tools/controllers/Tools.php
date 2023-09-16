<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Tools extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Tools_model');
        $this->load->model('Db_model');
        $this->load->model('Ver_model');
        $this->load->model('User/Log_model');
    }

    public function apps()
    {
        $data['ptitle'] = "Tools";
        $data['title']  = "Apps";

        $data['apps']   = $this->Tools_model->getApps()->row_array();

        $this->load->view('tools-apps-view', $data);
    }

    public function change_name_apps()
    {
        $apps   = $this->Tools_model->getApps()->row_array();

        if ($apps['NAME'] != $this->input->post('name')) {
            $this->form_validation->set_rules('name', 'Name', 'required|is_unique[apps.NAME]', [
                'required'      => 'Nama Aplikasi tidak boleh kosong',
                'is_unique'     => 'Nama Aplikasi sudah ada'
            ]);
        } else {
            $this->form_validation->set_rules('name', 'Name', 'required', [
                'required'      => 'Nama Aplikasi tidak boleh kosong'
            ]);
        }

        if ($this->form_validation->run() == FALSE) {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> ' . validation_errors() . '
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            redirect('tools/apps');
        } else {
            cek_csrf();
            $data = array("NAME" => $this->input->post('name'));
            $this->Tools_model->editApps($data);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Nama Apps berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah <strong>NAMA APPS</strong> dari <strong>' . $apps['NAME'] . '</strong> menjadi <strong>' . $this->input->post('name') . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Tools', 'UPDATE', 'primary', $ket);
            redirect('tools/apps');
        }
    }

    public function change_logo_apps()
    {
        $apps   = $this->Tools_model->getApps()->row_array();
        $old    = $apps['LOGO'];

        $filename = basename($_FILES['logo']['name']);
        $filename = preg_replace("/\.[^.]+$/", "", $filename);
        $config['upload_path']   = './public/apps';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['overwrite'] = FALSE;
        $config['file_name'] = "logo_" . date('YmdHis');

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('logo')) {
            $error = $this->upload->display_errors();
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> ' . strip_tags($error) . '
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            redirect('tools/apps');
        } else {
            cek_csrf();
            $upload = $this->upload->data();
            $filename = $upload['file_name'];

            $info = getimagesize($_FILES['logo']['tmp_name']);
            $width = $info[0];

            if ($width >= '1920') {
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'public/apps/' . $filename;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '70%';
                $config['width'] = 1920;
                $config['new_image'] = 'public/apps/' . $filename;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
            }

            $data = array("LOGO" => $filename);
            $this->Tools_model->editApps($data);

            if ($old != 'noimage.png') {
                unlink("./public/apps/" . $old);
            }

            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Logo Apps berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah <strong>LOGO APPS</strong>';
            activity_log(get_session_id(), get_session_name(), 'Tools', 'UPDATE', 'primary', $ket);
            redirect('tools/apps');
        }
    }

    public function change_logobig_apps()
    {
        $apps   = $this->Tools_model->getApps()->row_array();
        $old    = $apps['LOGO_BIG'];

        $filename = basename($_FILES['logobig']['name']);
        $filename = preg_replace("/\.[^.]+$/", "", $filename);
        $config['upload_path']   = './public/apps';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['overwrite'] = FALSE;
        $config['file_name'] = "logo_big_" . date('YmdHis');

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('logobig')) {
            $error = $this->upload->display_errors();
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> ' . strip_tags($error) . '
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            redirect('tools/apps');
        } else {
            cek_csrf();
            $upload = $this->upload->data();
            $filename = $upload['file_name'];

            $info = getimagesize($_FILES['logobig']['tmp_name']);
            $width = $info[0];

            if ($width >= '1920') {
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'public/apps/' . $filename;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '70%';
                $config['width'] = 1920;
                $config['new_image'] = 'public/apps/' . $filename;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
            }

            $data = array("LOGO_BIG" => $filename);
            $this->Tools_model->editApps($data);

            if ($old != 'noimage.png') {
                unlink("./public/apps/" . $old);
            }

            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Logo Big Apps berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah <strong>LOGO BIG APPS</strong>';
            activity_log(get_session_id(), get_session_name(), 'Tools', 'UPDATE', 'primary', $ket);
            redirect('tools/apps');
        }
    }

    public function change_bg_apps()
    {
        $apps   = $this->Tools_model->getApps()->row_array();
        $old    = $apps['BG'];

        $filename = basename($_FILES['bg']['name']);
        $filename = preg_replace("/\.[^.]+$/", "", $filename);
        $config['upload_path']   = './public/apps';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 20480;
        $config['overwrite'] = FALSE;
        $config['file_name'] = "bg_" . date('YmdHis');

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('bg')) {
            $error = $this->upload->display_errors();
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> ' . strip_tags($error) . '
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            redirect('tools/apps');
        } else {
            cek_csrf();
            $upload = $this->upload->data();
            $filename = $upload['file_name'];

            $info = getimagesize($_FILES['bg']['tmp_name']);
            $width = $info[0];

            if ($width >= '1920') {
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'public/apps/' . $filename;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '70%';
                $config['width'] = 1920;
                $config['new_image'] = 'public/apps/' . $filename;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
            }

            $data = array("BG" => $filename);
            $this->Tools_model->editApps($data);

            if ($old != 'noimage.png') {
                unlink("./public/apps/" . $old);
            }

            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Background Apps berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah <strong>BACKGROUND APPS</strong>';
            activity_log(get_session_id(), get_session_name(), 'Tools', 'UPDATE', 'primary', $ket);
            redirect('tools/apps');
        }
    }

    public function activity_log()
    {
        $data['ptitle'] = "Tools";
        $data['title']  = "Activity Log";

        $this->load->view('tools-log-view', $data);
    }

    public function get_activity_log()
    {
        $fetch_data = $this->Log_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<span class="text-center" style="font-size:0.75rem">' . $no . '</span>';
            $sub_array[] = '<span style="font-size:0.75rem">' . $row->USER . '</span>';
            $sub_array[] = '<span style="font-size:0.75rem">' . $row->MODUL . '</span> <span class="badge badge-sm bg-' . $row->COLOR . '">' . $row->ACTION . '</span>';
            $sub_array[] = '<span style="font-size:0.75rem">' . $row->KETERANGAN . '</span>';
            $sub_array[] = '<span style="font-size:0.75rem">' . $row->PLATFORM . '</span>';
            $sub_array[] = '<span style="font-size:0.75rem">' . $row->BROWSER . " Ver. " . $row->VER . '</span>';
            $sub_array[] = '<span style="font-size:0.75rem">' . $row->IP . '</span>';
            $tgl = date("Y-m-d", strtotime($row->CREATED_ON));
            $jam = date("H:i:s", strtotime($row->CREATED_ON));
            $sub_array[] = '<span style="font-size:0.75rem">' . tgl_indo($tgl) . ' ' . $jam . '<br>' . hitung_mundur($row->CREATED_ON) . '</span>';

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Log_model->get_all_data(),
            'recordsFiltered'   => $this->Log_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function backup()
    {
        $data['ptitle'] = "Tools";
        $data['title']  = "Backup Database";

        $this->load->view('tools-db-view', $data);
    }

    public function get_data_backup()
    {
        $fetch_data = $this->Db_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<div class="text-center">' . $no . '</div>';
            $sub_array[] = $row->DB;
            $sub_array[] = $row->CREATED_BY;
            $tgl = date("Y-m-d", strtotime($row->CREATED_ON));
            $jam = date("H:i:s", strtotime($row->CREATED_ON));
            $sub_array[] = tgl_indo($tgl) . ' ' . $jam . '<br>' . hitung_mundur($row->CREATED_ON);
            if (check_button('download_backup_db') > 0) {
                $dl = '<a type="button" class="btn btn-success btn-sm waves-effect me-1" href="' . base_url('tools/download_backup_db/') . encrypt_url($row->ID) . '" onclick="return confirmDownload()">
            <i class="ion ion-md-cloud-download"></i></a>';
                $sub_array[] = '<div class="text-center">' . $dl . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Db_model->get_all_data(),
            'recordsFiltered'   => $this->Db_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add_backup_db()
    {
        $this->load->dbutil();


        $tables = array(
            'apps', 'apps_db', 'apps_ver', 'org',
            'upload_pegawai', 'upload_pegawai_log', 'user', 'user_access_menu', 'user_activity_log',
            'user_group_role', 'user_menu', 'user_role', 'user_sub_menu'
        );

        $prefs = array(
            'format'      => 'zip',
            'filename'    => 'backup_' . date("Y-m-d_H-i-s") . '.sql',
            'tables'      => $tables
        );

        $backup = $this->dbutil->backup($prefs);

        $db_name = 'backup_' . date("Y-m-d_H-i-s") . '.zip';
        $save = './public/db/' . $db_name;

        write_file($save, $backup);

        $data = array(
            'DB'            => $db_name,
            'CREATED_BY'    => get_session_name(),
            'CREATED_ON'    => date('Y-m-d H:i:s'),
        );
        $this->Tools_model->addBackup($data);
        $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Sukses!</strong> Backup Database berhasil ditambah.
                    </div>';
        $this->session->set_flashdata('flash', $flash);
        $ket = 'Menambah <strong>BACKUP DB</strong> dengan nama <strong>' . $db_name . '</strong>';
        activity_log(get_session_id(), get_session_name(), 'Tools', 'ADD', 'success', $ket);
        redirect('tools/backup');
    }

    public function download_backup_db($id)
    {
        $id = decrypt_url($id);
        $db = $this->Tools_model->getBackupById($id);

        $ket = 'Mengunduh <strong>BACKUP DB</strong> dengan nama <strong>' . $db['DB'] . '</strong>';
        activity_log(get_session_id(), get_session_name(), 'Tools', 'DOWNLOAD', 'dark', $ket);

        $this->load->helper('download');
        force_download('./public/db/' . $db['DB'], NULL);
    }

    public function ver()
    {
        $data['ptitle'] = "Tools";
        $data['title']  = "Version";

        $this->load->view('tools-ver-view', $data);
    }

    public function get_data_ver()
    {
        $fetch_data = $this->Ver_model->make_datatables();
        $data = array();

        foreach ($fetch_data as $row) {
            $sub_array = array();
            $sub_array[] = '<span class="text-primary"><strong>' . $row->VER . '</strong></span>';
            $sub_array[] = $row->TIPE;
            $sub_array[] = $row->CREATED_BY;
            $tgl = date("Y-m-d", strtotime($row->CREATED_ON));
            $jam = date("H:i:s", strtotime($row->CREATED_ON));
            $sub_array[] = tgl_indo($tgl) . ' ' . $jam . '<br>' . hitung_mundur($row->CREATED_ON);
            $detail = NULL;
            $edit = NULL;
            $del = NULL;
            if (check_button('detail_ver') > 0) {
                $detail = '<a type="button" class="btn btn-info btn-sm waves-effect" href="' . base_url('tools/detail_ver/') . encrypt_url($row->ID) . '">
            <i class="ion ion-md-eye"></i></a>';
            }
            if (check_button('edit_ver') > 0) {
                $edit = '<a type="button" class="btn btn-warning btn-sm waves-effect" href="' . base_url('tools/edit_ver/') . encrypt_url($row->ID) . '">
            <i class="ion ion-md-color-filter"></i></a>';
            }
            if (check_button('delete_ver') > 0) {
                $del = '<a href="' . base_url('tools/delete_ver/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('detail_ver') > 0 || check_button('edit_ver') > 0 || check_button('delete_ver') > 0) {
                $sub_array[] = '<div class="text-center">' . $detail . ' ' . $edit . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Ver_model->get_all_data(),
            'recordsFiltered'   => $this->Ver_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add_ver()
    {
        $data['ptitle'] = "Tools";
        $data['title']  = "Version";

        $this->form_validation->set_rules('tipe', 'Tipe', 'required', [
            'required' => 'Tipe harus dipilih'
        ]);
        $this->form_validation->set_rules('detail', 'Detail', 'required', [
            'required' => 'Detail tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('tools-ver-add', $data);
        } else {
            cek_csrf();
            $major = NULL;
            $fitur = NULL;
            $minor = NULL;
            $max_major = $this->Ver_model->max_major();
            $max_fitur = $this->Ver_model->max_fitur();
            $max_minor = $this->Ver_model->max_minor();
            if ($this->input->post('tipe') == 1) {
                $major = (int) $max_major['MAJOR'] + 1;
                $fitur = (int) $max_fitur['FITUR'];
                $minor = (int) $max_minor['MINOR'];
                $tipe = "MAJOR";
            } else if ($this->input->post('tipe') == 2) {
                $major = (int) $max_major['MAJOR'];
                $fitur = (int) $max_fitur['FITUR'] + 1;
                $minor = (int) $max_minor['MINOR'];
                $tipe = "FITUR";
            } else if ($this->input->post('tipe') == 3) {
                $major = (int) $max_major['MAJOR'];
                $fitur = (int) $max_fitur['FITUR'];
                $minor = (int) $max_minor['MINOR'] + 1;
                $tipe = "MINOR";
            }
            $ver = "v" . $major . "." . $fitur . "." . $minor;
            $data = array(
                'VER'           => $ver,
                'TIPE'          => $tipe,
                'MAJOR'         => $major,
                'FITUR'         => $fitur,
                'MINOR'         => $minor,
                'DETAIL'        => $this->input->post('detail'),
                'CREATED_BY'    => get_session_name(),
                'CREATED_ON'    => date('Y-m-d H:i:s'),
                'CHANGED_BY'    => get_session_name()
            );
            $this->Tools_model->addVer($data);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah <strong>Version Apps</strong> menjadi <strong>' . $ver . '</strong> pada sistem';
            activity_log(get_session_id(), get_session_name(), 'Tools', 'ADD', 'success', $ket);
            redirect('tools/ver');
        }
    }

    public function edit_ver($id)
    {
        $data['ptitle'] = "Tools";
        $data['title']  = "Version";

        $id             = decrypt_url($id);
        $data['ver']    = $this->Tools_model->getVerById($id);

        if ($data['ver'] != NULL) {
            $ver = $data['ver']['VER'];
            $this->form_validation->set_rules('detail', 'Detail', 'required', [
                'required' => 'Detail tidak boleh kosong'
            ]);
        }

        if ($this->form_validation->run() == FALSE) {
            if ($data['ver'] != NULL) {
                $this->load->view('tools-ver-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $data = array(
                'DETAIL'        => $this->input->post('detail'),
                'CHANGED_BY'    => get_session_name()
            );
            $this->Tools_model->editVer($data, $id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah <strong>Version Apps ' . $ver . '</strong> pada sistem';
            activity_log(get_session_id(), get_session_name(), 'Tools', 'UPDATE', 'primary', $ket);
            redirect('tools/ver');
        }
    }

    public function detail_ver($id)
    {
        $data['ptitle'] = "Tools";
        $data['title']  = "Version";

        $id             = decrypt_url($id);
        $data['ver']    = $this->Tools_model->getVerById($id);

        if ($data['ver'] != NULL) {
            $this->load->view('tools-ver-detail', $data);
        } else {
            $this->load->view('myerror/error404', $data);
        }
    }

    public function delete_ver($id)
    {
        $id             = decrypt_url($id);
        $data['ver']    = $this->Tools_model->getVerById($id);
        $ver            = $data['ver']['VER'];

        $delete = $this->Tools_model->deleteVer($id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus Version <strong>' . $ver . '</strong> pada sistem';
            activity_log(get_session_id(), get_session_name(), 'Tools', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('tools/ver');
    }

    public function changelog()
    {
        $data['ptitle'] = "Changelog";
        $data['title']  = "Changelog";

        $data['ver']    = $this->Tools_model->getVer()->result_array();

        $this->load->view('tools-changelog', $data);
    }
}
