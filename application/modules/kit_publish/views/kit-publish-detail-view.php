<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <style>
        .smalls,
        smalls {
            font-size: 70%;
        }

        .smalld,
        smalld {
            font-size: 60%;
        }
    </style>
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
                                <h6 class="page-title mb-0">Detail Data <?= $title; ?></h6>
                                <?php
                                $tgl_out = date("Y-m-d", strtotime($pub['PUBLISH_ON']));
                                $jam_out = date("H:i:s", strtotime($pub['PUBLISH_ON']));;
                                ?>
                                <p class="card-text">Publish By <?= '<strong>' . $pub['PUBLISH_BY'] . '</strong> On <strong>' . tgl_indo($tgl_out) . ' ' . $jam_out . '</strong>'; ?></p>
                            </div>
                            <div class="col-md-4">
                                <div class="float-end d-none d-md-block">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-warning waves-effect waves-light" type="button" onclick="window.location.href = '<?= base_url('kit_publish'); ?>';">
                                            <i class="ion ion-md-arrow-back me-1"></i> Kembali
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <?= $this->session->flashdata('flash'); ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="input-group">
                                            <span class="input-group-text">Cari Data</span>
                                            <input type="text" class="form-control" placeholder="Masukkan Keyword" id="search">
                                            <button class="btn light btn-dark" type="button" id="btn-reset"><i class="fa-solid fa-refresh me-1"></i>Reset</button>
                                        </div>
                                        <table id="mytable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 25px;">
                                                        <smalls>#</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>KODE PEMBANGKIT</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>TIPE</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>NAMA PEMBANGKIT</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>KEPEMILIKAN</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>REGIONAL</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>SISTEM</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>DAYA TERPASANG</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>BB</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>GAS</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>LNG</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>BIO</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>BBM</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>STATUS</smalls>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
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
        <script src="<?= base_url('assets/'); ?>libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script type="text/javascript">
            var token = "<?= $this->security->get_csrf_hash(); ?>";
            var table;

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
                    "pageLength": 10,
                    "ajax": {
                        "url": "<?= site_url('kit_publish/get_data_detail/') . $detail_id; ?>",
                        "type": "POST"
                    },
                    'columnDefs': [{
                        "targets": [0, 7, 8, 9, 10, 11, 12, 13],
                        "className": "text-center",
                    }]
                });
                $('#search').keyup(function() {
                    table.search($(this).val()).draw();
                })
                $('#btn-reset').click(function() {
                    $('#search').val('');
                    $('#mytable').DataTable().search(this.value).draw();
                });
            });
        </script>
</body>

</html>