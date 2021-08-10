<!DOCTYPE html>
<html>

<head>
  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/simple-sidebar/css/simple-sidebar.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="<?= base_url() ?>/assets/simple-sidebar/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <style>
    .nav-link {
      color: rgba(255, 255, 255);
    }
  </style>
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg" style="background-color:	#2F4F4F">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="<?= base_url('user') ?>"></a>
      </div>
      <ul class="nav navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-database" aria-hidden="true"></i> Tabel
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?= base_url('user/tabel_barang_masuk'); ?>">Tabel Barang Masuk</a></li>
            <li><a href="<?= base_url('user/tabel_barang_keluar'); ?>">Tabel Barang Keluar</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a class="nav-link">Last Login : <?= $this->session->userdata('last_login') ?></a></li>
        <li><a class="nav-link" href="<?= base_url('user/setting') ?>"><i class="fa fa-user" aria-hidden="true"></i> Setting</a></li>
        <li><a class="nav-link" href="<?= base_url('user/signout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign Out</a></li>
      </ul>
    </div>
  </nav>