
<?php
// File untuk memperbaiki password user

// Koneksi langsung tanpa include
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "project_inventaris";

$koneksi = mysqli_connect($host, $user, $pass, $db_name);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Generate password MD5 yang benar
$pass_admin = md5('admin123');
$pass_manajemen = md5('manajemen123');

echo "Password MD5 yang benar:<br>";
echo "admin123 = " . $pass_admin . "<br>";
echo "manajemen123 = " . $pass_manajemen . "<br><br>";

// Update password user
mysqli_query($koneksi, "UPDATE user SET user_password = '$pass_admin' WHERE user_username = 'admin'");
mysqli_query($koneksi, "UPDATE user SET user_password = '$pass_manajemen' WHERE user_username = 'manajemen'");

echo "✓ Password berhasil diperbaiki!<br><br>";

// Verifikasi
$user_data = mysqli_query($koneksi, "SELECT * FROM user");
echo "<h3>Data user setelah diperbaiki:</h3>";
while ($u = mysqli_fetch_assoc($user_data)) {
    echo "Username: " . $u['user_username'] . " | Password: " . $u['user_password'] . "<br>";
}

echo "<br>Silakan login dengan:<br>";
echo "- admin / admin123<br>";
echo "- manajemen / manajemen123<br>";
?>


