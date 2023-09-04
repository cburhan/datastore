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
                                <p class="card-text">#Add Data <?= $title; ?></p>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" action="<?= base_url('org/add'); ?>">
                                            <?= csrf(); ?>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Level 1</label>
                                                <div class="col-sm-8">
                                                    <select id="lvl1" name="lvl1" class="form-control lvl1 <?= form_error('lvl1', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <?php foreach ($lvl_1 as $m) : ?>
                                                            <option value="<?= $m['ID']; ?>" <?= set_select('lvl1', $m['ID']) ?>><?= $m['SHORT_ORG']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?= form_error('lvl1', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button id="btn_lvl_1" class="btn btn-success btn-sm waves-effect" type="button"><i class="ion ion-md-add"></i></button>
                                                    <button id="btn_lvl_1_min" class="btn btn-warning btn-sm waves-effect" type="button"><i class="ion ion-md-close"></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-3" id="rlvl2">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Level 2</label>
                                                <div class="col-sm-8">
                                                    <select id="lvl2" name="lvl2" class="form-control lvl2 <?= form_error('lvl2', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <?php foreach ($org as $m) : ?>
                                                            <option class="<?= $m['PARENT_ID']; ?>" value="<?= $m['ID']; ?>" <?= set_select('lvl2', $m['ID']) ?>><?= $m['SHORT_ORG']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?= form_error('lvl2', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button id="btn_lvl_2" class="btn btn-success btn-sm waves-effect" type="button"><i class="ion ion-md-add"></i></button>
                                                    <button id="btn_lvl_2_min" class="btn btn-warning btn-sm waves-effect" type="button"><i class="ion ion-md-close"></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-3" id="rlvl3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Level 3</label>
                                                <div class="col-sm-8">
                                                    <select id="lvl3" name="lvl3" class="form-control lvl3 <?= form_error('lvl3', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <?php foreach ($org as $m) : ?>
                                                            <option class="<?= $m['PARENT_ID']; ?>" value="<?= $m['ID']; ?>" <?= set_select('lvl3', $m['ID']) ?>><?= $m['SHORT_ORG']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?= form_error('lvl3', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button id="btn_lvl_3" class="btn btn-success btn-sm waves-effect" type="button"><i class="ion ion-md-add"></i></button>
                                                    <button id="btn_lvl_3_min" class="btn btn-warning btn-sm waves-effect" type="button"><i class="ion ion-md-close"></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-3" id="rlvl4">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Level 4</label>
                                                <div class="col-sm-8">
                                                    <select id="lvl4" name="lvl4" class="form-control lvl4 <?= form_error('lvl4', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <?php foreach ($org as $m) : ?>
                                                            <option class="<?= $m['PARENT_ID']; ?>" value="<?= $m['ID']; ?>" <?= set_select('lvl4', $m['ID']) ?>><?= $m['SHORT_ORG']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?= form_error('lvl4', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button id="btn_lvl_4" class="btn btn-success btn-sm waves-effect" type="button"><i class="ion ion-md-add"></i></button>
                                                    <button id="btn_lvl_4_min" class="btn btn-warning btn-sm waves-effect" type="button"><i class="ion ion-md-close"></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-3" id="rlvl5">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Level 5</label>
                                                <div class="col-sm-8">
                                                    <select id="lvl5" name="lvl5" class="form-control lvl5 <?= form_error('lvl5', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <?php foreach ($org as $m) : ?>
                                                            <option class="<?= $m['PARENT_ID']; ?>" value="<?= $m['ID']; ?>" <?= set_select('lvl5', $m['ID']) ?>><?= $m['SHORT_ORG']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?= form_error('lvl5', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Short Organisasi</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="short" class="form-control <?= form_error('short', 'is-invalid '); ?>" placeholder="Short Organisasi" value="<?= set_value('short'); ?>">
                                                    <?= form_error('short', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Long Organisasi</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="long" class="form-control <?= form_error('long', 'is-invalid '); ?>" placeholder="Long Organisasi" value="<?= set_value('long'); ?>">
                                                    <?= form_error('long', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mb-3 row">
                                                <div class="col-sm-10 offset-sm-1 text-center">
                                                    <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1"></i>Simpan</button>
                                                    <button class="btn btn-sm btn-light waves-effect waves-light" type="reset"><i class="ion ion-md-refresh me-1"></i>Reset</button>
                                                    <button class="btn btn-sm btn-outline-warning waves-effect waves-light" onclick="window.location.href = '<?= base_url('org'); ?>';" type="button"><i class="ion ion-md-close me-1"></i>Batal</button>
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
        <script src="<?= base_url('assets/') ?>js/chained.js"></script>
        <script>
            $(function() {
                'use strict'

                $(".lvl1").select2({
                    placeholder: 'Pilih Data'
                });
                $(".lvl2").select2({
                    placeholder: 'Pilih Data'
                });
                $(".lvl3").select2({
                    placeholder: 'Pilih Data'
                });
                $(".lvl4").select2({
                    placeholder: 'Pilih Data'
                });
                $(".lvl5").select2({
                    placeholder: 'Pilih Data'
                });
            });

            $(document).ready(function() {

                $("#lvl2").chained("#lvl1");
                $("#lvl3").chained("#lvl2");
                $("#lvl4").chained("#lvl3");
                $("#lvl5").chained("#lvl4");

                $('#btn_lvl_1_min').hide();
                $('#btn_lvl_2_min').hide();
                $('#btn_lvl_3_min').hide();
                $('#btn_lvl_4_min').hide();
                $('#btn_lvl_5_min').hide();

                $('#rlvl2').hide();
                $('#rlvl3').hide();
                $('#rlvl4').hide();
                $('#rlvl5').hide();

                $('#btn_lvl_1').on('click', function() {
                    $('#rlvl2').show();
                    $('#btn_lvl_1_min').show();
                    $('#btn_lvl_1').hide();
                });

                $('#btn_lvl_2').on('click', function() {
                    $('#rlvl3').show();
                    $('#btn_lvl_2_min').show();
                    $('#btn_lvl_2').hide();
                });

                $('#btn_lvl_3').on('click', function() {
                    $('#rlvl4').show();
                    $('#btn_lvl_3_min').show();
                    $('#btn_lvl_3').hide();
                });

                $('#btn_lvl_4').on('click', function() {
                    $('#rlvl5').show();
                    $('#btn_lvl_4_min').show();
                    $('#btn_lvl_4').hide();
                });

                $('#btn_lvl_1_min').on('click', function() {
                    $('#rlvl2').hide();
                    $('#rlvl3').hide();
                    $('#rlvl4').hide();
                    $('#rlvl5').hide();
                    $('#btn_lvl_1_min').hide();
                    $('#btn_lvl_2_min').hide();
                    $('#btn_lvl_3_min').hide();
                    $('#btn_lvl_4_min').hide();
                    $('#btn_lvl_1').show();
                    $('#btn_lvl_2').show();
                    $('#btn_lvl_3').show();
                    $('#btn_lvl_4').show();
                    $('#lvl2').val("");
                    $('#lvl3').val("");
                    $('#lvl4').val("");
                    $('#lvl5').val("");
                });

                $('#btn_lvl_2_min').on('click', function() {
                    $('#rlvl3').hide();
                    $('#rlvl4').hide();
                    $('#rlvl5').hide();
                    $('#btn_lvl_2_min').hide();
                    $('#btn_lvl_3_min').hide();
                    $('#btn_lvl_4_min').hide();
                    $('#btn_lvl_2').show();
                    $('#btn_lvl_3').show();
                    $('#btn_lvl_4').show();
                    $('#lvl3').val("");
                    $('#lvl4').val("");
                    $('#lvl5').val("");
                });

                $('#btn_lvl_3_min').on('click', function() {
                    $('#rlvl4').hide();
                    $('#rlvl5').hide();
                    $('#btn_lvl_3_min').hide();
                    $('#btn_lvl_4_min').hide();
                    $('#btn_lvl_3').show();
                    $('#btn_lvl_4').show();
                    $('#lvl4').val("");
                    $('#lvl5').val("");
                });

                $('#btn_lvl_4_min').on('click', function() {
                    $('#rlvl5').hide();
                    $('#btn_lvl_4_min').hide();
                    $('#btn_lvl_4').show();
                    $('#lvl5').val("");
                });

            });
        </script>
</body>

</html>