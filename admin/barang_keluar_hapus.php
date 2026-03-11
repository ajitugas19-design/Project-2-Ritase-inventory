<?php 
include '../koneksi.php';
$id = $_GET['id'];



$bk = mysqli_query($koneksi,"select * from barang_keluar where bk_id='$id'");
$barang_keluar = mysqli_fetch_assoc($bk);
$id_barang_keluar = $barang_keluar['bk_id_barang'];
$jumlah_barang_keluar = $barang_keluar['bk_jumlah_keluar'];


$b = mysqli_query($koneksi,"select * from barang where barang_id='$id_barang_keluar'");
$barang = mysqli_fetch_assoc($b);

// Cek apakah kolom barang_jumlah ada
$cek_kolom = mysqli_query($koneksi, "SHOW COLUMNS FROM barang LIKE 'barang_jumlah'");
$kolom_adalah = mysqli_num_rows($cek_kolom) > 0;

// Ambil jumlah barang jika kolom ada
$jumlah_barang = 0;
if ($kolom_adalah) {
    $jumlah_barang = isset($barang['barang_jumlah']) ? $barang['barang_jumlah'] : 0;
    
    // ubah jumlah stok data barang (tambahkan kembali saat hapus barang keluar)
    $ubah_jumlah = $jumlah_barang + $jumlah_barang_keluar;
    mysqli_query($koneksi," update barang set barang_jumlah='$ubah_jumlah' where barang_id='$id_barang_keluar'");
}

mysqli_query($koneksi, "delete from barang_keluar where bk_id='$id'");
header("location:barang_keluar.php");
