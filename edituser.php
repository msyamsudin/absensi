<?php
    include 'include/head.php';
    include 'include/function.php';
    include 'include/global.php';
    include 'include/navbar.php';

  $id = $_GET['id'];
  $sql = mysqli_query($link,"SELECT * FROM demo_user WHERE user_id='$id'");

  while($d = mysqli_fetch_array($sql)){
 ?>
    
      
  <div class="container">
    <div class="container"><h1><u>Edit Data User</u></h1></div>
    <form method="post" action="perbaruidata.php">
      <div class="form-group row">
        <label class="hidden">ID</label>
        <div class="col-sm-3">
          <input type="hidden" class="form-control" name="user_id" value="<?php echo $d['user_id']; ?>" placeholder="Ubah Nama">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 form-control-label">Nama</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="nama" value="<?php echo $d['nama_lengkap']; ?>" placeholder="Ubah Nama">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 form-control-label">Asal Sekolah / Kampus</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="asal" value="<?php echo $d['asal_kampus']; ?>"  placeholder="Ubah Asal Sekolah / Kampus">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 form-control-label">Fakultas / Jurusan</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="fakultas" value="<?php echo $d['fakultas']; ?>"  placeholder="Ubah Fakultas / Jurusan">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 form-control-label">Mulai magang</label>
        <div class="col-sm-3">
          <input type="text" class="form-control input-tanggal" name="tgl_masuk" value="<?php echo $d['tgl_masuk']; ?>"  placeholder="Ubah tanggal mulai magang">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 form-control-label">Status</label>
          <div class="col-sm-3">
          Status user saat ini <strong>
                                  <?php 
                                     $status = $d['status'];

                                     if ($status == 'Tidak Aktif')
                                     {
                                      echo "<span style='color: #f44242;'>$status</span>";
                                     }
                                     elseif ($status == 'Aktif')
                                     {
                                      echo "<span style='color: #25ba3e;'>$status</span>";
                                     }
                                  ?>
                                  </strong>
            <select class="form-control" name="status">
            <option value="default">-- Ubah Status User --</option>
              <option value="1">Aktif</option>
              <option value="0">Tidak Aktif</option>
            </select>
          </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 form-control-label">Password</label>
        <div class="col-sm-3">
          <input type="password" class="form-control" name="password" value=""  placeholder="Ubah Password User">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-offset-2 col-sm-10">
          <a href="<?php echo $base_path?>" class="btn btn-default">Back</a>
          <a href="https://syam.web.id/portofolio/absensi" class="btn btn-default">Back Manual</a>
          <button type="submit" class="btn btn-primary">Update Data</button>
        </div>
      </div>
    </form>

    <script type="text/javascript">

    $('.input-tanggal').datepicker({
      dateFormat: 'yy-mm-dd' });

    </script>

  </div>

<?php } ?>
