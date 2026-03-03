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
            <form action="barang_act.php" method="post">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama ..">
              </div>

              <div class="form-group">
                <label>Register</label>
                <input type="text" class="form-control" name="register" placeholder="Masukkan Register ..">
              </div>

              <div class="form-group">
                <label>Lokasi</label>
                <input type="text" class="form-control" name="lokasi" required="required" placeholder="Masukkan lokasi ..">
              </div>

              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" required="required" placeholder="Masukkan jumlah ..">
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
<?php include 'footer.php'; ?>
