<?php 
// Memulai session di awal file
session_start();

// menghubungkan dengan koneksi
include 'koneksi.php';

// Cek apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);

// Query untuk cek login
$login = mysqli_query($koneksi, "SELECT * FROM user WHERE user_username='$username' AND user_password='$password'");

// Cek apakah query berhasil
if (!$login) {
    die("Query gagal: " . mysqli_error($koneksi));
}

$cek = mysqli_num_rows($login);

if($cek > 0){
	$data = mysqli_fetch_assoc($login);
	$_SESSION['id'] = $data['user_id'];
	$_SESSION['nama'] = $data['user_nama'];
	$_SESSION['username'] = $data['user_username'];
	$_SESSION['level'] = $data['user_level'];

	if($data['user_level'] == "administrator"){
		header("location:admin/");
		exit();
	}else if($data['user_level'] == "manajemen"){
		header("location:manajemen/");
		exit();
	}else{
		header("location:index.php?alert=gagal");
		exit();
	}
}else{
	header("location:index.php?alert=gagal");
	exit();
}
?>
