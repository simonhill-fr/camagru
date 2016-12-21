
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