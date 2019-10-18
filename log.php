<?php
  include 'include/global.php';
  include 'include/function.php'; ?>

<?php

	if (isset($_GET['action']) && $_GET['action'] == 'index') {
?>
		<script type="text/javascript">

			$('title').html('Log Masuk');
				function log_delete(data) {

				var r = confirm("Delete log "+data+"?");

				if (r == true) {

					push('log.php?action=delete&data='+data);

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
	
	<!-- Menampilkan tooltip -->
	<script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
            });
	  </script>
	  
<button type="button" data-toggle="tooltip" data-placement="bottom" title="Menampilkan data user berdasarkan tanggal" class="btn btn-info lokasi-btn-log" onclick="load('<?php echo $base_path?>filter.php?action=index')">Filter</button>
        
<?php

		$log = getLog();

		if (count($log) > 0) {

			echo	"<h1>Log Masuk</h1>"
					."<div class='row'>"
					."<div class='col-md-12'>"
						."<table class='table table-bordered table-hover tabele text-center'>"
								."<thead>"
									."<tr>"
										."<th class='col-md-2'>Data</th>"
										."<th class='col-md-2'>Username</th>"
										."<th class='col-md-2'>Keterangan</th>";
										if(!isset($_SESSION)) // kalau langsung session_start(); gak bisa.
										{
										session_start();
										}
								
										if (empty($_SESSION['user'])) {
										// tombol bersembunyi.
										} else {
										echo	"<th class='col-md-1'>Aksi</th>";
										}
								echo "</tr>"
								."</thead>"
								."<tbody>";

			foreach ($log as $row) {


				echo					"<tr>"
									."<td><code>".$row['data']."</code></td>"
				 					."<td>".$row['user_name']."</td>"
									."<td>".$row['keterangan']."</td>";
									if(!isset($_SESSION)) // kalau langsung session_start(); gak bisa.
									{ session_start(); }		
									if (empty($_SESSION['user'])) {
									// tombol bersembunyi.
										} else {
									echo "<td>"
									."<div class = 'btn-group'>"
									."<a href='editlog.php?id=".$row['data']."' class='btn btn-xs btn-warning'>Edit Keterangan</a>"
									."<button type='button' class='btn btn-xs btn-danger' onclick=\"log_delete('".$row['data']."')\">Delete</button>"
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

			echo 'Log Empty';

		}

	}
	elseif (isset($_GET['action']) && $_GET['action'] == 'delete') {

		$sql1		= "DELETE FROM demo_log WHERE data = '".$_GET['data']."'";
		$result1	= mysqli_query($link,$sql1);

		if ($result1) {

			$res['result']	= true;
			$res['reload'] 	= "log.php?action=index";

		} else {

			$res['server'] = "Error delete data!#".$sql1;

		}

		echo json_encode($res);

	} else {

		echo "Parameter invalid..";

	}
?>
