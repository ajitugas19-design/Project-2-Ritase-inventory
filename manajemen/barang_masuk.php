<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      <i class="fa fa-mail-reply"></i> Barang Masuk
      <small>Data Barang Masuk</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Barang Masuk</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-list"></i> Data Barang Masuk</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_barang_masuk">
                <i class="fa fa-plus"></i> Tambah
              </button>
            </div>
          </div>

          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr class="bg-primary text-center">
                    <th width="5%">NO</th>
                    <th>NO REGISTER</th>
                    <th>NAMA BARANG</th>
                    <th>TANGGAL MASUK</th>
                    <th>BERAT</th>
                    <th>LOKASI ASAL</th>
                    <th>LOKASI TUJUAN</th>
                    <th width="12%">OPSI</th>
                  </tr>
                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT bm.*, 
                    g1.lokasi_asal as nama_gudang,
                    g2.lokasi_tujuan as nama_gudang2
                    FROM barang_masuk bm
                    LEFT JOIN gudang g1 ON bm.bm_id_gudang = g1.gudang_id
                    LEFT JOIN gudang_2 g2 ON bm.bm_id_gudang2 = g2.gudang2_id
                    ORDER BY bm.bm_id DESC");
                  while($d = mysqli_fetch_array($data)){
                  ?>
                  <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td><?php echo $d['bm_nama_barang']; ?></td>
                    <td><?php echo $d['bm_register']; ?></td>
                    <td><?php echo $d['bm_tgl_masuk']; ?></td>
                    <td><?php echo $d['bm_berat']; ?></td>
                    <td><?php echo $d['nama_gudang']; ?></td>
                    <td><?php echo $d['nama_gudang2']; ?></td>
                    <td class="text-center">
                      <a class="btn btn-warning btn-xs" href="barang_masuk_edit.php?id=<?php echo $d['bm_id'] ?>" title="Edit" style="margin-right: 3px;">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a class="btn btn-danger btn-xs" href="barang_masuk_hapus.php?id=<?php echo $d['bm_id'] ?>" onclick="return confirm('Yakin ingin hapus?')" title="Hapus" style="margin-left: 3px;">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>

      </div>
    </div>
  </section>

</div>

<!-- Modal Tambah Barang Masuk -->
<div class="modal fade" id="modal_barang_masuk" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Barang Masuk</h4>
      </div>
      <div class="modal-body">
        <form action="barang_masuk_act.php" method="post" class="form-horizontal">
          
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
                    <option value="<?php echo $b['barang_id']; ?>"><?php echo $b['barang_nama']; ?></option>
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
              <input type="text" class="form-control" name="register" placeholder="Register">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Tanggal Masuk</label>
            <div class="col-sm-9">
              <input type="text" class="form-control datepicker" autocomplete="off" name="tanggal" required="required" placeholder="Tanggal Masuk" id="datepicker">
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
                <option value=""> Pilih Lokasi Asal </option>
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
                <option value=""> Pilih Lokasi Tujuan </option>
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
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    scrollX: false,
    responsive: true,
    pageLength: 10,
    order: [[3,"desc"]],
    language: {
      search: 'Pencarian:',
      lengthMenu: 'Tampilkan _MENU_ data per halaman',
      zeroRecords: 'Data tidak ditemukan',
      info: 'Menampilkan halaman _PAGE_ dari _PAGES_',
      infoEmpty: 'Tidak ada data',
      paginate: {
        first: 'Pertama',
        last: 'Terakhir',
        next: 'Selanjutnya',
        previous: 'Sebelumnya'
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
</script>

<?php include 'footer.php'; ?>
