<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Facilitators extends admin {
	var $facilitators_path;
	var $facilitators_location;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('users_model');
		$this->load->model('facilitators_model');
		$this->load->model('file_model');
		$this->load->library('image_lib');
		
		//path to image facilitatory
		$this->facilitators_path = realpath(APPPATH . '../assets/facilitators');
		$this->facilitators_location = base_url().'assets/facilitators/';
	}
    
	/*
	*
	*	Default action is to show all the registered facilitators
	*
	*/
	public function index() 
	{
		$where = 'facilitators_id > 0';
		$table = 'facilitators';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'content/facilitators';
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
		$query = $this->facilitators_model->get_all_facilitators($table, $where, $config["per_page"], $page);
		
		$data['title'] = $v_data['title'] = 'Facilitators';
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$v_data['facilitators_location'] = $this->facilitators_location;
			$data['content'] = $this->load->view('facilitators/all_facilitators', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'administration/add-facilitator" class="btn btn-success pull-right">Add facilitator</a>There are no facilitators';
		}
		
		$this->load->view('templates/general_page', $data);
	}
	
	function add_facilitator()
	{
		$v_data['facilitators_location'] = 'http://placehold.it/300x300';
		
		$this->session->unset_userdata('facilitators_error_message');
		
		//upload image if it has been selected
		$response = $this->facilitators_model->upload_facilitators_image($this->facilitators_path);
		if($response)
		{
			$v_data['facilitators_location'] = $this->facilitators_location.$this->session->userdata('facilitators_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['facilitators_error'] = $this->session->userdata('facilitators_error_message');
		}
		
		$facilitators_error = $this->session->userdata('facilitators_error_message');
		
		$this->form_validation->set_rules('check', 'check', 'trim|xss_clean');
		$this->form_validation->set_rules('facilitators_name', 'Title', 'trim|xss_clean');
		$this->form_validation->set_rules('facilitators_description', 'Description', 'trim|xss_clean');
		$this->form_validation->set_rules('facilitators_button_text', 'Button Text', 'trim|xss_clean');
		$this->form_validation->set_rules('facilitators_link', 'Link', 'trim|xss_clean');

		if ($this->form_validation->run())
		{	
			if(empty($facilitators_error))
			{
				$data2 = array(
					'facilitators_name'=>$this->input->post("facilitators_name"),
					'facilitators_description'=>$this->input->post("facilitators_description"),
					'facilitators_image_name'=>$this->session->userdata('facilitators_file_name'),
					'facilitators_button_text'=>$this->input->post("facilitators_button_text"),
					'facilitators_link'=>$this->session->userdata('facilitators_link')
				);
				
				$table = "facilitators";
				$this->db->insert($table, $data2);
				$this->session->unset_userdata('facilitators_file_name');
				$this->session->unset_userdata('facilitators_thumb_name');
				$this->session->unset_userdata('facilitators_error_message');
				$this->session->set_userdata('success_message', 'facilitator has been added');
				
				redirect('content/facilitators');
			}
		}
		
		$table = "facilitators";
		$where = "facilitators_id > 0";
		
		$this->db->where($where);
		$v_data['facilitators'] = $this->db->get($table);
		
		$facilitators = $this->session->userdata('facilitators_file_name');
		
		if(!empty($facilitators))
		{
			$v_data['facilitators_location'] = $this->facilitators_location.$this->session->userdata('facilitators_file_name');
		}
		$v_data['error'] = $facilitators_error;
		$data['title'] = $v_data['title'] = 'Add facilitator';
		
		$data['content'] = $this->load->view("facilitators/add_facilitator", $v_data, TRUE);
		
		$this->load->view('templates/general_page', $data);
	}
	
	function edit_facilitator($facilitators_id, $page)
	{
		//get facilitators data
		$table = "facilitators";
		$where = "facilitators_id = ".$facilitators_id;
		
		$this->db->where($where);
		$facilitators_query = $this->db->get($table);
		$facilitator_row = $facilitators_query->row();
		$v_data['facilitator_row'] = $facilitator_row;
		$v_data['facilitators_location'] = $this->facilitators_location.$facilitator_row->facilitators_image_name;
		
		$this->session->unset_userdata('facilitators_error_message');
		
		//upload image if it has been selected
		$response = $this->facilitators_model->upload_facilitators_image($this->facilitators_path, $edit = $facilitator_row->facilitators_image_name);
		if($response)
		{
			$v_data['facilitators_location'] = $this->facilitators_location.$this->session->userdata('facilitators_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['facilitators_error'] = $this->session->userdata('facilitators_error_message');
		}
		
		$facilitators_error = $this->session->userdata('facilitators_error_message');
		
		$this->form_validation->set_rules('check', 'check', 'trim|xss_clean');
		$this->form_validation->set_rules('facilitators_name', 'Title', 'trim|xss_clean');
		$this->form_validation->set_rules('facilitators_description', 'Description', 'trim|xss_clean');
		$this->form_validation->set_rules('facilitators_button_text', 'Button Text', 'trim|xss_clean');
		$this->form_validation->set_rules('facilitators_link', 'Link', 'trim|xss_clean');

		if ($this->form_validation->run())
		{	
			if(empty($facilitators_error))
			{
		
				$facilitators = $this->session->userdata('facilitators_file_name');
				
				if($facilitators == FALSE)
				{
					$facilitators = $facilitator_row->facilitators_image_name;
				}
				$data2 = array(
					'facilitators_name'=>$this->input->post("facilitators_name"),
					'facilitators_description'=>$this->input->post("facilitators_description"),
					'facilitators_image_name'=>$facilitators,
					'facilitators_button_text'=>$this->input->post("facilitators_button_text"),
					'facilitators_link'=>$this->session->userdata('facilitators_link')
				);
				
				$table = "facilitators";
				$this->db->where('facilitators_id', $facilitators_id);
				$this->db->update($table, $data2);
				$this->session->unset_userdata('facilitators_file_name');
				$this->session->unset_userdata('facilitators_thumb_name');
				$this->session->unset_userdata('facilitators_error_message');
				$this->session->set_userdata('success_message', 'facilitator has been edited');
				
				redirect('content/facilitators/'.$page);
			}
		}
		
		$facilitators = $this->session->userdata('facilitators_file_name');
		
		if(!empty($facilitators))
		{
			$v_data['facilitators_location'] = $this->facilitators_location.$this->session->userdata('facilitators_file_name');
		}
		$v_data['error'] = $facilitators_error;
		
		$data['title'] = $v_data['title'] = 'Edit facilitator';
		$data['content'] = $this->load->view("facilitators/edit_facilitator", $v_data, TRUE);
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing facilitators
	*	@param int $facilitators_id
	*
	*/
	function delete_facilitator($facilitators_id, $page)
	{
		//get facilitators data
		$table = "facilitators";
		$where = "facilitators_id = ".$facilitators_id;
		
		$this->db->where($where);
		$facilitators_query = $this->db->get($table);
		$facilitator_row = $facilitators_query->row();
		$facilitators_path = $this->facilitators_path;
		
		$image_name = $facilitator_row->facilitators_image_name;
		
		//delete any other uploaded image
		$this->file_model->delete_file($facilitators_path."\\".$image_name, $this->facilitators_path);
		
		//delete any other uploaded thumbnail
		$this->file_model->delete_file($facilitators_path."\\thumbnail_".$image_name, $this->facilitators_path);
		
		if($this->facilitators_model->delete_facilitators($facilitators_id))
		{
			$this->session->set_userdata('success_message', 'facilitator has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'facilitator could not be deleted');
		}
		redirect('content/facilitators/'.$page);
	}
    
	/*
	*
	*	Activate an existing facilitators
	*	@param int $facilitators_id
	*
	*/
	public function activate_facilitator($facilitators_id, $page)
	{
		if($this->facilitators_model->activate_facilitators($facilitators_id))
		{
			$this->session->set_userdata('success_message', 'facilitator has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'facilitator could not be activated');
		}
		redirect('content/facilitators/'.$page);
	}
    
	/*
	*
	*	Deactivate an existing facilitators
	*	@param int $facilitators_id
	*
	*/
	public function deactivate_facilitator($facilitators_id, $page)
	{
		if($this->facilitators_model->deactivate_facilitators($facilitators_id))
		{
			$this->session->set_userdata('success_message', 'facilitator has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'facilitator could not be disabled');
		}
		redirect('content/facilitators/'.$page);
	}
}
?>