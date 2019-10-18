<?php
  session_start();
  if (isset($_POST['submit'])) {
    include 'include/global.php';

    $user = $_POST['username'];
    $passw = $_POST['password'];

    if (empty($user) || empty($passw)) {
    //  echo "kosong";
      header ("Location: login.php");
    } else {
        $sql = "SELECT * FROM admin WHERE user = '$user'";
        $result = mysqli_query($link, $sql);
        $resultCheck = mysqli_num_rows($result);
          if ($resultCheck < 1) {
            //echo "user tidak ditemukan";
            $_SESSION['pesan'] = '!user';
            header('location:login.php');
          } else {
              if ($row = mysqli_fetch_assoc($result)) {
                //Proses Dehashes Password
                  $hash_passwCheck = password_verify($passw, $row['passw']);
                    if ($hash_passwCheck == false) {
                       $_SESSION['pesan'] = 'salah';
                       header('location:login.php');
                      //echo "Ahahahah";
                    } elseif ($hash_passwCheck == true) {
                        $_SESSION['user'] = $row['user'];
                        header('location:index.php');
                    }
              }
          }

    }
  } else {
     header ("Location: login.php");
    //echo "Alo";
  }


    //$hash_passw = password_hash($passw, PASSWORD_DEFAULT);

     // print_r($user);
     // echo "<br>";
     // var_dump($passw);
     // echo "<br>";
     // var_dump($hash_passw);




 ?>
