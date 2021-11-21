<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $judul; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/AdminLTE/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.css">
    <!-- iziToast -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/AdminLTE/plugins/izitoast/dist/css/iziToast.min.css">
    <!-- select2 -->
    <link href="<?= base_url(); ?>assets/AdminLTE/plugins/select2/css/select2.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> -->
    <!-- smartWizard -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/AdminLTE/plugins/jquery-smartwizard-master/dist/css/smart_wizard_all.min.css">
    <!-- dataTables -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/AdminLTE/plugins/datatables-autofill/css/autoFill.bootstrap4.min.css">
    <!-- my css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/custom.css">
    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/AdminLTE/plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?= base_url(); ?>assets/img/suzuki-invoice.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
                <img src="<?= base_url(); ?>assets/img/suzuki-invoice.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text  text-bold">SUZUKI</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url(); ?>assets/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $users['nama_pegawai']; ?></a>
                        <a href="#" class="d-block text-sm mt-2"><i class="fas fa-circle text-success text-sm"></i> <?= $users['nama_posisi']; ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php
                        ini_set('display_errors', 1);
                        ini_set('display_startup_errors', 1);
                        error_reporting(E_ALL);
                        $level_id = $this->session->userdata('level_id');
                        $this->db->select('tb_user_menu.*');
                        $this->db->from('tb_user_menu');
                        $this->db->join('tb_user_access_menu', 'tb_user_access_menu.menu_id = tb_user_menu.id');
                        $this->db->where('level_id', $level_id);
                        $this->db->order_by('id', 'ASC');

                        $query = $this->db->get()->result_array();
                        foreach ($query as $menu) :
                        ?>
                            <li class="nav-header text-uppercase text-bold"><?= $menu['nama_menu']; ?></li>
                            <?php
                            $menu_id = $menu['id'];
                            $this->db->select('tb_user_sub_menu.*');
                            $this->db->from('tb_user_sub_menu');
                            $this->db->join('tb_user_menu', 'tb_user_sub_menu.menu_id = tb_user_menu.id');
                            $this->db->where('menu_id', $menu_id);
                            $this->db->where('is_active', 1);
                            $query_subMenu = $this->db->get()->result_array();
                            foreach ($query_subMenu as $sub_menu) :
                                if ($sub_menu['dropdown'] == 1) :
                            ?>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link text-sm">
                                            <i class="nav-icon text-sm <?= $sub_menu['icon']; ?>"></i>
                                            <p>
                                                <?= $sub_menu['sub_menu']; ?>
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>
                                        <?php
                                        $sub_menu_id = $sub_menu['id'];
                                        $this->db->select('dropdown_menu.*');
                                        $this->db->from('dropdown_menu');
                                        $this->db->join('tb_user_sub_menu', 'dropdown_menu.sub_menu_id = tb_user_sub_menu.id');
                                        $this->db->where('sub_menu_id', $sub_menu_id);
                                        $query_dropdown = $this->db->get()->result_array();
                                        ?>
                                        <ul class="nav nav-treeview">
                                            <?php foreach ($query_dropdown as $dropdown) : ?>
                                                <li class="nav-item">
                                                    <a href="<?= base_url($dropdown['url']); ?>" class="nav-link text-sm">
                                                        <i class="far fa-circle nav-icon text-sm"></i>
                                                        <p><?= $dropdown['dropdown_nama']; ?></p>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php else : ?>
                                    <li class="nav-item">
                                        <a href="<?= base_url($sub_menu['url']) ?>" class="nav-link text-sm">
                                            <i class="nav-icon text-sm <?= $sub_menu['icon']; ?>"></i>
                                            <p>
                                                <?= $sub_menu['sub_menu']; ?>
                                                <!-- <span class="badge badge-info right">2</span> -->
                                            </p>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">