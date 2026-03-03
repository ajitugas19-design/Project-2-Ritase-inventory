<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Edit Barang Keluar
      <small>Data Barang Keluar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Barang Keluar</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6 col-lg-offset-3">       
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Edit Barang Keluar</h3>
            <a href="barang_keluar.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">
            <form action="barang_keluar_update.php" method="post">
              <?php 
              $id = $_GET['id'];              
              $data = mysqli_query($koneksi, "select * from barang_keluar where bk_id='$id'");
              while($d = mysqli_fetch_array($data)){
                ?>
                
                <div class="form-group">
                  <label>Barang</label>
                  <input type="hidden" name="id" value="<?php echo $d['bk_id'] ?>">
                  <select class="form-control" name="barang" required="required">
                    <option value=""> - Pilih Barang - </option>
                    <?php 
                    $barang = mysqli_query($koneksi,"SELECT * from barang");
                    if($barang){
                      while($b=mysqli_fetch_array($barang)){
                        ?>
                        <option <?php if($d['bk_id_barang'] == $b['barang_id']){echo "selected='selected'";} ?> value="<?php echo $b['barang_id']; ?>"><?php echo $b['barang_nama']; ?></option>
                        <?php 
                      }
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Register</label>
                  <input type="text" class="form-control" name="register" value="<?php echo $d['bk_register'] ?>">
                </div>

                <div class="form-group">
                  <label>Tanggal Keluar</label>
                  <input type="text" class="form-control datepicker" autocomplete="off" name="tanggal" required="required" value="<?php echo $d['bk_tgl_keluar'] ?>">
                </div>

                <div class="form-group">
                  <label>Jumlah</label>
                  <input type="number" class="form-control" name="jumlah" required="required" value="<?php echo $d['bk_jumlah_keluar'] ?>">
                </div>

                <div class="form-group">
                  <label>Berat</label>
                  <input type="text" class="form-control" name="berat" value="<?php echo $d['bk_berat'] ?>">
                </div>

                <div class="form-group">
                  <label>Lokasi Asal</label>
                  <select class="form-control" name="id_gudang">
                    <option value=""> - Pilih Lokasi Asal - </option>
                    <?php 
                    $gudang = mysqli_query($koneksi,"SELECT * from gudang");
                    if($gudang){
                      while($g=mysqli_fetch_array($gudang)){
                        ?>
                        <option value="<?php echo $g['gudang_id']; ?>" <?php if($g['gudang_id']==$d['bk_id_gudang']){echo "selected='selected'";} ?>><?php echo $g['lokasi_asal']; ?></option>
                        <?php 
                      }
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
                    if($gudang2){
                      while($g2=mysqli_fetch_array($gudang2)){
                        ?>
                        <option value="<?php echo $g2['gudang2_id']; ?>" <?php if($g2['gudang2_id']==$d['bk_id_gudang2']){echo "selected='selected'";} ?>><?php echo $g2['lokasi_tujuan']; ?></option>
                        <?php 
                      }
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <a href="barang_keluar.php" class="btn btn-danger btn-sm">Batal</a>
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
$(document).ready(function(){
  $('.datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    todayHighlight: true
  });
});
</script>

<?php include 'footer.php'; ?>
