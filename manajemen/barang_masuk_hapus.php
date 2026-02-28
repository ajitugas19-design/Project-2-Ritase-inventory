<?php 
include '../koneksi.php';
$id = $_GET['id'];



$bm = mysqli_query($koneksi,"select * from barang_masuk where bm_id='$id'");
$barang_masuk = mysqli_fetch_assoc($bm);
$id_barang_masuk = $barang_masuk['bm_id_barang'];
$jumlah_barang_masuk = $barang_masuk['bm_jumlah'];


$b = mysqli_query($koneksi,"select * from barang where barang_id='$id_barang_masuk'");
$barang = mysqli_fetch_assoc($b);
$jumlah_barang = $barang['barang_jumlah'];

// ubah jumlah stok data barang
$ubah_jumlah = $jumlah_barang-$jumlah_barang_masuk;

mysqli_query($koneksi,"update barang set barang_jumlah='$ubah_jumlah' where barang_id='$id_barang_masuk'");

mysqli_query($koneksi, "delete from barang_masuk where bm_id='$id'");
header("location:barang_masuk.php");
