<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
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
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h6 class="page-title mb-0"><?= $ptitle; ?></h6>
                                <p class="card-text">#List Data <?= $ptitle; ?> Tahunan</p>
                            </div>
                            <?php if (check_button('add') > 0) {
                            ?>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary" type="button" onclick="window.location.href = '<?= base_url('rot/add'); ?>';">
                                                <i class="ion ion-md-add me-1"></i> Add Data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            ?>
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
                                                    <th style="width: 25px;">#</th>
                                                    <th>File</th>
                                                    <th>Tahun</th>
                                                    <th>Tipe</th>
                                                    <?php if (check_button('detail') > 0 || check_button('delete') > 0) {
                                                    ?>
                                                        <th class="text-center" style="width: 100px;">Actions</th>
                                                    <?php }
                                                    ?>
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

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

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
                    "processing": true,
                    "serverSide": true,
                    "pageLength": 20,
                    "ajax": {
                        "url": "<?php echo site_url('rot/get_data'); ?>",
                        "type": "POST"
                    },
                    'columnDefs': [{
                        "targets": [0, 2, 3, 4],
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

            function confirmDelete() {
                return confirm("Apakah anda yakin untuk menghapus data ini?")
            }
        </script>
</body>

</html>