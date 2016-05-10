<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller 
{
	function __construct()
	{
		parent:: __construct();
		
		$this->load->model('auth_model');
		$this->load->model('admin_model');
		$this->load->model('site/site_model');
		$this->load->model('reports_model');
		
		if(!$this->auth_model->check_admin_login())
		{
			redirect('login-admin');
		}
	}
	
	public function index()
	{
		redirect('dashboard');
	}
    
	/*
	*
	*	Dashboard
	*
	*/
	public function dashboard() 
	{
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$v_data['category_parents'] = $this->categories_model->all_parent_categories();
		
		$data['content'] = $this->load->view('dashboard', $v_data, true);
		
		$this->load->view('templates/general_page', $data);
	}
	
	public function dobis()
	{
		
	}
}
?>