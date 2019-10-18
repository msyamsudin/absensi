<?php
  include 'include/head.php';
  include 'include/global.php';
  include 'include/function.php';
  include 'include/navbar.php';

  // menerima nilai dari simpanketeranganpulang.php
  $user_id  = $_POST['id'];
  $user_name = $_POST['user_name'];
  $keterangan = $_POST['keterangan'];

  if(count($_POST)>3) {

    $sql = "SELECT * FROM demo_user WHERE user_name = '$user_name'";
        $result = mysqli_query($link, $sql);
        $resultCheck = mysqli_num_rows($result);
          if ($resultCheck < 1) {
            echo "user tidak ditemukan";
          } else {
              if ($row = mysqli_fetch_assoc($result)) {
                //Proses Dehashes Password
                  $hash_pw = password_verify($_POST["password"], $row['password']);
                    if ($hash_pw == false) {
                      echo "<script type='text/javascript'> window.onload=NOTIFmerah; </script>";
                      echo "<div id='salah'>Password yang kamu masukkan salah.</div>";
                      //echo "Ahahahah";
                    } elseif ($hash_pw == true) {
                      $log = buatLogPulang2($user_name, $keterangan);
                       if ($log == 1) {
                        header( "refresh:3; url=$base_path" ); // mengalihkan halaman setelah 3 detik.
                        echo "<script type='text/javascript'> window.onload=NOTIFbiru; </script>";
                        echo "<div id='benar'>Terima kasih, Hati-hati dijalan ya..</div>";
                      }
                    }
              }
          }
  }
                   /* (QR) Awal form pengirim */
          echo		"<div class='container' hidden>"
                    ."<form id='qr_form_send' method='POST' action='qr_form_bridge.php'>"
                      ."<input type='hidden' name='user_id' value='$user_id'>"
                      ."<input type='hidden' name='user_name' value='$user_name'>"
                      ."<input type='hidden' name='keterangan' value='$keterangan'>"
                      ."<input type='hidden' name='dari_pulang' value='pulang'>"
                    ."</form>"
                  ."</div>"
                  /* (QR) Akhir form pengirim */
                  ."<div class='container'>"
                    ."<div class='col-md-4' id='tepat'>"
                    ."<div class='form-group'>"
                    ."<label for='alasan'>Sebelum pulang, verifikasikan diri kamu:</label>"
                    ."<br>"
                      ."<div class='btn-group'>"
                          ."<button onclick=\"back_beranda('$base_path')\" class='btn btn-danger glyphicon glyphicon-home'></button>"
                          ."<button onclick=\"qr_auth()\" class='btn btn-danger glyphicon glyphicon-qrcode'></button>"
                      ."</div>"
                    .'<form name="frmUser" method="post" action="">'
                    		."<table border='0' cellpadding='10' cellspacing='1' width='500' align='center' class='tblLogin'>"
                    			."<tr class='tableheader'>"
                    			   ."<td align='center' colspan='2'>Masukkan password kamu:</td>"
                    			."</tr>"
                          ."<tr class='tablerow'>"
                            ."<td align='center' colspan='2'><h4>Terima kasih <strong>$user_name</strong>, hati-hati dijalan ya..</h4></td>"
                          ."</tr>"
                    			."<tr class='tablerow'>"
                    			."<td>"
                    			  ."<input type='hidden' name='user_name' value='$user_name' class='login-input'></td>"
                          ."</tr>"
                          ."<td>"
          			            ."<input type='hidden' name='keterangan' value='$keterangan'></td>"
                    			."<tr class='tablerow'>"
                    			."<td>"
                    			."<input type='password' name='password' placeholder='Password' class='login-input' autofocus></td>"
                    			."</tr>"
                          ."<tr class='tableheader'>"
                             ."<td align='center' colspan='2'>"
                              ."<button class='btn btn-danger' name='submit' type='submit'>Pulang</button>"
                             ."</td>"
                    			."</tr>"
                    		."</table>"
                    ."</form>"
                    ."</div>"
                    ."</div>"
                    ."</div>";
 ?>
