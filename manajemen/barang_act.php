<?php 
include '../koneksi.php';

$nama  = $_POST['nama'];
$lokasi = $_POST['lokasi'];
$jumlah = $_POST['jumlah'];
$register = $_POST['register'];
$tanggal = $_POST['tanggal'];
$barcode = $_POST['barcode'];

// Insert data to database - save barcode to 'barcode' column
mysqli_query($koneksi, "INSERT INTO barang (barang_nama, barang_lokasi, barang_jumlah, barang_register, barang_tanggal, barcode) VALUES ('$nama', '$lokasi', '$jumlah', '$register', '$tanggal', '$barcode')");

header("location:barang.php");
