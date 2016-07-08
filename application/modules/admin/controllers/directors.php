<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class directors extends admin {
	var $directors_path;
	var $directors_location;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('users_model');
		$this->load->model('directors_model');
		$this->load->model('file_model');
		$this->load->library('image_lib');
		
		//path to image directory
		$this->directors_path = realpath(APPPATH . '../assets/directors');
		$this->directors_location = base_url().'assets/directors/';
	}
    
	/*
	*
	*	Default action is to show all the registered directors
	*
	*/
	public function index() 
	{
		$where = 'directors_id > 0';
		$table = 'directors';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'directors';
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
        $data["links"] = $this->pagination->create_links();
		$query = $this->directors_model->get_all_directors($table, $where, $config["per_page"], $page);
		
		$data['title'] = $v_data['title'] = 'directors';
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$v_data['directors_location'] = $this->directors_location;
			$data['content'] = $this->load->view('directors/all_directors', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'administration/add-director" class="btn btn-success pull-right">Add director</a>There are no directors';
		}
		
		$this->load->view('templates/general_page', $data);
	}
	
	function add_director()
	{
		$v_data['directors_location'] = 'http://placehold.it/300x300';
		
		$this->session->unset_userdata('directors_error_message');
		
		//upload image if it has been selected
		$response = $this->directors_model->upload_directors_image($this->directors_path);
		if($response)
		{
			$v_data['directors_location'] = $this->directors_location.$this->session->userdata('directors_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['directors_error'] = $this->session->userdata('directors_error_message');
		}
		
		$directors_error = $this->session->userdata('directors_error_message');
		
		$this->form_validation->set_rules('check', 'check', 'trim|xss_clean');
		$this->form_validation->set_rules('directors_name', 'Title', 'trim|xss_clean');
		$this->form_validation->set_rules('directors_description', 'Description', 'trim|xss_clean');
		$this->form_validation->set_rules('directors_button_text', 'Button Text', 'trim|xss_clean');
		$this->form_validation->set_rules('directors_link', 'Link', 'trim|xss_clean');

		if ($this->form_validation->run())
		{	
			if(empty($directors_error))
			{
				$data2 = array(
					'directors_name'=>$this->input->post("directors_name"),
					'directors_description'=>$this->input->post("directors_description"),
					'directors_image_name'=>$this->session->userdata('directors_file_name'),
					'directors_button_text'=>$this->input->post("directors_button_text"),
					'directors_link'=>$this->session->userdata('directors_link')
				);
				
				$table = "directors";
				$this->db->insert($table, $data2);
				$this->session->unset_userdata('directors_file_name');
				$this->session->unset_userdata('directors_thumb_name');
				$this->session->unset_userdata('directors_error_message');
				$this->session->set_userdata('success_message', 'director has been added');
				
				redirect('content/directors');
			}
		}
		
		$table = "directors";
		$where = "directors_id > 0";
		
		$this->db->where($where);
		$v_data['directors'] = $this->db->get($table);
		
		$directors = $this->session->userdata('directors_file_name');
		
		if(!empty($directors))
		{
			$v_data['directors_location'] = $this->directors_location.$this->session->userdata('directors_file_name');
		}
		$v_data['error'] = $directors_error;
		$data['title'] = $v_data['title'] = 'Add director';
		
		$data['content'] = $this->load->view("directors/add_director", $v_data, TRUE);
		
		$this->load->view('templates/general_page', $data);
	}
	
	function edit_director($directors_id, $page)
	{
		//get directors data
		$table = "directors";
		$where = "directors_id = ".$directors_id;
		
		$this->db->where($where);
		$directors_query = $this->db->get($table);
		$director_row = $directors_query->row();
		$v_data['director_row'] = $director_row;
		$v_data['directors_location'] = $this->directors_location.$director_row->directors_image_name;
		
		$this->session->unset_userdata('directors_error_message');
		
		//upload image if it has been selected
		$response = $this->directors_model->upload_directors_image($this->directors_path, $edit = $director_row->directors_image_name);
		if($response)
		{
			$v_data['directors_location'] = $this->directors_location.$this->session->userdata('directors_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['directors_error'] = $this->session->userdata('directors_error_message');
		}
		
		$directors_error = $this->session->userdata('directors_error_message');
		
		$this->form_validation->set_rules('check', 'check', 'trim|xss_clean');
		$this->form_validation->set_rules('directors_name', 'Title', 'trim|xss_clean');
		$this->form_validation->set_rules('directors_description', 'Description', 'trim|xss_clean');
		$this->form_validation->set_rules('directors_button_text', 'Button Text', 'trim|xss_clean');
		$this->form_validation->set_rules('directors_link', 'Link', 'trim|xss_clean');

		if ($this->form_validation->run())
		{	
			if(empty($directors_error))
			{
		
				$directors = $this->session->userdata('directors_file_name');
				
				if($directors == FALSE)
				{
					$directors = $director_row->directors_image_name;
				}
				$data2 = array(
					'directors_name'=>$this->input->post("directors_name"),
					'directors_description'=>$this->input->post("directors_description"),
					'directors_image_name'=>$directors,
					'directors_button_text'=>$this->input->post("directors_button_text"),
					'directors_link'=>$this->session->userdata('directors_link')
				);
				
				$table = "directors";
				$this->db->where('directors_id', $directors_id);
				$this->db->update($table, $data2);
				$this->session->unset_userdata('directors_file_name');
				$this->session->unset_userdata('directors_thumb_name');
				$this->session->unset_userdata('directors_error_message');
				$this->session->set_userdata('success_message', 'director has been edited');
				
				redirect('content/directors/'.$page);
			}
		}
		
		$directors = $this->session->userdata('directors_file_name');
		
		if(!empty($directors))
		{
			$v_data['directors_location'] = $this->directors_location.$this->session->userdata('directors_file_name');
		}
		$v_data['error'] = $directors_error;
		
		$data['title'] = $v_data['title'] = 'Edit director';
		$data['content'] = $this->load->view("directors/edit_director", $v_data, TRUE);
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing directors
	*	@param int $directors_id
	*
	*/
	function delete_director($directors_id, $page)
	{
		//get directors data
		$table = "directors";
		$where = "directors_id = ".$directors_id;
		
		$this->db->where($where);
		$directors_query = $this->db->get($table);
		$director_row = $directors_query->row();
		$directors_path = $this->directors_path;
		
		$image_name = $director_row->directors_image_name;
		
		//delete any other uploaded image
		$this->file_model->delete_file($directors_path."\\".$image_name, $this->directors_path);
		
		//delete any other uploaded thumbnail
		$this->file_model->delete_file($directors_path."\\thumbnail_".$image_name, $this->directors_path);
		
		if($this->directors_model->delete_directors($directors_id))
		{
			$this->session->set_userdata('success_message', 'director has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'director could not be deleted');
		}
		redirect('content/directors/'.$page);
	}
    
	/*
	*
	*	Activate an existing directors
	*	@param int $directors_id
	*
	*/
	public function activate_director($directors_id, $page)
	{
		if($this->directors_model->activate_directors($directors_id))
		{
			$this->session->set_userdata('success_message', 'director has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'director could not be activated');
		}
		redirect('content/directors/'.$page);
	}
    
	/*
	*
	*	Deactivate an existing directors
	*	@param int $directors_id
	*
	*/
	public function deactivate_director($directors_id, $page)
	{
		if($this->directors_model->deactivate_directors($directors_id))
		{
			$this->session->set_userdata('success_message', 'director has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'director could not be disabled');
		}
		redirect('content/directors/'.$page);
	}
}
?>