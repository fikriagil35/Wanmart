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
    if ($role_id == 1) : ?>


        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/penghutang'); ?>">
                <i class="fas fa-fw fa-book-open"></i>
                <span>Penghutang</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/pesan'); ?>">
                <i class="fas fa-fw fa-comments"></i>
                <span>Pesan</span></a>
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
        <a class="nav-link" href="<?= base_url('user/gantipassword'); ?>">
            <i class="fas fa-fw fa-key"></i>
            <span>Ganti Password</span></a>
    </li>
    <?php
    if ($role_id == 2) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('user/pesan'); ?>">
                <i class="fas fa-fw fa-comments"></i>
                <span>Pesan</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('user/hutang'); ?>">
                <i class="fas fa-fw fa-comments"></i>
                <span>Hutang Saya</span></a>
        </li>
    <?php else : ?>
    <?php endif; ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Keluar</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->