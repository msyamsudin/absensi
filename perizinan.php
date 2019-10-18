<?php
      include 'include/global.php';
		include 'include/function.php';

		$base_path = "http://localhost/absensi";
		
		$tambah = "<div class='row'>"
					."<div class='col-md-12'>"
						."<button type='button' class='btn btn-success' onclick=\"load('$base_path/perizinan.php?action=create')\">Tambah Izin</button>"
					."</div>"
					."</div>";

	if (isset($_GET['action']) && $_GET['action'] == 'index') {
?>

	<script type="text/javascript">

			$('title').html('Perizinan');

			function perizinan_delete(no_perizinan) {

				var r = confirm("Delete perizinan "+no_perizinan+"?");

				if (r == true) {

					push('perizinan.php?action=delete&no_perizinan='+no_perizinan);

				}
			}

		</script>

    <!-- Membuat fungsi Datatable pada tabel -->
    <script type="text/javascript">
      $(document).ready(function() {
   		 $('.tabele').DataTable( {
   				dom: 'lBfrtip',
     	   	buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    		});
		});
    </script>

<?php

		$perizinan = getPerizinan();

		if (count($perizinan) > 0) {

			echo	"<div class='row'>"
					."<div class='col-md-12'>"
						."<table class='table table-bordered table-hover tabele text-center'>"
								."<thead>"
									."<tr>"
										."<th class='col-md-1'>ID Perizinan</th>"
										."<th class='col-md-3'>User Name</th>"
										."<th class='col-md-2'>Keperluan</th>"
										."<th class='col-md-2'>Log Time</th>";
										if(!isset($_SESSION)) // kalau langsung session_start(); gak bisa.
										{
										session_start();
										}
								
										if (empty($_SESSION['user'])) {
										// tombol bersembunyi.
										} else {
										echo	"<th class='col-md-1'>$tambah</th>";
										}
								
								echo "</tr>"
								."</thead>"
								."<tbody>";

			foreach ($perizinan as $row) {

		echo 	"<tr>"
					."<td>".$row['no_perizinan']."</td>"
					."<td>".$row['user_name']."</td>"
					."<td>".$row['keperluan']."</td>"
					."<td><code>".$row['log_time']."</code></td>";
					if(!isset($_SESSION)) // kalau langsung session_start(); gak bisa.
						{ session_start(); }		
							if (empty($_SESSION['user'])) {
							// tombol bersembunyi.
								} else {
									echo "<td>"
									."<div class = 'btn-group'>"
									."<a href='editizin.php?id=".$row['no_perizinan']."' class='btn btn-xs btn-warning'>Edit Izin</a>"
									."<button type='button' class='btn btn-xs btn-danger' onclick=\"perizinan_delete('".$row['no_perizinan']."')\">Delete</button>"
								."</td>";
								}					
    		       echo  "</div>"
				."</tr>";

			}

			echo
								"</tbody>"
						."</table>"
					."</div>"
				."</div>";

		} else {

			echo 'Perizinan Kosong';

		}

	} elseif (isset($_GET['action']) && $_GET['action'] == 'create') {
?>

		<script type="text/javascript">

			$('title').html('Tambah Data Izin');

			function perizinan_store() {

				user_name	= $('#user_name').val();
				keperluan 		= $('#keperluan').val();

				push('perizinan.php?action=store&user_name='+user_name+'&keperluan='+keperluan);

			}

		</script>


			<div class="row">
				<div class="col-md-4">

				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="user_name">User Name</label>
            <td colspan="2">
        		<select class="form-control" name="user_name" id='user_name'>
        						<option selected disabled="disabled"> -- Select Username -- </option>
        							<?php
        								$Tampil = "SELECT user_name FROM demo_user";
        								$result = mysqli_query($link,$Tampil);

        								while($row = mysqli_fetch_array($result)){

        									$value = $row['user_name'];

        									echo "<option value=$value>$row[user_name]</option>";
        								}
        							?>
        					</select>
        			</td>
					</div>
					<div class="form-group">
						<label for="keperluan">Keperluan</label>
						<input type="text" id="keperluan" class="form-control" placeholder="Masukan Keperluan Anda">
					</div>
					<a href="<?php echo $base_path?>/index.php?action=perizinan" class="btn btn-default">Back</a>
					<button type="button" class="btn btn-success" onclick="perizinan_store()">Save</button>
				</div>
				<div class="col-md-4">

				</div>
			</div>

<?php
	} elseif (isset($_GET['action']) && $_GET['action'] == 'store') {

				$res 			= array();
        		$res['result'] 	= false;

		if ($_GET['user_name'] == '' || !isset($_GET['user_name']) || empty($_GET['user_name'])) {

			$res['user_name'] = "username tidak boleh kosong";

		}

		if ($_GET['keperluan'] == '' || !isset($_GET['keperluan']) || empty($_GET['keperluan'])) {

			$res['keperluan'] = "keperluan tidak boleh kosong";

		}


		if (count($res) > 1) {

			echo json_encode($res);

		} else {
			$user_name = $_GET['user_name'];
			$keperluan = $_GET['keperluan'];

			$user_ok = filter_var($user_name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$perlu_ok = filter_var($keperluan, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

			$sql 	= "INSERT INTO perizinan SET user_name='".$user_ok."', keperluan='".$perlu_ok."'";

			$keterangan = "<code>(Tidak Masuk)</code> Alasan: ";
			$zonaWaktu = time() + (60 * 60 * 7); // GMT + 7 (Asia/Jakarta) // menyesuaikan waktu server
			
			$sql2 	= "INSERT INTO demo_log SET user_name='".$user_ok."', data='".gmdate('Y-m-d H:i:s', $zonaWaktu)." (Server Time)"."', keterangan='".$keterangan.$perlu_ok."' ";
			$sql3 	= "INSERT INTO demo_log_keluar SET user_name='".$user_ok."', data='".gmdate('Y-m-d H:i:s', $zonaWaktu)." (Server Time)"."', keterangan='".$keterangan.$perlu_ok."' ";

			$result = mysqli_query($link,$sql);
			$result2 = mysqli_query($link,$sql2);
			$result3 = mysqli_query($link,$sql3);

			if ($result && $result2) {

				$res['result'] 	= true;
				$res['reload'] 	= "perizinan.php?action=index";

			} else {

				$res['server'] = "Error insert data!";

			}

			echo json_encode($res);

		}

	} elseif (isset($_GET['action']) && $_GET['action'] == 'delete') {

		$sql1		= "DELETE FROM perizinan WHERE no_perizinan = '".$_GET['no_perizinan']."'";
		$result1	= mysqli_query($link,$sql1);

		if ($result1) {

			$res['result']	= true;
			$res['reload'] 	= "perizinan.php?action=index";

		} else {

			$res['server'] = "Error delete data!#".$sql1;

		}

		echo json_encode($res);

	} else {

		echo "Parameter invalid..";

	}
?>
