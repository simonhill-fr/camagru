<?php 
	require_once '/Users/shill/http/MyWebSite/camagru/config/setup.php';
	require_once '/Users/shill/http/MyWebSite/camagru/tools/database_operations.php';
?>

<div class="colmask ">
		<div class="colmid">
			<!-- Column 1 start -->
			<h2 style="text-align: center">Welcome</h2>
			<div align="center">
				
<?php

$sql = "SELECT path, user_id FROM pictures ORDER BY timestamp DESC";
$pic = db_array_fetchAll($sql);
if ($pic)
{
	$k = 0;
	$total = count($pic);
	while ($k < $total)
	{
		if (isset($pic[''.$k.'']['path'])) {
			echo "<div class='feed_post'>";
			echo "<div class='user_post'>";
			echo "username";
			echo "</div>";

			echo "	<img src='".$pic[''.$k.'']['0']."' width='100%' \>";
			
			if ($pic[''.$k.'']['user_id'] === $_SESSION['user_id']) 
			{
				echo "	<form action='./?page=create' method='post' >
						<button class='delbtn' id='delbtn".$k."' 
							onclick='return deleteImg(this)' name='img_delete' value='";
				echo $pic[''.$k.'']['path'];
				echo "'	></button></form>";
			}
			echo "<div>";
			echo "</div>";
			echo "</div>";
		}
		$k++;
	}
}
else
	echo "<p>No pictures to show</p>";
	
?>
			</div>			
		</div>
		<!-- Column 1 end -->
</div>