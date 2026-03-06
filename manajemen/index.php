<?php include 'header.php'; ?>

<div class="content-wrapper">

<section class="content-header">
  <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<section class="content">

<!-- ROW 1 -->
<div class="row">

<!-- Model Barang -->
<div class="col-lg-3 col-xs-6">
<div class="small-box bg-green">
<div class="inner">
<?php 
$barang = mysqli_query($koneksi,"SELECT COUNT(*) as total FROM barang");
$b = mysqli_fetch_assoc($barang);
?>
<h3><?php echo $b['total']; ?></h3>
<p>Model Barang</p>
</div>
<div class="icon">
<i class="ion ion-stats-bars"></i>
</div>
<a href="barang.php" class="small-box-footer">
More info <i class="fa fa-arrow-circle-right"></i>
</a>
</div>
</div>

<!-- Pengguna -->
<div class="col-lg-3 col-xs-6">
<div class="small-box bg-yellow">
<div class="inner">
<?php 
$user = mysqli_query($koneksi,"SELECT COUNT(*) as total FROM user");
$u = mysqli_fetch_assoc($user);
?>
<h3><?php echo $u['total']; ?></h3>
<p>Pengguna</p>
</div>
<div class="icon">
<i class="ion ion-person-add"></i>
</div>
<a href="user.php" class="small-box-footer">
More info <i class="fa fa-arrow-circle-right"></i>
</a>
</div>
</div>

<!-- Total Barang Masuk -->
<div class="col-lg-3 col-xs-6">
<div class="small-box bg-primary">
<div class="inner">
<?php 
$barang_masuk = mysqli_query($koneksi,"SELECT SUM(bm_jumlah) as total FROM barang_masuk");
$bm = mysqli_fetch_assoc($barang_masuk);
?>
<h3><?php echo $bm['total'] ?? 0; ?></h3>
<p>Total Barang Masuk</p>
</div>
<div class="icon">
<i class="ion ion-android-download"></i>
</div>
<a href="barang_masuk.php" class="small-box-footer">
More info <i class="fa fa-arrow-circle-right"></i>
</a>
</div>
</div>

<!-- Total Barang Keluar -->
<div class="col-lg-3 col-xs-6">
<div class="small-box bg-purple">
<div class="inner">
<?php 
$barang_keluar = mysqli_query($koneksi,"SELECT SUM(bk_jumlah_keluar) as total FROM barang_keluar");
$bk = mysqli_fetch_assoc($barang_keluar);
?>
<h3><?php echo $bk['total'] ?? 0; ?></h3>
<p>Total Barang Keluar</p>
</div>
<div class="icon">
<i class="ion ion-android-upload"></i>
</div>
<a href="barang_keluar.php" class="small-box-footer">
More info <i class="fa fa-arrow-circle-right"></i>
</a>
</div>
</div>

</div>


<!-- ROW 2 -->
<div class="row">

<!-- Total Transaksi Barang Masuk -->
<div class="col-lg-3 col-xs-6">
<div class="small-box bg-orange">
<div class="inner">
<?php 
$transaksi_masuk = mysqli_query($koneksi,"SELECT COUNT(*) as total FROM barang_masuk");
$tm = mysqli_fetch_assoc($transaksi_masuk);
?>
<h3><?php echo $tm['total']; ?></h3>
<p>Total Transaksi Barang Masuk</p>
</div>
<div class="icon">
<i class="ion ion-document-text"></i>
</div>
<a href="barang_masuk.php" class="small-box-footer">
More info <i class="fa fa-arrow-circle-right"></i>
</a>
</div>
</div>

<!-- Total Transaksi Barang Keluar -->
<div class="col-lg-3 col-xs-6">
<div class="small-box bg-blue">
<div class="inner">
<?php 
$transaksi_keluar = mysqli_query($koneksi,"SELECT COUNT(*) as total FROM barang_keluar");
$tk = mysqli_fetch_assoc($transaksi_keluar);
?>
<h3><?php echo $tk['total']; ?></h3>
<p>Total Transaksi Barang Keluar</p>
</div>
<div class="icon">
<i class="ion ion-document"></i>
</div>
<a href="barang_keluar.php" class="small-box-footer">
More info <i class="fa fa-arrow-circle-right"></i>
</a>
</div>
</div>

</div>


<!-- DETAIL LOGIN -->
<div class="row">    
<section class="col-lg-7">

<div class="box box-info">

<div class="box-header">
<h3 class="box-title">Detail Login</h3>
</div>

<div class="box-body">

<table class="table table-bordered">

<tr>
<th width="30%">Nama</th>
<td><?php echo $_SESSION['nama']; ?></td>
</tr>

<tr>
<th>Username</th>
<td><?php echo $_SESSION['username']; ?></td>
</tr>

<tr>
<th>Level Hak Akses</th>
<td>
<span class="label label-success text-uppercase">
<?php echo $_SESSION['level']; ?>
</span>
</td>
</tr>

</table>

</div>

</div>

</section>
</div>

</section>

</div>

<?php include 'footer.php'; ?>