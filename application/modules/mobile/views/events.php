<?php
$result = '';
if($trainings->num_rows() > 0){
    foreach($trainings->result() as $res){
       // var_dump($trainings); die();
        $training_id = $res->training_id;
        $training_name = $res->training_name;
        $training_description = $res->training_description;
        $start_date = $res->start_date;
        $training_image_name = $res->training_image_name;
        $end_date = $res->end_date;

        $start = date('jS F Y',strtotime($start_date));
        $end = date('jS F Y',strtotime($end_date));
        $day = date('d',strtotime($start_date));
        $month = date('M',strtotime($start_date));
        $result .= '
                    <li>
                      <a href="event-single.html" class="item-link item-content" onclick="get_event_detail('.$training_id.')">
                        <div class="item-media">
                            <div class="list-date">
                                <span class="list-dayname">'.$month.'</span>
                                <span class="list-daynumber">'.$day.'</span>
                            </div>
                         </div>
                        <div class="item-inner">
                          <div class="item-title-row">
                            <div class="item-title">'.$training_name.'</div>
                          </div>
                           <div class="item-subtitle"> Seminar </div>
                          <div class="item-text"><span><i class="fa fa-calendar"></i> From :</span> '.$start_date.'  <span><i class="fa fa-calendar"></i> To :</span> '.$end.'</div>
                        </div>
                      </a>
                    </li>
                    ';
    }
}

echo $result;
?>
                                                  
