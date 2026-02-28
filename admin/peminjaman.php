<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Peminjaman
      <small>Data Peminjaman</small>
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
            <h3 class="box-title">Peminjaman</h3>
            
            <div class="btn-group pull-right">
              <a href="peminjaman_tambah.php" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> &nbsp Peminjaman Baru</a>              
              <a href="peminjaman_pdf.php" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
              <a href="peminjaman_print.php" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>
            </div>

          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA</th>
                    <th>BARANG</th>
                    <th>JUMLAH</th>
                    <th>KONDISI</th>
                    <th>TGL.PINJAM</th>
                    <th>TGL.KEMBALI</th>
                    <th>STATUS</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM pinjam,barang where pinjam_barang=barang_id");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['pinjam_peminjam']; ?></td>
                      <td><?php echo $d['barang_nama']; ?></td>
                      <td><?php echo $d['pinjam_jumlah']; ?></td>
                      <td><?php echo $d['pinjam_kondisi']; ?></td>
                      <td><?php echo $d['pinjam_tgl_pinjam']; ?></td>
                      <td><?php echo $d['pinjam_tgl_kembali']; ?></td>
                      <td>
                        <?php 
                        if($d['pinjam_status'] == "Dikembalikan"){
                          echo "<span class='label label-success'>Di Kembalikan</span>";
                        }elseif($d['pinjam_status'] == "Dipinjam"){
                          echo "<span class='label label-danger'>Di Pinjam</span>";
                        }
                        ?>

                      </td>
                      <td>                        
                        <a class="btn btn-warning btn-sm" href="peminjaman_edit.php?id=<?php echo $d['pinjam_id'] ?>"><i class="fa fa-cog"></i></a>
                        <a class="btn btn-danger btn-sm" href="peminjaman_hapus.php?id=<?php echo $d['pinjam_id'] ?>"><i class="fa fa-trash"></i></a>
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
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>