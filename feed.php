<?php 
	require_once 'model/db_query.php';
	require_once 'model/Feed_Gallery.php';
?>

<div class="colmask ">
		<div class="colmid">
			<!-- Column 1 start -->
<?php

	try {
		$post = new Feed_Gallery();
		$total_pages = ceil($post->total / 5);
	
		if (isset($_GET["pagenum"]) && is_numeric($_GET["pagenum"]))
		{
			$post->key = (intval($_GET["pagenum"]) - 1) * 5;
			if ($post->key > $post->total || $post->key < 0)
				$post->key = 0;
		}
		else
			$post->key = 0;
		$i = 0;
		while ($i < 5 && $post->key < $post->total)
		{
			include 'post.php';
			$post->key++;
			$i++;
		}
	
		echo "<div class='pagination'>";
		$pagenum = 1;
		while ($pagenum <= $total_pages)
		{
			include "pagination.php";
			$pagenum++;
		}
		echo "</div>";
	
	} catch (Exception $e) {
		header("Location: error.php?ernum=1");
	}

?>
		</div>
		<!-- Column 1 end -->
</div>

