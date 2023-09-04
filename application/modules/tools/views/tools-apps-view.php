<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
    <link href="<?= base_url('assets/'); ?>libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
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
                                <p class="card-text">#<?= $title; ?> Config</p>
                            </div>
                        </div>
                        <!-- end page title -->
                        <?= $this->session->flashdata('flash'); ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" style="width: 200px;" class="align-middle">Nama</th>
                                                        <td class="align-middle"><span class="text-primary"><strong><?= $apps['NAME']; ?></strong></span></td>
                                                        <td style="width: 100px;" class="align-middle text-center">
                                                            <?php if (check_button('change_name_apps') > 0) { ?>
                                                                <button class="btn btn-warning btn-sm waves-effect" type="button" data-bs-toggle="modal" data-bs-target="#nama"><i class="ion ion-md-color-filter me-1"></i>Edit</button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 200px;" class="align-middle">Logo Kecil</th>
                                                        <td class="align-middle">
                                                            <?php if ($apps['LOGO'] != NULL) { ?>
                                                                <a class="logo" href="<?= base_url('public/apps/') . $apps['LOGO']; ?>">
                                                                    <img src="<?= base_url('public/apps/') . $apps['LOGO']; ?>" alt="" class="img-thumbnail rounded me-2" width="50">
                                                                </a>
                                                            <?php } else { ?>
                                                                <img src="<?= base_url('public/apps/noimage.png'); ?>" alt="" class="img-thumbnail rounded me-2" width="50">
                                                            <?php } ?>
                                                        </td>
                                                        <td style="width: 100px;" class="align-middle text-center">
                                                            <?php if (check_button('change_logo_apps') > 0) { ?>
                                                                <button class="btn btn-warning btn-sm waves-effect" type="button" data-bs-toggle="modal" data-bs-target="#logo"><i class="ion ion-md-color-filter me-1"></i>Edit</button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 200px;" class="align-middle">Logo Besar</th>
                                                        <td class="align-middle">
                                                            <?php if ($apps['LOGO_BIG'] != NULL) { ?>
                                                                <a class="logobig" href="<?= base_url('public/apps/') . $apps['LOGO_BIG']; ?>">
                                                                    <img src="<?= base_url('public/apps/') . $apps['LOGO_BIG']; ?>" alt="" class="img-thumbnail rounded me-2" width="200">
                                                                </a>
                                                            <?php } else { ?>
                                                                <img src="<?= base_url('public/apps/noimage.png'); ?>" alt="" class="img-thumbnail rounded me-2" width="100">
                                                            <?php } ?>
                                                        </td>
                                                        <td style="width: 100px;" class="align-middle text-center">
                                                            <?php if (check_button('change_logobig_apps') > 0) { ?>
                                                                <button class="btn btn-warning btn-sm waves-effect" type="button" data-bs-toggle="modal" data-bs-target="#logobig"><i class="ion ion-md-color-filter me-1"></i>Edit</button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 200px;" class="align-middle">Background</th>
                                                        <td class="align-middle">
                                                            <?php if ($apps['BG'] != NULL) { ?>
                                                                <a class="bg" href="<?= base_url('public/apps/') . $apps['BG']; ?>">
                                                                    <img src="<?= base_url('public/apps/') . $apps['BG']; ?>" alt="" class="img-thumbnail rounded me-2" width="300">
                                                                </a>
                                                            <?php } else { ?>
                                                                <img src="<?= base_url('public/apps/noimage.png'); ?>" alt="" class="img-thumbnail rounded me-2" width="100">
                                                            <?php } ?>
                                                        </td>
                                                        <td style="width: 100px;" class="align-middle text-center">
                                                            <?php if (check_button('change_bg_apps') > 0) { ?>
                                                                <button class="btn btn-warning btn-sm waves-effect" type="button" data-bs-toggle="modal" data-bs-target="#bg"><i class="ion ion-md-color-filter me-1"></i>Edit</button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
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

        <?php if (check_button('change_name_apps') > 0) { ?>
            <div class="modal fade" id="nama" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="nama">Change Nama Apps</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('tools/change_name_apps'); ?>">
                                <?= csrf(); ?>
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">Nama Aplikasi<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control" value="<?= $apps['NAME']; ?>" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <div class="form-control-wrap">
                                            <button type="button" class="btn btn-sm btn-secondary waves-effect waves-light" data-bs-dismiss="modal"><i class="ion ion-md-close me-1"></i>Close</button>
                                            <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1"></i>Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php } ?>

        <?php if (check_button('change_logo_apps') > 0) { ?>
            <div class="modal fade" id="logo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logo">Change Logo Apps</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('tools/change_logo_apps'); ?>" enctype="multipart/form-data">
                                <?= csrf(); ?>
                                <div class="row">
                                    <div class="col-sm-12 pb-3">
                                        <div class="form-control-wrap">
                                            <input class="form-control form-file-input" name="logo" id="customFile" type="file" required onchange="imgPreview()">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-center">
                                        <div class="form-control-wrap">
                                            <div class="user-avatar xl sq">
                                                <img src="<?= base_url('public/apps/noimage.png'); ?>" id="joss" class="img-thumbnail rounded me-2" width="100" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <div class="form-control-wrap">
                                            <button type="button" class="btn btn-sm btn-secondary waves-effect waves-light" data-bs-dismiss="modal"><i class="ion ion-md-close me-1"></i>Close</button>
                                            <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1"></i>Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php } ?>

        <?php if (check_button('change_logobig_apps') > 0) { ?>
            <div class="modal fade" id="logobig" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logobig">Change Logo Big Apps</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('tools/change_logobig_apps'); ?>" enctype="multipart/form-data">
                                <?= csrf(); ?>
                                <div class="row">
                                    <div class="col-sm-12 pb-3">
                                        <div class="form-control-wrap">
                                            <input class="form-control form-file-input" name="logobig" id="customFile3" type="file" required onchange="imgPreview3()">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-center">
                                        <div class="form-control-wrap">
                                            <div class="user-avatar xl sq">
                                                <img src="<?= base_url('public/apps/noimage.png'); ?>" id="joss3" class="img-thumbnail rounded me-2" width="200" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <div class="form-control-wrap">
                                            <button type="button" class="btn btn-sm btn-secondary waves-effect waves-light" data-bs-dismiss="modal"><i class="ion ion-md-close me-1"></i>Close</button>
                                            <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1"></i>Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php } ?>

        <?php if (check_button('change_bg_apps') > 0) { ?>
            <div class="modal fade" id="bg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bg">Change Logo Big Apps</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('tools/change_bg_apps'); ?>" enctype="multipart/form-data">
                                <?= csrf(); ?>
                                <div class="row">
                                    <div class="col-sm-12 pb-3">
                                        <div class="form-control-wrap">
                                            <input class="form-control form-file-input" name="bg" id="customFile2" type="file" required onchange="imgPreview2()">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-center">
                                        <div class="form-control-wrap">
                                            <div class="user-avatar xl sq">
                                                <img src="<?= base_url('public/apps/noimage.png'); ?>" id="joss2" class="img-thumbnail rounded me-2" width="200" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <div class="form-control-wrap">
                                            <button type="button" class="btn btn-sm btn-secondary waves-effect waves-light" data-bs-dismiss="modal"><i class="ion ion-md-close me-1"></i>Close</button>
                                            <button class="btn btn-sm btn-primary waves-effect waves-light" type="submit"><i class="ion ion-md-save me-1"></i>Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php } ?>


        <!-- JAVASCRIPT -->
        <?php $this->load->view('template/js'); ?>
        <script src="<?= base_url('assets/'); ?>libs/magnific-popup/jquery.magnific-popup.min.js"></script>
        <script>
            $(function() {
                'use strict'

                $(".logo").magnificPopup({
                    type: "image",
                    closeOnContentClick: !0,
                    closeBtnInside: !1,
                    fixedContentPos: !0,
                    mainClass: "mfp-no-margins mfp-with-zoom",
                    image: {
                        verticalFit: !0
                    },
                    zoom: {
                        enabled: !0,
                        duration: 300
                    }
                });

                $(".logobig").magnificPopup({
                    type: "image",
                    closeOnContentClick: !0,
                    closeBtnInside: !1,
                    fixedContentPos: !0,
                    mainClass: "mfp-no-margins mfp-with-zoom",
                    image: {
                        verticalFit: !0
                    },
                    zoom: {
                        enabled: !0,
                        duration: 300
                    }
                });

                $(".bg").magnificPopup({
                    type: "image",
                    closeOnContentClick: !0,
                    closeBtnInside: !1,
                    fixedContentPos: !0,
                    mainClass: "mfp-no-margins mfp-with-zoom",
                    image: {
                        verticalFit: !0
                    },
                    zoom: {
                        enabled: !0,
                        duration: 300
                    }
                });
            });

            function imgPreview() {
                const customFile = document.querySelector('#customFile');
                //const customLabel = document.querySelector('.form-file-label');
                const imgPreview = document.querySelector('#joss');

                //customLabel.textContent = customFile.files[0].name;

                const img = new FileReader();
                img.readAsDataURL(customFile.files[0]);

                img.onload = function(e) {
                    imgPreview.src = e.target.result;
                }
            };

            function imgPreview2() {
                const customFile = document.querySelector('#customFile2');
                //const customLabel = document.querySelector('.form-file-label');
                const imgPreview = document.querySelector('#joss2');

                //customLabel.textContent = customFile.files[0].name;

                const img = new FileReader();
                img.readAsDataURL(customFile.files[0]);

                img.onload = function(e) {
                    imgPreview.src = e.target.result;
                }
            };

            function imgPreview3() {
                const customFile = document.querySelector('#customFile3');
                //const customLabel = document.querySelector('.form-file-label');
                const imgPreview = document.querySelector('#joss3');

                //customLabel.textContent = customFile.files[0].name;

                const img = new FileReader();
                img.readAsDataURL(customFile.files[0]);

                img.onload = function(e) {
                    imgPreview.src = e.target.result;
                }
            };
        </script>
</body>

</html>