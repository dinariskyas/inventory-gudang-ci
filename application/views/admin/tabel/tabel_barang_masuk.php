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
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/sweetalert/dist/sweetalert.css">
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
                    <a href="<?= base_url('admin/sigout') ?>" class="btn btn-default btn-flat"><i class="fa fa-cogs" aria-hidden="true"></i> Profile</a>
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
          <li class="treeview active">
            <a href="#">
              <i class="fa fa-table"></i> <span>Tables</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active"><a href="<?= base_url('admin/tabel_barang_masuk') ?>"><i class="fa fa-circle-o"></i> Tabel Barang Masuk</a></li>
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
          Tabel Barang Masuk
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li>Tables</li>
          <li class="active"><a href="<?= base_url('admin/tabel_barang_masuk') ?>">Tabel Barang Masuk</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">

            <!-- /.box -->
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-table" aria-hidden="true"></i> Stok Barang Masuk</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">

                <?php if ($this->session->flashdata('msg_berhasil')) { ?>
                  <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil'); ?>
                  </div>
                <?php } ?>

                <?php if ($this->session->flashdata('msg_berhasil_keluar')) { ?>
                  <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil_keluar'); ?>
                  </div>
                <?php } ?>


                <a href="<?= base_url('admin/form_barang_masuk') ?>" style="margin-bottom:10px;" type="button" class="btn btn-primary" name="tambah_data"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Data Masuk</a>
                <br><br>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Custom Filter : </h3>
                  </div>
                  <div class="panel-body">
                    <form id="form-filter" class="form-horizontal">
                      <div class="form-group">
                        <label for="barang" class="col-sm-2 control-label">Barang</label>
                        <div class="col-sm-4">
                          <?php echo $form_barang; ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tanggal" class="col-sm-2 control-label">Tanggal Masuk</label>
                        <div class="col-sm-4">
                          <input type="date" class="form-control" id="tanggal">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="supplier" class="col-sm-2 control-label">Supplier</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="supplier">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="supplier" class="col-sm-2 control-label"></label>
                        <div class="col-sm-4">
                          <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                          <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <br>
                <table id="table" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>ID_Transaksi</th>
                      <th>Tanggal</th>
                      <th>Supplier</th>
                      <th>Nama Barang</th>
                      <th>Kategori</th>
                      <th>Satuan</th>
                      <th>Jumlah</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if (is_array($list_data)) { ?>
                        <?php $no = 1; ?>
                        <?php foreach ($list_data as $data) : ?>
                          <td><?= $no ?></td>
                          <td><?= $data['id_barang_masuk'] ?></td>
                          <td><?= $data['tanggal'] ?></td>
                          <td><?= $data['nama_supplier'] ?></td>
                          <td><?= $data['nama_barang'] ?></td>
                          <td><?= $data['nama_kategori'] ?></td>
                          <td><?= $data['nama_satuan'] ?></td>
                          <td><?= $data['jumlah'] ?></td>
                          <th>
                            <a type="button" class="btn btn-success" href="<?= base_url('admin/update_barang_masuk/' . $data['id_barang_masuk']) ?>" name="btn_update" style="margin:auto;"><i class="fa fa-edit" aria-hidden="true"> Edit</i></a>
                            <a type="button" class="btn btn-danger btn-delete" href="<?= base_url('admin/delete_barang_masuk/' . $data['id_barang_masuk']) ?>" name="btn_delete" style="margin:auto;"><i class="fa fa-timees-circle" aria-hidden="true"> Delete</i> </a>
                            <a type="button" class="btn btn-warning btn-barangkeluar" href="<?= base_url('admin/barang_keluar/' . $data['id_barang_masuk']) ?>" name="btn_barangkeluar" style="margin:auto;"><i class="fa fa-sign-out" aria-hidden="true"> Keluarkan</i></a>
                    </tr>
                    <?php $no++; ?>
                  <?php endforeach; ?>
                <?php } else { ?>
                  <td colspan="7" align="center"><strong>Data Kosong</strong></td>
                <?php } ?>
                  </tbody>
                </table>
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
    <!-- Control Sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/web_admin/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() ?>assets/web_admin/dist/js/demo.js"></script>

  <!-- page script -->
  <script type="text/javascript">
    var table;

    $(document).ready(function() {

      //datatables
      table = $('#table').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": "<?php echo site_url('tb_barang_masuk/ajax_list') ?>",
          "type": "POST",
          "data": function(data) {
            data.barang = $('#barang').val();
            data.tanggal = $('#tanggal').val();
            data.supplier = $('#supplier').val();
          }
        },

        //Set column definition initialisation properties.
        "columnDefs": [{
          "targets": [0], //first column / numbering column
          "orderable": false, //set not orderable
        }, ],

      });

      $('#btn-filter').click(function() { //button filter event click
        table.ajax.reload(); //just reload table
      });
      $('#btn-reset').click(function() { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
      });

    });

    // // var end = $('#search_date').val();
    // // $('#search_date').datetimepicker();
    // var date = ""
    // // This will update the "end" variable as it changes.
    // $(document).on('change', '#search_date', function() {
    // date = $(this).val();
    // // filterDate(date)
    // console.log(date);
    // });

    // document.getElementById("search").onclick = function() {
    // var supplier = $('#search_supplier').find('option').filter(':selected').text();
    // if (supplier != "-- Pilih --") {
    // filterSupplier($('#search_supplier').find('option').filter(':selected').text())
    // }
    // filterDate(date)
    // return false;
    // };

    // function filterDate(i) {
    // $('#example1').DataTable().column(2).search(
    // i
    // ).draw();
    // }

    // function filterSupplier(i) {
    // $('#example1').DataTable().column(3).search(
    // i
    // ).draw();
    // }
  </script>
</body>

</html>