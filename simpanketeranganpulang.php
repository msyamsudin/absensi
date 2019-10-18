<?php
  $id = $_POST['user_id'];
  $user = $_POST['user_name'];
  $keterangan = $_POST['keterangan'];

  // mengirim nilai ke cekokepulang.php
  echo		"<form id='frm_kirimData' method='post' action='cekokepulang.php'>
              <input type='hidden' name='id' value='$id'>
              <input type='hidden' name='user_name' value='$user'>
              <input type='hidden' name='keterangan' value='$keterangan'>
           </form>";
 ?>
 <script>
  document.getElementById("frm_kirimData").submit();
 </script>