<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo base_url('admin') ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b></b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b></b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php foreach ($avatar as $a) { ?>
                                    <img src="<?php echo base_url('assets/upload/user/img/' . $a->nama_file) ?>" class="user-image" alt="User Image">
                                <?php } ?>
                                <span class="hidden-xs"><?= $this->session->userdata('name') ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <?php foreach ($avatar as $a) { ?>
                                        <img src="<?php echo base_url('assets/upload/user/img/' . $a->nama_file) ?>" class="img-circle" alt="User Image">
                                    <?php } ?>
                                    <p>
                                        <?= $this->session->userdata('name') ?> - Web Developer
                                        <small>Last Login : <?= $this->session->userdata('last_login') ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= base_url('admin/profile') ?>" class="btn btn-default btn-flat"><i class="fa fa-cogs" aria-hidden="true"></i> Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= base_url('admin/sigout') ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->

        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <?php foreach ($avatar as $a) { ?>
                            <img src="<?php echo base_url('assets/upload/user/img/' . $a->nama_file) ?>" class="img-circle" alt="User Image">
                        <?php } ?>
                    </div>
                    <div class="pull-left info">
                        <p><?= $this->session->userdata('name') ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->

                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="<?= base_url('admin') ?>">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            <span class="pull-right-container">
                                <!-- <i class="fa fa-angle-left pull-right"></i> -->
                            </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i> <span>Forms</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url('admin/form_barang_masuk') ?>"><i class="fa fa-circle-o"></i> Tambah Data Barang Masuk</a></li>
                            <li><a href="<?= base_url('admin/form_barang') ?>"><i class="fa fa-circle-o"></i> Tambah Data Barang</a></li>
                            <li><a href="<?= base_url('admin/form_supplier') ?>"><i class="fa fa-circle-o"></i> Tambah Data Supplier</a></li>
                            <li><a href="<?= base_url('admin/form_kategori') ?>"><i class="fa fa-circle-o"></i> Tambah Data Kategori</a></li>
                            <li><a href="<?= base_url('admin/form_satuan') ?>"><i class="fa fa-circle-o"></i> Tambah Data Satuan</a></li>
                        </ul>
                    </li>
                    <li class="treeview ">
                        <a href="#">
                            <i class="fa fa-table"></i> <span>Tables</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url('admin/tabel_barang_masuk') ?>"><i class="fa fa-circle-o"></i> Tabel Barang Masuk</a></li>
                            <li><a href="<?= base_url('admin/tabel_barang_keluar') ?>"><i class="fa fa-circle-o"></i> Tabel Barang Keluar</a></li>
                            <li><a href="<?= base_url('admin/tabel_barang') ?>"><i class="fa fa-circle-o"></i> Tabel Barang</a></li>
                            <li><a href="<?= base_url('admin/tabel_supplier') ?>"><i class="fa fa-circle-o"></i> Tabel Supplier</a></li>
                            <li><a href="<?= base_url('admin/tabel_kategori') ?>"><i class="fa fa-circle-o"></i> Tabel Kategori</a></li>
                            <li><a href="<?= base_url('admin/tabel_satuan') ?>"><i class="fa fa-circle-o"></i> Tabel Satuan</a></li>
                        </ul>
                    </li>
                    <li class="header">REPORT</li>
                    <li>
                        <a href="<?php echo base_url('admin/cetakLaporan') ?>">
                            <i class="fa fa-print" aria-hidden="true"></i> <span>Cetak Laporan</span></a>
                    </li>
                    <li class="header">LABELS</li>
                    <li>
                        <a href="<?php echo base_url('admin/profile') ?>">
                            <i class="fa fa-cogs" aria-hidden="true"></i> <span>Profile</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/users') ?>">
                            <i class="fa fa-fw fa-users" aria-hidden="true"></i> <span>Users</span></a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Laporan Transaksi
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Forms</a></li>
                    <li class="active">Laporan</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <div class="container">
                            <!-- general form elements -->
                            <div class="box box-primary" style="width:94%;">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-archive" aria-hidden="true"></i> Form Laporan</h3>
                                </div>

                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8">
                                            <div class="card shadow-sm border-bottom-primary">
                                                <div class="card-body">
                                                    <?= $this->session->flashdata('pesan'); ?>
                                                    <?= form_open(); ?>
                                                    <div class="row form-group"><br>
                                                        <label class="col-md-3 text-md-right" for="transaksi">Laporan Transaksi</label>
                                                        <div class="col-md-9">
                                                            <div class="custom-control custom-radio">
                                                                <input value="tb_barang_masuk" type="radio" id="id_barang_masuk" name="transaksi" class="custom-control-input">
                                                                <label class="custom-control-label" for="tb_barang_masuk">Barang Masuk</label>
                                                            </div>
                                                            <div class="custom-control custom-radio">
                                                                <input value="tb_barang_keluar" type="radio" id="id_barang_keluar" name="transaksi" class="custom-control-input">
                                                                <label class="custom-control-label" for="tb_barang_keluar">Barang Keluar</label>
                                                            </div>
                                                            <?= form_error('transaksi', '<span class="text-danger small">', '</span>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-lg-3 text-lg-right" for="tanggal">Tanggal</label>
                                                        <div class="col-lg-5">
                                                            <div class="input-group">
                                                                <input value="<?= set_value('tanggal', date('d/m/Y')); ?>" name="tanggal" id="tanggal" type="text" class="form-control date" placeholder="Periode Tanggal">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                            <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-lg-3 text-lg-right"></label>
                                                        <div class="col-lg-5 offset-lg-3">
                                                            <button type="submit" class="btn btn-primary btn-icon-split">
                                                                <span class="icon">
                                                                    <i class="fa fa-print"></i>
                                                                </span>
                                                                <span class="text">
                                                                    Cetak
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <?= form_close(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; <?= date('Y') ?></strong>

        </footer>
    </div>

    <!-- jQuery 3 -->
    <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() ?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>assets/web_admin/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() ?>assets/web_admin/dist/js/demo.js"></script>
</body>

</html>