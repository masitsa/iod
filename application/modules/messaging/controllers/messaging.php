<?php
date_default_timezone_set('Africa/Nairobi');
class Messaging extends MX_Controller 
{
	var $csv_path;
	function __construct()
	{
		parent:: __construct();
		$this->load->model('messaging_model');
		$this->load->model('site/site_model');
		$this->load->model('admin/sections_model');
		$this->load->model('admin/admin_model');
		$this->load->model('admin/users_model');
		$this->load->model('admin/personnel_model');

		$this->csv_path = realpath(APPPATH . '../assets/csv');
	}
	
	public function index()
	{
		if(!$this->auth_model->check_login())
		{
			redirect('login');
		}
		
		else
		{
			redirect('message/dashboard');
		}
	}
	public function dashboard()
	{
		$where = 'entryid > 0 ';
		$total_contacts = $this->messaging_model->count_items('member',$where);

		$sent_where = 'message_status = 1 ';
		$sent_messages = $this->messaging_model->count_items('messages',$sent_where);

		$unsent_where = 'message_status > 1 ';
		$unsent_messages = $this->messaging_model->count_items('messages',$unsent_where);

		// calculate total cost

		$cost = $this->messaging_model->get_total_cost();
		
		$total_amount = 0;//$this->messaging_model->get_amount_toped_up();

		$v_data['title'] = 'Dashboard';
		$data['title'] = 'Dashboard';
		$v_data['total_contacts'] = $total_contacts;
		$v_data['sent_messages'] = $sent_messages;
		$v_data['unsent_messages'] = $unsent_messages;
		$v_data['balance'] = $total_amount - $cost;
		$data['content'] = $this->load->view('dashboard', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);		
	}

	public function unsent_messages()
	{

		$where = 'messages.message_status > 1';
		$table = 'messages';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url().'messaging/unsent-messages';
		$config['total_rows'] = $this->messaging_model->count_items($table, $where);
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

		$query = $this->messaging_model->get_all_messages($table, $where, $config["per_page"], $page);
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$v_data['page'] = $page;
		$v_data['query'] = $query;
		$data['content'] = $this->load->view('sms/unsent_messages', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}

	public function message_templates()
	{

		$where = 'message_template_id > 0';
		$table = 'message_template';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url().'message/message-templates';
		$config['total_rows'] = $this->messaging_model->count_items($table, $where);
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

		$query = $this->messaging_model->get_all_message_templates($table, $where, $config["per_page"], $page);

		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$v_data['page'] = $page;
		$v_data['query'] = $query;
		$data['content'] = $this->load->view('templates/all_message_templates', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}

	public function sent_messages()
	{

		$where = 'messages.message_status = 1';
		$table = 'messages';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url().'messaging/sent-messages';
		$config['total_rows'] = $this->messaging_model->count_items($table, $where);
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

		$query = $this->messaging_model->get_all_messages($table, $where, $config["per_page"], $page);
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$v_data['page'] = $page;
		$v_data['query'] = $query;
		$data['content'] = $this->load->view('sms/sent_messages', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}
	public function import_template()
	{
		$this->messaging_model->import_template();
	}
	function do_messages_import($message_category_id)
	{

		if(isset($_FILES['import_csv']))
		{
			// var_dump($message_category_id); die();
			if(is_uploaded_file($_FILES['import_csv']['tmp_name']))
			{
				//import products from excel 

				$response = $this->messaging_model->import_csv_charges($this->csv_path, $message_category_id);
				
				
				if($response == FALSE)
				{

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
		redirect('messaging/unsent-messages');
	}
	public function spoilt_messages()
	{

		$where = 'messaging.message_category_id = message_category.message_category_id AND messaging.sent_status = 2 AND messaging.branch_code = "'. $this->session->userdata('branch_code').'"';
		$table = 'messaging, message_category';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-posts';
		$config['total_rows'] = $this->messaging_model->count_items($table, $where);
		$config['uri_segment'] = 2;
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
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->messaging_model->get_all_messages($table, $where, $config["per_page"], $page);
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$v_data['query'] = $query;
		$data['content'] = $this->load->view('sms/sent_messages', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}

	public function send_messages()
	{
		$this->messaging_model->send_unsent_messages();

		redirect('messaging/unsent-messages');
	}

	/*
	*
	*	Add a new category
	*
	*/
	public function add_message_template() 
	{

		//form validation rules
		$this->form_validation->set_rules('template_description', 'Template Description', 'required|xss_clean');
		$this->form_validation->set_rules('template_code', 'Template Code', 'required|is_unique[message_template.message_template_code]|xss_clean');
		$this->form_validation->set_message("is_unique", "A unique preffix is requred.");
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			
			if($this->messaging_model->add_message_template())
			{
				$this->session->set_userdata('success_message', 'message template added successfully');
				redirect('messaging/message-templates');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add message template. Please try again');
			}
		}
		
		//open the add new category
		
		$data['title'] = 'Add Message Template';
		$v_data['title'] = $data['title'];
		$data['content'] = $this->load->view('templates/add_message_template', $v_data, true);
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Edit an existing category
	*	@param int $category_id
	*
	*/
	public function edit_message_template($message_template_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('template_description', 'Template Description', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			
			//update category
			if($this->messaging_model->update_message_template($message_template_id))
			{
				$this->session->set_userdata('success_message', 'message template updated successfully');
				redirect('messaging/message-templates');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update message template. Please try again');
			}
		}
		
		//open the add new message_template
		$data['title'] = 'Edit message_template';
		$v_data['title'] = $data['title'];
		
		//select the message_template from the database
		$query = $this->messaging_model->get_message_template($message_template_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['message_template'] = $query->result();
			
			$data['content'] = $this->load->view('templates/edit_message_template', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'message template does not exist';
		}
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	
    
	/*
	*
	*	Activate an existing message_template
	*	@param int $message_template_id
	*
	*/
	public function activate_message_template($message_template_id)
	{
		$this->messaging_model->activate_message_template($message_template_id);
		$this->session->set_userdata('success_message', 'message template activated successfully');
		redirect('messaging/message-templates');
	}
    
	/*
	*
	*	Deactivate an existing message_template
	*	@param int $message_template_id
	*
	*/
	public function deactivate_message_template($message_template_id)
	{
		$this->messaging_model->deactivate_message_template($message_template_id);
		$this->session->set_userdata('success_message', 'Message Template disabled successfully');
		redirect('messaging/message-templates');
	}

	public function template_detail($message_template_id)
	{
		//form validation rules
		$where = 'message_template_id ='.$message_template_id;
		$table = 'message_batch';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url().'template-detail/'.$message_template_id;
		$config['total_rows'] = $this->messaging_model->count_items($table, $where);
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

		$query = $this->messaging_model->get_all_message_template_batches($table, $where, $config["per_page"], $page);

		$v_data['query'] = $query;
		$v_data['page'] = $page;

		$counties = $this->messaging_model->get_active_contacts('member_phone');
		$rs8 = $counties->result();
		$county_list = '';
		foreach ($rs8 as $property_rs) :
			$Countyname = $property_rs->member_first_name.' '.$property_rs->member_surname;

		    $county_list .="<option value='".$Countyname."'>".$Countyname."</option>";

		endforeach;
		$v_data['county_list'] = $county_list;

		$query = $this->messaging_model->get_message_template($message_template_id);
		$v_data['message_template'] = $query->result();
		$message_template = $query->result();

		$data['title'] =  $message_template[0]->message_template_code.' Detail';
		$v_data['title'] = $data['title'];
		$data['content'] = $this->load->view('templates/template_detail', $v_data, true);
		$this->load->view('admin/templates/general_page', $data);
	}
	public function set_search_parameters($message_template_id)
	{
		$_SESSION['search_template'] = NULL;
		
		$this->session->unset_userdata('search_title');
		$this->session->unset_userdata('search_template');
		
		$countyname = $this->input->post('countyname');
		$gender = $this->input->post('gender');
		$constituencyname = $this->input->post('constituencyname');
		$Pollingstationname = $this->input->post('Pollingstationname');
		$CAWname = $this->input->post('CAWname');
		$age_from = $this->input->post('age_from');
		$age_to = $this->input->post('age_to');

		$search_title = "Showing records for ";
		if(!empty($countyname))
		{
			$search_title .= " County : ".$countyname;
			$countyname = ' AND Countyname = "'.$countyname.'"';
			
		}
		else
		{
			$countyname = '';
			$search_title .= '';
		}
		if(!empty($gender))
		{
				$search_title .= " Gender : ".$gender;
				$gender = ' AND Gender = "'.$gender.'"';
				
		}
		else
		{
			$gender = '';
			$search_title .= '';
		}
		if(!empty($CAWname))
		{
				$search_title .= " Ward :".$CAWname;
				$CAWname = ' AND CAWname = "'.$CAWname.'"';
				
		}
		else
		{
			$gender = '';
			$search_title .= '';
		}
		if(!empty($constituencyname))
		{
				$search_title .= " Constituency :".$constituencyname;
				$constituencyname = ' AND Constituencyname = "'.$constituencyname.'"';
				
		}
		else
		{
			$constituencyname = '';
			$search_title .= '';
		}
		if(!empty($Pollingstationname))
		{
				$search_title .= " Polling Station:".$Pollingstationname;
				$Pollingstationname = ' AND Pollingstationname = "'.$Pollingstationname.'"';
				
		}
		else
		{
			$Pollingstationname = '';
			$search_title .= '';
		}
		if(!empty($age_from) && !empty($age_to))
		{
			$visit_date = ' AND age BETWEEN \''.$age_from.'\' AND \''.$age_to.'\'';
			$search_title .= ' Ages From '.$age_from.' To '.$age_to.' ';
		}
		
		else if(!empty($age_from))
		{
			$visit_date = ' AND age = \''.$age_from.'\'';
			$search_title .= ' Ages From '.$age_from.' ';
		}
		
		else if(!empty($age_to))
		{
			$visit_date = ' AND age = \''.$age_to.'\'';
			$search_title .= ' Ages From '.$age_from.' ';
		}
		
		else
		{
			$visit_date = '';
		}
		$search = $countyname.$constituencyname.$CAWname.$Pollingstationname.$gender.$visit_date;
		$this->session->set_userdata('search_template', $search);
		$this->session->set_userdata('search_title', $search_title);
		
		redirect('template-detail/'.$message_template_id);
	}
	public function create_batch_items($message_template_id)
	{
		if($this->messaging_model->create_batch($message_template_id))
		{
			$this->session->unset_userdata('search_title');
			$this->session->unset_userdata('search_template');
			$this->session->set_userdata("success_message","You have successfully added batch contacts to this template");
		}
		else
		{
			$this->session->set_userdata("error_message","Sorry somthing went wrong. Please try again");

		}
		redirect('template-detail/'.$message_template_id);
	}
	public function send_batch_messages($message_batch_id,$message_template_id)
	{
		$this->messaging_model->send_batch_messages($message_batch_id);

		redirect('template-detail/'.$message_template_id);
	}
	public function view_persons_for_batch($message_batch_id,$message_template_id)
	{

		$where = 'messages.message_batch_id = message_batch.message_batch_id AND messages.entryid = member.member_id AND messages.message_batch_id = '.$message_batch_id;
		$table = 'messages,message_batch,member';
		$segment = 4;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'sending-messages/'.$message_batch_id.'/'.$message_template_id;
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
        $data["links"] = $this->pagination->create_links();
		$query = $this->messaging_model->get_all_message_details($table, $where, $config["per_page"], $page);
		
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$v_data['message_template_id'] = $message_template_id;
		$v_data['message_batch_id'] = $message_batch_id;
		$query = $this->messaging_model->get_message_template($message_template_id);
		$v_data['message_template'] = $query->result();
		$message_template = $query->result();
		$v_data['title'] ='Message Contacts';
			
		$data['content'] = $this->load->view('templates/message_detail', $v_data, true);
		
		$data['title'] = 'Message Contacts';
		
		$this->load->view('admin/templates/general_page', $data);
	}

	public function view_schedules($message_batch_id,$message_template_id)
	{
		$where = 'schedules.schedule_period_id = schedule_period.schedule_period_id AND schedule_delete = 0 AND schedules.message_batch_id = '.$message_batch_id;
		$table = 'schedules,schedule_period';
		$segment = 4;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'view-schedules/'.$message_batch_id.'/'.$message_template_id;
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
        $data["links"] = $this->pagination->create_links();
		$query = $this->messaging_model->get_all_schedule_details($table, $where, $config["per_page"], $page);
		
		$v_data['schedules_query'] = $query;
		$v_data['page'] = $page;
		$v_data['message_template_id'] = $message_template_id;
		$v_data['message_batch_id'] = $message_batch_id;
		$query = $this->messaging_model->get_message_template($message_template_id);
		$v_data['message_template'] = $query->result();
		$message_template = $query->result();
		$v_data['title'] ='Schedules';
			
		$data['content'] = $this->load->view('templates/all_schedules', $v_data, true);
		
		$data['title'] = 'Schedules';
		
		$this->load->view('admin/templates/general_page', $data);
	}
	public function delete_contact($message_id,$message_batch_id,$message_template_id)
	{
		if($this->messaging_model->delete_contact($message_id))
		{
			$this->session->set_userdata('contact_success_message', 'The contact has been deleted successfully');

		}
		else
		{
			$this->session->set_userdata('contact_error_message', 'The contact could not be deleted');
		}
		
			redirect('view-senders/'.$message_batch_id.'/'.$message_template_id);
	}
	public function create_new_schedule($message_batch_id,$message_template_id)
	{
		$this->form_validation->set_rules('schedule_period_id', 'Schedule period', 'required|xss_clean');
		$this->form_validation->set_rules('schedule_date', 'Schedule date', 'xss_clean');
		$this->form_validation->set_rules('schedule_time', 'Schedule time', 'xss_clean');


		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->messaging_model->add_schedule($message_batch_id))
			{
				$this->session->set_userdata("success_message", "Schedule created successfully");
			}
			
			else
			{
				$this->session->set_userdata("error_message","Could not create schedule Please try again");
			}
		}
		redirect('view-schedules/'.$message_batch_id.'/'.$message_template_id);
	}
	public function activate_schedule($schedule_id,$message_batch_id,$message_template_id)
	{
		$visit_data = array('schedule_status'=>1);
		$this->db->where('schedule_id',$schedule_id);
		if($this->db->update('schedules', $visit_data))
		{
				$this->session->set_userdata("success_message", "Activation was successful");
				redirect('view-schedules/'.$message_batch_id.'/'.$message_template_id);
		}
		else
		{
				$this->session->set_userdata("error_message","Could not activate. Please try again");
				redirect('view-schedules/'.$message_batch_id.'/'.$message_template_id);
		}
	}
	public function deactivate_schedule($schedule_id,$message_batch_id,$message_template_id)
	{
		$visit_data = array('schedule_status'=>0);
		$this->db->where('schedule_id',$schedule_id);
		if($this->db->update('schedules', $visit_data))
		{
				$this->session->set_userdata("success_message", "deactivation was successful");
				redirect('view-schedules/'.$message_batch_id.'/'.$message_template_id);
		}
		else
		{
				$this->session->set_userdata("error_message","Could not deactivate. Please try again");
				redirect('view-schedules/'.$message_batch_id.'/'.$message_template_id);
		}
	}
	public function delete_schedule($schedule_id,$message_batch_id,$message_template_id)
	{
		$visit_data = array('schedule_delete'=>1);
		$this->db->where('schedule_id',$schedule_id);
		if($this->db->update('schedules', $visit_data))
		{
				$this->session->set_userdata("success_message", "You've successfully removed the schedule");
				redirect('view-schedules/'.$message_batch_id.'/'.$message_template_id);
		}
		else
		{
				$this->session->set_userdata("error_message","Could not remove the schedule. Please try again");
				redirect('view-schedules/'.$message_batch_id.'/'.$message_template_id);
		}
	}
	public function send_cron_messages()
	{
		if($this->messaging_model->send_cron_messages())
		{
			echo "yes";
			
		}
		else
		{
			echo "no";
		}
	}
	
	public function test_messages($phone = '0726149351', $message = 'Hello World')
	{
		$this->messaging_model->sms($phone,$message);
	}
}