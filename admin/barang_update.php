<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$lokasi = $_POST['lokasi'];
$jumlah = (int)$_POST['jumlah'];
$register = $_POST['register'];
$tanggal = $_POST['tanggal'];
$barcode = $_POST['barcode'];

// Cek dan tambahkan kolom barang_jumlah jika belum ada
$cek_kolom = mysqli_query($koneksi, "SHOW COLUMNS FROM barang LIKE 'barang_jumlah'");
if (mysqli_num_rows($cek_kolom) == 0) {
    mysqli_query($koneksi, "ALTER TABLE barang ADD COLUMN barang_jumlah INT DEFAULT 0");
}

mysqli_query($koneksi, "update barang set barang_nama='$nama', barang_lokasi='$lokasi', barang_jumlah='$jumlah', barang_register='$register', barang_tanggal='$tanggal', barcode='$barcode' where barang_id='$id'");
header("location:barang.php");
