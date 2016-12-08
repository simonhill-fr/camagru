<!-- montage.php -->

<?php 

function put_user_img()
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
				echo "	<img onmouseenter='displayDeleteButton(".$k.")' onmouseleave='hideDeleteButton(".$k.")' src='".$pic[''.$k.'']['0']."' width='80%' >";
				echo "	<form action='./?page=create' method='post' >
						<button class='delbtn' id='delbtn".$k."' type='submit' name='img_delete' value='";
				echo $pic[''.$k.''][0];
				echo "'	></button></form>";
			}
			$k++;
		}
	}
}

if (isset($_POST["img_data"]) && $_POST["img_data"] !== ""
	&& isset($_POST["filter"]) && $_POST["filter"] )
{
	include "create_picture.php";
	$filterPath = "./images/filters/" . $_POST["filter"];
	create_picture($filterPath);
	$_POST["img_data"] = NULL;
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
			<div>
				<form action="./?page=create" method="post" name="takepic_form">
					<label>
						<input type="radio" value="glasses.png" name="filter" required>
						<img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src="images/filters/glasses.png" width="10%">
					</label>
					<label>
						<input type="radio" value="wig.png" name="filter" required>
						<img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src="images/filters/wig.png" width="10%">
					</label>
					<label>
						<input type="radio" value="dog.png" name="filter" required>
						<img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src="images/filters/dog.png"  width="10%">
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
		<div class="col2">
			<?php put_user_img(); ?>
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
	
	

	
function bigImg(x) {
	x.style.width = "15%";

}
function normalImg(x) {
	x.style.width = "10%";
}

function displayDeleteButton(n)
{
	/*deleteButton = document.getElementById("delbtn" + n);
	deleteButton.style.display="block";*/
}

function hideDeleteButton(n)
{
	/*deleteButton = document.getElementById("delbtn" + n);
	deleteButton.style.display="none";*/
}






</script>