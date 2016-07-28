 <?php
 $partners_result = '';
 $affiliates_result = '';
 if($partners->num_rows() > 0)
	{
		foreach($partners->result() as $partners)
		{
			$partners_name = $partners->partners_name;
			$description = $partners->partners_description;
			$partners_image = $partners->partners_image_name;
			$partners_type_id = $partners->partner_type_id;
			$partners_link = $partners->partners_link;
			$partners_button_text = $partners->partners_button_text;
			$description = $this->site_model->limit_text($description, 8);
			
			if($partners_type_id == 1)
			{
				$partners_result .= ' 
					<div class="col-lg-3 col-md-4 col-sm-6">
						<!-- FACULTY DES START-->
						<div class="edu2_faculty_des">
							<figure><img src="'.$partners_location.''.$partners_image.'" alt=""/>
								<figcaption>
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-linkedin"></i></a>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</figcaption>
							</figure>
							<div class="edu2_faculty_des2">
								<h6><a href="'.$partners_link.'">'.$partners_name.'</a></h6>
								<!--<p>'.$description.'...</p>-->
							</div>
						</div>
					</div>
				';
			}
			
			else if($partners_type_id == 2)
			{
				$affiliates_result .= ' 
					<div class="col-lg-3 col-md-4 col-sm-6">
						<!-- FACULTY DES START-->
						<div class="edu2_faculty_des">
							<figure><img src="'.$partners_location.''.$partners_image.'" alt=""/>
								<figcaption>
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-linkedin"></i></a>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</figcaption>
							</figure>
							<div class="edu2_faculty_des2">
								<h6><a href="'.$partners_link.'">'.$partners_name.'</a></h6>
								<!--<p>'.$description.'...</p>-->
							</div>
						</div>
					</div>
				';
			}
		}
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
								<!-- HEADING 1 START-->
								<div class="kf_edu2_heading1">
									<h3>Affiliations</h3>
								</div>
								<!-- HEADING 1 END-->

    						</div>
    					</div>

    				</div>
                
    				<div class="row">
    					<?php echo $affiliates_result;?>
    				</div>
                    
                    <div class="row">
    					<div class="col-md-12">
    						<div class="abt_univ_wrap">
								<!-- HEADING 1 START-->
								<div class="kf_edu2_heading1">
									<h3>Partners</h3>
								</div>
								<!-- HEADING 1 END-->

    						</div>
    					</div>

    				</div>
                
    				<div class="row">
    					<?php echo $partners_result;?>
    				</div>
    			</div>
    		</section>
    	</div>