<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Menu extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Menu_model');
    }

    public function index()
    {
        $data['ptitle'] = "Menu";
        $data['title']  = "Menu";

        $this->load->view('menu-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Menu_model->make_datatables();
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
            $sub_array[] = $row->ICON;
            $sub_array[] = '<div class="text-center">' . $row->SEQUENCE . '</div>';
            $edit = NULL;
            $del = NULL;

            if (check_button('edit') > 0) {
                $edit = '<a href="' . base_url('menu/edit/') . encrypt_url($row->ID) . '" class="btn btn-warning btn-sm waves-effect"><i class="ion ion-md-color-filter"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('menu/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('edit') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $edit . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Menu_model->get_all_data(),
            'recordsFiltered'   => $this->Menu_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "Menu";
        $data['title']  = "Menu";

        $this->form_validation->set_rules('menu', 'Menu', 'required', [
            'required' => 'Menu tidak boleh kosong'
        ]);

        $this->form_validation->set_rules('icon', 'Icon', 'required', [
            'required' => 'Icon tidak boleh kosong'
        ]);

        $this->form_validation->set_rules('sequence', 'Sequence', 'required|numeric|is_unique[user_menu.SEQUENCE]', [
            'required'      => 'Sequence tidak boleh kosong',
            'numeric'       => 'Sequence harus berupa angka',
            'is_unique'     => 'Sequence sudah ada'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('menu-add', $data);
        } else {
            cek_csrf();
            $data_menu = array(
                'MENU'          => $this->input->post('menu'),
                'ICON'          => $this->input->post('icon'),
                'SEQUENCE'      => $this->input->post('sequence'),
                'CREATED_BY'    => get_session_name(),
                'CREATED_ON'    => date('Y-m-d H:i:s'),
                'CHANGED_BY'    => get_session_name()
            );
            $add_id = $this->Menu_model->addMenu($data_menu);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>Menu</strong> dengan <strong>ID #' . $add_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Menu', 'ADD', 'success', $ket);
            redirect('menu');
        }
    }

    public function edit($menu_id)
    {
        $data['ptitle'] = "Menu";
        $data['title']  = "Menu";

        $menu_id = decrypt_url($menu_id);

        $data['menu']   = $this->Menu_model->getMenuById($menu_id)->row_array();
        if ($data['menu'] != NULL) {
            $menu_old       = $data['menu']['MENU'];

            if ($data['menu']['MENU'] != $this->input->post('menu')) {
                $this->form_validation->set_rules('menu', 'Menu', 'required|is_unique[user_menu.MENU]', [
                    'required'      => 'Role tidak boleh kosong',
                    'is_unique'     => 'Role sudah ada'
                ]);
            } else {
                $this->form_validation->set_rules('menu', 'menu', 'required', [
                    'required'      => 'Role tidak boleh kosong'
                ]);
            }

            $this->form_validation->set_rules('icon', 'Icon', 'required', [
                'required' => 'Icon tidak boleh kosong'
            ]);

            if ($data['menu']['SEQUENCE'] != $this->input->post('sequence')) {
                $this->form_validation->set_rules('sequence', 'Sequence', 'required|numeric|is_unique[user_menu.SEQUENCE]', [
                    'required'      => 'Sequence tidak boleh kosong',
                    'numeric'       => 'Sequence harus berupa angka',
                    'is_unique'     => 'Sequence sudah ada'
                ]);
            } else {
                $this->form_validation->set_rules('sequence', 'Sequence', 'required|numeric', [
                    'required'      => 'Urutan tidak boleh kosong',
                    'numeric'       => 'Sequence harus berupa angka'
                ]);
            }
        }

        if ($this->form_validation->run() == FALSE) {
            if ($data['menu'] != NULL) {
                $this->load->view('menu-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $data_menu = array(
                'MENU'          => $this->input->post('menu'),
                'ICON'          => $this->input->post('icon'),
                'SEQUENCE'      => $this->input->post('sequence'),
                'CHANGED_BY'    => get_session_name()
            );

            $this->Menu_model->editMenu($data_menu, $menu_id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah data <strong>Menu</strong> dengan <strong>ID #' . $menu_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Menu', 'UPDATE', 'primary', $ket);
            redirect('menu');
        }
    }

    public function delete($menu_id)
    {
        $menu_id = decrypt_url($menu_id);

        $data['menu']   = $this->Menu_model->getMenuById($menu_id)->row_array();

        $delete = $this->Menu_model->deleteMenu($menu_id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>Menu</strong> dengan <strong>ID #' . $menu_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Menu', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('menu');
    }
}
