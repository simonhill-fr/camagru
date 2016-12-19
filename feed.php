<?php 
	require_once 'model/db_query.php';
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
