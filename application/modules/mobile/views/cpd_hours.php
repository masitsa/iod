<?php
		$result = '<div class="content-block">
		          		<div class="content-block-inner">';
		          			$total_points = 0;
					          $sub_total = 0;
					          for ($i=date('Y'); $i >= 2011  ; $i--) { 
					          	$startdate = $i.'-01-01';
					          	$enddate = $i.'-12-31';
					          	# code...
					          	$url = 'http://www.icpak.com:8080/icpakportal/api/members/'.$memberRefId.'/cpd/cpdFormatted?startDate='.$startdate.'&endDate='.$enddate.'';
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
					          $result .= '<div class="grand-total"> <h3> Grand total points : '.$total_points.'</h3> </div>
			          			
      			
		          		</div>
		          	</div>';
		      echo $result;