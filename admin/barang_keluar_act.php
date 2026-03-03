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
$jumlah_barang = $bb['barang_jumlah'];

// cek jika jumlah yang diinput lebih besar dari jumlah barang yang ada
if($jumlah > $jumlah_barang){
	header("location:barang_keluar.php?alert=lebih");
}else{

	// kurangi jumlah data barang
	$jumlah_baru = $jumlah_barang-$jumlah;
	mysqli_query($koneksi,"update barang set barang_jumlah='$jumlah_baru' where barang_id='$barang'");

	mysqli_query($koneksi, "INSERT INTO barang_keluar 
(bk_id_barang, bk_register, bk_nama_barang, bk_tgl_keluar, bk_jumlah_keluar, bk_berat, bk_id_gudang, bk_id_gudang2)
VALUES 
('$barang','$register','$nama_barang','$tanggal','$jumlah','$berat','$id_gudang','$id_gudang2')");
	header("location:barang_keluar.php");
}
