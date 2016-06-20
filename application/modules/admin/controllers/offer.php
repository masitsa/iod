<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Offer extends admin {
	var $offers_path;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('users_model');
		$this->load->model('offer_model');
		$this->load->model('file_model');
		
		$this->load->library('image_lib');
		
		//path to image directory
		$this->offers_path = realpath(APPPATH . '../assets/images/offers');
	}
    
	/*
	*
	*	Default action is to show all the offers
	*
	*/
	public function index() 
	{
		$where = 'offer.offer_id > 0';
		$table = 'offer';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'offers';
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
		$query = $this->offer_model->get_all_offers($table, $where, $config["per_page"], $page);
		
		$data['title'] = $v_data['title'] = 'All offers';
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('offer/all_offers', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-offer" class="btn btn-success pull-right">Add offer</a>There are no offers';
		}
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Add a new offer
	*
	*/
	public function add_offer() 
	{
		//form validation rules
		$this->form_validation->set_rules('created', 'Offer Date', 'required|xss_clean');
		$this->form_validation->set_rules('offer_title', 'Offer Name', 'required|xss_clean');
		$this->form_validation->set_rules('offer_status', 'Offer Status', 'required|xss_clean');
		$this->form_validation->set_rules('offer_content', 'Offer Description', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//upload product's gallery images
			$resize['width'] = 600;
			$resize['height'] = 800;
			
			if(is_uploaded_file($_FILES['offer_image']['tmp_name']))
			{
				$offers_path = $this->offers_path;
				/*
					-----------------------------------------------------------------------------------------
					Upload image
					-----------------------------------------------------------------------------------------
				*/
				$response = $this->file_model->upload_file($offers_path, 'offer_image', $resize);
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
				if($this->offer_model->add_offer($file_name, $thumb_name))
				{
					$this->session->set_userdata('success_message', 'Offer added successfully');
					redirect('offers');
				}
				
				else
				{
					$this->session->set_userdata('error_message', 'Could not add offer. Please try again');
				}
			}
		}
		
		//open the add new offer
		$data['title'] = $v_data['title'] = 'Add New offer';
		$data['content'] = $this->load->view('offer/add_offer', $v_data, true);
		$this->load->view('templates/general_page', $data);
	}
	
	/*
	*
	*	Edit an existing offer
	*	@param int $offer_id
	*
	*/
	public function edit_offer($offer_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('created', 'Offer Date', 'required|xss_clean');
		$this->form_validation->set_rules('offer_title', 'Offer Name', 'required|xss_clean');
		$this->form_validation->set_rules('offer_status', 'Offer Status', 'required|xss_clean');
		$this->form_validation->set_rules('offer_content', 'Offer Name', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//upload product's gallery images
			$resize['width'] = 600;
			$resize['height'] = 800;
			
			if(is_uploaded_file($_FILES['offer_image']['tmp_name']))
			{
				$offers_path = $this->offers_path;
				
				//delete original image
				$this->file_model->delete_file($offers_path."\\".$this->input->post('current_image'), $offers_path);
				
				//delete original thumbnail
				$this->file_model->delete_file($offers_path."\\thumbnail_".$this->input->post('current_image'), $offers_path);
				/*
				/*
					-----------------------------------------------------------------------------------------
					Upload image
					-----------------------------------------------------------------------------------------
				*/
				$response = $this->file_model->upload_file($offers_path, 'offer_image', $resize);
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
				}
			
				else
				{
					$this->session->set_userdata('error_message', $response['error']);
					
					$data['title'] = $v_data['title'] = 'Edit offer';
					$query = $this->offer_model->get_offer($offer_id);
					if ($query->num_rows() > 0)
					{
						$v_data['offer'] = $query->result();
						$data['content'] = $this->load->view('offer/edit_offer', $v_data, true);
					}
					
					else
					{
						$data['content'] = 'offer does not exist';
					}
					
					$this->load->view('templates/general_page', $data);
					break;
				}
			}
			
			else{
				$file_name = $this->input->post('current_image');
				$thumb_name = 'thumbnail_'.$this->input->post('current_image');
			}
			//update offer
			if($this->offer_model->update_offer($file_name, $thumb_name, $offer_id))
			{
				$this->session->set_userdata('success_message', 'Offer updated successfully');
				redirect('offers');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update offer. Please try again');
			}
		}
		
		//open the add new offer
		$data['title'] = $v_data['title'] = 'Edit Offer';
		
		//select the offer from the database
		$query = $this->offer_model->get_offer($offer_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['offer'] = $query->result();
			
			$data['content'] = $this->load->view('offer/edit_offer', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'offer does not exist';
		}
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing offer
	*	@param int $offer_id
	*
	*/
	public function delete_offer($offer_id)
	{
		//delete offer image
		$query = $this->offer_model->get_offer($offer_id);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			$image = $result[0]->offer_image;
			
			$this->load->model('file_model');
			//delete image
			$this->file_model->delete_file($this->offers_path."\\".$image, $this->offers_path);
			//delete thumbnail
			$this->file_model->delete_file($this->offers_path."\\thumbnail_".$image, $this->offers_path);
		}
		//delete offers of that category
		$this->offer_model->delete_offer_comments($offer_id);
		$this->offer_model->delete_offer($offer_id);
		$this->session->set_userdata('success_message', 'Offer has been deleted');
		redirect('offers');
	}
    
	/*
	*
	*	Activate an existing offer
	*	@param int $offer_id
	*
	*/
	public function activate_offer($offer_id)
	{
		$this->offer_model->activate_offer($offer_id);
		$this->session->set_userdata('success_message', 'Offer activated successfully');
		redirect('offers');
	}
    
	/*
	*
	*	Deactivate an existing offer
	*	@param int $offer_id
	*
	*/
	public function deactivate_offer($offer_id)
	{
		$this->offer_model->deactivate_offer($offer_id);
		$this->session->set_userdata('success_message', 'Offer disabled successfully');
		redirect('offers');
	}
    
	/*
	*
	*	Offer Comments
	*
	*/
	public function comments($offer_id = NULL) 
	{
		$where = 'offer.offer_id = offer_comment.offer_id';
		if($offer_id == NULL)
		{
			$segment = 3;
		}
		
		else
		{
			$where .= ' AND offer_comment.offer_id = '.$offer_id;
			$segment = 4;
		}
		$table = 'offer_comment, offer';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'offer/comments/'.$offer_id;
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
		$query = $this->offer_model->get_comments($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$v_data['offer_id'] = $offer_id;
			$data['title'] = $v_data['title'] = $this->offer_model->get_comment_title($offer_id);
			$data['content'] = $this->load->view('offer/comments', $v_data, true);
		}
		
		else
		{
			if($offer_id != NULL)
			{
				$data['content'] = '<a href="'.site_url().'add-comment/'.$offer_id.'" class="btn btn-success pull-right">Add Comment</a>There are no comments';
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
	public function add_comment($offer_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('offer_comment_description', 'Description', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{	
			if($this->offer_model->add_comment_admin($offer_id))
			{
				$this->session->set_userdata('success_message', 'Comment added successfully');
				redirect('offer/comments/'.$offer_id);
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add comment. Please try again');
			}
		}
		
		$v_data['offer_id'] = $offer_id;
		$v_data['title'] = $data['title'] = $this->offer_model->get_comment_title($offer_id);
		$data['content'] = $this->load->view('offer/add_comment', $v_data, true);
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing comment
	*	@param int $offer_comment_id
	*	@param int $offer_id
	*
	*/
	public function delete_comment($offer_comment_id, $offer_id = NULL)
	{
		$this->offer_model->delete_comment($offer_comment_id);
		$this->session->set_userdata('success_message', 'Comment has been deleted');
		redirect('offer/comments/'.$offer_id);
	}
    
	/*
	*
	*	Activate an existing comment
	*	@param int $offer_comment_id
	*	@param int $offer_id
	*
	*/
	public function activate_comment($offer_comment_id, $offer_id = NULL)
	{
		$this->offer_model->activate_comment($offer_comment_id);
		$this->session->set_userdata('success_message', 'Comment activated successfully');
		redirect('offer/comments/'.$offer_id);
	}
    
	/*
	*
	*	Deactivate an existing comment
	*	@param int $offer_comment_id
	*	@param int $offer_id
	*
	*/
	public function deactivate_comment($offer_comment_id, $offer_id = NULL)
	{
		$this->offer_model->deactivate_comment($offer_comment_id);
		$this->session->set_userdata('success_message', 'Comment disabled successfully');
		redirect('offer/comments/'.$offer_id);
	}
    
	/*
	*
	*	Blog Categories
	*
	*/
	public function categories() 
	{
		$where = 'offer_category_id > 0';
		$table = 'offer_category';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'offer/categories';
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
		$query = $this->offer_model->get_all_categories($table, $where, $config["per_page"], $page);
		
		$data['title'] = $v_data['title'] = 'All Categories';
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$v_data['categories_query'] = $this->offer_model->get_all_active_categories();
			$data['content'] = $this->load->view('offer/all_categories', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-offer-category" class="btn btn-success pull-right">Add Category</a>There are no categories';
		}
		
		$this->load->view('templates/general_page', $data);
	}
	
	public function add_offer_category()
	{
		//form validation rules
		$this->form_validation->set_rules('offer_category_parent', 'Parent Category', 'required|xss_clean');
		$this->form_validation->set_rules('offer_category_name', 'Category Name', 'required|xss_clean');
		$this->form_validation->set_rules('offer_category_status', 'Category Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{	
			if($this->offer_model->add_offer_category())
			{
				$this->session->set_userdata('success_message', 'Category added successfully');
				redirect('offer/categories');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add category. Please try again');
			}
		}
		
		//open the add new offer
		$data['title'] = $v_data['title'] = 'Add Category';
		$categories_query = $this->offer_model->get_all_active_categories();
		$categories = '<select class="form-control" name="offer_category_parent"><option value="0">No Parent</option>';
		if($categories_query->num_rows > 0)
		{
			
			foreach($categories_query->result() as $res)
			{
				$categories .= '<option value="'.$res->offer_category_id.'">'.$res->offer_category_name.'</option>';
			}
		}
		$categories .= '</select>';
		
		$v_data['categories'] = $categories;
		$data['content'] = $this->load->view('offer/add_category', $v_data, true);
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Edit an existing offer category
	*	@param int $offer_category_id
	*
	*/
	public function edit_offer_category($offer_category_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('offer_category_parent', 'Parent Category', 'required|xss_clean');
		$this->form_validation->set_rules('offer_category_name', 'Category Name', 'required|xss_clean');
		$this->form_validation->set_rules('offer_category_status', 'Category Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//update offer
			if($this->offer_model->update_offer_category($offer_category_id))
			{
				$this->session->set_userdata('success_message', 'Category updated successfully');
				redirect('offer/categories');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update category. Please try again');
			}
		}
		
		//open the add new offer
		$data['title'] = $v_data['title'] = 'Edit Category';
		
		//select the offer from the database
		$query = $this->offer_model->get_offer_category($offer_category_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['category'] = $query->result();
			$categories_query = $this->offer_model->get_all_active_categories();
			$categories = '<select class="form-control" name="offer_category_parent"><option value="0">No Parent</option>';
			if($categories_query->num_rows > 0)
			{
				
				foreach($categories_query->result() as $res)
				{
					if($v_data['category'][0]->offer_category_parent == $res->offer_category_id)
					{
						$categories .= '<option value="'.$res->offer_category_id.'" selected="selected">'.$res->offer_category_name.'</option>';
					}
					
					else
					{
						$categories .= '<option value="'.$res->offer_category_id.'">'.$res->offer_category_name.'</option>';
					}
				}
			}
			$categories .= '</select>';
			
			$v_data['categories'] = $categories;
			
			$data['content'] = $this->load->view('offer/edit_offer_category', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'offer does not exist';
		}
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing category
	*	@param int $offer_category_id
	*
	*/
	public function delete_offer_category($offer_category_id)
	{
		//delete offers of that category
		$this->offer_model->delete_category_offer_comments($offer_category_id);
		$this->offer_model->delete_category_offers($offer_category_id);
		$this->offer_model->delete_offer_category($offer_category_id);
		$this->session->set_userdata('success_message', 'Category has been deleted');
		redirect('offer/categories');
	}
    
	/*
	*
	*	Activate an existing category
	*	@param int $offer_category_id
	*
	*/
	public function activate_offer_category($offer_category_id)
	{
		$this->offer_model->activate_offer_category($offer_category_id);
		$this->session->set_userdata('success_message', 'Category activated successfully');
		redirect('offer/categories');
	}
    
	/*
	*
	*	Deactivate an existing category
	*	@param int $offer_category_id
	*
	*/
	public function deactivate_offer_category($offer_category_id)
	{
		$this->offer_model->deactivate_offer_category($offer_category_id);
		$this->session->set_userdata('success_message', 'Category disabled successfully');
		redirect('offer/categories');
	}
}
?>