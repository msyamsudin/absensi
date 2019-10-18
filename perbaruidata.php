<?php

  include 'koneksi.php';

    $id = $_POST['user_id'];
    $nama = $_POST['nama'];
    $asal = $_POST['asal'];
    $fakultas = $_POST['fakultas'];
    $tgl = $_POST['tgl_masuk'];
    $status = $_POST['status'];
    $pw = $_POST['password'];

    if ($status == "default")
    {
      $old_status = mysqli_query($link,"SELECT status FROM demo_user WHERE user_id='$id'");
        while($d = mysqli_fetch_array($old_status)){
          $status = $d['status'];
        }
    } elseif ($status == 0)
    {
      $status = "Tidak Aktif";
    } elseif ($status == 1)
    {
      $status = "Aktif";
    }

    if ($pw == null) {
      $ext_passw = mysqli_query($link,"SELECT password FROM demo_user WHERE user_id='$id'");
        while($d = mysqli_fetch_array($ext_passw)){
          $pw_old = $d['password'];
        }
        mysqli_query($link,"update demo_user set password='$pw_old', nama_lengkap='$nama', asal_kampus='$asal', fakultas='$fakultas', tgl_masuk='$tgl', status='$status' where user_id='$id'");
        header("location:index.php");
    } elseif ($pw != null) {
      $pw = $_POST['password'];
      $pw_hash = password_hash($pw, PASSWORD_DEFAULT);
      mysqli_query($link,"update demo_user set password='$pw_hash', nama_lengkap='$nama', asal_kampus='$asal', fakultas='$fakultas', tgl_masuk='$tgl', status='$status' where user_id='$id'");
      header("location:index.php");
    }

    

    // print_r($id);
    // print_r($nama);
    // print_r($asal);
    // print_r($fakultas);
    // print_r($tgl);

    
    


 ?>
