<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
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
                                <h6 class="page-title mb-0"><?= $title; ?></h6>
                                <p class="card-text">#Detail <?= $title; ?></p>
                            </div>
                            <div class="col-md-4">
                                <div class="float-end d-none d-md-block">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-warning waves-effect waves-light" type="button" onclick="window.location.href = '<?= base_url('user/upload'); ?>';">
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
                                                    <a href="<?= base_url('user/exe_upload/') . $file['ID']; ?>" type="button" class="btn btn-primary btn-sm waves-effect"><i class="ion ion-ios-save me-1"></i>Eksekusi Data</a>
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
                                            <div class="tab-pane active p-3" id="excel" role="tabpanel">
                                                <table id="mytable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>NIP</th>
                                                        <th>USERNAME</th>
                                                        <th>FULLNAME</th>
                                                        <th>EMAIL</th>
                                                        <th>SHORT TITLE</th>
                                                        <th>SHORT ORG</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0;
                                                        $s = 1; ?>
                                                        <?php foreach ($sheet as $f) : ?>
                                                            <?php if ($s > 1) : ?>
                                                                <tr>
                                                                    <td><?= $i; ?></td>
                                                                    <td><?= $f['A']; ?></td>
                                                                    <td><?= $f['B']; ?></td>
                                                                    <td><?= $f['C']; ?></td>
                                                                    <td><?= $f['D']; ?></td>
                                                                    <td><?= $f['F']; ?></td>
                                                                    <td><?= get_parent_org($f['E']); ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                            <?php $i++;
                                                            $s++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php if ($file['STATUS'] == 'EXE') : ?>
                                                <div class="tab-pane p-3" id="upload" role="tabpanel">
                                                    <table id="mytable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                        <thead>
                                                            <th>#</th>
                                                            <th>NIP</th>
                                                            <th>USERNAME</th>
                                                            <th>FULLNAME</th>
                                                            <th>EMAIL</th>
                                                            <th>SHORT TITLE</th>
                                                            <th>SHORT ORG</th>
                                                            <th>TIPE</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 1; ?>
                                                            <?php foreach ($log as $f) : ?>
                                                                <tr>
                                                                    <td class="align-middle"><?= $i++; ?></td>
                                                                    <td class="align-middle"><?= $f['NIP']; ?></td>
                                                                    <td class="align-middle"><?= $f['USERNAME']; ?></td>
                                                                    <td class="align-middle"><?= $f['FULLNAME']; ?></td>
                                                                    <td class="align-middle"><?= $f['EMAIL']; ?></td>
                                                                    <td class="align-middle"><?= $f['SHORT_TITLE']; ?></td>
                                                                    <td class="align-middle"><?= get_parent_org($f['ORG_ID']); ?></td>
                                                                    <td class="align-middle">
                                                                        <?php if ($f['TIPE'] == 'INSERT') { ?>
                                                                            <span class="badge bg-sm bg-success">INSERT</span>
                                                                        <?php } else if ($f['TIPE'] == 'EXIST') { ?>
                                                                            <span class="badge bg-sm bg-danger">EXIST</span>
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