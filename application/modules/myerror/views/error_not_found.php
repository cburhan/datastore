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
            Content body start
        ***********************************-->
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-xl-12">
                    <div class="text-center">
                        <img src="<?= base_url('public/error/404.png'); ?>" width="400px" alt="">
                        <p class="error-head">Maaf, halaman tidak ditemukan.<br>Silahkan hubungi administrator</p>
                        <div class="text-center">
                            <a href=" <?= base_url('/'); ?>" class="btn btn-sm btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
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