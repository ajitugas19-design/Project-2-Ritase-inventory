<?php 
include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from pinjam where pinjam_id='$id'");
header("location:peminjaman.php");
