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
                                        <div class="row justify-content-center mb-0">
                                            <div class="col-lg-8">
                                                <div class="text-center faq-title">
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
                                <div class="row">
                                    <div class="col-xl-3 col-md-6">
                                        <div class="card mini-stat bg-primary text-white">
                                            <div class="card-body">
                                                <div class="mb-1">
                                                    <div class="float-start mini-stat-img me-4">
                                                        <img src="<?= base_url('assets/images/ro.png'); ?>" alt="" style="max-width: 38px !important">
                                                    </div>
                                                    <h6 class="font-size-12 text-uppercase text-white-50 mb-1">TOTAL DATA<br>RENCANA OPERASI</h6>
                                                    <h4 class="fw-medium font-size-24"><?= $ro_total; ?></h4>
                                                </div>
                                                <div class="pt-2">
                                                    <dl class="row mb-0">
                                                        <dt class="col-sm-8">
                                                            <p class="text-white-50 mb-0">Data ROT</p>
                                                        </dt>
                                                        <dd class="col-sm-4 text-end mb-0">
                                                            <p class="fw-medium mb-0"><?= $rot['ROT']; ?></p>
                                                        </dd>
                                                        <dt class="col-sm-8">
                                                            <p class="text-white-50 mb-0">Data ROB</p>
                                                        </dt>
                                                        <dd class="col-sm-4 text-end mb-0">
                                                            <p class="fw-medium mb-0"><?= $rob['ROB']; ?></p>
                                                        </dd>
                                                        <dt class="col-sm-8">
                                                            <p class="text-white-50 mb-0">Data ROM</p>
                                                        </dt>
                                                        <dd class="col-sm-4 text-end mb-0">
                                                            <p class="fw-medium mb-0"><?= $rom['ROM']; ?></p>
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <div class="card mini-stat bg-primary text-white">
                                            <div class="card-body">
                                                <div class="mb-1">
                                                    <div class="float-start mini-stat-img me-4">
                                                        <img src="<?= base_url('assets/images/bio.png'); ?>" alt="" style="max-width: 38px !important">
                                                    </div>
                                                    <h6 class="font-size-12 text-uppercase text-white-50 mb-1">TOTAL DATA<br>BIOMASSA</h6>
                                                    <h4 class="fw-medium font-size-24"><?= $bio_total; ?></h4>
                                                </div>
                                                <div class="pt-2">
                                                    <dl class="row mb-4">
                                                        <dt class="col-sm-8">
                                                            <p class="text-white-50 mb-0">Data Transaksi</p>
                                                        </dt>
                                                        <dd class="col-sm-4 text-end mb-0">
                                                            <p class="fw-medium mb-0"><?= $bio_t['BIO_T']; ?></p>
                                                        </dd>
                                                        <dt class="col-sm-8">
                                                            <p class="text-white-50 mb-0">Data Master</p>
                                                        </dt>
                                                        <dd class="col-sm-4 text-end mb-0">
                                                            <p class="fw-medium mb-0"><?= $bio_m['BIO_M']; ?></p>
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <div class="card mini-stat bg-primary text-white">
                                            <div class="card-body">
                                                <div class="mb-1">
                                                    <div class="float-start mini-stat-img me-4">
                                                        <img src="<?= base_url('assets/images/gas.png'); ?>" alt="" style="max-width: 38px !important">
                                                    </div>
                                                    <h6 class="font-size-12 text-uppercase text-white-50 mb-1">TOTAL DATA<br>GAS</h6>
                                                    <h4 class="fw-medium font-size-24"><?= $bio_total; ?></h4>
                                                </div>
                                                <div class="pt-2">
                                                    <dl class="row mb-4">
                                                        <dt class="col-sm-8">
                                                            <p class="text-white-50 mb-0">Data Transaksi</p>
                                                        </dt>
                                                        <dd class="col-sm-4 text-end mb-0">
                                                            <p class="fw-medium mb-0"><?= $bio_t['BIO_T']; ?></p>
                                                        </dd>
                                                        <dt class="col-sm-8">
                                                            <p class="text-white-50 mb-0">Data Master</p>
                                                        </dt>
                                                        <dd class="col-sm-4 text-end mb-0">
                                                            <p class="fw-medium mb-0"><?= $bio_m['BIO_M']; ?></p>
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <div class="card mini-stat bg-primary text-white">
                                            <div class="card-body">
                                                <div class="mb-1">
                                                    <div class="float-start mini-stat-img me-4">
                                                        <img src="<?= base_url('assets/images/bbm.png'); ?>" alt="" style="max-width: 38px !important">
                                                    </div>
                                                    <h6 class="font-size-12 text-uppercase text-white-50 mb-1">TOTAL DATA<br>BBM</h6>
                                                    <h4 class="fw-medium font-size-24"><?= $bio_total; ?></h4>
                                                </div>
                                                <div class="pt-2">
                                                    <dl class="row mb-4">
                                                        <dt class="col-sm-8">
                                                            <p class="text-white-50 mb-0">Data Transaksi</p>
                                                        </dt>
                                                        <dd class="col-sm-4 text-end mb-0">
                                                            <p class="fw-medium mb-0"><?= $bio_t['BIO_T']; ?></p>
                                                        </dd>
                                                        <dt class="col-sm-8">
                                                            <p class="text-white-50 mb-0">Data Master</p>
                                                        </dt>
                                                        <dd class="col-sm-4 text-end mb-0">
                                                            <p class="fw-medium mb-0"><?= $bio_m['BIO_M']; ?></p>
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card mini-stat bg-white">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">Latest ROT File</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-centered table-nowrap mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">File</th>
                                                                <th scope="col">Upload By</th>
                                                                <th scope="col">Upload On</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if ($last_rot != NULL) { ?>
                                                                <?php foreach ($last_rot as $d) : ?>
                                                                    <tr>
                                                                        <td><?= $d['FILE']; ?></td>
                                                                        <td><?= $d['CREATED_BY']; ?></td>
                                                                        <?php $tgl = date("Y-m-d", strtotime($d['CREATED_ON']));
                                                                        $jam = date("H:i:s", strtotime($d['CREATED_ON'])); ?>
                                                                        <td><?= $tgl . ' ' . $jam; ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php } else { ?>
                                                                <tr>
                                                                    <td colspan="3" class="text-center">Tidak Ada Data</td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">Latest ROB File</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-centered table-nowrap mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">File</th>
                                                                <th scope="col">Upload By</th>
                                                                <th scope="col">Upload On</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if ($last_rob != NULL) { ?>
                                                                <?php foreach ($last_rob as $d) : ?>
                                                                    <tr>
                                                                        <td><?= $d['FILE']; ?></td>
                                                                        <td><?= $d['CREATED_BY']; ?></td>
                                                                        <?php $tgl = date("Y-m-d", strtotime($d['CREATED_ON']));
                                                                        $jam = date("H:i:s", strtotime($d['CREATED_ON'])); ?>
                                                                        <td><?= $tgl . ' ' . $jam; ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php } else { ?>
                                                                <tr>
                                                                    <td colspan="3" class="text-center">Tidak Ada Data</td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">Latest ROM File</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-centered table-nowrap mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">File</th>
                                                                <th scope="col">Upload By</th>
                                                                <th scope="col">Upload On</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if ($last_rom != NULL) { ?>
                                                                <?php foreach ($last_rom as $d) : ?>
                                                                    <tr>
                                                                        <td><?= $d['FILE']; ?></td>
                                                                        <td><?= $d['CREATED_BY']; ?></td>
                                                                        <?php $tgl = date("Y-m-d", strtotime($d['CREATED_ON']));
                                                                        $jam = date("H:i:s", strtotime($d['CREATED_ON'])); ?>
                                                                        <td><?= $tgl . ' ' . $jam; ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php } else { ?>
                                                                <tr>
                                                                    <td colspan="3" class="text-center">Tidak Ada Data</td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="row">
                                                    <h4 class="card-title mb-4">Disk Space</h4>
                                                    <div class="col-lg-6">
                                                        <dl class="row mb-0">
                                                            <dt class="col-sm-6">
                                                                <p class="text-muted mb-0">Used Disk Space</p>
                                                            </dt>
                                                            <dd class="col-sm-6">
                                                                <h5 class="mb-0 font-size-15 text-primary"><?= formatBytes($useddisk); ?></h5>
                                                            </dd>
                                                            <dt class="col-sm-6">
                                                                <p class="text-muted mb-0">Free Disk Space</p>
                                                            </dt>
                                                            <dd class="col-sm-6">
                                                                <h5 class="mb-0 font-size-15 text-success"><?= formatBytes($freedisk); ?></h5>
                                                            </dd>
                                                            <dt class="col-sm-6">
                                                                <p class="text-muted mb-0">Total Disk Space</p>
                                                            </dt>
                                                            <dd class="col-sm-6">
                                                                <h5 class="mb-0 font-size-15 text-info"><?= formatBytes($totaldisk); ?></h5>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div id="pie-chart" class="mb-0">
                                                            <div id="pie-chart-container" class="flot-charts flot-charts-height">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <h4 class="card-title mb-4">Apps</h4>
                                                <dl class="row mb-0">
                                                    <dt class="col-sm-4">
                                                        <p class="text-muted mb-0">Version</p>
                                                    </dt>
                                                    <dd class="col-sm-8">
                                                        <h5 class="mb-0 font-size-15 text-primary"><?= lastVersion()['VER']; ?></h5>
                                                    </dd>
                                                    <dt class="col-sm-4">
                                                        <p class="text-muted mb-0">Last Update</p>
                                                    </dt>
                                                    <dd class="col-sm-8">
                                                        <?php
                                                        $tgl = date("Y-m-d", strtotime(lastVersion()['CREATED_ON']));
                                                        $jam = date("H:i:s", strtotime(lastVersion()['CREATED_ON']));
                                                        ?>
                                                        <h5 class="mb-0 font-size-15 text-primary"><?= tgl_indonesia($tgl) . ' ' . $jam; ?></h5>
                                                    </dd>
                                                    <dt class="col-sm-4">
                                                        <p class="text-muted mb-0">Total User</p>
                                                    </dt>
                                                    <dd class="col-sm-8">
                                                        <h5 class="mb-0 font-size-15 text-primary"><?= $user['U']; ?> Users</h5>
                                                    </dd>
                                                    <dt class="col-sm-4">
                                                        <p class="text-muted mb-0">Maintener</p>
                                                    </dt>
                                                    <dd class="col-sm-8">
                                                        <ul class="ps-3 text-primary">
                                                            <li>
                                                                <h5 class=" mb-0 font-size-15">Miftahu Choirul Burhan</h5>
                                                            </li>
                                                            <li>
                                                                <h5 class="mb-0 font-size-15">Reza Kamaluddin Isman</h5>
                                                            </li>
                                                        </ul>
                                                    </dd>
                                                </dl>
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
        <script src="<?= base_url('assets/'); ?>libs/flot-charts/jquery.flot.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/flot-charts/jquery.flot.time.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/flot-charts/jquery.flot.resize.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/flot-charts/jquery.flot.pie.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/flot-charts/jquery.flot.selection.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/flot-charts/jquery.flot.stack.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/flot.curvedlines/curvedLines.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/flot-charts/jquery.flot.crosshair.js"></script>
        <script>
            ! function(n) {
                "use strict";

                function t() {
                    this.$body = n("body"), this.$realData = []
                }
                t.prototype.createPieGraph = function(t, a, o, e) {
                    a = [{
                        label: a[0],
                        data: o[0]
                    }, {
                        label: a[1],
                        data: o[1]
                    }], o = {
                        series: {
                            pie: {
                                show: !0,
                                radius: 1
                            }
                        },
                        legend: {
                            show: !0,
                            backgroundColor: "transparent"
                        },
                        grid: {
                            hoverable: !0,
                            clickable: !0
                        },
                        colors: e,
                        height: '10%',
                    };
                    n.plot(n(t), a, o)
                }, t.prototype.init = function() {
                    this.createPieGraph("#pie-chart #pie-chart-container", ["Used", "Free"], [<?= $useddisk; ?>, <?= $freedisk; ?>], ["#3c4ccf", "#02a499"]);
                }, n.FlotChart = new t, n.FlotChart.Constructor = t
            }(window.jQuery),
            function() {
                "use strict";
                window.jQuery.FlotChart.init()
            }();
        </script>
</body>

</html>