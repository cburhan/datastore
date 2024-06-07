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
                                                        <th scope="row" style="width: 200px;" class="align-middle">Database</th>
                                                        <td class="align-middle"><span class="text-primary"><strong><?= $api['DATABASE']; ?></strong></span></td>
                                                        <td style="width: 100px;" class="align-middle text-center">
                                                            <?php if (check_button('change_db_api') > 0) { ?>
                                                                <button class="btn btn-warning btn-sm waves-effect" type="button" data-bs-toggle="modal" data-bs-target="#db"><i class="ion ion-md-color-filter me-1"></i>Edit</button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 200px;" class="align-middle">Schema</th>
                                                        <td class="align-middle"><span class="text-primary"><strong><?= $api['SCHEMA']; ?></strong></span></td>
                                                        <td style="width: 100px;" class="align-middle text-center">
                                                            <?php if (check_button('change_schema_api') > 0) { ?>
                                                                <button class="btn btn-warning btn-sm waves-effect" type="button" data-bs-toggle="modal" data-bs-target="#schema"><i class="ion ion-md-color-filter me-1"></i>Edit</button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 200px;" class="align-middle">Integrasi Token</th>
                                                        <td class="align-middle"><span class="text-primary"><strong><?= $api['INTEGRASI_TOKEN']; ?></strong></span></td>
                                                        <td style="width: 100px;" class="align-middle text-center">
                                                            <?php if (check_button('change_int_token') > 0) { ?>
                                                                <button class="btn btn-warning btn-sm waves-effect" type="button" data-bs-toggle="modal" data-bs-target="#token"><i class="ion ion-md-color-filter me-1"></i>Edit</button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 200px;" class="align-middle">Integrasi Load</th>
                                                        <td class="align-middle"><span class="text-primary"><strong><?= $api['INTEGRASI_LOAD']; ?></strong></span></td>
                                                        <td style="width: 100px;" class="align-middle text-center">
                                                            <?php if (check_button('change_int_load') > 0) { ?>
                                                                <button class="btn btn-warning btn-sm waves-effect" type="button" data-bs-toggle="modal" data-bs-target="#load"><i class="ion ion-md-color-filter me-1"></i>Edit</button>
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

        <?php if (check_button('change_db_api') > 0) { ?>
            <div class="modal fade" id="db" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="nama">Change Database API</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('tools/change_db_api'); ?>">
                                <?= csrf(); ?>
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">Database<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="db" class="form-control" value="<?= $api['DATABASE']; ?>" required>
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

        <?php if (check_button('change_schema_api') > 0) { ?>
            <div class="modal fade" id="schema" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="nama">Change Schema API</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('tools/change_schema_api'); ?>">
                                <?= csrf(); ?>
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">Schema<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="schema" class="form-control" value="<?= $api['SCHEMA']; ?>" required>
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

        <?php if (check_button('change_int_token') > 0) { ?>
            <div class="modal fade" id="token" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="nama">Integrasi Token</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('tools/change_int_token'); ?>">
                                <?= csrf(); ?>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Link<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="token" class="form-control" value="<?= $api['INTEGRASI_TOKEN']; ?>" required>
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

        <?php if (check_button('change_int_load') > 0) { ?>
            <div class="modal fade" id="load" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="nama">Integrasi Load</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('tools/change_int_load'); ?>">
                                <?= csrf(); ?>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Link<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="load" class="form-control" value="<?= $api['INTEGRASI_LOAD']; ?>" required>
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
</body>

</html>