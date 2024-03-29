<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <style>
        .smalls,
        smalls {
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
                                <h6 class="page-title mb-0"><?= $ptitle; ?></h6>
                                <p class="card-text">#Detail Data <?= $title; ?> Bulanan</p>
                            </div>
                            <div class="col-md-4">
                                <div class="float-end d-none d-md-block">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-warning waves-effect waves-light" type="button" onclick="window.location.href = '<?= base_url('bio_trans'); ?>';">
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
                                            <dt class="col-sm-2">Periode</dt>
                                            <dd class="col-sm-8 mb-0"><?= $file['BULAN'] . ' ' . $file['TAHUN']; ?></dd>
                                        </dl>
                                        <dl class="row mb-0">
                                            <dt class="col-sm-2">Nama File</dt>
                                            <dd class="col-sm-8 mb-0"><?= $file['FILE']; ?></dd>
                                        </dl>
                                        <dl class="row mb-0">
                                            <dt class="col-sm-2">Upload By</dt>
                                            <dd class="col-sm-8 mb-0"><?= $file['CREATED_BY']; ?></dd>
                                        </dl>
                                        <dl class="row mb-0">
                                            <dt class="col-sm-2">Upload On</dt>
                                            <?php
                                            $tgl_out = date("Y-m-d", strtotime($file['CREATED_ON']));
                                            $jam_out = date("H:i:s", strtotime($file['CREATED_ON']));
                                            ?>
                                            <dd class="col-sm-8 mb-0"><?= tgl_indo($tgl_out) . " " . $jam_out; ?></dd>
                                        </dl>
                                    </div>
                                    <div class="card-body">
                                        <div class="input-group">
                                            <span class="input-group-text">Cari Data</span>
                                            <input type="text" class="form-control form-control-sm" placeholder="Masukkan Keyword" id="search">
                                            <button class="btn btn-sm light btn-dark" type="button" id="btn-reset"><i class="fa-solid fa-refresh me-1"></i>Reset</button>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="mytable" class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <th class="p-1 text-center align-middle">
                                                        <smalls>#</smalls>
                                                    </th>
                                                    <th class="p-1 align-middle">
                                                        <smalls>Pembangkit</smalls>
                                                    </th>
                                                    <th class="p-1 align-middle">
                                                        <smalls>Pemasok</smalls>
                                                    </th>
                                                    <th class="p-1 text-center align-middle">
                                                        <smalls>Jenis Biomassa</smalls>
                                                    </th>
                                                    <th class="p-1 text-center align-middle">
                                                        <smalls>Bulan</smalls>
                                                    </th>
                                                    <th class="p-1 text-center align-middle">
                                                        <smalls>Tahun</smalls>
                                                    </th>
                                                    <th class="p-1 align-middle">
                                                        <smalls>No Kontrak</smalls>
                                                    </th>
                                                    <th class="p-1 text-center align-middle">
                                                        <smalls>Tgl Mulai Kontrak</smalls>
                                                    </th>
                                                    <th class="p-1 text-center align-middle">
                                                        <smalls>Tgl Selesai Kontrak</smalls>
                                                    </th>
                                                    <th class="p-1 align-middle">
                                                        <smalls>No Amd</smalls>
                                                    </th>
                                                    <th class="p-1 text-center align-middle">
                                                        <smalls>Tgl Mulai Amd</smalls>
                                                    </th>
                                                    <th class="p-1 text-center align-middle">
                                                        <smalls>Tgl Selesai Amd</smalls>
                                                    </th>
                                                    <th class="p-1 text-center align-middle">
                                                        <smalls>Harga Satuan</smalls>
                                                    </th>
                                                    <th class="p-1 text-center align-middle">
                                                        <smalls>Kalori Kontrak</smalls>
                                                    </th>
                                                    <th class="p-1 text-center align-middle">
                                                        <smalls>Kalori Realisasi</smalls>
                                                    </th>
                                                    <th class="p-1 text-center align-middle">
                                                        <smalls>Volume Konfirmasi</smalls>
                                                    </th>
                                                    <th class="p-1 text-center align-middle">
                                                        <smalls>Volume Realisasi</smalls>
                                                    </th>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0;
                                                    $s = 1; ?>
                                                    <?php foreach ($sheet as $f) : ?>
                                                        <?php if ($s > 1) : ?>
                                                            <tr>
                                                                <td class="p-1 text-center">
                                                                    <smalls><?= $i; ?>
                                                                </td>
                                                                <td class="p-1">
                                                                    <smalls><?= ($f['A'] != NULL ? get_pembangkit($f['A']) : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1">
                                                                    <smalls><?= ($f['D'] != NULL ? $f['D'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1">
                                                                    <smalls><?= ($f['E'] != NULL ? $f['E'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1 text-center">
                                                                    <smalls><?= ($f['F'] != NULL ? bulan($f['F']) : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1 text-center">
                                                                    <smalls><?= ($f['G'] != NULL ? $f['G'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1">
                                                                    <smalls><?= ($f['I'] != NULL ? $f['I'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1 text-center">
                                                                    <smalls><?= ($f['J'] != NULL ? $f['J'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1 text-center">
                                                                    <smalls><?= ($f['K'] != NULL ? $f['K'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1">
                                                                    <smalls><?= ($f['M'] != NULL ? $f['M'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1 text-center">
                                                                    <smalls><?= ($f['N'] != NULL ? $f['N'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1 text-center">
                                                                    <smalls><?= ($f['O'] != NULL ? $f['O'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1 text-center">
                                                                    <smalls><?= ($f['P'] != NULL ? $f['P'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1 text-center">
                                                                    <smalls><?= ($f['Q'] != NULL ? $f['Q'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1 text-center">
                                                                    <smalls><?= ($f['R'] != NULL ? $f['R'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1 text-center">
                                                                    <smalls><?= ($f['S'] != NULL ? $f['S'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                                <td class="p-1 text-center">
                                                                    <smalls><?= ($f['T'] != NULL ? $f['T'] : '<span class="text-danger">No data</span>'); ?></smalls>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                        <?php $i++;
                                                        $s++; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
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