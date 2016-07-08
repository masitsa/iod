<?php
$result = ''; 
if($query->num_rows() > 0)
{
  foreach($query->result() as $value)
  {
    $event_name = $value->event_name;
     $event_id = $value->event_id;
    $event_web_name = $value->event_web_name;
    $start_date = $value->event_start_time;
    $end_date = $value->event_end_time;
    $event_description = $value->event_description;
    $event_venue = $value->event_venue;

    $start_date = date('jS M Y',strtotime($start_date));
    $month = date('M',strtotime($start_date));
    $day = date('d',strtotime($start_date));
    $end_date = date('jS M Y',strtotime($end_date));

			$result = '
				
		          <div class="content-block">
		            
		            <div class="content-block-inner">
		            	<span class="event-title">'.strip_tags($event_name).'</span>
		            	<div class="row">
			                <div class="col-50"><span><i class="fa fa-calendar"></i> From :</span> '.$start_date.'</div> <div class="col-50"><span><i class="fa fa-calendar"></i>  To :</span> '.$end_date.'</div>
			            </div>
			            <div class="row">
			                <div class="col-100"><span><i class="fa fa-map-marker"></i> Venue :</span> '.$event_venue.'</div>
			            </div>
		              <p>'.$event_description.'</p>
		             
		            </div>
		          </div> ';
		 }

}else

{

	$result = 'Data not found';

}

echo $result;

?>