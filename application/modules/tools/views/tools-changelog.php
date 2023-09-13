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
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <?php if ($ver != NULL) { ?>
                                            <ol class="activity-checkout mb-0 px-4 mt-3">
                                                <?php foreach ($ver as $v) { ?>
                                                    <li class="checkout-item">
                                                        <div class="avatar-sm checkout-icon p-1">
                                                            <div class="avatar-title rounded-circle bg-primary">
                                                                <i class="ti-vector text-white font-size-20"></i>
                                                            </div>
                                                        </div>
                                                        <div class="feed-item-list">

                                                            <h5 class="font-size-16 text-primary mb-0"><?= $v['VER']; ?></h5>
                                                            <?php
                                                            $tgl_out = date("Y-m-d", strtotime($v['CREATED_ON']));
                                                            $jam_out = date("H:i:s", strtotime($v['CREATED_ON']));
                                                            ?>
                                                            <small class="text-muted"><?= tgl_indo($tgl_out) . " " . $jam_out; ?></small>
                                                            <div class="alert alert-dark mb-0" role="alert" style="font-family: var(--bs-font-monospace);">
                                                                <span class="text-muted font-size-12"><?= $v['DETAIL']; ?></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ol>
                                        <?php } else { ?>
                                            <p class="text-muted text-center">Tidak ada data</p>
                                        <?php } ?>
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