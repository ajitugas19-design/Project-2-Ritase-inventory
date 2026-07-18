<?php 
include '../koneksi.php';
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'administrator') {
  header("location:barang.php?alert=forbidden");
  exit;
}

$id = $_GET['id'];

mysqli_query($koneksi, "delete from barang where barang_id='$id'");

mysqli_query($koneksi, "delete from barang_masuk where bm_id_barang='$id'");
mysqli_query($koneksi, "delete from barang_keluar where bk_id_barang='$id'");

header("location:barang.php");

