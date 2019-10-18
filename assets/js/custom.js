function load(page) {
	$.ajax({
		type		: 'GET',
		url		: page,
		success	: function(data) {
			try {
				$('#content').html(data);
			} catch (err) {
				alert(err);
			}
		}
	});
}

function push(page) {

	$.ajax({
		beforeSend	: function() {
			$('.help-blok').remove();
		},
		type		: 'GET',
		url		: page,
		success	: function(data) {
			try {

				console.log('Data has been pushed..');

				var res = jQuery.parseJSON(data);

				if (res.result) {

					$.each(res, function(key, value) {

						if (key == 'reload') {

							load(value);

							alert('Data saved..');

						}

					});

				} else if (res.result == false) {

					$.each(res, function(key, value) {

						if (key != 'result' && key != 'server' && key != 'notif' ) {

							$('#'+key).after("<span class='help-blok'>"+value+"</span>")

						} else if (key == 'server') {

							alert(value);

						}
					});

				}

			} catch (err) {

				alert(err.message);

			}
		}
	});

}

/* Cek waktu */
function cek_waktu() {

	var d = new Date();
	var Sekarang = d.getHours() * 100 + d.getMinutes();
		//console.log(Sekarang);
	if(Sekarang > 810 && Sekarang < 2300 ){
			console.log('Sekarang pukul'+' '+d.getHours()+':'+d.getMinutes());
			console.log('Kamu terlambat');
			$("#tepat").hide();
	}
	else{
		console.log('Selamat datang');
		$("#terlambat").hide();
	}
}

function cek_waktu_pulang() {
     var d = new Date();
     var Sekarang = d.getHours() * 100 + d.getMinutes();
       //console.log(Sekarang);
     if(Sekarang > 810 && Sekarang < 1630 ){
         console.log('Sekarang pukul'+' '+d.getHours()+':'+d.getMinutes());
         console.log('Belum waktunya pulang');
         $("#pulang").hide();
     }
     else{
       console.log('Hati-hati dijalan');
       $("#sabar").hide();
     }
   }

/* Awal JS Snackbar (notifikasi) */
function NOTIFmerah() {
	setTimeout(function() {
		var x = document.getElementById("salah");
		x.className = "show";
		setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}, 500);
}

function NOTIFbiru() {
	setTimeout(function() {
	var x = document.getElementById("benar");
	x.className = "show";
	setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}, 500);
}
/* Akhir JS Snackbar (notifikasi) */

/* Awal button Home pada cek.php */
function back_beranda(url) {
  window.location.replace(url);
}
/* Akhir button Home pada cek.php */


/* Awal button autentikasi QR pada cek.php / cekoke.php */
function qr_auth() {
	document.getElementById("qr_form_send").submit();
  }
  /* Akhir button autentikasi QR pada cekoke.php */