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

// Get current barang keluar data
$bk = mysqli_query($koneksi,"select * from barang_keluar where bk_id='$id'");
$barang_keluar = mysqli_fetch_assoc($bk);
$id_barang_keluar = $barang_keluar['bk_id_barang'];
$jumlah_barang_keluar = $barang_keluar['bk_jumlah_keluar'];

// Get barang data
$b = mysqli_query($koneksi,"select * from barang where barang_id='$id_barang_keluar'");
$barang = mysqli_fetch_assoc($b);
$jumlah_barang = $barang['barang_jumlah'];

// Restore old quantity
$ubah_jumlah = $jumlah_barang + $jumlah_barang_keluar;
mysqli_query($koneksi,"update barang set barang_jumlah='$ubah_jumlah' where barang_id='$id_barang_keluar'");

// Get new barang info
$bb = mysqli_query($koneksi,"select * from barang where barang_id='$barang_baru'");
$bb = mysqli_fetch_assoc($bb);
$nama_barang = $bb['barang_nama'];

// Reduce new quantity
$jumlah_baru = $ubah_jumlah - $jumlah;
mysqli_query($koneksi,"update barang set barang_jumlah='$jumlah_baru' where barang_id='$barang_baru'");

// Update barang keluar
mysqli_query($koneksi,"update barang_keluar set bk_id_barang='$barang_baru', bk_nama_barang='$nama_barang', bk_register='$register', bk_tgl_keluar='$tanggal', bk_jumlah_keluar='$jumlah', bk_berat='$berat', bk_id_gudang='$id_gudang', bk_id_gudang2='$id_gudang2' where bk_id='$id'");

header("location:barang_keluar.php");
