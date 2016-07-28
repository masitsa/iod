 <?php
 	$facilitators_result = '';
	if($facilitators->num_rows() > 0)
	{
		$counter = 0;
		foreach($facilitators->result() as $facilitators)
		{
			$facilitators_name = $facilitators->facilitators_name;
			$description = $facilitators->facilitators_description;
			$facilitators_image = $facilitators->facilitators_image_name;
			$facilitators_link = $facilitators->facilitators_link;
			$facilitators_button_text = $facilitators->facilitators_button_text;
			$description = $this->site_model->limit_text($description, 8);

			$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 10));
			// if ($counter % 3 == 0) {
			//    echo 'image file';
			// }
			$facilitators_result .= ' 
								<div class="col-lg-3 col-md-4 col-sm-6">
		    						<!-- FACULTY DES START-->
									<div class="edu2_faculty_des">
										<figure><img src="'.$facilitators_location.''.$facilitators_image.'" alt=""/>
											<figcaption>
												<a href="#"><i class="fa fa-facebook"></i></a>
												<a href="#"><i class="fa fa-twitter"></i></a>
												<a href="#"><i class="fa fa-linkedin"></i></a>
												<a href="#"><i class="fa fa-google-plus"></i></a>
											</figcaption>
										</figure>
										<div class="edu2_faculty_des2">
											<h6><a href="#">'.$facilitators_name.'</a></h6>
											<strong>'.$facilitators_button_text.'</strong>
											<p>'.$mini_desc.'...</p>
										</div>
									</div>
		    					</div>
								';
		}
	}
	else
	{

	}

 ?>

<!--Banner Wrap Start-->
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>OUR <?php echo $title;?></h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<?php echo $this->site_model->get_breadcrumbs();?>
								</ul>
							</div>
                        </div>
                        <!--KF INR BANNER DES Wrap End-->
                    </div>
                </div>
            </div>
        </div>

        <!--Banner Wrap End-->

    	<!--Content Wrap Start-->
    	<div class="kf_content_wrap">
    		<section class="edu2_teachers_page">
    			<div class="container">
                	<div class="row">
    					<div class="col-md-12">
    						<div class="abt_univ_wrap">

								<div class="abt_univ_des">

									<span>Our training facilitators.</span>

								</div>
    						</div>
    					</div>

    				</div>
                
    				<div class="row">
    					<?php echo $facilitators_result;?>
    				</div>
    			</div>
    		</section>
    	</div>