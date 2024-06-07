<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kit_demand_bulanan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Kit_demand_bulanan_model');
        $this->load->model('Kit_demand_bulanan_upload_model');
        $this->load->model('pembangkit/Pembangkit_model');
        $this->load->library('Excel');
    }

    public function index()
    {
        $data['ptitle'] = "Demand Pembangkit";
        $data['title']  = "Bulanan";

        $this->load->view('kit-demand-bulanan-view', $data);
    }

    public function get_data()
    {
        $fetch_data = $this->Kit_demand_bulanan_model->make_datatables();
        $data = array();

        $no = 0;

        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }

        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = '<smalld>' . $row->KODE_PEMBANGKIT . '<smalld>';
            $sub_array[] = '<smalld>' . $row->NAMA_PEMBANGKIT . '<smalld>';
            $sub_array[] = '<smalld>' . $row->SISTEM . '<smalld>';
            $sub_array[] = '<smalld>' . $row->BAHAN_BAKAR . '<smalld>';
            $sub_array[] = '<smalld>' . $row->KEBUTUHAN_PEMBANGKIT . '<smalld>';
            $sub_array[] = '<smalld>' . $row->CF . '<smalld>';
            $sub_array[] = '<smalld>' . bulan2($row->BULAN) . '<smalld>';
            $sub_array[] = '<smalld>' . $row->TAHUN . '<smalld>';
            $del = NULL;
            $edit = NULL;

            if (check_button('edit') > 0) {
                $edit = '<a href="' . base_url('kit_demand_bulanan/edit/') . encrypt_url($row->ID) . '" class="btn btn-warning btn-sm waves-effect"><i class="ion ion-md-color-filter"></i></a>';
            }

            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('kit_demand_bulanan/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('edit') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $edit . ' ' . $del . '</div>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            'draw'              => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            'recordsTotal'      => $this->Kit_demand_bulanan_model->get_all_data(),
            'recordsFiltered'   => $this->Kit_demand_bulanan_model->get_filtered_data(),
            'data'              => $data
        );

        echo json_encode($output);
    }

    public function edit($id)
    {
        $data['ptitle'] = "Demand Pembangkit";
        $data['title']  = "Bulanan";

        $id = decrypt_url($id);

        $data['demand']    = $this->Kit_demand_bulanan_model->getKitDemandBulananById($id);

        $this->form_validation->set_rules('demand', 'Demand', 'required|numeric', [
            'required' => 'Kebutuhan Pembangkit tidak boleh kosong',
            'numeric' => 'Kebutuhan Pembangkit harus berupa angka'
        ]);

        $this->form_validation->set_rules('cf', 'Cf', 'required|numeric', [
            'required' => 'CF tidak boleh kosong',
            'numeric' => 'CF harus berupa angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            if ($data['demand'] != NULL) {
                $this->load->view('kit-demand-bulanan-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $data = array(
                'KEBUTUHAN_PEMBANGKIT'  => $this->input->post('demand'),
                'CF'                    => $this->input->post('cf'),
                'CHANGED_BY'            => get_session_name()
            );
            $this->Kit_demand_bulanan_model->editKitDemandbulanan($data, $id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah data <strong>Demand Pembangkit ' . $data['title'] . '</strong> dengan <strong>ID #' . $id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Demand Pembangkit', 'UPDATE', 'primary', $ket);
            redirect('kit_demand_bulanan');
        }
    }

    public function delete($id)
    {
        $id = decrypt_url($id);

        $demand = $this->Kit_demand_bulanan_model->getKitDemandBulananById($id);
        $delete = $this->Kit_demand_bulanan_model->deleteKitDemandBulanan($id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data Demand Pembangkit bulanan berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>Demand Pembangkit Periode</strong> <strong>' . bulan($demand['BULAN']) . ' ' . $demand['TAHUN'] . '</strong> dengan ID #<strong>' . $id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Demand Pembangkit', 'DELETE', 'danger', $ket);
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Data Demand Pembangkit Bulanan masih digunakan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
        }
        redirect('kit_demand_bulanan');
    }

    public function upload()
    {
        $data['ptitle'] = "Demand Pembangkit";
        $data['title']  = "Bulanan";

        $data['file'] = $this->Kit_demand_bulanan_upload_model->file_uploaded()->result_array();

        $this->load->view('kit-demand-bulanan-upload', $data);
    }

    public function do_upload()
    {
        $this->load->library('excel');
        $upload_file = $_FILES['excel']['name'];
        if ($upload_file) {
            $config['upload_path']      = './public/upload_file/demand_bulanan';
            $config['allowed_types']    = 'xls|xlsx';
            $config['remove_spaces']    = true;

            $time = date('Y-m-d H:i:s');
            $time_name = date('YmdHis', strtotime($time));
            $config['file_name']        = $time_name . '_DEMAND_BULANAN';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('excel')) {
                $file = $this->upload->data('file_name');
                $data = array(
                    'FILE'          => $file,
                    'STATUS'        => 'INIT',
                    'UPLOAD_ON'     => date('Y-m-d H:i:s'),
                    'UPLOAD_BY'     => get_session_name()
                );
                $add = $this->Kit_demand_bulanan_upload_model->add_upload($data);
                $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Sukses!</strong> File berhasil diupload.
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                redirect('kit_demand_bulanan/detail_upload/' . encrypt_url($add));
            } else {
                $error = $this->upload->display_errors();
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Gagal!</strong> ' . strip_tags($error) . '
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                redirect('kit_demand_bulanan/upload');
            }
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> File kosong.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            redirect('kit_demand_bulanan/upload');
        }
    }

    public function download_template()
    {
        $kit    = $this->Pembangkit_model->getPembangkitBatubara()->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'KODE_PEMBANGKIT');
        $sheet->setCellValue('B1', 'NAMA_PEMBANGKIT');
        $sheet->setCellValue('C1', 'SISTEM');
        $sheet->setCellValue('D1', 'BAHAN BAKAR');
        $sheet->setCellValue('E1', 'KEBUTUHAN PEMBANGKIT');
        $sheet->setCellValue('F1', 'CF (%)');
        $sheet->setCellValue('G1', 'BULAN');
        $sheet->setCellValue('H1', 'TAHUN');
        $row = 2;
        foreach ($kit as $data) {
            $sheet->setCellValue('A' . $row, $data['KODE_PEMBANGKIT']);
            $sheet->setCellValue('B' . $row, $data['NAMA_PEMBANGKIT']);
            $sheet->setCellValue('C' . $row, $data['SISTEM']);

            $kolomD = '';
            if ($data['IS_BATUBARA'] == 1) {
                $kolomD = "BATUBARA";
            } elseif ($data['IS_GASPIPA'] == 1 && $data['IS_LNG'] == 1) {
                $kolomD = "GAS PIPA, LNG";
            } elseif ($data['IS_GASPIPA'] == 1) {
                $kolomD = "GAS PIPA";
            } elseif ($data['IS_LNG'] == 1) {
                $kolomD = "LNG";
            }
            $sheet->setCellValue('D' . $row, $kolomD);

            $row++;
        }

        // Menambahkan style
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'D9E1F2',
                ],
            ],
        ];

        $sheet->getStyle('A1:H1')->applyFromArray($styleArray);
        $maxRow = $sheet->getHighestRow();
        $rangeColumnA = 'A2:A' . $maxRow;
        $rangeColumnE = 'E2:H' . $maxRow;
        $sheet->getStyle($rangeColumnA)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($rangeColumnE)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);

        $sheet->setTitle('DEMAND_BULANAN');

        $filename = 'DEMAND_BULANAN_TEMPLATE.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function detail_upload($file_id)
    {
        $data['ptitle'] = "Demand Pembangkit";
        $data['title']  = "Bulanan";

        $file_id = decrypt_url($file_id);

        $file = $this->Kit_demand_bulanan_upload_model->get_file_by_id($file_id);
        if ($file != NULL) {
            if ($file['STATUS'] == 'EXE') {
                $data['log'] = $this->Kit_demand_bulanan_upload_model->get_log_upload($file_id)->result_array();
            }
            $path = 'public/upload_file/demand_bulanan/' . $file['FILE'];

            $this->load->library('Excel');
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($path);
            $data['sheet'] = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data['file'] = $file;

            $this->load->view('kit-demand-bulanan-detail-upload', $data);
        } else {
            $this->load->view('myerror/error404', $data);
        }
    }

    public function exe_upload($file_id)
    {
        $file_id = decrypt_url($file_id);
        $file = $this->Kit_demand_bulanan_upload_model->get_file_by_id($file_id);
        $path = 'public/upload_file/demand_bulanan/' . $file['FILE'];

        $this->load->library('excel');
        $object = PHPExcel_IOFactory::load($path);
        foreach ($object->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            for ($row = 2; $row <= $highestRow; $row++) {
                $kode_pembangkit    = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $nama_pembangkit    = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $kit                = $this->Pembangkit_model->getPembangkitByKode($kode_pembangkit)->row_array();

                if ($kit['IS_BATUBARA'] == 1) {
                    $bakar = "BATUBARA";
                } elseif ($kit['IS_GASPIPA'] == 1 && $kit['IS_LNG'] == 1) {
                    $bakar = "GAS PIPA, LNG";
                } elseif ($kit['IS_GASPIPA'] == 1) {
                    $bakar = "GAS PIPA";
                } elseif ($kit['IS_LNG'] == 1) {
                    $bakar = "LNG";
                }

                $demand = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $cf     = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $bulan  = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                $tahun  = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

                $p = $this->Kit_demand_bulanan_upload_model->get_not_kit($kode_pembangkit, $tahun, $bulan);
                if ($p->num_rows() == 0) {
                    $data_insert = array(
                        'KODE_PEMBANGKIT'       => $kode_pembangkit,
                        'NAMA_PEMBANGKIT'       => $nama_pembangkit,
                        'SISTEM'                => $kit['SISTEM'],
                        'BAHAN_BAKAR'           => $bakar,
                        'KEBUTUHAN_PEMBANGKIT'  => $demand,
                        'CF'                    => $cf,
                        'BULAN'                 => $bulan,
                        'TAHUN'                 => $tahun,
                        'CREATED_BY'            => get_session_name(),
                        'CREATED_ON'            => date('Y-m-d H:i:s'),
                        'CHANGED_BY'            => get_session_name()
                    );
                    $this->Kit_demand_bulanan_model->addKitDemandbulanan($data_insert);
                    $tipe = "INSERT";
                } else {
                    $data_update = array(
                        'KODE_PEMBANGKIT'       => $kode_pembangkit,
                        'NAMA_PEMBANGKIT'       => $nama_pembangkit,
                        'SISTEM'                => $kit['SISTEM'],
                        'BAHAN_BAKAR'           => $bakar,
                        'KEBUTUHAN_PEMBANGKIT'  => $demand,
                        'CF'                    => $cf,
                        'BULAN'                 => $bulan,
                        'TAHUN'                 => $tahun,
                        'CHANGED_BY'            => get_session_name()
                    );
                    $this->Kit_demand_bulanan_model->editKitDemandbulananByKode($data_update, $kode_pembangkit, $bulan, $tahun);
                    $tipe = "EXIST";
                }
                $data_log = array(
                    'UPLOAD_ID'             => $file_id,
                    'KODE_PEMBANGKIT'       => $kode_pembangkit,
                    'NAMA_PEMBANGKIT'       => $nama_pembangkit,
                    'SISTEM'                => $kit['SISTEM'],
                    'BAHAN_BAKAR'           => $bakar,
                    'KEBUTUHAN_PEMBANGKIT'  => $demand,
                    'CF'                    => $cf,
                    'BULAN'                 => $bulan,
                    'TAHUN'                 => $tahun,
                    'TIPE'                  => $tipe
                );

                $this->Kit_demand_bulanan_upload_model->insert_log($data_log);
            }
        }

        $data_file = array(
            'STATUS'          => 'EXE',
            'EXECUTED_ON'     => date('Y-m-d H:i:s'),
            'EXECUTED_BY'     => get_session_name()
        );
        $this->Kit_demand_bulanan_upload_model->edit_upload($data_file, $file_id);
        $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Sukses!</strong> Data berhasil dieksekusi.
                    </div>';
        $this->session->set_flashdata('flash', $flash);
        redirect('kit_demand_bulanan/detail_upload/' . encrypt_url($file_id));
    }

    public function publish()
    {
        $demand     = $this->Kit_demand_bulanan_model->getKitDemandBulanan()->result_array();
        if ($demand != NULL) {
            $publish_on = date('Y-m-d H:i:s');

            $token      = get_token();
            $db         = api()['DATABASE'];
            $schema     = api()['SCHEMA'];
            $table      = 'DATASTORE_MANUAL_KITDEMANDBULANAN';
            $table_name = $db . '.' . $schema . '.' . $table;

            if ($token) {
                foreach ($demand as $d) {
                    $data[] = [
                        'ID'                    => $d['ID'],
                        'KODE_PEMBANGKIT'       => $d['KODE_PEMBANGKIT'],
                        'NAMA_PEMBANGKIT'       => $d['NAMA_PEMBANGKIT'],
                        'SISTEM'                => $d['SISTEM'],
                        'BAHAN_BAKAR'           => $d['BAHAN_BAKAR'],
                        'KEBUTUHAN_PEMBANGKIT'  => $d['KEBUTUHAN_PEMBANGKIT'],
                        'CF'                    => $d['CF'],
                        'BULAN'                 => $d['BULAN'],
                        'TAHUN'                 => $d['TAHUN'],
                        'CREATED_BY'            => $d['CREATED_BY'],
                        'CREATED_ON'            => $d['CREATED_ON'],
                        'CHANGED_BY'            => $d['CHANGED_BY'],
                        'CHANGED_ON'            => $d['CHANGED_ON'],
                        'PUBLISH_ON'            => $publish_on,
                        'SOURCE'                => 'DATASTORE_MANUAL_KITDEMANDBULANAN'
                    ];
                }
                insert_data($token, $table_name, $data);
                $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Sukses!</strong> Data berhasil dipublish di Snowflake!
            </div>';
                $this->session->set_flashdata('flash', $flash);
                $ket = 'Mempublish data <strong>Demand Pembangkit Bulanan</strong> ke <strong>Snowflake</strong>';
                activity_log(get_session_id(), get_session_name(), 'Demand Pembangkit', 'PUBLISH', 'success', $ket);
                redirect('kit_demand_bulanan');
            } else {
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Token tidak berhasil digenerate.
                        </div>';
                $this->session->set_flashdata('flash', $flash);
                redirect('kit_demand_bulanan');
            }
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Tidak ada data. Silahkan tambah data terlebih dahulu.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            redirect('kit_demand_bulanan');
        }
    }
}