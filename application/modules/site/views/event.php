<!--Banner Wrap Start-->
<div class="kf_inr_banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	<!--KF INR BANNER DES Wrap Start-->
                <div class="kf_inr_ban_des">
                	<div class="inr_banner_heading">
						<h3>Courses List</h3>
                	</div>
                   
                    <div class="kf_inr_breadcrumb">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Event</a></li>
						</ul>
					</div>
                </div>
                <!--KF INR BANNER DES Wrap End-->
            </div>
        </div>
    </div>
</div>

<!--Banner Wrap End-->
<?php
$result = ''; 
if($query->num_rows() > 0)
{
	foreach($query->result() as $cat)
	{
		$training_id = $cat->training_id;
		$training_status = $cat->training_status;
		$training_date = $cat->training_date;
		$start_date = $cat->start_date;
		$end_date = $cat->end_date;
		$created = $cat->created;
		$training_name = $cat->training_name;
		$training_image_name = $cat->training_image_name;
		$trainees = $this->training_model->get_attendees($training_id);
		$registered_attendees = $trainees->num_rows();
		
		$v_data['training_id'] = $training_id;
		$v_data['trainees'] = $trainees;
		$start_date = date('jS M Y',strtotime($start_date));
		$end_date = date('jS M Y',strtotime($end_date));
		$created = date('jS M Y',strtotime($created));
		$day = date('d',strtotime($start_date));
		$month = date('M',strtotime($start_date));

		$result .= '
					<div class="col-md-6">
					<div class="edu2_event_wrap side_change">
						<div class="edu2_event_des">
							<h4>'.$month.'</h4>
							<p>'.$training_name.'</p>
							<ul class="post-option">
									<li> <a href="#">From :</a>'.$start_date.' <a href="#">To :</a>'.$end_date.' </li>
							</ul>
							<a href="#" class="readmore">read more<i class="fa fa-long-arrow-right"></i></a>
							<span>11</span>
						</div>
							
						<figure><img src="'.$training_location.''.$training_image_name.'" alt=""/>
							<figcaption><a href="'.$training_location.''.$training_image_name.'"><i class="fa fa-plus"></i></a></figcaption>
						</figure>
					</div>
				</div>
					';
		
	}
}
else
{
	$result = 'There are no trainings';
}

?>
<!--Content Wrap Start-->
<div class="kf_content_wrap">
	<section class="our_event_page">
		<div class="container">
			<div class="row">

				<!-- HEADING 2 START-->
				<div class="col-md-12">
					<div class="kf_edu2_heading2">
						<h3>Events</h3>
					</div>
				</div>
				<!-- HEADING 2 END-->

				<?php echo $result;?>

				<div class="col-md-12">
					<!--KF_PAGINATION_WRAP START-->
					<div class="kf_edu_pagination_wrap">
						<ul class="pagination">
							<li>
								<a href="#" aria-label="Previous">
								<span aria-hidden="true"><i class="fa fa-angle-left"></i>PREV</span>
								</a>
							</li>
							<li class="active"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li>
								<a href="#" aria-label="Next">
								<span aria-hidden="true">Next<i class="fa fa-angle-right"></i></span>
								</a>
							</li>
						</ul>
					</div>
					<!--KF_PAGINATION_WRAP END-->
				</div>

			</div>
		</div>
	</section>
</div>
<!--Content Wrap End-->