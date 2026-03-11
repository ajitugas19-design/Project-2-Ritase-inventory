<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Edit Barang Masuk
      <small>Data Barang Masuk</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6">       
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Edit Barang Masuk</h3>
            <a href="barang_masuk.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">
            <form action="barang_masuk_update.php" method="post">
              <?php 
              $id = $_GET['id'];              
              $data = mysqli_query($koneksi, "select * from barang_masuk where bm_id='$id'");
              while($d = mysqli_fetch_array($data)){
                ?>
                
                <!-- Scan Barcode Section -->
                <div class="form-group">
                  <label><i class="fa fa-barcode"></i> Scan Barcode</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="scanBarcodeMasuk" placeholder="Scan atau input kode barcode untuk mencari data...">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" onclick="cariBarcodeMasuk()"><i class="fa fa-search"></i> Cari</button>
                      <button type="button" class="btn btn-success btn-flat" onclick="bukaScannerMasuk()"><i class="fa fa-camera"></i> Kamera</button>
                    </span>
                  </div>
                  <small class="text-muted">Scan atau input kode barcode untuk mencari data barang</small>
                </div>

                <hr>

                <div class="form-group">
                  <label>Barang</label>
                  <input type="hidden" name="id" value="<?php echo $d['bm_id'] ?>">
                  <select class="form-control" name="barang" id="barangSelect" required="required">
                    <option value=""> - Pilih Barang - </option>
                    <?php 
                    $barang = mysqli_query($koneksi,"SELECT * from barang");
                    while($b=mysqli_fetch_array($barang)){
                      ?>
                      <option <?php if($d['bm_id_barang'] == $b['barang_id']){echo "selected='selected'";} ?> value="<?php echo $b['barang_id']; ?>"><?php echo $b['barang_nama']; ?></option>
                      <?php 
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Register</label>
                  <input type="text" class="form-control" name="register" placeholder="Register" value="<?php echo $d['bm_register'] ?>">
                </div>

                <div class="form-group">
                  <label>Tanggal Masuk</label>
                  <input type="text" class="form-control datepicker2" autocomplete="off" name="tanggal" required="required" placeholder="Masukkan Tanggal Masuk .." value="<?php echo $d['bm_tgl_masuk'] ?>">
                </div>

                <div class="form-group">
                  <label>Jumlah</label>
                  <input type="number" class="form-control" name="jumlah" required="required" placeholder="Masukkan Jumlah .." value="<?php echo $d['bm_jumlah'] ?>">
                </div>

                <div class="form-group">
                  <label>Berat</label>
                  <input type="text" class="form-control" name="berat" placeholder="Berat" value="<?php echo $d['bm_berat'] ?>">
                </div>

                <div class="form-group">
                  <label>Lokasi Asal</label>
                  <select class="form-control" name="id_gudang">
                    <option value=""> - Pilih Lokasi Asal - </option>
                    <?php 
                    $gudang = mysqli_query($koneksi,"SELECT * from gudang");
                    while($g=mysqli_fetch_array($gudang)){
                      ?>
                      <option <?php if($d['bm_id_gudang'] == $g['gudang_id']){echo "selected='selected'";} ?> value="<?php echo $g['gudang_id']; ?>"><?php echo $g['lokasi_asal']; ?></option>
                      <?php 
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Lokasi Tujuan</label>
                  <select class="form-control" name="id_gudang2">
                    <option value=""> - Pilih Lokasi Tujuan - </option>
                    <?php 
                    $gudang2 = mysqli_query($koneksi,"SELECT * from gudang_2");
                    while($g2=mysqli_fetch_array($gudang2)){
                      ?>
                      <option <?php if($d['bm_id_gudang2'] == $g2['gudang2_id']){echo "selected='selected'";} ?> value="<?php echo $g2['gudang2_id']; ?>"><?php echo $g2['lokasi_tujuan']; ?></option>
                      <?php 
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <a href="barang_masuk.php" class="btn btn-sm btn-danger">Batal</a>
                  <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                </div>
                <?php 
              }
              ?>
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>

<script>
// Function to search barcode for barang masuk edit
function cariBarcodeMasuk() {
    var kode = document.getElementById('scanBarcodeMasuk').value;
    if(kode == "") {
        alert("Silakan scan atau input kode barcode terlebih dahulu!");
        return;
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "koneksi.php?aksi=cari_barcode&kode=" + kode, true);
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            try {
                var data = JSON.parse(xhr.responseText);
                if(data.found) {
                    var select = document.getElementById('barangSelect');
                    select.value = data.barang_id;
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
function bukaScannerMasuk() {
    window.open('barcode_scanner.php', 'ScannerBarcode', 'width=500,height=600,scrollbars=yes');
}

// Listen for messages from barcode scanner window
window.addEventListener('message', function(event) {
    if(event.data && event.data.type === 'barcodeScan') {
        var barcode = event.data.barcode;
        document.getElementById('scanBarcodeMasuk').value = barcode;
        cariBarcodeMasuk();
    }
});

// Handle Enter key on scan barcode input
document.getElementById('scanBarcodeMasuk').addEventListener('keypress', function(e) {
    if(e.key === 'Enter') {
        e.preventDefault();
        cariBarcodeMasuk();
    }
});
</script>

<?php include 'footer.php'; ?>

