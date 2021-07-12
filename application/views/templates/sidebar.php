<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Wanmart</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <?php
    $role_id = $this->session->userdata('role_id');
    ?>
    <?php if ($role_id == 1) : ?>


        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/catatan'); ?>">
                <i class="fas fa-fw fa-book-open"></i>
                <span>Catatan Hutang</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/lunas'); ?>">
                <i class="fas fa-fw fa-handshake"></i>
                <span>Hutang Lunas</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/pesan'); ?>">
                <i class="fas fa-fw fa-comments"></i>
                <span>Fitur Pesan</span></a>
        </li>
    <?php else : ?>
    <?php endif; ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user'); ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Profil Saya</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/edit'); ?>">
            <i class="fas fa-fw fa-edit"></i>
            <span>Edit Profil</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/hutang'); ?>">
            <i class="fas fa-fw fa-money-check-alt"></i>
            <span>Hutang Aktif</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/gantipassword'); ?>">
            <i class="fas fa-fw fa-key"></i>
            <span>Ganti Password</span></a>
    </li>
    <?php
    $role_id = $this->session->userdata('role_id');
    ?>
    <?php if ($role_id == 2) : ?>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('user/pesan'); ?>">
                <i class="fas fa-fw fa-comments"></i>
                <span>Fitur Pesan</span></a>
        </li>
    <?php else : ?>
    <?php endif; ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Keluar</span></a>
    </li>


    <!-- Query Menu -->
    <!-- ?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`, `menu`
                        FROM `user_menu` JOIN `user_access_menu`
                            ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                        WHERE `user_access_menu`.`role_id` = $role_id
                    ORDER BY `user_access_menu`.`menu_id`ASC
       ";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>

     Looping Menu 
    ?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>

        Sub Menu 
        ?php
        $menuId = $m['id'];
        $querysubMenu = "SELECT *
                            FROM  `user_sub_menu` JOIN `user_menu`
                              ON  `user_sub_menu`.`menu_id` = `user_menu`.`id`
                            WHERE `user_sub_menu`.`menu_id` = $menuId
                              AND `user_sub_menu`.`is_active` = 1
                    ";
        $subMenu = $this->db->query($querysubMenu)->result_array();
        ?>

        ?php foreach ($subMenu as $sm) : ?>
        ?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                ?php else : ?>
                <li class="nav-item">
                ?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>
            ?php endforeach; ?>

            <hr class="sidebar-divider mt-2">

        ?php endforeach; ?> -->



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->