<div class = "feed_img_del" width="50%">
<form action="./do_feed_delete_img.php" method="post" >
<button class="feed_img_del_btn"
		id="<?php echo 'feed_img_del' . $post->key; ?>"
		name="img_delete" 
		value="<?php echo $post->img_path(); ?>" >
</button>
</form>
</div>