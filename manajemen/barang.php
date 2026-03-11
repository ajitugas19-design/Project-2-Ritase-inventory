<?php include 'header.php'; ?>

<style>
/* Table Layout Fix - Scroll vertical only */
.table-responsive {
    max-height: 400px;
    overflow-y: auto;
}
#table-datatable th, 
#table-datatable td {
    vertical-align: middle;
    text-align: center;
    font-size: 13px;
}
#table-datatable th {
    font-weight: 700;
}
#table-datatable td strong {
    font-weight: 800;
}
/* Column Sizes */
#table-datatable th:nth-child(1),
#table-datatable td:nth-child(1) { width: 40px; min-width: 40px; }
#table-datatable th:nth-child(2),
#table-datatable td:nth-child(2) { width: 80px; min-width: 80px; }
#table-datatable th:nth-child(3),
#table-datatable td:nth-child(3) { width: 100px; min-width: 100px; }
#table-datatable th:nth-child(4),
#table-datatable td:nth-child(4) { width: 100px; min-width: 100px; }
#table-datatable th:nth-child(5),
#table-datatable td:nth-child(5) { width: auto; min-width: 150px; }
#table-datatable th:nth-child(6),
#table-datatable td:nth-child(6) { width: 80px; min-width: 80px; }
#table-datatable th:nth-child(7),
#table-datatable td:nth-child(7) { width: 100px; min-width: 100px; }
#table-datatable th:nth-child(8),
#table-datatable td:nth-child(8) { width: 120px; min-width: 120px; }
#table-datatable th:nth-child(9),
#table-datatable td:nth-child(9) { width: 70px; min-width: 70px; }
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
          <div class="box-body">

<div class="row" style="margin-bottom:15px;">
  <div class="col-md-12">

    <div class="form-inline">
      <label><i class="fa fa-barcode"></i> Scan Barcode :</label>

      <input type="text" id="cari_barcode" class="form-control" 
      placeholder="Scan atau input kode barcode..." autofocus>

      <button type="button" class="btn btn-primary" onclick="cariBarcode()">
        <i class="fa fa-search"></i> Cari
      </button>

      <button type="button" class="btn btn-success" onclick="bukaScanner()">
        <i class="fa fa-camera"></i> Kamera
      </button>

      <a href="barang.php" class="btn btn-default">
        <i class="fa fa-refresh"></i> Reset
      </a>
    </div>

<div id="hasil_pencarian" style="margin-top:10px;"></div>

</div>
</div>


            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>KODE</th>
                    <th>TANGGAL</th>
                    <th>REGISTER</th>
                    <th>NAMA</th>
                    <th>JUMLAH</th>
                    <th>LOKASI</th>
                    <th>BARCODE</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody id="tabel_barang">
                  <?php 
                  include '../koneksi.php';
                  
                  // Default: tampilkan semua data
                  $where = "";
                  if(isset($_POST['cari_barcode']) && $_POST['cari_barcode'] != "") {
                      $cari = $_POST['cari_barcode'];
                      $where = "WHERE barang_id = '$cari' OR barang_nama LIKE '%$cari%' OR barang_register LIKE '%$cari%' OR barcode LIKE '%$cari%'";
                  }
                  
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT b.*, g.lokasi_asal as nama_lokasi FROM barang b LEFT JOIN gudang g ON b.barang_lokasi = g.gudang_id $where");
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
                    // Database tidak punya kolom barang_jumlah
                    $jumlah_tampilan = $total_masuk - $total_keluar;
                    
                    // Tentukan keterangan berdasarkan status dengan jumlah
                    $keterangan = "";
                    $keterangan_class = "";
                    
                    if ($total_masuk > 0 && $total_keluar > 0) {
                        $keterangan = "🟢 Data Dimasukkan: +" . $total_masuk . " | 🔴 Barang Diambil: -" . $total_keluar;
                        $keterangan_class = "text-orange";
                    } elseif ($total_masuk > 0) {
                        $keterangan = "🟢 Data Dimasukkan: +" . $total_masuk;
                        $keterangan_class = "text-green";
                    } elseif ($total_keluar > 0) {
                        $keterangan = "🔴 Barang Diambil: -" . $total_keluar;
                        $keterangan_class = "text-red";
                    }
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['barang_id']; ?></td>
                      <td><?php echo isset($d['barang_tanggal']) ? $d['barang_tanggal'] : '-'; ?></td>
                      <td><?php echo $d['barang_register']; ?></td>
                      <td><?php echo $d['barang_nama']; ?></td>
                      <td><strong><?php echo $jumlah_tampilan; ?></strong></td>
                      <td><?php echo isset($d['nama_lokasi']) ? $d['nama_lokasi'] : '-'; ?></td>
                      <td>
                        <?php if(!empty($d['barcode'])): ?>
                        <img src="../admin/barcode_img.php?text=<?php echo $d['barcode']; ?>" height="60">
                        <br><small><?php echo $d['barcode']; ?></small>
                        <?php else: ?>
                        <img src="../admin/barcode_img.php?text=<?php echo $d['barang_id']; ?>" height="60">
                        <br><small><?php echo $d['barang_id']; ?></small>
                        <?php endif; ?>
                      </td>
                      <td>                        
                        <a class="btn btn-warning btn-sm" href="barang_edit.php?id=<?php echo $d['barang_id'] ?>"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="barang_hapus_konfir.php?id=<?php echo $d['barang_id'] ?>"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php 
                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr class="bg-info">
                    <th colspan="5" class="text-right">JUMLAH TOTAL:</th>
                    <th id="total_jumlah">
                      <?php 
                      include '../koneksi.php';
                      // Hitung total dari barang_masuk dan barang_keluar
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
                    <th colspan="4"></th>
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
                    
                    // Determine keterangan with quantity
                    var keterangan = '-';
                    var keteranganClass = '';
                    if(data.total_masuk > 0 && data.total_keluar > 0) {
                        keterangan = '🟢 Data Dimasukkan: +' + data.total_masuk + ' | 🔴 Barang Diambil: -' + data.total_keluar;
                        keteranganClass = 'text-orange';
                    } else if(data.total_masuk > 0) {
                        keterangan = '🟢 Data Dimasukkan: +' + data.total_masuk;
                        keteranganClass = 'text-green';
                    } else if(data.total_keluar > 0) {
                        keterangan = '🔴 Barang Diambil: -' + data.total_keluar;
                        keteranganClass = 'text-red';
                    }
                    
                    var html = '<tr>' +
                        '<td>1</td>' +
                        '<td>' + data.barang_id + '</td>' +
                        '<td>' + (data.barang_tanggal ? data.barang_tanggal : '-') + '</td>' +
                        '<td>' + (data.barang_register ? data.barang_register : '-') + '</td>' +
                        '<td>' + data.barang_nama + '</td>' +
                        '<td><strong>' + data.barang_jumlah_tampilan + '</strong>' + 
                        (data.total_masuk > 0 || data.total_keluar > 0 ? '<br><small class="text-muted">(Dasar: ' + data.barang_jumlah + ' | Masuk: +' + data.total_masuk + ' | Keluar: -' + data.total_keluar + ')</small>' : '') + 
                        '</td>' +
                        '<td class="' + keteranganClass + '">' + (keterangan !== '-' ? '<i class="fa fa-info-circle"></i> ' + keterangan : '-') + '</td>' +
                        '<td>' + data.barang_lokasi + '</td>' +
                        '<td><img src="../admin/barcode_img.php?text=' + barcodeImg + '" height="60"><br><small>' + barcodeImg + '</small></td>' +
                        '<td>' +
                        '<a class="btn btn-warning btn-sm" href="barang_edit.php?id=' + data.barang_id + '"><i class="fa fa-edit"></i></a> ' +
                        '<a class="btn btn-danger btn-sm" href="barang_hapus_konfir.php?id=' + data.barang_id + '"><i class="fa fa-trash"></i></a>' +
                        '</td></tr>';
                    
                    tabelBody.innerHTML = html;
                    totalJumlah.innerHTML = data.barang_jumlah_tampilan;
                    
                    document.getElementById('hasil_pencarian').innerHTML = 
                        '<div class="alert alert-success"><i class="fa fa-check"></i> Ditemukan: ' + data.barang_nama + ' (Barcode: ' + barcodeImg + ')</div>';
                } else {
                    tabelBody.innerHTML = '<tr><td colspan="10" class="text-center alert alert-warning">Barang tidak ditemukan. <a href="barang_tambah.php">Tambah barang baru?</a></td></tr>';
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
