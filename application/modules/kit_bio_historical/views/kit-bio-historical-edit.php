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
                                <h6 class="page-title mb-0"><?= $title; ?></h6>
                                <p class="card-text">#Edit Data <?= $title; ?></p>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" action="<?= base_url('kit_bio_historical/edit/') . encrypt_url($bio['ID']); ?>">
                                            <?= csrf(); ?>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-3 offset-sm-1 col-form-label">Tahun</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $bio['TAHUN']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-3 offset-sm-1 col-form-label">Pembangkit</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $bio['KODE_PEMBANGKIT'] . ' - ' . $bio['NAMA_PEMBANGKIT']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-3 offset-sm-1 col-form-label">Target Pemakaian</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" name="target" class="form-control text-end <?= form_error('target', 'is-invalid '); ?>" value="<?= $bio['TARGET_PEMAKAIAN_BIO']; ?>" autofocus>
                                                        <button class="btn btn-primary" type="button">MT/Tahun</button>
                                                        <?= form_error('target', '<div class="invalid-feedback">', '</div>'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-3 offset-sm-1 col-form-label">Intensitas Emisi</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" name="inten" class="form-control text-end <?= form_error('inten', 'is-invalid '); ?>" value="<?= $bio['INTENSITAS_EMISI_BIO']; ?>">
                                                        <button class="btn btn-primary" type="button">Ton/MWh</button>
                                                        <?= form_error('inten', '<div class="invalid-feedback">', '</div>'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-3 offset-sm-1 col-form-label">Kapasitas Max Penyimpanan</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" name="max_simpan" class="form-control text-end <?= form_error('max_simpan', 'is-invalid '); ?>" value="<?= $bio['KAPASITAS_MAX_PENYIMPANAN_BIO']; ?>">
                                                        <button class="btn btn-primary" type="button">MT</button>
                                                        <?= form_error('max_simpan', '<div class="invalid-feedback">', '</div>'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-3 offset-sm-1 col-form-label">Kapasitas Max Bongkar Harian</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" name="max_bongkar" class="form-control text-end <?= form_error('max_bongkar', 'is-invalid '); ?>" value="<?= $bio['KAPASITAS_MAX_BONGKAR_HARIAN_BIO']; ?>">
                                                        <button class="btn btn-primary" type="button">MT</button>
                                                        <?= form_error('max_bongkar', '<div class="invalid-feedback">', '</div>'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mb-3 row">
                                                <div class="col-sm-10 offset-sm-1 text-center">
                                                    <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1"></i>Simpan</button>
                                                    <button class="btn btn-sm btn-light waves-effect waves-light" type="reset"><i class="ion ion-md-refresh me-1"></i>Reset</button>
                                                    <button class="btn btn-sm btn-outline-warning waves-effect waves-light" onclick="window.location.href = '<?= base_url('kit_bio_historical'); ?>';" type="button"><i class="ion ion-md-close me-1"></i>Batal</button>
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

        <!-- JAVASCRIPT -->
        <?php $this->load->view('template/js'); ?>
        <script src="<?= base_url('assets/'); ?>libs/select2/js/select2.min.js"></script>
        <script>
            $(function() {
                'use strict'

                $(".status").select2({
                    placeholder: 'Pilih Data'
                });
            });
        </script>
</body>

</html>