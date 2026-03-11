<?php 
include '../koneksi.php';

$nama  = $_POST['nama'];
$lokasi = $_POST['lokasi'];
$jumlah = $_POST['jumlah'];
$register = $_POST['register'];
$tanggal = $_POST['tanggal'];
$barcode = $_POST['barcode'];

// Jika tanggal kosong, gunakan NULL
if (empty($tanggal)) {
    $tgl = "NULL";
} else {
    $tgl = "'$tanggal'";
}

// Cek dan tambahkan kolom barang_jumlah jika belum ada
$cek_kolom = mysqli_query($koneksi, "SHOW COLUMNS FROM barang LIKE 'barang_jumlah'");
if (mysqli_num_rows($cek_kolom) == 0) {
    mysqli_query($koneksi, "ALTER TABLE barang ADD COLUMN barang_jumlah INT DEFAULT 0");
}

// Insert data to database
mysqli_query($koneksi, "INSERT INTO barang (barang_nama, barang_lokasi, barang_jumlah, barang_register, barang_tanggal, barcode) VALUES ('$nama', '$lokasi', '$jumlah', '$register', $tgl, '$barcode')");

header("location:barang.php");
