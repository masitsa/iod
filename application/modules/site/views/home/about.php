<?php
    if(count($contacts) > 0)
    {
        $email = $contacts['email'];
        $facebook = $contacts['facebook'];
        $twitter = $contacts['twitter'];
        $logo = $contacts['logo'];
        $company_name = $contacts['company_name'];
        $phone = $contacts['phone'];
        $address = $contacts['address'];
        $post_code = $contacts['post_code'];
        $city = $contacts['city'];
        $building = $contacts['building'];
        $floor = $contacts['floor'];
        $location = $contacts['location'];

		$working_weekday = $contacts['working_weekday'];
		$working_weekend = $contacts['working_weekend'];

		$mission = $contacts['mission'];
		$vision = $contacts['vision'];
		$about = $contacts['about'];
    }
?>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="abt_univ_wrap">

					<div class="kf_courses_tabs">
						<!-- Nav tabs -->
						<ul role="tablist" class="nav nav-tabs">
							
							<li role="presentation" class="active"><a data-toggle="tab" role="tab" aria-controls="coursedetails2" href="<?php echo base_url();?>home#coursedetails2" aria-expanded="true">ABOUT IOD KENYA</a></li>
							<li role="presentation" class=""><a data-toggle="tab" role="tab" aria-controls="entryrequirment" href="<?php echo base_url();?>home#entryrequirment" aria-expanded="true">DIRECTOR DEVELOPMENT</a></li>
							<li role="presentation" class=""><a data-toggle="tab" role="tab" aria-controls="placements" href="<?php echo base_url();?>home#placements" aria-expanded="true">IOD MEMBERSHIP</a></li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">

							<div id="coursedetails2" class="tab-pane active" role="tabpanel">
								<div class="course_heading">
									<h3>IOD Kenya</h3>
								</div>
								<p><?php echo $about;?>
								<a href="<?php echo site_url();?>about">Know More ></a></p>
							</div>

							<div id="entryrequirment" class="tab-pane" role="tabpanel">
								<div class="course_heading">
									<h3>Director Development</h3>
								</div>
								<?php
								 $services = $this->site_model->get_active_services();
			                    $checking_items = '';
			                    if($services->num_rows() > 0)
			                    {   $count = 0;
			                        foreach($services->result() as $res)
			                        {
			                            $service_name = $res->service_name;
			                            $service_description = $res->service_description;
			                             $mini_desc = implode(' ', array_slice(explode(' ', $service_description), 0, 30));
			                             $maxi_desc = implode(' ', array_slice(explode(' ', $service_description), 0, 40));
			                            $web_name = $this->site_model->create_web_name($service_name);
			                            $checking_items .=
			                            					'
			                            					<div class="service-list">
			                            						<h6>'.$service_name.'</h6>
																<p>'.$mini_desc.' <a href="'.site_url().'director-development/'.$web_name.'">  Know More > </a> </p>

															</div>
			                            					';
			                         }
			                    }
			                    echo $checking_items;
								?>
								
							</div>

							<div id="placements" class="tab-pane " role="tabpanel">
								<div class="course_heading">
									<h3>BECOME A MEMBER</h3>
								</div>
								<p>
									 A prospective member submits a duly filled application form and a copy of his/her corporate governance training certificate to the Institute. The Membership Services and Development Committee of the Board meets at least once every quarter to review application forms. 
								</p>
								<p>
									Applicants who fulfill the required criteria are then invited to join the relevant category of membership in the Institute. The new member is supplied with a membership number, a membership certificate and a copy of the Memorandum and Articles of Association of the Institute.
								<a href="<?php echo site_url();?>register">Register ></a>
								</p>
							</div>

						</div>
						</div>
				</div>
			</div>

			<div class="col-md-4">

					 <form action="<?php echo site_url().'login';?>" method="post" role="form">
                        <div class="contact_des">
                            <div class="kf_edu2_heading2">
								<h3>Member sign in</h3>
							</div>
							<div class="abt_univ_des">
	                            <div class="inputs_des des_2">
	                                <input type="email" placeholder="E-mail" required><i class="fa fa-envelope-o"></i>
	                            </div>
	                            <div class="inputs_des des_2">
	                                <input type="password" placeholder="Password" required><i class="fa fa-lock"></i>
	                            </div>
	                            <div class="inputs_des des_3 align-center">
	                                <a href="#"> Forgot password ?</a>
	                            </div>
	                            <div class="inputs_des des_2">
	                                <button type="submit">login</button>
	                            </div>
	                        </div>
                        </div>
                    </form>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-8">
					<!-- HEADING 1 START-->
					
					<!-- HEADING 2 START-->
					<div class="col-md-12">
						<div class="kf_edu2_heading2">
							<h3>Quick Links</h3>
						</div>
					</div>
					<!-- HEADING 2 END-->
					<!-- INTERO DES START-->
					<div class="kf_intro_des">
						<div class="kf_intro_des_caption">
							<!-- <span><i class="fa fa-users"></i></span> -->
							<h6>Membership</h6>
							<div class="widget widget-categories">
								<ul>
									<li><a href="#"><i class="fa fa-caret-right"></i>Who is a member ?</a></li>
									<li><a href="#"><i class="fa fa-caret-right"></i>Become a member</a></li>
									<li><a href="#"><i class="fa fa-caret-right"></i>Members categories</a></li>
								</ul>
    						</div>
						</div>
						<!-- <figure>
							<img alt="" src="<?php echo base_url();?>assets/img/icon.jpg">
							<figcaption><a href="index.html#">Learn Courses Online</a></figcaption>
						</figure> -->
					</div>
					<!-- INTERO DES END-->
					<!-- INTERO DES START-->
					<div class="kf_intro_des">
						<div class="kf_intro_des_caption">
							<!-- <span><i class="fa fa-newspaper-o"></i></span> -->
							<h6>Newsroom</h6>
							<div class="widget widget-categories">
								<ul>
									<li><a href="#"><i class="fa fa-caret-right"></i>Upcoming events </a></li>
									<li><a href="#"><i class="fa fa-caret-right"></i>Tenders & Vacancies</a></li>
									<li><a href="#"><i class="fa fa-caret-right"></i>Our Resources</a></li>
									
								</ul>
    						</div>
						</div>
						<!-- <figure>
							<img alt="" src="<?php echo base_url();?>assets/img/icon.jpg">
							<figcaption><a href="index.html#">Learn Courses Online</a></figcaption>
						</figure> -->
					</div>
					<!-- INTERO DES END-->

					<!-- INTERO DES START-->
					<div class="kf_intro_des">
						<div class="kf_intro_des_caption">
							<!-- <span><i class="fa fa-calendar"></i></span> -->
							<h6>Events</h6>
							<div class="widget widget-categories">
								<ul>
									<li><a href="#"><i class="fa fa-caret-right"></i>Seminars</a></li>
									<li><a href="#"><i class="fa fa-caret-right"></i>Conferences</a></li>
									<li><a href="#"><i class="fa fa-caret-right"></i>Special Events</a></li>
								</ul>
    						</div>
						</div>
						<!-- <figure>
							<img alt="" src="<?php echo base_url();?>assets/img/icon.jpg" class="" width="50px">
							<figcaption><a href="index.html#">Learn Courses Online</a></figcaption>
						</figure> -->
					</div>
					<!-- INTERO DES END-->
				</div>
				<div class="col-md-4">
						<div class="kf_edu2_heading2">
							<h3>Resources</h3>
						</div>
						<!--KF_SIDEBAR_SEARCH_WRAP START-->
						<div class="widget widget-courses-list">
							<ul>
							<?php
								$resource_result = '';
								if($resource->num_rows() > 0)
								{
									$counter = 0;
									foreach($resource->result() as $resource)
									{
									 	$resource_name = $resource->resource_name;
										$description = $resource->resource_description;
										$resource_image = $resource->resource_image_name;
										$resource_link = $resource->resource_link;
										$resource_button_text = $resource->resource_button_text;
										$description = $this->site_model->limit_text($description, 8);

										$array = explode('.', $resource_image);
										$suffix = $array[1];

										if($suffix == 'pdf' OR $suffix == 'PDF')
										{
											$fa = 'fa-file-pdf-o';
										}
										else if($suffix == 'xls' OR $suffix == 'XLS')
										{
											$fa = 'fa-file-excel-o';
										}
										else if($suffix == 'doc' OR $suffix == 'Doc')
										{
											$fa = 'fa-file-word-o';
										}
										else if($suffix == 'docx' OR $suffix == 'DOCX')
										{
											$fa = 'fa-file-word-o';
										}
										else if($suffix == 'ppt' OR $suffix == 'PPT')
										{
											$fa = 'fa-file-powerpoint-o';
										}
										else if($suffix == 'pptx' OR $suffix == 'PPTX')
										{
											$fa = 'fa-file-powerpoint-o';
										}
										else
										{
											$fa = 'fa-file-o';

										}
										// if ($counter % 3 == 0) {
										//    echo 'image file';
										// }
										$resource_result .= ' 
															  	<li>


								                                	<figure>
								                                    	<i  class="fa '.$fa.'" aria-hidden="true"></i>
																		'.$resource_name.'
																		<a href="'.$resource_location.''.$resource_image.'" target="_blank">Download</a>
																	</figure>
																</li>';
									}
								}
								else
								{

								}
								echo $resource_result;
							?>
								

								
							</ul>
						</div>
				</div>			
			</div>

	</div>
</section>