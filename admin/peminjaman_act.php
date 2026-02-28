<?php 
include '../koneksi.php';
$nama  = $_POST['nama'];
$barang = $_POST['barang'];
$jumlah = $_POST['jumlah'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];
$kondisi = $_POST['kondisi'];
$status = $_POST['status'];

mysqli_query($koneksi, "insert into pinjam values (NULL,'$nama','$barang','$jumlah','$tgl_pinjam','$tgl_kembali','$kondisi','$status')");
header("location:peminjaman.php");