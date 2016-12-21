window.onerror = function(message, url, lineNumber) {  
        // code to execute on an error  
        return true; // prevents browser error messages  
    };


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
				xhttp.open("POST", "./?page=create", true);
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
		xhr.open('GET', './sidebar_usr_img.php', true);
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
	try {
	but1 = document.getElementById("but1");
	but2 = document.getElementById("but2");
	but3 = document.getElementById("but3");

	but1.style.background = "none";
	but2.style.background = "none";
	but3.style.background = "none";
	x.style.background="lightgreen";
	//	enable button :
	document.getElementById("startbutton").disabled = false;
	//	set filter value for upload form :
	document.getElementById("upload_filter").value = x.src;
	} catch(e){};
}

function deleteImg(xthis) {
	
	var xhttp;
	if (window.XMLHttpRequest)
	{
		xhttp = new XMLHttpRequest();
	}
	if (xhttp.readyState == 0 || xhttp.readyState == 4) 
	{
		xhttp.onreadystatechange = updateThumbnailSection;
		xhttp.open("POST", "./?page=create", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var img = xthis.value;
		xhttp.send("img_delete=" + img);
	}
	else 
		setTimeout('takepicture()', 500);
	return (false);
}








