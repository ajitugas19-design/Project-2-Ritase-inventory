<?php 
include '../koneksi.php';
$barang  = $_POST['barang'];
$register = $_POST['register'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$berat = $_POST['berat'];
$id_gudang = $_POST['id_gudang'];
$id_gudang2 = $_POST['id_gudang2'];

// Validasi: Jika id_gudang kosong, set ke NULL agar tidak error foreign key
if (empty($id_gudang)) {
    $id_gudang = "NULL";
} else {
    $cek_gudang = mysqli_query($koneksi, "SELECT gudang_id FROM gudang WHERE gudang_id = '$id_gudang'");
    if (mysqli_num_rows($cek_gudang) == 0) {
        $id_gudang = "NULL";
    } else {
        $id_gudang = "'$id_gudang'";
    }
}

if (empty($id_gudang2)) {
    $id_gudang2 = "NULL";
} else {
    $cek_gudang2 = mysqli_query($koneksi, "SELECT gudang2_id FROM gudang_2 WHERE gudang2_id = '$id_gudang2'");
    if (mysqli_num_rows($cek_gudang2) == 0) {
        $id_gudang2 = "NULL";
    } else {
        $id_gudang2 = "'$id_gudang2'";
    }
}

// Get barang info
$b = mysqli_query($koneksi,"select * from barang where barang_id='$barang'");
$bb = mysqli_fetch_assoc($b);
$nama_barang = $bb['barang_nama'];

// kurang jumlah data barang
$jumlah_lama = $bb['barang_jumlah'];
$jumlah_baru = $jumlah_lama - $jumlah;
mysqli_query($koneksi,"update barang set barang_jumlah='$jumlah_baru' where barang_id='$barang'");

mysqli_query($koneksi, "INSERT INTO barang_keluar 
(bk_id_barang, bk_register, bk_nama_barang, bk_tgl_keluar, bk_jumlah_keluar, bk_berat, bk_id_gudang, bk_id_gudang2)
VALUES 
('$barang','$register','$nama_barang','$tanggal','$jumlah','$berat',$id_gudang,$id_gudang2)");

header("location:barang_keluar.php");
