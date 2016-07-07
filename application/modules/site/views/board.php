 <?php
 	$directors_result = '';
	if($directors->num_rows() > 0)
	{
		$counter = 0;
		foreach($directors->result() as $directors)
		{
			$directors_name = $directors->directors_name;
			$description = $directors->directors_description;
			$directors_image = $directors->directors_image_name;
			$directors_link = $directors->directors_link;
			$directors_button_text = $directors->directors_button_text;
			$description = $this->site_model->limit_text($description, 8);

			$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 10));
			// if ($counter % 3 == 0) {
			//    echo 'image file';
			// }
			$directors_result .= ' 
								<div class="col-lg-3 col-md-4 col-sm-6">
		    						<!-- FACULTY DES START-->
									<div class="edu2_faculty_des">
										<figure><img src="'.$directors_location.''.$directors_image.'" alt=""/>
											<figcaption>
												<a href="#"><i class="fa fa-facebook"></i></a>
												<a href="#"><i class="fa fa-twitter"></i></a>
												<a href="#"><i class="fa fa-linkedin"></i></a>
												<a href="#"><i class="fa fa-google-plus"></i></a>
											</figcaption>
										</figure>
										<div class="edu2_faculty_des2">
											<h6><a href="#">'.$directors_name.'</a></h6>
											<strong>'.$directors_button_text.'</strong>
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
									<li><a href="<?php echo site_url();?>home">Home</a></li>
									<li><a href="<?php echo site_url();?>about">About</a></li>
									<li><a href="<?php echo site_url();?>about/board">Board</a></li>
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
								<!-- HEADING 1 START-->
								<div class="kf_edu2_heading1">
									<h5>Our Board</h5>
									<h3>About</h3>
								</div>
								<!-- HEADING 1 END-->

								<div class="abt_univ_des">

									<span>The Board of IOD (K) comprises Duncan Watta (Chairman), John Cheruiyot Kiplagat, Marilyn Kamuru, Lucy Munjuga, Allen Ndungu, Dr. Peter Muthoka, Celestine Otieno, Henry Kiema, and Margaret Chege.</span>

								</div>
    						</div>
    					</div>

    				</div>
                
    				<div class="row">
    					<?php echo $directors_result;?>
    				</div>
    			</div>
    		</section>
    	</div>