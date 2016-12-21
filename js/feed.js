
/*	This is an abandonned attempt at ajaxifiyng newsfeed */

/*function updatePostLikes ()	{
	document.getElementById("TotalNumberOfLikes").innerHTML = document.getElementById("TotalNumberOfLikes").responseText;
}

function LikeImg() {

	var xhttp;
	if (window.XMLHttpRequest)
	{
		xhttp = new XMLHttpRequest();
	}
	if (xhttp.readyState == 0 || xhttp.readyState == 4) 
	{
		xhttp.onreadystatechange = updatePostLikes;
		xhttp.open("POST", "./like_form.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var like_status = document.getElementById("like_status").value;
		var pic_id = document.getElementById("like_pic_id").value;
		console.log("submit_like=true&like_status=" + like_status + "&pic_id=" + pic_id);
		xhttp.send("submit_like=true&like_status=" + like_status + "&pic_id=" + pic_id);
	}
	else 
		setTimeout('LikeImg()', 500);
	return (false);
}*/


/*
function updateThisPost()	{
	if (this.readyState == 4 && this.status == 200) 
	{
		console.log(this.responseText);
		//document.getElementById("thumb_sidebar").innerHTML = this.responseText;
		
	}
}

function deleteImgFromFeed(xthis) {
	
	var xhttp;
	if (window.XMLHttpRequest)
	{
		xhttp = new XMLHttpRequest();
	}
	if (xhttp.readyState == 0 || xhttp.readyState == 4) 
	{
		xhttp.onreadystatechange = updateThisPost;
		xhttp.open("POST", "./do_feed_delete_img.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var img = xthis.value;
		xhttp.send("img_delete=" + img);
	}
	else 
		setTimeout('takepicture()', 500);
	return (false);
}*/


/*function putLikeColor(xthis)	{
	console.log("enter");

	if (xthis.value == 'set')	{
		xthis.backgroundImage = "url('images/chat-outline/32x32.png')";
		console.log("set");
	}
	else if (xthis.value == 'cleared')	{
		xthis.backgroundImage = "url('images/heart-outline/32x32.png')";
		console.log("cleared");
	}
}*/