<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Streaming extends MX_Controller {
	
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
		
		$this->load->model('streaming_model');
		$this->load->model('email_model');
	}
    
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function get_streaming_event() 
	{
		$query = $this->streaming_model->get_now_streaming_event();
		
		$v_data['query'] = $query;

		$response['message'] = 'success';
		$response['result'] = $this->load->view('streaming_live', $v_data, true);

		
		echo json_encode($response);
	}
	public function get_recording_event() 
	{
		$query = $this->streaming_model->get_now_recording_event();
		
		$v_data['query'] = $query;

		$response['message'] = 'success';
		$response['result'] = $this->load->view('recording_live', $v_data, true);

		
		echo json_encode($response);
	}
	
	
	
}