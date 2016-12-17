<div class='feed_post'>
	<div class='username'>
		<?php echo $post->username; ?>
	</div>
	<img src="<?php echo $post->img_path(); ?>" width="100%" \>
	
	<div class="post_likes">
		<?php echo $post->get_post_likes(); ?> Likes
	</div>
	<?php if ($post->belongs_to_user()) include 'feed_delete_img.php' ?>

	<div class="comments">
<?php 



?>
		
	</div>
	
	<div class="comment_form">
		<form action="./comment.php" method="post">
		<input type="hidden" name="pic_id" value="<?php echo $post->get_img_id() ?>">
		<input id="comment_text" type="text" name="comment_text">
		<button type="submit" name="submit_comment">
			Send
		</button>
		</form>
	</div>
</div>