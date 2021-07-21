<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Satuan</title>
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
                    <li class="treeview active">
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
                            <li class="active"><a href="<?= base_url('admin/tabel_kategori') ?>"><i class="fa fa-circle-o"></i> Tabel Kategori</a></li>
                            <li><a href="<?= base_url('admin/tabel_satuan') ?>"><i class="fa fa-circle-o"></i> Tabel Satuan</a></li>
                        </ul>
                    </li>
                </ul>
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
                    Update Data Kategori Barang
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Forms</a></li>
                    <li class="active">General Elements</li>
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
                                    <h3 class="box-title"><i class="fa fa-archive" aria-hidden="true"></i> Update Data Kategori Barang</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <div class="container">
                                    <form action="<?= base_url('admin/proses_kategori_update') ?>" role="form" method="post">

                                        <?php if (validation_errors()) { ?>
                                            <div class="alert alert-warning alert-dismissible">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
                                            </div>
                                        <?php } ?>

                                        <div class="box-body">
                                            <div class="form-group">
                                                <?php foreach ($data_kategori as $d) { ?>
                                                    <div class="box-body">
                                                        <div class="form-group" style="display:inline-block;">
                                                            <input type="hidden" name="id_kategori" value="<?= $d->id_kategori ?>">
                                                            <label for="nama_kategori" style="width:73%;">Nama Kategori</label>
                                                            <input type="text" required name="nama_kategori" style="width:90%;margin-right: 67px;" class="form-control" id="nama_kategori" placeholder="Nama Kategori" value="<?= $d->nama_kategori ?>">
                                                        </div>
                                                        <div class="form-group" style="display:inline-block;">
                                                            <button type="reset" class="btn btn-basic" name="btn_reset" style="width:95px;margin-left:20px;"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- /.box-body -->

                                                    <div class="box-footer" style="width:93%;">
                                                        <a type="button" class="btn btn-default" style="width:10%;margin-right:26%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                                                        <a type="button" class="btn btn-info" style="width:13%;margin-right:29%" href="<?= base_url('admin/tabel_kategori') ?>" name="btn_listsatuan"><i class="fa fa-table" aria-hidden="true"></i> Lihat Kategori</a>
                                                        <button type="submit" style="width:20%" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
                                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.box -->

                            <!-- Form Element sizes -->

                            <!-- /.box -->


                            <!-- /.box -->

                            <!-- Input addon -->

                            <!-- /.box -->

                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <!-- <div class="col-md-6">
          <!-- Horizontal Form -->

                        <!-- /.box -->
                        <!-- general form elements disabled -->

                        <!-- /.box -->

                    </div>
                </div>
                <!--/.col (right) -->
        </div>
        <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; <?= date('Y') ?></strong>

    </footer>
    </div>
    <!-- ./wrapper -->

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