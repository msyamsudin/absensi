<?php
    include 'include/head.php';
    include 'include/navbar.php';
    include 'include/function.php';
    include 'include/global.php';

  $id = $_GET['id'];
  $sql = mysqli_query($link,"SELECT * FROM demo_log WHERE data='$id'");

  while($d = mysqli_fetch_array($sql)){
 ?>

  <div class="container">
    <form method="post" action="perbaruilog.php">
    <div class="form-group row">
        <label class="col-sm-2 form-control-label">Time</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="data" value="<?php echo $d['data']; ?>" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 form-control-label">Username</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="user_name" value="<?php echo $d['user_name']; ?>" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 form-control-label">Keterangan</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="keterangan" value="<?php echo $d['keterangan']; ?>"  placeholder="Ubah Keterangan">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-offset-2 col-sm-10">
          <a href="<?php echo $base_path?>index.php?action=log" class="btn btn-default">Back</a>
          <button type="submit" class="btn btn-primary">Update Log</button>
        </div>
      </div>
    </form>

  </div>

<?php } ?>
