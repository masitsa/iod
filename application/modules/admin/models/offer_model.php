<?php

class Offer_model extends CI_Model 
{	
	/*
	*	Retrieve all active categories
	*
	*/
	public function get_all_active_categories($limit = NULL, $order = 'offer_category_name', $order_method = 'ASC', $where ='offer_category_status = 1' )
	{
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get('offer_category');
		
		return $query;
	}
	
	public function get_all_offer_categories($offer_category_id)
	{
		$this->db->where('offer_category.offer_category_id = '.$offer_category_id.' OR offer_category.offer_category_parent = '.$offer_category_id);
		$this->db->order_by('offer_category_parent, offer_category_name');
		$query = $this->db->get('offer_category');
		
		return $query;
	}
	
	public function count_offers($offer_category_id)
	{
		$this->db->where('offer_category.offer_category_id = offer.offer_category_id AND offer_category.offer_category_id = '.$offer_category_id.' OR offer_category.offer_category_parent = '.$offer_category_id);
		$total = $this->db->count_all_results('offer_category, offer');
		
		return $total;
	}
	
	/*
	*	Retrieve all active categories
	*
	*/
	public function get_all_active_category_parents()
	{
		$this->db->where('offer_category_status = 1 AND offer_category_parent = 0');
		$this->db->order_by('offer_category_name');
		$query = $this->db->get('offer_category');
		
		return $query;
	}
	
	/*
	*	Retrieve all active children
	*
	*/
	public function get_all_active_category_children($offer_category_id)
	{
		$this->db->where('offer_category_status = 1 AND offer_category_parent = '.$offer_category_id);
		$this->db->order_by('offer_category_name');
		$query = $this->db->get('offer_category');
		
		return $query;
	}
	/*
	*	Retrieve all active offers
	*
	*/
	public function all_active_offers()
	{
		$this->db->where('offer_status = 1');
		$query = $this->db->get('offer');
		
		return $query;
	}

	public function get_pre_next_offer($offer_id,$item)
	{
		if($item == 'Previous')
		{
			$this->db->where('offer_status = 1 AND offer_id < '.$offer_id);
			$this->db->order_by('offer_id','DESC');
		}
		else
		{
			$this->db->where('offer_status = 1 AND offer_id > '.$offer_id);
			$this->db->order_by('offer_id','ASC');
		}
		$query = $this->db->get('offer');
		
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$offer_title = $key->offer_title;
			}
			$web_name = $this->create_web_name($offer_title);
		}
		else
		{
			$web_name = NULL;
		}
		return $web_name;
	}
	
	public function create_web_name($field_name)
	{
		$web_name = str_replace(" ", "-", $field_name);
		
		return $web_name;
	}
	
	/*
	*	Retrieve latest offer
	*
	*/
	public function latest_offer()
	{
		$this->db->limit(1);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('offer');
		
		return $query;
	}
	
	/*
	*	Retrieve all offers
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_offers($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new offer
	*	@param string $image_name
	*
	*/
	public function add_offer($image_name, $thumb_name)
	{
		$data = array(
				'offer_title'=>ucwords(strtolower($this->input->post('offer_title'))),
				'offer_status'=>$this->input->post('offer_status'),
				'offer_content'=>$this->input->post('offer_content'),
				'offer_expiry_date'=>$this->input->post('created'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('user_id'),
				'modified_by'=>$this->session->userdata('user_id'),
				'offer_thumb'=>$thumb_name,
				'offer_image'=>$image_name
			);
			
		if($this->db->insert('offer', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	function getTinyUrl($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://tinyurl.com/api-create.php?url=".$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tinyurl = curl_exec($ch);
		curl_close($ch);
		//$tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);
		return $tinyurl;
	}
	
	/*
	*	Update an existing offer
	*	@param string $image_name
	*	@param int $offer_id
	*
	*/
	public function update_offer($image_name, $thumb_name, $offer_id)
	{
		$data = array(
				'offer_title'=>ucwords(strtolower($this->input->post('offer_title'))),
				'offer_status'=>$this->input->post('offer_status'),
				'offer_content'=>$this->input->post('offer_content'),
				'offer_expiry_date'=>$this->input->post('created'),
				'modified_by'=>$this->session->userdata('user_id'),
				'offer_thumb'=>$thumb_name,
				'offer_image'=>$image_name,
			);
			
		$this->db->where('offer_id', $offer_id);
		if($this->db->update('offer', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single offer's details
	*	@param int $offer_id
	*
	*/
	public function get_offer($offer_id)
	{
		//retrieve all users
		$this->db->from('offer');
		$this->db->select('*');
		$this->db->where('offer_id = '.$offer_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing offer's comments
	*	@param int $offer_id
	*
	*/
	public function delete_offer_comments($offer_id)
	{
		if($this->db->delete('offer_comment', array('offer_id' => $offer_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Delete an existing offer
	*	@param int $offer_id
	*
	*/
	public function delete_offer($offer_id)
	{
		if($this->db->delete('offer', array('offer_id' => $offer_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated offer
	*	@param int $offer_id
	*
	*/
	public function activate_offer($offer_id)
	{
		$data = array(
				'offer_status' => 1
			);
		$this->db->where('offer_id', $offer_id);
		
		if($this->db->update('offer', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated offer
	*	@param int $offer_id
	*
	*/
	public function deactivate_offer($offer_id)
	{
		$data = array(
				'offer_status' => 0
			);
		$this->db->where('offer_id', $offer_id);
		
		if($this->db->update('offer', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Retrieve comments
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_comments($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('offer.offer_title, offer.created, offer.offer_image, offer_comment.*');
		$this->db->where($where);
		$this->db->order_by('comment_created', 'DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new comment
	*	@param int $offer_id
	*
	*/
	public function add_comment_admin($offer_id)
	{
		$data = array(
				'offer_comment_description'=>$this->input->post('offer_comment_description'),
				'comment_created'=>date('Y-m-d H:i:s'),
				'offer_comment_user'=>$this->session->userdata('first_name'),
				'offer_comment_email'=>$this->session->userdata('email'),
				'offer_id'=>$offer_id
			);
			
		if($this->db->insert('offer_comment', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Add a new comment
	*	@param int $offer_id
	*
	*/
	public function add_comment_user($offer_id)
	{
		$data = array(
				'offer_comment_description'=>$this->input->post('offer_comment_description'),
				'comment_created'=>date('Y-m-d H:i:s'),
				'offer_comment_user'=>$this->input->post('name'),
				'offer_comment_email'=>$this->input->post('email'),
				'offer_comment_status'=>0,
				'offer_id'=>$offer_id
			);
			
		if($this->db->insert('offer_comment', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function get_comment_title($offer_id)
	{
		if($offer_id > 0)
		{
			$query = $this->get_offer($offer_id);
			
			if($query->num_rows() > 0)
			{
				$row = $query->row();
				$title = $row->offer_title;
			}
			
			else
			{
				$title = '';
			}
		}
			
		else
		{
			$title = '';
		}
		
		return $title;	
	}
	
	/*
	*	Delete an existing comment
	*	@param int $offer_comment_id
	*
	*/
	public function delete_comment($offer_comment_id)
	{
		if($this->db->delete('offer_comment', array('offer_comment_id' => $offer_comment_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated comment
	*	@param int $offer_comment_id
	*
	*/
	public function activate_comment($offer_comment_id)
	{
		$data = array(
				'offer_comment_status' => 1
			);
		$this->db->where('offer_comment_id', $offer_comment_id);
		
		if($this->db->update('offer_comment', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated comment
	*	@param int $offer_comment_id
	*
	*/
	public function deactivate_comment($offer_comment_id)
	{
		$data = array(
				'offer_comment_status' => 0
			);
		$this->db->where('offer_comment_id', $offer_comment_id);
		
		if($this->db->update('offer_comment', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function update_views_count($offer_id)
	{
		//get count of views
		$this->db->where('offer_id', $offer_id);
		$query = $this->db->get('offer');
		$row = $query->row();
		$total = $row->offer_views;
		
		//increment comments
		$total++;
		
		//update
		$data = array(
				'offer_views' => $total
			);
		$this->db->where('offer_id', $offer_id);
		
		if($this->db->update('offer', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	/*
	*	Retrieve all categories
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_categories($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('offer_category_name', 'ASC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new category
	*	@param int $offer_id
	*
	*/
	public function add_offer_category()
	{
		$data = array(
				'offer_category_name'=>ucwords(strtolower($this->input->post('offer_category_name'))),
				'offer_category_status'=>$this->input->post('offer_category_status'),
				'offer_category_parent'=>$this->input->post('offer_category_parent'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('user_id'),
				'modified_by'=>$this->session->userdata('user_id')
			);
			
		if($this->db->insert('offer_category', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing category
	*	@param int $offer_category_id
	*
	*/
	public function update_offer_category($offer_category_id)
	{
		$data = array(
				'offer_category_name'=>ucwords(strtolower($this->input->post('offer_category_name'))),
				'offer_category_status'=>$this->input->post('offer_category_status'),
				'offer_category_parent'=>$this->input->post('offer_category_parent'),
				'modified_by'=>$this->session->userdata('user_id')
			);
			
		$this->db->where('offer_category_id', $offer_category_id);
		if($this->db->update('offer_category', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single category's details
	*	@param int $offer_category_id
	*
	*/
	public function get_offer_category($offer_category_id)
	{
		//retrieve all users
		$this->db->from('offer_category');
		$this->db->select('*');
		$this->db->where('offer_category_id = '.$offer_category_id);
		$query = $this->db->get();
		
		return $query;
	}

	public function check_previous_offer($offer_id)
	{
		//retrieve all users
		$this->db->from('offer');
		$this->db->select('*');
		$this->db->where('offer_status = 1 AND offer_id < '.$offer_id);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function check_offer_offer($offer_id)
	{
		//retrieve all users
		$this->db->from('offer');
		$this->db->select('*');
		$this->db->where('offer_status = 1 AND offer_id > '.$offer_id);
		$query = $this->db->get();
				
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	/*
	*	Delete an existing offer's comments by category id
	*	@param int $offer_category_id
	*
	*/
	public function delete_category_offer_comments($offer_category_id)
	{
		$this->db->where(array('offer_category_id' => $offer_category_id));
		$this->db->select('offer_id');
		$query = $this->db->get('offer');
		$row = $query->row();
		$offer_id = $row->offer_id;
		
		if($this->db->delete('offer_comment', array('offer_id' => $offer_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Delete an existing offer
	*	@param int $offer_category_id
	*
	*/
	public function delete_category_offers($offer_category_id)
	{
		if($this->db->delete('offer', array('offer_category_id' => $offer_category_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Delete an existing category
	*	@param int $offer_category_id
	*
	*/
	public function delete_offer_category($offer_category_id)
	{
		if($this->db->delete('offer_category', array('offer_category_id' => $offer_category_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated category
	*	@param int $offer_category_id
	*
	*/
	public function activate_offer_category($offer_category_id)
	{
		$data = array(
				'offer_category_status' => 1
			);
		$this->db->where('offer_category_id', $offer_category_id);
		
		if($this->db->update('offer_category', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated category
	*	@param int $offer_category_id
	*
	*/
	public function deactivate_offer_category($offer_category_id)
	{
		$data = array(
				'offer_category_status' => 0
			);
		$this->db->where('offer_category_id', $offer_category_id);
		
		if($this->db->update('offer_category', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Retrieve recent offers
	*
	*/
	public function get_recent_offers($num = 6)
	{
		$this->db->select('offer.*');
		$this->db->where('offer_status = 1');
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('offer', $num);
		
		return $query;
	}
	
	/*
	*	Retrieve popular offers
	*
	*/
	public function get_popular_offers()
	{
		$this->db->from('offer');
		$this->db->select('offer.*');
		$this->db->where('offer_status = 1');
		$this->db->order_by('offer_views', 'DESC');
		$query = $this->db->get('', 3);
		
		return $query;
	}
	
	/*
	*	Retrieve related offers
	*
	*/
	public function get_related_offers($offer_category_id, $offer_id)
	{
		$this->db->from('offer, offer_category');
		$this->db->select('offer.*');
		$this->db->where('offer.offer_id <> '.$offer_id.' AND offer.offer_status = 1 AND offer.offer_category_id = offer_category.offer_category_id AND (offer_category.offer_category_id = '.$offer_category_id.' OR offer_category.offer_category_parent = '.$offer_category_id.')');
		$this->db->order_by('offer.created', 'DESC');
		$query = $this->db->get('', 4);
		
		return $query;
	}
	
	/*
	*	Retrieve comments
	* 	@param int $offer_id
	*
	*/
	public function get_offer_comments($offer_id)
	{
		//retrieve all users
		$this->db->from('offer_comment');
		$this->db->select('offer_comment.*');
		$this->db->where('offer_comment_status = 1 AND offer_id = '.$offer_id);
		$this->db->order_by('comment_created', 'DESC');
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_offer_id($offer_title)
	{
		//retrieve all users
		$this->db->from('offer');
		$this->db->select('offer_id');
		$this->db->where('offer_title', $offer_title);
		$query = $this->db->get();
		$offer_id = FALSE;
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$offer_id = $row->offer_id;
		}
		
		return $offer_id;
	}
	
	/*
	*	Retrieve all offers per given category
	*	@param int $offer_category_id
	*	@param int $limit
	*
	*/
	public function get_category_offers($offer_category_id, $limit = NULL)
	{
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		$this->db->from('offer');
		$this->db->select('offer.*');
		$this->db->where('offer.offer_status = 1 AND offer.offer_category_id = '.$offer_category_id);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get();
		
		return $query;
	}
}
?>