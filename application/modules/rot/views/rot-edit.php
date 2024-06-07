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
                                        <form method="POST" action="<?= base_url('rot/edit/') . encrypt_url($rot['ID']); ?>">
                                            <?= csrf(); ?>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Pembangkit</label>
                                                <div class="col-sm-7">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $rot['KODE_PEMBANGKIT'] . ' - ' . $rot['NAMA_PEMBANGKIT']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Sistem</label>
                                                <div class="col-sm-7">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $rot['SISTEM']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Bahan Bakar</label>
                                                <div class="col-sm-7">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $rot['BAHAN_BAKAR']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">ROT Tahun</label>
                                                <div class="col-sm-7">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $rot['TAHUN']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Januari</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="jan" class="form-control <?= form_error('jan', 'is-invalid '); ?>" placeholder="Januari" value="<?= $rot['JAN']; ?>">
                                                    <?= form_error('jan', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Februari</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="feb" class="form-control <?= form_error('feb', 'is-invalid '); ?>" placeholder="Februari" value="<?= $rot['FEB']; ?>">
                                                    <?= form_error('feb', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Maret</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="mar" class="form-control <?= form_error('mar', 'is-invalid '); ?>" placeholder="Maret" value="<?= $rot['MAR']; ?>">
                                                    <?= form_error('mar', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">April</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="apr" class="form-control <?= form_error('apr', 'is-invalid '); ?>" placeholder="April" value="<?= $rot['APR']; ?>">
                                                    <?= form_error('apr', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Mei</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="mei" class="form-control <?= form_error('mei', 'is-invalid '); ?>" placeholder="Mei" value="<?= $rot['MEI']; ?>">
                                                    <?= form_error('mei', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Juni</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="jun" class="form-control <?= form_error('jun', 'is-invalid '); ?>" placeholder="Juni" value="<?= $rot['JUN']; ?>">
                                                    <?= form_error('jun', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Juli</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="jul" class="form-control <?= form_error('jul', 'is-invalid '); ?>" placeholder="Juli" value="<?= $rot['JUL']; ?>">
                                                    <?= form_error('jul', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Agustus</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="aug" class="form-control <?= form_error('aug', 'is-invalid '); ?>" placeholder="Agustus" value="<?= $rot['AUG']; ?>">
                                                    <?= form_error('aug', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">September</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="sep" class="form-control <?= form_error('sep', 'is-invalid '); ?>" placeholder="September" value="<?= $rot['SEP']; ?>">
                                                    <?= form_error('sep', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Oktober</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="okt" class="form-control <?= form_error('okt', 'is-invalid '); ?>" placeholder="Oktober" value="<?= $rot['OKT']; ?>">
                                                    <?= form_error('okt', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">November</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="nov" class="form-control <?= form_error('nov', 'is-invalid '); ?>" placeholder="November" value="<?= $rot['NOV']; ?>">
                                                    <?= form_error('nov', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">Desember</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="des" class="form-control <?= form_error('des', 'is-invalid '); ?>" placeholder="Desember" value="<?= $rot['DES']; ?>">
                                                    <?= form_error('des', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-3 col-form-label">CF (%)</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="cf" class="form-control <?= form_error('cf', 'is-invalid '); ?>" placeholder="CF" value="<?= $rot['CF']; ?>">
                                                    <?= form_error('cf', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mb-3 row">
                                                <div class="col-sm-10 offset-sm-1 text-center">
                                                    <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1"></i>Simpan</button>
                                                    <button class="btn btn-sm btn-light waves-effect waves-light" type="reset"><i class="ion ion-md-refresh me-1"></i>Reset</button>
                                                    <button class="btn btn-sm btn-outline-warning waves-effect waves-light" onclick="window.location.href = '<?= base_url('rot'); ?>';" type="button"><i class="ion ion-md-close me-1"></i>Batal</button>
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