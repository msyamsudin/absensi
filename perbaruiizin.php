<?php

  include 'koneksi.php';

    $id = $_POST['no_perizinan'];
    $user = $_POST['user_name'];
    $keperluan = $_POST['keperluan'];

    // print_r($id);
    // print_r($user);
    // print_r($keperluan);

    mysqli_query($link,"update perizinan set user_name='$user', keperluan='$keperluan' where no_perizinan='$id'");

    header("location:http://localhost/absensi/index.php?action=perizinan");


 ?>
