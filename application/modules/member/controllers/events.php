<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/member/controllers/member.php";

class Events extends member 
{
	var $training_location;
	function __construct()
	{
		parent:: __construct();
		$this->training_location = base_url().'assets/training/';
	}
	
	function event_list()
	{
		$where = 'training_status = 1';
		$table = 'training';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'member/events';
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
		$query = $this->training_model->get_all_trainings($table, $where, $config["per_page"], $page);
		
		$data['title'] = $v_data['title'] = 'All Trainings';
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$data['content'] = $this->load->view('account/event_list', $v_data, true);
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('site/templates/account', $data);
	}
	
	function event_single($event_web_name)
	{
		$result = explode('-', $event_web_name);
		$total = count($result);
		$last = $total - 1;
		if($last >= 0)
		{
			$training_id = $result[$last];
			$v_data['training_location'] = $this->training_location;
			$v_data['query'] = $this->training_model->get_training($training_id);
			$data['content'] = $this->load->view('account/event_single', $v_data, true);
			$data['title'] = $this->site_model->display_page_title();
			$this->load->view('site/templates/account', $data);
		}
		
		else
		{
			echo $event_web_name;
		}
	}
}
?>