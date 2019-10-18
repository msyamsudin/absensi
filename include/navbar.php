<?php $base_path = "https://syam.web.id/portofolio/absensi/"; ?>

<!-- Bootstrap -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/js/bootstrap.min.js"></script>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">FlexCode Absensi</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo $base_path?>">User</a></li>
        <li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Log
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
						<li><a href="<?php echo $base_path?>index.php?action=log">Log Masuk</a></li>
            <li><a href="<?php echo $base_path?>index.php?action=log_pulang">Log Pulang</a></li>
            <li><a href="<?php echo $base_path?>index.php?action=log_semua">Log Semua</a></li>
						</ul>
					</li>
        <li><a href="<?php echo $base_path?>index.php?action=perizinan">Perizinan</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
          session_start();
          if (empty($_SESSION['user'])) {
            echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
          } else {
          //print_r(  $_SESSION['user']);
          echo "<li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
          }
         ?>
      </ul>
    </div>

  </div>
</nav>
