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
                        <div class="row align-items-center mb-2">
                            <div class="col-md-8">
                                <h6 class="page-title mb-0"><?= $title; ?></h6>
                                <p class="card-text">#List Data <?= $title; ?></p>
                            </div>
                            <?php if (check_button('add') > 0) {
                            ?>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary" type="button" onclick="window.location.href = '<?= base_url('submenu/add'); ?>';">
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
                                                    <th>Menu</th>
                                                    <th>Title</th>
                                                    <th>Sub Menu</th>
                                                    <th>URL</th>
                                                    <?php if (check_button('change_status') > 0) {
                                                    ?>
                                                        <th style="width: 50px;">Tampil</th>
                                                    <?php }
                                                    ?>
                                                    <?php if (check_button('edit') > 0 || check_button('delete') > 0) {
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
                        "url": "<?php echo site_url('submenu/get_data'); ?>",
                        "type": "POST"
                    },
                    'columnDefs': [{
                        "targets": [0, 5],
                        "className": "text-center",
                    }]
                });
                $('#search').keyup(function() {
                    table.search($(this).val()).draw();
                })
                $('#btn-reset').click(function() {
                    $('#search').val('');
                    $('#table1').DataTable().search(this.value).draw();
                });
            });

            $('#mytable').on('click', '.form-check-input', function() {
                const subMenuId = $(this).data('submenu');
                const activeId = $(this).data('active');

                $.ajax({
                    url: "<?= base_url('submenu/change_status'); ?>",
                    type: 'POST',
                    data: {
                        subMenuId: subMenuId,
                        activeId: activeId
                    },

                    success: function() {
                        document.location.href = "<?= base_url('submenu'); ?>";
                    }
                });
            });

            function confirmDelete() {
                return confirm("Apakah anda yakin untuk menghapus data ini?")
            }
        </script>
</body>

</html>