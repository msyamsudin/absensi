<?php session_start(); ?>
<head>
	<title>Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="assets/image/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--===============================================================================================-->
<script type="text/javascript">
/* Awal JS Snackbar (notifikasi) */
function NOTIFsalah() {
  setTimeout(function() {
    var x = document.getElementById("salah");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  }, 500);
}

function NOTIFuser() {
  setTimeout(function() {
    var x = document.getElementById("userSalah");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  }, 500);
}
/* Akhir JS Snackbar (notifikasi) */
</script>
</head>

<body>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-b-160 p-t-50">
        <form class="login100-form validate-form" action="proses_login.php" method="post">
          <span class="login100-form-title p-b-43">
            Admin Login
          </span>

          <div class="wrap-input100 rs1 validate-input" data-validate = "Username is required">
            <input class="input100" type="text" name="username">
            <span class="label-input100">Username</span>
          </div>


          <div class="wrap-input100 rs2 validate-input" data-validate="Password is required">
            <input class="input100" type="password" name="password">
            <span class="label-input100">Password</span>
          </div>

          <div class="container-login100-form-btn">
            <button type="submit" name="submit" class="login100-form-btn">
              Sign in
            </button>
            <a href="index.php" class="login100-form-tombol-home">Home</a>
          </div>

          <?php
            if (empty($_SESSION['pesan'])) { ?>

            <?php } elseif ($_SESSION['pesan']=='!user') { ?>
              <script type='text/javascript'>
                window.onload=NOTIFuser;
              </script>
              <div id='userSalah'>Username tidak ditemukan.</div>
            <?php session_destroy(); } else { ?>
              <script type='text/javascript'>
                window.onload=NOTIFsalah;
              </script>
              <div id='salah'>Password yang kamu masukkan salah.</div>
          <?php session_destroy(); } ?>

        </form>
      </div>
    </div>
  </div>

  <!--==================================== JAVASCRIPT ============================================== -->
  <!--===============================================================================================-->
    <script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
    <script src="assets/vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
    <script src="assets/vendor/bootstrap/js/popper.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
    <script src="assets/vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
    <script src="assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
    <script src="assets/vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
    <script src="assets/js/main-login.js"></script>
</body>
