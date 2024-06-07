<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Role extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Role_model');
        $this->load->model('menu/Menu_model');
    }

    public function index()
    {
        $data['ptitle'] = "User";
        $data['title']  = "Role";

        $this->load->view('role-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Role_model->make_datatables_role();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<div class="text-center"><smalld>' . $no . '</smalld></div>';
            $sub_array[] = '<smalld>' . $row->ROLE . '</smalld>';

            $listUr = array();
            $ra = get_role_access($row->ID);
            if ($ra != NULL) {
                foreach ($ra as $rax) {
                    $listUr[] = '<li class="text-primary"><smalld>' . $rax['CLASS_METHOD'] . '</smalld></li>';
                }
            } else {
                $listUr = NULL;
            }

            $sub_array[] = ($listUr != NULL) ? '<ul class="unorder-list" style="columns: 3;">' . implode($listUr) . '</ul>' : '<ul class="unorder-list"><li class="text-danger">Tidak ada akses</li></ul>';
            $access = NULL;
            $edit = NULL;
            $del = NULL;

            if (check_button('access') > 0) {
                $access = '<a href="' . base_url('role/access/') . encrypt_url($row->ID) . '" class="btn btn-info btn-sm waves-effect"><i class="ion ion-md-eye"></i></a>';
            }
            if (check_button('edit') > 0) {
                $edit = '<a href="' . base_url('role/edit/') . encrypt_url($row->ID) . '" class="btn btn-warning btn-sm waves-effect"><i class="ion ion-md-color-filter"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('role/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('access') > 0 || check_button('edit') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $access . ' ' . $edit . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Role_model->get_all_data_role(),
            'recordsFiltered'   => $this->Role_model->get_filtered_data_role(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle']     = "User";
        $data['title']      = "Role";

        $this->form_validation->set_rules('role', 'role', 'required|is_unique[user_role.ROLE]', [
            'required'      => 'Role tidak boleh kosong',
            'is_unique'     => 'Role sudah ada'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('role-add', $data);
        } else {
            cek_csrf();
            $data = array(
                'ROLE'          => $this->input->post('role'),
                'CREATED_BY'    => get_session_name(),
                'CREATED_ON'    => date('Y-m-d H:i:s'),
                'CHANGED_BY'    => get_session_name()
            );
            $add_id = $this->Role_model->addRole($data);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data ' . $data['title'] . ' dengan <strong>ID #' . $add_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'User', 'ADD', 'success', $ket);
            redirect('role');
        }
    }

    public function edit($role_id)
    {
        $data['ptitle']     = "User";
        $data['title']      = "Role";

        $role_id = decrypt_url($role_id);

        $data['role']   = $this->Role_model->getRoleById($role_id);
        if ($data['role'] != NULL) {
            if ($data['role']['ROLE'] != $this->input->post('role')) {
                $this->form_validation->set_rules('role', 'Role', 'required|is_unique[user_role.ROLE]', [
                    'required'      => 'Role tidak boleh kosong',
                    'is_unique'     => 'Role sudah ada'
                ]);
            } else {
                $this->form_validation->set_rules('role', 'Role', 'required', [
                    'required'      => 'Role tidak boleh kosong'
                ]);
            }
        }

        if ($this->form_validation->run() == FALSE) {
            if ($data['role'] != NULL) {
                $this->load->view('role-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $data = array(
                'ROLE'          => $this->input->post('role'),
                'CHANGED_BY'    => get_session_name()
            );

            $this->Role_model->editRole($data, $role_id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah data ' . $data['title'] . ' dengan <strong>ID #' . $role_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'User', 'UPDATE', 'primary', $ket);
            redirect('role');
        }
    }

    public function delete($role_id)
    {
        $role_id        = decrypt_url($role_id);
        $data['role']   = $this->Role_model->getRoleById($role_id);
        $role           = $data['role']['ROLE'];

        $delete     = $this->Role_model->deleteRole($role_id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data Role dengan <strong>ID #' . $role_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'User', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('role');
    }

    public function access($role_id)
    {
        $data['ptitle']     = "User";
        $data['title']      = "Role";

        $data['role']       = decrypt_url($role_id);

        $data['role']       = $this->Role_model->getRoleById($data['role']);
        $data['menu']       = $this->Menu_model->getMenu()->result_array();

        if ($data['role'] != NULL) {
            $this->load->view('role-access', $data);
        } else {
            $this->load->view('myerror/error404', $data);
        }
    }

    public function get_data_access($role_id)
    {
        $role_id      = decrypt_url($role_id);
        $fetch_data = $this->Role_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<div class="text-center">' . $no . '</div>';
            $sub_array[] = $row->MENU;
            $sub_array[] = $row->TITLE;

            //if (check_button('change_access') > 0) {
            $sub_array[] = '<div class="custom-control custom-checkbox text-center"><input type="checkbox" class="form-check-input"' . check_access($role_id, $row->ID) . 'data-role="' . encrypt_url($role_id) . '" data-submenu="' . $row->ID . '"></div>';
            //}
            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Role_model->get_all_data(),
            'recordsFiltered'   => $this->Role_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function change_access()
    {
        $role_id        = $this->input->post('roleId');
        $sub_menu_id    = $this->input->post('subMenuId');

        $role_id      = decrypt_url($role_id);
        $data['role']   = $this->Role_model->getRoleById($role_id);
        $role           = $data['role']['ROLE'];

        $data = [
            'ROLE_ID'       => $role_id,
            'SUB_MENU_ID'   => $sub_menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Sukses!</strong> Data berhasil diubah.
                    </div>';
        $this->session->set_flashdata('flash', $flash);
        $ket = 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #' . $role_id . '</strong>';
        activity_log(get_session_id(), get_session_name(), 'User', 'UPDATE', 'primary', $ket);
        //redirect('role');
    }
}
