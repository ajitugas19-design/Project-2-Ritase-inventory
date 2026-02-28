<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$barang = $_POST['barang'];
$jumlah = $_POST['jumlah'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];
$kondisi = $_POST['kondisi'];
$status = $_POST['status'];

mysqli_query($koneksi, "update pinjam set pinjam_peminjam ='$nama', pinjam_barang='$barang', pinjam_jumlah='$jumlah', pinjam_tgl_pinjam='$tgl_pinjam', pinjam_tgl_kembali='$tgl_kembali', pinjam_kondisi='$kondisi', pinjam_status='$status' where pinjam_id='$id'");
header("location:peminjaman.php");