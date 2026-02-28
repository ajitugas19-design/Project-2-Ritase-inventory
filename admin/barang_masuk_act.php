<?php 
include '../koneksi.php';
$barang  = $_POST['barang'];
$tanggal = $_POST['tanggal'];
$suplier = $_POST['suplier'];
$jumlah = $_POST['jumlah'];
$register = $_POST['register'];
$berat = $_POST['berat'];
$lokasi_asal = $_POST['suplier'];
$lokasi_tujuan = $_POST['lokasi_tujuan'];
$keterangan = $_POST['keterangan'];




$b = mysqli_query($koneksi,"select * from barang where barang_id='$barang'");
$bb = mysqli_fetch_assoc($b);
$nama_barang = $bb['barang_nama'];

$s = mysqli_query($koneksi,"select * from suplier where suplier_id='$suplier'");
$ss = mysqli_fetch_assoc($s);
$nama_suplier = $ss['suplier_nama'];

// tambah jumlah data barang
$jumlah_lama = $bb['barang_jumlah'];
$jumlah_baru = $jumlah_lama+$jumlah;
mysqli_query($koneksi,"update barang set barang_jumlah='$jumlah_baru' where barang_id='$barang'");

mysqli_query($koneksi, "
INSERT INTO barang_masuk 
(bm_id_barang, bm_register, bm_nama_barang, bm_tgl_masuk, bm_jumlah, bm_berat, bm_id_suplier, bm_lokasi_asal, bm_lokasi_tujuan, bm_keterangan)
VALUES 
('$barang','$register','$nama_barang','$tanggal','$jumlah','$berat','$suplier','$nama_suplier','$lokasi_tujuan','$keterangan') ");

header("location:barang_masuk.php");
