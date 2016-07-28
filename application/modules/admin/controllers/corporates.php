<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Corporates extends admin {
	var $corporates_path;
	var $corporates_location;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('users_model');
		$this->load->model('corporates_model');
		$this->load->model('file_model');
		$this->load->library('image_lib');
		
		//path to image directory
		$this->corporates_path = realpath(APPPATH . '../assets/corporates');
		$this->corporates_location = base_url().'assets/corporates/';
	}
    
	/*
	*
	*	Default action is to show all the registered corporates
	*
	*/
	public function index() 
	{
		$where = 'corporates.corporates_id > 0';
		$table = 'corporates';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'content/corporates';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 5;
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
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $v_data["links"] = $this->pagination->create_links();
		$query = $this->corporates_model->get_all_corporates($table, $where, $config["per_page"], $page);
		
		$data['title'] = $v_data['title'] = 'corporates';
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$v_data['corporates_location'] = $this->corporates_location;
			$data['content'] = $this->load->view('corporates/all_corporates', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'administration/add-corporate" class="btn btn-success pull-right">Add corporate</a>There are no corporates';
		}
		
		$this->load->view('templates/general_page', $data);
	}
	
	function add_corporate()
	{
		$v_data['corporates_location'] = 'http://placehold.it/300x300';
		
		$this->session->unset_userdata('corporates_error_message');
		
		//upload image if it has been selected
		$response = $this->corporates_model->upload_corporates_image($this->corporates_path);
		if($response)
		{
			$v_data['corporates_location'] = $this->corporates_location.$this->session->userdata('corporates_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['corporates_error'] = $this->session->userdata('corporates_error_message');
		}
		
		$corporates_error = $this->session->userdata('corporates_error_message');
		
		$this->form_validation->set_rules('check', 'check', 'trim|xss_clean');
		$this->form_validation->set_rules('corporates_name', 'Title', 'required|xss_clean');
		$this->form_validation->set_rules('corporates_description', 'Description', 'trim|xss_clean');
		$this->form_validation->set_rules('corporates_button_text', 'Button Text', 'trim|xss_clean');
		$this->form_validation->set_rules('corporates_link', 'Link', 'trim|xss_clean');

		if ($this->form_validation->run())
		{	
			if(empty($corporates_error))
			{
				$data2 = array(
					'corporates_name'=>$this->input->post("corporates_name"),
					'corporates_description'=>$this->input->post("corporates_description"),
					'corporates_image_name'=>$this->session->userdata('corporates_file_name'),
					'corporates_button_text'=>$this->input->post("corporates_button_text"),
					'corporates_link'=>$this->session->userdata('corporates_link')
				);
				
				$table = "corporates";
				$this->db->insert($table, $data2);
				$this->session->unset_userdata('corporates_file_name');
				$this->session->unset_userdata('corporates_thumb_name');
				$this->session->unset_userdata('corporates_error_message');
				$this->session->set_userdata('success_message', 'corporate has been added');
				
				redirect('corporates');
			}
		}
		
		$table = "corporates";
		$where = "corporates_id > 0";
		
		$this->db->where($where);
		$v_data['corporates'] = $this->db->get($table);
		
		$corporates = $this->session->userdata('corporates_file_name');
		
		if(!empty($corporates))
		{
			$v_data['corporates_location'] = $this->corporates_location.$this->session->userdata('corporates_file_name');
		}
		$v_data['error'] = $corporates_error;
		$data['title'] = $v_data['title'] = 'Add corporate';
		
		$data['content'] = $this->load->view("corporates/add_corporate", $v_data, TRUE);
		
		$this->load->view('templates/general_page', $data);
	}
	
	function edit_corporate($corporates_id, $page)
	{
		//get corporates data
		$table = "corporates";
		$where = "corporates_id = ".$corporates_id;
		
		$this->db->where($where);
		$corporates_query = $this->db->get($table);
		$corporate_row = $corporates_query->row();
		$v_data['corporate_row'] = $corporate_row;
		$v_data['corporates_location'] = $this->corporates_location.$corporate_row->corporates_image_name;
		
		$this->session->unset_userdata('corporates_error_message');
		
		//upload image if it has been selected
		$response = $this->corporates_model->upload_corporates_image($this->corporates_path, $edit = $corporate_row->corporates_image_name);
		if($response)
		{
			$v_data['corporates_location'] = $this->corporates_location.$this->session->userdata('corporates_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['corporates_error'] = $this->session->userdata('corporates_error_message');
		}
		
		$corporates_error = $this->session->userdata('corporates_error_message');
		
		$this->form_validation->set_rules('check', 'check', 'trim|xss_clean');
		$this->form_validation->set_rules('corporates_name', 'Title', 'required|xss_clean');
		$this->form_validation->set_rules('corporates_description', 'Description', 'trim|xss_clean');
		$this->form_validation->set_rules('corporates_button_text', 'Button Text', 'trim|xss_clean');
		$this->form_validation->set_rules('corporates_link', 'Link', 'trim|xss_clean');

		if ($this->form_validation->run())
		{	
			if(empty($corporates_error))
			{
		
				$corporates = $this->session->userdata('corporates_file_name');
				
				if($corporates == FALSE)
				{
					$corporates = $corporate_row->corporates_image_name;
				}
				$data2 = array(
					'corporates_name'=>$this->input->post("corporates_name"),
					'corporates_description'=>$this->input->post("corporates_description"),
					'corporates_image_name'=>$corporates,
					'corporates_button_text'=>$this->input->post("corporates_button_text"),
					'corporates_link'=>$this->session->userdata('corporates_link')
				);
				
				$table = "corporates";
				$this->db->where('corporates_id', $corporates_id);
				$this->db->update($table, $data2);
				$this->session->unset_userdata('corporates_file_name');
				$this->session->unset_userdata('corporates_thumb_name');
				$this->session->unset_userdata('corporates_error_message');
				$this->session->set_userdata('success_message', 'corporate has been edited');
				
				redirect('corporates/'.$page);
			}
		}
		
		$corporates = $this->session->userdata('corporates_file_name');
		
		if(!empty($corporates))
		{
			$v_data['corporates_location'] = $this->corporates_location.$this->session->userdata('corporates_file_name');
		}
		$v_data['error'] = $corporates_error;
		
		$data['title'] = $v_data['title'] = 'Edit corporate';
		$data['content'] = $this->load->view("corporates/edit_corporate", $v_data, TRUE);
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing corporates
	*	@param int $corporates_id
	*
	*/
	function delete_corporate($corporates_id, $page)
	{
		//get corporates data
		$table = "corporates";
		$where = "corporates_id = ".$corporates_id;
		
		$this->db->where($where);
		$corporates_query = $this->db->get($table);
		$corporate_row = $corporates_query->row();
		$corporates_path = $this->corporates_path;
		
		$image_name = $corporate_row->corporates_image_name;
		
		//delete any other uploaded image
		$this->file_model->delete_file($corporates_path."\\".$image_name, $this->corporates_path);
		
		//delete any other uploaded thumbnail
		$this->file_model->delete_file($corporates_path."\\thumbnail_".$image_name, $this->corporates_path);
		
		if($this->corporates_model->delete_corporates($corporates_id))
		{
			$this->session->set_userdata('success_message', 'corporate has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'corporate could not be deleted');
		}
		redirect('corporates/'.$page);
	}
    
	/*
	*
	*	Activate an existing corporates
	*	@param int $corporates_id
	*
	*/
	public function activate_corporate($corporates_id, $page)
	{
		if($this->corporates_model->activate_corporates($corporates_id))
		{
			$this->session->set_userdata('success_message', 'corporate has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'corporate could not be activated');
		}
		redirect('corporates/'.$page);
	}
    
	/*
	*
	*	Deactivate an existing corporates
	*	@param int $corporates_id
	*
	*/
	public function deactivate_corporate($corporates_id, $page)
	{
		if($this->corporates_model->deactivate_corporates($corporates_id))
		{
			$this->session->set_userdata('success_message', 'corporate has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'corporate could not be disabled');
		}
		redirect('corporates/'.$page);
	}
}
?>