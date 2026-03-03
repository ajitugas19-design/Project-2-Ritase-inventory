<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$barang_baru  = $_POST['barang'];
$register = $_POST['register'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$berat = $_POST['berat'];
$id_gudang = $_POST['id_gudang'];
$id_gudang2 = $_POST['id_gudang2'];

// Get current barang masuk data
$bm = mysqli_query($koneksi,"select * from barang_masuk where bm_id='$id'");
$barang_masuk = mysqli_fetch_assoc($bm);
$id_barang_masuk = $barang_masuk['bm_id_barang'];
$jumlah_barang_masuk = $barang_masuk['bm_jumlah'];

// Get barang data
$b = mysqli_query($koneksi,"select * from barang where barang_id='$id_barang_masuk'");
$barang = mysqli_fetch_assoc($b);
$jumlah_barang = $barang['barang_jumlah'];

// Restore old quantity
$ubah_jumlah = $jumlah_barang - $jumlah_barang_masuk;
mysqli_query($koneksi,"update barang set barang_jumlah='$ubah_jumlah' where barang_id='$id_barang_masuk'");

// Get new barang info
$bb = mysqli_query($koneksi,"select * from barang where barang_id='$barang_baru'");
$bb = mysqli_fetch_assoc($bb);
$nama_barang = $bb['barang_nama'];

// Add new quantity
$jumlah_baru = $ubah_jumlah + $jumlah;
mysqli_query($koneksi,"update barang set barang_jumlah='$jumlah_baru' where barang_id='$barang_baru'");

// Update barang masuk
mysqli_query($koneksi,"update barang_masuk set bm_id_barang='$barang_baru', bm_nama_barang='$nama_barang', bm_register='$register', bm_tgl_masuk='$tanggal', bm_jumlah='$jumlah', bm_berat='$berat', bm_id_gudang='$id_gudang', bm_id_gudang2='$id_gudang2' where bm_id='$id'");

header("location:barang_masuk.php");
