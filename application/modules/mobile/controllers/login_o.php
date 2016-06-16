<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
	
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
		
		$this->load->model('login_model');
		$this->load->model('email_model');
		
		$this->load->library('Mandrill', $this->config->item('mandrill_key'));
	}
	
	public function get_logged_in_member()
	{
		$newdata = array(
                   'member_email'     		=> $this->session->userdata('member_email'),
                   'member_first_name'     	=> $this->session->userdata('member_first_name'),
                   'member_id'  			=> $this->session->userdata('member_id'),
                   'member_code'  			=> $this->session->userdata('member_code')
               );
		
		$response['result'] = $newdata;
		
		echo json_encode($newdata);
	}
    
	// public function login_member($member_email = '', $member_password = '') 
	// {
	// 	$result = $this->login_model->validate_member($member_email, $member_password);
		
	// 	if($result != FALSE)
	// 	{
	// 		//create user's login session
	// 		$newdata = array(
 //                   'member_login_status'    => TRUE,
 //                   'member_email'     		=> $result[0]->member_email,
 //                   'member_first_name'     	=> $result[0]->member_first_name,
 //                   'member_id'  			=> $result[0]->member_id,
 //                   'member_code'  			=> md5($result[0]->member_id)
 //               );
	// 		$this->session->set_userdata($newdata);
			
	// 		$response['message'] = 'success';
	// 		$response['result'] = $newdata;
	// 	}
		
	// 	else
	// 	{
	// 		$response['message'] = 'fail';
	// 		$response['result'] = 'You have entered incorrect details. Please try again';
	// 	}
		
	// 	//echo $_GET['callback'].'(' . json_encode($response) . ')';
	// 	echo json_encode($response);
	// }
	
	public function login_member($member_email = '', $member_password = '') 
	{
		$result = $this->login_model->validate_member($member_email, $member_password);
		
		if($result != FALSE)
		{
			//create user's login session
			$newdata = array(
                   'member_login_status'    => TRUE,
                   'member_email'     		=> $result[0]->email,
                   'member_first_name'     	=> $result[0]->name,
                   'member_id'  			=> $result[0]->id,
                   'member_code'  			=> $result[0]->username
               );
			$this->session->set_userdata($newdata);
			
			$response['message'] = 'success';
			$response['result'] = $newdata;
		}
		
		else
		{
			$response['message'] = 'fail';
			$response['result'] = 'You have entered incorrect details. Please try again';
		}
		
		//echo $_GET['callback'].'(' . json_encode($response) . ')';
		echo json_encode($response);
	}
	public function dummy()
	{
		$return[0]['firstName'] = 'James';
		$return[0]['lastName'] = 'King';
		$return[1]['firstName'] = 'Eugene';
		$return[1]['lastName'] = 'Lee';
		$return[2]['firstName'] = 'Julie';
		$return[2]['lastName'] = 'Taylor';
		
		echo json_encode($return);
	}
	
	public function register_user()
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			$query = $this->login_model->register_member_details();
			if($query->num_rows() > 0)
			{
				// the user exisits in the database

				if($this->login_model->send_account_verification_email())
				{
					$response['message'] = 'success';
					$response['result'] = 'You have successfully created your account. Please check your email so that you can activate your account';
				}
				
				else
				{
					$response['message'] = 'fail';
					$response['result'] = 'Unable to send account verification email. Please contact us for details on how to activate your account';
				}
			}
			
			else
			{
				$response['message'] = 'fail';
				$response['result'] = 'Unable to create account. Please try again';
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				$response['message'] = 'fail';
			 	$response['result'] = $validation_errors;
			}
			
			//populate form data on initial load of page
			else
			{
				$response['message'] = 'fail';
				$response['result'] = 'Ensure that you have entered all the values in the form provided';
			}
		}
		echo json_encode($response);
	}
	
	public function activate_account($member_id)
	{
		$data['member_status'] = 1;
		$this->db->where('member_id', $member_id);
		$this->db->update('member', $data);
		
		redirect('mobile/login/success');
	}
	
	public function get_client_profile()
	{
		$v_data['profile_query'] = $this->login_model->get_profile_details();
		

		$response['message'] = 'success';
		$response['result'] = $this->load->view('member_profile', $v_data, true);

		echo json_encode($response);
	}
	public function success()
	{
		echo '<h3>Thank you for activating your account</h3><p>You can now log into our mobile application</p>';
	}
	public function post_cpd_query()
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('member_id', 'member_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('question', 'question', 'trim|required|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->login_model->post_cpd_query())
			{
				
					$response['message'] = 'success';
					$response['result'] = 'Thank you for contact us, we will address your issue and get back to you shortly.';
				
			}
			
			else
			{
					$response['message'] = 'fail';
					$response['result'] = 'Unable to create account. Please try again';
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				$response['message'] = 'fail';
			 	$response['result'] = $validation_errors;
			}
			
			//populate form data on initial load of page
			else
			{
				$response['message'] = 'fail';
				$response['result'] = 'Ensure that you have entered all the values in the form provided';
			}
		}
		echo json_encode($response);
	}
}