<?php
// memanggil library FPDF
require('../library/fpdf181/fpdf.php');

include '../koneksi.php';

// intance object dan memberikan pengaturan halaman PDF
$pdf=new FPDF('L','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','B',13);
$pdf->Cell(280,10,'DATA PEMINJAMAN',0,0,'C');

$pdf->Cell(10,15,'',0,1);
$pdf->SetFont('Arial','B',9);


$pdf->Cell(14,7,'NO',1,0,'C');
$pdf->Cell(60,7,'NAMA' ,1,0,'C');
$pdf->Cell(60,7,'BARANG',1,0,'C');
$pdf->Cell(20,7,'JUMLAH',1,0,'C');
$pdf->Cell(30,7,'KONDISI',1,0,'C');
$pdf->Cell(30,7,'TGL.PINJAM',1,0,'C');
$pdf->Cell(30,7,'TGL.KEMBALI',1,0,'C');
$pdf->Cell(30,7,'STATUS',1,0,'C');

$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','',10);


$no=1;
$data = mysqli_query($koneksi,"SELECT * FROM pinjam,barang where pinjam_barang=barang_id");
while($d = mysqli_fetch_array($data)){
  $pdf->Cell(14,6, $no++,1,0,'C');
  $pdf->Cell(60,6, $d['pinjam_peminjam'],1,0,'C');
  $pdf->Cell(60,6, $d['barang_nama'],1,0,'C');
  $pdf->Cell(20,6, $d['pinjam_jumlah'],1,0,'C');
  $pdf->Cell(30,6, $d['pinjam_kondisi'],1,0,'C');
  $pdf->Cell(30,6, $d['pinjam_tgl_pinjam'],1,0,'C');
  $pdf->Cell(30,6, $d['pinjam_tgl_kembali'],1,0,'C');
  if($d['pinjam_status'] == "Dikembalikan"){
    $s = "Di Kembalikan";
  }elseif($d['pinjam_status'] == "Dipinjam"){
    $s = "Di Pinjam";
  }
  $pdf->Cell(30,6, $s,1,1,'C');
}

$pdf->Output();

?>