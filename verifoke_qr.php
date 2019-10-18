<?php
include 'include/head.php';
include 'include/global.php';
include 'include/function.php';
include 'include/navbar.php';

    $auth = $_POST['auth_data'];
    $uid = $_POST['user_id'];
    $user = $_POST['user_name'];
    $ket = $_POST['keterangan'];

    // var_dump($auth); "<br>";
    // var_dump($uid); "<br>";
    // var_dump($user); "<br>";
    // var_dump($ket);

    if(count($_POST)>0) {

        $sql = "SELECT * FROM demo_user WHERE user_name = '$user'";
            $result = mysqli_query($link, $sql);
            $resultCheck = mysqli_num_rows($result);
              if ($resultCheck < 1) {
                echo "user tidak ditemukan";
              } else {
                  if ($row = mysqli_fetch_assoc($result)) {
                    //Proses Dehashes Password
                      $hash_pw = password_verify($auth, $row['password']);
                        if ($hash_pw == false) {
                            header( "refresh:3; url=$base_path" ); // mengalihkan halaman setelah 3 detik.
                            echo "<center><h1 style='margin-top: 470px'>Hai, $user. QR Code yang kamu gunakan tidak sesuai.</h1></center>";
                            echo "<script type='text/javascript'> window.onload=NOTIFmerah; </script>";
                            echo "<div id='salah'>Ulangi lagi ya.</div>";
                        } elseif ($hash_pw == true && $ket != '') {
                          $log = buatLog2($user, $ket);
                           if ($log == 1) {
                            header( "refresh:3; url=$base_path" ); // mengalihkan halaman setelah 3 detik.
                              echo "<center><h1 style='margin-top: 470px'>Hai, $user. Selamat datang.</h1></center>";
                              echo "<script type='text/javascript'> window.onload=NOTIFbiru; </script>";
                              echo "<div id='benar'>Terima kasih, kamu akan dialihkan beberapa saat lagi.</div>";
                          }
                        } else {
                          $log = buatLog($user);
                            if ($log == 1) {
                              header( "refresh:3; url=$base_path" ); // mengalihkan halaman setelah 3 detik.
                                echo "<center><h1 style='margin-top: 470px'>Hai, $user. Selamat datang.</h1></center>";
                                echo "<script type='text/javascript'> window.onload=NOTIFbiru; </script>";
                                echo "<div id='benar'>Terima kasih, kamu akan dialihkan beberapa saat lagi.</div>";
                            }
                        }
                  }
              }
      }
?>