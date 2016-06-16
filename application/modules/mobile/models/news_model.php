<?php



class News_model extends CI_Model 

{


	/*

	*	Update user's last login date

	*

	*/

	public function get_news()

	{

		$this->db->where('wp_vhxu_posts.ID = wp_vhxu_postmeta.post_id AND wp_vhxu_posts.post_type = "post"
AND wp_vhxu_posts.post_status = "publish" AND year(post_date) >= '.date('Y').' AND wp_vhxu_posts.post_parent = 0');

	 	$this->db->order_by('wp_vhxu_posts.post_date','DESC');
	 	$this->db->group_by('wp_vhxu_posts.ID');
		$this->db->limit(10);

		$query = $this->db->get('wp_vhxu_posts, wp_vhxu_postmeta');


		return $query;

	}



	/*

	*	Update user's last login date

	*

	*/

	public function get_ecconect_news()

	{

		$this->db->where('wp_vhxu_posts.ID = wp_vhxu_postmeta.post_id AND wp_vhxu_posts.post_type = "post"
AND wp_vhxu_posts.post_status = "publish" AND year(post_date) >= '.date('Y').' AND wp_vhxu_posts.post_parent = 0');

	 	$this->db->order_by('wp_vhxu_posts.post_date','DESC');
		$this->db->limit(10);
		$this->db->group_by('wp_vhxu_posts.ID');

		$query = $this->db->get('wp_vhxu_posts, wp_vhxu_postmeta');



		return $query;

	}

	public function get_news_detail($id)

	{

		$this->db->where('wp_vhxu_posts.ID = wp_vhxu_postmeta.post_id AND wp_vhxu_posts.post_type = "post"
AND wp_vhxu_posts.post_status = "publish" AND wp_vhxu_posts.ID = '.$id);

		$query = $this->db->get('wp_vhxu_posts,wp_vhxu_postmeta');

		return $query;

	}



	public function count_unread_news()

	{

		$this->db->where('wp_vhxu_posts.ID = wp_vhxu_postmeta.post_id AND wp_vhxu_posts.post_type = "post"
AND wp_vhxu_posts.post_status = "publish" AND year(post_date) >= '.date('Y').' AND wp_vhxu_posts.post_parent = 0');

	 	$this->db->order_by('wp_vhxu_posts.post_date','DESC');
		$this->db->limit(10);
		$this->db->group_by('wp_vhxu_posts.ID');
		$query = $this->db->get('wp_vhxu_posts, wp_vhxu_postmeta');
	



		return $query->num_rows();	

	}
	public function get_attachments($id)
	{

		$this->db->select('*');

		$this->db->where('wp_vhxu_posts.ID = wp_vhxu_postmeta.post_id AND wp_vhxu_posts.post_type = "attachment" AND wp_vhxu_posts.post_status = "inherit" AND wp_vhxu_posts.post_parent ='.$id);

		$this->db->order_by('wp_vhxu_posts.post_date','ASC');

		$query = $this->db->get('wp_vhxu_posts, wp_vhxu_postmeta');

		return $query;



	}



}