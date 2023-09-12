<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <style>
        .smalls,
        smalls {
            font-size: 90%;
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
                                <h6 class="page-title mb-0"><?= $ptitle; ?></h6>
                                <p class="card-text">#Detail Data <?= $title; ?></p>
                            </div>
                            <div class="col-md-4">
                                <div class="float-end d-none d-md-block">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-warning waves-effect waves-light" type="button" onclick="window.location.href = '<?= base_url('rom'); ?>';">
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
                                    <div class="card-body border-bottom border-1">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-2">Template</dt>
                                            <dd class="col-sm-4 mb-0"><?= $file['TEMPLATE']; ?></dd>
                                            <dt class="col-sm-2">Upload By</dt>
                                            <dd class="col-sm-4 mb-0"><?= $file['CREATED_BY']; ?></dd>
                                            <dt class="col-sm-2">Nama File</dt>
                                            <dd class="col-sm-4 mb-0"><?= $file['FILE']; ?></dd>
                                            <dt class="col-sm-2">Upload On</dt>
                                            <?php
                                            $tgl_out = date("Y-m-d", strtotime($file['CREATED_ON']));
                                            $jam_out = date("H:i:s", strtotime($file['CREATED_ON']));
                                            ?>
                                            <dd class="col-sm-4 mb-0"><?= tgl_indo($tgl_out) . " " . $jam_out; ?></dd>
                                        </dl>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="mytable" class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <?php foreach ($sheet as $f) : ?>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalls><?= $f['A']; ?></smalls>
                                                        </th>
                                                        <th class="p-1 align-middle">
                                                            <smalls>Pembangkit</smalls>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalls>Sistem</smalls>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalls>Tgl Start</smalls>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalls>Tgl End</smalls>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalls>Bahan Bakar</smalls>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalls>DMN (MW)</smalls>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalls>Penerimaan Energi (MWh)</smalls>
                                                        </th>
                                                        <th class="p-1 text-center align-middle">
                                                            <smalls>CF (%)</smalls>
                                                        </th>
                                                    <?php endforeach; ?>
                                                </thead>
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
                    "pageLength": 10
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