<?php
 $memberprice = 0;
        $nonmemberprice = 0;
        $associateprice = 0;  

if ($query->num_rows() > 0)

{

        $memberprice = 0;
        $nonmemberprice = 0;
        $associateprice = 0;  

	foreach ($query->result() as $row)

	{

		 $id = $row->post_id;

        $title = $row->post_title;

        $title_alias = $row->post_name;
        $fulltext  = $row->post_content;
        $post_content = $row->post_content;

        // $post_date = $row->post_date;
         $date = date('jS M Y',strtotime($row->post_date));

        $publish_up = date('jS M Y',strtotime($row->post_date));

         $day = date('j',strtotime($row->StartDate));

         $month = date('M',strtotime($row->StartDate));



        $mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;

        $title = $row->post_title;

        $mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
        $start_date = date('jS M Y',strtotime($row->StartDate));
        $end_date = date('jS M Y',strtotime($row->EndDate));
        $memberprice = $row->MemberPrice;
        $nonmemberprice = $row->NonMemberPrice;
        $associateprice = $row->AssociateMemberPrice;
        $bookingid = $row->BookingId;
		if(!isset($memberprice))
		{
			$member_price = number_format($member_price = 0,0);
		}


	}
	$booking_things = "".$id.",'".$bookingid."'";

	$result = '<h2 class="page_title">'.strip_tags($title).' Accomodations</h2>
		          <div class="post_single">
		            <div class="page_content"> 
		              <div class="entry">
		              <ul class="simple_list">
			              <li>Dates : '.$start_date.' - '.$end_date.'</li>
			              <li>
			                Member Price : Kes. '.$memberprice.' Non Member Price : Kes. '.$nonmemberprice.' Associate Price : Kes. '.$associateprice.'
			              </li>

		              </ul>
		              </div>
		            </div>
		          </div>

	          ';

}else

{

	$result = 'Data not found';

}

// this will desplay all the events accomodations list
$accomodations_url = 'http://www.icpak.com:8080/icpakportal/api/events/'.$booking_refid.'/accommodations?offset=0&limit=100';
// $accomodations_url = 'https://www.icpak.com/icpakportal/api/events/dQdcmmGqPuw7wVzr/accommodations?offset=0&limit=100';
//Encode the array into JSON.			

$accomodations = '';
try{                                                                                                         

	//  Initiate curl
	$ch = curl_init();
	// Disable SSL verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// Will return the response, if false it print the response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Set the url
	curl_setopt($ch, CURLOPT_URL,$accomodations_url);
	// Execute
	$accomodations_json=curl_exec($ch);
	// Closing
	curl_close($ch);

	// Will dump a beauty json :3

	$accomodations_array = json_decode($accomodations_json, TRUE);
	$accomodation_items = '';
	if(count($accomodations_array) > 0)
	{
			// there are some accomodations

		for ($i=0; $i < count($accomodations_array); $i++) { 
			# code...
			$ref_id = $accomodations_array[$i]['refId'];
			$hotel = $accomodations_array[$i]['hotel'];
			$fee =  $accomodations_array[$i]['fee'];
			$spaces =  $accomodations_array[$i]['spaces'];
			if(isset($accomodations_array[$i]['total_bookings']))
			{
				$total_bookings =  $accomodations_array[$i]['total_bookings'];	
			}
			else
			{
				$total_bookings = 0;
			}
			
			$balance = $spaces - $total_bookings;

			$clickable_things = "'".$booking_refid."','".$ref_id."',".$id.",'".$hotel."','".$fee."'";
			if($balance > 0)
			{
				$accomodation_items .= ' <li class="accomodation_list prompt-title-ok-cancel" style="cursor:pointer" onclick="get_these_items('.$clickable_things.');">
									          <div >
									          <h3>'.$hotel.' </h3>
									          <span class="pull-left"> Fee: KES. '.$fee.' </span>
									          <span class="pull-right"> Available Spaces : '.$balance.' </span>
									         		
									          </div>
								          </li>';
			}

			
		}
	}
	else
	{
		// there are no accomodations
		$accomodation_items = '<li class="accomodation_list" style="cursor:pointer">
						          <div >
						          <h3>No Accomodation for this event </h3>
						          </div>
					          </li>';
	}

	// var_dump($accomodations_array);
	
 }catch(Exception $e)
{
	$accomodations = '<li class="accomodation_list" style="cursor:pointer">
				          <div >
				          <h3>No Accomodation for this event </h3>
				          </div>
			          </li>';
	
}


$checker = '

<div class="page-content">
	     <div class="navbarpages">
	       <div class="nav_left_logo"><a href="index.html"><img src="images/header.png" alt="" title="" /></a></div>
	       <div class="nav_right_button">
	       <a href="#" data-popup=".popup-menu" class="open-popup"><img src="images/icons/white/menu.png" alt="" title=""  /></a>
	       <a href="index.html" ><img src="images/icons/white/home.png" alt="" title=""  /></a>
	       <a href="event-single.html?id='.$id.'"><img src="images/icons/white/back.png" alt="" title="" onClick="get_events_description('.$id.')" /></a>
	       </div>
	     </div>
	     <div id="pages_maincontent">
	     			<h2 class="page_title">'.strip_tags($title).' Accomodations</h2>
		            <div class="page_content">
		              	<ul class="features_list_detailed" style="margin-top:-25px;">
				         	'.$accomodation_items.'
				        
		     			</ul> 

					</div>
			</div>
  	</div>
  	';
	echo $checker;
?>