<?php 
include '../koneksi.php';
$barang  = $_POST['barang'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$lokasi = $_POST['lokasi'];
$penerima = $_POST['penerima'];
$keterangan = $_POST['keterangan'];


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

	mysqli_query($koneksi, "insert into barang_keluar values (NULL,'$barang','$nama_barang','$tanggal','$jumlah','$lokasi','$penerima','$keterangan')");
	header("location:barang_keluar.php");
}



