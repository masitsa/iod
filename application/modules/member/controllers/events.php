<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/member/controllers/member.php";

class Events extends member 
{
	function __construct()
	{
		parent:: __construct();
	}
	
	function event_list()
	{
		$data['content'] = $this->load->view('account/event_list', '', true);
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('site/templates/account', $data);
	}
	
	function event_single()
	{
		$data['content'] = $this->load->view('account/event_single', '', true);
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('site/templates/account', $data);
	}
}
?>