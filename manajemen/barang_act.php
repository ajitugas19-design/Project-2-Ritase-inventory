<?php 
include '../koneksi.php';

$nama  = $_POST['nama'];
$lokasi = $_POST['lokasi'];
$jumlah = $_POST['jumlah'];
$barcode = $_POST['barcode'];

// Insert data to database - save barcode to 'barcode' column
mysqli_query($koneksi, "INSERT INTO barang (barang_nama, barang_lokasi, barang_jumlah, barcode) VALUES ('$nama', '$lokasi', '$jumlah', '$barcode')");

header("location:barang.php");
