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
                                <p class="card-text">#Detail Data <?= $title; ?></p>
                            </div>
                            <div class="col-md-4">
                                <div class="float-end d-none d-md-block">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-warning waves-effect waves-light" type="button" onclick="window.location.href = '<?= base_url('pembangkit'); ?>';">
                                            <i class="ion ion-md-arrow-back me-1"></i> Kembali
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-7">
                                <div class="card">
                                    <div class="card-body">
                                        <form>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Kode Pembangkit</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $kit['KODE_PEMBANGKIT']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Tipe Pembangkit</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $kit['TIPE']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Nama Pembangkit</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $kit['NAMA_PEMBANGKIT']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Kepemilikan</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $kit['KEPEMILIKAN']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Regional Pembangkit</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $kit['REGIONAL']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Sistem Transmisi</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $kit['SISTEM']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Daya Terpasang</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $kit['DAYA_TERPASANG']; ?> MW</strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Energi Primer</label>
                                                <div class="col-sm-8">
                                                    <?php if ($kit['IS_BATUBARA'] == 1) { ?>
                                                        <div class="custom-control custom-checkbox pt-2">
                                                            <input type="checkbox" class="form-check-input" disabled value="batubara" <?= $kit['IS_BATUBARA'] == 1 ? 'checked' : ''; ?>>
                                                            <label class="custom-control-label" for="customCheck1">Batubara</label>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($kit['IS_GASPIPA'] == 1) { ?>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="form-check-input" disabled value="gaspipa" <?= $kit['IS_GASPIPA'] == 1 ? 'checked' : ''; ?>>
                                                            <label class="custom-control-label" for="customCheck1">Gas Pipa</label>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($kit['IS_LNG'] == 1) { ?>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="form-check-input" disabled value="lng" <?= $kit['IS_LNG'] == 1 ? 'checked' : ''; ?>>
                                                            <label class="custom-control-label" for="customCheck1">LNG</label>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($kit['IS_BIOMASA'] == 1) { ?>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="form-check-input" disabled value="biomasa" <?= $kit['IS_BIOMASA'] == 1 ? 'checked' : ''; ?>>
                                                            <label class="custom-control-label" for="customCheck1">Biomasa</label>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($kit['IS_BBM'] == 1) { ?>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="form-check-input" disabled value="bbm" <?= $kit['IS_BBM'] == 1 ? 'checked' : ''; ?>>
                                                            <label class="custom-control-label" for="customCheck1">BBM</label>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php if ($kit['IS_BATUBARA'] == 1) { ?>
                                                <div class="row">
                                                    <label for="example-text-input" class="col-sm-4 col-form-label">ID BBO</label>
                                                    <div class="col-sm-8">
                                                        <p class="mt-1 mb-0 text-primary"><strong><?= $kit['ID_BBO']; ?></strong></p>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Kode Mesin</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $kit['KODE_MESIN']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Status</label>
                                                <div class="col-sm-8 pt-2">
                                                    <?php if ($kit['IS_ACTIVE'] == 1) { ?>
                                                        <span class="badge bg-sm bg-success">AKTIF</span>
                                                    <?php } else { ?>
                                                        <span class="badge bg-sm bg-danger">TIDAK AKTIF</span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5 text-center">
                                <div class="card">
                                    <div class="card-body">
                                        <form>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Created By</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $kit['CREATED_BY']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Created On</label>
                                                <div class="col-sm-8">
                                                    <?php
                                                    $tgl_cre = date("Y-m-d", strtotime($kit['CREATED_ON']));
                                                    $jam_cre = date("H:i:s", strtotime($kit['CREATED_ON']));
                                                    ?>
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= tgl_indo($tgl_cre) . ' ' . $jam_cre; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Changed By</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $kit['CREATED_BY']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Changed On</label>
                                                <div class="col-sm-8">
                                                    <?php
                                                    $tgl_cha = date("Y-m-d", strtotime($kit['CHANGED_ON']));
                                                    $jam_cha = date("H:i:s", strtotime($kit['CHANGED_ON']));
                                                    ?>
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= tgl_indo($tgl_cha) . ' ' . $jam_cha; ?></strong></p>
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