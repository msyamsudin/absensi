<?php
  include 'include/head.php';
  include 'include/global.php';
  include 'include/function.php';
  include 'include/navbar.php';

    $id  = $_GET['id'];
    $user_name = $_GET['user'];

  if(count($_POST)>0) {

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
                      echo "<script type='text/javascript'> onload=NOTIFmerah; </script>";
                      echo "<div id='salah'>Password yang kamu masukkan salah.</div>";
                      //echo "Ahahahah";
                    } elseif ($hash_pw == true) {
                      $log = buatLogPulang($user_name);
                       if ($log == 1) {
                        echo "<script type='text/javascript'> onload=NOTIFbiru; </script>";
                        echo "<div id='benar'>Terima kasih, Hati-hati dijalan ya..</div>";
                      header( "refresh:3; url=$base_path" ); // mengalihkan halaman setelah 3 detik.
                      }
                    }
              }
          }

  	
  }

        /* (QR) Akhir form pengirim */ /* Muncul jika telah melebihi 4:30 sore */
echo		"<div class='container' hidden>"
          ."<form id='qr_form_send' method='POST' action='qr_form_bridge.php'>"
            ."<input type='hidden' name='user_id' value='$user_id'>"
            ."<input type='hidden' name='user_name' value='$user_name'>"
            ."<input type='hidden' name='dari_pulang' value='pulang'>"
          ."</form>"
         ."</div>"
          /* (QR) Akhir form pengirim */
        ."<div class='container'>"
          ."<div class='col-md-4' id='pulang'>"
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
                  ."<td align='center' colspan='2'><h4>Selamat Datang <strong>$user_name</strong></h4></td>"
                ."</tr>"
          			."<tr class='tablerow'>"
          			."<td>"
          			."<input type='hidden' name='user_name' value='$user_name' class='login-input'></td>"
          			."</tr>"
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

 <!-- Berfungsi untuk mengecek waktu -->
 <script type="text/javascript">
  // kenapa tidak memakai onload? Gak bisaa !! Karena ada onload lain yang harus di eksekusi diatas.
   onpageshow = cek_waktu_pulang;
 </script>

<form action="simpanketeranganpulang.php" method="post">
  <div class="row">
    <div class="container">
      <div class="col-md-5" id="sabar">
        <h4>Belum waktunya pulang, silahkan isi form dibawah untuk melanjutkan.</h4>
        <div class="form-group">
          <br>
          <input type="hidden" name="user_id" value="<?php echo $id?>">
          <input type="hidden" name="user_name" value="<?php echo $user_name?>">
          <label for="alasan">Keterangan:</label>
          <input type="text" name="keterangan" class="form-control" placeholder="Isikan keterangan kamu kenapa pulang lebih awal." required>
        </div>
        <a href="<?php echo $base_path?>" class="btn btn-default">Back</a>
        <button type="submit" class="btn btn-danger">Lanjut Pulang</button>
      </div>
    </div>
  </div>
</form>
