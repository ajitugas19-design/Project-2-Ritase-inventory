<?php 
include '../koneksi.php';
$barang  = $_POST['barang'];
$register = $_POST['register'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$berat = $_POST['berat'];
$id_gudang = $_POST['id_gudang'];
$id_gudang2 = $_POST['id_gudang2'];

$b = mysqli_query($koneksi,"select * from barang where barang_id='$barang'");
$bb = mysqli_fetch_assoc($b);
$nama_barang = $bb['barang_nama'];

// tambah jumlah data barang
$jumlah_lama = $bb['barang_jumlah'];
$jumlah_baru = $jumlah_lama+$jumlah;
mysqli_query($koneksi,"update barang set barang_jumlah='$jumlah_baru' where barang_id='$barang'");

mysqli_query($koneksi, "INSERT INTO barang_masuk 
(bm_id_barang, bm_register, bm_nama_barang, bm_tgl_masuk, bm_jumlah, bm_berat, bm_id_gudang, bm_id_gudang2)
VALUES 
('$barang','$register','$nama_barang','$tanggal','$jumlah','$berat','$id_gudang','$id_gudang2')");

header("location:barang_masuk.php");
