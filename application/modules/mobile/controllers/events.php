<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Events extends MX_Controller {
	function __construct()
	{
		parent:: __construct();

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
		$this->load->model('events_model');
		$this->load->model('email_model');

	}

	public function get_events() 
	{

		$query = $this->events_model->get_events();
		$v_data['trainings'] = $query;
		$response['message'] = 'success';
		$response['result'] = $this->load->view('events', $v_data, true);
		echo json_encode($response);

	}

	public function get_event_detail($id)
	{
		$query = $this->events_model->get_event_detail($id);
		$v_data['trainings'] = $query;
		$v_data['id'] = $id;
		$response['message'] = 'success';
		$response['result'] = $this->load->view('event_detail', $v_data, true);
		echo json_encode($response);

	}
}