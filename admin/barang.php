<?php include 'header.php'; ?>

<style>
/* Simple table adjustments only */

#table-datatable {
    width: 100% !important;
}
.table-responsive {
    max-height: 400px;
    overflow-y: auto;
}
#table-datatable th,
#table-datatable td {
    vertical-align: middle;
    text-align: center;
}
#table-datatable td {
    font-size: 13px;
}
.table > tbody > tr > td {
    padding: 8px;
}

/* Column Sizes - simplified for better layout */
#table-datatable th:nth-child(1),
#table-datatable td:nth-child(1) { width: 40px; min-width: 40px; }   /* NO */
#table-datatable th:nth-child(2),
#table-datatable td:nth-child(2) { width: 80px; min-width: 80px; }   /* KODE */
#table-datatable th:nth-child(3),
#table-datatable td:nth-child(3) { width: 100px; min-width: 100px; }  /* TANGGAL */
#table-datatable th:nth-child(4),
#table-datatable td:nth-child(4) { width: 100px; min-width: 100px; }  /* REGISTER */
#table-datatable th:nth-child(5),
#table-datatable td:nth-child(5) { width: auto; min-width: 150px; }   /* NAMA */
#table-datatable th:nth-child(6),
#table-datatable td:nth-child(6) { width: 80px; min-width: 80px; }  /* JUMLAH */
#table-datatable th:nth-child(7),
#table-datatable td:nth-child(7) { width: 100px; min-width: 100px; }   /* LOKASI */
#table-datatable th:nth-child(8),
#table-datatable td:nth-child(8) { width: 120px; min-width: 120px; }  /* BARCODE */
#table-datatable th:nth-child(9),
#table-datatable td:nth-child(9) { width: 70px; min-width: 70px; }   /* OPSI */
</style>

<div class="content-wrapper">

<section class="content-header">
<h1>
Barang
<small>Data Barang</small>
</h1>

<ol class="breadcrumb">
<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li>
</ol>
</section>


<section class="content">
<div class="row">
<section class="col-lg-12">

<div class="box box-info">

<div class="box-header">
<h3 class="box-title">Barang</h3>

<div class="btn-group pull-right">
<a href="barang_tambah.php" class="btn btn-info btn-sm">
<i class="fa fa-plus"></i> Tambah Barang
</a>
</div>
</div>


<div class="box-body">

<div class="row" style="margin-bottom:15px;">
<div class="col-md-8">

<div class="form-inline">

<div class="form-group">

<label>
<i class="fa fa-barcode"></i> Scan Barcode :
</label>

<input type="text"
id="cari_barcode"
class="form-control"
placeholder="Scan atau input kode barcode..."
autofocus>

<button type="button"
class="btn btn-primary"
onclick="cariBarcode()">

<i class="fa fa-search"></i> Cari
</button>

<button type="button"
class="btn btn-success"
onclick="bukaScanner()">

<i class="fa fa-camera"></i> Kamera
</button>

<a href="barang.php"
class="btn btn-default">

<i class="fa fa-refresh"></i> Reset
</a>

</div>

</div>

<div id="hasil_pencarian" style="margin-top:10px;"></div>

</div>
</div>

<div class="table-responsive">
<table id="table-datatable" class="table table-bordered table-striped">

<thead>

<tr>
<th>NO</th>
<th>KODE</th>
<th>TANGGAL</th>
<th>REGISTER</th>
<th>NAMA</th>
<th>JUMLAH</th>
<th>LOKASI</th>
<th>BARCODE</th>
<th>OPSI</th>
</tr>

</thead>


<tbody id="tabel_barang">

<?php

include '../koneksi.php';

$no=1;

$data = mysqli_query($koneksi,"
SELECT
b.*,
g.lokasi_asal as nama_lokasi
FROM barang b
LEFT JOIN gudang g
ON b.barang_lokasi=g.gudang_id
");

while($d=mysqli_fetch_array($data)){

$barang_id=$d['barang_id'];

$masuk=mysqli_query($koneksi,"
SELECT SUM(bm_jumlah) as total
FROM barang_masuk
WHERE bm_id_barang='$barang_id'
");

$m=mysqli_fetch_assoc($masuk);
$total_masuk=$m['total'] ? $m['total'] : 0;


$keluar=mysqli_query($koneksi,"
SELECT SUM(bk_jumlah_keluar) as total
FROM barang_keluar
WHERE bk_id_barang='$barang_id'
");

$k=mysqli_fetch_assoc($keluar);
$total_keluar=$k['total'] ? $k['total'] : 0;


// Hitung jumlah stok: total_masuk - total_keluar
$stok = $total_masuk - $total_keluar;

?>

<tr>

<td class="text-center">
<?php echo $no++; ?>
</td>

<td class="text-center">
<?php echo $d['barang_id']; ?>
</td>

<td class="text-center">
<?php echo $d['barang_tanggal'] ?? '-'; ?>
</td>

<td class="text-center">
<?php echo $d['barang_register']; ?>
</td>

<td>
<?php echo $d['barang_nama']; ?>
</td>

<td class="text-center">
<b><?php echo $stok; ?></b>
</td>

<td class="text-center">
<?php echo $d['nama_lokasi'] ?? '-'; ?>
</td>

<td class="text-center">

<?php if(!empty($d['barcode'])){ ?>

<img
src="barcode_img.php?text=<?php echo $d['barcode']; ?>"
height="50">

<br>

<small>
<?php echo $d['barcode']; ?>
</small>

<?php }else{ ?>

<img
src="barcode_img.php?text=<?php echo $d['barang_id']; ?>"
height="50">

<br>

<small>
<?php echo $d['barang_id']; ?>
</small>

<?php } ?>

</td>


<td class="text-center">

<a
class="btn btn-warning btn-xs"
href="barang_edit.php?id=<?php echo $d['barang_id']; ?>">

<i class="fa fa-edit"></i>

</a>

<a
class="btn btn-danger btn-xs"
href="barang_hapus_konfir.php?id=<?php echo $d['barang_id']; ?>">

<i class="fa fa-trash"></i>

</a>

</td>

</tr>

<?php } ?>

</tbody>

<tfoot>
<tr class="bg-info">
<th colspan="5" class="text-right">JUMLAH TOTAL:</th>
<th id="total_jumlah">
<?php 
include '../koneksi.php';
// Hitung total dengan mempertimbangkan barang masuk dan keluar
$barang = mysqli_query($koneksi, "SELECT barang_id FROM barang");
$total_keseluruhan = 0;
while($b = mysqli_fetch_assoc($barang)) {
    $bid = $b['barang_id'];
    
    $m = mysqli_query($koneksi, "SELECT SUM(bm_jumlah) as tm FROM barang_masuk WHERE bm_id_barang = '$bid'");
    $md = mysqli_fetch_assoc($m);
    $tm = $md['tm'] ? $md['tm'] : 0;
    
    $k = mysqli_query($koneksi, "SELECT SUM(bk_jumlah_keluar) as tk FROM barang_keluar WHERE bk_id_barang = '$bid'");
    $kd = mysqli_fetch_assoc($k);
    $tk = $kd['tk'] ? $kd['tk'] : 0;
    
    $total_keseluruhan += $tm - $tk;
}
echo number_format($total_keseluruhan, 0, ',', '.');
?>
</th>
<th colspan="3"></th>
</tr>
</tfoot>

</table>

</div>

</div>

</div>

</section>
</div>
</section>

</div>


<script>

function cariBarcode(){

var kode=document.getElementById('cari_barcode').value;

if(kode==""){
location.href='barang.php';
return;
}

window.location='barang.php?barcode='+kode;

}

function bukaScanner(){

window.open(
'barcode_scanner.php',
'ScannerBarcode',
'width=500,height=600'
);

}

function changePageLength(length){
    var table = $('#table-datatable').DataTable();
    table.page.len(parseInt(length)).draw();
}

</script>


<?php include 'footer.php'; ?>

