<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
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
                                        <form method="POST" action="<?= base_url('rob/edit/') . encrypt_url($rob['ID']); ?>">
                                            <?= csrf(); ?>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Pembangkit</label>
                                                <div class="col-sm-7">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $rob['KODE_PEMBANGKIT'] . ' - ' . $rob['NAMA_PEMBANGKIT']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Sistem</label>
                                                <div class="col-sm-7">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $rob['SISTEM']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Bahan Bakar</label>
                                                <div class="col-sm-7">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $rob['BAHAN_BAKAR']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">ROB Perioder</label>
                                                <div class="col-sm-7">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= bulan($rob['BULAN']) . ' ' . $rob['TAHUN']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Rencana Pembebanan</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="rb" class="form-control <?= form_error('rb', 'is-invalid '); ?>" placeholder="Rencana Pembebanan" value="<?= $rob['RENCANA_PEMBEBANAN']; ?>">
                                                    <?= form_error('rb', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">CF (%)</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="cf" class="form-control <?= form_error('cf', 'is-invalid '); ?>" placeholder="CF" value="<?= $rob['CF']; ?>">
                                                    <?= form_error('cf', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Merit Order</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="merit" class="form-control <?= form_error('merit', 'is-invalid '); ?>" placeholder="Merit Order" value="<?= $rob['MERIT_ORDER']; ?>">
                                                    <?= form_error('merit', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mb-3 row">
                                                <div class="col-sm-10 offset-sm-1 text-center">
                                                    <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1"></i>Simpan</button>
                                                    <button class="btn btn-sm btn-light waves-effect waves-light" type="reset"><i class="ion ion-md-refresh me-1"></i>Reset</button>
                                                    <button class="btn btn-sm btn-outline-warning waves-effect waves-light" onclick="window.location.href = '<?= base_url('rob'); ?>';" type="button"><i class="ion ion-md-close me-1"></i>Batal</button>
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
</body>

</html>