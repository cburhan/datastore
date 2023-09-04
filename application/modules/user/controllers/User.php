<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('User_model');
        $this->load->model('Log_model');
        $this->load->model('Upload_model');
        $this->load->model('role/Role_model');
        $this->load->model('org/Org_model');
    }

    public function index()
    {
        $data['ptitle'] = "User";
        $data['title']  = "User";

        $this->load->view('user-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->User_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<img src="' . base_url('public/user/') . $row->IMAGE . '" alt="" class="rounded-circle avatar-xs" style="object-fit: cover;">';
            $sub_array[] = ($row->NIP != NULL ? $row->NIP : '-');
            $sub_array[] = $row->FULLNAME;
            $sub_array[] = $row->USERNAME;

            $listUr = array();
            $userRole = $this->User_model->getUserRoleById($row->ID)->result_array();
            if ($userRole != NULL) {
                foreach ($userRole as $ur) {
                    $listUr[] = '<li class="text-primary">' . $ur['ROLE'] . '</li>';
                }
            } else {
                $listUr = NULL;
            }
            $sub_array[] = ($listUr != NULL) ? '<ul class="list mb-0">' . implode($listUr) . '</ul>' : '<ul class="list mb-0"><li class="text-danger">Tidak Ada Role</li></ul>';
            $detail = NULL;
            $edit = NULL;
            $del = NULL;

            if (check_button('detail') > 0) {
                $detail = '<a href="' . base_url('user/detail/') . encrypt_url($row->ID) . '" class="btn btn-info btn-sm waves-effect"><i class="ion ion-md-eye"></i></a>';
            }
            if (check_button('edit') > 0) {
                $edit = '<a href="' . base_url('user/edit/') . encrypt_url($row->ID) . '" class="btn btn-warning btn-sm waves-effect"><i class="ion ion-md-color-filter"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('user/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('detail') > 0 || check_button('edit') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $detail . ' ' . $edit . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->User_model->get_all_data(),
            'recordsFiltered'   => $this->User_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "User";
        $data['title']  = "User";

        $data['org'] = $this->Org_model->getOrgAll()->result_array();
        $org = $this->Org_model->getOrgById($this->input->post('org'))->row_array();

        $this->form_validation->set_rules('username', 'Username', 'required|trim|username|min_length[5]|is_unique[user.USERNAME]', [
            'required'      => 'Username tidak boleh kosong',
            'username'      => 'Hanya boleh mengandung unsur huruf dan angka saja',
            'min_length'    => 'Username minimal 5 karakter',
            'is_unique'     => 'Username sudah ada'
        ]);
        $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim', [
            'required'      => 'Nama Lengkap tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required'      => 'Email tidak boleh kosong!',
            'valid_email'   => 'Format harus Email'
        ]);
        $this->form_validation->set_rules('org', 'org', 'required|trim', [
            'required'      => 'Organisasi harus dipilih'
        ]);

        $data['hide_pass'] = true;

        if ($this->input->post('tipe') == 1) {
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
                'required'      => 'Password tidak boleh kosong',
                'min_length'    => 'Password minimal 8 karakter',
                'matches'       => 'Password tidak sama'
            ]);
            $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[8]|matches[password1]', [
                'required'      => 'Password tidak boleh kosong',
                'min_length'    => 'Password minimal 8 karakter',
                'matches'       => 'Password tidak sama'
            ]);
            $tipe = 'TABLE';
            $password = $this->input->post('password1');
            $data['hide_pass'] = false;
        } else if ($this->input->post('tipe') == 2) {
            $tipe = 'AD';
            $password = NULL;
            $data['hide_pass'] = true;
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user-add', $data);
        } else {
            cek_csrf();
            $data_user = array(
                'USERNAME'      => $this->input->post('username'),
                'FULLNAME'      => $this->input->post('fullname'),
                'NIP'           => ($this->input->post('nip') != NULL ? $this->input->post('nip') : NULL),
                'EMAIL'         => $this->input->post('email'),
                'NO_HP'         => ($this->input->post('nohp') != NULL ? $this->input->post('nohp') : NULL),
                'SHORT_TITLE'   => ($this->input->post('shortjab') != NULL ? $this->input->post('shortjab') : NULL),
                'LONG_TITLE'    => ($this->input->post('longjab') != NULL ? $this->input->post('longjab') : NULL),
                'ORG_ID'        => $this->input->post('org'),
                'SHORT_ORG'     => $org['SHORT_ORG'],
                'LONG_ORG'      => $org['LONG_ORG'],
                'PASSWORD'      => password_hash($password, PASSWORD_DEFAULT),
                'IMAGE'         => 'default.png',
                'TYPE_USER'     => $tipe,
                'IS_ACTIVE'     => 1,
                'CREATED_BY'    => get_session_name(),
                'CREATED_ON'    => date('Y-m-d H:i:s'),
                'CHANGED_BY'    => get_session_name()
            );
            $add_user = $this->User_model->addUser($data_user);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>' . $data['title'] . '</strong> dengan <strong>ID #' . $add_user . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'User', 'ADD', 'success', $ket);
            redirect('user');
        }
    }

    public function edit($user_id)
    {
        $data['ptitle'] = "User";
        $data['title']  = "User";

        $user_id = decrypt_url($user_id);

        $data['user'] = $this->User_model->getUserById($user_id)->row_array();
        if ($data['user'] != NULL) {
            $data['org'] = $this->Org_model->getOrgAll()->result_array();
            $org = $this->Org_model->getOrgById($this->input->post('org'))->row_array();
            $username = $data['user']['USERNAME'];

            $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim', [
                'required'      => 'Nama Lengkap tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
                'required'      => 'Email tidak boleh kosong!',
                'valid_email'   => 'Format harus Email'
            ]);
            $this->form_validation->set_rules('org', 'org', 'required|trim', [
                'required'      => 'Organisasi harus dipilih'
            ]);

            if ($data['user']['TYPE_USER'] == 'TABLE') {
                if ($this->input->post('password1') != '') {
                    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
                        'required'      => 'Password tidak boleh kosong',
                        'min_length'    => 'Password minimal 8 karakter',
                        'matches'       => 'Password tidak sama'
                    ]);
                    $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[8]|matches[password1]', [
                        'required'      => 'Password tidak boleh kosong',
                        'min_length'    => 'Password minimal 8 karakter',
                        'matches'       => 'Password tidak sama'
                    ]);
                    $pass = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                } else {
                    $pass = $data['user']['PASSWORD'];
                }
            } else {
                $pass = $data['user']['PASSWORD'];
            }
        }

        if ($this->form_validation->run() == FALSE) {
            if ($data['user'] != NULL) {
                $this->load->view('user-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $data = array(
                'FULLNAME'      => $this->input->post('fullname'),
                'NIP'           => ($this->input->post('nip') != NULL ? $this->input->post('nip') : NULL),
                'EMAIL'         => $this->input->post('email'),
                'NO_HP'         => ($this->input->post('nohp') != NULL ? $this->input->post('nohp') : NULL),
                'SHORT_TITLE'   => ($this->input->post('shortjab') != NULL ? $this->input->post('shortjab') : NULL),
                'LONG_TITLE'    => ($this->input->post('longjab') != NULL ? $this->input->post('longjab') : NULL),
                'ORG_ID'        => $this->input->post('org'),
                'SHORT_ORG'     => $org['SHORT_ORG'],
                'LONG_ORG'      => $org['LONG_ORG'],
                'PASSWORD'      => $pass,
                'CHANGED_BY'    => get_session_name()
            );
            $this->User_model->editUser($data, $user_id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah data <strong>' . $data['title'] . '</strong> dengan <strong>ID #' . $user_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'User', 'UPDATE', 'primary', $ket);
            redirect('user');
        }
    }

    public function detail($user_id)
    {
        $data['ptitle'] = "User";
        $data['title']  = "User";

        $user_id        = decrypt_url($user_id);
        $data['user']   = $this->User_model->getUserById($user_id)->row_array();

        if ($data['user'] != NULL) {
            $data['orgs']   = $this->Org_model->getOrgById($data['user']['ORG_ID'])->row_array();
            $role_u         = $this->Role_model->getRoleByUser($user_id)->result_array();
            $data['orgz'] = $this->Org_model->get_parent_by_child($data['user']['ORG_ID']);
            $data['orgc'] = $this->Org_model->getOrgAll()->result_array();
            if (check_button('change_user_role') > 0) {
                $data['role']   = $this->Role_model->getRole()->result_array();
            } else {
                if ($role_u != NULL) {
                    $data['role'] = $role_u;
                } else {
                    $data['role'] = NULL;
                }
            }
            $data['log']    = $this->Log_model->getUserActivity($user_id)->result_array();
            $this->load->view('user-detail', $data);
        } else {
            $this->load->view('myerror/error404', $data);
        }
    }

    public function delete($user_id)
    {
        $user_id        = decrypt_url($user_id);
        $data['user'] = $this->User_model->getUserById($user_id)->row_array();
        $username = $data['user']['USERNAME'];

        $delete     = $this->User_model->deleteUser($user_id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>User</strong> dengan <strong>ID #' . $user_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'User', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('user');
    }

    public function change_photo($user_id)
    {
        $id = decrypt_url($user_id);

        $user = $this->db->get_where('user', ['ID' => $id])->row();
        $old = $user->IMAGE;

        $filename = basename($_FILES['foto']['name']);
        $filename = preg_replace("/\.[^.]+$/", "", $filename);
        $config['upload_path']   = './public/user';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['overwrite'] = FALSE;
        $config['file_name'] = "user_" . $user_id . "_" . date('YmdHis');

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto')) {
            $error = $this->upload->display_errors();
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> ' . strip_tags($error) . '
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            redirect('user/detail/' . encrypt_url($id));
        } else {
            $upload = $this->upload->data();
            $filename = $upload['file_name'];
            $data = array("IMAGE" => $filename, 'CHANGED_BY' => get_session_name());
            $this->User_model->editUser($data, $id);

            if ($old != 'default.png') {
                unlink("./public/user/" . $old);
            }

            change_session_image($filename, $user->USERNAME);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Foto berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah <strong>Foto ' . $data['title'] . '</strong> dengan <strong>ID #' . $id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'User', 'UPDATE', 'primary', $ket);
            redirect('user/detail/' . encrypt_url($id));
        }
    }

    public function change_password($user_id)
    {
        $id = decrypt_url($user_id);

        $user = $this->db->get_where('user', ['ID' => $id])->row();

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|username|matches[password2]', [
            'required'      => 'Password tidak boleh kosong',
            'username'      => 'Password Hanya boleh mengandung unsur huruf dan angka saja',
            'min_length'    => 'Password minimal 8 karakter',
            'matches'       => 'Password tidak sama'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[8]|username|matches[password1]', [
            'required'      => 'Password tidak boleh kosong',
            'username'      => 'Retype Password Hanya boleh mengandung unsur huruf dan angka saja',
            'min_length'    => 'Password minimal 8 karakter',
            'matches'       => 'Password tidak sama'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Password tidak berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            redirect('user/detail/' . encrypt_url($id));
        } else {
            $data = array("PASSWORD" => password_hash($this->input->post('password1'), PASSWORD_DEFAULT), 'CHANGED_BY' => get_session_name());
            $this->User_model->editUser($data, $id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Password berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah <strong>Password ' . $data['title'] . '</strong> dengan <strong>ID #' . $id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'User', 'UPDATE', 'primary', $ket);
            redirect('user/detail/' . encrypt_url($id));
        }
    }

    public function change_user_role()
    {
        $role_id        = $this->input->post('roleid');
        $user_id        = $this->input->post('userid');

        $role_id        = decrypt_url($role_id);
        $user_id        = decrypt_url($user_id);

        $data['user'] = $this->User_model->getUserById($user_id)->row_array();
        //$username = $data['user']['USERNAME'];

        $data = [
            'ROLE_ID'       => $role_id,
            'USER_ID'       => $user_id
        ];

        $result = $this->db->get_where('user_group_role', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_group_role', $data);
        } else {
            $this->db->delete('user_group_role', $data);
        }

        $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Sukses!</strong> Role User berhasil diubah.
                    </div>';
        $this->session->set_flashdata('flash', $flash);
        $ket = 'Mengubah <strong>Role User</strong> dengan <strong>ID #' . $user_id . '</strong>';
        activity_log(get_session_id(), get_session_name(), 'User', 'UPDATE', 'primary', $ket);
        exit();
    }

    public function get_data_log($user_id)
    {
        $user_id        = decrypt_url($user_id);
        $fetch_data = $this->Log_model->make_datatables($user_id);
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<strong class="text-uppercase">' . $row->MODUL . '</strong> <span class="badge badge-sm bg-' . $row->COLOR . '">' . $row->ACTION . '</span>';
            $sub_array[] = $row->KETERANGAN;
            $sub_array[] = $row->PLATFORM . "<br>" . $row->BROWSER . " Ver. " . $row->VER;
            $sub_array[] = $row->IP;
            $tgl = date("Y-m-d", strtotime($row->CREATED_ON));
            $jam = date("H:i:s", strtotime($row->CREATED_ON));
            $sub_array[] = tgl_indo($tgl) . ' ' . $jam . '<br>' . hitung_mundur($row->CREATED_ON);

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Log_model->get_all_data($user_id),
            'recordsFiltered'   => $this->Log_model->get_filtered_data($user_id),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function change_status()
    {
        $id = $this->input->post('userId');
        $active_id = $this->input->post('activeId');

        if ($active_id == 0) {
            $active_id = 1;
        } else if ($active_id == 1) {
            $active_id = 0;
        }

        $data = [
            'IS_ACTIVE' => $active_id,
            'CHANGED_BY' => get_session_name()
        ];
        $this->db->update('user', $data, array('ID' => $id));

        $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Sukses!</strong> Status User berhasil diubah.
                    </div>';
        $this->session->set_flashdata('flash', $flash);
        $ket = 'Mengubah <strong>Status User</strong> dengan <strong>ID #' . $id . '</strong>';
        activity_log(get_session_id(), get_session_name(), 'User', 'UPDATE', 'primary', $ket);
    }

    public function profile()
    {
        $data['ptitle'] = "Profile";
        $data['title']  = "Profile";

        $data['user']   = $this->User_model->getUserById(get_session_id())->row_array();
        $data['role']   = $this->Role_model->getRoleByUser(get_session_id())->result_array();
        $data['log']    = $this->Log_model->getUserActivity(get_session_id())->result_array();
        $data['orgz'] = $this->Org_model->get_parent_by_child($data['user']['ORG_ID']);
        $data['orgs']   = $this->Org_model->getOrgById($data['user']['ORG_ID'])->row_array();

        $this->load->view('user-profile', $data);
    }

    public function change_photo_profile($user_id)
    {
        $id = decrypt_url($user_id);

        $user = $this->db->get_where('user', ['ID' => $id])->row();
        $old = $user->IMAGE;

        $filename = basename($_FILES['foto']['name']);
        $filename = preg_replace("/\.[^.]+$/", "", $filename);
        $config['upload_path']   = './public/user';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['overwrite'] = FALSE;
        $config['file_name'] = "user_" . $user_id . "_" . date('YmdHis');

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto')) {
            $error = $this->upload->display_errors();
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> ' . strip_tags($error) . '
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            redirect('myprofile');
        } else {
            $upload = $this->upload->data();
            $filename = $upload['file_name'];
            $data = array("IMAGE" => $filename, 'CHANGED_BY' => get_session_name());
            $this->User_model->editUser($data, $id);

            if ($old != 'default.png') {
                unlink("./public/user/" . $old);
            }

            change_session_image($filename, $user->USERNAME);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Foto berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'User <strong>' . $user->USERNAME . '</strong> mengubah <strong>Foto</strong> pada Profile';
            activity_log(get_session_id(), get_session_name(), 'User', 'UPDATE', 'primary', $ket);
            redirect('myprofile');
        }
    }

    public function upload()
    {
        $data['ptitle'] = "User";
        $data['title']  = "User Upload";

        $data['file'] = $this->Upload_model->file_uploaded()->result_array();

        $this->load->view('user-upload', $data);
    }

    public function download_template()
    {
        force_download('public/template/template_pegawai.xlsx', NULL);
    }

    public function do_upload()
    {
        $this->load->library('excel');
        $upload_file = $_FILES['excel']['name'];
        if ($upload_file) {
            $config['upload_path']      = './public/upload_file/pegawai';
            $config['allowed_types']    = 'xls|xlsx';
            $config['remove_spaces']    = true;
            $config['file_name']        = 'file_pegawai_' . date('Y-m-d_H-i-s');

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('excel')) {
                $file = $this->upload->data('file_name');
                $data = array(
                    'FILE'          => $file,
                    'STATUS'        => 'INIT',
                    'CREATED_ON'    => date('Y-m-d H:i:s'),
                    'CREATED_BY'    => get_session_name()
                );
                $add = $this->Upload_model->add_upload($data);
                $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Sukses!</strong> File berhasil diupload.
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                redirect('user/detail_upload/' . encrypt_url($add));
            } else {
                $error = $this->upload->display_errors();
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Gagal!</strong> ' . strip_tags($error) . '
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                redirect('user/upload');
            }
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> File kosong.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            redirect('user/upload');
        }
    }

    public function detail_upload($file_id)
    {
        $data['ptitle'] = "User";
        $data['title'] = "User Upload";

        $file_id = decrypt_url($file_id);

        $file = $this->Upload_model->get_file_by_id($file_id);
        if ($file != NULL) {
            if ($file['STATUS'] == 'EXE') {
                $data['log'] = $this->Upload_model->get_log_upload($file_id)->result_array();
            }
            $path = 'public/upload_file/pegawai/' . $file['FILE'];

            $this->load->library('Excel');
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($path);
            $data['sheet'] = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data['file'] = $file;

            $this->load->view('user-detail-upload', $data);
        } else {
            $this->load->view('myerror/error404', $data);
        }
    }

    public function exe_upload($file_id)
    {
        $file = $this->Upload_model->get_file_by_id($file_id);
        $path = 'public/upload_file/pegawai/' . $file['FILE'];

        $this->load->library('excel');
        $object = PHPExcel_IOFactory::load($path);
        foreach ($object->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            for ($row = 2; $row <= $highestRow; $row++) {
                $nip = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $username = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $fullname = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $email = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $org_id = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $short_title = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $long_title = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                $org = $this->Org_model->getOrgById($org_id)->row_array();

                $data = array(
                    'NIP'           => $nip,
                    'USERNAME'      => $username,
                    'FULLNAME'      => $fullname,
                    'EMAIL'         => $email,
                    'ORG_ID'        => $org_id,
                    'SHORT_ORG'     => $org['SHORT_ORG'],
                    'LONG_ORG'      => $org['LONG_ORG'],
                    'SHORT_TITLE'   => $short_title,
                    'LONG_TITLE'    => $long_title,
                    'IMAGE'         => 'default.png',
                    'TYPE_USER'     => 'AD',
                    'IS_ACTIVE'     => 1,
                    'CREATED_BY'    => 'SYSTEM',
                    'CREATED_ON'    => date('Y-m-d H:i:s'),
                    'CHANGED_BY'    => 'SYSTEM',
                );

                $p = $this->Upload_model->get_not_username($username);
                if ($p->num_rows() == 0) {
                    $add_user = $this->Upload_model->exe_upload($data);

                    $role = [
                        'ROLE_ID'       => 11,
                        'USER_ID'       => $add_user
                    ];

                    $this->db->insert('user_group_role', $role);
                    $tipe = "INSERT";
                } else {
                    $tipe = "EXIST";
                    $data_org = array(
                        'ORG_ID'        => $org_id,
                        'SHORT_ORG'     => $org['SHORT_ORG'],
                        'LONG_ORG'      => $org['LONG_ORG'],
                        'CHANGED_BY'    => 'SYSTEM'
                    );
                    $this->User_model->editUser($data_org, get_user($username));
                }
                $data_log = array(
                    'UPLOAD_ID'     => $file_id,
                    'NIP'           => $nip,
                    'USERNAME'      => $username,
                    'FULLNAME'      => $fullname,
                    'EMAIL'         => $email,
                    'ORG_ID'        => $org_id,
                    'SHORT_ORG'     => $org['SHORT_ORG'],
                    'LONG_ORG'      => $org['LONG_ORG'],
                    'SHORT_TITLE'   => $short_title,
                    'LONG_TITLE'    => $long_title,
                    'TIPE'          => $tipe
                );

                $this->Upload_model->insert_log($data_log);
            }
        }

        $data_file = array(
            'STATUS'    => 'EXE'
        );
        $this->Upload_model->edit_upload($data_file, $file_id);
        $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Sukses!</strong> Data berhasil diupload.
                    </div>';
        $this->session->set_flashdata('flash', $flash);
        redirect('user/detail_upload/' . encrypt_url($file_id));
    }
}
