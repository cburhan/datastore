<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Rot extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Rot_model');
        $this->load->model('Rot_upload_model');
        $this->load->model('pembangkit/Pembangkit_model');
        $this->load->library('Excel');
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
            $sub_array[] = '<smalld>' . $row->KODE_PEMBANGKIT . '<smalld>';
            $sub_array[] = '<smalld>' . $row->NAMA_PEMBANGKIT . '<smalld>';
            $sub_array[] = '<smalld>' . $row->SISTEM . '<smalld>';
            $sub_array[] = '<smalld>' . $row->BAHAN_BAKAR . '<smalld>';
            $sub_array[] = '<smalld>' . $row->JAN . '<smalld>';
            $sub_array[] = '<smalld>' . $row->FEB . '<smalld>';
            $sub_array[] = '<smalld>' . $row->MAR . '<smalld>';
            $sub_array[] = '<smalld>' . $row->APR . '<smalld>';
            $sub_array[] = '<smalld>' . $row->MEI . '<smalld>';
            $sub_array[] = '<smalld>' . $row->JUN . '<smalld>';
            $sub_array[] = '<smalld>' . $row->JUL . '<smalld>';
            $sub_array[] = '<smalld>' . $row->AUG . '<smalld>';
            $sub_array[] = '<smalld>' . $row->SEP . '<smalld>';
            $sub_array[] = '<smalld>' . $row->OKT . '<smalld>';
            $sub_array[] = '<smalld>' . $row->NOV . '<smalld>';
            $sub_array[] = '<smalld>' . $row->DES . '<smalld>';
            $sub_array[] = '<smalld>' . $row->TAHUN . '<smalld>';
            $sub_array[] = '<smalld>' . $row->CF . '<smalld>';
            $del = NULL;
            $edit = NULL;

            if (check_button('edit') > 0) {
                $edit = '<a href="' . base_url('rot/edit/') . encrypt_url($row->ID) . '" class="btn btn-warning btn-sm waves-effect"><i class="ion ion-md-color-filter"></i></a>';
            }

            if (check_button('delete') > 0) {
                $del = '<a href="' . base_url('rot/delete/') . encrypt_url($row->ID) . '" class="btn btn-danger btn-sm waves-effect" onclick="return confirmDelete()"><i class="ion ion-md-trash"></i></a>';
            }
            if (check_button('edit') > 0 || check_button('delete') > 0) {
                $sub_array[] = '<div class="text-center">' . $edit . ' ' . $del . '</div>';
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

    public function edit($id)
    {
        $data['ptitle'] = "Rencana Operasi";
        $data['title']  = "ROT";

        $id = decrypt_url($id);

        $data['rot']    = $this->Rot_model->getRotById($id);

        $this->form_validation->set_rules('jan', 'Jan', 'required|numeric', [
            'required' => 'ROT bulan Januari tidak boleh kosong',
            'numeric' => 'ROT bulan Januari harus berupa angka'
        ]);

        $this->form_validation->set_rules('feb', 'Feb', 'required|numeric', [
            'required' => 'ROT bulan Februari tidak boleh kosong',
            'numeric' => 'ROT bulan Februari harus berupa angka'
        ]);

        $this->form_validation->set_rules('mar', 'Mar', 'required|numeric', [
            'required' => 'ROT bulan Maret tidak boleh kosong',
            'numeric' => 'ROT bulan Maret harus berupa angka'
        ]);

        $this->form_validation->set_rules('apr', 'Apr', 'required|numeric', [
            'required' => 'ROT bulan April tidak boleh kosong',
            'numeric' => 'ROT bulan April harus berupa angka'
        ]);

        $this->form_validation->set_rules('mei', 'Mei', 'required|numeric', [
            'required' => 'ROT bulan Mei tidak boleh kosong',
            'numeric' => 'ROT bulan Mei harus berupa angka'
        ]);

        $this->form_validation->set_rules('jun', 'Jun', 'required|numeric', [
            'required' => 'ROT bulan Juni tidak boleh kosong',
            'numeric' => 'ROT bulan Juni harus berupa angka'
        ]);

        $this->form_validation->set_rules('jul', 'Jul', 'required|numeric', [
            'required' => 'ROT bulan Juli tidak boleh kosong',
            'numeric' => 'ROT bulan Juli harus berupa angka'
        ]);

        $this->form_validation->set_rules('aug', 'Aug', 'required|numeric', [
            'required' => 'ROT bulan Agustus tidak boleh kosong',
            'numeric' => 'ROT bulan Agustus harus berupa angka'
        ]);

        $this->form_validation->set_rules('sep', 'Sep', 'required|numeric', [
            'required' => 'ROT bulan September tidak boleh kosong',
            'numeric' => 'ROT bulan September harus berupa angka'
        ]);

        $this->form_validation->set_rules('okt', 'Okt', 'required|numeric', [
            'required' => 'ROT bulan Oktober tidak boleh kosong',
            'numeric' => 'ROT bulan Oktober harus berupa angka'
        ]);

        $this->form_validation->set_rules('nov', 'Nov', 'required|numeric', [
            'required' => 'ROT bulan November tidak boleh kosong',
            'numeric' => 'ROT bulan November harus berupa angka'
        ]);

        $this->form_validation->set_rules('des', 'Des', 'required|numeric', [
            'required' => 'ROT bulan Desember tidak boleh kosong',
            'numeric' => 'ROT bulan Desember harus berupa angka'
        ]);

        $this->form_validation->set_rules('cf', 'Cf', 'required|numeric', [
            'required' => 'CF tidak boleh kosong',
            'numeric' => 'CF harus berupa angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            if ($data['rot'] != NULL) {
                $this->load->view('rot-edit', $data);
            } else {
                $this->load->view('myerror/error404', $data);
            }
        } else {
            cek_csrf();
            $data = array(
                'JAN'           => $this->input->post('jan'),
                'FEB'           => $this->input->post('feb'),
                'MAR'           => $this->input->post('mar'),
                'APR'           => $this->input->post('apr'),
                'MEI'           => $this->input->post('mei'),
                'JUN'           => $this->input->post('jun'),
                'JUL'           => $this->input->post('jul'),
                'AUG'           => $this->input->post('aug'),
                'SEP'           => $this->input->post('sep'),
                'OKT'           => $this->input->post('okt'),
                'NOV'           => $this->input->post('nov'),
                'DES'           => $this->input->post('des'),
                'CF'            => $this->input->post('cf'),
                'CHANGED_BY'    => get_session_name()
            );
            $this->Rot_model->editRot($data, $id);
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Mengubah data <strong>' . $data['title'] . '</strong> dengan <strong>ID #' . $id . '</strong>';
            activity_log(get_session_id(), get_session_name(), 'Rencana Operasi', 'UPDATE', 'primary', $ket);
            redirect('rot');
        }
    }

    public function delete($rot_id)
    {
        $rot_id = decrypt_url($rot_id);

        $rot   = $this->Rot_model->getRotById($rot_id);
        $delete = $this->Rot_model->deleteRot($rot_id);
        if ($delete) {
            $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Sukses!</strong> Data ROT berhasil dihapus.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            $ket = 'Menghapus data <strong>ROT</strong> <strong>' . $rot['TAHUN'] . '</strong> dengan ID #<strong>' . $rot_id . '</strong>';
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

    public function upload()
    {
        $data['ptitle'] = "Rencana Operasi";
        $data['title']  = "ROT";

        $data['file'] = $this->Rot_upload_model->file_uploaded()->result_array();

        $this->load->view('rot-upload', $data);
    }

    public function do_upload()
    {
        $this->load->library('excel');
        $upload_file = $_FILES['excel']['name'];
        if ($upload_file) {
            $config['upload_path']      = './public/upload_file/rot';
            $config['allowed_types']    = 'xls|xlsx';
            $config['remove_spaces']    = true;

            $time = date('Y-m-d H:i:s');
            $time_name = date('YmdHis', strtotime($time));
            $config['file_name']        = $time_name . '_ROT';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('excel')) {
                $file = $this->upload->data('file_name');
                $data = array(
                    'FILE'          => $file,
                    'STATUS'        => 'INIT',
                    'UPLOAD_ON'     => date('Y-m-d H:i:s'),
                    'UPLOAD_BY'     => get_session_name()
                );
                $add = $this->Rot_upload_model->add_upload($data);
                $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Sukses!</strong> File berhasil diupload.
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                redirect('rot/detail_upload/' . encrypt_url($add));
            } else {
                $error = $this->upload->display_errors();
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Gagal!</strong> ' . strip_tags($error) . '
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                redirect('rot/upload');
            }
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> File kosong.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            redirect('rot/upload');
        }
    }

    public function download_template()
    {
        $kit    = $this->Pembangkit_model->getPembangkit()->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'KODE_PEMBANGKIT');
        $sheet->setCellValue('B1', 'NAMA_PEMBANGKIT');
        $sheet->setCellValue('C1', 'SISTEM');
        $sheet->setCellValue('D1', 'BAHAN BAKAR');
        $sheet->setCellValue('E1', 'JAN');
        $sheet->setCellValue('F1', 'FEB');
        $sheet->setCellValue('G1', 'MAR');
        $sheet->setCellValue('H1', 'APR');
        $sheet->setCellValue('I1', 'MEI');
        $sheet->setCellValue('J1', 'JUN');
        $sheet->setCellValue('K1', 'JUL');
        $sheet->setCellValue('L1', 'AUG');
        $sheet->setCellValue('M1', 'SEP');
        $sheet->setCellValue('N1', 'OKT');
        $sheet->setCellValue('O1', 'NOV');
        $sheet->setCellValue('P1', 'DES');
        $sheet->setCellValue('Q1', 'TAHUN');
        $sheet->setCellValue('R1', 'CF (%)');

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

        $sheet->getStyle('A1:R1')->applyFromArray($styleArray);
        $maxRow = $sheet->getHighestRow();
        $rangeColumnA = 'A2:A' . $maxRow;
        $rangeColumnE = 'E2:R' . $maxRow;
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
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);
        $sheet->getColumnDimension('R')->setAutoSize(true);

        $sheet->setTitle('ROT');

        $filename = 'ROT_TEMPLATE.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function detail_upload($file_id)
    {
        $data['ptitle'] = "Rencana Operasi";
        $data['title']  = "ROT";

        $file_id = decrypt_url($file_id);

        $file = $this->Rot_upload_model->get_file_by_id($file_id);
        if ($file != NULL) {
            if ($file['STATUS'] == 'EXE') {
                $data['log'] = $this->Rot_upload_model->get_log_upload($file_id)->result_array();
            }
            $path = 'public/upload_file/rot/' . $file['FILE'];

            $this->load->library('Excel');
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($path);
            $data['sheet'] = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data['file'] = $file;

            $this->load->view('rot-detail-upload', $data);
        } else {
            $this->load->view('myerror/error404', $data);
        }
    }

    public function exe_upload($file_id)
    {
        $file_id = decrypt_url($file_id);
        $file = $this->Rot_upload_model->get_file_by_id($file_id);
        $path = 'public/upload_file/rot/' . $file['FILE'];

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

                $jan                = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $feb                = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $mar                = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                $apr                = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                $mei                = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                $jun                = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                $jul                = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                $aug                = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                $sep                = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                $okt                = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                $nov                = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                $des                = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                $tahun              = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                $cf                 = $worksheet->getCellByColumnAndRow(17, $row)->getValue();

                $p = $this->Rot_upload_model->get_not_kit($kode_pembangkit, $tahun);
                if ($p->num_rows() == 0) {
                    $data_insert = array(
                        'KODE_PEMBANGKIT'       => $kode_pembangkit,
                        'NAMA_PEMBANGKIT'       => $nama_pembangkit,
                        'SISTEM'                => $kit['SISTEM'],
                        'BAHAN_BAKAR'           => $bakar,
                        'JAN'                   => $jan,
                        'FEB'                   => $feb,
                        'MAR'                   => $mar,
                        'APR'                   => $apr,
                        'MEI'                   => $mei,
                        'JUN'                   => $jun,
                        'JUL'                   => $jul,
                        'AUG'                   => $aug,
                        'SEP'                   => $sep,
                        'OKT'                   => $okt,
                        'NOV'                   => $nov,
                        'DES'                   => $des,
                        'TAHUN'                 => $tahun,
                        'CF'                    => $cf,
                        'CREATED_BY'            => get_session_name(),
                        'CREATED_ON'            => date('Y-m-d H:i:s'),
                        'CHANGED_BY'            => get_session_name()
                    );
                    $this->Rot_model->addRot($data_insert);
                    $tipe = "INSERT";
                } else {
                    $data_update = array(
                        'KODE_PEMBANGKIT'       => $kode_pembangkit,
                        'NAMA_PEMBANGKIT'       => $nama_pembangkit,
                        'SISTEM'                => $kit['SISTEM'],
                        'BAHAN_BAKAR'           => $bakar,
                        'JAN'                   => $jan,
                        'FEB'                   => $feb,
                        'MAR'                   => $mar,
                        'APR'                   => $apr,
                        'MEI'                   => $mei,
                        'JUN'                   => $jun,
                        'JUL'                   => $jul,
                        'AUG'                   => $aug,
                        'SEP'                   => $sep,
                        'OKT'                   => $okt,
                        'NOV'                   => $nov,
                        'DES'                   => $des,
                        'TAHUN'                 => $tahun,
                        'CF'                    => $cf,
                        'CHANGED_BY'            => get_session_name()
                    );
                    $this->Rot_model->editRotByKode($data_update, $kode_pembangkit, $tahun);
                    $tipe = "EXIST";
                }
                $data_log = array(
                    'UPLOAD_ID'             => $file_id,
                    'KODE_PEMBANGKIT'       => $kode_pembangkit,
                    'NAMA_PEMBANGKIT'       => $nama_pembangkit,
                    'SISTEM'                => $kit['SISTEM'],
                    'BAHAN_BAKAR'           => $bakar,
                    'JAN'                   => $jan,
                    'FEB'                   => $feb,
                    'MAR'                   => $mar,
                    'APR'                   => $apr,
                    'MEI'                   => $mei,
                    'JUN'                   => $jun,
                    'JUL'                   => $jul,
                    'AUG'                   => $aug,
                    'SEP'                   => $sep,
                    'OKT'                   => $okt,
                    'NOV'                   => $nov,
                    'DES'                   => $des,
                    'TAHUN'                 => $tahun,
                    'CF'                    => $cf,
                    'TIPE'                  => $tipe
                );

                $this->Rot_upload_model->insert_log($data_log);
            }
        }

        $data_file = array(
            'STATUS'        => 'EXE',
            'EXECUTED_ON'     => date('Y-m-d H:i:s'),
            'EXECUTED_BY'     => get_session_name()
        );
        $this->Rot_upload_model->edit_upload($data_file, $file_id);
        $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Sukses!</strong> Data berhasil dieksekusi.
                    </div>';
        $this->session->set_flashdata('flash', $flash);
        redirect('rot/detail_upload/' . encrypt_url($file_id));
    }

    public function publish()
    {
        $rot        = $this->Rot_model->getRot()->result_array();
        if ($rot != NULL) {
            $publish_on = date('Y-m-d H:i:s');

            $token      = get_token();
            $db         = api()['DATABASE'];
            $schema     = api()['SCHEMA'];
            $table      = 'DATASTORE_MANUAL_ROT';
            $table_name = $db . '.' . $schema . '.' . $table;

            if ($token) {
                foreach ($rot as $d) {
                    $data[] = [
                        'ID'                => $d['ID'],
                        'KODE_PEMBANGKIT'   => $d['KODE_PEMBANGKIT'],
                        'NAMA_PEMBANGKIT'   => $d['NAMA_PEMBANGKIT'],
                        'SISTEM'            => $d['SISTEM'],
                        'BAHAN_BAKAR'       => $d['BAHAN_BAKAR'],
                        'JAN'               => $d['JAN'],
                        'FEB'               => $d['FEB'],
                        'MAR'               => $d['MAR'],
                        'APR'               => $d['APR'],
                        'MEI'               => $d['MEI'],
                        'JUN'               => $d['JUN'],
                        'JUL'               => $d['JUL'],
                        'AUG'               => $d['AUG'],
                        'SEP'               => $d['SEP'],
                        'OKT'               => $d['OKT'],
                        'NOV'               => $d['NOV'],
                        'DES'               => $d['DES'],
                        'TAHUN'             => $d['TAHUN'],
                        'CF'                => $d['CF'],
                        'CREATED_BY'        => $d['CREATED_BY'],
                        'CREATED_ON'        => $d['CREATED_ON'],
                        'CHANGED_BY'        => $d['CHANGED_BY'],
                        'CHANGED_ON'        => $d['CHANGED_ON'],
                        'PUBLISH_ON'        => $publish_on,
                        'SOURCE'            => 'DATASTORE_MANUAL_ROT'
                    ];
                }
                insert_data($token, $table_name, $data);
                $flash = '<div class="alert alert-success alert-dismissible bg-success text-white border-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Sukses!</strong> Data berhasil dipublish di Snowflake!
            </div>';
                $this->session->set_flashdata('flash', $flash);
                $ket = 'Mempublish data <strong>ROT</strong> ke <strong>Snowflake</strong>';
                activity_log(get_session_id(), get_session_name(), 'Rencana Operasi', 'PUBLISH', 'success', $ket);
                redirect('rot');
            } else {
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Token tidak berhasil digenerate.
                        </div>';
                $this->session->set_flashdata('flash', $flash);
                redirect('rot');
            }
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> Tidak ada data. Silahkan tambah data terlebih dahulu.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            redirect('rot');
        }
    }
}
