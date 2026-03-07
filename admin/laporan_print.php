<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrator - Sistem Informasi Inventaris Sarana & Prasarana SMK</title>
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

</head>
<body>

  <center>
    <h4>LAPORAN</h4>
    <h4>Sistem Informasi Inventaris Sarana & Prasarana</h4>
  </center>

  <?php include '../koneksi.php'; ?>
  <?php 
  if(isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['jenis'])){
    $tgl_dari = $_GET['tanggal_dari'];
    $tgl_sampai = $_GET['tanggal_sampai'];
    $jenis = $_GET['jenis'];
    ?>

    <table class="">
      <tr>
        <th width="40%">DARI TANGGAL</th>
        <th width="10%" class="text-center">:</th>
        <td><?php echo $tgl_dari; ?></td>
      </tr>
      <tr>
        <th>SAMPAI TANGGAL</th>
        <th class="text-center">:</th>
        <td><?php echo $tgl_sampai; ?></td>
      </tr>
      <tr>
        <th>JENIS</th>
        <th class="text-center">:</th>
        <td><?php echo $jenis; ?></td>
      </tr>
    </table>
    <br/>

    <?php 
    if($jenis == "barang_masuk"){
      ?>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="1%">NO</th>
              <th>KODE</th>
              <th>NAMA BARANG</th>
              <th>REGISTER</th>
              <th>TANGGAL MASUK</th>
              <th>JUMLAH</th>
              <th>BERAT</th>
              <th>LOKASI ASAL</th>
              <th>LOKASI TUJUAN</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            include '../koneksi.php';
            $no=1;
            $data = mysqli_query($koneksi,"SELECT bm.*, g1.lokasi_asal as nama_gudang, g2.lokasi_tujuan as nama_gudang2 FROM barang_masuk bm LEFT JOIN gudang g1 ON bm.bm_id_gudang = g1.gudang_id LEFT JOIN gudang_2 g2 ON bm.bm_id_gudang2 = g2.gudang2_id WHERE date(bm_tgl_masuk) >= '$tgl_dari' AND date(bm_tgl_masuk) <= '$tgl_sampai'");
            while($d = mysqli_fetch_array($data)){
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['bm_id_barang']; ?></td>
                <td><?php echo $d['bm_nama_barang']; ?></td>
                <td><?php echo $d['bm_register']; ?></td>
                <td><?php echo $d['bm_tgl_masuk']; ?></td>
                <td><?php echo $d['bm_jumlah']; ?></td>
                <td><?php echo $d['bm_berat']; ?></td>
                <td><?php echo $d['nama_gudang'] ?? '-'; ?></td>
                <td><?php echo $d['nama_gudang2'] ?? '-'; ?></td>
              </tr>
              <?php 
            }
            ?>
          </tbody>
          <tfoot>
            <tr class="bg-info">
              <th colspan="5" class="text-right">TOTAL JUMLAH:</th>
              <th>
                <?php 
                include '../koneksi.php';
                $total = mysqli_query($koneksi, "SELECT SUM(bm_jumlah) as total FROM barang_masuk WHERE date(bm_tgl_masuk) >= '$tgl_dari' AND date(bm_tgl_masuk) <= '$tgl_sampai'");
                $t = mysqli_fetch_assoc($total);
                echo number_format($t['total'], 0, ',', '.');
                ?>
              </th>
              <th colspan="3"></th>
            </tr>
          </tfoot>
        </table>
      </div>

      <?php 
    }elseif($jenis == "barang_keluar"){
     ?>
     <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th width="1%">NO</th>
            <th>KODE</th>
            <th>NAMA BARANG</th>
            <th>REGISTER</th>
            <th>TANGGAL KELUAR</th>
            <th>JUMLAH</th>
            <th>BERAT</th>
            <th>LOKASI ASAL</th>
            <th>LOKASI TUJUAN</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          include '../koneksi.php';
          $no=1;
          $data = mysqli_query($koneksi,"SELECT bk.*, g1.lokasi_asal as nama_gudang, g2.lokasi_tujuan as nama_gudang2 FROM barang_keluar bk LEFT JOIN gudang g1 ON bk.bk_id_gudang = g1.gudang_id LEFT JOIN gudang_2 g2 ON bk.bk_id_gudang2 = g2.gudang2_id WHERE date(bk_tgl_keluar) >= '$tgl_dari' AND date(bk_tgl_keluar) <= '$tgl_sampai'");
          while($d = mysqli_fetch_array($data)){
            ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $d['bk_id_barang']; ?></td>
              <td><?php echo $d['bk_nama_barang']; ?></td>
              <td><?php echo $d['bk_register']; ?></td>
              <td><?php echo $d['bk_tgl_keluar']; ?></td>
              <td><?php echo $d['bk_jumlah_keluar']; ?></td>
              <td><?php echo $d['bk_berat']; ?></td>
              <td><?php echo $d['nama_gudang'] ?? '-'; ?></td>
              <td><?php echo $d['nama_gudang2'] ?? '-'; ?></td>
            </tr>
            <?php 
          }
          ?>
        </tbody>
        <tfoot>
          <tr class="bg-info">
            <th colspan="5" class="text-right">TOTAL JUMLAH:</th>
            <th>
              <?php 
              include '../koneksi.php';
              $total = mysqli_query($koneksi, "SELECT SUM(bk_jumlah_keluar) as total FROM barang_keluar WHERE date(bk_tgl_keluar) >= '$tgl_dari' AND date(bk_tgl_keluar) <= '$tgl_sampai'");
              $t = mysqli_fetch_assoc($total);
              echo number_format($t['total'], 0, ',', '.');
              ?>
            </th>
            <th colspan="3"></th>
          </tr>
        </tfoot>
      </table>
    </div>

    <?php 
  } 
  ?>

  <?php 
}else{
  ?>

  <div class="alert alert-info text-center">
    Silahkan Filter Laporan Terdulu.
  </div>

  <?php
}
?>

<script>

  window.print();
  $(document).ready(function(){

  });
</script>

</body>
</html>

