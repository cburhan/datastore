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

            <div class="authentication-bg d-flex align-items-center pb-0 vh-100">
                <div class="content-center w-100">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-lg-5 ms-auto">
                                                <div class="ex-page-content">
                                                    <h1 class="text-dark display-1 mt-4">404!</h1>
                                                    <h3 class="mb-0">Not Found.</h3>
                                                    <p class="mb-5">Maaf, halaman tidak ditemukan.<br>Silahkan hubungi administrator.</p>
                                                    <a class="btn btn-primary mb-5 waves-effect waves-light" href="<?= base_url('home'); ?>"><i class="ti ti-home me-1"></i> Back to Home</a>
                                                </div>

                                            </div>
                                            <div class="col-lg-5 mx-auto">
                                                <img src="<?= base_url('public/error/404.png'); ?>" alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!--end row-->
                    </div>
                    <!-- end container -->
                </div>

            </div>

            <?php $this->load->view('template/footer'); ?>

        </div>
        <!-- End Page -->

        <!-- JAVASCRIPT -->
        <?php $this->load->view('template/js'); ?>
</body>

</html>