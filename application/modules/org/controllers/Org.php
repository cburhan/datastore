<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Org extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Org_model');
    }

    public function index()
    {
        $data['ptitle']     = "Master";
        $data['title']      = "Organisasi";

        $this->load->view('org-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Org_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<div class="text-center"><small>' . $no . '</small></div>';
            $sub_array[] = '<small>' . $row->SHORT_ORG . '</small>';
            $sub_array[] = '<small>' . $row->LONG_ORG . '</small>';
            $sub_array[] = ($row->PARENT_ID != NULL ? '<small>' . get_parent_org($row->PARENT_ID) . '</small>' : '<small>-</small>');
            if ($row->IS_ACTIVE == 1) {
                $sub_array[] = '<span class="badge bg-sm bg-success">AKTIF</span>';
            } else if ($row->IS_ACTIVE == 0) {
                $sub_array[] = '<span class="badge bg-sm bg-danger">TIDAK AKTIF</span>';
            }

            $edit = NULL;
            $del = NULL;

            if (check_button('edit') > 0) {
                $edit = '<a href="' . base_url('org/edit/') . encrypt_url($row->ID) . '" class="btn btn-warning btn-sm waves-effect"><i class="ion ion-md-color-filter"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('org/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('edit') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $edit . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Org_model->get_all_data(),
            'recordsFiltered'   => $this->Org_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle']     = "Master";
        $data['title']      = "Organisasi";

        $data['lvl_1']      = $this->Org_model->getOrgByLevel(1);
        $data['org']        = $this->Org_model->getOrg()->result_array();

        $this->form_validation->set_rules('short', 'Short', 'required|is_unique[org.SHORT_ORG]', [
            'required'      => 'Short Organisasi tidak boleh kosong',
            'is_unique'     => 'Short Organisasi sudah ada'
        ]);

        $this->form_validation->set_rules('long', 'Long', 'required|is_unique[org.LONG_ORG]', [
            'required'      => 'Long Organisasi tidak boleh kosong',
            'is_unique'     => 'Long Organisasi sudah ada'
        ]);

        $this->form_validation->set_rules('lvl1', 'lvl1', 'required', [
            'required'      => 'Organisasi harus dipilih'
        ]);

        $lvl = NULL;
        if ($this->input->post('lvl1') != NULL && $this->input->post('lvl2') == NULL) {
            $lvl = $this->input->post('lvl1');
        } else if ($this->input->post('lvl2') != NULL && $this->input->post('lvl3') == NULL) {
            $lvl = $this->input->post('lvl2');
        } else if ($this->input->post('lvl3') != NULL && $this->input->post('lvl4') == NULL) {
            $lvl = $this->input->post('lvl3');
        } else if ($this->input->post('lvl4') != NULL && $this->input->post('lvl5') == NULL) {
            $lvl = $this->input->post('lvl4');
        } else if ($this->input->post('lvl4') != NULL && $this->input->post('lvl5') != NULL) {
            $lvl = $this->input->post('lvl5');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('org-add', $data);
        } else {
            cek_csrf();
            $data = array(
                'SHORT_ORG'     => $this->input->post('short'),
                'LONG_ORG'      => $this->input->post('long'),
                'PARENT_ID'     => $lvl,
                'LEVEL'         => $lvl + 1,
                'IS_ACTIVE'     => 1,
                'CREATED_BY'    => get_session_name(),
                'CREATED_ON'    => date('Y-m-d H:i:s'),
                'CHANGED_BY'    => get_session_name()
            );
            $add_id = $this->Org_model->addOrg($data);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>Master Organisasi</strong> dengan <strong>ID #' . $add_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Master', 'ADD', 'success', $ket);
            redirect('org');
        }
    }

    public function edit($org_id = NULL)
    {
        $data['ptitle']     = "Master";
        $data['title']      = "Organisasi";

        $org_id = decrypt_url($org_id);

        $data['orgs']   = $this->Org_model->getOrgById($org_id)->row_array();
        $data['orgz'] = $this->Org_model->get_parent_by_child($org_id);

        if ($data['orgs'] != NULL) {
            if ($data['orgs']['SHORT_ORG'] != $this->input->post('short')) {
                $this->form_validation->set_rules('short', 'short', 'required|is_unique[org.SHORT_ORG]', [
                    'required'      => 'Short Organisasi tidak boleh kosong',
                    'is_unique'     => 'Short Organisasi sudah ada'
                ]);
            } else {
                $this->form_validation->set_rules('short', 'short', 'required', [
                    'required'      => 'Short Organisasi tidak boleh kosong'
                ]);
            }

            if ($data['orgs']['LONG_ORG'] != $this->input->post('long')) {
                $this->form_validation->set_rules('long', 'long', 'required|is_unique[org.LONG_ORG]', [
                    'required'      => 'Long Organisasi tidak boleh kosong',
                    'is_unique'     => 'Long Organisasi sudah ada'
                ]);
            } else {
                $this->form_validation->set_rules('long', 'long', 'required', [
                    'required'      => 'Long Organisasi tidak boleh kosong'
                ]);
            }

            $this->form_validation->set_rules('status', 'Status', 'required', [
                'required' => 'Status harus dipilih'
            ]);
        }

        if ($this->form_validation->run() == FALSE) {
            if ($data['orgs'] != NULL) {
                $this->load->view('org-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $data = array(
                'SHORT_ORG'     => $this->input->post('short'),
                'LONG_ORG'      => $this->input->post('long'),
                'IS_ACTIVE'     => $this->input->post('status'),
                'CHANGED_BY'    => get_session_name()
            );

            $this->Org_model->editOrg($data, $org_id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah data <strong>Master Organisasi</strong> dengan <strong>ID #' . $org_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Master', 'UPDATE', 'primary', $ket);
            redirect('org');
        }
    }

    public function delete($org_id = NULL)
    {
        $org_id        = decrypt_url($org_id);
        $data['org']   = $this->Org_model->getOrgById($org_id);

        if ($data['org'] == NULL) {
            redirect('error404');
        } else {
            $delete     = $this->Org_model->deleteOrg($org_id);
            if ($delete) {
                $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Sukses!</strong> Data berhasil dihapus.
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                $ket = 'Menghapus data <strong>Master Organisasi</strong> dengan <strong>ID #' . $org_id . '</strong>';
                activity_log(get_session_id(), get_session_name(), 'Master', 'DELETE', 'danger', $ket);
            } else {
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Gagal!</strong> Data masih digunakan.
                            </div>';
                $this->session->set_flashdata('flash', $flash);
            }
            redirect('org');
        }
    }
}
