<div class='feed_post'>
	<div class='username'>
		<?php echo $post->get_username(); ?>
	</div>
	<img src="<?php echo $post->img_path(); ?>" width="100%" \>
	
	<div id="TotalNumberOfLikes" class="post_likes">
		<?php echo $post->count_likes(); ?> Like
	</div>
	<?php if ($post->belongs_to_user()) include 'feed_delete_img.php' ?>

	<div class="comments">
		<?php 
			$all_comments = $post->get_comments();
			foreach ($all_comments as $comment) {
				include 'put_comment.php';
			}
		?>		
	</div>
	<div class="like_form">
		<form action="./like_form.php" method="post">
			<input id="like_status" type="hidden" name="like_status" value="<?php echo $post->get_like_status() ?>">
			<input id="like_pic_id" type="hidden" name="pic_id" value="<?php echo $post->get_img_id() ?>">
			<button type="submit" name="submit_like" ></button>
		</form>

	</div>

	<div class="comment_form">
			<form action="./comment.php" method="post">
		<input type="hidden" name="pic_id" value="<?php echo $post->get_img_id() ?>">
		<input id="comment_form_input" type="text" name="comment_text">
		<button type="submit" name="submit_comment">
			Send
		</button>
		</form>
	</div>
</div>