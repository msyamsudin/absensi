<?php
	$base_path		= "https://iflow.id/portofolio/absensi/";
	$db_name		= "iflowid_absensi";
	$db_user		= "iflowid_uabsen";
	$db_pass		= "HAiydT5e}?8@";
	$db_host		= "localhost";

	$link = mysqli_connect("$db_host", $db_user, $db_pass, $db_name) or die ("Koneksi Error : ".mysqli_connect_errno()." - ".mysqli_connect_error());
?>
