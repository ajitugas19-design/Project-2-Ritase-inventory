<?php 
include '../koneksi.php';

$nama  = $_POST['nama'];
$lokasi = $_POST['lokasi'];
$jumlah = $_POST['jumlah'];
$barcode = $_POST['barcode'];

// Insert data ke database dengan menyebutkan nama kolom
mysqli_query($koneksi, "INSERT INTO barang (barang_nama, barang_lokasi, barang_jumlah, barang_keterangan) VALUES ('$nama', '$lokasi', '$jumlah', '$barcode')");

header("location:barang.php");
