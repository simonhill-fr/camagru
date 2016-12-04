<!-- montage.php -->

<?php 

if (isset($_POST["frr"]) && $_POST["frr"] !== "")
{
	include "cam.php";
	$_POST["frr"] = NULL;
}
else
	echo "ISNT";

?>

<div class="colmask rightmenu">
	<div class="colleft">
		<div class="col1">
			<!-- Column 1 start -->
			<h2 style="text-align: center">Step 1 : Pick a Filter</h2>
			<div>
				<img src="images/filters/glasses.png" width="30%">
				<img src="images/filters/wig.png" width="30%">
				<img src="images/filters/glasses.png" width="30%">

			</div>
			<div>
				<h2 style="text-align: center">Step 2 : Take a Picture</h2>

			</div>
			<div style="text-align: center">
				<video id="video"></video>
				<form action="./?page=create" method="post">					
					<div style="display: none"><canvas id="canvas"></canvas></div>
					<div><button id="startbutton" name="frr" type="submit" >Prendre une photo</button></div>
				</form>
			</div>
		</div>
		<!-- Column 1 end -->
		<div class="col2">
		<?php echo $display_img ?>
		</div>
	</div>

</div>
</div>

<script>

	(function() {

		var streaming = false,
		video        = document.querySelector('#video'),
		cover        = document.querySelector('#cover'),
		canvas       = document.querySelector('#canvas'),
		photo        = document.querySelector('#photo'),
		startbutton  = document.querySelector('#startbutton'),
		width = 320,
		height = 0;

		navigator.getMedia = ( navigator.getUserMedia ||
			navigator.webkitGetUserMedia ||
			navigator.mozGetUserMedia ||
			navigator.msGetUserMedia);

		navigator.getMedia(
		{
			video: true,
			audio: false
		},
		function(stream) {
			if (navigator.mozGetUserMedia) {
				video.mozSrcObject = stream;
			} else {
				var vendorURL = window.URL || window.webkitURL;
				video.src = vendorURL.createObjectURL(stream);
			}
			video.play();
		},
		function(err) {
			console.log("An error occured! " + err);
		}
		);

		video.addEventListener('canplay', function(ev){
			if (!streaming) {
				height = video.videoHeight / (video.videoWidth/width);
				video.setAttribute('width', width);
				video.setAttribute('height', height);
				canvas.setAttribute('width', width);
				canvas.setAttribute('height', height);
				streaming = true;
			}
		}, false);

		function takepicture() 
		{
			canvas.width = width;
			canvas.height = height;
			canvas.getContext('2d').drawImage(video, 0, 0, width, height);
			var data = canvas.toDataURL('image/png');
			startbutton.value=data;
			//video.style.display="none";
		}

		startbutton.addEventListener('click', function (ev){
			takepicture();
			/*ev.preventDefault();*/
		}, false);

	})(); 
</script>