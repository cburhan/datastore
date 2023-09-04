<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
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
                                <p class="card-text">#Akses Role <strong><?= $role['ROLE']; ?></strong></p>
                            </div>
                            <div class="col-md-4">
                                <div class="float-end d-none d-md-block">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-warning waves-effect waves-light" type="button" onclick="window.location.href = '<?= base_url('role'); ?>';">
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
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="input-group">
                                                    <span class="input-group-text">Cari Data</span>
                                                    <input type="text" class="form-control" placeholder="Masukkan Keyword" id="search">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <form id="form-filter">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <select name="menu" class="form-control menu-select <?= form_error('menu', 'is-invalid '); ?>">
                                                                <option></option>
                                                                <?php foreach ($menu as $m) : ?>
                                                                    <option value="<?= $m['ID']; ?>"><?= $m['MENU']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-4 text-end">
                                                            <button type="button" id="btn-filter" class="btn btn-sm btn-dark waves-effect waves-light">
                                                                <i class="fas fa-filter me-1"></i>Filter
                                                            </button>
                                                            <button type="button" id="btn-reset2" class="btn btn-sm btn-outline-dark waves-effect waves-light">
                                                                <i class="ion ion-md-refresh me-1"></i>Reset
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <table id="mytable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 25px;">#</th>
                                                    <th>Menu</th>
                                                    <th>Sub Menu</th>
                                                    <th style="width: 50px;">Actions</th>
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
        <script src="<?= base_url('assets/'); ?>libs/select2/js/select2.min.js"></script>
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
                        url: "<?= base_url() . 'role/get_data_access/' . $this->uri->segment(3); ?>",
                        type: "POST",
                        "data": function(data) {
                            data.menu = $('.menu-select').val();
                        }
                    },
                    'columnDefs': [{
                        "targets": [0, 3],
                        "className": "text-center",
                    }]
                });
                $('#btn-filter').click(function() {
                    $('#mytable').DataTable().ajax.reload();
                });
                $('#btn-reset2').click(function() {
                    $('#form-filter')[0].reset();
                    $('#search').val('');
                    $('#mytable').DataTable().ajax.reload();
                    $('#mytable').DataTable().search(this.value).draw();
                });
                $('#search').keyup(function() {
                    table.search($(this).val()).draw();
                })
                $('#mytable').on('click', '.form-check-input', function() {
                    const roleId = $(this).data('role');
                    const subMenuId = $(this).data('submenu');

                    $.ajax({
                        url: "<?= base_url('role/change_access'); ?>",
                        type: 'POST',
                        data: {
                            roleId: roleId,
                            subMenuId: subMenuId
                        },

                        success: function() {
                            document.location.href = "<?= base_url('role/access/'); ?>" + roleId;
                        }
                    });
                });
            });

            $(function() {
                'use strict'

                $(".menu-select").select2({
                    placeholder: 'Pilih Data'
                });
            });
        </script>
</body>

</html>