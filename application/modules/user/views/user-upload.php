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
                                <p class="card-text">#List Data <?= $title; ?></p>
                            </div>
                            <?php if (check_button('upload') > 0) {
                            ?>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#uploadfile">
                                                <i class="ion ion-md-cloud-upload me-1"></i> Upload Data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            ?>
                        </div>
                        <!-- end page title -->
                        <?= $this->session->flashdata('flash'); ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="mytable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 25px;">#</th>
                                                    <th>File</th>
                                                    <th>Created On</th>
                                                    <th>Created By</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($file != NULL) { ?>
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($file as $f) : ?>
                                                        <tr>
                                                            <td class="align-middle"><?= $i++; ?></td>
                                                            <td class="align-middle"><?= $f['FILE']; ?></td>
                                                            <td class="align-middle"><?= date("d.m.Y H:i:s", strtotime($f['CREATED_ON'])); ?></td>
                                                            <td class="align-middle"><?= $f['CREATED_BY']; ?></td>
                                                            <td class="text-center align-middle">
                                                                <?php if ($f['STATUS'] == "INIT") : ?>
                                                                    <span class="badge bg-sm bg-primary"><?= $f['STATUS']; ?></span>
                                                                <?php elseif ($f['STATUS'] == "EXE") : ?>
                                                                    <span class="badge bg-sm bg-success"><?= $f['STATUS']; ?></span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <a href="<?= base_url('user/detail_upload/') . encrypt_url($f['ID']); ?>" class="btn btn-info btn-sm waves-effect"><i class="ion ion-md-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php } else { ?>
                                                    <tr class="odd">
                                                        <td valign="top" colspan="6" class="text-center">Tidak ada data</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
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

        <?php if (check_button('upload') > 0) { ?>
            <div class="modal fade" id="uploadfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadfile">Upload Data
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('user/do_upload/'); ?>" enctype="multipart/form-data">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <div class="row mb-3">
                                    <label class="col-sm-2 offset-sm-1 col-form-label">File</label>
                                    <div class="col-sm-8">
                                        <div class="form-control-wrap">
                                            <input class="form-control form-file-input" name="excel" id="customFile" type="file" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 offset-sm-1 col-form-label">Template</label>
                                    <div class="col-sm-8">
                                        <button type="button" class="btn btn-sm btn-info" onclick="window.location.href = '<?= base_url('user/download_template'); ?>';"><i class="ion ion-md-download me-1"></i>Download</button>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <div class="form-control-wrap">
                                            <button type="button" class="btn btn-sm btn-secondary waves-effect waves-light" data-bs-dismiss="modal"><i class="ion ion-md-close me-1"></i>Close</button>
                                            <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1"></i>Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php } ?>

        <!-- JAVASCRIPT -->
        <?php $this->load->view('template/js'); ?>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
</body>

</html>