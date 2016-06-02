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
					$end_date = date('jS M Y',strtotime($end_date));
					# code...
					$result_trainings .='<!--LIST ITEM START-->
                                   		<li>
                                            <figure>
                                            	<img src="'.$training_location.''.$training_image_name.'" alt="">
                                                <figcaption><a href="'.$training_location.''.$training_image_name.'"><i class="fa fa-search-plus"></i></a></figcaption>
                                            </figure>
                                            <div class="kode-text">
                                                <h6><a href="courses-detail.html#">'.$training_name.'</a></h6>
                                                <span><strong>From </strong><i class="fa fa-clock-o"></i>'.$start_date.'</span>
                                                <span><strong>To </strong> <i class="fa fa-clock-o"></i>'.$end_date.'</span>
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
					<ul class="sidebar_rpost_des">
                    	<?php echo $result_trainings;?>
					</ul>
				</div>
			</div>
			<!-- COURSES DETAIL DES END -->

			

		</div>

		<div role="tabpanel" class="tab-pane" id="coursestructure">
			<?php

			$result_accouncements = '';
			
			//if users exist display them

			if ($latest_posts->num_rows() > 0)
			{	
				//get all administrators
				$administrators = $this->users_model->get_all_administrators();
				if ($administrators->num_rows() > 0)
				{
					$admins = $administrators->result();
				}
				
				else
				{
					$admins = NULL;
				}
				
				foreach ($latest_posts->result() as $row)
				{
					$post_id = $row->post_id;
					$blog_category_name = '';//$row->blog_category_name;
					$blog_category_web_name = $this->site_model->create_web_name($blog_category_name);
					$blog_category_id = $row->blog_category_id;
					$post_title = $row->post_title;
					$web_name = $this->site_model->create_web_name($post_title);
					$post_status = $row->post_status;
					$post_views = $row->post_views;
					$image = base_url().'assets/images/posts/'.$row->post_image;
					$created_by = $row->created_by;
					$modified_by = $row->modified_by;
					$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
					$categories_query = $this->blog_model->get_all_post_categories($blog_category_id);
					$description = $row->post_content;
					$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 30));
					$created = $row->created;
					$day = date('j',strtotime($created));
					$month = date('M',strtotime($created));
					$created_on = date('jS M Y',strtotime($row->created));
					
					$categories = '';
					$count = 0;
					
						
					$result_accouncements .= '<li>
		                                            <div class="abt_univ_des">
		                                                <h6><a href="courses-detail.html#">'.$post_title.'</a></h6>
		                                                <span><i class="fa fa-clock-o"></i>'.$created_on.'</span>
		                                            </div>
		    									</li>';
					}
				}
				else
				{
					$result_accouncements = "There are no posts :-(";
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
	