<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Notification extends admin {
	var $notifications_path;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('users_model');
		$this->load->model('notification_model');
		$this->load->model('file_model');
		
		$this->load->library('image_lib');
		
		//path to image directory
		$this->notifications_path = realpath(APPPATH . '../assets/images/notifications');
	}
    
	/*
	*
	*	Default action is to show all the notifications
	*
	*/
	public function index() 
	{
		$where = 'notification.notification_id > 0';
		$table = 'notification';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'notifications';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = 3;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->notification_model->get_all_notifications($table, $where, $config["per_page"], $page);
		
		$data['title'] = $v_data['title'] = 'All notifications';
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('notification/all_notifications', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-notification" class="btn btn-success pull-right">Add notification</a>There are no notifications';
		}
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Add a new notification
	*
	*/
	public function add_notification() 
	{
		//form validation rules
		$this->form_validation->set_rules('created', 'Notification Date', 'required|xss_clean');
		$this->form_validation->set_rules('notification_title', 'Notification Name', 'required|xss_clean');
		$this->form_validation->set_rules('notification_status', 'Notification Status', 'required|xss_clean');
		$this->form_validation->set_rules('notification_content', 'Notification Description', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//upload product's gallery images
			$resize['width'] = 600;
			$resize['height'] = 800;
			
			if(is_uploaded_file($_FILES['notification_image']['tmp_name']))
			{
				$notifications_path = $this->notifications_path;
				/*
					-----------------------------------------------------------------------------------------
					Upload image
					-----------------------------------------------------------------------------------------
				*/
				$response = $this->file_model->upload_file($notifications_path, 'notification_image', $resize);
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
				}
			
				else
				{
					$this->session->set_userdata('error_message', $response['error']);
				}
			}
			
			else{
				$file_name = '';
				$thumb_name = '';
			}
			
			if(isset($file_name) && isset($thumb_name))
			{
				if($this->notification_model->add_notification($file_name, $thumb_name))
				{
					$this->session->set_userdata('success_message', 'Notification added successfully');
					redirect('notifications');
				}
				
				else
				{
					$this->session->set_userdata('error_message', 'Could not add notification. Please try again');
				}
			}
		}
		
		//open the add new notification
		$data['title'] = $v_data['title'] = 'Add New notification';
		$data['content'] = $this->load->view('notification/add_notification', $v_data, true);
		$this->load->view('templates/general_page', $data);
	}
	
	/*
	*
	*	Edit an existing notification
	*	@param int $notification_id
	*
	*/
	public function edit_notification($notification_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('created', 'Notification Date', 'required|xss_clean');
		$this->form_validation->set_rules('notification_title', 'Notification Name', 'required|xss_clean');
		$this->form_validation->set_rules('notification_status', 'Notification Status', 'required|xss_clean');
		$this->form_validation->set_rules('notification_content', 'Notification Name', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//upload product's gallery images
			$resize['width'] = 600;
			$resize['height'] = 800;
			
			if(is_uploaded_file($_FILES['notification_image']['tmp_name']))
			{
				$notifications_path = $this->notifications_path;
				
				//delete original image
				$this->file_model->delete_file($notifications_path."\\".$this->input->post('current_image'), $notifications_path);
				
				//delete original thumbnail
				$this->file_model->delete_file($notifications_path."\\thumbnail_".$this->input->post('current_image'), $notifications_path);
				/*
				/*
					-----------------------------------------------------------------------------------------
					Upload image
					-----------------------------------------------------------------------------------------
				*/
				$response = $this->file_model->upload_file($notifications_path, 'notification_image', $resize);
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
				}
			
				else
				{
					$this->session->set_userdata('error_message', $response['error']);
					
					$data['title'] = $v_data['title'] = 'Edit notification';
					$query = $this->notification_model->get_notification($notification_id);
					if ($query->num_rows() > 0)
					{
						$v_data['notification'] = $query->result();
						$data['content'] = $this->load->view('notification/edit_notification', $v_data, true);
					}
					
					else
					{
						$data['content'] = 'notification does not exist';
					}
					
					$this->load->view('templates/general_page', $data);
					break;
				}
			}
			
			else{
				$file_name = $this->input->post('current_image');
				$thumb_name = 'thumbnail_'.$this->input->post('current_image');
			}
			//update notification
			if($this->notification_model->update_notification($file_name, $thumb_name, $notification_id))
			{
				$this->session->set_userdata('success_message', 'Notification updated successfully');
				redirect('notifications');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update notification. Please try again');
			}
		}
		
		//open the add new notification
		$data['title'] = $v_data['title'] = 'Edit Notification';
		
		//select the notification from the database
		$query = $this->notification_model->get_notification($notification_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['notification'] = $query->result();
			
			$data['content'] = $this->load->view('notification/edit_notification', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'notification does not exist';
		}
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing notification
	*	@param int $notification_id
	*
	*/
	public function delete_notification($notification_id)
	{
		//delete notification image
		$query = $this->notification_model->get_notification($notification_id);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			$image = $result[0]->notification_image;
			
			$this->load->model('file_model');
			//delete image
			$this->file_model->delete_file($this->notifications_path."\\".$image, $this->notifications_path);
			//delete thumbnail
			$this->file_model->delete_file($this->notifications_path."\\thumbnail_".$image, $this->notifications_path);
		}
		//delete notifications of that category
		$this->notification_model->delete_notification_comments($notification_id);
		$this->notification_model->delete_notification($notification_id);
		$this->session->set_userdata('success_message', 'Notification has been deleted');
		redirect('notifications');
	}
    
	/*
	*
	*	Activate an existing notification
	*	@param int $notification_id
	*
	*/
	public function activate_notification($notification_id)
	{
		$this->notification_model->activate_notification($notification_id);
		$this->session->set_userdata('success_message', 'Notification activated successfully');
		redirect('notifications');
	}
    
	/*
	*
	*	Deactivate an existing notification
	*	@param int $notification_id
	*
	*/
	public function deactivate_notification($notification_id)
	{
		$this->notification_model->deactivate_notification($notification_id);
		$this->session->set_userdata('success_message', 'Notification disabled successfully');
		redirect('notifications');
	}
    
	/*
	*
	*	Notification Comments
	*
	*/
	public function comments($notification_id = NULL) 
	{
		$where = 'notification.notification_id = notification_comment.notification_id';
		if($notification_id == NULL)
		{
			$segment = 3;
		}
		
		else
		{
			$where .= ' AND notification_comment.notification_id = '.$notification_id;
			$segment = 4;
		}
		$table = 'notification_comment, notification';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'notification/comments/'.$notification_id;
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->notification_model->get_comments($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$v_data['notification_id'] = $notification_id;
			$data['title'] = $v_data['title'] = $this->notification_model->get_comment_title($notification_id);
			$data['content'] = $this->load->view('notification/comments', $v_data, true);
		}
		
		else
		{
			if($notification_id != NULL)
			{
				$data['content'] = '<a href="'.site_url().'add-comment/'.$notification_id.'" class="btn btn-success pull-right">Add Comment</a>There are no comments';
			}
			
			else
			{
				$data['content'] = 'There are no comments';
			}
			$data['title'] = $v_data['title'] = 'Comments';
		}
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Add a new comment
	*
	*/
	public function add_comment($notification_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('notification_comment_description', 'Description', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{	
			if($this->notification_model->add_comment_admin($notification_id))
			{
				$this->session->set_userdata('success_message', 'Comment added successfully');
				redirect('notification/comments/'.$notification_id);
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add comment. Please try again');
			}
		}
		
		$v_data['notification_id'] = $notification_id;
		$v_data['title'] = $data['title'] = $this->notification_model->get_comment_title($notification_id);
		$data['content'] = $this->load->view('notification/add_comment', $v_data, true);
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing comment
	*	@param int $notification_comment_id
	*	@param int $notification_id
	*
	*/
	public function delete_comment($notification_comment_id, $notification_id = NULL)
	{
		$this->notification_model->delete_comment($notification_comment_id);
		$this->session->set_userdata('success_message', 'Comment has been deleted');
		redirect('notification/comments/'.$notification_id);
	}
    
	/*
	*
	*	Activate an existing comment
	*	@param int $notification_comment_id
	*	@param int $notification_id
	*
	*/
	public function activate_comment($notification_comment_id, $notification_id = NULL)
	{
		$this->notification_model->activate_comment($notification_comment_id);
		$this->session->set_userdata('success_message', 'Comment activated successfully');
		redirect('notification/comments/'.$notification_id);
	}
    
	/*
	*
	*	Deactivate an existing comment
	*	@param int $notification_comment_id
	*	@param int $notification_id
	*
	*/
	public function deactivate_comment($notification_comment_id, $notification_id = NULL)
	{
		$this->notification_model->deactivate_comment($notification_comment_id);
		$this->session->set_userdata('success_message', 'Comment disabled successfully');
		redirect('notification/comments/'.$notification_id);
	}
    
	/*
	*
	*	Blog Categories
	*
	*/
	public function categories() 
	{
		$where = 'notification_category_id > 0';
		$table = 'notification_category';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'notification/categories';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = 3;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->notification_model->get_all_categories($table, $where, $config["per_page"], $page);
		
		$data['title'] = $v_data['title'] = 'All Categories';
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$v_data['categories_query'] = $this->notification_model->get_all_active_categories();
			$data['content'] = $this->load->view('notification/all_categories', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-notification-category" class="btn btn-success pull-right">Add Category</a>There are no categories';
		}
		
		$this->load->view('templates/general_page', $data);
	}
	
	public function add_notification_category()
	{
		//form validation rules
		$this->form_validation->set_rules('notification_category_parent', 'Parent Category', 'required|xss_clean');
		$this->form_validation->set_rules('notification_category_name', 'Category Name', 'required|xss_clean');
		$this->form_validation->set_rules('notification_category_status', 'Category Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{	
			if($this->notification_model->add_notification_category())
			{
				$this->session->set_userdata('success_message', 'Category added successfully');
				redirect('notification/categories');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add category. Please try again');
			}
		}
		
		//open the add new notification
		$data['title'] = $v_data['title'] = 'Add Category';
		$categories_query = $this->notification_model->get_all_active_categories();
		$categories = '<select class="form-control" name="notification_category_parent"><option value="0">No Parent</option>';
		if($categories_query->num_rows > 0)
		{
			
			foreach($categories_query->result() as $res)
			{
				$categories .= '<option value="'.$res->notification_category_id.'">'.$res->notification_category_name.'</option>';
			}
		}
		$categories .= '</select>';
		
		$v_data['categories'] = $categories;
		$data['content'] = $this->load->view('notification/add_category', $v_data, true);
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Edit an existing notification category
	*	@param int $notification_category_id
	*
	*/
	public function edit_notification_category($notification_category_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('notification_category_parent', 'Parent Category', 'required|xss_clean');
		$this->form_validation->set_rules('notification_category_name', 'Category Name', 'required|xss_clean');
		$this->form_validation->set_rules('notification_category_status', 'Category Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//update notification
			if($this->notification_model->update_notification_category($notification_category_id))
			{
				$this->session->set_userdata('success_message', 'Category updated successfully');
				redirect('notification/categories');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update category. Please try again');
			}
		}
		
		//open the add new notification
		$data['title'] = $v_data['title'] = 'Edit Category';
		
		//select the notification from the database
		$query = $this->notification_model->get_notification_category($notification_category_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['category'] = $query->result();
			$categories_query = $this->notification_model->get_all_active_categories();
			$categories = '<select class="form-control" name="notification_category_parent"><option value="0">No Parent</option>';
			if($categories_query->num_rows > 0)
			{
				
				foreach($categories_query->result() as $res)
				{
					if($v_data['category'][0]->notification_category_parent == $res->notification_category_id)
					{
						$categories .= '<option value="'.$res->notification_category_id.'" selected="selected">'.$res->notification_category_name.'</option>';
					}
					
					else
					{
						$categories .= '<option value="'.$res->notification_category_id.'">'.$res->notification_category_name.'</option>';
					}
				}
			}
			$categories .= '</select>';
			
			$v_data['categories'] = $categories;
			
			$data['content'] = $this->load->view('notification/edit_notification_category', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'notification does not exist';
		}
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing category
	*	@param int $notification_category_id
	*
	*/
	public function delete_notification_category($notification_category_id)
	{
		//delete notifications of that category
		$this->notification_model->delete_category_notification_comments($notification_category_id);
		$this->notification_model->delete_category_notifications($notification_category_id);
		$this->notification_model->delete_notification_category($notification_category_id);
		$this->session->set_userdata('success_message', 'Category has been deleted');
		redirect('notification/categories');
	}
    
	/*
	*
	*	Activate an existing category
	*	@param int $notification_category_id
	*
	*/
	public function activate_notification_category($notification_category_id)
	{
		$this->notification_model->activate_notification_category($notification_category_id);
		$this->session->set_userdata('success_message', 'Category activated successfully');
		redirect('notification/categories');
	}
    
	/*
	*
	*	Deactivate an existing category
	*	@param int $notification_category_id
	*
	*/
	public function deactivate_notification_category($notification_category_id)
	{
		$this->notification_model->deactivate_notification_category($notification_category_id);
		$this->session->set_userdata('success_message', 'Category disabled successfully');
		redirect('notification/categories');
	}
}
?>