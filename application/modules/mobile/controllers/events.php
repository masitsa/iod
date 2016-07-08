<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Events extends MX_Controller {

	

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

		

		$this->load->model('events_model');

		$this->load->model('email_model');

	}

    

	/*

	*

	*	Default action is to go to the home page

	*

	*/

	public function get_icpak_events() 

	{

		$query = $this->events_model->get_events();

		

		$v_data['query'] = $query;



		$response['message'] = 'success';

		$response['result'] = $this->load->view('icpak_events', $v_data, true);



		

		echo json_encode($response);

	}

	public function get_event_detail($id)

	{

		$query = $this->events_model->get_event_detail($id);

		

		$v_data['query'] = $query;

		$v_data['id'] = $id;

		$response['message'] = 'success';

		$response['result'] = $this->load->view('event_detail', $v_data, true);



		

		echo json_encode($response);

	}
	public function get_accomodations($post_id, $booking_refid)
	{

		$query = $this->events_model->get_event_detail($post_id);

		

		$v_data['query'] = $query;
		$v_data['booking_refid'] = $booking_refid;
		$v_data['id'] = $post_id;

		$response['message'] = 'success';

		$response['result'] = $this->load->view('event_accomodations', $v_data, true);
			echo json_encode($response);
	}


	public function book_member_to_event()
	{
		$post_id = $this->input->post('post_id');
		$booking_refid = $this->input->post('booking_refid');
		 $member_no = $this->input->post('member_no');
		$hotel = $this->input->post('hotel');
		$accomodation_refid = $this->input->post('accomodation_refid');
		$fee = $this->input->post('fee');


		// now do the things that should be done for this member to book for this event

		 $url = 'http://www.icpak.com:8080/icpakportal/api/events/'.$booking_refid.'/bookings/instantBooking';
		// $url = 'http://www.icpak.com:8080/icpakportal/api/events/dQdcmmGqPuw7wVzr/bookings/instantBooking';
		//Encode the array into JSON.
		$data = array('memberNo'=> $member_no);
		$data['accommodation']['refId'] = $accomodation_refid;
		//The JSON data.
		$data_string = json_encode($data);
		// echo $data_string;
	
		try
		{                                                                                                         

			$ch = curl_init($url);                                                                      
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                 
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
				'Content-Type: application/json',                                                                                
				'Content-Length: ' . strlen($data_string))                                                                       
			);                                                                                
			$result = curl_exec($ch);
			curl_close($ch);

			$json = json_decode($result, true);
			if(!empty($json['refId']))
			{
				// submit email to the person

			    $emailREFID = $json['refId'];
			    $data_url = 'http://www.icpak.com:8080/icpakportal/api/events/'.$booking_refid.'/bookings/'.$emailREFID;
				// $data_url = 'http://www.icpak.com:8080/icpakportal/api/events/dQdcmmGqPuw7wVzr/bookings/'.$emailREFID;
					
				try
					{                                                                                                         

						$ch = curl_init($data_url);                                                                      
						curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                  
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
						curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
							'Content-Type: application/json')                                                                       
						);                                                                                
						$result_item = curl_exec($ch);
						curl_close($ch);
						$response['refId'] = $json['refId'];
					}
					catch(Exception $e)
					{
							$response['refId'] = 'problem';
					}
				$response['message'] = 'success';
				$response['result'] = $result;
				
			}
			else
			{
				$response['message'] = 'fail';
				$response['result'] = 'Failed';
			}
			
			echo json_encode($response);
		}
		catch(Exception $e)
		{
			$response['message'] = 'fail';
			$response['result'] = 'Something went wrong';
			
			echo json_encode($response.' '.$e);
		}

	}
	
	public function book_non_member_to_event()
	{

		$post_id = $this->input->post('post_id');
		$bookingRefId = $this->input->post('bookingRefId');
		$member_no = $this->input->post('member_no');
		$hotel = $this->input->post('hotel');
		$accomodationRefId = $this->input->post('accomodationRefId');
		$fee = $this->input->post('fee');

		$company = $this->input->post('company');
		$office_line = $this->input->post('office_line');
		$postal_address = $this->input->post('postal_address');
		$postal_code = $this->input->post('postal_code');
		$town = $this->input->post('town');
		$contact_person = $this->input->post('contact_person');
		$contact_full_name = $this->input->post('full_name');
		$contact_person_email = $this->input->post('contact_person_email');


		// now do the things that should be done for this member to book for this event

		 $url = 'http://www.icpak.com:8080/icpakportal/api/events/'.$booking_refid.'/bookings/instantBooking';
		// $url = 'http://www.icpak.com:8080/icpakportal/api/events/dQdcmmGqPuw7wVzr/bookings';
		$data = array();
		//Encode the array into JSON.
	

		//The JSON data.
		// $data_string = json_encode($data);
		$data_string = '{
						  "contact": {
						    "company": "'.$company.'",
						    "address": "'.$postal_address.'",
						    "address2": null,
						    "city": "'.$town.'",
						    "contactName": "'.$contact_person.'",
						    "telephoneNumbers": "'.$office_line.'",
						    "telexNo": null,
						    "territoryCode": null,
						    "fax": null,
						    "postCode": "'.$postal_code.'",
						    "county": null,
						    "email": "'.$contact_person_email.'",
						    "website": null,
						    "physicalAddress": null,
						    "country": "Kenya",
						    "refId": null,
						    "uri": null
						  },
						  "paymentMode": null,
						  "currency": null,
						  "bookingDate": 1461483347468,
						  "paymentRef": null,
						  "paymentDate": null,
						  "amountDue": null,
						  "amountPaid": null,
						  "eventRefId": "dQdcmmGqPuw7wVzr",
						  "invoiceRef": null,
						  "status": "",
						  "isActive": null,
						  "paymentStatus": "NOTPAID",
						  "delegates": [
						    {
						      "createdDate": null,
						      "companyName": null,
						      "contactName": null,
						      "contactEmail": null,
						      "contactPhoneNumber": null,
						      "delegatePhoneNumber": null,
						      "memberNo": null,
						      "memberRefId": null,
						      "title": null,
						      "surname": null,
						      "otherNames": null,
						      "fullName": "'.$contact_full_name.'",
						      "email": null,
						      "accommodation": null,
						      "amount": null,
						      "attendance": null,
						      "transaction": null,
						      "delegateType": null,
						      "bookingId": null,
						      "bookingRefId": null,
						      "isBookingActive": null,
						      "eventRefId": null,
						      "paymentStatus": null,
						      "courseId": null,
						      "ern": null,
						      "hotel": null,
						      "lmsResponse": null,
						      "clearanceNo": null,
						      "receiptNo": null,
						      "lpoNo": null,
						      "isCredit": 0,
						      "contact": null,
						      "bookingDate": null,
						      "memberQrCode": null,
						      "invoiceNo": null,
						      "refId": null,
						      "uri": null
						    }
						  ],
						  "refId": null,
						  "uri": null
						}
						';
		// echo $data_string;
	
		try
		{                                                                                                         

			$ch = curl_init($url);                                                                      
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                 
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
				'Content-Type: application/json',                                                                                
				'Content-Length: ' . strlen($data_string))                                                                       
			);                                                                                
			$result = curl_exec($ch);
			curl_close($ch);

			$json = json_decode($result, true);

			if(!empty($json['refId']))
			{
				// submit email to the person

			    $emailREFID = $json['refId'];
			    $data_url = 'http://www.icpak.com:8080/icpakportal/api/events/'.$booking_refid.'/bookings/'.$emailREFID;
				// $data_url = 'http://www.icpak.com:8080/icpakportal/api/events/dQdcmmGqPuw7wVzr/bookings/'.$emailREFID;
					
				try
					{                                                                                                         

						$ch = curl_init($data_url);                                                                      
						curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                  
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
						curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
							'Content-Type: application/json')                                                                       
						);                                                                                
						$result_item = curl_exec($ch);
						curl_close($ch);
						$response['refId'] = $json['refId'];
					}
					catch(Exception $e)
					{
							$response['refId'] = 'problem';
					}
				
			}
			$response['message'] = 'success';
			$response['result'] = $result;


			echo json_encode($response);
		}
		catch(Exception $e)
		{
			$response['message'] = 'fail';
			$response['result'] = 'Something went wrong';
			
			echo json_encode($response.' '.$e);
		}
	}
	

	

}