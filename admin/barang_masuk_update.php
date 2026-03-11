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

// Cek dan tambahkan kolom barang_jumlah jika belum ada
$cek_kolom = mysqli_query($koneksi, "SHOW COLUMNS FROM barang LIKE 'barang_jumlah'");
if (mysqli_num_rows($cek_kolom) == 0) {
    mysqli_query($koneksi, "ALTER TABLE barang ADD COLUMN barang_jumlah INT DEFAULT 0");
}

// kembalikan data barang
$bm = mysqli_query($koneksi,"select * from barang_masuk where bm_id='$id'");
$barang_masuk = mysqli_fetch_assoc($bm);
$id_barang_masuk = $barang_masuk['bm_id_barang'];
$jumlah_barang_masuk = $barang_masuk['bm_jumlah'];

$b = mysqli_query($koneksi,"select * from barang where barang_id='$id_barang_masuk'");
$barang = mysqli_fetch_assoc($b);
$jumlah_barang = isset($barang['barang_jumlah']) ? $barang['barang_jumlah'] : 0;

// ubah jumlah stok data barang
$ubah_jumlah = $jumlah_barang - $jumlah_barang_masuk;
mysqli_query($koneksi,"update barang set barang_jumlah='$ubah_jumlah' where barang_id='$id_barang_masuk'");

// update jumlah barang
$ubah_jumlah_baru = $ubah_jumlah + $jumlah;
mysqli_query($koneksi,"update barang set barang_jumlah='$ubah_jumlah_baru' where barang_id='$barang_baru'");

// update data barang masuk
mysqli_query($koneksi,"update barang_masuk set 
  bm_id_barang='$barang_baru', 
  bm_register='$register',
  bm_tgl_masuk='$tanggal', 
  bm_jumlah='$jumlah',
  bm_berat='$berat',
  bm_id_gudang='$id_gudang',
  bm_id_gudang2='$id_gudang2'
  where bm_id='$id'");

header("location:barang_masuk.php");

