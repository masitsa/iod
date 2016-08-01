<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MX_Controller 
{	
	var $slideshow_location;
	var $service_location;
	var $gallery_location;
	var $training_location;
	var $partners_location;
	var $resource_location;
	var $directors_location;
	var $facilitators_location;
	var $corporates_location;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('site/site_model');
		$this->load->model('auth_model');
		$this->load->model('admin/blog_model');
		$this->load->model('site/banner_model');
		$this->load->model('admin/training_model');
		$this->load->model('admin/event_model');
		$this->load->model('admin/users_model');

		$this->slideshow_location = base_url().'assets/slideshow/';
		$this->service_location = base_url().'assets/service/';
		$this->gallery_location = base_url().'assets/gallery/';
		$this->training_location = base_url().'assets/training/';
		$this->partners_location = base_url().'assets/partners/';
		$this->resource_location = base_url().'assets/resource/';
		$this->directors_location = base_url().'assets/directors/';
		$this->facilitators_location = base_url().'assets/facilitators/';
		$this->corporates_location = base_url().'assets/corporates/';
	}
	
	public function without_jquery()
	{
		$this->load->view('without_jquery');
	}
    
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function index() 
	{
		redirect('home');
	}
    
	/*
	*
	*	Sign in
	*
	*/
	public function sign_in() 
	{
		$data['title'] = $this->site_model->display_page_title();
		$data['content'] = $this->load->view("sign_in", '', TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}
    
	/*
	*
	*	Sign in
	*
	*/
	public function sign_out() 
	{
		$this->session->sess_destroy();
		
		redirect('home');
	}
    
	/*
	*
	*	Home Page
	*
	*/
	public function home_page() 
	{
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		$v_data['gallery_location'] = $this->gallery_location;
		$v_data['gallery_images'] = $this->site_model->get_active_gallery();
		$v_data['testimonials'] = $this->site_model->get_testimonials();
		$v_data['items'] = $this->site_model->get_front_end_items();
		$v_data['slides'] = $this->site_model->get_slides();
		$v_data['corporates'] = $this->site_model->get_corporates();
		$v_data['resource'] = $this->site_model->get_resource(3);
		$v_data['latest_posts'] = $this->blog_model->get_recent_posts(4);
		$v_data['trainings'] = $this->training_model->get_recent_trainings(5);
		$v_data['seminars'] = $this->event_model->get_recent_events(1, 4);
		$v_data['events'] = $this->event_model->get_recent_events(2, 4);
		$v_data['conferences'] = $this->event_model->get_recent_events(3, 4);
		$v_data['training_location'] = $this->training_location;
		$v_data['resource_location'] = $this->resource_location;
		$v_data['corporates_location'] = $this->corporates_location;
		$v_data['faqs'] = $this->site_model->get_faqs();
		$data['title'] = $this->site_model->display_page_title();
		$v_data['service_location'] = $this->service_location;
		$data['sign_up'] = 1;
		$data['content'] = $this->load->view("home", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}
    
	/*
	*
	*	Register customer
	*
	*/
	public function register_customer()
	{
		$this->form_validation->set_rules('website', 'Website url', 'required|is_unique[smart_banner.smart_banner_website]');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('image', 'Image', 'trim');
		$this->form_validation->set_message('is_unique', 'That website already exists. Please enter another one');
		
		if ($this->form_validation->run() == FALSE)
		{
			$response['message'] = 'false';
			$validation_errors = validation_errors();
			$response['result'] = $validation_errors;
		}
		else
		{
			$url = $this->input->post('website');
			
			//check for valid url
			if($this->site_model->valid_url($url))
			{
				$reply = $this->auth_model->register_user();
				
				if($reply['message'] == TRUE)
				{
					//send registration email
					$email_reply = $this->auth_model->send_registration_email($this->input->post('email'), $reply['first_name']);
					//var_dump($response);
					if($email_reply)
					{
						//$data2['success'] = $response;
					}
					
					else
					{
						//$data2['error'] = $response;
					}
					$response['message'] = 'true';
					$this->session->set_userdata('success_message', $reply['response']);
				}
				
				else
				{
					$response['message'] = 'false';
					$response['result'] = $reply['response'];
				}
			}
			
			else
			{
				$response['message'] = 'false';
				$response['result'] = 'Please enter a valid website url. Ensure it starts with http(s)://';
			}
		}
		
		echo json_encode($response);
	}
    
	/*
	*
	*	Register customer
	*
	*/
	public function sign_in_customer()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('image', 'Image', 'trim');
		
		if ($this->form_validation->run() == FALSE)
		{
			$response['message'] = 'false';
			$validation_errors = validation_errors();
			$response['result'] = $validation_errors;
		}
		else
		{
			$reply = $this->auth_model->sign_in_customer();
			
			if($reply['message'] == TRUE)
			{
				$response['message'] = 'true';
				$this->session->set_userdata('success_message', $reply['response']);
			}
			
			else
			{
				$response['message'] = 'false';
				$response['result'] = $reply['response'];
			}
		}
		
		echo json_encode($response);
	}
    
	/*
	*
	*	Search for a product
	*
	*/
	public function search()
	{
		$search = $this->input->post('search_item');
		
		if(!empty($search))
		{
			redirect('products/search/'.$search);
		}
		
		else
		{
			redirect('products/all-products');
		}
	}
    
	/*
	*
	*	FAQs
	*
	*/
	public function faqs() 
	{	
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view("faqs", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}
    
	/*
	*
	*	terms
	*
	*/
	public function terms() 
	{	
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view("terms", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}
    
	/*
	*
	*	privacy
	*
	*/
	public function privacy() 
	{	
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view("privacy", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}
    
	/*
	*
	*	about
	*
	*/
	public function about() 
	{	
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		$v_data['items'] = $this->site_model->get_front_end_items();
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view("about", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}

	/*
	*
	*	about
	*
	*/
	public function board() 
	{	
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		$v_data['items'] = $this->site_model->get_front_end_items();
		$v_data['directors'] = $this->site_model->get_directors();
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$v_data['directors_location'] = $this->directors_location;
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view("board", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}
	
	public function member_details($web_name)
	{
		$directors_name = $this->site_model->decode_web_name($web_name);
		$title = $directors_name ;

		$data['title'] = $title;
		$v_data['directors'] = $this->site_model->get_member_details($directors_name);
		$v_data['title'] = $data['title'];
		$v_data['directors_location'] = $this->directors_location;
		$data['contacts'] = $this->site_model->get_contacts();
		
		$data['content'] = $this->load->view('single_director', $v_data, true);
		$this->load->view("site/templates/general_page", $data);
	}

	/*
	*
	*	partners
	*
	*/
	public function partners() 
	{	
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		$v_data['items'] = $this->site_model->get_front_end_items();
		$v_data['partners'] = $this->site_model->get_partners();
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$v_data['partners_location'] = $this->partners_location;
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view("partners", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}

	/*
	*
	*	facilitators
	*
	*/
	public function facilitators() 
	{	
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		$v_data['items'] = $this->site_model->get_front_end_items();
		$v_data['facilitators'] = $this->site_model->get_facilitators();
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$v_data['facilitators_location'] = $this->facilitators_location;
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view("facilitators", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}

	/*
	*
	*	about
	*
	*/
	public function services() 
	{	
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view("services", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}

	/*
	*
	*	about
	*
	*/
	public function membership() 
	{	
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view("membership", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}


   /*
	*
	*	about
	*
	*/
	public function gallery() 
	{	
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		
		$data['title'] = $this->site_model->display_page_title();
		$v_data['gallery_location'] = $this->gallery_location;
		$v_data['title'] = $data['title'];
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view("gallery", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}

	/*
	*
	*	about
	*
	*/
	public function event() 
	{	
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		
		$data['title'] = $this->site_model->display_page_title();
		$v_data['gallery_location'] = $this->gallery_location;
		$v_data['title'] = $data['title'];
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view("event", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}

	/*
	*
	*	about
	*
	*/
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

	public function service_item($service_web_name = NULL) 
	{
		$table = "service";
		$where = 'service.service_status = 1';
		$v_data['service_location'] = $this->service_location;
		
		if($service_web_name != NULL)
		{
			$service_name = $this->site_model->decode_web_name($service_web_name);
			$where .= ' AND service.service_name = \''.$service_name.'\'';//echo $where; die();
			$v_data['services_item'] = $this->site_model->get_services($table, $where, NULL);
			$data['title'] = $service_name;
			$v_data['title'] = $service_name;
		}
		
		else
		{
			$data['title'] = 'Our Services';
			$v_data['title'] = 'Our Services';
			$v_data['services_item'] = $this->site_model->get_services($table, $where, 12);
		}
		$v_data['service_location'] = $this->service_location;


		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view("single_service", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}


	public function membership_item($service_web_name) 
	{	

		$table = "service";
		$where = 'service.service_status = 1';
		$v_data['service_location'] = $this->service_location;
		
		if($service_web_name != NULL)
		{
			$service_name = $this->site_model->decode_web_name($service_web_name);
			$where .= ' AND service.service_name = \''.$service_name.'\'';
			$v_data['services_item'] = $this->site_model->get_services($table, $where, NULL);
			$data['title'] = $service_name;
			$v_data['title'] = $service_name;
		}
		
		else
		{
			$data['title'] = 'Our Services';
			$v_data['title'] = 'Our Services';
			$v_data['services_item'] = $this->site_model->get_services($table, $where, 12);
		}
		$v_data['service_location'] = $this->service_location;


		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view("single_membership", $v_data, TRUE);
		
		$this->load->view("site/templates/general_page", $data);
	}
    
	/*
	*
	*	Contact
	*
	*/
	public function contact()
	{
		$v_data['sender_name_error'] = '';
		$v_data['sender_email_error'] = '';
		$v_data['sender_phone_error'] = '';
		$v_data['message_error'] = '';
		
		$v_data['sender_name'] = '';
		$v_data['sender_email'] = '';
		$v_data['sender_phone'] = '';
		$v_data['message'] = '';
		
		//form validation rules
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('sender_name', 'Your Name', 'required');
		$this->form_validation->set_rules('sender_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('sender_phone', 'phone', 'xss_clean');
		$this->form_validation->set_rules('message', 'Message', 'required');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			$response = $this->site_model->contact();
			$this->session->set_userdata('success_message', 'Your message has been sent successfully. We shall get back to you as soon as possible');
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['sender_name_error'] = form_error('sender_name');
				$v_data['sender_email_error'] = form_error('sender_email');
				$v_data['sender_phone_error'] = form_error('sender_phone');
				$v_data['message_error'] = form_error('message');
				
				//repopulate fields
				$v_data['sender_name'] = set_value('sender_name');
				$v_data['sender_email'] = set_value('sender_email');
				$v_data['sender_phone'] = set_value('sender_phone');
				$v_data['message'] = set_value('message');
			}
		}
		
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		$v_data['items'] = $this->site_model->get_front_end_items();
		
		$data['title'] = $v_data['title'] = $this->site_model->display_page_title();
		$data['contacts'] = $contacts;
		$data['content'] = $this->load->view('contact', $v_data, true);
		
		$this->load->view("site/templates/general_page", $data);
	}
	/*
	*
	*	Default action is to show all the registered training
	*
	*/
	public function trainings() 
	{
		$where = 'training_id > 0';
		$table = 'training';
		$segment = 2;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'trainings';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = '<span aria-hidden="true">Next<i class="fa fa-angle-right"></i></span>';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = '<span aria-hidden="true"><i class="fa fa-angle-left"></i>PREV</span>';
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
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$v_data['training_location'] = $this->training_location;
		$data['content'] = $this->load->view('event', $v_data, true);
		
		$this->load->view("site/templates/general_page", $data);
	}
	/*
	*
	*	Default action is to show all the registered training
	*
	*/
	public function calendar() 
	{
		$where = 'event_status = 1 AND event.event_type_id = event_type.event_type_id AND event_start_time >= CURDATE()';
		$table = 'event, event_type';
		$segment = 2;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'calendar';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 50;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = '<span aria-hidden="true">Next<i class="fa fa-angle-right"></i></span>';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = '<span aria-hidden="true"><i class="fa fa-angle-left"></i>PREV</span>';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $v_data["links"] = $this->pagination->create_links();
		$query = $this->event_model->get_all_events($table, $where, $config["per_page"], $page);
		
		$data['title'] = $v_data['title'] = 'All Events';
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$data['content'] = $this->load->view('event', $v_data, true);
		
		$this->load->view("site/templates/general_page", $data);
	}

	public function resource()
	{
		$where = 'resource_category_id > 0';
		$table = 'resource_category';
		$segment = 2;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'resource';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = '<span aria-hidden="true">Next<i class="fa fa-angle-right"></i></span>';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = '<span aria-hidden="true"><i class="fa fa-angle-left"></i>PREV</span>';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->site_model->get_all_resources($table, $where, $config["per_page"], $page);
		
		$data['title'] = $v_data['title'] = 'Resources';
		$contacts = $this->site_model->get_contacts();
		$v_data['contacts'] = $contacts;
		$v_data['query'] = $query;
		$v_data['total_rows'] = $config['total_rows'];
		$v_data['page'] = $page;
		$v_data['training_location'] = $this->training_location;
		$data['content'] = $this->load->view('resource', $v_data, true);
		
		$this->load->view("site/templates/general_page", $data);
	}
	
	public function view_event_details($event_web_name)
	{
		$query = $this->event_model->get_event2($event_web_name);
		$contacts = $this->site_model->get_contacts();
		$data['title'] = 'Calendar';
		
		if($query->num_rows() > 0)
		{
			//get event type id
			$row = $query->row();
			$event_type_id = $row->event_type_id;
			$v_data['contacts'] = $contacts;
			$v_data['query'] = $query;
			$v_data['similar_events'] = $this->event_model->get_similar_event($event_type_id, 5);
			$data['content'] = $this->load->view('single_event', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'Unable to find item';
		}
		$this->load->view("site/templates/general_page", $data);
	}
	public function single_resource($resource_name)
	{
		$resource_title = $this->site_model->decode_web_name($resource_name);
		$title = $resource_title ;

		$v_data['title'] = $title;
		$return = $this->site_model->get_resource_category_id($title);
		$resource_category_id = $return['resource_category_id'];
		$member_only = $return['member_only'];
		
		if($member_only == 1)
		{
			$this->session->set_userdata('login_error', 'Please login to view these resources');
			redirect('login');
		}
		
		else
		{
			$resource = $this->site_model->get_resource_item($resource_category_id);
			$contacts = $this->site_model->get_contacts();
			$v_data['resource_category'] = $this->site_model->get_resource_category($resource_category_id);
			// $v_data['latest_posts'] = $this->blog_model->get_recent_posts(4);
			$v_data['resource_location'] = $this->resource_location;
			$v_data['contacts'] = $contacts;
			$v_data['resource'] = $resource;
			$data['content'] = $this->load->view('single_resource', $v_data, true);
			$this->load->view("site/templates/general_page", $data);
		}
	}
	public function single_calendar($web_name)
	{
		$event_type_name = $this->site_model->decode_web_name($web_name);
		$title = $event_type_name ;

		$v_data['title'] = $title;
		$event_type_id = $this->site_model->get_event_type_id($title);
		$event = $this->site_model->get_event_item($event_type_id);
		$contacts = $this->site_model->get_contacts();
		//$v_data['resource_category'] = $this->site_model->get_resource_category($resource_category_id);
		// $v_data['latest_posts'] = $this->blog_model->get_recent_posts(4);
		$v_data['contacts'] = $contacts;
		$v_data['query'] = $event;
		$data['content'] = $this->load->view('event', $v_data, true);
		$this->load->view("site/templates/general_page", $data);
	}

	public function about_us($about_name)
	{
		$about_title = $this->site_model->decode_web_name($about_name);
		$title = $about_title ;

		$v_data['title'] = $title;
		$service_id = $this->site_model->get_service_id($title);
		$about = $this->site_model->get_about_item($service_id);
		$contacts = $this->site_model->get_contacts();

		$v_data['contacts'] = $contacts;
		$v_data['services'] = $about;
		$data['content'] = $this->load->view('single_about', $v_data, true);
		$this->load->view("site/templates/general_page", $data);
	}

	public function training_partners()
	{
		$data['content'] = 'Coming Soon';
		$data['title'] = 'Training Partners';
		$this->load->view("site/templates/general_page", $data);
	}

	public function get_tweets()
	{
		$tweets = $this->site_model->get_tweets();
	}
	
	public function convertNumber($number)
	{
		$this->load->model('numbers_model');
		$value = ucwords($this->numbers_model->convertNumber($number));
		echo $value.' only ********************* KSH';
	}
	
	public function create_invoices()
	{
		//get all members
		$this->load->model('member/invoices_model');
		$member_numbers = array('MIoD048', 'MIoD064', 'MIoD076', 'MIoD179', 'MIoD207', 'MIoD711', 'MIoD712', 'MIoD713', 'MIoD748', 'MIoD749', 'MIoD750', 'MIoD751', 'MIoD752', 'MIoD753', 'MIoD754', 'MIoD755', 'MIoD761', 'MIoD781', 'MIoD782', 'MIoD783', 'MIoD784', 'MIoD785', 'MIoD786', 'MIoD795', 'MIoD796', 'MIoD797', 'MIoD798', 'MIoD801', 'MIoD802', 'MIoD803', 'MIoD805', 'MIoD806', 'MIoD807', 'MIoD808', 'MIoD809', 'MIoD810', 'MIoD811', 'MIoD812', 'MIoD813', 'MIoD814', 'MIoD815', 'MIoD816', 'MIoD817', 'MIoD818', 'MIoD819', 'MIoD820', 'MIoD821', 'MIoD822', 'MIoD823', 'MIoD824', 'MIoD825', 'MIoD826', 'MIoD827', 'MIoD828', 'MIoD829', 'MIoD830', 'MIoD831', 'MIoD832', 'MIoD833', 'MIoD834', 'MIoD835', 'MIoD836', 'MIoD838', 'MIoD840', 'MIoD841', 'MIoD843', 'MIoD845', 'MIoD846', 'MIoD847', 'MIoD848', 'MIoD849', 'MIoD850', 'MIoD851', 'MIoD852', 'MIoD853', 'MIoD854', 'MIoD855', 'MIoD856', 'MIoD857', 'MIoD858', 'MIoD859', 'MIoD860', 'MIoD861', 'MIoD862', 'MIoD863', 'MIoD864', 'MIoD865', 'MIoD866', 'MIoD867', 'MIoD868', 'MIoD869', 'MIoD870');
		$this->db->where_not_in('member_number', $member_numbers);
		$this->db->where('member_number');
		$query = $this->db->get('member');
		
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $res)
			{
				$member_id = $res->member_id;
				if($this->invoices_model->create_member_invoice($member_id))
				{
				}
			}
		}
	}
}
?>