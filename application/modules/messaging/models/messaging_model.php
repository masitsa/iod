<?php
date_default_timezone_set('Africa/Nairobi');
class Messaging_model extends CI_Model 
{
	/*
	*	Count all items from a table
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function count_items($table, $where, $limit = NULL)
	{
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		$this->db->from($table);
		$this->db->where($where);
		return $this->db->count_all_results();
	}

	/*
	*	Retrieve all personnel
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_messages($table, $where, $per_page, $page, $order = 'messages.message_id', $order_method = 'DESC')
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
		/*
	*	Retrieve all leases
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_message_details($table, $where, $per_page, $page, $order = 'messages.entryid', $order_method = 'ASC')
	{
		//retrieve all leases
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}

		/*
	*	Retrieve all leases
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_schedule_details($table, $where, $per_page, $page, $order = 'schedules.schedule_id', $order_method = 'ASC')
	{
		//retrieve all leases
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
		/*
	*	Retrieve all personnel
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_message_templates($table, $where, $per_page, $page, $order = 'message_template.message_template_id', $order_method = 'DESC')
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
			/*
	*	Retrieve all personnel
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_message_template_batches($table, $where, $per_page, $page, $order = 'message_batch.message_batch_code', $order_method = 'DESC')
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}



	/*
	*	Import Template
	*
	*/
	function import_template()
	{
		$this->load->library('Excel');
		
		$title = 'Rental Import Template';
		$count=1;
		$row_count=0;
		
		$report[$row_count][0] = 'Unit Name';
		$report[$row_count][1] = 'Tenant Name';
		$report[$row_count][2] = 'Tenant Phone Number';
		$report[$row_count][3] = 'Arreas';
		
		$row_count++;
		
		//create the excel document
		$this->excel->addArray ( $report );
		$this->excel->generateXML ($title);
	}

	public function import_csv_charges($upload_path, $service_id)
	{
		//load the file model
		$this->load->model('admin/file_model');
		/*
			-----------------------------------------------------------------------------------------
			Upload csv
			-----------------------------------------------------------------------------------------
		*/
		$response = $this->file_model->upload_csv($upload_path, 'import_csv');
		
		if($response['check'])
		{
			$file_name = $response['file_name'];
			
			$array = $this->file_model->get_array_from_csv($upload_path.'/'.$file_name);
			//var_dump($array); die();
			$response2 = $this->sort_csv_charges_data($array, $service_id);
		
			if($this->file_model->delete_file($upload_path."\\".$file_name, $upload_path))
			{
			}
			
			return $response2;
		}
		
		else
		{
			$this->session->set_userdata('error_message', $response['error']);
			return FALSE;
		}
	}
	public function sort_csv_charges_data($array, $message_category_id)
	{
		//count total rows
		$total_rows = count($array);
		$total_columns = count($array[0]);
		
		
		//if products exist in array
		if(($total_rows > 0) && ($total_columns == 4))
		{
			$count = 0;
			$comment = '';
			$items['modified_by'] = $this->session->userdata('personnel_id');
			
			//retrieve the data from array
			for($r = 1; $r < $total_rows; $r++)
			{
				$messaging_unit_name = $array[$r][0];
				$messaging_tenant_name = ucwords(strtolower($array[$r][1]));
				$messaging_tenant_phone_number = $array[$r][2];
				$messaging_arreas = $array[$r][3];
				
				$count++;
				
				// service charge entry
				$service_charge_insert = array(
								"messaging_tenant_name" => $messaging_tenant_name,
								"message_category_id" => $message_category_id,
								"messaging_unit_name" => $messaging_unit_name,
								"messaging_arreas" => $messaging_arreas,
								"messaging_tenant_phone_number" => $messaging_tenant_phone_number,
								"date_created" => date("Y-m-d"),
								"created_by" => $this->session->userdata('personnel_id'),
								"branch_code" => $this->session->userdata('branch_code'),
								'sent_status' => 0,
							);
				
					if($this->db->insert('messaging', $service_charge_insert))
					{
						$comment .= '<br/>Details successfully added to the database';
						$class = 'success';
					}
					
					else
					{
						$comment .= '<br/>Not saved internal error';
						$class = 'danger';
					}
			}	
			$return['response'] = TRUE;
			$return['check'] = TRUE;
				
		}
		else
		{
			$return['response'] = FALSE;
			$return['check'] = FALSE;
		}
		
		return $return;
	}


	public function send_unsent_messages()
	{
		$where = 'messaging.message_category_id = message_category.message_category_id AND messaging.sent_status = 0 AND messaging.branch_code = "'. $this->session->userdata('branch_code').'"';
		$table = 'messaging, message_category';
		
		$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $row) {
				# code...
				$messaging_id = $row->messaging_id;
				$messaging_tenant_name = $row->messaging_tenant_name;
				$messaging_unit_name = $row->messaging_unit_name;
				$messaging_arreas = $row->messaging_arreas;
				$date_created = $row->date_created;
				$messaging_tenant_phone_number = $row->messaging_tenant_phone_number;
				$message_category_id = $row->message_category_id;
				$message_category_name = $row->message_category_name;
				$branch_code = $row->branch_code;
				$sent_status = $row->sent_status;

				$delivery_message = "Hello ".$messaging_tenant_name.", your outstanding ".$message_category_name." is KES. ".$messaging_arreas.".";
           
				$response = $this->sms($messaging_tenant_phone_number,$delivery_message);

				if($response == "Success" OR $response == "success")
				{
					$service_charge_update = array('sent_status' => 1);
					$this->db->where('messaging_id',$messaging_id);
					$this->db->update('messaging', $service_charge_update);

				}
				else
				{
					$service_charge_update = array('sent_status' => 0);
					$this->db->where('messaging_id',$messaging_id);
					$this->db->update('messaging', $service_charge_update);
				}

			}
		}
		else
		{

		}
		
	}

	public function send_batch_messages($message_batch_id)
	{
		$where = 'message_batch_id = '.$message_batch_id;
		$table = 'messages';
		
		$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $row) {
				# code...
				$message_batch_id = $row->message_batch_id;
				$message = $row->message;
				$message_id = $row->message_id;
				$phone_number = $row->phone_number;
				$response = $this->sms($phone_number,$message);
				$cost = 1.5;
				$cost = $this->messaging_model->get_total_cost();
				$total_amount = $this->messaging_model->get_amount_toped_up();
				$balance = $total_amount-$cost;
				if($balance == 0)
				{	

					$service_charge_update = array('message_status' => 2,'delivery_message'=>'Insufficient Balance','sms_cost'=>0);
					$this->db->where('message_id',$message_id);
					$this->db->update('messages', $service_charge_update);

				}
				
				else
				{
					if($response == "Success" OR $response == "success")
					{
						$service_charge_update = array('message_status' => 1,'delivery_message'=>'success','sms_cost'=>1.5);
						$this->db->where('message_id',$message_id);
						$this->db->update('messages', $service_charge_update);

					}
					else if($response == "error message")
					{
						$service_charge_update = array('message_status' => 2,'delivery_message'=>'something went wrong','sms_cost'=>0);
						$this->db->where('message_id',$message_id);
						$this->db->update('messages', $service_charge_update);
					}
					else
					{
						$service_charge_update = array('message_status' => 2,'delivery_message'=>$response,'sms_cost'=>0);
						$this->db->where('message_id',$message_id);
						$this->db->update('messages', $service_charge_update);

					}
				}
			}
			$service_charge_update = array('message_batch_status' => 1);
			$this->db->where('message_batch_id',$message_batch_id);
			$this->db->update('message_batch', $service_charge_update);
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	
	public function get_configuration()
	{
		return $this->db->get('configuration');
	}

	public function sms($phone,$message)
	{
        // This will override any configuration parameters set on the config file
		// max of 160 characters
		// to get a unique name make payment of 8700 to Africastalking/SMSLeopard
		// unique name should have a maximum of 11 characters
		if (substr($phone, 0, 1) === '0') 
		{
			$phone = ltrim($phone, '0');
		}
		
		$phone_number = '+254'.$phone;
		// get items 

		$configuration = $this->messaging_model->get_configuration();

		$mandrill = '';
		$configuration_id = 0;
		
		if($configuration->num_rows() > 0)
		{
			$res = $configuration->row();
			$configuration_id = $res->configuration_id;
			$mandrill = $res->mandrill;
			$sms_key = $res->sms_key;
			$sms_user = $res->sms_user;
	        $sms_suffix = $res->sms_suffix;
	        $sms_from = $res->sms_from;
		}
	    else
	    {
	        $configuration_id = '';
	        $mandrill = '';
	        $sms_key = '';
	        $sms_user = '';
	        $sms_suffix = '';

	    }

	    $actual_message = $message.' '.$sms_suffix;
	    // var_dump($actual_message); die();
		// get the current branch code
		$params = array('username' => $sms_user, 'apiKey' => $sms_key);  

		$this->load->library('africastalkinggateway', $params);
		// var_dump($params)or die();
        // Send the message
		try 
		{
			//$results = $this->africastalkinggateway->sendMessage($phone_number, $actual_message, $sms_from=22384);
			$results = $this->africastalkinggateway->sendMessage($phone_number, $actual_message);
			
			//var_dump($results);die();
			foreach($results as $result) {
				// status is either "Success" or "error message"
				// echo " Number: " .$result->number;
				// echo " Status: " .$result->status;
				// echo " MessageId: " .$result->messageId;
				// echo " Cost: "   .$result->cost."\n";
			}
			return $result->status;

		}
		
		catch(AfricasTalkingGatewayException $e)
		{
			// echo "Encountered an error while sending: ".$e->getMessage();
			return $e->getMessage();
		}
    }
    /*
	*	Add a new category
	*	@param string $image_name
	*
	*/
	public function add_message_template()
	{
		// var_dump($_POST['']);die();
		$data = array(
				'message_template_code'=>$this->input->post('template_code'),
				'message_template_description'=>$this->input->post('template_description'),
				'message_template_status'=>1,
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('user_id'),
				'modified_by'=>$this->session->userdata('user_id')
			);

		// var_dump($data);die();
			
		if($this->db->insert('message_template', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing message_template
	*	@param string $image_name
	*	@param int $message_template_id
	*
	*/
	public function update_message_template($message_template_id)
	{
		$data = array(
				'message_template_code'=>$this->input->post('template_code'),
				'message_template_description'=>$this->input->post('template_description'),
				'message_template_status'=>1,
				'modified_by'=>$this->session->userdata('user_id')
			);
			
		$this->db->where('message_template_id', $message_template_id);
		if($this->db->update('message_template', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/*
	*	Activate a deactivated category
	*	@param int $category_id
	*
	*/
	public function activate_message_template($message_template_id)
	{
		$data = array(
				'message_template_status' => 1
			);
		$this->db->where('message_template_id', $message_template_id);
		
		if($this->db->update('message_template', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated message_template
	*	@param int $message_template_id
	*
	*/
	public function deactivate_message_template($message_template_id)
	{
		$data = array(
				'message_template_status' => 0
			);
		$this->db->where('message_template_id', $message_template_id);
		
		if($this->db->update('message_template', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/*
	*	get a single category's details
	*	@param int $category_id
	*
	*/
	public function get_message_template($message_template_id)
	{
		//retrieve all users
		$this->db->from('message_template');
		$this->db->select('*');
		$this->db->where('message_template_id = '.$message_template_id);
		$query = $this->db->get();
		
		return $query;
	}
	public function get_active_contacts($group_by)
	{
		//retrieve all users
		$this->db->from('member');
		$this->db->where('member_status', 1);
		$this->db->group_by($group_by);
		// $this->db->where('message_template_id = '.$message_template_id);
		$query = $this->db->get();
		
		return $query;

	}

	public function get_sample_text($message_template_description)
	{
		preg_match_all("/\[([^\]]*)\]/", $message_template_description, $matches);
		// var_dump($matches[1]);
		$select = '';
		$count = 0;
		$array_count = count($matches[1]);
		foreach ($matches[1] as $key) {
			# code...
			$count++;
			$select .= ''.$key.'';
			if($count < $array_count)
			{
				$select .= ',';
			}

			
		}
		$this->db->from('allcounties');
		$this->db->select($select);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			$healthy = $matches[1];
			// var_dump($query->result());
			$array = array();
			$website = $message_template_description;
			foreach ($query->result() as $key_item) {
					
					foreach ($matches[1] as $key) {
						if($key == 'name')
						{
							// echo $key_item->Firstname;
							$website = str_replace('[name]', $key_item->name, $website);
						}
						if($key == 'balance')
						{
							$website = str_replace('[balance]', $key_item->balance, $website);
							// echo $key_item->Countyname;
						}
					}
					return $website;


			}
		}

	}
	public function create_batch($message_template_id)
	{
		 $search_template = $this->session->userdata('search_template');
		 $message_template_description = $_POST['message_template_description'];
		if(1>0)
		{

			$where = 'member_status  = 1';
			$this->db->where($where);
			$query = $this->db->get('member');
			if($query->num_rows() > 0)
			{
				$visit_data = array(
					"message_batch_code" => $this->create_batch_code(),
					"search_title" => $this->session->userdata('search_template'),
					"message_template_description" => $message_template_description,
					"message_template_id"=>$message_template_id,
					"search_template"=>$this->session->userdata('search_template'),
					"message_batch_status"=>0,
					"created"=>date('Y-m-d H:i:s')
				);
				$this->db->insert('message_batch', $visit_data);
				$message_batch_id = $this->db->insert_id();

				preg_match_all("/\[([^\]]*)\]/", $message_template_description, $matches);
				// var_dump($matches[1]);
				$select = '';
				$count = 0;
				$array_count = count($matches[1]);
				$website = $message_template_description;
				foreach ($query->result() as $key_item) {
					foreach ($matches[1] as $key) {

						if($key == 'name')
						{
							// echo $key_item->Firstname;
							$website = str_replace('[name]', $key_item->member_first_name.' '.$key_item->member_surname, $website);
						}
						/*if($key == 'balance')
						{
							$website = str_replace('[balance]', $key_item->balance, $website);
							// echo $key_item->Countyname;
						}*/
						# code...
					}
					// $message = $website;
					$entryid = $key_item->member_id;
					$Phonenumber = $key_item->member_phone;

				
					$message_data = array(
						"phone_number" => $Phonenumber,
						"entryid" => $entryid,
						"message" => $website,
						"message_batch_id"=>$message_batch_id
					);
					$this->db->insert('messages', $message_data);
					$website = $message_template_description;
					

				}
				return TRUE;
			}
			else
			{
				return FALSE;
			}


		}
		else
		{
			return FALSE;
		}

		
	}
	public function create_batch_code()
	{
		//select product code
		$preffix = "BIoD";
		$this->db->select('MAX(message_batch_code) AS number');
		$this->db->from('message_batch');
		$this->db->where("message_batch_code LIKE '".$preffix."%'");
		$query = $this->db->get();//echo $query->num_rows();
		
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$number =  $result[0]->number;
			$real_number = str_replace($preffix, "", $number);
			$real_number++;//go to the next number
			$number = $preffix.sprintf('%03d', $real_number);
		}
		else{//start generating receipt numbers
			$number = $preffix.sprintf('%03d', 1);
		}
		
		return $number;
	}
	public function get_total_cost()
	{
		$this->db->from('messages');
		$this->db->select('SUM(sms_cost) AS cost');
		$query = $this->db->get();
		$cost = 0;
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$cost =  $result[0]->cost;
			
			
		}
		else{//start generating receipt numbers
			$cost = 0;
		}
		return $cost;
	}
	public function get_message_schedules($message_batch_id)
	{
		$this->db->from('schedules,schedule_period');
		$this->db->select('*');
		$this->db->where('schedules.schedule_period_id = schedule_period.schedule_period_id');
		$query = $this->db->get();

		return $query;
	}
	public function all_schedule_period()
	{
		$this->db->from('schedule_period');
		$this->db->select('*');
		$query = $this->db->get();

		return $query;
	}

	public function get_amount_toped_up()
	{
		$amount = 1;
		/*$this->db->from('branch');
		$this->db->select('amount');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$amount =  $result[0]->amount;
			
			
		}
		else{//start generating receipt numbers
			$amount = 0;
		}*/
		return $amount;
	}
	public function delete_contact($message_id)
	{
		$this->db->where('message_id', $message_id);
		
		if($this->db->delete('messages'))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}

	public function add_schedule($message_batch_id)
	{
		// var_dump($_POST['schedule_time']); die();
		// if(empty(var))
		$data = array(
			'schedule_period_id'=>$this->input->post('schedule_period_id'),
			'schedule_date'=>$this->input->post('schedule_date'),
			'schedule_time'=>$this->input->post('schedule_time'),
			'created_by'=>$this->session->userdata('personnel_id'),
			'modified_by'=>$this->session->userdata('personnel_id'),
			'created'=>date('Y-m-d'),
			'schedule_status' => 1,
			'message_batch_id' => $message_batch_id

		);
		
		if($this->db->insert('schedules', $data))
		{
			return $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}

	public function send_cron_messages()
	{
		$this->db->from('schedules,message_batch,schedule_period');
		$this->db->select('*');
		$this->db->where('schedules.schedule_status = 1 AND schedules.schedule_period_id = schedule_period.schedule_period_id AND schedules.schedule_delete = 0 AND message_batch.message_batch_id = schedules.message_batch_id');
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{

			foreach ($query->result() as $key) {
				# code...
				 $schedule_date = $key->schedule_date;
				$schedule_time = $key->schedule_time;
				$message_batch_id = $key->message_batch_id;
				$schedule_id = $key->schedule_id;
				$schedule_period_id = $key->schedule_period_id;
				$schedule_period_name = $key->schedule_period_name;

				$search_template = $key->search_template;
				$message_template_description = $key->message_template_description;

				if(!empty($schedule_time))
				{

					if(!empty($schedule_date))
					{
						// check if its todays date 
						if($schedule_date == date('Y-m-d'))
						{
							
							// $schedule_time = date('H:i');
							// check if it this time
							if($schedule_time == date('H:i'))
							{
								// need to send message to the people who have been asked to be sent the messages
								// get the contacts that match the search creteria
								$result = $this->message_preparation($message_batch_id);

								$result = TRUE;

							}
							else
							{
								// just do nothing
								$result = TRUE;

							}
						}
						else
						{
							// just do nothing coz the date isnt today
							$result = FALSE;
						}
					}
					else
					{
						// just check if the time has been reached
						if($schedule_time == date('H:i'))
						{
							// need to send message to the people who have been asked to be sent the messages
							// get the contacts that match the search creteria
							$result = $this->message_preparation($message_batch_id);
							
						}
						else
						{
							// just do nothing
							$result = FALSE;

						}

					}
				}
				else
				{
					// just do nothing
					$result = FALSE;
				}

			}
			// end of the loop
		}

		
	}

	public function message_preparation($message_batch_id)
	{
		$where = 'message_batch_id = '.$message_batch_id;
		$table = 'messages';
		
		$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $row) {
				# code...
				$message_batch_id = $row->message_batch_id;
				$message = $row->message;
				$message_id = $row->message_id;
				$phone_number = 704808007;
				$counter = $row->counter;
				$response = $this->sms($phone_number,$message);
				$cost = 1.5;
				$cost = $this->messaging_model->get_total_cost();
				$total_amount = $this->messaging_model->get_amount_toped_up();
				$balance = $total_amount-$cost;
				if($balance == 0)
				{	

					$service_charge_update = array('message_status' => 2,'delivery_message'=>'Insufficient Balance','sms_cost'=>0);
					$this->db->where('message_id',$message_id);
					$this->db->update('messages', $service_charge_update);

				}
				
				else
				{

					if($response == "Success" OR $response == "success")
					{
						$counter++;
						$service_charge_update = array('message_status' => 1,'delivery_message'=>'success','sms_cost'=>1.5,'counter'=>$counter);
						$this->db->where('message_id',$message_id);
						$this->db->update('messages', $service_charge_update);

					}
					else if($response == "error message")
					{
						$service_charge_update = array('message_status' => 2,'delivery_message'=>'something went wrong','sms_cost'=>0);
						$this->db->where('message_id',$message_id);
						$this->db->update('messages', $service_charge_update);
					}
					else
					{
						$service_charge_update = array('message_status' => 2,'delivery_message'=>$response,'sms_cost'=>0);
						$this->db->where('message_id',$message_id);
						$this->db->update('messages', $service_charge_update);

					}
				}
			}
			$service_charge_update = array('message_batch_status' => 3);
			$this->db->where('message_batch_id',$message_batch_id);
			$this->db->update('message_batch', $service_charge_update);
			return TRUE;
		}
		else
		{
			return FALSE;
		}

		
	}

	
	
}
