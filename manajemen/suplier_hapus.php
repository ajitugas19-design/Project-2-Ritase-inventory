<?php 
include '../koneksi.php';
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'administrator') {
  header("location:suplier.php?alert=forbidden");
  exit;
}

$id = $_GET['id'];

mysqli_query($koneksi, "delete from suplier where suplier_id='$id'");
header("location:suplier.php");

