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


            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>KODE</th>
                    <th>REGISTER</th>
                    <th>NAMA</th>
                    <th>JUMLAH</th>
                    <th>LOKASI</th>
                    <th>BARCODE</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM barang");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['barang_id']; ?></td>
                      <td><?php echo $d['barang_register']; ?></td>
                      <td><?php echo $d['barang_nama']; ?></td>
                      <td><?php echo $d['barang_jumlah']; ?></td>
                      <td><?php echo $d['barang_lokasi']; ?></td>
                      <td>
                        <img src="../admin/barcode_img.php?text=<?php echo $d['barang_id']; ?>" height="60">
                        <br><small><?php echo $d['barang_id']; ?></small>
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
                    <th colspan="4" class="text-right">JUMLAH TOTAL:</th>
                    <th>
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
<?php include 'footer.php'; ?>
