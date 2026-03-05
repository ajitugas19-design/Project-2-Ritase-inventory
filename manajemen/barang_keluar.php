<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      <i class="fa fa-mail-forward"></i> Barang Keluar
      <small>Data Barang Keluar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Barang Keluar</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-list"></i> Data Barang Keluar</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_barang_keluar">
                <i class="fa fa-plus"></i> Tambah
              </button>
            </div>
          </div>
          
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable" style="width: 100%;">
                <thead>
                  <tr class="bg-primary text-center">
                    <th width="5%">NO</th>
                    <th>KODE</th>
                    <th>NAMA BARANG</th>
                    <th>REGISTER</th>
                    <th>TANGGAL KELUAR</th>
                    <th>JUMLAH</th>
                    <th>BERAT</th>
                    <th>LOKASI ASAL</th>
                    <th>LOKASI TUJUAN</th>
                    <th width="12%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT bk.*, 
                    g1.lokasi_asal as nama_gudang,
                    g2.lokasi_tujuan as nama_gudang2
                    FROM barang_keluar bk
                    LEFT JOIN gudang g1 ON bk.bk_id_gudang = g1.gudang_id
                    LEFT JOIN gudang_2 g2 ON bk.bk_id_gudang2 = g2.gudang2_id
                    ORDER BY bk.bk_id DESC");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td><?php echo $d['bk_id_barang']; ?></td>
                      <td><?php echo $d['bk_nama_barang']; ?></td>
                      <td><?php echo $d['bk_register']; ?></td>
                      <td><?php echo $d['bk_tgl_keluar']; ?></td>
                      <td><?php echo $d['bk_jumlah_keluar']; ?></td>
                      <td><?php echo $d['bk_berat']; ?></td>
                      <td><?php echo $d['nama_gudang']; ?></td>
                      <td><?php echo $d['nama_gudang2']; ?></td>
                      <td class="text-center">                        
                        <a class="btn btn-warning btn-xs" href="barang_keluar_edit.php?id=<?php echo $d['bk_id'] ?>" title="Edit" style="margin-right: 3px;">
                          <i class="fa fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-xs" href="barang_keluar_hapus.php?id=<?php echo $d['bk_id'] ?>" onclick="return confirm('Yakin ingin hapus?')" title="Hapus" style="margin-left: 3px;">
                          <i class="fa fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                    <?php 
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

<!-- Modal Tambah Barang Keluar -->
<div class="modal fade" id="modal_barang_keluar" tabindex="-1" role="dialog" aria-labelledby="modal_barang_keluar_label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="modal_barang_keluar_label"><i class="fa fa-plus"></i> Tambah Barang Keluar</h4>
      </div>
      <div class="modal-body">
        <form action="barang_keluar_act.php" method="post" class="form-horizontal">
          
<!-- Scan Barcode Section -->
          <div class="form-group">
            <label class="col-sm-3 control-label"><i class="fa fa-barcode"></i> Scan Barcode</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="text" class="form-control" id="scanBarcodeKeluar" placeholder="Scan barcode untuk auto-fill data barang..." autofocus>
                <span class="input-group-btn">
                  <button type="button" class="btn btn-info btn-flat" onclick="cariBarcodeKeluar()"><i class="fa fa-search"></i> Cari</button>
                  <button type="button" class="btn btn-success btn-flat" onclick="bukaScannerKeluar()"><i class="fa fa-camera"></i> Kamera</button>
                </span>
              </div>
              <small class="text-muted">Scan atau input kode barcode untuk mencari barang secara otomatis</small>
            </div>
          </div>

          <hr>

          <div class="form-group">
            <label class="col-sm-3 control-label">Barang</label>
            <div class="col-sm-9">
              <select class="form-control" name="barang" id="barangSelect" required="required">
                <option value=""> - Pilih Barang - </option>
                <?php 
                $barang = mysqli_query($koneksi,"SELECT * from barang");
                if($barang){
                  while($b=mysqli_fetch_array($barang)){
                    ?>
                    <option value="<?php echo $b['barang_id']; ?>"><?php echo $b['barang_nama']; ?></option>
                    <?php 
                  }
                }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Nama Barang</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="namaBarang" placeholder="Nama barang akan terisi otomatis" readonly>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Register</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="register" placeholder="Register">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Tanggal Keluar</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" name="tanggal" required="required" value="<?php echo date('Y-m-d'); ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Jumlah</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" name="jumlah" required="required" placeholder="Jumlah">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Berat</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="berat" placeholder="Berat">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Lokasi Asal</label>
            <div class="col-sm-9">
              <select class="form-control" name="id_gudang">
                <option value=""> - Pilih Gudang - </option>
                <?php 
                $gudang = mysqli_query($koneksi,"SELECT * from gudang");
                if($gudang){
                  while($g=mysqli_fetch_array($gudang)){
                    ?>
                    <option value="<?php echo $g['gudang_id']; ?>"><?php echo $g['lokasi_asal']; ?></option>
                    <?php 
                  }
                }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Lokasi Tujuan</label>
            <div class="col-sm-9">
              <select class="form-control" name="id_gudang2">
                <option value=""> - Pilih Gudang 2 - </option>
                <?php 
                $gudang2 = mysqli_query($koneksi,"SELECT * from gudang_2");
                if($gudang2){
                  while($g2=mysqli_fetch_array($gudang2)){
                    ?>
                    <option value="<?php echo $g2['gudang2_id']; ?>"><?php echo $g2['lokasi_tujuan']; ?></option>
                    <?php 
                  }
                }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $('#table-datatable').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : true,
    'scrollX'     : false,
    'responsive'  : true,
    "pageLength": 10,
    "order": [[ 4, "desc" ]], 
    'language': {
      'search': 'Pencarian:',
      'lengthMenu': 'Tampilkan _MENU_ data per halaman',
      'zeroRecords': 'Data tidak ditemukan',
      'info': 'Menampilkan halaman _PAGE_ dari _PAGES_',
      'infoEmpty': 'Tidak ada data',
      'paginate': {
        'first': 'Pertama',
        'last': 'Terakhir',
        'next': 'Selanjutnya',
        'previous': 'Sebelumnya'
      }
    }
  });
  
  // Datepicker with auto set current date
  $('.datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    todayHighlight: true
  }).datepicker('setDate', new Date());
});

// Function to search barcode for barang keluar
function cariBarcodeKeluar() {
    var kode = document.getElementById('scanBarcodeKeluar').value;
    if(kode == "") {
        alert("Silakan scan atau input kode barcode terlebih dahulu!");
        return;
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../koneksi.php?aksi=cari_barcode&kode=" + kode, true);
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            try {
                var data = JSON.parse(xhr.responseText);
                if(data.found) {
                    var select = document.getElementById('barangSelect');
                    select.value = data.barang_id;
                    document.getElementById('namaBarang').value = data.barang_nama;
                    alert("Barang ditemukan: " + data.barang_nama);
                } else {
                    alert("Barang dengan barcode tersebut tidak ditemukan!");
                }
            } catch(e) {
                console.error("Error parsing JSON:", e);
                alert("Terjadi kesalahan dalam pencarian!");
            }
        }
    };
    xhr.send();
}

// Function to open barcode scanner camera
function bukaScannerKeluar() {
    window.open('barcode_scanner.php', 'ScannerBarcode', 'width=500,height=600,scrollbars=yes');
}

// Listen for messages from barcode scanner window
window.addEventListener('message', function(event) {
    if(event.data && event.data.type === 'barcodeScan') {
        var barcode = event.data.barcode;
        document.getElementById('scanBarcodeKeluar').value = barcode;
        cariBarcodeKeluar();
    }
});

// Handle Enter key on scan barcode input
document.getElementById('scanBarcodeKeluar').addEventListener('keypress', function(e) {
    if(e.key === 'Enter') {
        e.preventDefault();
        cariBarcodeKeluar();
    }
});

// When barang dropdown changes, also update nama barang display
document.getElementById('barangSelect').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    if(this.value != "") {
        document.getElementById('namaBarang').value = selectedOption.text;
    } else {
        document.getElementById('namaBarang').value = "";
    }
});
</script>

<?php include 'footer.php'; ?>
