<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
	<head>
		<?php include 'include/global.php'; ?>
		<?php include 'include/head.php'; ?>
	</head>
	<body>
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
						<li><a href="#" onclick="load('<?php echo $base_path?>user.php?action=index')">User</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Log
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
						<li><a href="#" onclick="load('<?php echo $base_path?>log.php?action=index')">Log Masuk</a></li>
						<li><a href="#" onclick="load('<?php echo $base_path?>log_pulang.php?action=index')">Log Pulang</a></li>
						<li><a href="#" onclick="load('<?php echo $base_path?>log_semua.php?action=index')">Log Semua</a></li>
						</ul>
					</li>
						<li><a href="#" onclick="load('<?php echo $base_path?>perizinan.php?action=index')">Perizinan</a></li>
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
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="content">

					</div>
				</div>
			</div>
		</div>


		<script>
		 jQuery(document).ready(function() {

			 console.log('user');

			 load('<?php echo $base_path?>user.php?action=index');

		 });
	 </script>

		<?php if (isset($_GET['action']) && $_GET['action'] == 'log') { ?>

		 <script>
			 jQuery(document).ready(function() {

				 console.log('catatan masuk');

				 load('<?php echo $base_path?>log.php?action=index');

			 });
		 </script>

	 <?php } elseif (isset($_GET['action']) && $_GET['action'] == 'log_pulang') { ?>

			<script>
 			 jQuery(document).ready(function() {

 				 console.log('catatan pulang');

 				 load('<?php echo $base_path?>log_pulang.php?action=index');

 			 });
 		 </script>

	 <?php } elseif (isset($_GET['action']) && $_GET['action'] == 'log_semua') { ?>

			<script>
			jQuery(document).ready(function() {

				console.log('catatan masuk dan pulang');

				load('<?php echo $base_path?>log_semua.php?action=index');

			});
			</script>

	<?php } elseif (isset($_GET['action']) && $_GET['action'] == 'perizinan') { ?>

		 <script>
			jQuery(document).ready(function() {

				console.log('perizinan');

				load('<?php echo $base_path?>perizinan.php?action=index');

			});
		</script>

	 <?php } elseif (isset($_GET['action']) && $_GET['action'] == 'filter') { ?>

		 <script>
			jQuery(document).ready(function() {

				console.log('filter');

				load('<?php echo $base_path?>filter.php?action=index');

			});
		</script>

		 <?php } ?>

	</body>
</html>