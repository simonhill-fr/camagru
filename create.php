<!-- montage.php -->

<?php 

/*function put_user_img()
{
	$db = db_connection();
	$pictures = $db->prepare("
		SELECT path 
		FROM pictures 
		WHERE user_id='".$_SESSION["user_id"]."'
		ORDER BY timestamp DESC
		");
	$pictures->execute();
	$pic = $pictures->fetchAll();
	if ($pic){	
		$k = 0;
		while ($k < 5)
		{
			if (isset($pic[''.$k.''][0])) {
				echo "	<img src='".$pic[''.$k.'']['0']."' width='80%' >";
				echo "	<form action='./?page=create' method='post' >
						<button class='delbtn' id='delbtn".$k."' type='submit' name='img_delete' value='";
				echo $pic[''.$k.''][0];
				echo "'	></button></form>";
			}
			$k++;
		}
	}
}*/

if (isset($_POST["img_data"]) && $_POST["img_data"] !== ""
	&& isset($_POST["filter"]) && $_POST["filter"] )
{
	include "create_picture.php";
	$filterPath = "./images/filters/" . $_POST["filter"];
	create_picture($filterPath);
}

if (isset($_POST["img_delete"])) {
	$db = db_connection();
	$sql = "DELETE FROM pictures WHERE pictures.path = '".$_POST['img_delete']."'";
	$db->exec($sql);
	unlink($_POST['img_delete']);

}

?>
<div class="colmask rightmenu">
	<div class="colleft">
		<div class="col1">
			<!-- Column 1 start -->
			<h2 style="text-align: center">Step 1 : Pick a Filter</h2>
			<div align="center">
				<form action="./?page=create" method="post" name="takepic_form">
					<label>
						<input style="visibility: hidden" type="radio" value="glasses.png" name="filter" required>
						<img id="but1" class="filters" onclick="imgSelect(this)" src="images/filters/glasses.png" width="20%">
					</label>
					<label>
						<input style="visibility: hidden" type="radio" value="wig.png" name="filter" required>
						<img id="but2" class="filters" onclick="imgSelect(this)" src="images/filters/wig.png" width="20%">
					</label>
					<label>
						<input style="visibility: hidden" type="radio" value="dog.png" name="filter" required>
						<img id="but3" class="filters" onclick="imgSelect(this)" src="images/filters/dog.png"  width="20%">
					</label>
				</div>
				<div>
					<h2 style="text-align: center">Step 2 : Take a Picture</h2>
				</div>
				<div style="text-align: center">
					<video id="video"></video>
					<div style="display: none"><canvas id="canvas"></canvas></div>
					<div><button class='delbtn' id="startbutton" name="img_data" type="submit" >Prendre une photo</button></div>
				</form>
			</div>
		</div>
		<!-- Column 1 end -->
		<div id="thumb_sidebar" class="col2">

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
			//startbutton.value=data;
			
			var xhttp;
			if (window.XMLHttpRequest) 
			{
				xhttp = new XMLHttpRequest();
			}

			if (xhttp.readyState == 0 || xhttp.readyState == 4) 
			{
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) 
					{
						var xhr= new XMLHttpRequest();
						xhr.open('GET', 'http://localhost:8080/camagru/sidebar_usr_img.php', true);
						
						xhr.onreadystatechange= function() {
							if (this.readyState == 4 && this.status == 200)
							{
								console.log(document.getElementById("thumb_sidebar").innerHTML = this.responseText);
							}
						};

						xhr.send();						
					}
				};

				xhttp.open("POST", "http://localhost:8080/camagru/index.php?page=create", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("img_data=" + data + "&filter=glasses.png");
			}
			else 
				setTimeout('takepicture()', 500);


			
		}

		startbutton.addEventListener('click', function (ev){
			takepicture();
			ev.preventDefault();
		}, false);

	})();
	
	

	
function imgSelect(x) {
	but1 = document.getElementById("but1");
	but2 = document.getElementById("but2");
	but3 = document.getElementById("but3");

	but1.style.background = "none";
	but2.style.background = "none";
	but3.style.background = "none";
	x.style.background="lightgreen";

}



</script>