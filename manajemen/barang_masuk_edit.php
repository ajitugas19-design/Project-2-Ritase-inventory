<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Edit Barang Masuk
      <small>Data Barang Masuk</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Barang Masuk</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6 col-lg-offset-3">       
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Edit Barang Masuk</h3>
            <a href="barang_masuk.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">
            <form action="barang_masuk_update.php" method="post" class="form-horizontal">
              <?php 
              $id = $_GET['id'];              
              $data = mysqli_query($koneksi, "select * from barang_masuk where bm_id='$id'");
              while($d = mysqli_fetch_array($data)){
                ?>
                <input type="hidden" name="id" value="<?php echo $d['bm_id'] ?>">
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">Barang</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="barang" required="required">
                      <option value=""> - Pilih Barang - </option>
                      <?php 
                      $barang = mysqli_query($koneksi,"SELECT * from barang");
                      if($barang){
                        while($b=mysqli_fetch_array($barang)){
                          ?>
                          <option value="<?php echo $b['barang_id']; ?>" <?php if($b['barang_id']==$d['bm_id_barang']){echo "selected";} ?>><?php echo $b['barang_nama']; ?></option>
                          <?php 
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Register</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="register" value="<?php echo $d['bm_register']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Tanggal Masuk</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control datepicker" autocomplete="off" name="tanggal" required="required" value="<?php echo $d['bm_tgl_masuk']; ?>" id="datepicker">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jumlah</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" name="jumlah" required="required" value="<?php echo $d['bm_jumlah']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Berat</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="berat" value="<?php echo $d['bm_berat']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Lokasi Asal</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="id_gudang">
                      <option value="">Pilih Lokasi Asal</option>
                      <?php 
                      $gudang = mysqli_query($koneksi,"SELECT * from gudang");
                      if($gudang){
                        while($g=mysqli_fetch_array($gudang)){
                          ?>
                          <option value="<?php echo $g['gudang_id']; ?>" <?php if($g['gudang_id']==$d['bm_id_gudang']){echo "selected";} ?>><?php echo $g['lokasi_asal']; ?></option>
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
                      <option value=""> LPilih Lokasi Tujuan</option>
                      <?php 
                      $gudang2 = mysqli_query($koneksi,"SELECT * from gudang_2");
                      if($gudang2){
                        while($g2=mysqli_fetch_array($gudang2)){
                          ?>
                          <option value="<?php echo $g2['gudang2_id']; ?>" <?php if($g2['gudang2_id']==$d['bm_id_gudang2']){echo "selected";} ?>><?php echo $g2['lokasi_tujuan']; ?></option>
                          <?php 
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">
                    <a href="barang_masuk.php" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
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
$(document).ready(function(){
  $('.datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    todayHighlight: true
  });
});
</script>

<?php include 'footer.php'; ?>
