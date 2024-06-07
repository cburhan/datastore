<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <style>
        .smalls,
        smalls {
            font-size: 75%;
        }

        .smalld,
        smalld {
            font-size: 70%;
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
                                <p class="card-text">#Detail Upload Data <?= $title; ?></p>
                            </div>
                            <div class="col-md-4">
                                <div class="float-end d-none d-md-block">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-warning waves-effect waves-light" type="button" onclick="window.location.href = '<?= base_url('kit_demand_tahunan/upload'); ?>';">
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
                                            <dt class="col-sm-2">Nama File</dt>
                                            <dd class="col-sm-10"><?= $file['FILE']; ?></dd>
                                            <dt class="col-sm-2">Upload</dt>
                                            <dd class="col-sm-10"><?= $file['UPLOAD_BY'] . ' - ' . date("d.m.Y H:i:s", strtotime($file['UPLOAD_ON'])); ?></dd>
                                            <?php if ($file['STATUS'] == "EXE") : ?>
                                                <dt class="col-sm-2">Execute</dt>
                                                <dd class="col-sm-10"><?= $file['EXECUTED_BY'] . ' - ' . date("d.m.Y H:i:s", strtotime($file['EXECUTED_ON'])); ?></dd>
                                            <?php endif; ?>
                                            <dt class="col-sm-2">Status</dt>
                                            <dd class="col-sm-10">
                                                <?php if ($file['STATUS'] == "INIT") : ?>
                                                    <span class="badge bg-sm bg-info"><?= $file['STATUS']; ?></span>
                                                <?php elseif ($file['STATUS'] == "EXE") : ?>
                                                    <span class="badge bg-sm bg-success"><?= $file['STATUS']; ?></span>
                                                <?php endif; ?>
                                            </dd>
                                            <?php if ($file['STATUS'] == "INIT") : ?>
                                                <dt class="col-sm-2">Action</dt>
                                                <dd class="col-sm-10">
                                                    <a href="<?= base_url('kit_demand_tahunan/exe_upload/') . encrypt_url($file['ID']); ?>" type="button" class="btn btn-primary btn-sm waves-effect"><i class="ion ion-ios-save me-1"></i>Eksekusi Data</a>
                                                </dd>
                                            <?php endif; ?>
                                        </dl>
                                    </div>
                                    <div class="card-body">
                                        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#excel" role="tab" aria-selected="true">
                                                    <span class="d-none d-md-block">Data Excel</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                                </a>
                                            </li>
                                            <?php if ($file['STATUS'] == 'EXE') : ?>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#upload" role="tab" aria-selected="false" tabindex="-1">
                                                        <span class="d-none d-md-block">Data Upload</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active table-responsive p-3" id="excel" role="tabpanel">
                                                <table class="table mb-0">
                                                    <thead>
                                                        <th class="text-center">
                                                            <smalls>Kode</smalls>
                                                        </th>
                                                        <th class="text-center">
                                                            <smalls>Pembangkit</smalls>
                                                        </th>
                                                        <th class="text-center">
                                                            <smalls>Sistem</smalls>
                                                        </th>
                                                        <th class="text-center" style="white-space: nowrap;">
                                                            <smalls>Bahan Bakar</smalls>
                                                        </th>
                                                        <th class="text-center">
                                                            <smalls>Kebutuhan Pembangkit</smalls>
                                                        </th>
                                                        <th class="text-center" style="white-space: nowrap;">
                                                            <smalls>CF (%)</smalls>
                                                        </th>
                                                        <th class="text-center">
                                                            <smalls>Tahun</smalls>
                                                        </th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $s = 1; ?>
                                                        <?php foreach ($sheet as $f) : ?>
                                                            <?php if ($s > 1) : ?>
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <smalld><?= $f['A']; ?></smalld>
                                                                    </td>
                                                                    <td style="white-space: nowrap;">
                                                                        <smalld><?= $f['B']; ?></smalld>
                                                                    </td>
                                                                    <td>
                                                                        <smalld><?= $f['C']; ?></smalld>
                                                                    </td>
                                                                    <td>
                                                                        <smalld><?= $f['D']; ?></smalld>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <smalld><?= $f['E']; ?></smalld>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <smalld><?= $f['F']; ?></smalld>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <smalld><?= $f['G']; ?></smalld>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                            <?php
                                                            $s++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php if ($file['STATUS'] == 'EXE') : ?>
                                                <div class="tab-pane table-responsive p-3" id="upload" role="tabpanel">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <th class="text-center">
                                                                <smalls>Kode</smalls>
                                                            </th>
                                                            <th class="text-center">
                                                                <smalls>Pembangkit</smalls>
                                                            </th>
                                                            <th class="text-center">
                                                                <smalls>Sistem</smalls>
                                                            </th>
                                                            <th class="text-center" style="white-space: nowrap;">
                                                                <smalls>Bahan Bakar</smalls>
                                                            </th>
                                                            <th class="text-center">
                                                                <smalls>Kebutuhan Pembangkit</smalls>
                                                            </th>
                                                            <th class="text-center" style="white-space: nowrap;">
                                                                <smalls>CF (%)</smalls>
                                                            </th>
                                                            <th class="text-center">
                                                                <smalls>Tahun</smalls>
                                                            </th>
                                                            <th class="text-center">
                                                                <smalls>Tipe</smalls>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($log as $f) : ?>
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <smalld><?= $f['KODE_PEMBANGKIT']; ?></smalld>
                                                                    </td>
                                                                    <td style="white-space: nowrap;">
                                                                        <smalld><?= $f['NAMA_PEMBANGKIT']; ?></smalld>
                                                                    </td>
                                                                    <td>
                                                                        <smalld><?= $f['SISTEM']; ?></smalld>
                                                                    </td>
                                                                    <td>
                                                                        <smalld><?= $f['BAHAN_BAKAR']; ?></smalld>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <smalld><?= $f['KEBUTUHAN_PEMBANGKIT']; ?></smalld>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <smalld><?= $f['CF']; ?></smalld>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <smalld><?= $f['TAHUN']; ?></smalld>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($f['TIPE'] == 'INSERT') { ?>
                                                                            <span class="badge bg-sm bg-success"><?= $f['TIPE']; ?></span>
                                                                        <?php } else if ($f['TIPE'] == 'EXIST') { ?>
                                                                            <span class="badge bg-sm bg-primary"><?= $f['TIPE']; ?></span>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
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
</body>

</html>