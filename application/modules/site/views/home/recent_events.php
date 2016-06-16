<div class="kf_courses_tabs">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="courses-detail.html#coursedetails" aria-controls="coursedetails" role="tab" data-toggle="tab">SEMINARS</a></li>
		<li role="presentation"><a href="courses-detail.html#coursestructure" aria-controls="coursestructure" role="tab" data-toggle="tab">CONFERENCES</a></li>
		<li role="presentation"><a href="courses-detail.html#coursestructure" aria-controls="coursestructure" role="tab" data-toggle="tab">Courses</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<?php
			$result_trainings = '';
			if($trainings->num_rows() > 0)
			{
				foreach ($trainings->result() as $value) {
					$training_name = $value->training_name;
					$start_date = $value->start_date;
					$end_date = $value->end_date;
					$training_image_name = $value->training_image_name;

					$start_date = date('jS M Y',strtotime($start_date));
					$month = date('M',strtotime($start_date));
					$day = date('d',strtotime($start_date));
					$end_date = date('jS M Y',strtotime($end_date));

					$category_web_name = $this->site_model->create_web_name($training_name);
					# code...
					$result_trainings .='<!--LIST ITEM START-->
                                   		<li>
                                            <div class="list-date">
											        <span class="list-dayname">'.$month.'</span>
											        <span class="list-daynumber">'.$day.'</span>
											    </div>
                                            <div class="kode-text">

                                                <div class="item-title-row">
                            <div class="item-title">'.$training_name.'</div>
                          </div>
                           <div class="item-subtitle"> Seminar </div>
                          <div class="item-text"><span><i class="fa fa-calendar"></i> From :</span> '.$start_date.'  <span><i class="fa fa-calendar"></i> To :</span> '.$end_date.'</div>

                                                
                                            </div>
    									</li>
                                        <!--LIST ITEM START-->';
				}
			}
			else
			{
				$result_trainings = '';
			}
			?>

		<div role="tabpanel" class="tab-pane active" id="coursedetails">
			
			<!-- COURSES DETAIL DES START -->
			<div class="kf_courses_detail_des">
				<div class="widget widget-recent-posts">
					<ul class="sidebar_rpost_des event-items">
                    	<?php echo $result_trainings;?>

					</ul>
					
				</div>
			</div>
			<!-- COURSES DETAIL DES END -->

			

		</div>

		<div role="tabpanel" class="tab-pane" id="coursestructure">
			<?php

			$result_accouncements = '';
			
			if($trainings->num_rows() > 0)
			{
				foreach ($trainings->result() as $value) {
					$training_name = $value->training_name;
					$start_date = $value->start_date;
					$end_date = $value->end_date;
					$training_image_name = $value->training_image_name;

					$start_date = date('jS M Y',strtotime($start_date));
					$month = date('M',strtotime($start_date));
					$day = date('d',strtotime($start_date));
					$end_date = date('jS M Y',strtotime($end_date));
					# code...
					$result_accouncements .='<!--LIST ITEM START-->
                                   		<li>
                                            <div class="list-date">
											        <span class="list-dayname">'.$month.'</span>
											        <span class="list-daynumber">'.$day.'</span>
											    </div>
                                            <div class="kode-text">
                                                <h6><a href="courses-detail.html#">'.$training_name.' From '.$start_date.' To '.$end_date.'</a></h6>
                                                
                                            </div>
    									</li>
                                        <!--LIST ITEM START-->';
				}
			}
			else
			{
				$result_accouncements = '';
			}
			   
			  ?>

			<!-- COURSES DETAIL DES START -->
			<div class="kf_courses_detail_des">
				<div class="widget widget-recent-posts">
					<ul class="sidebar_rpost_des">
                    	<!--LIST ITEM START-->
                   		<?php echo $result_accouncements?>
                        <!--LIST ITEM START-->
					</ul>
				</div>
			</div>
			<!-- COURSES DETAIL DES END -->

			

		</div>


	</div>
	</div>
	<!-- COURSES DETAIL TABS WRAP END -->
	