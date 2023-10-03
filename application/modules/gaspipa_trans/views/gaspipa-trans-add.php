<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
    <link href="<?= base_url('assets/'); ?>libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <style>
        .was-validated select.select2:invalid+.select2.select2-container.select2-container--default span.select2-selection,
        select.is-invalid+.select2.select2-container.select2-container--default span.select2-selection {
            border-color: #FF5E5E;
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
                                <p class="card-text">#Add Data <?= $title; ?> Bulanan</p>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" action="<?= base_url('gaspipa_trans/add'); ?>" enctype="multipart/form-data">
                                            <?= csrf(); ?>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Bulan</label>
                                                <div class="col-sm-2">
                                                    <select name="bulan" class="form-control bulan <?= form_error('bulan', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                            <option value="<?= $i; ?>" <?= set_select('bulan', $i) ?>><?= bulan($i); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <?= form_error('bulan', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Tahun</label>
                                                <div class="col-sm-2">
                                                    <select name="tahun" class="form-control tahun <?= form_error('tahun', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <?php $currentYear = date("Y");
                                                        for ($i = $currentYear; $i <= $currentYear + 5; $i++) { ?>
                                                            <option value="<?= $i; ?>" <?= set_select('tahun', $i) ?>><?= $i; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <?= form_error('tahun', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">File Trans Gas Pipa</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="bio" class="filestyle <?= form_error('bio', 'is-invalid '); ?>" data-buttonname="btn-secondary" required>
                                                    <?= form_error('bio', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mb-3 row">
                                                <div class="col-sm-10 offset-sm-1 text-center">
                                                    <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1"></i>Simpan</button>
                                                    <button class="btn btn-sm btn-light waves-effect waves-light" type="reset"><i class="ion ion-md-refresh me-1"></i>Reset</button>
                                                    <button class="btn btn-sm btn-outline-warning waves-effect waves-light" onclick="window.location.href = '<?= base_url('gaspipa_trans'); ?>';" type="button"><i class="ion ion-md-close me-1"></i>Batal</button>
                                                </div>
                                            </div>
                                        </form>
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

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <?php $this->load->view('template/js'); ?>
        <script src="<?= base_url('assets/'); ?>libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/select2/js/select2.min.js"></script>
        <script>
            $(function() {
                'use strict'

                $(".bulan").select2({
                    placeholder: 'Pilih Bulan'
                });
                $(".tahun").select2({
                    placeholder: 'Pilih Tahun'
                });
            });
        </script>
</body>

</html>