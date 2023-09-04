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
                                        <form method="POST" action="<?= base_url('user/edit/') . encrypt_url($user['ID']); ?>">
                                            <?= csrf(); ?>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Username</label>
                                                <div class="col-sm-8">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $user['USERNAME']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Nama Lengkap</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="fullname" class="form-control <?= form_error('fullname', 'is-invalid '); ?>" placeholder="Fullname" value="<?= $user['FULLNAME']; ?>">
                                                    <?= form_error('fullname', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">NIP</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="nip" class="form-control <?= form_error('nip', 'is-invalid '); ?>" placeholder="NIP" value="<?= $user['NIP']; ?>">
                                                    <?= form_error('nip', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Email</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="email" class="form-control <?= form_error('email', 'is-invalid '); ?>" placeholder="Email" value="<?= $user['EMAIL']; ?>">
                                                    <?= form_error('email', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">No Handphone</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="nohp" class="form-control <?= form_error('nohp', 'is-invalid '); ?>" placeholder="No Handphone" value="<?= $user['NO_HP']; ?>">
                                                    <?= form_error('nohp', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Short Jabatan</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="shortjab" class="form-control <?= form_error('shortjab', 'is-invalid '); ?>" placeholder="Short Jabatan" value="<?= $user['SHORT_TITLE']; ?>">
                                                    <?= form_error('shortjab', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Long Jabatan</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="longjab" class="form-control <?= form_error('longjab', 'is-invalid '); ?>" placeholder="Long Jabatan" value="<?= $user['LONG_TITLE']; ?>">
                                                    <?= form_error('longjab', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Organisasi</label>
                                                <div class="col-sm-8">
                                                    <select name="org" class="form-control org <?= form_error('org', 'is-invalid '); ?>">
                                                        <option></option>
                                                        <?php foreach ($org as $m) : ?>
                                                            <option <?php if ($m['ID'] == $user['ORG_ID']) {
                                                                        echo 'selected="selected"';
                                                                    } ?> value="<?= $m['ID']; ?>" <?= set_select('org', $m['ID']) ?>><?= $m['LONG_ORG']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?= form_error('org', '<div class="invalid-feedback">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Tipe User</label>
                                                <div class="col-sm-3">
                                                    <p class="mt-1 mb-0 text-primary"><strong><?= $user['TYPE_USER']; ?></strong></p>
                                                </div>
                                            </div>
                                            <?php if ($user['TYPE_USER'] == 'TABLE') { ?>
                                                <div class="row mb-3">
                                                    <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Password</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="password" name="password1" id="password1" class="form-control <?= form_error('password1', 'is-invalid '); ?>" placeholder="Password" value="<?= set_value('password1'); ?>">
                                                            <button class="btn btn-primary" onclick="satu()" type="button"><i class="ion ion-md-eye"></i></button>
                                                            <?= form_error('password1', '<div class="invalid-feedback">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="example-text-input" class="col-sm-2 offset-sm-1 col-form-label">Retype Password</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="password" name="password2" id="password2" class="form-control <?= form_error('password2', 'is-invalid '); ?>" placeholder="Retype Password" value="<?= set_value('password2'); ?>">
                                                            <button class="btn btn-primary" onclick="dua()" type="button"><i class="ion ion-md-eye"></i></button>
                                                            <?= form_error('password2', '<div class="invalid-feedback">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <hr>
                                            <div class="mb-3 row">
                                                <div class="col-sm-10 offset-sm-1 text-center">
                                                    <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1"></i>Simpan</button>
                                                    <button class="btn btn-sm btn-light waves-effect waves-light" type="reset"><i class="ion ion-md-refresh me-1"></i>Reset</button>
                                                    <button class="btn btn-sm btn-outline-warning waves-effect waves-light" onclick="window.location.href = '<?= base_url('user'); ?>';" type="button"><i class="ion ion-md-close me-1"></i>Batal</button>
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

                $(".org").select2({
                    placeholder: 'Pilih Data'
                });
                $(".tipe").select2({
                    placeholder: 'Pilih Data'
                });
            });

            function satu() {
                var type = document.getElementById("password1").type;
                if (type == 'password') {
                    document.getElementById("password1").type = "text";
                } else {
                    document.getElementById("password1").type = "password";
                }
            }

            function dua() {
                var type = document.getElementById("password2").type;
                if (type == 'password') {
                    document.getElementById("password2").type = "text";
                } else {
                    document.getElementById("password2").type = "password";
                }
            }

            $(document).ready(function() {

                $(".tipe").change(function() {
                    if ($(this).val() == "1") {
                        $("#pass").show();
                        $("#pass2").show();
                    } else {
                        $("#pass").hide();
                        $("#pass2").hide();
                    }
                });
            });
        </script>
</body>

</html>