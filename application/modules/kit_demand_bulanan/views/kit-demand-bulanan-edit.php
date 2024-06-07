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
                                        <form method="POST" action="<?= base_url('kit_demand_bulanan/edit/') . encrypt_url($demand['ID']); ?>">
                                            <?= csrf(); ?>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-3 offset-sm-2 col-form-label">Pembangkit</label>
                                                <div class="col-sm-7">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $demand['KODE_PEMBANGKIT'] . ' - ' . $demand['NAMA_PEMBANGKIT']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-3 offset-sm-2 col-form-label">Sistem</label>
                                                <div class="col-sm-7">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $demand['SISTEM']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-3 offset-sm-2 col-form-label">Bahan Bakar</label>
                                                <div class="col-sm-7">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $demand['BAHAN_BAKAR']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-3 offset-sm-2 col-form-label">Kebutuhan Pembangkit Periode</label>
                                                <div class="col-sm-7">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= bulan($demand['BULAN']) . ' ' . $demand['TAHUN']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-3 offset-sm-2 col-form-label">Kebutuhan Pembangkit</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="demand" class="form-control <?= form_error('demand', 'is-invalid '); ?>" placeholder="Kebutuhan Pembangkit" value="<?= $demand['KEBUTUHAN_PEMBANGKIT']; ?>">
                                                    <?= form_error('demand', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-3 offset-sm-2 col-form-label">CF (%)</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="cf" class="form-control <?= form_error('cf', 'is-invalid '); ?>" placeholder="CF" value="<?= $demand['CF']; ?>">
                                                    <?= form_error('cf', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mb-3 row">
                                                <div class="col-sm-10 offset-sm-1 text-center">
                                                    <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1"></i>Simpan</button>
                                                    <button class="btn btn-sm btn-light waves-effect waves-light" type="reset"><i class="ion ion-md-refresh me-1"></i>Reset</button>
                                                    <button class="btn btn-sm btn-outline-warning waves-effect waves-light" onclick="window.location.href = '<?= base_url('kit_demand_bulanan'); ?>';" type="button"><i class="ion ion-md-close me-1"></i>Batal</button>
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