<?php 
include '../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

$foto = $_FILES['foto']['name'];
$file_tmp = $_FILES['foto']['tmp_name'];

if($password == ""){
	if($foto == ""){
		mysqli_query($koneksi, "UPDATE user SET user_nama='$nama', user_username='$username', user_level='$level' WHERE user_id='$id'");
	}else{
		move_uploaded_file($file_tmp, '../gambar/user/'.$foto);
		mysqli_query($koneksi, "UPDATE user SET user_nama='$nama', user_username='$username', user_level='$level', user_foto='$foto' WHERE user_id='$id'");
	}
}else{
	$password = md5($password);
	if($foto == ""){
		mysqli_query($koneksi, "UPDATE user SET user_nama='$nama', user_username='$username', user_password='$password', user_level='$level' WHERE user_id='$id'");
	}else{
		move_uploaded_file($file_tmp, '../gambar/user/'.$foto);
		mysqli_query($koneksi, "UPDATE user SET user_nama='$nama', user_username='$username', user_password='$password', user_level='$level', user_foto='$foto' WHERE user_id='$id'");
	}
}

header("location:user.php?alert=sukses");
?>
