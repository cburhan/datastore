<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('template/head'); ?>
</head>

<body style="background-image:url('<?= base_url('public/apps/') . apps()['BG']; ?>'); background-position-y:top; background-size:cover;">
    <div class="account-pages my-5 pt-5 mb-0">
        <div class="container pt-3">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card overflow-hidden">
                        <div class="bg-primary">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20 mb-0"><?= apps()['NAME']; ?></h5>
                                <p class="text-white-50">Silahkan Log In untuk masuk ke sistem</p>
                                <a href="index.html" class="logo logo-admin">
                                    <img src="<?= base_url('public/apps/') . apps()['LOGO']; ?>" height="32" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4 pt-3 pb-0">
                            <div class="pt-5 pb-2">
                                <?= $this->session->flashdata('flash'); ?>
                                <form method="POST" action="<?= base_url('auth'); ?>">
                                    <?= csrf(); ?>
                                    <div class="mb-2">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" class="form-control <?= form_error('username', 'is-invalid '); ?> mb-0" placeholder="Masukkan Username" autofocus name="username" value="<?= set_value('username'); ?>">
                                        <?= form_error('username', '<div class="invalid-feedback">', '</div>'); ?>
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password" class="form-control <?= form_error('password', 'is-invalid '); ?> mb-0" placeholder="Masukkan Password">
                                            <button class="btn btn-primary" onclick="cek()" type="button"><i class="ion ion-md-eye"></i></button>
                                            <?= form_error('password', '<div class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 offset-sm-6 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <p class="mb-0"><small>Copyright ©2023 Developed by Bidang TIG ~ <span class="text-primary"><?= lastVersion()['VER']; ?><span><small></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="<?= base_url('assets/'); ?>libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/'); ?>libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url('assets/'); ?>libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url('assets/'); ?>libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/app.js"></script>
    <script>
        function cek() {
            var type = document.getElementById("password").type;
            if (type == 'password') {
                document.getElementById("password").type = "text";
            } else {
                document.getElementById("password").type = "password";
            }
        }
    </script>
</body>

</html>