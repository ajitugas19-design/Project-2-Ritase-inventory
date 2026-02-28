<?php
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

  $pdf->Cell(14,7,'NO',1,0,'C');
  $pdf->Cell(110,7,'NAMA BARANG' ,1,0,'C');
  $pdf->Cell(50,7,'TANGGAL MASUK',1,0,'C');
  $pdf->Cell(35,7,'JUMLAH',1,0,'C');
  $pdf->Cell(65,7,'NAMA SUPLIER',1,0,'C');

  $pdf->Cell(10,7,'',0,1);
  $pdf->SetFont('Arial','',10);

  $no=1;
  $data = mysqli_query($koneksi,"SELECT * FROM barang_masuk WHERE date(bm_tgl_masuk) >= '$tgl_dari' AND date(bm_tgl_masuk) <= '$tgl_sampai'");
  while($d = mysqli_fetch_array($data)){
    $pdf->Cell(14,6, $no++,1,0,'C');
    $pdf->Cell(110,6, $d['bm_nama_barang'],1,0,'C');
    $pdf->Cell(50,6, $d['bm_tgl_masuk'],1,0,'C');
    $pdf->Cell(35,6, $d['bm_jumlah'],1,0,'C');
    $pdf->Cell(65,6, $d['bm_nama_suplier'],1,1,'C');
  }

}elseif($jenis == "barang_keluar"){

  $pdf->Cell(14,7,'NO',1,0,'C');
  $pdf->Cell(50,7,'NAMA BARANG' ,1,0,'C');
  $pdf->Cell(35,7,'TANGGAL KELUAR',1,0,'C');
  $pdf->Cell(20,7,'JUMLAH',1,0,'C');
  $pdf->Cell(50,7,'LOKASI',1,0,'C');
  $pdf->Cell(50,7,'PENERIMA',1,0,'C');
  $pdf->Cell(55,7,'KETERANGAN',1,0,'C');

  $pdf->Cell(10,7,'',0,1);
  $pdf->SetFont('Arial','',10);

  $no=1;
  $data = mysqli_query($koneksi,"SELECT * FROM barang_keluar WHERE date(bk_tgl_keluar) >= '$tgl_dari' AND date(bk_tgl_keluar) <= '$tgl_sampai'");
  while($d = mysqli_fetch_array($data)){
    $pdf->Cell(14,6, $no++,1,0,'C');
    $pdf->Cell(50,6, $d['bk_nama_barang'],1,0,'C');
    $pdf->Cell(35,6, $d['bk_tgl_keluar'],1,0,'C');
    $pdf->Cell(20,6, $d['bk_jumlah_keluar'],1,0,'C');
    $pdf->Cell(50,6, $d['bk_lokasi'],1,0,'C');
    $pdf->Cell(50,6, $d['bk_penerima'],1,0,'C');
    $pdf->Cell(55,6, $d['bk_keterangan'],1,1,'C');
  }

}

$pdf->Output();

?>