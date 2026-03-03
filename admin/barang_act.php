<?php 
include '../koneksi.php';
$nama  = $_POST['nama'];
$register = $_POST['register'];
$lokasi = $_POST['lokasi'];
$jumlah = $_POST['jumlah'];

mysqli_query($koneksi, "insert into barang values (NULL,'$nama','$register','$lokasi','',$jumlah,'','','')");
header("location:barang.php");
