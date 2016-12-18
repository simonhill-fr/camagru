<?php 
	require_once '/Users/shill/http/MyWebSite/camagru/config/setup.php';
	require_once '/Users/shill/http/MyWebSite/camagru/tools/database_operations.php';
	require_once 'model/Feed_Gallery.php';
?>

<div class="colmask ">
		<div class="colmid">
			<!-- Column 1 start -->
			<!-- <div > -->
				
<?php

try {
	$post = new Feed_Gallery();
	$i = 0;
	$total_pages = $post->total / 10;
	while ($i < $post->total)
		{
			include 'post.php';
			$post->key++;
			$i++;
		}
} catch (Exception $e) {
	echo $e->getMessage();
}

?>
			<!-- </div> -->			
		</div>
		<!-- Column 1 end -->
</div>