<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <style>
        .smalls,
        smalls {
            font-size: 100%;
        }

        .smalld,
        smalld {
            font-size: 85%;
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
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h6 class="page-title mb-0"><?= $ptitle; ?></h6>
                                <p class="card-text">#List Data <?= $title; ?></p>
                            </div>
                            <div class="col-md-4">
                                <div class="float-end d-none d-md-block">
                                    <div class="dropdown">
                                        <?php if (check_button('publish') > 0) {
                                        ?>
                                            <button class="btn btn-sm btn-success" type="button" onclick="window.location.href = '<?= base_url('kit_demand_tahunan/publish'); ?>';">
                                                <i class="ion ion-md-rocket me-1"></i> Publish
                                            </button>
                                        <?php }
                                        ?>
                                        <?php if (check_button('upload') > 0) {
                                        ?>
                                            <button class="btn btn-sm btn-primary" type="button" onclick="window.location.href = '<?= base_url('kit_demand_tahunan/upload'); ?>';">
                                                <i class="ion ion-md-add me-1"></i> Add Data
                                            </button>
                                        <?php }
                                        ?>
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
                                                    <th>
                                                        <smalls>Kode</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>Pembangkit</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>Sistem</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>Bahan Bakar</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>Kebutuhan Pembangkit</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>CF (%)</smalls>
                                                    </th>
                                                    <th>
                                                        <smalls>Tahun</smalls>
                                                    </th>
                                                    <?php if (check_button('edit') > 0 || check_button('delete') > 0) {
                                                    ?>
                                                        <th class="text-center" style="width: 50px;">
                                                            <smalls>Actions</smalls>
                                                        </th>
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
                        "url": "<?= site_url('kit_demand_tahunan/get_data'); ?>",
                        "type": "POST"
                    },
                    'columnDefs': [{
                        "targets": [0, 4, 5, 6],
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