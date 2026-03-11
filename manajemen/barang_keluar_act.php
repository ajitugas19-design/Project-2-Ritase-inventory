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

// Cek apakah barang ada di tabel barang
$b = mysqli_query($koneksi,"select * from barang where barang_id='$barang'");
$bb = mysqli_fetch_assoc($b);

// Validasi: Barang harus ada di tabel barang
if (!$bb) {
    echo "<script>
    alert('Barang tidak ditemukan! Barang harus ada di Data Barang terlebih dahulu.');
    window.location.href='barang_keluar.php';
    </script>";
    exit;
}

$nama_barang = $bb['barang_nama'];

// Cek apakah kolom barang_jumlah ada
$cek_kolom = mysqli_query($koneksi, "SHOW COLUMNS FROM barang LIKE 'barang_jumlah'");
$kolom_adalah = mysqli_num_rows($cek_kolom) > 0;

// Ambil jumlah barang jika kolom ada
$jumlah_barang = 0;
if ($kolom_adalah) {
    $jumlah_barang = isset($bb['barang_jumlah']) ? $bb['barang_jumlah'] : 0;
}

// Hitung stok real (barang_jumlah + total_masuk - total_keluar) untuk validasi
$masuk = mysqli_query($koneksi, "SELECT SUM(bm_jumlah) as total_masuk FROM barang_masuk WHERE bm_id_barang = '$barang'");
$masuk_data = mysqli_fetch_assoc($masuk);
$total_masuk = $masuk_data['total_masuk'] ? $masuk_data['total_masuk'] : 0;

$keluar = mysqli_query($koneksi, "SELECT SUM(bk_jumlah_keluar) as total_keluar FROM barang_keluar WHERE bk_id_barang = '$barang'");
$keluar_data = mysqli_fetch_assoc($keluar);
$total_keluar = $keluar_data['total_keluar'] ? $keluar_data['total_keluar'] : 0;

$stok_tersedia = $jumlah_barang + $total_masuk - $total_keluar;

// Validasi: Pastikan stok cukup untuk barang keluar
if ($jumlah > $stok_tersedia) {
    echo "<script>
    alert('Stok tidak mencukupi! Stok tersedia: $stok_tersedia, Jumlah diminta: $jumlah');
    window.location.href='barang_keluar.php';
    </script>";
    exit;
}

// Kurangi jumlah barang di tabel barang jika kolom ada
if ($kolom_adalah) {
    $jumlah_baru = $jumlah_barang - $jumlah;
    mysqli_query($koneksi, "UPDATE barang SET barang_jumlah='$jumlah_baru' WHERE barang_id='$barang'");
}

// Insert to barang_keluar table
mysqli_query($koneksi, "INSERT INTO barang_keluar
(bk_id_barang, bk_register, bk_nama_barang, bk_tgl_keluar, bk_jumlah_keluar, bk_berat, bk_id_gudang, bk_id_gudang2)
VALUES 
('$barang','$register','$nama_barang','$tanggal','$jumlah','$berat',$id_gudang,$id_gudang2)");

header("location:barang_keluar.php");
