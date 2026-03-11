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
    // Cek apakah gudang_id exists
    $cek_gudang = mysqli_query($koneksi, "SELECT gudang_id FROM gudang WHERE gudang_id = '$id_gudang'");
    if (mysqli_num_rows($cek_gudang) == 0) {
        $id_gudang = "NULL";
    } else {
        $id_gudang = "'$id_gudang'";
    }
}

// Validasi: Jika id_gudang2 kosong, set ke NULL agar tidak error foreign key
if (empty($id_gudang2)) {
    $id_gudang2 = "NULL";
} else {
    // Cek apakah gudang2_id exists
    $cek_gudang2 = mysqli_query($koneksi, "SELECT gudang2_id FROM gudang_2 WHERE gudang2_id = '$id_gudang2'");
    if (mysqli_num_rows($cek_gudang2) == 0) {
        $id_gudang2 = "NULL";
    } else {
        $id_gudang2 = "'$id_gudang2'";
    }
}

// Get current barang data
$b = mysqli_query($koneksi,"select * from barang where barang_id='$barang'");
$bb = mysqli_fetch_assoc($b);
$nama_barang = $bb['barang_nama'];

// Cek apakah kolom barang_jumlah ada
$cek_kolom = mysqli_query($koneksi, "SHOW COLUMNS FROM barang LIKE 'barang_jumlah'");
$kolom_adalah = mysqli_num_rows($cek_kolom) > 0;

// Update jumlah barang di tabel barang jika kolom ada
if ($kolom_adalah) {
    $jumlah_barang = isset($bb['barang_jumlah']) ? $bb['barang_jumlah'] : 0;
    $jumlah_baru = $jumlah_barang + $jumlah;
    mysqli_query($koneksi, "UPDATE barang SET barang_jumlah='$jumlah_baru' WHERE barang_id='$barang'");
}

// Insert to barang_masuk table
mysqli_query($koneksi, "INSERT INTO barang_masuk
(bm_id_barang, bm_register, bm_nama_barang, bm_tgl_masuk, bm_jumlah, bm_berat, bm_id_gudang, bm_id_gudang2)
VALUES 
('$barang','$register','$nama_barang','$tanggal','$jumlah','$berat',$id_gudang,$id_gudang2)");

header("location:barang_masuk.php");
