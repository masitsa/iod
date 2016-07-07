<?php
	$result_seminars = '';
	if($seminars->num_rows() > 0)
	{
		foreach ($seminars->result() as $value) {
			$event_name = $value->event_name;
			$event_web_name = $value->event_web_name;
			$start_date = $value->event_start_time;
			$end_date = $value->event_end_time;

			$start_date = date('jS M Y',strtotime($start_date));
			$month = date('M',strtotime($start_date));
			$day = date('d',strtotime($start_date));
			$end_date = date('jS M Y',strtotime($end_date));

			# code...
			$result_seminars .='<!--LIST ITEM START-->
								<li>
									<a href="'.site_url().'events/'.$event_web_name.'">
										<div class="list-date">
												<span class="list-dayname">'.$month.'</span>
												<span class="list-daynumber">'.$day.'</span>
											</div>
										<div class="kode-text">

											<div class="item-title-row">
										<div class="item-title">'.$event_name.'</div>
									  </div>
									   <div class="item-subtitle"> Seminar </div>
									  <div class="item-text"><span><i class="fa fa-calendar"></i> From :</span> '.$start_date.'  <span><i class="fa fa-calendar"></i> To :</span> '.$end_date.'</div>

											
										</div>
									</a>
								</li>
								<!--LIST ITEM START-->';
		}
	}
	
	$result_conferences = '';
			
	if($conferences->num_rows() > 0)
	{
		foreach ($conferences->result() as $value) {
			$event_name = $value->event_name;
			$event_web_name = $value->event_web_name;
			$start_date = $value->event_start_time;
			$end_date = $value->event_end_time;

			$start_date = date('jS M Y',strtotime($start_date));
			$month = date('M',strtotime($start_date));
			$day = date('d',strtotime($start_date));
			$end_date = date('jS M Y',strtotime($end_date));

			# code...
			$result_conferences .='<!--LIST ITEM START-->
								<li>
									<a href="'.site_url().'events/'.$event_web_name.'">
										<div class="list-date">
												<span class="list-dayname">'.$month.'</span>
												<span class="list-daynumber">'.$day.'</span>
											</div>
										<div class="kode-text">

											<div class="item-title-row">
										<div class="item-title">'.$event_name.'</div>
									  </div>
									   <div class="item-subtitle"> Conference </div>
									  <div class="item-text"><span><i class="fa fa-calendar"></i> From :</span> '.$start_date.'  <span><i class="fa fa-calendar"></i> To :</span> '.$end_date.'</div>

											
										</div>
									</a>
								</li>
								<!--LIST ITEM START-->';
		}
	}
	
	$result_events = '';
			
	if($events->num_rows() > 0)
	{
		foreach ($events->result() as $value) {
			$event_name = $value->event_name;
			$event_web_name = $value->event_web_name;
			$start_date = $value->event_start_time;
			$end_date = $value->event_end_time;

			$start_date = date('jS M Y',strtotime($start_date));
			$month = date('M',strtotime($start_date));
			$day = date('d',strtotime($start_date));
			$end_date = date('jS M Y',strtotime($end_date));

			# code...
			$result_events .='<!--LIST ITEM START-->
								<li>
									<a href="'.site_url().'events/'.$event_web_name.'">
										<div class="list-date">
												<span class="list-dayname">'.$month.'</span>
												<span class="list-daynumber">'.$day.'</span>
											</div>
										<div class="kode-text">

											<div class="item-title-row">
										<div class="item-title">'.$event_name.'</div>
									  </div>
									   <div class="item-subtitle"> Event </div>
									  <div class="item-text"><span><i class="fa fa-calendar"></i> From :</span> '.$start_date.'  <span><i class="fa fa-calendar"></i> To :</span> '.$end_date.'</div>

											
										</div>
									</a>
								</li>
								<!--LIST ITEM START-->';
		}
	}
?>
<div class="kf_courses_tabs">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="courses-detail.html#seminars" aria-controls="coursedetails" role="tab" data-toggle="tab">SEMINARS</a></li>
		<li role="presentation"><a href="courses-detail.html#conferences" aria-controls="coursestructure" role="tab" data-toggle="tab">CONFERENCES</a></li>
		<li role="presentation"><a href="courses-detail.html#events" aria-controls="coursestructure" role="tab" data-toggle="tab">EVENTS</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">

		<div role="tabpanel" class="tab-pane active" id="seminars">
			
			<!-- COURSES DETAIL DES START -->
			<div class="kf_courses_detail_des">
				<div class="widget widget-recent-posts">
					<ul class="sidebar_rpost_des event-items">
                    	<?php echo $result_seminars;?>

					</ul>
				</div>
			</div>
			<!-- COURSES DETAIL DES END -->

			

		</div>

		<div role="tabpanel" class="tab-pane" id="conferences">
			<!-- COURSES DETAIL DES START -->
			<div class="kf_courses_detail_des">
				<div class="widget widget-recent-posts">
					<ul class="sidebar_rpost_des event-items">
                    	<!--LIST ITEM START-->
                   		<?php echo $result_conferences?>
                        <!--LIST ITEM START-->

					</ul>
				</div>
			</div>
			<!-- COURSES DETAIL DES END -->
		</div>

		<div role="tabpanel" class="tab-pane" id="events">
			<!-- COURSES DETAIL DES START -->
			<div class="kf_courses_detail_des">
				<div class="widget widget-recent-posts">
					<ul class="sidebar_rpost_des event-items">
                    	<!--LIST ITEM START-->
                   		<?php echo $result_events?>
                        <!--LIST ITEM START-->

					</ul>
				</div>
			</div>
			<!-- COURSES DETAIL DES END -->
		</div>
	</div>
	</div>
	<!-- COURSES DETAIL TABS WRAP END -->
	