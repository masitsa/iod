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

    $start_date = date('jS M Y',strtotime($start_date));
    $month = date('M',strtotime($start_date));
    $day = date('d',strtotime($start_date));
    $end_date = date('jS M Y',strtotime($end_date));

    $result .= '
                 <li>
                  <a href="event-single.html?id='.$event_id.'" class="item-link item-content" onclick="get_events_description('.$event_id.')">
                    <div class="item-media">
                      <div class="list-date">
                        <span class="list-dayname">'.$month.'</span>
                        <span class="list-daynumber">'.$day.'</span>
                    </div>
                     </div>
                    <div class="item-inner">
                      <div class="item-title-row">
                        <div class="item-title">'.strip_tags($event_name,'<p><a>').'</div>
                      </div>
                       <div class="item-subtitle"> <i class="fa fa-bookmark"></i>  Seminar </div>
                       <div class="item-text"><span><i class="fa fa-calendar"></i> From :</span> '.$start_date.' <span><i class="fa fa-calendar"></i> To :</span> '.$end_date.'</div>
                    </div>
                  </a>
                </li>
        
          ';
    
  }
}
else
{
  $result = '
            <li>
                    <div class="item-inner">
                       No events currently
                    </div>
                </li>';
}
echo $result;
?>

