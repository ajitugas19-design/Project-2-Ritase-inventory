<?php include 'header.php'; ?>

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
            
            <!-- Form Pencarian Barcode (Real-time dengan AJAX) -->
            <div class="row" style="margin-bottom: 15px;">
              <div class="col-md-8">
                <div class="form-inline">
                  <div class="form-group">
                    <label><i class="fa fa-barcode"></i> Scan Barcode: </label>
                    <input type="text" id="cari_barcode" class="form-control" placeholder="Scan atau input kode barcode..." autofocus>
                    <button type="button" class="btn btn-primary" onclick="cariBarcode()"><i class="fa fa-search"></i> Cari</button>
                    <button type="button" class="btn btn-success" onclick="bukaScanner()"><i class="fa fa-camera"></i> Kamera</button>
                    <a href="barang.php" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</a>
                  </div>
                </div>
                <div id="hasil_pencarian" style="margin-top: 10px;"></div>
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
                  $data = mysqli_query($koneksi,"SELECT * FROM barang $where");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['barang_id']; ?></td>
                      <td><?php echo isset($d['barang_tanggal']) ? $d['barang_tanggal'] : '-'; ?></td>
                      <td><?php echo $d['barang_register']; ?></td>
                      <td><?php echo $d['barang_nama']; ?></td>
                      <td><?php echo $d['barang_jumlah']; ?></td>
                      <td><?php echo $d['barang_lokasi']; ?></td>
                      <td>
                        <?php if(!empty($d['barcode'])): ?>
                        <img src="barcode_img.php?text=<?php echo $d['barcode']; ?>" height="60">
                        <br><small><?php echo $d['barcode']; ?></small>
                        <?php else: ?>
                        <img src="barcode_img.php?text=<?php echo $d['barang_id']; ?>" height="60">
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
                      $jumlah = mysqli_query($koneksi, "SELECT SUM(barang_jumlah) as total FROM barang");
                      $j = mysqli_fetch_assoc($jumlah);
                      echo number_format($j['total'], 0, ',', '.');
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
function cariBarcode() {
    var kode = document.getElementById('cari_barcode').value;
    if(kode == "") {
        // Jika kosong, tampilkan semua data
        location.href = 'barang.php';
        return;
    }
    
    // Cari menggunakan AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../koneksi.php?aksi=cari_barcode&kode=" + encodeURIComponent(kode), true);
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            try {
                var data = JSON.parse(xhr.responseText);
                var tabelBody = document.getElementById('tabel_barang');
                var totalJumlah = document.getElementById('total_jumlah');
                
                if(data.found) {
                    // Tampilkan 1 barang yang ditemukan
                    var barcodeImg = data.barcode ? data.barcode : data.barang_id;
                    var html = '<tr>' +
                        '<td>1</td>' +
                        '<td>' + data.barang_id + '</td>' +
                        '<td>-</td>' +
                        '<td>-</td>' +
                        '<td>' + data.barang_nama + '</td>' +
                        '<td>' + data.barang_jumlah + '</td>' +
                        '<td>' + data.barang_lokasi + '</td>' +
                        '<td><img src="barcode_img.php?text=' + barcodeImg + '" height="60"><br><small>' + barcodeImg + '</small></td>' +
                        '<td>' +
                        '<a class="btn btn-warning btn-sm" href="barang_edit.php?id=' + data.barang_id + '"><i class="fa fa-edit"></i></a> ' +
                        '<a class="btn btn-danger btn-sm" href="barang_hapus_konfir.php?id=' + data.barang_id + '"><i class="fa fa-trash"></i></a>' +
                        '</td></tr>';
                    
                    tabelBody.innerHTML = html;
                    totalJumlah.innerHTML = data.barang_jumlah;
                    
                    document.getElementById('hasil_pencarian').innerHTML = 
                        '<div class="alert alert-success"><i class="fa fa-check"></i> Ditemukan: ' + data.barang_nama + ' (Barcode: ' + barcodeImg + ')</div>';
                } else {
                    // Tidak ditemukan, tampilkan semua dengan highlight
                    tabelBody.innerHTML = '<tr><td colspan="9" class="text-center alert alert-warning">Barang tidak ditemukan. <a href="barang_tambah.php">Tambah barang baru?</a></td></tr>';
                    totalJumlah.innerHTML = '0';
                    
                    document.getElementById('hasil_pencarian').innerHTML = 
                        '<div class="alert alert-warning"><i class="fa fa-warning"></i> Barang dengan barcode "' + kode + '" tidak ditemukan</div>';
                }
            } catch(e) {
                console.error("Error:", e);
                // Fallback: reload dengan POST
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
    window.open('barcode_scanner.php', 'ScannerBarcode', 'width=500,height=600,scrollbars=yes');
}

// Listen for messages from barcode scanner window
window.addEventListener('message', function(event) {
    if(event.data && event.data.type === 'barcodeScan') {
        var barcode = event.data.barcode;
        document.getElementById('cari_barcode').value = barcode;
        cariBarcode();
    }
});

// Handle Enter key pada scan barcode
document.getElementById('cari_barcode').addEventListener('keypress', function(e) {
    if(e.key === 'Enter') {
        e.preventDefault();
        cariBarcode();
    }
});

// Real-time search saat mengetik (delay 300ms)
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
