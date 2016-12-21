<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'error_report.php';
?>
<!DOCTYPE html>
<html>
<body>
<?php 
	
	require_once '/Users/shill/http/MyWebSite/camagru/model/db_query.php';
	
	$sql = 
		"SELECT path FROM pictures 
		WHERE user_id='".$_SESSION['user_id']."'
		ORDER BY timestamp DESC";
	$pic = db_array_fetchAll($sql, NULL);
	if ($pic)
	{
		$k = 0;
		while ($k < 5)
		{
			if (isset($pic[''.$k.''][0])) {
				echo "	<img src='".$pic[''.$k.'']['0']."' width='80%' \>";
				echo "	<form action='./?page=create' method='post' >
				<button class='delbtn' id='delbtn".$k."' onclick='return deleteImg(this)' name='img_delete' 	value='";
				echo $pic[''.$k.''][0];
				echo "'	></button></form>";
			}
			$k++;
		}
	}
	else
		echo "<p>No pictures on this profile</p>";
	
?>
</body>
</html>

