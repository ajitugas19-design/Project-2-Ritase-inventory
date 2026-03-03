<?php 
include '../koneksi.php';
$barang  = $_POST['barang'];
$register = $_POST['register'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$berat = $_POST['berat'];
$id_gudang = $_POST['id_gudang'];
$id_gudang2 = $_POST['id_gudang2'];

// Get barang info
$b = mysqli_query($koneksi,"select * from barang where barang_id='$barang'");
$bb = mysqli_fetch_assoc($b);
$nama_barang = $bb['barang_nama'];

// kurang jumlah data barang
$jumlah_lama = $bb['barang_jumlah'];
$jumlah_baru = $jumlah_lama - $jumlah;
mysqli_query($koneksi,"update barang set barang_jumlah='$jumlah_baru' where barang_id='$barang'");

mysqli_query($koneksi, "insert into barang_keluar values (NULL,'$barang','$nama_barang','$register','$tanggal','$jumlah','$berat','$id_gudang','$id_gudang2')");

header("location:barang_keluar.php");
