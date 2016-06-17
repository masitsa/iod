 <?php
    // $services = $this->site_model->get_active_services();
    $checking_items = '';
    if($query->num_rows() > 0)
    {   $count = 0;
        foreach($query->result() as $res)
        {
            $resource_category_name = $res->resource_category_name;
            $resource_category_id = $res->resource_category_id;
            $resource_category_description = $res->resource_category_description;
            $mini_desc = implode(' ', array_slice(explode(' ', $resource_category_description), 0, 100));
            $maxi_desc = implode(' ', array_slice(explode(' ', $resource_category_description), 0, 40));
            $web_name = $this->site_model->create_web_name($resource_category_name);

            $where = 'resource_category_id ='.$resource_category_id;
			$table = 'resource';

			$total_rows_item = $this->users_model->count_items($table, $where);

            $count ++;

            $checking_items .=
                            '
							<div class="edu2_col_3_des">
								<h6>'.$resource_category_name.'</h6>
								<p>'.$resource_category_description.' </p>

								<div class="edu2_col_3_ftr">
									<a href="'.site_url().'view-single-resource/'.$web_name.'" class="button">VIEW ATTACHMENTS ('.$total_rows_item.')</a>
								</div>
							</div>'; 
           
        }
    }
    
?>
<div class="kf_inr_banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	<!--KF INR BANNER DES Wrap Start-->
                <div class="kf_inr_ban_des">
                	<div class="inr_banner_heading">
						<h3><?php echo $title;?></h3>
                	</div>
                   
                    <div class="kf_inr_breadcrumb">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Courses Details</a></li>
						</ul>
					</div>
                </div>
                <!--KF INR BANNER DES Wrap End-->
            </div>
        </div>
    </div>
</div>
<div class="kf_content_wrap">
	<section>
		<div class="container">

			<div class="row">
				<div class="col-md-12">
					<div class="col-md-4 col-sm-6">

						<!--EDU2 COLUM 3 Wrap Start-->
						<div class="edu2_col_3_wrap">
							<figure>
								<img src="extra-images/col-3-thum1.jpg" alt="">
								<figcaption><a href="our-courses.html#"><i class="fa fa-play"></i></a></figcaption>
							</figure>

							<?php echo $checking_items;?>


						</div>
						<!--EDU2 COLUM 3 Wrap End-->

					</div>

					


					<div class="col-md-12">
						<!--KF_PAGINATION_WRAP START-->
						<div class="kf_edu_pagination_wrap">
							<ul class="pagination">
								<li>
									<a href="our-courses.html#" aria-label="Previous">
									<span aria-hidden="true"><i class="fa fa-angle-left"></i>PREV</span>
									</a>
								</li>
								<li class="active"><a href="our-courses.html#">1</a></li>
								<li><a href="our-courses.html#">2</a></li>
								<li><a href="our-courses.html#">3</a></li>
								<li><a href="our-courses.html#">4</a></li>
								<li><a href="our-courses.html#">5</a></li>
								<li>
									<a href="our-courses.html#" aria-label="Next">
									<span aria-hidden="true">Next<i class="fa fa-angle-right"></i></span>
									</a>
								</li>
							</ul>
						</div>
						<!--KF_PAGINATION_WRAP END-->
					</div>
				</div>
				<!-- <div class="col-md-3">
					<div class="kf-sidebar">
						<div class="widget widget-categories">
		    							<h2>categories</h2>
										<ul>
											<li><a href="courses-detail.html"><i class="fa fa-caret-right"></i>Business &amp; Economics</a></li>
											<li><a href="courses-detail.html"><i class="fa fa-caret-right"></i>Politics &amp; History</a></li>
											<li><a href="courses-detail.html"><i class="fa fa-caret-right"></i>Medical Sciences &amp; Health</a></li>
											<li><a href="courses-detail.html"><i class="fa fa-caret-right"></i>Fine Arts</a></li>
											<li><a href="courses-detail.html"><i class="fa fa-caret-right"></i>Tourism &amp; Culture</a></li>
											<li><a href="courses-detail.html"><i class="fa fa-caret-right"></i>Sports</a></li>
										</ul>
		    						</div>
					</div>
				</div> -->
			</div>
		</div>
	</section>
</div>