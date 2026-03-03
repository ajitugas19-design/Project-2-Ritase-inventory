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
                
                <div class="form-group">
                  <label>Barang</label>
                  <input type="hidden" name="id" value="<?php echo $d['bm_id'] ?>">
                  <select class="form-control" name="barang" required="required">
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
                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
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
<?php include 'footer.php'; ?>
