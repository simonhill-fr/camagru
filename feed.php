<?php 
	require_once '/Users/shill/http/MyWebSite/camagru/config/setup.php';
	require_once '/Users/shill/http/MyWebSite/camagru/tools/database_operations.php';
	require_once 'model/Feed_Gallery.php';
?>

<div class="colmask ">
		<div class="colmid">
			<!-- Column 1 start -->
			<h2 style="text-align: center">Welcome</h2>
			<div align="center">
				
<?php

$post = new Feed_Gallery();
$i = 0;
$total_pages = $post->total / 10;

while ($i < 10)
{
	while ($i < 10)
	{
		include 'post.php';
		$post->key++;
		$i++;
	}
}
?>
			</div>			
		</div>
		<!-- Column 1 end -->
</div>