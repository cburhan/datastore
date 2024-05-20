<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Pembangkit extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Pembangkit_model');
        $this->load->model('kit_tipe/Kit_tipe_model');
        $this->load->model('kit_regional/Kit_regional_model');
        $this->load->model('kit_sistem/Kit_sistem_model');
    }

    public function index()
    {
        $data['ptitle'] = "Pembangkit";
        $data['title']  = "Pembangkit";

        $this->load->view('pembangkit-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Pembangkit_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<div class="text-center">' . $no . '</div>';
            $sub_array[] = $row->KODE_PEMBANGKIT;
            $sub_array[] = $row->NAMA_PEMBANGKIT;
            $sub_array[] = $row->DAYA_TERPASANG . ' MW';
            $sub_array[] = $row->REGIONAL;
            $sub_array[] = $row->SISTEM;
            if ($row->IS_ACTIVE == 1) {
                $sub_array[] = '<span class="badge bg-sm bg-success">AKTIF</span>';
            } else if ($row->IS_ACTIVE == 0) {
                $sub_array[] = '<span class="badge bg-sm bg-danger">TIDAK AKTIF</span>';
            }
            $detail = NULL;
            $edit = NULL;
            $del = NULL;

            if (check_button('detail') > 0) {
                $detail = '<a href="' . base_url('pembangkit/detail/') . encrypt_url($row->ID) . '" class="btn btn-info btn-sm waves-effect"><i class="ion ion-md-eye"></i></a>';
            }
            if (check_button('edit') > 0) {
                $edit = '<a href="' . base_url('pembangkit/edit/') . encrypt_url($row->ID) . '" class="btn btn-warning btn-sm waves-effect"><i class="ion ion-md-color-filter"></i></a>';
            }
            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('pembangkit/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('detail') > 0 || check_button('edit') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $detail . ' ' . $edit . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Pembangkit_model->get_all_data(),
            'recordsFiltered'   => $this->Pembangkit_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function add()
    {
        $data['ptitle'] = "Pembangkit";
        $data['title']  = "Pembangkit";

        $data['tipe']   = $this->Kit_tipe_model->getTipe()->result_array();
        $data['reg']    = $this->Kit_regional_model->getRegional()->result_array();
        $data['sis']    = $this->Kit_sistem_model->getSistem()->result_array();

        $this->form_validation->set_rules('tipe', 'Tipe', 'required', [
            'required'      => 'Tipe harus dipilih'
        ]);

        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required'      => 'Nama Pembangkit tidak boleh kosong'
        ]);

        $this->form_validation->set_rules('milik', 'Milik', 'required', [
            'required'      => 'Kepemilikan harus dipilih'
        ]);

        $this->form_validation->set_rules('sis', 'Sistem', 'required', [
            'required'      => 'Sistem Transmisi harus dipilih'
        ]);

        $this->form_validation->set_rules('reg', 'Reg', 'required', [
            'required'      => 'Regional harus dipilih'
        ]);

        $this->form_validation->set_rules('daya', 'Daya', 'required|numeric', [
            'required' => 'Daya Terpasang tidak boleh kosong',
            'numeric' => 'Daya Terpasang harus berupa angka'
        ]);

        $this->form_validation->set_rules('energi_primer[]', 'Energi Primer', 'required', [
            'required'      => 'Energi Primer harus dipilih minimal satu'
        ]);

        $data['is_bb'] = false;
        if ($this->input->post('energi_primer') != null) {
            if (in_array('batubara', $this->input->post('energi_primer'))) {
                $this->form_validation->set_rules('bbo', 'BBO', 'required', [
                    'required'      => 'ID BBO tidak boleh kosong'
                ]);
                $data['is_bb'] = true;
            } else {
                $data['is_bb'] = false;
            }
        }
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pembangkit-add', $data);
        } else {
            cek_csrf();
            $energi_primer  = $this->input->post('energi_primer');
            $tipe           = $this->Kit_tipe_model->getTipeById($this->input->post('tipe'))->row_array();
            $reg            = $this->Kit_regional_model->getRegionalById($this->input->post('reg'))->row_array();
            $sis            = $this->Kit_sistem_model->getSistemById($this->input->post('sis'))->row_array();

            $milik = $this->input->post('milik');
            if ($milik == 11) {
                $milik_label = 'PLN';
            } else if ($milik == 12) {
                $milik_label = 'PLN IP';
            } else if ($milik == 13) {
                $milik_label = 'PLN NP';
            } else if ($milik == 14) {
                $milik_label = 'IPP';
            }

            $data_kit = array(
                'KODE_PEMBANGKIT'   => generate_kode_pembangkit($this->input->post('milik')),
                'NAMA_PEMBANGKIT'   => strtoupper($this->input->post('nama')),
                'KEPEMILIKAN_ID'    => $milik,
                'KEPEMILIKAN'       => $milik_label,
                'DAYA_TERPASANG'    => $this->input->post('daya'),
                'IS_BATUBARA'       => in_array('batubara', $energi_primer) ? 1 : 0,
                'IS_GASPIPA'        => in_array('gaspipa', $energi_primer) ? 1 : 0,
                'IS_LNG'            => in_array('lng', $energi_primer) ? 1 : 0,
                'IS_BIOMASA'        => in_array('biomasa', $energi_primer) ? 1 : 0,
                'IS_BBM'            => in_array('bbm', $energi_primer) ? 1 : 0,
                'TIPE_ID'           => $this->input->post('tipe'),
                'TIPE'              => $tipe['TIPE'],
                'REGIONAL_ID'       => $this->input->post('reg'),
                'REGIONAL'          => $reg['REGIONAL'],
                'SISTEM_ID'         => $this->input->post('sis'),
                'SISTEM'            => $sis['SISTEM'],
                'ID_BBO'            => $this->input->post('bbo'),
                'SEQUENCE'          => seq_pembangkit(),
                'IS_ACTIVE'         => 1,
                'CREATED_BY'        => get_session_name(),
                'CREATED_ON'        => date('Y-m-d H:i:s'),
                'CHANGED_BY'        => get_session_name()
            );
            $add_id = $this->Pembangkit_model->addPembangkit($data_kit);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil ditambah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menambah data <strong>Pembangkit</strong> dengan <strong>ID #' . $add_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Pembangkit', 'ADD', 'success', $ket);
            redirect('pembangkit');
        }
    }

    public function edit($pembangkit_id)
    {
        $data['ptitle'] = "Pembangkit";
        $data['title']  = "Pembangkit";

        $pembangkit_id = decrypt_url($pembangkit_id);

        $data['kit']   = $this->Pembangkit_model->getPembangkitById($pembangkit_id)->row_array();
        $data['tipe']   = $this->Kit_tipe_model->getTipe()->result_array();
        $data['reg']    = $this->Kit_regional_model->getRegional()->result_array();
        $data['sis']    = $this->Kit_sistem_model->getSistem()->result_array();

        if ($data['kit'] != NULL) {
            $this->form_validation->set_rules('tipe', 'Tipe', 'required', [
                'required'      => 'Tipe harus dipilih'
            ]);

            if ($data['kit']['NAMA_PEMBANGKIT'] != $this->input->post('nama')) {
                $this->form_validation->set_rules('nama', 'Nama', 'required|is_unique[pembangkit.NAMA_PEMBANGKIT]', [
                    'required'      => 'Nama Pembangkit tidak boleh kosong',
                    'is_unique'     => 'Nama Pembangkit sudah ada'
                ]);
            } else {
                $this->form_validation->set_rules('nama', 'Nama', 'required', [
                    'required'      => 'Nama Pembangkit tidak boleh kosong'
                ]);
            }

            $this->form_validation->set_rules('milik', 'Milik', 'required', [
                'required'      => 'Kepemilikan harus dipilih'
            ]);

            $this->form_validation->set_rules('sis', 'Sistem', 'required', [
                'required'      => 'Sistem Transmisi harus dipilih'
            ]);

            $this->form_validation->set_rules('reg', 'Reg', 'required', [
                'required'      => 'Regional harus dipilih'
            ]);

            $this->form_validation->set_rules('daya', 'Daya', 'required|numeric', [
                'required' => 'Daya Terpasang tidak boleh kosong',
                'numeric' => 'Daya Terpasang harus berupa angka'
            ]);

            $this->form_validation->set_rules('energi_primer[]', 'Energi Primer', 'required', [
                'required'      => 'Energi Primer harus dipilih minimal satu'
            ]);
        }

        if ($this->form_validation->run() == FALSE) {
            if ($data['kit'] != NULL) {
                $this->load->view('pembangkit-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $energi_primer  = $this->input->post('energi_primer');
            $tipe           = $this->Kit_tipe_model->getTipeById($this->input->post('tipe'))->row_array();
            $reg            = $this->Kit_regional_model->getRegionalById($this->input->post('reg'))->row_array();
            $sis            = $this->Kit_sistem_model->getSistemById($this->input->post('sis'))->row_array();

            $milik = $this->input->post('milik');
            if ($milik == 11) {
                $milik_label = 'PLN';
            } else if ($milik == 12) {
                $milik_label = 'PLN IP';
            } else if ($milik == 13) {
                $milik_label = 'PLN NP';
            } else if ($milik == 14) {
                $milik_label = 'IPP';
            }

            $data_kit = array(
                'NAMA_PEMBANGKIT'   => strtoupper($this->input->post('nama')),
                'KEPEMILIKAN_ID'    => $milik,
                'KEPEMILIKAN'       => $milik_label,
                'DAYA_TERPASANG'    => $this->input->post('daya'),
                'IS_BATUBARA'       => in_array('batubara', $energi_primer) ? 1 : 0,
                'IS_GASPIPA'        => in_array('gaspipa', $energi_primer) ? 1 : 0,
                'IS_LNG'            => in_array('lng', $energi_primer) ? 1 : 0,
                'IS_BIOMASA'        => in_array('biomasa', $energi_primer) ? 1 : 0,
                'IS_BBM'            => in_array('bbm', $energi_primer) ? 1 : 0,
                'TIPE_ID'           => $this->input->post('tipe'),
                'TIPE'              => $tipe['TIPE'],
                'REGIONAL_ID'       => $this->input->post('reg'),
                'REGIONAL'          => $reg['REGIONAL'],
                'SISTEM_ID'         => $this->input->post('sis'),
                'SISTEM'            => $sis['SISTEM'],
                'ID_BBO'            => $this->input->post('bbo'),
                'IS_ACTIVE'         => $this->input->post('status'),
                'CHANGED_BY'        => get_session_name()
            );

            $this->Pembangkit_model->editPembangkit($data_kit, $pembangkit_id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah data <strong>Pembangkit</strong> dengan <strong>ID #' . $pembangkit_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Master', 'UPDATE', 'primary', $ket);
            redirect('pembangkit');
        }
    }

    public function detail($pembangkit_id)
    {
        $data['ptitle'] = "Pembangkit";
        $data['title']  = "Pembangkit";

        $pembangkit_id = decrypt_url($pembangkit_id);

        $data['kit']   = $this->Pembangkit_model->getPembangkitById($pembangkit_id)->row_array();

        if ($data['kit'] != NULL) {
            $this->load->view('pembangkit-detail', $data);
        } else {
            $this->load->view('myerror/error404', $data);
        }
    }

    public function delete($pembangkit_id)
    {
        $pembangkit_id = decrypt_url($pembangkit_id);

        $data['kit']   = $this->Pembangkit_model->getPembangkitById($pembangkit_id)->row_array();

        $delete = $this->Pembangkit_model->deletePembangkit($pembangkit_id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>Pembangkit</strong> dengan <strong>ID #' . $pembangkit_id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Master', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('pembangkit');
    }

    public function publish()
    {
        $pembangkit   = $this->Pembangkit_model->getPembangkit()->result_array();
        $date = date('Y-m-d H:i:s');

        $data_file = array(
            'PUBLISH_BY'        => get_session_name(),
            'PUBLISH_ON'        => $date
        );
        $file_id = $this->Pembangkit_model->addPembangkitPublishFile($data_file);

        foreach ($pembangkit as $kit) {
            $data_publish = array(
                'FILE_ID'           => $file_id,
                'KODE_PEMBANGKIT'   => $kit['KODE_PEMBANGKIT'],
                'TIPE'              => $kit['TIPE'],
                'NAMA_PEMBANGKIT'   => $kit['NAMA_PEMBANGKIT'],
                'KEPEMILIKAN'       => $kit['KEPEMILIKAN'],
                'DAYA_TERPASANG'    => $kit['DAYA_TERPASANG'],
                'SISTEM_TRANSMISI'  => $kit['SISTEM'],
                'REGIONAL'          => $kit['REGIONAL'],
                'IS_BATUBARA'       => $kit['IS_BATUBARA'],
                'IS_GASPIPA'        => $kit['IS_GASPIPA'],
                'IS_LNG'            => $kit['IS_LNG'],
                'IS_BIOMASA'        => $kit['IS_BIOMASA'],
                'IS_BBM'            => $kit['IS_BBM'],
                'ID_BBO'            => $kit['ID_BBO'],
                'IS_ACTIVE'         => $kit['IS_ACTIVE'],
                'PUBLISH_BY'        => get_session_name(),
                'PUBLISH_ON'        => $date
            );

            $this->Pembangkit_model->addPembangkitPublish($data_publish);
        }

        $publish = array();
        foreach ($pembangkit as $item) {
            $new_item = array(
                'KODE_PEMBANGKIT'   => $item['KODE_PEMBANGKIT'],
                'TIPE'              => $item['TIPE'],
                'NAMA_PEMBANGKIT'   => $item['NAMA_PEMBANGKIT'],
                'KEPEMILIKAN'       => $item['KEPEMILIKAN'],
                'DAYA_TERPASANG'    => $item['DAYA_TERPASANG'],
                'SISTEM_TRANSMISI'  => $item['SISTEM'],
                'REGIONAL'          => $item['REGIONAL'],
                'IS_BATUBARA'       => $item['IS_BATUBARA'],
                'IS_GASPIPA'        => $item['IS_GASPIPA'],
                'IS_LNG'            => $item['IS_LNG'],
                'IS_BIOMASA'        => $item['IS_BIOMASA'],
                'IS_BBM'            => $item['IS_BBM'],
                'ID_BBO'            => $item['ID_BBO'],
                'IS_ACTIVE'         => $item['IS_ACTIVE'],
                'PUBLISH_BY'        => get_session_name(),
                'PUBLISH_ON'        => $date
            );

            // Tambahkan array baru ke dalam array hasil
            $publish[] = $new_item;
        }

        //$publish   = $this->Pembangkit_model->getPembangkitPublish()->result_array();
        $date_name  = date('YmdHis', strtotime($date));
        $file_name  = $date_name . '_pembangkit.csv';

        $csv_file = 'public/publish/' . $file_name;

        $file = fopen($csv_file, 'w');

        fputcsv($file, array_keys($publish[0]));

        foreach ($publish as $row) {
            fputcsv($file, $row);
        }

        fclose($file);

        $data_file_update = array(
            'FILE'        => $file_name
        );
        $this->Pembangkit_model->editPembangkitPublishFile($data_file_update, $file_id);


        $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil dipublish.
                        </div>';
        $this->session->set_flashdata('flash', $flash);
        $ket = 'Mempublish data <strong>Pembangkit</strong>';
        activity_log(get_session_id(), get_session_name(), 'Pembangkit', 'PUBLISH', 'success', $ket);
        redirect('kit_publish');
    }
}
