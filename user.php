<?php
      include 'include/global.php';
    	include 'include/function.php';
?>

<?php
	if (isset($_GET['action']) && $_GET['action'] == 'index') {
?>

		<script type="text/javascript">

			$('title').html('User');

			function user_delete(user_id, user_name) {

				var r = confirm("Delete user "+user_name+" ?");

				if (r == true) {

					push('user.php?action=delete&user_id='+user_id);

				}
			}

		</script>

    <!-- Menampilkan tooltip -->
      <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
            });
      </script>

		<div class="row">
				<div class="col-md-12 btn-group">
					<button type="button" data-toggle="tooltip" data-placement="bottom" title="Menambahkan user baru" class="btn btn-success" onclick="load('<?php echo $base_path?>user.php?action=create')">Add</button>
					<div class="btn-group">
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Filter <span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#" onclick="load('<?php echo $base_path?>useraktif.php?action=index')" data-toggle="tooltip" data-placement="right" title="Hanya menampilkan user Aktif">Aktif</a></li>
						<li><a href="#" onclick="load('<?php echo $base_path?>usernonaktif.php?action=index')" data-toggle="tooltip" data-placement="right" title="Hanya menampilkan user NonAktif">Nonaktif</a></li>
						<li><a href="#" onclick="load('<?php echo $base_path?>user.php?action=index')" data-toggle="tooltip" data-placement="right" title="Menampilkan semua user">Semua</a></li>
					</ul>
						</div>
					</div>
				</div>
		<br>

    <!-- Membuat fungsi Datatable pada tabel -->
    <script type="text/javascript">
      $(document).ready(function(){
        $('.tabele').DataTable();
      });
    </script>

<?php

  $user = getUser();

		if (count($user) > 0) {

			echo "<div class='row'>"
					."<div class='col-md-12'>"
						."<table class='table table-bordered table-hover text-center tabele'>"
								."<thead>"
									."<tr>"
										."<th class='col-md-1 text-center'>ID</th>"
										."<th class='col-md-1 text-center'>Username</th>"
                    ."<th class='col-md-3 text-center'>Nama Lengkap</th>"
                    ."<th class='col-md-2 text-center'>Asal Kampus</th>"
                    ."<th class='col-md-2 text-center'>Fakultas</th>"
                    ."<th class='col-md-2 text-center'>Tanggal Gabung</th>"
                    ."<th class='col-md-2 text-center'>Status</th>"
										."<th class='col-md-4 text-center'>Action</th>"
									."</tr>"
								."</thead>"
								."<tbody>";

			foreach ($user as $row) {

				$bgcolor = null;
				$status_btn = null;

        $id = $row['user_id'];
        $nama = $row['user_name'];
        $nm_lengkap = $row['nama_lengkap'];
        $asal = $row['asal_kampus'];
        $fakultas = $row['fakultas'];
				$tgl_masuk = $row['tgl_masuk'];
        $status = $row['status'];

			  $cekwaktu = $base_path."cek.php?id=".$id."&user=".$nama;
				$cekpulang = $base_path."cekpulang.php?id=".$id."&user=".$nama;
				
				 // Mengubah warna latar belakang
				 if ($status == 'Aktif') {
          $bgcolor = 'bgcolor = #cdffb2';
        } elseif ($status = 'Tidak Aktif') {
					$bgcolor = 'bgcolor = #ffb2b2';
					$status_btn = 'disabled';
        }

        $verification		= "<li role='presentation'><a href='$cekwaktu' role='menuitem' tabindex='-1' >Masuk</a></li>"
                          ."<li role='presentation'><a href='$cekpulang' role='menuitem' tabindex='-1' >Pulang</a></li>";

        $action = "<li role='presentation'><a href='edituser.php?id=".$row['user_id']."' role='menuitem' tabindex='-1' >Edit Data</a></li>"
                  ."<li role='presentation' class='divider'></li>"
                  ."<li role='presentation'><a role='menuitem' tabindex='-1' onclick=\"user_delete('".$row['user_id']."','".$row['user_name']."')\">Delete</a></li>";

				echo					"<tr>"
				 					."<td>".$id."</td>"
				 					."<td>".$nama."</td>"
                  ."<td>".$nm_lengkap."</td>"
                  ."<td>".$asal."</td>"
                  ."<td>".$fakultas."</td>"
                  ."<td>".$tgl_masuk."</td>"
                  ."<td $bgcolor>".$status."</td>"
				 					."<td>"
                    ."<div class='dropdown'>"
      ."<button class='".$status_btn." btn btn-default dropdown-toggle glyphicon glyphicon-eye-open btn-info' type='button' id='menu1' data-toggle='dropdown'> Aksi "
      ."<span class='caret'></span></button>"
			."<ul class='dropdown-menu' role='menu' aria-labelledby='menu1'>"
        ."$verification";

      if(!isset($_SESSION)) // kalau langsung session_start(); gak bisa.
        {
          session_start();
        }

        if (empty($_SESSION['user'])) {
          // tombol edit dan hapus user bersembunyi.
        } else {
        echo "$action";
        }

    echo  "</ul>"
    ."</div>"
									."</td>"
				 					."</tr>";
			}

      ?>

      <?php

			echo
								"</tbody>"
						."</table>"
					."</div>"
				."</div>";

		} else {

			echo 'User Empty';

		}

	} elseif (isset($_GET['action']) && $_GET['action'] == 'create') {
?>

		<script type="text/javascript">

			$('title').html('Add user');

			function user_store() {

				user_name	= $('#user_name').val();
        password = $('#password').val();
        nama_lengkap	= $('#nama_lengkap').val();
        asal_kampus	= $('#asal_kampus').val();
        fakultas	= $('#fakultas').val();
        tgl_masuk	= $('#tgl_masuk').val();

				push('user.php?action=store&user_name='+user_name+
        '&password='+password+
        '&nama_lengkap='+nama_lengkap+
        '&asal_kampus='+asal_kampus+
        '&fakultas='+fakultas+'&tgl_masuk='+tgl_masuk);

			}

		</script>

	
  <h1 class="text-center">Add User</h1>  
			
		<div class="row">
			<div class="col-md-4">
				</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="user_name">Username</label>
					<input type="text" id="user_name" class="form-control" placeholder="Masukkan Username" required>
          <label>Password</label>
          <input type="password" id="password" class="form-control" placeholder="Masukkan Password" required>
          <label>Nama Lengkap</label>
          <input type="text" id="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap" required>
          <label>Asal Sekolah / Kampus</label>
          <input type="text" id="asal_kampus" class="form-control" placeholder="Masukkan Asal Sekolah / Kampus" required>
          <label >Jurusan / Fakultas</label>
          <input type="text" id="fakultas" class="form-control" placeholder="Masukkan Jurusan / Fakultas" required>
          <label>Tanggal Gabung</label>
          <input type="text" id="tgl_masuk" class="form-control input-tanggal" placeholder="Tanggal gabung" required>
				</div>
				<a class="btn btn-default" onclick="load('<?php echo $base_path?>user.php?action=index')">Back</a>
				<button type="submit" class="btn btn-success" onclick="user_store()">Save</button>
			</div>
			<div class="col-md-4">

			</div>
		</div>

    <script type="text/javascript">

    $('.input-tanggal').datepicker({
      dateFormat: 'yy-mm-dd' });

    </script>

<?php
	} elseif (isset($_GET['action']) && $_GET['action'] == 'store') {

		$res 		= array();
        		$res['result'] 	= false;

    // mulai pengecekan (tidak boleh kosong)
		if ($_GET['user_name'] == '' || !isset($_GET['user_name']) || empty($_GET['user_name'])) {

			$res['user_name'] = "<p><span style='background-color: #f2dede; color: #b94442;'><strong>Username</strong> tidak boleh kosong</span></p>";

		} elseif (isset($_GET['user_name']) && !empty($_GET['user_name'])) {

			$user_name = checkUserName($_GET['user_name']);

			if ($user_name != 1) {

				$res['user_name'] = $user_name;

			}

		}

    if ($_GET['password'] == '' || !isset($_GET['password']) || empty($_GET['password'])) {

			$res['password'] = "<p><span style='background-color: #f2dede; color: #b94442;'><strong>Password</strong> tidak boleh kosong</span></p>";

		}

    if ($_GET['nama_lengkap'] == '' || !isset($_GET['nama_lengkap']) || empty($_GET['nama_lengkap'])) {

			$res['nama_lengkap'] = "<p><span style='background-color: #f2dede; color: #b94442;'><strong>Nama</strong> tidak boleh kosong</span></p>";

		}

    if ($_GET['asal_kampus'] == '' || !isset($_GET['asal_kampus']) || empty($_GET['asal_kampus'])) {

			$res['asal_kampus'] = "<p><span style='background-color: #f2dede; color: #b94442;'><strong>Asal Sekolah / Kampus</strong> tidak boleh kosong</span></p>";

		}

    if ($_GET['fakultas'] == '' || !isset($_GET['fakultas']) || empty($_GET['fakultas'])) {

			$res['fakultas'] = "<p><span style='background-color: #f2dede; color: #b94442;'><strong>Fakultas</strong> tidak boleh kosong</span></p>";

		}

    if ($_GET['tgl_masuk'] == '' || !isset($_GET['tgl_masuk']) || empty($_GET['tgl_masuk'])) {

			$res['tgl_masuk'] = "<p><span style='background-color: #f2dede; color: #b94442;'>Harap pilih <strong>Tanggal masuk</strong></span></p>";

		}

    // akhir pengecekan (tidak boleh kosong)

		if (count($res) > 1) {

			echo json_encode($res);

		} else {
      $user_name = $_GET['user_name'];
			$password = $_GET['password'];
			
			$passw = password_hash($password, PASSWORD_DEFAULT);

      $nama_lengkap = $_GET['nama_lengkap'];
      $asal_kampus = $_GET['asal_kampus'];
      $fakultas = $_GET['fakultas'];
      $tgl_masuk = $_GET['tgl_masuk'];
      $status = 'Aktif';

      $sql = "INSERT INTO demo_user (user_name, password, nama_lengkap, asal_kampus, fakultas, tgl_masuk, status) VALUES ('$user_name', '$passw', '$nama_lengkap', '$asal_kampus', '$fakultas', '$tgl_masuk', '$status')";
			$result = mysqli_query($link,$sql);

			if ($result) {

				$res['result']	= true;
				$res['reload'] 	= "user.php?action=index";

			} else {

				$res['server'] = "Error insert data!";

			}

			echo json_encode($res);

		}

	} elseif (isset($_GET['action']) && $_GET['action'] == 'delete') {

		$sql1		= "DELETE FROM demo_user WHERE user_id = '".$_GET['user_id']."' ";
		$result1	= mysqli_query($link,$sql1);

		if ($result1) {

			$res['result'] 	= true;
			$res['reload'] 	= "user.php?action=index";

		} else {

			$res['server'] 	= "Error delete data!#".$sql1;

		}

		echo json_encode($res);

	}
?>
