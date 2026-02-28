<?php 
include '../koneksi.php';
$nama  = $_POST['nama'];
$spesifikasi = $_POST['spesifikasi'];
$lokasi = $_POST['lokasi'];
$kondisi = $_POST['kondisi'];
$jumlah = $_POST['jumlah'];
$sumber_dana = $_POST['sumber_dana'];
$keterangan = $_POST['keterangan'];
$jenis = $_POST['jenis'];



mysqli_query($koneksi, "insert into barang values (NULL,'$nama ','$spesifikasi','$lokasi','$kondisi','$jumlah','$sumber_dana','$keterangan','$jenis')");
header("location:barang.php");