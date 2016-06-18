<?php

class Notification_model extends CI_Model 
{	
	/*
	*	Retrieve all active categories
	*
	*/
	public function get_all_active_categories($limit = NULL, $order = 'notification_category_name', $order_method = 'ASC', $where ='notification_category_status = 1' )
	{
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get('notification_category');
		
		return $query;
	}
	
	public function get_all_notification_categories($notification_category_id)
	{
		$this->db->where('notification_category.notification_category_id = '.$notification_category_id.' OR notification_category.notification_category_parent = '.$notification_category_id);
		$this->db->order_by('notification_category_parent, notification_category_name');
		$query = $this->db->get('notification_category');
		
		return $query;
	}
	
	public function count_notifications($notification_category_id)
	{
		$this->db->where('notification_category.notification_category_id = notification.notification_category_id AND notification_category.notification_category_id = '.$notification_category_id.' OR notification_category.notification_category_parent = '.$notification_category_id);
		$total = $this->db->count_all_results('notification_category, notification');
		
		return $total;
	}
	
	/*
	*	Retrieve all active categories
	*
	*/
	public function get_all_active_category_parents()
	{
		$this->db->where('notification_category_status = 1 AND notification_category_parent = 0');
		$this->db->order_by('notification_category_name');
		$query = $this->db->get('notification_category');
		
		return $query;
	}
	
	/*
	*	Retrieve all active children
	*
	*/
	public function get_all_active_category_children($notification_category_id)
	{
		$this->db->where('notification_category_status = 1 AND notification_category_parent = '.$notification_category_id);
		$this->db->order_by('notification_category_name');
		$query = $this->db->get('notification_category');
		
		return $query;
	}
	/*
	*	Retrieve all active notifications
	*
	*/
	public function all_active_notifications()
	{
		$this->db->where('notification_status = 1');
		$query = $this->db->get('notification');
		
		return $query;
	}

	public function get_pre_next_notification($notification_id,$item)
	{
		if($item == 'Previous')
		{
			$this->db->where('notification_status = 1 AND notification_id < '.$notification_id);
			$this->db->order_by('notification_id','DESC');
		}
		else
		{
			$this->db->where('notification_status = 1 AND notification_id > '.$notification_id);
			$this->db->order_by('notification_id','ASC');
		}
		$query = $this->db->get('notification');
		
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$notification_title = $key->notification_title;
			}
			$web_name = $this->create_web_name($notification_title);
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
	*	Retrieve latest notification
	*
	*/
	public function latest_notification()
	{
		$this->db->limit(1);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('notification');
		
		return $query;
	}
	
	/*
	*	Retrieve all notifications
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_notifications($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new notification
	*	@param string $image_name
	*
	*/
	public function add_notification($image_name, $thumb_name)
	{
		$data = array(
				'notification_title'=>ucwords(strtolower($this->input->post('notification_title'))),
				'notification_status'=>$this->input->post('notification_status'),
				'notification_content'=>$this->input->post('notification_content'),
				'created'=>$this->input->post('created'),
				'created_by'=>$this->session->userdata('user_id'),
				'modified_by'=>$this->session->userdata('user_id'),
				'notification_thumb'=>$thumb_name,
				'notification_image'=>$image_name
			);
			
		if($this->db->insert('notification', $data))
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
	*	Update an existing notification
	*	@param string $image_name
	*	@param int $notification_id
	*
	*/
	public function update_notification($image_name, $thumb_name, $notification_id)
	{
		$data = array(
				'notification_title'=>ucwords(strtolower($this->input->post('notification_title'))),
				'notification_status'=>$this->input->post('notification_status'),
				'notification_content'=>$this->input->post('notification_content'),
				'created'=>$this->input->post('created'),
				'modified_by'=>$this->session->userdata('user_id'),
				'notification_thumb'=>$thumb_name,
				'notification_image'=>$image_name,
			);
			
		$this->db->where('notification_id', $notification_id);
		if($this->db->update('notification', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single notification's details
	*	@param int $notification_id
	*
	*/
	public function get_notification($notification_id)
	{
		//retrieve all users
		$this->db->from('notification');
		$this->db->select('*');
		$this->db->where('notification_id = '.$notification_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing notification's comments
	*	@param int $notification_id
	*
	*/
	public function delete_notification_comments($notification_id)
	{
		if($this->db->delete('notification_comment', array('notification_id' => $notification_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Delete an existing notification
	*	@param int $notification_id
	*
	*/
	public function delete_notification($notification_id)
	{
		if($this->db->delete('notification', array('notification_id' => $notification_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated notification
	*	@param int $notification_id
	*
	*/
	public function activate_notification($notification_id)
	{
		$data = array(
				'notification_status' => 1
			);
		$this->db->where('notification_id', $notification_id);
		
		if($this->db->update('notification', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated notification
	*	@param int $notification_id
	*
	*/
	public function deactivate_notification($notification_id)
	{
		$data = array(
				'notification_status' => 0
			);
		$this->db->where('notification_id', $notification_id);
		
		if($this->db->update('notification', $data))
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
		$this->db->select('notification.notification_title, notification.created, notification.notification_image, notification_comment.*');
		$this->db->where($where);
		$this->db->order_by('comment_created', 'DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new comment
	*	@param int $notification_id
	*
	*/
	public function add_comment_admin($notification_id)
	{
		$data = array(
				'notification_comment_description'=>$this->input->post('notification_comment_description'),
				'comment_created'=>date('Y-m-d H:i:s'),
				'notification_comment_user'=>$this->session->userdata('first_name'),
				'notification_comment_email'=>$this->session->userdata('email'),
				'notification_id'=>$notification_id
			);
			
		if($this->db->insert('notification_comment', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Add a new comment
	*	@param int $notification_id
	*
	*/
	public function add_comment_user($notification_id)
	{
		$data = array(
				'notification_comment_description'=>$this->input->post('notification_comment_description'),
				'comment_created'=>date('Y-m-d H:i:s'),
				'notification_comment_user'=>$this->input->post('name'),
				'notification_comment_email'=>$this->input->post('email'),
				'notification_comment_status'=>0,
				'notification_id'=>$notification_id
			);
			
		if($this->db->insert('notification_comment', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function get_comment_title($notification_id)
	{
		if($notification_id > 0)
		{
			$query = $this->get_notification($notification_id);
			
			if($query->num_rows() > 0)
			{
				$row = $query->row();
				$title = $row->notification_title;
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
	*	@param int $notification_comment_id
	*
	*/
	public function delete_comment($notification_comment_id)
	{
		if($this->db->delete('notification_comment', array('notification_comment_id' => $notification_comment_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated comment
	*	@param int $notification_comment_id
	*
	*/
	public function activate_comment($notification_comment_id)
	{
		$data = array(
				'notification_comment_status' => 1
			);
		$this->db->where('notification_comment_id', $notification_comment_id);
		
		if($this->db->update('notification_comment', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated comment
	*	@param int $notification_comment_id
	*
	*/
	public function deactivate_comment($notification_comment_id)
	{
		$data = array(
				'notification_comment_status' => 0
			);
		$this->db->where('notification_comment_id', $notification_comment_id);
		
		if($this->db->update('notification_comment', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function update_views_count($notification_id)
	{
		//get count of views
		$this->db->where('notification_id', $notification_id);
		$query = $this->db->get('notification');
		$row = $query->row();
		$total = $row->notification_views;
		
		//increment comments
		$total++;
		
		//update
		$data = array(
				'notification_views' => $total
			);
		$this->db->where('notification_id', $notification_id);
		
		if($this->db->update('notification', $data))
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
		$this->db->order_by('notification_category_name', 'ASC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new category
	*	@param int $notification_id
	*
	*/
	public function add_notification_category()
	{
		$data = array(
				'notification_category_name'=>ucwords(strtolower($this->input->post('notification_category_name'))),
				'notification_category_status'=>$this->input->post('notification_category_status'),
				'notification_category_parent'=>$this->input->post('notification_category_parent'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('user_id'),
				'modified_by'=>$this->session->userdata('user_id')
			);
			
		if($this->db->insert('notification_category', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing category
	*	@param int $notification_category_id
	*
	*/
	public function update_notification_category($notification_category_id)
	{
		$data = array(
				'notification_category_name'=>ucwords(strtolower($this->input->post('notification_category_name'))),
				'notification_category_status'=>$this->input->post('notification_category_status'),
				'notification_category_parent'=>$this->input->post('notification_category_parent'),
				'modified_by'=>$this->session->userdata('user_id')
			);
			
		$this->db->where('notification_category_id', $notification_category_id);
		if($this->db->update('notification_category', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single category's details
	*	@param int $notification_category_id
	*
	*/
	public function get_notification_category($notification_category_id)
	{
		//retrieve all users
		$this->db->from('notification_category');
		$this->db->select('*');
		$this->db->where('notification_category_id = '.$notification_category_id);
		$query = $this->db->get();
		
		return $query;
	}

	public function check_previous_notification($notification_id)
	{
		//retrieve all users
		$this->db->from('notification');
		$this->db->select('*');
		$this->db->where('notification_status = 1 AND notification_id < '.$notification_id);
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
	public function check_notification_notification($notification_id)
	{
		//retrieve all users
		$this->db->from('notification');
		$this->db->select('*');
		$this->db->where('notification_status = 1 AND notification_id > '.$notification_id);
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
	*	Delete an existing notification's comments by category id
	*	@param int $notification_category_id
	*
	*/
	public function delete_category_notification_comments($notification_category_id)
	{
		$this->db->where(array('notification_category_id' => $notification_category_id));
		$this->db->select('notification_id');
		$query = $this->db->get('notification');
		$row = $query->row();
		$notification_id = $row->notification_id;
		
		if($this->db->delete('notification_comment', array('notification_id' => $notification_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Delete an existing notification
	*	@param int $notification_category_id
	*
	*/
	public function delete_category_notifications($notification_category_id)
	{
		if($this->db->delete('notification', array('notification_category_id' => $notification_category_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Delete an existing category
	*	@param int $notification_category_id
	*
	*/
	public function delete_notification_category($notification_category_id)
	{
		if($this->db->delete('notification_category', array('notification_category_id' => $notification_category_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated category
	*	@param int $notification_category_id
	*
	*/
	public function activate_notification_category($notification_category_id)
	{
		$data = array(
				'notification_category_status' => 1
			);
		$this->db->where('notification_category_id', $notification_category_id);
		
		if($this->db->update('notification_category', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated category
	*	@param int $notification_category_id
	*
	*/
	public function deactivate_notification_category($notification_category_id)
	{
		$data = array(
				'notification_category_status' => 0
			);
		$this->db->where('notification_category_id', $notification_category_id);
		
		if($this->db->update('notification_category', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Retrieve recent notifications
	*
	*/
	public function get_recent_notifications($num = 6)
	{
		$this->db->select('notification.*');
		$this->db->where('notification_status = 1');
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('notification', $num);
		
		return $query;
	}
	
	/*
	*	Retrieve popular notifications
	*
	*/
	public function get_popular_notifications()
	{
		$this->db->from('notification');
		$this->db->select('notification.*');
		$this->db->where('notification_status = 1');
		$this->db->order_by('notification_views', 'DESC');
		$query = $this->db->get('', 3);
		
		return $query;
	}
	
	/*
	*	Retrieve related notifications
	*
	*/
	public function get_related_notifications($notification_category_id, $notification_id)
	{
		$this->db->from('notification, notification_category');
		$this->db->select('notification.*');
		$this->db->where('notification.notification_id <> '.$notification_id.' AND notification.notification_status = 1 AND notification.notification_category_id = notification_category.notification_category_id AND (notification_category.notification_category_id = '.$notification_category_id.' OR notification_category.notification_category_parent = '.$notification_category_id.')');
		$this->db->order_by('notification.created', 'DESC');
		$query = $this->db->get('', 4);
		
		return $query;
	}
	
	/*
	*	Retrieve comments
	* 	@param int $notification_id
	*
	*/
	public function get_notification_comments($notification_id)
	{
		//retrieve all users
		$this->db->from('notification_comment');
		$this->db->select('notification_comment.*');
		$this->db->where('notification_comment_status = 1 AND notification_id = '.$notification_id);
		$this->db->order_by('comment_created', 'DESC');
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_notification_id($notification_title)
	{
		//retrieve all users
		$this->db->from('notification');
		$this->db->select('notification_id');
		$this->db->where('notification_title', $notification_title);
		$query = $this->db->get();
		$notification_id = FALSE;
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$notification_id = $row->notification_id;
		}
		
		return $notification_id;
	}
	
	/*
	*	Retrieve all notifications per given category
	*	@param int $notification_category_id
	*	@param int $limit
	*
	*/
	public function get_category_notifications($notification_category_id, $limit = NULL)
	{
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		$this->db->from('notification');
		$this->db->select('notification.*');
		$this->db->where('notification.notification_status = 1 AND notification.notification_category_id = '.$notification_category_id);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get();
		
		return $query;
	}
}
?>