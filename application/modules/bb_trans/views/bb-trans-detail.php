<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <style>
        .smalls,
        smalls {
            font-size: 90%;
        }

        .smalld,
        smalld {
            font-size: 60%;
        }
    </style>
</head>

<body data-sidebar="dark">

    <!-- Begin Page -->
    <div id="layout-wrapper">

        <?php $this->load->view('template/header'); ?>

        <!-- ========== Left Sidebar Start ========== -->
        <?php $this->load->view('template/menu'); ?>

        <!-- ============================================================== -->
        <!-- Content -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="page-title-box">
                        <div class="row align-items-center mb-2">
                            <div class="col-md-8">
                                <h6 class="page-title mb-0"><?= $ptitle; ?></h6>
                                <p class="card-text">#Detail Data <?= $title; ?></p>
                            </div>
                            <div class="col-md-4">
                                <div class="float-end d-none d-md-block">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-warning waves-effect waves-light" type="button" onclick="window.location.href = '<?= base_url('bb_trans'); ?>';">
                                            <i class="ion ion-md-arrow-back me-1"></i> Kembali
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <?= $this->session->flashdata('flash'); ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body border-bottom border-1">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-2">Model</dt>
                                            <dd class="col-sm-8 mb-0"><?= $file['MODEL_TEXT']; ?></dd>
                                        </dl>
                                        <dl class="row mb-0">
                                            <dt class="col-sm-2">Nama File</dt>
                                            <dd class="col-sm-8 mb-0"><?= $file['FILE']; ?></dd>
                                        </dl>
                                        <dl class="row mb-0">
                                            <dt class="col-sm-2">Upload By</dt>
                                            <dd class="col-sm-8 mb-0"><?= $file['CREATED_BY']; ?></dd>
                                        </dl>
                                        <dl class="row mb-0">
                                            <dt class="col-sm-2">Upload On</dt>
                                            <?php
                                            $tgl_out = date("Y-m-d", strtotime($file['CREATED_ON']));
                                            $jam_out = date("H:i:s", strtotime($file['CREATED_ON']));
                                            ?>
                                            <dd class="col-sm-8 mb-0"><?= tgl_indo($tgl_out) . " " . $jam_out; ?></dd>

                                        </dl>
                                    </div>
                                    <?php if ($file['MODEL'] == 1) { ?>
                                        <div class="card-body">
                                            <div class="input-group">
                                                <span class="input-group-text">Cari Data</span>
                                                <input type="text" class="form-control form-control-sm" placeholder="Masukkan Keyword" id="search">
                                                <button class="btn btn-sm light btn-dark" type="button" id="btn-reset"><i class="fa-solid fa-refresh me-1"></i>Reset</button>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="mytable" class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalls>#</smalls>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalls>Kode Pembangkit</smalls>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalls>Pembangkit</smalls>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalls>Pemasok</smalls>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalls>Waktu Selesai Unloading</smalls>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalls>GCV Unloading</smalls>
                                                        </th>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0;
                                                        $s = 1; ?>
                                                        <?php foreach ($sheet as $f) : ?>
                                                            <?php if ($s > 1) : ?>
                                                                <tr>
                                                                    <td class="p-1 text-center">
                                                                        <smalls><?= $i; ?>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalls><?= ($f['B'] != NULL ? $f['B'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalls><?= ($f['B'] != NULL ? get_pembangkit($f['B']) : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalls><?= ($f['E'] !== NULL ? $f['E'] : ($f['E'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalls>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalls><?= ($f['F'] !== NULL ? $f['F'] : ($f['F'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalls>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalls><?= ($f['G'] !== NULL ? $f['G'] : ($f['G'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalls>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                            <?php $i++;
                                                            $s++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } else if ($file['MODEL'] == 2) { ?>
                                        <div class="card-body">
                                            <div class="input-group">
                                                <span class="input-group-text">Cari Data</span>
                                                <input type="text" class="form-control form-control-sm" placeholder="Masukkan Keyword" id="search">
                                                <button class="btn btn-sm light btn-dark" type="button" id="btn-reset"><i class="fa-solid fa-refresh me-1"></i>Reset</button>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="mytable" class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>#</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>Skema</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>No Shipment</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Kode Pembangkit</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>Pembangkit</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>Pemasok</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Waktu Selesai Unloading</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Harga Dasar Batubara</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Tarif Dasar Transportasi</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Volume Kontrak Tahunan</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Tipikal Batubara</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>GCV Kontrak</smalld>
                                                        </th>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0;
                                                        $s = 1; ?>
                                                        <?php foreach ($sheet as $f) : ?>
                                                            <?php if ($s > 1) : ?>
                                                                <tr>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= $i; ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['A'] != NULL ? $f['A'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['B'] != NULL ? $f['B'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['D'] != NULL ? $f['D'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['D'] != NULL ? get_pembangkit($f['D']) : '<span class="text-danger">No data</span>'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['G'] != NULL ? $f['G'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['H'] !== NULL ? $f['H'] : ($f['H'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['I'] !== NULL ? $f['I'] : ($f['I'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['J'] !== NULL ? $f['J'] : ($f['J'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['K'] !== NULL ? $f['K'] : ($f['K'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['L'] !== NULL ? $f['L'] : ($f['L'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['M'] !== NULL ? $f['M'] : ($f['M'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                            <?php $i++;
                                                            $s++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } else if ($file['MODEL'] == 3) { ?>
                                        <div class="card-body">
                                            <div class="input-group">
                                                <span class="input-group-text">Cari Data</span>
                                                <input type="text" class="form-control form-control-sm" placeholder="Masukkan Keyword" id="search">
                                                <button class="btn btn-sm light btn-dark" type="button" id="btn-reset"><i class="fa-solid fa-refresh me-1"></i>Reset</button>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="mytable" class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>#</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>Skema</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>No Shipment</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Kode Pembangkit</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>Pembangkit</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>Pemasok</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Pemakaian Maksimal harian</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Volume Rakor</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Tgl Stok Akhir</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Stok Akhir</smalld>
                                                        </th>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0;
                                                        $s = 1; ?>
                                                        <?php foreach ($sheet as $f) : ?>
                                                            <?php if ($s > 1) : ?>
                                                                <tr>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= $i; ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['A'] != NULL ? $f['A'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['B'] != NULL ? $f['B'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['D'] != NULL ? $f['D'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['D'] != NULL ? get_pembangkit($f['D']) : '<span class="text-danger">No data</span>'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['G'] != NULL ? $f['G'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['H'] !== NULL ? $f['H'] : ($f['H'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['I'] !== NULL ? $f['I'] : ($f['I'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['J'] !== NULL ? $f['J'] : ($f['J'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['K'] !== NULL ? $f['K'] : ($f['K'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                            <?php $i++;
                                                            $s++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } else if ($file['MODEL'] == 4) { ?>
                                        <div class="card-body">
                                            <div class="input-group">
                                                <span class="input-group-text">Cari Data</span>
                                                <input type="text" class="form-control form-control-sm" placeholder="Masukkan Keyword" id="search">
                                                <button class="btn btn-sm light btn-dark" type="button" id="btn-reset"><i class="fa-solid fa-refresh me-1"></i>Reset</button>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="mytable" class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>#</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>Skema</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>No Shipment</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Kode Pembangkit</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>Pembangkit</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Pemakaian Maksimal harian</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Kapasitas Stockpile</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Minimum Stok</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>Pemasok</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>Nama Pelabuhan Muat</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>Nama Moda Transportasi</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>Jenis Moda Transportasi</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Kapasitas Moda Transportasi</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>Nama Transportir</smalld>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalld>Nama Pelabuhan Bongkar</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Harga Dasar Batubara</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Tarif Dasar Transportasi</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Volume Rakor</smalld>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalld>Waktu Selesai Unloading</smalld>
                                                        </th>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0;
                                                        $s = 1; ?>
                                                        <?php foreach ($sheet as $f) : ?>
                                                            <?php if ($s > 1) : ?>
                                                                <tr>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= $i; ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['A'] != NULL ? $f['A'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['B'] != NULL ? $f['B'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['D'] != NULL ? $f['D'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['D'] != NULL ? get_pembangkit($f['D']) : '<span class="text-danger">No data</span>'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['F'] !== NULL ? $f['F'] : ($f['F'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['G'] !== NULL ? $f['G'] : ($f['G'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['H'] !== NULL ? $f['H'] : ($f['H'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['J'] != NULL ? $f['J'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['K'] != NULL ? $f['K'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['L'] != NULL ? $f['L'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['M'] != NULL ? $f['M'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['N'] !== NULL ? $f['N'] : ($f['N'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['O'] != NULL ? $f['O'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <smalld><?= ($f['P'] != NULL ? $f['P'] : 'No data'); ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['Q'] !== NULL ? $f['Q'] : ($f['Q'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['R'] !== NULL ? $f['R'] : ($f['R'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['S'] !== NULL ? $f['S'] : ($f['S'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                    <td class="p-1 text-center">
                                                                        <smalld><?= ($f['T'] !== NULL ? $f['T'] : ($f['T'] === 0 ? '0' : '<span class="text-danger">No data</span>')) ?></smalld>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                            <?php $i++;
                                                            $s++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <?php $this->load->view('template/footer'); ?>
            </div>
            <!-- End Content-->

        </div>
        <!-- End Page -->

        <!-- JAVASCRIPT -->
        <?php $this->load->view('template/js'); ?>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script type="text/javascript">
            var token = "<?= $this->security->get_csrf_hash(); ?>";
            var table;

            $(document).ready(function() {
                table = $('#mytable').DataTable({
                    dom: "lrt" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    language: {
                        searchPlaceholder: 'Search...',
                        sSearch: '',
                        info: "_START_ - _END_ of _TOTAL_ data",
                        infoEmpty: "No data",
                        infoFiltered: "( Total _MAX_ data )"
                    },
                    "bLengthChange": false,
                    "ordering": false,
                    "pageLength": 10
                });
                $('#search').keyup(function() {
                    table.search($(this).val()).draw();
                })
                $('#btn-reset').click(function() {
                    $('#search').val('');
                    $('#mytable').DataTable().search(this.value).draw();
                });
            });
        </script>
</body>

</html>