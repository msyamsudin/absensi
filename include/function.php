<?php

	function getUser() {
		include 'global.php';
		$sql 	= 'SELECT * FROM demo_user ORDER BY user_name ASC';
		$result	= mysqli_query($link,$sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysqli_fetch_array($result)) {

			$arr[$i] = array(
				'user_id'	=> $row['user_id'],
				'user_name'	=> $row['user_name'],
				'nama_lengkap'	=> $row['nama_lengkap'],
				'asal_kampus'	=> $row['asal_kampus'],
				'fakultas'	=> $row['fakultas'],
				'tgl_masuk'	=> $row['tgl_masuk'],
				'status'	=> $row['status']
			);

			$i++;

		}

		return $arr;

	}

	function getUserAktif() {
		include 'global.php';
		$sql 	= 'SELECT * FROM demo_user where status = "Aktif" ORDER BY user_name ASC';
		$result	= mysqli_query($link,$sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysqli_fetch_array($result)) {

			$arr[$i] = array(
				'user_id'	=> $row['user_id'],
				'user_name'	=> $row['user_name'],
				'nama_lengkap'	=> $row['nama_lengkap'],
				'asal_kampus'	=> $row['asal_kampus'],
				'fakultas'	=> $row['fakultas'],
				'tgl_masuk'	=> $row['tgl_masuk'],
				'status'	=> $row['status']
			);

			$i++;

		}

		return $arr;

	}

	function getUserNonAktif() {
		include 'global.php';
		$sql 	= 'SELECT * FROM demo_user where status = "Tidak Aktif" ORDER BY user_name ASC';
		$result	= mysqli_query($link,$sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysqli_fetch_array($result)) {

			$arr[$i] = array(
				'user_id'	=> $row['user_id'],
				'user_name'	=> $row['user_name'],
				'nama_lengkap'	=> $row['nama_lengkap'],
				'asal_kampus'	=> $row['asal_kampus'],
				'fakultas'	=> $row['fakultas'],
				'tgl_masuk'	=> $row['tgl_masuk'],
				'status'	=> $row['status']
			);

			$i++;

		}

		return $arr;

	}

	function deviceCheckSn($sn) {
		include 'global.php';
		$sql 	= "SELECT count(sn) as ct FROM demo_device WHERE sn = '".$sn."'";
		$result	= mysqli_query($link,$sql);
		$data 	= mysqli_fetch_array($result);

		if ($data['ct'] != '0' && $data['ct'] != '') {
			return "sn already exist!";
		} else {
			return 1;
		}

	}

	function checkUserName($user_name) {
		include 'global.php';
		$sql	= "SELECT user_name FROM demo_user WHERE user_name = '".$user_name."'";
		$result	= mysqli_query($link,$sql);
		$row	= mysqli_num_rows($result);

		if ($row>0) {
			return "Username exist!";
		} else {
			return "1";
		}

	}

	function getUserFinger($user_id) {
		include 'global.php';
		$sql 	= "SELECT * FROM demo_finger WHERE user_id= '".$user_id."' ";
		$result = mysqli_query($link,$sql);
		$arr 	= array();
		$i	= 0;

		while($row = mysqli_fetch_array($result)) {

			$arr[$i] = array(
				'user_id'	=>$row['user_id'],
				"finger_id"	=>$row['finger_id'],
				"finger_data"	=>$row['finger_data']
				);
			$i++;

		}

		return $arr;

	}

	function getLog() {
		include 'global.php';
		$sql 	= 'SELECT * FROM demo_log ORDER BY log_time DESC';
		$result	= mysqli_query($link,$sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysqli_fetch_array($result)) {

			$arr[$i] = array(
				'log_time'		=> $row['log_time'],
				'user_name'		=> $row['user_name'],
				'data'			=> $row['data'],
				'keterangan'	=> $row['keterangan']
			);

			$i++;

		}

		return $arr;

	}

	function getLogPulang() {
		include 'global.php';
		$sql 	= 'SELECT * FROM demo_log_keluar ORDER BY log_time DESC';
		$result	= mysqli_query($link,$sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysqli_fetch_array($result)) {

			$arr[$i] = array(
				'log_time'		=> $row['log_time'],
				'user_name'		=> $row['user_name'],
				'data'			=> $row['data'],
				'keterangan'	=> $row['keterangan']
			);

			$i++;

		}

		return $arr;

	}


	function buatLog($user){
		include 'global.php';

		$zonaWaktu = time() + (60 * 60 * 7); // GMT + 7 (Asia/Jakarta) // menyesuaikan waktu server
		$sql 		= "INSERT INTO demo_log SET user_name='".$user."', data='".gmdate('Y-m-d H:i:s', $zonaWaktu)." (Server Time)"."' ";

		$result1	= mysqli_query($link,$sql);
		if ($result1) {
			return 1;
		} else {
			return "Error insert log data!";
		}
	}


	function buatLog2($user_name, $keterangan) {
		include 'global.php';

		$telat = "<code>(Telat)</code> Alasan: ";
		$zonaWaktu = time() + (60 * 60 * 7); // GMT + 7 (Asia/Jakarta) // menyesuaikan waktu server
		$sql 		= "INSERT INTO demo_log SET user_name='".$user_name."', data='".gmdate('Y-m-d H:i:s', $zonaWaktu)." (Server Time)"."', keterangan='".$telat.$keterangan."' ";

		$result1	= mysqli_query($link,$sql);
		if ($result1) {
			return 1;
		} else {
			return "Error insert log data!";
		}
	}

	function buatLogPulang($user_name) {
		include 'global.php';

		$zonaWaktu = time() + (60 * 60 * 7); // GMT + 7 (Asia/Jakarta) // menyesuaikan waktu server
		$sql 		= "INSERT INTO demo_log_keluar SET user_name='".$user_name."', data='".gmdate('Y-m-d H:i:s', $zonaWaktu)." (Server Time)"."' ";

		$result1	= mysqli_query($link,$sql);
		if ($result1) {
			return 1;
		} else {
			return "Error insert log data!";
		}
	}

	function buatLogPulang2($user_name, $keterangan) {
		include 'global.php';

		$awal = "<code>(Pulang lebih awal)</code> Alasan: ";
		$zonaWaktu = time() + (60 * 60 * 7); // GMT + 7 (Asia/Jakarta) // menyesuaikan waktu server
		$sql 		= "INSERT INTO demo_log_keluar SET user_name='".$user_name."', data='".gmdate('Y-m-d H:i:s', $zonaWaktu)." (Server Time)"."', keterangan='".$awal.$keterangan."' ";

		$result1	= mysqli_query($link,$sql);
		if ($result1) {
			return 1;
		} else {
			return "Error insert log data!";
		}
	}


function getPerizinan() {
		include 'global.php';
		$sql 	= 'SELECT * FROM perizinan ORDER BY user_name ASC';
		//exit("$sql");
		$result	= mysqli_query($link,$sql);
		//exit("$result");
		$arr 	= array();
		$i 	= 0;

		while ($row = mysqli_fetch_array($result)) {

			$arr[$i] = array(
				'no_perizinan'	=> $row['no_perizinan'],
				'user_name'	=> $row['user_name'],
				'keperluan'		=> $row['keperluan'],
				'log_time'		=> $row['log_time'],

			);

			$i++;

		}

		return $arr;


}
?>
