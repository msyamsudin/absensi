<?php
include 'include/head.php';
include 'include/global.php';
include 'include/function.php';
include 'include/navbar.php';

  // menangkap nilai dari qr_form_bridge.php
  $user_id  = $_POST['id'];
  $user_name = $_POST['user_name'];
  $keterangan = $_POST['keterangan'];

  $stat_scan = null;
  ?>

  <br>
  <br>
  <br>
  <br>
<div id="qrscanner" <?php echo $stat_scan ?> >
<div id="output">
    <div id="outputMessage"><!-- ..Pesan.. --></div>
    <div hidden><b>Data:</b> <span id="outputData"></span></div>
  </div>
  <div id="loadingMessage">Arahkan QR Code kamu ke kamera. <br> 🎥 Mohon tunggu sebentar, pastikan webcam dalam keadaan aktif.</div>
  <canvas id="canvas" hidden ></canvas>
  
  <script>
    var video = document.createElement("video");
    var canvasElement = document.getElementById("canvas");
    var canvas = canvasElement.getContext("2d");
    var loadingMessage = document.getElementById("loadingMessage");
    var outputContainer = document.getElementById("output");
    var outputMessage = document.getElementById("outputMessage");
    var outputData = document.getElementById("outputData");

    function drawLine(begin, end, color) {
      canvas.beginPath();
      canvas.moveTo(begin.x, begin.y);
      canvas.lineTo(end.x, end.y);
      canvas.lineWidth = 4;
      canvas.strokeStyle = color;
      canvas.stroke();
    }

    // Use facingMode: environment to attemt to get the front camera on phones
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
      video.srcObject = stream;
      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
      video.play();
      requestAnimationFrame(tick);
    });

    function tick() {
      loadingMessage.innerText = "⌛ Loading video..."
      if (video.readyState === video.HAVE_ENOUGH_DATA) {
        loadingMessage.hidden = true;
        canvasElement.hidden = false;
        outputContainer.hidden = true;

        canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
        var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
        var code = jsQR(imageData.data, imageData.width, imageData.height);
        if (code) {
          drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#ff0000");
          drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#ff0000");
          drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#ff0000");
          drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#ff0000");

            outputMessage.hidden = false;
            outputData.parentElement.hidden = false;
            outputData.innerText = code.data;
          
            var isidata = outputData.innerText;
            document.frm_kirimData.auth_data.value = isidata;
            document.getElementById("frm_kirimData").submit(); // gak perlu tombol submit pada form
            localstream.getTracks()[0].stop(); // turn off webcam
        } else {
          outputMessage.hidden = false;
         // outputData.parentElement.hidden = true;
        }
      }
      requestAnimationFrame(tick);
    }
  </script>
</div>

  <?php
echo		"<form name='frm_kirimData' id='frm_kirimData' method='post' action='verifpulang_qr.php'>
                <input type='hidden' name='auth_data' id='auth_data' value=''>
                <input type='hidden' name='user_id' value='$user_id'>
                <input type='hidden' name='user_name' value='$user_name'>
                <input type='hidden' name='keterangan' value='$keterangan'>
        </form>";

        
 ?>
