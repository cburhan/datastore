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
                        <!-- end page title -->
                        <?= $this->session->flashdata('flash'); ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-center mb-5">
                                            <div class="col-lg-8">
                                                <div class="text-center faq-title pt-4 pb-4">
                                                    <div>
                                                        <i class="ion ion-ios-ribbon text-primary h1"></i>
                                                    </div>
                                                    <h4 class="text-primary">Hai, <?= get_session_name(); ?> !</h4>
                                                    <p class="text-muted mb-0">Selamat datang di <strong>P2EP Data Store</strong>.</p>
                                                    <p class="text-muted mb-0"><strong>P2EP Data Store</strong> digunakan sebagai tools dalam melakukan upload Manual Data Feeding <strong>P2EP</strong>.</p>
                                                </div>
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

        <!-- JAVASCRIPT -->
        <?php $this->load->view('template/js'); ?>
</body>

</html>