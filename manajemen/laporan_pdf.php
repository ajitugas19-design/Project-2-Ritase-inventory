<?php
// Start output buffering to prevent "headers already sent" error
ob_start();

// memanggil library FPDF
require('../library/fpdf181/fpdf.php');

include '../koneksi.php';

// intance object dan memberikan pengaturan halaman PDF
$pdf=new FPDF('L','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','B',13);
$pdf->Cell(280,10,'LAPORAN',0,0,'C');

$tgl_dari = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];
$jenis = $_GET['jenis'];

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',9);

$pdf->Cell(35,6,'DARI TANGGAL',0,0);
$pdf->Cell(5,6,':',0,0);
$pdf->Cell(35,6, date('d-m-Y', strtotime($tgl_dari)) ,0,0);
$pdf->Cell(10,6,'',0,1);
$pdf->Cell(35,6,'SAMPAI TANGGAL',0,0);
$pdf->Cell(5,6,':',0,0);
$pdf->Cell(35,6, date('d-m-Y', strtotime($tgl_sampai)) ,0,0);
$pdf->Cell(10,6,'',0,1);
$pdf->Cell(35,6,'KATEGORI',0,0);
$pdf->Cell(5,6,':',0,0);
$pdf->Cell(35,6, $jenis ,0,0);

$pdf->Cell(10,15,'',0,1);
$pdf->SetFont('Arial','B',9);

if($jenis == "barang_masuk"){

  $pdf->Cell(10,7,'NO',1,0,'C');
  $pdf->Cell(30,7,'KODE',1,0,'C');
  $pdf->Cell(60,7,'NAMA BARANG' ,1,0,'C');
  $pdf->Cell(30,7,'REGISTER',1,0,'C');
  $pdf->Cell(35,7,'TANGGAL MASUK',1,0,'C');
  $pdf->Cell(20,7,'JUMLAH',1,0,'C');
  $pdf->Cell(20,7,'BERAT',1,0,'C');
  $pdf->Cell(35,7,'LOKASI ASAL',1,0,'C');
  $pdf->Cell(35,7,'LOKASI TUJUAN',1,1,'C');

  $pdf->Cell(10,7,'',0,1);
  $pdf->SetFont('Arial','',9);

  $no=1;
  $data = mysqli_query($koneksi,"SELECT bm.*, g1.lokasi_asal as nama_gudang, g2.lokasi_tujuan as nama_gudang2 FROM barang_masuk bm LEFT JOIN gudang g1 ON bm.bm_id_gudang = g1.gudang_id LEFT JOIN gudang_2 g2 ON bm.bm_id_gudang2 = g2.gudang2_id WHERE date(bm_tgl_masuk) >= '$tgl_dari' AND date(bm_tgl_masuk) <= '$tgl_sampai'");
  while($d = mysqli_fetch_array($data)){
    $pdf->Cell(10,6, $no++,1,0,'C');
    $pdf->Cell(30,6, $d['bm_id_barang'],1,0,'C');
    $pdf->Cell(60,6, $d['bm_nama_barang'],1,0,'C');
    $pdf->Cell(30,6, $d['bm_register'],1,0,'C');
    $pdf->Cell(35,6, $d['bm_tgl_masuk'],1,0,'C');
    $pdf->Cell(20,6, $d['bm_jumlah'],1,0,'C');
    $pdf->Cell(20,6, $d['bm_berat'],1,0,'C');
    $pdf->Cell(35,6, $d['nama_gudang'] ?? '-',1,0,'C');
    $pdf->Cell(35,6, $d['nama_gudang2'] ?? '-',1,1,'C');
  }

  // Add total
  $pdf->Cell(10,7,'',0,1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(205,6,'TOTAL JUMLAH:',0,0,'R');
  $total = mysqli_query($koneksi, "SELECT SUM(bm_jumlah) as total FROM barang_masuk WHERE date(bm_tgl_masuk) >= '$tgl_dari' AND date(bm_tgl_masuk) <= '$tgl_sampai'");
  $t = mysqli_fetch_assoc($total);
  $pdf->Cell(50,6, $t['total'] ?? 0,1,1,'C');

}elseif($jenis == "barang_keluar"){

  $pdf->Cell(10,7,'NO',1,0,'C');
  $pdf->Cell(30,7,'KODE',1,0,'C');
  $pdf->Cell(50,7,'NAMA BARANG' ,1,0,'C');
  $pdf->Cell(30,7,'REGISTER',1,0,'C');
  $pdf->Cell(35,7,'TANGGAL KELUAR',1,0,'C');
  $pdf->Cell(25,7,'JUMLAH',1,0,'C');
  $pdf->Cell(25,7,'BERAT',1,0,'C');
  $pdf->Cell(35,7,'LOKASI ASAL',1,0,'C');
  $pdf->Cell(35,7,'LOKASI TUJUAN',1,1,'C');

  $pdf->Cell(10,7,'',0,1);
  $pdf->SetFont('Arial','',9);

  $no=1;
  $data = mysqli_query($koneksi,"SELECT bk.*, g1.lokasi_asal as nama_gudang, g2.lokasi_tujuan as nama_gudang2 FROM barang_keluar bk LEFT JOIN gudang g1 ON bk.bk_id_gudang = g1.gudang_id LEFT JOIN gudang_2 g2 ON bk.bk_id_gudang2 = g2.gudang2_id WHERE date(bk_tgl_keluar) >= '$tgl_dari' AND date(bk_tgl_keluar) <= '$tgl_sampai'");
  while($d = mysqli_fetch_array($data)){
    $pdf->Cell(10,6, $no++,1,0,'C');
    $pdf->Cell(30,6, $d['bk_id_barang'],1,0,'C');
    $pdf->Cell(50,6, $d['bk_nama_barang'],1,0,'C');
    $pdf->Cell(30,6, $d['bk_register'],1,0,'C');
    $pdf->Cell(35,6, $d['bk_tgl_keluar'],1,0,'C');
    $pdf->Cell(25,6, $d['bk_jumlah_keluar'],1,0,'C');
    $pdf->Cell(25,6, $d['bk_berat'],1,0,'C');
    $pdf->Cell(35,6, $d['nama_gudang'] ?? '-',1,0,'C');
    $pdf->Cell(35,6, $d['nama_gudang2'] ?? '-',1,1,'C');
  }

  // Add total
  $pdf->Cell(10,7,'',0,1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(205,6,'TOTAL JUMLAH:',0,0,'R');
  $total = mysqli_query($koneksi, "SELECT SUM(bk_jumlah_keluar) as total FROM barang_keluar WHERE date(bk_tgl_keluar) >= '$tgl_dari' AND date(bk_tgl_keluar) <= '$tgl_sampai'");
  $t = mysqli_fetch_assoc($total);
  $pdf->Cell(50,6, $t['total'] ?? 0,1,1,'C');
}

// Clean any output before PDF
ob_end_clean();

$pdf->Output();

?>

