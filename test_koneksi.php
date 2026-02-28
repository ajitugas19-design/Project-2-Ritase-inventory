<?php
// File untuk menguji koneksi database

echo "=== TEST KONEKSI DATABASE ===<br><br>";

// Include koneksi
include 'koneksi.php';

// Cek apakah variabel $koneksi ada dan berhasil
if (isset($koneksi)) {
    echo "✓ Variabel \$koneksi tersedia<br>";
    
    // Test koneksi dengan ping
    if (mysqli_ping($koneksi)) {
        echo "✓ Koneksi ke database BERHASIL!<br>";
        
        // Test query sederhana
        $result = mysqli_query($koneksi, "SELECT VERSION()");
        if ($result) {
            $row = mysqli_fetch_array($result);
            echo "✓ Versi MySQL: " . $row[0] . "<br><br>";
            
            // Tampilkan data user untuk debugging login
            $user = mysqli_query($koneksi, "SELECT * FROM user");
            echo "<strong>Data User di Database:</strong><br>";
            while ($u = mysqli_fetch_assoc($user)) {
                echo "- Username: " . $u['user_username'] . " | Password (MD5): " . $u['user_password'] . " | Level: " . $u['user_level'] . "<br>";
            }
        }
    } else {
        echo "✗ Koneksi GAGAL - tidak dapat ping ke database";
    }
} else {
    echo "✗ Variabel \$koneksi TIDAK tersedia - kemungkinan ada error saat koneksi";
}

echo "<br><br>=== AKHIR TEST ===";
?>
