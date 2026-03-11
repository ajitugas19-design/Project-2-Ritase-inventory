<?php 
include '../koneksi.php';
$id = $_GET['id'];



$bm = mysqli_query($koneksi,"select * from barang_masuk where bm_id='$id'");
$barang_masuk = mysqli_fetch_assoc($bm);
$id_barang_masuk = $barang_masuk['bm_id_barang'];
$jumlah_barang_masuk = $barang_masuk['bm_jumlah'];


$b = mysqli_query($koneksi,"select * from barang where barang_id='$id_barang_masuk'");
$barang = mysqli_fetch_assoc($b);

// Cek apakah kolom barang_jumlah ada
$cek_kolom = mysqli_query($koneksi, "SHOW COLUMNS FROM barang LIKE 'barang_jumlah'");
$kolom_adalah = mysqli_num_rows($cek_kolom) > 0;

// Ambil jumlah barang jika kolom ada
$jumlah_barang = 0;
if ($kolom_adalah) {
    $jumlah_barang = isset($barang['barang_jumlah']) ? $barang['barang_jumlah'] : 0;
    
    // ubah jumlah stok data barang
    $ubah_jumlah = $jumlah_barang - $jumlah_barang_masuk;
    mysqli_query($koneksi,"update barang set barang_jumlah='$ubah_jumlah' where barang_id='$id_barang_masuk'");
}

mysqli_query($koneksi, "delete from barang_masuk where bm_id='$id'");
header("location:barang_masuk.php");
