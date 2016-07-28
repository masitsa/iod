<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Partners extends admin {
	var $partners_path;
	var $partners_location;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('users_model');
		$this->load->model('partners_model');
		$this->load->model('file_model');
		$this->load->library('image_lib');
		
		//path to image directory
		$this->partners_path = realpath(APPPATH . '../assets/partners');
		$this->partners_location = base_url().'assets/partners/';
	}
    
	/*
	*
	*	Default action is to show all the registered partners
	*
	*/
	public function index() 
	{
		$where = 'partners.partner_type_id = partner_type.partner_type_id';
		$table = 'partners, partner_type';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'content/partners';
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
		$query = $this->partners_model->get_all_partners($table, $where, $config["per_page"], $page);
		
		$data['title'] = $v_data['title'] = 'partners';
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$v_data['partners_location'] = $this->partners_location;
			$data['content'] = $this->load->view('partners/all_partners', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'administration/add-partner" class="btn btn-success pull-right">Add partner</a>There are no partners';
		}
		
		$this->load->view('templates/general_page', $data);
	}
	
	function add_partner()
	{
		$v_data['partners_location'] = 'http://placehold.it/300x300';
		
		$this->session->unset_userdata('partners_error_message');
		
		//upload image if it has been selected
		$response = $this->partners_model->upload_partners_image($this->partners_path);
		if($response)
		{
			$v_data['partners_location'] = $this->partners_location.$this->session->userdata('partners_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['partners_error'] = $this->session->userdata('partners_error_message');
		}
		
		$partners_error = $this->session->userdata('partners_error_message');
		
		$this->form_validation->set_rules('check', 'check', 'trim|xss_clean');
		$this->form_validation->set_rules('partners_name', 'Title', 'required|xss_clean');
		$this->form_validation->set_rules('partner_type_id', 'Type', 'required|xss_clean');
		$this->form_validation->set_rules('partners_description', 'Description', 'trim|xss_clean');
		$this->form_validation->set_rules('partners_button_text', 'Button Text', 'trim|xss_clean');
		$this->form_validation->set_rules('partners_link', 'Link', 'trim|xss_clean');

		if ($this->form_validation->run())
		{	
			if(empty($partners_error))
			{
				$data2 = array(
					'partner_type_id'=>$this->input->post("partner_type_id"),
					'partners_name'=>$this->input->post("partners_name"),
					'partners_description'=>$this->input->post("partners_description"),
					'partners_image_name'=>$this->session->userdata('partners_file_name'),
					'partners_button_text'=>$this->input->post("partners_button_text"),
					'partners_link'=>$this->session->userdata('partners_link')
				);
				
				$table = "partners";
				$this->db->insert($table, $data2);
				$this->session->unset_userdata('partners_file_name');
				$this->session->unset_userdata('partners_thumb_name');
				$this->session->unset_userdata('partners_error_message');
				$this->session->set_userdata('success_message', 'partner has been added');
				
				redirect('partners');
			}
		}
		
		$table = "partners";
		$where = "partners_id > 0";
		
		$this->db->where($where);
		$v_data['partners'] = $this->db->get($table);
		
		$partners = $this->session->userdata('partners_file_name');
		
		if(!empty($partners))
		{
			$v_data['partners_location'] = $this->partners_location.$this->session->userdata('partners_file_name');
		}
		$v_data['error'] = $partners_error;
		$data['title'] = $v_data['title'] = 'Add partner';
		$v_data['partner_types'] = $this->db->get('partner_type');
		
		$data['content'] = $this->load->view("partners/add_partner", $v_data, TRUE);
		
		$this->load->view('templates/general_page', $data);
	}
	
	function edit_partner($partners_id, $page)
	{
		//get partners data
		$table = "partners";
		$where = "partners_id = ".$partners_id;
		
		$this->db->where($where);
		$partners_query = $this->db->get($table);
		$partner_row = $partners_query->row();
		$v_data['partner_row'] = $partner_row;
		$v_data['partners_location'] = $this->partners_location.$partner_row->partners_image_name;
		
		$this->session->unset_userdata('partners_error_message');
		
		//upload image if it has been selected
		$response = $this->partners_model->upload_partners_image($this->partners_path, $edit = $partner_row->partners_image_name);
		if($response)
		{
			$v_data['partners_location'] = $this->partners_location.$this->session->userdata('partners_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['partners_error'] = $this->session->userdata('partners_error_message');
		}
		
		$partners_error = $this->session->userdata('partners_error_message');
		
		$this->form_validation->set_rules('check', 'check', 'trim|xss_clean');
		$this->form_validation->set_rules('partners_name', 'Title', 'required|xss_clean');
		$this->form_validation->set_rules('partner_type_id', 'Type', 'required|xss_clean');
		$this->form_validation->set_rules('partners_description', 'Description', 'trim|xss_clean');
		$this->form_validation->set_rules('partners_button_text', 'Button Text', 'trim|xss_clean');
		$this->form_validation->set_rules('partners_link', 'Link', 'trim|xss_clean');

		if ($this->form_validation->run())
		{	
			if(empty($partners_error))
			{
		
				$partners = $this->session->userdata('partners_file_name');
				
				if($partners == FALSE)
				{
					$partners = $partner_row->partners_image_name;
				}
				$data2 = array(
					'partner_type_id'=>$this->input->post("partner_type_id"),
					'partners_name'=>$this->input->post("partners_name"),
					'partners_description'=>$this->input->post("partners_description"),
					'partners_image_name'=>$partners,
					'partners_button_text'=>$this->input->post("partners_button_text"),
					'partners_link'=>$this->session->userdata('partners_link')
				);
				
				$table = "partners";
				$this->db->where('partners_id', $partners_id);
				$this->db->update($table, $data2);
				$this->session->unset_userdata('partners_file_name');
				$this->session->unset_userdata('partners_thumb_name');
				$this->session->unset_userdata('partners_error_message');
				$this->session->set_userdata('success_message', 'partner has been edited');
				
				redirect('partners/'.$page);
			}
		}
		
		$partners = $this->session->userdata('partners_file_name');
		
		if(!empty($partners))
		{
			$v_data['partners_location'] = $this->partners_location.$this->session->userdata('partners_file_name');
		}
		$v_data['error'] = $partners_error;
		$v_data['partner_types'] = $this->db->get('partner_type');
		
		$data['title'] = $v_data['title'] = 'Edit partner';
		$data['content'] = $this->load->view("partners/edit_partner", $v_data, TRUE);
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing partners
	*	@param int $partners_id
	*
	*/
	function delete_partner($partners_id, $page)
	{
		//get partners data
		$table = "partners";
		$where = "partners_id = ".$partners_id;
		
		$this->db->where($where);
		$partners_query = $this->db->get($table);
		$partner_row = $partners_query->row();
		$partners_path = $this->partners_path;
		
		$image_name = $partner_row->partners_image_name;
		
		//delete any other uploaded image
		$this->file_model->delete_file($partners_path."\\".$image_name, $this->partners_path);
		
		//delete any other uploaded thumbnail
		$this->file_model->delete_file($partners_path."\\thumbnail_".$image_name, $this->partners_path);
		
		if($this->partners_model->delete_partners($partners_id))
		{
			$this->session->set_userdata('success_message', 'partner has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'partner could not be deleted');
		}
		redirect('partners/'.$page);
	}
    
	/*
	*
	*	Activate an existing partners
	*	@param int $partners_id
	*
	*/
	public function activate_partner($partners_id, $page)
	{
		if($this->partners_model->activate_partners($partners_id))
		{
			$this->session->set_userdata('success_message', 'partner has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'partner could not be activated');
		}
		redirect('partners/'.$page);
	}
    
	/*
	*
	*	Deactivate an existing partners
	*	@param int $partners_id
	*
	*/
	public function deactivate_partner($partners_id, $page)
	{
		if($this->partners_model->deactivate_partners($partners_id))
		{
			$this->session->set_userdata('success_message', 'partner has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'partner could not be disabled');
		}
		redirect('partners/'.$page);
	}
}
?>