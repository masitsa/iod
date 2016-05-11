<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MX_Controller 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('site_model');
	}
    
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function index() 
	{
		redirect('login');
	}
	public function projects() 
	{	
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view("services", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}
}
?>