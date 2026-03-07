<?php
include '../koneksi.php';

$tgl_dari   = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];
$jenis      = $_GET['jenis'];

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_barang.xls");

if($jenis == "barang_masuk"){
    echo "<table border='1'>";
    echo "<tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Register</th>
            <th>Tanggal Masuk</th>
            <th>Jumlah</th>
            <th>Berat</th>
            <th>Lokasi Asal</th>
            <th>Lokasi Tujuan</th>
          </tr>";

    $no = 1;

    $sql = mysqli_query($koneksi,"
    SELECT bm.*, g1.lokasi_asal as nama_gudang, g2.lokasi_tujuan as nama_gudang2 
    FROM barang_masuk bm 
    LEFT JOIN gudang g1 ON bm.bm_id_gudang = g1.gudang_id
    LEFT JOIN gudang_2 g2 ON bm.bm_id_gudang2 = g2.gudang2_id
    WHERE date(bm.bm_tgl_masuk) BETWEEN '$tgl_dari' AND '$tgl_sampai'
    ");

    while($d = mysqli_fetch_array($sql)){
        echo "<tr>
                <td>".$no++."</td>
                <td>".$d['bm_id_barang']."</td>
                <td>".$d['bm_nama_barang']."</td>
                <td>".$d['bm_register']."</td>
                <td>".$d['bm_tgl_masuk']."</td>
                <td>".$d['bm_jumlah']."</td>
                <td>".$d['bm_berat']."</td>
                <td>".($d['nama_gudang'] ?? '-')."</td>
                <td>".($d['nama_gudang2'] ?? '-')."</td>
              </tr>";
    }

    echo "</table>";
    
    // Print total
    echo "<table border='1'>";
    echo "<tr><td colspan='5' align='right'><strong>Total Jumlah:</strong></td><td><strong>";
    $total = mysqli_query($koneksi, "SELECT SUM(bm_jumlah) as total FROM barang_masuk WHERE date(bm_tgl_masuk) BETWEEN '$tgl_dari' AND '$tgl_sampai'");
    $t = mysqli_fetch_assoc($total);
    echo $t['total'] ?? 0;
    echo "</strong></td><td colspan='2'></td></tr>";
    echo "</table>";

}elseif($jenis == "barang_keluar"){
    echo "<table border='1'>";
    echo "<tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Register</th>
            <th>Tanggal Keluar</th>
            <th>Jumlah</th>
            <th>Berat</th>
            <th>Lokasi Asal</th>
            <th>Lokasi Tujuan</th>
          </tr>";

    $no = 1;

    $sql = mysqli_query($koneksi,"
    SELECT bk.*, g1.lokasi_asal as nama_gudang, g2.lokasi_tujuan as nama_gudang2 
    FROM barang_keluar bk 
    LEFT JOIN gudang g1 ON bk.bk_id_gudang = g1.gudang_id
    LEFT JOIN gudang_2 g2 ON bk.bk_id_gudang2 = g2.gudang2_id
    WHERE date(bk.bk_tgl_keluar) BETWEEN '$tgl_dari' AND '$tgl_sampai'
    ");

    while($d = mysqli_fetch_array($sql)){
        echo "<tr>
                <td>".$no++."</td>
                <td>".$d['bk_id_barang']."</td>
                <td>".$d['bk_nama_barang']."</td>
                <td>".$d['bk_register']."</td>
                <td>".$d['bk_tgl_keluar']."</td>
                <td>".$d['bk_jumlah_keluar']."</td>
                <td>".$d['bk_berat']."</td>
                <td>".($d['nama_gudang'] ?? '-')."</td>
                <td>".($d['nama_gudang2'] ?? '-')."</td>
              </tr>";
    }

    echo "</table>";
    
    // Print total
    echo "<table border='1'>";
    echo "<tr><td colspan='5' align='right'><strong>Total Jumlah:</strong></td><td><strong>";
    $total = mysqli_query($koneksi, "SELECT SUM(bk_jumlah_keluar) as total FROM barang_keluar WHERE date(bk_tgl_keluar) BETWEEN '$tgl_dari' AND '$tgl_sampai'");
    $t = mysqli_fetch_assoc($total);
    echo $t['total'] ?? 0;
    echo "</strong></td><td colspan='2'></td></tr>";
    echo "</table>";
}
?>

