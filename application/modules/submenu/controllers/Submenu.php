<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Submenu extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Sub_menu_model');
        $this->load->model('menu/Menu_model');
    }

    public function index()
    {
        $data['ptitle'] = "Menu";
        $data['title']  = "Sub Menu";

        $this->load->view('submenu-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Sub_menu_model->make_datatables();
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
            $sub_array[] = $row->SUB_MENU;
            $sub_array[] = $row->URL;

            if (check_button('change_status') > 0) {
                $sub_array[] = '<div class="custom-control custom-checkbox ps-0">
                                <input type="checkbox" id="asu" class="form-check-input"' . check_active($row->IS_ACTIVE) . ' data-submenu="' . $row->ID . '" data-active="' . $row->IS_ACTIVE . '">
                                </div>';
            }
            $edit = NULL;
            $del = NULL;

            if (check_button('edit') > 0) {
                $edit = '<a href="' . base_url('submenu/edit/') . encrypt_url($row->ID) . '" class="btn btn-warning btn-sm waves-effect"><i class="ion ion-md-color-filter"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('submenu/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('edit') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $edit . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Sub_menu_model->get_all_data(),
            'recordsFiltered'   => $this->Sub_menu_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "Menu";
        $data['title']  = "Sub Menu";

        $data['menu'] = $this->Menu_model->getMenu()->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required', [
            'required' => 'Menu harus dipilih'
        ]);
        $this->form_validation->set_rules('title', 'Title', 'required', [
            'required' => 'Title tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('submenu', 'Submenu', 'required', [
            'required' => 'Sub Menu tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required', [
            'required' => 'URL tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('class', 'Class', 'required', [
            'required' => 'Class Method tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('tampil', 'Tampil', 'required', [
            'required' => 'Status harus dipilih'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('submenu-add', $data);
        } else {
            cek_csrf();
            $data = array(
                'MENU_ID'       => $this->input->post('menu'),
                'TITLE'         => $this->input->post('title'),
                'SUB_MENU'      => $this->input->post('submenu'),
                'URL'           => $this->input->post('url'),
                'CLASS_METHOD'  => $this->input->post('class'),
                'IS_ACTIVE'     => $this->input->post('tampil'),
                'CREATED_BY'    => get_session_name(),
                'CREATED_ON'    => date('Y-m-d H:i:s'),
                'CHANGED_BY'    => get_session_name()
            );
            $add_id = $this->Sub_menu_model->addSubMenu($data);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>' . $data['title'] . '</strong> dengan <strong>ID #' . $add_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Menu', 'ADD', 'success', $ket);
            redirect('submenu');
        }
    }

    public function edit($sub_menu_id)
    {
        $data['ptitle'] = "Menu";
        $data['title']  = "Sub Menu";

        $sub_menu_id = decrypt_url($sub_menu_id);

        $data['menu']       = $this->Menu_model->getMenu()->result_array();
        $data['submenu']    = $this->Sub_menu_model->getSubMenuById($sub_menu_id)->row_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required', [
            'required' => 'Menu harus dipilih'
        ]);
        $this->form_validation->set_rules('title', 'Title', 'required', [
            'required' => 'Title tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('submenu', 'Submenu', 'required', [
            'required' => 'Sub Menu tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required', [
            'required' => 'URL tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('class', 'Class', 'required', [
            'required' => 'Class Method tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            if ($data['submenu'] != NULL) {
                $this->load->view('submenu-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $data = array(
                'MENU_ID'       => $this->input->post('menu'),
                'TITLE'         => $this->input->post('title'),
                'SUB_MENU'      => $this->input->post('submenu'),
                'URL'           => $this->input->post('url'),
                'CLASS_METHOD'  => $this->input->post('class'),
                'CHANGED_BY'    => get_session_name()
            );
            $this->Sub_menu_model->editSubMenu($data, $sub_menu_id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $data['menuid']     = $this->Menu_model->getMenuById($this->input->post('menu'))->row_array();
            $ket = 'Mengubah data <strong>' . $data['title'] . '</strong> dengan <strong>ID #' . $sub_menu_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Menu', 'UPDATE', 'primary', $ket);
            redirect('submenu');
        }
    }

    public function delete($sub_menu_id)
    {
        $sub_menu_id        = decrypt_url($sub_menu_id);
        $data['submenu']    = $this->Sub_menu_model->getSubMenuById($sub_menu_id)->row_array();

        $delete = $this->Sub_menu_model->deleteSubMenu($sub_menu_id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>Sub Menu</strong> dengan <strong>ID #' . $sub_menu_id  . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Menu', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('submenu');
    }

    public function change_status()
    {
        $id = $this->input->post('subMenuId');
        $active_id = $this->input->post('activeId');

        if ($active_id == 0) {
            $active_id = 1;
        } else if ($active_id == 1) {
            $active_id = 0;
        }

        $data = [
            'IS_ACTIVE' => $active_id
        ];
        $this->db->update('user_sub_menu', $data, array('ID' => $id));
        $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Sukses!</strong> Data berhasil diubah.
                    </div>';
        $this->session->set_flashdata('flash', $flash);
        $ket = 'Mengubah <strong>Status</strong> data <strong>Sub Menu</strong> dengan <strong>ID #' . $id . '</strong>';
        activity_log(get_session_id(), get_session_name(), 'Menu', 'UPDATE', 'primary', $ket);
    }
}
