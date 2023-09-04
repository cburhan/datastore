<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>libs/jstree/jstree.css?ver=3.0.0" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/scrollable-content.css" rel="stylesheet" type="text/css">
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
                                <h6 class="page-title mb-0"><?= $title; ?></h6>
                                <p class="card-text">#User <?= $title; ?></p>
                            </div>
                        </div>
                        <!-- end page title -->
                        <?= $this->session->flashdata('flash'); ?>
                        <div class="row">
                            <div class="col-3">
                                <div class="user-sidebar">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mt-n4 position-relative">
                                                <div class="text-center">
                                                    <a class="fotouser" href="<?= base_url('public/user/') . $user['IMAGE']; ?>">
                                                        <img src="<?= base_url('public/user/') . $user['IMAGE']; ?>" alt="" class="avatar-xl rounded-circle img-thumbnail">
                                                    </a>
                                                    <div class="mt-3">
                                                        <h6 class="mb-0"><?= $user['FULLNAME']; ?></h6>
                                                        <small class="text-muted"><?= ($user['USERNAME'] != NULL ? $user['USERNAME'] : '-'); ?></small>
                                                        <div class="mt-3">
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="d-flex justify-content-between">
                                                                    <small class="text-muted">Status</small>
                                                                    <?= ($user['IS_ACTIVE'] == 1) ? "<small><span class='badge bg-sm bg-success'>ACTIVE</span></small>" : "<small><span class='badge bg-sm bg-danger'>NOT ACTIVE</span></small>"; ?>
                                                                </li>
                                                                <li class="d-flex justify-content-between">
                                                                    <small class="text-muted">Tipe</small>
                                                                    <?php if ($user['TYPE_USER'] == 'AD') { ?>
                                                                        <small><span class="badge bg-sm bg-primary">ACTIVE DIRECTORY</span></small>
                                                                    <?php } else { ?>
                                                                        <small><span class="badge bg-sm bg-info">USER TABLE</span></small>
                                                                    <?php } ?>
                                                                </li>
                                                                <hr class="m-0 mt-1 mb-1">
                                                                <li class="d-flex justify-content-between">
                                                                    <small class="text-muted">Created By</small>
                                                                    <small><?= $user['CREATED_BY']; ?></small>
                                                                </li>
                                                                <?php
                                                                $tgl_out = date("Y-m-d", strtotime($user['CREATED_ON']));
                                                                $jam_out = date("H:i:s", strtotime($user['CREATED_ON']));
                                                                ?>
                                                                <li class="d-flex justify-content-between">
                                                                    <small class="text-muted">Created On</small>
                                                                    <small><?= tgl_indo($tgl_out) . " " . $jam_out; ?></small>
                                                                </li>
                                                                <hr class="m-0 mt-1 mb-1">
                                                                <li class="d-flex justify-content-between">
                                                                    <small class="text-muted">Changed By</small>
                                                                    <small><?= $user['CHANGED_BY']; ?></small>
                                                                </li>
                                                                <?php
                                                                $tgl_out = date("Y-m-d", strtotime($user['CHANGED_ON']));
                                                                $jam_out = date("H:i:s", strtotime($user['CHANGED_ON']));
                                                                ?>
                                                                <li class="d-flex justify-content-between">
                                                                    <small class="text-muted">Changed On</small>
                                                                    <small><?= tgl_indo($tgl_out) . " " . $jam_out; ?></small>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <hr class="m-0 mt-1 mb-1">
                                                        <div class="d-grid mt-2">
                                                            <button class="btn btn-primary btn-blocks waves-effect waves-light btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#gantifoto">
                                                                <i class="ion ion-md-images me-1"></i>Change Photo
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#info" role="tab">
                                                <i class="bx bx-user-circle font-size-20"></i>
                                                <span class="d-none d-sm-block">Information</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#role" role="tab">
                                                <i class="bx bx-clipboard font-size-20"></i>
                                                <span class="d-none d-sm-block">Role</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#act" role="tab">
                                                <i class="bx bx-mail-send font-size-20"></i>
                                                <span class="d-none d-sm-block">Activity</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Tab content -->
                                    <div class="tab-content p-4">

                                        <div class="tab-pane active" id="info" role="tabpanel">
                                            <div>
                                                <dl class="row mb-0">
                                                    <dt class="col-sm-3">Nama Lengkap</dt>
                                                    <dd class="col-sm-9"><?= $user['FULLNAME']; ?></dd>
                                                    <dt class="col-sm-3">Username</dt>
                                                    <dd class="col-sm-9"><?= $user['USERNAME']; ?></dd>
                                                    <dt class="col-sm-3">NIP</dt>
                                                    <dd class="col-sm-9"><?= ($user['NIP'] != NULL ? $user['NIP'] : '-'); ?></dd>
                                                    <dt class="col-sm-3">Email</dt>
                                                    <dd class="col-sm-9"><?= $user['EMAIL']; ?></dd>
                                                    <dt class="col-sm-3">No Handphone</dt>
                                                    <dd class="col-sm-9"><?= ($user['NO_HP'] != NULL ? $user['NO_HP'] : '-'); ?></dd>
                                                    <dt class="col-sm-3">Jabatan</dt>
                                                    <dd class="col-sm-9"><?= ($user['SHORT_TITLE'] != NULL ? $user['SHORT_TITLE'] : '-'); ?></dd>
                                                    <dt class="col-sm-3">Organisasi</dt>
                                                    <dd class="col-sm-9">
                                                        <?php if ($user['ORG_ID'] != NULL) { ?>
                                                            <div id="jstree"></div>
                                                        <?php } else { ?>
                                                            -
                                                        <?php } ?>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="role" role="tabpanel">
                                            <div>
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-hover mb-0">
                                                        <tbody>
                                                            <?php if ($role != NULL) { ?>
                                                                <?php foreach ($role as $r) : ?>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span class="text-primary"><?= $r['ROLE']; ?></span>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php } else { ?>
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <span class="text-danger">Tidak Ada Role</span>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="act" role="tabpanel">
                                            <div class="scrollable-content dz-scroll">
                                                <?php if ($log != NULL) { ?>
                                                    <div class="text-center">
                                                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#fullact"><i class="ti-alarm-clock me-1"></i>Full Activity</button>
                                                    </div>
                                                <?php } ?>

                                                <?php if ($log != NULL) { ?>
                                                    <ol class="activity-checkout mb-0 px-4 mt-3">
                                                        <?php foreach ($log as $l) : ?>
                                                            <li class="checkout-item">
                                                                <div class="avatar-sm checkout-icon p-1">
                                                                    <div class="avatar-title rounded-circle bg-<?= $l['COLOR']; ?>">
                                                                        <i class="<?= $l['ICON']; ?> text-white font-size-20"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="feed-item-list">
                                                                    <div>
                                                                        <h6 class="mb-0"><?= $l['MODUL']; ?> <span class="badge bg-sm bg-<?= $l['COLOR']; ?>"><?= $l['ACTION']; ?></span></h6>
                                                                        <p class="text-muted text-truncate mb-2"><?= hitung_mundur($l['CREATED_ON']); ?></p>
                                                                        <div class="mb-2">
                                                                            <p class="text-muted mb-0"><?= $l['KETERANGAN']; ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ol>
                                                <?php } else { ?>
                                                    <p class="text-muted text-center font-size-16">Tidak ada data</p>
                                                <?php } ?>
                                            </div>
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

        <div class="modal fade" id="gantifoto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="gantifoto">Change Photo
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?= base_url('user/change_photo_profile/') . encrypt_url($user['ID']); ?>" enctype="multipart/form-data">
                            <?= csrf(); ?>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-control-wrap">
                                        <input class="form-control form-file-input" name="foto" id="customFile" type="file" required onchange="imgPreview()">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-control-wrap">
                                        <div class="user-avatar xl sq">
                                            <img src="<?= base_url('public/user/noimage.png'); ?>" id="joss" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-8 text-end">
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

        <div id="fullact" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullact" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fullact">Activity Log
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table id="mytable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Modul - Action</th>
                                    <th>Aktivitas</th>
                                    <th>Platform</th>
                                    <th>IP Address</th>
                                    <th>Waktu Akses</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary waves-effect waves-light" data-bs-dismiss="modal"><i class="ion ion-md-close me-1"></i>Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- JAVASCRIPT -->
        <?php $this->load->view('template/js'); ?>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/jstree/jstree.js?ver=3.0.0"></script>
        <script src="<?= base_url('assets/'); ?>libs/magnific-popup/jquery.magnific-popup.min.js"></script>
        <script>
            <?php if ($user['ORG_ID'] != NULL) { ?>
                $(function() {
                    var data = [
                        <?php foreach ($orgz as $org) : ?> {
                                'id': '<?php echo $org['ID']; ?>',
                                'parent': '<?php echo $org['PARENT_ID'] ? $org['PARENT_ID'] : '#'; ?>',
                                'text': '<?php echo $org['SHORT_ORG']; ?>',
                                'icon': 'fa fa-building',
                                'state': {
                                    'opened': true
                                }
                            },
                        <?php endforeach; ?> {
                            'id': '<?= $orgs['ID']; ?>',
                            'parent': '<?= $orgs['PARENT_ID']; ?>',
                            'text': '<?= $orgs['SHORT_ORG']; ?>',
                            'icon': 'fa fa-building'
                        }
                    ];

                    $('#jstree').jstree({
                        'core': {
                            'data': data
                        }
                    });
                });
            <?php } ?>

            //GANTI FOTO
            function imgPreview() {
                const customFile = document.querySelector('#customFile');
                const imgPreview = document.querySelector('#joss');

                const img = new FileReader();
                img.readAsDataURL(customFile.files[0]);

                img.onload = function(e) {
                    imgPreview.src = e.target.result;
                }
            };

            $(function() {
                'use strict'

                $(".fotouser").magnificPopup({
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

            $(document).ready(function() {

                //datatables
                table = $('#mytable').DataTable({
                    dom: "lrt" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    language: {
                        searchPlaceholder: 'Search...',
                        sSearch: '',
                        info: "_START_ - _END_ of _TOTAL_ data",
                        infoEmpty: "No data",
                        infoFiltered: "( Total _MAX_ data )"
                    },
                    "bLengthChange": false,
                    "ordering": false,
                    "processing": true,
                    "serverSide": true,
                    "pageLength": 5,
                    "ajax": {
                        "url": "<?= base_url() . 'user/get_data_log/' . encrypt_url(get_session_id()); ?>",
                        "type": "POST"
                    },
                    'columnDefs': [{
                            "className": "align-middle",
                            "targets": "_all"
                        },
                        {
                            "className": "text-center",
                            "targets": 0
                        }
                    ]
                });
            });
        </script>
</body>

</html>