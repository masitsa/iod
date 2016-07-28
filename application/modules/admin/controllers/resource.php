<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Resource extends admin {
	var $resource_path;
	var $resource_location;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('users_model');
		$this->load->model('resource_model');
		$this->load->model('file_model');
		$this->load->library('image_lib');
		
		//path to image directory
		$this->resource_path = realpath(APPPATH . '../assets/resource');
		$this->resource_location = base_url().'assets/resource/';
	}
    
	/*
	*
	*	Default action is to show all the registered resource
	*
	*/
	public function index() 
	{
		$where = 'resource.resource_category_id = resource_category.resource_category_id';
		$table = 'resource, resource_category';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'resource';
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
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $v_data["links"] = $this->pagination->create_links();
		$query = $this->resource_model->get_all_resource($table, $where, $config["per_page"], $page);
		
		$data['title'] = $v_data['title'] = 'resource';
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$v_data['resource_location'] = $this->resource_location;
			$data['content'] = $this->load->view('resource/all_resource', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'administration/add-resource" class="btn btn-success pull-right">Add resource</a>There are no resource';
		}
		
		$this->load->view('templates/general_page', $data);
	}
	
	function add_resource()
	{
		$this->form_validation->set_rules('resource_name', 'Title', 'required|xss_clean');
		$this->form_validation->set_rules('resource_category_id', 'Category', 'required|xss_clean');

		if ($this->form_validation->run())
		{	
			$resize['width'] = 800;
			$resize['height'] = 600;
			$response = $this->file_model->upload_resource($this->resource_path, $resize);
			$this->session->set_userdata('success_message', 'resource has been added');
			
			redirect('resource');
		}
		
		$table = "resource_category";
		$this->db->order_by("resource_category_name", "ASC");
		$v_data['resource_categories'] = $this->db->get($table);
		
		$data['title'] = $v_data['title'] = 'Add resource';
		
		$data['content'] = $this->load->view("resource/add_resource", $v_data, TRUE);
		
		$this->load->view('templates/general_page', $data);
	}
	
	function edit_resource($resource_id, $page)
	{
		//get resource data
		$table = "resource";
		$where = "resource_id = ".$resource_id;
		
		$this->db->where($where);
		$resource_query = $this->db->get($table);
		$resource_row = $resource_query->row();
		$v_data['resource_row'] = $resource_row;
		
		$this->form_validation->set_rules('resource_name', 'Title', 'required|xss_clean');
		$this->form_validation->set_rules('resource_category_id', 'Category', 'required|xss_clean');

		if ($this->form_validation->run())
		{
			$resize['width'] = 800;
			$resize['height'] = 600;
			$response = $this->file_model->upload_resource($this->resource_path, $resize, $resource_id);
			$this->session->set_userdata('success_message', 'resource has been added');
			
			redirect('resource/'.$page);
		}
		
		$table = "resource_category";
		$this->db->order_by("resource_category_name", "ASC");
		$v_data['resource_categories'] = $this->db->get($table);
		
		$data['title'] = $v_data['title'] = 'Edit resource';
		$data['content'] = $this->load->view("resource/edit_resource", $v_data, TRUE);
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing resource
	*	@param int $resource_id
	*
	*/
	function delete_resource($resource_id, $page)
	{
		//get resource data
		$table = "resource";
		$where = "resource_id = ".$resource_id;
		
		$this->db->where($where);
		$resource_query = $this->db->get($table);
		$resource_row = $resource_query->row();
		$resource_path = $this->resource_path;
		
		$image_name = $resource_row->resource_image_name;
		
		//delete any other uploaded image
		$this->file_model->delete_file($resource_path."\\".$image_name, $this->resource_path);
		
		//delete any other uploaded thumbnail
		$this->file_model->delete_file($resource_path."\\thumbnail_".$image_name, $this->resource_path);
		
		if($this->resource_model->delete_resource($resource_id))
		{
			$this->session->set_userdata('success_message', 'resource has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'resource could not be deleted');
		}
		redirect('resource/'.$page);
	}
    
	/*
	*
	*	Activate an existing resource
	*	@param int $resource_id
	*
	*/
	public function activate_resource($resource_id, $page)
	{
		if($this->resource_model->activate_resource($resource_id))
		{
			$this->session->set_userdata('success_message', 'resource has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'resource could not be activated');
		}
		redirect('resource/'.$page);
	}
    
	/*
	*
	*	Deactivate an existing resource
	*	@param int $resource_id
	*
	*/
	public function deactivate_resource($resource_id, $page)
	{
		if($this->resource_model->deactivate_resource($resource_id))
		{
			$this->session->set_userdata('success_message', 'resource has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'resource could not be disabled');
		}
		redirect('resource/'.$page);
	}
}
?>