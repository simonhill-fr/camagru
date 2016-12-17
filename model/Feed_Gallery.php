<?php

/*	Get images and info from pictures table	*/

Class Feed_Gallery {

	private $db;
	public	$img_src;
	public	$pic_array;
	public	$key;
	public	$total;
	public	$username;
	public	$img_likes;

	function __construct() {
		$this->db = new Connection();
		$sql = "SELECT path, user_id, comment_ids, likes, id FROM pictures ORDER BY timestamp DESC";
		$this->pic_array = $this->db->db_array_fetchAll($sql);
		$this->total = count($this->pic_array);
		$this->key = 0;

		$sql = "SELECT login FROM users WHERE id='".$_SESSION['user_id']."'";
		$users = $this->db->db_array_fetchAll($sql);
		$this->username = $users['0']['login'];
	}
	function img_path() {
		if (isset($this->pic_array[''.$this->key.'']['path']))
		{
			return ($this->pic_array[''.$this->key.'']['path']);			
		}
	}
	function belongs_to_user()	{
		if ($this->pic_array[''.$this->key.'']['user_id'] === $_SESSION['user_id'])
			return true;
		else
			return false;
	}
	function get_post_likes()	{
		if ($this->pic_array[''.$this->key.'']['likes'])
			return ($this->pic_array[''.$this->key.'']['likes']);
	}
	function get_img_id()	{
		if ($this->pic_array[''.$this->key.'']['id'])
			return ($this->pic_array[''.$this->key.'']['id']);
	}

}

?>