<?php 
include '../koneksi.php';
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'administrator') {
  header("location:user.php?alert=forbidden");
  exit;
}

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM user WHERE user_id='$id'");

header("location:user.php?alert=sukses_hapus");
?>

