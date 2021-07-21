<!DOCTYPE html>
<html>

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
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href=<?php echo base_url() ?>assets/web_admin/"bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

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
      <a href="<?= base_url('admin') ?>" class="logo">
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
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= base_url('admin/profile') ?>" class="btn btn-default btn-flat"><i class="fa fa-cogs" aria-hidden="true"></i> Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?= base_url('admin/sigout'); ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a>
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

          <li class="treeview active">
            <a href="<?php echo base_url('admin') ?>">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <!-- <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span> -->
            </a>
          </li>
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
          Dashboard
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
              </div>
              <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                </div>
                <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b></b>
      </div>
      <strong>Copyright &copy; <?= date('Y') ?></strong>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Morris.js charts -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/raphael/raphael.min.js"></script>
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/morris.js/morris.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="<?php echo base_url() ?>assets/web_admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?php echo base_url() ?>assets/web_admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/moment/min/moment.min.js"></script>
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?php echo base_url() ?>assets/web_admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/web_admin/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url() ?>assets/web_admin/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() ?>assets/web_admin/dist/js/demo.js"></script>
</body>

</html>