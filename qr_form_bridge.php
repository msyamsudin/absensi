<?php
  $serv = null;

  $serv1 = 'cek_qr.php';
  $serv2 = 'cekoke_qr.php';

  $serv3 = 'cekpulang_qr.php';
  $serv4 = 'cekokepulang_qr.php';

      if (!isset($_POST['keterangan']))
      {
        $keterangan = '';
        $serv = $serv1;
      }
      elseif (isset($_POST['keterangan'])) {
        $keterangan = $_POST['keterangan'];
        $serv = $serv2;
      }

      if (!isset($_POST['keterangan']) && isset($_POST['dari_pulang'])) {
        $keterangan = '';
        $serv = $serv3;
      }
      elseif (isset($_POST['keterangan']) && isset($_POST['dari_pulang'])) {
        $keterangan = $_POST['keterangan'];
        $serv = $serv4;
      }
  
  $id = $_POST['user_id'];
  $user = $_POST['user_name'];
  

 // mengirim nilai ke cekoke.php
  echo	"<form id='frm_kirimData' method='post' action='$serv'>
          <input type='hidden' name='id' value='$id'>
          <input type='hidden' name='user_name' value='$user'>
          <input type='hidden' name='keterangan' value='$keterangan'>
        </form>";
 ?>

 <script>
  document.getElementById("frm_kirimData").submit();
 </script>
