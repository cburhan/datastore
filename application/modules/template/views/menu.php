<?php
$role_id = get_session_role();
if ($role_id != NULL) {
    $roles = array_column($role_id, 'ROLE_ID');
} else {
    $roles = [0];
}
$menu = query_menu($roles);
?>

<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main Menu</li>
                <?php foreach ($menu as $m) : ?>
                    <?php
                    $menu_id = $m['ID'];
                    $subMenu = query_submenu($menu_id, $roles);
                    ?>
                    <?php if (query_jumlah_menu($menu_id, $roles) > 1) : ?>
                        <li <?= ($ptitle == $m['MENU']) ? 'class="mm-active"' : ''; ?>>
                            <a href="javascript: void(0);" class="has-arrow waves-effect <?= ($ptitle == $m['MENU']) ? 'class="mm-active"' : ''; ?>">
                                <i class="<?= $m['ICON']; ?>"></i>
                                <span><?= $m['MENU']; ?></span>
                            </a>
                            <ul class="sub-menu <?= ($ptitle == $m['MENU']) ? 'class="mm-collapse mm-show"' : ''; ?>" aria-expanded="false">
                                <?php foreach ($subMenu as $sm) : ?>
                                    <li <?= ($ptitle == $m['MENU'] && $title == $sm['TITLE']) ? 'class="mm-active"' : ''; ?>>
                                        <a href="<?= base_url($sm['URL']); ?>" <?= ($ptitle == $m['MENU'] && $title == $sm['TITLE']) ? 'class="active"' : ''; ?>>
                                            <?= $sm['TITLE']; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php else : ?>
                        <?php foreach ($subMenu as $sm) : ?>
                            <li <?= ($ptitle == $m['MENU']) ? 'class="mm-active"' : ''; ?>>
                                <a href="<?= base_url($sm['URL']); ?>" class="waves-effect <?= ($ptitle == $m['MENU']) ? 'active' : ''; ?>">
                                    <i class="<?= $m['ICON']; ?>"></i>
                                    <span><?= $sm['TITLE']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>