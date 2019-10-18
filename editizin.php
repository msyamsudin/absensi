<?php
    include 'include/head.php';
    include 'include/navbar.php';
    include 'include/function.php';
    include 'include/global.php';

  $id = $_GET['id'];
  $sql = mysqli_query($link,"SELECT * FROM perizinan WHERE no_perizinan='$id'");

  while($d = mysqli_fetch_array($sql)){
 ?>

  <div class="container">
    <form method="post" action="perbaruiizin.php">
      <div class="form-group row">
        <label class="hidden">ID</label>
        <div class="col-sm-3">
          <input type="hidden" class="form-control" name="no_perizinan" value="<?php echo $d['no_perizinan']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 form-control-label">Username</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="user_name" value="<?php echo $d['user_name']; ?>" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 form-control-label">Keperluan</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="keperluan" value="<?php echo $d['keperluan']; ?>"  placeholder="Ubah Keperluan">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-offset-2 col-sm-10">
          <a href="<?php echo $base_path?>index.php?action=perizinan" class="btn btn-default">Back</a>
          <button type="submit" class="btn btn-primary">Update Data</button>
        </div>
      </div>
    </form>

  </div>

<?php } ?>
