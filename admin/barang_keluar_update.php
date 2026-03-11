<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$barang  = $_POST['barang'];
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

$b = mysqli_query($koneksi,"select * from barang where barang_id='$barang'");
$bb = mysqli_fetch_assoc($b);
$nama_barang = $bb['barang_nama'];
$jumlah_barang = isset($bb['barang_jumlah']) ? $bb['barang_jumlah'] : 0;

$bk = mysqli_query($koneksi,"select * from barang_keluar where bk_id='$id'");
$barang_keluar = mysqli_fetch_assoc($bk);
$id_barang = $barang_keluar['bk_id_barang'];
$jumlah_barang_keluar = $barang_keluar['bk_jumlah_keluar'];


$x = mysqli_query($koneksi,"select * from barang where barang_id='$id_barang'");
$xx = mysqli_fetch_assoc($x);
$jumlah_x = isset($xx['barang_jumlah']) ? $xx['barang_jumlah'] : 0;


// cek jika jumlah yang diinput lebih besar dari jumlah barang yang ada
$kembalikan_jumlah = $jumlah_x+$jumlah_barang_keluar;
if($jumlah > $kembalikan_jumlah){
	header("location:barang_keluar.php?alert=lebih");
}else{

	// kurangi jumlah data barang
	mysqli_query($koneksi,"update barang set barang_jumlah='$kembalikan_jumlah' where barang_id='$id_barang'");

	mysqli_query($koneksi,"update barang_keluar set 
		bk_id_barang='$barang', 
		bk_register='$register',
		bk_nama_barang='$nama_barang', 
		bk_tgl_keluar='$tanggal', 
		bk_jumlah_keluar='$jumlah', 
		bk_berat='$berat',
		bk_id_gudang='$id_gudang', 
		bk_id_gudang2='$id_gudang2'
		where bk_id='$id'");
	
	// update stok barang
	if($jumlah > $jumlah_barang){
		header("location:barang_keluar.php?alert=lebih");
	}else{
		$j = $jumlah_barang-$jumlah;
		mysqli_query($koneksi,"update barang set barang_jumlah='$j' where barang_id='$barang'");
		header("location:barang_keluar.php");
	}
}

