<?php

/*	Get images and info from pictures table	*/

require_once 'model/db_query.php';

Class Feed_Gallery {

	private $db;
	public	$img_src;
	public	$pic_array;
	public	$comment_array;
	public	$key;
	public	$total;
	public	$img_likes;
	public	$liked_by_user;

	function __construct() {
		$this->db = new Connection();
		$sql = "SELECT path, user_id, comment_ids, likes, id FROM pictures ORDER BY timestamp DESC";
		$this->pic_array = $this->db->db_array_fetchAll($sql);
		if (!$this->pic_array)
			throw new Exception("The feed is empty", 1);
		$this->total = count($this->pic_array);
		$this->key = 0;
	}
	function img_path() {
		if (isset($this->pic_array[''.$this->key.'']['path']))
		{
			return ($this->pic_array[''.$this->key.'']['path']);			
		}
	}
	function belongs_to_user()	{
		if (isset($_SESSION['user_id']) && $this->pic_array[''.$this->key.'']['user_id'] === $_SESSION['user_id'])
			return true;
		else
			return false;
	}
	function get_username()	{
		$sql = "SELECT login FROM users WHERE id='".$this->pic_array[''.$this->key.'']['user_id']."' ";
		$users = $this->db->db_array_fetchAll($sql);
		if (!$users)
			throw new Exception("Error: No user to match this picture", 1);
		return $users['0']['login'];

	}
	function get_post_likes()	{
		if ($this->pic_array[''.$this->key.'']['likes'])
			return ($this->pic_array[''.$this->key.'']['likes']);
	}
	function get_img_id()	{
		if ($this->pic_array[''.$this->key.'']['id'])
			return ($this->pic_array[''.$this->key.'']['id']);
	}
	function get_comments()	{
		$sql = "
		SELECT pic_id, login, text
		FROM comments
		INNER JOIN users ON comments.user_id=users.id
		WHERE comments.pic_id='".$this->pic_array[''.$this->key.'']['id']."'
		ORDER BY comments.timestamp ASC";
		$this->comment_array = $this->db->db_array_fetchAll($sql);
		if ($this->comment_array === false)
			throw new Exception("DB Error retrieving comments", 1);
		return ($this->comment_array);
	}
	function get_like_status()	{
		if (isset($_SESSION['user_id']))
		{
			$user_id = $_SESSION['user_id'];
			$sql= "
				SELECT * FROM likes
				WHERE likes.pic_id='".$this->pic_array[''.$this->key.'']['id']."'
				AND likes.user_id='".$user_id."'
				";
			$search = $this->db->db_array_fetchAll($sql);
			if ($search === false)
				throw new Exception("DB Error getting like status", 1);
			if ($search)
				$this->liked_by_user = "set";
			else
				$this->liked_by_user = "cleared";
			return ($this->liked_by_user);
		}
		return ("test");
	}

	function count_likes()	{
		$sql = "
		SELECT * FROM likes
		WHERE likes.pic_id='".$this->pic_array[''.$this->key.'']['id']."'
		";
		$count_likes = $this->db->db_array_fetchAll($sql);
		if ($count_likes === false)
			throw new Exception("DB Error getting likes count", 1);
		if (!$count_likes)
			return ("No");
		else
			return (count($count_likes));
	}
}

?>