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
			        <div class="content-block-title">
			            <div class="row">
			            	<div class="col-100">
			          	 		<span class="event-title">'.$training_name.'</span>
			          	 	</div>
			          	 </div>
			          
			          </div>
			          <div class="content-block">

			            <div class="content-block-inner">
			            	<div class="row">
				                <div class="col-50"><span><i class="fa fa-calendar"></i> From :</span> '.$start.'</div> <div class="col-50"><span><i class="fa fa-calendar"></i>  To :</span> '.$end.'</div>
				            </div>
				            <div class="row">
				                <div class="col-100"><span><i class="fa fa-map-marker"></i> Venue :</span> Sarova Hotel Mombasa</div>
				            </div>
				            <div class="row">
				                <div class="col-100"><span><i class="fa fa-money"></i>  Pricing : </span> Ksh. 2000</div>
				            </div>
			              <p>'.$training_description.'</p>
			              
			              	<div class="row">
				                <div class="col-50"><a class="convocation_link" href="#">Book Now</a></div>
				            </div>
			            </div>
			          </div>
                    <li>
                     
                    </li>
                    ';
    }
}

echo $result;
?>