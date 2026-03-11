
<?php
// File debug login - untuk melihat masalah login

echo "<h1>Debug Login</h1>";

include 'koneksi.php';

// Ambil semua user dari database
$user = mysqli_query($koneksi, "SELECT * FROM user");
echo "<h3>Data user di database:</h3>";
while ($u = mysqli_fetch_assoc($user)) {
    echo "ID: " . $u['user_id'] . "<br>";
    echo "Nama: " . $u['user_nama'] . "<br>";
    echo "Username: " . $u['user_username'] . "<br>";
    echo "Password (DB): " . $u['user_password'] . "<br>";
    echo "Password MD5('admin123'): " . md5('admin123') . "<br>";
    echo "Password MD5('manajemen123'): " . md5('manajemen123') . "<br>";
    echo "Level: " . $u['user_level'] . "<br>";
    echo "<hr>";
}

// Cek apakah password cocok
$test_admin = mysqli_query($koneksi, "SELECT * FROM user WHERE user_username='admin' AND user_password='" . md5('admin123') . "'");
echo "<h3>Cek login admin:</h3>";
if (mysqli_num_rows($test_admin) > 0) {
    echo "✓ Username 'admin' dengan password 'admin123' COCOK!<br>";
} else {
    echo "✗ Username 'admin' dengan password 'admin123' TIDAK COCOK<br>";
}

$test_admin2 = mysqli_query($koneksi, "SELECT * FROM user WHERE user_username='admin'");
$admin_data = mysqli_fetch_assoc($test_admin2);
echo "Password di DB: " . $admin_data['user_password'] . "<br>";
echo "MD5('admin123'): " . md5('admin123') . "<br>";
echo "Apakah sama? " . ($admin_data['user_password'] == md5('admin123') ? 'YA' : 'TIDAK') . "<br>";

?>


