<?php
// Script untuk menambahkan kolom barang_jumlah jika belum ada
include 'koneksi.php';

// Cek apakah kolom barang_jumlah sudah ada
$cek_kolom = mysqli_query($koneksi, "SHOW COLUMNS FROM barang LIKE 'barang_jumlah'");

if (mysqli_num_rows($cek_kolom) == 0) {
    // Kolom belum ada, tambahkan
    $result = mysqli_query($koneksi, "ALTER TABLE barang ADD COLUMN barang_jumlah INT DEFAULT 0");
    
    if ($result) {
        echo "Kolom 'barang_jumlah' berhasil ditambahkan ke tabel barang!<br>";
    } else {
        echo "Gagal menambahkan kolom: " . mysqli_error($koneksi) . "<br>";
    }
} else {
    echo "Kolom 'barang_jumlah' sudah ada di tabel barang.<br>";
}

// Verifikasi
echo "<br>Struktur tabel barang:<br>";
$struktur = mysqli_query($koneksi, "SHOW COLUMNS FROM barang");
while ($row = mysqli_fetch_assoc($struktur)) {
    echo "- " . $row['Field'] . " (" . $row['Type'] . ")<br>";
}
?>
<p><a href="admin/barang.php">Kembali ke halaman barang</a></p>

