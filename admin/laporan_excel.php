<?php
include '../koneksi.php';

$tgl_dari   = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];
$jenis      = $_GET['jenis'];

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_barang.xls");

echo "<table border='1'>";
echo "<tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Tanggal Masuk</th>
        <th>Jumlah</th>
        <th>Nama Supplier</th>
      </tr>";

$no = 1;

$sql = mysqli_query($koneksi,"
SELECT b.nama_barang,
       m.tanggal_masuk,
       m.jumlah,
       s.nama_supplier
FROM barang_masuk m
JOIN barang b ON m.id_barang=b.id_barang
JOIN supplier s ON m.id_supplier=s.id_supplier
WHERE m.tanggal_masuk BETWEEN '$tgl_dari' AND '$tgl_sampai'
");

while($d = mysqli_fetch_array($sql)){
    echo "<tr>
            <td>".$no++."</td>
            <td>".$d['nama_barang']."</td>
            <td>".$d['tanggal_masuk']."</td>
            <td>".$d['jumlah']."</td>
            <td>".$d['nama_supplier']."</td>
          </tr>";
}

echo "</table>";
?>
