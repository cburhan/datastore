<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a class="logo logo-dark" href="<?= base_url(); ?>">
                    <span class="logo-sm">
                        <img src="<?= base_url('public/apps/') . apps()['LOGO']; ?>" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url('public/apps/') . apps()['LOGO_BIG']; ?>" alt="" height="17">
                    </span>
                </a>

                <a class="logo logo-light" href="<?= base_url(); ?>">
                    <span class="logo-sm">
                        <img src="<?= base_url('public/apps/') . apps()['LOGO']; ?>" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url('public/apps/') . apps()['LOGO_BIG']; ?>" alt="" height="18">
                    </span>
                </a>

            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>
            <div class="d-none d-sm-block">
                <div class="dropdown pt-3 d-inline-block">
                    <a class="btn btn-link waves-effect">
                        <strong>
                            <span>
                                <?= nama_hari(date('Y-m-d')) . ", " . tgl_indonesia(date('Y-m-d')); ?>
                            </span>
                            <span id="waktu"></span>
                        </strong>
                    </a>
                </div>
            </div>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>

            <?php $notification = notif(get_session_id()); ?>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="badge bg-danger rounded-pill"><?= count($notification); ?></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-16"> Notifications (<?= count($notification); ?>) </h5>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <?php if ($notification != NULL) { ?>
                            <?php foreach ($notification as $notif) { ?>
                                <a href="<?= base_url('notif/readThenRedirect/') . encrypt_url($notif['ID']); ?>" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title bg-<?= $notif['COLOR']; ?> rounded-circle font-size-16">
                                                    <i class="ti ti-<?= $notif['ICON']; ?>"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1"><?= $notif['SUBJECT']; ?></h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1"><?= $notif['MESSAGE']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="d-grid">
                                <a class="btn btn-sm font-size-14 text-center">
                                    Tidak ada notifikasi
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="<?= base_url('notif'); ?>">
                                View all
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?= base_url('public/user/') . '' . get_session_image(); ?>" alt="Header Avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item text-primary"><?= get_session_name(); ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-muted" href="<?= base_url('myprofile'); ?>"><i class="ti ti-user font-size-17 align-middle me-1"></i> Profile</a>
                    <a class="dropdown-item text-muted" href="<?= base_url('changelog'); ?>"><i class="ti-vector font-size-17 align-middle me-1"></i> Changelog</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="<?= base_url('logout'); ?>"><i class="ti ti-power-off font-size-17 align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>