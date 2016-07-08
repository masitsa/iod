<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends MX_Controller 
{
	var $message_amount;
	var $like_amount;
	var $messages_path;
		
	function __construct()
	{
		parent:: __construct();
		// Allow from any origin
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}
	
		// Access-Control headers are received during OPTIONS requests
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
	
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	
			exit(0);
		}
		/*$this->message_amount = $this->config->item('message_cost');
		$this->like_amount = $this->config->item('like_cost');*/
		$this->message_amount = 0;
		$this->like_amount = 0;
		$this->messages_path = realpath(APPPATH . '../assets/messages');
		$this->load->model('profile_model');
		$this->load->model('messages_model');
		$this->load->model('file_model');
		$this->load->model('admin/users_model');
	}
	
	public function contacts($client_id)
	{
		//browse all profiles
		$where = 'member_id != '.$client_id;
		$table = 'member';
		
		$this->db->where($where);
		$v_data['profiles'] = $this->db->get($table);
		$data['result']= $this->load->view('messages/all_profiles', $v_data, true);
		$data['message']= 'success';
		echo json_encode($data);
	}
	
	public function inbox($client_id) 
	{
		$search = '__';
		$order_by = 'last_chatted';
		//browse all profiles
		$where = 'client_message.client_id = '.$client_id.' OR client_message.receiver_id = '.$client_id;
		$table = 'client_message';
		$limit = NULL;
		
		//ordering products
		switch ($order_by)
		{
			case 'last_chatted':
				$order_method = 'DESC';
			break;
			
			case 'client_username':
				$order_method = 'ASC';
			break;
			
			default:
				$order_method = 'DESC';
			break;
		}
		
		//pagination
		$segment = 3;
		$this->load->library('pagination');
		$config['base_url'] = site_url().'messages/inbox';
		$config['total_rows'] = $this->users_model->count_items($table, $where, $limit);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination no-margin-top">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = '»';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = '«';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
		
		if($limit == NULL)
		{
        	$v_data["links"] = $this->pagination->create_links();
			$v_data["first"] = $page + 1;
			$v_data["total"] = $config['total_rows'];
			
			if($v_data["total"] < $config["per_page"])
			{
				$v_data["last"] = $page + $v_data["total"];
			}
			
			else
			{
				$v_data["last"] = $page + $config["per_page"];
			}
		}
		
		else
		{
			$v_data["first"] = $page + 1;
			$v_data["total"] = $config['total_rows'];
			$v_data["last"] = $config['total_rows'];
		}
		$v_data['messages'] = $this->messages_model->get_all_messages($table, $where, $config["per_page"], $page, $limit, $order_by, $order_method);
		//$v_data['profile_image_location'] = $this->profile_image_location;
		$v_data['messages_path'] = $this->messages_path;
		$v_data['current_client_id'] = $client_id;
		//$v_data['crumbs'] = $this->site_model->get_crumbs();
		//$v_data['profile_image_path'] = $this->profile_image_path;

		$data['result']= $this->load->view('messages/inbox', $v_data, true);
		$data['message']= "success";
		$data['total'] = $this->messages_model->count_unread_messages($client_id, $this->messages_path);
		$data['username']= $this->session->userdata('client_username');
		echo json_encode($data);
	}
	
	public function view_message($receiver_id, $client_id)
	{
		$v_data['receiver'] = $this->profile_model->get_client($receiver_id);
		$v_data['sender'] = $this->profile_model->get_client($client_id);
		$v_data['messages'] = $this->profile_model->get_messages($client_id, $receiver_id, $this->messages_path);

		$data['message']= "success";
		$data['result']= $this->load->view('messages/view_message', $v_data, true);
		$data['receiver_id']= $receiver_id;
		$data['received_messages']= $this->profile_model->count_received_messages($v_data['messages']);
		echo json_encode($data);
	}
	
	public function count_unread_messages()
	{
		$data['total_received'] = $this->messages_model->count_unread_messages($client_id, $this->messages_path);
		$data['messages'] = $this->view_last_messages($client_id);
		$data['account_balance'] = $this->account_balance;
		
		echo json_encode($data);
	}
	
	public function count_unread_messages2()
	{
		$data['total_received'] = $this->messages_model->count_unread_messages(5, $this->messages_path);
		$data['messages'] = $this->view_last_messages(5);
		$v_data['account_balance'] = $this->account_balance;
		
		echo json_encode($data);
	}
	
	public function new_single_message_check($receiver_id)
	{
		$v_data['smiley_location'] = $this->smiley_location;
		$v_data['receiver'] = $this->profile_model->get_client($receiver_id);
		$v_data['sender'] = $this->profile_model->get_client($client_id);
		$v_data['messages'] = $this->profile_model->get_messages($client_id, $receiver_id, $this->messages_path);
		$v_data['received_messages'] = $this->profile_model->count_received_messages($v_data['messages']);
		$v_data['profile_image_location'] = $this->profile_image_location;
		$v_data['profile_image_path'] = $this->profile_image_path;
		
		$data['message'] = $this->load->view('messages/new_message', $v_data, true);
		$data['curr_message_count'] = $v_data['received_messages'];
		
		echo json_encode($data);
	}
	
	public function send_message($receiver_id, $page = NULL)
	{
		$v_data['smiley_location'] = $this->smiley_location;
		$v_data['receiver'] = $this->profile_model->get_client($receiver_id);
		$v_data['sender'] = $this->profile_model->get_client($client_id);
		$v_data['messages'] = $this->profile_model->get_messages($client_id, $receiver_id, $this->messages_path);
		$v_data['received_messages'] = $this->profile_model->count_received_messages($v_data['messages']);
		$v_data['profile_image_location'] = $this->profile_image_location;
		
		//make payment if message was sent
		if($page > 0)
		{
		}
		
		if($page == 1)
		{
			$data['messages'] = $this->load->view('messages/message_details', $v_data, true);
			$data['curr_message_count'] = $v_data['received_messages'];
			$data['account_balance'] = $this->payments_model->get_account_balance($this->session->userdata('client_id'));
			
			echo json_encode($data);
		}
		
		else if($page == 2)
		{
			$data['messages'] = $this->load->view('account/modal_messages', $v_data, true);
			$data['curr_message_count'] = $v_data['received_messages'];
			$data['account_balance'] = $this->payments_model->get_account_balance($this->session->userdata('client_id'));
			
			echo json_encode($data);
		}
		
		else
		{
			//for smileys
			$image_array = get_clickable_smileys($this->smiley_location, 'instant_message');
			$col_array = $this->table->make_columns($image_array, 12);
			
			$v_data['smiley_table'] = $this->profile_model->generate_emoticons($col_array);
			$v_data['account_balance'] = $this->account_balance;
			
			echo $this->load->view('account/message', $v_data, true);
		}
	}
	
	public function message_profile($page = NULL)
	{
		/*$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('client_message_details', 'Message', 'required|xss_clean');*/
		$message = $this->input->post('client_message_details');
		$receiver_id = $this->input->post('receiver_id');
		$client_id = $this->input->post('client_id');
		
		if(!empty($message))
		{
			$data['client_message_details'] = $message;
			$data['client_id'] = $client_id;
			$data['receiver_id'] = $receiver_id;
			$data['created'] = date('Y-m-d H:i:s');
			$content = json_encode($data);
			$return = array();
			
			//create file name
			$file_name = $this->profile_model->create_file_name($client_id, $receiver_id);
			$file_path = $this->messages_path.'//'.$file_name;
			$base_path = $this->messages_path;
			
			//check if file exists
			if(!$this->file_model->check_if_file_exists($file_path, $base_path))
			{
				//create file if not exists
				if($this->file_model->create_file($file_path, $base_path))
				{
					$this->file_model->write_to_file($file_path, $content);
					$return = $this->view_sent_message($data['client_message_details'], $client_id, $data['created']);
				}
				
				else
				{
					$return = 'false1';
				}
			}
			
			else
			{
				$this->file_model->write_to_file($file_path, $content);
				$return = $this->view_sent_message($data['client_message_details'], $client_id, $data['created']);
			}
		}
		
		else
		{
			$return = 'false';
		}
		
		echo json_encode($return);
	}
	
	public function view_sent_message($message, $client_id, $created)
	{
		$sender = $this->profile_model->get_client($client_id);
		if($sender->num_rows() > 0)
		{
			$row = $sender->row();
			$client_username = $row->username;
			$client_thumb = '';
			$client_thumb = 'user.png';
		}
		$data['message'] = '<div class="message message-sent"><div class="message-text">'.$message.'</div><div class="messages-date">'.date('jS M Y',strtotime($created)).' <span>'.date('H:i a',strtotime($created)).'</span></div></div><div class="message message-sent message-pic"><div class="message-label">Delivered</div></div>';
				
		return $data;
	}
	
	public function view_last_messages($client_id)
	{
		//get all unread messages from the db
		$unread_query = $this->messages_model->get_unread_messages($client_id);
		$return = array();
		//echo $unread_query->num_rows();
		//get all unread messages data
		if($unread_query->num_rows() > 0)
		{
			foreach($unread_query->result() as $res)
			{
				$last_receiver_web_name = $res->last_receiver_web_name;
				$last_sender_web_name = $res->last_sender_web_name;
				$file_name = $res->message_file_name;
				
				$receiver_id = $this->messages_model->get_receiver_id($last_sender_web_name);
				$v_data['sender'] = $this->profile_model->get_client($receiver_id);
				$v_data['messages'] = $this->profile_model->get_last_messages($file_name, $this->messages_path);
		
				$data['result']= $this->load->view('messages/view_last_message', $v_data, true);
				$data['web_name']= $last_receiver_web_name;
				$data['sender_web_name']= $last_sender_web_name;
				array_push($return, $data);
			}
			//mark messages as retrieved
			$data_update['read_status'] = 1;
			$this->db->where('read_status = 0 AND last_receiver_id = '.$client_id);
			$this->db->update('client_message', $data_update);
		}
		return $return;
	}
}