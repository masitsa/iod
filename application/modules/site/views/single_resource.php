<?php 

$rs = $resource_category->result();
$resource_category_name = $rs[0]->resource_category_name;
$resource_category_description = $rs[0]->resource_category_description;
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
							<?php echo $this->site_model->get_breadcrumbs();?>
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

    					<div class=" col-lg-6 col-md-7">
    						<!--TEACHER BIO WRAP START-->
    						<div class="teacher_bio_wrap">
    							<!--TEACHER BIO LOGO START-->
    							<div class="teacher_bio_logo">
    								<span><i class="fa fa-folder-open"></i></span>
    								<h3><?php echo $resource_category_name;?></h3>
    							</div>

    							<!--TEACHER BIO LOGO END-->
    							<!--TEACHER BIO des START-->
    							<div class="teacher_bio_des">
    								<?php echo $resource_category_description;?>
    							</div>
    							<!--TEACHER BIO DES END-->
    						</div>
    						<!--TEACHER BIO WRAP END-->
    					</div>

    					<div class="col-lg-6 col-md-5">
    						<div class="kf_event_speakers">
									<!-- <div class="heading_5">
										<h4><span>Resource</span> Downloads </h4>
									</div> -->
									<div class="row">
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
													$resource_result .= ' <div class="col-md-4 col-sm-4">
																			<div class="kf_event_speakers_des">
																				<figure><i  class="fa '.$fa.'" aria-hidden="true"></i></figure>
																				<h5><a href="'.$resource_location.''.$resource_image.'" target="_blank">'.$resource_name.'</a></h5>
																				
																			</div>
																		</div>';
												}
											}
											else
											{

											}
											echo $resource_result;
										?>
									</div>
								</div>
    					</div>

    				</div>
    			</div>
    		</section>
</div>