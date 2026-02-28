<?php 
include '../koneksi.php';
$id = $_GET['id'];



$bk = mysqli_query($koneksi,"select * from barang_keluar where bk_id='$id'");
$barang_keluar = mysqli_fetch_assoc($bk);
$id_barang_keluar = $barang_keluar['bk_id_barang'];
$jumlah_barang_keluar = $barang_keluar['bk_jumlah_keluar'];


$b = mysqli_query($koneksi,"select * from barang where barang_id='$id_barang_keluar'");
$barang = mysqli_fetch_assoc($b);
$jumlah_barang = $barang['barang_jumlah'];

// ubah jumlah stok data barang
$ubah_jumlah = $jumlah_barang+$jumlah_barang_keluar;

mysqli_query($koneksi,"update barang set barang_jumlah='$ubah_jumlah' where barang_id='$id_barang_keluar'");

mysqli_query($koneksi, "delete from barang_keluar where bk_id='$id'");
header("location:barang_keluar.php");
