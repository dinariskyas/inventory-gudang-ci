<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Barang Masuk</title>
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
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/datetimepicker/css/bootstrap-datetimepicker.css">

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
                    <a href="#" class="btn btn-default btn-flat"><i class="fa fa-cogs" aria-hidden="true"></i> Profile</a>
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
            <!-- <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>assets/web_admin/index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul> -->
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
          Tambah Barang Keluar
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?= base_url('admin/tabel_barang_masuk') ?>">Tables</a></li>
          <li class="active">Tambah Barang Keluar</li>
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
                  <h3 class="box-title"><i class="fa fa-archive" aria-hidden="true"></i> Tambah Barang Keluar</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="container">
                  <form action="<?= base_url('admin/proses_data_keluar') ?>" role="form" method="post">

                    <?php if (validation_errors()) { ?>
                      <div class="alert alert-warning alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
                      </div>
                    <?php } ?>

                    <div class="box-body">
                      <div class="form-group">
                        <?php foreach ($list_data as $data) { ?>
                          <label for="id_barang_masuk" style="margin-left:220px;display:inline;">ID Transaksi</label>
                          <input type="text" name="id_barang_masuk" style="margin-left:37px;width:20%;display:inline;" class="form-control" readonly="readonly" value="<?= $data->id_barang_masuk ?>">
                      </div>
                      <div class="form-group">
                        <label for="tanggal" style="margin-left:220px;display:inline;">Tanggal Masuk</label>
                        <input type="text" name="tanggal" style="margin-left:20px;width:20%;display:inline;" class="form-control" readonly="readonly" value="<?= $data->tanggal ?>">
                      </div>
                      <div class="form-group">
                        <label for="tanggal_keluar" style="margin-left:220px;display:inline;">Tanggal Keluar</label>
                        <input value="<?= set_value('tanggal', date('d/m/Y')); ?>" type="date" name="tanggal_keluar" style="margin-left:20px;width:20%;display:inline;" class="form-control date" required="" placeholder="Klik Disini">
                      </div>
                      <div class="form-group" style="margin-bottom:40px;">
                        <label for="id_supplier" style="margin-left:220px;display:inline;">Supplier</label>
                        <select class="form-control" name="id_supplier" style="margin-left:60px;width:20%;display:inline;" readonly="readonly">
                          <?php foreach ($list_supplier as $supplier) { ?>
                            <?php if ($supplier['id_supplier'] == $list_data['id_supplier']) { ?>
                              <option value=" <?= $list_data['id_supplier'] ?>" selected=""><?= $supplier['nama_supplier'] ?> </option>
                            <?php } else { ?>
                              <option value=" <?= $supplier['id_supplier'] ?>"><?= $supplier['nama_supplier'] ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group" style="display:inline-block;">
                        <label for="id_barang" style="width:73%;margin-left: 12px;">Barang</label>
                        <select class="form-control" name="id_barang" style="width:110%;margin-right: 18px; margin-left: 12px;" readonly="readonly">
                          <?php foreach ($list_barang as $barang) { ?>
                            <?php if ($barang['id_barang'] == $list_data['id_barang']) { ?>
                              <option value=" <?= $list_data['id_barang'] ?>" selected=""><?= $barang['nama_barang'] ?></option>
                            <?php } else { ?>
                              <option value=" <?= $barang['id_barang'] ?>"><?= $barang['nama_barang'] ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group" style="display:inline-block;">
                        <label for="id_kategori" style="width:73%;margin-left:34px;">Kategori</label>
                        <select class="form-control" name="id_kategori" style="width:110%;margin-left:34px;margin-right: 18px;" readonly="readonly">
                          <?php foreach ($list_kategori as $kategori) { ?>
                            <?php if ($kategori['id_kategori'] == $list_data['id_kategori']) { ?>
                              <option value="<?= $list_data['id_kategori'] ?>" selected=""><?= $kategori['nama_kategori'] ?></option>
                            <?php } else { ?>
                              <option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama_kategori'] ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group" style="display:inline-block;">
                        <label for="id_satuan" style="width:73%;margin-left:64px;">Satuan</label>
                        <select class="form-control" name="id_satuan" style="width:110%;margin-left:64px;margin-right: 18px;" readonly="readonly">
                          <?php foreach ($list_satuan as $satuan) { ?>
                            <?php if ($satuan['id_satuan'] == $list_data['id_satuan']) { ?>
                              <option value="<?= $list_data['id_satuan'] ?>" selected=""><?= $satuan['nama_satuan'] ?></option>
                            <?php } else { ?>
                              <option value="<?= $satuan['id_satuan'] ?>"><?= $satuan['nama_satuan'] ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group" style="display:inline-block;">
                        <label for="jumlah" style="width:73%;margin-left:94px;">Jumlah</label>
                        <input type="number" name="jumlah" style="width:41%;margin-left:94px;margin-right:18px;" class="form-control" id="jumlah" max="<?= $data->jumlah ?>" value="<?= $data->jumlah ?>">
                      </div>
                    <?php } ?>
                    <!-- /.box-body -->

                    <div class="box-footer" style="width:93%;">
                      <a type="button" class="btn btn-default" style="width:10%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                      <button type="submit" style="width:20%;margin-left:689px;" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>&nbsp;&nbsp;&nbsp;
                    </div>
                  </form>
                </div>
              </div>
            </div>
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
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/web_admin/dist/js/adminlte.min.js"></script>
  <script src="<?php echo base_url() ?>assets/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() ?>assets/web_admin/dist/js/demo.js"></script>

  <script type="text/javascript">
    $(".form_datetime").datetimepicker({
      format: 'dd/mm/yyyy',
      autoclose: true,
      todayBtn: true,
      pickTime: false,
      minView: 2,
      maxView: 4,
    });
  </script>
</body>

</html>