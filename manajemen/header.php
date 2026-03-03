<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Manajemen - Sistem Informasi Inventaris</title>
  
  <meta content="width=device-width, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro">

  <?php 
  include '../koneksi.php';
  session_start();
  if($_SESSION['level'] != "manajemen"){
    header("location:../index.php?alert=belum_login");
  }
  ?>

  <!-- FIX LAYOUT HEADER DAN SIDEBAR -->
  <style>
    .main-header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
    }
    .main-sidebar {
      position: fixed;
      top: 50px;
      left: 0;
      height: calc(100vh - 50px);
      width: 230px;
      z-index: 999;
    }
    .content-wrapper {
      margin-left: 95px;
      margin-top: 0px;
      padding: 20px;
      min-height: calc(100vh - 50px);
    }

    .sidebar-collapse .main-sidebar { width: 50px; }
    .sidebar-collapse .content-wrapper { margin-left: 50px; }
  </style>

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<header class="main-header">
  <a href="index.php" class="logo">
    <span class="logo-mini"><b>SG</b></span>
    <span class="logo-lg"><b>Sistem Gudang</b> LJP</span>
  </a>

  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu"></a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php
            $id_user = $_SESSION['id'];
            $profil = mysqli_query($koneksi,"SELECT * FROM user WHERE user_id='$id_user'");
            $profil = mysqli_fetch_assoc($profil);
            ?>
            <img src="../gambar/<?php echo $profil['user_foto'] ? 'user/'.$profil['user_foto'] : 'sistem/user.png'; ?>" class="user-image">
            <span class="hidden-xs"><?php echo $_SESSION['nama']; ?> - <?php echo $_SESSION['level']; ?></span>
          </a>
        </li>
        <li>
          <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
        </li>
      </ul>
    </div>
  </nav>
</header>

<aside class="main-sidebar">
<section class="sidebar">

<div class="user-panel">
  <div class="pull-left image">
    <img src="../gambar/<?php echo $profil['user_foto'] ? 'user/'.$profil['user_foto'] : 'sistem/user.png'; ?>" class="img-circle">
  </div>
  <div class="pull-left info">
    <p><?php echo $_SESSION['nama']; ?></p>
    <a><i class="fa fa-circle text-success"></i> Online</a>
  </div>
</div>

<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>

  <li><a href="index.php"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
  <li><a href="barang.php"><i class="fa fa-folder"></i> <span>DATA BARANG</span></a></li>
  <li><a href="barang_masuk.php"><i class="fa fa-mail-reply"></i> <span>BARANG MASUK</span></a></li>
  <li><a href="barang_keluar.php"><i class="fa fa-mail-forward"></i> <span>BARANG KELUAR</span></a></li>

  <li class="treeview">
    <a href="#"><i class="fa fa-users"></i> <span>DATA PENGGUNA</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
      <li><a href="user.php"><i class="fa fa-circle-o"></i> Data Pengguna</a></li>
      <li><a href="user_tambah.php"><i class="fa fa-circle-o"></i> Tambah Pengguna</a></li>
    </ul>
  </li>

  <li><a href="laporan.php"><i class="fa fa-file"></i> <span>PACKING LIST</span></a></li>
  <li><a href="gantipassword.php"><i class="fa fa-lock"></i> <span>GANTI PASSWORD</span></a></li>
  <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>LOGOUT</span></a></li>
</ul>

</section>
</aside>

<div class="content-wrapper">
