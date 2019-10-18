<?php

	//defined('ROOT') or die('');

	define('db_host','localhost');
	define('db_user','root');
	define('db_pass','');
	define('db_name','demo_flexcodesdk');

	$dbconnect = mysqli_connect(db_host,db_user,db_pass, db_name);

	if ($dbconnect->connect_error) {
    die('Database Not Connect. Error : ' . $dbconnect->connect_error);
}
?>
