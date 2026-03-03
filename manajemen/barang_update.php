<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$register = $_POST['register'];
$lokasi = $_POST['lokasi'];
$jumlah = $_POST['jumlah'];

mysqli_query($koneksi, "update barang set barang_nama='$nama', barang_register='$register', barang_lokasi='$lokasi', barang_jumlah='$jumlah' where barang_id='$id'");
header("location:barang.php");
