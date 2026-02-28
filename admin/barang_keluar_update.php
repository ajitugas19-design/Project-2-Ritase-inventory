<?php 
include '../koneksi.php';
$id  = $_POST['id'];
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

$bk = mysqli_query($koneksi,"select * from barang_keluar where bk_id='$id'");
$barang_keluar = mysqli_fetch_assoc($bk);
$id_barang = $barang_keluar['bk_id_barang'];
$jumlah_barang_keluar = $barang_keluar['bk_jumlah_keluar'];


$x = mysqli_query($koneksi,"select * from barang where barang_id='$id_barang'");
$xx = mysqli_fetch_assoc($x);
$jumlah_x = $xx['barang_jumlah'];


// cek jika jumlah yang diinput lebih besar dari jumlah barang yang ada
$kembalikan_jumlah = $jumlah_x+$jumlah_barang_keluar;
if($jumlah > $kembalikan_jumlah){
	header("location:barang_keluar.php?alert=lebih");
}else{

	// kurangi jumlah data barang
	mysqli_query($koneksi,"update barang set barang_jumlah='$kembalikan_jumlah' where barang_id='$id_barang'");

	mysqli_query($koneksi,"update barang_keluar set bk_id_barang='$barang', bk_nama_barang='$nama_barang', bk_tgl_keluar='$tanggal', bk_jumlah_keluar='$jumlah', bk_lokasi='$lokasi', bk_penerima='$penerima', bk_keterangan='$keterangan' where bk_id='$id'");
	
	// update stok barang
	if($jumlah > $jumlah_barang){
		header("location:barang_keluar.php?alert=lebih");
	}else{
		$j = $jumlah_barang-$jumlah;
		mysqli_query($koneksi,"update barang set barang_jumlah='$j' where barang_id='$barang'");
		header("location:barang_keluar.php");
	}
}