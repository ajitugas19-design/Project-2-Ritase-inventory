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
                    <th>NAMA BARANG</th>
                    <th>REGISTER</th>
                    <th>TANGGAL KELUAR</th>
                    <th>JUMLAH</th>
                    <th>BERAT</th>
                    <th>LOKASI</th>
                    <th>PENERIMA</th>
                    <th width="8%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM barang_keluar ORDER BY bk_id DESC");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td><?php echo $d['bk_nama_barang']; ?></td>
                      <td><?php echo $d['bk_register']; ?></td>
                      <td><?php echo $d['bk_tgl_keluar']; ?></td>
                      <td class="text-center"><?php echo $d['bk_jumlah_keluar']; ?></td>
                      <td><?php echo $d['bk_berat']; ?></td>
                      <td><?php echo $d['bk_lokasi']; ?></td>
                      <td><?php echo $d['bk_penerima']; ?></td>
                      <td class="text-center">                        
                        <a class="btn btn-danger btn-xs" href="barang_keluar_hapus.php?id=<?php echo $d['bk_id'] ?>" onclick="return confirm('Yakin ingin hapus?')">
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
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Barang</label>
            <div class="col-sm-9">
              <select class="form-control" name="barang" required="required">
                <option value=""> - Pilih Barang - </option>
                <?php 
                $barang = mysqli_query($koneksi,"SELECT * from barang");
                while($b=mysqli_fetch_array($barang)){
                  ?>
                  <option value="<?php echo $b['barang_id']; ?>"><?php echo $b['barang_nama']; ?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Register</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" name="register" required="required" placeholder="Masukkan Register">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Tanggal</label>
            <div class="col-sm-9">
              <input type="text" class="form-control datepicker" autocomplete="off" name="tanggal" required="required" placeholder="Tanggal Keluar" id="datepicker">
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
              <input type="number" class="form-control" name="berat" placeholder="Berat">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Lokasi</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="lokasi" placeholder="Lokasi">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Penerima</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="penerima" placeholder="Penerima">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Keterangan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="keterangan" placeholder="Keterangan">
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
    "order": [[ 3, "desc" ]], // Default urutkan berdasarkan kolom ke-4 (tanggal) descending
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
});
</script>

<?php include 'footer.php'; ?>
