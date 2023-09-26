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
                                <p class="card-text">#Add Data <?= $title; ?></p>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" action="<?= base_url('bio_master/add'); ?>" enctype="multipart/form-data">
                                            <?= csrf(); ?>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Tipe</label>
                                                <div class="col-sm-2">
                                                    <select name="tipe" class="form-control tipe <?= form_error('tipe', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <option value="1" <?= set_select('tipe', 1) ?>>PEMBANGKIT</option>
                                                        <option value="2" <?= set_select('tipe', 2) ?>>KONTRAK</option>
                                                        <option value="3" <?= set_select('tipe', 3) ?>>AMANDEMEN</option>
                                                    </select>
                                                    <?= form_error('tipe', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">File Master Bio</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="bio" class="filestyle <?= form_error('bio', 'is-invalid '); ?>" data-buttonname="btn-secondary" required>
                                                    <?= form_error('bio', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mb-3 row">
                                                <div class="col-sm-10 offset-sm-1 text-center">
                                                    <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1" onclick="return confirmUpload()"></i>Simpan</button>
                                                    <button class="btn btn-sm btn-light waves-effect waves-light" type="reset"><i class="ion ion-md-refresh me-1"></i>Reset</button>
                                                    <button class="btn btn-sm btn-outline-warning waves-effect waves-light" onclick="window.location.href = '<?= base_url('bio_trans'); ?>';" type="button"><i class="ion ion-md-close me-1"></i>Batal</button>
                                                </div>
                                            </div>
                                            <hr>
                                            <p class="mb-3 font-14">
                                                <span class="text-primary"><strong>Sebelum mengupload harap perhatikan hal-hal berikut:</strong></span><br>
                                                1. Data pada kolom yang kosong atau empty atau NULL diisi dengan <span class="text-primary"><strong>0</strong></span><br>
                                                2. Delimiter atau pemisah bilangan desimal menggunakan <span class="text-primary"><strong>titik (.)</strong></span> contoh <span class="text-primary"><strong>125.76</strong></span><br>
                                                3. Delimiter atau pemisah pada bilangan ribuan tidak digunakan, contoh <span class="text-primary"><strong>1000000</strong></span> bukan <span class="text-danger"><strong>1.000.000</strong></span><br>
                                            </p>
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

                $(".tipe").select2({
                    placeholder: 'Pilih Tipe'
                });
            });

            function confirmUpload() {
                return confirm("Apakah anda yakin?\nFormat value pada kolom harus sesuai dengan ketentuan berikut:\n1. Data pada kolom yang kosong atau empty atau NULL diisi dengan 0\n2. Delimiter atau pemisah bilangan desimal menggunakan titik (.) contoh 125.76\n3. Delimiter atau pemisah pada bilangan ribuan tidak digunakan, contoh 1000000 bukan 1.000.000")
            }
        </script>
</body>

</html>