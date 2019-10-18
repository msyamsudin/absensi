<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html>
<head>
	<title></title>
    <link rel="stylesheet" href="tabel.css" />
	<?php include 'include/head.php'; ?>
	<?php include 'include/global.php'; ?>
	<?php include 'include/navbar.php'; ?>
</head>
<body onLoad="document.postform.elements['nasabah'].focus();">

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="content">

					</div>
				</div>
			</div>
		</div>

<?php
//untuk koneksi database
include "koneksi.php";


//untuk menantukan tanggal awal dan tanggal akhir data di database
//$min_tanggal=mysqli_fetch_array(mysqli_query($link,"select min(log_time) as min_tanggal from demo_log"));
//$max_tanggal=mysqli_fetch_array(mysqli_query($link,"select max(log_time) as max_tanggal from demo_log"));
?>

<form  method="post">
<table width="435" border="0">
<tr>
    <td width="111">User Name</td>
		<td colspan="2">
		<select class="form-control" name="user_name" id='user_name'>
						<option selected disabled="disabled"> -- Select Username -- </option>
							<?php
								$Tampil = "SELECT user_name FROM demo_user";
								$result = mysqli_query($link,$Tampil);

								while($row = mysqli_fetch_array($result)){

									$value = $row['user_name'];

									echo "<option value=$value>$row[user_name]</option>";
								}
							?>
					</select>
			</td>

</tr>
<tr>
    <td>Tanggal Awal</td>
    <td colspan="2"><input type="text" class="input-tanggal" name="tanggal_awal" id="tanggal_awal" size="20" />
    <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_awal);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
    </td>
</tr>
<tr>
    <td>Tanggal Akhir</td>
    <td colspan="2"><input type="text" class="input-tanggal" name="tanggal_akhir" id="tanggal_akhir" size="20" />
    <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_akhir);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
    </td>
</tr>
<tr>
    <td><input type="button" value="Tampilkan Data" id="button"></td>
    <td colspan="2">&nbsp;</td>
</tr>
</table>
</form>
<p>

<ul id="result"></ul>

<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>

<script src="assets/js/jquery-1.7.1.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                 function search(){

                      var user_name=$("#user_name").val();
                      var tanggal_awal=$("#tanggal_awal").val();
                      var tanggal_akhir=$("#tanggal_akhir").val()+1;

                      if(user_name!="" && tanggal_awal!="" && tanggal_akhir!=""){
                        $("#result").html("<img src='assets/image/ajax-loader.gif'/>");
                         $.ajax({
                            type:"post",
                            url:"search.php",
                            data:{user_name:user_name,tanggal_awal:tanggal_awal,tanggal_akhir:tanggal_akhir},
                            success:function(data){
                                $("#result").html(data);
                                $("#user_name").val("");
                                $("#tanggal_awal").val("");
                                $("#tanggal_akhir").val("");
                             }
                          });
                      }

                 }

                  $("#button").click(function(){
                  	 search();
                  });
            });
</script>

</body>
</html>
