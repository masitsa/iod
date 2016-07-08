<?php
// $newdata = array(
//                    'member_login_status'    => TRUE,
//                    'member_email'     		=> 'marttkip',
//                    'member_first_name'     	=> 'Tarus',
//                    'member_id'  			=> 708,
//                    'member_code'  			=> md5(708)
//                );
// $this->session->set_userdata($newdata);

if($this->session->userdata('member_login_status') == TRUE)
{           

    
	$result = '<h2 class="page_title"> '.$this->session->userdata('member_first_name').'</h2> 
	     
	  <div class="page_content"> 

		<div class="buttons-row">
	        <a href="#tab1" class="tab-link active button">My Profile</a>
	        <a href="#tab2" class="tab-link button">CPD Statement</a>
	        <a href="#tab3" class="tab-link button">CPD Queries</a>
	  </div>
	  
	  <div class="tabs-animated-wrap">
	        <div class="tabs">
	              <div id="tab1" class="tab active">
					
		              <h3>Bio Information:</h3>
		              <ul class="simple_list">
		              <li>Name:  '.$this->session->userdata('member_first_name').'</li>
		              <li>Email:  '.$this->session->userdata('member_email').'</li>
		              <li>Member No.:  '.$this->session->userdata('member_id').'</li>
		              </ul>
		          </div>
		          <div id="tab2" class="tab">';
		          $total_points = 0;
		          for ($i=date('Y'); $i >= 2011  ; $i--) { 
		          	$startdate = $i.'-01-01';
		          	$enddate = $i.'-12-31';
		          	# code...
		          	$url = 'https://www.icpak.com/icpakportal/api/members/'.$memberRefId.'/cpd/cpdFormatted?startDate='.$startdate.'&endDate='.$enddate.'';
					//Encode the array into JSON.			
				
					try{                                                                                                         

						//  Initiate curl
						$ch = curl_init();
						// Disable SSL verification
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						// Will return the response, if false it print the response
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						// Set the url
						curl_setopt($ch, CURLOPT_URL,$url);
						// Execute
						$result_array=curl_exec($ch);
						// Closing
						curl_close($ch);

						// Will dump a beauty json :3

						$obj = json_decode($result_array, TRUE);

						
						
		          			 	if(is_array($obj))
		          			 	{
		          			 	  $result .= '
				          			<h3>CPD Statement '.$i.':</h3>';
				          			$result .= '<ul class="simple_list">';
			          			 	$counter = 0;
			          			 	$sub_total = 0;
				          			  foreach ($obj as $key => $value) {
											# code...
				          			  	    $sub_total = $sub_total + $value['cpdHours'];
							                $counter++;
											$result .= '<li>  '.$value['title'].' : <span id="colored"> '.$value['cpdHours'].' points </span></li>';
									  }
									  $result .= '</ul>';
								      $result .= '<div class="sub-total"><h3 > '.$i.' Sub total points : '.$sub_total.'</h3></div>';

								      $total_points = $total_points + $sub_total;
							    }
							    else
							    {
							    	$result .= 'You have no points';
							    }

			          		
							$total_points = $total_points + $sub_total;
						
						 
					}
					catch(Exception $e)
					{
						$result .= 'You have no points';
						
					}
		          }
		          $result .= '<div class="grand-total"> <h3> Grand total points : '.$total_points.'</h3> </div>';
		        
				 $result .='
          			
			          
			          </div> 
			          <div id="tab3" class="tab">
			          	<div id="cpdquery_response"></div>
			            <div class="contactform">
				            <form class="cmxform" id="cpd_query_form" method="post" action="">
					           
					            <input type="hidden" name="member_id" id="member_id" value="'.$this->session->userdata('member_id').'" class="form_input required" />
					            <label>Question:</label>
					            <textarea name="question" id="question" class="form_textarea textarea required" rows="" cols=""></textarea>
					            <input type="submit" name="submit" class="form_submit" id="submit" value="Submit Query" />
					           
				            </form>
				            <h3>Questions & Responses</h3>';
				             $question_query = $this->login_model->get_from_question($this->session->userdata('member_id'));
					          if($question_query->num_rows() > 0){
					          	$total_points = 0;
					          	$result .= '<ul class="comments">';
								foreach ($question_query->result() as $question_row)
								{
					            
					            	$question_id = $question_row->question_id;
					            	$question = $question_row->question;
					            	$question_answer = $question_row->question_answer;
					            	$answered_by = $question_row->answered_by;

					            	$date_asked = $question_row->date_asked;
					            	$date_answered = $question_row->date_answered;
					            	$question_status = $question_row->question_status;

					            	$result .= '
					            				<li class="comment_row question" >
				                                   <div class="comm_content"><p>'.$question.'</p></div>
				                                </li>
					            				';

					            	if(!empty($answered_by))
					            	{
					            		$result .= '
					            				<li class="comment_row response" >
				                                   <div class="comm_content"><p>'.$question_answer.'</p></div>
				                                </li>
					            				';
					            	}
					            	else
					            	{
					            		
					            	}
					           	}
					           }
                               $result .= ' 
                                <div class="clear"></div>
                            </ul>
		            </div> 
		     </div>

		</div>
	</div>';
}
else
{
	$result='Please log in to get the information';
}

echo $result;
?>


