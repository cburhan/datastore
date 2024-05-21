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
                                        <form method="POST" action="<?= base_url('pembangkit/edit/') . encrypt_url($kit['ID']); ?>">
                                            <?= csrf(); ?>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Kode Pembangkit</label>
                                                <div class="col-sm-6">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $kit['KODE_PEMBANGKIT']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Tipe Pembangkit</label>
                                                <div class="col-sm-2">
                                                    <select name="tipe" class="form-control tipe <?= form_error('tipe', 'is-invalid '); ?>" autofocus>
                                                        <option></option>
                                                        <?php foreach ($tipe as $m) : ?>
                                                            <option <?php if ($m['ID'] == $kit['TIPE_ID']) {
                                                                        echo 'selected="selected"';
                                                                    } ?> value="<?= $m['ID']; ?>" <?= set_select('tipe', $m['ID']) ?>><?= $m['TIPE']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?= form_error('tipe', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Nama Pembangkit</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="nama" class="form-control <?= form_error('nama', 'is-invalid '); ?>" placeholder="Nama Pembangkit" value="<?= $kit['NAMA_PEMBANGKIT']; ?>">
                                                    <?= form_error('nama', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Kepemilikan</label>
                                                <div class="col-sm-2">
                                                    <select name="milik" class="form-control milik <?= form_error('milik', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <option value="11" <?= ($kit['KEPEMILIKAN_ID'] == 11) ? " selected=' selected'" : "" ?>>PLN</option>
                                                        <option value="12" <?= ($kit['KEPEMILIKAN_ID'] == 12) ? " selected=' selected'" : "" ?>>PLN IP</option>
                                                        <option value="13" <?= ($kit['KEPEMILIKAN_ID'] == 13) ? " selected=' selected'" : "" ?>>PLN NP</option>
                                                        <option value="14" <?= ($kit['KEPEMILIKAN_ID'] == 14) ? " selected=' selected'" : "" ?>>IPP</option>
                                                    </select>
                                                    <?= form_error('milik', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Regional Pembangkit</label>
                                                <div class="col-sm-2">
                                                    <select name="reg" class="form-control reg <?= form_error('reg', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <?php foreach ($reg as $m) : ?>
                                                            <option <?php if ($m['ID'] == $kit['REGIONAL_ID']) {
                                                                        echo 'selected="selected"';
                                                                    } ?> value="<?= $m['ID']; ?>" <?= set_select('reg', $m['ID']) ?>><?= $m['REGIONAL']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?= form_error('reg', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Sistem Transmisi</label>
                                                <div class="col-sm-2">
                                                    <select name="sis" class="form-control sis <?= form_error('sis', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <?php foreach ($sis as $m) : ?>
                                                            <option <?php if ($m['ID'] == $kit['SISTEM_ID']) {
                                                                        echo 'selected="selected"';
                                                                    } ?> value="<?= $m['ID']; ?>" <?= set_select('sis', $m['ID']) ?>><?= $m['SISTEM']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?= form_error('sis', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Daya Terpasang</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <input type="text" name="daya" class="form-control <?= form_error('daya', 'is-invalid '); ?>" placeholder="Daya Terpasang" value="<?= $kit['DAYA_TERPASANG']; ?>">
                                                        <button class="btn btn-primary" type="button">MW</button>
                                                        <?= form_error('daya', '<div class="invalid-feedback">', '</div>'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Energi Primer</label>
                                                <div class="col-sm-3">
                                                    <div class="custom-control custom-checkbox pt-2">
                                                        <input type="checkbox" class="form-check-input" id="batubara" name="energi_primer[]" value="batubara" <?= $kit['IS_BATUBARA'] == 1 ? 'checked' : ''; ?>>
                                                        <label class="custom-control-label" for="customCheck1">Batubara</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="form-check-input" id="gaspipa" name="energi_primer[]" value="gaspipa" <?= $kit['IS_GASPIPA'] == 1 ? 'checked' : ''; ?>>
                                                        <label class="custom-control-label" for="customCheck1">Gas Pipa</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="form-check-input" id="lng" name="energi_primer[]" value="lng" <?= $kit['IS_LNG'] == 1 ? 'checked' : ''; ?>>
                                                        <label class="custom-control-label" for="customCheck1">LNG</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="form-check-input" id="biomasa" name="energi_primer[]" value="biomasa" <?= $kit['IS_BIOMASA'] == 1 ? 'checked' : ''; ?>>
                                                        <label class="custom-control-label" for="customCheck1">Biomasa</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="form-check-input" id="bbm" name="energi_primer[]" value="bbm" <?= $kit['IS_BBM'] == 1 ? 'checked' : ''; ?>>
                                                        <label class="custom-control-label" for="customCheck1">BBM</label>
                                                    </div>
                                                    <?= form_error('energi_primer[]', '<div class="text-danger" style="font-size: 80%">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3" id="bbo" style="display: none;">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">ID BBO</label>
                                                <div class="col-sm-2">
                                                    <input type="text" name="bbo" class="form-control <?= form_error('bbo', 'is-invalid '); ?>" placeholder="ID BBO" value="<?= $kit['ID_BBO']; ?>">
                                                    <?= form_error('bbo', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Kode Mesin</label>
                                                <div class="col-sm-6">
                                                    <textarea name="mesin" class="form-control <?= form_error('mesin', 'is-invalid '); ?>" rows="5"><?= $kit['KODE_MESIN']; ?></textarea>
                                                    <?= form_error('mesin', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Status</label>
                                                <div class="col-sm-2">
                                                    <select name="status" class="form-control status <?= form_error('status', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <option value="1" <?= ($kit['IS_ACTIVE'] == 1) ? " selected=' selected'" : "" ?>>AKTIF</option>
                                                        <option value="0" <?= ($kit['IS_ACTIVE'] == 0) ? " selected=' selected'" : "" ?>>TIDAK AKTIF</option>
                                                    </select>
                                                    <?= form_error('status', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mb-3 row">
                                                <div class="col-sm-10 offset-sm-1 text-center">
                                                    <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1"></i>Simpan</button>
                                                    <button class="btn btn-sm btn-light waves-effect waves-light" type="reset"><i class="ion ion-md-refresh me-1"></i>Reset</button>
                                                    <button class="btn btn-sm btn-outline-warning waves-effect waves-light" onclick="window.location.href = '<?= base_url('pembangkit'); ?>';" type="button"><i class="ion ion-md-close me-1"></i>Batal</button>
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

                $(".milik").select2({
                    placeholder: 'Pilih Data'
                });

                $(".tipe").select2({
                    placeholder: 'Pilih Data'
                });

                $(".reg").select2({
                    placeholder: 'Pilih Data'
                });

                $(".sis").select2({
                    placeholder: 'Pilih Data'
                });

                $(".status").select2({
                    placeholder: 'Pilih Data'
                });
            });

            $(document).ready(function() {

                <?php if ($kit['IS_BATUBARA'] == 1) : ?>
                    $("#bbo").show();
                <?php endif; ?>

                $("#batubara").change(function() {
                    if ($(this).is(":checked")) {
                        $("#bbo").show();
                    } else {
                        $("#bbo").hide();
                    }
                });
            });
        </script>
</body>

</html>