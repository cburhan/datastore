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
                                        <form method="POST" action="<?= base_url('submenu/add'); ?>">
                                            <?= csrf(); ?>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Menu</label>
                                                <div class="col-sm-6">
                                                    <select name="menu" class="form-control menu <?= form_error('menu', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <?php foreach ($menu as $m) : ?>
                                                            <option value="<?= $m['ID']; ?>" <?= set_select('menu', $m['ID']) ?>><?= $m['MENU']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?= form_error('menu', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Title</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="title" class="form-control <?= form_error('title', 'is-invalid '); ?>" placeholder="Title" value="<?= set_value('title'); ?>">
                                                    <?= form_error('title', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Sub Menu</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="submenu" class="form-control <?= form_error('submenu', 'is-invalid '); ?>" placeholder="Sub Menu" value="<?= set_value('submenu'); ?>">
                                                    <?= form_error('submenu', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">URL</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="url" class="form-control <?= form_error('url', 'is-invalid '); ?>" placeholder="URL" value="<?= set_value('url'); ?>">
                                                    <?= form_error('url', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Class Method</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="class" class="form-control <?= form_error('class', 'is-invalid '); ?>" placeholder="Class Method" value="<?= set_value('class'); ?>">
                                                    <?= form_error('class', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-2 col-form-label">Status</label>
                                                <div class="col-sm-6">
                                                    <select name="tampil" class="form-control tampil <?= form_error('tampil', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <option value="0" <?= (set_value('tampil') == 0) ? " selected='selected'" : "" ?>>Tidak Tampil</option>
                                                        <option value="1" <?= (set_value('tampil') == 1) ? " selected='selected'" : "" ?>>Tampil</option>
                                                    </select>
                                                    <?= form_error('tampil', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mb-3 row">
                                                <div class="col-sm-10 offset-sm-1 text-center">
                                                    <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1"></i>Simpan</button>
                                                    <button class="btn btn-sm btn-light waves-effect waves-light" type="reset"><i class="ion ion-md-refresh me-1"></i>Reset</button>
                                                    <button class="btn btn-sm btn-outline-warning waves-effect waves-light" onclick="window.location.href = '<?= base_url('submenu'); ?>';" type="button"><i class="ion ion-md-close me-1"></i>Batal</button>
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

                $(".menu").select2({
                    placeholder: 'Pilih Data'
                });
                $(".tampil").select2({
                    placeholder: 'Pilih Status'
                });
            });
        </script>
</body>

</html>