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
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body p-0">
                                <div id="DZ_W_TimeLine11" class="widget-timeline dz-scroll style-1 height500 my-4 px-4">
                                    <?php if ($ver != NULL) { ?>
                                        <ul class="timeline">
                                            <?php foreach ($ver as $v) { ?>
                                                <li>
                                                    <div class="timeline-badge primary"></div>
                                                    <a class="timeline-panel">
                                                        <?php $tgl = date("Y-m-d", strtotime($v['CREATED_ON'])); ?>
                                                        <span><?= tgl_indonesia($tgl); ?></span>
                                                        <h6 class="mb-0"><strong class="text-primary"><?= $v['VER']; ?></strong></h6>
                                                        <pre class="mb-0 border p-2 ps-5"><?= $v['DETAIL']; ?></pre>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } else { ?>
                                        <p class="tx-14 text-center mg-t-30">Tidak ada data</p>
                                    <?php } ?>
                                </div>
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