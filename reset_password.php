<?php
// Reset password user admin ke MD5 (password: adit)

include 'koneksi.php';

// Password MD5 dari "adit"
$password_baru = "0192023a7bbd73250516f069df18b500";

// Update password user admin
$update = mysqli_query($koneksi, "UPDATE user SET user_password = '$password_baru' WHERE user_username = 'admin'");

if ($update) {
    echo "✓ Password admin berhasil diupdate ke MD5!<br>";
    echo "Sekarang bisa login dengan:<br>";
    echo "- Username: admin<br>";
    echo "- Password: adit<br>";
} else {
    echo "✗ Gagal update password: " . mysqli_error($koneksi);
}
?>
