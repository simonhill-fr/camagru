<?php 
session_start();
include 'config/setup.php';
include 'tools/database_operations.php';
	/*REMOVE */
	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);
	/*REMOVE */
?>
<html>
<head>
	<title>Camagru</title>
	<meta name="robots" content="index, follow" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen" />
</head>
<body>

<div id="header">
	
	<ul>
		<li style="float: left"><a href="./"> Home </a></li>
		<?php
			if (isset($_SESSION["user"]) && $_SESSION["user"] !== "")
				include 'view/nav_user.html';
			else
				include 'view/nav_anonym.html'
		?>
	</ul>
</div>
<?php

if (isset($_GET["page"]))
{
	if ($_GET["page"] == "create")
		include "create.php";
}
else
	include "feed.php";

?>
<div id="footer">
	<p style="text-align: center;"> (c) shill 2016 </p>
</div>

</body>

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
				xhttp.onreadystatechange = updateThumbnailSection;
				xhttp.open("POST", "http://localhost:8080/camagru/index.php?page=create", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				var radio = selectedRadioBut();
				xhttp.send("img_data=" + data + "&filter=" + radio);
			}
			else 
				setTimeout('takepicture()', 500);
		}

		startbutton.addEventListener('click', function (ev){
			takepicture();
			ev.preventDefault();
		}, false);
	})();

function	updateThumbnailSection()
{
	if (this.readyState == 4 && this.status == 200) 
	{
		var xhr= new XMLHttpRequest();
		xhr.open('GET', 'http://localhost:8080/camagru/sidebar_usr_img.php', true);
		xhr.send();
		xhr.onreadystatechange= function() {
		if (this.readyState == 4 && this.status == 200)
			document.getElementById("thumb_sidebar").innerHTML = this.responseText;
		};
	}
}
	
function selectedRadioBut()
{
	var radio = "glasses.png";
	if (document.getElementById("r1").checked == true)
		return ("glasses.png");
	else if (document.getElementById("r2").checked == true)
		return ("wig.png");
	else if (document.getElementById("r3").checked == true)
		return ("dog.png");
	return (false);
}
	
function imgSelect(x) {
	but1 = document.getElementById("but1");
	but2 = document.getElementById("but2");
	but3 = document.getElementById("but3");

	but1.style.background = "none";
	but2.style.background = "none";
	but3.style.background = "none";
	x.style.background="lightgreen";
	document.getElementById("startbutton").disabled = false;

}


function deleteImg(xthis) {
	
	console.log("enter");
	var xhttp;
	if (window.XMLHttpRequest)
	{
		xhttp = new XMLHttpRequest();
	}
	if (xhttp.readyState == 0 || xhttp.readyState == 4) 
	{
		xhttp.onreadystatechange = updateThumbnailSection;
		xhttp.open("POST", "http://localhost:8080/camagru/index.php?page=create", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var img = xthis.value;
		xhttp.send("img_delete=" + img);
	}
	else 
		setTimeout('takepicture()', 500);
	return (false);
}
</script>

</html>
