<?php include 'header.php'; ?>

<?php 
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi,"SELECT * FROM user WHERE user_id='$id'");
while($d = mysqli_fetch_array($data)){
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Pengguna
      <small>Edit Pengguna</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pengguna</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6 col-lg-offset-3">       
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Edit Pengguna</h3>
            <a href="user.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">
            <form action="user_update.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Nama</label>
                <input type="hidden" name="id" value="<?php echo $d['user_id'] ?>">
                <input type="text" class="form-control" name="nama" required="required" value="<?php echo $d['user_nama'] ?>">
              </div>
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" required="required" value="<?php echo $d['user_username'] ?>">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
              </div>
              <div class="form-group">
                <label>Level</label>
                <select class="form-control" name="level" required="required">
                  <option value=""> - Pilih Level - </option>
                  <option value="administrator" <?php if($d['user_level'] == "administrator"){echo "selected";} ?>> Administrator </option>
                  <option value="manajemen" <?php if($d['user_level'] == "manajemen"){echo "selected";} ?>> Manajemen </option>
                </select>
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto">
                <br>
                <?php if($d['user_foto'] == ""){ ?>
                  <img src="../gambar/sistem/user.png" style="width: 100px;">
                <?php }else{ ?>
                  <img src="../gambar/user/<?php echo $d['user_foto'] ?>" style="width: 100px;">
                <?php } ?>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-sm btn-primary" value="Update">
              </div>
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php } ?>
<?php include 'footer.php'; ?>
