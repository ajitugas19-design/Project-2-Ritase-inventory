<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$lokasi = $_POST['lokasi'];
$jumlah = (int)$_POST['jumlah'];
$barcode = $_POST['barcode'];

mysqli_query($koneksi, "update barang set barang_nama='$nama', barang_lokasi='$lokasi', barang_jumlah='$jumlah', barang_keterangan='$barcode' where barang_id='$id'");
header("location:barang.php");
