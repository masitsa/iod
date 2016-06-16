<?php
require_once "./application/libraries/OAuth.php";

class Member_model extends CI_Model 
{
	public function register_member_details()
	{
		  $companydata = array(
		  'company_name' => $this->input->post('company_name'),
		  'company_physical_address' => $this->input->post('company_physical_address'),
		  'company_postal_address' => $this->input->post('company_postal_address'),
		  'company_post_code' => $this->input->post('company_postal_code'),
		  'company_town' => $this->input->post('company_town'),
		  'company_email' => $this->input->post('company_email'),
		  'company_phone' => $this->input->post('company_phone'),
		  'company_cell_phone' => $this->input->post('company_cell_phone'),
		  'company_facsimile' => $this->input->post('company_facsimile'),
		  'company_activity' => $this->input->post('company_activity'),
		  );
		  
		if($this->db->insert('company',$companydata))
		{
			$company_id = $this->db->insert_id();
			
			$member_number = $this->member_model->create_member_number();
			$newdata = array(
				   'member_first_name'			=> $this->input->post('member_first_name'),
				   'member_surname'				=> $this->input->post('member_surname'),
				   'member_phone'				=> $this->input->post('member_phone'),
				   'member_email'				=> strtolower($this->input->post('member_email')),
				   'member_password'			=> md5($this->input->post('member_password')),
				   'member_title'				=> $this->input->post('member_title'),
				   'date_of_birth'				=> $this->input->post('date_of_birth'),
				   'nationality'				=> $this->input->post('nationality'),
				   'company_id'					=> $company_id,
				   'qualifications'				=> $this->input->post('qualifications'),
				   'designation'				=> $this->input->post('designation'),
				   'member_title'				=> $this->input->post('member_title'),
				   'member_number'				=> $member_number,
				   'registration_method_id'		=> 1,
				   'created'     				=> date('Y-m-d H:i:s')
			   );
			if($this->db->insert('member', $newdata))
			{
				$member_id = $this->db->insert_id();
				if($this->invoices_model->create_new_member_invoice($member_id))
				{
					$this->validate_member();
				}
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}
	
	public function update_member_details($member_id)
	{
		$parent_neighbourhood = $this->input->post('parent');
		$child_neighbourhood = $this->input->post('child');
		
		if(empty($child_neighbourhood))
		{
			$neighbourhood_id = $parent_neighbourhood;
		}
		else
		{
			$neighbourhood_id = $child_neighbourhood;
		}
		$newdata = array(
			   'member_first_name'		=> $this->input->post('member_first_name'),
			   'member_surname'			=> $this->input->post('member_surname'),
			   'member_phone'				=> $this->input->post('member_phone'),
			   'neighbourhood_id'			=> $neighbourhood_id
		   );
		
		$this->db->where('member_id', $member_id);
		if($this->db->update('member', $newdata))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_neighbourhoods()
	{
		$this->db->where('neighbourhood_parent', NULL);
		$this->db->order_by('neighbourhood_name');
		$query = $this->db->get('neighbourhood');
		
		$this->db->where('neighbourhood_parent > 0');
		$this->db->order_by('neighbourhood_name');
		$query2 = $this->db->get('neighbourhood');
		
		$data['neighbourhood_parents'] = $query;
		$data['neighbourhood_children'] = $query2;
		
		return $data;
	}
	
	public function check_email($member_email)
	{
		$this->db->where('member_email', $member_email);
		$query = $this->db->get('member');
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
	
	/*
	*	Validate a member's login request
	*
	*/
	public function validate_member()
	{
		//select the member by email from the database
		$this->db->select('*');
		$this->db->where(array('member_email' => strtolower($this->input->post('member_email')), 'member_status' => 1, 'member_activated' => 1, 'member_password' => md5($this->input->post('member_password'))));
		$query = $this->db->get('member');
		
		//if member exists
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			//create member's login session
			$newdata = array(
                   'member_login_status'     => TRUE,
                   'first_name'     => $result[0]->member_first_name,
                   'email'     => $result[0]->member_email,
                   'member_id'  => $result[0]->member_id,
                   'member'  => 1
               );
			$this->session->set_userdata($newdata);
			
			//update member's last login date time
			$this->update_member_login($result[0]->member_id);
			return TRUE;
		}
		
		//if member doesn't exist
		else
		{
			return FALSE;
		}
	}
	
	/*
	*	Check if member has logged in
	*
	*/
	public function check_login()
	{
		if($this->session->userdata('member_login_status'))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
	
	/*
	*	Update member's last login date
	*
	*/
	private function update_member_login($member_id)
	{
		$data['last_login'] = date('Y-m-d H:i:s');
		$this->db->where('member_id', $member_id);
		$this->db->update('member', $data); 
	}
	
	/*
	*	Reset a member's password
	*
	*/
	public function reset_password($member_id)
	{
		$new_password = substr(md5(date('Y-m-d H:i:s')), 0, 6);
		
		$data['password'] = md5($new_password);
		$this->db->where('member_id', $member_id);
		$this->db->update('member', $data); 
		
		return $new_password;
	}
	
	public function send_registration_email($member_email, $member_first_name)
	{
		//send account registration email
		$this->load->library('Mandrill', $this->config->item('mandrill_key'));
		$this->load->model('site/email_model');
		
		$client_email = $member_email;
		$client_username = $member_first_name;
		$sender_email = 'info@dobi.co.ke';
		$subject = 'Welcome to Dobi';
		$message = '
			<p>Someone (hopefully you) has successfully registered an account on '.site_url().'. You are now set up to the easiest laundry service IN YOUR OWN NEIGHBOURHOOD!!.</p>
			
			<p>
				You can do this by:
				<ol>
					<li>Going to '.site_url().'.</li>
					<li>Selecting the categories you need washed and their appropriate quantities e.g. two shirts</li>
					<li>Making the payment for your laundry</li>
				</ol>
			</p>
			
			<p>
				Depending on the options of the provider that you pick you may either have to drop of your laundry or have it picked from your house.
			</p>
			
			<p>And thats all! Go to '.site_url().'. to get started!</p>
		';
		$shopping = "<p>Happy washing<br/>The Dobi Team</p>";
		$from = 'Dobi';
		
		$button = '<a class="mcnButton " title="Find a dobi" href="'.site_url().'member-login" target="_blank" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">Find a dobi</a>';
		//echo $client_email.'<br/>'."Hi ".$client_username.'<br/>'.$subject.'<br/>'.$message.'<br/>'.$sender_email.'<br/>'.$shopping.'<br/>'.$from.'<br/>'.$button;
		$response = $this->email_model->send_mandrill_mail($client_email, "Hi ".$client_username, $subject, $message, $sender_email, $shopping, $from, $button, $cc = NULL);
		
		return $response;
	}
	
	public function get_member_details($member_id)
	{
		$this->db->where('member_id', $member_id);
		
		return $this->db->get('member');
	}
	
	/*
	*	Edit an existing user's password
	*	@param int $user_id
	*
	*/
	public function edit_password($member_id)
	{
		if($this->input->post('slug') == md5($this->input->post('current_password')))
		{
			if($this->input->post('new_password') == $this->input->post('confirm_password'))
			{
				$data['member_password'] = md5($this->input->post('new_password'));
		
				$this->db->where('member_id', $member_id);
				
				if($this->db->update('member', $data))
				{
					$return['result'] = TRUE;
				}
				else{
					$return['result'] = FALSE;
					$return['message'] = 'Oops something went wrong and your password could not be updated. Please try again';
				}
			}
			else{
				$return['result'] = FALSE;
				$return['message'] = 'New Password and Confirm Password don\'t match';
			}
		}
		
		else
		{
			$return['result'] = FALSE;
			$return['message'] = 'You current password is not correct. Please try again';
		}
		
		return $return;
	}
	
	/*
	*	Create invoice number
	*
	*/
	public function create_member_number()
	{
		//select product code
		$preffix = "MIoD";
		$this->db->from('member');
		$this->db->where("member_number LIKE '".$preffix."%'");
		$this->db->select('MAX(member_number) AS number');
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
	
	// pesa pal payments
	public function make_pesapal_payment($total, $invoice_number, $invoice_id, $member_id)
	{
		//$api = 'http://demo.pesapal.com';
		$api = 'https://www.pesapal.com';
	
		$token = $params 	= NULL;
		$iframelink 		= $api.'/api/PostPesapalDirectOrderV4';
		
		//Kenyan keys
		$consumer_key 		= $this->config->item('consumer_key'); //fill key here
		$consumer_secret 	= $this->config->item('consumer_secret'); //fill secret here
		 
		$signature_method	= new OAuthSignatureMethod_HMAC_SHA1();
		$consumer 			= new OAuthConsumer($consumer_key, $consumer_secret);
		
		//payment data
		$amount = $total;//$this->input->post('credit_type_amount');
		
		//save client credit
		/*$data = array
		(
			'credit_type_id' => $this->input->post('credit_type_id'),
			'client_id' => $client_id,
			'purchase_amount' => $amount,
			'client_credit_amount' => $this->input->post('credit_type_credits'),
			'created' => date('Y-m-d H:i:s')
		);
		
		$this->db->insert('client_credit', $data);*/
		$client_credit_id = 1;//$this->db->insert_id();
		
		//$amount 		= str_replace(',','',$amount); // remove thousands seperator if included
		$amount 		= number_format($amount, 2); //format amount to 2 decimal places
		$desc 			= 'Payment for Invoice ';$invoice_number;
		$type 			= 'MERCHANT';	
		$first_name 	= '';
		$last_name 		= '';
		$email 			= 'support@omnis.co.ke';//$this->session->userdata('client_email');
		$phonenumber	= '';
		$currency 		= "KES";//$_POST['currency'];
		$reference 		= $invoice_id;// $_POST['reference']; //unique transaction id, generated by merchant.
		$callback_url 	= site_url().'member/payment-success/'.$total.'/'.$member_id;//'http://localhost/pbf/demo/redirect.php'; //URL user to be redirected to after payment
		
		//Record order in your database.
		/*$database = new pesapalDatabase();
		$database->store($_POST);*/ 
			
		$post_xml	= "<?xml version=\"1.0\" encoding=\"utf-8\"?>
					   <PesapalDirectOrderInfo 
							xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" 
							xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" 
							Currency=\"".$currency."\" 
							Amount=\"".$amount."\" 
							Description=\"".$desc."\" 
							Type=\"".$type."\" 
							Reference=\"".$reference."\" 
							FirstName=\"".$first_name."\" 
							LastName=\"".$last_name."\" 
							Email=\"".$email."\" 
							PhoneNumber=\"".$phonenumber."\" 
							xmlns=\"http://www.pesapal.com\" />";
		$post_xml = htmlentities($post_xml);
		
		//post transaction to pesapal
		$iframe_src = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $iframelink, $params);
		$iframe_src->set_parameter("oauth_callback", $callback_url);
		$iframe_src->set_parameter("pesapal_request_data", $post_xml);
		$iframe_src->sign_request($signature_method, $consumer, $token);
		return $iframe_src;
	}
	
	public function create_payment($transaction_tracking_id, $invoice_id, $total, $member_id)
	{
		$receipt_number = $this->generate_receipt_number();
		$payment_data = array(
			'transaction_tracking_id' => $transaction_tracking_id,
			'invoice_id' =>$invoice_id,
			'payment_amount' =>$total,
			'member_id' =>$member_id,
			'payment_date' =>date('Y-m-d h-i-s'),
			'reciept_number' =>$receipt_number
			);
		if($this->db->insert('payment',$payment_data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	//generate reciept numbers
	public function generate_receipt_number()
	{
		//select product code
		$preffix = "IoD/R/";
		$this->db->from('payment');
		$this->db->where("reciept_number LIKE '".$preffix."%'");
		$this->db->select('MAX(reciept_number) AS number');
		$query = $this->db->get();//echo $query->num_rows();
		
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$reciept_number =  $result[0]->number;
			$real_number = str_replace($preffix, "", $reciept_number);
			$real_number++;//go to the next number
			$reciept_number = $preffix.sprintf('%03d', $real_number);
		}
		else{//start generating receipt numbers
			$reciept_number = $preffix.sprintf('%03d', 1);
		}
		
		return $reciept_number;
	}
}