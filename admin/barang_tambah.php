<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Barang
      <small>Tambah Barang Baru</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6 col-lg-offset-3">       
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Tambah Barang Baru</h3>
            <a href="barang.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">
            <form action="barang_act.php" method="post" id="formBarang">
              <!-- Scan Barcode Field -->
              <div class="form-group">
                <label><i class="fa fa-barcode"></i> Scan Barcode (Opsional)</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="scanBarcode" placeholder="Scan barcode untuk auto-fill data..." autofocus>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-info btn-flat" onclick="cariBarcode()"><i class="fa fa-search"></i> Cari</button>
                  </span>
                </div>
              </div>
              
              <hr>

              <div class="form-group">
                <label>No (Auto)</label>
                <input type="text" class="form-control" name="id" id="barangId" readonly placeholder="Akan digenerate otomatis">
              </div>

              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" required="required" placeholder="Masukkan Nama ..">
              </div>

              <div class="form-group">
                <label>Lokasi</label>
                <input type="text" class="form-control" name="lokasi" id="lokasi" required="required" placeholder="Masukkan lokasi ..">
              </div>

              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" id="jumlah" required="required" placeholder="Masukkan jumlah .." value="1" min="1">
              </div>

              <div class="form-group">
                <label>Barcode</label>
                <input type="text" class="form-control" name="barcode" id="barcode" placeholder="Masukkan kode barcode...">
              </div>

              <div class="form-group">
                <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
              </div>
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>

<script>
function cariBarcode() {
    var kode = document.getElementById('scanBarcode').value;
    if(kode == "") {
        alert("Silakan scan atau input kode barcode terlebih dahulu!");
        return;
    }
    
    // Cari data barang berdasarkan barcode
    fetch('../koneksi.php?aksi=cari_barcode&kode=' + kode)
    .then(response => response.json())
    .then(data => {
        if(data.found) {
            document.getElementById('barangId').value = data.barang_id;
            document.getElementById('nama').value = data.barang_nama;
            document.getElementById('lokasi').value = data.barang_lokasi;
            document.getElementById('jumlah').value = data.barang_jumlah;
            document.getElementById('barcode').value = data.barang_keterangan;
            alert("Data barang ditemukan!");
        } else {
            alert("Barang dengan kode tersebut tidak ditemukan. Anda dapat menambah barang baru.");
            document.getElementById('barcode').value = kode;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Fallback: langsung set barcode
        document.getElementById('barcode').value = kode;
    });
}

// Handle Enter key pada scan barcode
document.getElementById('scanBarcode').addEventListener('keypress', function(e) {
    if(e.key === 'Enter') {
        e.preventDefault();
        cariBarcode();
    }
});
</script>

<?php include 'footer.php'; ?>
