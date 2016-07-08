<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Resources extends MX_Controller {

	

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

		

		$this->load->model('resources_model');

		$this->load->model('email_model');

	}

    

	/*

	*

	*	Default action is to go to the home page

	*

	*/

	public function get_icpak_resources() 

	{

		$query = $this->resources_model->get_resources();

		

		$v_data['query'] = $query;



		$response['message'] = 'success';

		$response['result'] = $this->load->view('icpak_resources', $v_data, true);



		

		echo json_encode($response);

	}

	

	public function get_resources_detail($id)

	{

		$query = $this->resources_model->get_resources_detail($id);

		

		$v_data['query'] = $query;

		$v_data['id'] = $id;

		$response['message'] = 'success';

		$response['result'] = $this->load->view('resources_detail', $v_data, true);
		echo json_encode($response);



	}
	public function get_icpak_publications() 

	{

		$query = $this->resources_model->get_publications();

		

		$v_data['query'] = $query;



		$response['message'] = 'success';

		$response['result'] = $this->load->view('publication_list', $v_data, true);



		

		echo json_encode($response);

	}
	public function get_publication_detail($id)

	{

		$query = $this->resources_model->get_publication_detail($id);

		

		$v_data['query'] = $query;

		$v_data['id'] = $id;

		$response['message'] = 'success';

		$response['result'] = $this->load->view('publication_detail', $v_data, true);
		echo json_encode($response);



	}

	

}