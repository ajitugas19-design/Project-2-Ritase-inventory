
<?php
// File test koneksi - Buka di browser: http://localhost/Project%20Magang%202%20Final/project_inventaris/test_koneksi.php

echo "<h1>Test Koneksi Database</h1>";

include 'koneksi.php';

if ($koneksi) {
    echo "✓ Koneksi ke database BERHASIL<br><br>";
    
    // Cek tabel user
    $result = mysqli_query($koneksi, "SHOW TABLES LIKE 'user'");
    if (mysqli_num_rows($result) > 0) {
        echo "✓ Tabel user ada<br>";
        
        // Ambil data user
        $user = mysqli_query($koneksi, "SELECT * FROM user");
        $jumlah = mysqli_num_rows($user);
        echo "✓ Jumlah user: $jumlah<br><br>";
        
        if ($jumlah > 0) {
            echo "<h3>Data User:</h3>";
            echo "<table border='1' cellpadding='5'>";
            echo "<tr><th>ID</th><th>Nama</th><th>Username</th><th>Level</th></tr>";
            while ($u = mysqli_fetch_assoc($user)) {
                echo "<tr>";
                echo "<td>" . $u['user_id'] . "</td>";
                echo "<td>" . $u['user_nama'] . "</td>";
                echo "<td>" . $u['user_username'] . "</td>";
                echo "<td>" . $u['user_level'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<br><h3>Silakan login dengan:</h3>";
            echo "<ul>";
            echo "<li>Username: <b>admin</b> | Password: <b>admin123</b></li>";
            echo "<li>Username: <b>manajemen</b> | Password: <b>manajemen123</b></li>";
            echo "</ul>";
        } else {
            echo "⚠ Tabel user kosong! Tidak ada user untuk login.";
        }
    } else {
        echo "⚠ Tabel user tidak ada!";
    }
    
    // Cek tabel lain
    echo "<br><h3>Status Tabel:</h3>";
    $tabel = ['gudang', 'gudang_2', 'barang', 'barang_masuk', 'barang_keluar', 'pinjam', 'suplier'];
    foreach ($tabel as $t) {
        $result = mysqli_query($koneksi, "SHOW TABLES LIKE '$t'");
        if (mysqli_num_rows($result) > 0) {
            echo "✓ $t ada<br>";
        } else {
            echo "✗ $t tidak ada<br>";
        }
    }
    
} else {
    echo "✗ Koneksi ke database GAGAL";
    echo "<br>Error: " . mysqli_connect_error();
}

echo "<br><br><a href='index.php'>Klik di sini untuk login</a>";
?>


