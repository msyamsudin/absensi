<?php
 include "koneksi.php";

$user_name=$_POST['user_name'];
$tanggal_awal=$_POST['tanggal_awal'];
$tanggal_akhir=$_POST['tanggal_akhir'];


    $query=mysqli_query($link,"SELECT * from demo_log_keluar where user_name like '%$user_name%' and data between '$tanggal_awal' and '$tanggal_akhir'");
	$query2=mysqli_query($link,"SELECT * from demo_user where user_name like '%$user_name%'");

 //$found=mysql_num_rows($result);

?>

<table class="datatable text-center">
	<tr>
    	<th width="50">No</th>
    	<th width="300">Tanggal</th>
    	<th width="300">User Name</th>
      <th width="300">Nama</th>
    	<th width="600">Keterangan</th>
    </tr>

    <?php
      while ($baris=mysqli_fetch_array($query2)) {
        ?>

	<?php
	//untuk penomoran data
	$no=0;

	//menampilkan data
	while($row=mysqli_fetch_assoc($query)){
	?>

    <tr>
    	<td><?php echo $no=$no+1; ?></td>
      <td><?php echo $row['data']; ?></td>
      <td><?php echo $row['user_name'];?></td>
      <td><?php echo $baris['nama_lengkap'];?></td>
    	<td><?php echo $row['keterangan'];?></td>
    </tr>
    <?php
	}
}
	?>

    <tr>
    	<td colspan="5" align="center">
		<?php
		//jika data tidak ditemukan
		if(mysqli_num_rows($query)==0){
			echo "<font color=red><blink>Data tidak ditemukan.</blink></font>";
		}
		?>
        </td>
    </tr>

</table>
