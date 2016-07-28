<?php 
$directors_result = '';
if($directors->num_rows() > 0)
{
	$row = $directors->row();
	$directors_name = $row->directors_name;
	$description = $row->directors_description;
	$directors_image = $row->directors_image_name;
	$directors_link = $row->directors_link;
	$directors_button_text = $row->directors_button_text;
	$web_name = $this->site_model->create_web_name($directors_name);
	$image = $directors_location.''.$directors_image;
	
	$directors_result = '<p>'.$description.'</p>';
}
else
{
	$directors_result = 'Unable to find board member';
	$image = '';
}
?>
<div class="kf_inr_banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	<!--KF INR BANNER DES Wrap Start-->
                <div class="kf_inr_ban_des">
                	<div class="inr_banner_heading">
						<h3>Board Member</h3>
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
            	
                <div class=" col-lg-8 col-md-8">
                    <!--TEACHER BIO WRAP START-->
                    <div class="teacher_bio_wrap">
                        <!--TEACHER BIO LOGO START-->
                        <div class="teacher_bio_logo">
                            <span><i class="fa fa-user"></i></span>
                            <h3>Board Member Profile</h3>
                        </div>
                        <!--TEACHER BIO LOGO END-->
                        <!--TEACHER BIO des START-->
                        <div class="teacher_bio_des">
                            <h4><?php echo $title;?></h4>
                            <?php echo $directors_result;?>
                        </div>
                        <!--TEACHER BIO DES END-->
                    </div>
                    <!--TEACHER BIO WRAP END-->
                </div>

                <div class="col-lg-4 col-md-4">
                    <!--TEACHER THUMB START-->
                    <div class="teacher_thumb">
                        <figure>
                            <img src="<?php echo $image;?>" alt=""/>
                            <figcaption>
                                
                            </figcaption>
                        </figure>
                    </div>
                    <!--TEACHER THUMB END-->
                </div>
            </div>
        </div>
    </section>
</div>