<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <?php $this->load->view('template/loader'); ?>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Header start
        ***********************************-->
        <?php $this->load->view('template/header'); ?>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php $this->load->view('template/menu'); ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row mb-5">
                    <div class="col-xl-12 mb-5">
                        <div class="text-center mb-5">
                            <img src="<?= base_url('public/error/404.png'); ?>" width="250px" alt="">
                            <p class="error-head mb-5">Maaf, halaman tidak ditemukan.<br>Silahkan hubungi administrator</p>
                            <br>
                            <div class="text-center mb-5">
                                <a href=" <?= base_url('home'); ?>" class="btn btn-sm btn-primary">BACK TO HOMEPAGE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <?php $this->load->view('template/footer'); ?>
        <!--**********************************
            Footer end
        ***********************************-->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <?php $this->load->view('template/js'); ?>
</body>

</html>