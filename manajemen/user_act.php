<?php 
include '../koneksi.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$level = $_POST['level'];

$foto = $_FILES['foto']['name'];
$file_tmp = $_FILES['foto']['tmp_name'];

if($foto == ""){
	mysqli_query($koneksi, "INSERT INTO user VALUES ('','$nama','$username','$password','$level','')");
}else{
	move_uploaded_file($file_tmp, '../gambar/user/'.$foto);
	mysqli_query($koneksi, "INSERT INTO user VALUES ('','$nama','$username','$password','$level','$foto')");
}

header("location:user.php?alert=sukses");
?>
