<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Companies extends admin 
{
	var $csv_path;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('users_model');
		$this->load->model('companies_model');
		
		$this->csv_path = realpath(APPPATH . '../assets/csv');
	}
    
	/*
	*
	*	Default action is to show all the companies
	*
	*/
	public function index($order = 'company_name', $order_method = 'ASC') 
	{
		$where = 'company.company_id > 0';
		$table = 'company';
		//pagination
		$segment = 5;
		$this->load->library('pagination');
		$config['base_url'] = site_url().'admin/companies/'.$order.'/'.$order_method;
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
		$query = $this->companies_model->get_all_companies($table, $where, $config["per_page"], $page, $order, $order_method);
		
		//change of order method 
		if($order_method == 'DESC')
		{
			$order_method = 'ASC';
		}
		
		else
		{
			$order_method = 'DESC';
		}
		
		$data['title'] = 'Companies';
		$v_data['title'] = $data['title'];
		
		$v_data['order'] = $order;
		$v_data['order_method'] = $order_method;
		$v_data['query'] = $query;
		$v_data['all_companies'] = $this->companies_model->all_companies();
		$v_data['page'] = $page;
		$data['content'] = $this->load->view('companies/all_companies', $v_data, true);
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Add a new company
	*
	*/
	public function add_company() 
	{
		//form validation rules
		$this->form_validation->set_rules('company_name', 'Company', 'required|xss_clean');
		$this->form_validation->set_rules('company_physical_address', 'Company Physical Address', 'required|xss_clean');
		$this->form_validation->set_rules('company_postal_address', 'Company Postal Address', 'required|xss_clean');
		$this->form_validation->set_rules('company_post_code', 'Company Post Code', 'required|xss_clean');
		$this->form_validation->set_rules('company_town', 'Company Town', 'required|xss_clean');
		$this->form_validation->set_rules('company_phone', 'Company Phone', 'required|xss_clean');
		$this->form_validation->set_rules('company_facsimile', 'Company Facsimile', 'xss_clean');
		$this->form_validation->set_rules('company_cell_phone', 'Company Cell Phone', 'required|xss_clean');
		$this->form_validation->set_rules('company_email', 'Company Email', 'valid_email|required|xss_clean');
		$this->form_validation->set_rules('company_activity', 'Company Activity', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->companies_model->add_company())
			{
				$this->session->set_userdata('success_message', 'Company added successfully');
				redirect('admin/companies');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add company. Please try again');
			}
		}
		
		//open the add new company
		
		$data['title'] = 'Add company';
		$v_data['title'] = $data['title'];
		$data['content'] = $this->load->view('companies/add_company', $v_data, true);
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Edit an existing company
	*	@param int $company_id
	*
	*/
	public function edit_company($company_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('company_name', 'Company', 'required|xss_clean');
		$this->form_validation->set_rules('company_physical_address', 'Company Physical Address', 'required|xss_clean');
		$this->form_validation->set_rules('company_postal_address', 'Company Postal Address', 'required|xss_clean');
		$this->form_validation->set_rules('company_post_code', 'Company Post Code', 'required|xss_clean');
		$this->form_validation->set_rules('company_town', 'Company Town', 'required|xss_clean');
		$this->form_validation->set_rules('company_phone', 'Company Phone', 'required|xss_clean');
		$this->form_validation->set_rules('company_facsimile', 'Company Facsimile', 'xss_clean');
		$this->form_validation->set_rules('company_cell_phone', 'Company Cell Phone', 'required|xss_clean');
		$this->form_validation->set_rules('company_email', 'Company Email', 'valid_email|required|xss_clean');
		$this->form_validation->set_rules('company_activity', 'Company Activity', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->companies_model->update_company($company_id))
			{
				$this->session->set_userdata('success_message', 'Company updated successfully');
				redirect('admin/companies');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update company. Please try again');
			}
		}
		
		//open the add new company
		$data['title'] = 'Edit company';
		$v_data['title'] = $data['title'];
		
		//select the company from the database
		$query = $this->companies_model->get_company($company_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['company'] = $query->result();
			
			$data['content'] = $this->load->view('companies/edit_company', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'company does not exist';
		}
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing company
	*	@param int $company_id
	*
	*/
	public function delete_company($company_id)
	{
		//delete company image
		if($this->companies_model->delete_company($company_id))
		{
			$this->session->set_userdata('success_message', 'Company has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Could not delete company. Please try again');
		}
		redirect('admin/companies');
	}
    
	/*
	*
	*	Activate an existing company
	*	@param int $company_id
	*
	*/
	public function activate_company($company_id)
	{
		if($this->companies_model->activate_company($company_id))
		{
			$this->session->set_userdata('success_message', 'company activated successfully');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Could not activate company. Please try again');
		}
		redirect('admin/companies');
	}
    
	/*
	*
	*	Deactivate an existing company
	*	@param int $company_id
	*
	*/
	public function deactivate_company($company_id)
	{
		if($this->companies_model->deactivate_company($company_id))
		{
			$this->session->set_userdata('success_message', 'company disabled successfully');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Could not disable company. Please try again');
		}
		redirect('admin/companies');
	}
    
	/*
	*
	*	import company
	*
	*/
	function import_companies()
	{
		$v_data['title'] = $data['title'] = 'Import companies';
		
		$data['content'] = $this->load->view('companies/import_companies', $v_data, true);
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	import company template
	*
	*/
	function import_companies_template()
	{
		//export products template in excel 
		$this->companies_model->import_companies_template();
	}
    
	/*
	*
	*	Do the actual company import
	*
	*/
	function do_companies_import()
	{
		if(isset($_FILES['import_csv']))
		{
			if(is_uploaded_file($_FILES['import_csv']['tmp_name']))
			{
				//import products from excel 
				$response = $this->companies_model->import_csv_companies($this->csv_path);
				
				if($response == FALSE)
				{
					$v_data['import_response_error'] = 'Something went wrong. Please try again.';
				}
				
				else
				{
					if($response['check'])
					{
						$v_data['import_response'] = $response['response'];
					}
					
					else
					{
						$v_data['import_response_error'] = $response['response'];
					}
				}
			}
			
			else
			{
				$v_data['import_response_error'] = 'Please select a file to import.';
			}
		}
		
		else
		{
			$v_data['import_response_error'] = 'Please select a file to import.';
		}
		
		$v_data['title'] = $data['title'] = $this->site_model->display_page_title();
		
		$data['content'] = $this->load->view('companies/import_companies', $v_data, true);
		$this->load->view('admin/templates/general_page', $data);
	}
}
?>