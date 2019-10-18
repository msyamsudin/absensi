<?php

  include 'koneksi.php';

    $id = $_POST['data'];
    $user = $_POST['user_name'];
    $keterangan = $_POST['keterangan'];

    // print_r($id);
    // print_r($user);
    // print_r($keterangan);

    mysqli_query($link,"update demo_log set user_name='$user', keterangan='$keterangan' where data='$id'");

    header("location:http://localhost/absensi/index.php?action=log");
    
 ?>
