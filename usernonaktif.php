<?php
    	include 'include/global.php';
    	include 'include/function.php';

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

<?php

  $user = getUserNonAktif();

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

        $verification		= "<li role='presentation'><a href='$cekwaktu' role='menuitem' tabindex='-1' >Masuk</a></li>"
                          ."<li role='presentation'><a href='$cekpulang' role='menuitem' tabindex='-1' >Pulang</a></li>";

        $action = "<li role='presentation'><a href='edituser.php?id=".$row['user_id']."' role='menuitem' tabindex='-1' >Edit Data</a></li>"
                  ."<li role='presentation' class='divider'></li>"
                  ."<li role='presentation'><a role='menuitem' tabindex='-1' onclick=\"user_delete('".$row['user_id']."','".$row['user_name']."')\">Delete</a></li>";


        // Mengubah warna latar belakang
        if ($status == 'Aktif') {
          $bgcolor = 'bgcolor = #cdffb2';
        } elseif ($status = 'Tidak Aktif') {
					$bgcolor = 'bgcolor = #ffb2b2';
					$status_btn = 'disabled';
        }

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

echo "</ul>"
  ."</div>"
				 					."</tr>";
			}

      ?>

          <script type="text/javascript">
          	$(document).ready(function(){
          		$('.tabele').DataTable();
          	});
          </script>

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
        nama_lengkap	= $('#nama_lengkap').val();
        asal_kampus	= $('#asal_kampus').val();
        fakultas	= $('#fakultas').val();
        tgl_masuk	= $('#tgl_masuk').val();

				push('user.php?action=store&user_name='+user_name+
        '&nama_lengkap='+nama_lengkap+'&asal_kampus='+asal_kampus+
        '&fakultas='+fakultas+'&tgl_masuk='+tgl_masuk);

			}

		</script>

		<div class="row">
			<div class="col-md-4">

			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="user_name">Username</label>
					<input type="text"  id="user_name" class="form-control" placeholder="Masukkan Username" required>
          <label for="user_name">Nama Lengkap</label>
          <input type="text"  id="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap" required>
          <label for="user_name">Asal Sekolah / Kampus</label>
          <input type="text"  id="asal_kampus" class="form-control" placeholder="Masukkan Asal Sekolah / Kampus" required>
          <label for="user_name">Jurusan / Fakultas</label>
          <input type="text"  id="fakultas" class="form-control" placeholder="Masukkan Jurusan / Fakultas" required>
          <label for="user_name">Tanggal Gabung</label>
          <input type="text"  id="tgl_masuk" class="form-control input-tanggal" placeholder="Tanggal gabung" required>
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

		if ($_GET['user_name'] == '' || !isset($_GET['user_name']) || empty($_GET['user_name'])) {

			$res['user_name'] = "username can't empty";

		} elseif (isset($_GET['user_name']) && !empty($_GET['user_name'])) {

			$user_name = checkUserName($_GET['user_name']);

			if ($user_name != 1) {

				$res['user_name'] = $user_name;

			}

		}

		if (count($res) > 1) {

			echo json_encode($res);

		} else {
      $user_name = $_GET['user_name'];
      $nama_lengkap = $_GET['nama_lengkap'];
      $asal_kampus = $_GET['asal_kampus'];
      $fakultas = $_GET['fakultas'];
      $tgl_masuk = $_GET['tgl_masuk'];
      $status = 'Aktif';

      $sql = "INSERT INTO demo_user (user_name, nama_lengkap, asal_kampus, fakultas, tgl_masuk, status) VALUES ('$user_name', '$nama_lengkap', '$asal_kampus', '$fakultas', '$tgl_masuk', '$status')";
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

		$sql2 		= "DELETE FROM demo_finger WHERE user_id = '".$_GET['user_id']."' ";
		$result2 	= mysqli_query($link,$sql2);

		if ($result1 && $result2) {

			$res['result'] 	= true;
			$res['reload'] 	= "user.php?action=index";

		} else {

			$res['server'] 	= "Error delete data!#".$sql1;

		}

		echo json_encode($res);

	} elseif (isset ($_GET['action']) && $_GET['action'] == 'checkreg') {

		$sql1		= "SELECT count(finger_id) as ct FROM demo_finger WHERE user_id=".$_GET['user_id'];
		$result1	= mysqli_query($link,$sql1);
		$data1 		= mysqli_fetch_array($result1);

		if (intval($data1['ct']) > intval($_GET['current'])) {
			$res['result'] = true;
			$res['current'] = intval($data1['ct']);
		}
		else
		{
			$res['result'] = false;
		}
		echo json_encode($res);

	} else {

		echo "Parameter invalid..";

	}
?>
