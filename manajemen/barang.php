<?php include 'header.php'; ?>

<style>
/* Table styling */
#table-datatable {
    width: 100% !important;
    font-size: 12px;
}
#table-datatable th,
#table-datatable td {
    vertical-align: middle;
    text-align: center;
    padding: 8px 5px !important;
}
#table-datatable th {
    font-size: 13px;
    font-weight: bold;
}
#table-datatable td {
    font-size: 13px;
}
/* Column widths */
#table-datatable th:nth-child(1),
#table-datatable td:nth-child(1) { width: 40px; }   /* NO */
#table-datatable th:nth-child(2),
#table-datatable td:nth-child(2) { width: 70px; }   /* KODE */
#table-datatable th:nth-child(3),
#table-datatable td:nth-child(3) { width: 90px; }   /* TANGGAL */
#table-datatable th:nth-child(4),
#table-datatable td:nth-child(4) { width: 80px; }   /* REGISTER */
#table-datatable th:nth-child(5),
#table-datatable td:nth-child(5) { min-width: 120px; }   /* NAMA */
#table-datatable th:nth-child(6),
#table-datatable td:nth-child(6) { width: 70px; }   /* JUMLAH */
#table-datatable th:nth-child(7),
#table-datatable td:nth-child(7) { width: 100px; }   /* LOKASI */
#table-datatable th:nth-child(8),
#table-datatable td:nth-child(8) { width: 180px; }   /* BARCODE - diperlebar */
#table-datatable th:nth-child(9),
#table-datatable td:nth-child(9) { width: 80px; }   /* OPSI */

/* Enhanced barcode display */
.barcode-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
}
.barcode-img {
    height: 45px !important;
    width: auto !important;
    max-width: 160px;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 3px;
    background: white;
}
.barcode-text {
    font-size: 11px !important;
    font-family: 'Courier New', monospace;
    font-weight: bold;
    color: #333;
    background: #f8f9fa;
    padding: 2px 8px;
    border-radius: 3px;
    letter-spacing: 1px;
}

/* Button styling */
#table-datatable .btn {
    padding: 4px 8px;
    font-size: 14px;
    margin: 2px;
}

/* Row hover effect */
#table-datatable tbody tr:hover {
    background-color: #f5f5f5;
}

/* Name column styling */
#table-datatable td:nth-child(5) {
    text-align: left;
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Stok badge */
.stok-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 12px;
    font-weight: bold;
    font-size: 12px;
}
.stok-ada {
    background-color: #d4edda;
    color: #155724;
}
.stok-habis {
    background-color: #f8d7da;
    color: #721c24;
}
.stok-rendah {
    background-color: #fff3cd;
    color: #856404;
}
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
              <a href="barang_tambah.php" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> &nbsp Tambah Barang</a>              
            </div>
          </div>

          <div class="box-body">

            <div class="row" style="margin-bottom:10px;">
              <div class="col-md-10">

                <div class="form-inline">
                  <label style="font-size:12px;"><i class="fa fa-barcode"></i> Scan Barcode :</label>

                  <input type="text" id="cari_barcode" class="form-control" 
                  style="width:200px; height:28px; font-size:12px;"
                  placeholder="Scan atau input kode barcode..." autofocus>

                  <button type="button" class="btn btn-primary btn-sm" onclick="cariBarcode()">
                    <i class="fa fa-search"></i> Cari
                  </button>

                  <button type="button" class="btn btn-success btn-sm" onclick="bukaScanner()">
                    <i class="fa fa-camera"></i> Kamera
                  </button>

                  <a href="barang.php" class="btn btn-default btn-sm">
                    <i class="fa fa-refresh"></i> Reset
                  </a>
                </div>

                <div id="hasil_pencarian" style="margin-top:5px;"></div>

              </div>
            </div>


            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr class="bg-primary" style="font-size:10px;">
                    <th>NO</th>
                    <th>KODE</th>
                    <th>TANGGAL</th>
                    <th>REG</th>
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
                  $data = mysqli_query($koneksi,"SELECT b.*, g.lokasi_asal as nama_lokasi FROM barang b LEFT JOIN gudang g ON b.barang_lokasi = g.gudang_id");
                  while($d = mysqli_fetch_array($data)){
                    // Hitung total masuk dan keluar untuk barang ini
                    $barang_id = $d['barang_id'];
                    
                    $masuk = mysqli_query($koneksi, "SELECT SUM(bm_jumlah) as total_masuk FROM barang_masuk WHERE bm_id_barang = '$barang_id'");
                    $masuk_data = mysqli_fetch_assoc($masuk);
                    $total_masuk = $masuk_data['total_masuk'] ? $masuk_data['total_masuk'] : 0;
                    
                    $keluar = mysqli_query($koneksi, "SELECT SUM(bk_jumlah_keluar) as total_keluar FROM barang_keluar WHERE bk_id_barang = '$barang_id'");
                    $keluar_data = mysqli_fetch_assoc($keluar);
                    $total_keluar = $keluar_data['total_keluar'] ? $keluar_data['total_keluar'] : 0;
                    
                    // Jumlah tampilan = total_masuk - total_keluar
                    $jumlah_tampilan = $total_masuk - $total_keluar;
                    
                    // Get barcode text
                    $barcode_teks = !empty($d['barcode']) ? $d['barcode'] : $d['barang_id'];
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d['barang_id']; ?></td>
                      <td class="text-center"><?php echo isset($d['barang_tanggal']) ? $d['barang_tanggal'] : '-'; ?></td>
                      <td class="text-center"><?php echo $d['barang_register']; ?></td>
                      <td class="text-left" style="max-width:80px; overflow:hidden; text-overflow:ellipsis;"><?php echo $d['barang_nama']; ?></td>
                      <td class="text-center"><strong><?php echo $jumlah_tampilan; ?></strong></td>
                      <td class="text-center"><?php echo isset($d['nama_lokasi']) ? $d['nama_lokasi'] : '-'; ?></td>
<td class="text-center">
                        <div class="barcode-container">
                        <img src="../admin/barcode_img.php?text=<?php echo $barcode_teks; ?>" class="barcode-img" alt="bc">
                        <span class="barcode-text"><?php echo $barcode_teks; ?></span>
                        </div>
                      </td>
                      <td class="text-center">                        
                        <a class="btn btn-warning btn-xs" href="barang_edit.php?id=<?php echo $d['barang_id'] ?>" title="Edit"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger btn-xs" href="barang_hapus_konfir.php?id=<?php echo $d['barang_id'] ?>" title="Hapus" onclick="return confirm('Yakin ingin hapus?')"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php 
                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr class="bg-info" style="font-size:10px;">
                    <th colspan="5" class="text-right">JUMLAH TOTAL:</th>
                    <th id="total_jumlah">
                      <?php 
                      include '../koneksi.php';
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
              </table>
            </div>

        </div>
      </section>
    </div>
  </section>

</div>

<script>
function changePageLength(length){
    var table = $('#table-datatable').DataTable();
    table.page.len(parseInt(length)).draw();
}

function cariBarcode() {
    var kode = document.getElementById('cari_barcode').value;
    if(kode == "") {
        location.href = 'barang.php';
        return;
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../koneksi.php?aksi=cari_barcode&kode=" + encodeURIComponent(kode), true);
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            try {
                var data = JSON.parse(xhr.responseText);
                var tabelBody = document.getElementById('tabel_barang');
                var totalJumlah = document.getElementById('total_jumlah');
                
                if(data.found) {
                    var barcodeImg = data.barcode ? data.barcode : data.barang_id;
                    
var html = '<tr>' +
                        '<td class="text-center">1</td>' +
                        '<td class="text-center">' + data.barang_id + '</td>' +
                        '<td class="text-center">' + (data.barang_tanggal ? data.barang_tanggal : '-') + '</td>' +
                        '<td class="text-center">' + (data.barbar_register ? data.barbar_register : '-') + '</td>' +
                        '<td class="text-left" style="max-width:150px; overflow:hidden; text-overflow:ellipsis;">' + data.barang_nama + '</td>' +
                        '<td class="text-center"><strong>' + data.barang_jumlah_tampilan + '</strong></td>' +
                        '<td class="text-center">' + (data.nama_lokasi ? data.nama_lokasi : '-') + '</td>' +
                        '<td class="text-center"><div class="barcode-container"><img src="../admin/barcode_img.php?text=' + barcodeImg + '" class="barcode-img" alt="bc"><span class="barcode-text">' + barcodeImg + '</span></div></td>' +
                        '<td class="text-center">' +
                        '<a class="btn btn-warning btn-xs" href="barang_edit.php?id=' + data.barang_id + '" title="Edit"><i class="fa fa-edit"></i></a> ' +
                        '<a class="btn btn-danger btn-xs" href="barang_hapus_konfir.php?id=' + data.barang_id + '" title="Hapus" onclick="return confirm(\'Yakin ingin hapus?\')"><i class="fa fa-trash"></i></a>' +
                        '</td></tr>';
                    
                    tabelBody.innerHTML = html;
                    totalJumlah.innerHTML = '<strong>' + data.barang_jumlah_tampilan + '</strong>';
                    
                    document.getElementById('hasil_pencarian').innerHTML = 
                        '<div class="alert alert-success"><i class="fa fa-check"></i> Ditemukan: ' + data.barang_nama + ' (Barcode: ' + barcodeImg + ')</div>';
                } else {
                    tabelBody.innerHTML = '<tr><td colspan="9" class="text-center alert alert-warning">Barang tidak ditemukan. <a href="barang_tambah.php">Tambah barang baru?</a></td></tr>';
                    totalJumlah.innerHTML = '0';
                    
                    document.getElementById('hasil_pencarian').innerHTML = 
                        '<div class="alert alert-warning"><i class="fa fa-warning"></i> Barang dengan barcode "' + kode + '" tidak ditemukan</div>';
                }
            } catch(e) {
                console.error("Error:", e);
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'barang.php';
                
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'cari_barcode';
                input.value = kode;
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }
    };
    xhr.send();
}

function bukaScanner() {
    window.open('../admin/barcode_scanner.php', 'ScannerBarcode', 'width=500,height=600,scrollbars=yes');
}

window.addEventListener('message', function(event) {
    if(event.data && event.data.type === 'barcodeScan') {
        var barcode = event.data.barcode;
        document.getElementById('cari_barcode').value = barcode;
        cariBarcode();
    }
});

document.getElementById('cari_barcode').addEventListener('keypress', function(e) {
    if(e.key === 'Enter') {
        e.preventDefault();
        cariBarcode();
    }
});

let searchTimeout;
document.getElementById('cari_barcode').addEventListener('input', function(e) {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(function() {
        var kode = e.target.value;
        if(kode.length >= 3) {
            cariBarcode();
        } else if(kode == "") {
            location.href = 'barang.php';
        }
    }, 300);
});
</script>

<?php include 'footer.php'; ?>

